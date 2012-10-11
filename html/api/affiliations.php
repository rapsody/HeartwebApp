<?php
    
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();

    $generalObj = new General();


    $affiliations = $generalObj -> getAffiliations();
   
    if ($affiliations) {
	   	$webService -> createXMLInstance();	
		$webService -> appendArrayToRootNode('',$affiliations);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $generalObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }