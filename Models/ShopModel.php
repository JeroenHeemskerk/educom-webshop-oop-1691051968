<?php

require_once "PageModel.php";
require_once "Util.php";
require_once "db_repository.php";

class ShopModel extends PageModel {

    public function __construct($model) {
        PARENT::__construct($model);
    }
    public function doesProductExist($product_id) {
        return (!is_null(getProductById($product_id)));
    }
}