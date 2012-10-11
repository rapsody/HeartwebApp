<?php

    include_once "/var/www/html/includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
error_reporting(E_ALL);

	 


	$subscription = new Subscription();
	$return = $subscription -> loadSubscriptionMultipleExpiry();
	
	var_dump($return);
	/* end */    
	/*
	if ($return) {
	   	$webService -> createXMLInstance();	
		$webService -> appendArrayToRootNode('',$return);
		if($subscriptionexpiry != '')	
		$webService -> appendArrayToRootNode('',$subscriptionexpiry);	
		$webService -> displayXML();
    }
    else {
    	if(isset($subscription -> errorMessages) && count($subscription -> errorMessages) > 0)
    	$errormessages =  $subscription -> errorMessages;
    	else
    	$errormessages[] = 'No Data Found';
        $xmls = $webService -> errorXML(join(",", $errormessages)); 
		$webService -> outputXML($xmls);
    }

	

	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    printf("ID: %s  Name: %s", $row[0], $row[1]);  
}



*/