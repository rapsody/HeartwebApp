<?php
	
    include_once "../includes/webservice.inc.php";
    
    $webService = new Webservices_Writer();
    $webService -> init();
    
    $data = (isset($_POST['data']))?$_POST['data']:'';
     
	$messagesObj = new Messages();
  
	$msgsent = $messagesObj->sendMessage($data);
    
    if ($msgsent) {
    	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$msgsent);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $messagesObj -> errorMessages)); 
     $webService -> outputXML($xmls);
    }
   
   