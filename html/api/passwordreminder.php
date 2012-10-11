<?php

    include_once "../includes/webservice.inc.php";
    
    $webService = new Webservices_Writer();
    $webService -> init();
    
    $usersObj       = new Users();
    if ($usersObj -> passwordReminder($_POST['data']) === true) {
        $xmls[] = $webService -> successXML();
    }
    else {
        $xmls = $webService -> errorXML(join(",", $usersObj -> errorMessages)); 
    }
   
    $webService -> outputXML($xmls);