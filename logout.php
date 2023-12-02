<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Optionally, redirect to the login page or home page after logging out
header("Location: login.php");
exit;
?>
