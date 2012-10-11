<?php
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$contentObj       = new Content();
 
  
   
    $result = $contentObj -> getContent();
   
   if (count($result) > 0) {
   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $contentObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }