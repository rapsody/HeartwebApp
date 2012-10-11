<?php

    include_once "../includes/webservice.inc.php";
	
	$webService = new Webservices_Writer();
	$webService -> init();
	
	/* to get news details */
	
	 $news = new News();
	$result = $news -> getNews();
	if(count($result) > 0)
	{
		$webService -> createXMLInstance();
		$webService -> appendArrayToRootNode('',$result);	
		$webService -> displayXML();
	}	

	/* end */    
	
