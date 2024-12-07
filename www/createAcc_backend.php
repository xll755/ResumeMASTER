<?php
// include 'check_login.php'; 
session_start();
$mysqli = require_once"./db_config.php";
include "./DB_functions.php";
include "./User.php";
include "./valid_funcs.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	throw new Exception("METHOD NOT POST", 1);
}

$username = htmlspecialchars($_POST['userName']);
$firstName = htmlspecialchars($_POST['firstName']);
$lastName = htmlspecialchars($_POST['lastName']);
$email = htmlspecialchars($_POST['emailAddr']);
$pwd = htmlspecialchars($_POST['passwd']);

$err_msg = '';
$retun_url = './createAcc.php';

if (!is_valid_uname($username)) {
	$err_msg = 'bad uname';
	return_on_failure($err_msg, $retun_url);
}

if (!is_valid_input($firstName) || !is_valid_input($lastName)) {
	$err_msg = 'bad names';
	return_on_failure($err_msg, $retun_url);
}

if (!is_valid_email($email)) {
	$err_msg = 'bad email';
	return_on_failure($err_msg, $retun_url);
}

if (!is_valid_pwd($pwd)) {
	$err_msg = 'bad pwd';
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
	header('Location: ./index.php', true);
}

?>
