<?php

class TestUser {

    public function __construct($user_id,$email,$name,$password) {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }
}