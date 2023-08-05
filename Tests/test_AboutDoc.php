<?php

require_once "../Views/AboutDoc.php";

$data = array("page"=>"about");

$test = new AboutDoc($data);
$test->show();