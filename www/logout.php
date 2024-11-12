<?php
// logout.php

// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Set headers to prevent user from going back into account and session never being terminated
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


// Redirect to the welcome page
header("Location: ./welcome.html");
exit();
?>
