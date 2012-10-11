<?php

	class General {
	
	
		private $model;
		
		
		public function __construct() {
			
			include ROOT_DIR . DS . "models" . DS . __CLASS__ . ".class.php";
			
			$classname = __CLASS__ . "_Model";
			$this -> model = new $classname;
		}// end fn: construct
		
		public function getAffiliations() {
			
			$result = $this -> model -> loadAffiliation();
			
			return $result;
		}
		public function getLocations() {
			
			$result = $this -> model -> loadLocations();
			
			return $result;
		}
		
		
	}