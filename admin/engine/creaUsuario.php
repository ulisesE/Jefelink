<?php
include 'db.php';

$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$email = $_GET['email'];
$status = "";
$sql = "CALL creaUsuario('$nombre', '$apellido','$email');";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  $status = "usuarioCreado";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  $status = "errorCrearUsuario";
}

header("location: /?usuario=$status");

