<?php 

require_once "../Views/WebshopDoc.php";
require_once "../data_manipulation.php";

$data = array("page"=>"webshop","values"=>array(),"errors"=>array());
$products = getAllProducts();

$test = new WebshopDoc($data, $products);
$test->show(); 