<?php
class Faqs
 {
    private $contentObj;
    
    public function __construct()
    {
        include_once ROOT_DIR.'models'.DS.__class__.'.class.php';
        $classname =  __class__.'_Model';
        $this->faqsObj = new $classname; 
    }
    
  public function getFaqs() {
        
        try{
         
			$result = $this->faqsObj -> getFaqs();
			if(count($result) > 0)
			return $result;
			else
			throw new Exception('No Data Available');
        }
        catch (Exception $e) {
        	
            $this -> setError($e -> getMessage());
        }
        
        
        
    }
   
    public function setError($error) {
        
        $this -> errorMessages[] = $error;
        return false;
    }
 }