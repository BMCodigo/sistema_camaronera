<?php $objeto = new corrida(); ?>


<div class="card">

    <div class="card-header text-center" style="background: #404e67;">
    <h6 class="text-white" style="margin:auto;">RESUMEN DE EXISTENCIA DE BALANCEADO</h6>
        <!--h6 class="text-white" style="margin:auto;">REGISTRO DE EGRESO DE BALANCEADO</h6-->
        <ul class="time-horizontal nav justify-content-center">
            <!--li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li-->
            <!--<li><b><a class="nav-link text-white " href="index.php?page=Ingreso"><i class="fas fa-copy text-info"></i> Ingresos de balanceado </a></b></li>-->
            <!--<li><b><a class="nav-link text-white " href="index.php?page=Aprobacion-solicitud"><i class="fas fa-minus-circle text-warning"></i> Aprobacion de solicitud</a></b></li>-->
            <!--li><b><a class="nav-link text-white " href="index.php?page=Ingreso"><i class="fas fa-cogs text-danger"></i> Ajuste de kardex </a></b></li-->
        </ul>
    </div>

</div>
<div class="card-body">

    <div class="row">
        <div class="col-3">
            <div class="table table-sm table-responsive">

                <table class="table table-sm table-bordered   align-items-center mb-0">
                    <thead>
                        <tr class="text-center">

                            <th class="text-white" style="background: #e8573a;">Tipo de balanceado
                            </th>

                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td class="align-middle text-center" style="border: 1px solid #40497C">

                                <form action="index.php?page=Kardex" method="post">
                                    <select class="form-control text-center" name="tipo_alimento" id="camaronera" style="border: none" onchange="this.form.submit()">
                                        <a href="index.php?page=Kardex">
                                            <option class="text-center" id="valor" value="todos"> Seleccione
                                                balanceado</option>
                                        </a>
                                        <a href="index.php?page=Kardex">
                                            <option class="text-center" id="valor" value=""> Todos los alimentos
                                            </option>
                                        </a>
                                        <?php

                                        $sql = "SELECT * FROM tipo_alimento";
                                        $data = $objeto->mostrar($sql);

                                        $alimentos = $data;

                                        foreach ($data as $value) {
                                        ?>
                                            <option value="<?php echo $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento'] ?>">
                                                <?php echo '<a href="#">' . $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento'] . '</a>'; ?>
                                            </option>

                                        <?php } ?>

                                    </select>
                                </form>

                            </td>

                        </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </div>


    <div class="row">

        <div class="col-12">
            <div class="table table-sm table-responsive mb-4 ">
                <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">

                    <?php

                    $b = $_POST['tipo_alimento'];
                    $alimento = explode(" ", $b);
                    if (isset($_POST['tipo_alimento']) && $b != '') { ?>

                        <thead>

                            <tr class="text-center">

                                <th class="text-center text-white" style="background: #404e67;">Fecha egreso
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
                                        ORDER BY e.fecha_entrega ASC) t1
                                    UNION
                                        (SELECT DISTINCT i.fecha_ingreso AS fecha, i.descripcion AS descripcion
                                        FROM ingreso_balanceado i
                                        WHERE i.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
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
                                                <?php echo $d = $x['fecha']; ?>
                                        <!-- balanceado -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $b; ?></span>
                                        </td>

                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $x['descripcion']; ?></span>
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
                                            }
                                            ?>
                                        </td>

                                        <!-- sobrante en piscina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            echo $este_te_sobra_koketa/25;
                                            ?>
                                        </td>

                                        <!-- Saldo disponible -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php $s = $i - $e; ?>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php if ($s <= 0) {
                                                    echo '0.00';
                                                } else {
                                                    $valor_e = number_format(substr($s, -4), 2);
                                                    if ($valor_e == 'E-14' || $valor_e == 'E-15' || $valor_e == 'E-16') {
                                                        echo '0.00';
                                                    } else {
                                                        echo number_format(sprintf($s), 2);
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
                                                AND e.camaronera = '$camaronera'";
                                            }

                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $x['encargado'] . '</span>';
                                            }
                                            ?>
                                        </td>

                                    </tr>
                        </tbody>

                <?php }
                            }

                    

                        } 
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>