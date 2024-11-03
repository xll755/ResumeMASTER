<?php
session_start();

// necessary resources for PDF export
require_once __DIR__ . '/../../../app/vendor/autoload.php';
use Dompdf\Dompdf;

/*
* MOCK-UP page for PDF exporting
*
* will need to:
* - get passed in string either from html or from python return
*/

// PDF to be exported in HTML markup form
// will be just a string
$html_pdf = '';

// new export obj
$dompdf = new Dompdf();

// load the pdf to be exported
$dompdf->loadHtml($html_pdf->get_contents());

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>
