<?php
ini_set('display_errors','on');
include_once ("includes/webservice.inc.php");
include('modules/Forms.class.php');
$objFormModel= new Forms();

$filename = 'hello.pdf';
$formid=189;	
	$data = $objFormModel -> getPdfFormData($formid,$db);
	print_r($data);
    	$postFields = 'filename='.$filename.'&formid='.$formid.'&data='.urlencode(serialize($data)); 
    	$ch = curl_init();
	
       
         curl_setopt($ch, CURLOPT_URL, 'http://staging.valuelabs.net/heartweb/actual/plugins/pdf/pdf.php');
                curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
                curl_setopt( $ch, CURLOPT_POST, 1 );
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $postFields);

                $sms_server = curl_exec($ch);
                curl_close($ch);	

	
	
