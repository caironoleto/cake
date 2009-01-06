<?php
require_once 'PHPUnit/Framework.php';
class BinTest extends PHPUnit_Framework_TestCase {
	function tearDown() {
		rm_recursive('system');
	}
	function testIfCakeFileExists() {
		$this->assertFileExists('../bin/cake');
	}
	function testIfCanCreateAWelcomeController() {
		shell_exec('php ../bin/cake controller welcome');
		$this->assertFileExists('system/application/controllers/welcomeController.php');
	}
	function testShowUsageMessageWithoutOptions() {
		$result = shell_exec('php ../bin/cake');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\tUsage: cake controller method1 method2 method3\n";
		$string .= "\tYou can use with\n";
		$string .= "\t\tcontroller model\n";
		$this->assertEquals($string, $result);
	}
	function testIfCanShowMessageLikeStringWhenGenerateController() {
		$result = shell_exec('php ../bin/cake controller welcome');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\t\tCreate system/\n";
		$string .= "\t\tCreate system/application/\n";
		$string .= "\t\tCreate system/application/controllers/\n";
		$string .= "\t\tCreate system/application/config/\n";
		$string .= "\t\tAdd default routes\n";
		$string .= "\t\tAdd route to WelcomeController\n";
		$string .= "\t\tCreate system/application/controllers/welcomeController.php\n\n";
		$this->assertEquals($string, $result);
	}
	function testIfCanShowMessageLikeStringWhenGenerateTwoController() {
		$result = shell_exec('php ../bin/cake controller welcome');
		$result = shell_exec('php ../bin/cake controller home');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\t\tsystem/ exists\n";
		$string .= "\t\tsystem/application/ exists\n";
		$string .= "\t\tsystem/application/controllers/ exists\n";
		$string .= "\t\tsystem/application/config/ exists\n";
		$string .= "\t\tAdd route to HomeController\n";
		$string .= "\t\tCreate system/application/controllers/homeController.php\n\n";
		$this->assertEquals($string, $result);
	}
	function testIfCanShowMessageLikeStringWhenGenerateControllerWithOneMethods() {
		$result = shell_exec('php ../bin/cake controller user index');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\t\tCreate system/\n";
		$string .= "\t\tCreate system/application/\n";
		$string .= "\t\tCreate system/application/controllers/\n";
		$string .= "\t\tCreate system/application/config/\n";
		$string .= "\t\tAdd default routes\n";
		$string .= "\t\tAdd route to UserController\n";
		$string .= "\t\tAdd index in UserController\n";
		$string .= "\t\tCreate system/application/views/\n";
		$string .= "\t\tCreate system/application/views/user\n";
		$string .= "\t\tCreate system/application/views/user/index.php\n";
		$string .= "\t\tCreate system/application/controllers/userController.php\n\n";
		$this->assertEquals($string, $result);
	}
	function testIfCanShowMessageLikeStringWhenGenerateAModel() {
		$result = shell_exec('php ../bin/cake model user');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\t\tCreate system/\n";
		$string .= "\t\tCreate system/application/\n";
		$string .= "\t\tCreate system/application/models/\n";
		$string .= "\t\tCreate system/application/models/user.php\n\n";
		$this->assertEquals($string, $result);
	}
	function testIfCanShowMessageLikeStringWhenGenerateTwoModels() {
		$result = shell_exec('php ../bin/cake model user');
		$result = shell_exec('php ../bin/cake model welcome');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\t\tsystem/ exists\n";
		$string .= "\t\tsystem/application/ exists\n";
		$string .= "\t\tsystem/application/models/ exists\n";
		$string .= "\t\tCreate system/application/models/welcome.php\n\n";
		$this->assertEquals($string, $result);
	}
	function testIfCanShowMessageLikeStringWhenGenerateAModelWithTwoMethods() {
		$result = shell_exec('php ../bin/cake model user find_all login');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\t\tCreate system/\n";
		$string .= "\t\tCreate system/application/\n";
		$string .= "\t\tCreate system/application/models/\n";
		$string .= "\t\tAdd find_all in User\n";
		$string .= "\t\tAdd login in User\n";
		$string .= "\t\tCreate system/application/models/user.php\n\n";
		$this->assertEquals($string, $result);
	}
	function testIfCanPassHelpOption() {
		$result = shell_exec('php ../bin/cake --help');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\tHelp: You can use cake to generate your controllers and models\n";
		$string .= "\tUsage: cake controller method1 method2 method3\n";
		$string .= "\tYou can use with\n";
		$string .= "\t\tcontroller model\n";
		$this->assertEquals($string, $result);
	}
	function testCanNotCreateControllerWhenPassHelpOptionAndControllerOption() {
		$result = shell_exec('php ../bin/cake --help controller user');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\tHelp: You can use cake to generate your controllers and models\n";
		$string .= "\tUsage: cake controller method1 method2 method3\n";
		$string .= "\tYou can use with\n";
		$string .= "\t\tcontroller model\n";
		$this->assertEquals($string, $result);
	}
	function testIfCanNotShowMessagesWithOptionQuiet() {
		$result = shell_exec('php ../bin/cake --quiet controller user');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$this->assertEquals($string, $result);
	}
	function testIfShowHelpMessagesWithOptionQuietAndNotControllerOption() {
		$result = shell_exec('php ../bin/cake --quiet');
		$string = "cake by Cairo Noleto - http://www.caironoleto.com/\n\n";
		$string .= "\tUsage: cake controller method1 method2 method3\n";
		$string .= "\tYou can use with\n";
		$string .= "\t\tcontroller model\n";
		$this->assertEquals($string, $result);
	}
}
?>
