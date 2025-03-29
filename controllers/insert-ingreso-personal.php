<?php

    error_reporting(0);
    include '../models/conexion.php';

    $conectar = new Conexion();
    $conexion = $conectar->conectar();

    $camaronera = $_POST['camaronera'];
    $fecha_ingreso_personal = $_POST['fecha_ingreso_personal'];
    $cargo = $_POST['cargo'];
    $nombres = $_POST['nombres'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $banco = $_POST['banco'];
    $numero_cuenta = $_POST['numero_cuenta'];

    if($camaronera == "1"){
        $camaronera = 'Darsacom';
    }else if($camaronera == "2"){
        $camaronera = 'Aquacamaron';
    }else if($camaronera == "3"){
        $camaronera = 'Jopisa';
    }else if($camaronera == "4"){
        $camaronera = 'Aquanatura';
    }

    $sql = "INSERT INTO `registro_ingreso_personal`(`camaronera`, `fecha_ingreso_personal`, `cargo`, `nombres`, `apellido`, `cedula`, `banco`, `numero_cuenta`)
            VALUES('$camaronera', '$fecha_ingreso_personal', '$cargo', '$nombres',  '$apellido', '$cedula', '$banco', '$numero_cuenta')";
    $query = mysqli_query( $conexion, $sql );

?>
    <script>
        alert(" ¡ Datos registrados ! ", );
        window.location.href="../views/index.php?page=Ingreso-personal";
    </script>
