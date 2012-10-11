<?php

    include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	/* to get faculties details */
	
	
	 $faculties = new Faculties();
	 $facultiesdata = $faculties -> getFaculties();
	 $specialties = new Specialties();
	 $specialitiesdata = $specialties -> getSpecialties();
	 
	 if ($facultiesdata && $specialitiesdata) {
	   	$webService -> createXMLInstance();	
		$webService -> appendArrayToRootNode('',$facultiesdata);
		$webService -> appendArrayToRootNode('',$specialitiesdata);	
		$webService -> displayXML();
    }
    else {
    	$errors = array();
    	if(count($faculties -> errorMessages) > 0)
    		$errors +=	$faculties -> errorMessages;
    	if(count($specialties -> errorMessages) > 0)
    		$errors +=	$specialties -> errorMessages;
        $xmls = $webService -> errorXML(join(",", $errors)); 
		$webService -> outputXML($xmls);
    }