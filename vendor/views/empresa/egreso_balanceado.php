    <?php

    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    date_default_timezone_set("America/Lima");
    $fecha = date('Y-m-d');
    ?>

    <!-- TABLA DE EGRESO -->
    <div class="card">

        <div class="card-header" style="background: #404e67;">

            <h6 class="text-white" style="margin:auto;">ORDEN DE PEDIDO DE BALANCEADO GENERADAS</h6>
            <ul class="time-horizontal nav justify-content-center">
                <!--li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li-->
                <li><b><a class="nav-link text-white " href="index.php?page=Ingreso"><i class="fas fa-copy text-info"></i>
                            Ingresos de AABB </a></b></li>
                <li><b><a class="nav-link text-white " href="index.php?page=Egreso"><i class="fas fa-minus-circle text-warning"></i> Orden Generadas </a></b></li>

                <li>

                    <div class="dropdown mt-2">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs text-danger"></i>
                            <b> Orden Generadas</b>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="index.php?page=Sugerencias">Ver orden </a>
                        </div>
                    </div>
                </li>
            </ul>

        </div>
        <div class="card-body">
            <center>
                <div class="col-6 mb-5">

                    <div class="row">
                        <div class="col">
                            <b><span class="text-danger">Responsable</span></b>
                            <input type="text" class="form-control text-center" value="<?php echo $nombre . ' ' . $apellido; ?>">
                        </div>
                        <div class="col">
                            <?php

                            $sql_fecha = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND fecha_entrega = (SELECT MAX(fecha_entrega) FROM solicitud_balanceados WHERE camaronera = '$camaronera') LIMIT 1";
                            $data_fecha = $objeto->mostrar($sql_fecha);
                            foreach ($data_fecha as $key_fecha) {
                            ?>
                                <b><span class="text-danger">Fecha de entrega</span></b>
                                <input type="date" class="form-control text-center" value="<?php echo $key_fecha['fecha_entrega']; ?>" readonly style="background: none;">
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </center>

            <div class="row mt-5">

                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 mt-5">

                    <div class="table table-sm table-responsive mb-4 mt-2">
                        <div class="scroll">
                            <table class="table table-sm table-bordered align-items-center mb-0">

                                <thead>
                                    <tr class="text-center">

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Piscina
                                        </th>

                                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">
                                            Cant. en </br> Psc / sacos
                                        </th>

                                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">
                                            Cant. </br> solicitada
                                        </th>

                                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">
                                            Total a </br> entregar
                                        </th>

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Tipo </br> AABB
                                        </th>

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Sugerir</th>

                                    </tr>
                                </thead>

                                <tbody>

                                    <?php

                                    if (isset($_POST['buscar_alimento'])) {

                                        $consulta = $_POST['buscar_alimento'];
                                        $sql = "SELECT * FROM  solicitud_balanceados WHERE fecha_entrega = '$consulta' AND camaronera = '$camaronera' AND cantidad_balanceado > 0 AND id = 'Piscina' ORDER BY id_piscina";
                                    } else {

                                        $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id = 'Piscina' AND fecha_entrega = (SELECT MAX(fecha_entrega) FROM solicitud_balanceados WHERE camaronera = '$camaronera') ORDER BY id_piscina";
                                    }

                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $key) {
                                    ?>

                                        <tr>

                                            <?php $f_e = $key['fecha_entrega']; ?>
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <?php echo $key['id_piscina']; ?>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <?php if ($key['sobrante'] > 0) { ?>
                                                        <input type="text" class="text-center text-danger" value="<?php echo $sobrante = intval($key['sobrante']); ?>" style="border:none; width: 30px;" readonly>
                                                    <?php } else { ?>
                                                        <input type="text" class="text-center" value="<?php echo $sobrante = intval($key['sobrante']); ?>" style="border:none; width: 30px;" readonly>
                                                    <?php } ?>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <?php echo $cantidad = intval($key['cantidad_balanceado']); ?>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-primary text-xs font-weight-bold">
                                                    <?php echo intval($cantidad - ($sobrante*25)) . ' kg'; ?>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <?php echo $key['tipo_balanceado']; ?>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <a data-toggle="modal" data-target=".bd-example-modal-md<?php echo $key['id_balanceado'];
                                                                                                            echo $key['id_piscina'];  ?>"><i class="fas fa-align-justify text-danger"></i></a>
                                                </span>
                                            </td>
                                            <!-- Modal sugerenci -->
                                            <?php include 'modal-sugerencia-psc.php'; ?>

                                        <?php }  ?>
                                        </tr>
                                </tbody>
                            </table>
                            <form action="../controllers/confirmacion-entrega-balanceado-psc.php" method="POST">
                                <input type="hidden" name="fecha_entrega" value="<?php echo $f_e; ?>">
                                <input type="hidden" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>">
                                <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                                <center> <button type="submit" class="btn btn-sm mt-3" style="background:  #32c563 ;"> <i class="fas fa-check-square"></i> Aprobar </button></center>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 mt-5">

                    <div class="table table-sm table-responsive mb-4 mt-2">
                        <div class="scroll">
                            <table class="table table-sm table-bordered align-items-center mb-0">
                                <thead>
                                    <tr class="text-center">

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Precria
                                        </th>

                                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">
                                            Cant. en </br> Pre
                                        </th>

                                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">
                                            Cant. </br> solicitada
                                        </th>

                                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">
                                            Total a </br> entregar
                                        </th>

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Tipo </br> Balanceado
                                        </th>

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Sugerir</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id = 'Precria' AND fecha_entrega = (SELECT MAX(fecha_entrega) FROM solicitud_balanceados WHERE camaronera = '$camaronera'  AND id = 'Precria') ORDER BY id_piscina";

                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $key) {
                                    ?>
                                        <tr>

                                            <?php $f_ep = $key['fecha_entrega']; ?>
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <?php

                                                    if ($key['id_piscina'] == 31) {
                                                        echo '3A';
                                                    } else if ($key['id_piscina'] == 91) {
                                                        echo '9B';
                                                    } else {
                                                        echo $key['id_piscina'];
                                                    }
                                                    ?>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <?php if ($key['sobrante'] > 0) { ?>
                                                        <input type="text" class="text-center text-danger" value="<?php echo $sobrante2 = intval($key['sobrante']); ?>" style="border:none; width: 30px;" readonly>
                                                    <?php } else { ?>
                                                        <input type="text" class="text-center" value="<?php echo $sobrante2 = intval($key['sobrante']); ?>" style="border:none; width: 30px;" readonly>
                                                    <?php } ?>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $cantidad2 = intval($key['cantidad_balanceado']) . ' kg'; ?></span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="text" class="text-center text-primary" name="cantidad_balanceado[]" value="<?php echo intval($cantidad2 - $sobrante2) . ' kg'; ?>" style="border:none; width: 80px;" readonly>
                                                </span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $key['tipo_balanceado']; ?></span>
                                            </td>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <a data-toggle="modal" data-target=".bd-example-modal-md<?php echo $key['id_balanceado'];
                                                                                                            echo $key['id_piscina'];  ?>"><i class="fas fa-align-justify text-danger"></i></a>
                                                </span>
                                            </td>
                                            <!-- Modal sugerenci -->
                                            <?php include 'modal-sugerencia-pre.php'; ?>

                                        <?php } ?>

                                        </tr>


                                </tbody>
                            </table>
                            <form action="../controllers/confirmacion-entrega-balanceado-pre.php" method="POST">
                                <input type="hidden" name="fecha_entrega" value="<?php echo $f_ep; ?>">
                                <input type="hidden" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>">
                                <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                                <center> <button type="submit" class="btn btn-sm mt-3" style="background:  #32c563 ;"> <i class="fas fa-check-square"></i> Aprobar </button></center>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 mt-5">

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="alert text-center alert-dismissible fade show opacity-7 bg-danger" role="alert">
                                <strong class="text-white">Total de sacos</strong>
                            </div>

                            <ul class="list-group" style="margin-top: -12px;">
                                <?php
                                if (isset($_POST['buscar_alimento'])) {

                                    $consulta = $_POST['buscar_alimento'];
                                    $sqli = "SELECT DISTINCT tipo_balanceado FROM solicitud_balanceados WHERE fecha_entrega = '$consulta' AND camaronera = '$camaronera' AND fecha_entrega = '$f_e'";
                                    $data = $objeto->mostrar($sqli);
                                } else {

                                    $sqli = "SELECT DISTINCT tipo_balanceado FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND fecha_entrega = '$f_e'";
                                    $data = $objeto->mostrar($sqli);
                                }

                                foreach ($data as $value) {
                                ?>

                                    <li class="list-group-item d-flex justify-content-between align-items-center text-secondary text-xs font-weight-bold">
                                        <?php
                                        echo $tp = $value['tipo_balanceado'];
                                        ?>
                                        <span class="badge badge-primary badge-pill">
                                            <?php

                                            if (isset($_POST['buscar_alimento'])) {

                                                $consulta = $_POST['buscar_alimento'];
                                                $sqli = "SELECT SUM(cantidad_balanceado) AS suma FROM solicitud_balanceados WHERE tipo_balanceado = '$tp' AND fecha_entrega = '$consulta' AND camaronera = '$camaronera' AND fecha_entrega = '$f_e'";
                                                $data = $objeto->mostrar($sqli);
                                            } else {

                                                $sqli = "SELECT SUM(cantidad_balanceado) AS suma FROM solicitud_balanceados WHERE tipo_balanceado = '$tp' AND camaronera = '$camaronera' AND fecha_entrega = '$f_e'";
                                                $data = $objeto->mostrar($sqli);
                                            }

                                            foreach ($data as $x) {
                                                echo intval($x['suma'] / 25);
                                            } ?>
                                        </span>
                                    </li>

                                <?php } ?>

                            </ul>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- Modal sugerencia pre -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form action="../controllers/insert-sugerencia-alimento-pre.php" method="post">
                        <div class="form-row">

                            <?php

                            $objeto_tabla_camaronera = new corrida();
                            $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                            $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                            foreach ($data as $value) { ?>
                                <input type="hidden" class="form-control" name="camaronera" value="<?php echo $value['id_camaronera']; ?>">
                            <?php } ?>

                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Encargado</label>
                                <input type="text" class="form-control" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>" readonly style="background:none;">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Fecha</label>
                                <input type="text" class="form-control" name="fechaActual" value="<?php echo date('Y-m-d'); ?>" readonly style="background:none;">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Seleccione precria</label>
                                <select class="form-control" name="precria">

                                    <?php
                                    $sql_tabla_piscina = "SELECT DISTINCT id_precria FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_precria";
                                    $data = $objeto->mostrar($sql_tabla_piscina);
                                    foreach ($data as $value) { ?>
                                        <option value="<?php echo $value['id_precria']; ?>">
                                            <?php echo 'precria ' . $value['id_precria']; ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" value="0.0" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Tipo de alimento</label>
                                <select class="form-control" name="tipo_alimento">
                                    <?php

                                    $sqli = "SELECT DISTINCT tipo_balanceado FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND descripcion = 'Compra' ORDER BY tipo_balanceado ASC";
                                    $data = $objeto->mostrar($sqli);
                                    foreach ($data as $value) {
                                    ?>

                                        <option class="text-center" value="<?php echo $value['tipo_balanceado'] ?>">
                                            <?php echo $value['tipo_balanceado']; ?>
                                        </option>

                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar solicitud</button>
                </div>
                </form>
            </div>
        </div>
    </div>