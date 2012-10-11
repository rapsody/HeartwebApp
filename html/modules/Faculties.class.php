<?php

	class Faculties {
	
	
		private $model;
		
		
		public function __construct() {
			
			include ROOT_DIR . DS . "models" . DS . __CLASS__ . ".class.php";
			
			$classname = __CLASS__ . "_Model";
			$this -> model = new $classname;
		}// end fn: construct
		
		public function getFaculties() {
			
			$result = $this -> model -> loadFaculties();
			
			return $result;
		}// end fn: getFaculties
	}// end class: Faculties