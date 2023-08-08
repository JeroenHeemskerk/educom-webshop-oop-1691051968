<?php 

require_once "ProductsDoc.php";

class WebshopDoc extends ProductsDoc {
    
    protected $data;
    protected $products;

    public function __construct($data, $products) {
        $this->data = $data;
        $this->products = $products;
    }

    protected function showProductCard($product) {
        $this->showDivStart("column");
        $this->showProductDetailLinkStart($product["product_id"]);
        $this->showProductImage($product["filename"]);
        $this->showProductBrand($product["brand"]);
        $this->showProductName($product["name"]);
        $this->showProductPrice($product["price"]);
        $this->showProductDetailLinkEnd();
        $this->showAddToCart($product["product_id"]);
        $this->showDivEnd();
    }
    protected function showContent() {
        $counter = 0;

        foreach ($this->products as $key => $product) {
            if ($counter % 2 == 0) {
                $this->showDivStart("row");
                $this->showProductCard($product);
            }
            else {
                $this->showProductCard($product);
                $this->showDivEnd();
            }
            $counter++;
        }
    }
}