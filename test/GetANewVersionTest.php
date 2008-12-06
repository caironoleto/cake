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
		$this->assertContains('<head><title>Revision 1583: /tags</title></head>', $content);
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
				$this->assertRegExp('/v[0-9.]/', $a->item(0)->nodeValue);
				$versions[] = $a->item(0)->nodeValue;
			}
		}
	}
}
?>
