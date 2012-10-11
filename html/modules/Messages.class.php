<?php
include_once ROOT_DIR.'modules'.DS.'Common.class.php';
Class Messages extends Common {
    
    private $objMessagesModel;

    public function __construct()
    {
        include ROOT_DIR.'models'.DS.__class__.'.class.php';
        $class_name = __class__.'_Model';
        $this->objMessagesModel = new $class_name;
    }
	
	public function setError($error) {
        
        $this -> errorMessages[] = $error;
        return false;
    }
	
    public function deleteMessage($input)
    {
    	try{
           $inputObject = $this->processXML($input);
            
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == '')
            {
                throw new Exception ('Invalid userkey.');
            }
            
            if(!isset ($inputObject -> messageid) || $inputObject -> messageid == '')
            {
                throw new Exception ('Invalid messageid.');
            }
            $result = $this -> objMessagesModel -> deleteMessage($inputObject);
            return $result;
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
        
    public function getMessage($input) 
    {
		try{
			$inputObject = $this->processXML($input);
            
			if(!isset($inputObject -> messageid) || $inputObject -> messageid == '')
				throw new Exception ('Message ID is empty');
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == ''){
				throw new Exception ('Userkey should not be left empty');
            } 
			
			$messages = $this->objMessagesModel->getMessage($inputObject -> userkey,$inputObject -> messageid);
			if(count($messages) > 0)
	        {
	        	return $messages;
	        }
	        else
	        {
	        	throw new Exception ("No Messages Found");
	        }
		}
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
	
    }
    
 	public function getMessages($input) 
    {
		try{
            $inputObject = $this->processXML($input);
            
			if(!isset($inputObject -> lastupdatedate) || $inputObject -> lastupdatedate == '')
				$updatedate  = '';
			else
				$updatedate  = $inputObject -> lastupdatedate;
			
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == ''){
				throw new Exception ('Userkey should not be left empty');
            } 
			$messages = $this->objMessagesModel->getMessages($inputObject -> userkey,$updatedate);
			if(count($messages) > 0)
	        {
	        	return $messages;
	        }
	        else
	        {
	        	throw new Exception ("No Messages Found");
	        }
		}
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		

    }

    public function getGroupMessages($input) 
    {
		try{
            $inputObject = $this->processXML($input);
            
			if(!isset($inputObject -> lastupdatedate) || $inputObject -> lastupdatedate == '')
				$updatedate  = '';
			else
				$updatedate  = $inputObject -> lastupdatedate;
			
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == ''){
				throw new Exception ('Userkey should not be left empty');
            } 
            if (!isset ($inputObject -> groupid) || $inputObject -> groupid == ''){
				throw new Exception ('Group should not be left empty');
            } 
            
			$messages = $this->objMessagesModel->getGroupMessages($inputObject -> userkey,$inputObject -> groupid,$updatedate);
			if(count($messages) > 0)
	        {
	        	return $messages;
	        }
	        else
	        {
	        	throw new Exception ("No Messages Found");
	        }
		}
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		

    }
    
    
    public function getRecentMessages($input) 
    {
		try{
            $inputObject = $this->processXML($input);
            
			if(!isset($inputObject -> lastupdatedate) || $inputObject -> lastupdatedate == '')
				$updatedate  = '';
			else
				$updatedate  = $inputObject -> lastupdatedate;
			
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == ''){
				throw new Exception ('Userkey should not be left empty');
            } 
			$messages = $this->objMessagesModel->getRecentMessages($inputObject -> userkey,$updatedate);
			if(count($messages) > 0)
	        {
	        	return $messages;
	        }
	        else
	        {
	        	throw new Exception ("No Messages Found");
	        }
		}
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		

    }
 	
    public function getSentMessages($input,$limit='') 
    {
		try{
            $inputObject = $this->processXML($input);
			if(!isset($inputObject -> lastupdatedate) || $inputObject -> lastupdatedate == '')
				$updatedate  = '';
			else
				$updatedate  = $inputObject -> lastupdatedate;
			
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == ''){
				throw new Exception ('Userkey should not be left empty');
            } 
			$messages = $this->objMessagesModel->getSentMessages($inputObject -> userkey,$updatedate,$limit);
			if(count($messages) > 0)
	        {
	        	return $messages;
	        }
	        else
	        {
	        	throw new Exception ("No Messages Found");
	        }
		}
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		

    }

    	public function sendMessage($input)
   	{
   		try{
            $inputObject = $this->processXML($input);

            if ( !isset ($inputObject -> to) ){
                throw new Exception ('To field is empty.');
            } 
            if($inputObject->to == '' && $inputObject->cc == '' )
            {
            	throw new Exception ('TO and CC fields are empty.');
            }	

            $totalids = $toids = $ccids = $newlist = array();
            
            
            $usersObj   = new Users();
            $fromuser = $usersObj->checkUser($inputObject->userkey);
            if(!($fromuser > 0))
            	throw new Exception ('Invalid User.');
            $toids = explode(',',$inputObject->to);
            $ccids = explode(',',$inputObject->cc);
			$totalids = $toids+$ccids;
			//print_r($totalids);
            foreach($totalids as $val)
            {
            	if(strpos($val,';') > 0)
            	{
            		$temp = array();
            		$temp = explode(';',$val);
            		//print_r($temp);
            		foreach($temp as $temp1)
            		$newlist[$temp1] ='';
            	}
            	else
            	$newlist[$val] = '';
            }
          
            $details = $this->objMessagesModel->getToIds($newlist);
            $details['inputlist'] = $newlist;
            $details['fromuser'] = $fromuser;
            
            $result = $this->objMessagesModel->createMessage($inputObject,$details);
            //echo '<pre>';
            //print_r($details);
			return $result;
		}
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
   	} 
	
}  