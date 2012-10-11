<?php

    include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	/* to get subscription details */
	 $data = (isset($_POST['data']))?$_POST['data']:'';


$fp = fopen('/var/www/html/logfiles/subscription.txt', 'a');
fwrite($fp, $data."\n");


	$subscription = new Subscription();
	$return = $subscription -> getSubscription();
	$subscriptionexpiry = $subscription -> getSubscriptionexpiry($data);
	
	/* end */    
	
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
