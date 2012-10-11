<?php
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$groupsObj       = new Groups();
    $data = (isset($_POST['data']))?$_POST['data']:'';
   
    $result = $groupsObj -> doGroupAction($data);
   
   if (count($result) > 0) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $groupsObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }