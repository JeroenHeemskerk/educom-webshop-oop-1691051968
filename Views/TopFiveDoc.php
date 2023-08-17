<?php

require_once "ProductsDoc.php";

class TopFiveDoc extends ProductsDoc {

    private function showTopProduct($top_product) {
        $this->showDivStart("column");
        $this->showDivStart("c1");
        $this->showProductDetailLinkStart($top_product->product_id);
        $this->showProductImage($top_product->filename);
        $this->showProductDetailLinkEnd();
        $this->showDivEnd();
        $this->showDivStart("c2");
        $this->showProductDetailLinkStart($top_product->product_id);
        $this->showProductName($top_product->brand." ".$top_product->name);
        $this->showProductDetailLinkEnd();
        echo '<p class="sold">'.$top_product->sold_quantity.' sold</p>';
        $this->showDivEnd();
        $this->showDivEnd();
    }
    protected function showContent() {
        $counter = 0;   

        echo '<h3>Most sold products over the last 7 days</h3>';
        $this->showDivStart();
        foreach ($this->model->top_5_products as $product_id => $top_product) {
            if ($counter % 2 == 0) {
                $this->showDivStart("row");
                $this->showTopProduct($top_product);
            }
            else {
                $this->showTopProduct($top_product);
                $this->showDivEnd();
            }       
        $counter++; 
        }
        $this->showDivEnd();
        $this->showDivEnd();
    }
}