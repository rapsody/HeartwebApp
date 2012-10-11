<?php
    
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();

    $groupsObj = new Groups();

   
    $data = (isset($_POST['data']))?$_POST['data']:'';
    $resultgroups = $groupsObj -> getUserGroups($data);
   
    if ($resultgroups) {
	   	$webService -> createXMLInstance();	
		$webService -> appendArrayToRootNode('',$resultgroups);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $messageObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }