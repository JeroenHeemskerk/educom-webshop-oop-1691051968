<?php

require_once '../Views/ContactDoc.php';

$data = array("page"=>"contact","values"=>array(),"errors"=>array(),"valid"=>false);

$test = new ContactDoc($data);
$test->show();