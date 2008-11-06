<?php
#CodeIgniter Generate
#	@author Cairo Noleto at Add4 Comunicação
#	@site http://www.caironoleto.com/
#	@email caironoleto@gmail.com
require_once('../config.php');
class Generate {
	private $basepath;
	function Generate() {
	}
	function setPath($path) {
		$this->basepath = $path;
	}
	function getPath() {
		return $this->basepath;
	}
	function create($what, $name, $methods = null) {
		$what = strtolower($what);
		$name = strtolower($name);
		if (!file_exists($this->basepath .'system/')) {
			mkdir($this->basepath .'system/');
			chmod($this->basepath .'system/', 0777);
		}
		if (!file_exists($this->basepath .'system/application/')) {
			mkdir($this->basepath .'system/application/');
			chmod($this->basepath .'system/application/', 0777);
		}
		switch($what) {
			case 'controller':
				$path = $this->basepath .'system/application/controllers/';
				if (!file_exists($path))
					mkdir($path);
				$class = ucfirst($name);
				$file = $class .'Controller.php';
				$resource = fopen($path .$file, 'w');
				fwrite($resource, "<?php\n");
				fwrite($resource, "class $class" ."Controller {\n");
				fwrite($resource, "\tfunction $class" ."Controller() {\n");
				fwrite($resource, "\t\tparent::Controller();\n");
				fwrite($resource, "\t}\n");
				if (is_array($methods)) {
					foreach ($methods as $method) {
						fwrite($resource, "\tfunction $method() {\n");
						fwrite($resource, "\t}\n");
					}
				}
				fwrite($resource, "}\n");
				fwrite($resource, "?>");
				fclose($resource);
			break;
		}
	}
}
?>
