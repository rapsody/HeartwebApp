<?php




		


include_once("Mail.php");
include_once('Mail/mime.php'); // PEAR Mail_Mime packge
/*SMTP realted constants*/
define('SMTP_HOST', 'pod51003.outlook.com');
define('SMTP_USER', 'iHeartScan@Heartweb.com');
define('SMTP_PASSWORD', 'Cardigan123');
define('SMTP_AUTH', true);
define('SMTP_PORT', '587');
define('SITE_NAME_FOR_EMAIL','http:\//*****.net');

/*directory seprator*/

$from_mail = SMTP_USER;

$mailto ="Jwong2138@gmail.com";

 $subject = "H.A.R.T.scan Report 19999";
	$header = array ('From' => $from_mail,
			'To' => $mailto,
			'Subject' => $subject);
	
			
		$text = "Hi<BR><BR>";
	
		$text .= "====== IMPORTANT INFORMATION =========<BR>";
		$text .= "Please Note <BR>";
		$text .= "Can you confirm you received this, as the App doesn't seem to like your email address, richard"; // text and html versions of email.
			
		$html = '<html><body>'.$text.'</body></html>';
			
	
		
		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
			


		$message = $mime->get();
		$header = $mime->headers($header);
		 
			
		$smtp = Mail::factory('smtp',
		array ('host' => SMTP_HOST,
			 'port' => SMTP_PORT,
			 'auth' => true,
			 'debug' => true,
			 'username' => SMTP_USER,
			 'password' => SMTP_PASSWORD));
		$mail = $smtp->send($mailto, $header, $message);

		


?>
