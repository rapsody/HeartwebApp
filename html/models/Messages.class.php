<?php
include_once('Common.class.php');
class Messages_Model extends Common_Model{

	public $db;

	public function __construct() {
		global $db;

		$this -> db =& $db;
	}

	/**
	 * Retrieves message based on message id, user auth key
	 * @param string $userauth_key
	 * @param int $messageid
	 * @return array
	 */
	public function getMessage($userauth_key,$messageid) {

		$query = "SELECT
           					msg.id ,
                        	fromuser.username as message_from,
							fromuser.image_data as userimage,
                        	msg.message_to ,
                        	msg.message_cc ,
                        	msg.message_subject,
                        	msg.message_body,
							DATE_FORMAT(msg.added_date,'%d/%m/%Y') as date,
							DATE_FORMAT(msg.added_date,'%H:%i') as time 
                        FROM 
                        	messages msg, 
                        	messages_to mto,
                        	users u,
                        	users fromuser
                        WHERE
                        	fromuser.id = msg.message_from
                       	AND
                       		mto.message_id = msg.id
                        AND
                        	(
                        		(	mto.to = u.id 
                        			AND 
                        			mto.type = 'USER'
                        		) 
                        		OR 
                        		(	mto.to IN	(
                        						SELECT 
                        							gu.group_id 
                        						FROM 
                        							group_users gu
                        						WHERE gu.user_id = u.id 
                        						)
                        			AND
                        			mto.type = 'GROUP'
								)
								OR
								msg.message_from = fromuser.id
                        		
                        	)		
                        AND
                        	u.userkey = '".$this->db->real_escape_string($userauth_key)."'
                       	AND
                       		msg.id = ". $messageid ."
                        ";
			
		$result = $this -> db -> query ($query);
		if(isset($result->num_rows) && $result->num_rows > 0)
		{
			$formdata = array();
			while($data = $result->fetch_assoc())
			{
				$formdata['messages']['message'][]['nodes'] = $data;
			}

			$formdata['status'] = 'OK';

			return $formdata;
		}
		else
		{
			return array('status' => 'error', 'message' => 'No Messages Found.');
		}
	}

	/**
	 * Get all messages from the passed last update date.
	 * @param string $userauth_key
	 * @param date $lastupdatedate
	 * @return array
	 */
	public function getMessages($userauth_key,$lastupdatedate) {

		$lastupdatedate = ($lastupdatedate != '')?"'".$lastupdatedate."'":"u.date_registered";

		$query = "SELECT
           					msg.id ,
                        	fromuser.username as message_from,
							fromuser.first_name as message_from_firstname,
							fromuser.image_data as userimage,
                        	msg.message_to ,
                        	msg.message_cc ,
                        	msg.message_subject,
                        	SUBSTRING(msg.message_body,0,50) as message_body,
							DATE_FORMAT(msg.added_date,'%d/%m/%Y') as date,
							DATE_FORMAT(msg.added_date,'%H:%i') as time
                        FROM 
                        	messages msg, 
                        	messages_to mto,
                        	users u,
                        	users fromuser
                        WHERE
                        	fromuser.id = msg.message_from
                       	AND
                       		mto.message_id = msg.id
                        AND
                        	(
                        		(	mto.to = u.id 
                        			AND 
                        			mto.type = 'USER'
                        		) 
                        		OR 
                        		(	mto.to IN	(
                        						SELECT 
                        							gu.group_id 
                        						FROM 
                        							group_users gu
                        						WHERE gu.user_id = u.id 
                        						)
                        					)
                        			AND
                        			mto.type = 'GROUP'	
                        	)		
                        AND
                        	u.userkey = '".$this->db->real_escape_string($userauth_key)."'
                       	AND
                       		mto.date_added > " . $lastupdatedate ;
			
		$result = $this -> db -> query ($query);
		if(isset($result->num_rows) && $result->num_rows > 0)
		{
			$formdata = array();
			while($data = $result->fetch_assoc())
			{
				$formdata['messages']['message'][]['nodes'] = $data;
			}

			$formdata['status'] = 'OK';

			return $formdata;
		}
		else
		{
			return array('status' => 'error', 'message' => 'No Messages Found.');
		}
	}

