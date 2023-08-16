<?php

session_start();
require_once "Controllers/PageController.php";
require_once "Cruds/Crud.php";
require_once "Models/FactoryModel.php";

$crud = new Crud();
$factory = new FactoryModel($crud);
$controller = new PageController($factory);
$controller->handleRequest();