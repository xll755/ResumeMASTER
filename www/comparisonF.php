<?php
include 'check_login.php'; 
	// session_start();
?>

<!-- ResumeMASTER
	 Lewis Green
	 CPSC 4910
	 XLL755
	 Version: 1
	 Date: 11/14/2024
-->

<!-- This segment of code will create a page the user can
	 go to in order to compare the job roles for the listed
	 job they are applying for to their resume. The account
	 will accept input from the user, their resume and the job
	 postings qualifications sections. This page will connect to
	 a backend .php file that will pass over the user's input which
	 will be passed through to the AI interactive assistant.
-->

<html>
	<head>
	<title>Comparison Page</title>
		<style>
		/* Section defines the bar */
        .bar {
            background-color: #9f8c6c;  /* Background color for navigation bar */
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
            border: 1px #f1f1f1;  /* Separator color (black vertical line) */
            list-style-type: none;
			border-radius: 5px;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Anchored listed items */
        .bar li a {
            color: white;  /* Text color */
            width: 100%;
            height: 100%;
            display: flex;
			border-radius: 2px;
            align-items: center;  /* Center vertically */
            justify-content: center;  /* Center horizontally */
            text-decoration: none;  /* Remove underline from links */
			transition: background-color 0.3s;
        }
        
        /* Hover effect for navigation links */
        .bar li a:hover {
            background-color: #5f5441;  /* Background color when hovering over tabs */
        }
        
        /* Style for active page link */
        .bar li a.active {
            background-color: #5f5441 ;  /* Background color of active tab */
            color: white;  /* Text color of the active page */
        }
        
        /* Body styling */
        body {
            background-color: #fff7ea;  /* Background color for the entire page */
            font-family: Arial, sans-serif;  /* Set a font family for consistency */
            margin: 0;  /* Remove default body margin */
        }
			
			/* Styling for the container holding content */
        .background-container {
            max-width: 800px;  /* Maximum width of the container */
            margin: 20px auto;  /* Centering the container and adding top/bottom margin */
            padding: 2em;  /* Spacing inside the container */
            border-radius: 8px;  /* Border color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Shadow effect */
            background-color: white;  /* Set the background color to contrast with body */
            color: black;  /* Set text color for the container content */
        }
		
		</style>
	</head>
	<body>
    <div class="container">
        <nav>
            <ul class="bar">  											<!-- Creating a tab layout on the bar --> 
		<li><a href="uHome.php">Home</a></li>	
                <li><a href="resumePage.php">Resume Upload</a></li>
		<li><a href="resume_example.php">Resume Example</a></li>   
                <li><a href="comparisonF.php" class="active">Qualification Comparison</a></li>   <!-- Active tab and "web location" -->
				<li><a href="FrontEnd_createResume.php">Create Your Resume</a></li>
		<li><a href="logout.php">Logout</a></li>
	     </ul>
        </nav>
    </div>
	<br>
	<div class= "background-container">
	<p>this is a test</p>
	</div>
	</body>
</html>



<!-- What I want to create in this file
	 - Two "form" options to accept user input
	 - The "forms" I want in two seperate boxes.
	 - I want a box that outputs interactive assistances feedback below
	 
	 -Total of 3 boxes need to be made. 
	
-->
