<?php

require_once "../Views/HomeDoc.php";

$data = array("page"=>"home");

$test = new HomeDoc($data);
$test->show();