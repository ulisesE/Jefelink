<?php
$servername = "localhost";
$username = "u290360044_lonko";
$dbname = "u290360044_pixels";

// Create connection
$conn = new mysqli($servername, $username, 'lG+$IbNxx9', $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>