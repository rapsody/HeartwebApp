<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();

	
	$groupObj       = new Groups();
   
    $result = $groupObj -> latestGroups();
   if (count($result) > 0) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $groupObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }