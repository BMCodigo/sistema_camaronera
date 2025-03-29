<?php

    error_reporting(0);
    include '../models/conexion.php';

    $conectar = new Conexion();
    $conexion = $conectar->conectar();

    $camaronera = $_POST['camaronera'];
    $fecha_salida_personal = $_POST['fecha_salida_personal'];
    $cargo = $_POST['cargo'];
    $nombres = $_POST['nombres'];
    $apellido = $_POST['apellido'];
    $cedula = $_POST['cedula'];
    $motivo = $_POST['motivo'];

    if($camaronera == "1"){
        $camaronera = 'Darsacom';
    }else if($camaronera == "2"){
        $camaronera = 'Aquacamaron';
    }else if($camaronera == "3"){
        $camaronera = 'Jopisa';
    }else if($camaronera == "4"){
        $camaronera = 'Aquanatura';
    }else if($camaronera == ""){
        $camaronera = 'Grupo Camaron';
    }else if($camaronera == 6){
                echo 'Calica';
            }

    echo $sql = "INSERT INTO `registro_salida_personal`(`camaronera`, `fecha_salida_personal`, `cargo`, `nombres`, `apellido`, `cedula`, `motivo`)
            VALUES('$camaronera', '$fecha_salida_personal', '$cargo', '$nombres',  '$apellido', '$cedula', '$motivo')";
    $query = mysqli_query( $conexion, $sql );

?>
    <script>
        alert(" ¡ Datos registrados ! ", );
        window.location.href="../views/index.php?page=Salida-personal";
    </script>
