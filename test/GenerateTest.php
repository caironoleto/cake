<?php
require_once 'PHPUnit/Framework.php';
require_once('helper.php');
class GenerateTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		require_once('../bin/Generate.php');
		$this->generate = new Generate();
		$this->generate->setPath('..');
	}
	function tearDown() {
		rm_recursive($this->generate->getPath() ."system");
	}
	function testCreateAWelcomeController() {
		$this->generate->create('controller', 'welcome');
		$this->assertFileExists('../system/application/controllers/welcomeController.php');
	}
	function testIfContentOfWelcomeControllerIsWelcomeClass() {
		$this->generate->create('controller', 'welcome');
		$string = "<?php\nclass WelcomeController extends Controller {\n\tfunction WelcomeController() {\n\t\tparent::Controller();\n\t}\n}\n?>";
		$this->assertStringEqualsFile('../system/application/controllers/welcomeController.php', $string);
	}
	function testCreateAUserController() {
		$this->generate->create('controller', 'user');
		$this->assertFileExists('../system/application/controllers/userController.php');
	}
	function testCreateAUserControllerAndIndexView() {
		$this->generate->create('controller', 'user', array('index'));
		$this->assertFileExists('../system/application/views/user_controller/index_view.php');
	}
	function testIfContentOfUserControllerIsUserClass() {
		$this->generate->create('controller', 'USER');
		$string = "<?php\nclass UserController extends Controller {\n\tfunction UserController() {\n\t\tparent::Controller();\n\t}\n}\n?>";
		$this->assertStringEqualsFile('../system/application/controllers/userController.php', $string);
	}
	function testIfCreateAIndexMethodInWelcomeController() {
		$this->generate->create('controller', 'welcome', array('index'));
		$string = "<?php\n";
		$string .= "class WelcomeController extends Controller {\n";
		$string .= "\tfunction WelcomeController() {\n";
		$string .= "\t\tparent::Controller();\n";
		$string .= "\t}\n";
		$string .= "\tfunction index() {\n";
		$string .= "\t}\n";
		$string .= "}\n?>";
		$this->assertStringEqualsFile('../system/application/controllers/welcomeController.php', $string);
	}
	function testIfCreateAIndexMethodAndDestroyMethodInWelcomeController() {
		$this->generate->create('controller', 'welcome', array('index', 'destroy'));
		$string = "<?php\n";
		$string .= "class WelcomeController extends Controller {\n";
		$string .= "\tfunction WelcomeController() {\n";
		$string .= "\t\tparent::Controller();\n";
		$string .= "\t}\n";
		$string .= "\tfunction index() {\n";
		$string .= "\t}\n";
		$string .= "\tfunction destroy() {\n";
		$string .= "\t}\n";
		$string .= "}\n?>";
		$this->assertStringEqualsFile('../system/application/controllers/welcomeController.php', $string);
	}
	function testCreateAUserModel() {
		$this->generate->create('model', 'user');
		$this->assertFileExists('../system/application/models/user.php');
	}
	function testIfCanSetPath() {
		$this->generate->setPath('../.');
		$this->assertEquals('.././', $this->generate->getPath());
	}
	function testIfContentOfUserModelEqualsAString() {
		$this->generate->create('model', 'user');
		$string = "<?php\n";
		$string .= "class User extends Model {\n";
		$string .= "\tfunction User() {\n";
		$string .= "\t\tparent::Model();\n";
		$string .= "\t}\n";
		$string .= "}\n?>";
		$this->assertStringEqualsFile('../system/application/models/user.php', $string);
	}
	function testIfCreateAFindAllMethodInUserModel() {
		$this->generate->create('model', 'user', array('findAll'));
		$string = "<?php\n";
		$string .= "class User extends Model {\n";
		$string .= "\tfunction User() {\n";
		$string .= "\t\tparent::Model();\n";
		$string .= "\t}\n";
		$string .= "\tfunction findAll() {\n";
		$string .= "\t}\n";
		$string .= "}\n?>";
		$this->assertStringEqualsFile('../system/application/models/user.php', $string);
	}
	function testReturnStringWithStatusLog() {
		$this->generate->create('model', 'user', array('findAll'));
		$this->assertType('string', $this->generate->getMessages());
	}
}
?>
