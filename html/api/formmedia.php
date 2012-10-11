<?php
ini_set('upload_max_filesize', '30M');
ini_set('post_max_size', '30M');
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();


	$formsObj       = new Forms();
    $data = (isset($_POST['data']))?$_POST['data']:'';
	
   if ($result = $formsObj -> updateMedia($_FILES, $data)) {
    	$xmls = $webService -> getArrayAsXML($result);   
    }
    else {
        $xmls = $webService -> errorXML(join(",", $formsObj -> errorMessages)); 
    }
    $webService -> outputXML($xmls);