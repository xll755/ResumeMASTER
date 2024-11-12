<?php
// logout.php

// Start the session
session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the welcome page
header("Location: ./welcome.html");
exit();
?>
