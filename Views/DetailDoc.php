<?php 

require_once "ProductsDoc.php";

class DetailDoc extends ProductsDoc {

    protected $data;
    protected $product;

    public function __construct($data, $product) {
        $this->data = $data;
        $this->product = $product;
    }

    protected function showContent() {
        echo '<div class="row">';
        echo '<div class="column">';
        $this->showProductImage($this->product["filename"]);
        echo '</div>';
        echo '<div class="column">';
        $this->showProductBrand($this->product["brand"]);
        $this->showProductName($this->product["name"]);
        $this->showProductPrice($this->product["price"]);
        $this->showAddToCart($this->product["product_id"]);
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="column c2">';
        echo '<h4>Description</h4>';
        echo '<p>'.$this->product["description"].'</p>';
        echo '</div>';
        echo '</div>';
    }
}