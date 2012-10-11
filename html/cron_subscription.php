<?php

    include_once "/var/www/html/includes/webservice.inc.php";
include_once "/var/www/html/config/config.inc.php";	
include_once "/var/www/html/config/database.inc.php";	

include_once("Mail.php");
include_once('Mail/mime.php'); // PEAR Mail_Mime packge
//include_once "/var/www/html/models/Subscription.class.php";	
//include_once "/var/www/html/modules/Subscription.class.php";	

	
error_reporting(E_ALL);

	 


	$subscription = new Subscription();
	$return = $subscription -> loadSubscriptionMultipleExpiry();
	

/*


	$smtp = Mail::factory('smtp',
		array ('host' => SMTP_HOST,
			 'port' => SMTP_PORT,
			 'auth' => true,
			 'username' => SMTP_USER,
			 'password' => SMTP_PASSWORD));

	$subject = "Heartweb Subscription";
	$from_mail = 'iHeartScan@Heartweb.com';
	foreach($return as $row){
	

		$header = array ('From' => $from_mail,
			'To' => $row['username'],
			'Subject' => $subject);
		$text = "Hi ".$row['username']."<BR><BR>";
		$text .= "Your subscription is coming to an end in 2 days please renew your subscription: <BR>";
		$text .= "Expiry Date: ".$row["expiry"]."<BR>";
		$text .= "====== IMPORTANT INFORMATION =========<BR>";
		$text .= "Please Note <BR>";
		$text .= "The information contained within this report is of a confidential nature and should not be shared with any other person."; // text and html versions of email.
			
		$html = '<html><body>'.$text.'</body></html>';
			
		$crlf = "\n";
			
		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
	
		$mailto = $row['username'];//$username;
			
		$message = $mime->get();
		$header = $mime->headers($header);
		 
		$mail = $smtp->send($mailto, $header, $message);

		if (PEAR::isError($mail)) {
			echo 'Mail not send';
		} else {
			echo  'Mail has sent successfully';
		}

	}
	*/


	$subject = "Heartweb Subscription";

	$mime = new Mail_Mime();

			
		$text = "Hi<BR><BR>";
		$text .= "Your subscription to the Heartweb application is due for renewal in 7days.  TIf you would liek to carry on with your subscription then you will need renew through the application.<BR>";
		$text .= "====== IMPORTANT INFORMATION =========<BR>";
		$text .= "Please Note <BR>";
		$text .= "The information contained within this report is of a confidential nature and should not be shared with any other person."; // text and html versions of email.
			
		$html = '<html><body>'.$text.'</body></html>';
			

		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
		$mime->setFrom(SMTP_USER);
		$mime->setSubject($subject);
		$body = $mime->get();
		$headers = $mime->headers();

		$smtp = Mail::factory('smtp',
		array ('host' => SMTP_HOST,
			 'port' => SMTP_PORT,
			 'auth' => true,
			 'username' => SMTP_USER,
			 'password' => SMTP_PASSWORD));



	foreach($return as $row){
		$mailto = $row['username'];
		if(TRIM($mailto) !=''){
			$mailto = $smtp->send($mailto, $header, $body);
		}
		
		if (PEAR::isError($mail)) {
			echo 'Mail not send';
		} else {
			echo  'Mail has sent successfully';
		}

		}

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