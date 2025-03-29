<?php

error_reporting(0);
include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera = $_POST['camaronera'];
$encargado = $_POST['encargado'];

$fechaActual = $_POST['fechaActual'];
$piscina = $_POST['piscina'];

$cantidad = $_POST['cantidad'];
$tipo_alimento = $_POST['tipo_alimento'];

$id = $_POST['id'];

$sql_tabla_piscina = "SELECT DISTINCT identificacion FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND id_precria = '$piscina' AND estado = 'En proceso'";
$result_1 = mysqli_query($conexion, $sql_tabla_piscina);
foreach ($result_1 AS $data){
    $corrida = $data['identificacion'];
}

$sql_psc = "SELECT cantidad_balanceado, tipo_balanceado FROM solicitud_balanceados WHERE id_piscina = '$piscina' AND id_corrida = '$corrida' AND id_balanceado = '$id'";
$result = mysqli_query($conexion, $sql_psc);

foreach($result as $key){
    $cant_biologo = $key['cantidad_balanceado'];
    $aabb_biologo= $key['tipo_balanceado'];
}

#validamos que la cantidad no sea mayor y que exista en el ingreso de balanceado
$consulta = "SELECT IF(ti.cant-te.tot_egre > 0,ti.cant-te.tot_egre,-1) * 25 AS disponible FROM ((SELECT *, SUM(t1.cantidad_balanceado) AS cant FROM `ingreso_balanceado` t1 WHERE t1.camaronera ='$camaronera' AND t1.tipo_balanceado = '$tipo_alimento' GROUP BY t1.tipo_balanceado) UNION (SELECT 0,0,0,0,0,0,0,0 AS cant) LIMIT 1) ti, ((SELECT SUM(t3.cantidad_balanceado) / 25 AS tot_egre FROM egreso_balanceado t3 WHERE t3.camaronera ='$camaronera' AND t3.tipo_balanceado = '$tipo_alimento' GROUP BY t3.tipo_balanceado) UNION (SELECT 0) LIMIT 1) te";
$result = mysqli_query($conexion, $consulta);

foreach ($result as $key) {
    $disponible = $key['disponible'];

    if ($disponible < $cantidad) { ?>

        <script>
            alert(" ¡ No tiene cantidad suficiente ! " );
            window.history.go(-1);
        </script>

    <?php
    }else{

        if($cantidad > 0){

            $sql = "INSERT INTO `sugerencia_balanceado`(`fecha_entrega`, `camaronera`, `id_piscina`, `cantidad_balanceado`, `tipo_balanceado`, `encargado`, `psc_pre`, `detalles`, `aprobador_por`, `estatus`, `cant_biologo`, `aabb_biologo`) 
            VALUES ((NOW()),'$camaronera', '$piscina', '$cantidad', '$tipo_alimento', '$encargado', 'Pre', 'Por aprobar', '-------', 1, '$cant_biologo', '$aabb_biologo')";
            $query = mysqli_query($conexion, $sql);
        ?>
            <script>
            alert(" ¡ Datos agregados con éxito ! ");
            window.history.go(-1);
        </script>

    <?php

        } 
    }
}

?>*/