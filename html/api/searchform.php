<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$formObj       = new Forms();
    
	$data = (isset($_POST['data']))?$_POST['data']:'';
    
   if ($result = $formObj -> searchForms($data)) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $formObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }