<?php 
    // Inicializar objetos
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    
    // Capturar el número de la piscina desde la URL
    $piscina = $_GET['piscina'] ?? null;
    $hectareas = $_GET['ha'] ?? null;

    // Consulta para obtener la siguiente piscina en proceso
    $query = "SELECT id_piscina, hectareas 
              FROM registro_piscina_engorde 
              WHERE estado = 'en proceso' 
              AND id_camaronera = ? 
              AND id_piscina > ? 
              ORDER BY id_piscina ASC LIMIT 1";
    
    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $camaronera, $piscina);  // Parámetros: id_camaronera, piscina actual
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Recuperar la siguiente piscina
        $row = $result->fetch_assoc();
        $siguientePiscina = $row['id_piscina'];
        $hectareaSiguiente = $row['hectareas']; // Esta línea es opcional si ya está definida en la URL
    } else {
        // Si no hay siguiente piscina, manejar la situación
        $siguientePiscina = null;
        $hectareaSiguiente = null;
    }

    
    // Consulta para obtener la piscina anterior en proceso
    $query = "SELECT id_piscina, hectareas 
              FROM registro_piscina_engorde 
              WHERE estado = 'en proceso' 
              AND id_camaronera = ? 
              AND id_piscina < ? 
              ORDER BY id_piscina DESC LIMIT 1"; // Usamos DESC para obtener la piscina anterior más cercana
    
    // Preparar y ejecutar la consulta
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $camaronera, $piscina);  // Parámetros: id_camaronera, piscina actual
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Recuperar la piscina anterior
        $row = $result->fetch_assoc();
        $anteriorPiscina = $row['id_piscina'];
        $hectareaAnteriror = $row['hectareas']; // Esta línea es opcional si ya está definida en la URL
    } else {
        // Si no hay piscina anterior, manejar la situación
        $anteriorPiscina = null;
        $hectareaAnteriror = null;
    }
