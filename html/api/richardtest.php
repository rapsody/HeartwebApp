<?php
    include_once "/var/www/html/includes/webservice.inc.php";
include_once "/var/www/html/config/config.inc.php";	
include_once "/var/www/html/config/database.inc.php";	

include_once("Mail.php");
include_once('Mail/mime.php'); // PEAR Mail_Mime packge



			
$filename ="deidentified_1342660312-2012-07-24-3069.pdf";
$path = PDF_PATH;
$mailto = "rmacca@gmail.com";
$from_mail = SMTP_USER;
$subject =  'H.A.R.T.scan Report ';
$message =  'Please find the attached PD';

$header = array ('From' => $from_mail,
			'To' => $mailto,
			'Subject' => $subject);
		$file = $path.$filename; // attachment
			
		$text = "Hi<BR><BR>";
		$text .= "This Patient Record has been shared to you by:first_name<BR><BR>";
		$text .= "Patient: <BR>";
		$text .= "DOB: <BR>";
		$text .= "UR:<BR>";
		$text .= "ExamID:<BR><BR><BR>";
		$text .= "====== IMPORTANT INFORMATION =========<BR>";
		$text .= "Please Note <BR>";
		$text .= "The information contained within this report is of a confidential nature and should not be shared with any other person."; // text and html versions of email.
			
		$html = '<html><body>'.$text.'</body></html>';
			
			
		$filename_deidentified = 'deidentified_'.$filename;
		 $file_deidentified = $path.$filename_deidentified; // attachment2
	 	$crlf = "\n";
		
		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
		$mime->addAttachment($file, 'text/html');
			
		if($mailto == ''){
			$mime->addAttachment($file_deidentified, 'text/html');
			$mailto = $username;
		}
			
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

		if (PEAR::isError($mail)) {
			echo  "Your email wasn't sent, please try again";
		} else {
			echo  "Your email has been sent successfully";
		}


   
    ?>