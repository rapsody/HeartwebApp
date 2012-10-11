<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();

	$messageObj  = new Messages();
    $groupsObj = new Groups();
    $formsObj = new Forms();
   
    $data = (isset($_POST['data']))?$_POST['data']:'';
    $resultmessage = $messageObj -> getRecentMessages($data);
    $resultgroups = $groupsObj -> getUserGroups($data,4);
    $resultforms = $formsObj -> getRecentForms($data);

    $data = (isset($_POST['data']))?$_POST['data']:'';
$fp = fopen('/var/www/html/logfiles/home.txt', 'a');
fwrite($fp, $data."\n");
fclose($fp);


    if ($resultmessage && $resultgroups && $resultforms) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$resultmessage);	
		$webService -> appendArrayToRootNode('',$resultgroups);	
		$webService -> appendArrayToRootNode('',$resultforms);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $messageObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }