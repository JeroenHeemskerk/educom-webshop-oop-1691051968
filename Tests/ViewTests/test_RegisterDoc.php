<?php 

require_once "../Views/RegisterDoc.php";

$data = array("page"=>"register","values"=>array(),"errors"=>array());

$test = new RegisterDoc($data);
$test->show();