<?php
/*
* Include this file on any page that should require an active SESSION in order
* to be viewed.
*/
session_start();
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
