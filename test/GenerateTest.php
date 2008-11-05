<?php
require_once 'PHPUnit/Framework.php';
class GenerateTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		require('../bin/Generate.php');
	}
	function testIfGetHelpString() {
		$generate = new Generate();
		$this->assertType('string', $generate->start());
	}
}
?>
