<?php
include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	$faqsObj       = new Faqs();
   
    $result = $faqsObj -> getFaqs();
   
   if (count($result) > 0) {
   	$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $faqsObj -> errorMessages)); 
		$webService -> outputXML($xmls);
    }