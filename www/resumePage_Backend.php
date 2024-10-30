<?php
// resumePage_backend.php

session_start();
$mysqli = require_once"./db_config.php";
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

    $name = strtolower($fileNameCmps[0]);
    $blob = (string) file_get_contents($fileTmpPath);
    // echo mb_strlen($blob, '8bit');
    // var_dump($blob);

   
    $resume = new Resume();
    $resume->set_userId($user_id);
    $resume->set_name($name);
    $resume->set_blob($blob);
    // print($resume->get_blob());
    // $resume_id = $resume->create($mysqli);
    $resume_id = 12; // w/o slashes
    $r = new Resume();
    $r->pull($mysqli, $resume_id);
    // $r->convert_blob2text();
    // // var_dump($r);
    // $r->print();
    // // Directory where uploaded PDFs will be saved
    // $uploadFileDir = './uploaded_resumes/';
    // $dest_path = $uploadFileDir . $fileName;
    //
    // // Move file to the desired folder
    // if (!move_uploaded_file($fileTmpPath, $dest_path)) {
    //     echo 'There was some error moving the file to the upload directory.';
    //     exit();
    // }

    // Redirect user to a page to assist with developing their page
    // header('Location: user_page_builder.php?file=' . urlencode($fileName));
    exit();
}
