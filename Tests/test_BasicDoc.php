<?php

require_once '../Views/BasicDoc.php';

$menu = array("home"=>"Home","about"=>"About","contact"=>"Contact");
$data = array ("page"=>"basic","menu"=>$menu);

$view = new BasicDoc($data);
$view  -> show();