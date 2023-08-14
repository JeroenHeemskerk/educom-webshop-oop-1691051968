<?php

require_once "Util.php";
require_once "SessionManager.php";
require_once "MenuItem.php";

class PageModel {
    
    public $page;
    protected $isPost = false;
    public $menu;
    public $values = array();
    public $user = array();
    public $errors = array();
    public $genericErr = "";
    public $valid = false;
    public $sessionManager;

    public function __construct($copy) {
        if (empty($copy)) {
            $this->sessionManager = new SessionManager();
        }
        else {
            $this->page = $copy->page;
            $this->isPost = $copy->isPost;
            $this->menu = $copy->menu;
            $this->values = $copy->values;
            $this->genericErr = $copy->genericErr;
            $this->valid = $copy->valid;
            $this->sessionManager = $copy->sessionManager;
        }
    }
    public function setPage($newPage) {
        $this->page = $newPage;
    }                
    public function getRequestedPage() {
        $this->isPost = (Util::isPost());

        if ($this->isPost) {
            $this->setPage(Util::getPostValue("page","home"));
        }
        else {
            $this->setPage(Util::getUrlValue("page","home"));
        }
    }
    public function createMenu() {
        $this->menu["home"] = new MenuItem("home", "Home");
        $this->menu["about"] = new MenuItem("about", "About");
        $this->menu["contact"] = new MenuItem("contact", "Contact");
        $this->menu["webshop"] = new MenuItem("webshop", "Webshop");
        $this->menu["top5"] = new MenuItem("top5", "TOP 5");

        if ($this->sessionManager->isUserLoggedIn()) {
            $this->menu["change_password"] = new MenuItem("change_password", "Change Password");
            $this->menu["logout"] = new MenuItem("logout", "Logout ".$this->sessionManager->getLoggedInUserName());
            $this->menu["shopping_cart"] = new MenuItem("shopping_cart", 'Shopping Cart');
        } 
        else {
            $this->menu["register"] = new MenuItem("register", "Register");
            $this->menu["login"] = new MenuItem("login", "Login");
        }
    }
}