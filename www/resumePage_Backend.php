<?php
// resumePage_backend.php

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

    // create new resume obj and save it to db
    // saves the pdf bin to the db
    // DOES NOT set the contents field of the obj
    // this will be handled during the pull() of a given resume into a new obj
    $name = strtolower($fileNameCmps[0]);
    $blob = (string) file_get_contents($fileTmpPath);
    $resume = new Resume();
    $resume->set_userId($user_id);
    $resume->set_name($name);
    $resume->set_blob($blob);
    $resume_id = $resume->create($mysqli);

    unlink($fileTmpPath); // remove tmp file from server

    // Redirect user to a page to assist with developing their page
    // header('Location: {TODO: correct_file_name}.php?resume_id=' . urlencode($resume_id));
    exit();
}
