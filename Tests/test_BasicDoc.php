<?php

require_once '../Views/BasicDoc.php';

$data = array("page"=>"basic");

$test = new BasicDoc($data);
$test  -> show();