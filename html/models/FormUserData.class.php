<?php
class FormUserData_Model {


    private $db;
        
    public function __construct() 
    {
            global $db;
            
            $this -> db =& $db;
    }
        
    /**
     * Get all the user form data based on passed formstatus.
     * @param int $formstatus
     * @return array
     */
    public function loadFormUserData($formstatus)
    {
    
        $result = $this -> db -> query (
                        "SELECT
                            *
                        FROM
                            " .TBL_FORM_USER_DATA ."
                        WHERE
                            form_complete = '".$formstatus."'"
                        );

            $return = array();
                
            if ($result ) {

                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $return[] = array ("pdur" => $row['patient_detail_ur'],
                                       "pdfame" => $row['patient_detail_firstname'],
                                       "pdsurname"  => $row['patient_detail_surname'],
                                       "formkey"    => $row['form_key']
                                        );
                }

                /* free result set */
                $result->free();
            }
            
            return $return;
        
    
    }
}