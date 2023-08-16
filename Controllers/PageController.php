<?php

class PageController {

    private $factory;
    private $model;

    public function __construct($factory) {
        $this->factory = $factory;
        $this->model = $this->factory->createModel("page");
    }
    public function handleRequest() {
        $this->getRequest();
        $this->processRequest();
        $this->showResponse();
    }
    // from client
    private function getRequest() {
        $this->model->getRequestedPage();
    }
    // business flow code 
    private function processRequest() {
        switch ($this->model->page) {
            case "contact":
                $this->model = $this->factory->createModel("user",$this->model);
                $this->model->validateContactForm();
                break;
            case "register":
                $this->model = $this->factory->createModel("user",$this->model);
                $this->model->validateRegisterForm();
                break;
            case "login":
                $this->model = $this->factory->createModel("user",$this->model);
                $this->model->validateLoginForm();
                break;
            case "change_password":
                $this->model = $this->factory->createModel("user",$this->model);
                $this->model->validateChangePasswordForm();
                break;
            case "logout":
                $this->model->session_manager->logoutUser();
                $this->model->setPage("home");
                break;
            case "webshop":
                $this->model = new ShopModel($this->model);
                $this->model->products = getAllProducts();
                if (Util::isPost()) {
                    $this->model->session_manager->addToCart(Util::getPostValue("product_id"));
                }
                break;
            case "detail":
                $this->model = new ShopModel($this->model);
                $product_id = Util::getUrlValue("product_id");
                if ($this->model->doesProductExist($product_id)) {
                    $this->model->product = getProductById($product_id);
                }
                if (Util::isPost()) {
                    $product_id = Util::getPostValue("product_id");
                    $this->model->session_manager->addToCart($product_id);
                }
                break;
            case "shopping_cart":
                $this->model = new ShopModel($this->model);
                $this->model->cart = $this->model->session_manager->getShoppingCart();
                $this->model->products = getProductsByIds(array_keys($this->model->cart));
                if (Util::isPost()) {
                    $product_id = Util::getPostValue("product_id");
                    $quantity = Util::getPostValue("quantity");
                    $this->model->session_manager->addToCart($product_id,$quantity);
                }
                break;
            case "checkout":
                $this->model = new ShopModel($this->model);
                $this->model->cart = $this->model->session_manager->getShoppingCart();
                $this->model->validateCheckout();
                if ($this->model->valid) {
                    $this->model->session_manager->emptyCart();
                    $this->model->setPage("checkout_thanks");
                }
                break;
            case "top5":
                $this->model->top_5_products = getTop5Products();
                break;
        }
    }
    // to client: presentation tier
    private function showResponse() {
        $this->model->CreateMenu();

        switch ($this->model->page) {
            case "home":
                require "Views/HomeDoc.php";
                $view = new HomeDoc($this->model);
                $view->show();
                break;
            case "about":
                require "Views/AboutDoc.php";
                $view = new AboutDoc($this->model);
                $view->show();
                break;
            case "contact":
                require "Views/ContactDoc.php";
                $view = new ContactDoc($this->model);
                $view->show();
                break;
            case "contact_thanks":
                require "Views/ContactThanksDoc.php";
                $view = new ContactThanksDoc($this->model);
                $view->show();
                break;
            case "register":
                require "Views/RegisterDoc.php";
                $view = new RegisterDoc($this->model);
                $view->show();
                break;
            case "login":
                require "Views/LoginDoc.php";
                $view = new LoginDoc($this->model);
                $view->show();
                break;
            case "change_password":
                require "Views/ChangePasswordDoc.php";
                $view = new ChangePasswordDoc($this->model);
                $view->show();
                break;
            case "webshop":
                require "Views/WebshopDoc.php";
                $view = new WebshopDoc($this->model);
                $view->show();
                break;
            case "detail":
                require "Views/DetailDoc.php";
                $view = new DetailDoc($this->model);
                $view->show();
                break;
            case "shopping_cart":
                require "Views/ShoppingCartDoc.php";
                $view = new ShoppingCartDoc($this->model);
                $view->show();
                break;
            case "checkout_thanks":
                require "Views/CheckoutThanksDoc.php";
                $view = new CheckoutThanksDoc($this->model);
                $view->show();
                break;
            case "top5":
                require "Views/TopFiveDoc.php";
                $view = new TopFiveDoc($this->model);
                $view->show();
                break;
            default:
                require "Views/PageNotFoundDoc.php";
                $view = new PageNotFoundDoc($this->model);
                $view->show();
        }
    }
}