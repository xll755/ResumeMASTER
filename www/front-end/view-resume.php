<?php

use FontLib\Table\Type\post;


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
	
	The purpose of this code is to capture the contents produced
	from the file front-end_create_resume.php and output a useable
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
	<title>View Resume</title>
        <link href="../css/styles.css" rel="stylesheet">
<body>
	<div class="container">
		<nav>
			<ul class="bar">
			    <li><a href="./home.php">Home</a></li>
			    <li><a href="./my-resumes.php" class="active">My Resumes</a></li> <!-- Active tab and "web location" -->
			    <li><a href="./create-resume.php">Create Resume</a></li>
			    <li><a href="./example-resume.php">Example Resume</a></li>
			    <li><a href="./edit-user.php">Edit My Information</a></li>
			    <li><a href="./logout.php">Logout</a></li>
			</ul>
		</nav>
	</div>
	<br>


<?php
function call_ai($type, $post){
	$command = "/app/.venv/bin/python3 /var/www/html/back-end/ai-api-caller.py " . escapeshellarg($post) . " " . escapeshellarg($type);
	$output = shell_exec($command);
	return $output;
}

function get_contents($type, $post, $improve) {
	if ($improve) {
		$post = call_ai($type, $post);
	}
	return $post;
}

function get_next_resume_id($mysqli) {
	$query = "select max(id) from resumes";
	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	if (!isset($row['max(id)'])) {
		return 1;
	} else {
		return $row['max(id)'] + 1;
	}
}

$mysqli = require_once "../back-end/db-config.php";
include "../back-end/resume-renderer.php";
include "../back-end/dbfuncs.php";
include "../back-end/Resume.php";
include "../back-end/User.php";

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

$user_id = $_SESSION['user_id'];
$user = new User();
$user->pull($mysqli, $user_id);

if (!isset($_SESSION['resume_id'])) {
	$next_id = get_next_resume_id($mysqli);
	$resume_name = $user->getLastName() . '-resume-' . $next_id;
	$_SESSION['resume_id'] = $resume->create($mysqli, $user_id, $resume_name, $info);
} else {
	$resume_name = $user->getLastName() . '-resume-' . $_SESSION['resume_id'];
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
	<form action="./create-resume.php" method="POST">
		<input type="hidden" id="edit" name="edit">
		<button type="submit">Edit Resume</button>
	</form>

	<form action="../back-end/resume-download.php" method="POST">
		<button type="submit">Download Resume</button>
	</form>
</div>

</body>
</html>
