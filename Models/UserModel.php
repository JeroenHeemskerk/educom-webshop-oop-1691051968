<?php

require_once "PageModel.php";
require_once "Util.php";

class UserModel extends PageModel {

    public $values = array();
    public $user = array();
    public $errors = array();
    private $crud;

    public function __construct($model,$crud) {
        PARENT::__construct($model);
        $this->crud = $crud;
    }
    public function getFormFields() {
        $form_fields = array("contact"=>array("gender"=>"","name"=>"","email"=>"","phone"=>"","subject"=>"","commpref"=>"","message"=>""),
                        "register"=>array("email"=>"","name"=>"","password"=>"","confirm_password"=>""),
                        "login"=>array("email"=>"","password"=>""),
                        "change_password"=>array("current_password"=>"","new_password"=>"","confirm_new_password"=>""));
        return $form_fields[$this->page];
    }
    public function setEmptyFields() {
        $this->values = $this->getFormFields();
    }
    public function validateField($key, $value) {
        if (empty($value)) { 
            $this->errors[$key] = ucfirst(str_replace("_", " ", $key)) .  " is required";
        }
        else {
            switch($key) { 
                case "name":
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$value)) { 
                        $this->errors[$key] = "Only letters and white space allowed";
                    }
                    break;
                case "email":
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) { 
                        $this->errors[$key] = "Invalid email format";
                    }
                    break;
                case "phone":
                    if(!preg_match('/^[0-9]{10}+$/', $value)) {
                        $this->errors[$key] = "Not a valid Phone number";
                    }
                    break;
                case "confirm_password":
                    if ($this->values["password"] != $value) {
                        $this->errors[$key] = "Passwords do not match. Try again";
                    }
                    break;
            }   
        } 
    }
    public function ValidateForm() {
        foreach ($this->values as $key => $value) {
            $value = Util::getPostValue($key);
            $this->values[$key] = $value;
            $this->validateField($key, $value);
        }
    }
    public function validateContactForm() {
        $this->setEmptyFields();
        if (Util::isPost()) {
            $this->setPage(Util::getPostValue("page"));
            $this->ValidateForm();
            $this->checkForError();
        }
        if ($this->valid) {
            $this->setPage("contact_thanks");
        }
    }
    public function isEmailNotEmpty() {
        return (!empty($this->values["email"]));
    }
    public function doesEmailExist($email) {
        return !is_null($this->crud->readUserByEmail($email));
    }
    public function validateRegisterForm() {
        $this->setEmptyFields();
        if (Util::isPost()) {
            $this->setPage(Util::getPostValue("page"));
            $this->ValidateForm();
            try {
                if ($this->isEmailNotEmpty()) {
                    if ($this->doesEmailExist($this->values["email"])) {
                        $this->errors["user_already_exists"] = "Email already exists";
                    }
                }
            }
            catch (Exception $e) {
                $this->recordGenericError();
                Util::showLog($e->getMessage());
            }
            $this->checkForError();
        }
        if ($this->valid) {
            $this->crud->createUser($this->values["email"],$this->values["name"],$this->values["password"]);
            $this->setPage("login");
        }
    }
    public function validateLoginForm() {
        $this->setEmptyFields();
        if (Util::isPost()) {
            $this->setPage(Util::getPostValue("page"));
            $this->ValidateForm();
            try {
                if ($this->isEmailNotEmpty()) {
                    if (!$this->doesEmailExist($this->values["email"])) {
                        $this->errors["no_existing_user"] = "This user doesn't seem to exist";
                    }
                    else {
                        $user = $this->crud->readUserByEmail($this->values["email"]);
                        if ($this->values["password"] != $user->password) {
                            $this->errors["authentication"] = "Your password is incorrect";
                        }
                        else {
                            $this->user["user_id"] = $user->user_id;
                            $this->user["name"] = $user->name;
                        }
                    }
                }   
            }
            catch (Exception $e) {
                $this->model->recordGenericError();
                Util::showLog($e->getMessage());
            }
            $this->checkForError();
        }
        if ($this->valid) {
            $this->session_manager->LoginUser($this->user);
            $this->setPage("home");
        }
    }
    public function validateChangePasswordForm() {
        $this->setEmptyFields();
        if (Util::isPost()) {
            if ($this->session_manager->isUserLoggedIn()) {
                $this->setPage(Util::getPostValue("page"));
                $this->ValidateForm();

                try {
                    $user = $this->crud->readUserById($this->session_manager->getLoggedInUserId());
                    if ($this->values["current_password"] != $user->password) { 
                        $this->errors["current_password"] = "Your password is incorrect";
                    }
                    elseif ($this->values["new_password"] != $this->values["confirm_new_password"]) {
                        $this->errors["confirm_new_password"] = "Passwords do not match. Try again";
                    }
                    else {
                        $this->user["user_id"] = $user->user_id;
                        $this->user["name"] = $user->name;
                    }
                }
                catch (Exception $e) {
                    $this->model->recordGenericError();
                    Util::showLog($e->getMessage());
                }
                $this->checkForError();
            }
            if ($this->valid) {
                $this->crud->updateUserPassword($this->user["user_id"],$this->values["new_password"]);
                $this->setPage("home");
            }
        }
    }
}