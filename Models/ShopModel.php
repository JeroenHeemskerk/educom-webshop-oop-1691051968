<?php

require_once "UserModel.php";
require_once "Util.php";
require_once "db_repository.php";

class ShopModel extends UserModel {

    public $products = array();
    public $product;
    public $cart = array();
    public $top_5_products = array();

    public function __construct($model) {
        PARENT::__construct($model);
    }
    public function doesProductExist($product_id) {
        return (!is_null(getProductById($product_id)));
    }
    public function validateCheckout() {
        try {
            $user_id = $this->session_manager->getLoggedInUserId();
            storeOrder($user_id);
            $order_id = getLastOrderId($user_id);
            foreach ($this->cart as $product_id => $product_amount) {
                insertProductOrder($product_id, $order_id, $product_amount);
            }
        }
        catch (Exception $e) {
            $this->recordGenericError();
            Util::showLog($e->getMessage());
        }
        $this->checkForError();
    }
}