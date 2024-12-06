<?php
// WARN: UNTESTED CODE
// TODO: confirm sessions code & improve session security
// TODO: better error handling???
// TODO: validate the contents of post (is not empty and/or is each field set?)

/* createAcc_backend
*
* Backend processing for account/user creation.
* Checks if user account exists and creates a new one if none found.
*
* Takes in a HTTP POST containing:
*	- firstName
*	- lastName
*	- email address
*	- TODO: needs: userName & PW
*
* Produces:
*	- new user db entry
*	- new user ojb
*	- new user session
*/

// include 'check_login.php'; 
// session_start();
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

if (!is_valid_uname($username) ||
	!is_valid_input($firstName) ||
	!is_valid_input($lastName) ||
	!is_valid_email($email) ||
	!is_valid_pwd($pwd)) {
	// fail & return to login page
	//
}

$user = new User();
$user->setUserName($username);
$user->setFirstName($firstName);
$user->setLastName($lastName);
$user->setEmail($email);
$user->setPW($pwd);

$id = $user->exists($mysqli);
if ($id) {
	throw new Exception("USER ALREADY EXISTS", 1);
} else {
	// NOTE: does this need to be in an else given the throw???
	$id = $user->create($mysqli);
	$user->pull($mysqli, $id);
	// NOTE: is this what we want to do / how its done?
	if (!isset($_SESSION['user_id'])) {
		$_SESSION['user_id'] = $id;
	}
	header('Location: ./index.php', true);
}

?>
