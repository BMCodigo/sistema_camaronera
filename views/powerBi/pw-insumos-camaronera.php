<?php 

    include '../../models/conexion.php';
 
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    // Establecer la zona horaria
    date_default_timezone_set('America/Guayaquil');
?>

<table class="table table-bordered table-responsive">
    <thead>
        <tr>
        <th scope="col">fecha</th>
        <th scope="col">camaronera</th>
        <th scope="col">nombre cama</th>
        <th scope="col">piscina</th>
        <th scope="col">corrida</th>
        <th scope="col">hectarea</th>
        <th scope="col">familia</th>
        <th scope="col">producto</th>
        <th scope="col">medida</th>
        <th scope="col">cantidad</th>
        <th scope="col">costo</th>
        <th scope="col">total</th>
        <th scope="col">total ha</th>
        <th scope="col">costo total</th>
        <th scope="col">costo total Ha</th>
        <th scope="col">prsupuesto</th>
        <th scope="col">prsupuesto ha</th>
        <th scope="col">total consumido</th>
        
        </tr>
    </thead>

    <?php

        // Consulta para verificar si la piscina está en proceso y obtener hectáreas
        $SqlInicio = "SELECT id_camaronera, id_piscina, id_corrida, hectareas, estado

        FROM registro_piscina_engorde 
        WHERE id_camaronera 
        IN (1)
        /*IN (1,2,3,5)  */
        /*AND id_piscina = 4
        AND id_corrida = 39*/
        AND estado = 'En proceso'";
        $data_inicio = $conectar->mostrar($SqlInicio);
        
        foreach($data_inicio as $i){

            $id_camaronera = $i['id_camaronera'];
            $id_piscina = $i['id_piscina'];
            $id_corrida = $i['id_corrida'];
            $hectareas = $i['hectareas'];
            $estado = $i['estado'];
        
            // Consulta para obtener las fechas y cantidades de registro_alimentacion_engorde
            $sql_costos = "SELECT *,
            CASE id_camaronera
                WHEN 1 THEN 'Total consumido'
                WHEN 2 THEN 'Total consumido'
                WHEN 3 THEN 'Total consumido'
                WHEN 5 THEN 'Total consumido'
                ELSE 0
            END AS consumo_nombre,
            CASE id_camaronera
                WHEN 1 THEN 'Presupuesto Ha'
                WHEN 2 THEN 'Presupuesto Ha'
                WHEN 3 THEN 'Presupuesto Ha'
                WHEN 5 THEN 'Presupuesto Ha'
                ELSE 0
            END AS presupuesto_nombre,
            CASE id_camaronera
                WHEN 1 THEN 'Restante'
                WHEN 2 THEN 'Restante'
                WHEN 3 THEN 'Restante'
                WHEN 5 THEN 'Restante'
                ELSE 0
            END AS restante_nombre,
            CASE id_camaronera
                WHEN 1 THEN 'Hectareas'
                WHEN 2 THEN 'Hectareas'
                WHEN 3 THEN 'Hectareas'
                WHEN 5 THEN 'Hectareas'
                ELSE 0
            END AS hectareas_nombre 

            FROM costos_camaronera WHERE id_camaronera = '$id_camaronera' AND id_piscina = '$id_piscina' AND id_corrida = '$id_corrida' ";
            $data_costos = $conectar->mostrar($sql_costos);

            $costoTotal = 0;
            $costoTotalHa = 0;

            foreach($data_costos as $c){

                $fecha_consumo = $c['fecha_consumo'];
                $id_camaronera = $c['id_camaronera'];
                $nombre_camaronera = $c['nombre_camaronera'];
                $piscina = $c['id_piscina'];
                $corrida = $c['id_corrida'];
                $hectareas = $c['hectareas'];
                $familia = $c['familia'];
                $producto = $c['producto'];
                $medida = $c['medida'];
                $cantidad = $c['cantidad'];
                $costo = $c['costo'];
                $total = $c['total'];
                $total_ha = $c['total_ha'];
                $costoTotal += $total; 
                $costoTotalHa += $total/$hectareas; 
                $presupuesto = 500;
                $presupuestoHa = $presupuesto/$hectareas;
                $totalconsumido = $presupuesto - $costoTotalHa;
                $consumo_nombre = $c['consumo_nombre'];
                $presupuesto_nombre = $c['presupuesto_nombre'];
                $restante_nombre = $c['restante_nombre'];
                $hectareas_nombre = $c['hectareas_nombre'];


                // Consulta SQL para insertar los datos
                $sqlInsumos = "INSERT INTO pw_insumos_camaronera (fecha_consumo, id_camaronera, nombre_camaronera, id_piscina, id_corrida,
                 hectareas, familia, producto, medida, cantidad, costo, total, total_ha, costoTotal, costoTotalHa, presupuesto, presupuestoHa, totalconsumido, consumo_nombre, presupuesto_nombre, restante_nombre, hectareas_nombre)
                VALUES ('$fecha_consumo', '$id_camaronera', '$nombre_camaronera', '$piscina', '$corrida', 
                '$hectareas', '$familia', '$producto', '$medida', '$cantidad', '$costo', '$total', '$total_ha', '$costoTotal', '$costoTotalHa', '$presupuesto', '$presupuestoHa', '$totalconsumido', '$consumo_nombre', '$presupuesto_nombre', '$restante_nombre', '$hectareas_nombre')";
                $insert = mysqli_query($conexion, $sqlInsumos); // Realizar la inserción


             ?>

                <tbody>
                    <tr>
                        <td><?php echo $fecha_consumo;?></td>
                        <td><?php echo $id_camaronera;?></td>
                        <td><?php echo $nombre_camaronera;?></td>
                        <td><?php echo $piscina;?></td>
                        <td><?php echo $corrida;?></td>
                        <td><?php echo $hectareas;?></td>
                        <td><?php echo $familia;?></td>
                        <td><?php echo $producto;?></td>
                        <td><?php echo $medida;?></td>
                        <td><?php echo $cantidad;?></td>
                        <td><?php echo $costo;?></td>
                        <td><?php echo $total;?></td>
                        <td><?php echo $total_ha;?></td>
                        <td><?php echo $costoTotal;?></td>
                        <td><?php echo $costoTotalHa;?></td>
                        <td><?php echo $presupuesto;?></td>
                        <td><?php echo $presupuestoHa;?></td>
                        <td><?php echo $totalconsumido;?></td>
                        <td><?php echo $consumo_nombre;?></td>
                        <td><?php echo $presupuesto_nombre;?></td>
                        <td><?php echo $restante_nombre;?></td>
                        <td><?php echo $hectareas_nombre;?></td>
                    
                    </tr>
                </tbody>
                



        <?php } } ?>

</table>

<style>

    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    table {
        width: 80%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 1em;
        text-align: left;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    thead {
        background-color: #009879;
        color: white;
    }

    th, td {
        padding: 12px 15px;
        border: 1px solid #ddd;
    }

    tbody tr {
        background-color: #f3f3f3;
    }

    tbody tr:nth-child(even) {
        background-color: #e9e9e9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
    }

</style>