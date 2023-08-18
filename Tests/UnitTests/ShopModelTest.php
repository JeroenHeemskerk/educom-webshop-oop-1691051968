<?php

require_once "../../Models/ShopModel.php";
require_once "TestShopCrud.php";
require_once "TestProduct.php";
use PHPUnit\Framework\TestCase;

class ShopModelTest extends TestCase {
    
    private function createTestProduct($id) {
        return new TestProduct($id,"Name_".$id,"Brand_".$id,"A test product",1.01,"testimage.jpg");
    }
    private function createTestShopCrud($n, $nums=NULL) {
        $crud = new TestShopCrud();
        if (!is_null($n)) {
            for ($x = 1; $x <= $n; $x++) {
                $crud->arrayToReturn[$x] = $this->createTestProduct($x);
            }
        }
        else {
            if (!is_null($nums)) {
                foreach ($nums as $num) {
                    $crud->arrayToReturn[$num] = $this->createTestProduct($num);
                }
            }
        }
        return $crud;
    }
    public function testSetProducts_LengthProductsEqualTo() {
        // prepare
        $crud = $this->createTestShopCrud(7);
        $shop_model = new ShopModel(NULL,$crud);
        // run
        $shop_model->setProducts();
        $result = sizeof($shop_model->products);
        // validate
        $this->assertEquals(7, $result);
    }
    public function testSetProducts_OneProductsEqualTo() {
         // prepare
        $crud = $this->createTestShopCrud(7);
        $shop_model = new ShopModel(NULL,$crud);
        // run
        $shop_model->setProducts();
        $result = array($shop_model->products[5]->id,
                        $shop_model->products[5]->name,
                        $shop_model->products[5]->brand,
                        $shop_model->products[5]->description,
                        $shop_model->products[5]->price,
                        $shop_model->products[5]->filename);
        // validate
        $this->assertEquals(array(5,"Name_5","Brand_5","A test product",1.01,"testimage.jpg"), $result);
    }
    public function testProductAddToCart_AddToSession() {
        // prepare
        session_start();
        session_unset();
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST = array("product_id"=>3);
        $shop_model = new ShopModel(NULL,NULL);
        // run
        $shop_model->validateProductAddToCart();
        // validate
        $this->assertEquals(array(3=>1),$_SESSION["cart"]);
    }
    public function testProductAddToCart_GetSessionEmpty() {
        // prepare
        session_start();
        session_unset();
        $_SERVER["REQUEST_METHOD"] = "GET";
        $_POST = array("product_id"=>3);
        $shop_model = new ShopModel(NULL,NULL);
        // run
        $shop_model->validateProductAddToCart();
        // validate
        $this->assertEmpty($_SESSION);
    }
    public function testvalidateDetailProduct_ProductEqualTo() {
        // prepare 
        $crud = $this->createTestShopCrud(NULL,array(3));
        $shop_model = new ShopModel(NULL,$crud);
        $_GET = array("product_id"=>3);
        // run
        $shop_model->validateDetailProduct();
        $result = array($shop_model->product[3]->id,
                        $shop_model->product[3]->name,
                        $shop_model->product[3]->brand,
                        $shop_model->product[3]->description,
                        $shop_model->product[3]->price,
                        $shop_model->product[3]->filename);
        // validate 
        $this->assertEquals(array(3,"Name_3","Brand_3","A test product",1.01,"testimage.jpg"), $result);
    }
    public function testvalidateDetailProduct_PageEqualTo() {
        // prepare 
        $crud = $this->createTestShopCrud(NULL,array(3));
        $shop_model = new ShopModel(NULL,$crud);
        $_GET = array("product_id"=>3);
        $shop_model->page = "Test";
        // run
        $shop_model->validateDetailProduct();
        $result = $shop_model->page;
        // validate 
        $this->assertEquals("Test", $result);
    }
    public function testvalidateDetailProduct_PageEqualTo404() {
        // prepare 
        $crud = $this->createTestShopCrud(NULL);
        $shop_model = new ShopModel(NULL,$crud);
        $_GET = array("product_id"=>3);
        $shop_model->page = "Test";
        // run
        $shop_model->validateDetailProduct();
        $result = $shop_model->page;
        // validate 
        $this->assertEquals("404", $result);
    }
    public function testSetShoppingCart_CartEqualTo() {
        // prepare 
        session_start();
        session_unset();
        $_SESSION['cart'] = array(6=>1, 4=>1);
        $shop_model = new ShopModel(NULL,NULL);
        // run
        $shop_model->setShoppingCart();
        $result = $shop_model->cart;
        // validate
        $this->assertEquals(array(6=>1, 4=>1),$result);
    }
    public function testSetCartProducts_LengthCartProductsEqualTo() {
        // prepare
        $crud = $this->createTestShopCrud(4);
        $shop_model = new ShopModel(NULL,$crud);
        // run
        $shop_model->setCartProducts();
        $result = sizeof($shop_model->cart_products);
        //validate
        $this->assertEquals(4, $result);
    }
    public function testSetCartProducts_OneCartProductsEqualTo() {
        // prepare
        $crud = $this->createTestShopCrud(4);
        $shop_model = new ShopModel(NULL,$crud);
        // run
        $shop_model->setCartProducts();
        $result = array($shop_model->cart_products[4]->id,
                        $shop_model->cart_products[4]->name,
                        $shop_model->cart_products[4]->brand,
                        $shop_model->cart_products[4]->description,
                        $shop_model->cart_products[4]->price,
                        $shop_model->cart_products[4]->filename);
        // validate
        $this->assertEquals(array(4,"Name_4","Brand_4","A test product",1.01,"testimage.jpg"), $result);
    }
    public function testValidateShoppingCart_PostCartEqualTo() {
        // prepare
        session_start();
        session_unset();
        $_SESSION['cart'] = array(8=>3,2=>2,4=>1);
        $crud = $this->createTestShopCrud(NULL,array(8,2,4));
        $shop_model = new ShopModel(NULL,$crud);
        $_SERVER["REQUEST_METHOD"] = "POST";
        $_POST = array("product_id"=>8,"quantity"=>20);
        // run
        $shop_model->ValidateShoppingCart();
        // validate
        $this->assertEquals(array(8=>20,2=>2,4=>1),$_SESSION['cart']);
    }
    public function testValidateShoppingCart_GetCartEqualTo() {
        // prepare
        session_start();
        session_unset();
        $_SESSION['cart'] = array(8=>3,2=>2,4=>1);
        $crud = $this->createTestShopCrud(NULL,array(8,2,4));
        $shop_model = new ShopModel(NULL,$crud);
        $_SERVER["REQUEST_METHOD"] = "GET";
        $_POST = array("product_id"=>8,"quantity"=>20);
        // run
        $shop_model->ValidateShoppingCart();
        // validate
        $this->assertEquals(array(8=>3,2=>2,4=>1),$_SESSION['cart']);
    }
    public function testValidateCheckout_SessionCartEmpty() {
        // prepare 
        session_start();
        session_unset();
        $_SESSION['user_id'] = 2;
        $_SESSION['cart'] = array(9=>7);
        $crud = $this->createTestShopCrud(NULL);
        $shop_model = new ShopModel(NULL,$crud);
        $shop_model->cart = array(9=>7);
        $shop_model->page = "Test";
        // run
        $shop_model->validateCheckout();
        // validate
        $this->assertEmpty($_SESSION['cart']);
    }
    public function testValidateCheckout_PageEqualTo() {
        // prepare 
        session_start();
        session_unset();
        $_SESSION['user_id'] = 2;
        $crud = $this->createTestShopCrud(NULL);
        $shop_model = new ShopModel(NULL,$crud);
        $shop_model->cart = array(9=>7);
        $shop_model->page = "Test";
        // run
        $shop_model->validateCheckout();
        $result = $shop_model->page;
        // validate
        $this->assertEquals("checkout_thanks",$result);
    }
    public function testValidateCheckout_PageEqualToTest() {
        // prepare 
        session_start();
        session_unset();
        $_SESSION['user_id'] = 1;
        $crud = $this->createTestShopCrud(NULL);
        $shop_model = new ShopModel(NULL,$crud);
        $shop_model->cart = array(9=>7);
        $shop_model->page = "Test";
        $shop_model->errors["myerror"] = "MyError";
        // run
        $shop_model->validateCheckout();
        $result = $shop_model->page;
        // validate
        $this->assertEquals("Test",$result);
    }
    public function testSetTop5Products_LengthTop5ProductsEqualTo() {
        // prepare
        $crud = $this->createTestShopCrud(5);
        $shop_model = new ShopModel(NULL,$crud);
        // run
        $shop_model->setTop5Products();
        $result = sizeof($shop_model->top_5_products);
        // validate
        $this->assertEquals(5, $result);
    }
    public function testSetTop5Products_OneTop5ProductsEqualTo() {
        // prepare
        $crud = $this->createTestShopCrud(5);
        $shop_model = new ShopModel(NULL,$crud);
        // run
        $shop_model->setTop5Products();
        $result = array($shop_model->top_5_products[2]->id,
                        $shop_model->top_5_products[2]->name,
                        $shop_model->top_5_products[2]->brand,
                        $shop_model->top_5_products[2]->description,
                        $shop_model->top_5_products[2]->price,
                        $shop_model->top_5_products[2]->filename);
        // validate
        $this->assertEquals(array(2,"Name_2","Brand_2","A test product",1.01,"testimage.jpg"), $result);
    }
}