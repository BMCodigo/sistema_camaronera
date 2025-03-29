<?php
$objeto = new corrida();
date_default_timezone_set("America/Lima");
$fecha = date('Y-m-d');
?>



<div class="card">

    <div class="card-header text-center" style="background: #404e67;">
            <h6 class="text-white" style="margin:auto;text-align:center">INGRESO BALANCEADO A BODEGA</h6>
     <!--   <ul class="time-horizontal nav justify-content-center">
            <li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li>
            <li><b><a class="nav-link text-white " href="index.php?page=Ingreso"><i class="fas fa-copy text-info"></i> Ingresos de AABB </a></b></li>
            <li><b><a class="nav-link text-white " href="index.php?page=Aprobacion-solicitud"><i class="fas fa-minus-circle text-warning"></i> Aprobacion de solicitud </a></b></li>
            <li><b><a class="nav-link text-white " href="index.php?page=Ingreso"><i class="fas fa-cogs text-danger"></i> Ajuste de kardex </a></b></li>
        </ul>-->

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-6">
                <div class="mb-20">
                    <form onsubmit="return kardex()" class="container mt-3" action="../controllers/insert-ingreso-balanceado.php" method="post">

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <?php

                                    $sqli = "SELECT DISTINCT id_camaronera FROM registro_piscina_engorde WHERE estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                    $data = $objeto->mostrar($sqli);

                                    ?>
                                    <select class="form-control" name="camaronera" id="camaronera">
                                        <?php

                                        foreach ($data as $value) {

                                        ?>
                                            <option value="<?php echo $aux = $value['id_camaronera']; ?>">

                                                <?php

                                                $sqli_camaronera = "SELECT DISTINCT descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                                $data_camaronera = $objeto->mostrar($sqli_camaronera);

                                                foreach ($data_camaronera as $value) {

                                                ?>
                                                    <?php echo $value['descripcion_camaronera']; ?></option>

                                    <?php }
                                            } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Fecha de ingreso</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="datetime" class="form-control" name="fechaActualModal" id="fechaActual" readonly style="background: none;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Seleccione tipo de balanceado</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="tipo_balanceado" id="tipo_balanceado">
                                        <?php

                                        $objeto = new corrida();
                                        $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $value) {
                                        ?>
                                            <option value="<?php echo $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento']; ?>">
                                                <?php echo $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento']; ?>
                                            </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Cantidad de sascos</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" step="any" class="form-control" id="cantidad_animales" name="cantidad_balanceado" value="100">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Concepto</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="estado" id="estado">
                                        <option value="Compra">por Compra</option>
                                        <option value="Ajuste">por Ajuste</option>
                                    </select>
                                    <input type="hidden" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>">
                                    <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                                    <input type="hidden" class="form-control mb-3 text-center" name="fechaActual" value="<?php echo $fecha; ?>" readonly style="border: none; background:none;" value="<?php echo $fecha; ?>">

                                </div>
                            </div>
                        </div>
                        <center><button class="btn btn-danger btn-sm text-light mt-3" id="add-form-kardex" type="submit">Registar datos</button></center>
                    </form>
                </div>
            </div>

            <div class="col-6">
                <div class="table table-sm table-responsive mb-4 mt-2">
                    <div class="scroll"><b>
    Ultimas 15 compras</b>
                        <table class="table table-sm table-hover table-bordered table-striped  align-items-center mb-0">
                        
                            <thead>
                                <tr class="text-center">

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Fecha de ingreso
                                    </th>

                                    <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Balanceado</th>

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cantidad
                                    </th>

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Concepto</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $sql = "SELECT * FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND ( descripcion = 'Compra' OR descripcion = 'Ajuste' ) ORDER BY fecha_ingreso DESC LIMIT 15";

                                $data = $objeto->mostrar($sql);

                                foreach ($data as $key) {
                                ?>
                                    <tr>

                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $key['fecha_ingreso']; ?></span>
                                        </td>

                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $key['tipo_balanceado']?></span>
                                        </td>

                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo intval($key['cantidad_balanceado']). ' sacos'; ?></span>
                                        </td>

                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $key['descripcion']; ?></span>
                                        </td>


                                        

                                    <?php } ?>

                                    </tr>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>


    </div>

</div>

</center>


<script>
    function kardex() {

        var smspre = confirm("��� Esta seguro que desea finalizar ?");
        if (smspre) {
            return true;
        } else {
            return false;
        }
    }
</script>
<script type="text/javascript">
    $(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
});
        document.oncontextmenu = function(){return false;}
</script>