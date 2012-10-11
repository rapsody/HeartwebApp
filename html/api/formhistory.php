<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();

    $formsObj = new Forms();
   
    $data = (isset($_POST['data']))?$_POST['data']:'';

    $resultforms = $formsObj -> getRecentForms($data,20);
   
    if ($resultforms) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$resultforms);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $formsObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }