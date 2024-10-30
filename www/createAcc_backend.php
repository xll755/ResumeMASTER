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

session_start();
$mysqli = require_once"./db_config.php";
include "./Validation.php";
include "./DB_functions.php";
include "./User.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
	throw new Exception("METHOD NOT POST", 1);
}

$user = new User();
$user->setUserName($_POST['userName']);
$user->setFirstName($_POST['firstName']);
$user->setLastName($_POST['lastName']);
$user->setEmail($_POST['emailAddr']);
$user->setPW($_POST['passwd']);

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
	header('Location: ./index.html', true);
}

?>
