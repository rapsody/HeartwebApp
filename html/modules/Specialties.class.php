<?php

	class Specialties {
	
	
		private $model;
		
		
		public function __construct() {
			
			include ROOT_DIR . DS . "models" . DS . __CLASS__ . ".class.php";
			
			$classname = __CLASS__ . "_Model";
			$this -> model = new $classname;
		}// end fn: construct
		
		public function getSpecialties() {
			
			$result = $this -> model -> loadSpecialties();
			
			return $result;
		}// end fn: getSpecialties
	}// end class: Specialties