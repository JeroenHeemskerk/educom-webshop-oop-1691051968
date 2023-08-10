<?php

require_once "FormsDoc.php";

class ContactThanksDoc extends FormsDoc {

    protected function showContent() {
        $this->showDivStart();
        echo '<p class="center">🙂<br>Thank you for reaching out, I\'ll get back to you soon</p>';
        $this->showDivEnd();
        echo '<h3 class="center">Summary</h3>';
        echo '<p class="center">';
        echo 'Gender: '.$this->getValue("gender").'<br>';
        echo 'Name: '.$this->getValue("name").'<br>';
        echo 'Email: '.$this->getValue("email").'<br>';
        echo 'Phone: '.$this->getValue("phone").'<br>';
        echo 'Subject: '.$this->getValue("subject").'<br>';
        echo 'Communicatioin preference: '.$this->getValue("commpref").'<br>';
        echo 'Message: '.$this->getValue("message").'<br>';
        echo '</p>';
    }

}