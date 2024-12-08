<?php
// TODO: better error handling???
// TODO: validate the contents of post (is not empty and/or is each field set?)

/* back_end/login-backend.php
*
* Backend processing for user login.
* Verifies that the user exists & confirms their password.
* Creates a User object & inits a session for that user.
*
* Takes in a HTTP POST containing:
*	- userName
*	- passwd
*
* Produces:
*	- user session
*	- user object
*/

// include 'back_end/verify-session.php'; 
session_start();
$mysqli = require_once"./back_end/db-config.php";
include "./back_end/db-funcs.php";
include "./User.php";
include "./back_end/validation-funcs.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	throw new Exception("METHOD NOT POST", 1);
}

$username = htmlspecialchars($_POST['username']);
$pwd = htmlspecialchars($_POST['password']);

$retun_url = './login.php';

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
	header('Location: ./front_end/home.php', true);		/*Lewis: Changed location from index to User Page 10/23/24 */ /*11/15/24 uhome.php changed to uhome.php*/
}

?>
