<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	$obj       = new Messages();
    $data = (isset($_POST['data']))?$_POST['data']:'';

   if ($result = $obj -> deleteMessage($data)) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $obj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }