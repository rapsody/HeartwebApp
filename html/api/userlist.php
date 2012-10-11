<?php

    include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	/* to get userlist details */
	
	 $userlist = new UserList();
	 
	$return = $userlist -> getUserList();
	
   
    if ($return) {
	   	$webService -> createXMLInstance();	
		$webService -> appendArrayToRootNode('',$return);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $userlist -> errorMessages)); 
		$webService -> outputXML($xmls);
    }
