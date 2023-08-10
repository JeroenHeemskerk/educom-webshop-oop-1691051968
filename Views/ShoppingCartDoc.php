<?php

require_once "ProductsDoc.php";

class ShoppingCartDoc extends ProductsDoc {

    public function __construct($data) {
        $this->data = $data;
        $this->cart = $data["cart"];
        $this->products = $data["products"];
        $this->total = 0;
    }

    private function showEmptyShoppingCart() {
        $this->showDivStart();
        echo '<p>🛒<br>You have no products in your cart</p>';
        $this->showDivEnd();
    }
    private function showCheckoutThanks() {
        $this->showDivStart();
        echo '<p>🛍️<br>Your order was completed successfully</p>';
        $this->showDivEnd();
    }
    private function showQuantityDropdown($product_id, $quantity) {
        $this->showDivStart();
        echo '<form action="" method="POST">';
        echo '<label for="quantity">Qty</label>';
        echo '<input type="number" name="quantity" value="'.$quantity.'" min="0" onchange="this.form.submit()">';
        echo '<input type="hidden" name="product_id" value="'.$product_id.'">';
        echo '<input type="hidden" name="page" value="shopping_cart">';
        echo '</form>';
        $this->showDivEnd();
    }
    private function showShoppingCartLine($product_id,$product,$quantity,$subtotal) {
        $this->showDivStart("cart_product");
        $this->showDivStart("c1");
        $this->showProductDetailLinkStart($product_id);
        $this->showProductImage($product["filename"]);
        $this->showProductDetailLinkEnd();
        $this->showDivEnd();
        $this->showDivStart("c2");
        $this->showDivStart();
        $this->showProductDetailLinkStart($product_id);
        $this->showProductName($product["brand"]." ".$product["name"]);
        $this->showProductDetailLinkEnd();
        $this->showDivEnd();
        $this->showDivStart("grid-2");
        $this->showQuantityDropdown($product_id, $quantity);
        echo '<hr>';
        $this->showDivStart();
        echo '<label>Each</label>';
        echo '<p class="price_each">&euro;'.$product["price"].'</p>';
        $this->showDivEnd();
        $this->showDivEnd();
        $this->showDivEnd();
        $this->showDivStart("c3");
        echo '<label>Subtotal</label>';
        echo '<p class="subtotal">&euro;'.$subtotal.'</p>';
        $this->showDivEnd();
        $this->showDivEnd();
    }
    private function showShoppingCartItems() {
        $this->showDivStart("row");
        $this->showDivStart("column items");
        echo '<h3>Items</h3>';
        foreach ($this->cart as $product_id => $quantity) {
            $product = $this->products[$product_id];
            $subtotal = number_format(((float)$product["price"] * (int)$quantity), 2, ".", "");
            $this->total += $subtotal;
            $this->showShoppingCartLine($product_id,$product,$quantity,$subtotal);
        }
        $this->showDivEnd();
    }
    private function showShoppingCartSummary() {
        $this->showDivStart("column summary");
        echo '<h3>Summary</h3>';
        $this->showDivStart();
        echo '<p>Estimated Total</p>';
        echo '<p class="r">&euro;'.number_format($this->total, 2).'</p>';
        echo '<p>Discount</p>';
        echo '<p class="r">&euro;0</p>';
        echo '<p>Delivery</p>';
        echo '<p class="r">&euro;0</p>';
        echo '<p class="cb">Total</p>';
        echo '<p class="r cb">&euro;'.number_format($this->total, 2).'</p>';
        $this->showDivEnd();
        echo '<button class="click_btn checkout" type="button"><a href="index.php?page=checkout">Checkout</a></button>';
        $this->showDivEnd();
        $this->showDivEnd();
    }
    private function showShoppingCart() {
        $this->showShoppingCartItems();
        $this->showShoppingCartSummary();
    }
    protected function showContent() {
        if ($this->data["valid"]) {
            $this->showCheckoutThanks();
        }
        elseif (empty($this->cart)) {
            $this->showEmptyShoppingCart();
        }
        else {
            $this->showShoppingCart();
        }
    }
}