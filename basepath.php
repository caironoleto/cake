<?php
define('BASEPATH',dirname(__FILE__) .'/');

function rm_recursive($filepath) {
	if (is_dir($filepath) && !is_link($filepath)) {
		if ($dh = opendir($filepath)) {
			while (($sf = readdir($dh)) !== false) {
				if ($sf == '.' || $sf == '..')
					continue;
				if (!rm_recursive($filepath.'/'.$sf))
					throw new Exception($filepath.'/'.$sf.' could not be deleted.');
			}
			closedir($dh);
		}
		return @rmdir($filepath);
	}
	return @unlink($filepath);
}

?>
