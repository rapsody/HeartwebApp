<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	$usersObj       = new Users();
    $data = (isset($_POST['data']))?$_POST['data']:'';

   if ($result = $usersObj -> deleteUser($data)) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $usersObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }