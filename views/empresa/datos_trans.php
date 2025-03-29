<?php 

include '../models/conexion.php';
error_reporting(0);
$conectar = new Conexion();
$conexion = $conectar->conectar();



$precria=$_POST['provinciaSelect'];


//$sql_cantones = "SELECT * FROM cantones WHERE ID_PROVINCIA LIKE '$provinciaSelect'";
$sql_sec = "SELECT * FROM `registro_piscina_precria` WHERE id_precria = '$id_pre' AND id_camaronera = '$id_cama' AND estado LIKE 'En proceso'";
$result=mysqli_query($conexion,$sql_sec);

	$cadena="
			<select class='datos form-control form-control-sm' id='canton' name='canton'>";

	while ($ver=mysqli_fetch_row($result)) {

		$cadena=$cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
	}

	echo  $cadena."</select>";


