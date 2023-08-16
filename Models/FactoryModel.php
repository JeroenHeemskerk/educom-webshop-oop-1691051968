<?php

require_once "Models/PageModel.php";
require_once "Models/UserModel.php";
require_once "Models/ShopModel.php";
require_once "Cruds/UserCrud.php";
require_once "Cruds/ShopCrud.php";

class FactoryModel {

    public function __construct($crud) {
        $this->crud = $crud;
    }
    public function createCrud($name) {
        switch ($name) {
            case "user":
                return new UserCrud($this->crud);
            case "shop":
                return new ShopCrud($this->crud);
        }
    }
    public function createModel($name, $model=NULL) {
        switch ($name) {
            case "page":
                return new PageModel($model);
            case "user":
                $user_crud = $this->createCrud("user");
                return new UserModel($model,$user_crud);
            case "shop":
                $shop_crud = $this->createCrud("shop");
                return new ShopModel($model,$shop_crud);
        }
    }
}