<?php
include 'db.php';

$opc = $_GET['opc'];
$_GET[controles] = 1;
if ($opc=="rentar") {
	$sql = "CALL crearRenta($_GET[usuario],$_GET[equipo],$_GET[controles]);";
	
	echo "$sql";
	
	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  $status = "rentaCreada";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	  $status = "errorRenta";
	}

	
}else if ($opc=="actualizar") {
	$sql = "CALL actualizaTiempo($_GET[folio],'$_GET[tiempo]');";
	
	echo "$sql";
	
	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  $status = "actualizacionCorrecta";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	  $status = "errorActualizar";
	}
}else if ($opc=="cerrarTiempo") {
	$sql = "CALL cerrarTiempoActual($_GET[folio]);";
	echo "$sql";
	
	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  $status = "cerrarExitoso";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	  $status = "errorCerrar";
	}
}else if ($opc=="cobrar") {
	$sql = "CALL cobrar($_GET[folio]);";
	echo "$sql";
	
	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  $status = "cerrarExitoso";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	  $status = "errorCerrar";
	}
}else if ($opc=="pagado") {
	$sql = "CALL rentaPagada($_GET[folio]);";
	echo "$sql";
	
	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  $status = "pagadaExitoso";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	  $status = "pagadaCerrar";
	}
}


header("location: /?tiempo=$status");