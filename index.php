<?php

session_start();
require_once "Controllers/PageController.php";
require_once "Cruds/Crud.php";
require_once "Models/ModelFactory.php";

$crud = new Crud();
$factory = new ModelFactory($crud);
$controller = new PageController($factory);
$controller->handleRequest();