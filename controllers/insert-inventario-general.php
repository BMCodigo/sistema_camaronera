<?php
error_reporting(0);
include '../models/conexion.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();
$camaronera =$_POST["camaronera"];
$fechaActual =$_POST["fechaActual"];
$piscinas =$_POST["piscina"];
$corridas =$_POST["corrida"];
$insumo =$_POST["producto"];
$cantidades =$_POST["cantidad"];
$tipo =$_POST["tipo"];
$encargado = $_POST["encargado"];


    $get = "SELECT id_insumos, costo_actual, familia, medida FROM insumos_camaronera WHERE producto = '$insumo' AND estado = 1";
    $dataCosto = $conectar->mostrar($get); 

    foreach ($dataCosto as $key):
        $costo = $key['costo_actual'];
        $medida = $key['medida'];
        $familia = $key['familia'];
    endforeach;

    $sqlpsc = "SELECT id_corrida, hectareas FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscinas' AND estado = 'En proceso'";
    $data = $conectar->mostrar($sqlpsc); 

    foreach ($data as $key):
        $corrida = $key['id_corrida'];
        $hectareas = $key['hectareas'];
    endforeach;

    $total = $cantidades*$costo;
    $total_ha = $total/$hectareas;

    $sqls= "INSERT INTO `costos_camaronera`( `fecha_consumo`, `id_camaronera`, `id_piscina`, `id_corrida`, `hectareas`, `familia`, `producto`, `medida`, `cantidad`, `costo`, `total`, `total_ha`, `responsable`)
            VALUES ('$fechaActual', '$camaronera', '$piscinas', '$corrida', '$hectareas', '$familia', '$insumo', '$medida', '$cantidades', '$costo', '$total', '$total_ha', '$encargado')";  
    $query = mysqli_query($conexion, $sqls);

    ?>

    <script>
        alert("Datos agregados con exito");
        window.location.href="../views/index.php?page=insumos";
    </script>
     
      

        
    
    ?>

