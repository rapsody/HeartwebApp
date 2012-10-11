<?php
include_once('Common.class.php');
	class Subscription_Model extends Common_Model{
		
		
		public $db;
		public $db_user;
		
		const TABLE = "subscription_types";
		
		public function __construct() {
			global $db;
			global $db_user;
			
			$this -> db =& $db;
			$this -> db_user =& $db_user;
		}
		/**
         * Returns all active subscriptions as array
         * @return array
         */
		public function loadSubscriptions() {
			$result = $this -> db -> query (
						"SELECT
							*
						FROM
							" . self::TABLE . "
						WHERE
							status = '1'"
						);
						
			$return = array();
				
			if ($result ) {
				/* fetch associative array */
				while ($row = $result->fetch_assoc()) {
					$temp = array();
					$temp['label_text'] = 'Subscribe for '.$row['subscription_duration'].' Months';
					$temp['button_text'] = '$ '.number_format($row['subscription_amount'],2);
					$temp['amount'] = $row['subscription_amount'];
					$temp['duration'] = $row['subscription_duration'];
					$return['subscriptions']['subscription'][]['nodes'] = $temp;
				}
				/* free result set */
				$result->free();
			}
			return $return;
		}
		/**
         * Get subscription expiry of a user
         * @param StdObj $inputObj
         * @return array
         */
		public function loadSubscriptionExpiry($inputObj) {
			
			if(!isset($inputObj->userkey) || $inputObj->userkey == '')
			return array('status' => 'error', 'error' => 'Authentication Failed.');
			
			$result = $this -> db -> query (
						"SELECT
							*
						FROM
							users
						WHERE
							userkey = '".$inputObj->userkey."'"
						);
						
			$return = array();
				
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
					$temp = array();
					 
					if(strtotime($row['expiry']) > strtotime(date('Y-m-d H:i:s')))
					$temp = array('status' => 'OK', 'expiry' => $row['expiry'],'message' => 'You are subscribed until '.date('d F Y',strtotime($row['expiry'])));
					else
					$temp = array('status' => 'OK', 'message' => 'Your subscription expired on '.date('d F Y',strtotime($row['expiry'])));
					$result->free();
			}
			else
			$temp = array('status' => 'error', 'error' => 'Authentication Failed.');
			return $temp;
		}
			/**
         * Get subscription expiry of a user
         * @param StdObj $inputObj
         * @return array
         */
		public function loadSubscriptionMultipleExpiry() {
			
		
			$expirdate = date("Y-m-d", time()+302400);

			$result = $this -> db -> query (
						"SELECT
							*
						FROM
							users
						WHERE
							DATE_FORMAT(expiry, '%Y-%m-%d') <= '".$expirdate."'"
						);

			if ($result->num_rows > 0) {
				$temp = array();
				while($row = $result->fetch_assoc()){
					array_push($temp, array("username" =>$row['username'], "expiry" =>$row['expiry']));
				}
			//	$temp = $result->fetch_assoc();
			//		$result->free();
			}
			else
			$temp = 'empty';
			return $temp;
		}
		/**
         * Extends a subscription for a user by days days.
         * @param stdObj $inputObj, has userid, days
         * @return array, has status message, error description in case of failure.
         */
		public function addAdditionalSubscription($inputObj)
		{
		if($this->getUserType($inputObj->userkey) == 'SUPER USER')
			{
				$query = 'UPDATE  
                    		users 
                    	SET 
                    		expiry = date_add(expiry, INTERVAL '.(int)$inputObj->days.' DAY)
                    	WHERE id = "'.(int)$inputObj->userid.'" LIMIT 1'; 
	            if($this -> db -> query($query)) {
	            	if($this -> db -> affected_rows > 0) {
	            		return  array('status' => 'OK','message'=>'User subscription updated successfully.');
	            	} else {
	            		return  array('status' => 'error','error' => 'Unable to update.');
	            	}
	            } else {
	            	return  array('status' => 'error', 'error' => 'Unable to update.');	
	            }
			}
			else
			{
				return  array('status' => 'error', 'error' => 'Access denied.');
			}
		}
	}// end fn: Subscription
