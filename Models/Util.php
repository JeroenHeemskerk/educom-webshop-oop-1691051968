<?php 

class Util {

    public static function isPost() {
        return $_SERVER["REQUEST_METHOD"] == "POST";
    }
    public static function cleanInput($value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }
    public static function getPostValue($key, $default="") {
        return isset($_POST[$key]) ? Util::cleanInput($_POST[$key]) : $default;
    }
    public static function getUrlValue($key, $default="") {
        return isset($_GET[$key]) ? Util::cleanInput($_GET[$key]) : $default;
    }
}