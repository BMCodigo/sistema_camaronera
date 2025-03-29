<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera = $_POST['camaronera'];
$fechaActual = $_POST['fechaActual'];
$razon_social = $_POST['razon_social'];
$ruc_cedula = $_POST['ruc_cedula'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$encargado = $_POST['encargado'];

$sqlInsert ="INSERT INTO `registro_proveedor`( `empresa_razon_social`, `ruc_cedula`, `direccion`, `telefono`, `encargado`, `id_camaronera`, `fecha_registro`) 
VALUES ( '$razon_social', '$ruc_cedula', '$direccion', '$telefono', '$encargado', '$camaronera', '$fechaActual')";
$query = mysqli_query($conexion, $sqlInsert);

?>

<script>
    alert(' ¡ Proveedor registrado !');
    window.history.go(-1);
</script>