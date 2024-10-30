<?php
// resumePage_backend.php
//Updated version of resumePage_backend.php that should fix this issue
session_start();
$mysqli = require_once "./db_config.php";
include "./Validation.php";
include "./DB_functions.php";
include "./Resume.php";

if (!isset($_SESSION['user_id'])) {
    echo 'NO SESSION';
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (!isset($_FILES['resume']) || $_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
        echo 'No file uploaded or there was an upload error!';
        exit();
    }

    $fileTmpPath = $_FILES['resume']['tmp_name'];
    $fileName = $_FILES['resume']['name'];
    $fileSize = $_FILES['resume']['size'];
    $fileType = $_FILES['resume']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Check if it's a PDF file
    if ($fileExtension !== 'pdf') {
        echo 'Only PDF files are allowed!';
        exit();
    }

    // Read file contents into a binary blob
    $blob = file_get_contents($fileTmpPath);
    if ($blob === false) {
        echo 'Error reading file!';
        exit();
    }

    // Store resume data into the database
    $resume = new Resume();
    $resume->set_userId($user_id);
    $resume->set_name(strtolower($fileNameCmps[0]));
    $resume->set_blob($blob);
    $resume_id = $resume->create($mysqli);

    if (!$resume_id) {
        echo 'Error saving resume to database!';
        exit();
    }

    // Retrieve the PDF to confirm it was stored correctly
    $retrievedResume = new Resume();
    if ($retrievedResume->pull($mysqli, $resume_id)) {
        // Check if blob data is retrieved
        if (is_null($retrievedResume->get_blob())) {
            echo 'Error retrieving resume from database!';
            exit();
        }

        // Optionally convert blob to text for debugging
        // echo nl2br(htmlspecialchars($retrievedResume->convert_blob2text()));

        // Redirect user to their page builder after successful upload
        header('Location: user_page_builder.php?resume_id=' . urlencode($resume_id));
        exit();
    } else {
        echo 'Resume retrieval failed. Possible encoding or query error!';
        exit();
    }
}
?>
