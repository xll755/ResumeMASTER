<?php
	session_start();
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
		    .bar {									   		/* Section defines the bar */
				background-color: rgb(255, 0, 255);  		/* Setting color of background for bar */
				width: 100%;
				height: 40px;
				display: flex;
				list-style-type: none;  
				padding: 0;  
				margin: 0;   
			}
			
			.bar li {										/* This section is for listed items (li) */
				flex-grow: 1;								/* makes even spacing for tabs in bar */					
				border-right: 1px solid rgb(0, 0, 0);		/* Separators color (black vertical line) */
				list-style-type: none; 
			}
			
			.bar li a {						/* This section and below defines anchored listed items */
				color: black;				/* Color of the letters */
				width: 100%;  
				height: 100%; 
				display: flex;
				align-items: center;  		/* centering vertically */
				justify-content: center;  	/* centering horizontally */
				text-decoration: none;  	/* Stops from generating underlines */
			}
			
			.bar li a:hover {						  /* Section defines "hovering" */
				background-color: rgb(180, 175, 255);  /* Setting color for "hovering" over tabs */
			}
			
			.bar li a.active {  					  /* Section defines the active page */
				background-color: rgb(255, 150, 255);  /* Color of the active page's tab */
				color: blue;  						  /* Color of the letters of active page */
				
			
			h1 {					/*This section is for header 1's format*/
				text-align: left;
				font-size: 100%;
				margin: 0;
			}
			h2 [					/*This section is for header 2's format*/
				text-align: right;
				font-size: 100%;
				margin: 0;
			}
			
			.background-container {  /*This section is for the background format*/
				max-width: 800px;
				margin: 0 auto;
				padding: 20px;
				border: 1px solid #ddd;
				box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
			}
			
			body{
				background-color: orange;
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
