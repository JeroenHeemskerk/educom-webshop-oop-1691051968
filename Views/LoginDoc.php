<?php 

require_once "FormsDoc.php";

class LoginDoc extends FormsDoc {

    protected function showForm() {
        $this->showFormStart();
        $this->showFormField("email","Email","email",array("email","no_existing_user"));
        $this->showFormField("password","Password","password",array("password","authentication"));
        $this->showFormEnd("login","Login");
   }
   protected function showContent() {
    $this->showForm();
   }
}