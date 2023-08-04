<?php

require_once "../Views/AboutDoc.php";

$data = $menu = array("home"=>"Home","about"=>"About","contact"=>"Contact");
$data = array ("page"=>"about","menu"=>$menu);

$view = new AboutDoc($data);
$view->show();