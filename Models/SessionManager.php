<?php

class SessionManager {

    public function isUserLoggedIn() {
        return isset($_SESSION["user_name"]);
    }
    public function getLoggedInUserId() {
        return $_SESSION["user_id"];
    }
    public function getLoggedInUserName() {
        return $_SESSION["user_name"];
    }
}