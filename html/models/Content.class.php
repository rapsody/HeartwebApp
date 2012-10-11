<?php
  class Content_Model {
        
        
        private $db;
        
        
		
        public function __construct() {
            global $db;
            
            $this -> db =& $db;
        }
        
        /**
         * Fetches various types of content in associative array with keys 'name', 'content'
         * @return array
         * Output array format is array(
         *    'data' => array(
         *      array('nodes' => array('name' => contentName, 'content' => content)),
         *      array('nodes' => array('name' => contentName1, 'content' => content1))
         *      ....
         *    )
         * )
         */
        public function getContent() {
            $result = $this -> db -> query (
                        "SELECT
                            name,content
                        FROM
                            content
                       "
                        );

            $return = array();
                
            if ($result ) {
                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $return['data'][]['nodes'] = array ("name" => $row['name'],
                                       "content" => $row['content']
                                        );
                }

                /* free result set */
                $result->free();
            }
            
            return $return;
        }
  }