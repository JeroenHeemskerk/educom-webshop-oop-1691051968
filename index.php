<?php

session_start();
require_once "Controllers/PageController.php";

$controller = new PageController();
$controller->handleRequest();