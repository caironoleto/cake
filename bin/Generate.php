<?php
#CodeIgniter Generate
#	@author Cairo Noleto at Add4 Comunicação
#	@site http://www.caironoleto.com/
#	@email caironoleto@gmail.com
class Generate {
	private $basepath;
	public $message = '';
	function Generate() {
	}
	function setPath($path) {
		$this->basepath = $path ."/";
	}
	function getPath() {
		return $this->basepath;
	}
	function getMessages() {
		return $this->message;
	}
	function create($what, $name, $methods = null) {
		$what = strtolower($what);
		$name = strtolower($name);
		if (!file_exists($this->basepath .'system/')) {
			mkdir($this->basepath .'system/');
			chmod($this->basepath .'system/', 0775);
			$this->message .= "\t\tCreate system/\n";
		} else {
			$this->message .= "\t\tsystem/ exists\n";
		}
		if (!file_exists($this->basepath .'system/application/')) {
			mkdir($this->basepath .'system/application/');
			chmod($this->basepath .'system/application/', 0775);
			$this->message .= "\t\tCreate system/application/\n";
		} else {
			$this->message .= "\t\tsystem/application/ exists\n";
		}
		switch($what) {
			case 'controller':
				$path = $this->basepath .'system/application/controllers/';
				if (!file_exists($path)) {
					mkdir($path);
					chmod($path, 0775);
					$this->message .= "\t\tCreate system/application/controllers/\n";
				} else {
					$this->message .= "\t\tsystem/application/controllers/ exists\n";
				}
				$class = ucfirst($name);
				$file = $name .'Controller.php';
				if (!file_exists($path .$file)) {
					$resource = fopen($path .$file, 'w');

					fwrite($resource, "<?php\n");
					fwrite($resource, "class $class" ."Controller extends Controller {\n");
					fwrite($resource, "\tfunction $class" ."Controller() {\n");
					fwrite($resource, "\t\tparent::Controller();\n");
					fwrite($resource, "\t}\n");

					$routes_path = $this->basepath .'system/application/config/';
					if (!file_exists($routes_path)) {
						mkdir($routes_path);
						chmod($routes_path, 0775);
						$this->message .= "\t\tCreate system/application/config/\n";
					} else {
						$this->message .= "\t\tsystem/application/config/ exists\n";
					}

					if (!file_exists($routes_path .'routes.php')) {
						$routesresource = fopen($routes_path .'routes.php', 'a');
						fwrite($routesresource, "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');\n");
						fwrite($routesresource, '$route["default_controller"] = "welcome";' ."\n");
						fwrite($routesresource, '$route["scaffolding_trigger"] = "";' ."\n");
						fwrite($routesresource, "\n");
						$this->message .= "\t\tAdd default routes\n";
					} else {
						$routesresource = fopen($routes_path .'routes.php', 'a');
						fwrite($routesresource, "\n");
					}
					
					fwrite($routesresource, '$route["' .$name .'"] = "' .$name .'Controller";' ."\n");
					fwrite($routesresource, '$route["' .$name .'/([a-zA-Z]+)"] = "' .$name .'Controller/$1";' ."\n");
					fwrite($routesresource, '$route["' .$name .'/([a-zA-Z]+)/([a-zA-Z0-9 ]+)"] = "' .$name .'Controller/$1/$2";' ."\n");
					fwrite($routesresource, '$route["' .$name .'/([a-zA-Z]+)/([a-zA-Z0-9 ]+)/([a-zA-Z0-9 ]+)"] = "' .$name .'Controller/$1/$2/$3";' ."\n");
					fclose($routesresource);
					$this->message .= "\t\tAdd route to " .$class ."Controller\n";

					if (is_array($methods)) {
						foreach ($methods as $method) {

							fwrite($resource, "\tfunction $method() {\n");
							fwrite($resource, "\t}\n");

							$this->message .= "\t\tAdd $method in " .$class ."Controller\n";
							$viewpath = $this->basepath .'system/application/views/';

							if (!file_exists($viewpath)) {
								mkdir($viewpath);
								chmod($viewpath, 0775);
								$this->message .= "\t\tCreate system/application/views/\n";
							} else {
								$this->message .= "\t\tsystem/application/views/ exists\n";
							}

							$viewpath .= $name ."_controller/";
							if (!file_exists($viewpath)) {
								mkdir($viewpath);
								chmod($viewpath, 0775);
								$this->message .= "\t\tCreate system/application/views/$name" ."_controller/\n";
							} else {
								$this->message .= "\t\tsystem/application/views/$name" ."_controller/ exists\n" ;
							}

							$viewfile = $method ."_view.php";
							$viewresource = fopen($viewpath .$viewfile, 'w');
							fclose($viewresource);
							chmod($viewpath .$viewfile, 0775);

							$this->message .= "\t\tCreate system/application/views/$name" ."_controller/$viewfile\n";
						}
					}

					fwrite($resource, "}\n");
					fwrite($resource, "?>");
					fclose($resource);
					chmod($path .$file, 0775);

					$this->message .= "\t\tCreate system/application/controllers/$file\n";
				} else {
					$this->message .= "\t\tsystem/application/controllers/$file exists\n";
				}
			break;
			case 'model':
				$path = $this->basepath .'system/application/models/';

				if (!file_exists($path)) {
					mkdir($path);
					chmod($path, 0775);
					$this->message .= "\t\tCreate system/application/models/\n";
				} else {
					$this->message .= "\t\tsystem/application/models/ exists\n";
				}

				$class = ucfirst($name);
				$file = $name .'.php';

				if (!file_exists($path .$file)) {
					$resource = fopen($path .$file, 'w');

					fwrite($resource, "<?php\n");
					fwrite($resource, "class $class extends Model {\n");
					fwrite($resource, "\tfunction $class() {\n");
					fwrite($resource, "\t\tparent::Model();\n");
					fwrite($resource, "\t}\n");

					if (is_array($methods)) {
						foreach ($methods as $method) {
							fwrite($resource, "\tfunction $method() {\n");
							fwrite($resource, "\t}\n");
							$this->message .= "\t\tAdd $method in $class\n";
						}
					}

					fwrite($resource, "}\n");
					fwrite($resource, "?>");
					fclose($resource);
					chmod($path .$file, 0775);
					$this->message .= "\t\tCreate system/application/models/$file\n";

				} else {
					$this->message .= "\t\tsystem/application/models/$file exists\n";
				}
			break;
		}
		$this->message .= "\n";
	}
}
?>
