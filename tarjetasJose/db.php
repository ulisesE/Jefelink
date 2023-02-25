<?php
$servername = "localhost";
$username = "u290360044_beta";
$dbname = "u290360044_jose";

// Create connection
$conn = new mysqli($servername, $username, '$5[ANvU+vH', $dbname);
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