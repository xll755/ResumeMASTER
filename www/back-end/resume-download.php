<?php
include './verify-session.php'; 

include "./resume-renderer.php";
include "./dbfuncs.php";
include "./User.php";
include "./Resume.php";

$mysqli = require_once "./db-config.php";

// necessary resources for PDF export
require_once __DIR__ . '/../../../../app/vendor/autoload.php';
use Dompdf\Dompdf;

// get user's id & last name
$user_id = $_SESSION['user_id'];
$user = new User();
$user->pull($mysqli, $user_id);
$user_name = $user->getLastName();

if (isset($_SESSION['resume_id'])) {
    $resume_id = $_SESSION['resume_id'];
    unset($_SESSION['resume_id']);
}

$resume = new Resume();
$resume->pull($mysqli, $resume_id);
$data = $resume->get_resume();

$renderer = new pdf_render();
$html = $renderer->render($data);

// new export obj
$dompdf = new Dompdf();

// load the pdf to be exported
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($resume->get_name() . '.pdf');
?>
