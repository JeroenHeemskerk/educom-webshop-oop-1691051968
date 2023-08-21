<?php

interface IUserCrud {

    public function createUser($email,$name,$password);
    public function readUserByEmail($email);
    public function readUserById($user_id);
    public function updateUserPassword($user_id,$new_password);
}