<?php 

abstract class HtmlDoc {
    
    private function showHtmlStart() {
        echo '<!DOCTYPE html>';
        echo '<html>';
    }
    private function showHeadStart() {
        echo '<head>';
    }
    abstract protected function showHeadcontent();
    
    private function showHeadEnd() {
        echo '</head>';
    }
    private function showBodyStart() {
        echo '<body>';
    }
    abstract protected function showBodyContent();
    
    private function showBodyEnd() {
        echo '</body>';
    }
    private function showHtmlEnd() {
        echo '</html>';
    }
    public function show() {
        $this->showHtmlStart();
        $this->showHeadStart();
        $this->showHeadcontent();
        $this->showHeadEnd();
        $this->showBodyStart();
        $this->showBodyContent();
        $this->showBodyEnd();
        $this->showHtmlEnd();
    }
}