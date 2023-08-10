<?php 

require_once "ProductsDoc.php";

class DetailDoc extends ProductsDoc {

    public function __construct($data) {
        $this->data = $data;
        $this->product = $data["product"];
    }

    protected function showContent() {
        $this->showDivStart("row");
        $this->showDivStart("column");
        $this->showProductImage($this->product["filename"]);
        $this->showDivEnd();
        $this->showDivStart("column");
        $this->showProductBrand($this->product["brand"]);
        $this->showProductName($this->product["name"]);
        $this->showProductPrice($this->product["price"]);
        $this->showAddToCart($this->product["product_id"]);
        $this->showDivEnd();
        $this->showDivEnd();
        $this->showDivStart("row");
        $this->showDivStart("column d2");
        echo '<h4>Description</h4>';
        $this->showProductDescription($this->product["description"]);
        $this->showDivEnd();
        $this->showDivEnd();
    }
}