<?php 

require_once "ProductsDoc.php";

class WebshopDoc extends ProductsDoc {
    
    protected $data;
    protected $products;

    public function __construct($data, $products) {
        $this->data = $data;
        $this->products = $products;
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