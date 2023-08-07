<?php

require_once "FormsDoc.php";

class RegisterDoc extends FormsDoc {

   protected function showForm() {
        $this->showFormStart();
        $this->showFormField("email","Email","email",array("email","user_already_exists"));
        $this->showFormField("name","Name","text",array("name"));
        $this->showFormField("password","Password","password",array("password"));
        $this->showFormField("confirm_password","Confirm Password","password",array("confirm_password"));
        $this->showFormEnd("register","Register");
   }
   protected function showContent() {
    $this->showForm();
   }
}