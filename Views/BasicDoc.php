<?php

require_once "HtmlDoc.php";

abstract class BasicDoc extends HtmlDoc {
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }
    private function getTitle() {
        $page_titles = array("home"=>"Home","about"=>"About","contact"=>"Contact",
        "contact_thanks"=>"Thank You","register"=>"Register","login"=>"Login",
        "change_password"=>"Change Password","webshop"=>"Webshop","detail"=>"Detail",
        "shopping_cart"=>"Shopping Cart","checkout_thanks"=>"Thank You","top5"=>"Top 5");
        return $page_titles[$this->data["page"]];
    }
    private function showTitle() {
        echo '<title>'.$this->getTitle().'</title>';
    }
    private function showCssLink() {
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '<link rel="stylesheet" href="CSS/stylesheet.css">';
        echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
        echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
        echo '<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">';
    }
    private function showMenuItem($page_name, $button_text) {
        echo '<li><button type="button"><a class="navlink" href="index.php?page='.$page_name.'">'.$button_text.'</a></button></li>';
    }
    private function getMenuItems() {
        if (isUserLoggedIn()) {
            $firstname = ucfirst(explode(" ", getLoggedInUserName())[0]);
            $menu = array("home"=>"Home","about"=>"About","contact"=>"Contact","change_password"=>"Change Password","logout"=>"Logout ".$firstname,"webshop"=>"Webshop","top5"=>"TOP 5","shopping_cart"=>"Shopping Cart");
        }
        else {
            $menu = array("home"=>"Home","about"=>"About","contact"=>"Contact","register"=>"Register","login"=>"Login","webshop"=>"Webshop","top5"=>"TOP 5");
        }
        return $menu;
    }
    private function showMenu() {
        foreach($this->getMenuItems() as $page_name => $button_text) {
            $this->showMenuItem($page_name, $button_text);
        }
    }
    private function showHeader() {
        echo '<header>';
        echo '<nav>';    
        echo '<ul>';
        $this->showMenu();
        echo '</ul>';
        echo '</nav>';
        echo '</header>';
    }
    private function showContentStart() {
        echo '<div class="content">';
        echo '<div class="'.$this->data["page"].'">';
        echo '<h1>'.$this->getTitle().'</h1>';
    }
    abstract protected function showContent();

    private function showContentEnd() {
        echo '</div>';
        echo '</div>';
    }
    private function showFooter() {
        echo '<footer>';
        echo '<p>Copyright &copy; 2023 Quincy</p>';
        echo '</footer>';
    }
    protected function showHeadContent() {
        $this->showTitle();
        $this->showCssLink();
    }
    protected function showBodyContent() {
        $this->showHeader();
        $this->showContentStart();
        $this->showContent();
        $this->showContentEnd();
        $this->showFooter();
    }
    protected function getArrayValue($data, $key) { 
        return isset($data[$key]) ? $data[$key] : ''; 
    }
    protected function showDivStart($class=NULL) {
        if (is_null($class)) {
            echo '<div>';
        }
        else {
            echo '<div class="'.$class.'">';
        }
    }
    protected function showDivEnd() {
        echo '</div>';
    }
}