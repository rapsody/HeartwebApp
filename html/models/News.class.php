<?php

class News_Model {


	private $db;

	const TABLE = "news";

	public function __construct() {
		global $db;
			
		$this -> db =& $db;
	}
	/**
	 * Returns array of active news available.
	 * @return array
	 */
	public function loadNews() {
		$result = $this -> db -> query (
						"SELECT
							*
						FROM
							" . self::TABLE . "
						WHERE
							status = '1'"
							);

							$return = array();

							if ($result->num_rows > 0) {

								/* fetch associative array */
								while ($row = $result->fetch_assoc()) {
									$return['news'][]['nodes'] = array ("id" => $row['id'], "title" => $row['news_heading'], "body" => $row['news_content']);
										
								}
								$return['status'] = 'OK';
								/* free result set */
								$result->free();
							}
							else
							{
								$return['status'] = 'error';
								$return['error'] = 'No articles found.';
									
							}
								
							return $return;
	}
	/**
	 * Returns the associative array of news details of given news id.
	 * @param int $news_id
	 * @return array
	 */
	public function loadNewsDetails($news_id) {
		$result = $this -> db -> query (
						"SELECT
							*
						FROM
							" . self::TABLE . "
						WHERE
							status = '1' AND id = ".$news_id.""
							);

							$return = array();

							if ($result ) {

								/* fetch associative array */
								$row = $result->fetch_assoc();
								$return[] = array ("title" => $row['news_heading'], "body" => $row['news_content']);

								/* free result set */
								$result->free();
							}
								
							return $return;
	}


}// end fn: News