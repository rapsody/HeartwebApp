<?php
ini_set('display_errors','on');
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();

	$messageObj  = new Messages();
    $groupsObj = new Groups();
   
    $data = (isset($_POST['data']))?$_POST['data']:'';

    $resultmessage = $messageObj -> getRecentMessages($data);
    $resultgroupsreqs = $groupsObj -> getPendingPublicRequests($data);
    $resultsentmessages = $messageObj -> getSentMessages($data);
   
    if ($resultmessage && $resultgroupsreqs && $resultsentmessages) {
	$sentmsgs['sentmessages'] = $resultsentmessages['messages'];
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$resultmessage);	
		$webService -> appendArrayToRootNode('',$resultgroupsreqs);	
		$webService -> appendArrayToRootNode('',$sentmsgs);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $messageObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }