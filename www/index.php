<?php
// testing things to see what works

$mysqli = require_once "./db_config.php"; // assignment not strictly necessary but seems to help lsp, kinda
include "./DB_functions.php";
include "./User.php";
include "./Resume.php";

$sql = "select database();";
$result = $mysqli->query($sql);
$result = $result->fetch_array();
echo 'current db: ' . $result['database()'] . "\n";

// create test user
$test_user = new User();
// $test_user->setID(1);
$test_user->firstName = 'test';
$test_user->lastName = 'user';
$test_user->email = 'test_user@test.test';

print_r($test_user); // "cleaner"
var_dump($test_user); // more precise

echo "testing create function: \n";

$test_user->create($mysqli);
$user_from_db = new User();
$user_from_db->fetch(mysqli: $mysqli, id: 1);

print_r($user_from_db);

// if passing around will need to close last
// dont love
// TODO: investigate
$mysqli->close(); 
?>
