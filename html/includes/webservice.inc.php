<?php
	
include_once realpath(dirname(__FILE__) . "/../config/config.inc.php");	
//echo realpath(dirname(__FILE__) . "/../config/config.inc.php");
include_once BASE_PATH . DS . "database.inc.php";
	include_once ROOT_DIR . DS . "modules/Webservices/Writer.class.php";
//echo ROOT_DIR . DS . "modules/Webservices/Writer.class.php";	
	function __autoload($class_name) {
	
		$file = ROOT_DIR . DS . "modules" . DS . $class_name . ".class.php";
		if (is_file($file)){
			include_once $file;
		}
	}
