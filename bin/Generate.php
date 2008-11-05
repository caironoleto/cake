<?php
#CodeIgniter Generate
#	@author Cairo Noleto at Add4 Comunicação
#	@site http://www.caironoleto.com/
#	@email caironoleto@gmail.com
require_once('../basepath.php');
class Generate {
	private $basepath = BASEPATH;
	function Generate() {
	}
	function start() {
		return "CodeIgniter Generator";
	}
	function create($what, $name) {
		$what = strtolower($what);
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
				$file = $name .'Controller.php';
				$resource = fopen($path .$file, 'w');
				fwrite($resource, "<?php\n");
				$class = ucfirst($name);
				fwrite($resource, "class $class" ."Controller {\n");
				fwrite($resource, "\tfunction $class" ."Controller() {\n");
				fwrite($resource, "\t\tparent::Controller();\n");
				fwrite($resource, "\t}\n");
				fwrite($resource, "}\n");
				fwrite($resource, "?>");
				fclose($resource);
		}
	}
}
?>
