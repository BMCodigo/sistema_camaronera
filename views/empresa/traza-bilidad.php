    <div class="container">
        <div class="container text-center" style="margin-top:-45px;">
            <label for="inlineFormCustomSelectPref"><strong>
                    <h5><strong>Trazabilidad de modificacion de balanceado</strong></h5>
                </strong></label>
            <hr>
        </div>
        <div class="container" style="margin-left:-15px; margin-top:15px;">
            <form class="form-inline" method="GET" action="../views/index.php?page=traza-bilidad">
                <input type="hidden" name="page" value="traza-bilidad">
                <select class="form-control custom-select my-1 mr-sm-3" name="camaronera" id="camaronera">
                    <option value="">[ Seleccione camaronera ]</option>
                    <?php
                        $objeto_tabla_camaronera = new corrida();
                        $sql_tabla_camaronera = "SELECT id_camaronera, descripcion_camaronera FROM camaronera";
                        $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);
                        foreach ($data as $value) {
                    ?>
                    <option value="<?php echo $value['id_camaronera']; ?>"
                        <?php if(isset($_GET['camaronera']) && $_GET['camaronera'] == $value['id_camaronera']) echo 'selected'; ?>>
                        <?php echo $value['descripcion_camaronera']; ?>
                    </option>
                    <?php } ?>
                </select>
                <button type="submit" class="btn btn-primary" name="buscar">Ver detalles</button>
            </form>
        </div>

        <div class="container" style="margin-left:-15px; margin-top:10px;">
            <div class="alert alert-warning" role="alert">
                Movimientos agregados por fecha <strong>mas reciente</strong>
            </div>
        </div>

        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-sm table-bordered">
                <thead class="">
                    <tr class="text-white text-center">
                        <th colspan="6" class="bg-dark" style="height:30px;">
                            <span class="text-white">Registro Modificacion</span>
                        </th>
                        <th colspan="4" class="bg-dark" style="height:30px;">
                            <span class="text-white">Registro Inicial</span>
                        </th>
                    </tr>
                    <tr class="text-center" style="background:rgb(64, 78, 103);">
                        <th class="text-white" scope="col">Camaronera</th>
                        <th class="text-white" scope="col">Piscina</th>
                        <th class="text-white" scope="col">Fecha registro</th>
                        <th class="text-white" scope="col">Tipo Balanceado</th>
                        <th class="text-white" scope="col">Cantidad</th>
                        <th class="text-white" scope="col">Sobrante</th>
                        <th class="text-white" scope="col">Tipo Balanceado</th>
                        <th class="text-white" scope="col">Cantidad</th>
                        <th class="text-white" scope="col">Sobrante</th>
                        <th class="text-white" scope="col">Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (isset($_GET['buscar'])) {
                        // Filtered SQL query when a camaronera is selected
                        $camaronera_id = $_GET['camaronera'];
                       $sql="SELECT 
                                CASE 
                                    WHEN y.camaronera = 1 THEN 'Darsacom'
                                    WHEN y.camaronera = 2 THEN 'Aquacamaron'
                                    WHEN y.camaronera = 3 THEN 'Jopisa'
                                    WHEN y.camaronera = 4 THEN 'Jopisa'
                                    WHEN y.camaronera = 5 THEN 'Grupo Camaron'
                                    WHEN y.camaronera = 6 THEN 'Calica'
                                    ELSE 'other' 
                                END AS camaronera,
                                y.id_secuencia, 
                                
                                y.fecha_entrega AS fecha_inicial, 
                                y.id_piscina, 
                                y.id_corrida, 
                                y.cantidad_balanceado AS cantidad_inicial, 
                                y.tipo_balanceado AS balanceado_inicial,
                                y.encargado, 
                                y.descripcion, 
                                y.sobrante AS sobrante_inicial, 
                                y.estado, 
                                x.fecha_registro AS fecha_modificada, 
                                x.cantidad_balanceado AS cantidad_modificada, 
                                x.tipo_balanceado AS balanceado_modificado, 
                                x.sobrante AS sobrante_modificado, 
                                x.responsable, 
                                x.id_bitacora 
                                FROM 
                                    bitacora_balanceado x
                                INNER JOIN 
                                    solicitud_balanceados y 
                                ON 
                                    x.id_balanceado = y.id_balanceado 
                                WHERE 
                                    y.estado = 'Aprobado' 
                                AND y.camaronera = '$camaronera_id'
                                ORDER BY 
                                    x.fecha_registro DESC, 
                                    y.id_piscina ASC, 
                                    x.id_bitacora ASC";
                    } else {
                        // Default SQL query when no camaronera is selected
                        $sql="SELECT 
                                CASE 
                                    WHEN y.camaronera = 1 THEN 'Darsacom'
                                    WHEN y.camaronera = 2 THEN 'Aquacamaron'
                                    WHEN y.camaronera = 3 THEN 'Jopisa'
                                    WHEN y.camaronera = 4 THEN 'Jopisa'
                                    WHEN y.camaronera = 5 THEN 'Grupo Camaron'
                                    WHEN y.camaronera = 6 THEN 'Calica'
                                    ELSE 'other' 
                                END AS camaronera,
                                y.id_secuencia, 
                                y.fecha_entrega AS fecha_inicial, 
                                y.id_piscina, 
                                y.id_corrida, 
                                y.cantidad_balanceado AS cantidad_inicial, 
                                y.tipo_balanceado AS balanceado_inicial,
                                y.encargado, 
                                y.descripcion, 
                                y.sobrante AS sobrante_inicial, 
                                y.estado, 
                                x.fecha_registro AS fecha_modificada, 
                                x.cantidad_balanceado AS cantidad_modificada, 
                                x.tipo_balanceado AS balanceado_modificado, 
                                x.sobrante AS sobrante_modificado, 
                                x.responsable, 
                                x.id_bitacora 
                            FROM 
                                bitacora_balanceado x
                            INNER JOIN 
                                solicitud_balanceados y 
                            ON 
                                x.id_balanceado = y.id_balanceado 
                            WHERE 
                                y.estado = 'Aprobado' 
                            ORDER BY 
                                x.fecha_registro DESC, 
                                y.id_piscina ASC, 
                                x.id_bitacora ASC";
                    }
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $key) :
                    ?>
                    <tr>
                        <th><?php echo $key['camaronera']?></th>
                        <td class="text-center"><?php echo $key['id_piscina']?></td>
                        <td>
                            <?php 
                                $fecha_ini = $key['fecha_inicial'];
                                // Crear un objeto DateTime a partir de la fecha
                                $date = new DateTime($fecha_ini);
                                // Definir el formato en espa�0�9ol
                                $fechaEnEspanol = $date->format('j-M-Y');
                                // Traducir el mes al espa�0�9ol
                                $meses = [
                                    'Jan' => 'ene', 'Feb' => 'feb', 'Mar' => 'mar', 'Apr' => 'abr',
                                    'May' => 'may', 'Jun' => 'jun', 'Jul' => 'jul', 'Aug' => 'ago',
                                    'Sep' => 'sep', 'Oct' => 'oct', 'Nov' => 'nov', 'Dec' => 'dic'
                                ];
                                // Reemplazar el mes en ingl��s por el mes en espa�0�9ol
                                $fechaEnEspanol = strtr($fechaEnEspanol, $meses);
                                // Mostrar la fecha en espa�0�9ol
                                echo $fechaEnEspanol;
                            ?>
                        </td>
                        <td><?php echo $key['balanceado_inicial']?></td>
                        <td class="text-center"><?php echo intval($key['cantidad_inicial'])?></td>
                        <td class="text-center"><?php echo $key['sobrante_inicial']?></td>
                        <td><?php echo $key['balanceado_modificado']?></td>
                        <td class="text-center"><?php echo intval($key['cantidad_modificada'])?></td>
                        <td class="text-center"><?php echo $key['sobrante_modificado']?></td>
                        <td><?php echo $key['encargado']?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>

    <style>
    thead th {
        position: sticky;
        top: 0;
        z-index: 1;
        background-color: rgb(64, 78, 103);
        color: white;
    }
    .selected-row {
        background-color: #fcc77b; /* Color de fondo de la fila seleccionada */
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todas las filas del cuerpo de la tabla
        const rows = document.querySelectorAll('tbody tr');

        rows.forEach(row => {
            row.addEventListener('click', function() {
                // Elimina la clase 'selected-row' de todas las filas
                rows.forEach(r => r.classList.remove('selected-row'));

                // A�0�9ade la clase 'selected-row' a la fila clicada
                this.classList.add('selected-row');
            });
        });
    });
    </script>

