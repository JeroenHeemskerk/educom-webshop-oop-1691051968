<?php

require "session_manager.php";
require "validations.php";
require "data_manipulation.php";
require "main.php";

session_start();
$page = getRequestedPage();
$data = processRequest($page);
showResponsePage($data);


/**
 * Get the requested page
 * 
 * @return string $page : The requested page
 */
function getRequestedPage() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $page = $_POST["page"];
    }
    else {
        $page = isset($_GET["page"]) ? $_GET["page"] : "home";
    }
    return $page;
}


/**
 * Process the page requests
 * 
 * @return array $data : Relevant page data
 */
function processRequest($page) {
    $data["errors"] = array();
    switch($page) {
        case "contact":
            $data = validateContact($page);
            if ($data["valid"]) {
                $page = "contact_thanks";
            }
            break;
        case "register":
            $data = validateRegister($page);
            if ($data["valid"]) {
                storeUser($data["values"]["email"],$data["values"]["name"],$data["values"]["password"]);
                $page = "login";
            }
            break;
        case "login":
            $data = validateLogin($page);
            if ($data["valid"]) {
                loginUser($data);
                $page = "home";
            }
            break;
        case "logout":
            logoutUser();
            $page = "home";
            break;
        case "change_password":
            $data = validateNewPassword($page);
            if ($data["valid"]) {
                updatePassword($data["user"]["user_id"], $data["values"]["new_password"]);
                $page = "home";
            }
            break;
        case "webshop":
            if (requestMethodIsPost()) {
                $product_id = getPostValue("product_id");
                addToCart($product_id);
            }
            $data["products"] = getAllProducts();
            break;
        case "detail":
            $product_id = getRequestedProductId();
            if (doesProductExist($product_id)) {
                $data["product"] = getProductById($product_id);
            }
            if (requestMethodIsPost()) {
                $product_id = getPostValue("product_id");
                addToCart($product_id);
            }
            break;
        case "shopping_cart":
            if (requestMethodIsPost()) {
                $product_id = getPostValue("product_id");
                $quantity = getPostValue("quantity");
                addToCart($product_id, $quantity);
            }
            $data["valid"] = false;
            $data["cart"] = getShoppingCart();
            $data["products"] = getProductsByIds(array_keys($data["cart"]));
            break;
        case "top5":
            $data["top_5_products"] = getTop5Products();
            break;
        case "checkout":
            $data = validateCheckout();
            if ($data["valid"]) {
                emptyCart();
                $data["cart"] = NULL;
                $data["products"] = NULL;
                $page = "checkout_thanks";
            }
            break;
    }
    $data["page"] = $page;
    return $data;
}


/**
 * Get the requested product
 * 
 * @return string: The requested product
 */
function getRequestedProductId() {
    if (isset($_GET["product"]) && $_GET["product"] != "") {
        return  $_GET["product"];
    }
}


/**
 * Display the response page
 * 
 * @param array $data : Relevant page data
 */
function showResponsePage($data) {
    // showError($data, "generic");
    switch ($data["page"]) {
       case "home":
            require "Views/HomeDoc.php";
            $view = new HomeDoc($data);
            $view->show();
            break;
        case "about":
            require "Views/AboutDoc.php";
            $view = new AboutDoc($data);
            $view->show();
            break;
        case "contact":
            require "Views/ContactDoc.php";
            $view = new ContactDoc($data);
            $view->show();
            break;
        case "contact_thanks":
            require "Views/ContactDoc.php";
            $view = new ContactDoc($data);
            $view->show();
            break;
        case "register":
            require "Views/RegisterDoc.php";
            $view = new RegisterDoc($data);
            $view->show();
            break;
        case "login":
            require "Views/LoginDoc.php";
            $view = new LoginDoc($data);
            $view->show();
            break;
        case "change_password":
            require "Views/ChangePasswordDoc.php";
            $view = new ChangePasswordDoc($data);
            $view->show();
            break;
        case "webshop":
            require "Views/WebshopDoc.php";
            $view = new WebshopDoc($data);
            $view->show();
            break;
        case "detail":
            require "Views/DetailDoc.php";
            $view = new DetailDoc($data);
            $view->show();
            break;
        case "shopping_cart":
            require "Views/ShoppingCartDoc.php";
            $view = new ShoppingCartDoc($data);
            $view->show();
            break;
        case "checkout_thanks":
            require "Views/ShoppingCartDoc.php";
            $view = new ShoppingCartDoc($data);
            $view->show();
            break;
        case "top5":
            require "Views/TopFiveDoc.php";
            $view = new TopFiveDoc($data);
            $view->show();
            break;
        default:
            show404Page();
    }
}