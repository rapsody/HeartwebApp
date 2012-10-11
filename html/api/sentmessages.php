<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	$messageObj       = new Messages();
    $data = (isset($_POST['data']))?$_POST['data']:'';
    $result = $messageObj -> getSentMessages($data);
   if ($result) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $messageObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }