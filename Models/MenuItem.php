<?php

class MenuItem{
    private $page;
    private $label;
  
    public function __construct($page, $label) {
      $this->page = $page;
      $this->label = $label;
    }
  
    public function showMenuItem(){
        echo '<li><button type="button"><a class="navlink" href="index.php?page='.$this->page.'">'.$this->label.'</a></button></li>';
    }
  }