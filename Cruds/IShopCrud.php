<?php

interface IShopCrud {
    
    public function readAllProducts();
    public function readProductById($product_id);
    public function readMultipleProductById($product_id_array);
    public function createOrder($user_id);
    public function createProductOrder($order_id,$product_id,$quantity);
    public function readTop5Products();
}