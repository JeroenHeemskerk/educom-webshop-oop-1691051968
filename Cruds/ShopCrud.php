<?php 

class ShopCrud {
    
    private $crud;

    public function __construct($crud) {
        $this->crud = $crud;
    }
    public function readAllProducts() {
        $sql = "SELECT *
                FROM product;";
        $params=NULL;
        $key_column = "product_id";
        $products = $this->crud->readMultipleRow($sql,$params,$key_column);
        return $products;
    }
    public function readProductById($product_id) {
        $sql = "SELECT *
                FROM product
                WHERE product_id = :product_id";
        $params = array(":product_id"=>$product_id);
        $product = $this->crud->readOneRow($sql,$params);
        return $product;
    }
    public function readMultipleProductById($product_id_array) {
        $sql = "SELECT *
                FROM product
                WHERE FIND_IN_SET (product_id, :array)";
        $params = array(":array"=>implode(',', $product_id_array));
        $key_column = "product_id";
        $products = $this->crud->readMultipleRow($sql,$params,$key_column);
        return $products;
    }
    public function createOrder($user_id) {
        $sql = "INSERT INTO `order` (user_id) 
                VALUES (:user_id)";
        $params = array(":user_id"=>$user_id);
        $last_id = $this->crud->createRow($sql,$params);
        return $last_id;
    }
    public function createProductOrder($order_id,$product_id,$quantity) {
        $sql = "INSERT INTO product_order (order_id, product_id, quantity)
                VALUES (:order_id, :product_id, :quantity)";
        $params = array(":order_id"=>$order_id,":product_id"=>$product_id,":quantity"=>$quantity);
        $last_id = $this->crud->createRow($sql,$params);
        return $last_id;
    }
    public function readTop5Products() {
        $sql = "SELECT
                p.product_id
                ,p.brand 
                ,p.name
                ,p.filename
                ,SUM(po.quantity) AS sold_quantity
            FROM `product_order` AS po

            LEFT JOIN `order` o 
                ON o.order_id = po.order_id
            LEFT JOIN `product` AS p 
                ON p.product_id = po.product_id

            WHERE date >= DATE(NOW() - INTERVAL 7 DAY)
            GROUP BY po.product_id
            ORDER BY sold_quantity DESC
            LIMIT 5;";
        $params = NULL;
        $key_column = "product_id";
        $products = $this->crud->readMultipleRow($sql,$params,$key_column);
        return $products;
    }
}