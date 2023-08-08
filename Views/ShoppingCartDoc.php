<?php

require_once "ProductsDoc.php";

class ShoppingCartDoc extends ProductsDoc {

    protected $data;
    protected $cart;
    protected $products;

    public function __construct($data, $cart, $products) {
        $this->data = $data;
        $this->cart = $cart;
        $this->products = $products;
    }

    private function showEmptyShoppingCart() {
        $this->showDivStart();
        echo '🛒<br>You have no products in your cart';
        $this->showDivEnd();
    }
    private function showQuantityDropdown($product_id, $quantity) {
        $this->showDivStart();
        echo '<form action="" method="POST">';
        echo '<label for="quantity">Quantity</label>';
        echo '<select id="quantity" name="quantity" onchange="this.form.submit()">';
        echo '<option value="'.$quantity.'">'.$quantity.'</option>';
        for ($count = 0; $count <= 10; $count++) {
            echo '<option value="'.$count.'">'.$count.'</option>';
        }
        echo '</select>';
        echo '<input type="hidden" name="product_id" value="'.$product_id.'">';
        echo '<input type="hidden" name="page" value="cart">';
        echo '</form>';
        $this->showDivEnd();
    }
    private function showShoppingCartLine($product_id,$product,$quantity,$subtotal) {
        $this->showDivStart("product_order");
        $this->showProductDetailLinkStart($product_id);
        $this->showProductImage($product["filename"]);
        $this->showProductDetailLinkEnd();
        $this->showDivStart("grid");
        $this->showDivStart();
        $this->showProductDetailLinkStart($product_id);
        $this->showProductBrand($product["brand"]);
        $this->showProductDetailLinkEnd();
        $this->showDivEnd();
        $this->showQuantityDropdown($product_id, $quantity);
        $this->showDivStart();
        echo '<p>Each</p>';
        $this->showProductPrice($product["price"]);
        $this->showDivEnd();
        $this->showDivStart();
        echo '<p>Subtotal</p>';
        $this->showProductPrice($subtotal);
        $this->showDivEnd();
        $this->showDivEnd();
        $this->showDivEnd();
    }
    private function showShoppingCart() {
        $this->showDivStart("row");
        $this->showDivStart("column");
        echo '<h3>Items</h3>';

        $total = 0;
        foreach ($this->cart as $product_id => $quantity) {
            $product = $this->products[$product_id];
            $subtotal = number_format(($product["price"] * $quantity), 2, ".", "");
            $total += $subtotal;
            $this->showShoppingCartLine($product_id,$product,$quantity,$subtotal);
        }
        $this->showDivEnd();
        
        $this->showDivStart("column");
        echo '<h3>Summary</h3>';
        $this->showDivStart();
        echo '<p>Total</p>';
        echo '<p>&euro; '.number_format($total, 2).'</p>';
        $this->showDivEnd();
        $this->showDivEnd();
        $this->showDivEnd();
        $this->showDivStart("row");
        echo '<button class="click_btn checkout" type="button"><a href="index.php?page=checkout">Checkout</a></button>';
        $this->showDivEnd();
    }
    private function showCheckoutThanks() {
        $this->showDivStart();
        echo '🛍️<br>Your order was completed successfully';
        $this->showDivEnd();
    }
    protected function showContent() {
        if ($this->data["valid"]) {
            $this-showCheckoutThanks();
        }
        elseif (!isset($_SESSION["cart"])) {
            $this->showEmptyShoppingCart();
        }
        else {
            $this->showShoppingCart();
        }
    }
}