<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fecha_liquidacion = $_POST['fecha_liquidacion'];
$libras_pesca = $_POST['libras_pesca'];
$estado = $_POST['estado'];
$id = $_POST['id'];
$encargado = $_POST['encargado'];
$numero_factura = $_POST['numero_factura'];

if($estado == 'Procesado'){
    
    $sqlUpdateLiquidacion = "UPDATE `gestion_pesca_liquidacion` SET `fecha_liquidacion` = '$fecha_liquidacion', `libras_gestionadas` = '$libras_pesca', `encargado` = '$encargado', `estado` = '$estado', `numero_factura` = '$numero_factura' WHERE id_liquidacion = '$id'";
    $query1 = mysqli_query($conexion, $sqlUpdateLiquidacion);
    //echo '</br>';
    $sqlUpdateFacturado = "UPDATE `gestion_pesca_facturada` SET `fecha_facturado` = '$fecha_liquidacion', `libras_gestionadas` = '$libras_pesca', `encargado` = '$encargado', `estado` = 'Procesado', `checks` = 'No', `numero_factura` = '$numero_factura'  WHERE id_facturado = '$id'";
    $query2 = mysqli_query($conexion, $sqlUpdateFacturado); 

}else if($estado == 'Facturado'){

    $sqlUpdateFacturadoAprobado = "UPDATE `gestion_pesca_facturada` SET  `encargado` = '$encargado', `estado` = 'Facturado' , `checks` = 'Si', `numero_factura` = '$numero_factura'  WHERE id_facturado = '$id'";
    $query3 = mysqli_query($conexion, $sqlUpdateFacturadoAprobado);

    $sqlUpdateLiquidacionNumero = "UPDATE `gestion_pesca_liquidacion` SET `numero_factura` = '$numero_factura' WHERE id_liquidacion = '$id'";
    $query4 = mysqli_query($conexion, $sqlUpdateLiquidacionNumero);

    $sqlUpdateLiquidacionGestion = "UPDATE `gestion_pesca` SET `numero_factura` = '$numero_factura' WHERE id_gestion = '$id'";
    $query5 = mysqli_query($conexion, $sqlUpdateLiquidacionGestion);

}else{
    echo 'Error en la conexion con la base de datos';
}


?>

<script>
    alert("Datos actualizados con exito");
    window.location.href="../views/index.php?page=gestion-pesca";
</script>
 




