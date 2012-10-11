<?php


	include_once "../includes/webservice.inc.php";
    
    $webService = new Webservices_Writer();
    $webService -> init();
    
    $usersObj = new Users();
   
    $data = (isset($_POST['data']))?$_POST['data']:'';

$fp = fopen('/var/www/html/logfiles/register.txt', 'a');
fwrite($fp, $data."\n");
fclose($fp);

    $result = $usersObj -> validateRegister($data);
    if (count($result) > 0) {
    	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {

        $xmls = $webService -> errorXML(join(",", $usersObj -> errorMessages)); 
        
		$webService -> outputXML($xmls);
    }

