<?php 

	require_once "conexion.php";

	$conexion=conexion();

	$cuentanro=$_POST['cuentanro'];
	$cedula=$_POST['cedula'];
	$valor=$_POST['valor'];

	$sql="CALL sp_insertar_datos('$cuentanro','$cedula','$valor')";

	echo mysqli_query($conexion,$sql);

 ?>