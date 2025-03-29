<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fecha_gestion = $_POST['fecha_gestion'];
$camaronera = $_POST['camaronera'];
$id_piscina = $_POST['id_piscina'];
$libras_gestionadas = $_POST['libras_gestionadas'];
$accion = $_POST['accion'];

$cliente = $_POST['cliente'];
$encargado = $_POST['encargado'];
$estado = $_POST['estado'];
$peso_pesca = $_POST['peso_pesca'];

$numero_factura = 'S/N';


$sqlCorrida = "SELECT id_corrida FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$id_piscina' AND estado = 'En proceso'";
$data = $conectar->mostrar($sqlCorrida); 

if($camaronera == 1){
    $camaronera = 'Darsacom';
}else if($camaronera == 2){
    $camaronera = 'Aquacamaron';
}else if($camaronera == 3){
    $camaronera = 'Jopisa';
}else{
    $camaronera = 'Grupo Camaron';
}

foreach($data as $key):
    
    $id_corrida = $key['id_corrida'];

    $sqlInsertGestion = "INSERT INTO `gestion_pesca`( `fecha_gestion`, `camaronera`, `id_piscina`, `id_corrida`, `libras_gestionadas`, `accion`, `cliente`, `encargado`, `estado`, `numero_factura`, `peso_pesca`)
    VALUES ('$fecha_gestion','$camaronera','$id_piscina','$id_corrida','$libras_gestionadas','$accion','$cliente','$encargado','$estado', '$numero_factura', '$peso_pesca')";
    $query1 = mysqli_query($conexion, $sqlInsertGestion);

    $sqlInsertLiquidacion = "INSERT INTO `gestion_pesca_liquidacion`( `fecha_liquidacion`, `camaronera`, `id_piscina`, `id_corrida`, `libras_gestionadas`, `accion`, `cliente`, `encargado`, `estado`, `numero_factura`, `peso_pesca`) 
    VALUES ('$fecha_gestion','$camaronera','$id_piscina','$id_corrida','0.00','$accion','$cliente','$encargado','Solicitado', '$numero_factura', '$peso_pesca')";
    $query2 = mysqli_query($conexion, $sqlInsertLiquidacion);

    $sqlInsertFacturacion = "INSERT INTO `gestion_pesca_facturada`( `fecha_facturado`, `camaronera`, `id_piscina`, `id_corrida`, `libras_gestionadas`, `accion`, `cliente`, `encargado`, `estado`, `checks`, `numero_factura`, `peso_pesca`) 
    VALUES ('$fecha_gestion','$camaronera','$id_piscina','$id_corrida','0.00','$accion','$cliente','$encargado','Solicitado', 'No', '$numero_factura', '$peso_pesca')";
    $query3 = mysqli_query($conexion, $sqlInsertFacturacion);

endforeach;


?>

<script>
    alert("Datos agregados con exito");
    window.location.href="../views/index.php?page=gestion-pesca";
</script>
 




