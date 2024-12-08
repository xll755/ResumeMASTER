<?php

use FontLib\Table\Type\post;


include 'back_end/verify-session.php'; 
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
	
	The purpose of this code is to capture the contents produced
	from the file front_end_create_resume.php and output a useable
	resume. This file uses php functions such as nl2br to create a
	new line each time the user pressed entered, separating them in
	work experience. The style used is to format the page into a resume
	as well as aligning text in paragraph, putting dates in a table on
	the same line, and headers being aligned. htmlspecialchars is used
	to convert characters into "regular" characters for html. This file
	also utilizes tables for aligning dates.
-->


<html>
	<head>
		<title>Generated Resume</title>
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
	    .resume-container {
		    max-width: 800px;  /* Maximum width of the container */
            margin: 20px auto;  /* Centering the container and adding top/bottom margin */
            padding: 2em;  /* Spacing inside the container */
            border-radius: 8px;  /* Border color */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Shadow effect */
            background-color: white;  /* Set the background color to contrast with body */
            color: black;  /* Set text color for the container content */
				}

				h1, h2, h3{
					text-align: center; /*aligning headers 1-3 to center */
					margin: 0;
				}
		
				p.a {					/*This section alignes paragraphs to the left */					
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
<body>
	<div class="container">
		<nav>
			<ul class="bar">
				<li><a href="front_end/home.php" class="active">Home</a></li>  <!-- Active tab and "web location" -->
				<li><a href="./front_end/my-resumes.php">My Resumes</a></li>
				<li><a href="./front_end/create-resume.php">Create Resume</a></li>
				<li><a href="front_end/example-resume.php">Example Resume</a></li>
				<!-- <li><a href="comparisonF.php">Qualification Comparison</a></li> -->
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</div>
	<br>


<?php
function call_ai($type, $post){
	$command = "/app/.venv/bin/python3 /var/www/html/back_end/ai-api-caller.py " . escapeshellarg($post) . " " . escapeshellarg($type);
	$output = shell_exec($command);
	return $output;
}

function get_contents($type, $post, $improve) {
	if ($improve) {
		$post = call_ai($type, $post);
	}
	return $post;
}

$mysqli = require_once "./back_end/db-config.php";
include "./back_end/resume-renderer.php";
include "./back_end/db-funcs.php";
include "./Resume.php";

$renderer = new pdf_render();
$resume = new Resume();

if (isset($_SESSION['resume_id']) &&  isset($_SESSION['from_my'])) {
	$resume->pull($mysqli, $_SESSION['resume_id']);
	$info = $resume->get_resume();
} else {
	$info = array(
		'personal_info' => array(
			'name' => htmlspecialchars($_POST['name']),
			'location' => htmlspecialchars($_POST['location']),
			'contact' => htmlspecialchars($_POST['contact']),
			'obj' => get_contents('obj', htmlspecialchars($_POST['objstmt']), isset($_POST['objstmt_cb'])),
		),
		'work_info' => array(
			'job_1' => array(
				'job_title' => htmlspecialchars($_POST['jobTitle1']),
				'job_dates' => htmlspecialchars($_POST['startDate1'] . '-' . $_POST['endDate1']),
				'job_exper' => get_contents('work', htmlspecialchars($_POST['workExperience1']), isset($_POST['work1_cb'])),
			),
			'job_2' => array(
				'job_title' => htmlspecialchars($_POST['jobTitle2']),
				'job_dates' => htmlspecialchars($_POST['startDate2'] . '-' . $_POST['endDate2']),
				'job_exper' => get_contents('work', htmlspecialchars($_POST['workExperience2']), isset($_POST['work2_cb'])),
			),
			'job_3' => array(
				'job_title' => htmlspecialchars($_POST['jobTitle3']),
				'job_dates' => htmlspecialchars($_POST['startDate3'] . '-' . $_POST['endDate3']),
				'job_exper' => get_contents('work', htmlspecialchars($_POST['workExperience3']), isset($_POST['work3_cb'])),
			),
		),
		'edu_info' => get_contents('edu', htmlspecialchars($_POST['education']), isset($_POST['edu_cb'])),
		'add_info' => get_contents('info', htmlspecialchars($_POST['additionalInfo']), isset($_POST['info_cb'])),
		);
}

$resume_name = 'test_resume'; // TODO: handle resume name creation

if (!isset($_SESSION['resume_id'])) {
	$_SESSION['resume_id'] = $resume->create($mysqli, $_SESSION['user_id'], $resume_name, $info);
} else {
	$resume->setID($_SESSION['resume_id']);
	$resume->set_name($resume_name);
	$resume->set_resume($info);
	$resume->push($mysqli);
}

$html = $renderer->render($info);
print('<div class="resume-container">' .  $html . '</div>');

?>

<div style="text-align: center">
	<br>
	<form action="./front_end/create-resume.php" method="POST">
		<button type="submit">Edit Resume</button>
	</form>

	<form action="./back_end/resume-download.php" method="POST">
		<button type="submit">Download Resume</button>
	</form>
</div>

</body>
</html>
