<?

require_once("../plugins/pdf/dompdf_config.inc.php");

// We check wether the user is accessing the demo locally

if ( isset( $_POST["html"] )) {

  if ( get_magic_quotes_gpc() )
    $_POST["html"] = stripslashes($_POST["html"]);
  
  $dompdf = new DOMPDF();
  $dompdf->load_html($_POST["html"]);
  $dompdf->set_paper('letter', 'portrait');
  $dompdf->render();

  $dompdf->stream("dompdf_out.pdf", array("Attachment" => true));

  exit(0);
}