<?php
include "../back-end/verify-session.php";
include "../back-end/validation-funcs.php";
include "../back-end/dbfuncs.php";
include "../back-end/User.php";
$mysqli = require_once "../back-end/db-config.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	throw new Exception("METHOD NOT POST", 1);
}

$user = new User();
$user_id = $_SESSION['user_id'];
$user->pull($mysqli, $user_id);

$username = htmlspecialchars($_POST['userName']);
$firstName = htmlspecialchars($_POST['firstName']);
$lastName = htmlspecialchars($_POST['lastName']);
$email = htmlspecialchars($_POST['emailAddr']);
if (isset($_POST['passwd_curr']) && isset($_POST['passwd_new'])) {
	$pwd_curr = htmlspecialchars($_POST['passwd_curr']);
	$pwd_new = htmlspecialchars($_POST['passwd_new']);
} else {
	$pwd_curr = null;
	$pwd_new = null;

}

$err_msg = '';
$retun_url = '../front-end/edit-user.php';
$is_change = false;

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

if ($pwd_curr != null && $pwd_new != null) {
	if (!is_valid_pwd($pwd_curr) || !is_valid_pwd($pwd_new)) {
		$err_msg = "Invalid password<br>Passwords must be 8 characters or longer & contain one or more uppercase, lowercase, and digit.";
		return_on_failure($err_msg, $retun_url);
	}

	if ($user->getPW() != $pwd_curr) {
		$err_msg = "INCORRECT CURRENT PASSWORD";
		return_on_failure($err_msg, $retun_url);
	} else {
		$user->setPW($pwd_new);
		$is_change = true;
	}
}

if ($user->getUserName() != $username) {
	$user->setUserName($username);
	$is_change = true;
}

if ($user->getFirstName() != $firstName) {
	$user->setFirstName($firstName);
	$is_change = true;
}

if ($user->getLastName() != $lastName) {
	$user->setLastName($lastName);
	$is_change = true;
}

if ($user->getEmail() != $email) {
	$user->setEmail($email);
	$is_change = true;
}


if ($is_change) {
	$user->push($mysqli);
}

header('Location: ../front-end/edit-user.php', true);
?>
