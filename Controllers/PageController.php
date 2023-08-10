<?php

require_once "Models/PageModel.php";

class PageController {

    private $model;

    public function __construct() {
        $this->model = new PageModel(NULL);
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
            ###
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