<?php 

require_once "BasicDoc.php";

abstract class ProductsDoc extends BasicDoc {
    
    protected function showProductImage($filename) {
        echo '<img src="Images/'.$filename.'" alt="picture of product">';
    }
    protected function showProductBrand($brand) {
        echo '<div class="brand">'.$brand.'</div>';
    }
    protected function showProductPrice($price) {
        echo '<div class="price">&euro;'.$price.'</div>';
    }
    protected function showProductName($product_name) {
        echo '<div class="name">'.$product_name.'</div>';
    }
    protected function showProductDescription($description) {
        echo '<p>'.$description.'</p>';
    }
    protected function showProductDetailLinkStart($product_id) {
        echo '<a href="index.php?page=detail&product='.$product_id.'">';
    }
    protected function showProductDetailLinkEnd() {
        echo '</a>';
    }
    protected function showAddToCart($product_id) {
        echo '<form action="" method="POST">';
        echo '<input type="hidden" name="page" value="'.$this->data["page"].'">';
        echo '<input type="hidden" name="product_id" value="'.$product_id.'">';
        echo '<input type="submit" class="click_btn cart_btn" value="Add to Cart">';
        echo '</form>';
    }
}