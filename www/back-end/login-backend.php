<?php
session_start();
$mysqli = require_once"./db-config.php";
include "./dbfuncs.php";
include "./User.php";
include "./validation-funcs.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	throw new Exception("METHOD NOT POST", 1);
}

$username = htmlspecialchars($_POST['username']);
$pwd = htmlspecialchars($_POST['password']);

$retun_url = '../front-end/login.php';

if (!is_valid_uname($username)) {
	$err_msg = "Invalid username<br>Usernames must be alphanumeric & 1-15 characters in length.";
	return_on_failure($err_msg, $retun_url);
}

if (!is_valid_pwd($pwd)) {
	$err_msg = "Invalid password<br>Passwords must be 8 characters or longer & contain one or more uppercase, lowercase, and digit.";
	return_on_failure($err_msg, $retun_url);
}

$user = new User();
$user->setUserName($username);
$id = $user->exists($mysqli);

if (!$id) {
	$err_msg = "NO USER WITH USERNAME: <br>" . $user->getUserName();
	return_on_failure($err_msg, $retun_url);
}
if (!$user->confirmPW($mysqli, $pwd)) {
	$err_msg = 'INCORRECT PASSWORD';
	return_on_failure($err_msg, $retun_url);
} else {
	if (!isset($_SESSION['user_id'])) {
		$_SESSION['user_id'] = $id;
	}
	$user->pull($mysqli, $id);
	header('Location: ../front-end/home.php', true);		/*Lewis: Changed location from index to User Page 10/23/24 */ /*11/15/24 uhome.php changed to uhome.php*/
}

?>
