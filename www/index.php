<?php
// testing things to see what works

$mysqli = require_once "./db_config.php"; // assignment not strictly necessary but seems to help lsp, kinda
include "./Validation.php";
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
$test_user->setUserName('test_user');
$test_user->setFirstName('test');
$test_user->setLastName('user');
$test_user->setEmail('test_user@test.test');
$test_user->setPW('passwdHash');
print("show created user obj: \n");
print_r($test_user); // "cleaner"
// var_dump($test_user); // more precise

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
$user_from_db->setUserName("updated_uname");
$user_from_db->push($mysqli);
$user_from_db->pull($mysqli, 1);
print_r($user_from_db);

print("-------------- \n");
print("testing user.push_pull method: \n");
$user_from_db->setFirstName("updated_fname");
$user_from_db->setLastName("update_lname");
$user_from_db->setPW("new_password");
$user_from_db->setEmail("updated_email@email.com");
$user_from_db->push_pull($mysqli);
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
