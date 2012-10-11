<?php

    include_once "../includes/webservice.inc.php";
    
    $webService = new Webservices_Writer();
    $webService -> init();
    $userObj = new Users();
    $groupsObj = new Groups();
	$formsObj = new Forms();

    $data = (isset($_POST['data']))?$_POST['data']:'';
    $groupusers = ''; 
    $groupdetails = '';

    if($userObj->checkUserFromRawData($data))
    {
    	
    	$groupusers = $userObj -> getGroupUsersList($data);
    	$groupdetails = $groupsObj -> getGroupDetails($data);
		$groupforms = $formsObj -> getGroupFormsList($data);
    }
    else
    {
    	
    	$xmls = $webService -> errorXML(join(",", $userObj -> errorMessages)); 
    	$webService -> outputXML($xmls);
    }
    
    if (count($groupusers) > 0 && count($groupdetails) > 0) {
	   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$groupusers);	
		$webService -> appendArrayToRootNode('',$groupdetails);
		$webService -> appendArrayToRootNode('',$groupforms);
		$webService -> displayXML();
    }
    else {
    	$usererrors = array();
    	$usererrors = $userObj -> errorMessages;
    	$grouperrors = array();
    	$grouperrors = $groupsObj -> errorMessages;
		$formerrors = array();
    	$formerrors = $formsObj -> errorMessages;
    	$errors = $usererrors+$grouperrors+$formerrors;
        $xmls = $webService -> errorXML(join(",", $errors)); 
		$webService -> outputXML($xmls);
    }