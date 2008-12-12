<?php
class Checkout {

	private $basepath;
	
	function Checkout() {
	}

	function setPath($path) {
		$this->basepath = $path ."/";
	}

	function getPath() {
		return $this->basepath;
	}
	
	function svnCheckOut() {
		if (!file_exists($this->getPath() ."source/versions"))
			mkdir($this->getPath() ."source/versions" );
			chmod($path, 0775);
		
	}

}
?>
