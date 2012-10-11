<?php


include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$messageObj       = new Messages();
    $userObj = new Users();
    $data = (isset($_POST['data']))?$_POST['data']:'';
    
    if($userObj->checkUserFromRawData($data))
    {
	    $result = $messageObj -> getGroupMessages($data);
	   	if ($result) {
		   	$webService -> createXMLInstance();
			$webService -> appendArrayToRootNode('',$result);	
			$webService -> displayXML();
	    }
	    else {
	        $xmls = $webService -> errorXML(join(",", $messageObj -> errorMessages)); 
			$webService -> outputXML($xmls);
	    }
    }
    else
    {
    	$xmls = $webService -> errorXML(join(",", $userObj -> errorMessages)); 
    	$webService -> outputXML($xmls);
    }
    
    
    
   
?>