<?php
// TODO: better error handling???
// TODO: validate the contents of post (is not empty and/or is each field set?)

/* login_backend.php
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

// include 'check_login.php'; 
session_start();
$mysqli = require_once"./db_config.php";
include "./DB_functions.php";
include "./User.php";
include "./valid_funcs.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	throw new Exception("METHOD NOT POST", 1);
}

$username = htmlspecialchars($_POST['username']);
$pwd = htmlspecialchars($_POST['password']);

if (!is_valid_uname($username) || !is_valid_pwd($pwd)) {
	// fail & return to login page
}

$user = new User();
$user->setUserName($username);

$id = $user->exists($mysqli);
if (!$id) {
	throw new Exception("NO USER WITH USERNAME" . $user->getUserName(), 1);
}

if (!$user->confirmPW($mysqli, $pwd)) {
	throw new Exception("INCORRECT PASSWORD", 1);
} else {
	// NOTE: does this need to be in an else given the throw???
	// NOTE: is this what we want to do / how its done?
	if (!isset($_SESSION['user_id'])) {
		$_SESSION['user_id'] = $id;
	}
	$user->pull($mysqli, $id);
	header('Location: ./uHome.php', true);		/*Lewis: Changed location from index to User Page 10/23/24 */ /*11/15/24 uhome.php changed to uhome.php*/
}

?>
