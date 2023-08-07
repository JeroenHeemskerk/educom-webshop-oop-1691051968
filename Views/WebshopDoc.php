<?php 

require_once "ProductsDoc.php";

class WebshopDoc extends ProductsDoc {
    
    protected $data;
    protected $products;

    public function __construct($data, $products) {
        $this->data = $data;
        $this->products = $products;
    }

    private function showProductCard($product) {
        echo '<div class="column">';
        $this->showProductDetailLinkStart($product["product_id"]);
        $this->showProductImage($product["filename"]);
        $this->showProductBrand($product["brand"]);
        $this->showProductName($product["name"]);
        $this->showProductPrice($product["price"]);
        $this->showProductDetailLinkEnd();
        $this->showAddToCart($product["product_id"]);
        echo '</div>';
    }
    protected function showContent() {
        $counter = 0;

        foreach ($this->products as $key => $product) {
            if ($counter % 2 == 0) {
                echo '<div class="row">';
                $this->showProductCard($product);
            }
            else {
                $this->showProductCard($product);
                echo '</div>';
            }
            $counter++;
        }
    }
}