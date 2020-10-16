<?php 

	require_once "conexion.php";
	$conexion=conexion();

	$id=$_POST['idusuarios'];
	$sql="CALL sp_obtener_regUsusarios($id)";

	$result=mysqli_query($conexion,$sql);

	$ver=mysqli_fetch_row($result);

	$datos=array(
			'id_usuarios'=>$ver[0],
              'cuentanroU'=>$ver[1],
              'cedulaU'=>$ver[2],
              'valorU'=>$ver[3]
					);
	echo json_encode($datos);
 ?>