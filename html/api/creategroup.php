<?php

include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$groupsObj       = new Groups();
    $data = (isset($_POST['data']))?$_POST['data']:'';
  
  
   if ($result = $groupsObj -> createUserGroups($data)) {
    	$xmls = $webService -> getArrayAsXML($result);
    	//$xmls[] = $result;        
    }
    else {
        $xmls = $webService -> errorXML(join(",", $groupsObj -> errorMessages)); 
    }
   
    $webService -> outputXML($xmls);