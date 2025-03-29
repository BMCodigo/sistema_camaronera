<?php

    error_reporting(0);
    date_default_timezone_set('America/Guayaquil'); // Ajusta según tu zona horaria
    include '../models/conexion.php';
    $conectar = new Conexion();
    $conexion = $conectar->conectar();



    $camaronera = $_POST["camaronera"];
    $fechaHoraActual = date("Y-m-d H:i:s");
    
    if($camaronera == 1){
        $empresaId = 115;
    }else if($camaronera == 2){
        $empresaId = 117;
    }else if($camaronera == 3){
        $empresaId = 118;
    }

    $presupuesto_aprobado_manoObra = $_POST['presupuesto_aprobado_manoObra'];
    $ejecutado_camaronera_manoObra = $_POST['ejecutado_camaronera_manoObra'];
    $ejecutado_contabilidad_manoObra = $_POST['ejecutado_contabilidad_manoObra'];
    $manoObra = $_POST['manoObra'];
    $encargado = $_POST['encargado'];

    $presupuesto_aprobado_indirectos = $_POST['presupuesto_aprobado_indirectos'];
    $ejecutado_camaronera_indirectos = $_POST['ejecutado_camaronera_indirectos'];
    $ejecutado_contabilidad_indirectos = $_POST['ejecutado_contabilidad_indirectos'];
    $indirectos = $_POST['indirectos'];
    $encargado = $_POST['encargado'];



    if ($manoObra == 'manoObra') {
            $sqlManoObra = "INSERT INTO `presupuesto_camaronera_general`( `fecha_registro`, `id_camaronera`, `empresaId`, `presupuesto_aprobado`, `ejecutado_camaronera`, `ejecutado_contabilidad`, `descripcion`, `encargado`) 
            VALUES ('$fechaHoraActual', '$camaronera', '$empresaId', '$presupuesto_aprobado_manoObra', '$ejecutado_camaronera_manoObra', '$ejecutado_contabilidad_manoObra', '$manoObra', '$encargado')";
            $query = mysqli_query($conexion, $sqlManoObra);


    } else if ($indirectos == 'indirectos') {
            $sqlIndirectos = "INSERT INTO `presupuesto_camaronera_general`( `fecha_registro`, `id_camaronera`, `empresaId`, `presupuesto_aprobado`, `ejecutado_camaronera`, `ejecutado_contabilidad`, `descripcion`, `encargado`) 
            VALUES ('$fechaHoraActual', '$camaronera', '$empresaId', '$presupuesto_aprobado_indirectos', '$ejecutado_camaronera_indirectos', '$ejecutado_contabilidad_indirectos', '$indirectos', '$encargado')";
            $query = mysqli_query($conexion, $sqlIndirectos);
    }

?>

<script>
    alert("Datos agregados con exito");
    window.location.href="../views/index.php?page=insumostrazabilidad";
</script>
    
      

        
    
   
