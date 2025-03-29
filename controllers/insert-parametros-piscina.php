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
$pesoPesca = $_POST['pesoPesca'];
$diasProceso = $_POST['diasProceso'];


    $sqlSimulacion="SELECT 
    ts.id_camaronera, ts.piscinas, ts.id_corrida, ts.peso_final, ts.incremento, ts.incrprm3s, ts.gr_dias
    FROM simulacion_proceso ts, registro_piscina_engorde t3
    WHERE ts.Dias = (SELECT MAX(ti.Dias) FROM simulacion_proceso ti WHERE ti.id_camaronera = ts.id_camaronera AND ti.piscinas = ts.piscinas AND ti.id_corrida = ts.id_corrida) 
    AND ts.ciclos = 'Actual' 
    AND ts.id_bio = 'BW 6 d?' 
    AND ts.id_camaronera = '$camaronera'
    AND ts.id_camaronera = t3.id_camaronera
    AND ts.piscinas = t3.id_piscina
    AND ts.id_corrida = t3.id_corrida
    AND t3.estado = 'En proceso'

    GROUP BY ts.id_camaronera, ts.piscinas
    ORDER BY ts.id_camaronera, ts.piscinas, ts.id_corrida  ASC";
    $resultsimulacion = $conexion->query($sqlSimulacion);

    foreach ($resultsimulacion as $key) {

        $incremSemanas = $key['incrprm3s'];
        $piscinas = $key['piscinas'];
        $corrida = $key['id_corrida'];
        $gr_dias = $key['gr_dias'];
   
            $sqlParametros = "INSERT INTO `parametro_camaronera_psc`( `fecha_parametro`, `id_camaronera`, `id_piscina`, `id_corrida`, `proceso`, `cantidad_ha`, `incre_3_sem`, `dias_proceso`, `gramaje_pesca`, `gr_dias`)


            VALUES('$fecha_parametro', '$camaronera', '$piscinas', '$corrida', '$procesoSiembra', '$cantidadHa', '$incremSemanas', '$diasProceso', '$pesoPesca','$gr_dias')";
            $query = mysqli_query( $conexion, $sqlParametros );
  
    }
?>

<script>
    window.location.href = "../views/index.php?page=Parametros";
</script>
