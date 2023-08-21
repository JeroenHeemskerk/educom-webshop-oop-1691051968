<?php

require_once "../../Cruds/IUserCrud.php";

class TestUserCrud implements IUserCrud {

    public $sqlQueries = array();
    public $arrayToReturn = array();

    public function readUserByEmail($email) {
        array_push($this->sqlQueries, "readUserByEmail");
        if (!isset($email)) {
            return NULL;
        }
        else {
            return $this->arrayToReturn;
        } 
    }
    public function createUser($email,$name,$password) {
        array_push($this->sqlQueries, "createUser");
    }
    public function readUserById($user_id) {
        array_push($this->sqlQueries, "readUserById");
        return $this->arrayToReturn;
    }
    public function updateUserPassword($user_id,$new_password) {
        array_push($this->sqlQueries, "updateUserPassword");
    }
}