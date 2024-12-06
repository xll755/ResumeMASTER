<?php
include 'check_login.php'; 
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
	 
	 Any additions (except corrections) to code modifies version 
	 and needs to be commented along with editors name.
	 
	 Resources used:
	 Coding For Webpages
	 w3schools
	 
	Nice to do if time permits:
		Fill white space of Page so it isn't empty
		Implement interactive assistant to fill whitespace
-->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <style>
        /* Section defines the bar */
        .bar {
            background-color: #4CAF50;  /* Background color for navigation bar */
            width: 100%;
            height: 40px;
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        /* List items inside the bar */
        .bar li {
            flex-grow: 1;  /* Makes even spacing for tabs in the bar */
            border-right: 2px solid white;  /* Separator color (black vertical line) */
            list-style-type: none;
        }
        
        /* Anchored listed items */
        .bar li a {
            color: white;  /* Text color */
            width: 100%;
            height: 100%;
            display: flex;
			border-radius: 4px;
            align-items: center;  /* Center vertically */
            justify-content: center;  /* Center horizontally */
            text-decoration: none;  /* Remove underline from links */
			transition: background-color 0.3s;
        }
        
        /* Hover effect for navigation links */
        .bar li a:hover {
            background-color: 45a049;  /* Background color when hovering over tabs */
        }
        
        /* Style for active page link */
        .bar li a.active {
            background-color: 45a049 ;  /* Background color of active tab */
            color: white;  /* Text color of the active page */
        }
        
        /* Body styling */
        body {
            background-color: white;  /* Background color for the entire page */
            font-family: Arial, sans-serif;  /* Set a font family for consistency */
            color: white;  /* Set a default text color */
            margin: 0;  /* Remove default body margin */
        }
        
        /* Styling for the container holding content */
        .background-container {
            max-width: 800px;  /* Maximum width of the container */
            margin: 20px auto;  /* Centering the container and adding top/bottom margin */
            padding: 20px;  /* Spacing inside the container */
            border: 1px solid grey;  /* Border color */
            box-shadow: 2px 2px 10px black;  /* Shadow effect */
            background-color: white;  /* Set the background color to contrast with body */
            color: black;  /* Set text color for the container content */
        }
        
        /* Styling for paragraphs */
        p {
            text-align: justify;  /* Justify the text for clean alignment */
            margin: 10px 0;  /* Add top and bottom margin */
            font-size: 1.2em;  /* Set a relative font size for readability */
        }
        
        /* Heading Styling */
        h1 {
            color: #4CAF50;  /* Match heading color with navigation bar */
        }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <ul class="bar">  <!-- Creating a tab layout on the bar -->
                <li><a href="uHome.php" class="active">Home</a></li>  <!-- Active tab and "web location" -->
                <li><a href="resumePage.php">Resume Upload</a></li>
                <li><a href="resume_example.php">Resume Example</a></li>
                <li><a href="comparisonF.php">Qualification Comparison</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
    <br>
    <div class="background-container">
        <center><h1>Welcome To Your User Page!</h1></center>
        <p>Thank you for taking the time to download this repository and getting started! Congratulations, you made it here!
            This is probably a very, very important time in your life and we want to make this transition as seamless as possible.
            One thing you should know about resumes is that they don't necessarily get you the job, they get you a chance to interview for a job.
            Remember to have references; you may need people to vouch for your character and work ethic! Practice for interviews by getting familiar with your profession.
            Always remember there is someone who may be a better candidate working hard to get the same job; you need tenacity, experience, and to reflect on yourself and accomplishments.
        </p>
        <p>Now, this web-based app is here to help you get started with your resume. At the time of writing this, our interactive assistant isn't up yet. Don't fret! We're still working though!</p>
    </div>
</body>
</html>
