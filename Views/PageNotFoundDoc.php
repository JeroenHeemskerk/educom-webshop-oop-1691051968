<?php

require_once "BasicDoc.php";

class PageNotFoundDoc extends BasicDoc {

    protected function showContent() {
        $this->showDivStart();
        echo '<p class="center">Page Not Found</p>';
        $this->showDivEnd();
    }
}