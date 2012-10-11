<?php
Class LoginKeys_Model 
{
private $db;
        
    public function __construct() 
    {
            global $db;
            
            $this -> db =& $db;
    }
    /**
     * Checks user auth key and returns a boolean
     * @param string $userkey
     * @return boolean
     */
    public function checkAuthKey($userkey)
    {
        $result = $this -> db -> query (
                        "SELECT
                            *
                        FROM
                            " .TBL_LOGIN_KEYS ."
                        WHERE
                            userkey = '".$userkey."'"
                        );

            $return = array();
                
            if ($result->num_rows > 0 ) {

              return true;
              
                /* free result set */
                $result->free();
            } else {
            
            return false;
            $result->free();
            }
    
    }
        
 }

