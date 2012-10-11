<?php
class Common_Model
{
 	
	public function __construct()
	{
		
	}
	/**
     * Returns the user type with respect to userkey
     * @param string $userkey
     * @return false|string, returns usertype which can be one of 'TRIAL USER', 'PAID USER', 'SUPER USER'
     * If no users exists with the given key, false is return.
     */
	public function getUserType($userkey)
	{
		$result = $this -> db_user -> query (
                        "SELECT
                            user_type
                        FROM
                            " .TBL_USERS ."
                        WHERE
                            userkey = '".$this->db_user->real_escape_string($userkey)."'"
                        );

            $return = array();
                
            if ($result->num_rows > 0 ) {
            	$row = $result->fetch_assoc();
				$result->free();
				return $row['user_type'];
                
            } else {
            $result->free();
            return false;
            
            }
		}
}