<?php

use FontLib\Table\Type\post;

session_start();
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
					border-right: 1px solid black;		/* Separators color (black vertical line) */
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
			
			
				.resume-container {
					max-width: 800px; /*Setting the width */
					margin: 0 auto; /*Centering the container */
					padding: 20px; /*Spacing inside the container */
					border: 1px solid grey; /*border for the container */
					box-shadow: 2px 2px 10px black; /*Coloring to ie shadow casting */
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
				<li><a href="uHome.php">Home</a></li> 		
				<li><a href="resumePage.html">Resume Upload</a></li>	
				<li><a href="resume_example.php">Resume Example</a></li>   <!-- Active tab and "web location" -->
				<li><a href="comparisonF.php">Qualification Comparison</a></li>
				<li><a href="FrontEnd_createResume.php" class="active">Create Your Resume</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</div>
	<br>


<?php
function call_ai($type, $post){
	$command = "/app/.venv/bin/python3 /var/www/html/resumeMasterAI.py " . escapeshellarg($post) . " " . escapeshellarg($type);
	$output = shell_exec($command);
	return $output;
}

function get_contents($type, $post, $improve) {
	if ($improve) {
		$post = call_ai($type, $post);
	}
	return $post;
}

include "./pdf_renderer.php";
$renderer = new pdf_render();
// TODO: create, or fetch & update, DB resume
// optional downloading here??
$info = array(
	'personal_info' => array(
		'name' => $_POST['name'],
		'location' => $_POST['location'],
		'contact' => $_POST['contact'],
		'obj' => get_contents('obj', $_POST['objstmt'], isset($_POST['objstmt_cb'])),
	),
	'work_info' => array(
		'job_1' => array(
			'job_title' => $_POST['jobTitle1'],
			'job_dates' => $_POST['startDate1'] . '-' . $_POST['endDate1'],
			'job_exper' => get_contents('work', $_POST['workExperience1'], isset($_POST['work1_cb'])),
		),
		'job_2' => array(
			'job_title' => $_POST['jobTitle2'],
			'job_dates' => $_POST['startDate2'] . '-' . $_POST['endDate2'],
			'job_exper' => get_contents('work', $_POST['workExperience2'], isset($_POST['work2_cb'])),
		),
		'job_3' => array(
			'job_title' => $_POST['jobTitle3'],
			'job_dates' => $_POST['startDate3'] . '-' . $_POST['endDate3'],
			'job_exper' => get_contents('work', $_POST['workExperience3'], isset($_POST['work3_cb'])),
		),
	),
		'edu_info' => get_contents('edu', $_POST['education'], isset($_POST['edu_cb'])),
		'add_info' => get_contents('info', $_POST['additionalInfo'], isset($_POST['info_cb']))
	);
$html = $renderer->render($info);
print('<div class="resume-container">' .  $html . '</div>');
?>

</body>
</html>
