<?php
class Checkout {

	private $basepath;
	
	function Checkout() {
	}

	function setPath($path) {
		$this->basepath = $path ."/";
		return true;
	}

	function getPath() {
		return $this->basepath;
	}
	
	function svnCheckOut($version) {
		if (!file_exists($this->getPath() ."source")) {
			mkdir($this->getPath() ."source");
			chmod($this->getPath(), 0775);
		}
		if (!file_exists($this->getPath() ."source/$version")) {
			mkdir($this->getPath() ."source/$version");
			chmod($this->getPath(), 0775);
		}
		shell_exec("svn checkout http://dev.ellislab.com/svn/CodeIgniter/tags/$version $this->getPath()source/$version");
		return true;
	}

}
?>
