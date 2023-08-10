<?php

require_once "BasicDoc.php";

class checkoutThanksDoc extends BasicDoc {

    protected function showContent() {
        $this->showDivStart();
        echo '<p class="center">🛍️<br>Your order was completed successfully</p>';
        $this->showDivEnd();
    }
}