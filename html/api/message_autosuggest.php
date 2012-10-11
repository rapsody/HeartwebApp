<?php
    include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$users = new Users();
	$data = (isset($_POST['data']))?$_POST['data']:'';
	/* to get username details */	
	
	$result = $users -> msgAutoSuggest($data);
	
	if($result)
	{
	extract($result);
	$xmls[] = $webService -> getNameXML($users, "users", "username"); 
	$xmls[] = $webService -> getNameXML($groups, "groups", "groupname"); 
	$webService -> outputXML($xmls);
	}
	else
	{
		$xmls = $webService -> errorXML(join(",", $users -> errorMessages)); 
		$webService -> outputXML($xmls);
	}
	