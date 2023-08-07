<?php 

require_once "../Views/ChangePasswordDoc.php";

$data = array("page"=>"change_password","values"=>array(),"errors"=>array());

$test = new ChangePasswordDoc($data);
$test->show();