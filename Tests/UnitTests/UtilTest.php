<?php

require_once('../../Models/Util.php');
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase {

    public function testCleanInput_stripSpaces() {
        $result = Util::cleanInput("    A   B    ");
        $this->assertEquals("A   B", $result);
    }

    public function testCleanInput_stripHtmlChar() {
        $result = Util::cleanInput("<script>alert('hoi')<script>");
        $this->assertEquals("&lt;script&gt;alert(&#039;hoi&#039;)&lt;script&gt;", $result);
    }
}