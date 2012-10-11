<?php
  class Faqs_Model {
        
        
        private $db;
        
        
		
        public function __construct() {
            global $db;
            
            $this -> db =& $db;
        }
        
        /**
         * Retuns an array of faq question and answers available
         * @return array, if there are no faq's available, an empty array is returned.
         */
        public function getFaqs() {
            $result = $this -> db -> query (
                        "SELECT
                            *
                        FROM
                            faqs
                       "
                        );

            $return = array();
                
            if ($result ) {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $return['faq'][]['nodes'] = array ("question" => $row['question'],
                                       "answer" => $row['answer']
                                        );
                }

                /* free result set */
                $result->free();
            }
            
            return $return;
        }
  }