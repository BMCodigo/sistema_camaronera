
         <div class="row">
        <div class="col-12">
            <div class="table table-sm table-responsive mb-4 ">
                <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                    <?php
                    $b = $_POST['tipo_alimento']; /*************************$_POST['fechaInicial'] $_POST['fechaFinal'] $_POST['tipo_balanceado'] *************************************/    
                    $alimento = explode(" ", $b);
                    if (isset($_POST['tipo_alimento']) && $b != '') { ?>  
                        <thead>
                            <tr class="text-center">
                                <th class="text-center text-white" style="background: #404e67;">Fecha de movimiento
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Balanceado
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Descripcion
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">ingreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Egreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">En Psc
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Saldo
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Responsable
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * 
                                    FROM(
                                        SELECT DISTINCT e.fecha_entrega AS fecha, e.descripcion AS descripcion
                                        FROM egreso_balanceado e
                                        WHERE e.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
                                        AND e.fecha_entrega < '2024-04-16' /***********************************************************************************/
                                        ORDER BY e.fecha_entrega ASC) t1
                                    UNION
                                        (SELECT DISTINCT i.fecha_ingreso AS fecha, i.descripcion AS descripcion
                                        FROM ingreso_balanceado i
                                        WHERE i.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
                                        AND i.fecha_ingreso < '2024-04-16'   /***********************************************************************************/
                                        ORDER BY i.descripcion ASC)
                                    ORDER BY fecha ASC";
                            $data = $objeto->mostrar($sql);
                            if (count($b) > 0) {
                                foreach ($data as $x) {
                                    $este_te_sobra_koketa = 0.00;
                                    $fecha_consumo = $x["fecha"];
                                    if ($x['descripcion'] == 'Consumo piscina' || $x['descripcion'] == 'Consumo precria') {
                                        if ($x['descripcion'] == 'Consumo piscina') {
                                            $sql_sobrante = "SELECT 
                                                            SUM((e.cantidad_balanceado) + e.sobrante) -
                                                            IF (
                                                                a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'), 
                                                                SUM(a.cantidad),
                                                                IF (
                                                                    a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                    SUM(a.cantidad_2),
                                                                    IF (
                                                                        a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')
                                                                        AND
                                                                        a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento  = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                        SUM(a.cantidad + a.cantidad_2),
                                                                        0
                                                                    )
                                                                )
                                                            )as alimentaste    
                                                        FROM 
                                                            egreso_balanceado e, registro_alimentacion_engorde a
                                                        WHERE
                                                            e.id_piscina = a.id_piscina
                                                            AND a.id_piscina BETWEEN 1 AND 12
                                                            AND e.camaronera = a.id_camaronera
                                                            AND a.id_camaronera = '$camaronera'
                                                            AND e.fecha_entrega = a.fecha_alimentacion
                                                            AND a.fecha_alimentacion = '$fecha_consumo'
                                                            AND (e.id = 'Piscina')
                                                            AND e.tipo_balanceado = '$b'
                                                            AND a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')";
                                        }  
                                    }
                            ?>
                                    <tr>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $d = $x['fecha'];$getdate = $d; ?>
                                        <!-- balanceado -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $b;$getbalanceado = $b; ?></span>
                                        </td>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $x['descripcion'];$getdescripcion = $x['descripcion'];  ?></span>
                                        </td>
                                        <!-- Ingreso inicial -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            $descrip = $x['descripcion'];
                                            $sql = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado FROM ingreso_balanceado WHERE tipo_balanceado LIKE '$b' AND descripcion = '$descrip' AND camaronera = '$camaronera' AND fecha_ingreso = ( SELECT MAX(fecha_ingreso) FROM ingreso_balanceado WHERE fecha_ingreso = '$d')";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $i_aux = $s;
                                                $i = $x['cantidad_balanceado'];
                                                $ingresito = $i;
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $i . '</span>';
                                                 $getingreso =  $i;
                                                   $getingreso = str_replace(",", "", $getingreso);
                                            }
                                            ?>
                                        </td>
                                        <!-- Egreso -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            $sql = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado, tipo_balanceado FROM egreso_balanceado WHERE tipo_balanceado LIKE '$b' AND camaronera = '$camaronera' AND fecha_entrega = '$d' AND descripcion = '$descrip'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                if($x['tipo_balanceado'] == 'Origin 0.5'){
                                                    $e = $x['cantidad_balanceado'] / 10;
                                                }else if($x['tipo_balanceado'] == 'Origin 0.3'){
                                                    $e = $x['cantidad_balanceado'] / 10;
                                                }else {
                                                    $e = $x['cantidad_balanceado'] / 25;
                                                }

                                                if ($i) {
                                                    echo '<span class="text-secondary text-xs font-weight-bold">' . $e . '</span>';
                                                    $i = $s + $i;
                                                } else {
                                                    echo '<span class="text-secondary text-xs font-weight-bold">' . $e . '</span>';
                                                    $i = $s;
                                                }
                                                $getegreso =  $e;
                                                 $getegreso = str_replace(",", "", $getegreso);
                                            }
                                            ?>
                                        </td>
                                        <!-- sobrante en piscina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            echo $este_te_sobra_koketa/25;
                                            $getsobrante = $est/25;
                                             $getsobrante = str_replace(",", "", $getsobrante);
                                            ?>
                                        </td>
                                        <!-- Saldo disponible -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php $s = $i - $e; ?>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php if ($s <= 0) {
                                                    echo '0.00';$getsaldo = 0.00;
                                                } else {
                                                    $valor_e = number_format(substr($s, -4), 2);
                                                    if ($valor_e == 'E-14' || $valor_e == 'E-15' || $valor_e == 'E-16') {
                                                        echo '0.00';$getsaldo = 0.00;
                                                    } else {
                                                        echo number_format(sprintf($s), 2); $getsaldo = number_format(sprintf($s), 2);
                                                     
                                                        $getsaldo = str_replace(",", "", $getsaldo);
                                                    };
                                                } ?>
                                            </span>
                                        </td>
                                        <!-- Responsable -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            if ($ingresito) {
                                                $sql = "SELECT DISTINCT i.encargado AS encargado
                                                FROM ingreso_balanceado i
                                                WHERE i.tipo_balanceado =  '$b' 
                                                AND i.fecha_ingreso = '$d'
                                                           
                                                AND i.camaronera = '$camaronera'";
                                            } else {
                                                $sql = "SELECT DISTINCT e.encargado AS encargado
                                                FROM egreso_balanceado e
                                                WHERE e.tipo_balanceado =  '$b' 
                                                AND e.fecha_entrega = '$d'
                                                AND e.fecha_entrega < '2024-04-16'
                                                AND e.camaronera = '$camaronera'";
                                            }

                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $x['encargado'] . '</span>';
                                                $getresponsable = $x['encargado'];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                        </tbody>
                <?php
                 $sql = "INSERT INTO `kardex`(`fecha`, `descripcion`, `tipo_balanceado`, `camaronera_id`, `ingreso`, `egreso`, `saldo_piscina`, `saldo`, `responsable`) 
            VALUES(
                '$getdate',
                '$getdescripcion',
                '$getbalanceado',
                '1',
                '$getingreso',
                '$getegreso',
                '$getsobrante',
                '$getsaldo',
                '$getresponsable'
            );"; 
        // echo $sql;
                                }
                            }
                            //VALIDAMOS Y VISUALIZAMOS EL KARDEX CON LOS SALDOS DEL ULTIMO MOVIMIENTO
                        } ?>

                    </table>
                    
                    
                    
                </div>
                
            </div>
        </div>