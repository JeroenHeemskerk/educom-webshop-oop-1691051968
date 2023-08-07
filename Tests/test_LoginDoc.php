<?php 

require_once "../Views/LoginDoc.php";

$data = array("page"=>"login","values"=>array(),"errors"=>array());

$test = new LoginDoc($data);
$test->show();