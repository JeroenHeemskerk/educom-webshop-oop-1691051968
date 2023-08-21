<?php

require_once "../../Cruds/IShopCrud.php";

class TestShopCrud implements IShopCrud {

    public $sqlQueries = array();
    public $arrayToReturn = array();

    public function readAllProducts() {
        array_push($this->sqlQueries, "readAllProducts");
        return $this->arrayToReturn;
    }
    public function readProductById($product_id) {
        array_push($this->sqlQueries, "readProductById");
        return $this->arrayToReturn;
    }
    public function readMultipleProductById($product_id_array) {
        array_push($this->sqlQueries, "readMultipleProductById");
        return $this->arrayToReturn;
    }
    public function createOrder($user_id) {
        array_push($this->sqlQueries, "createOrder");
        if ($user_id == 1) {
            throw new Exception("This a test exception");
        }
        return $user_id;
    }
    public function createProductOrder($order_id,$product_id,$quantity) {
        array_push($this->sqlQueries, "createProductOrder");
    }
    public function readTop5Products() {
        array_push($this->sqlQueries, "readTop5Products");
        return $this->arrayToReturn;
    }

}