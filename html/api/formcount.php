<?php

//$num = rand(2,6);
include_once "/var/www/html/config/config.inc.php";	
include_once "/var/www/html/config/database.inc.php";	

$num = 0;

$forms = $db->query("select forms.id from users  left join forms  on users.id = forms.created_by where username like '".$id."'");
$num = count($forms);
echo "<response><message>".$num."</message></response>";

	?>