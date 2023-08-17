<?php

require_once "PageModel.php";
require_once "Util.php";

class ShopModel extends PageModel {

    public $products = array();
    public $product = NULL;
    public $cart = array();
    public $cart_products = array();
    public $top_5_products = array();
    private $crud;

    public function __construct($model,$crud) {
        PARENT::__construct($model);
        $this->crud = $crud;
    }
    public function setProducts() {
        $this->products = $this->crud->readAllProducts();
    }
    public function validateProductAddToCart() {
        if (Util::isPost()) {
            $product_id = Util::getPostValue("product_id");
            $this->session_manager->addToCart($product_id);
        }
    }
    public function validateDetailProduct() {
        $product_id = Util::getUrlValue("product_id");
        $this->product = $this->crud->readProductById($product_id);
        if (!$this->product) {
            $this->setPage("404");
        }
    }
    public function setShoppingCart() {
        $this->cart = $this->session_manager->getShoppingCart();
    }
    public function setCartProducts() {
        $this->cart_products = $this->crud->readMultipleProductById(array_keys($this->cart));
    }
    public function validateShoppingCart() {
        $this->setShoppingCart();
        $this->setCartProducts();
        if (Util::isPost()) {
            $product_id = Util::getPostValue("product_id");
            $quantity = Util::getPostValue("quantity");
            $this->session_manager->addToCart($product_id,$quantity);
        }
    }
    public function validateCheckout() {
        try {
            $user_id = $this->session_manager->getLoggedInUserId();
            $order_id = $this->crud->createOrder($user_id);
            foreach ($this->cart as $product_id => $product_amount) {
                $this->crud->createProductOrder($order_id, $product_id, $product_amount);
            }
        }
        catch (Exception $e) {
            $this->recordGenericError();
            Util::showLog($e->getMessage());
        }
        $this->checkForError();
        if ($this->valid) {
            $this->session_manager->emptyCart();
            $this->setPage("checkout_thanks");
        }
    }
    public function setTop5Products() {
        $this->top_5_products = $this->crud->readTop5Products();
    }
}