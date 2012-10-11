<?php
ini_set('display_errors','on');
include_once ROOT_DIR.'modules'.DS.'Common.class.php';
include_once("Mail.php");
include_once('Mail/mime.php'); // PEAR Mail_Mime packge

class Users extends Common {
	
    private $userObj;
    
    public function __construct()
    {
        include_once ROOT_DIR.'models'.DS.__class__.'.class.php';
        $classname =  __class__.'_Model';
        $this->userObj = new $classname; 
    }
    
  	public function validateRegister($data) {
        
        $input = trim($data);
        try{
           $inputObject = $this->processXML($input);
			
			if('' == $inputObject->username)
				throw new Exception ("Username should not be left empty.");
			
			if($this->userObj -> usernameExists($inputObject->username))
				throw new Exception ("Username already exists.");
				
			if('' == $inputObject->password)
				throw new Exception ("Password should not be left empty.");
			
            if (preg_match("#.*^(?=.{6,6})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $inputObject->password))
    			throw new Exception ("Password should contain One small letter,One capital letter,One numeric
    								, One special character and length should be 6.");						
			
			if($inputObject->password != $inputObject->confirmpassword)
				throw new Exception ("Password and Confirm Password does not match.");
			
			if($inputObject->terms_accepted == '')
				throw new Exception ("Please accept terms to proceed.");
			
		//	if($inputObject->udid == '')
		//		throw new Exception ("Invalid Device.");
			$image = $this->uploadFile();	
			if($image == '')
				throw new Exception ("Problem uploading file.");
			if($image == 1)// if no image
				$image = '';	
			$result = $this->userObj -> registerUser($inputObject,$image);
			
			    $to      = $inputObject -> username;
                $subject = 'Welcome to Heartweb';
                $message = "Dear User,\n Welcome to heartweb. \nNow you can access your trail account for 30 days. \n Thanks,\n Heartweb Team.";
                $headers = 'From: admin@heartweb.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                if(!mail($to, $subject, $message, $headers))
                {
				throw new Exception ("Problem sending mail to .".$inputObject -> username);
                }
			
			return $result;
        }
        catch (Exception $e) {
        	
            $this -> setError($e -> getMessage());
        }
        
        
        
    }
    
	public function getUserData($input)
    {
    try{
            $inputObject = $this->processXML($input);

            if ( !isset ($inputObject -> userkey) ){
                throw new Exception ('Authentication key is null');
            } 
            
			$user_details = $this->userObj->getUserData($inputObject);
			return $user_details;
		
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
	
    public function setUserData($input)
    {
    try{
            $inputObject = $this->processXML($input);

            if ( !isset ($inputObject -> userkey) ){
                throw new Exception ('Authentication key is null');
            } 
                        
			$user_details = $this->userObj->setUserData($inputObject);
			return $user_details;
		
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
	
	
  	private function uploadFile()
    {
    if(isset($_FILES) && count($_FILES) > 0)
	{
		foreach($_FILES as $k => $val)
		{
			$filename = rand().$val['name'];	
			$uploadloc = $_SERVER['DOCUMENT_ROOT'].'/heartweb/actual/uploads/profiles/'.$filename;
			
			if($val['tmp_name'] != '')
			{
			$upload = move_uploaded_file($val['tmp_name'],$uploadloc);
			if($upload)
			return $filename;
			else
			{
				if($val['size'] == 0)
				{
					$this -> setError('Maximum file size should be less than 2 MB.');
					return '';
				}
				else
				{
					$this -> setError($val['error']);
					return '';	
				}
			}
			}
			else
			{
			return 1;
			}			
		}
	}
	else
	{
		return 1;
	}
    }
   
    /* to get particuler user's profile
     * parameter $user_id
     * returns array
     */
    
    public function getUserProfile($input)
    {
		try{
            $inputObject = $this->processXML($input);

            if ( !isset ($inputObject -> username) ){
                throw new Exception ('Please fill all the mandatory feilds');
            } 
            
			$user_details = $this->userObj->loadUserProfile($inputObject -> username);
			return $user_details;
		
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
		
        
    }
    
    /* to serch users based on first name and last name of users
     * parameters firstname and lastname
     * return array
     */
    
    public function getSearchUsers($input)
    {
    	$inputObject = $this->processXML($input);
	    $serch_users_details = $this->userObj->loadListOfSearchUsers($inputObject);
	    return $serch_users_details;
    }
    
    /* to get list of users
     * parameters none
     * returns array
     */
    public function  getListOfUsers()
    {
        $userlist = $this->userObj->loadListOfUsers();
        return $userlist;
    }
    
    
    public function getGroupUsersList($input)
    {
    	try{
            $inputObject = $this->processXML($input);
           
            if($inputObject->groupid == '')
            {
                throw new Exception (
                        'Group Id should not be left empty.'
                );
            }
            
    		if($inputObject->userkey == '')
            {
                throw new Exception (
                        'Userkey should not be left empty.'
                );
            }
        $group_userdlist = $this->userObj->loadGroupUsersList($inputObject);
        return $group_userdlist;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    
    }
    
    public function passwordReminder($input) {
        try{

            $inputObject = $this->processXML($input);
            
            if (!isset ($inputObject -> email[0])){
                throw new Exception ('Please fill all the mandatory feilds');
            } 
            
            $password = $this -> userObj -> checkEmail($inputObject -> email);
            
            if (!$password) throw new Exception ('Email does not exists.');
            
            else {
			
                $message = 'Your password :'.' '.$password;				
				
				$header = array ('From' => 'admin@heartweb.com',
				'To' => $inputObject -> email,
				'Subject' => 'Password reminder');
	   
				$text = 'Text version of email'; // text and html versions of email.
				$html = '<html><body>'.$message.'</body></html>';						
	   /*
				$smtp = Mail::factory('smtp',
			   array ('host' => 'mx.valuelabs.net',
				 'auth' => true,
				 'username' => 'pradeep.kachhawaha',
				 'password' => 'pradeep123'));
				 */

				 	$smtp = Mail::factory('smtp',
					array ('host' => SMTP_HOST,
						 'port' => SMTP_PORT,
						 'auth' => true,
						 'username' => SMTP_USER,
						 'password' => SMTP_PASSWORD));
			  $mail = $smtp->send($inputObject -> email, $header, $message);

				if (PEAR::isError($mail)) {
					throw new Exception ('Email  not sent');
				} else {
					return true;
				} 
            }
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }

 
    public function changePassword($input)
    {
    	try{
           $inputObject = $this->processXML($input);
            
            //@todo need to validate as per client requirement.
            if (!isset ($inputObject -> oldpassword) ||
                !isset ($inputObject -> newpassword))
            {
                throw new Exception ('Please fill all the mandatory feilds');
            }
			
            if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $inputObject->newpassword))
    			throw new Exception ("Password should contain One small letter,One capital letter,One numeric
    								, One special character and length should be 8 - 20 .");            
			
            if(!$this->passwordValidity($inputObject->udid,$inputObject->auth,$inputObject->oldpassword))
            {
                throw new Exception ('Invalid Password.');
            }
            $result = $this -> userObj -> changePassword($inputObject);
            return $result;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
    
	private function passwordValidity($udid,$auth,$oldpassword)
    {
        return $this -> userObj -> passwordValidity($udid,$auth,$oldpassword);
    }

	public function userLogin($input) {
        try{
            $inputObject = $this->processXML($input);
            

            if ( 
                !isset ($inputObject -> username) ||
                !isset ($inputObject -> password)
            ){
            throw new Exception ('Please fill all the mandatory feilds');
            } 
            
            $userlogin = $this -> userObj -> userLogin($inputObject -> username,
                                                        $inputObject -> password,
                                                        $inputObject -> udid);
            
            if ($userlogin['id'] == '0') {
                throw new Exception($userlogin['name']);
            }
            else
            {
				
		  $returndata['status'] = 'OK';				
                $userkey = $this -> userObj -> generateUserKey(
                                                                $userlogin['id'],
                                                                $inputObject -> udid
                                                               );
                $returndata['userauthkey'] = $userkey;
                $returndata['usertype'] = $userlogin['usertype'];
                $returndata['expiry'] = $userlogin['expiry'];
                
            }
            
            return $returndata;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
    
	public function sendingmessage($input) 
	{
        try{
           $inputObject = $this->processXML($input);
            
            if (            	 
            	!isset ($inputObject -> auth) ||
                !isset ($inputObject -> group) ||
                !isset ($inputObject -> subject) ||
                !isset ($inputObject -> message)
            ){
            
            // throw error to fill all feilds
                throw new Exception (
                        'Please fill all the mandatory feilds'
                );
            } 
            
            $userId = $this -> userObj -> checkUser($inputObject -> auth);
            
            if (!$userId) throw new Exception ('User doesn"t exist');
            
            else{
                foreach($inputObject -> group as $group)
                {
	            	$groupId = $this -> userObj -> checkGroup($userId, $inputObject -> group, $inputObject -> subject, $inputObject -> message);
	                
	            	if(!$groupId) throw new Exception ('Group doesn"t exist');
	            	else
	            	{
		            	// @todo add email here.
		                
		                return true;
	            	}
                }
            }
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }

	public function msgAutoSuggest($input)
    {
		try{
           $inputObject = $this->processXML($input);
            
			//if(!isset($inputObject -> username) || $inputObject -> username == '')
				//throw new Exception ('Searchname should not be left empty');
            if (!isset ($inputObject -> userkey) || $inputObject -> userkey == ''){
				throw new Exception ('Userkey should not be left empty');
            } 
			
			$users = $this->userObj->loadMsgAutoSuggestUsername($inputObject -> username, $inputObject -> userkey);
			$groups = $this->userObj->loadMsgAutoSuggestGroupname($inputObject -> username, $inputObject -> userkey);
			return compact('users','groups');
		}
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
    
	public function checkUser($authkey)
	{

        $result = $this->userObj->checkUser($authkey);
            
        return $result;
            
    }
	public function checkAuthKey($authkey)
	{
            
        $result = $this->userObj->checkAuthKey($authkey);
            
        return $result;
            
    }// end fn: getFaculties
    
    public function checkUserFromRawData($input)
    {
	    try{
	           $inputObject = $this->processXML($input);
	            if(isset($inputObject->userkey) && $inputObject->userkey != '')
	            {
	            	$authkey = $inputObject->userkey;
	            }
	            else if(isset($inputObject->auth) && $inputObject->auth != '')
	            {
	            	$authkey = $inputObject->userkey;
	            }
				else if(isset($inputObject->authKey) && $inputObject->authKey != '')
				{
					$authkey = $inputObject->authKey;
				}
				else
				 throw new Exception ('Invalid Authentication Key.');
				 
	             $result = $this->userObj->checkAuthKey($authkey);
				if($result)
	             return $result;
	            else
	             throw new Exception ('Authentication Failed.');
	             
	            
	        }
	        catch (Exception $e) {
	        	
	            return $this -> setError($e -> getMessage());
	        }
    }
    
	public function deleteUser($input)
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
            $result = $this -> userObj -> deleteUser($inputObject);
            return $result;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }
    }
	
	public function inAppPurchase($input) {
	
        try{
            $inputObject = $this->processXML($input);
            
			
            if ( 
                !isset ($inputObject -> authkey) ||
                !isset ($inputObject -> receipt) 
            ){
				throw new Exception ('Please fill all the mandatory feilds');
            } 
            
            $inapppurchase = $this -> userObj -> inAppPurchase($inputObject -> authkey,
                                                        $inputObject -> receipt);            
            return $inapppurchase;
            
        }
        catch (Exception $e) {
            return $this -> setError($e -> getMessage());
        }        
         
    }
    
}