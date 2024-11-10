<?php
session_start();
?>
<!-- Lewis Green
	 XLL755
	 Resume Master

The purpose of this code is to provide the user with an example
of what a resume typically may look like. It shows the structure,
I.E. the different sections for personal information, work experience,
education, and additional information. This document was coded using html
and CSS. The CSS used creates two classes, one for the bar that links to other pages
and another class to format the resume so it appears in a familiar
form for the user.
-->


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Not necessary, but helps w/ scaling with different devices (phones, tablets, etc.) -->
    <title>Resume Example</title>
<style>
/*This is for the bar at the top of the page to navigate to different sections.*/
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
    }

  /*This is to make the resume look like (format) it was actually written in word/on paper.*/
        .resume-container {
            max-width: 800px; /*Setting the width */
            margin: 0 auto; /*Centering the container */
            padding: 20px; /*Spacing inside the container */
            border: 1px solid #ddd; /*border for the container */
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1); /*Coloring to ie shadow casting */
        }

        h1, h2, h3, h4 {
            text-align: center; /*aligning headers 1 -4 to center */
        }
    </style>
</head>
<body>	
<!--This class is for the bar that links back to other pages-->
<div class="container">
		<nav>
			<ul class="bar">
				<li><a href="uHome.php">Home</a></li> 		
                <li><a href="resumePage.php">Resume Upload</a></li>				<!-- # are dummy links, replace w/ actual links --> 
                <li><a href="resume_example.php" class="active">Resume Example</a></li>   <!-- Active tab and "web location" -->
				<li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
	<br>
<!--This class is for the format of the resume example-->
	<div class="resume-container">
		<div>
<!--Personal data-->
			<p style="text-align: center;">Name</p>
			<p style="text-align: center;">City, State Zipcode</p>
			<p style="text-align: center;">Email & Phone #</p>
			
<!-- Work Experience Section -->
            <h2>Work Experience</h2>
            <div>
            <table width="100%">
				<tr>
					<td align="left"><b>First Job + Job Title</b></td> <!--Using table to align left and right on same line-->
                    <td align="right"><b>Dates worked there</b></td>
                </tr>
            </table>
				<p>STAR Method: The Situation, The Task, The action you took, and the Result by the action.</p>
				<p>You want <b>at least</b> three points per section, but if you can only do two, go for it.
				<p>The Second portion will be an example of a work experience section.</p>
            <hr>
            </div>
			
            <div>
            <table width="100%">
				<tr>
					<td align="left"><b>Kelly Connect – Apple Senior Technical Support Advisor</b></td>
                    <td align="right"><b>05/2020 – 04/2021</b></td>
				</tr>
            </table>
				<p>Collaborated with Apple’s engineering team for advanced troubleshooting methods if conventional methods did not resolve software issues related to logging in, cloud services, or internal functions</p>
				<p>Documented intricate processes of steps taken to diagnose and each step’s result to determine problems with the software or hardware on a specific device.</p>
				<p>Co-led technical support team, assisting peers with finding internal facing documents to assist with troubleshooting steps and compliance with organization standards pertaining to privacy and security.</p>
            <hr>
            </div>
			
            <div>
            <table width="100%">
				<tr>
					<td align="left"><b>United States Army Counterintelligence Section Leader</b></td>
					<td align="right"><b>03/2021 - 01/2022</b></td>
                </tr>
            </table>
                <p>Developed certification tracker for counterintelligence candidates to monitor compliance with standards and qualifications for additional duties.</p>
				<p>Trained junior counterintelligence personnel in weapon handling, achieving an 85% qualification rate.</p>
				<p>Managed confidential information with an 100% accuracy rate in distribution and disposal, resulting in successfully maintaining confidentiality.</p>
            <br>
            </div>
            <hr>
				
<!-- Education Section -->
            <h2>Education</h2>
			<div>
            <table width="100%">
				<tr>
					<td align="left"><b>The University Attended</b></td>
                </tr>
            </table>
				<p align="left">Your Major and graduation date goes here. Feel free to include GPA if desired (and high enough)</p align="left">
                <p align="left">If you also have a minor, add right below (here)</p align="left">
                <hr>
            </div>
				
<!-- Additional Info section -->
			<h3>Additional Information</h3>
			<div>
				<p align="left">Any Certifications, Projects worked on, stuff you want to include goes here!</p>
			</div>
		</div>
	</div>
</body>
</html>