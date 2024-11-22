<?php
session_start();
?>

<!--
	Lewis Green
	xll755
	ResumeMASTER
	
	The purpose of this code is to allow the user to Input
	information that they would want inside a resume. The 
	user will have fields for their name, location, contact,
	work experience, dates, education, and objective statement.
	This code will also syle the page so that it is centered, and
	produces a familiar layout for the user. The objective Statement,
	name, contact information, location, and first blocks for work experience
	are required to submit, all others are optional.
-->

<html>
<head>
    <title>Resume Input</title>
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
		}
		
		
        body {
            margin: 20px;
        }
		
        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }
		
        .form-container input, .form-container textarea, .form-container button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
        }
		
        .form-container label {
            margin-bottom: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
	<div class="container">
		<nav>
			<ul class="bar">
				<li><a href="uHome.php">Home</a></li> 		
				<li><a href="resumePage.html">Resume Upload</a></li> 
				<li><a href="resume_example.php">Resume Example</a></li> 
				<li><a href="comparisonF.php">Qualification Comparison</a></li>
				<li><a href="FrontEnd_createResume.php" class="active">Create Your Resume</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</div>
	<br>


    <div class="form-container">
        <h1>Create Your Resume</h1>
        <form action="createResume.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
			
			<label for="location">City, State, and Zipcode:</label>
            <textarea id="location" name="location" rows="1" required></textarea>

			<label for="contact">Phone Number and Email:</label>
            <textarea id="contact" name="contact" rows="1" required></textarea>

			<label for="objstmt">Objective Statement:</label>
			<textarea id="objstmt" name="objstmt" rows="3" required></textarea>



            <label for="jobTitle1">First Job Title (Separate entries with a line break):</label>
            <textarea id="jobTitle1" name="jobTitle1" rows="1" required></textarea>
			
            <label for="startDate1">Job Start Date: </label>
            <textarea id="startDate1" name="startDate1" rows="1" required></textarea>
			
	    <label for="endDate1">Job End Date: </label>
            <textarea id="endDate1" name="endDate1" rows="1" required></textarea>

            <label for="workExperience1">Work Experience (Separate entries with a line break):</label>
            <textarea id="workExperience1" name="workExperience1" rows="4" required></textarea>
			
			
			
			<label for="jobTitle2">Second Job Title (Separate entries with a line break):</label>
            <textarea id="jobTitle2" name="jobTitle2" rows="1"></textarea>
			
            <label for="startDate2">Job Start Date: </label>
            <textarea id="startDate2" name="startDate2" rows="1"></textarea>
			
			<label for="endDate2">Job End Date: </label>
            <textarea id="endDate2" name="endDate2" rows="1"></textarea>			
			
			<label for="workExperience2">Work Experience (Separate entries with a line break):</label>
            <textarea id="workExperience2" name="workExperience2" rows="4"></textarea>
			
			
			
			<label for="jobTitle3">Third Job Title (Separate entries with a line break):</label>
            <textarea id="jobTitle3" name="jobTitle3" rows="1"></textarea>	

            <label for="startDate3">Job Start Date: </label>
            <textarea id="startDate3" name="startDate3" rows="1"></textarea>
			
			<label for="endDate3">Job End Date: </label>
            <textarea id="endDate3" name="endDate3" rows="1"></textarea>			
			
			<label for="workExperience3">Work Experience (Separate entries with a line break):</label>
            <textarea id="workExperience3" name="workExperience3" rows="4"></textarea>
			
			

            <label for="education">Highest level of Education:</label>
            <textarea id="education" name="education" rows="4" required></textarea>

            <label for="additionalInfo">Additional Information:</label>
            <textarea id="additionalInfo" name="additionalInfo" rows="4"></textarea>

            <button type="submit">Create Resume</button>
        </form>
    </div>
</body>
</html>
