<?php
require_once 'PHPUnit/Framework.php';
require_once('../basepath.php');
class GenerateTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		require_once('../bin/Generate.php');
		$this->generate = new Generate();
	}
	function testIfGetHelpString() {
		$this->assertType('string', $this->generate->start());
	}
	function testIfHelpStringEquals() {
		$this->assertEquals('CodeIgniter Generator', $this->generate->start());
	}
	function testCreateAWelcomeController() {
		$this->generate->create('controller', 'welcome');
		$this->assertFileExists('../system/application/controllers/WelcomeController.php');
	}
	function testIfContentOfWelcomeControllerIsWelcomeClass() {
		$this->generate->create('controller', 'welcome');
		$string = "<?php\nclass WelcomeController {\n\tfunction WelcomeController() {\n\t\tparent::Controller();\n\t}\n}\n?>";
		$this->assertStringEqualsFile('../system/application/controllers/WelcomeController.php', $string);
	}
	function testCreateAUserController() {
		$this->generate->create('controller', 'user');
		$this->assertFileExists('../system/application/controllers/UserController.php');
	}
	function testIfContentOfUserControllerIsUserClass() {
		$this->generate->create('controller', 'user');
		$string = "<?php\nclass UserController {\n\tfunction UserController() {\n\t\tparent::Controller();\n\t}\n}\n?>";
		$this->assertStringEqualsFile('../system/application/controllers/UserController.php', $string);
	}
	function tearDown() {
		rm_recursive(BASEPATH .'system/');
	}
}
?>
