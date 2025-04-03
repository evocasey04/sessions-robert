<?php
$host = 'localhost';
$db = 'php_login_lab';
$user = 'root';
$pass = 'Ehw2019!'; // or your password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
