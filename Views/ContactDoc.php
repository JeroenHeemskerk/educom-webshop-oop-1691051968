<?php

require_once "FormsDoc.php";

class ContactDoc extends FormsDoc {
        
    protected function showContent() {
        $this->showFormStart();
        $this->showFormField("gender","Gender","select",array("gender"), array("","Male","Female"));
        $this->showFormField("name","Name","text",array("name"));
        $this->showFormField("email","Email","email",array("email"));
        $this->showFormField("phone","Phone","text",array("phone"));
        $this->showFormField("subject","Subject","text",array("subject"));
        $this->showFormField("commpref","Communication preference","radio",array("commpref"),array("Email","Phone"));
        $this->showFormField("message","Message","textarea",array("message"));
        $this->showFormEnd("contact","Submit");
    }
}