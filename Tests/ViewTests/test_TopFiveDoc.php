<?php 

require_once "../Views/TopFiveDoc.php";
require_once "../data_manipulation.php";

$top_5_products = getTop5Products();
$data = array("page"=>"top5","values"=>array(),"errors"=>array(),"valid"=>false);

$test = new TopFiveDoc($data, $top_5_products);
$test->show(); 