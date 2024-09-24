<?php
// testing things to see what works

$mysqli = require_once "db_config.php"; // assignment not strictly necessary but seems to help lsp, kinda, kinda
include "User.php";
include "Resume.php";

$sql = "select database();";
$result = $mysqli->query($sql);
$mysqli->close();
$result = $result->fetch_array();
echo 'current db: ' . $result['database()'] . "\n";
$test_user = new User();
$test_user->id = 3;
echo 'test_user obj->id:' . $test_user->id . "\n";

?>
