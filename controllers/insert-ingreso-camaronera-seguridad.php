<?php
error_reporting(0);
include '../models/conexion.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();



$descripcion_corta = $_POST['descripcion_corta'];
$asiento_id = $_POST['asiento_id'];
$cantidad_solicitada = $_POST['cantidad_solicitada'];
$id_producto = $_POST['id_producto'];
$codigo_cuenta_contable = $_POST['codigo_cuenta_contable'];
$encargado = $_POST['encargado'];
$cantidad_recibida = $_POST['cantidad_recibida'];
$descripcion = $_POST['descripcion'];
$checklist = $_POST['checklist'];
$camaronera = $_POST['camaronera'];

for ($i = 0; $i < count($cantidad_recibida); ++$i) {

$sqls= "INSERT INTO `ingreso_insumos_camaronera_seguridad`(`id_camaronera`, `descripcion_corta`, `asiento_id`, `cantidad_solicitada`, `id_producto`, `codigo_cuenta_contable`, `cantidad_recibida`, `descripcion`, `checklist`, `encargado`) 
    VALUES ('$camaronera', '$descripcion_corta[$i]', '$asiento_id[$i]', '$cantidad_solicitada[$i]', '$id_producto[$i]', '$codigo_cuenta_contable[$i]', '$cantidad_recibida[$i]', '$descripcion[$i]', '$checklist[$i]', '$encargado' )"; echo '</br>';
    
    $query = mysqli_query($conexion, $sqls);

    $sql = "UPDATE comprasfacturasaquapro SET auditoria = 'Autorizado' WHERE AsientoId = '$asiento_id[$i]' AND id_camaronera = '$camaronera'";
    $query = mysqli_query($conexion, $sql);
}


echo '<script>
    alert("Autorizacion de producto registrado!");
    window.location.href = "http://127.0.0.1/aquapro/views/index.php?page=Ingreso_seguridad";
</script>';
