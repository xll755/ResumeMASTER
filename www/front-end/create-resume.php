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
    <title>Create Resume</title>
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
		body {
            background-color: #fff7ea;  /* Background color for the entire page */
            font-family: Arial, sans-serif;  /* Set a font family for consistency */
            margin: 0;  /* Remove default body margin */
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

        .checkbox_align {
            display: flex
        }

        input[type="checkbox"] {
          width: 16px; /* Standard checkbox size */
          height: 16px;
        }
		 h1 {
            color: #C70039;  /* Match heading color with navigation bar */
        }
		.resume-container {
            max-width: 800px;  /* Maximum width of the container */
            margin: 20px auto;  /* Centering the container and adding top/bottom margin */
            padding: 2em;  /* Spacing inside the container */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Shadow effect */
            background-color: white;  /* Set the background color to contrast with body */
            color: black;  /* Set text color for the container content */
        }
		button[type="submit"] {
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
        /* Button hover effect */
        button[type="submit"]:hover {
            background-color: #5f5441;
        }
    </style>
</head>
    <body>
        <div class="container">
            <nav>
                <ul class="bar">
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./my-resumes.php">My Resumes</a></li>
                    <li><a href="./create-resume.php" class="active">Create Resume</a></li> <!-- Active tab and "web location" -->
                    <li><a href="./example-resume.php">Example Resume</a></li>
                    <li><a href="./edit-user.php">Edit My Information</a></li>
                    <li><a href="./logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <br>
<div class="resume-container">
<?php
$name = $location = $contact = $obj = $job_title1 = $job_exper1 = $job_title2 = $job_exper2 = $job_title3 = $job_exper3 = $education = $additionalInfo = '';
$job_dates1 = $job_dates2 = $job_dates3 = ['', ''];

if (isset($_SESSION['resume_id']) && (isset($_SESSION['from_my']) || isset($_POST['edit']))) {
    $resume_id = $_SESSION['resume_id'];
    unset($_SESSION['from_my']);

    $mysqli = require_once "../back-end/db-config.php";
    include "../back-end/dbfuncs.php";
    include "../back-end/Resume.php";

    $resume = new Resume();
    $resume->pull($mysqli, $resume_id);
    $data = $resume->get_resume();

    // handle persona_info array
    $name = $data['personal_info']['name'];
    $location = $data['personal_info']['location'];
    $contact = $data['personal_info']['contact'];
    $obj = $data['personal_info']['obj'];
    // handle work_info array of arrays
    $job_title1 = $data['work_info']['job_1']['job_title'];
    $job_dates1 = explode('-', $data['work_info']['job_1']['job_dates']);
    $job_exper1 = $data['work_info']['job_1']['job_exper'];
    $job_title2 = $data['work_info']['job_2']['job_title'];
    $job_dates2 = explode('-', $data['work_info']['job_2']['job_dates']);
    $job_exper2 = $data['work_info']['job_2']['job_exper'];
    $job_title3 = $data['work_info']['job_3']['job_title'];
    $job_dates3 = explode('-', $data['work_info']['job_3']['job_dates']);
    $job_exper3 = $data['work_info']['job_3']['job_exper'];
    // handle edu_info array
    $education = $data['edu_info'];
    // handle add_info array
    $additionalInfo = $data['add_info'];
} else {
    unset($_SESSION['resume_id']);
}
?>

    <div class="form-container">
        <center><h1>Create Your Resume</h1></center>
        <form action="./view-resume.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="location">City, State, and Zipcode:</label>
            <textarea id="location" name="location" rows="1" required><?php echo $location; ?></textarea>

            <label for="contact">Phone Number and Email:</label>
            <textarea id="contact" name="contact" rows="1" required><?php echo $contact; ?></textarea>

            <label for="objstmt">Objective Statement:</label>
            <textarea id="objstmt" name="objstmt" rows="3" required><?php echo $obj; ?></textarea>

            <div class="checkbox_align">
                        <label for="objstmt_cb">Would you like AI to improve this?</label>
                        <input type="checkbox" id="objstmt_cb" name="objstmt_cb" value="true"/>
            </div>
            <br>

            <label for="jobTitle1">First Job Title:</label>
            <textarea id="jobTitle1" name="jobTitle1" rows="1" required><?php echo $job_title1; ?></textarea>
			
            <label for="startDate1">Job Start Date: </label>
            <textarea id="startDate1" name="startDate1" rows="1" required><?php echo $job_dates1[0]; ?></textarea>
			
	    <label for="endDate1">Job End Date: </label>
            <textarea id="endDate1" name="endDate1" rows="1" required><?php echo $job_dates1[1]; ?></textarea>

            <label for="workExperience1">Work Experience (Separate entries with a line break):</label>
            <textarea id="workExperience1" name="workExperience1" rows="4" required><?php echo $job_exper1; ?></textarea>

            <div class="checkbox_align">
                        <label for="work1_cb">Would you like AI to improve this?</label>
                        <input type="checkbox" id="work1_cb" name="work1_cb" value="true"/>
            </div>
            <br>
			
			
			
            <label for="jobTitle2">Second Job Title:</label>
            <textarea id="jobTitle2" name="jobTitle2" rows="1"><?php echo $job_title2; ?></textarea>
			
            <label for="startDate2">Job Start Date: </label>
            <textarea id="startDate2" name="startDate2" rows="1"><?php echo $job_dates2[0]; ?></textarea>
			
            <label for="endDate2">Job End Date: </label>
            <textarea id="endDate2" name="endDate2" rows="1"><?php echo $job_dates2[1]; ?></textarea>
			
            <label for="workExperience2">Work Experience (Separate entries with a line break):</label>
            <textarea id="workExperience2" name="workExperience2" rows="4"><?php echo $job_exper2; ?></textarea>

            <div class="checkbox_align">
                        <label for="work2_cb">Would you like AI to improve this?</label>
                        <input type="checkbox" id="work2_cb" name="work2_cb" value="true"/>
            </div>
            <br>
			
			
			
            <label for="jobTitle3">Third Job Title:</label>
            <textarea id="jobTitle3" name="jobTitle3" rows="1"><?php echo $job_title3; ?></textarea>

            <label for="startDate3">Job Start Date: </label>
            <textarea id="startDate3" name="startDate3" rows="1"><?php echo $job_dates3[0]; ?></textarea>
			
            <label for="endDate3">Job End Date: </label>
            <textarea id="endDate3" name="endDate3" rows="1"><?php echo $job_dates3[1]; ?></textarea>
			
            <label for="workExperience3">Work Experience (Separate entries with a line break):</label>
            <textarea id="workExperience3" name="workExperience3" rows="4"><?php echo $job_exper3; ?></textarea>

            <div class="checkbox_align">
                        <label for="work3_cb">Would you like AI to improve this?</label>
                        <input type="checkbox" id="work3_cb" name="work3_cb" value="true"/>
            </div>
            <br>
			
			

            <label for="education">Highest level of Education  (Separate entries with a line break):</label>
            <textarea id="education" name="education" rows="4" required><?php echo $education; ?></textarea>
            <div class="checkbox_align">
                        <label for="edu_cb">Would you like AI to improve this?</label>
                        <input type="checkbox" id="edu_cb" name="edu_cb" value="true"/>
            </div>
            <br>

            <label for="additionalInfo">Additional Information (Separate entries with a line break):</label>
            <textarea id="additionalInfo" name="additionalInfo" rows="4"><?php echo $additionalInfo; ?></textarea>
            <div class="checkbox_align">
                        <label for="info_cb">Would you like AI to improve this?</label>
                        <input type="checkbox" id="info_cb" name="info_cb" value="true"/>
            </div>
            <br>

            <button type="submit" >Create Resume</button>
        </form>
    </div>
</div>
</body>
</html>
