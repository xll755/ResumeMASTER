<?php
// WARN: UNTESTED CODE
// TODO: confirm sessions code & improve session security
// TODO: better error handling???

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

$mysqli = require_once"./db_config.php";
include "./Validation.php";
include "./DB_functions.php.php";
include "./User.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	throw new Exception("METHOD NOT POST", 1);
}

$user = new User();
$user->setUserName($_POST['username']);

$id = $user->exists($mysqli);
if (!$id) {
	throw new Exception("NO USER WITH USERNAME" . $user->getUserName(), 1);
}

$user->setPW($_POST['password']);

if (!$user->confirmPW($mysqli)) {
	throw new Exception("INCORRECT PASSWORD", 1);
}

session_start();
// NOTE: is this what we want to do / how its done?
if (!isset($_SESSION['id'])) {
	$_SESSION['user_id'] = $id;
}

$user->pull($mysqli, $id);
?>
