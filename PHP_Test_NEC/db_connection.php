<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$database = "php_test_nec";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
