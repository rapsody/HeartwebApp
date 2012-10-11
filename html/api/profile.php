<?php
    include_once "../includes/webservice.inc.php";
    
    $webService = new Webservices_Writer();
    $webService -> init();
    /* profile */
    $usersObj    = new Users();
	$data = (isset($_POST['data']))?$_POST['data']:'';
	if($userprofile = $usersObj->getUserProfile($data))
    {
        $webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$userprofile);	
		$webService -> displayXML();
    }
    else
    {
        $xmls = $webService -> errorXML('Username does not exists'); 
		$webService -> outputXML($xmls);
    }
     
    /* End profile*/