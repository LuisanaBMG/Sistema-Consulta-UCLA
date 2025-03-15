<?php
// Start the session, clear all session variables, destroy the session data, and redirect to login page
session_start();
session_unset(); // Clear all session variables
session_destroy(); // Destroy session data
header("Location: ../Login.php"); // Redirect to login page
?>
