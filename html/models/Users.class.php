<?php
include_once('Common.class.php');

class Users_Model extends Common_Model{


	public $db;



	const TBL_GROUPS_USERS = "group_users";

	public function __construct() {
		global $db;

		$this -> db =& $db;
	}
    /**
     * Returns user profile details
     * @param string $username
     * @return array
     */
	public function loadUserProfile($username) {
		$result = $this -> db -> query (
                        "SELECT
                            *
                        FROM
                            " .TBL_USERS ."
                        WHERE
                            username = '".$username."'
                        AND
                        	status != '2'"
                        	);

                        	$return = array();

                        	if ($result ) {
                        		$userkey = 	'';
                        		/* fetch associative array */
                        		while ($row = $result->fetch_assoc()) {
                        			$return = array ("Username" => $row['username'],
                                       "Firstname" => $row['first_name'],
                                       "Lastname"  => $row['last_name'],
                                       "Faculty"    => $row['faculty'],
                                       "Speciality" => $row['speciality'],
                                       "Country"    => $row['country'],
                                       "State"      => $row['state'],
                                       "Location"      => $row['location'],
									   "ImagePath"      => $row['image'],
                    					"ImageData"	=> $row['image_data'],
                                       "Affiliation"      => $row['affiliation'],
                    					"Subject"	=> $row['subject'],
                    					"Privacy"	=> $row['privacy'],
										"JoinDate"	=> $row['date_registered']
                        			);
                        			$userkey = $row['userkey'];
                        		}

                        		/* free result set */
                        		$result->free();
                        		include_once('Groups.class.php');
                        		$obj = new Groups_Model();
                        		$groups = $obj->loadUserGroups($userkey);
                        		$return['groups'] = $groups['groups'];
                        		//print_r($return);
                        	}

                        	return $return;
	}
	/**
     * Returns user details based on passed userid
     * @param int $username
     * @return array
     */
	public function loadUserDetails($userid) {
		$result = $this -> db -> query (
	                        "SELECT
	                            *
	                        FROM
	                            " .TBL_USERS ."
	                        WHERE
	                            id = '".$userid."'
	                        AND 
	                        	status != '2'"
	                        	);

	                        	$return = array();
	                        	 
	                        	if ($result ) {

	                        		/* fetch associative array */
	                        		while ($row = $result->fetch_assoc()) {
	                        			$return[] = array ("username" => $row['username'],
	                                       "firstname" => $row['first_name'],
	                                       "lastname"  => $row['last_name'],
	                                       "faculty"    => $row['faculty'],
	                                       "specialty" => $row['speciality'],
	                                       "country"    => $row['country'],
	                                       "state"      => $row['state'],
										   "location"      => $row['location'],
	                                       "image"      => $row['image'],
										   "imagedata"      => $row['image_data']
	                        			);
	                        		}

	                        		/* free result set */
	                        		$result->free();
	                        	}
	                        	 
	                        	return $return;
	}
	/**
     * Returns user details based on user key
     * @param stdObj $data
     * @return array, returns users details on success, array with error description on failure
     */
	public function getUserData($data) {

		if($this->checkAuthKey($data->userkey))
		{
			$result = $this -> db -> query (
                        "SELECT
                            *
                        FROM
                            " .TBL_USERS ."
                        WHERE
                            userkey = '".$data->userkey."'
                        AND
                        	status != '2' limit 1");
			       
                        	$return = array();

                        	if ($result->num_rows > 0) {
                        		$userkey = 	'';
                        		/* fetch associative array */
                        		while ($row = $result->fetch_assoc()) {
                        			$return = array (  "userid" => $row['id'],
										"Firstname" => $row['first_name'],
                                       "Lastname"  => $row['last_name'],
                                       "Faculty"    => $row['faculty'],
                                       "Speciality" => $row['speciality'],
                                       "Country"    => $row['country'],
                                       "State"      => $row['state'],
									   "Location"	=> $row['location'],
                    					"ImageData"	=> $row['image_data'],
                                       "Affiliation"      => $row['affiliation'],
                    					"Subject"	=> $row['subject'],
                    					"Privacy"	=> $row['privacy']
                        			);
                        			$userkey = $row['userkey'];
                        	
			///	$fp = fopen('/var/www/html/logfiles/getuserdata.txt', 'a');
                                  ///              fwrite($fp, "results".explode($return)." ".$return['lastname']."  \n");
        			//				foreach($return as $key=>$value){
				//					fwrite($fp, "$key => $value \n");
				//				}                

	                   //     fclose($fp);
				
			}
                        		$result->free();
                        		return $return;
                        	}
                        	return  array('status' => 'error', 'error' => 'Authentication Failed.');

		}
		else
		return  array('status' => 'error', 'error' => 'Authentication Failed.');

	}
    /**
     * Updates the user data
     * @param StdObj $data
     * @return array, returns array with status key, error description in case of failure
     */
	public function setUserData($data) {

		if($this->checkAuthKey($data->userkey))
		{
			 
			$query = 'UPDATE
                    		users 
                    	SET 
                    		first_name = "'.$this -> db ->real_escape_string($data->Firstname).'",
                    		last_name = "'.$this -> db ->real_escape_string($data->Lastname).'",
                    		faculty = "'.$this -> db ->real_escape_string($data->Faculty).'",
                    		speciality = "'.$this -> db ->real_escape_string($data->Speciality).'",
                    		country = "'.$this -> db ->real_escape_string($data->Country).'",
                    		state = "'.$this -> db ->real_escape_string($data->State).'",
                    		image_data = "'.$this -> db ->real_escape_string($data->ImageData).'",
                    		location = "'.$this -> db ->real_escape_string($data->Location).'",
                    		affiliation = "'.$this -> db ->real_escape_string($data->Affiliation).'",
                    		subject = "'.$this -> db ->real_escape_string($data->Subject).'",
                    		privacy = "'.$this -> db ->real_escape_string($data->Privacy).'" 
                    		WHERE userkey = "'.$this -> db ->real_escape_string($data->userkey).'"'; 
			if($this -> db -> query($query)) {
				if($this -> db -> affected_rows > 0) {
					return  array('status' => 'OK');
				} else {
					return  array('status' => 'error','error' => 'Data Not Updated.');
				}
			} else {
				return  array('status' => 'error', 'error' => 'Unable to update profile information.');
			}
		}
		else
		return  array('status' => 'error', 'error' => 'Authentication Failed.');

	}

	/**
     * Get all users meeting the search criteria provided by inputObj
     * @param stdObj $inputObj
     * @return array
     */
	public function loadListOfSearchUsers($inputObj)
	{
		$where_cond = '';
		$qry1 = '';
		$qry2 = '';
		$qry3 = '';
		if($inputObj->firstname != '')
		$qry1 .= "first_name LIKE '%".$inputObj->firstname."%'";
		if($inputObj->lastname != '')
		$qry2 .= "last_name LIKE '%".$inputObj->lastname."%'";
		if($inputObj->username != '')
		$qry3 .= "username LIKE '%".$inputObj->username."%'";
			
		$where_cond = 'AND (';
		if(($qry1 != ''))
		$where_cond .= $qry1;
		if(($qry1 != '' && ($qry2 != '' || $qry3 != '')))
		$where_cond .= ' OR ';

		if(($qry2 != ''))
		$where_cond .= $qry2;
		if(($qry2 != '') && $qry3 != '')
		$where_cond .= ' OR ';

		if(($qry3 != ''))
		$where_cond .= $qry3;
		$where_cond .= ')';
		$query = "SELECT
								*
							FROM
								" .TBL_USERS ."
							WHERE privacy='public' and status = '1' $where_cond";
		$result = $this -> db -> query ($query);

		$return = array();

		if ($result->num_rows) {
			/* fetch associative array */
			while ($row = $result->fetch_assoc()) {
				$return['user'][]['nodes'] =  array ("firstname" => $row['first_name'],
                                       "lastname"  => $row['last_name'], 
                                       "username"  => $row['username'],
                                       "imagedata"  => $row['image_data']
				);
			}

			/* free result set */
			$result->free();
		}
		else
		{
			$return['user'] = array();
		}

		return $return;
	}

    /**
     * Get all users whose privacy is public and users are active
     * @return array
     */
	public function loadListOfUsers()
	{
		$result = $this -> db -> query (
                        "SELECT
                            *
                        FROM
                            " .TBL_USERS.' '."WHERE privacy='public' and status = '1'"
                            );
                            $return = array();

                            if ($result ) {

                            	/* fetch associative array */
                            	while ($row = $result->fetch_assoc()) {
                            		$return[] = array ("id" => $row['id'],
                                       "name"   => $row['first_name'].' '.$row['last_name'],
                    					"username" => $row['username'],
                    					"imagedata" => $row['image_data']
                            		);
                            	}

                            	/* free result set */
                            	$result->free();
                            }
                            return $return;
	}

    /**
     * Register a new user
     * @param stdObj $data, user submitted details
     * @param string $image, image path, default null
     * @return array, returns array with status key, error description in case of failure
     */
	public function registerUser($data,$image = '')
	{
		IF( TRIM($data->user_type) =="" || $data->user_type==null) $data->user_type= "TRIAL USER";
		$data->password = base64_encode($data->password);
		$query = '	INSERT
                			INTO 
                				users 
                			SET
                            	username = "' . $this->db->real_escape_string($data->username) . '",
								password  = "' . $this->db->real_escape_string($data->password) . '",
								first_name = "' . $this->db->real_escape_string($data->first_name) . '",
								last_name  = "' . $this->db->real_escape_string($data->last_name) . '",
								affiliation = "' . $this->db->real_escape_string($data->affiliation) . '",
								subject  = "' . $this->db->real_escape_string($data->subject) . '",
								speciality = "' . $this->db->real_escape_string($data->speciality) . '",
								faculty = "' . $this->db->real_escape_string($data->faculty) . '",
								image 	 = "' . $this->db->real_escape_string($image) . '",
								image_data 	 = "' . $this->db->real_escape_string($data->imagedata) . '",
								privacy 	 = "' . $this->db->real_escape_string($data->privacy) . '",
								user_type 		  = "' . $this->db->real_escape_string($data->user_type) . '",
								device_os 	 = "' . $this->db->real_escape_string($data->device_os) . '",
								app_version_number = "' . $this->db->real_escape_string($data->app_versionnumber) . '",
								terms_accepted  = "' . $this->db->real_escape_string($data->terms_accepted) . '",
								date_terms_accepted = "' . date('Y-m-d H:i:s') . '",
								date_registered  = "' . date('Y-m-d H:i:s') . '",
								device_type  = "' . $this->db->real_escape_string($data->device_type) . '",
								ip_address  = "' . $this->db->real_escape_string($data->ip_address) . '",
								udid  = "' . $this->db->real_escape_string($data->udid) . '",
								device_token  = "' . $this->db->real_escape_string($data->device_token) . '",
								push_notification  = "' . $this->db->real_escape_string($data->push_notification) . '",
								location  = "' . $this->db->real_escape_string($data->location) . '",
								expiry = "' . date('Y-m-d H:i:s',strtotime('+30 days')) . '"
								';
		 

		$result = $this -> db -> query ($query);

		if ($this -> db -> insert_id > 0) {
			return  array ("status" => 'OK');
		} else {
			return  array ("status" => 'error',"error"   => 'Error while registration.');
		}
	}

    /**
     * Login a user
     * @param string $username
     * @param string $password
     * @param string $udid
     * @return array, returns array with status key, error description in case of failure
     */
	public function userLogin($username, $password, $udid)
	{
		//encrypt password
		$password = base64_encode($password);
		
		$result = $this -> db -> query (
                        "SELECT
                            id,
                            user_type,
                            expiry
                        FROM
                            " . TBL_USERS . ' ' . "WHERE 
                            username='" . $username . "' 
                            AND password='" . $password . "' 
                            AND status != 2"
                            );
                            $return = array();

                            if ($result->num_rows > 0  ) {

                            	/* fetch associative array */
                            	$row = $result->fetch_assoc();
                            	if(strtotime($row['expiry']) > strtotime(date('Y-m-d H:i:s')) || $row['user_type'] == 'SUPER USER')
                            	$return = array ("id" => $row['id'],"usertype"=> $row['user_type'],"expiry"=> $row['expiry'],"name"=>'User Logged In Successsfully' );
                            	else
                            	$return = array ("id" => $row['id'],"usertype"=> 'Expired',"expiry"=> $row['expiry']);
                            	/* free result set */
                            	$result->free();
                            	return $return;
                            } else {
                            	$return = array ("id" => '0',"name"   => 'Invalid User');
                            	return $return;
                            }
	}
    
	/**
     * Creates a unique auth key for the user
     * @param int $id, userid
     * @param string $udid, udid of the device
     * @return string, unqiue auth key of the user
     */
	public function generateUserKey($id,$udid) {

		do
		{
			$uniquekey = md5(rand().$udid);
		}while($this->checkAuthKey($uniquekey));

		$query = 'UPDATE
                    		users 
                    	SET 
                    		userkey = "'.$uniquekey.'" WHERE id = "'.(int)$id.'"';
		$this -> db -> query($query);
		return  $uniquekey;
	}
	//End
    
	/**
     * Changes password of the user.
     * @param stdObj $inputObj
     * @return array, returns array with status key, error description in case of failure 
     */
	public function changePassword($inputObj) {
		
		$inputObj->newpassword = base64_encode($inputObj->newpassword);
		
		$query = 'UPDATE
                    		users 
                    	SET 
                    		password = "'.$inputObj->newpassword.'" WHERE userkey = "'.$inputObj->auth.'" '; 
		if($this -> db -> query($query)) {
			if($this -> db -> affected_rows > 0) {
				return  array('status' => 'OK');
			} else {
				return  array('status' => 'error','error' => 'Data Not Updated.');
			}
		} else {
			return  array('status' => 'error', 'error' => 'Unable to update password.');
		}
		 
	}
    
	/**
     * Checks for valid password and authkey of a user
     * @param string $udid
     * @param string $auth
     * @param string $oldpassword
     * @return bool
     */
	public function passwordValidity($udid,$auth,$oldpassword)
	{
		$oldpassword = base64_encode($oldpassword);
		$query = '	SELECT
            				u.id 
            			FROM 
            				 users u
            			WHERE 
            				u.userkey = "'.$auth.'" 
            			AND 
            				u.password = "'.$oldpassword.'"'; 
		$result = $this->db->query ($query);
		return  ($result->num_rows > 0)?true:false;

	}


    /**
     * Returns the list of users in a group
     * @param stdObj $data, user supplied groupid
     * @return array
     */
	public function loadGroupUsersList($data)
	{
		$result = $this -> db -> query (
                        "SELECT image_data,username,first_name
                        FROM
                            " .TBL_USERS.' '."WHERE 
							id 
							IN 
								(
								select 
									user_id 
								from 
									group_users 
								where 
									group_id=".(int)$data->groupid." AND status='APPROVED'
								) 
							OR id = (SELECT group_owner FROM groups WHERE groups.id = ".(int)$data->groupid.")"
							);

							$return = array();

							if ($result->num_rows > 0) {

								/* fetch associative array */
								while ($row = $result->fetch_assoc()) {
									$return['users']['user'][]['nodes'] = array (
                                       "imagedata"  => $row['image_data'], 
                                       "username"  => $row['username'],
									   "firstname"  => $row['first_name']
									);
								}

								/* free result set */
								$result->free();
							}
							else
							$return['users'] = '';

							return $return;
	}

    /**
     * Returns distinct usernames available
     * @param string $username
     * @param string $userkey
     * @return array
     */
	public function loadMsgAutoSuggestUsername($username, $userkey)
	{
		$result = $this -> db -> query (
                        "SELECT
                            DISTINCT u.username, u.id
                        FROM
                            " .TBL_USERS ." u "
                            );
                             
                            $return = array();

                            if ($result ) {

                            	/* fetch associative array */
                            	while ($row = $result->fetch_assoc()) {
                            		$return[] = array ("name" => $row['username'],
                            		);
                            	}

                            	/* free result set */
                            	$result->free();
                            }
                            return $return;
	}
    
	/**
     * Returns distinct group names of user
     * @param string $username
     * @param string $userkey
     * @return array
     */
	public function loadMsgAutoSuggestGroupname($username, $userkey)
	{
		$result = $this -> db -> query (
                        "SELECT
                            DISTINCT g.group_name, g.id
                        FROM
                            " .TBL_GROUPS ." g, " . self::TBL_GROUPS_USERS . " gu
                        WHERE gu.group_id in(SELECT group_id FROM " . self::TBL_GROUPS_USERS . " 
                        WHERE user_id IN (SELECT id FROM " . TBL_USERS . " WHERE userkey 
                        = '" . $userkey . "')) AND gu.group_id = g.id "
                        );
                         
                        $return = array();

                        if ($result ) {

                        	// fetch associative array
                        	while ($row = $result->fetch_assoc()) {
                        		$return[] = array ("name" => $row['group_name'],
                        		);
                        	}

                        	// free result set
                        	$result->free();
                        }
                        return $return;
	}


    /**
     * Deletes a user.
     * This privilege is available only to SUPER USER
     * @param stdObj $inputObj
     * @return array, returns array with status key, error description in case of failure
     */
	public function deleteUser($inputObj)
	{

		if($this->getUserType($inputObj->userkey) == 'SUPER USER')
		{
			$query = 'UPDATE
                    		users 
                    	SET 
                    		status = 2 WHERE username = "'.$inputObj->userid.'" LIMIT 1'; 
			if($this -> db -> query($query)) {
				if($this -> db -> affected_rows > 0) {
					return  array('status' => 'OK','message'=>'User deleted successfully.');
				} else {
					return  array('status' => 'error','error' => 'Unable to delete.');
				}
			} else {
				return  array('status' => 'error', 'error' => 'Unable to delete.');
			}
		}
		else
		{
			return  array('status' => 'error', 'error' => 'Access denied.');
		}
	}
    
	/**
     * Checks whether a username exists or not
     * @param string $username
     * @return boolean, returns true if exists else false
     */
	public function usernameExists($username)
	{
		$query = '	SELECT
        					* 
        				FROM
        					users
        				WHERE
        					username = "' . $username . '"	';

		$result = $this->db->query($query);
		 
		return ($result->num_rows > 0)?true:false;
	}


	/**
     * Checks for existing email and returns password
     * @param string $email
     * @return false|string, if email exists returns password, else false
     */
	public function checkEmail($email) {
		$result = $this -> db -> query ("
                              SELECT
                                password
                              FROM
                                " . TBL_USERS . "
                              WHERE
                                username = '" . $email . "'
                              LIMIT 1
                                ");

		if ( !$result or $result -> num_rows < 1) return false;

		$row = $result -> fetch_assoc();

		return $row['password'];

	}
    
	/**
     * Checks for existing user based on user auth key
     * @param string $userauthkey
     * @return int|false, if user is existing returns user id else false
     */
	public function checkUser($userauthkey) {
		$result = $this -> db -> query ("
                              SELECT
                                id
                              FROM
                                " . TBL_USERS . "
                              WHERE
                                userkey = '" . $userauthkey . "'
                                ");  
		if ( !$result or $result->num_rows < 1) return false;
		$row = $result -> fetch_assoc();
		return $row['id'];

	}

	/**
     * Checks for existing user auth key
     * @param string $userkey
     * @return boolean
     */
	public function checkAuthKey($userkey)
	{
		$result = $this -> db -> query (
	                        "SELECT
	                            *
	                        FROM
	                            " .TBL_USERS ."
	                        WHERE
	                            userkey = '".$this->db->real_escape_string($userkey)."'"
	                            );

	                            $return = array();
	                             
	                            if ($result->num_rows > 0 ) {
	                            	$result->free();
	                            	return true;
	                            	 
	                            	 
	                            } else {
	                            	$result->free();
	                            	return false;
	                            	 
	                            }
	                             
	}

	/**
     * Checks inapp purchase receipt with itunes, and returns whether the transaction if successful or not.
     * @param string $authkey
     * @param string $receiptid
     * @param string $secretkey
     * @return array, returns array with status key, error description in case of failure
     */
	public function inAppPurchase($authkey, $receiptid, $secretkey)
	{
		$receipt = json_encode(array('receipt-data' => "$receiptid",'password' => INAPP_PASSWORD));
		$url = INAPP_HIT_URL;
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $url);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_handle, CURLOPT_HEADER, 0);
		curl_setopt($curl_handle, CURLOPT_POST, true);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $receipt);

		$response_json = curl_exec($curl_handle);
		curl_close($curl_handle);

//"product_id":"com.heartweb.heartwebapp.6months", 

		$response = json_decode($response_json);
		$status = $response['status'];
			
		
		$return = array();
		if ($status == '0') {
			//$expiry = $response->latest_receipt_info->expires_date_formatted;
			
			$expiry = $response['receipt']['original_purchase_date_pst'];
			$expiry = substr($expiry,0,19);

			if($response['receipt']['product_id'] =="au.com.artreach.heartweb.6months" || $response['receipt']['product_id']=='com.heartweb.heartwebapp.6months')
				$expiry = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s", strtotime($expiry)) . " +6 month"));
			else if($response['receipt']['product_id'] =="au.com.artreach.heartweb.12months" || $response['receipt']['product_id']=='com.heartweb.heartwebapp.12months')
				$expiry = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s", strtotime($expiry)) . " +12 month"));
			//else
			//		return  array('status' => 'error','error' => 'Unable to update.');
	

		//	$transacionid = $response->latest_receipt_info->original_transaction_id;
			$transacionid = $response['receipt']['original_transaction_id'];

		   	$query = "UPDATE
                    		users 
                    	SET 
                    		user_type = 'PAID USER', expiry = '$expiry' WHERE userkey = '$authkey'"; 

			if($this->db->query($query)) {
				if($this->db->affected_rows > 0) {
					return  array('status' => 'OK','message'=>'User data updated successfully.','usertype' => 'PAID USER', 'expiry' => $expiry);
				} else {
					return  array('status' => 'error','error' => 'Unable to update.');
				}
			} else {
			
				return  array('status' => 'error', 'error' => 'Invalid User.');
			}

			$return = array("expiry" => $expiry,"transacionid" => $transacionid);
			return $return;
		} else {
			$result = $this -> db -> query (
	                        "SELECT
	                            *
	                        FROM
	                            inapp_error_codes
	                        WHERE
	                            status = '".$status."'"
	                            );
	                            $row = $result -> fetch_assoc();
	                            $return = array ('status' => 'error', 'error' => $row['error_message']);
	                            return $return;
		}
	}

}
