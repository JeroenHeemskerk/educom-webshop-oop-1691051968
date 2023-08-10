<?php

require_once "BasicDoc.php";

class HomeDoc extends BasicDoc {

    protected function showContent() {
        $this->showDivStart("row");
        $this->showDivStart("column");
        echo '<p>Hi! I\'m Quincy.<br>Welcome to my website.</p>';
        $this->showDivEnd();
        $this->showDivStart("column");
        echo '<img src="Images/me.JPG" alt="A picture of me">';
        $this->showDivEnd();
        $this->showDivEnd();

    }
}