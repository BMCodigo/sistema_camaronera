<?php

include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$id = $_GET['id'];
$mensaje = 'Rechazado';
$camaronera = $_GET['camaronera'];

$delete = "DELETE FROM solicitud_balanceados WHERE id_secuencia = '$id' AND camaronera = '$camaronera'";
$query = mysqli_query($conexion, $delete);


$insert = "INSERT INTO `alertas`(`id_secuencia`, `mensaje`, `camaronera`) VALUES ('$id','$mensaje','$camaronera')";
$query = mysqli_query($conexion, $insert);

?>
    <script>
        alert("Solicitud rechazada ! " );
       // window.history.go(-1);
         window.location.href="../views/index.php?page=Aprobacion-solicitud";
    </script>
<?php


?>