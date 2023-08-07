<?php 

require_once "BasicDoc.php";

abstract class ProductsDoc extends BasicDoc {
    
    private function showProductImage($filename) {
        echo '<img src="../Images/'.$filename.'" alt="picture of product">';
    }
    private function showProductBrand($brand) {
        echo '<div class="brand">'.$brand.'</div>';
    }
    private function showProductPrice($price) {
        echo '<div class="price">&euro;'.$price.'</div>';
    }
    private function showProductName($product_name) {
        echo '<div class="name">'.$product_name.'</div>';
    }
    private function showProductDetailLinkStart($product_id) {
        echo '<a href="index.php?page=detail&product='.$product_id.'">';
    }
    private function showProductDetailLinkEnd() {
        echo '</a>';
    }
    private function showAddToCart($product_id) {
        echo '<form action="" method="POST">';
        echo '<input type="hidden" name="page" value="'.$this->data["page"].'">';
        echo '<input type="hidden" name="product_id" value="'.$product_id.'">';
        echo '<input type="submit" class="click_btn cart_btn" value="Add to Cart">';
        echo '</form>';
    }
    protected function showProductCard($product) {
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
}