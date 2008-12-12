<?php
class Find {
	function Find() {
		
	}
	public function findVersions() {
		$resource = curl_init();
		curl_setopt($resource, CURLOPT_URL, "http://dev.ellislab.com/svn/CodeIgniter/tags/");
		curl_setopt($resource, CURLOPT_HEADER, 0);
		curl_setopt($resource, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($resource);
		$dom = DOMDocument::loadHTML($content);
		$elements = $dom->getElementsByTagName("li");
		foreach ($elements as $row ) {
			$a = $row->getElementsByTagName("a");
			if ($a->item(0)->nodeValue != "..") {
				$version = $a->item(0)->nodeValue;
				$version = preg_replace('/\//', '', $version);
				$versions[] = $version;
			}
		}
		return $versions;
	}
	public function getAllVersions() {
		$versions = $this->findVersions();
		$versions = implode("\n", $versions);
		return $versions;
	}
	public function getLatestVersion() {
		$versions = $this->findVersions();
		return array_pop($versions);
	}
}
?>
