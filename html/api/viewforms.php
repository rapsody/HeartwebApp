<?php
    include_once "../includes/webservice.inc.php";
    
    $webService = new Webservices_Writer();
    $webService -> init();
    
    $formUsersDataObj = new FormUserData();
    $userKeyObj = new LoginKeys();
    
    $authkey = $_POST['userauthkey'];
    
    $status = $userKeyObj->checkAuthKey($authkey);
    if($status)
    {
	   $result1 = $formUsersDataObj->getFormUserData(1);
	   $result2 =  $formUsersDataObj->getFormUserData(0);
	   
	   $result = array_merge($result1,$result2);
	   
	   $xmls   = array();
       $xml    = $webService -> viewFormAsXML($result1, "completed", 'form',true);
       $xml1    = $webService -> viewFormAsXML($result2, "Incompleted", 'form',false);
       $xmls = array_merge($xml,$xml1);
       $webService -> outputXML($xmls);
       
    }
    else
    {
         $xmls = $webService -> errorXML('Invalid User key'); 
         $webService -> outputXML($xmls);
    }
       
      
