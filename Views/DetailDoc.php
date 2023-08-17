<?php 

require_once "ProductsDoc.php";

class DetailDoc extends ProductsDoc {

    protected function showContent() {
        $this->showDivStart("row");
        $this->showDivStart("column");
        $this->showProductImage($this->model->product->filename);
        $this->showDivEnd();
        $this->showDivStart("column");
        $this->showProductBrand($this->model->product->brand);
        $this->showProductName($this->model->product->name);
        $this->showProductPrice($this->model->product->price);
        if ($this->model->session_manager->isUserLoggedIn()) {
            $this->showAddToCart($this->model->product->product_id);
        }
        $this->showDivEnd();
        $this->showDivEnd();
        $this->showDivStart("row");
        $this->showDivStart("column d2");
        echo '<h4>Description</h4>';
        $this->showProductDescription($this->model->product->description);
        $this->showDivEnd();
        $this->showDivEnd();
    }
}