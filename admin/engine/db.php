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


	$sql = "SET time_zone = '-06:00';";
	
	if ($conn->query($sql) === TRUE) {
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>