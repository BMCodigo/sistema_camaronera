<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';


$conectar = new Conexion();
$conexion = $conectar->conectar();


$camaronera = $_POST['camaronera'];
$piscina = $_POST['piscina'];
$corrida = $_POST['corrida'];
$librasRaleo = intval(str_replace(',', '.', $_POST['librasRaleo']));
$librasPesca = intval(str_replace(',', '.', $_POST['librasPesca']));
$precioRaleo = $_POST['precioRaleo'];
$precioPesca = $_POST['precioPesca'];

$sql = "INSERT INTO `precio_venta_pesca`( `id_camaronera`, `id_piscina`, `id_corrida`, `lbs_raleo`, `lbs_pesca`, `precio_raleo`, `precio_pesca`)
VALUES ('$camaronera', '$piscina', '$corrida', '$librasRaleo', '$librasPesca', '$precioRaleo', '$precioPesca')";
$query = mysqli_query($conexion, $sql);
echo '<script>window.history.go(-1);</script>';






