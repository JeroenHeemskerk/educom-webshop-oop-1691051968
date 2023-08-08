<?php 

require_once "../Views/ShoppingCartDoc.php";
require_once "../session_manager.php";
require_once "../data_manipulation.php";

$_SESSION["cart"]= array(1003=>2,1005=>1,1008=>5);
$cart = getShoppingCart();
$products = getProductsByIds(array_keys($cart));
$data = array("page"=>"shopping_cart","values"=>array(),"errors"=>array(),"valid"=>false);

$test = new ShoppingCartDoc($data, $cart, $products);
$test->show(); 