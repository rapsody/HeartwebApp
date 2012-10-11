<?php
    include_once "../includes/webservice.inc.php";
    
    $webService = new Webservices_Writer();
    $webService -> init();
    
    /* search user profile */
    
    $usersObj        = new Users();
    
    $data = (isset($_POST['data']))?$_POST['data']:'';
    
     $result = $usersObj -> getSearchUsers($data);
   
    if ($result) {
	   	$webService -> createXMLInstance();	
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $usersObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }
    