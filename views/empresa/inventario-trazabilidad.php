<?php 
    date_default_timezone_set('America/Guayaquil');
    // Inicializar objetos
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
   // $camaronera = 3; 

?>
<style>
    .scrollable-section {
        max-height: 300px;
        overflow-y: auto;
    }

    .scrollable-section thead {
        position: sticky;
        top: 0;
        background: #404e67;
        z-index: 2;
    }
</style>
<div class="card">
    
    <div class="d-flex flex-row bd-highlight ">
        <div class="p-2 bd-highlight">
            <a href="index.php?page=insumostrazabilidad" class="text-white text-decoration-none"><li class="list-group-item  text-white text-center" style="background: #404e67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">Presupuesto general camaronera</li></a>
        </div>
        <div class="p-2 bd-highlight">
            <a href="index.php?page=detalle_piscina_insumos" class="text-white text-decoration-none"><li class="list-group-item  text-white text-center" style="background: #404e67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">Aplicación de insumos general</li></a>
        </div>

        <div class="p-2 bd-highlight">
            <?php
                // Consulta para obtener todas las piscinas en proceso
                $sqlPiscinas = "SELECT DISTINCT id_piscina, hectareas FROM registro_piscina_engorde WHERE estado = 'En proceso' AND id_camaronera = '$camaronera' ORDER BY id_piscina ASC LIMIT 1;";
                $piscinasData = $conectar->mostrar($sqlPiscinas);

            ?>
            <a href="index.php?page=detalle_piscina.php&piscina=<?php echo $piscinasData[0]['id_piscina']; ?>&ha=<?php echo $piscinasData[0]['hectareas']; ?>" class="text-white text-decoration-none">
            <li class="list-group-item text-white text-center" style="background: #404e67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">
            Detalle por piscina </li></a>
        </div>
    </div>

    <div class="container d-flex justify-content-center align-items-center vh-100 mt-4">        
        <h5>Presupuesto valorizado camaronera <?php if ($camaronera == 1){ echo 'Darsacom'; }else if($camaronera == 2){ echo 'Aquacamaron'; }else if($camaronera == 3){ echo 'Jopisa'; }else{ echo 'Grupo Camaron'; }; ?></h5>
    </div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <hr style="width: 900px; background:#404e67;">
    </div>

    <div class="container">

        <div class="text-dark" style="margin-bottom: -10px; margin-top:5px; margin-left: 12%;">  Detalle presupuestal ejecutado</div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

            <div class="card-body">

                <div class="cabeceraFija" style="width: 850px; margin:auto;">
                    <table class="table table-sm">
                        <thead style="background: #404e67;">

                            <tr>
                                <th scope="col" class="text-white text-center" Style="cursor:pointer; height: 10px; line-height: 10px;width: 50%;"><strong>Hectareas</strong></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><strong>Presupuesto</strong></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><strong>Ejecucion real</strong></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><strong>% ejecutado</strong></th>
                            </tr>

                        </thead>
            
                        <tbody>

                            <tr>       
                                <th class="text-dark bg-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: 50%;">Hectareas</th>

                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                                    <?php
                                        $sqlHa= "SELECT DISTINCT(hectareas), dias FROM presupuestos_aporbados WHERE id_camaronera = '$camaronera' AND fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM presupuestos_aporbados WHERE id_camaronera = '$camaronera')";
                                        $dataHa = $conectar->mostrar($sqlHa);
                                        echo number_format($dataHa[0]['hectareas'],2);
                                    ?>
                                </th>
                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                                    <?php
                                        $sqlHa= "SELECT SUM(hectareas) AS hectareas FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                        $dataHaProceso = $conectar->mostrar($sqlHa);
                                        echo number_format($dataHaProceso[0]['hectareas'],2);
                                    ?>
                                </th>
                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                            
                                    <?php echo  number_format($dataHaProceso[0]['hectareas'] /  $dataHa[0]['hectareas'] * 100,2); ?> %
                                </th> 
                                
                            </tr>
            
                            <tr>
                        
                                <th class="text-dark bg-white text-center" Style="cursor:pointer; height: 10px; line-height: 10px;width: 50%;">Dias</th>
                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                                    <?php
                                        echo $diasDelMes = number_format($dataHa[0]['dias'],2);
                                    ?>

                                </th>
                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                                    <?php
                                        $mesActual = date('n'); // Obtiene el número del mes actual (1-12)
                                        $añoActual = date('Y'); // Obtiene el año actual

                                        // Obtener el primer día del mes actual
                                        $primerDiaDelMes = strtotime("$añoActual-$mesActual-01");

                                        // Obtener la fecha actual
                                        $fechaActual = strtotime(date('Y-m-d'));

                                        // Calcular la diferencia en días
                                        $diasTranscurridos = ($fechaActual - $primerDiaDelMes) / (60 * 60 * 24); // Convertir segundos a días

                                        echo  number_format($diasTranscurridos,2);
                                    ?>

                                </th> 
                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">

                                    <?php echo number_format(($diasTranscurridos / $diasDelMes) * 100,2) ?> %
                                </th> 
                                
                                

                            </tr>
            
                            <tr>
                            
                                <th class=" bg-white text-center" Style="cursor:pointer; height: 10px; line-height: 10px;width: 50%;">Rubros ejecutados real</th>
                                <th class="text-center  bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                                    <?php

                                        $sqlPresupuesto = "SELECT 
                                            SUM(p.presupuesto_aprobado) AS presupuesto_aprobado_camaronera, p.cuentaMadre
                                        FROM 
                                            presupuestos_aporbados p
                                        WHERE 
                                            p.id_camaronera = '$camaronera' AND p.cuentaMadre IN ('materia_prima', 'mano_obra', 'indirectos') AND fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM presupuestos_aporbados WHERE id_camaronera = '$camaronera' AND cuentaMadre IN ('materia_prima', 'mano_obra', 'indirectos'))";

                                        $data = $conectar->mostrar($sqlPresupuesto);

                                        // Obtener el total del presupuesto aprobado para la camaronera
                                        $totalPresupuesto = isset($data[0]['presupuesto_aprobado_camaronera']) ? $data[0]['presupuesto_aprobado_camaronera'] : 0;
                                        echo number_format($totalPresupuesto,2);

                                    ?>

                                </th>
                                <th class="text-center bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                            
                                    <?php


                                        $sqlEjecutadoCamaronera = "SELECT 
                                        SUM(t1.total) AS costoTotal
                                        FROM costos_camaronera t1
                                        JOIN registro_piscina_engorde t2 
                                        ON t1.id_camaronera = t2.id_camaronera 
                                        AND t1.id_piscina = t2.id_piscina
                                        AND t1.id_corrida = t2.id_corrida
                                        WHERE t2.estado = 'En proceso'
                                        AND t1.cuentaMadre IN ('materia_prima', 'mano_obra', 'indirectos')
                                        AND t1.id_camaronera = '$camaronera'";
                
                                        $dataEjecutado = $conectar->mostrar($sqlEjecutadoCamaronera);
                                        // Verificar si hay datos y asignar el valor total
                                        $totalCostoEjecutado = isset($dataEjecutado[0]['costoTotal']) ? $dataEjecutado[0]['costoTotal'] : 0;
                                        // Evitar división por cero
                                        $porcentajeEjecucion = ($totalPresupuesto > 0) ? ($totalCostoEjecutado / $totalPresupuesto) * 100 : 0;
                                        echo number_format($totalCostoEjecutado,2);

                                    ?>
                                </th>
                                <th class="text-center bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                            
                                    <?php echo number_format(( intval($totalCostoEjecutado) / intval($totalPresupuesto) )* 100 ,2)?> %

                                </th> 

                            </tr>

                            <tr>
                                <th class="text-dark bg-white text-center mt-4" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"></th>
                                <th class="text-dark bg-white text-center mt-4" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"></th>
                                <th class="text-dark bg-white text-center mt-4" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"></th>
                                <th class="text-dark bg-white text-center mt-4" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"></th>
                                <th class="text-dark bg-white text-center mt-4" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"></th>
                            </tr>
                            
                            <tr>
                                <th class="text-dark bg-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">Costo hectarea dia</th>
                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                                    <?php
                                        echo number_format($totalPresupuesto / $dataHa[0]['hectareas'] / $diasDelMes,2);
                                    ?>
                                </th>
                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">
                            
                                    <?php
                                        echo number_format($dataEjecutado[0]['costoTotal'] / $diasTranscurridos / $dataHa[0]['hectareas'],2);
                                    ?>

                                </th>
                                <th class="text-center text-dark bg-white" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;">

                                    <?php echo number_format((($dataEjecutado[0]['costoTotal'] / $diasTranscurridos / $dataHa[0]['hectareas'] )  / ( $totalPresupuesto / $dataHa[0]['hectareas'] / $diasDelMes ))* 100, 2);?> %

                                </th> 
                            </tr> 
                                

                        </tbody>

                    </table>
                </div>

                <div class="scrollable-section"  style="margin-top:-20px; width:850px; margin:auto;">
                    <table class="table table-sm">

                        <thead style="background: #404e67;" class="mt-3">

                            <?php
                                $sqlPresupuesto = "SELECT 
                                    SUM(p.presupuesto_aprobado) AS presupuesto_aprobado_camaronera, p.cuentaMadre
                                FROM 
                                    presupuestos_aporbados p
                                WHERE 
                                    p.id_camaronera = '$camaronera' AND p.cuentaMadre = 'materia_prima' AND fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM presupuestos_aporbados WHERE id_camaronera = '$camaronera' AND cuentaMadre = 'materia_prima')";

                                $data = $conectar->mostrar($sqlPresupuesto);

                                foreach($data as $cm){
                                    $cuentaMadre = $cm['cuentaMadre'];
                                }

                                // Obtener el total del presupuesto aprobado para la camaronera
                                $totalPresupuesto = isset($data[0]['presupuesto_aprobado_camaronera']) ? $data[0]['presupuesto_aprobado_camaronera'] : 0;

                                $sqlEjecutadoCamaronera = "SELECT 
                                            SUM(t1.total) AS costoTotal
                                        FROM costos_camaronera t1
                                        JOIN registro_piscina_engorde t2 
                                            ON t1.id_camaronera = t2.id_camaronera 
                                            AND t1.id_piscina = t2.id_piscina
                                            AND t1.id_corrida = t2.id_corrida
                                        WHERE t2.estado = 'En proceso'
                                        AND t1.cuentaMadre = '$cuentaMadre'
                                            AND t1.id_camaronera = '$camaronera'";


                                $dataEjecutado = $conectar->mostrar($sqlEjecutadoCamaronera);

                                // Verificar si hay datos y asignar el valor total
                                $totalCostoEjecutado = isset($dataEjecutado[0]['costoTotal']) ? $dataEjecutado[0]['costoTotal'] : 0;

                                // Evitar división por cero
                                $porcentajeEjecucion = ($totalPresupuesto > 0) ? ($totalCostoEjecutado / $totalPresupuesto) * 100 : 0;

                                // Determinar color basado en el porcentaje
                                if ($porcentajeEjecucion > 100) {
                                    $color = "red"; // Mayor al 100%
                                } elseif ($porcentajeEjecucion < 50) {
                                    $color = "#30791a"; // Menor al 50% (verde)
                                } else {
                                    $color = "#f9c280"; // Entre 50% y 100% (amarillo/naranja)
                                }

                            ?>

                            <tr>
                                <th scope="col" class="text-white text-center" Style="cursor:pointer; height: 10px; line-height: 10px;width: 50%;">Materia prima</th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($totalPresupuesto, 2); ?></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($totalCostoEjecutado, 2); ?></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($porcentajeEjecucion, 2); ?> % </th>
                                <!--th scope="col" class="text-white text-center" style="cursor:pointer;"
                                    class="text-white" style="text-decoration: none;"> Precio por</br> presentacion</th-->
                            </tr>

                        </thead>

                        <tbody>
                            
                            <?php

                                foreach($data as $p){

                                    if($camaronera == 1){ $empresaId = 115; }
                                    else if($camaronera == 2){ $empresaId = 117; }
                                    else if($camaronera == 3){ $empresaId = 118; }

                                    $sqlPresupuesto = "SELECT 
                                        f.familia, 
                                        f.codigocuenta, 
                                        COALESCE(p.presupuesto_aprobado, 0) AS presupuesto_aprobado,
                                        TRIM(LOWER(f.familia)) AS descripcion, 
                                        f.codigoCuenta AS codigoCuenta
                                    FROM 
                                        familiascuentacontable f
                                    LEFT JOIN (
                                        SELECT 
                                            familia, 
                                            MAX(fecha_ingreso) AS max_fecha
                                        FROM 
                                            presupuestos_aporbados
                                        WHERE 
                                            id_camaronera = '$camaronera'
                                        GROUP BY 
                                            familia
                                    ) subq ON f.familia = subq.familia
                                    LEFT JOIN presupuestos_aporbados p
                                        ON p.familia = subq.familia AND p.fecha_ingreso = subq.max_fecha
                                    WHERE 
                                        f.id_camaronera = '$camaronera'
                                    AND p.cuentaMadre = 'materia_prima'
                                    GROUP BY 
                                        f.familia, f.codigocuenta
                                    ORDER BY 
                                        f.id ASC;
                                    ";

                                    $data = $conectar->mostrar($sqlPresupuesto);

                                    foreach ($data as $p) {
                                        $descripcion = $p['descripcion'];
                                        $cuentaContble = $p['codigoCuenta'];
                                        $presupuesto_aprobado = $p['presupuesto_aprobado'];

                                    
                                        

                                        // Obtener los valores agregados por camaronera
                                        $sqlEjecutadoCamaronera = "SELECT 
                                        t1.id_camaronera, 
                                        t1.familia, 
                                        SUM(t1.cantidad) AS cantidadTotal, 
                                        SUM(t1.total) AS costoTotal, 
                                        SUM(t1.costo_presentacion) AS costoPresentacionTotal 
                                    FROM costos_camaronera t1
                                    INNER JOIN registro_piscina_engorde t2 
                                        ON t1.id_camaronera = t2.id_camaronera
                                        and t1.id_piscina = t2.id_piscina 
                                        and t1.id_corrida = t2.id_corrida 
                                    WHERE 
                                        t1.id_camaronera = '$camaronera' 
                                        AND t1.familia = '$descripcion'
                                        AND t2.estado = 'en proceso'
                                    GROUP BY t1.id_camaronera, t1.familia";
                                    // echo '</br>';

                                        $dataEjecucionCamaronera = $conectar->mostrar($sqlEjecutadoCamaronera);
                                        $cantidadTotal = 0;
                                        $costoTotal = 0;
                                        $costoPresentacionTotal = 0;

                                        if (!empty($dataEjecucionCamaronera)) {
                                            $cantidadTotal = $dataEjecucionCamaronera[0]['cantidadTotal'] ?? 0;
                                            $costoTotal = $dataEjecucionCamaronera[0]['costoTotal'] ?? 0;
                                            $costoPresentacionTotal = $dataEjecucionCamaronera[0]['costoPresentacionTotal'] ?? 0;
                                        }

                                        if($descripcion == 'otras_materias_primas'){
                                            $descripcion = 'Otras materias primas';
                                        }else if($descripcion == 'reguladores'){
                                            $descripcion = 'Reguladore de suelo y agua';
                                        }

                                        // Mostrar solo una fila por familia
                                        echo "<tr class='text-center' Style='cursor:pointer; height: 10px; line-height: 10px;width: 50%;'>";
                                            echo "<td class='text-dark'>".ucfirst(strtolower($descripcion))."</td>";
                                            echo "<td class='text-dark'>".number_format($presupuesto_aprobado,2)."</td>";

                                            

                                            echo "<td class='text-dark text-center'>".number_format($costoTotal, 2)."</td>"; // SUMA EN DÓLARES
                                            $porcentajeEjecucion = ($costoTotal > 0 && $presupuesto_aprobado > 0) ? ($costoTotal / $presupuesto_aprobado) * 100 : 0;

                                            // Determinar el color en base al porcentaje
                                            if ($porcentajeEjecucion > 100) {
                                                $color = "red"; // Mayor al 100%
                                            } elseif ($porcentajeEjecucion < 50) {
                                                $color = "green"; // Menor al 50%
                                            } else {
                                                $color = "orange"; // Entre 50% y 100%
                                            }

                                            $porcentajeEjecucion = ($costoTotal > 0 && $presupuesto_aprobado > 0) ? ($costoTotal / $presupuesto_aprobado) * 100 : 0;

                                            // Usar HSL para un degradado de verde a rojo
                                            $hue = max(0, min(120 - ($porcentajeEjecucion * 1.2), 120)); // 120° (verde) a 0° (rojo)
                                            $color = "hsl($hue, 80%, 40%)"; // Saturación y luminosidad ajustadas

                                            echo "<td class='text-center' style='color: $color;'>".number_format($porcentajeEjecucion, 2)." %</td>";


                                        echo "</tr>";
                                    }                       
                                }
                            ?>

                        </tbody>

                        <thead style="background: #404e67;" class="mt-3">

                            <?php
                            $sqlPresupuesto = "SELECT 
                            SUM(p.presupuesto_aprobado) AS presupuesto_aprobado_camaronera, p.cuentaMadre
                        FROM 
                            presupuestos_aporbados p
                        WHERE 
                            p.id_camaronera = '$camaronera' AND p.cuentaMadre = 'mano_obra' AND fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM presupuestos_aporbados WHERE id_camaronera = '$camaronera' AND cuentaMadre = 'mano_obra')";

                        $data = $conectar->mostrar($sqlPresupuesto);

                        foreach($data as $cm){
                            $cuentaMadre = $cm['cuentaMadre'];
                        }

                        // Obtener el total del presupuesto aprobado para la camaronera
                        $totalPresupuesto = isset($data[0]['presupuesto_aprobado_camaronera']) ? $data[0]['presupuesto_aprobado_camaronera'] : 0;

                        $sqlEjecutadoCamaronera = "SELECT 
                                    SUM(t1.total) AS costoTotal
                                FROM costos_camaronera t1
                                JOIN registro_piscina_engorde t2 
                                    ON t1.id_camaronera = t2.id_camaronera 
                                    AND t1.id_piscina = t2.id_piscina
                                    AND t1.id_corrida = t2.id_corrida
                                WHERE t2.estado = 'En proceso'
                                AND t1.cuentaMadre = '$cuentaMadre'
                                    AND t1.id_camaronera = '$camaronera'";


                                $dataEjecutado = $conectar->mostrar($sqlEjecutadoCamaronera);

                                // Verificar si hay datos y asignar el valor total
                                $totalCostoEjecutado = isset($dataEjecutado[0]['costoTotal']) ? $dataEjecutado[0]['costoTotal'] : 0;

                                // Evitar división por cero
                                $porcentajeEjecucion = ($totalPresupuesto > 0) ? ($totalCostoEjecutado / $totalPresupuesto) * 100 : 0;

                                // Determinar color basado en el porcentaje
                                if ($porcentajeEjecucion > 100) {
                                    $color = "red"; // Mayor al 100%
                                } elseif ($porcentajeEjecucion < 50) {
                                    $color = "#30791a"; // Menor al 50% (verde)
                                } else {
                                    $color = "#f9c280"; // Entre 50% y 100% (amarillo/naranja)
                                }

                            ?>

                            <tr>
                                <th scope="col" class="text-white text-center" Style="cursor:pointer; height: 10px; line-height: 10px;width: 50%;">Mano de obra</th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($totalPresupuesto, 2); ?></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($totalCostoEjecutado, 2); ?></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($porcentajeEjecucion, 2); ?> % </th>
                                <!--th scope="col" class="text-white text-center" style="cursor:pointer;"
                                    class="text-white" style="text-decoration: none;"> Precio por</br> presentacion</th-->
                                
                            </tr>

                        </thead>

                        <tbody>
                            
                            <?php

                                foreach($data as $p){

                                    if($camaronera == 1){ $empresaId = 115; }
                                    else if($camaronera == 2){ $empresaId = 117; }
                                    else if($camaronera == 3){ $empresaId = 118; }

                                    $sqlPresupuesto = "SELECT 
                                        f.familia, 
                                        f.codigocuenta, 
                                        COALESCE(p.presupuesto_aprobado, 0) AS presupuesto_aprobado,
                                        TRIM(LOWER(f.familia)) AS descripcion, 
                                        f.codigoCuenta AS codigoCuenta
                                    FROM 
                                        familiascuentacontable f
                                    LEFT JOIN (
                                        SELECT 
                                            familia, 
                                            MAX(fecha_ingreso) AS max_fecha
                                        FROM 
                                            presupuestos_aporbados
                                        WHERE 
                                            id_camaronera = '$camaronera'
                                        GROUP BY 
                                            familia
                                    ) subq ON f.familia = subq.familia
                                    LEFT JOIN presupuestos_aporbados p
                                        ON p.familia = subq.familia AND p.fecha_ingreso = subq.max_fecha
                                    WHERE 
                                        f.id_camaronera = '$camaronera'
                                    AND p.cuentaMadre = 'mano_obra'
                                    GROUP BY 
                                        f.familia, f.codigocuenta
                                    ORDER BY 
                                        f.id ASC;
                                    ";

                                    $data = $conectar->mostrar($sqlPresupuesto);

                                    foreach ($data as $p) {
                                        $descripcion = $p['descripcion'];
                                        $cuentaContble = $p['codigoCuenta'];
                                        $presupuesto_aprobado = $p['presupuesto_aprobado'];

                                    
                                        

                                        // Obtener los valores agregados por camaronera
                                        $sqlEjecutadoCamaronera = "SELECT 
                                        t1.id_camaronera, 
                                        t1.familia, 
                                        SUM(t1.cantidad) AS cantidadTotal, 
                                        SUM(t1.total) AS costoTotal, 
                                        SUM(t1.costo_presentacion) AS costoPresentacionTotal 
                                    FROM costos_camaronera t1
                                    INNER JOIN registro_piscina_engorde t2 
                                        ON t1.id_camaronera = t2.id_camaronera
                                        and t1.id_piscina = t2.id_piscina 
                                        and t1.id_corrida = t2.id_corrida 
                                    WHERE 
                                        t1.id_camaronera = '$camaronera' 
                                        AND t1.familia = '$descripcion'
                                        AND t2.estado = 'en proceso'
                                    GROUP BY t1.id_camaronera, t1.familia";
                                    // echo '</br>';

                                        $dataEjecucionCamaronera = $conectar->mostrar($sqlEjecutadoCamaronera);
                                        $cantidadTotal = 0;
                                        $costoTotal = 0;
                                        $costoPresentacionTotal = 0;

                                        if (!empty($dataEjecucionCamaronera)) {
                                            $cantidadTotal = $dataEjecucionCamaronera[0]['cantidadTotal'] ?? 0;
                                            $costoTotal = $dataEjecucionCamaronera[0]['costoTotal'] ?? 0;
                                            $costoPresentacionTotal = $dataEjecucionCamaronera[0]['costoPresentacionTotal'] ?? 0;
                                        }

                                        if($descripcion == 'sueldo_personal'){
                                            $descripcion = 'Sueldo personal';
                                        }else if($descripcion == 'beneficio_social'){
                                            $descripcion = 'Beneficio social iess';
                                        }else if($descripcion == 'extras_personal'){
                                            $descripcion = 'Extras de personal';
                                        }else{
                                            $descripcion;
                                        }

                                        // Mostrar solo una fila por familia
                                        echo "<tr class='text-center' Style='cursor:pointer; height: 10px; line-height: 10px;width: 50%;'>";
                                            echo "<td class='text-dark'>".ucfirst(strtolower($descripcion))."</td>";
                                            echo "<td class='text-dark'>".number_format($presupuesto_aprobado,2)."</td>";

                                            

                                            echo "<td class='text-dark text-center'>".number_format($costoTotal, 2)."</td>"; // SUMA EN DÓLARES
                                            $porcentajeEjecucion = ($costoTotal > 0 && $presupuesto_aprobado > 0) ? ($costoTotal / $presupuesto_aprobado) * 100 : 0;

                                            // Determinar el color en base al porcentaje
                                            if ($porcentajeEjecucion > 100) {
                                                $color = "red"; // Mayor al 100%
                                            } elseif ($porcentajeEjecucion < 50) {
                                                $color = "green"; // Menor al 50%
                                            } else {
                                                $color = "orange"; // Entre 50% y 100%
                                            }

                                            $porcentajeEjecucion = ($costoTotal > 0 && $presupuesto_aprobado > 0) ? ($costoTotal / $presupuesto_aprobado) * 100 : 0;

                                            // Usar HSL para un degradado de verde a rojo
                                            $hue = max(0, min(120 - ($porcentajeEjecucion * 1.2), 120)); // 120° (verde) a 0° (rojo)
                                            $color = "hsl($hue, 80%, 40%)"; // Saturación y luminosidad ajustadas

                                            echo "<td class='text-center' style='color: $color;'>".number_format($porcentajeEjecucion, 2)." %</td>";


                                        echo "</tr>";
                                    }                       
                                }
                            ?>

                        </tbody>

                        <thead style="background: #404e67;" class="mt-3">

                            <?php
                                $sqlPresupuesto = "SELECT 
                                SUM(p.presupuesto_aprobado) AS presupuesto_aprobado_camaronera, p.cuentaMadre
                            FROM 
                                presupuestos_aporbados p
                            WHERE 
                                p.id_camaronera = '$camaronera' AND p.cuentaMadre = 'indirectos' AND fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM presupuestos_aporbados WHERE id_camaronera = '$camaronera' AND cuentaMadre = 'indirectos')";

                            $data = $conectar->mostrar($sqlPresupuesto);

                            foreach($data as $cm){
                                $cuentaMadre = $cm['cuentaMadre'];
                            }

                            // Obtener el total del presupuesto aprobado para la camaronera
                            $totalPresupuesto = isset($data[0]['presupuesto_aprobado_camaronera']) ? $data[0]['presupuesto_aprobado_camaronera'] : 0;

                            $sqlEjecutadoCamaronera = "SELECT 
                                        SUM(t1.total) AS costoTotal
                                    FROM costos_camaronera t1
                                    JOIN registro_piscina_engorde t2 
                                        ON t1.id_camaronera = t2.id_camaronera 
                                        AND t1.id_piscina = t2.id_piscina
                                        AND t1.id_corrida = t2.id_corrida
                                    WHERE t2.estado = 'En proceso'
                                    AND t1.cuentaMadre = '$cuentaMadre'
                                        AND t1.id_camaronera = '$camaronera'";


                                $dataEjecutado = $conectar->mostrar($sqlEjecutadoCamaronera);

                                // Verificar si hay datos y asignar el valor total
                                $totalCostoEjecutado = isset($dataEjecutado[0]['costoTotal']) ? $dataEjecutado[0]['costoTotal'] : 0;

                                // Evitar división por cero
                                $porcentajeEjecucion = ($totalPresupuesto > 0) ? ($totalCostoEjecutado / $totalPresupuesto) * 100 : 0;

                                // Determinar color basado en el porcentaje
                                if ($porcentajeEjecucion > 100) {
                                    $color = "red"; // Mayor al 100%
                                } elseif ($porcentajeEjecucion < 50) {
                                    $color = "#30791a"; // Menor al 50% (verde)
                                } else {
                                    $color = "#f9c280"; // Entre 50% y 100% (amarillo/naranja)
                                }

                            ?>

                            <tr>
                                <th scope="col" class="text-white text-center" Style="cursor:pointer; height: 10px; line-height: 10px;width: 50%;">Indirectos</th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($totalPresupuesto, 2); ?></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($totalCostoEjecutado, 2); ?></th>
                                <th scope="col" class="text-white text-center" style="cursor:pointer; height: 10px; line-height: 10px;width: -5%;"><?php echo number_format($porcentajeEjecucion, 2); ?> % </th>
                                <!--th scope="col" class="text-white text-center" style="cursor:pointer;"
                                    class="text-white" style="text-decoration: none;"> Precio por</br> presentacion</th-->
                                
                            </tr>

                        </thead>

                        <tbody>
                            
                            <?php

                                foreach($data as $p){

                                    if($camaronera == 1){ $empresaId = 115; }
                                    else if($camaronera == 2){ $empresaId = 117; }
                                    else if($camaronera == 3){ $empresaId = 118; }

                                    $sqlPresupuesto = "SELECT 
                                        f.familia, 
                                        f.codigocuenta, 
                                        COALESCE(p.presupuesto_aprobado, 0) AS presupuesto_aprobado,
                                        TRIM(LOWER(f.familia)) AS descripcion, 
                                        f.codigoCuenta AS codigoCuenta
                                    FROM 
                                        familiascuentacontable f
                                    LEFT JOIN (
                                        SELECT 
                                            familia, 
                                            MAX(fecha_ingreso) AS max_fecha
                                        FROM 
                                            presupuestos_aporbados
                                        WHERE 
                                            id_camaronera = '$camaronera'
                                        GROUP BY 
                                            familia
                                    ) subq ON f.familia = subq.familia
                                    LEFT JOIN presupuestos_aporbados p
                                        ON p.familia = subq.familia AND p.fecha_ingreso = subq.max_fecha
                                    WHERE 
                                        f.id_camaronera = '$camaronera'
                                    AND p.cuentaMadre = 'indirectos'
                                    GROUP BY 
                                        f.familia, f.codigocuenta
                                    ORDER BY 
                                        f.id ASC;
                                    ";

                                    $data = $conectar->mostrar($sqlPresupuesto);

                                    foreach ($data as $p) {
                                        $descripcion = $p['descripcion'];
                                        $cuentaContble = $p['codigoCuenta'];
                                        $presupuesto_aprobado = $p['presupuesto_aprobado'];

                                    
                                        

                                        // Obtener los valores agregados por camaronera
                                        $sqlEjecutadoCamaronera = "SELECT 
                                        t1.id_camaronera, 
                                        t1.familia, 
                                        SUM(t1.cantidad) AS cantidadTotal, 
                                        SUM(t1.total) AS costoTotal, 
                                        SUM(t1.costo_presentacion) AS costoPresentacionTotal 
                                    FROM costos_camaronera t1
                                    INNER JOIN registro_piscina_engorde t2 
                                        ON t1.id_camaronera = t2.id_camaronera
                                        and t1.id_piscina = t2.id_piscina 
                                        and t1.id_corrida = t2.id_corrida 
                                    WHERE 
                                        t1.id_camaronera = '$camaronera' 
                                        AND t1.familia = '$descripcion'
                                        AND t2.estado = 'en proceso'
                                    GROUP BY t1.id_camaronera, t1.familia";
                                    // echo '</br>';

                                        $dataEjecucionCamaronera = $conectar->mostrar($sqlEjecutadoCamaronera);
                                        $cantidadTotal = 0;
                                        $costoTotal = 0;
                                        $costoPresentacionTotal = 0;

                                        if (!empty($dataEjecucionCamaronera)) {
                                            $cantidadTotal = $dataEjecucionCamaronera[0]['cantidadTotal'] ?? 0;
                                            $costoTotal = $dataEjecucionCamaronera[0]['costoTotal'] ?? 0;
                                            $costoPresentacionTotal = $dataEjecucionCamaronera[0]['costoPresentacionTotal'] ?? 0;
                                        }

                                        if($descripcion == 'mantenimiento_red_electica'){
                                            $descripcion = 'Mantenimiento red electica';
                                        }else{
                                            $descripcion;
                                        }

                                        // Mostrar solo una fila por familia
                                        echo "<tr class='text-center' Style='cursor:pointer; height: 10px; line-height: 10px;width: 50%;'>";
                                            echo "<td class='text-dark'>".ucfirst(strtolower($descripcion))."</td>";
                                            echo "<td class='text-dark'>".number_format($presupuesto_aprobado,2)."</td>";

                                            

                                            echo "<td class='text-dark text-center'>".number_format($costoTotal, 2)."</td>"; // SUMA EN DÓLARES
                                            $porcentajeEjecucion = ($costoTotal > 0 && $presupuesto_aprobado > 0) ? ($costoTotal / $presupuesto_aprobado) * 100 : 0;

                                            // Determinar el color en base al porcentaje
                                            if ($porcentajeEjecucion > 100) {
                                                $color = "red"; // Mayor al 100%
                                            } elseif ($porcentajeEjecucion < 50) {
                                                $color = "green"; // Menor al 50%
                                            } else {
                                                $color = "orange"; // Entre 50% y 100%
                                            }

                                            $porcentajeEjecucion = ($costoTotal > 0 && $presupuesto_aprobado > 0) ? ($costoTotal / $presupuesto_aprobado) * 100 : 0;

                                            // Usar HSL para un degradado de verde a rojo
                                            $hue = max(0, min(120 - ($porcentajeEjecucion * 1.2), 120)); // 120° (verde) a 0° (rojo)
                                            $color = "hsl($hue, 80%, 40%)"; // Saturación y luminosidad ajustadas

                                            echo "<td class='text-center' style='color: $color;'>".number_format($porcentajeEjecucion, 2)." %</td>";


                                        echo "</tr>";
                                    }                       
                                }
                            ?>

                        </tbody>

                    </table>
                </div>

            </div>

        </div>   
            
    </div>

</div>