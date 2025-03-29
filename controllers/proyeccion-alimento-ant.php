<?php 
error_reporting(0);
include '../models/conexion.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();

// Consulta para verificar si las piscinas están en proceso
$sqlPiscina = "SELECT id_camaronera, id_piscina, id_corrida, estado 
               FROM registro_piscina_engorde 
               WHERE estado = 'En proceso' 
               GROUP BY id_camaronera, id_piscina, id_corrida";
$data_piscina = $conectar->mostrar($sqlPiscina);

echo "<table border='1'>
        <tr>
            <th>Camaronera</th>
            <th>Día</th>
            
            <th>Fecha Alimentación</th>
            <th>Piscina</th>
            <th>Corrida</th>
            <th>Peso Final</th>
            <th>Incremento</th>
            <th>Gramo/Día</th>
            <th>Total Acumulado</th>
            <th>Cantidad Total</th>
            <th>Cantidad Total ha</th>
            <th>ind_x_metro_m</th>
            <th>Promedio Semanal</th>
        </tr>";

$days = ['lun', 'mar', 'mie', 'jue', 'vie', 'sab', 'dom'];

// Función para obtener el nombre del día de la semana (ajustada para que lunes sea el primer día)
function getDayName($date) {
    $dias = ['lun', 'mar', 'mie', 'jue', 'vie', 'sab', 'dom'];
    $dayNumber = (date('w', strtotime($date)) + 6) % 7; // Ajustar para que el lunes sea 0
    return $dias[$dayNumber];
}

// Iterar por cada piscina en estado 'En proceso'
foreach ($data_piscina as $key) {
    $id_camaronera = $key['id_camaronera'];
    $id_piscina = $key['id_piscina'];
    $id_corrida = $key['id_corrida'];

    // Consulta para obtener los datos de simulación
    $sql = "SELECT id_camaronera, hectareas, incremento, peso_final, piscinas, id_corrida, gr_dias 
            FROM simulacion_proceso_test 
            WHERE id_camaronera = '$id_camaronera' 
              AND piscinas = '$id_piscina' 
              AND id_corrida = '$id_corrida' 
              AND id_bio = 'BW 7 dias'";
    $data_simulacion = $conectar->mostrar($sql);

    // Consulta para obtener las fechas y cantidades de registro_alimentacion_engorde
    $sql_alimentacion = "SELECT fecha_alimentacion, SUM(cantidad + cantidad_2) AS total_diario 
                         FROM registro_alimentacion_engorde 
                         WHERE id_camaronera = '$id_camaronera' 
                           AND id_piscina = '$id_piscina' 
                           AND id_corrida = '$id_corrida' 
                         GROUP BY fecha_alimentacion";
    $data_alimentacion = $conectar->mostrar($sql_alimentacion);

    // Verificar si hay datos de simulación para esta piscina
    foreach ($data_simulacion as $simulacion) {
        $hectareas = $simulacion['hectareas'];
        $incremento = $simulacion['incremento'];
        $gr_dia = $simulacion['gr_dias'];
        $peso_final = $simulacion['peso_final'];
        $total_acumulado = $peso_final;
        $total_ind_x_metro_m_semana = 0;
        $contador_dias_semana = 0;

        // Iterar por cada día de la semana
        foreach ($days as $day) {
            $cantidad_total = 0;
            $cantidad_total_ha = 0;
            $fecha_alimentacion_mostrada = '';
            $semana = ''; // Variable para almacenar el número de semana

            // Iterar por cada registro de alimentación
            foreach ($data_alimentacion as $alimentacion) {
                $fecha_alimentacion = $alimentacion['fecha_alimentacion'];
                $total_diario = $alimentacion['total_diario'];

                // Comparar el día de la fecha de alimentación con el día actual del loop
                if (getDayName($fecha_alimentacion) == $day) {
                    $cantidad_total = $total_diario;
                    $cantidad_total_ha = $total_diario / $hectareas;
                    $fecha_alimentacion_mostrada = $fecha_alimentacion;
                    // Obtener la semana del año
                    $semana = date('W', strtotime($fecha_alimentacion));
                }
            }

            // Calcular valores adicionales
            $total_acumulado += $gr_dia;
            $kg_10_m = 1.00 / (0.007963335 + 0.1387779 / $total_acumulado);
            $kg_ha_semana_m = $cantidad_total_ha / 1;
            $ind_x_metro_m = $kg_ha_semana_m * 10 / $kg_10_m;
            $total_ind_x_metro_m_semana += $ind_x_metro_m;
            $contador_dias_semana++;
            $promedio_ind_x_metro_m_semana = $total_ind_x_metro_m_semana / $contador_dias_semana;

            // Insertar en la tabla alimentacion_diaria (opcional)
            $sql_insert = "INSERT INTO alimentacion_diaria 
                            (id_camaronera, dia_semana, fecha_alimentacion, id_piscina, id_corrida, peso_final, incremento, gr_dia, total_acumulado, cantidad_total, cantidad_total_ha, ind_x_metro_m, promedio_ind_x_metro_m_semana)
                           VALUES
                            ('$id_camaronera', '$day', '$fecha_alimentacion_mostrada', '$id_piscina', '$id_corrida', '$peso_final', '$incremento', '$gr_dia', '$total_acumulado', '$cantidad_total', '$cantidad_total_ha', '$ind_x_metro_m', '$promedio_ind_x_metro_m_semana')";
            $insert = mysqli_query($conexion, $sql_insert); // Realizar la inserción si es necesario

            // Mostrar los resultados en la tabla HTML
            echo "<tr>
                    <td>{$id_camaronera}</td>
                    <td>{$day}</td>
                    
                    <td>{$fecha_alimentacion_mostrada}</td>
                    <td>{$id_piscina}</td>
                    <td>{$id_corrida}</td>
                    <td>" . number_format($peso_final, 2) . "</td>
                    <td>" . number_format($incremento, 2) . "</td>
                    <td>" . number_format($gr_dia, 2) . "</td>
                    <td>" . number_format($total_acumulado, 2) . "</td>
                    <td>" . number_format($cantidad_total, 2) . "</td>
                    <td>" . number_format($cantidad_total_ha, 6) . "</td>
                    <td>" . number_format($ind_x_metro_m, 6) . "</td>
                    <td>" . number_format($promedio_ind_x_metro_m_semana, 2) . "</td>
                  </tr>";
        }
    }
}

echo "</table>";

?>
