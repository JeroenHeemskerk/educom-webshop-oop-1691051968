<?php

require_once "FormsDoc.php";

class ContactDoc extends FormsDoc {
    
    protected function showForm() {
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
    private function showFormThanks() {
        echo '<div>🙂<br>Thank you for reaching out, I\'ll get back to you soon</div>';
        echo '<h3>Summary</h3>';
        echo '<p>';
        echo 'Gender: '.getValue("gender").'<br>';
        echo 'Name: '.getValue("name").'<br>';
        echo 'Email: '.getValue("email").'<br>';
        echo 'Phone: '.getValue("phone").'<br>';
        echo 'Subject: '.getValue("subject").'<br>';
        echo 'Communicatioin preference: '.getValue("commpref").'<br>';
        echo 'Message: '.getValue("message").'<br>';
        echo '</p>';
    }
    protected function showContent() {
        if ($this->data["valid"]) {
            $this-showFormThanks();
        }
        else {
            $this->showForm();
        }
    }
}