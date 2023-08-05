<?php

require_once "FormsDoc.php";

class RegisterDoc extends FormsDoc {

   protected function showForm() {
        $this->showFormStart();
        $this->showFormField("email","Email","email","user_already_exists");
        $this->showFormField("name","Name","text","name");
        $this->showFormField("password","Password","password","password");
        $this->showFormField("confirm_password","Confirm Password","password","confirm_password");
        $this->showFormEnd("register","Register");
   }
   protected function showContent() {
    $this->showForm();
   }
}