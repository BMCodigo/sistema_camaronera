<?php

error_reporting(0);
include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$id=$_POST['id'];
$cantidad_ha=$_POST['cantidad_ha'];
$gramaje=$_POST['gramaje_pesca'];
$dias=$_POST['dias_proceso'];
$camaronera = $_POST['camaronera'];

$sqlUpdate="UPDATE `parametro_camaronera_psc` SET `cantidad_ha`='$cantidad_ha', `dias_proceso`='$dias', `gramaje_pesca`='$gramaje' WHERE id_camaronera='$camaronera' AND id_parametro='$id'";
$query = mysqli_query($conexion, $sqlUpdate);

if($query){
    header("Location:../views/index.php?page=Parametros");
exit;
}else{
    echo 'Error en el servidor';
}

