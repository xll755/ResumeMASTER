<?php
// include 'back-end/verify-session.php'; 
session_start();
$mysqli = require_once"./db-config.php";
include "./dbfuncs.php";
include "./User.php";
include "./validation-funcs.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	throw new Exception("METHOD NOT POST", 1);
}

$username = htmlspecialchars($_POST['userName']);
$firstName = htmlspecialchars($_POST['firstName']);
$lastName = htmlspecialchars($_POST['lastName']);
$email = htmlspecialchars($_POST['emailAddr']);
$pwd = htmlspecialchars($_POST['passwd']);

$err_msg = '';
$retun_url = '../front-end/create-account.php';

if (!is_valid_uname($username)) {
	$err_msg = "Invalid username<br>Usernames must be alphanumeric & 1-15 characters in length.";
	return_on_failure($err_msg, $retun_url);
}

if (!is_valid_input($firstName) || !is_valid_input($lastName)) {
	$err_msg = "Invalid input<br>Input must be ...";
	return_on_failure($err_msg, $retun_url);
}

if (!is_valid_email($email)) {
	$err_msg = "Invalid email<br>Emails must adhere to standard format.";
	return_on_failure($err_msg, $retun_url);
}

if (!is_valid_pwd($pwd)) {
	$err_msg = "Invalid password<br>Passwords must be 8 characters or longer & contain one or more uppercase, lowercase, and digit.";
	return_on_failure($err_msg, $retun_url);
}

$user = new User();
$user->setUserName($username);
$id = $user->exists($mysqli);

if ($id) {
	throw new Exception("USER ALREADY EXISTS", 1);
} else {
	$id = $user->create($mysqli, $username, $firstName, $lastName, $email, $pwd);
	$user->pull($mysqli, $id);
	if (!isset($_SESSION['user_id'])) {
		$_SESSION['user_id'] = $id;
	}
	header('Location: ../index.php', true);
}

?>
