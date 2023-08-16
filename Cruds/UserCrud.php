<?php

require_once "Crud.php";

class UserCrud {

    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }

    public function createUser($email,$name,$password) {
        $sql = "INSERT INTO user (email, name, password) 
                VALUES (:email, :name, :password)";
        $params = array(":email"=>$email,":name"=>$name,":password"=>$password);
        $last_id = $this->crud->createRow($sql,$params);
        return $last_id;
    }
    public function readUserByEmail($email) {
        $sql = "SELECT user_id, email, name, password
                FROM user
                WHERE email = :email";
        $params = array(":email"=>$email);
        $user = $this->crud->readOneRow($sql,$params);
        return $user;
    }
    public function readUserById($user_id) {
        $sql = "SELECT user_id, email, name, password
                FROM user
                WHERE user_id = :user_id";
        $params = array(":user_id"=>$user_id);
        $user = $this->crud->readOneRow($sql,$params);
        return $user;
    }
    public function updateUserPassword($user_id,$new_password) {
        $sql = "UPDATE user
                SET password = :new_password
                WHERE user_id = :user_id";
        $params = array(":user_id"=>$user_id,":new_password"=>$new_password);
        $this->crud->updateOneRow($sql,$params);
    }
}