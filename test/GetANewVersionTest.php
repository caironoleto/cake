<?php
require_once('PHPUnit/Framework.php');

class GetANewVersionTest extends PHPUnit_Framework_TestCase {
	function setUp() {
	}
	function tearDown() {
	}
	function testCanGetAllVersionUsingFindClass() {
		require_once('../bin/Find.php');
		$find = new Find();
		$this->assertEquals(4, count($find->findVersions()));
	}
	function testCanGetLatestVersionUsingFindClass() {
		require_once('../bin/Find.php');
		$find = new Find();
		$this->assertEquals('v1.7.0', $find->getLatestVersion());
	}
	function testCanCheckoutLatestVersionFromCodeIgniteSubversion() {
		require_once('../bin/Find.php');
		require_once('../bin/Checkout.php');
		$find = new Find();
		$this->assertEquals('v1.7.0', $find->getLatestVersion());
		$checkout = new Checkout();
		$this->assertTrue($checkout->setPath('..'));
		$this->assertTrue($checkout->svnCheckOut('v1.7.0', 'ci_framework'));
		$this->assertFileExists('../source/versions');
		$this->assertStringEqualsFile("v1.7.0\nv1.6.3\nv1.6.2\nv1.6.1\n", '../source/versions');
	}
}
?>
