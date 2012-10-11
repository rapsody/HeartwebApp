<?php

    include_once "../includes/webservice.inc.php";
    
    $webService = new Webservices_Writer();
    $webService -> init();
    
    $usersObj       = new Users();
    $data = (isset($_POST['data']))?$_POST['data']:'';

	
			$fp = fopen('/var/www/html/logfiles/login.txt', 'a');
fwrite($fp, explode($data)."\n");
fwrite($fp, var_dump($data)."\n");
fwrite($fp, "--------------\n");
fclose($fp);



    if ($result = $usersObj -> userLogin($data)) {
    	$xmls = $webService -> getArrayAsXML($result);    
    }
    else {
        $xmls = $webService -> errorXML(join(",", $usersObj -> errorMessages)); 
    }
   
    $webService -> outputXML($xmls);