	/**
	 * Get all messages from the passed last update date of the group.
	 * @param string $userauth_key
	 * @param int $groupid
	 * @param date $lastupdatedate
	 * @return array
	 */
	public function getGroupMessages($userauth_key,$groupid,$lastupdatedate) {

		$lastupdatedate = ($lastupdatedate != '')?"AND
                       		msg.added_date > '".$lastupdatedate."'":"";

		$query = "SELECT
           					msg.id ,
                        	fromuser.username as message_from,
							fromuser.first_name as message_from_firstname,
							fromuser.image_data as userimage,
                        	msg.message_to ,
                        	msg.message_cc ,
                        	msg.message_subject,
                        	msg.message_body,
							DATE_FORMAT(msg.added_date,'%d/%m/%Y') as date,
							DATE_FORMAT(msg.added_date,'%H:%i') as time
                        FROM 
                        	messages msg, 
                        	messages_to mto,
                        	users fromuser
                        WHERE
                        	fromuser.id = msg.message_from
                       	AND
                       		mto.message_id = msg.id
                       	AND	
        	       			mto.to =	".(int)$groupid."
                        AND
    	                    mto.type = 'GROUP'	
	                   	" . $lastupdatedate ;
			
		$result = $this -> db -> query ($query);
		if(isset($result->num_rows) && $result->num_rows > 0)
		{
			$formdata = array();
			while($data = $result->fetch_assoc())
			{
				$formdata['messages']['message'][]['nodes'] = $data;
			}

			$formdata['status'] = 'OK';

			return $formdata;
		}
		else
		{
			return array('status' => 'error', 'message' => 'No Messages Found.');
		}
	}

	/**
	 * Get all recent 4 messages of the user
	 * @param string $userauth_key
	 * @return array
	 */
	public function getRecentMessages($userauth_key) {


		$query = "SELECT
           					msg.id ,
           					fromuser.first_name as message_from,
							fromuser.image_data as userimage,
                        	msg.message_to ,
                        	msg.message_cc ,
                        	msg.message_subject,
                        	msg. message_body,
							DATE_FORMAT(msg.added_date,'%d/%m/%Y') as date,
							DATE_FORMAT(msg.added_date,'%H:%i') as time
                        FROM 
                        	messages msg, 
                        	messages_to mto,
                        	users u,
                        	users fromuser
                        WHERE
                        	fromuser.id = msg.message_from
                       	AND
                        	mto.message_id = msg.id
                        AND
                        	(
                        		(	
                        			mto.to = u.id 
                        			AND 
                        			mto.type = 'USER'
                        		) 
                        		OR 
                        		(	
                        			mto.to IN	(
                        						SELECT 
                        							gu.group_id 
                        						FROM 
                        							group_users gu
                        						WHERE gu.user_id = u.id 
                        						)
                        			AND
                        			mto.type = 'GROUP'	
                        		)
                        	)		
                        AND
                        	u.userkey = '".$this->db->real_escape_string($userauth_key)."'
                       	AND
                       		mto.date_added > u.date_registered
                       	ORDER BY 
                       		mto.date_added DESC
                       	LIMIT 4";
			
		$result = $this -> db -> query ($query);
		if(isset($result->num_rows) && $result->num_rows > 0)
		{
			$formdata = array();
			while($data = $result->fetch_assoc())
			{
				$formdata['messages']['message'][]['nodes'] = $data;
			}

			return $formdata;
		}
		else
		{
			return array('messages' => '');
		}
	}

	/**
	 * Get all the messages sent by user from last update date, with limit
	 * @param string $userauth_key
	 * @param date $lastupdatedate
	 * @param int $limit, default null, if not passed all records are returned
	 * @return array
	 */
	public function getSentMessages($userauth_key,$lastupdatedate,$limit='') {

		$subQry = ($lastupdatedate == '')?'':" AND msg.added_date > '" . $lastupdatedate . "'";

		$query = "SELECT
           					msg.id ,
                        	msg.message_from ,
							u.first_name as message_from_firstname,
                        	msg.message_to ,
                        	msg.message_cc ,
                        	msg.message_subject,
                        	SUBSTRING(msg.message_body,0,50) as message_body,
							DATE_FORMAT(msg.added_date,'%d/%m/%Y') as date,
							DATE_FORMAT(msg.added_date,'%H:%i') as time
                        FROM 
                        	messages msg, 
                        	users u
                        WHERE
                       		u.id = msg.message_from		
						AND
                        	u.userkey = '".$this->db->real_escape_string($userauth_key)."'
                       	" . $subQry;
		if($limit > 0)
		$query = $query.' LIMIT '.(int)$limit;
		$result = $this -> db -> query ($query);
		if(isset($result->num_rows) && $result->num_rows > 0)
		{
			$formdata = array();
			while($data = $result->fetch_assoc())
			{
				$formdata['messages']['message'][]['nodes'] = $data;
			}

			$formdata['status'] = 'OK';

			return $formdata;
		}
		else
		{
			return array('status' => 'error', 'message' => 'No Messages Found.');
		}
	}

	/**
	 * Deletes a message if the user is SUPER USER
	 * @param stdObj $inputObj
	 * @return array, with status key, error description in case of failure
	 */
	public function deleteMessage($inputObj)
	{

		if($this->getUserType($inputObj->userkey) == 'SUPER USER')
		{
			$query = 'DELETE FROM
                    		messages WHERE
                    	id = "'.(int)$inputObj->messageid.'" LIMIT 1'; 
			if($this -> db -> query($query)) {
				if($this -> db -> affected_rows > 0) {
					return  array('status' => 'OK','message'=>'Message deleted successfully.');
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
	 * Get array of ids mapped to username/group name
	 * @param array $array, array of user ids/group ids
	 * @return array
	 */
	public function getToIds($array)
	{
		$names = array_keys($array);
		$namestring = implode('\',\'',$names);
		$userqry = 'SELECT * FROM users u WHERE username IN (\''.$namestring.'\') AND status != 2';
		$groupqry = 'SELECT * FROM groups g WHERE group_name IN (\''.$namestring.'\')';
		$resultusers = $this -> db -> query ($userqry);
		$resultgroups = $this -> db -> query ($groupqry);
		$names = array();
		if($resultusers-> num_rows > 0)
		while($data = $resultusers->fetch_assoc())
		{
			$names[$data['username']] = $data['id'];
			$type[$data['username']] = 'USER';
		}
		if($resultgroups-> num_rows > 0)
		while($data = $resultgroups->fetch_assoc())
		{
			$names[$data['group_name']] = $data['id'];
			$type[$data['group_name']] = 'GROUP';
		}
		return array('names' => $names, 'types' => $type);
	}

	/**
	 * Sends group message to users/groups
	 * @param stdObj $data, message data
	 * @param array $arraylist, list of receipient details
	 * @return array, with status key, error description in case of failure
	 */
	public function createMessage($data,$arraylist)
	{
		ini_set('display_errors','off');
		$query = 'INSERT
                			INTO 
                				messages 
                			SET
                            	message_from = "' . $this->db->real_escape_string($arraylist['fromuser']) . '",
								message_to = "' . $this->db->real_escape_string($data->to) . '",
								message_cc = "' . $this->db->real_escape_string($data->cc) . '",
								message_subject  = "' . $this->db->real_escape_string($data->subject) . '",
								message_body = "' . $this->db->real_escape_string($data->message) . '",
								added_date = "' . date('Y-m-d H:i:s') . '"';
		$result = $this -> db -> query ($query);

		if ($this -> db -> insert_id > 0) {
			$messageid = $this -> db -> insert_id;
			$messagesent = 0;
			$error = array();

			$email_addresses = '';

			foreach($arraylist['names'] as $name => $val)
			{
				if($val > 0)
				{

					$query = 'INSERT
	                			INTO 
	                				messages_to VALUES(
	                				NULL,
	                				"' . $val . '",
									"' . $arraylist['types'][$name] . '",
									"' . $messageid . '",
									"' . date('Y-m-d H:i:s') . '")';
					$result = $this -> db -> query ($query);
					if($this -> db -> insert_id > 0)
					$messagesent = 1;

					$results = $this -> db -> query("select  username  
						from group_users left join users on  user_id = users.id 
						where group_id = '".$val."'");
				
					while($data = $results->fetch_assoc())
					{
						if(preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $data['username']) ) 
						$email_addresses .= $data['username'].",";
					}

				}
			}
			$username_result = $this -> db -> query("select * from users  where id = '".$arraylist['fromuser']."'");

			$message = '';
			if($messagesent == 1)
			$message = 'Message sent successfully.';
			else
			$message = 'Error occured while sending message.';

			foreach($arraylist['inputlist'] as $name => $val)
			{
				if(!isset($arraylist['names'][$name]))
				$error[] = $name;
			}
			if(isset($error) && count($error) > 0)
			$message = 'Message sending failed to the following Users/Groups.'."\n".implode(',',$error);
			
			$crlf = "\n";
			
			$header = array ('From' => SMTP_USER,
			'To' => RTRIM(",",$email_addresses),
			///'Cc' => $data->cc,
			'Subject' => "iHeartScan message received");

			$text ="Dear ".$username_result['first_name'].",\n\nYou have received a new message on your iHeartScan iPhone App. \n\n Please open the App to read it.\n\nSincerely,\niHeartScan";
			$html = '<html><body>Hi<br />There is a message waiting for you to view on your iHeartCsan iphone application<br><br>Thanks</body></html>';
			$mime = new Mail_mime($crlf);
			$mime->setTXTBody($text);
			$mime->setHTMLBody($html);
			
				
			$email_message = $mime->get();
			$header = $mime->headers($header);
			 
				
			$smtp = Mail::factory('smtp',
			array ('host' => SMTP_HOST,
				 'port' => SMTP_PORT,
				 'auth' => true,
				 'username' => SMTP_USER,
				 'password' => SMTP_PASSWORD));
			$mail = $smtp->send($email_addresses, $header, $email_message);

			if (PEAR::isError($mail)) {
				return array('status' => "Your email wasn't sent, please try again");
			} else {
				return array('status' => "Your email has been sent successfully");
			}
			

		} else {
			return  array ("status" => 'error',"error"   => 'Error while sending message.');
		}
	}

}