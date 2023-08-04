<?php

require_once "BasicDoc.php";

class HomeDoc extends BasicDoc {

    protected function showContent() {
        echo '<div class="home">';
        echo '<h1>Home</h1>';
        echo '<div class="row">';
        echo '<div class="column">';
        echo '<p>Hi! I\'m Quincy.<br>Welcome to my website.</p>';
        echo '</div>';
        echo '<div class="column">';
        echo '<img src="../Images/me.JPG" alt="A picture of me">';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<button type="button" class="click_btn"><a href="index.php?page=contact">Contact Me</a></button>';
    }
}