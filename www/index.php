<?php
// testing things to see what works

$mysqli = require_once "./db_config.php"; // assignment not strictly necessary but seems to help lsp, kinda
include "./DB_functions.php";
include "./User.php";
// include "./Resume.php";

print("reset users for testing:");
$sql = "truncate table users;";
$mysqli->query($sql);

function display_curr_users_in_db(mysqli $mysqli): void
{
	$sql = "select count(*) from users;";
	$result = $mysqli->query($sql);
	$result = $result->fetch_array();
	echo 'current # of users: ' . $result['count(*)'] . "\n";
}

print("-------------- \n");

/*
* here's my vision as of right now:
* we work with user objects "locally"
* then update the db based on the state of the obj
*/

// create test user
$test_user = new User();
// $test_user->setID(1); // set by db
$test_user->userName = 'test_user';
$test_user->firstName = 'test';
$test_user->lastName = 'user';
$test_user->email = 'test_user@test.test';
$test_user->setPW('passwdHash');
print("show created user obj: \n");
print_r($test_user); // "cleaner"
var_dump($test_user); // more precise

print("-------------- \n");
echo "testing user.create method: \n";
display_curr_users_in_db(mysqli: $mysqli);
print("creating db entry for user... \n");
$test_user->create($mysqli);
unset($test_user); // remove test_user obj
display_curr_users_in_db(mysqli: $mysqli);

print("-------------- \n");
print("testing user.pull method on new user obj: \n");
$user_from_db = new User();
$user_from_db->pull(mysqli: $mysqli, id: 1);
print_r($user_from_db);

print("-------------- \n");
print("testing user.push method: \n");
$user_from_db->userName = "updated_uname";
$user_from_db->push($mysqli);
$user_from_db->pull($mysqli, 1);
print_r($user_from_db);

print("-------------- \n");
print("testing user.delete method: \n");
display_curr_users_in_db(mysqli: $mysqli);
print("deleting userId:" . $user_from_db->getID() . "\n");
$user_from_db->delete($mysqli);
display_curr_users_in_db(mysqli: $mysqli);

// if passing around will need to close last
// dont love
// TODO: investigate
$mysqli->close(); 
?>
