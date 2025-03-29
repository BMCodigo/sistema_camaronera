<div class="row" style="margin: auto;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">ALIMENTACION DIARIA PISCINAS DE ENGORDE</h6>
            </div>
            <div class="card-body">
                <div class="dt-responsive">
                    <form onsubmit="return alim_engorde()" action="../controllers/insert-alimento-engorde.php" method="post">
                        <div class="row">
                            <label class="col-sm-6 col-lg-6 col-form-label">Camaronera</label>
                            <div class="col-sm-6 col-lg-6">
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

                            <label class="col-sm-6 col-lg-6 col-form-label">Fecha de alimentacion</label>
                            <div class="col-sm-6 col-lg-6">
                                <div class="input-group">
                                    
                                
                                   
                                       <input type="text" class="form-control" name="fechaActual" id="fechaActual" readonly style="background: none;">
                                   

                                
                                    <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">
                                </div>
                            </div>
                        </div>
                        <?php
                        #validar piscinas en proceso
                        $sql_proceso = "SELECT id_piscina, estado FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso'";
                        $data_proceso = $objeto_tabla_camaronera->mostrar($sql_proceso);

                        foreach ($data_proceso as $proceso) {
                            $psc_proceso = $proceso['id_piscina'];
                        }

                        ?>
                        <div class="table-responsive">

                            <table id="scr-vtr-dynamic" class="table table-bordered nowrap">
                                <thead>
                                    <tr class="text-white text-center">
                                        <th colspan="4" class="bg-dark">
                                            <span class="text-white"> ALIMENTACIÓN </span>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="background: #404e67; color:white;"># PS</th>
                                        <!--th style="background: #404e67; color:white;">Metodo Alim.</th-->
                                        <th style="background: #404e67; color:white;">Balanceado</th>
                                        <th style="background: #404e67; color:white;">Cantidad</th>
                                        <th style="background: #404e67; color:white;">Observacion </br> (no se alimenta)</th>
                                    </tr>
                                </thead>

                                <tbody class="fromtime" style="display:;">

                                    <!--piscina # 1 -->
                                    <tr class="text-center">

                                        <?php
                                        $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 1";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $x) {
                                            $ps = $x['id_piscina'];
                                        }

                                        ?>

                                        <?php if ($ps == 1) { ?>

                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p1 = 1; ?>">
                                                    <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p1' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto_camaronera->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="addUno" class="far fa-calendar-plus text-primary"></i>
                                                            
                                                            <select class="select" name="tipo_alimento[]">
                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                            </select>
                                                            
                                                            

                                                        </div>
                                                    </div>

                                                    <div class="mt-1 mb-1">
                                                        <div class="row" id="alimento_2_1">
                                                            <div>
                                                                <i id="deleteUno" class="fas fa-trash-alt text-danger"></i>
                                                                <select class="select" name="tipo_alimento_2[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_1" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </td>



                                        <?php } ?>

                                    </tr>

                                    <!--piscina # 2 -->
                                    <?php if ($camaronera != 1) { ?>

                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 2";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $ps = $x['id_piscina'];
                                            }

                                            ?>
                                            <?php if ($ps == 2) { ?>
                                                <td>
                                                    <div class="container">
                                                        <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p2 = 2; ?>">
                                                        <?php

                                                        $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p2' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                        $data = $objeto_camaronera->mostrar($sqli);
                                                        foreach ($data as $value) {
                                                        ?>

                                                            <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                        <?php } ?>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">

                                                        <div class="row">
                                                            <div>
                                                                <i id="addDos" class="far fa-calendar-plus text-primary"></i>
                                                                
                                                                <select class="select" name="tipo_alimento[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mt-1 mb-1">
                                                            <div class="row" id="alimento_2_2">
                                                                <div>
                                                                    <i id="deleteDos" class="fas fa-trash-alt text-danger"></i>
                                                                    <select class="select" name="tipo_alimento_2[]">
<?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                        <div class="">
                                                            <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_2" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                        </div>

                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                    <?php } ?>

                                    <!--piscina # 3 -->
                                    <tr class="text-center">
                                        <?php

                                        $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 3";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $x) {
                                            $ps = $x['id_piscina'];
                                        }

                                        ?>

                                        <?php if ($ps == 3) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p3 = 3; ?>">
                                                    <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p3' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto_camaronera->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="addTres" class="far fa-calendar-plus text-primary"></i>
                                                            
                                                            <select class="select" name="tipo_alimento[]">
                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-1 mb-1">
                                                        <div class="row" id="alimento_2_3">
                                                            <div>
                                                                <i id="deleteTres" class="fas fa-trash-alt text-danger"></i>
                                                                <select class="select" name="tipo_alimento_2[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_3" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </td>
                                        <?php } ?>
                                    </tr>

                                    <!--piscina # 4 -->
                                    <tr class="text-center">

                                        <?php

                                        $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 4";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $x) {
                                            $ps = $x['id_piscina'];
                                        }

                                        ?>

                                        <?php if ($ps == 4) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p4 = 4; ?>">
                                                    <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p4' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto_camaronera->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="addCuatro" class="far fa-calendar-plus text-primary"></i>
                                                            
                                                            <select class="select" name="tipo_alimento[]">
                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-1 mb-1">
                                                        <div class="row" id="alimento_2_4">
                                                            <div>
                                                                <i id="deleteCuatro" class="fas fa-trash-alt text-danger"></i>
                                                                <select class="select" name="tipo_alimento_2[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_4" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </td>
                                        <?php } ?>

                                    </tr>

                                    <!--piscina # 5 -->
                                    <tr class="text-center">
                                        <?php

                                        $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 5";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $x) {
                                            $ps = $x['id_piscina'];
                                        }

                                        ?>

                                        <?php if ($ps == 5) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p5 = 5; ?>">
                                                    <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p5' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto_camaronera->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="addCinco" class="far fa-calendar-plus text-primary"></i>
                                                            
                                                            <select class="select" name="tipo_alimento[]">
                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-1 mb-1">
                                                        <div class="row" id="alimento_2_5">
                                                            <div>
                                                                <i id="deleteCinco" class="fas fa-trash-alt text-danger"></i>
                                                                <select class="select" name="tipo_alimento_2[]">
                                                                   <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_5" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </td>
                                        <?php } ?>

                                    </tr>

                                    <!--piscina # 6 -->
                                    <tr class="text-center">
                                        <?php

                                        $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 6";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $x) {
                                            $ps = $x['id_piscina'];
                                        }

                                        ?>

                                        <?php if ($ps == 6) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p6 = 6; ?>">
                                                    <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p6' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto_camaronera->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="addSeis" class="far fa-calendar-plus text-primary"></i>
                                                           
                                                            <select class="select" name="tipo_alimento[]">
                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-1 mb-1">
                                                        <div class="row" id="alimento_2_6">
                                                            <div>
                                                                <i id="deleteSeis" class="fas fa-trash-alt text-danger"></i>
                                                                <select class="select" name="tipo_alimento_2[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_6" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </td>
                                        <?php } ?>

                                    </tr>

                                    <!--piscina # 7 -->
                                    <?php if ($camaronera != 3) { ?>

                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 7";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $ps = $x['id_piscina'];
                                            }

                                            ?>

                                            <?php if ($ps == 7) { ?>
                                                <td>
                                                    <div class="container">
                                                        <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p7 = 7; ?>">
                                                        <?php

                                                        $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p7' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                        $data = $objeto_camaronera->mostrar($sqli);
                                                        foreach ($data as $value) {
                                                        ?>

                                                            <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                        <?php } ?>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">

                                                        <div class="row">
                                                            <div>
                                                                <i id="addSiete" class="far fa-calendar-plus text-primary"></i>
                                                                
                                                                <select class="select" name="tipo_alimento[]">
                                                                   <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mt-1 mb-1">
                                                            <div class="row" id="alimento_2_7">
                                                                <div>
                                                                    <i id="deleteSiete" class="fas fa-trash-alt text-danger"></i>
                                                                    <select class="select" name="tipo_alimento_2[]">
                                                                        <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                        <div class="">
                                                            <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_7" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                        </div>

                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                    <?php } ?>

                                    <!--piscina # 8 -->
                                    <tr class="text-center">
                                        <?php

                                        $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 8";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $x) {
                                            $ps = $x['id_piscina'];
                                        }

                                        ?>

                                        <?php if ($ps == 8) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p8 = 8; ?>">
                                                    <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p8' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto_camaronera->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="addOcho" class="far fa-calendar-plus text-primary"></i>
                                                            
                                                            <select class="select" name="tipo_alimento[]">
                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-1 mb-1">
                                                        <div class="row" id="alimento_2_8">
                                                            <div>
                                                                <i id="deleteOcho" class="fas fa-trash-alt text-danger"></i>
                                                                <select class="select" name="tipo_alimento_2[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_8" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </td>
                                        <?php } ?>
                                    </tr>

                                    <!--piscina # 9 -->
                                    <?php if ($camaronera != 2) { ?>

                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 9";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $ps = $x['id_piscina'];
                                            }

                                            ?>

                                            <?php if ($ps == 9) { ?>
                                                <td>
                                                    <div class="container">
                                                        <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p9 = 9; ?>">
                                                        <?php

                                                        $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p9' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                        $data = $objeto_camaronera->mostrar($sqli);
                                                        foreach ($data as $value) {
                                                        ?>

                                                            <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                        <?php } ?>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">

                                                        <div class="row">
                                                            <div>
                                                                <i id="addNueve" class="far fa-calendar-plus text-primary"></i>
                                                                
                                                                <select class="select" name="tipo_alimento[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mt-1 mb-1">
                                                            <div class="row" id="alimento_2_9">
                                                                <div>
                                                                    <i id="deleteNueve" class="fas fa-trash-alt text-danger"></i>
                                                                    <select class="select" name="tipo_alimento_2[]">
                                                                        <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                        <div class="">
                                                            <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_9" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                        </div>

                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                    <?php } ?>

                                    <!--piscina # 10 -->
                                    <tr class="text-center">
                                        <?php

                                        $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 10";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $x) {
                                            $ps = $x['id_piscina'];
                                        }

                                        ?>

                                        <?php if ($ps == 10) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p10 = 10; ?>">
                                                    <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p10' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $data = $objeto_camaronera->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="addDiez" class="far fa-calendar-plus text-primary"></i>
                                                            
                                                            <select class="select" name="tipo_alimento[]">
                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="mt-1 mb-1">
                                                        <div class="row" id="alimento_2_10">
                                                            <div>
                                                                <i id="deleteDiez" class="fas fa-trash-alt text-danger"></i>
                                                                <select class="select" name="tipo_alimento_2[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_10" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </td>
                                        <?php } ?>
                                    </tr>

                                    <?php if ($camaronera != 3) { ?>

                                        <!--piscina # 11 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 11";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $ps = $x['id_piscina'];
                                            }

                                            ?>

                                            <?php if ($ps == 11) { ?>
                                                <td>
                                                    <div class="container">
                                                        <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p11 = 11; ?>">
                                                        <?php

                                                        $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p11' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                        $data = $objeto_camaronera->mostrar($sqli);
                                                        foreach ($data as $value) {
                                                        ?>

                                                            <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                        <?php } ?>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">

                                                        <div class="row">
                                                            <div>
                                                                <i id="addOnce" class="far fa-calendar-plus text-primary"></i>
                                                                
                                                                <select class="select" name="tipo_alimento[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mt-1 mb-1">
                                                            <div class="row" id="alimento_2_11">
                                                                <div>
                                                                    <i id="deleteOnce" class="fas fa-trash-alt text-danger"></i>
                                                                    <select class="select" name="tipo_alimento_2[]">
                                                                        <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                        <div class="">
                                                            <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_11" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                        </div>

                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                        <!--piscina # 12 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 12";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $ps = $x['id_piscina'];
                                            }

                                            ?>

                                            <?php if ($ps == 12) { ?>
                                                <td>
                                                    <div class="container">
                                                        <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p12 = 12; ?>">
                                                        <?php

                                                        $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p12' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                        $data = $objeto_camaronera->mostrar($sqli);
                                                        foreach ($data as $value) {
                                                        ?>

                                                            <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                        <?php } ?>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">

                                                        <div class="row">
                                                            <div>
                                                                <i id="addDoce" class="far fa-calendar-plus text-primary"></i>
                                                               
                                                                <select class="select" name="tipo_alimento[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mt-1 mb-1">
                                                            <div class="row" id="alimento_2_12">
                                                                <div>
                                                                    <i id="deleteDoce" class="fas fa-trash-alt text-danger"></i>
                                                                    <select class="select" name="tipo_alimento_2[]">
                                                                        <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                        <div class="">
                                                            <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_12" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                        </div>

                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                        <?php if ($camaronera != 1) { ?>

                                            <!--piscina # 13 -->
                                            <tr class="text-center">
                                                <?php

                                                $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 13";
                                                $data = $objeto->mostrar($sql);

                                                foreach ($data as $x) {
                                                    $ps = $x['id_piscina'];
                                                }

                                                ?>

                                                <?php if ($ps == 13) { ?>
                                                    <td>
                                                        <div class="container">
                                                            <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p13 = 13; ?>">
                                                            <?php

                                                            $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p13' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                            $data = $objeto_camaronera->mostrar($sqli);
                                                            foreach ($data as $value) {
                                                            ?>

                                                                <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                            <?php } ?>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="container">

                                                            <div class="row">
                                                                <div>
                                                                    <i id="addTrece" class="far fa-calendar-plus text-primary"></i>
                                                                    
                                                                    <select class="select" name="tipo_alimento[]">
                                                                        <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mt-1 mb-1">
                                                                <div class="row" id="alimento_2_13">
                                                                    <div>
                                                                        <i id="deleteTrece" class="fas fa-trash-alt text-danger"></i>
                                                                        <select class="select" name="tipo_alimento_2[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="container">
                                                            <div class=>
                                                                <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                            </div>
                                                            <div class="">
                                                                <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_13" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="container">
                                                            <div class=>
                                                                <select class="select" class="select" name="observacion[]" id="observacion">
                                                                    <option class="text-center" value="S/N">Sin novedad</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tr>

                                            <!--piscina # 14 -->
                                            <tr class="text-center">
                                                <?php

                                                $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 14";
                                                $data = $objeto->mostrar($sql);

                                                foreach ($data as $x) {
                                                    $ps = $x['id_piscina'];
                                                }

                                                ?>

                                                <?php if ($ps == 14) { ?>
                                                    <td>
                                                        <div class="container">
                                                            <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p14 = 14; ?>">
                                                            <?php

                                                            $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p14' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                            $data = $objeto_camaronera->mostrar($sqli);
                                                            foreach ($data as $value) {
                                                            ?>

                                                                <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                            <?php } ?>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="container">

                                                            <div class="row">
                                                                <div>
                                                                    <i id="addCatorce" class="far fa-calendar-plus text-primary"></i>
                                                                    
                                                                    <select class="select" name="tipo_alimento[]">
                                                                        <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="mt-1 mb-1">
                                                                <div class="row" id="alimento_2_14">
                                                                    <div>
                                                                        <i id="deleteCatorce" class="fas fa-trash-alt text-danger"></i>
                                                                        <select class="select" name="tipo_alimento_2[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="container">
                                                            <div class=>
                                                                <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                            </div>
                                                            <div class="">
                                                                <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_14" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="container">
                                                            <div class=>
                                                                <select class="select" class="select" name="observacion[]" id="observacion">
                                                                    <option class="text-center" value="S/N">Sin novedad</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                    <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tr>

                                            <?php if ($camaronera == 4 || $camaronera == 2) { ?>

                                                <!--piscina # 15 -->
                                                <tr class="text-center">
                                                    <?php

                                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 15";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $x) {
                                                        $ps = $x['id_piscina'];
                                                    }

                                                    ?>

                                                    <?php if ($ps == 15) { ?>
                                                        <td>
                                                            <div class="container">
                                                                <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p15 = 15; ?>">
                                                                <?php

                                                                $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p15' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                                $data = $objeto_camaronera->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>

                                                                    <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                                <?php } ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">

                                                                <div class="row">
                                                                    <div>
                                                                        <i id="addQuince" class="far fa-calendar-plus text-primary"></i>
                                                                        
                                                                        <select class="select" name="tipo_alimento[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-1 mb-1">
                                                                    <div class="row" id="alimento_2_15">
                                                                        <div>
                                                                            <i id="deleteQuince" class="fas fa-trash-alt text-danger"></i>
                                                                            <select class="select" name="tipo_alimento_2[]">
                                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_15" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <select class="select" class="select" name="observacion[]" id="observacion">
                                                                        <option class="text-center" value="S/N">Sin novedad</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>

                                                <!--piscina # 16 -->
                                                <tr class="text-center">
                                                    <?php

                                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 16";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $x) {
                                                        $ps = $x['id_piscina'];
                                                    }

                                                    ?>

                                                    <?php if ($ps == 16) { ?>
                                                        <td>
                                                            <div class="container">
                                                                <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p16 = 16; ?>">
                                                                <?php

                                                                $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p16' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                                $data = $objeto_camaronera->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>

                                                                    <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                                <?php } ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">

                                                                <div class="row">
                                                                    <div>
                                                                        <i id="addDieciseis" class="far fa-calendar-plus text-primary"></i>
                                                                        
                                                                        <select class="select" name="tipo_alimento[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-1 mb-1">
                                                                    <div class="row" id="alimento_2_16">
                                                                        <div>
                                                                            <i id="deleteDieciseis" class="fas fa-trash-alt text-danger"></i>
                                                                            <select class="select" name="tipo_alimento_2[]">
                                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_16" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <select class="select" class="select" name="observacion[]" id="observacion">
                                                                        <option class="text-center" value="S/N">Sin novedad</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    <?php } ?>
                                                </tr>

                                                <!--piscina # 17a -->
                                                <tr class="text-center">
                                                    <?php

                                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 17";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $x) {
                                                        $ps = $x['id_piscina'];
                                                    }

                                                    ?>

                                                    <?php if ($ps == 17) { ?>
                                                        <td>
                                                            <div class="container">
                                                                <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p17 = 17; ?>">
                                                                <?php

                                                                $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p17' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                                $data = $objeto_camaronera->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>

                                                                    <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                                <?php } ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">

                                                                <div class="row">
                                                                    <div>
                                                                        <i id="addDiescisite" class="far fa-calendar-plus text-primary"></i>
                                                                        
                                                                        <select class="select" name="tipo_alimento[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-1 mb-1">
                                                                    <div class="row" id="alimento_2_17">
                                                                        <div>
                                                                            <i id="deleteDiecisiete" class="fas fa-trash-alt text-danger"></i>
                                                                            <select class="select" name="tipo_alimento_2[]">
                                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_17" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <select class="select" class="select" name="observacion[]" id="observacion">
                                                                        <option class="text-center" value="S/N">Sin novedad</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>
                                                
                                                <!--piscina # 17b -->
                                                <tr class="text-center">
                                                    <?php

                                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 22";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $x) {
                                                        $ps = $x['id_piscina'];
                                                    }

                                                    ?>

                                                    <?php if ($ps == 22) { ?>
                                                        <td>
                                                            <div class="container">
                                                                <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php  $p22 = 22; if($p22 == 22){ echo '17B';}?>">
                                                                <?php

                                                                $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p22' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                                $data = $objeto_camaronera->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>

                                                                    <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                                <?php } ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">

                                                                <div class="row">
                                                                    <div>
                                                                        <i id="addDiescisiteb" class="far fa-calendar-plus text-primary"></i>
                                                                        
                                                                        <select class="select" name="tipo_alimento[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-1 mb-1">
                                                                    <div class="row" id="alimento_2_171">
                                                                        <div>
                                                                            <i id="deleteDiecisieteb" class="fas fa-trash-alt text-danger"></i>
                                                                            <select class="select" name="tipo_alimento_2[]">
                                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_171" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <select class="select" class="select" name="observacion[]" id="observacion">
                                                                        <option class="text-center" value="S/N">Sin novedad</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>

                                                <!--piscina # 18 -->
                                                <tr class="text-center">
                                                    <?php

                                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 18";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $x) {
                                                        $ps = $x['id_piscina'];
                                                    }

                                                    ?>

                                                    <?php if ($ps == 18) { ?>
                                                        <td>
                                                            <div class="container">
                                                                <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p18 = 18; ?>">
                                                                <?php

                                                                $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p18' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                                $data = $objeto_camaronera->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>

                                                                    <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                                <?php } ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">

                                                                <div class="row">
                                                                    <div>
                                                                        <i id="addDieciocho" class="far fa-calendar-plus text-primary"></i>
                                                                        
                                                                        <select class="select" name="tipo_alimento[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-1 mb-1">
                                                                    <div class="row" id="alimento_2_18">
                                                                        <div>
                                                                            <i id="deleteDieciocho" class="fas fa-trash-alt text-danger"></i>
                                                                            <select class="select" name="tipo_alimento_2[]">
                                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_18" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <select class="select" class="select" name="observacion[]" id="observacion">
                                                                        <option class="text-center" value="S/N">Sin novedad</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>

                                                <!--piscina # 19 -->
                                                <tr class="text-center">
                                                    <?php

                                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 19";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $x) {
                                                        $ps = $x['id_piscina'];
                                                    }

                                                    ?>

                                                    <?php if ($ps == 19) { ?>
                                                        <td>
                                                            <div class="container">
                                                                <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p19 = 19; ?>">
                                                                <?php

                                                                $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p19' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                                $data = $objeto_camaronera->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>

                                                                    <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                                <?php } ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">

                                                                <div class="row">
                                                                    <div>
                                                                        <i id="addDiecinueve" class="far fa-calendar-plus text-primary"></i>
                                                                        
                                                                        <select class="select" name="tipo_alimento[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-1 mb-1">
                                                                    <div class="row" id="alimento_2_19">
                                                                        <div>
                                                                            <i id="deleteDiecinueve" class="fas fa-trash-alt text-danger"></i>
                                                                            <select class="select" name="tipo_alimento_2[]">
                                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_19" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <select class="select" class="select" name="observacion[]" id="observacion">
                                                                        <option class="text-center" value="S/N">Sin novedad</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>

                                                <!--piscina # 20 -->
                                                <tr class="text-center">
                                                    <?php

                                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 20";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $x) {
                                                        $ps = $x['id_piscina'];
                                                    }

                                                    ?>

                                                    <?php if ($ps == 20) { ?>
                                                        <td>
                                                            <div class="container">
                                                                <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p20 = 20; ?>">
                                                                <?php

                                                                $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p20' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                                $data = $objeto_camaronera->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>

                                                                    <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                                <?php } ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">

                                                                <div class="row">
                                                                    <div>
                                                                        <i id="addVeinte" class="far fa-calendar-plus text-primary"></i>
                                                                        
                                                                        <select class="select" name="tipo_alimento[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-1 mb-1">
                                                                    <div class="row" id="alimento_2_20">
                                                                        <div>
                                                                            <i id="deleteVeinte" class="fas fa-trash-alt text-danger"></i>
                                                                            <select class="select" name="tipo_alimento_2[]">
                                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_20" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <select class="select" class="select" name="observacion[]" id="observacion">
                                                                        <option class="text-center" value="S/N">Sin novedad</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>

                                                <!--piscina # 21 -->
                                                <tr class="text-center">
                                                    <?php

                                                    $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 21";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $x) {
                                                        $ps = $x['id_piscina'];
                                                    }

                                                    ?>

                                                    <?php if ($ps == 21) { ?>
                                                        <td>
                                                            <div class="container">
                                                                <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p21 = 21; ?>">
                                                                <?php

                                                                $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p21' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                                $data = $objeto_camaronera->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>

                                                                    <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                                <?php } ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">

                                                                <div class="row">
                                                                    <div>
                                                                        <i id="addVeintiuno" class="far fa-calendar-plus text-primary"></i>
                                                                        
                                                                        <select class="select" name="tipo_alimento[]">
                                                                            <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="mt-1 mb-1">
                                                                    <div class="row" id="alimento_2_21">
                                                                        <div>
                                                                            <i id="deleteVeintiuno" class="fas fa-trash-alt text-danger"></i>
                                                                            <select class="select" name="tipo_alimento_2[]">
                                                                                <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                                <div class="">
                                                                    <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_21" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="container">
                                                                <div class=>
                                                                    <select class="select" class="select" name="observacion[]" id="observacion">
                                                                        <option class="text-center" value="S/N">Sin novedad</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                                        <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </td>
                                                    <?php } ?>

                                                </tr>

                                    <?php }
                                        }
                                    } ?>
                                </tbody>
                            </table>

                        </div>
                        <center><button class="btn btn-danger btn-sm text-light mt-1" name="engorde" id="add-form-foot" type="submit">guardar datos de alimentacion</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function alim_engorde() {

        var smspre = confirm("¿ Esta seguro que desea finalizar ?");
        if (smspre) {
            return true;
        } else {
            return false;
        }
    }
</script>