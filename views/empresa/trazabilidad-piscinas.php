<?php 

    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
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
        <h5>Reporte de aplicación de insumos de piscinas</h5>
    </div>

    <div class="container d-flex justify-content-center align-items-center vh-100">

        <hr style="width: 900px; background:#404e67;">
    </div>



    <div class="row">

        <div class="col-12">


            <div class="container mt-2">
                <div class="accordion col-12" id="accordionExample">
                    <div class="crd">


                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                            data-parent="#accordionExample">
                            <div class="card-body">
                                <div class=" col-12">
                                    <div class="col-12" style="margin: auto;">
                                        <?php
                                    // Consulta para obtener todas las piscinas en proceso
                                    $sqlPiscinas = "SELECT DISTINCT id_piscina, hectareas FROM registro_piscina_engorde WHERE estado = 'En proceso' AND id_camaronera = '$camaronera'";
                                    $piscinasData = $conectar->mostrar($sqlPiscinas);

                                    // Crear una lista de piscinas
                                    $piscinas = [];
                                    $hectareas = [];
                                    foreach ($piscinasData as $p) {
                                        $piscinas[] = $p['id_piscina'];
                                        $hectareas[] = $p['hectareas'];
                                    }
                                ?>




                                        <!--table class="table table-hover table-sm">

                                    <thead style="background: #404e67;">
                                        <tr>
                                            <th scope="col" class="text-white text-center" style="border-right: 3px solid white; width: 250px; cursor:pointer;">Indirectos</th>
                                                <?php foreach ($piscinas as $index => $piscina): ?>
                                                    <th scope="col" class="text-white text-center" style="cursor:pointer;">
                                                        <a href="index.php?page=detalle_piscina.php&piscina=<?= $piscina; ?>&ha=<?= $hectareas[$index]; ?>" 
                                                            title="Ver piscina" 
                                                            class="text-white" 
                                                            style="text-decoration: none;" 
                                                            data-toggle="popover" 
                                                            data-content="Información de la piscina <?= $piscina; ?>"><?= $piscina; ?>
                                                        </a>
                                                    </th>
                                                <?php endforeach; ?>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <?php

                                            


                                                if($camaronera == 1){ 
                                                    $empresaId = 115; 
                                                }else if($camaronera == 2){ 
                                                    $empresaId = 117; 
                                                } else if($camaronera == 3){ 
                                                    $empresaId = 118; 
                                                }

                                                $sqlPresupuesto = "SELECT DISTINCT p.id_camaronera AS empresaId, TRIM(LOWER(p.familia)) AS descripcion
                                                    FROM familiascuentacontable p
                                                    WHERE p.id_camaronera = '$camaronera'
                                                    AND p.cuentaMadre = 'materia_prima'
                                                    ORDER BY p.id ASC";
                                                
                                                $data = $conectar->mostrar($sqlPresupuesto);
    
                                                foreach ($data as $p) {

                                                    $descripcion = $p['descripcion'];
                                                    $idNormalizado = strtolower($descripcion); // Normalizar ID
                                                
                                          
                                                

                                                    
                                                        

                                                        // Consulta SQL para obtener productos y cantidades
                                                        $sqlEjecutadoCamaronera = "SELECT t1.id_piscina, t1.familia, t1.producto, 
                                                                                    SUM(t1.cantidad) AS cantidadTotal
                                                                                    FROM costos_camaronera t1
                                                                                    JOIN registro_piscina_engorde t2 
                                                                                    ON t1.id_camaronera = t2.id_camaronera 
                                                                                    AND t1.id_piscina = t2.id_piscina
                                                                                    WHERE t2.estado = 'En proceso'
                                                                                    AND t1.nombre_camaronera = '$camaronera'
                                                                                    AND t1.familia = '$descripcionNormalizado'
                                                                                    AND t1.cuentaMadre = 'materia_prima'
                                                                                    GROUP BY t1.id_piscina, t1.producto";

                                                        $dataEjecucionCamaronera = $conectar->mostrar($sqlEjecutadoCamaronera);
                                                    
                                                        // Inicializar estructuras de datos
                                                        $productosPiscinas = [];
                                                        $cantidadesPiscinas = array_fill_keys($piscinas, 0); // Inicializar en 0 todas las piscinas
                                                    
                                                        foreach ($dataEjecucionCamaronera as $cm) {
                                                            $producto = $cm['producto'];
                                                            $id_piscina = $cm['id_piscina'];
                                                            $cantidad = $cm['cantidadTotal'];
                                                    
                                                            if (!isset($productosPiscinas[$producto])) {
                                                                $productosPiscinas[$producto] = array_fill_keys($piscinas, 0);
                                                            }
                                                    
                                                            $productosPiscinas[$producto][$id_piscina] += $cantidad;
                                                            $cantidadesPiscinas[$id_piscina] += $cantidad;
                                                        }
                                                    
                                                        // ** Inicio Fila principal con la familia**

                                                       
                                                        // **Fin Fila principal con la familia**


                                                        // ** Inicio Fila oculta para productos**

                                                  

                                                        // ** Fin Fila oculta para productos**

                                                    }
                                                
                                            
                
                                        ?>

                                    </tbody>


                                    

                                </table-->

                                        <?php
                                    // Consulta para obtener el consumo total por piscina en un solo query
                                    $sqlSumaCantidad = "SELECT t1.id_piscina, (SUM(t1.total)/t2.hectareas) AS cantidadTotal, t2.hectareas
                                                        FROM costos_camaronera t1
                                                        JOIN registro_piscina_engorde t2 
                                                        ON t1.id_camaronera = t2.id_camaronera 
                                                        AND t1.id_piscina = t2.id_piscina
                                                        WHERE t2.estado = 'En proceso'
                                                        AND t1.nombre_camaronera = '$empresaId'
                                                       
                                                        AND t1.cuentaMadre = 'materia_prima'
                                                        GROUP BY t1.id_piscina";

                                    $resultado = mysqli_query($conexion, $sqlSumaCantidad);

                                    // Crear un array para almacenar los resultados de cada piscina
                                    $consumos = [];
                    

                                    while ($fila = mysqli_fetch_assoc($resultado)) {
                                        $consumos[$fila['id_piscina']] = $fila['cantidadTotal']; 
                                    }

                                    

                                    $presupuestoAprobado = 500; // Definir fuera del foreach
                                ?>
                                        <div class="text-dark" style="margin-bottom: 5px; margin-top:-25px;">
                                        Para visualizar los detalles,  <a href="#" class="text-danger">dar click sobre el numero de la piscina </a>
                                        </div>
                                        <table class="table table-hover table-sm">
                                            <thead style="background: #404e67;">
                                                <tr>
                                                    <th scope="col" class="text-white text-center"
                                                        style="border-right: 3px ; width: 275px; cursor:pointer;">
                                                        Presupuesto (Dolares)</th>
                                                    <?php foreach ($piscinas as $index => $piscina): ?>
                                                    <th scope="col" class="text-white text-center" style="cursor:pointer;">
                                                        <a href="index.php?page=detalle_piscina.php&piscina=<?= $piscina; ?>&ha=<?= $hectareas[$index]; ?>"
                                                            title="Ver piscina" class="text-white"
                                                            style="text-decoration: none;" data-toggle="popover"
                                                            data-content="Información de la piscina <?= $piscina; ?>"><?= $piscina; ?>
                                                        </a>
                                                    </th>
                                                    <?php endforeach; ?>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody style="cursor:pointer;">


                                                <tr>
                                                    <th scope="row" class="text-center">Total presupuesto por Ha</th>
                                                    <?php foreach ($piscinas as $piscina): ?>
                                                    <td class="text-center">
                                                        <?php 
                                                        $sqlHa = "SELECT hectareas FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND estado = 'En proceso'"; 
                                                        $data = $conectar->mostrar($sqlHa);
                                                        foreach($data as $ha){
                                                            echo  $presupuestos = ($presupuestoAprobado);
                                                        }


                                                    ?>
                                                    </td>
                                                    <?php endforeach; ?>
                                                </tr>

                                                <tr>
                                                    <th scope="row" class="text-center">Total ejecutado por Ha</th>
                                                    <?php foreach ($piscinas as $piscina): ?>
                                                        <td class="text-center">
                                                            <?= isset($consumos[$piscina]) && $consumos[$piscina] > 0 ? number_format($consumos[$piscina], 2) : "--"; ?>
                                                        </td>

                                                    <?php endforeach; ?>
                                                </tr>

                                                <tr>
                                                    <th scope="row" class="text-center">Restante total</th>
                                                    <?php foreach ($piscinas as $piscina): ?>
                                                    <?php 
                                                    $restante = isset($consumos[$piscina]) ? ($presupuestos - intval($consumos[$piscina])) : $presupuestos; 
                                                    $color = ($restante < 0) ? 'red' : 'green'; // Rojo si es negativo, verde si es positivo
                                                ?>
                                                    <td class="text-center" style="color: <?= $color; ?>;">
                                                        <?= $restante; ?>
                                                    </td>
                                                    <?php endforeach; ?>
                                                </tr>



                                            </tbody>
                                        </table>

                                        <table class="table table-hover table-sm">

                                            <thead style="background: #404e67;">
                                                <tr>
                                                    <th scope="col" class="text-white text-center"
                                                        style="border-right: 3px; width: 260px; cursor:pointer;">Materia
                                                        prima (cantidad aplicada)</th>
                                                    <?php foreach ($piscinas as $index => $piscina): ?>
                                                    <th scope="col" class="text-white text-center" style="cursor:pointer;">
                                                        <a href="index.php?page=detalle_piscina.php&piscina=<?= $piscina; ?>&ha=<?= $hectareas[$index]; ?>"
                                                            title="Ver piscina" class="text-white"
                                                            style="text-decoration: none;" data-toggle="popover"
                                                            data-content="Información de la piscina <?= $piscina; ?>">
                                                        </a>
                                                    </th>
                                                    <?php endforeach; ?>
                                                    </th>
                                                </tr>
                                            </thead>


                                            <tbody>

                                                <?php

                                            foreach($data as $p){


                                                if($camaronera == 1){ 
                                                    $empresaId = 115; 
                                                }else if($camaronera == 2){ 
                                                    $empresaId = 117; 
                                                } else if($camaronera == 3){ 
                                                    $empresaId = 118; 
                                                }

                                                $sqlPresupuesto = "SELECT DISTINCT p.id_camaronera AS empresaId, TRIM(LOWER(p.familia)) AS descripcion
                                                    FROM familiascuentacontable p
                                                    WHERE p.id_camaronera = '$camaronera'
                                                    AND p.cuentaMadre = 'materia_prima'
                                                    ORDER BY p.id ASC";
                                                
                                                $data = $conectar->mostrar($sqlPresupuesto);

                                                foreach ($data as $p) {

                                                    $descripcion = $p['descripcion'];
                                                    $idNormalizado = strtolower($descripcion); // Normalizar ID
                                                
                                                    if ($descripcion == 'otras_materias_primas') {
                                                        $descripcionNormalizado = 'otras_materias_primas';
                                                    } elseif ($descripcion == 'reguladores') {
                                                        $descripcionNormalizado = 'reguladores';
                                                    
                                                    }elseif ($descripcion == 'peroxido') {
                                                        $descripcionNormalizado = 'peroxido';
                                                    } elseif ($descripcion == 'fertilizantes') {
                                                        $descripcionNormalizado = 'fertilizantes';
                                                    } elseif ($descripcion == 'bacterias') {
                                                        $descripcionNormalizado = 'bacterias';
                                                    } elseif ($descripcion == 'larva') {
                                                        $descripcionNormalizado = 'larva';
                                                    } elseif ($descripcion == 'balanceado') {
                                                        $descripcionNormalizado = 'balanceado';
                                                    } elseif ($descripcion == 'desparasitantes') {
                                                        $descripcionNormalizado = 'desparasitantes';
                                                    } elseif ($descripcion == 'probioticos') {
                                                        $descripcionNormalizado = 'probioticos';
                                                    } elseif ($descripcion == 'vitaminas') {
                                                        $descripcionNormalizado = 'vitaminas';
                                                    }
                                                

                                                    
                                                        

                                                        // Consulta SQL para obtener productos y cantidades
                                                        $sqlEjecutadoCamaronera = "SELECT t1.id_piscina, t1.familia, t1.producto, t1.hectareas,
                                                                                    SUM(t1.cantidad) AS cantidadTotal
                                                                                    FROM costos_camaronera t1
                                                                                    JOIN registro_piscina_engorde t2 
                                                                                    ON t1.id_camaronera = t2.id_camaronera 
                                                                                    AND t1.id_piscina = t2.id_piscina
                                                                                    WHERE t2.estado = 'En proceso'
                                                                                    AND t1.nombre_camaronera = '$empresaId'
                                                                                    AND t1.familia = '$descripcionNormalizado'
                                                                                    AND t1.cuentaMadre = 'materia_prima'
                                                                                    GROUP BY t1.id_piscina, t1.producto";

                                                        $dataEjecucionCamaronera = $conectar->mostrar($sqlEjecutadoCamaronera);
                                                    
                                                        // Inicializar estructuras de datos
                                                        $productosPiscinas = [];
                                                        $cantidadesPiscinas = array_fill_keys($piscinas, 0); // Inicializar en 0 todas las piscinas
                                                        $hectareasPiscinas = array_fill_keys($piscinas, 0); // Inicializar en 0 las hectáreas por piscina

                                                        foreach ($dataEjecucionCamaronera as $cm) {
                                                            $producto = $cm['producto'];
                                                            $id_piscina = $cm['id_piscina'];
                                                            $cantidad = $cm['cantidadTotal'];
                                                            $hectareas = $cm['hectareas'];

                                                            if (!isset($productosPiscinas[$producto])) {
                                                                $productosPiscinas[$producto] = array_fill_keys($piscinas, 0);
                                                            }

                                                            // Acumular la cantidad para cada producto en cada piscina
                                                            $productosPiscinas[$producto][$id_piscina] += $cantidad;
                                                            $cantidadesPiscinas[$id_piscina] += $cantidad;
                                                            $hectareasPiscinas[$id_piscina] = $hectareas; // Guardar las hectáreas específicas por piscina
                                                        }

                                                        // ** Inicio Fila principal con la familia**

                                                        if($descripcion == 'fertilizantes'){
                                                            $descripcion = 'Fertilizantes';
                                                        }else if($descripcion == 'vitaminas'){
                                                            $descripcion = 'Vitaminas';
                                                        }else if($descripcion == 'bacterias'){
                                                            $descripcion = 'Bacterias';
                                                        }else if($descripcion == 'desparasitantes'){
                                                            $descripcion = 'Desparasitantes';
                                                        }else if($descripcion == 'antibioticos'){
                                                            $descripcion = 'Antibioticos';
                                                        }else if($descripcion == 'reguladores'){
                                                            $descripcion = 'Reguladores de agua y suelo';
                                                        
                                                        }else if($descripcion == 'peroxido'){
                                                            $descripcion = 'Peroxido';
                                                        }else if($descripcion == 'probioticos'){
                                                            $descripcion = 'Probioticos';
                                                        }else if($descripcion == 'otras_materias_primas'){
                                                            $descripcion = 'Otras materias primas';
                                                        }

                                                        echo "<tr class='fila-familia' data-familia='{$idNormalizado}' onclick='toggleFamilia(\"{$idNormalizado}\")' style='cursor: pointer;'>";
                                                        echo "<td class='text-dark text-center' style='border-right: 3px;'><strong>{$descripcion}</strong></td>";

                                                        foreach ($piscinas as $piscina) {
                                                            $cantidad = isset($cantidadesPiscinas[$piscina]) ? $cantidadesPiscinas[$piscina] : 0;
                                                            $hectareas = isset($hectareasPiscinas[$piscina]) ? $hectareasPiscinas[$piscina] : 0;

                                                            // Asegúrate de que hectáreas no sea 0 para evitar la división por cero
                                                            if ($cantidad > 0 && $hectareas != 0) {
                                                                $resultado = $cantidad / $hectareas;
                                                                // Muestra el resultado con 2 decimales
                                                                echo "<td class='text-dark text-center'>" . number_format($resultado, 2) . "</td>";
                                                            } else {
                                                                // Muestra una celda vacía si no hay cantidad
                                                                echo "<td class='text-dark text-center'>--</td>";
                                                            }

                                                        }

                                                        echo "</tr>";

                                                        

                                                        // **Fin Fila principal con la familia**


                                                        // ** Inicio Fila oculta para productos**

                                                        echo "<tbody id='detalle-{$idNormalizado}' class='detalle-familia' style='display: none;'>";

                                                        if (empty($productosPiscinas)) {
                                                            // Si no hay datos, mostrar un mensaje
                                                            echo "<tr class='mensaje-{$idNormalizado}'>";
                                                            echo "<td class='text-danger text-center' colspan='" . (count($piscinas) + 1) . "' style='cursor:pointer;' >No existen registros</td>";
                                                            echo "</tr>";
                                                        } else {
                                                            foreach ($productosPiscinas as $producto => $cantidades) {
                                                                echo "<tr class='producto-{$idNormalizado}'>";
                                                                echo "<td class='text-primary text-center' style='border-right: 3px'>{$producto}</td>";
                                                        
                                                                foreach ($piscinas as $piscina) {
                                                                    $cantidad = isset($cantidades[$piscina]) ? $cantidades[$piscina] : 0;
                                                        
                                                                    // Asegúrate de que hectáreas no sea 0 para evitar la división por cero
                                                                    $hectareas = isset($hectareasPiscinas[$piscina]) ? $hectareasPiscinas[$piscina] : 0;

                                                                    if ($cantidad > 0 && $hectareas != 0) {
                                                                        $resultado = $cantidad / $hectareas;
                                                                        // Muestra el resultado con 2 decimales
                                                                        echo "<td class='text-primary text-center' style='cursor:pointer;'> " . number_format($resultado, 2) . "</td>";
                                                                    } else {
                                                                        // Muestra una celda vacía si no hay cantidad
                                                                        echo "<td class='text-primary text-center' style='cursor:pointer;'>--</td> ";
                                                                    }
                                                                }
                                                                echo "</tr>";
                                                            }
                                                        }
                                                        echo "</tbody>";
                                                        
                                                            echo "</tbody>";

                                                        // ** Fin Fila oculta para productos**

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
                </div>
            </div>
        </div>
    </div>

</div>



<script>
/* Funcion para mostrar y ocultar filas del acordeon de la tabla principal */

function toggleFamilia(id) {
    let detalle = document.getElementById('detalle-' + id);

    if (detalle.style.display === 'none') {
        detalle.style.display = 'table-row-group'; // Muestra la tabla
    } else {
        detalle.style.display = 'none'; // Oculta la tabla
    }
}



/* Funcion para redireccionar a la pagina donde se muestra los detalles de la piscina seleccionada  */

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".piscina-header").forEach(function(th) {
        th.addEventListener("click", function() {
            let piscinaId = this.getAttribute("data-piscina-id");
            window.location.href = "empresa/detalle_piscina.php?piscina=" + encodeURIComponent(
                piscinaId);
        });
    });
});

/* Popup para piscina */

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});
</script>