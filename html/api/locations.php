<?php
    
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();

    $generalObj = new General();


    $locations = $generalObj -> getLocations();
   
    if ($locations) {
	   	$webService -> createXMLInstance();	
		$webService -> appendArrayToRootNode('',$locations);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $generalObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }