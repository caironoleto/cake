<?php
require_once 'PHPUnit/Framework.php';
class RoutesTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		require_once('../bin/Generate.php');
		$this->generate = new Generate();
		$this->generate->setPath('../routes');
	}
	function testIfExistsRoutesFile() {
		$this->generate->create('controller', 'welcome');
		$this->assertFileExists('../routes/system/application/config/routes.php');
	}
}
?>
