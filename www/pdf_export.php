<?php
session_start();

include "./text2html.php";
include "./pdf_renderer.php";
include "./Validation.php";
include "./DB_functions.php";
include "./Resume.php";
// necessary resources for PDF export
require_once __DIR__ . '/../../../app/vendor/autoload.php';
use Dompdf\Dompdf;
$mysqli = require_once "./db_config.php";

if (!isset($_POST) || $_POST['resume_id'] == null) {
	print('NO RESUME TO DOWNLOAD');
	exit();
}

$resume_id = $_POST['resume_id'];
$resume = new Resume();
$resume->pull($mysqli, $resume_id);
$render = new pdf_render();
$html_pdf = $render->render($resume);

// new export obj
$dompdf = new Dompdf();

// load the pdf to be exported
$dompdf->loadHtml($html_pdf);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>
