<?php 

date_default_timezone_set("America/Guayaquil");
$objeto = new corrida();
$conectar = new Conexion();
$conexion = $conectar->conectar();

// Obtiene la fecha del domingo pasado (inicio de la semana actual)
$domingo_cuatro_semanas = date('Y-m-d', strtotime('last Sunday - 3 weeks'));
$domingo_tres_semanas = date('Y-m-d', strtotime('last Sunday - 2 weeks'));
$domingo_dos_semanas = date('Y-m-d', strtotime('last Sunday - 1 week'));
$domingo_pasado = date('Y-m-d', strtotime('last Sunday'));
$miercoles_actual = date('Y-m-d', strtotime('Wednesday this week'));
$semana_actual = date('W');

?>


    <div class="row">
            <div class="col-12">
                <div class="px-0 pb-2">
            <div class="media">
        <img src="../src/img/grupo_vasco_2.png" class="mr-3" alt="grupo vasco" style="width:80px;">
        <div class="media-body">
            <h4 class="mt-0" style="color: #081665;">Alimentacion diaria de piscinas y precrias.</h4>
            <p style="color: #081665;"> Datos de alimentacion diaria de cada piscinas y precrias en proceso. </p>
        </div>
    </div>

    <?php
// Obtener la semana actual si no se ha seleccionado ninguna
$semanaSeleccionada = isset($_GET['semana']) ? intval($_GET['semana']) : date('W');

// Calcular las fechas de inicio y fin de la semana seleccionada
$inicio_semana = date('Y-m-d', strtotime("Monday this week", strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));
$fin_semana = date('Y-m-d', strtotime("Sunday this week", strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));
?>

<div class="container text-center d-flex justify-content-center align-items-center" style="margin-top:1px;">
    <div class="col-5">
        <p class="text-center"><strong style="color: #081665;">Semana de alimentación del </strong><strong style="color: #C70039;">( <?php echo $inicio_semana; ?> ) <strong style="color: #081665;">al</strong> ( <?php echo $fin_semana ?> )</strong></p>
        
        <div class="btn-group" role="group">
            <a href="index.php?page=Reporte-semanal&semana=<?php echo max(1, $semanaSeleccionada - 1); ?>" class="btn btn-sm text-white" style="background: #404e67;"><< Anterior</a>
            <a href="index.php?page=Reporte-semanal&semana=<?php echo $semanaSeleccionada + 1; ?>" class="btn btn-sm text-white" style="background: #404e67;">Siguiente >></a>
        </div>
    </div>
</div>

