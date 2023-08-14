<?php

require_once "PageModel.php";
require_once "Util.php";

class UserModel extends PageModel {

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
    }
    private function getFormFields() {
        $form_fields = array("contact"=>array("gender"=>"","name"=>"","email"=>"","phone"=>"","subject"=>"","commpref"=>"","message"=>""),
                        "register"=>array("email"=>"","name"=>"","password"=>"","confirm_password"=>""),
                        "login"=>array("email"=>"","password"=>""),
                        "change_password"=>array("current_password"=>"","new_password"=>"","confirm_new_password"=>""));
        return $form_fields[$this->page];
    }
    private function setFormValues() {
        $this->values = $this->getFormFields();
    }
    private function validateField($key, $value) {
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
                    if (!$this->values->password == $this->values->confirm_password) {
                        $this->errors["confirm_password"] = "Passwords do not match. Try again";
                    }
                    break;
            }   
        } 
    }
    private function ValidateForm() {
        foreach ($this->values as $key => $value) {
            $value = Util::getPostValue($key);
            $this->values[$key] = $value;
            $this->validateField($key, $value);
        }
    }
    private function checkForError() {
        if (empty($this->errors)) {
            $this->valid = true;
        }
    }
    public function validateContact() {
        $this->setFormValues();
        if (Util::isPost()) {
            $this->setPage(Util::getPostValue("page"));
            $this->ValidateForm();
            $this->checkForError();
        }
    } 
    //
    public function doesEmailExist($email) {
        return (!is_null(findUserByEmail($email)));
    }
    public function validateRegister() {
        $this->setFormValues();
        if (Util::isPost()) {
            $this->setPage(getPostValue("page"));
            $this->ValidateForm();
            try {
                if (!empty($this->values->email)) {
                    if ($this->doesEmailExist($this->values->email)) {
                        $this->errors["user_already_exists"] = "Email already exists";
                    }
                }
            }
            catch (Exception $e) {
                $this->errors["genericErr"] = 'Due to technical error, we cannot proceed with this process';
                Util::showLog($e->getMessage());
            }
            checkForError();
        }
    }
    function validateLogin() {
        $this->setFormValues();
        if (Util::isPost()) {
            $this->setPage(getPostValue("page"));
            $this->ValidateForm();
            try {
                if (!empty($this->values->email)) {
                    if (!doesEmailExist($this->values->email)) {
                        $this->errors["no_existing_user"] = "This user doesn't seem to exist";
                    }
                    else {
                        $user = findUserByEmail($this->values->email);
                        if (!$data["values"]["password"] == $user["password"]) {
                            $data["errors"]["authentication"] = "Your password is incorrect";
                        }
                        else {
                            $data["user"]["user_id"] = $user["user_id"];
                            $data["user"]["name"] = $user["name"];
                        }
                    }
                }   
            }
            catch (Exception $e) {
                $this->errors["genericErr"] = 'Due to technical error, we cannot proceed with this process';
                Util::showLog($e->getMessage());
            }
            $this->checkForError();
        }
    }
}