?>
    

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
        <h5>Detalles de aplicacion de insumo por Ha</h5>
    </div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <hr style="width: 900px; background:#404e67;">
    </div>

    <div class="container d-flex justify-content-center mt-2">        
        <h5><strong>Piscina: </strong> <?= htmlspecialchars($piscina); ?>  /  <strong>Ha: </strong> <?= htmlspecialchars($hectareas); ?></h5>
    </div>
    
    <div class="container d-flex justify-content-center align-items-center vh-100 mt-1">
        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group mr-2" role="group" aria-label="First group">
            <?php if ($anteriorPiscina !== null): ?>
                <a href="index.php?page=detalle_piscina.php&piscina=<?php echo $anteriorPiscina; ?>&ha=<?php echo $hectareaAnteriror; ?>&camaronera=<?php echo $camaronera; ?>" class="btn btn-sm text-white" style="background: #404e67;"><< Anterior </a>
            <?php else: ?>
                <button class="btn btn-secondary disabled"><< Anterior </button>
            <?php endif; ?>
            </div>

            <div class="btn-group mr-2" role="group" aria-label="Second group">
            <?php if ($siguientePiscina !== null): ?>
                <a href="index.php?page=detalle_piscina.php&piscina=<?php echo $siguientePiscina; ?>&ha=<?php echo $hectareaSiguiente; ?>&camaronera=<?php echo $camaronera; ?>" class="btn btn-sm text-white" style="background: #404e67;">Siguiente >> </a>
            <?php else: ?>
                <button class="btn btn-secondary disabled"> siguiente >> </button>
            <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="text-dark" style="margin-bottom: 8px; margin-top:5px; margin-left: 20px;">  Detalle presupuestal ejecutado</div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

            <div class="card-body">

                <table class="table table-hover table-sm" style="margin-top:-20px;">
        
                    <thead style="background: #404e67;">

                        <tr>
                            <th scope="col" class="text-white text-center">Presupuesto (Dolares)</th>
                            <th scope="col" class="text-white text-center">-</th>
                            <th scope="col" class="text-white text-center">-</th>
                            <th scope="col" class="text-white text-center">-</th>
                            <th scope="col" class="text-white text-center"> Total ejecucion (Dolares)</th>

                        </tr>

                    </thead>
        
                        <?php
                            
                                $descripcion = $data[0]['descripcion'];
                                $idNormalizado =  $descripcion;
        
                                // Obtener los productos y cantidades por piscina
                                $sqlEjecutadoCamaronera = "SELECT t1.hectareas, (SUM(t1.total)/t1.hectareas) AS ejecutadoHa, SUM(t1.total) AS ejecutadoTotal, 
                                (t1.hectareas*500) AS presupuestoPsc,  (t1.hectareas*500) - (SUM(t1.total)/t1.hectareas)  AS saldoDisponible
                                FROM costos_camaronera t1
                                JOIN registro_piscina_engorde t2 
                                ON t1.id_camaronera = t2.id_camaronera 
                                AND t1.id_piscina = t2.id_piscina
                                WHERE t2.estado = 'En proceso'
                                AND t1.id_camaronera = '$camaronera'
                                AND t1.cuentaMAdre = 'materia_prima'    
                                AND t1.id_piscina = '$piscina'";
                                $datas = $conectar->mostrar($sqlEjecutadoCamaronera);
        
                                
                                    
                        ?>
        
                    <tbody>

                        <tr>       
                            <th class="text-start text-dark bg-white text-center" style="cursor:pointer;"><strong>Total presupuesto por Ha</strong></th>
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th>
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th>
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th> 
                            <th class="text-end text-dark bg-white text-center" style="cursor:pointer;"><?php echo intval($datas[0]['presupuestoPsc']/$datas[0]['hectareas']); ?></th>         
                        </tr>
        
        
                        <tr>
                    
                            <th class="text-start text-dark bg-white text-center" style="cursor:pointer;"><strong>Total ejecutado por Ha</strong></th>
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th>
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th> 
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th> 
                            <th class="text-dark bg-white text-center" style="cursor:pointer;"><?php echo number_format($datas[0]['ejecutadoHa'],2);?></th>

                        </tr>
        
                        <tr>
                        
                            <th class="text-start text-dark bg-white text-center" style="cursor:pointer;"><strong>Restante total</strong></th>
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th>
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th>
                            <th class="text-center text-dark bg-white" style="cursor:pointer;"></th> 
                            <th class="text-dark bg-white text-center" style="margin-left: 15%; cursor:pointer;"><?php echo intval($datas[0]['presupuestoPsc']/$datas[0]['hectareas'] - $datas[0]['ejecutadoHa']); ?></th>
                            
                        </tr> 
        
                    </tbody>
        
                
                </table>

            </div>

        </div>   
            
    </div>

    <div class="container mt-4">
         
        <div class="text-dark" style="margin-bottom: 8px; margin-top:-35px; margin-left: 20px;"> Detalle de insumos consumidos</div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

            <div class="card-body">
                
                <?php
                    // Consulta para obtener todas las piscinas en proceso
                    $sqlPiscinas = "SELECT DISTINCT id_piscina FROM registro_piscina_engorde WHERE estado = 'En proceso' AND id_camaronera = '$camaronera' AND id_piscina = '$piscina'";
                    $piscinasData = $conectar->mostrar($sqlPiscinas);

                    // Crear una lista de piscinas
                    $piscinas = [];
                    foreach ($piscinasData as $p) {
                        $piscinas[] = $p['id_piscina'];
                    }
                ?>

                <table class="table table-hover table-sm" style="margin-top:-20px;">
                    <thead style="background: #404e67;">
                        <tr>
                            <th scope="col" class="text-white text-center">Materia prima</br> (cantidad aplicada)</th>
                            <th scope="col" class="text-white text-center" style="cursor:pointer;"
                                class="text-white" style="text-decoration: none;"> Fecha </br> aplicacion</th>
                            <th scope="col" class="text-white text-center" style="cursor:pointer;"
                                class="text-white" style="text-decoration: none;"> Cantidad </br> aplicada/Ha</th>
                            <th scope="col" class="text-white text-center" style="cursor:pointer;"
                                class="text-white" style="text-decoration: none;"> Precio por</br> (lt, kg, lbr)</th>
                            <!--th scope="col" class="text-white text-center" style="cursor:pointer;"
                                class="text-white" style="text-decoration: none;"> Precio por</br> presentacion</th-->
                            <th scope="col" class="text-white text-center" style="cursor:pointer;"
                                class="text-white" style="text-decoration: none;"> Valor </br> total/Ha</th>
                        </tr>
                    </thead>


                    <tbody>
                        
                        <?php

                            foreach($data as $p){

                                

                                if($camaronera == 1){ $empresaId = 115; }
                                else if($camaronera == 2){ $empresaId = 117; }
                                else if($camaronera == 3){ $empresaId = 118; }

                                $sqlPresupuesto = "SELECT DISTINCT p.id_camaronera AS empresaId, TRIM(LOWER(p.familia)) AS descripcion
                                                    FROM familiascuentacontable p
                                                    WHERE p.id_camaronera = '$camaronera'
                                                    AND p.cuentaMadre = 'materia_prima'
                                                    ORDER BY p.id ASC";
                                
                                $data = $conectar->mostrar($sqlPresupuesto);

                                foreach ($data as $p) {

                                    $descripcion = $p['descripcion'];
                                    $idNormalizado =  $descripcion;
                                
                                    // Obtener los productos y cantidades por piscina
                                    $sqlEjecutadoCamaronera = "SELECT t1.fecha_consumo, t1.id_piscina, t1.familia, t1.medida, t1.producto,  t1.total, t1.costo, 
                                    t1.cantidad AS cantidadTotal, t1.costo AS costoSubTotal, t1.total AS costoTotal, t1.costo_presentacion
                                    FROM costos_camaronera t1
                                    JOIN registro_piscina_engorde t2 
                                    ON t1.id_camaronera = t2.id_camaronera 
                                    AND t1.id_piscina = t2.id_piscina
                                    WHERE t2.estado = 'En proceso'
                                    AND t1.id_camaronera = '$camaronera'
                                    AND t1.familia = '$descripcion'
                                    AND t1.cuentaMadre = 'materia_prima'
                                    AND t1.id_piscina = '$piscina'";
                                
                                    $dataEjecucionCamaronera = $conectar->mostrar($sqlEjecutadoCamaronera);
                                
                                    // Inicializar estructuras de datos
                                    $productosPiscinas = [];
                                    $familiasPiscinas = [];
                                    $camaroneraTotales = [
                                        'cantidad' => 0,
                                        'costo_presentacion' => 0,
                                        'costoSubTotal' => 0,
                                        'costoTotal' => 0
                                    ];

                                    $fecha_consumo_global = '--'; // Valor por defecto si no hay datos

                                    $cantidadesPiscinas = array_fill_keys($piscinas, 0); // Inicializar en 0 todas las piscinas
                                
                                    foreach ($dataEjecucionCamaronera as $cm) {

                                        $producto = $cm['producto'];
                                        $id_piscina = $cm['id_piscina'];
                                        $cantidad = $cm['cantidadTotal'];
                                        $costo_presentacion = $cm['costo_presentacion'];
                                        $costoSubTotal = $cm['costoSubTotal'];
                                        $costoTotal = $cm['costoTotal'];
                                        $fecha_consumo_global = $cm['fecha_consumo'];
                                    

                                        // Inicializar estructuras si no existen
                                        if (!isset($productosPiscinas[$producto])) {
                                            $productosPiscinas[$producto] = array_fill_keys($piscinas, ['cantidad' => 0,  'costo_presentacion' => 0, 'costoSubTotal' => 0, 'costoTotal' => 0]);
                                        }
                                        if (!isset($familiasPiscinas[$id_piscina])) {
                                            $familiasPiscinas[$id_piscina] = ['cantidad' => 0,  'costo_presentacion' => 0, 'costoSubTotal' => 0, 'costoTotal' => 0];
                                        }


                                        
                                        // Acumular valores por producto dentro de la piscina
                                        $productosPiscinas[$producto][$id_piscina]['cantidad'] += $cantidad;
                                        $productosPiscinas[$producto][$id_piscina]['costo_presentacion'] = $costo_presentacion;
                                        $productosPiscinas[$producto][$id_piscina]['costoSubTotal'] = $costoSubTotal;
                                        $productosPiscinas[$producto][$id_piscina]['costoTotal'] += $costoTotal;
                                        

                                        // Acumular valores por familia dentro de la piscina
                                        $familiasPiscinas[$id_piscina]['cantidad'] += $cantidad;
                                        $familiasPiscinas[$id_piscina]['costo_presentacion'] = $costo_presentacion;
                                        $familiasPiscinas[$id_piscina]['costoSubTotal'] = $costoSubTotal;
                                        $familiasPiscinas[$id_piscina]['costoTotal'] += $costoTotal;
                                        

                                        // Acumular valores totales por camaronera
                                        $camaroneraTotales['cantidad'] += $cantidad;
                                        $camaroneraTotales['costo_presentacion'] += $costo_presentacion;
                                        $camaroneraTotales['costoSubTotal'] += $costoSubTotal;
                                        $camaroneraTotales['costoTotal'] += $costoTotal;
                                        
                                    }

                                    // **Fila principal con la familia**
                                    $descripcion_formateada = ucfirst(strtolower($descripcion));


                                    
                                        foreach ($piscinas as $piscina) {
                                            
                                            $cantidad = $familiasPiscinas[$piscina]['cantidad'] ?? 0;
                                            $costo_presentacion = $familiasPiscinas[$piscina]['costo_presentacion'] ?? 0;
                                            $costoSubTotal = $familiasPiscinas[$piscina]['costoSubTotal'] ?? 0;
                                            $costoTotal = $familiasPiscinas[$piscina]['costoTotal'] ?? 0;
                                        
                                        
                                            // Consulta para obtener los detalles por familia y piscina
                                            $sqlAcordeon = "SELECT t1.id_camaronera, t1.fecha_consumo, t1.id_piscina,  t1.medida,
                                                                    TRIM(LOWER(t1.familia)) AS familia, 
                                                                    t1.producto, t1.total, t1.costo, t1.cantidad, t1.costo_presentacion
                                                            FROM costos_camaronera t1
                                                            JOIN registro_piscina_engorde t2 
                                                            ON t1.id_camaronera = t2.id_camaronera 
                                                            AND t1.id_piscina = t2.id_piscina
                                                            WHERE t2.estado = 'En proceso'
                                                            AND t1.id_camaronera = '$camaronera'
                                                            AND TRIM(LOWER(t1.familia)) = TRIM(LOWER('$idNormalizado'))
                                                            AND t1.id_piscina = '$piscina'
                                                            ORDER BY t1.fecha_consumo ASC";

                                        
                                            $resultado = $conexion->query($sqlAcordeon);
                                            $datos = [];
                                        
                                        

                                                // Depurar los valores
                                                //echo "Valor de \$idNormalizado: " . htmlspecialchars($idNormalizado) . "<br>";

                                                // Ejecutar la consulta y verificar qué datos devuelve
                                                
                                                if ($resultado->num_rows > 0) {
                                                    while ($fila = $resultado->fetch_assoc()) {
                                                        //echo "Base de datos -> familia: " . htmlspecialchars($fila['familia']) . "<br>";
                                                        $datos[] = $fila;
                                                    }
                                                } else {
                                                    //echo "No hay resultados para el filtro aplicado.";
                                                }

                                        
                                            $jsonDatos = htmlspecialchars(json_encode($datos), ENT_QUOTES, 'UTF-8');
                                            
                                        
                                            // Fila principal de la familia con onclick para mostrar detalles
                                            echo "<tr>";
                                                echo "<td class='text-dark text-center' id='familias-{$idNormalizado}' onclick='toggleDetalles(this)' data-json='$jsonDatos' style='cursor:pointer; font-weight:bold;'>";
                                                if($descripcion_formateada == 'Reguladores'){
                                                    echo $descripcion_formateada = 'Reguladores de suelo y agua';
                                                
                                                }else if($descripcion_formateada == 'Otras_materias_primas'){
                                                    echo $descripcion_formateada = 'Otras materias primas';
                                                
                                                }else{
                                                    echo $descripcion_formateada;
                                                }
                                                echo "</td>";
                                                $claseColor = ($fecha_consumo_global == '--') ? 'text-dark' : 'text-dark';

                                                echo "<td class='text-center $claseColor' id='familias-{$idNormalizado}' onclick='toggleDetalles(this)' data-json='$jsonDatos' style='cursor:pointer;'>";
                                                echo !empty($fecha_consumo_global) ? "<span>$fecha_consumo_global</span>" : "--";
                                                echo "</td>";
                                                

                                                echo "<td class='text-dark text-center' id='familias-{$idNormalizado}' onclick='toggleDetalles(this)' data-json='$jsonDatos' style='cursor:pointer;'>";
                                                echo ($cantidad > 0) ? number_format($cantidad / $hectareas, 2) : "--";
                                                echo "</td>";

                                                echo "<td class='text-dark text-center' id='familias-{$idNormalizado}' onclick='toggleDetalles(this)' data-json='$jsonDatos' style='cursor:pointer;'>";
                                                echo '<i class="fas fa-dollar-sign">./</i>';
                                                echo "</td>";
                                                //echo "<td class='text-dark text-center' id='familias-{$idNormalizado}' onclick='toggleDetalles(this)' data-json='$jsonDatos' style='cursor:pointer;'>";
                                                //echo number_format($costoSubTotal,2);
                                                //echo "</td>";
                                                echo "<td class='text-dark text-center' id='familias-{$idNormalizado}' onclick='toggleDetalles(this)' data-json='$jsonDatos' style='cursor:pointer;'>";
                                                echo ($hectareas != 0 && !empty($costoTotal)) ? number_format($costoTotal / $hectareas, 2) : "--";
                                                echo "</td>";

                                            echo "</tr>";
                                                
                                        
                                            // Mostrar los detalles si hay registros
                                            if (!empty($datos)) {
                                                foreach ($datos as $fila) {
                                                    
                                                    $colorFecha = ($fila['fecha_consumo'] == '--') ? 'red' : 'black';
                                                    
                                                    echo "<tr class='detalle-familia familia-{$idNormalizado} mt-2' style='display:none;'>";
                                                
                                                        echo "<td class='text-center text-primary mt-2' style='cursor:pointer;'>{$fila['producto']}</td>";
                                                        echo "<td class='text-center text-primary mt-2' style='cursor:pointer; color: $colorFecha;'>{$fila['fecha_consumo']}</td>";
                                                        $abreviado = ($fila['medida'] == 'litro') ? '(Lt)' :  (($fila['medida'] == 'KILO') ? '(Kg)' :  (($fila['medida'] == 'libra') ? '(Lbs)' : $fila['medida']));
                                                        echo "<td class='text-center text-primary mt-2' style='cursor:pointer;'>" . number_format($fila['cantidad']/$hectareas, 2) . ' ' . $abreviado . "</td>";
                                                        echo "<td class='text-center text-primary mt-2' style='cursor:pointer;'>" . number_format($fila['costo_presentacion'],2) . "</td>";
                                                        //echo "<td class='text-center text-primary mt-2'>" . number_format($fila['costo'],2) . "</td>";
                                                        echo "<td class='text-center text-primary mt-2' style='cursor:pointer;'>" . number_format($fila['total']/$hectareas,2) . "</td>";

                                                    echo "</tr>";
                                                }
                                                
                                            } else {
                                                echo "<tr class='detalle-familia familia-{$idNormalizado} mt-2' style='display:none;'>";
                                                echo "<td class='text-center text-danger mt-2' colspan='5' style='cursor:pointer;'>No existen registros</td>";
                                                echo "</tr>";

                                            }
                                        }
                                    

                                }                       
                            }

                        ?>


                    </tbody>
                </table>
     
            </div>

        </div>

    </div>

                                                
<script>

    function toggleDetalles(element) {
        let id = element.id.replace('familias-', '');
        console.log("Familia seleccionada:", id); // Muestra en consola la familia seleccionada

        document.querySelectorAll('.familia-' + id).forEach(row => {
            row.style.display = (row.style.display === 'none') ? 'table-row' : 'none';
        });
    }

</script>