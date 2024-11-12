<?php
// logout.php

// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Set headers to prevent page caching
header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies.


// Redirect to the welcome page
header("Location: ./welcome.html");
exit();
?>
