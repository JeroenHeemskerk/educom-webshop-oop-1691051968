<?php

class TestProduct {

    public function __construct($id,$name,$brand,$description,$price,$filename) {
        $this->id = $id;
        $this->name = $name;
        $this->brand = $brand;
        $this->description = $description;
        $this->price = $price;
        $this->filename = $filename;
    }
}