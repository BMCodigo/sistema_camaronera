<?php

// Establecer la zona horaria
date_default_timezone_set('America/Guayaquil');


        // Consulta para verificar si la piscina está en proceso y obtener hectáreas
        $SqlInicio = "SELECT id_camaronera, id_piscina, id_corrida, hectareas, estado 
        FROM registro_piscina_engorde 
        WHERE id_camaronera 
        IN (1)  
        AND id_piscina = 1
        AND id_corrida = 39
        AND estado = 'En proceso'";
        $data_inicio = $conectar->mostrar($SqlInicio);
        
        foreach($data_inicio as $i){

            $id_camaronera = $i['id_camaronera'];
            $id_piscina = $i['id_piscina'];
            $id_corrida = $i['id_corrida'];
            $hectareas = $i['hectareas'];
            $estado = $i['estado'];
        
            // Consulta para obtener las fechas y cantidades de registro_alimentacion_engorde
            $sql_alimentacion = "SELECT 
            id_camaronera, 
            id_piscina, 
            id_corrida, 
            fecha_alimentacion, 
            id_tipo_alimento,
            CASE id_camaronera
                WHEN 1 THEN 'Darsacom'
                WHEN 2 THEN 'Aquacamaron'
                WHEN 3 THEN 'Jopisa'
                WHEN 5 THEN 'Grupo Camaron'
                WHEN 6 THEN 'Calica'
                ELSE 0
            END AS camaronera,
            CASE id_tipo_alimento
                WHEN 0 THEN 'FNLS 2.0'
                WHEN 1 THEN 'CLA AD 2.0'
                WHEN 2 THEN 'CLA 0.8'
                WHEN 3 THEN 'CLA 1.2'
                WHEN 4 THEN 'CLA 2.0'
                WHEN 5 THEN 'CLA PST TRANS 1.2'
                WHEN 6 THEN 'ORGN 0.3'
                WHEN 7 THEN 'ORGN 0.5'
                WHEN 8 THEN 'ORGN 0.8'
                WHEN 9 THEN 'TRP 0.8'
                WHEN 10 THEN 'TRP 1.2'
                WHEN 12 THEN 'TRP 2.0'
                WHEN 13 THEN 'TRP 0.8'
                WHEN 14 THEN 'TRP 1.2'
                WHEN 15 THEN 'KTL 0.8'
                WHEN 16 THEN 'KTL 1.2'
                WHEN 17 THEN 'KTL 2.0'
                WHEN 18 THEN 'KTL 2.5'
                WHEN 19 THEN 'FNSL EQ 2.0'
                WHEN 20 THEN 'FNLS 2.5'
                WHEN 21 THEN 'NTMIX 2.0'
                WHEN 22 THEN 'QLZ 2.5'
                WHEN 23 THEN 'HID PLT 2.0'
                WHEN 24 THEN 'HID EXT 2.0'
                WHEN 25 THEN 'balanceado NULL'
                WHEN 26 THEN 'KTL PRE 0.8'
                WHEN 27 THEN 'KTL PST TRNS 1.2'
                WHEN 28 THEN 'HID EXT 1.2'
                WHEN 29 THEN 'HID PLT 1.2'
                WHEN 30 THEN 'CLMB PLT 1.0'
                WHEN 31 THEN 'FNSL 2.0'
                WHEN 32 THEN 'CLA PRE 0.8'
                WHEN 33 THEN 'HID EXT FTNS 1.2'
                WHEN 34 THEN 'HID PLT FTNS 1.2'
                WHEN 35 THEN 'CLA AD AQ 2.0'
                WHEN 36 THEN 'LRC AD 2.0'
                WHEN 37 THEN 'LRC ad 4.0'
                WHEN 38 THEN 'MSTL 5.0'
                WHEN 39 THEN 'KTL BIO 2.0'
                WHEN 40 THEN 'CLA AD EQ BIO 2.0'
                WHEN 41 THEN 'KTL ACR 2.0'
                WHEN 43 THEN 'KTL 33% 2.0'
                WHEN 44 THEN 'AQXCL 0.8'
                WHEN 45 THEN 'AQXCL 0.8'
                WHEN 46 THEN 'PRN 2.0'
                WHEN 47 THEN 'AQXCL 2.0'
                WHEN 48 THEN 'AQXCL 1.2'
                WHEN 49 THEN 'KTL 38% 1.2'
                WHEN 50 THEN 'KTL XG 35% 2.0'
                WHEN 51 THEN 'KTL PLUS 33% 2.0'
                WHEN 52 THEN 'HID SPD 37% 2.0'
                WHEN 53 THEN 'HID PLT 37% 2.0'
                ELSE 0
            END AS tipo_alimento, 
            SUM(cantidad + cantidad_2) AS total_diario,
            COUNT(DISTINCT CASE 
                WHEN YEARWEEK(fecha_alimentacion, 1) = YEARWEEK(CURDATE(), 1) 
                THEN fecha_alimentacion 
            END) AS dias_alimentados_semana_actual
        FROM 
            registro_alimentacion_engorde 
        WHERE 
            id_camaronera = '$id_camaronera' 
            AND id_piscina = '$id_piscina'
            AND id_corrida = '$id_corrida'
            /*AND fecha_alimentacion <= CURDATE() */
        GROUP BY 
            fecha_alimentacion 
        ORDER BY 
            fecha_alimentacion ASC;
        ";
            $data_alimentacion = $conectar->mostrar($sql_alimentacion);

            // Consulta para verificar si la piscina está en proceso y obtener hectáreas
            $sqlPiscina = "SELECT hectareas, estado FROM registro_piscina_engorde 
                            WHERE id_camaronera = '$id_camaronera' 
                            AND id_piscina = '$id_piscina'
                            AND id_corrida = '$id_corrida'
                            AND estado = '$estado'";
            $data_piscina = $conectar->mostrar($sqlPiscina);



                // Si la piscina está en proceso, mostrar la tabla
                echo "<table border='1'>
                        <tr>
                            <th>estado</th>
                            <th>semana</th>
                            <th>dia</th>
                            <th>Camaronera</th>
                            <th>Piscina</th>
                            <th>Hectáreas</th>
                            <th>Fecha Alim</th>
                            <th>Alimento</th>
                            <th>Egreso</th>
                            <th>Cantidad</th>
                            <th>Cantidad ha</th>
                            <th>Peso Domingo</th>
                            <th>Incremento</th>
                            <th>GR Días</th>
                            <th>Ind/m2 dia</th>
                            <th>Alimentación Acumulada</th> <!-- Nueva columna para el acumulado -->
                            <th>Prom ind/m2</th> 
                        </tr>";

                // Inicializar arreglos y variables para almacenar datos de los domingos y promedios semanales
                $pesosDomingo = [];
                $incrementosDomingo = [];
                $grDiasDomingo = [];
                $resultadoAcumulado = 0;
                $resultadoAcumuladoInd = 0;
                $contadorDias = 0; // Contador de días para promedios
                $n = 0;
                $ind_x_metro_m = 0;
                $promedioSemanal = 0;
                

                // Inicializar variable de alimentación acumulada
                $alim_acum = 0; // Variable para almacenar la cantidad acumulada de alimentación
                $primeraFecha = null; // Variable para almacenar la primera fecha de alimentación

                // Iterar a través de cada registro de alimentación
                foreach ($data_alimentacion as $alimentacion) {
                    date_default_timezone_set('America/Guayaquil');


                    // Obtener la fecha de alimentación
                    $fecha_alimentacion = $alimentacion['fecha_alimentacion']; // Suponiendo que esto es una fecha válida
                    $semana = date('W', strtotime($fecha_alimentacion)); // Obtener la semana del año
                    // Obtener el día de la semana (0=domingo, 1=lunes, ..., 6=sábado)
                    $dia_num = date('w', strtotime($fecha_alimentacion));
                    // Ajustar para que lunes=1 y domingo=0
                    $dia_num = ($dia_num + 6) % 7; // Convertir domingo (0) a 0, lunes (1) a 1, ..., sábado (6) a 6
                    // Arreglo para mapear el número del día a su nombre
                    $dias = ['lun', 'mar', 'mie', 'jue', 'vie', 'sab', 'dom'];
                    // Obtener el nombre del día correspondiente
                    $nombre_dia = $dias[$dia_num];

                    // Establecer la primera fecha de alimentación si es la primera iteración
                    if ($primeraFecha === null) {
                        $primeraFecha = $fecha_alimentacion; // Guardar la primera fecha
                    }

                    // Calcular la fecha del próximo domingo
                    $fecha = new DateTime($fecha_alimentacion);
                    $diaSemana = $fecha->format('N'); // Obtener el día de la semana (1 = Lunes, 7 = Domingo)
                    $diasParaDomingo = 7 - $diaSemana; // Días restantes hasta el próximo domingo
                    $fechaDomingo = $fecha->modify("+$diasParaDomingo days")->format('Y-m-d');

                    // Consulta para obtener los datos de simulación
                    $sql_simulacion = "SELECT incremento, peso_final, piscinas, id_corrida, gr_dias, n, alim_sum
                                        FROM simulacion_proceso_test 
                                        WHERE id_camaronera = '$id_camaronera' 
                                        AND piscinas = '$id_piscina'
                                        AND id_corrida = '$id_corrida'
                                        AND id_bio = 'BW 7 dias' 
                                    AND fecha_muestreo = '$fechaDomingo'";
                    $data_simulacion = $conectar->mostrar($sql_simulacion);
                    
                    // Obtener los datos de simulación si están disponibles
                    $incremento = null;
                    $peso_final = null;
                    $gr_dias = null;

                    if (!empty($data_simulacion)) {
                        $simulacion = $data_simulacion[0]; // Tomar el primer resultado
                        $incremento = $simulacion['incremento'];
                        $peso_final = $simulacion['peso_final'];
                        $gr_dias = $simulacion['gr_dias'];
                        $n = $simulacion['n'];
                    }

                    if($peso_final < 2.00 || $peso_final === NULL || $peso_final === '' || $peso_final == 0 ){
                        $gr_dias = 0.30;
                    }else if($peso_final >= 2.00 && $peso_final <= 6.00){
                        $gr_dias = 0.43;
                    }else{
                        $gr_dias = $simulacion['gr_dias'];
                    }

                    // Asignar valores de alimentación
                    $nombre_camaronera = $alimentacion['camaronera'];
                    $camaronera = $alimentacion['id_camaronera'];
                    $id_piscina = $alimentacion['id_piscina'];
                    $id_corrida = $alimentacion['id_corrida'];
                    $id_tipo_alimento = $alimentacion['tipo_alimento'];
                    $cantidad = $alimentacion['total_diario'];
                    $dias_alimentados_semana_actual = $alimentacion['dias_alimentados_semana_actual'];

                    // Sumar la cantidad actual a la alimentación acumulada
                    $alim_acum += $cantidad;

                    // inicio cantidad egresada de bodega

                        echo $sqlEgreso = "SELECT id_camaronera, id_piscina, id_corrida, ingreso_bodega_piscina AS egreso FROM kardex_piscina WHERE id_camaronera = '$id_camaronera' AND id_piscina = '$id_piscina' AND id_corrida = '$id_corrida' AND fecha_ingreso = '$fecha_alimentacion' ";
                        $data_egreso = $conectar->mostrar($sqlEgreso);

                        foreach($data_egreso as $e){
                            $egreso = $e['egreso']*25;
                        


                    // fin cantidad egresada de bodega

                    // Si hay un peso final disponible, almacenarlo para el domingo correspondiente
                    if ($peso_final !== null) {
                        // Guardar el peso en el arreglo usando la fecha del domingo como clave
                        $pesosDomingo[$fechaDomingo] = $peso_final;
                        $incrementosDomingo[$fechaDomingo] = $incremento;
                        $grDiasDomingo[$fechaDomingo] = $gr_dias;
                    }

                    // Calcular el peso del domingo anterior para mostrar en la semana siguiente
                    $pesoDomingoAnterior = null;
                    $incrementoAnterior = null;
                    $grDiasAnterior = null;
                    $fechaDomingoAnterior = (new DateTime($fechaDomingo))->modify('-7 days')->format('Y-m-d');

                    // Verificar si hay un peso guardado para el domingo anterior
                    if (isset($pesosDomingo[$fechaDomingoAnterior])) {
                        $pesoDomingoAnterior = $pesosDomingo[$fechaDomingoAnterior];
                        $incrementoAnterior = $incrementosDomingo[$fechaDomingoAnterior] ?? null;
                        $grDiasAnterior = $grDiasDomingo[$fechaDomingoAnterior] ?? null;

                        // Sumar peso del domingo anterior y gramos del día anterior
                        if ($diaSemana == 1) { // Lunes
                            $resultadoAcumulado = $pesoDomingoAnterior + $grDiasAnterior; // Reiniciar el acumulado con el peso del domingo
                        } else {
                            // Para otros días, sumar el grDiasAnterior
                            $resultadoAcumulado += $grDiasAnterior; // Acumulado
                        }
                    }

                    // Calcular el nuevo valor (resultado de la suma diaria)
                    $nuevoValor = max($resultadoAcumulado, 1); // Asegurarse de que no sea cero

                    // Calcular kg_10_m basado en el nuevo valor calculado
                    $kg_10_m = 1.00 / (0.007963335 + 0.1387779 / $nuevoValor);

                    // Calcular la cantidad por hectáreas
                    $cantidad_por_hectarea = $cantidad / $hectareas;

                    // Calcular kg_ha_semana_m
                    $kg_ha_semana_m = $cantidad_por_hectarea / 1;
                    $ind_x_metro_m = $kg_ha_semana_m * 10 / $kg_10_m;


                    
                    if ($diaSemana == 1) { // Lunes
                        // Reiniciar el acumulado con el peso del lunes (no domingo, ya que es lunes)
                        $resultadoAcumuladoInd = $ind_x_metro_m; // Solo asignar el peso del lunes
                        $contadorDias = 1; // Contar el registro del lunes

                        $promedioSemanal = $resultadoAcumuladoInd;
                    
                    } else {
                        // Para otros días, sumar el valor del día actual al acumulado
                        $resultadoAcumuladoInd += $ind_x_metro_m; // Acumulado
                        $contadorDias++; // Contar cada día registrado
                        // Al final de la semana, calcular el promedio (esto debe hacerse después de procesar todos los días)
                        
                        if ($contadorDias > 0) {
                            $promedioSemanal = $resultadoAcumuladoInd / $contadorDias;
                            $contadorDias;
                            //echo "Promedio de la semana actual: " . $promedioSemanal;
                        } 
                    }
                    

                    // Calcular días transcurridos desde la primera fecha
                    $dias_transcurridos = (new DateTime())->diff(new DateTime($primeraFecha))->days;

                    if ($semana) {
                        // Si la semana actual es igual a la semana comparada
                        $dias = $dias_alimentados_semana_actual;
                        if ($dias > 0) {
                            $resultado = $resultadoAcumuladoInd / $dias;
                           // echo $resultado; // Muestra el resultado
                        } 
                    
                    } 

                    // Mostrar fila de resultados en la tabla
                    echo "
                    <tr>
                        <td>$estado</td>
                        <td>$semana</td>
                        <td>$nombre_dia</td>
                        <td>$camaronera</td>
                        <td>$id_piscina</td>
                        <td>$hectareas</td>
                        <td>$fecha_alimentacion</td>
                        <td>$id_tipo_alimento</td>
                        <td>$egreso</td>
                        <td>$cantidad</td>
                        <td>" . number_format($cantidad_por_hectarea, 2) . "</td>
                        <td>$pesoDomingoAnterior</td>
                        <td>" . number_format($incrementoAnterior, 2) . "</td>
                        <td>$grDiasAnterior</td>
                        <td>" . number_format($ind_x_metro_m, 2) . "</td>
                        <td>$alim_acum</td>
                        <td>$promedioSemanal </td>
                    </tr>";
                    
                        
                       // Verificar si el registro ya existe
                        $sql_check = "SELECT COUNT(*) as count FROM pw_alimentacion_diaria 
                        WHERE id_camaronera = '$camaronera' 
                        AND fecha_alimentacion = '$fecha_alimentacion' 
                        AND id_piscina = '$id_piscina' 
                        AND id_corrida = '$id_corrida'";

                        $result_check = mysqli_query($conexion, $sql_check);
                        $row_check = mysqli_fetch_assoc($result_check);

                        // Solo insertar si el registro no existe
                        if ($row_check['count'] == 0) {
                        // Insertar en la tabla alimentacion_diaria (opcional)
                        $sql_insert = "INSERT INTO `pw_alimentacion_diaria`( `camaronera`, `id_camaronera`, `dia_semana`, `fecha_alimentacion`, `id_piscina`, `id_corrida`, `hectareas`, `id_tipo_alimento`, `peso_final`, `incremento`, `gr_dia`, `total_acumulado`, `cantidad_total`, `cantidad_egreso`, `cantidad_total_ha`, `ind_x_metro_m`, `promedio_ind_x_metro_m_semana`, `alim_acum`, `estado`, `semana`, `dias_alimentados_semana_anterior`, `dias_alimentados_semana_actual`, `dias_transcurridos`)  VALUES
                            ('$nombre_camaronera', '$camaronera', '$nombre_dia', '$fecha_alimentacion', '$id_piscina', '$id_corrida', '$hectareas', '$id_tipo_alimento', '$pesoDomingoAnterior', '$incrementoAnterior', '$grDiasAnterior', '$nuevoValor', '$cantidad', '$egreso', '$cantidad_por_hectarea', '$ind_x_metro_m', '$promedioSemanal', '$alim_acum', '$estado', '$semana', '$n', '$dias_alimentados_semana_actual', '$dias_transcurridos' )";
                        //$insert = mysqli_query($conexion, $sql_insert); // Realizar la inserción
                        }else{
                            //echo ' no hay registros nuevos';
                        }
                    }
                }

                echo "</table>";
                echo "<h3>Total Acumulado de Alimentación: $alim_acum</h3>";
                echo "<h3>Dias Acumulado de Alimentación: $dias_transcurridos</h3>";

                

            } 
        

?>