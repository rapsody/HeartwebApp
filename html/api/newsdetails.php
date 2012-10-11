<?php

    include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	/* to get news details */
	$data = (isset($_POST['data']))?$_POST['data']:'';

	$news = new News();
	$result = $news -> getNewsDetails($data);
	if($result)
	{
	$xmls = $webService -> getNewsIdAndNameXML($result, "news", "title", "body"); 
	}
	else
	{
		$xmls = $webService -> errorXML(join(",", $news -> errorMessages)); 
	}
	/* end */    
	
	$webService -> outputXML($xmls);