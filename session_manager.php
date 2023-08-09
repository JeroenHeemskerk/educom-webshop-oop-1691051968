<?php

/**
 * Set user data inside session variable for use on other pages
 * 
 * @param array $data: User data
 */
function loginUser($data) {
    $_SESSION["user_name"] = $data["user"]["name"];
    $_SESSION["user_id"] = $data["user"]["user_id"];
}

/**
 * Return boolean to indicate if user is logged in or not
 * 
 * @return boolean: TRUE if user is logged in -or- FALSE if not logged in
 */
function isUserLoggedIn() {
    return isset($_SESSION["user_name"]);
}


/**
 * Return user ID
 * 
 * @return int: User ID
 */
function getLoggedInUserId() {
    return $_SESSION["user_id"];
}


/**
 * Return user name 
 * 
 * @return string: User name 
 */
function getLoggedInUserName() {
    return $_SESSION["user_name"];
}


/**
 * Unset user data inside session variable
 */
function logoutUser() {
    unset($_SESSION["user_name"]);
    unset($_SESSION["user_id"]);
}


/**
 * Return boolean to indicate if cart is empty or not
 * 
 * @return boolean: TRUE if cart is empty -or- FALSE if cart has product(s)
 */
function isShoppingCartEmpty() {
    return !isset($_SESSION["cart"]);
}


/**
 * Set product order data inside session variable
 */
function addToCart($product_id, $amount=1) {
    if ($amount == 0) {
        removeFromCart($product_id);
    }
    else {
        $_SESSION["cart"][$product_id] = $amount;
    }
}


/**
 * Return products inside shopping cart
 * 
 * @return array: Shopping cart products
 */
function getShoppingCart() {
    return $_SESSION["cart"];
}


/**
 * Unset product id inside session variable, and unset cart data if cart is empty
 */
function removeFromCart($product_id) {
    unset($_SESSION["cart"][$product_id]);
    if (isShoppingCartEmpty()) {
        emptyCart();
    }
}


/**
 * Unset cart data inside session variable
 */
function emptyCart() {
    unset($_SESSION["cart"]);
}