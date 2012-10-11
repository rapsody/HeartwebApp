<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	

	$formsObj       = new Forms();
    $data = (isset($_POST['data']))?$_POST['data']:'';
$fp = fopen('/var/www/html/logfiles/formshare.txt', 'a');
fwrite($fp, $data."\n");
fclose($fp);

   if ($result = $formsObj -> shareForm($data)) {
    	$xmls = $webService -> getArrayAsXML($result);
    }
    else {
        $xmls = $webService -> errorXML(join(",", $formsObj -> errorMessages)); 
    }
   
    $webService -> outputXML($xmls);