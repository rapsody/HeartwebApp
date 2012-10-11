<?php
include_once('Common.class.php');
    class Groups_Model extends Common_Model{
        
        public $db;
        
        public function __construct() {
            global $db;
            
            $this -> db =& $db;
        }
        
        public function loadUserGroups($userkey,$limit='') {

        	if(count($this->checkUserExistence($userkey)) == 0)
		    return array('status' => 'error', 'message' => 'Authentication Failed');
		   
        	$qry = "SELECT DISTINCT
                        	g.id as groupid, 
                        	g.group_name,
                        	g.group_subject,
                        	g.group_owner_faculty,
							(SELECT affiliation_name FROM affiliations WHERE affiliation_id = g.affiliation) as affiliation,                        	
                        	g.group_location,
                        	g.image_data,
                        	groupowner.username as group_owner
                        FROM 
                        	groups g, 
                        	group_users gu,
                        	users u,
                        	users groupowner
                        WHERE
                        (
	                        (	u.id = gu.user_id
	                        AND
	                        	gu.group_id = g.id
	                        AND
	                        	gu.status = 'APPROVED'
	                        ) 
                        OR
                        	g.group_owner = u.id
                        )
                        AND
                        	u.userkey = '".$this->db->real_escape_string($userkey)."'
                        AND
                        	groupowner.id = g.group_owner"
                        
                        .((is_numeric($limit))?' ORDER BY date_responded DESC LIMIT '.(int)$limit:'');	
                        
        	
        	$result = $this -> db -> query ($qry);
                        
            $return = array();
            
            if ($result->num_rows > 0) {

                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                	
                	
                	$msgqry = "SELECT 
                        *
                        FROM 
                        	messages m, 
                        	messages_to mt
                        WHERE
                        	m.id = mt.message_id
                        AND
                        	mt.type='GROUP'
                        AND
                        	mt.to = '".$row['groupid']."'
                        ORDER BY mt.id DESC LIMIT 1";	
                        
        	
        				$messagesresult = $this -> db -> query ($msgqry);
                        if($messagesresult->num_rows > 0)
                        {
                        $messagedata = $messagesresult->fetch_assoc();	
                        $message = array('subject' => $messagedata['message_subject'], 'body' => $messagedata['message_body']);
                        }
                        else
                        $message = array('subject' => '', 'body' => '');
                        
                    $return['groups']['group'][]['nodes'] = array ( 
                    "groupid"    => $row['groupid'],
                    "groupname"    => $row['group_name'],
                    "groupsubject" => $row['group_subject'],
                    "groupowner"   => $row['group_owner'],
                    "affiliation"   => $row['affiliation'],
                    "groupfaculty" => $row['group_owner_faculty'],
                    "grouplocation"=> $row['group_location'],
                    "groupimage"   => $row['image_data'],
                    "messagesubject"     => $message['subject'],
                    "messagebody"     => $message['body']
                    );
                }
                /* free result set */
                $result->free();
            }
            else
             $return['groups'] = '';
            
            return $return;
        }
        
        public function getGroupDetails($groupid) {

        	$qry = "SELECT 
                        	g.id as groupid, 
                        	g.group_name,
                        	g.group_subject,
                        	(SELECT username FROM users WHERE id = g.group_owner) as groupowner,
							(SELECT first_name FROM users WHERE id = g.group_owner) as groupowner_firstname,
                        	(SELECT affiliation_name FROM affiliations WHERE affiliation_id = g.affiliation) as affiliation,
                        	g.group_location,
                        	g.group_image,
                        	g.image_data
                        FROM 
                        	groups g
                        WHERE
                        	g.id = '".$this->db->real_escape_string($groupid)."'";	
                        
        	
        	$result = $this -> db -> query ($qry);
                        
            $return = array();
            
            if ($result->num_rows > 0) {

                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                    $return['group'] = array (
                     "groupid"    => $row['groupid'],
                    "groupname"    => $row['group_name'],
                    "groupsubject" => $row['group_subject'],
                    "grouplocation"=> $row['group_location'],
                    "groupimage"   => $row['group_image'],
                    "imagedata"   => $row['image_data'],
                    "affiliation"=> $row['affiliation'],
                    "groupowner"   => $row['groupowner'],
					"groupowner_firstname"   => $row['groupowner_firstname']
                    );
                }
                /* free result set */
                $result->free();
            }
            else
             $return['group'] = '';
            
            return $return;
        }
        
      // Search Group 
        public function searchGroups($data)
         {
        	$userdata = $this->checkUserExistence($data->userkey);
        	 
        	if(count($userdata) > 0)
        	{
        		if($data->mode == 'alphabetical')
        		$subqry = 'AND g.group_name LIKE \''.$data->searchkey.'%\'';
        		else if($data->mode == 'pattern')//pattern
        		$subqry = 'AND g.group_name LIKE \'%'.$data->searchkey.'%\'';
        		
        		$start = (isset($this->page) && $this->page > 0)?((int)$this->page - 1)*10:0;
        		
					 $qry = "SELECT 
		        	 				g.id as groupid, 
		        	 				g.group_name, 
		        	 				g.group_subject, 
		        	 				(SELECT username FROM users WHERE id = g.group_owner) as groupowner,
                        			(SELECT affiliation_name FROM affiliations WHERE affiliation_id = g.affiliation) as affiliation,
		        	 				g.group_image,
		        	 				g.image_data
		            		FROM 
			            			groups g
			            	WHERE 
			            			g.privacy = 'public' " 
					 . $subqry ;  
					 
        	$numrows = $this -> db -> query ($qry);
			$totalcount = $numrows->num_rows;		 
                        
            if($data->mode != 'alphabetical')         
            $qry .=   " LIMIT ".$start." , 10";       
        	$result = $this -> db -> query ($qry);
                        
            $return = array();
            
            if ($result->num_rows > 0) {

                /* fetch associative array */
                while ($row = $result->fetch_assoc()) {
                	
                	
                	$msgqry = "SELECT 
                        *
                        FROM 
                        	messages m, 
                        	messages_to mt
                        WHERE
                        	m.id = mt.message_id
                        AND
                        	mt.type='GROUP'
                        AND
                        	mt.to = '".$row['groupid']."'
                        ORDER BY mt.id DESC LIMIT 1";	
                        
        	
        				$messagesresult = $this -> db -> query ($msgqry);
                        if($messagesresult->num_rows > 0)
                        {
                        $messagedata = $messagesresult->fetch_assoc();	
                        $message = array('subject' => $messagedata['message_subject'], 'body' => $messagedata['message_body']);
                        }
                        else
                        $message = array('subject' => '', 'body' => '');
                        
                    $return['groups']['group'][]['nodes'] = array (
                     "groupid"    => $row['groupid'],
                    "groupname"    => $row['group_name'],
                    "groupsubject" => $row['group_subject'],
                    "groupimage"   => $row['group_image'],
                    "imagedata"   => $row['image_data'],
                    "groupowner"   => $row['groupowner'],
                    "affiliation"   => $row['affiliation'],
                    "messagesubject"     => $message['subject'],
                    "messagebody"     => $message['body']
                    );
                }
                /* free result set */
                $return['count'] = $totalcount;
                $result->free();
            }
            else
             $return['groups'] = '';
            
            return $return;
        	 	
        	 }
        	 else
        	 {
        	 	return  array ("status" => 'error',"message"   => 'Authentication Failed');  
        	 }
        	 
        	
        	
            
        }
        
          // Latest Public groups.
    	public function getLatestGroups()
        {
        	$selectQuery = 'SELECT 
        						g.id,g.group_name,g.group_subject,g.image_data
            				FROM 
					            groups g
            				WHERE 
            					g.privacy = "public"
            				ORDER BY id DESC
            				LIMIT 10';

            $result = $this -> db -> query ($selectQuery);

            if($result->num_rows > 0)
            {
            	$returnarray = array();
                while($row = $result->fetch_assoc())
                {				
					$msgqry = "SELECT 
                        *
                        FROM 
                        	messages m, 
                        	messages_to mt
                        WHERE
                        	m.id = mt.message_id
                        AND
                        	mt.type='GROUP'
                        AND
                        	mt.to = '".$row['id']."'
                        ORDER BY mt.id DESC LIMIT 1";	
                        
        	
        				$messagesresult = $this -> db -> query ($msgqry);
                        if($messagesresult->num_rows > 0)
                        {
                        $messagedata = $messagesresult->fetch_assoc();	
                        $message = array('subject' => $messagedata['message_subject'], 'body' => $messagedata['message_body']);
                        }
                        else
                        $message = array('subject' => '', 'body' => '');
						
                	$group['id'] = $row['id'];  	
                	$group['groupname'] = $row['group_name'];
                	$group['subject'] = $row['group_subject'];
					$group['imagedata'] = $row['image_data'];
					$group['messagesubject'] = $message['subject'];
                    $group['messagebody'] = $message['body'];
                	$returnarray['groups']['group'][]['nodes'] = $group;
                }
                return $returnarray;
            }
            else
            {
            return  array ("status" => 'error',"error"   => 'No new groups available.');
            }
        }
        
        // User groups.
        public function getMyGroups($data)
        {
        	 $userdata = $this->checkUserExistence($data->auth);
        	 
        	 if(count($userdata) > 0)
        	 {
		         	
	        	 	$selectQuery = '	SELECT 
		        	 						g.id,g.group_name,g.group_subject
		            					FROM 
			            					groups g,group_users gu
			            				WHERE 
			            					g.id = gu.group_id
			            				AND
		    	        					gu.user_id = "'.$userdata['id'].'"
		    	        				OR 
		    	        					g.group_owner = "'.$userdata['id'].'"';

		            $result = $this -> db -> query ($selectQuery);
		
		            if($result->num_rows > 0)
		            {
		            	$result = array();
		                while($row = $result->fetch_assoc())
		                {
		                	$group['id'] = $row['id'];  	
		                	$group['groupname'] = $row['group_name'];
		                	$group['subject'] = $row['group_subject'];
		                	$result['groups']['group'][]['nodes'] = $group;	
		                }
		                return $result;
		            }
		            else
		            {
		            return  array ("status" => 'error',"error"   => 'No groups available.');
		            }
        	 }
        	 else
        	 {
        	 	return  array ("status" => 'error',"error"   => 'Authentication Failed');  
        	 }
        	 
        	
        	
            
        }
        
        
        
        public function createUserGroup($data) 
		{
      		$row = $this->checkUserExistence($data->auth);
        	 
        	 if(count($row) > 0)
        	 {
                 
                $query = 'INSERT INTO groups (
                            group_name,
                            group_subject,
                            group_owner,
                            group_owner_faculty,
                            group_location,
                            group_image,
                            image_data,
                            affiliation,
                            messageboard,
                            privacy,
                            date_added,
                            status
                            )
                    VALUES ("'
                            .$this->db->real_escape_string($data->groupname).'","'
                            .$this->db->real_escape_string($data->groupsubject).'","'
                            .$this->db->real_escape_string($row['id']).'","'
                            .$this->db->real_escape_string($row['faculty']).'","'
                            .$this->db->real_escape_string($data->grouplocation).'","'
                            .$this->db->real_escape_string($data->groupimage).'","'
                            .$this->db->real_escape_string($data->imagedata).'","'
                            .$this->db->real_escape_string($data->affiliation).'","'
                            .$this->db->real_escape_string($data->messageboard).'","'
                            .$this->db->real_escape_string($data->groupprivate).'","'
                            .date('Y-m-d H:i:s').'","'
                            .'1'.'"
                            )';
                            
                $result = $this -> db -> query ($query);
                
                if ($result ) {
                    return  array ("id" => $this->db->insert_id,"name"   => 'Group Added Successfully');
                } else {
                    return  array ("id" => '0',"name"   => 'Error while adding group');
                }
            }
            else
            {
                return  array ("id" => '0',"name"   => 'Authentication Failed');    
            }
        }
        
        public function checkGroupExistence($group)
        {
            $selectQuery = 'SELECT * 
            FROM 
                groups 
            WHERE 
                group_name = "'.trim($group).'"';

            $result = $this -> db -> query ($selectQuery);

            return ($result->num_rows > 0)?true:false;
        }

        // Request to join in a group.
        public function groupJoin($data)
        {
        	$row = $this->checkUserExistence($data->auth);
        	 
        	 if(count($row) > 0)
        	 {
                $select = '	SELECT * 
                			FROM 
                				group_users 
                			WHERE 
                				group_id = "'.$this->db->real_escape_string($data->groupid).'"
                			AND
                				user_id = "'.$this->db->real_escape_string($row['id']).'"';
                $getinfo = $this -> db -> query ($select);
                if($getinfo->num_rows > 0)
                {
                 return  array ("status" => 'error',"error"   => 'You are either a member or already requested this group.');    
                }
                else
                {
                	$query = '	INSERT 
                			INTO 
                				group_users 
                			SET
                            	group_id = "'.$this->db->real_escape_string($data->groupid).'",
                            	user_id = "'.$this->db->real_escape_string($row['id']).'",
                            	date_requested = "'.date('Y-m-d H:i:s').'",
                            	status = "PENDING"
                            ';
                    $result = $this -> db -> query ($query);
	                
	                if ($result ) {
	                    return  array ("status" => 'OK',"error"   => 'Request Sent Successfully.');
	                } else {
	                    return  array ("status" => 'error',"error"   => 'Error while processing your request.');
	                }
                }
            }
            else
            {
                return  array ("status" => 'error',"error"   => 'Authentication Failed');    
            }
        	
        }
        
        // Request to unjoin from a group.
    	public function groupUnjoin($data)
        {
        	 $row = $this->checkUserExistence($data->auth);
        	 
        	 if(count($row) > 0)
        	 {
                $select = '	SELECT * 
                			FROM 
                				group_users 
                			WHERE 
                				group_id = "'.$this->db->real_escape_string($data->groupid).'"
                			AND
                				user_id = "'.$this->db->real_escape_string($row['id']).'"';
                $getinfo = $this -> db -> query ($select);
                if($getinfo->num_rows > 0)
                {
                	$query = '	DELETE 
                			FROM 
                				group_users 
                			WHERE
                            	group_id = "'.$this->db->real_escape_string($data->groupid).'"
                            AND	
                            	user_id = "'.$this->db->real_escape_string($row['id']).'"
                            LIMIT 1	
                            ';
                    $result = $this -> db -> query ($query);
	                
	                if ($result ) {
	                    return  array ("status" => 'OK',"error"   => '');
	                } else {
	                    return  array ("status" => 'error',"error"   => 'Error while processing your request.');
	                }
                }
                else
                {
                 return  array ("status" => 'error',"error"   => 'You are not a member of this group to unjoin.');
                }
            }
            else
            {
                return  array ("status" => 'error',"error"   => 'Authentication Failed');    
            }
        	
        }
        
        // To approve user in a group.
        public function groupApprove($data)
        {
                    $selectQuery = '	SELECT 
          						u.id
            				FROM 
 	 			          		users u, groups g 
            				WHERE 
            					g.group_owner = u.id
            				AND
								g.id = "' . $this->db->real_escape_string($data->groupid) . '"
            				AND
            					u.userkey = "'. $this->db->real_escape_string($data->auth) .'"';


            $result = $this -> db -> query ($selectQuery);

            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                 
                $select = '	SELECT * 
                			FROM 
                				group_users 
                			WHERE 
                				group_id = "'.$this->db->real_escape_string($data->groupid).'"
                			AND
                				user_id = "'.$this->db->real_escape_string($data->userid).'"';
                $getinfo = $this -> db -> query ($select);
                if($getinfo->num_rows > 0)
                {
                	$query = '	UPDATE
                					group_users 
                				SET
                            		date_responded = "'.date('Y-m-d H:i:s').'",
                            		status = "APPROVED"
                            	WHERE	
									group_id = "'.$this->db->real_escape_string($data->groupid).'" 
								AND
                            		user_id = "'.$this->db->real_escape_string($data->userid).'"	                            		
                            ';
                    $result = $this -> db -> query ($query);
	                
	                if ($result ) {
	                    return  array ("status" => 'OK',"error"   => 'Approved.');
	                } else {
	                    return  array ("status" => 'error',"error"   => 'Error while Processing.');
	                }
                	
                 }
                else
                {
                return  array ("status" => 'error',"error"   => 'Invalid Request.');    	
                }
            }
            else
            {
                return  array ("status" => 'error',"error"   => 'Authentication Failed');    
            }
        	
        }
        
        // To reject user in a group.
    	public function groupReject($data)
        {
        	$selectQuery = 'SELECT 
          						u.id
            				FROM 
 	 			          		users u,  groups g 
            				WHERE 
            					g.group_owner = u.id
            				AND
								g.id = "' . $this->db->real_escape_string($data->groupid) . '"
            				AND
            					u.userkey = "'. $this->db->real_escape_string($data->auth) .'"';

            $result = $this -> db -> query ($selectQuery);

            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                 
                $select = '	SELECT * 
                			FROM 
                				group_users 
                			WHERE 
                				group_id = "'.$this->db->real_escape_string($data->groupid).'"
                			AND
                				user_id = "'.$this->db->real_escape_string($data->userid).'"';
                $getinfo = $this -> db -> query ($select);
                if($getinfo->num_rows > 0)
                {
                	$query = '	UPDATE
                					group_users 
                				SET
                            		date_responded = "'.date('Y-m-d H:i:s').'",
                            		status = "REJECTED"
                            	WHERE	
									group_id = "'.$this->db->real_escape_string($data->groupid).'" 
								AND
                            		user_id = "'.$this->db->real_escape_string($data->userid).'"	                            		
                            ';
                    $result = $this -> db -> query ($query);
	                
	                if ($result ) {
	                    return  array ("status" => 'OK',"error"   => 'Rejected.');
	                } else {
	                    return  array ("status" => 'error',"error"   => 'Error while Processing.');
	                }
                 }
                else
                {
                	return  array ("status" => 'error',"error"   => 'Invalid Action.');    	
                }
            }
            else
            {
                return  array ("status" => 'error',"error"   => 'Authentication Failed');    
            }
        }
        
              
        // User Request awaiting for approval.
        public function getGroupRequestStatus($data)
        {
        	 $userdata = $this->checkUserExistence($data->auth);
        	 
        	 if(count($userdata) > 0)
        	 {
	        	 	$select = 'SELECT
	        	 					g.group_name,
	        	 					gu.date_requested,
	        	 					gu.date_responded,
	        	 					gu.status,
	        	 					u.first_name,
	        	 					u.last_name,
									u.image_data,
									u.username
	        	 				FROM
	        	 					groups g,
	        	 					group_users gu,
	        	 					users u
	        	 				WHERE
	        	 					g.id = gu.group_id
	        	 				AND
	        	 					gu.user_id = u.id
	        	 				AND
	        	 					gu.user_id = "'.$userdata['id'].'"';
	        	 	
	        	 	$result = $this -> db -> query ($select);
	        	 	if($result->num_rows > 0)
	        	 	{
	        	 		$returnarray = array(); 
	        	 		while($row = $result->fetch_assoc())
	        	 		{
	        	 			$temp = array();
	        	 			$temp['groupname'] = $row['group_name'];
	        	 			$temp['requesteddate'] = $row['date_requested'];
	        	 			$temp['respondeddate'] = $row['date_responded'];
	        	 			$temp['username'] = $row['username'];	
	        	 			$temp['imagedata'] = $row['image_data'];	
							
	        	 			
	        	 			if($row['status'] == 'PENDING'){

	        	 				$returnarray['requests']['pending']['request'][]['nodes'] = $temp;		 
	        	 				
	        	 			} else if ($row['status'] == 'APPROVED') {

	        	 				$returnarray['requests']['approved']['request'][]['nodes'] = $temp;		 
	        	 				
	        	 			} else if ($row['status'] == 'REJECTED'){
	        	 				
	        	 				$returnarray['requests']['rejected']['request'][]['nodes'] = $temp;		 
	        	 				
	        	 			}
	        	 			
	        	 		}
	        	 		return $returnarray;
	        	 	}
	        	 	else
	        	 	{
	        	 	return  array ("status" => 'error',"error"   => 'Data not available');  
	        	 	}
	        	 	
        	 }
        	 else
        	 {
        	 	return  array ("status" => 'error',"error"   => 'Authentication Failed');  
        	 }	 	
        }
        
		public function getPendingPublicRequests($data)
        {
        	$userdata = $this->checkUserExistence($data->userkey);
        	
        	if(!isset($data->limit))$data->limit = 3; 
        	
        	if(count($userdata) > 0)
        	 {
	        	 	$select = 'SELECT
	        	 					g.id as groupid,
	        	 					g.group_name,
	        	 					gu.date_requested,
	        	 					gu.date_responded,
	        	 					gu.status,
	        	 					u.first_name,
	        	 					u.last_name,
									u.username,
									u.image_data,
	        	 					u.id as userid
	        	 				FROM
	        	 					groups g,
	        	 					group_users gu,
	        	 					users u
	        	 				WHERE
	        	 					g.id = gu.group_id
	        	 				AND
	        	 					gu.user_id = u.id
	        	 				AND
	        	 					gu.status = \'PENDING\'	
	        	 				AND
	        	 					g.group_owner = "'.$userdata['id'].'"';
	        	 	$select = $select.' LIMIT '.(int)$data->limit;
	        	 	
	        	 	$result = $this -> db -> query ($select);
	        	 	if($result->num_rows > 0)
	        	 	{
	        	 		$returnarray = array(); 
	        	 		while($row = $result->fetch_assoc())
	        	 		{
	        	 			$temp = array();
	        	 			$temp['groupname'] = $row['group_name'];
	        	 			$temp['requesteddate'] = $row['date_requested'];
	        	 			$temp['respondeddate'] = $row['date_responded'];
	        	 			$temp['groupid'] = $row['groupid'];	        	 			
	        	 			$temp['userid'] = $row['userid'];	        	 			
	        	 			$temp['username'] = $row['username'];	        	 			
	        	 			$temp['subject'] = 'New Request';
							$temp['imagedata'] = $row['image_data'];
	        	 			
	        	 			if($row['status'] == 'PENDING'){

	        	 				$returnarray['userrequests']['request'][]['nodes'] = $temp;			 

	        	 			} 	        	 			
	        	 		}
	        	 		return $returnarray;
	        	 	}
	        	 	else
	        	 	{
	        	 	return  array ("status" => 'error',"error"   => 'Data not available');  
	        	 	}
	        	 	
        	 }
        	 else
        	 {
        	 	return  array ("status" => 'error',"error"   => 'Authentication Failed');  
        	 }	 	
        
        }
		
        // User Request Approved Groups  
        public function getMyGroupRequestStatus($data)
        {
        	 $userdata = $this->checkUserExistence($data->auth);
        	 if(count($userdata) > 0)
        	 {
	        	 	$select = 'SELECT
	        	 					g.id as groupid,
	        	 					g.group_name,
	        	 					gu.date_requested,
	        	 					gu.date_responded,
	        	 					gu.status,
	        	 					u.first_name,
	        	 					u.last_name,
	        	 					u.id as userid,
									u.username,
									u.image_data
									
	        	 				FROM
	        	 					groups g,
	        	 					group_users gu,
	        	 					users u
	        	 				WHERE
	        	 					g.id = gu.group_id
	        	 				AND
	        	 					gu.user_id = u.id
	        	 				AND
	        	 					g.group_owner = "'.$userdata['id'].'"';
	        	 	
	        	 	$result = $this -> db -> query ($select);
	        	 	if($result->num_rows > 0)
	        	 	{
	        	 		$returnarray = array(); 
	        	 		while($row = $result->fetch_assoc())
	        	 		{
	        	 			$temp = array();
	        	 			$temp['groupname'] = $row['group_name'];
	        	 			$temp['requesteddate'] = $row['date_requested'];
	        	 			$temp['respondeddate'] = $row['date_responded'];
	        	 			$temp['groupid'] = $row['groupid'];	        	 			
	        	 			$temp['userid'] = $row['userid'];	        	 			
	        	 			$temp['username'] = $row['username'];
							$temp['imagedata'] = $row['image_data'];	
	        	 			
	        	 			if($row['status'] == 'PENDING'){

	        	 				$returnarray['requests']['pending']['request'][]['nodes'] = $temp;		 

	        	 			} else if ($row['status'] == 'APPROVED') {

	        	 				$returnarray['requests']['approved']['request'][]['nodes'] = $temp;		 
	        	 				
	        	 			} else if ($row['status'] == 'REJECTED'){
	        	 				
	        	 				$returnarray['requests']['rejected']['request'][]['nodes'] = $temp;		 
	        	 				
	        	 			}
	        	 			
	        	 		}
	        	 		return $returnarray;
	        	 	}
	        	 	else
	        	 	{
	        	 	return  array ("status" => 'error',"error"   => 'Data not available');  
	        	 	}
	        	 	
        	 }
        	 else
        	 {
        	 	return  array ("status" => 'error',"error"   => 'Authentication Failed');  
        	 }	 	
        
        }
        
        // Checks whether user exists with the userkey or not  
        private function checkUserExistence($userkey)
        {
        	$selectQuery = 'SELECT u.id,u.faculty
            FROM 
            	users u
            WHERE 
            	u.userkey = "' . $this->db->real_escape_string($userkey) . '"';	
            
        	$result = $this -> db -> query ($selectQuery);
            
        	return ($result->num_rows > 0)?$result->fetch_assoc():array();
        }

    	public function deleteGroup($inputObj)
		{

			if($this->getUserType($inputObj->userkey) == 'SUPER USER')
			{
				$query = 'DELETE FROM  
                    		groups WHERE
                    	id = "'.(int)$inputObj->groupid.'" LIMIT 1'; 
	            if($this -> db -> query($query)) {
	            	if($this -> db -> affected_rows > 0) {
	            		return  array('status' => 'OK','message'=>'Group deleted successfully.');
	            	} else {
	            		return  array('status' => 'error','error' => 'Unable to delete.');
	            	}
	            } else {
	            	return  array('status' => 'error', 'error' => 'Unable to delete.');	
	            }
			}
			else
			{
				$userdata = $this->checkUserCreatedGroup($inputObj->userkey, $inputObj->groupid);
				if(count($userdata) > 0)
				{
					$query = 'DELETE FROM  
								groups WHERE
							id = "'.(int)$inputObj->groupid.'" LIMIT 1'; 
					if($this -> db -> query($query)) {
						if($this -> db -> affected_rows > 0) {
							return  array('status' => 'OK','message'=>'Group deleted successfully.');
						} else {
							return  array('status' => 'error','error' => 'Unable to delete.');
						}
					} else {
						return  array('status' => 'error', 'error' => 'Unable to delete.');	
					}
				}
				else
					return  array('status' => 'error', 'error' => 'Access denied.');
			}
		}
		
		private function checkUserCreatedGroup($userkey, $groupid)
        {
        	$selectQuery = 'SELECT u.id,u.faculty
            FROM 
            	users u, groups g
            WHERE
				u.id = g.group_owner
			AND
				g.id = '.$groupid.'
			AND
            	u.userkey = "' . $this->db->real_escape_string($userkey) . '"';	
            
        	$result = $this -> db -> query ($selectQuery);
            
        	return ($result->num_rows > 0)?$result->fetch_assoc():array();
        }
	
    }// end fn: Faculites