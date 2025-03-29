<?php

error_reporting(0);
include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();


if(isset($_GET['cBiTri'])){
    
    $id=$_GET['transferir'];
    $camaronera=$_GET['cBiTri'];

    $sqlPsc="SELECT * FROM parametro_camaronera_psc WHERE id_camaronera = '$camaronera' AND id_parametro = '$id'";
    $resultPsc = $conexion->query($sqlPsc);
    //$resultPsc = $objeto->mostrar($sqlPsc);

    foreach ($resultPsc as $key) {

        $fecha_parametro = $key['fecha_parametro'];
        $camaronera = $key['id_camaronera'];
        $piscinas = $key['id_piscina'];
        $corrida = $key['id_corrida'];
        $procesoSiembra = 'Tri-fasico';
        $cantidadHa = $key['cantidad_ha'];
        $incremSemanas = $key['incre_3_sem'];
        $diasProceso = $key['dias_proceso'];
        $pesoPesca = $key['gramaje_pesca'];
        $gr_dias = $key['gr_dias'];



        $sqlParametros = "INSERT INTO `parametro_camaronera_psc`( `fecha_parametro`, `id_camaronera`, `id_piscina`, `id_corrida`, `proceso`, `cantidad_ha`, `incre_3_sem`, `dias_proceso`, `gramaje_pesca`, `gr_dias`)
        VALUES('$fecha_parametro', '$camaronera', '$piscinas', '$corrida', 'Tri-fasico', '$cantidadHa', '$incremSemanas', '$diasProceso', '$pesoPesca','$gr_dias')";
        $query = mysqli_query( $conexion, $sqlParametros );

        if($query){

            $sqleliminar = "DELETE FROM parametro_camaronera_psc WHERE id_parametro  = $id";
            if ($conexion->query($sqleliminar) === TRUE) { ?>
                <script>
                    window.location.href="../views/index.php?page=Parametros";
                </script>
            <?php } 
        }
    }

}else if(isset($_GET['cTriBi'])){

    $id=$_GET['transferir'];
    $camaronera=$_GET['cTriBi'];

    $sqlPsc="SELECT * FROM parametro_camaronera_psc WHERE id_camaronera = '$camaronera' AND id_parametro = '$id'";
    $resultPsc = $conexion->query($sqlPsc);
    //$resultPsc = $objeto->mostrar($sqlPsc);

    foreach ($resultPsc as $key) {

        $fecha_parametro = $key['fecha_parametro'];
        $camaronera = $key['id_camaronera'];
        $piscinas = $key['id_piscina'];
        $corrida = $key['id_corrida'];
        $procesoSiembra = 'Tri-fasico';
        $cantidadHa = $key['cantidad_ha'];
        $incremSemanas = $key['incre_3_sem'];
        $diasProceso = $key['dias_proceso'];
        $pesoPesca = $key['gramaje_pesca'];
        $gr_dias = $key['gr_dias'];



        $sqlParametros = "INSERT INTO `parametro_camaronera_psc`( `fecha_parametro`, `id_camaronera`, `id_piscina`, `id_corrida`, `proceso`, `cantidad_ha`, `incre_3_sem`, `dias_proceso`, `gramaje_pesca`, `gr_dias`)
        VALUES('$fecha_parametro', '$camaronera', '$piscinas', '$corrida', 'Bi-fasico', '$cantidadHa', '$incremSemanas', '$diasProceso', '$pesoPesca','$gr_dias')";
        $query = mysqli_query( $conexion, $sqlParametros );

        if($query){

            $sqleliminar = "DELETE FROM parametro_camaronera_psc WHERE id_parametro  = $id";
            if ($conexion->query($sqleliminar) === TRUE) { ?>
                <script>
                    window.location.href="../views/index.php?page=Parametros";
                </script>
            <?php } 
        }
    }

} 

?>