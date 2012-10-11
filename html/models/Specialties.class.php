<?php

	class Specialties_Model {
		
		
		private $db;
		
		const TABLE = "specializations";
		
		public function __construct() {
			global $db;
			
			$this -> db =& $db;
		}
		/**
         * Returns array of active specializations
         * @return array
         */
		public function loadSpecialties() {
			$result = $this -> db -> query (
						"SELECT
							id,
							specialization_name as name
						FROM
							" . self::TABLE . "
						WHERE
							status = '1'"
						);
						
			$return = array();
				
			if ($result ) {

				/* fetch associative array */
				while ($row = $result->fetch_assoc()) {
					$return['specialities']['speciality'][]['nodes'] = $row;
				}

				/* free result set */
				$result->free();
			}
			
			return $return;
		}
	}// end fn: Faculites