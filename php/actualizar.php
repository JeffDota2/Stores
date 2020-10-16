<?php 

	require_once "conexion.php";

	$conexion=conexion();

	$id_usuarios=$_POST['id_usuarios'];
	$cuentanroU=$_POST['cuentanroU'];
	$cedulaU=$_POST['cedulaU'];
	$valorU=$_POST['valorU'];

	$sql="CALL sp_actualizar_datos('$cuentanroU',
									'$cedulaU',
									'$valorU',
									'$id_usuarios')";
									
	echo mysqli_query($conexion,$sql);
 ?>