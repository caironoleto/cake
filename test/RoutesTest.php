<?php
require_once 'PHPUnit/Framework.php';
class RoutesTest extends PHPUnit_Framework_TestCase {
	function setUp() {
		require_once('../bin/Generate.php');
		$this->generate = new Generate();
		$this->generate->setPath('../routes');
	}
	function tearDown() {
		rm_recursive($this->generate->getPath() ."system");
	}
	function testIfExistsRoutesFile() {
		$this->generate->create('controller', 'welcome', array('index'));
		$this->assertFileExists('../routes/system/application/config/routes.php');
	}
	function testAddOneControllerAndYourRoutes() {
		$this->generate->create('controller', 'users');
		$string = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n";
		$string .= '$route["default_controller"] = "welcome";' ."\n";
		$string .= '$route["scaffolding_trigger"] = "";' ."\n\n";
		$string .= '$route["users"] = "usersController";' ."\n";
		$string .= '$route["users/([a-zA-Z]+)"] = "usersController/$1";' ."\n";
		$string .= '$route["users/([a-zA-Z]+)/([a-zA-Z0-9 ]+)"] = "usersController/$1/$2";' ."\n";
		$string .= '$route["users/([a-zA-Z]+)/([a-zA-Z0-9 ]+)/([a-zA-Z0-9 ]+)"] = "usersController/$1/$2/$3";' ."\n";
		$this->assertStringEqualsFile('../routes/system/application/config/routes.php', $string);
	}
	function testIfCanAddTwoControllersAndYourRoutes() {
		$this->generate->create('controller', 'users');
		$this->generate->create('controller', 'home');
		$string = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n";
		$string .= '$route["default_controller"] = "welcome";' ."\n";
		$string .= '$route["scaffolding_trigger"] = "";' ."\n\n";
		$string .= '$route["users"] = "usersController";' ."\n";
		$string .= '$route["users/([a-zA-Z]+)"] = "usersController/$1";' ."\n";
		$string .= '$route["users/([a-zA-Z]+)/([a-zA-Z0-9 ]+)"] = "usersController/$1/$2";' ."\n";
		$string .= '$route["users/([a-zA-Z]+)/([a-zA-Z0-9 ]+)/([a-zA-Z0-9 ]+)"] = "usersController/$1/$2/$3";' ."\n\n";
		$string .= '$route["home"] = "homeController";' ."\n";
		$string .= '$route["home/([a-zA-Z]+)"] = "homeController/$1";' ."\n";
		$string .= '$route["home/([a-zA-Z]+)/([a-zA-Z0-9 ]+)"] = "homeController/$1/$2";' ."\n";
		$string .= '$route["home/([a-zA-Z]+)/([a-zA-Z0-9 ]+)/([a-zA-Z0-9 ]+)"] = "homeController/$1/$2/$3";' ."\n";
		$this->assertStringEqualsFile('../routes/system/application/config/routes.php', $string);
	}
}
?>
