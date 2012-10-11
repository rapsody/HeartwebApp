<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$formsObj       = new Forms();
    $data = (isset($_POST['data']))?$_POST['data']:'';
 


   if ($result = $formsObj -> createForm($data)) {
    	$xmls = $webService -> getArrayAsXML($result);
    	//$xmls[] = $result;        
    }
    else {
        $xmls = $webService -> errorXML(join(",", $formsObj -> errorMessages)); 
    }
    $webService -> outputXML($xmls);