<?php 
// Establecer la zona horaria a Ecuador
date_default_timezone_set('America/Guayaquil');

// Obtener la fecha actual en formato deseado
$fecha_actual = date('Y-m-d');

?>
<div class="row" style="margin: auto;">

    <div class="col-md-4">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">PESO INTERMEDIO-MIERCOLES</h6>
            </div>
            <div class="card-body" style="margin:auto">
                <div class="mb-20">
                    <form class="container" onsubmit="return intermedio()" action="../controllers/insert-peso.php"
                        method="post">

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="camaronera" id="camaronera">
                                        <?php

                                        $objeto_tabla_camaronera = new corrida();
                                        $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                        foreach ($data as $value) {
                                        ?>
                                        <option value="<?php echo $value['id_camaronera']; ?>">
                                            <?php echo $value['descripcion_camaronera']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Fecha de peso</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fechaActual"
                                        id="fechaActualpoblacional" readonly style="background: none;">
                                </div>
                            </div>
                        </div>

                        <table class="table table-sm table-hover mt-2 table-bordered" style="margin-top:-15px;">
                            <thead class=" alert-dark opacity-8">
                                <tr class="text-center">
                                    <th class="text-white" style="background: #404e67;">
                                        N° Piscina
                                    </th>
                                    <th class="text-white" style="background: #404e67;">
                                        Peso </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 1";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 1) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static text-center">

                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p1 = 1; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p1' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_1" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 2";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 2) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static text-center">

                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p2 = 2; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p2' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_2" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 3";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 3) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static text-center">

                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p3 = 3; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p3' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_3" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 4";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 4) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p4 = 4; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p4' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_4" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>

                                </tr>

                                <tr class="text-center">

                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 5";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 5) {

                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p5 = 5; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p5' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";

                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_5" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>

                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 6";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 6) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p6 = 6; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p6' AND estado LIKE 'En proceso'AND id_camaronera = '$camaronera'";

                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_6" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 7";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 7) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p7 = 7; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p7' AND estado LIKE 'En proceso'AND id_camaronera = '$camaronera'";

                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_7" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 8";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 8) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p8 = 8; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p8' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_8" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 9";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 9) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p9 = 9; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p9' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_9" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 10";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 10) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p10 = 10; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p10' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_10" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 11";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 11) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p11 = 11; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p11' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_11" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 12";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 12) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p12 = 12; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p12' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_12" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 13";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 13) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p13 = 13; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p13' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_13" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' AND id_piscina = '14'";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 14) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p14 = 14; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p14' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_14" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 15";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 15) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p15 = 15; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p15' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_15" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 16";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 16) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p16 = 16; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p16' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_16" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 17";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 17) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p17 = 17; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p17' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_17" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 22";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 22) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any"
                                                    value="<?php  $p22 = 22; if($camaronera == 2){ if($p22 == 22){ echo '17B'; } }else{ echo $ps;} ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p22' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_64" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>



                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 18";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 18) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p18 = 18; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p18' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_18" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 19";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 19) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p19 = 19; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p19' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_19" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 20";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 20) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p20 = 20; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p20' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_20" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 21";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 21) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p21 = 21; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p21' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_21" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 23";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 23) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any"
                                                    value="<?php $p23 = 23; echo $ps; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p23' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_23" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 24";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 24) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any"
                                                    value="<?php $p24 = 24; echo $ps; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p24' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_24" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>
                                
                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 25";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }
                                    if ($ps == 25) {
                                    ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any"
                                                    value="<?php $p25 = 25;  echo $ps; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p25' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_25" step="any" value="0.0">

                                            </div>
                                        </div>
                                    </td>
                                    <?php } ?>
                                </tr>

                                <input type="hidden" name="user" value="<?php echo $id_usuario; ?>">

                            </tbody>
                        </table>
                        <center><button class="btn btn-danger btn-sm text-light mt-1" id="add-peso-intermedi"
                                type="submit">guardar datos de peso intermedio</button></center>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">MUESTREO SAMANAL - DOMINGO</h6>
            </div>
            <div class="card-body" style="margin:auto">
                <div class="mb-20">
                    <form class="container" onsubmit="return muestreo()" action="../controllers/insert-muestreo.php"
                        method="post">

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                            <div class="col-sm-6 col-lg-6">
                                <div class="input-group">
                                    <select class="form-control" name="camaronera" id="camaronera">
                                        <?php

                                        $objeto_tabla_camaronera = new corrida();
                                        $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                        foreach ($data as $value) {
                                        ?>
                                        <option value="<?php echo $aux = $value['id_camaronera']; ?>">
                                            <?php echo $value['descripcion_camaronera']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Fecha</label>
                            <div class="col-sm-6 col-lg-6">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fechaActual" id="fechaActualmuestreo"
                                        readonly style="background: none;">
                                </div>
                            </div>
                        </div>

                        <!--p class="form-alert" id="nombre-form-alert" style="display:none;color:red;">Ingrese un nombre valido</p-->


                        <table class="table table-sm table-hover mt-2 table-bordered"
                            style="margin-top:-15px; margin-left: -31px; width:290px">
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert"
                                id="nombre-form-alert" style="display: none;">
                                <strong> Ingrese desidad valida </strong>
                            </div>
                            <thead class=" alert-dark opacity-8">
                                <tr class="text-center">
                                    <th class="text-white" width="300px" style="background: #404e67;">
                                        N° Piscina</th>
                                    <th class="text-white" width="300px" style="background: #404e67;">
                                        Peso</th>
                                    <th colspan="1" class="text-white" style="background: #404e67;">
                                        Desidad
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr class="text-center">

                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 1";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 1) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p1 = 1; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p1' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>

                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_1" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_1" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 2";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 2) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p2 = 2; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p2' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_2" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_2" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>

                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 3";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 3) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p3 = 3; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p3' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_3" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_3" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>

                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 4";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 4) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p4 = 4; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p4' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_4" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_4" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 5";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 5) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p5 = 5; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p5' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_5" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_5" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 6";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 6) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p6 = 6; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p6' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_6" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_6" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 7";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 7) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p7 = 7; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p7' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_7" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_7" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 8";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 8) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p8 = 8; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p8' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_8" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_8" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 9";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 9) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p9 = 9; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p9' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_9" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_9" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 10";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 10) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p10 = 10; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p10' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_10" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_10" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 11";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 11) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p11 = 11; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p11' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_11" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_11" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 12";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 12) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p12 = 12; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p12' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_12" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_12" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 13";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 13) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p13 = 13; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p13' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_13" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_13" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = '14'";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 14) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p14 = 14; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p14' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_14" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_14" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 15";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 15) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p15 = 15; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p15' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_15" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_15" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 16";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 16) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p16 = 16; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p16' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_16" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_16" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 17";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 17) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p17 = 17; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p17' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_17" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_17" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 22";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 22) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any"
                                                    value="<?php  $p22 = 22; if($camaronera == 2){ if($p22 == 22){ echo '17B'; } }else{ echo $ps;} ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p22' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_64" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_64" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 18";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 18) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p18 = 18; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p18' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_18" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_18" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 19";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 19) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p19 = 19; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p19' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_19" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_19" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 20";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 20) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p20 = 20; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p20' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_20" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_20" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 21";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 21) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php echo $p21 = 21; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p21' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_21" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_21" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 23";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 23) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any" value="<?php $p23 = 23;  echo $ps; ?>">
                                                    
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p23' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_23" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_23" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>

                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 24";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 24) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any"
                                                    value="<?php $p24 = 24; echo $ps; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p24' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_24" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_24" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>
                                
                                <tr class="text-center">
                                    <?php
                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 25";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) {
                                        $ps = $x['id_piscina'];
                                    }

                                    if ($ps == 25) { ?>
                                    <td>
                                        <div class="container d-flex flex-column justify-content-center">
                                            <div class="input-group input-group-static ">
                                                <input type="text" class="inputs text-center" name="piscina[]"
                                                    id="piscina" readonly step="any"
                                                    value="<?php $p25 = 25;  echo $ps; ?>">
                                                <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p25' AND estado LIKE 'En proceso' AND id_camaronera = '$aux'";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                <input type="hidden" name="corrida[]"
                                                    value="<?php echo $value['id_corrida']; ?>">

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" min="0" max="40" class="inputs text-center"
                                                    name="peso[]" id="peso_25" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="densidad[]"
                                                    id="densidad_25" step="any" value="0.0">
                                            </div>
                                        </div>
                                    </td>

                                    <?php } ?>
                                </tr>
                                
                                

                                <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">

                            </tbody>

                        </table>
                        <center><button class="btn btn-danger btn-sm text-light mt-1" id="add-mueste"
                                type="submit">guardar datos de peso domingo</button></center>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">ESTIMACION DE LARVA</h6>
            </div>
            <div class="card-body" style="margin:auto">
                <div class="mb-20">
                    <form class="container" onsubmit="return muestreo()"
                        action="../controllers/insert-larva-estimado.php" method="post">

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="camaronera" id="camaronera">
                                        <?php

                                        $objeto_tabla_camaronera = new corrida();
                                        $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                        foreach ($data as $value) {
                                        ?>
                                        <option value="<?php echo $aux = $value['id_camaronera']; ?>">
                                            <?php echo $value['descripcion_camaronera']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Fecha</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fechaActual" readonly
                                        style="background: none;" value="<?php echo $fecha_actual; ?>">
                                </div>
                            </div>
                        </div>

                        <!--p class="form-alert" id="nombre-form-alert" style="display:none;color:red;">Ingrese un nombre valido</p-->


                        <table class="table table-sm table-hover mt-2 table-bordered"
                            style="margin-top:-15px; width:50px">
                            <div class="alert alert-danger alert-dismissible fade show text-center" role="alert"
                                id="nombre-form-alert" style="display: none;">
                                <strong> Ingrese densidad valida </strong>
                            </div>
                            <thead class=" alert-dark opacity-8">
                                <tr class="text-center">
                                    <th class="text-white" width="300px" style="background: #404e67;">
                                        N° Precria</th>
                                    <th colspan="1" class="text-white" style="background: #404e67;">
                                        Estimacion
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                <tr class="text-center">

                                    <?php
                                    $sql = "SELECT id_precria, secuencial FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso'";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $x) { ?>
                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" readonly step="any"
                                                    name="precria[]" id="precria" step="any"
                                                    value="<?php echo $x['id_precria'] ?>">
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="container">
                                            <div class="input-group input-group-static d-flex justify-content-center">
                                                <input type="number" class="inputdens text-center" name="estimado[]"
                                                    id="estimado" step="any" value="0.0">
                                                <input type="hidden" name="secuencial[]"
                                                    value="<?php echo $x['secuencial']; ?>">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tr>
                                <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">
                            </tbody>

                        </table>
                        <center><button class="btn btn-danger btn-sm text-light mt-1" id="add-mueste"
                                type="submit">guardar datos de estimacion</button></center>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<script>
function muestreo() {

    var smspre = confirm("¿ Esta seguro que desea finalizar ?");
    if (smspre) {
        return true;
    } else {
        return false;
    }
}

function intermedio() {

    var smspre = confirm("¿ Esta seguro que desea finalizar ?");
    if (smspre) {
        return true;
    } else {
        return false;
    }
}


$(document).ready(function() {

    var densidad1;
    var densidad2;
    var densidad3;
    var densidad4;
    var densidad5;
    var densidad6;
    var densidad7;
    var densidad8;
    var densidad9;
    var densidad10;
    var densidad11;
    var densidad12;
    var densidad13;
    var densidad14;
    var densidad15;
    var densidad16;
    var densidad17;
    var densidad18;
    var densidad19;
    var densidad20;
    var densidad21;

    $("#densidad_1").keyup(function() {
        densidad1 = $("#densidad_1").val();
        if (densidad1.length < 5 || densidad1.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_2").keyup(function() {
        densidad2 = $("#densidad_2").val();
        if (densidad2.length < 5 || densidad2.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_3").keyup(function() {
        densidad3 = $("#densidad_3").val();
        if (densidad3.length < 5 || densidad3.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_4").keyup(function() {
        densidad4 = $("#densidad_4").val();
        if (densidad4.length < 5 || densidad4.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_5").keyup(function() {
        densidad5 = $("#densidad_5").val();
        if (densidad5.length < 5 || densidad5.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_6").keyup(function() {
        densidad6 = $("#densidad_6").val();
        if (densidad6.length < 5 || densidad6.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_7").keyup(function() {
        densidad7 = $("#densidad_7").val();
        if (densidad7.length < 5 || densidad7.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_8").keyup(function() {
        densidad8 = $("#densidad_8").val();
        if (densidad8.length < 5 || densidad8.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_9").keyup(function() {
        densidad9 = $("#densidad_9").val();
        if (densidad9.length < 5 || densidad9.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_10").keyup(function() {
        densidad10 = $("#densidad_10").val();
        if (densidad10.length < 5 || densidad10.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_11").keyup(function() {
        densidad11 = $("#densidad_11").val();
        if (densidad11.length < 5 || densidad11.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_12").keyup(function() {
        densidad12 = $("#densidad_12").val();
        if (densidad12.length < 5 || densidad12.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_13").keyup(function() {
        densidad13 = $("#densidad_13").val();
        if (densidad13.length < 5 || densidad13.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_14").keyup(function() {
        densidad14 = $("#densidad_14").val();
        if (densidad14.length < 5 || densidad14.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_15").keyup(function() {
        densidad15 = $("#densidad_15").val();
        if (densidad15.length < 5 || densidad15.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_16").keyup(function() {
        densidad16 = $("#densidad_16").val();
        if (densidad16.length < 5 || densidad16.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_17").keyup(function() {
        densidad17 = $("#densidad_17").val();
        if (densidad17.length < 5 || densidad17.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_18").keyup(function() {
        densidad18 = $("#densidad_18").val();
        if (densidad18.length < 5 || densidad18.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_19").keyup(function() {
        densidad19 = $("#densidad_19").val();
        if (densidad19.length < 5 || densidad19.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_20").keyup(function() {
        densidad20 = $("#densidad_20").val();
        if (densidad20.length < 5 || densidad20.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

    $("#densidad_21").keyup(function() {
        densidad21 = $("#densidad_21").val();
        if (densidad21.length < 5 || densidad21.length > 6) {
            $("#nombre-form-alert").css("display", "block");
        } else {
            $("#nombre-form-alert").css("display", "none");
        }
    });

});
</script>