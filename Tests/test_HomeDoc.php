<?php

require_once "../Views/HomeDoc.php";

$data = $menu = array("home"=>"Home","about"=>"About","contact"=>"Contact");
$data = array ("page"=>"home","menu"=>$menu);

$view = new HomeDoc($data);
$view->show();