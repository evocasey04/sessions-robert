<?php
session_start();  // Start the session

require_once '../src/session.php';  // Load the class
$session = new session();           // Create object
$session->forgetSession();          // Call forgetSession method
?>
