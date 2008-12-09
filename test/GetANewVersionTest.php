<?php
require_once('PHPUnit/Framework.php');

class GetANewVersionTest extends PHPUnit_Framework_TestCase {
	function setUp() {
	}
	function tearDown() {
	}
	function testConnectInCodeIgniterSvnSiteWithCurl() {
		$resource = curl_init();
		$this->assertType('resource', $resource);
		curl_setopt($resource, CURLOPT_URL, "http://dev.ellislab.com/svn/CodeIgniter/tags/");
		curl_setopt($resource, CURLOPT_HEADER, 0);
		curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($resource);
		$this->assertType('string', $content);
		$this->assertContains("<head><title>Revision", $content);
		$this->assertContains(": /tags</title></head>", $content);
	}
	function testCanGetAllVersionsWithDomDocument() {
		$resource = curl_init();
		$this->assertType('resource', $resource);
		curl_setopt($resource, CURLOPT_URL, "http://dev.ellislab.com/svn/CodeIgniter/tags/");
		curl_setopt($resource, CURLOPT_HEADER, 0);
		curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($resource);
		$dom = DOMDocument::loadHTML($content);
		$this->assertType('DOMDocument', $dom);
		$elements = $dom->getElementsByTagName("li");
		foreach ($elements as $row ) {
			$a = $row->getElementsByTagName("a");
			if ($a->item(0)->nodeValue != "..") {
				$this->assertRegExp('/v[0-9.]/', $a->item(0)->nodeValue);
			}
		}
	}
	function testCanCreatePathToSaveCodeIgniterFramework() {
		if (!file_exists('../ci_framework'))
			mkdir('../ci_framework');
		$this->assertFileExists('../ci_framework/');
	}
	function testCanGetLatestVersionFromCodeIgniterSubversion() {
		$resource = curl_init();
		$this->assertType('resource', $resource);
		curl_setopt($resource, CURLOPT_URL, "http://dev.ellislab.com/svn/CodeIgniter/tags/");
		curl_setopt($resource, CURLOPT_HEADER, 0);
		curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($resource);
		$dom = DOMDocument::loadHTML($content);
		$this->assertType('DOMDocument', $dom);
		$elements = $dom->getElementsByTagName("li");
		foreach ($elements as $row ) {
			$a = $row->getElementsByTagName("a");
			if ($a->item(0)->nodeValue != "..") {
				$version = $a->item(0)->nodeValue;
				$this->assertRegExp('/v[0-9.\/]/', $version);
				$version = preg_replace('/\//', '', $version);
				$this->assertRegExp('/v[0-9.]/', $version);
				$versions[] = $version;
			}
		}
		$this->assertType('array', $versions);
		$this->assertEquals(4, count($versions));
		$last = array_pop($versions);
		$this->assertEquals('v1.7.0', $last);
	}
	function testCanGetAllVersionUsingFindClass() {
		require_once('../bin/Find.php');
		$find = new Find();
		$this->assertEquals(4, count($find->getAllVersions()));
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
		$this->assertTrue($checkout->svnCheckOut('v1.7.0', 'ci_framework'));
	}
}
?>
