<?php

	class Webservices_Writer {
	
	
		private $db; 
		private $model;
		private $modelClass;
		private $xml;
		
		private $formatXMLOutput = true;
		
		public function __construct() {
			// purposefully left blank
		}// end fn: __construct
		
		public function init() {
			$this -> xml = new DOMDocument('1.0', 'utf-8');
			$this -> xml -> formatOutput = $this -> formatXMLOutput;
			$this -> xmlRoot = $this -> xml -> createElement("response");
			$this -> xml -> appendChild ($this -> xmlRoot);
		}// end fn: init
		
		public function getNameXML($array, $root, $item) {
			$rootElement = $this -> xml -> createElement ($root);
		
			foreach ($array as $arrayItem) {
			
				$itemElement = $this -> xml -> createElement ($item);
				
				$itemNodeValue = $this -> xml -> createCDATASection($arrayItem['name']);
				$itemElement -> appendChild ($itemNodeValue);
				$rootElement -> appendChild ($itemElement);
			}
			
			return $rootElement;
		}
		
		public function getIdNameXML($array, $root, $item) {
			$rootElement = $this -> xml -> createElement ($root);
		
			foreach ($array as $arrayItem) {
			
				$itemElement = $this -> xml -> createElement ($item);
				$itemId      = $this -> xml -> createAttribute ("id");
				$itemValue   = $this -> xml -> createTextNode ($arrayItem['id']);
				
				$itemId -> appendChild ($itemValue);
				$itemElement -> appendChild ($itemId);
				$itemNodeValue = $this -> xml -> createCDATASection($arrayItem['name']);
				$itemElement -> appendChild ($itemNodeValue);
				$rootElement -> appendChild ($itemElement);
			}
			
			return $rootElement;
		}
		
	    public function getIdAndNameXML($array, $root, $node1, $node2) {
            $rootElement = $this -> xml -> createElement ($root);
        
            foreach ($array as $arrayItem) {
            
                $itemElement = $this -> xml -> createElement ($node1);
                $itemValue = $this -> xml -> createCDATASection ($arrayItem['id']);
                $itemElement -> appendChild ($itemValue);
                $rootElement -> appendChild ($itemElement);
                $itemElement1 = $this -> xml -> createElement ($node2);
                $itemValue1 = $this -> xml -> createCDATASection ($arrayItem['name']);
                $itemElement1 -> appendChild ($itemValue1);
                $rootElement -> appendChild ($itemElement1);
            }
            
            return $rootElement;
        }
		
        /* user details */
        
        public function getUserProfileAsXML($array)
        {
        
            foreach ($array as $arrayItem) {
                
                $itemElement_1  = $this -> xml -> createElement ('Username');
                $itemValue_1    = $this -> xml -> createCDATASection ($arrayItem['username']);
                $itemElement_1  -> appendChild ($itemValue_1);
                $this -> xmlRoot    -> appendChild ($itemElement_1);
                
                $itemElement_3  = $this -> xml -> createElement ('Firstname');
                $itemValue_3    = $this -> xml -> createCDATASection ($arrayItem['firstname']);
                $itemElement_3  -> appendChild ($itemValue_3);
                $this -> xmlRoot    -> appendChild ($itemElement_3);
                
                $itemElement_4  = $this -> xml -> createElement ('Lastname');
                $itemValue_4    = $this -> xml -> createCDATASection ($arrayItem['lastname']);
                $itemElement_4  -> appendChild ($itemValue_4);
                $this -> xmlRoot    -> appendChild ($itemElement_4);
                
                $itemElement_5  = $this -> xml -> createElement ('Faculty');
                $itemValue_5    = $this -> xml -> createCDATASection ($arrayItem['faculty']);
                $itemElement_5  -> appendChild ($itemValue_5);
                $this -> xmlRoot    -> appendChild ($itemElement_5);
                
                $itemElement_6  = $this -> xml -> createElement ('Speciality');
                $itemValue_6    = $this -> xml -> createCDATASection ($arrayItem['specialty']);
                $itemElement_6  -> appendChild ($itemValue_6);
                $this -> xmlRoot    -> appendChild ($itemElement_6);
                
                $itemElement_7  = $this -> xml -> createElement ('Country');
                $itemValue_7    = $this -> xml -> createCDATASection ($arrayItem['country']);
                $itemElement_7  -> appendChild ($itemValue_7);
                $this -> xmlRoot    -> appendChild ($itemElement_7);
                
                $itemElement_8  = $this -> xml -> createElement ('State');
                $itemValue_8    = $this -> xml -> createCDATASection ($arrayItem['state']);
                $itemElement_8  -> appendChild ($itemValue_8);
                $this -> xmlRoot    -> appendChild ($itemElement_8);
                
                $itemElement_9  = $this -> xml -> createElement ('ImagePath');
                $itemValue_9    = $this -> xml -> createCDATASection ($arrayItem['image']);
                $itemElement_9  -> appendChild ($itemValue_9);
                $this -> xmlRoot    -> appendChild ($itemElement_9);
                
                
            }
            
	            header("Content-type: text/xml");
	            print $this -> xml -> saveXML();
	            exit;
        }
        
        /* End */
        
        
       /* public function errorXML($message = "There is an unknown error") {
            $status = $this -> xml -> createElement("status");
            $statusValue = $this -> xml -> createAttribute ("status");
            $statusValue -> appendChild ($this -> xml -> createTextNode ("Error"));
            
            $status -> appendChild ($statusValue);
            $status -> appendChild ($this -> xml -> createCDATASection($message));
            
            $this -> xmlRoot -> appendChild ($status);
            
            return $status;
        } */
		
		 public function errorXML($message = "There is an unknown error") {
            $status = $this -> xml -> createElement("status");
            $statusValue = $this -> xml -> createTextNode ("error");
            $status -> appendChild($statusValue);
            
            $error = $this -> xml -> createElement("message");
            $messageValue = $this -> xml -> createCDATASection ($message);
            $error ->  appendChild($messageValue);          
            return array($status,$error);
        }
        
		public function successXML() {
            $status = $this -> xml -> createElement("status");
            $statusValue = $this -> xml -> createAttribute ("status");
            $statustxt = $this -> xml -> createTextNode ("OK");
            $headnode = $statusValue->appendChild($statustxt);
            $status->appendChild($headnode);
            $this -> xmlRoot -> appendChild ($status);
            
            return $status;
        }
        
        
        
		public function outputXML($array) {
			foreach ($array as $a) {
				$this -> xmlRoot -> appendChild ($a);
			}
			
			header("Content-type: text/xml");
			print $this -> xml -> saveXML();
			exit;
			
		}
		
	 public function getUsersGroupsAsXML($array, $root) {
            
                $xmls = array();
            foreach ($array as $arrayItem) {
                
                $rootElement  = $this -> xml -> createElement ($root);
                $itemElement  = $this -> xml -> createElement ('groupname');
                $itemValue    = $this -> xml -> createCDATASection ($arrayItem['groupname']);
                $itemElement  -> appendChild ($itemValue);
                $rootElement  -> appendChild ($itemElement);
                
                $itemElement1 = $this -> xml -> createElement ('groupsubject');
                $itemValue1   = $this -> xml -> createCDATASection ($arrayItem['groupsubject']);
                $itemElement1 -> appendChild ($itemValue1);
                $rootElement  -> appendChild ($itemElement1);
                
                $itemElement2 = $this -> xml -> createElement ('groupowner');
                $itemValue2   = $this -> xml -> createCDATASection ($arrayItem['groupowner']);
                $itemElement2 -> appendChild ($itemValue2);
                $rootElement  -> appendChild ($itemElement2);
                
                $itemElement3 = $this -> xml -> createElement ('groupfaculty');
                $itemValue3   = $this -> xml -> createCDATASection ($arrayItem['groupfaculty']);
                $itemElement3 -> appendChild ($itemValue3);
                $rootElement  -> appendChild ($itemElement3);
                
                $itemElement4 = $this -> xml -> createElement ('grouplocation');
                $itemValue4   = $this -> xml -> createCDATASection ($arrayItem['grouplocation']);
                $itemElement4 -> appendChild ($itemValue4);
                $rootElement  -> appendChild ($itemElement4);
                
                $itemElement5 = $this -> xml -> createElement ('groupimage');
                $itemValue5   = $this -> xml -> createCDATASection ($arrayItem['groupimage']);
                $itemElement5 -> appendChild ($itemValue5);
                $rootElement  -> appendChild ($itemElement5);
                $xmls[] = $rootElement;
            }
            
            return $xmls;
        }
        
	    
        public function getGroupUsersListAsXML($array, $root) {
            $xmls = array();
            foreach ($array as $arrayItem) {
                
                $rootElement = $this -> xml -> createElement("user");
                $itemElement  = $this -> xml -> createElement ('firstname');
                $itemValue    = $this -> xml -> createCDATASection ($arrayItem['firstname']);
                $itemElement  -> appendChild ($itemValue);
                $rootElement  -> appendChild ($itemElement);
                
                $itemElement1 = $this -> xml -> createElement ('lastname');
                $itemValue1   = $this -> xml -> createCDATASection ($arrayItem['lastname']);
                $itemElement1 -> appendChild ($itemValue1);
                $rootElement  -> appendChild ($itemElement1);
                
                $itemElement2 = $this -> xml -> createElement ('username');
                $itemValue2   = $this -> xml -> createCDATASection ($arrayItem['username']);
                $itemElement2 -> appendChild ($itemValue2);
                $rootElement  -> appendChild ($itemElement2);
                
                $xmls[] = $rootElement;
            }
            
            return $xmls;
        }
        
        // Swaroops
	   public function getArrayAsXML($array) {
            
            foreach ($array as $k => $value) {
                $itemElement = $this -> xml -> createElement ($k);
                $itemNodeValue = $this -> xml -> createTextNode($value);
                $itemElement -> appendChild ($itemNodeValue);
                $result[] = $itemElement; 
            }
            
            return $result;
        }
		
		
		  
        public function buildArrayAsXML($parent,$array)
        {
        	if($parent == '')
        	{
        		$domnode =	$this->xmlRoot;
        	} else {        	
        		$domnode = $this -> xml -> createElement ($parent);
        	}
        	
			foreach($array as $k=>$val)
        	{
        		if(is_array($val))
        		{
        			$nextlevelindex = each($val);
        			
        			if(is_numeric($nextlevelindex['key']))
        			{
        				foreach($val as $value)
        				{
        					$itemElement = $this -> xml -> createElement ($k);	
        					if(isset($value['attrs']))
        					{
	        					foreach($value['attrs'] as $nodes => $data)
	        					{
		        					if($nodes == 'text')
		        					{
		        						$itemNodeValue = $this -> xml -> createCDATASection($data);
		        						$itemElement -> appendChild ($itemNodeValue);
		        					}
		        					else
		        					{
		        						$createnode = $this -> xml -> createAttribute ($nodes);	
		        						$itemNodeValue = $this -> xml -> createTextNode($data);
		        						$createnode ->appendChild($itemNodeValue);
		        						$itemElement -> appendChild ($createnode);
		        					}
	        					}
        					}
        					else if(isset($value['nodes']))
        					{
        						foreach($value['nodes'] as $nodes => $data)
	        					{
	        						if(is_array($data))
	        						{
	        							$domnode -> appendChild($this->buildArrayAsXML($nodes,$data));
	        						}
	        						else
	        						{
	        						$createnode = $this -> xml -> createElement ($nodes);	
	        						$itemNodeValue = $this -> xml -> createTextNode($data);
	        						$createnode ->appendChild($itemNodeValue);
	        						$itemElement -> appendChild ($createnode);
	        						}
	        					}
        						
        					}        					
        					$domnode -> appendChild($itemElement);
        				}
        			}
        			else
        			{	
        				$domnode -> appendChild($this->buildArrayAsXML($k,$val));
        			}
        		}
        		else
        		{
        			$itemElement = $this -> xml -> createElement ($k);
                	$itemNodeValue = $this -> xml -> createCDATASection($val);
               	 	$itemElement -> appendChild ($itemNodeValue);
					$domnode -> appendChild($itemElement);
        		}
        	}    
        	return $domnode;
        }
		
        public function createXMLInstance()
        {
        	$this->xml = new DOMDocument('1.0', 'utf-8');
			$this->xml -> formatOutput = $this -> formatXMLOutput;
			$this->xmlRoot = $this -> xml -> createElement ('response');
        }
		
        public function appendArrayToRootNode($parent,$array)
        {
        	$this -> xml -> appendChild($this->buildArrayAsXML($parent,$array));
        }
		
        public function displayXML()
        {
        	header("Content-type: text/xml");
			print $this -> xml -> saveXML();
			exit;
        }
        
        
    //added by bindu
        public function getSubscriptionIdNameXML($array, $item) {
            //print_r($array);
            foreach ($array as $arrayItem) {
            
                $itemElement = $this -> xml -> createElement ($item);
                $itemId      = $this -> xml -> createAttribute ("months");
                $itemValue   = $this -> xml -> createTextNode ($arrayItem['months']);
                
                $itemId -> appendChild ($itemValue);
                $itemElement -> appendChild ($itemId);
                $itemNodeValue = $this -> xml -> createCDATASection($arrayItem['type']);
                $itemElement -> appendChild ($itemNodeValue);
                $returnnodes[] = $itemElement; 
            }
            return $returnnodes;
        }
        
	public function getUserListIdAndNameXML($array, $root, $node1, $node2, $node3) {
            $xml = array();
        
            foreach ($array as $arrayItem) {
                
                $rootElement = $this -> xml -> createElement ($root);
                $itemElement = $this -> xml -> createElement ($node1);
                $itemValue = $this -> xml -> createCDATASection ($arrayItem['firstname']);
                $itemElement -> appendChild ($itemValue);
                $rootElement -> appendChild ($itemElement);
                $itemElement1 = $this -> xml -> createElement ($node2);
                $itemValue1 = $this -> xml -> createCDATASection ($arrayItem['lastname']);
                $itemElement1 -> appendChild ($itemValue1);
                $rootElement -> appendChild ($itemElement1);
                $itemElement2 = $this -> xml -> createElement ($node3);
                $itemValue2 = $this -> xml -> createCDATASection ($arrayItem['username']);
                $itemElement2 -> appendChild ($itemValue2);
                $rootElement -> appendChild ($itemElement2);
                
                $xml[] = $rootElement;
            }
            
            return $xml;
        }
        
        public function getNewsIdAndNameXML($array, $root, $node1, $node2) {
            $xml = array();
            
            foreach ($array as $arrayItem) {
                
                $rootElement = $this -> xml -> createElement ($root);
                $itemElement = $this -> xml -> createElement ($node1);
                $itemValue = $this -> xml -> createCDATASection ($arrayItem['title']);
                $itemElement -> appendChild ($itemValue);
                $rootElement -> appendChild ($itemElement);
                $itemElement1 = $this -> xml -> createElement ($node2);
                $itemValue1 = $this -> xml -> createCDATASection ($arrayItem['body']);
                $itemElement1 -> appendChild ($itemValue1);
                $rootElement -> appendChild ($itemElement1);
                
                $xml[] = $rootElement;
            }
            
            return $xml;
        }
        
          public function viewFormAsXML($array, $root, $node1, $status )
        {
        
                $xml = array();
                
                if($status){
                $status = $this -> xml->createElement('status');
                $statusChild = $this->xml->createCDATASection('OK');
                $status ->appendChild($statusChild);
                $xml[] = $this -> xmlRoot->appendChild($status);
                }
                $rootElement = $this -> xml -> createElement ($root);
            foreach ($array as $arrayItem) {
                
                $itemElement = $this -> xml -> createElement ($node1);
                $childElement = $this -> xml -> createElement ('PatientDetailUR');
                $itemValue = $this -> xml -> createCDATASection ($arrayItem['pdur']);
                $childElement -> appendChild ($itemValue);
                $itemElement -> appendChild ($childElement);
                
                $childElement1 = $this -> xml -> createElement ('PatientDetailFirstName');
                $itemValue1 = $this -> xml -> createCDATASection ($arrayItem['pdfame']);
                $childElement1 -> appendChild ($itemValue1);
                $itemElement -> appendChild ($childElement1);
                
                $childElement2 = $this -> xml -> createElement ('PatientDetailSurname');
                $itemValue2 = $this -> xml -> createCDATASection ($arrayItem['pdsurname']);
                $childElement2 -> appendChild ($itemValue2);
                $itemElement -> appendChild ($childElement2);
                
                $childElement3 = $this -> xml -> createElement ('formKey');
                $itemValue3 = $this -> xml -> createCDATASection ($arrayItem['formkey']);
                $childElement3 -> appendChild ($itemValue3);
                $itemElement -> appendChild ($childElement3);
                $rootElement->appendChild ($itemElement);
                
                $xml[] = $rootElement;
            }
            
            return $xml;  
        
        }
        
        
        /* End */
        
	}// end class: Webservices_Writer