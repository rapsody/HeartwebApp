<?php

    class UserList_Model {
        
        
        private $db_user;
        
        const TABLE = "users";
        
        public function __construct() {
            global $db_user;
            
            $this -> db_user =& $db_user;
        }
        
        /**
         * Returns the list of users' details, whose are not deleted
         * @return array
         */
        public function loadUserList() {
           $result = $this -> db_user -> query (
	                        "SELECT
	                            *
	                        FROM
	                            " .TBL_USERS ."
	                        WHERE 
	                        	status != '2'"
	                        );
	
	            $return = array();
	                
	            if ($result ) {
	
	                /* fetch associative array */
	                while ($row = $result->fetch_assoc()) {
	                    $return['user'][]['nodes'] = array ("username" => $row['username'],
	                                       "firstname" => $row['first_name'],
	                                       "lastname"  => $row['last_name'],
	                                       "faculty"    => $row['faculty'],
	                                       "specialty" => $row['speciality'],
	                                       "country"    => $row['country'],
	                                       "state"      => $row['state'],
	                                       "image"      => $row['image'],
	                                       "imagedata"      => $row['image_data'],
	                    
	                                        );
	                }
	
	                /* free result set */
	                $result->free();
	            }
	            
	            return $return;
        }
    }// end fn: UserList