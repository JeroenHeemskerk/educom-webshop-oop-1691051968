<?php

require_once "html_doc.php";

class BasicDoc extends HtmlDoc {
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }
    private function getTitle($page) {
        $page_titles = array("basic"=>"Basic","home"=>"Home","about"=>"About","contact"=>"Contact",
        "register"=>"Register","login"=>"Login","change_password"=>"Change Password",
        "webshop"=>"Webshop","cart"=>"Shopping Cart","top5"=>"Top 5");
        return $page_titles[$page];
    }
    private function showTitle() {
        echo '<title>'.$this->getTitle($this->data["page"]).'</title>';
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
    private function showMenu() {
        foreach($this->data["menu"] as $page_name => $button_text) {
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
    protected function showContent() {
        echo 'some content';
    }
    private function showFooter() {
        echo '<footer>';
        echo '<p>Copyright &copy; Quincy 2023</p>';
        echo '</footer>';
    }
    protected function showHeadContent() {
        $this->showTitle();
        $this->showCssLink();
    }
    protected function showBodyContent() {
        $this->showHeader();
        $this->showContent();
        $this->showFooter();
    }
}