<?php

error_reporting(0);
include '../models/conexion.php';
include '../models/corrida.php';
include '../views/footer.php';

$objeto = new corrida();

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera = $_POST['camaronera'];
$fechaActual = $_POST['fechaActual'];
$fechacosecha = date("Y-m-d", strtotime($fechaactual . "- 1 days" . "+ 3 month"));
$piscina = $_POST['piscina'];
$libras = $_POST['libras'];
$peso_pesca = $_POST['peso_pesca'];
$densidad = $_POST['densidad'];
$origen = $_POST['origen'];
$nauplio = $_POST['nauplio'];
$laboratorio = $_POST['laboratorio'];
$piscina_destino = $_POST['piscina_destino'];
$encargado = $_POST['user'];


#seleccinamos la corrida hectareas de la piscina que se transfiere
$sql = "SELECT hectareas, MAX(id_corrida) AS corrida FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND estado LIKE 'En proceso'";
$data = $objeto->mostrar($sql);

foreach ($data as $key) {
    intval($corrida_ps_trans = $key['corrida']);
    $ha_ps_envio = $key['hectareas'];
}

#seleccinamos hectareas de la piscina que recibe
$sql = "SELECT hectareas FROM piscina WHERE id_camaronera = '$camaronera' AND piscinas = '$piscina_destino'";
$data = $objeto->mostrar($sql);

foreach ($data as $key) {
    $ha_ps_recibe = $key['hectareas'];
}

#sumamos la cantidad de alimento de la piscina y corrida actuales que se va a transferir
$sql = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND id_corrida = '$corrida_ps_trans'";
$data = $objeto->mostrar($sql);

foreach ($data as $key) {
    $cant_acumu = $key['total'];
}

#calulos de alimento que pertenece a cada piscina
$x_ha = $ha_ps_envio + $ha_ps_recibe;

round($r_x_ha = $cant_acumu / $x_ha, 2);
#ps que transfiere y se resta alimento
echo $bps_envia = round($r_x_ha * $ha_ps_envio, 2);
#ps que recibe y se le agg alimento
echo $bps_recibe = round($r_x_ha * $ha_ps_recibe, 2);

#seleccionamos la corridade la piscina destino
echo $sql = "SELECT MAX(id_corrida) AS corrida FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina_destino'";
$data = $objeto->mostrar($sql);

foreach ($data as $key) {
    intval($corrida = $key['corrida'] + 1);
}

$datos = array($fechaActual, $fechacosecha, $camaronera, $piscina_destino, $ha_ps_recibe, $corrida, $peso_pesca, $densidad, $nauplio, $laboratorio, 'Trifasico', 'En proceso', $encargado);

#validamos que los datos no se encuentren repetidos en la tabla.
$sql = mysqli_query($conexion, "SELECT * FROM registro_piscina_engorde WHERE id_camaronera LIKE '$camaronera' AND id_piscina LIKE '$piscina_destino' AND estado LIKE 'En proceso'");
$query = mysqli_num_rows($sql);

foreach ($sql as $key) {
    $aux = $key['id_corrida'];
    $status = $key['estado'];
}

if ($query > 0) {

    if ($status == 'Cosechado') {
        #mensaje de validacion correcta.
        if ($corrida <= $aux) {
            #mensaje de error
            include '../sms-validacion/is-invalid-pesca.php';
        } else {

            include '../sms-validacion/is-valid-piscina.php';

            #insertamos datos 
            $sql = "INSERT INTO `registro_muestreo`(`fecha_muestreo`, `id_camaronera`, `id_piscina`, `id_corrida`, `peso`, `densidad`, `incremento`, `talla`, `id_usuario`) 
                        VALUES('$fechaActual', '$camaronera', '$piscina_destino', '$corrida', '$peso_pesca', '$densidad', '0.00', '0.00', '$encargado')";
            $query = mysqli_query($conexion, $sql);

            #insertamos el alimento a la ps creada
            $sql_alim = "INSERT INTO `registro_alimentacion_engorde`( `fecha_alimentacion`, `id_camaronera`, `id_piscina`, `id_corrida`, `metodo_alimento`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `tiempo`, `consumo`, `camarones_muertos`, `oxigeno`, `temperatura`, `acumulado_semanal`, `acumulado_total`, `id_usuario`) 
                        VALUES('$fechaActual', '$camaronera', '$piscina_destino', '$corrida', 'Boleo', 25, 25, '$bps_recibe', 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '$bps_recibe', '$encargado')";
            $query = mysqli_query($conexion, $sql_alim);
            
            #insertamos datos en el registro de piscina
            $objeto->insert_run_engorde($datos);
        }
    } else {
        #mensaje de error
        include '../sms-validacion/is-invalid.php';
    }
} else {

    #mensaje de validacion
    include '../sms-validacion/is-valid-piscina.php';

    #insertamos datos 
    $sql = "INSERT INTO `registro_muestreo`(`fecha_muestreo`, `id_camaronera`, `id_piscina`, `id_corrida`, `peso`, `densidad`, `incremento`, `talla`, `id_usuario`) 
                        VALUES('$fechaActual', '$camaronera', '$piscina_destino', '$corrida', '$peso_pesca', '$densidad', '0.00', '0.00', '$encargado')";
    $query = mysqli_query($conexion, $sql);

    #insertamos el alimento a la ps creada
    $sql_alim = "INSERT INTO `registro_alimentacion_engorde`( `fecha_alimentacion`, `id_camaronera`, `id_piscina`, `id_corrida`, `metodo_alimento`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `tiempo`, `consumo`, `camarones_muertos`, `oxigeno`, `temperatura`, `acumulado_semanal`, `acumulado_total`, `id_usuario`) 
                    VALUES('$fechaActual', '$camaronera', '$piscina_destino', '$corrida', 'Boleo', 25, 25, '$bps_recibe', 0.00, 0.00, 0.00, 0, 0.00, 0.00, 0.00, '$bps_recibe', '$encargado')";
    $query = mysqli_query($conexion, $sql_alim);

    #insertamos datos en el registro de piscina
    $objeto->insert_run_engorde($datos);
    
}
