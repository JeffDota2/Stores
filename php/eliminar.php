<?php 

	require_once "conexion.php";

	$conexion=conexion();
	$id=$_POST['idusuarios'];
	$sql="CALL sp_eliminar_datos('$id')";
	echo mysqli_query($conexion,$sql);
 ?>