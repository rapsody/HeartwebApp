<?php
//ini_set('display_errors',1); 
//error_reporting(E_ALL);
include_once "../includes/webservice.inc.php";

	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$formObj       = new Forms();
    
	$data = (isset($_POST['data']))?$_POST['data']:'';
 
  	 
	$fp = fopen('/var/www/html/logfiles/removemedia.txt', 'a');
	fwrite($fp, $data."\n");

	fclose($fp);
   if ($result = $formObj -> removemedia($data)) {
	  
    	$xmls = $webService -> getArrayAsXML($result);
    	//$xmls[] = $result;     
    }
    else {
        $xmls = $webService -> errorXML(join(",", $formObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }