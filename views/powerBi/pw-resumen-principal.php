<div class="jumbotron">
    <h2>Actualizacion de parametros</h2>
    <p class="lead">Para actualizar los datos del resumen principal, por favor dar ingrese los datos en el
        <strong>formulario</strong>.</p>
    <hr class="my-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="#">
                    
                    <div class="form-group">
                        <label for="formGroupExampleInput">Desde</label>
                        <input type="date" class="form-control" name="desde" placeholder="Example input" required>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Hasta</label>
                        <input type="date" class="form-control" name="hasta" placeholder="Another input" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                 
                </form>
            </div>
        </div>
    </div>
    <br><hr><br>
    <div class="container">

        <div class="row">
    
            <div class="col-md-7">
                <p class="lead">Meta suguerida de cumplimiento de pesca
                <strong>(trimestral)</strong>.</p>
                
                <form action="#" method="post">
                    
    
                    <?php
                        // Configurar la zona horaria y el locale para español de Ecuador
                        setlocale(LC_TIME, 'es_EC.UTF-8');
                        date_default_timezone_set('America/Guayaquil');
                        // Verificar si el formulario fue enviado y los datos existen
                        if (isset($_POST['desde'], $_POST['hasta'])) { 
    
                        // Variables de entrada
                        $desde = $_POST['desde']; // Supongamos que tiene formato 'YYYY-MM-DD'
                        $hasta = $_POST['hasta'];
    
    
                        // Convertimos las fechas a formato timestamp
                        $desdeDia = date("d", strtotime($desde)); // Extraemos el día
                        $desdeMes = strftime("%b", strtotime($desde)); // Extraemos el mes abreviado en español
                        $hastaDia = date("d", strtotime($hasta)); // Extraemos el día
                        $hastaMes = strftime("%b", strtotime($hasta)); // Extraemos el mes abreviado en español
                        // Extraer el año de las fechas
                        $desdeAnio = date("Y", strtotime($desde)); // Extrae el año de $desde
                        $hastaAnio = date("Y", strtotime($hasta)); // Extrae el año de $hasta
    
    
                    ?>
    
                    <div class="alert alert-success mt-5 col-12" role="alert">
                        Formulario de actualizacion
                    </div>
                    <table class="table table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Meta Anual</th>
                                <th scope="col">Lbs cosechadas</th>
                                <th scope="col">% cumplimiento</th>
    
    
                            </tr>
                        </thead>
                        <tbody>
    
                            <tr>
    
                                <th scope="row">Libras</th>
    
                                <td>
                                    <?php 
    
                                            $meta_anual = "SELECT id_camaronera, 
                                            CASE WHEN id_camaronera = 1 THEN 4000000 
                                            WHEN id_camaronera = 2 THEN 6000000 
                                            WHEN id_camaronera = 3 THEN 2500000 
                                            WHEN id_camaronera = 5 THEN 4000000 
                                            ELSE 0 END AS meta_anual 
                                            FROM registro_pesca_engorde 
                                            WHERE id_camaronera = '$camaronera' 
                                            AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            ORDER BY id_piscina, fecha_pesca ASC LIMIT 1;";
    
                                            $data = $conectar->mostrar($meta_anual);
                                            foreach ($data as $key):
                                                echo '<input type="text" name="libras_anual_sugerido" id="libras_anual_sugerido" value="0.00">';
                                            endforeach;
                                        ?>
                                </td>
    
                                <td>
    
                                    <?php 
                                            $meta_anual = "SELECT 
                                             
                                            -- Suma acumulada de todas las filas de lbs_finales
                                            SUM((IFNULL((SELECT SUM(libras_pescadas)
                                                         FROM registro_pesca_engorde 
                                                         WHERE estado = 'Raleo' 
                                                           AND id_camaronera = t1.id_camaronera
                                                           AND id_piscina = t1.id_piscina 
                                                           AND id_corrida = t1.id_corrida), 0) 
                                                 + IFNULL(t1.libras_pescadas, 0)) * t1.hectareas)
                                            OVER () AS lbs_anual
                                        
                                        FROM 
                                            registro_pesca_engorde t1
                                        INNER JOIN 
                                            registro_piscina_engorde t2 
                                            ON t1.id_piscina = t2.id_piscina 
                                            AND t1.id_corrida = t2.id_corrida
                                        WHERE 
                                            t1.id_camaronera = '$camaronera'
                                            AND t1.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                            AND t1.estado = 'Cosechado'
                                            AND t2.estado = 'Cosechado'
                                        GROUP BY 
                                            t2.id_piscina, t2.id_corrida, t1.fecha_pesca, t1.id_piscina, t1.id_corrida, t1.hectareas LIMIT 1";
    
                                            $data = $conectar->mostrar($meta_anual);
                                            foreach ($data as $key) :
                                                echo '<input type="text" name="libras_anual_pescado" id="libras_anual_pescado"  readonly value="' .intval($key['lbs_anual']). '">';
                                            endforeach;
    
                                        ?>
    
                                </td>
    
                                <td>
                                    <?php 
                                            $porcentaje = "SELECT 
                                                    (CASE 
                                                        WHEN (CASE 
                                                                WHEN id_camaronera = 1 THEN 340
                                                                WHEN id_camaronera = 2 THEN 507
                                                                WHEN id_camaronera = 3 THEN 250
                                                                WHEN id_camaronera = 5 THEN 340
                                                                ELSE 0
                                                            END) != 0 THEN 
                                                            CASE 
                                                                WHEN id_camaronera = 1 THEN 4000000
                                                                WHEN id_camaronera = 2 THEN 6000000
                                                                WHEN id_camaronera = 3 THEN 2500000 
                                                                WHEN id_camaronera = 5 THEN 4000000 
                                                                ELSE 0
                                                            END / 
                                                            (CASE 
                                                                WHEN id_camaronera = 1 THEN 340
                                                                WHEN id_camaronera = 2 THEN 507
                                                                WHEN id_camaronera = 3 THEN 250
                                                                WHEN id_camaronera = 5 THEN 340
                                                                ELSE 0
                                                            END)
                                                        ELSE NULL
                                                    END) AS meta_ha_anual,
                                                    
                                                    CASE 
                                                        WHEN id_camaronera = 1 THEN 340
                                                        WHEN id_camaronera = 2 THEN 507
                                                        WHEN id_camaronera = 3 THEN 250
                                                        WHEN id_camaronera = 5 THEN 340
                                                        ELSE 0
                                                    END AS ha_anual,
                                                    
                                                    -- Cálculo del porcentaje de cumplimiento
                                                    (SUM(libras_pescadas * hectareas) OVER (PARTITION BY id_camaronera) / 
                                                    CASE 
                                                        WHEN id_camaronera = 1 THEN 4000000
                                                        WHEN id_camaronera = 2 THEN 6000000
                                                        WHEN id_camaronera = 3 THEN 2500000 
                                                        WHEN id_camaronera = 5 THEN 4000000 
                                                        ELSE 0
                                                    END) * 100 AS porcentaje_cumplimiento
                                                FROM 
                                                    registro_pesca_engorde 
                                                WHERE 
                                                    id_camaronera = '$camaronera' 
                                                    AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                                ORDER BY 
                                                    id_piscina, fecha_pesca ASC LIMIT 1"; 
    
                                                $data = $conectar->mostrar($porcentaje);
    
                                                foreach ($data as $key):
                                                    
                                                    echo '<input type="text" name="porcentaje_cumplimiento" readonly id="porcentaje_cumplimiento" value="' .number_format(0.00,2). '">';
                                                endforeach;
                                            
                                        ?>
    
                                </td>
    
                            </tr>
    
                            <tr>
    
                                <th scope="row">libras/Ha</th>
                                <td>
                                    <?php 
                                            $lbsHaMeta = "SELECT 
                                            
                                                (CASE 
                                                    WHEN CASE 
                                                            WHEN id_camaronera = 1 THEN 340
                                                            WHEN id_camaronera = 2 THEN 507
                                                            WHEN id_camaronera = 3 THEN 250
                                                            WHEN id_camaronera = 5 THEN 340
                                                            ELSE 0
                                                        END != 0 THEN 
                                                        CASE 
                                                            WHEN id_camaronera = 1 THEN 4000000
                                                            WHEN id_camaronera = 2 THEN 6000000
                                                            WHEN id_camaronera = 3 THEN 2500000 
                                                            WHEN id_camaronera = 5 THEN 4000000 
                                                            ELSE 0
                                                        END / 
                                                        CASE 
                                                            WHEN id_camaronera = 1 THEN 340
                                                            WHEN id_camaronera = 2 THEN 507
                                                            WHEN id_camaronera = 3 THEN 250
                                                            WHEN id_camaronera = 5 THEN 340
                                                            ELSE 0
                                                        END
                                                    ELSE NULL
                                                END) AS meta_ha_anual
                                                
                                            FROM 
                                                registro_pesca_engorde 
                                            WHERE 
                                                id_camaronera = '$camaronera'
                                                AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            ORDER BY 
                                                id_piscina, fecha_pesca ASC LIMIT 1";
    
                                            $data = $conectar->mostrar($lbsHaMeta);
    
                                            foreach ($data as $key):
                                                
                                                echo '<input type="text" name="libras_ha_sugerido" id="libras_ha_sugerido"  value="0.00">';
                                            endforeach;
                                        ?>
                                </td>
                                <td>
                                    <?php 
                                            $lbsHaCumplimiento = "SELECT 
                                                (SUM((IFNULL((SELECT SUM(libras_pescadas)
                                                              FROM registro_pesca_engorde 
                                                              WHERE estado = 'Raleo' 
                                                                AND id_camaronera = t1.id_camaronera
                                                                AND id_piscina = t1.id_piscina 
                                                                AND id_corrida = t1.id_corrida), 0) 
                                                     + IFNULL(t1.libras_pescadas, 0)) * t1.hectareas)
                                                OVER () / 
                                                SUM(IFNULL((SELECT SUM(hectareas)
                                                            FROM registro_piscina_engorde
                                                            WHERE estado = 'Cosechado' 
                                                              AND id_camaronera = t1.id_camaronera
                                                              AND id_piscina = t1.id_piscina 
                                                              AND id_corrida = t1.id_corrida), 0))
                                                OVER () ) AS lbs_total_ha_pescado
                                            FROM 
                                                registro_pesca_engorde t1
                                            INNER JOIN 
                                                registro_piscina_engorde t2 
                                                ON t1.id_piscina = t2.id_piscina 
                                                AND t1.id_corrida = t2.id_corrida
                                            WHERE 
                                                t1.id_camaronera = '$camaronera'
                                                AND t1.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                                AND t1.estado = 'Cosechado'
                                                AND t2.estado = 'Cosechado'
                                            GROUP BY 
                                                t2.id_piscina, t2.id_corrida, t1.fecha_pesca, t1.id_piscina, t1.id_corrida, t1.hectareas
                                            LIMIT 1;
                                        ";
    
                                                $datas = $conectar->mostrar($lbsHaCumplimiento);
    
                                                foreach ($datas as $key):
                                                    
                                                    echo '<input type="text" name="libras_ha_pescado" id="libras_ha_pescado" readonly value="' .intval($key['lbs_total_ha_pescado']). '">';
                                                    
                                                endforeach;
                                        ?>
                                </td>
                                <td>
                                    <?php 
                                            $porcentaje_ha = "SELECT 
                                            
                                        
                                            (NULLIF(
                                                (SUM(libras_pescadas * hectareas) OVER (PARTITION BY id_camaronera) / 
                                                NULLIF(SUM(CASE WHEN estado in ('Cosechado') THEN hectareas ELSE 0 END) OVER (PARTITION BY id_camaronera), 0)), 0
                                            ) / 
                                            NULLIF(
                                                (CASE 
                                                    WHEN CASE 
                                                            WHEN id_camaronera = 1 THEN 340
                                                            WHEN id_camaronera = 2 THEN 507
                                                            WHEN id_camaronera = 3 THEN 250
                                                            WHEN id_camaronera = 5 THEN 340

                                                            ELSE 0
                                                        END != 0 THEN 
                                                        CASE 
                                                            WHEN id_camaronera = 1 THEN 4000000
                                                            WHEN id_camaronera = 2 THEN 6000000
                                                            WHEN id_camaronera = 3 THEN 2500000 
                                                            WHEN id_camaronera = 5 THEN 4000000 
                                                            ELSE 0
                                                        END / 
                                                        CASE 
                                                            WHEN id_camaronera = 1 THEN 340
                                                            WHEN id_camaronera = 2 THEN 507
                                                            WHEN id_camaronera = 3 THEN 250
                                                            WHEN id_camaronera = 5 THEN 340

                                                            ELSE 0
                                                        END
                                                    ELSE NULL
                                                END), 0
                                            )) * 100 AS porcentaje_ha
                                            
                                            FROM 
                                                registro_pesca_engorde 
                                            WHERE 
                                                id_camaronera = '$camaronera'
                                                AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            ORDER BY 
                                            id_piscina, fecha_pesca ASC LIMIT 1"; 
    
                                            $data = $conectar->mostrar($porcentaje_ha);
    
                                            foreach ($data as $key):
                                                
                                                echo '<input type="text" name="porcentaje_meta_ha" readonly id="porcentaje_meta_ha" value="' .number_format(0.00,2). '">';
                                            endforeach;
                                            
                                        ?>
                                </td>
    
                            </tr>
    
                            <tr>
    
                                <th scope="row">Conversion</th>
                                <td>
                                    <?php
                                                $fcv_ideal = "SELECT 
    
                                                CASE WHEN id_camaronera = 1 THEN 1.45 
                                                    WHEN id_camaronera = 2 THEN 1.45 
                                                    WHEN id_camaronera = 3 THEN 1.45
                                                    WHEN id_camaronera = 5 THEN 1.45 
                                                ELSE 0 END AS fcv_ideal
                                                
                                            FROM 
                                                registro_pesca_engorde rpe
                                            WHERE 
                                                rpe.id_camaronera = '$camaronera'
                                                AND rpe.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                                AND rpe.estado = 'Cosechado'
                                            ORDER BY 
                                                rpe.id_piscina, 
                                                rpe.fecha_pesca ASC LIMIT 1";
    
                                            $data = $conectar->mostrar($fcv_ideal);
    
                                            foreach ($data as $key):
                                                
                                                echo '<input type="text" name="fcv_ideal" id="fcv_ideal" value="' .number_format(0.00,2). '">';
                                            endforeach;
                                            
                                        ?>
    
                                </td>
                                <td>
    
                                    <?php 
                                            $fcv = "SELECT 
                                            AVG(fcv) AS promedio_fcv
                                        FROM (
                                            SELECT 
                                                
                                    
                                                -- Cálculo del Factor de Conversión de Alimento (FCV)
                                                (IFNULL((SELECT SUM(cantidad+cantidad_2)
                                                         FROM registro_alimentacion_engorde 
                                                         WHERE id_camaronera = t1.id_camaronera
                                                           AND id_piscina = t1.id_piscina 
                                                           AND id_corrida = t1.id_corrida), 0) * 2.2046) /
                                                ((IFNULL((SELECT SUM(libras_pescadas)
                                                          FROM registro_pesca_engorde 
                                                          WHERE estado = 'Raleo' 
                                                            AND id_camaronera = t1.id_camaronera
                                                            AND id_piscina = t1.id_piscina 
                                                            AND id_corrida = t1.id_corrida), 0) 
                                                  + IFNULL(t1.libras_pescadas, 0)) * t1.hectareas) AS fcv
                                            FROM 
                                                registro_pesca_engorde t1
                                            INNER JOIN 
                                                registro_piscina_engorde t2 
                                                ON t1.id_piscina = t2.id_piscina 
                                                AND t1.id_corrida = t2.id_corrida
                                            WHERE 
                                                t1.id_camaronera = '$camaronera'
                                                AND t1.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                                AND t1.estado = 'Cosechado'
                                                AND t2.estado = 'Cosechado'
                                            GROUP BY 
                                                t2.id_piscina, t2.id_corrida, t1.fecha_pesca, t1.id_piscina, t1.id_corrida, t1.hectareas
                                        ) AS subquery;
                                        ";
    
                                        $data = $conectar->mostrar($fcv);
    
                                        foreach ($data as $key):
                                            echo '<input type="text" name="fcv_pescado" id="fcv_pescado" readonly value="' .number_format($key['promedio_fcv'],2). '">';
                                        endforeach;
                                            
                                            ?>
    
    
                                </td>
                                <td>
                                    <?php
                                                $porcentaje_fcv = "SELECT 
                                                rpe.id_camaronera, 
                                                rpe.id_piscina, 
                                                rpe.id_corrida, 
                                                (libras_pescadas * hectareas) AS lbs_total,
                                                (
                                                    SELECT (SUM(rae.cantidad + rae.cantidad_2) * 2.2046)
                                                    FROM registro_alimentacion_engorde rae
                                                    WHERE rae.id_camaronera = rpe.id_camaronera
                                                    AND rae.id_piscina = rpe.id_piscina
                                                    AND rae.id_corrida = rpe.id_corrida
                                                ) AS alim_acum,
                                                (
                                                    (
                                                        SELECT (SUM(rae.cantidad + rae.cantidad_2) * 2.2046)
                                                        FROM registro_alimentacion_engorde rae
                                                        WHERE rae.id_camaronera = rpe.id_camaronera
                                                        AND rae.id_piscina = rpe.id_piscina
                                                        AND rae.id_corrida = rpe.id_corrida
                                                    ) / 
                                                    (libras_pescadas * hectareas)
                                                ) AS fcv,
                                                CASE WHEN id_camaronera = 1 THEN 1.45 
                                                    WHEN id_camaronera = 2 THEN 1.45 
                                                ELSE 0 END AS fcv_ideal, 
                                                (
                                                    SELECT AVG(
                                                        (
                                                            SELECT (SUM(rae.cantidad + rae.cantidad_2) * 2.2046)
                                                            FROM registro_alimentacion_engorde rae
                                                            WHERE rae.id_camaronera = r.id_camaronera
                                                            AND rae.id_piscina = r.id_piscina
                                                            AND rae.id_corrida = r.id_corrida
                                                        ) / 
                                                        (r.libras_pescadas * r.hectareas)
                                                    )
                                                    FROM registro_pesca_engorde r
                                                    WHERE r.id_camaronera = rpe.id_camaronera
                                                    AND r.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                                    AND r.estado = 'Cosechado'
                                                ) AS promedio_fcv,
                                                (
                                                    CASE 
                                                        WHEN 
                                                            CASE WHEN id_camaronera = 1 THEN 1.45 
                                                                WHEN id_camaronera = 2 THEN 1.45 
                                                                WHEN id_camaronera = 3 THEN 1.45
                                                                WHEN id_camaronera = 5 THEN 1.45 
                                                            ELSE 0 END > 0 
                                                        THEN 
                                                            (
                                                                (SELECT AVG(
                                                                    (
                                                                        SELECT (SUM(rae.cantidad + rae.cantidad_2) * 2.2046)
                                                                        FROM registro_alimentacion_engorde rae
                                                                        WHERE rae.id_camaronera = r.id_camaronera
                                                                        AND rae.id_piscina = r.id_piscina
                                                                        AND rae.id_corrida = r.id_corrida
                                                                    ) / 
                                                                    (r.libras_pescadas * r.hectareas)
                                                                )
                                                                FROM registro_pesca_engorde r
                                                                WHERE r.id_camaronera = rpe.id_camaronera
                                                                AND r.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                                                AND r.estado = 'Cosechado')
                                                                / 
                                                                CASE WHEN id_camaronera = 1 THEN 1.45
                                                                    WHEN id_camaronera = 2 THEN 1.45 
                                                                    WHEN id_camaronera = 3 THEN 1.45
                                                                    WHEN id_camaronera = 5 THEN 1.45 
                                                                ELSE 0 END
                                                            ) /* * 100*/
                                                        ELSE 0
                                                    END
                                                ) AS porcentaje_cumpli_fcv,
                                                rpe.estado
                                            FROM 
                                                registro_pesca_engorde rpe
                                            WHERE 
                                                rpe.id_camaronera = '$camaronera'
                                                AND rpe.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                                AND rpe.estado = 'Cosechado'
                                            ORDER BY 
                                                rpe.id_piscina, 
                                                rpe.fecha_pesca ASC LIMIT 1";
    
                                            $data = $conectar->mostrar($porcentaje_fcv);
    
                                            foreach ($data as $key):
                                                echo '<input type="text" name="porcentaje_fcv" readonly id="porcentaje_fcv" value="' .number_format(0.00,2). '">';
                                            endforeach;
                                            
                                        ?>
    
                                </td>
    
                            </tr>
    
                            <tr>
                                <th scope="row">Dias cultivo</th>
                                <td>
                                    <?php 
    
                                            $meta_dias = "SELECT id_camaronera, 
                                            CASE WHEN id_camaronera = 1 THEN 85 
                                            WHEN id_camaronera = 2 THEN 80 
                                            ELSE 0 END AS meta_dias 
                                            FROM registro_pesca_engorde 
                                            WHERE id_camaronera = '$camaronera'
                                            AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            ORDER BY id_piscina, fecha_pesca ASC LIMIT 1;";
    
                                            $data = $conectar->mostrar($meta_dias);
                                            foreach ($data as $key):
                                                
                                                echo '<input type="text" name="dias_sugerido" id="dias_sugerido"  value="0.00">';
                                            endforeach;
                                        ?>
                                </td>
                                <td>
                                    <?php 
    
                                            $dias_cultivo = "SELECT 
                                            re.id_camaronera,
                                            re.estado,
                                            re.fecha_pesca, 
                                            re.id_piscina, 
                                            re.id_corrida,
                                            rpe.fecha_siembra,
                                            DATEDIFF(re.fecha_pesca, rpe.fecha_siembra) + 1 AS dias_cultivo,
                                            AVG(DATEDIFF(re.fecha_pesca, rpe.fecha_siembra) + 1) 
                                            OVER (PARTITION BY re.estado) AS promedio_dias_cultivo
                                        FROM 
                                            registro_pesca_engorde re
                                        INNER JOIN 
                                            registro_piscina_engorde rpe
                                        ON 
                                            re.id_camaronera = rpe.id_camaronera
                                            AND re.id_piscina = rpe.id_piscina
                                            AND re.id_corrida = rpe.id_corrida
                                        WHERE 
                                            re.estado = 'Cosechado'
                                            AND re.id_camaronera = '$camaronera'
                                            AND re.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                        ORDER BY 
                                            re.id_piscina, re.fecha_pesca ASC LIMIT 1";
    
                                            $data = $conectar->mostrar($dias_cultivo);
                                            foreach ($data as $key):
                                                
                                                echo '<input type="text" name="dias_pescados" id="dias_pescados" readonly value="' .intval($key['promedio_dias_cultivo']). '">';
                                            endforeach;
                                        ?>
                                </td>
                                <td>
                                    <?php 
    
                                            $porcentaje_cumplimiento = "SELECT 
    
    
                                            AVG(DATEDIFF(re.fecha_pesca, rpe.fecha_siembra) + 1) OVER (PARTITION BY re.estado) AS promedio_dias_cultivo,
                                            (CASE 
                                                WHEN CASE 
                                                    WHEN re.id_camaronera = 1 THEN 85 
                                                    WHEN re.id_camaronera = 2 THEN 80 
                                                    WHEN re.id_camaronera = 3 THEN 85
                                                    WHEN re.id_camaronera = 5 THEN 85 
                                                    ELSE 0 
                                                END = 0 THEN NULL
                                                ELSE 
                                                    (AVG(DATEDIFF(re.fecha_pesca, rpe.fecha_siembra) + 1) OVER (PARTITION BY re.estado) * 100) / 
                                                    CASE 
                                                        WHEN re.id_camaronera = 1 THEN 85 
                                                        WHEN re.id_camaronera = 2 THEN 80
                                                        WHEN re.id_camaronera = 3 THEN 85
                                                        WHEN re.id_camaronera = 5 THEN 85 
                                                        ELSE 0 
                                                    END
                                            END) AS porcentaje_cumplimiento
                                        FROM 
                                            registro_pesca_engorde re
                                        INNER JOIN 
                                            registro_piscina_engorde rpe
                                        ON 
                                            re.id_camaronera = rpe.id_camaronera
                                            AND re.id_piscina = rpe.id_piscina
                                            AND re.id_corrida = rpe.id_corrida
                                        WHERE 
                                            re.estado = 'Cosechado'
                                            AND re.id_camaronera = '$camaronera'
                                            AND re.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                        ORDER BY 
                                            re.id_piscina, re.fecha_pesca ASC LIMIT 1";
    
                                            $data = $conectar->mostrar($porcentaje_cumplimiento);
                                            foreach ($data as $key):
                                                
                                                echo '<input type="text" name="porcentaje_dias" readonly id="porcentaje_dias" value="' .number_format(0.00,2). '">';
                                            endforeach;
                                        ?>
                                </td>
                            </tr>
    
                            <tr>
                                <th scope="row">peso</th>
                                <td>
                                    <?php
                                                $peso_ideal = "SELECT 
    
                                                CASE WHEN id_camaronera = 1 THEN 28 
                                                    WHEN id_camaronera = 2 THEN 28
                                                    WHEN id_camaronera = 3 THEN 28
                                                    WHEN id_camaronera = 5 THEN 28
                                                ELSE 0 END AS peso_ideal
                                                
                                            FROM 
                                                registro_pesca_engorde rpe
                                            WHERE 
                                                rpe.id_camaronera = '$camaronera'
                                                AND rpe.fecha_pesca BETWEEN '$desde' AND '$hasta'
                                                AND rpe.estado = 'Cosechado'
                                            ORDER BY 
                                                rpe.id_piscina, 
                                                rpe.fecha_pesca ASC LIMIT 1";
    
                                            $data = $conectar->mostrar($peso_ideal);
    
                                            foreach ($data as $key):
                                                
                                                echo '<input type="text" name="peso_sugerido" id="peso_sugerido" value="0.00">';
                                            endforeach;
                                            
                                        ?>
    
                                </td>
                                <td>
                                    <?php
                                                $peso_pesca = "SELECT 
    
                                                CASE WHEN id_camaronera = 1 THEN 28 
                                                WHEN id_camaronera = 2 THEN 28
                                                WHEN id_camaronera = 3 THEN 28
                                                WHEN id_camaronera = 5 THEN 28
                                                ELSE 0 END AS peso_ideal, 
    
                                                SUM(CASE WHEN estado = 'cosechado' THEN peso_pesca ELSE 0 END) OVER (PARTITION BY id_camaronera) AS peso_pesca_total,
                                                AVG(CASE WHEN estado = 'cosechado' THEN peso_pesca ELSE NULL END) OVER (PARTITION BY id_camaronera) AS promedio_peso_pesca
                                            FROM 
                                                registro_pesca_engorde re
                                            WHERE 
                                                id_camaronera = '$camaronera'
                                                AND fecha_pesca BETWEEN '$desde' AND '$hasta'
                                            ORDER BY 
                                                id_piscina, fecha_pesca ASC 
                                            LIMIT 1";
                                
                                            $data = $conectar->mostrar($peso_pesca);
                                            
                                            foreach ($data as $key) :
                                                
                                                echo '<input type="text" name="peso_pescado" readonly id="peso_pescado" readonly value="' .number_format($key['promedio_peso_pesca'],2). '">';
                                            endforeach;
                                        ?>
    
                                </td>
                                <td>
                                    <?php
                                                $peso_pesca_dif = "SELECT 
                                                id_camaronera,
                                                CASE 
                                                    WHEN id_camaronera = 1 THEN 28
                                                    WHEN id_camaronera = 2 THEN 28
                                                    WHEN id_camaronera = 3 THEN 28
                                                    WHEN id_camaronera = 5 THEN 28
                                                    ELSE 0 
                                                END AS peso_ideal,
                                                
                                                SUM(CASE WHEN estado = 'cosechado' THEN peso_pesca ELSE 0 END) OVER (PARTITION BY id_camaronera) AS peso_pesca_total,
                                                
                                                AVG(CASE WHEN estado = 'cosechado' THEN peso_pesca ELSE NULL END) OVER (PARTITION BY id_camaronera) AS promedio_peso_pesca,
                                                
                                                -- Calcular el porcentaje de diferencia
                                                CASE 
                                                    WHEN (CASE 
                                                                WHEN id_camaronera = 1 THEN 28
                                                                WHEN id_camaronera = 2 THEN 28
                                                                WHEN id_camaronera = 3 THEN 28
                                                                WHEN id_camaronera = 5 THEN 28
                                                                ELSE 0 
                                                            END) = 0 THEN NULL -- Evitar división por cero
                                                    ELSE 
                                                        ((AVG(CASE WHEN estado = 'cosechado' THEN peso_pesca ELSE NULL END) 
                                                            OVER (PARTITION BY id_camaronera) 
                                                            - 
                                                            CASE 
                                                                WHEN id_camaronera = 1 THEN 28
                                                                WHEN id_camaronera = 2 THEN 28
                                                                WHEN id_camaronera = 3 THEN 28
                                                                WHEN id_camaronera = 5 THEN 28
                                                                ELSE 0 
                                                            END) 
                                                            / 
                                                            CASE 
                                                                WHEN id_camaronera = 1 THEN 28
                                                                WHEN id_camaronera = 2 THEN 28
                                                                WHEN id_camaronera = 3 THEN 28
                                                                WHEN id_camaronera = 5 THEN 28
                                                                ELSE 0 
                                                            END) * 100
                                                END AS porcentaje_diferencia
                                            FROM 
                                                registro_pesca_engorde re
                                            WHERE 
                                                id_camaronera = '$camaronera'
                                                AND fecha_pesca BETWEEN '$desde' AND '$hasta'
                                            ORDER BY 
                                                id_piscina, fecha_pesca ASC 
                                            LIMIT 1";
                                
                                            $data = $conectar->mostrar($peso_pesca_dif);
                                            
                                            foreach ($data as $key) :
                                                
                                                echo '<input type="text" name="porcentaje_peso" readonly id="porcentaje_peso" value="' .number_format(0.00,2). '">';
                                            endforeach;
                                        ?>
    
                                </td>
                            </tr>
    
                            <tr>
                                <th scope="row">Ha/cosechadas</th>
                                <td>
                                    <?php 
    
                                            $ha_cosechadas_anual = "SELECT id_camaronera, 
                                            CASE WHEN id_camaronera = 1 THEN 340 
                                            WHEN id_camaronera = 2 THEN 510 
                                            WHEN id_camaronera = 3 THEN 250
                                            WHEN id_camaronera = 5 THEN 340
                                            ELSE 0 END AS ha_cosechadas_anual 
                                            FROM registro_pesca_engorde 
                                            WHERE id_camaronera = '$camaronera'
                                            AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            ORDER BY id_piscina, fecha_pesca ASC LIMIT 1;";
    
                                            $data = $conectar->mostrar($ha_cosechadas_anual);
                                            foreach ($data as $key):
                                                echo '<input type="text" name="ha_cosechadas_anual" id="ha_cosechadas_anual" value="0.00">';
                                            endforeach;
                                        ?>
                                </td>
                                <td>
                                    <?php 
    
                                            $ha_cosechadas_pesca = "SELECT id_camaronera, 
                                            SUM(hectareas) as hectareas 
                                            FROM registro_pesca_engorde 
                                            WHERE id_camaronera = '$camaronera'
                                            AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            AND estado = 'Cosechado'
                                            ORDER BY id_piscina, fecha_pesca ASC LIMIT 1;";
    
                                            $data = $conectar->mostrar($ha_cosechadas_pesca);
                                            foreach ($data as $key):
                                                echo '<input type="text" name="ha_cosechadas_pescado" readonly id="ha_cosechadas_pescado" value="' .number_format($key['hectareas'],2). '">';
                                            endforeach;
                                        ?>
                                </td>
                                <td>
                                    <?php 
    
                                            $ha_cosechadas_pesca = "SELECT 
                                            id_camaronera, 
                                            CASE 
                                                WHEN id_camaronera = 1 THEN 340 
                                                WHEN id_camaronera = 2 THEN 510 
                                                WHEN id_camaronera = 3 THEN 250
                                                WHEN id_camaronera = 5 THEN 340
                                                ELSE 0 
                                            END AS ha_cosechadas_anual,
                                            SUM(hectareas) AS hectareas,
                                            -- Cálculo del porcentaje de diferencia
                                            CASE 
                                                WHEN (CASE 
                                                        WHEN id_camaronera = 1 THEN 340 
                                                        WHEN id_camaronera = 2 THEN 510 
                                                        WHEN id_camaronera = 3 THEN 250
                                                        WHEN id_camaronera = 5 THEN 340
                                                        ELSE 0 
                                                        END) != 0 
                                                THEN 
                                                    (SUM(hectareas) 
                                                        
                                                    / 
                                                        (CASE 
                                                        WHEN id_camaronera = 1 THEN 340 
                                                        WHEN id_camaronera = 2 THEN 510 
                                                        WHEN id_camaronera = 3 THEN 250
                                                        WHEN id_camaronera = 5 THEN 340
                                                        ELSE 0 
                                                        END)) * 100 
                                                ELSE 0 
                                            END AS porcentaje_diferencia
                                        FROM 
                                            registro_pesca_engorde 
                                        WHERE 
                                            id_camaronera = '$camaronera'
                                            AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            AND estado = 'Cosechado'
                                        GROUP BY 
                                            id_camaronera
                                        ORDER BY 
                                            id_piscina, fecha_pesca ASC 
                                        LIMIT 1";
    
                                            $data = $conectar->mostrar($ha_cosechadas_pesca);
                                            foreach ($data as $key):
                                                echo '<input type="text" name="porcentaje_ha_cosechado" readonly id="porcentaje_ha_cosechado" value="' .number_format(0.00,2). '">';
                                            endforeach;
                                        ?>
                                </td>
                            </tr>
    
                            <tr>
                                <th scope="row">Costo por Lbr</th>
                                <td>
                                    <?php 
    
                                            $costo_lbr = "SELECT id_camaronera, 
                                            CASE WHEN id_camaronera = 1 THEN 1.40 
                                            WHEN id_camaronera = 2 THEN 1.30 
                                            WHEN id_camaronera = 3 THEN 1.30 
                                            WHEN id_camaronera = 5 THEN 1.30 
                                            ELSE 0 END AS meta_anual 
                                            FROM registro_pesca_engorde 
                                            WHERE id_camaronera = 1 
                                            AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            ORDER BY id_piscina, fecha_pesca ASC LIMIT 1;";
    
                                            $data = $conectar->mostrar($costo_lbr);
                                            foreach ($data as $key):
                                                echo '<input type="text" name="costo_libra" id="costo_libra" value="0.00">';
                                            endforeach;
                                        ?>
                                </td>
                                <td>
                                    <input type="text" name="costo_libra_pescado" id="costo_libra_pescado" value="1.20">
                                </td>
                                <td>
                                    <input type="text" name="porcentaje_costo_libra" readonly id="porcentaje_costo_libra"
                                        value="0.00">
                                </td>
    
                            </tr>
    
                            <tr>
                                <th scope="row">Costo Ha/dia</th>
                                <td>
                                    <?php 
    
                                            $costo_ha_dia = "SELECT id_camaronera, 
                                            CASE WHEN id_camaronera = 1 THEN 46
                                            WHEN id_camaronera = 2 THEN 50
                                            WHEN id_camaronera = 3 THEN 50
                                            WHEN id_camaronera = 5 THEN 50
                                            ELSE 0 END AS meta_anual 
                                            FROM registro_pesca_engorde 
                                            WHERE id_camaronera = '$camaronera' 
                                            AND fecha_pesca BETWEEN '$desde' AND '$hasta' 
                                            ORDER BY id_piscina, fecha_pesca ASC LIMIT 1;";
    
                                            $data = $conectar->mostrar($costo_ha_dia);
                                            foreach ($data as $key):
                                                echo '<input type="text" name="costo_ha_dia" id="costo_ha_dia" value="0.00">';
                                            endforeach;
                                        ?>
                                </td>
                                <td>
                                    <input type="text" name="costo_ha_dia_pescado" id="costo_ha_dia_pescado" value="46.12">
                                </td>
                                <td>
                                    <input type="text" name="porcentaje_costo_ha_dia" readonly id="porcentaje_costo_ha_dia"
                                        value="0.00">
                                </td>
    
                            </tr>
    
                        </tbody>
    
                    </table>
                    <input type="hidden" name="inicio" value="<?php echo $desdeDia. '/' .$desdeMes;?>">
                    <input type="hidden" name="fin" value="<?php echo $hastaDia. '/' .$hastaMes;?>">
                    <input type="hidden" name="inicioAnio" value="<?php echo $desdeAnio; ?>">
                    <input type="hidden" name="finAnio" value="<?php echo $hastaAnio;?>">
                    <center><button type="submit" class="btn btn-danger" name="guardar"> actualizar y guardar </button></center>
                    
                    <?php } ?>
                </form>
            </div>
    
    
            <div class="col-md-5">
                <!-- TABLA DE DATOS ACTUALIZADOS CON EL ULTIMO MOVIMIENTO -->
                </br></br>
                <div class="alert alert-primary mt-5 col-12 text-center" role="alert">
                    Registro de ultima actualizacion ingresada
                </div>
    
    
                <table class="table table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Meta Anual</th>
                            <th scope="col">Lbs cosechadas</th>
                            <th scope="col">% cumplimiento</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        <?php 
                                    $sqlResumenPrincipal = "SELECT * FROM pw_resumen_principal WHERE id_camaronera = '$camaronera' AND fecha_registro = (SELECT MAX(fecha_registro) FROM pw_resumen_principal WHERE id_camaronera = '$camaronera')"; 
                                    $data = $conectar->mostrar($sqlResumenPrincipal);
                                    foreach ($data as $key):
                                ?>
    
                        <tr>
    
                            <th scope="row">Libras</th>
    
                            <td>
                                <?php  echo number_format($key['libras_anual_sugerido'],0);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['libras_anual_pescado'],0);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['porcentaje_cumplimiento'],2);?>
                            </td>
    
                        </tr>
    
                        <tr>
    
                            <th scope="row">Libras/Ha</th>
    
                            <td>
                                <?php  echo number_format($key['libras_ha_sugerido'],0);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['libras_ha_pescado'],0);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['porcentaje_meta_ha'],2);?>
                            </td>
    
                        </tr>
    
                        <tr>
    
                            <th scope="row">Conversion</th>
    
                            <td>
                                <?php  echo number_format($key['fcv_ideal'],2);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['fcv_pescado'],2);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['porcentaje_fcv'],2);?>
                            </td>
    
                        </tr>
    
                        <tr>
    
                            <th scope="row">Dias cultivo</th>
    
                            <td>
                                <?php  echo number_format($key['dias_sugerido'],0);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['dias_pescados'],0);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['porcentaje_dias'],2);?>
                            </td>
    
                        </tr>
    
                        <tr>
    
                            <th scope="row">Peso</th>
    
                            <td>
                                <?php  echo number_format($key['peso_sugerido'],0);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['peso_pescado'],2);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['porcentaje_peso'],2);?>
                            </td>
    
                        </tr>
    
                        <tr>
    
                            <th scope="row">Ha/cosechadas</th>
    
                            <td>
                                <?php  echo number_format($key['ha_cosechadas_anual'],0);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['ha_cosechadas_pescado'],2);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['porcentaje_ha_cosechado'],2);?>
                            </td>
    
                        </tr>
    
                        <tr>
    
                            <th scope="row">Costo por lbr</th>
    
                            <td>
                                <?php  echo number_format($key['costo_libra'],2);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['costo_libra_pescado'],2);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['porcentaje_costo_libra'],2);?>
                            </td>
    
                        </tr>
    
                        <tr>
    
                            <th scope="row">Costo/Ha dia</th>
    
                            <td>
                                <?php  echo number_format($key['costo_ha_dia'],2);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['costo_ha_dia_pescado'],2);?>
                            </td>
    
                            <td>
                                <?php  echo number_format($key['porcentaje_costo_ha_dia'],2);?>
                            </td>
    
                        </tr>
    
                        <?php endforeach; ?>
    
                    </tbody>
                </table>
            </div>


            <div class="col-12">
                                
            <?php
                $sqlalimento = "SELECT 
                t2.cantidad,
                t2.id_tipo_alimento,
                CASE 
                    WHEN t2.id_tipo_alimento = 0 THEN 'FNLS 2.0'
                    WHEN t2.id_tipo_alimento = 1 THEN 'CLA AD 2.0'
                    WHEN t2.id_tipo_alimento = 2 THEN 'CLA 0.8'
                    WHEN t2.id_tipo_alimento = 3 THEN 'CLA 1.2'
                    WHEN t2.id_tipo_alimento = 4 THEN 'CLA 2.0'
                    WHEN t2.id_tipo_alimento = 5 THEN 'CLA PST TRANS 1.2'
                    WHEN t2.id_tipo_alimento = 6 THEN 'ORGN 0.3'
                    WHEN t2.id_tipo_alimento = 7 THEN 'ORGN 0.5'
                    WHEN t2.id_tipo_alimento = 8 THEN 'ORGN 0.8'
                    WHEN t2.id_tipo_alimento = 9 THEN 'TRP 0.8'
                    WHEN t2.id_tipo_alimento = 10 THEN 'TRP 1.2'
                    WHEN t2.id_tipo_alimento = 12 THEN 'TRP 2.0'
                    WHEN t2.id_tipo_alimento = 13 THEN 'TRP 0.8'
                    WHEN t2.id_tipo_alimento = 14 THEN 'TRP 1.2'
                    WHEN t2.id_tipo_alimento = 15 THEN 'KTL 0.8'
                    WHEN t2.id_tipo_alimento = 16 THEN 'KTL 1.2'
                    WHEN t2.id_tipo_alimento = 17 THEN 'KTL 2.0'
                    WHEN t2.id_tipo_alimento = 18 THEN 'KTL 2.5'
                    WHEN t2.id_tipo_alimento = 19 THEN 'FNSL EQ 2.0'
                    WHEN t2.id_tipo_alimento = 20 THEN 'FNLS 2.5'
                    WHEN t2.id_tipo_alimento = 21 THEN 'NTMIX 2.0'
                    WHEN t2.id_tipo_alimento = 22 THEN 'QLZ 2.5'
                    WHEN t2.id_tipo_alimento = 23 THEN 'HID PLT 2.0'
                    WHEN t2.id_tipo_alimento = 24 THEN 'HID EXT 2.0'
                    WHEN t2.id_tipo_alimento = 25 THEN 'balanceado NULL'
                    WHEN t2.id_tipo_alimento = 26 THEN 'KTL PRE 0.8'
                    WHEN t2.id_tipo_alimento = 27 THEN 'KTL PST TRNS 1.2'
                    WHEN t2.id_tipo_alimento = 28 THEN 'HID EXT 1.2'
                    WHEN t2.id_tipo_alimento = 29 THEN 'HID PLT 1.2'
                    WHEN t2.id_tipo_alimento = 30 THEN 'CLMB PLT 1.0'
                    WHEN t2.id_tipo_alimento = 31 THEN 'FNSL 2.0'
                    WHEN t2.id_tipo_alimento = 32 THEN 'CLA PRE 0.8'
                    WHEN t2.id_tipo_alimento = 33 THEN 'HID EXT FTNS 1.2'
                    WHEN t2.id_tipo_alimento = 34 THEN 'HID PLT FTNS 1.2'
                    WHEN t2.id_tipo_alimento = 35 THEN 'CLA AD AQ 2.0'
                    WHEN t2.id_tipo_alimento = 36 THEN 'LRC AD 2.0'
                    WHEN t2.id_tipo_alimento = 37 THEN 'LRC ad 4.0'
                    WHEN t2.id_tipo_alimento = 38 THEN 'MSTL 5
                    WHEN t2.id_tipo_alimento = 39 THEN 'KTL BIO 2.0'
                    WHEN t2.id_tipo_alimento = 40 THEN 'CLA AD EQ BIO 2.0'
                    WHEN t2.id_tipo_alimento = 41 THEN 'KTL ACR 2.0'
                    WHEN t2.id_tipo_alimento = 43 THEN 'KTL 33% 2.0'
                    WHEN t2.id_tipo_alimento = 44 THEN 'AQXCL 0.8'
                    WHEN t2.id_tipo_alimento = 45 THEN 'AQXCL 0.8'
                    WHEN t2.id_tipo_alimento = 46 THEN 'PRN 2.0'
                    WHEN t2.id_tipo_alimento = 47 THEN 'AQXCL 2.0'
                    WHEN t2.id_tipo_alimento = 48 THEN 'AQXCL 1.2'
                    WHEN t2.id_tipo_alimento = 49 THEN 'KTL 38% 1.2'
                    WHEN t2.id_tipo_alimento = 50 THEN 'KTL XG 35% 2.0'
                    WHEN t2.id_tipo_alimento = 51 THEN 'KTL PLUS 33% 2.0'
                    WHEN t2.id_tipo_alimento = 52 THEN 'HID SPD 37% 2.0'
                    WHEN t2.id_tipo_alimento = 53 THEN 'HID PLT 37% 2.0'
                    ELSE 'Desconocido'
                END AS descripcion_tipo_alimento,
                SUM(t2.cantidad) AS cantidad_1,
                t2.id_tipo_alimento_2,
                CASE 
                    WHEN t2.id_tipo_alimento_2 = 0 THEN 'FNLS 2.0'
                    WHEN t2.id_tipo_alimento_2 = 1 THEN 'CLA AD 2.0'
                    WHEN t2.id_tipo_alimento_2 = 2 THEN 'CLA 0.8'
                    WHEN t2.id_tipo_alimento_2 = 3 THEN 'CLA 1.2'
                    WHEN t2.id_tipo_alimento_2 = 4 THEN 'CLA 2.0'
                    WHEN t2.id_tipo_alimento_2 = 5 THEN 'CLA PST TRANS 1.2'
                    WHEN t2.id_tipo_alimento_2 = 6 THEN 'ORGN 0.3'
                    WHEN t2.id_tipo_alimento_2 = 7 THEN 'ORGN 0.5'
                    WHEN t2.id_tipo_alimento_2 = 8 THEN 'ORGN 0.8'
                    WHEN t2.id_tipo_alimento_2 = 9 THEN 'TRP 0.8'
                    WHEN t2.id_tipo_alimento_2 = 10 THEN 'TRP 1.2'
                    WHEN t2.id_tipo_alimento_2 = 12 THEN 'TRP 2.0'
                    WHEN t2.id_tipo_alimento_2 = 13 THEN 'TRP 0.8'
                    WHEN t2.id_tipo_alimento_2 = 14 THEN 'TRP 1.2'
                    WHEN t2.id_tipo_alimento_2 = 15 THEN 'KTL 0.8'
                    WHEN t2.id_tipo_alimento_2 = 16 THEN 'KTL 1.2'
                    WHEN t2.id_tipo_alimento_2 = 17 THEN 'KTL 2.0'
                    WHEN t2.id_tipo_alimento_2 = 18 THEN 'KTL 2.5'
                    WHEN t2.id_tipo_alimento_2 = 19 THEN 'FNSL EQ 2.0'
                    WHEN t2.id_tipo_alimento_2 = 20 THEN 'FNLS 2.5'
                    WHEN t2.id_tipo_alimento_2 = 21 THEN 'NTMIX 2.0'
                    WHEN t2.id_tipo_alimento_2 = 22 THEN 'QLZ 2.5'
                    WHEN t2.id_tipo_alimento_2 = 23 THEN 'HID PLT 2.0'
                    WHEN t2.id_tipo_alimento_2 = 24 THEN 'HID EXT 2.0'
                    WHEN t2.id_tipo_alimento_2 = 25 THEN 'balanceado NULL'
                    WHEN t2.id_tipo_alimento_2 = 26 THEN 'KTL PRE 0.8'
                    WHEN t2.id_tipo_alimento_2 = 27 THEN 'KTL PST TRNS 1.2'
                    WHEN t2.id_tipo_alimento_2 = 28 THEN 'HID EXT 1.2'
                    WHEN t2.id_tipo_alimento_2 = 29 THEN 'HID PLT 1.2'
                    WHEN t2.id_tipo_alimento_2 = 30 THEN 'CLMB PLT 1.0'
                    WHEN t2.id_tipo_alimento_2 = 31 THEN 'FNSL 2.0'
                    WHEN t2.id_tipo_alimento_2 = 32 THEN 'CLA PRE 0.8'
                    WHEN t2.id_tipo_alimento_2 = 33 THEN 'HID EXT FTNS 1.2'
                    WHEN t2.id_tipo_alimento_2 = 34 THEN 'HID PLT FTNS 1.2'
                    WHEN t2.id_tipo_alimento_2 = 35 THEN 'CLA AD AQ 2.0'
                    WHEN t2.id_tipo_alimento_2 = 36 THEN 'LRC AD 2.0'
                    WHEN t2.id_tipo_alimento_2 = 37 THEN 'LRC ad 4.0'
                    WHEN t2.id_tipo_alimento_2 = 38 THEN 'MSTL 5.0'
                    WHEN t2.id_tipo_alimento_2 = 39 THEN 'KTL BIO 2.0'
                    WHEN t2.id_tipo_alimento_2 = 40 THEN 'CLA AD EQ BIO 2.0'
                    WHEN t2.id_tipo_alimento_2 = 41 THEN 'KTL ACR 2.0'
                    WHEN t2.id_tipo_alimento_2 = 43 THEN 'KTL 33% 2.0'
                    WHEN t2.id_tipo_alimento_2 = 44 THEN 'AQXCL 0.8'
                    WHEN t2.id_tipo_alimento_2 = 45 THEN 'AQXCL 0.8'
                    WHEN t2.id_tipo_alimento_2 = 46 THEN 'PRN 2.0'
                    WHEN t2.id_tipo_alimento_2 = 47 THEN 'AQXCL 2.0'
                    WHEN t2.id_tipo_alimento_2 = 48 THEN 'AQXCL 1.2'
                    WHEN t2.id_tipo_alimento_2 = 49 THEN 'KTL 38% 1.2'
                    WHEN t2.id_tipo_alimento_2 = 50 THEN 'KTL XG 35% 2.0'
                    WHEN t2.id_tipo_alimento_2 = 51 THEN 'KTL PLUS 33% 2.0'
                    WHEN t2.id_tipo_alimento_2 = 52 THEN 'HID SPD 37% 2.0'
                    WHEN t2.id_tipo_alimento_2 = 53 THEN 'HID PLT 37% 2.0'
                    ELSE 'Desconocido'
                END AS descripcion_tipo_alimento_2,
                SUM(t2.cantidad_2) AS cantidad_2
            FROM 
                registro_piscina_engorde t1
            INNER JOIN 
                registro_alimentacion_engorde t2 
                ON t1.id_piscina = t2.id_piscina 
                AND t1.id_corrida = t2.id_corrida
            WHERE 
                t1.id_camaronera = '$camaronera'
                AND t2.fecha_alimentacion BETWEEN '$desde' AND '$hasta'
                AND t1.estado = 'En proceso'
            GROUP BY 
                t2.id_tipo_alimento, t2.id_tipo_alimento_2
            ORDER BY 
                t2.id_tipo_alimento, t2.id_tipo_alimento_2 ASC";

            $data = $conectar->mostrar($sqlalimento);

            // Inicializamos la variable para almacenar la suma.
            $totalCantidad = 0;
            foreach ($data as $alim):
                $alim['descripcion_tipo_alimento'];

                if( $alim['id_tipo_alimento']  == '16'){
                  echo  $totalCantidad += $alim['cantidad'];
                }
            endforeach;
            ?>

            </div>
        </div>
    </div>

</div>



<?php 
    if(isset($_POST['guardar'])){

                            
        // Configuración de conexión a la base de datos
/*        
        $servername = "190.90.160.172";
        $username = "gvascoco_aquapro_admin";
        $password = "d3v3l0p3r02023";
        $database = "gvascoco_aquapro";
        
*/
        $servername = "127.0.0.1:3307";
        $username = "root";
        $password = "";
        $database = "grupo_vasco";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Obtener los datos del formulario POST
        $camaronera;
        $libras_anual_sugerido = $_POST['libras_anual_sugerido'];
        $libras_anual_pescado = $_POST['libras_anual_pescado'];
        $libras_ha_sugerido = $_POST['libras_ha_sugerido'];
        $libras_ha_pescado = $_POST['libras_ha_pescado'];
        $fcv_ideal = $_POST['fcv_ideal'];
        $fcv_pescado = $_POST['fcv_pescado'];
        $dias_sugerido = $_POST['dias_sugerido'];
        $dias_pescados = $_POST['dias_pescados'];
        $peso_sugerido = $_POST['peso_sugerido'];
        $peso_pescado = $_POST['peso_pescado'];
        $porcentaje_cumplimiento = $_POST['porcentaje_cumplimiento'];
        $porcentaje_meta_ha = $_POST['porcentaje_meta_ha'];
        $porcentaje_fcv = $_POST['porcentaje_fcv'];
        $porcentaje_dias = $_POST['porcentaje_dias'];
        $porcentaje_peso = $_POST['porcentaje_peso'];
        $ha_cosechadas_anual = $_POST['ha_cosechadas_anual'];
        $ha_cosechadas_pescado = $_POST['ha_cosechadas_pescado'];
        $porcentaje_ha_cosechado = $_POST['porcentaje_ha_cosechado'];

        $costo_libra = $_POST['costo_libra'];
        $costo_libra_pescado = $_POST['costo_libra_pescado'];
        $porcentaje_costo_libra = $_POST['porcentaje_costo_libra'];

        $costo_ha_dia = $_POST['costo_ha_dia'];
        $costo_ha_dia_pescado = $_POST['costo_ha_dia_pescado'];
        $porcentaje_costo_ha_dia = $_POST['porcentaje_costo_ha_dia'];

        $inicio = $_POST['inicio'];
        $fin = $_POST['fin'];

        $inicioAnio = $_POST['inicioAnio'];
        $finAnio = $_POST['finAnio'];

        // Insertar datos en la tabla
        $sql = "INSERT INTO pw_resumen_principal (
            id_camaronera, libras_anual_sugerido, libras_anual_pescado, 
            libras_ha_sugerido, libras_ha_pescado, fcv_ideal, fcv_pescado, 
            dias_sugerido, dias_pescados, peso_sugerido, peso_pescado, 
            porcentaje_cumplimiento, porcentaje_meta_ha, porcentaje_fcv, 
            porcentaje_dias, porcentaje_peso, porcentaje_ha_cosechado, ha_cosechadas_anual, ha_cosechadas_pescado,
            costo_libra, costo_libra_pescado, porcentaje_costo_libra, costo_ha_dia, costo_ha_dia_pescado, porcentaje_costo_ha_dia, desde, hasta, desdeAnio, hastaAnio
        ) VALUES (
            '$camaronera', '$libras_anual_sugerido', '$libras_anual_pescado', 
            '$libras_ha_sugerido', '$libras_ha_pescado', '$fcv_ideal', '$fcv_pescado', 
            '$dias_sugerido', '$dias_pescados', '$peso_sugerido', '$peso_pescado', 
            '$porcentaje_cumplimiento', '$porcentaje_meta_ha', '$porcentaje_fcv', 
            '$porcentaje_dias', '$porcentaje_peso', '$porcentaje_ha_cosechado', '$ha_cosechadas_anual', '$ha_cosechadas_pescado',
            '$costo_libra', '$costo_libra_pescado', '$porcentaje_costo_libra', '$costo_ha_dia', '$costo_ha_dia_pescado', '$porcentaje_costo_ha_dia', '$inicio', '$fin', '$inicioAnio', '$finAnio'
        )";

        if ($conn->query($sql) === TRUE) {
            //echo "Datos insertados correctamente.";
            echo '  <script>
                        alert("Datos actualizados con exito");
                        window.location.href="../views/index.php?page=pw-resumen-principal";
                    </script>';
        } else {
            echo "Error al insertar datos: " . $conn->error;
        }
    }
?>


<script>
    // Obtener referencias a los inputs
    const inputSugerido = document.getElementById('libras_anual_sugerido');
    const inputPescado = document.getElementById('libras_anual_pescado');
    const inputPorcentaje = document.getElementById('porcentaje_cumplimiento');

    // Función para calcular el porcentaje
    function calcularPorcentaje() {
        const metaAnual = parseFloat(inputSugerido.value) || 0; // Convertir a número, manejar vacío como 0
        const lbsAnual = parseFloat(inputPescado.value) || 0;

        if (metaAnual > 0) {
            const porcentaje = (lbsAnual / metaAnual) * 100;
            inputPorcentaje.value = porcentaje.toFixed(2); // Mostrar con 2 decimales
        } else {
            inputPorcentaje.value = '0.00'; // Si meta es 0, mostrar 0%
        }
    }

    // Agregar evento de escucha al input editable
    inputSugerido.addEventListener('input', calcularPorcentaje);


    // Obtener referencias a los inputs
    const libras_ha_sugerido = document.getElementById('libras_ha_sugerido');
    const libras_ha_pescado = document.getElementById('libras_ha_pescado');
    const porcentaje_meta_ha = document.getElementById('porcentaje_meta_ha');

    // Función para calcular el porcentaje
    function calcularPorcentajeHa() {
        const metaHaAnual = parseFloat(libras_ha_sugerido.value) || 0; // Convertir a número, manejar vacío como 0
        const lbsHaAnual = parseFloat(libras_ha_pescado.value) || 0;

        if (metaHaAnual > 0) {
            const porcentaje = (lbsHaAnual / metaHaAnual) * 100;
            porcentaje_meta_ha.value = porcentaje.toFixed(2); // Mostrar con 2 decimales
        } else {
            porcentaje_meta_ha.value = '0.00'; // Si meta es 0, mostrar 0%
        }
    }

    // Agregar evento de escucha al input editable
    libras_ha_sugerido.addEventListener('input', calcularPorcentajeHa);


    // Obtener referencias a los inputs
    const fcv_ideal = document.getElementById('fcv_ideal');
    const fcv_pescado = document.getElementById('fcv_pescado');
    const porcentaje_fcv = document.getElementById('porcentaje_fcv');

    // Función para calcular el porcentaje
    function calcularPorcentajeFcv() {
        const metaFcvAnual = parseFloat(fcv_ideal.value) || 0; // Convertir a número, manejar vacío como 0
        const lbsFcvAnual = parseFloat(fcv_pescado.value) || 0;

        if (metaFcvAnual > 0) {
            const porcentaje = (lbsFcvAnual / metaFcvAnual) * 100;
            porcentaje_fcv.value = porcentaje.toFixed(2); // Mostrar con 2 decimales
        } else {
            porcentaje_fcv.value = '0.00'; // Si meta es 0, mostrar 0%
        }
    }

    // Agregar evento de escucha al input editable
    fcv_ideal.addEventListener('input', calcularPorcentajeFcv);


    // Obtener referencias a los inputs
    const dias_sugerido = document.getElementById('dias_sugerido');
    const dias_pescados = document.getElementById('dias_pescados');
    const porcentaje_dias = document.getElementById('porcentaje_dias');

    // Función para calcular el porcentaje
    function calcularPorcentajeDias() {
        const metaDiasAnual = parseFloat(dias_sugerido.value) || 0; // Convertir a número, manejar vacío como 0
        const lbsDiasAnual = parseFloat(dias_pescados.value) || 0;

        if (metaDiasAnual > 0) {
            const porcentaje = (lbsDiasAnual / metaDiasAnual) * 100;
            porcentaje_dias.value = porcentaje.toFixed(2); // Mostrar con 2 decimales
        } else {
            porcentaje_dias.value = '0.00'; // Si meta es 0, mostrar 0%
        }
    }

    // Agregar evento de escucha al input editable
    dias_sugerido.addEventListener('input', calcularPorcentajeDias);


    // Obtener referencias a los inputs
    const peso_sugerido = document.getElementById('peso_sugerido');
    const peso_pescado = document.getElementById('peso_pescado');
    const porcentaje_peso = document.getElementById('porcentaje_peso');

    // Función para calcular el porcentaje
    function calcularPorcentajePeso() {
        const metaPesoAnual = parseFloat(peso_sugerido.value) || 0; // Convertir a número, manejar vacío como 0
        const lbsPesoAnual = parseFloat(peso_pescado.value) || 0;

        if (metaPesoAnual > 0) {
            const porcentaje = (lbsPesoAnual / metaPesoAnual) * 100;
            porcentaje_peso.value = porcentaje.toFixed(2); // Mostrar con 2 decimales
        } else {
            porcentaje_peso.value = '0.00'; // Si meta es 0, mostrar 0%
        }
    }

    // Agregar evento de escucha al input editable
    peso_sugerido.addEventListener('input', calcularPorcentajePeso);


    // Obtener referencias a los inputs
    const ha_cosechadas_anual = document.getElementById('ha_cosechadas_anual');
    const ha_cosechadas_pescado = document.getElementById('ha_cosechadas_pescado');
    const porcentaje_ha_cosechado = document.getElementById('porcentaje_ha_cosechado');

    // Función para calcular el porcentaje
    function calcularPorcentajeHaCosechadas() {
        const metaHaCosechadoAnual = parseFloat(ha_cosechadas_anual.value) || 0; // Convertir a número, manejar vacío como 0
        const lbsHaCosechdoAnual = parseFloat(ha_cosechadas_pescado.value) || 0;

        if (metaHaCosechadoAnual > 0) {
            const porcentaje = (lbsHaCosechdoAnual / metaHaCosechadoAnual) * 100;
            porcentaje_ha_cosechado.value = porcentaje.toFixed(2); // Mostrar con 2 decimales
        } else {
            porcentaje_ha_cosechado.value = '0.00'; // Si meta es 0, mostrar 0%
        }
    }

    // Agregar evento de escucha al input editable
    ha_cosechadas_anual.addEventListener('input', calcularPorcentajeHaCosechadas);


    // Obtener referencias a los inputs
    const costo_libra = document.getElementById('costo_libra');
    const costo_libra_pescado = document.getElementById('costo_libra_pescado');
    const porcentaje_costo_libra = document.getElementById('porcentaje_costo_libra');

    // Función para calcular el porcentaje
    function calcularPorcentajeCostoLibra() {
        const metaCostoAnual = parseFloat(costo_libra.value) || 0; // Convertir a número, manejar vacío como 0
        const lbsCostoAnual = parseFloat(costo_libra_pescado.value) || 0;

        if (metaCostoAnual > 0) {
            const porcentaje = (lbsCostoAnual / metaCostoAnual) * 100;
            porcentaje_costo_libra.value = porcentaje.toFixed(2); // Mostrar con 2 decimales
        } else {
            porcentaje_costo_libra.value = '0.00'; // Si meta es 0, mostrar 0%
        }
    }

    // Agregar evento de escucha al input editable
    costo_libra.addEventListener('input', calcularPorcentajeCostoLibra);



    // Obtener referencias a los inputs
    const costo_ha_dia = document.getElementById('costo_ha_dia');
    const costo_ha_dia_pescado = document.getElementById('costo_ha_dia_pescado');
    const porcentaje_costo_ha_dia = document.getElementById('porcentaje_costo_ha_dia');

    // Función para calcular el porcentaje
    function calcularPorcentajeCostoDiaLibra() {
        const metaCostoDiaAnual = parseFloat(costo_ha_dia.value) || 0; // Convertir a número, manejar vacío como 0
        const lbsCostoDiaAnual = parseFloat(costo_ha_dia_pescado.value) || 0;

        if (metaCostoDiaAnual > 0) {
            const porcentaje = (lbsCostoDiaAnual / metaCostoDiaAnual) * 100;
            porcentaje_costo_ha_dia.value = porcentaje.toFixed(2); // Mostrar con 2 decimales
        } else {
            porcentaje_costo_ha_dia.value = '0.00'; // Si meta es 0, mostrar 0%
        }
    }

    // Agregar evento de escucha al input editable
    costo_ha_dia.addEventListener('input', calcularPorcentajeCostoDiaLibra);
</script>