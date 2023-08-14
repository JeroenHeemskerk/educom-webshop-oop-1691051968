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
    public function loginUser($user) {
        $_SESSION["user_id"] = $user["user_id"];
        $_SESSION["user_name"] = $user["name"];
    }
    public function logoutUser() {
        unset($_SESSION["user_name"]);
        unset($_SESSION["user_id"]);
    }
}