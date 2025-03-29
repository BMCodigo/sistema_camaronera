<?php

error_reporting(0);
include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();


$camaronera = $_POST['camaronera'];

if($camaronera == 'Darsacom'){
    $camaronera = 1;
}else if($camaronera == 'Aquacamaron'){
    $camaronera = 2;
}else if($camaronera == 'Jopisa'){
    $camaronera = 3;
}else if($camaronera == 'Aquanatura'){
    $camaronera = 4;
}else if($camaronera == 'Grupo Camaron'){
    $camaronera = 5;
}else{
    $camaronera = 6;
}

$fecha_parametro = $_POST['fecha_parametro'];
$procesoSiembra = $_POST['procesoSiembra'];
$cantidadHa = $_POST['cantidadHa'];

if($cantidadHa > 0){

    $sqlParametros = "INSERT INTO `parametro_camaronera`( `id_camaronera`, `fecha_parametro`, `proceso`, `cantidad_ha`)
    VALUES('$camaronera', '$fecha_parametro', '$procesoSiembra', '$cantidadHa')";
    $query = mysqli_query( $conexion, $sqlParametros );
?>

<script>
    //alert(" ¡ Parametros de camaronera ingresados ! ");
    window.location.href="../views/index.php?page=Parametros";
</script>

<?php }else{ ?>

    <script>
    alert(" ¡ Ingrese cantidad mayor a cero ( 0 ) ! ");
    window.location.href="../views/index.php?page=Parametros";
    </script>;

<?php } ?>
