<?php
include 'check_login.php'; 

include "./pdf_renderer.php";
include "./Validation.php";
include "./DB_functions.php";
include "./User.php";

$mysqli = require_once "./db_config.php";

// necessary resources for PDF export
require_once __DIR__ . '/../../../app/vendor/autoload.php';
use Dompdf\Dompdf;

if (isset($_SESSION['data'])) {
    $data = $_SESSION['data'];
    unset($_SESSION['data']);
}

$user_id = $_SESSION['user_id'];
$user = new User();
$user->pull($mysqli, $user_id);
$user_name = $user->getLastName();

// new export obj
$dompdf = new Dompdf();

// load the pdf to be exported
$dompdf->loadHtml($data);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($user_name . '_resume.pdf');
?>
