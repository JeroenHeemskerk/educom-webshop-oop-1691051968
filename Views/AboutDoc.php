<?php

require_once "BasicDoc.php";

class AboutDoc extends BasicDoc {

    protected function showContent() {
        $this->showDivStart();
        echo '<h2>Quincy Tromp</h2>';
        echo '<img src="../Images/me.JPG" alt="A picture of me">';
        echo '<p>I\'m an application/software development trainee. My ambition is to become a data engineer.</p>';
        echo '<p>I\'m currently working at Educom, to get a solid foundation in programming.</p>';
        echo '<p>I enjoy:';
        echo '<ul>';
        echo '<li>Exercising</li>';
        echo '<li>Cooking</li>';
        echo '<li>Reading</li>';
        echo '</ul>';
        echo '</p>';
        echo '<button class="click_btn" type="button"><a href="index.php?page=contact">Contact Me</a></button>';
        $this->showDivEnd();
    }
}