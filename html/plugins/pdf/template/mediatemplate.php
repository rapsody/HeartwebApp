<?php
ini_set('display_errors','off');
session_start();
$formdata = $_SESSION['data'];
?>
<?php if(count($formdata['images']) > 0 || count($formdata['videos']) > 0){?>
<table>
<tr><td><b>Additional Information</b></td></tr>
</table>
<?php }?>

<?php if(count($formdata['images']) > 0){?>
<table>
<tr><td><u>Images</u></td></tr>
</table>
<?php }?>
<table>
<?php foreach($formdata['images'] as $val){?>
<tr><td><img src="/var/www/test/html/uploads/formdata/<?=basename($val)?>" /></td></tr>
<?php }?>
</table>
<?php if(count($formdata['videos']) > 0){?>
<table>
<tr><td><u>Videos</u></td></tr>
</table>
<?php }?>
<table>
<?php foreach($formdata['videos'] as $val){?>
<tr><td><?=$val?></td></tr>
<?php }?>
</table>
