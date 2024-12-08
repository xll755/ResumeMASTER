<?php
// logout.php

// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Prevent user from going back into account and session never being terminated
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to the welcome page
header("Location: ./index.php");
exit();
?>
