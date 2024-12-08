<?php
include '../back-end/verify-session.php'; 
// session_start();
// if (!isset($_SESSION['user_id'])) {
//     header("Location: index.php");
//     exit();
// }
//
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
?>

<!-- ResumeMASTER
Lewis Green
CPSC 4910
XLL755
Version: 2
Date: 11/13/2024
-->

<!-- This segment of code will create the user page which
the user will be directed to after they successfully
login. This will serve as their "main" page which gives
them access to ResumeMASTER features. This page will utilize 
CSS and HTML. The tabs created will be Home, Resume Upload,
and logout. Others may be added along development

Resources used:
Coding For Webpages
w3schools
-->

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="../css/styles.css" rel="stylesheet">
    </head>
    <body>
        <nav>
            <ul class="bar">  <!-- Creating a tab layout on the bar -->
                <li><a href="./home.php" class="active">Home</a></li> <!-- Active tab and "web location" -->
                <li><a href="./my-resumes.php">My Resumes</a></li>
                <li><a href="./create-resume.php">Create Resume</a></li>
                <li><a href="./example-resume.php">Example Resume</a></li>
                <li><a href="./edit-user.php">Edit My Information</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </nav>
        <br>
        <div class="background-container">
            <center><h1>Welcome To Your User Page!</h1></center>
            <p>Thank you for taking the time to download this repository and getting started! Congratulations, you made it here!
                This is probably a very, very important time in your life and we want to make this transition as seamless as possible.
                One thing you should know about resumes is that they don't necessarily get you the job, they get you a chance to interview for a job.
                Remember to have references; you may need people to vouch for your character and work ethic! Practice for interviews by getting familiar with your profession.
                Always remember there is someone who may be a better candidate working hard to get the same job; you need tenacity, experience, and to reflect on yourself and accomplishments.
            </p>
            <p>Now, this web-based app is here to help you get started with your resume!</p>
        </div>
    </body>
</html>

