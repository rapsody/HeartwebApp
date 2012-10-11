<?php
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
		 $data = (isset($_POST['data']))?$_POST['data']:'';
	$groupObj       = new Groups();
   
    $result = $groupObj -> myGroupRequestStatus($data);
   if (count($result) > 0) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $groupObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }