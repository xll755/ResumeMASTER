<?php
// resumePage_backend.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['resume']['tmp_name'];
        $fileName = $_FILES['resume']['name'];
        $fileSize = $_FILES['resume']['size'];
        $fileType = $_FILES['resume']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Check if it's a PDF file
        if ($fileExtension === 'pdf') {
            // Directory where uploaded PDFs will be saved
            $uploadFileDir = './uploaded_resumes/';
            $dest_path = $uploadFileDir . $fileName;

            // Move file to the desired folder
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Redirect user to a page to assist with developing their page
                header('Location: user_page_builder.php?file=' . urlencode($fileName));
                exit();
            } else {
                echo 'There was some error moving the file to the upload directory.';
            }
        } else {
            echo 'Only PDF files are allowed!';
        }
    } else {
        echo 'No file uploaded or there was an upload error!';
    }
}
?>

