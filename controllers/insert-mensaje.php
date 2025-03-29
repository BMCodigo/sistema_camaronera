<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';


$conectar = new Conexion();
$conexion = $conectar->conectar();

    $camaronera = $_POST['camaronera'];
    $fechaActual = $_POST['fechaActual'];
    $mensaje = $_POST['mensaje'];
    $encargado = $_POST['usuario'];
    $estado = 'Enviado';

    #insertamos datos 
    echo $sql = "INSERT INTO `mensajes`(`fecha_mensaje`, `usuario`, `mensaje`, `estado`, `id_camaronera`) 
            VALUES('$fechaActual', '$encargado', '$mensaje', '$estado', '$camaronera')";
    $query = mysqli_query( $conexion, $sql );
    include '../sms-validacion/is-valid-mensaje.php';
