<?php
include 'check_login.php'; 
?>
<!-- resumePage.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Your Resume</title>
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
            background-color: #5f5441;  /* Background color of active tab */
            color: white;  /* Text color of the active page */
        }
        
        /* Body styling */
        body {
            background-color: #fff7ea;  /* Background color for the entire page */
            font-family: Arial, sans-serif;  /* Set a font family for consistency */
            margin: 0;  /* Remove default body margin */
        }
        /* Base reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Page header styling */
        h1 {
            text-align: center;
            color: #C70039; /* upload your resume text color */
            margin-bottom: 1em;
            font-size: 1.8em;
        }

        /* Form container styling */
        .form-container {
            background-color: #fff;
			margin: 20px auto;  /* Centering the container and adding top/bottom margin */
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        /* Table layout for form fields */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Label and input field styling */
        label {
            display: inline-block;
            font-size: 0.9em;
            color: #555;
            margin-bottom: 0.5em;
        }

        input[type="file"] {
            width: 100%;
            padding: 0.75em;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 1em;
            font-size: 0.9em;
        }

        /* Submit button styling */
        input[type="submit"], .back-button {
             width: 100%;
            padding: 0.75em;
            border: none;
            border-radius: 4px;
            background-color: #9f8c6c;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Hover effect for buttons */
        input[type="submit"]:hover, .back-button:hover {
            background-color: #5f5441;
        }

    </style>
</head>
<body>
    <div class="container">
        <nav>
            <ul class="bar">  <!-- Creating a tab layout on the bar -->
                <li><a href="uHome.php" >Home</a></li>  <!-- Active tab and "web location" -->
                <li><a href="resumePage.php" class="active">Resume Upload</a></li>
                <li><a href="resume_example.php">Resume Example</a></li>
                <li><a href="comparisonF.php">Qualification Comparison</a></li>
				<li><a href="FrontEnd_createResume.php">Create Your Resume</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
		
		<div class="form-container">
        <form action="resumePage_Backend.php" method="POST" enctype="multipart/form-data">
            <table>
			<h1>Upload Your Resume</h1>
                <tr>
                    <td><label for="resume">Upload Resume (PDF only):</label></td>
                </tr>
                <tr>
                    <td><input type="file" id="resume" name="resume" accept=".pdf" required></td>
                </tr>
                <tr>
                    <td>
					<input type="submit" value="Upload">
					</td>
                </tr>
            </table>
        </form>
    </div>

</body>
</html>


