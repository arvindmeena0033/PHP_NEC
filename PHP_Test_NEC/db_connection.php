<?php
// Database connection details
$servername = "localhost";
$username = "f0947901_php_test_nec";
$password = "bS5s8iNT";
$database = "f0947901_php_test_nec";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
