<?php 

include_once "../includes/webservice.inc.php";

	$webService = new Webservices_Writer();
	$webService -> init();

	$formObj       = new Forms();

    $data = (isset($_POST['data']))?$_POST['data']:'';
	

	if ($result = $formObj -> getFormPDF($data)) {
	
		if($result['status'] == 'OK')
		{

			$result_data = $formObj ->getFormPDFData($data);

	/*	$fp = fopen('/var/www/html/logfiles/sendform.txt', 'a');
fwrite($fp,$result['pdffile']. "\n");
fwrite($fp, $result['email']."\n");
fclose($fp);

*/

			$emailsend = $formObj -> sendMailFormPDF($result['pdffile'], PDF_PATH, $result['email'], SMTP_USER, '', '', 'H.A.R.T.scan Report '.$result['UR'].'', 'Please find the attached PDF', $result_data);
		
			$webService -> createXMLInstance();
			$webService -> appendArrayToRootNode('',$emailsend);	
			$webService -> displayXML();
		}
		else
		{
			$webService -> createXMLInstance();
			$webService -> appendArrayToRootNode('',$result);	
			$webService -> displayXML();
		}
	}
	else { 
        $xmls = $webService -> errorXML(join(",", $formObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }	

?>