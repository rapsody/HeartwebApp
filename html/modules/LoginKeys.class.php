<?php
Class LoginKeys
{
   
        private $model;
        
        
        public function __construct() {
            
            include ROOT_DIR . DS . "models" . DS . __CLASS__ . ".class.php";
            
            $classname = __CLASS__ . "_Model";
            $this -> model = new $classname;
        }// end fn: construct
        
        public function checkAuthKey($authkey) {
            
            $result = $this -> model -> checkAuthKey($authkey);
            
            return $result;
            
        }// end fn: getFaculties

}