<?php
Class FormUserData 
{
    private $userObj;
    
    public function __construct()
    {
        include_once ROOT_DIR.'models'.DS.__class__.'.class.php';
        $classname =  __class__.'_Model';
        $this->formObj = new $classname; 
    }

    public function getFormUserData($formstatus)
    {
    
        return $result = $this->formObj->loadFormUserData($formstatus);
        
    
    }
}