<?php

require_once "session_manager.php";
require_once "validations.php";
require_once "db_repository.php";

session_start();
require_once "Controllers/PageController.php";

$controller = new PageController();
$controller->handleRequest();