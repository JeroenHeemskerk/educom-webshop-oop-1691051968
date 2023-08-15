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
    public function addToCart($product_id, $amount=1) {
        if ($amount == 0) {
            removeFromCart($product_id);
        }
        else {
            $_SESSION["cart"][$product_id] = $amount;
        }
    }
    public function removeFromCart($product_id) {
        unset($_SESSION["cart"][$product_id]);
        if (isShoppingCartEmpty()) {
            emptyCart();
        }
    }
    public function isShoppingCartEmpty() {
        return !isset($_SESSION["cart"]);
    }
    public function getShoppingCart() {
        if (isShoppingCartEmpty()) {
            return NULL;
        }
        return $_SESSION["cart"];
    }
    public function emptyCart() {
        $_SESSION["cart"] = [];
    }
}