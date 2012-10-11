<?php


include_once "/var/www/html/config/config.inc.php";	
include_once "/var/www/html/config/database.inc.php";	

$id=$_GET['username'];
$db->query("update users set expiry ='2012-01-01 00:00:00' where username like '$id'");
echo "<response><message>Updated</message></response>";

	?>