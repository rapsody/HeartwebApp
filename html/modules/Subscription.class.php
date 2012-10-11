<?php
include_once ROOT_DIR.'modules'.DS.'Common.class.php';
Class Subscription extends Common{
    
    private $objSubscriptionModel;

    public function __construct()
    {
        include ROOT_DIR.'models'.DS.__class__.'.class.php';
        $class_name = __class__.'_Model';
        $this->objSubscriptionModel = new $class_name;
    }
        
    public function getSubscription() 
    {
        $subscriptions = $this->objSubscriptionModel->loadSubscriptions();
        return $subscriptions;
    }
    
	  public function loadSubscriptionMultipleExpiry() 
    {
        $subscriptions = $this->objSubscriptionModel->loadSubscriptionMultipleExpiry();
        return $subscriptions;
    }
	public function getSubscriptionExpiry($data) 
    {
    	try
    	{
    	$inputObj = $this->processXML($data);
    	$subscriptions = $this->objSubscriptionModel->loadSubscriptionExpiry($inputObj);
        return $subscriptions;
    	}
    	catch(Exception $ex)
    	{
    	$this->setError($ex->getMessage());
    	}
    }
    
	public function addAdditionalSubscription($input)
    {
    	try{
           $inputObject = $this->processXML($input);
            
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == '')
            {
                throw new Exception ('Invalid userkey.');
            }
            
            if(!isset ($inputObject -> userid) || $inputObject -> userid == '')
            {
                throw new Exception ('Invalid userid.');
            }
            
    		if(!(isset ($inputObject -> days) && (int)$inputObject -> days > 0))
            {
                throw new Exception ('Invalid no of days.');
            }
            
            $result = $this -> objSubscriptionModel -> addAdditionalSubscription($inputObject);
            return $result;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }

}