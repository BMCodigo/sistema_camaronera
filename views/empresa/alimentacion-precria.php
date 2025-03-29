<div class="row" style="margin: auto;">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">ALIMENTACION DIARIA DE PRECRIAS</h6>
            </div>
            <div class="card-body">
                <div class="dt-responsive">
                    <form onsubmit="return alim_precria()" action="../controllers/insert-alimento-precria.php" method="post">
                        <div class="row">
                            <label class="col-sm-2 col-lg-6 col-form-label">Camaronera</label>
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
                                    
                       
                                  
                                      <input type="text" class="form-control" name="fechaActual" id="fechaActualpre" readonly style="background: none;">
                                   
                                    
                                   
                                    <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="scr-vtr-dynamic" class="table table-bordered nowrap">
                                <thead>
                                    <tr class="text-white text-center">
                                        <th colspan="4" class="bg-dark">
                                            <span class=" text-white"> ALIMENTACIÓN </span>
                                        </th>
                                    </tr>
                                     <tr class="text-center">
                                        <th style="background: #404e67; color:white;"># PS</th>
                                        <!--th style="background: #404e67; color:white;">Metodo Alim.</th-->
                                        <th style="background: #404e67; color:white;">Balanceado</th>
                                        <th style="background: #404e67; color:white;">Cantidad</th>
                                       
                                    </tr>
                                </thead>
                                <tbody class="fromtime">

                                    <?php if ($camaronera != 3 && $camaronera != 1) { ?>

                                        <!-- precria #1  -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 1";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 1) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p1 = 1; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_uno" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_1">

                                                            <div>
                                                                <i id="delete_pre_2_1" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_1" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td> 
                                            
                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p1' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>" >

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo $precria['identificacion'];  ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                    <?php } ?>

                                    <!--?php if ($camaronera != 4) { ?-->

                                        <!-- precria #2 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 2";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 2) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p2 = 2; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_dos" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_2">

                                                            <div>
                                                                <i id="delete_pre_2_2" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_2" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p2' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                    <!--?php } ?-->

                                    <?php if ($camaronera != 1) { ?>
                                    <?php if ($camaronera == 2 || $camaronera == 5) { ?>

                                        <!-- precria #3 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 3";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 3) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p3 = 3; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_tres" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_3">

                                                            <div>
                                                                <i id="delete_pre_2_3" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_3" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">
                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p3' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                    <?php } ?>

                                    <?php if ($camaronera != 1) { ?>

                                        <!-- precria #4 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 4";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 4) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p4 = 4; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_cuatro" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_4">

                                                            <div>
                                                                <i id="delete_pre_2_4" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_4" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p4' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                    <?php } ?>
                                    
                                    <?php if ($camaronera != 4) { ?>

                                        <!-- precria #5 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 5";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 5) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p5 = 5; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_cinco" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_5">

                                                            <div>
                                                                <i id="delete_pre_2_5" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_5" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p5' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>

                                            </td>
                                        </tr>

                                    <?php } ?>
                                    <?php } ?>
                                    <?php if ($camaronera != 3){ ?>

                                        <!-- precria #6 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 6";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 6) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p6 = 6; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_seis" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_6">

                                                            <div>
                                                                <i id="delete_pre_2_6" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_6" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p6' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>

                                        </tr>
                                        
                                    <?php } ?>
                                    <?php if ($camaronera == 2 || $camaronera == 3) { ?>

                                        <!-- precria #7 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 7";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 7) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p7 = 7; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_siete" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_7">
                                                            <div>
                                                                <i id="delete_pre_2_7" class="fas fa-trash-alt text-danger"></i>
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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_7" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">
                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p7' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {



                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>

                                    <?php if ($camaronera != 3) { ?>

                                        <!-- precria #8 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 8";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 8) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p8 = 8; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_ocho" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_8">

                                                            <div>
                                                                <i id="delete_pre_2_8" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_8" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">
                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p8' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>
                                        
                                    <?php } } ?>
                                    <?php if ($camaronera != 3) { ?>

                                        <!-- precria #9 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 9";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 9) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p9 = 9; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_nueve" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_9">

                                                            <div>
                                                                <i id="delete_pre_2_9" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_9" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">
                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p9' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                    <?php } ?>
                                    <?php if ($camaronera != 2) { ?>
                                    <?php if ($camaronera != 1) { ?>

                                        <!-- precria #10 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 10";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 10) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p10 = 10; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_diez" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_10">
                                                            <div>
                                                                <i id="delete_pre_2_10" class="fas fa-trash-alt text-danger"></i>
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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_10" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p10' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>     

                                    <?php if ($camaronera == 2) { ?>

                                        <!-- precria #11 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 11";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 11) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p11 = 11; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_once" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_11">

                                                            <div>
                                                                <i id="delete_pre_2_11" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_11" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">
                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p11' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                    <?php } } ?>
                                    <?php if ($camaronera != 3) { ?>

                                        <!-- precria #12 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 12";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 12) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p12 = 12; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_doce" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_12">

                                                            <div>
                                                                <i id="delete_pre_2_12" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_12" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p12' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                    <?php } } ?>
                                    <?php if ($camaronera == 4) { ?>

                                        <!-- precria #13 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 13";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 13) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p13 = 13; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_trece" class="far fa-calendar-plus text-primary"></i>
                                                        
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
                                                        <div class="row" id="pre_2_13">

                                                            <div>
                                                                <i id="delete_pre_2_13" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_13" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p13' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                        <!-- precria #13 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 15";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 15) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p15 = 15; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_trece" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_15">

                                                            <div>
                                                                <i id="delete_pre_2_15" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_15" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p15' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                    <?php } ?>

                                    <?php if ($camaronera == 2) { ?>

                                        <!-- precria #3A -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 31";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 31) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p31 = 31; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_quince" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_15">

                                                            <div>
                                                                <i id="delete_pre_2_15" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_15" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p31' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                        <!-- precria #16 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 16";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 16) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p16 = 16; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_dieciseis" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_16">

                                                            <div>
                                                                <i id="delete_pre_2_16" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_16" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">
                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p16' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                        <!-- precria #9b -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 91";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 91) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p91 = 91; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_nueveb" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_9b">

                                                            <div>
                                                                <i id="delete_pre_2_9b" class="fas fa-trash-alt text-danger"></i>
                                                                
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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_9b" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p91' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>

                                        <!-- precria #19 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 19";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 19) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p19 = 19; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_diecinueve" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_19">

                                                            <div>
                                                                <i id="delete_pre_2_19" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_19" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p19' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>

                                    <?php } ?>




                                    <?php if ($camaronera == 6) { ?>

                                        <!-- precria #51 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 51";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 51) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p51 = 51; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_cincuentauno" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_51">

                                                            <div>
                                                                <i id="delete_pre_2_51" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_51" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p51' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>
                                        <!-- precria #52 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 52";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 52) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p52 = 52; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_quince" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_15">

                                                            <div>
                                                                <i id="delete_pre_2_15" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_15" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p31' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>
                                        <!-- precria #53 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 53";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 53) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p53 = 53; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_cincuentatres" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_53">

                                                            <div>
                                                                <i id="delete_pre_2_53" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_53" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p53' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>                                    
                                        <!-- precria #55 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 55";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 55) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p55 = 55; ?>">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_dieciseis" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_16">

                                                            <div>
                                                                <i id="delete_pre_2_16" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_16" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">
                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p16' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>
                                        <!-- precria #56 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 56";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 56) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p56 = 56; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_nueveb" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_9b">

                                                            <div>
                                                                <i id="delete_pre_2_9b" class="fas fa-trash-alt text-danger"></i>
                                                                
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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_9b" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p91' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                            
                                        </tr>
                                        <!-- precria #57 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 57";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 57) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p57 = 57; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_diecinueve" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_19">

                                                            <div>
                                                                <i id="delete_pre_2_19" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_19" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p19' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>
                                        <!-- precria #58 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 58";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 58) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p58 = 58; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_cincuentaocho" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_58">

                                                            <div>
                                                                <i id="delete_pre_2_58" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_58" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p58' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>
                                        <!-- precria #61 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 61";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 61) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p61 = 61; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_sesentaUno" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_61">

                                                            <div>
                                                                <i id="delete_pre_2_61" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_61" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p61' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>
                                        <!-- precria #62 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 62";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 62) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p62 = 62; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_sesentados" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_62">

                                                            <div>
                                                                <i id="delete_pre_2_62" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_62" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p62' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>
                                        <!-- precria #63 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 63";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 63) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p63 = 63; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_sesentatres" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_63">

                                                            <div>
                                                                <i id="delete_pre_2_63" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_63" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p63' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>
                                        <!-- precria #64 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 64";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 64) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p64 = 64; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_sesentacuatro" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_64">

                                                            <div>
                                                                <i id="delete_pre_2_64" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_64" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p64' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>
                                        <!-- precria #66 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 66";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 66) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p66 = 66; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_sesentaseis" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_66">

                                                            <div>
                                                                <i id="delete_pre_2_66" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_66" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p66' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>
                                        <!-- precria #67 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 67";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 67) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p67 = 67; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_sesentasiete" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_67">

                                                            <div>
                                                                <i id="delete_pre_2_67" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_67" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p67' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>
                                        <!-- precria #68 -->
                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_precria FROM `registro_piscina_precria` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_precria = 68";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $pre = $x['id_precria'];
                                            }

                                            ?>

                                            <?php if ($pre == 68) { ?>
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p68 = 68; ?>">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="container">

                                                    <div class="row">
                                                        <div>
                                                            <i id="add_pre_sesentaocho" class="far fa-calendar-plus text-primary"></i>
                                                            
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
                                                        <div class="row" id="pre_2_68">

                                                            <div>
                                                                <i id="delete_pre_2_68" class="fas fa-trash-alt text-danger"></i>

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
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                    <div class="">
                                                        <input type="number" class="inputs text-center" name="cantidad_2[]" id="cant_pre_2_68" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                    </div>
                                                </div>
                                            </td>



                                            <div class="container">

                                                <?php

                                                $sql_idenfificador = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$p68' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                                $data_identificador = $objeto->mostrar($sql_idenfificador);

                                                if (count($data_identificador) > 0) {

                                                    foreach ($data_identificador as $precria) {
                                                ?>
                                                        <input type="hidden" name="id[]" value="<?php echo $precria['identificacion']; ?>">

                                                    <?php }
                                                } else { ?>
                                                    <input type="hidden" name="id[]" value="<?php echo 0; ?>">
                                                <?php } ?>

                                            </div>
                                            <?php } ?>
                                        </tr>


                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>
                        <center><button class="btn btn-danger btn-sm text-light mt-1" type="submit">guardar datos de alimentacion</button></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
    function alim_precria() {

        var smspre = confirm("¿ Esta seguro que desea finalizar ?");
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