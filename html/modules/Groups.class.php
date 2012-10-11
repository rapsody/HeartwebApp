<?php
include_once ROOT_DIR.'modules'.DS.'Common.class.php';
Class Groups extends Common {
    
    private $objGroupModel;

    public function __construct()
    {
        include ROOT_DIR.'models'.DS.__class__.'.class.php';
        $class_name = __class__.'_Model';
        $this->objGroupModel = new $class_name;
    }
    
	public function deleteGroup($input)
    {
    	try{
           $inputObject = $this->processXML($input);
            
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == '')
            {
                throw new Exception ('Invalid userkey.');
            }
            
            if(!isset ($inputObject -> groupid) || $inputObject -> groupid == '')
            {
                throw new Exception ('Invalid groupid.');
            }
            $result = $this -> objGroupModel -> deleteGroup($inputObject);
            return $result;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
    
    public function getUserGroups($input,$limit = '') 
    {
		try{
			
			$inputObject = $this->processXML($input);
			
            if ( !isset ($inputObject -> userkey) ){
                throw new Exception ('Please fill all the mandatory feilds');
            } 
            
			$groups = $this->objGroupModel->loadUserGroups($inputObject -> userkey,$limit);
			return $groups;
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		
       
    }

    public function searchGroups($input,$limit = '') 
    {
		try{
            $inputObject = $this->processXML($input);
			
            if ( !isset ($inputObject -> userkey) ){
                throw new Exception ('Invalid Userkey');
            } 
            
			$groups = $this->objGroupModel->searchGroups($inputObject);
			return $groups;
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		
       
    }
    
    public function getGroupDetails($input) 
    {
		try{
           $inputObject = $this->processXML($input);
			
            if ( !isset ($inputObject -> userkey) ){
                throw new Exception ('Please fill all the mandatory feilds');
            } 
            
			$groups = $this->objGroupModel->getGroupDetails($inputObject -> groupid);
			return $groups;
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		
       
    }
    
    public function createUserGroups($input) 
    {
     try{
           $inputObject = $this->processXML($input);
            
            //@todo need to validate as per client requirement.
            if ( 
                !isset ($inputObject -> groupname) ||
                !isset ($inputObject -> groupsubject) || 
                !isset ($inputObject -> grouplocation) ||
                !isset ($inputObject -> groupprivate)
                
            ){
            
            // throw error to fill all feilds
                throw new Exception (
                        'Please fill all the mandatory feilds'
                );
            }
            if($this->groupExists($inputObject->groupname))
            {
                throw new Exception (
                        'Group Name already exists.'
                );
            }

            
            
            
            $usergroup = $this -> objGroupModel -> createUserGroup($inputObject);
            
            if ($usergroup['id'] == '0') {
                throw new Exception($usergroup['name']);
            }
            else
            {
                $returnValue['status'] = 'OK';
				$returnValue['id'] = $usergroup['id'];
            }
            
            return $returnValue;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
    
    private function groupExists($groupname)
    {
        return $this -> objGroupModel -> checkGroupExistence($groupname);
    }
	
	// Used to Join , Unjoin , Approve and Reject the Users.
	public function doGroupAction($input)
    {
	     try{
            $inputObject = $this->processXML($input);
            
            //@todo need to validate as per client requirement.
            if (!isset ($inputObject -> auth) || 
            	!isset ($inputObject -> groupid) || 
            	!isset ($inputObject -> mode))
            {
                throw new Exception ('Invalid Parameters');
            }
            
            if($inputObject -> mode == 'join') {
            	$result = $this -> objGroupModel -> groupJoin($inputObject);
            } else if($inputObject -> mode == 'unjoin') {
            	$result = $this -> objGroupModel -> groupUnjoin($inputObject);
            } else if($inputObject -> mode == 'approve') {
            	$result = $this -> objGroupModel -> groupApprove($inputObject);
            } else if($inputObject -> mode == 'reject') {
            	$result = $this -> objGroupModel -> groupReject($inputObject);
            } else {
            	throw new Exception ('Invalid Action Type.');
	     	}
	     	
            
            if (count($result) > 0) {
                return $result;
            }
            else
            {
                throw new Exception('Error while Processing.');
            }
 
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
    
    // Latest Public groups.
    public function latestGroups()
	{
    	return $this -> objGroupModel -> getLatestGroups();
    }
        
    // User Request For Groups Pending Approved Rejected Status.
    public function groupRequestStatus($input)
    {
      try{
            $inputObject = $this->processXML($input);
            
            //@todo need to validate as per client requirement.
            if (!isset ($inputObject -> auth))
                throw new Exception ('Invalid Parameters');
            
            
            $result = $this -> objGroupModel -> getGroupRequestStatus($inputObject);
            
	     	if (count($result) > 0) {
                return $result;
            }
            else
            {
                throw new Exception('Error while Processing.');
            }
 
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
        
 	// User Request For My Groups Pending Approved Rejected Status.
    public function myGroupRequestStatus($input)
    {
		try
		{
            $inputObject = $this->processXML($input);
            
            //@todo need to validate as per client requirement.
            if (!isset ($inputObject -> auth))
                throw new Exception ('Invalid Parameters');
            
            $result = $this -> objGroupModel -> getMyGroupRequestStatus($inputObject);
            
	     	if (count($result) > 0) {
                return $result;
            }
            else
            {
                throw new Exception('Error while Processing.');
            }
 
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }	
    }
	
	public function getPendingPublicRequests($input)
    {
		try
		{
            $inputObject = $this->processXML($input);
            
            //@todo need to validate as per client requirement.
            if (!isset ($inputObject -> userkey))
                throw new Exception ('Invalid Parameters');
            
            $result = $this -> objGroupModel -> getPendingPublicRequests($inputObject);
            
	     	if (count($result) > 0) {
                return $result;
            }
            else
            {
                throw new Exception('Error while Processing.');
            }
 
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }	
    }
 
}