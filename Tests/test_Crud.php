<?php 

require_once "../CRUD/Crud.php";

$test = new Crud();

$sql = "INSERT INTO MyGuests (firstname, lastname, email)
        VALUES (:firstname, :lastname, :email);";
$params = array("firstname"=>"John","lastname"=>"Doe","email"=>"john@example.com");
$test->createRow($sql, $params);

$sql = "SELECT id, firstname, lastname, email
          FROM MyGuests
          WHERE id=:id"; 
$params = array("id"=>42);
$test->readOneRow($sql, $params);

$sql = "SELECT id, firstname, lastname, email 
        FROM MyGuests"; 
$params = array();
$key_column = "id";
$test->readMultipleRow($sql,$params,$key_column);