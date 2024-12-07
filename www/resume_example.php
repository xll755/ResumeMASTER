<?php
include 'check_login.php'; 
// session_start();
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Not necessary, but helps w/ scaling with different devices (phones, tablets, etc.) -->
    <title>Resume Example</title>
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
        body {
            background-color: #fff7ea;  /* Background color for the entire page */
            font-family: Arial, sans-serif;  /* Set a font family for consistency */
            margin: 0;  /* Remove default body margin */
        }
  /*This is to make the resume look like (format) it was actually written in word/on paper.*/
        .resume-container {
            max-width: 800px;  /* Maximum width of the container */
            margin: 20px auto;  /* Centering the container and adding top/bottom margin */
            padding: 2em;  /* Spacing inside the container */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Shadow effect */
            background-color: white;  /* Set the background color to contrast with body */
            color: black;  /* Set text color for the container content */
        }

        h1, h2, h3, h4 {
            text-align: center; /*aligning headers 1 -4 to center */
			margin: 0;
        }
		
		p.a {						/*This section alignes paragraphs to the left */					
			text-align: center;
			margin: 0;
		}
		p.b {
			text-align: left;
		}
		
		table {					/*Creating table and establishing spacing */
			width: 100%;
		}
		
		td.a {					/*establishing tables text alignment */
			text-align: left;
		}
		td.b {
			text-align: right;
		}
    </style>
</head>
<body>	<!--This class is for the bar that links back to other pages-->
   <div class="container">
	   <nav>
		    <ul class="bar">  <!-- Creating a tab layout on the bar -->
                <li><a href="uHome.php">Home</a></li>  <!-- Active tab and "web location" -->
                <li><a href="resumePage.php">Resume Upload</a></li>
                <li><a href="resume_example.php"class="active">Resume Example</a></li>
                <li><a href="comparisonF.php">Qualification Comparison</a></li>
				<li><a href="FrontEnd_createResume.php">Create Your Resume</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
	<br>
<!--This class is for the format of the resume example-->
	<div class="resume-container">
		<div>
<!--Personal data-->
			<p class = "a">Name</p>
			<p class = "a">City, State Zipcode</p>
			<p class = "a">Email & Phone #</p>
			<br>
<!-- Work Experience Section -->
            <h2>Work Experience</h2>
            <div>
            <table>
				<tr>
					<td class = "a"><b>First Job + Job Title</b></td> <!--Using table to align left and right on same line-->
                    <td class = "b"><b>Dates worked there</b></td>
                </tr>
            </table>
				<p class = "b">Experience is important. Make sure each bullet point expresses your roles <b>AND</b> reflects the position you're applying for.</p>
				<p class = "b">You want <b>at least</b> three points per section, but if you can only do two, go for it.
				<p class = "b">The Second portion will be an example of a work experience section.</p>
            <hr>
            </div>
			
            <div>
            <table>
				<tr>
					<td class = "a"><b>Kelly Connect – Apple Senior Technical Support Advisor</b></td>
                    <td class = "b"><b>05/2020 – 04/2021</b></td>
				</tr>
            </table>
				<p class = "b">Collaborated with Apple’s engineering team for advanced troubleshooting methods if conventional methods did not resolve software issues related to logging in, cloud services, or internal functions</p>
				<p class = "b">Documented intricate processes of steps taken to diagnose and each step’s result to determine problems with the software or hardware on a specific device.</p>
				<p class = "b"Co-led technical support team, assisting peers with finding internal facing documents to assist with troubleshooting steps and compliance with organization standards pertaining to privacy and security.</p>
            <hr>
            </div>
			
            <div>
            <table>
				<tr>
					<td class = "a"><b>United States Army Counterintelligence Section Leader</b></td>
					<td class = "b"><b>03/2021 - 01/2022</b></td>
                </tr>
            </table>
                <p class = "b">Developed certification tracker for counterintelligence candidates to monitor compliance with standards and qualifications for additional duties.</p>
				<p class = "b">Trained junior counterintelligence personnel in weapon handling, achieving an 85% qualification rate.</p>
				<p class = "b">Managed confidential information with an 100% accuracy rate in distribution and disposal, resulting in successfully maintaining confidentiality.</p>
            <br>
            </div>
            <hr>
				
<!-- Education Section -->
            <h2>Education</h2>
			<div>
            <table>
				<tr>
					<td><b>The University Attended</b></td>
                </tr>
            </table>
				<p>Your Major and graduation date goes here. Feel free to include GPA if desired (and high enough)</p>
                <p>If you also have a minor, add right below (here)</p>
                <hr>
            </div>
				
<!-- Additional Info section -->
			<h3>Additional Information</h3>
			<div>
				<p class = "b">Any Certifications, Projects worked on, stuff you want to include goes here!</p>
			</div>
		</div>
	</div>
</body>
</html>
