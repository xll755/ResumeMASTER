<?php
// DB creds
$env = parse_ini_file("../../.env");
define('DB_SERVER', $env["DB_SERVER"]);
define('DB_USERNAME', $env["MYSQL_USER"]);
define('DB_PASSWORD', $env["MYSQL_PASSWORD"]);
define('DB_NAME', $env["MYSQL_DATABASE"]);

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
