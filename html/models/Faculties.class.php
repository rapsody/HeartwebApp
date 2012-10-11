<?php

	class Faculties_Model {
		
		
		private $db;
		
		const TABLE = "faculties";
		
		public function __construct() {
			global $db;
			
			$this -> db =& $db;
		}
		
		/**
         * Retuns an array of faculty id and it's name
         * @return array, if there are no faculties available, an empty array is returned.
         */
		public function loadFaculties() {
			$result = $this -> db -> query (
						"SELECT
							id,
							faculty_name as name
						FROM
							" . self::TABLE . "
						WHERE
							status = '1'"
						);
						
			$return = array();
				
			if ($result ) {

				/* fetch associative array */
				while ($row = $result->fetch_assoc()) {
					$return['faculties']['faculty'][]['nodes'] = $row;
				}

				/* free result set */
				$result->free();
			}
			
			return $return;
		}
	}// end fn: Faculites