<!-- inicio tabla alimentacion engorde -->
    <?php /*
      // Si se selecciona una semana desde el formulario
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['semana_alimentacion'])) {
            $semanaSeleccionada = $_POST['semana_alimentacion'];
        } else {
            // Si no se selecciona una semana, usamos la semana actual
            $semanaSeleccionada = date('W'); 
        }

        // Calcular las fechas de inicio y fin de la semana seleccionada
        $inicio_semana = date('Y-m-d', strtotime('Monday this week', strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));
        $fin_semana = date('Y-m-d', strtotime('Sunday this week', strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));*/
    ?>

    <div class="table table-sm table-responsive mt-2">
        <!--strong><p class="text-center" style="font-size:15px; margin-left: 10px; color:#4785e3; ">Alimentacion de engorde y precria semana: <?php echo $semanaSeleccionada; ?> </p></strong-->
        <div class="scroll mt-5">      
            <table class="table table-sm tab table-striped table-bordered" id="tablaDatos">

                <thead>
                    
                    <tr class="text-center mt-2" style="border: solid 2px #343a40">

                        <!--th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Semana</th-->

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Ps</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Ha</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Alimento</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Lun</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Mar</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Mie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Jue</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Vie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Sab</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Dom</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Acum. </br> Sem.</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Acum. </br> Total</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Días</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Peso</br>Dom </th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Inc.</br>Mie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Inc.</br>Act.</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Inc.</br>7 d.</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Inc.</br>14 d.</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Dens.</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">FCV.</th>


                    </tr>

                </thead>

                <tbody>

                    <?php
                            
                            $sql_piscina = "SELECT 
    t1.id_camaronera, 
    t1.id_piscina, 
    t1.id_corrida, 
    t1.hectareas,
    COALESCE(WEEK(t2.fecha_alimentacion, 1), '$semanaSeleccionada') AS 'Semana',
    COALESCE(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Monday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'lunes',
    COALESCE(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Tuesday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'martes',
    COALESCE(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Wednesday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'miercoles',
    COALESCE(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Thursday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'jueves',
    COALESCE(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Friday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'viernes',
    COALESCE(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Saturday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'sabado',
    COALESCE(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Sunday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'domingo',
    COALESCE(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) IN ('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday') 
                        THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'alimento_semanal',
    (
        SELECT COALESCE(SUM(t2_sub.cantidad + t2_sub.cantidad_2), 0)
        FROM registro_alimentacion_engorde t2_sub
        WHERE t2_sub.id_camaronera = t1.id_camaronera
        AND t2_sub.id_piscina = t1.id_piscina
        AND t2_sub.id_corrida = t1.id_corrida
        AND t2_sub.fecha_alimentacion BETWEEN t1.fecha_siembra AND COALESCE(MAX(t2.fecha_alimentacion), CURDATE())
    ) AS 'alimento_cumulativo',
    DATEDIFF(COALESCE(MAX(t2.fecha_alimentacion), CURDATE()), t1.fecha_siembra) AS 'dias_proceso',
    COALESCE((
        SELECT CONCAT(ta.descripcion_alimento, ' ', ta.gramaje_alimento) 
        FROM tipo_alimento ta
        JOIN registro_alimentacion_engorde rae 
            ON ta.id_tipo_alimento = rae.id_tipo_alimento
        WHERE rae.id_camaronera = t1.id_camaronera
        AND rae.id_piscina = t1.id_piscina
        AND rae.id_corrida = t1.id_corrida
        ORDER BY rae.fecha_alimentacion DESC LIMIT 1
    ), 'N/A') AS 'nombre_alimento',
    COALESCE((
        SELECT t3.peso FROM registro_muestreo t3 
        WHERE t3.id_camaronera = t1.id_camaronera
        AND t3.id_piscina = t1.id_piscina
        AND t3.id_corrida = t1.id_corrida
        AND t3.fecha_muestreo = DATE_SUB(COALESCE(MAX(t2.fecha_alimentacion), CURDATE()), INTERVAL 21 DAY)
        ORDER BY t3.fecha_muestreo DESC LIMIT 1
    ), 0) AS 'peso_21_dias_atras',
    COALESCE((
        SELECT t3.peso FROM registro_muestreo t3 
        WHERE t3.id_camaronera = t1.id_camaronera
        AND t3.id_piscina = t1.id_piscina
        AND t3.id_corrida = t1.id_corrida
        AND t3.fecha_muestreo = DATE_SUB(COALESCE(MAX(t2.fecha_alimentacion), CURDATE()), INTERVAL 14 DAY)
        ORDER BY t3.fecha_muestreo DESC LIMIT 1
    ), 0) AS 'peso_14_dias_atras',
    COALESCE((
        SELECT t3.peso FROM registro_muestreo t3 
        WHERE t3.id_camaronera = t1.id_camaronera
        AND t3.id_piscina = t1.id_piscina
        AND t3.id_corrida = t1.id_corrida
        AND t3.fecha_muestreo = DATE_SUB(COALESCE(MAX(t2.fecha_alimentacion), CURDATE()), INTERVAL 7 DAY)
        ORDER BY t3.fecha_muestreo DESC LIMIT 1
    ), 0) AS 'peso_7_dias_atras',
    COALESCE((
        SELECT t3.peso FROM registro_muestreo t3 
        WHERE t3.id_camaronera = t1.id_camaronera
        AND t3.id_piscina = t1.id_piscina
        AND t3.id_corrida = t1.id_corrida
        AND t3.fecha_muestreo = COALESCE(MAX(t2.fecha_alimentacion), CURDATE())
        ORDER BY t3.fecha_muestreo DESC LIMIT 1
    ), 0) AS 'peso_ultimo',
    COALESCE((
        SELECT t3.densidad FROM registro_muestreo t3 
        WHERE t3.id_camaronera = t1.id_camaronera
        AND t3.id_piscina = t1.id_piscina
        AND t3.id_corrida = t1.id_corrida
        AND t3.fecha_muestreo = (
            SELECT MAX(t3_sub.fecha_muestreo)
            FROM registro_muestreo t3_sub
            WHERE t3_sub.id_camaronera = t1.id_camaronera
            AND t3_sub.id_piscina = t1.id_piscina
            AND t3_sub.id_corrida = t1.id_corrida
            AND DAYNAME(t3_sub.fecha_muestreo) = 'Sunday'
            AND t3_sub.fecha_muestreo <= COALESCE(MAX(t2.fecha_alimentacion), CURDATE())
        ) ORDER BY t3.fecha_muestreo DESC LIMIT 1
    ), 0) AS 'densidad_domingos'
FROM registro_piscina_engorde t1
LEFT JOIN registro_alimentacion_engorde t2 
    ON t1.id_camaronera = t2.id_camaronera
    AND t1.id_piscina = t2.id_piscina
    AND t1.id_corrida = t2.id_corrida
    AND WEEK(t2.fecha_alimentacion, 1) = '$semanaSeleccionada'
WHERE t1.estado = 'En proceso'
AND t1.id_camaronera = '$camaronera'
GROUP BY t1.id_camaronera, t1.id_piscina, t1.id_corrida, t1.hectareas
ORDER BY Semana, t1.id_piscina;
";

                        $data = $objeto->mostrar($sql_piscina);
                        
                        foreach ($data as $value) : 
                        
                            $piscina = $value['id_piscina'];
                            $corrida = $value['id_corrida'];


                    ?>

                    <tr class="text-center mt-2">
                        <!-- Mostrar los datos de la piscina y hectáreas -->
                        <!--td class="align-middle text-right text-center"><?php echo $semanaSeleccionada; ?></td-->
                        <td class="align-middle text-right text-center" title="<?php echo $value['id_corrida'];?>"><?php echo $value['id_piscina']; ?></td>
                        <td class="align-middle text-right text-center"><?php echo $ha = $value['hectareas']; ?></td>
                        <td class="align-middle text-right text-center" style="width:30px;"><?php echo $value['nombre_alimento']; ?></td>
                        
                        <!-- Mostrar los datos de alimentación diaria -->
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['lunes']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['martes']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['miercoles']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['jueves']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['viernes']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['sabado']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['domingo']); ?></td>
                        <td class="align-middle text-right text-center"><?php echo intval($value['alimento_semanal']); ?></td>
                        <td class="align-middle text-right text-center"><?php echo intval($acum = $value['alimento_cumulativo']); ?></td>
                        <td class="align-middle text-right text-center"><?php echo intval($value['dias_proceso']); ?></td>

                        <?php
                            // Consultar el peso para la semana seleccionada
                                $sqlPesoSemana = "SELECT peso 
                                FROM registro_muestreo 
                                WHERE id_camaronera = '$camaronera' 
                                AND fecha_muestreo BETWEEN '$inicio_semana' AND '$fin_semana' 
                                AND id_piscina = '$piscina' 
                                AND id_corrida = '$corrida' 
                                ORDER BY fecha_muestreo DESC 
                                LIMIT 1";

                            $dataPesoSemana = $objeto->mostrar($sqlPesoSemana);

                            // Si no hay peso en la semana seleccionada
                            if (empty($dataPesoSemana)) {
                            // Calcular el último domingo registrado antes del último domingo
                            $ultimoDomingo = date('Y-m-d', strtotime('last Sunday', strtotime($fin_semana)));

                            // Consultar el último peso registrado antes o durante el último domingo
                            $sqlPesoUltimoDomingo = "SELECT peso 
                                        FROM registro_muestreo 
                                        WHERE id_camaronera = '$camaronera' 
                                        AND fecha_muestreo <= '$ultimoDomingo' 
                                        AND id_piscina = '$piscina' 
                                        AND id_corrida = '$corrida' 
                                        ORDER BY fecha_muestreo DESC 
                                        LIMIT 1";

                            $dataPesoUltimoDomingo = $objeto->mostrar($sqlPesoUltimoDomingo);
                            $pesoDom = !empty($dataPesoUltimoDomingo) ? $dataPesoUltimoDomingo[0]['peso'] : '0.00';
                            } else {
                            // Si hay peso en la semana seleccionada, lo usamos
                            $pesoDom = $dataPesoSemana[0]['peso'];
                            }
                        ?>
                        <td class="align-middle text-right text-center"><?php echo $pesoDom; ?></td>

                        <?php
                            // Obtener la semana seleccionada o la actual por defecto
                            $semanaSeleccionada = isset($_POST['semana_alimentacion']) ? $_POST['semana_alimentacion'] : $semanaActual;

                            // Consultar el peso para la semana seleccionada
                            $sqlPesoMie = "SELECT peso 
                                        FROM registro_peso 
                                        WHERE id_camaronera = '$camaronera' 
                                        AND fecha_peso BETWEEN '$inicio_semana' AND '$fin_semana' 
                                        AND id_piscina = '$piscina' 
                                        AND id_corrida = '$corrida' 
                                        ORDER BY fecha_peso DESC 
                                        LIMIT 1";

                            // Ejecutar la consulta y obtener el peso
                            $dataPesoMie = $objeto->mostrar($sqlPesoMie);
                            $pesoMie = !empty($dataPesoMie) ? $dataPesoMie[0]['peso'] : '0.00';

                            // Calcular el rango de fechas para la semana anterior
                            $inicio_semana_anterior = date('Y-m-d', strtotime('-1 week', strtotime($inicio_semana)));
                            $fin_semana_anterior = date('Y-m-d', strtotime('-1 week', strtotime($fin_semana)));

                            // Consultar el peso de la semana anterior
                           $sqlPesoDom = "SELECT peso 
                                        FROM registro_muestreo 
                                        WHERE id_camaronera = '$camaronera' 
                                        AND fecha_muestreo BETWEEN '$inicio_semana_anterior' AND '$fin_semana_anterior' 
                                        AND id_piscina = '$piscina' 
                                        AND id_corrida = '$corrida' 
                                        ORDER BY fecha_muestreo DESC 
                                        LIMIT 1";

                            // Ejecutar la consulta y obtener el peso de la semana anterior
                            $dataPesoDom = $objeto->mostrar($sqlPesoDom);
                            $pesoDom = !empty($dataPesoDom) ? $dataPesoDom[0]['peso'] : '0.00';

                        ?>

                        <td class="align-middle text-right text-center"><?php if($pesoMie == 0){ echo '0.00'; }else{ echo number_format($pesoMie - $pesoDom, 2); } ?></td>

                        <?php
                            // Pesos de las últimas 4 semanas (basado en la semana seleccionada)
                                $sqlPeso = "SELECT
                                   IFNULL(MAX(CASE WHEN WEEK(fecha_muestreo, 1) = WEEK(DATE_SUB('$inicio_semana', INTERVAL 3 WEEK), 1) THEN peso ELSE NULL END), 0) AS peso_cuatro_semanas,
                                   IFNULL(MAX(CASE WHEN WEEK(fecha_muestreo, 1) = WEEK(DATE_SUB('$inicio_semana', INTERVAL 2 WEEK), 1) THEN peso ELSE NULL END), 0) AS peso_tres_semanas,
                                   IFNULL(MAX(CASE WHEN WEEK(fecha_muestreo, 1) = WEEK(DATE_SUB('$inicio_semana', INTERVAL 1 WEEK), 1) THEN peso ELSE NULL END), 0) AS peso_dos_semanas,
                                   IFNULL(MAX(CASE WHEN WEEK(fecha_muestreo, 1) = WEEK(DATE_SUB('$inicio_semana', INTERVAL 0 WEEK), 1) THEN peso ELSE NULL END),
                                   (SELECT MAX(peso) FROM registro_muestreo WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND id_corrida = '$corrida' AND fecha_muestreo < '$inicio_semana')
                                   ) AS peso_domingo_pasado
                                FROM registro_muestreo
                                WHERE id_camaronera = '$camaronera'
                                AND id_piscina = '$piscina'
                                AND id_corrida = '$corrida'";
                               

                            $dataPesoSemanas = $objeto->mostrar($sqlPeso);
                            $pesoSemanas = $dataPesoSemanas[0];

                            // Calcular las diferencias
                            $diferencia_3_4 = $pesoSemanas['peso_tres_semanas'] - $pesoSemanas['peso_cuatro_semanas'];
                            $diferencia_2_3 = $pesoSemanas['peso_dos_semanas'] - $pesoSemanas['peso_tres_semanas'];
                            $diferencia_1_2 = $pesoSemanas['peso_domingo_pasado'] - $pesoSemanas['peso_dos_semanas'];

                        ?>

                        <td class="align-middle text-right text-center"><?php echo $diferencia_1_2 > 0 ? number_format($diferencia_1_2, 2) : '0.00'; ?></td>
                        <td class="align-middle text-right text-center"><?php echo $diferencia_2_3 > 0 ? number_format($diferencia_2_3, 2) : '0.00'; ?></td>
                        <td class="align-middle text-right text-center"><?php echo $diferencia_3_4 > 0 ? number_format($diferencia_3_4, 2) : '0.00'; ?></td>
                        <td class="align-middle text-right text-center"><?php echo $densidad = intval($value['densidad_domingos']); ?></td>

                        <td class="align-middle text-center">
                            <?php
                            // Consultar el peso de la semana seleccionada o el último domingo si no hay registros
                            $sqlPeso = "SELECT peso 
                                FROM registro_muestreo 
                                WHERE id_camaronera = '$camaronera' 
                                AND id_piscina = '$piscina' 
                                AND id_corrida = '$corrida' 
                                AND (
                                    fecha_muestreo BETWEEN '$inicio_semana' AND '$fin_semana' 
                                    OR fecha_muestreo <= DATE_SUB('$fin_semana', INTERVAL WEEKDAY('$fin_semana') + 1 DAY)
                                ) 
                                ORDER BY fecha_muestreo DESC 
                                LIMIT 1";

                            $dataPeso = $objeto->mostrar($sqlPeso);
                            $pesoDom = !empty($dataPeso) ? $dataPeso[0]['peso'] : '0.00';

                            // Condición para densidad mayor que 0
                            $factor = 0;
                            if ($densidad > 0) {
                                // Consultar la suma de libras pescadas
                                $sqlRaleo = "SELECT IFNULL(SUM(libras_pescadas), 0) AS libras_pescadas 
                                    FROM registro_pesca_engorde 
                                    WHERE id_piscina = '$piscina' 
                                    AND id_camaronera = '$camaronera' 
                                    AND id_corrida = '$corrida'";
                                
                                $dataRaleo = $objeto->mostrar($sqlRaleo);
                                $raleo = $dataRaleo[0]['libras_pescadas'] * $ha;

                                // Calcular las variables necesarias
                                $r1 = $value['alimento_cumulativo'] * 2.2;
                                $r2 = ($densidad * $pesoDom * 0.0022) * $ha;
                                $r4 = $r2 + $raleo;

                                // Evitar división por cero y calcular el factor
                                if ($r4 != 0) {
                                    $factor = $r1 / $r4;
                                }
                            }
                            ?>
                            
                            <span class="text-secondary text-xs font-weight-bold">
                                <?php echo number_format($factor, 2); ?>
                            </span>
                        </td>


                        <?php endforeach; ?>  
                        
                
                    </tr>  

                </tbody>

                
            </table>
        </div>
    </div>
<!-- fin tabla alimentacion engorde -->

<!-- inicio tabla alimentacion precria -->
    <div class="table table-sm table-responsive" style="margin-top:-30px;">
        <!--strong><p class="text" style="font-size:15px; margin-left: 10px; color:#4785e3;">Alimentacion precria semana: <?php echo $semanaSeleccionada; ?> </p></strong-->
        <div class="scroll mt-5">      
            <table class="table table-sm tab table-striped table-bordered" id="tablaDatos">

                <thead>
                    
                    <tr class="text-center mt-2" style="border: solid 2px #343a40">

                        

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Pre</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Ha</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Alimento</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Lun</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Mar</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Mie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Jue</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Vie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Sab</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Dom</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Acum. </br> Sem.</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Acum. </br> Total</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Días</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Cant. </br> sembrado</th>

                        <!--th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Estimancion</th-->

                    </tr>

                </thead>

                <tbody>

                    
                            
                            

                                <?php
// Obtener la semana actual si no se ha seleccionado ninguna
$semanaSeleccionada = isset($_GET['semana']) ? intval($_GET['semana']) : date('W');

// Calcular las fechas de inicio y fin de la semana seleccionada
$inicio_semana = date('Y-m-d', strtotime("Monday this week", strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));
$fin_semana = date('Y-m-d', strtotime("Sunday this week", strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));


                        

                            $sql_piscina = "SELECT 
    t1.id_camaronera, 
    t1.id_precria, 
    t1.identificacion, 
    t1.hectareas,
    t1.cantidad_siembra,
    IFNULL(WEEK(t2.fecha_alimentacion, 1), '$semanaSeleccionada') AS 'Semana',
    IFNULL(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Monday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'lunes',
    IFNULL(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Tuesday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'martes',
    IFNULL(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Wednesday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'miercoles',
    IFNULL(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Thursday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'jueves',
    IFNULL(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Friday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'viernes',
    IFNULL(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Saturday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'sabado',
    IFNULL(SUM(CASE WHEN DAYNAME(t2.fecha_alimentacion) = 'Sunday' THEN (t2.cantidad + t2.cantidad_2) ELSE 0 END), 0) AS 'domingo',
    IFNULL(SUM(t2.cantidad + t2.cantidad_2), 0) AS 'alimento_semanal',
    (
        SELECT IFNULL(SUM(t2_sub.cantidad + t2_sub.cantidad_2), 0)
        FROM registro_alimentacion_precria t2_sub
        WHERE t2_sub.id_camaronera = t1.id_camaronera
        AND t2_sub.id_precria = t1.id_precria
        AND t2_sub.identificacion = t1.identificacion
        AND t2_sub.fecha_alimentacion BETWEEN t1.fecha_siembra 
        AND (SELECT MAX(t2_sub2.fecha_alimentacion) 
             FROM registro_alimentacion_precria t2_sub2 
             WHERE t2_sub2.id_camaronera = t1.id_camaronera
             AND t2_sub2.id_precria = t1.id_precria
             AND t2_sub2.identificacion = t1.identificacion)
    ) AS 'alimento_cumulativo',
    DATEDIFF(
        IFNULL((SELECT MAX(t2.fecha_alimentacion) 
                FROM registro_alimentacion_precria t2 
                WHERE t2.id_camaronera = t1.id_camaronera
                AND t2.id_precria = t1.id_precria
                AND t2.identificacion = t1.identificacion), CURDATE()), 
        t1.fecha_siembra
    ) AS 'dias_proceso',
    COALESCE(
        (SELECT CONCAT(ta.descripcion_alimento, ' ', ta.gramaje_alimento) 
         FROM tipo_alimento ta
         JOIN registro_alimentacion_precria rae 
             ON ta.id_tipo_alimento = rae.id_tipo_alimento
         WHERE rae.id_camaronera = t1.id_camaronera
         AND rae.id_precria = t1.id_precria
         AND rae.identificacion = t1.identificacion
         ORDER BY rae.fecha_alimentacion DESC LIMIT 1), 'N/A') AS 'nombre_alimento',
    COALESCE(
        (SELECT rel.cantidad_estimada
         FROM registro_estimado_larva rel
         WHERE rel.id_camaronera = t1.id_camaronera
         AND rel.id_precria = t1.id_precria
         AND rel.secuencial = t1.identificacion
         LIMIT 1), 0.00) AS 'estimado_lavar'
FROM registro_piscina_precria t1
LEFT JOIN registro_alimentacion_precria t2 
    ON t1.id_camaronera = t2.id_camaronera
    AND t1.id_precria = t2.id_precria
    AND t1.identificacion = t2.identificacion
    AND WEEK(t2.fecha_alimentacion, 1) = '$semanaSeleccionada'
WHERE t1.estado = 'En proceso'
AND t1.id_camaronera = '$camaronera'
GROUP BY t1.id_camaronera, t1.id_precria, t1.identificacion, t1.hectareas
ORDER BY Semana, t1.id_precria;

                        ";

                        $data = $objeto->mostrar($sql_piscina);
                        
                        foreach ($data as $value) : 
                        
                            $piscina = $value['id_precria'];
                            $corrida = $value['identificacion'];




                    ?>

                    <tr class="text-center mt-2">
                        <!-- Mostrar los datos de la piscina y hectáreas -->
                      
                        <td class="align-middle text-right text-center"><?php echo $value['id_precria']; ?></td>
                        <td class="align-middle text-right text-center"><?php echo $ha = $value['hectareas']; ?></td>
                        <td class="align-middle text-right text-center" style="width:120px;"><?php echo $value['nombre_alimento']; ?></td>
                        <!-- Mostrar los datos de alimentación diaria -->
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['lunes']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['martes']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['miercoles']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['jueves']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['viernes']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['sabado']); ?></td>
                        <td class="align-middle text-right text-center" title="<?php echo $value['nombre_alimento'];?>"><?php echo intval($value['domingo']); ?></td>
                        <td class="align-middle text-right text-center"><?php echo intval($value['alimento_semanal']); ?></td>
                        <td class="align-middle text-right text-center"><?php echo $acum = intval($value['alimento_cumulativo']); ?></td>
                        <td class="align-middle text-right text-center"><?php echo $value['dias_proceso']; ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($value['cantidad_siembra'], 0); ?></td>
                        <!--td class="align-middle text-right text-center"><?php echo number_format($value['estimado_lavar'], 0); ?></td-->

                        <?php endforeach; ?>  
                        
                
                    </tr>  

                </tbody>

                <!--td class="align-middle text-right" colspan="22" style="background: #555557; border: solid 2px #343a40;"></td-->
            </table>
        </div>
    </div>
<!-- fin tabla alimentacion precria -->

<!-- inicio tabla sacos usados engorde -->
    <div class="table table-sm table-responsive" style="margin-top:5px;">
        
        <p class="text-center"><strong style="color: #081665;">Sacos consumidos de engorde y precira del </strong><strong style="color: #C70039;">( <?php echo $inicio_semana; ?> ) <strong style="color: #081665;">al</strong> ( <?php echo $fin_semana ?> )</strong></p>
        <div class="scroll mt-5">      
            <table class="table table-sm tab table-striped table-bordered" id="tablaDatos">

                <thead>
                    
                    <tr class="text-center mt-2" style="border: solid 2px #343a40">

                        

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Alimento</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Lun</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Mar</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Mie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Jue</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Vie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Sab</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Dom</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Total</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                            
                            // Obtener la semana actual si no se ha seleccionado ninguna
$semanaSeleccionada = isset($_GET['semana']) ? intval($_GET['semana']) : date('W');

// Calcular las fechas de inicio y fin de la semana seleccionada
$inicio_semana = date('Y-m-d', strtotime("Monday this week", strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));
$fin_semana = date('Y-m-d', strtotime("Sunday this week", strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));

                            $sqlSacos = "SELECT 
                            r.id_tipo_alimento,
                            CONCAT(t.descripcion_alimento, ' ', t.gramaje_alimento) AS descripcion_gramaje,
                            COALESCE(SUM(
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25)
                                END
                            ), 0.00) AS total,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Monday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS lunes,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Tuesday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS martes,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Wednesday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS miercoles,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Thursday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS jueves,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Friday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS viernes,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Saturday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS sabado,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Sunday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS domingo
                        FROM 
                            registro_alimentacion_engorde r
                        INNER JOIN 
                            tipo_alimento t
                        ON 
                            r.id_tipo_alimento = t.id_tipo_alimento
                        WHERE 
                            r.id_camaronera = '$camaronera'
                            AND r.fecha_alimentacion BETWEEN '$inicio_semana' AND '$fin_semana'
                        GROUP BY 
                            r.id_tipo_alimento, t.descripcion_alimento, t.gramaje_alimento
                        ORDER BY 
                            r.id_tipo_alimento ASC
                        ";

                        $data = $objeto->mostrar($sqlSacos);
                        
                        foreach ($data as $key) : 
        


                    ?>

                    <tr class="text-center mt-2">
                        <!-- Mostrar los datos de la piscina y hectáreas -->
                       
                        <td class="align-middle text-right text-center" style="width:120px;"><?php echo $key['descripcion_gramaje']; ?></td>
                        <!-- Mostrar los datos de alimentación diaria -->
                        <td class="align-middle text-right text-center"><?php echo number_format($key['lunes'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['martes'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['miercoles'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['jueves'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['viernes'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['sabado'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['domingo'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['total'],2); ?></td>


                        <?php endforeach; ?>  
                        
                
                    </tr>  

                </tbody>

                <!--td class="align-middle text-right" colspan="22" style="background: #555557; border: solid 2px #343a40;"></td-->
            </table>
        </div>
    </div>
<!-- fin tabla sacos usados engorde -->

<!-- inicio tabla sacos usados precria -->
    <div class="table table-sm table-responsive" style="margin-top:-30px;">
        <!--strong><p class="text" style="font-size:15px; margin-left: 10px; color:#4785e3;">Sacos consumidos en precria de la semana: <?php echo $semanaSeleccionada; ?> </p></strong-->
        <div class="scroll mt-5">      
            <table class="table table-sm tab table-striped table-bordered" id="tablaDatos">

                <thead>
                    
                    <tr class="text-center mt-2" style="border: solid 2px #343a40">

                       

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Alimento</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Lun</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Mar</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Mie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Jue</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Vie</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Sab</th>

                        <th style="background: #404e67; color:white; border: solid 2px #343a40; font-size:12px;">Dom</th>

                        <th style="background: #555557; border: solid 2px #343a40; color:white; font-size:12px;">Total</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                            
                            // Obtener la semana actual si no se ha seleccionado ninguna
$semanaSeleccionada = isset($_GET['semana']) ? intval($_GET['semana']) : date('W');

// Calcular las fechas de inicio y fin de la semana seleccionada
$inicio_semana = date('Y-m-d', strtotime("Monday this week", strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));
$fin_semana = date('Y-m-d', strtotime("Sunday this week", strtotime("1 January " . date('Y') . " + " . ($semanaSeleccionada - 1) . " weeks")));
                        

                            $sqlSacos = "SELECT 
                            r.id_tipo_alimento,
                            CONCAT(t.descripcion_alimento, ' ', t.gramaje_alimento) AS descripcion_gramaje,
                            COALESCE(SUM(
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25)
                                END
                            ), 0.00) AS total,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Monday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS lunes,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Tuesday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS martes,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Wednesday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS miercoles,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Thursday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS jueves,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Friday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS viernes,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Saturday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS sabado,
                            COALESCE(SUM(CASE WHEN DAYNAME(r.fecha_alimentacion) = 'Sunday' THEN 
                                CASE 
                                    WHEN r.id_tipo_alimento = r.id_tipo_alimento_2 THEN ((r.cantidad + r.cantidad_2) / 25)
                                    ELSE (r.cantidad / 25) 
                                END
                            END), 0.00) AS domingo
                        FROM 
                            registro_alimentacion_precria r
                        INNER JOIN 
                            tipo_alimento t
                        ON 
                            r.id_tipo_alimento = t.id_tipo_alimento
                        WHERE 
                            r.id_camaronera = '$camaronera'
                            AND r.fecha_alimentacion BETWEEN '$inicio_semana' AND '$fin_semana'
                        GROUP BY 
                            r.id_tipo_alimento, t.descripcion_alimento, t.gramaje_alimento
                        ORDER BY 
                            r.id_tipo_alimento ASC;
                        ";

                        $data = $objeto->mostrar($sqlSacos);
                        
                        foreach ($data as $key) : 
        


                    ?>

                    <tr class="text-center mt-2">
                        <!-- Mostrar los datos de la piscina y hectáreas -->
                     
                        <td class="align-middle text-right text-center" style="width:120px;"><?php echo $key['descripcion_gramaje']; ?></td>
                        <!-- Mostrar los datos de alimentación diaria -->
                        <td class="align-middle text-right text-center"><?php echo number_format($key['lunes'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['martes'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['miercoles'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['jueves'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['viernes'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['sabado'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['domingo'],2); ?></td>
                        <td class="align-middle text-right text-center"><?php echo number_format($key['total'],2); ?></td>


                        <?php endforeach; ?>  
                        
                
                    </tr>  

                </tbody>

                <!--td class="align-middle text-right" colspan="22" style="background: #555557; border: solid 2px #343a40;"></td-->
            </table>
        </div>
    </div>
<!-- fin tabla sacos usados precria -->
            
            
    
                               
<script type="text/javascript">
    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });
        document.oncontextmenu = function(){return false;}

    // Cargar datos de la semana actual al iniciar la página
    $(document).ready(function() {
        cargarDatosSemana();
    });

      // Seleccionar todas las filas de la tabla
      document.querySelectorAll("#tablaDatos tr").forEach(row => {
        // Agregar un evento click a cada fila
        row.addEventListener("click", function() {
            // Eliminar el color de la fila previamente seleccionada
            document.querySelectorAll("#tablaDatos tr").forEach(r => r.style.backgroundColor = "");
            // Establecer el color de la fila seleccionada
            this.style.backgroundColor = "lightblue"; // Puedes cambiar el color a tu preferencia
        });
    });
</script>

    