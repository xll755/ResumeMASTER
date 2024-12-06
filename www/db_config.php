<?php
// DB creds
define('DB_SERVER', 'db'); //TODO: change if necessary
define('DB_USERNAME', 'dev'); //TODO: change
define('DB_PASSWORD', 'dev'); //TODO: change
define('DB_NAME', 'rm_db'); //TODO: change

// attempt db connection
$connected = false;
do {
	try {
		$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		$connected = true;
	} catch (\Throwable $th) {
	}
} while (!$connected);

// verify connection
if ($mysqli === false) {
	die("ERROR: Could not connect. " . $mysqli->connect_error);
}

return $mysqli;
?>
