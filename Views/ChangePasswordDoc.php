<?php

require_once "FormsDoc.php";

class ChangePasswordDoc extends FormsDoc {

    protected function showForm() {
        $this->showFormStart();
        $this->showFormField("current_password","Current Password","password",array("current_password"));
        $this->showFormField("new_password","New password","password",array("new_password"));
        $this->showFormField("confirm_new_password","Confirm new password","password",array("confirm_new_password"));
        $this->showFormEnd("change_password","Update");
   }
   protected function showContent() {
    $this->showForm();
   }
}