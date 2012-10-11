<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$formsObj       = new Forms();
    $data = (isset($_POST['data']))?$_POST['data']:'';
  
$fp = fopen('/var/www/html/logfiles/usersharedform.txt', 'a');
fwrite($fp, $data."\n");
fclose($fp);
   if ($result = $formsObj -> userShareForm($data)) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $formObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }