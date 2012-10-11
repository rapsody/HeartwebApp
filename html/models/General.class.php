<?php

class General_Model {


	private $db;

	public function __construct() {
		global $db;
			
		$this -> db =& $db;
	}
	/**
	 * Returns list of affiliations
	 * @return array
	 */
	public function loadAffiliation() {
		$result = $this -> db -> query (
						"SELECT
							affiliation_id as id,
							affiliation_name as name
						FROM
							affiliations"
							);

							$return = array();

							if ($result->num_rows) {

								/* fetch associative array */
								while ($row = $result->fetch_assoc()) {
									$return['affiliations']['affiliation'][]['nodes'] = $row;
								}
								/* free result set */
								$result->free();
							}
							return $return;
	}
	/**
	 * Returns list of locations
	 * @return array
	 */
	public function loadLocations() {
		$result = $this -> db -> query (
						"SELECT
							location_id as id,
							location_name as location
						FROM
							locations"
							);

							$return = array();

							if ($result->num_rows) {

								/* fetch associative array */
								while ($row = $result->fetch_assoc()) {
									$return['locations']['location'][]['nodes'] = $row;
								}
								/* free result set */
								$result->free();
							}


							return $return;
	}
}// end fn: Faculites