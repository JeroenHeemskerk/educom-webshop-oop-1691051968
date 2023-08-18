<?php 

require_once "../Views/DetailDoc.php";
require_once "../data_manipulation.php";

$data = array("page"=>"detail","values"=>array(),"errors"=>array());
$product = getProductById(1003);

$test = new DetailDoc($data, $product);
$test->show(); 