<?php
ini_set('display_errors','on');
session_start();


$filename = $_POST['filename'];
$_SESSION['id'] = $_POST['formid'];
$_SESSION['sharedby'] = $_POST['sharedby'];
$_SESSION['data'] = unserialize(urldecode($_POST['data']));


require_once("dompdf_config.inc.php");
if($_POST['mode'] == 'media')
{
$file = realpath(dirname(__FILE__)).'/template/mediatemplate.php';
}
else
{
$file = realpath(dirname(__FILE__)).'/template/template.php';
}
$base_path = 'template/';
$paper = 'tabloid';
$orientation = 'portrait';
//$outfile = "dompdf_out.pdf";
$options['Attachment'] = 0;
$outfile = realpath(dirname(__FILE__).'/../../pdf') . DIRECTORY_SEPARATOR . $filename;
$save_file = true;
//echo $outfile;
//echo strpos($outfile, DOMPDF_CHROOT);
//echo DOMPDF_CHROOT;
//echo $outfile;
//exit;

$dompdf = new DOMPDF();

if ( $file === "-" ) {
  $str = "";
  while ( !feof(STDIN) )
    $str .= fread(STDIN, 4096);

  $dompdf->load_html($str);

} else
{
	
  $dompdf->load_html_file($file);

}
if ( isset($base_path) ) {
  $dompdf->set_base_path($base_path);
}

$dompdf->set_paper($paper, $orientation);

$dompdf->render();

if ( $save_file ) {
//   if ( !is_writable($outfile) )
//     throw new DOMPDF_Exception("'$outfile' is not writable.");
  if ( strtolower(DOMPDF_PDF_BACKEND) === "gd" )
    $outfile = str_replace(".pdf", ".png", $outfile);

  list($proto, $host, $path, $file) = explode_url($outfile);
  if ( $proto != "" ) // i.e. not file://
    $outfile = $file; // just save it locally, FIXME? could save it like wget: ./host/basepath/file

 $outfile = realpath(dirname($outfile)) . DIRECTORY_SEPARATOR . basename($outfile);

  //if ( strpos($outfile, '/var/www/html/heartweb/actual/pdf/') !== 0 )
  //  throw new DOMPDF_Exception("Permission denied.");

  file_put_contents($outfile, $dompdf->output( array("compress" => 0) ));
  echo basename($outfile);
  exit(0);
}

//if ( !headers_sent() ) {
//  $dompdf->stream($outfile, $options);
//}
exit;
