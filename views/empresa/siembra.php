<div class="row">
    <div class="container col-md-6">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">SIEMBRA</h6>
            </div>
            <div class="card-body">
                <div class="mb-20">
                    <form id="form-insert-run" onsubmit="return addrunpre()" action="../controllers/insert-siembra.php"
                        method="post">

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Codigo secuencial</label>
                            <div class="col-sm-8 col-lg-2">
                                <div class="input-group">

                                <?php

                                        $objeto_secuencial = new corrida();
                                        $sql_secuencial = "SELECT MAX(secuencial) as secuencial FROM secuencial";
                                        $data_secuencial = $objeto_secuencial->mostrar($sql_secuencial);

                                        foreach ($data_secuencial as $key){
                                            $secuencial = intval($key['secuencial']+1);   
                                                
                                        ?>
                                        
                                            <input type="text" class="form-control" name="secuencial" id="secuencial" value="<?php echo $secuencial; ?>" readonly style="background: none;">

                                        <?php } ?>
                                </div>
                            </div>
                        </div>

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
                            <label class="col-sm-4 col-lg-5 col-form-label">Fecha de siembra</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fechaActual" id="fechaActual">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Seleccione precria origen</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="origen_pre" id="piscina">

                                        <option id="valor" value="0"> Seleccione precria</option>
                                        <?php

                                            $objeto_pre = new corrida();

                                            if ($camaronera == 1) {
                                                $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_darsacom WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 2) {
                                                $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquacamaron WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 3) {
                                                $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_jopisa WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 4){
                                                $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquanatura WHERE id_camaronera = '$camaronera'";
                                            }else if ($camaronera == 5){
                                                $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_grupo_camaron WHERE id_camaronera = '$camaronera'";
                                            }else if ($camaronera == 6){
                                                $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_calica WHERE id_camaronera = '$camaronera'";
                                            }else{
                                                echo 'error en el servidor :(';
                                            }

                                            $data = $objeto_pre->mostrar($sql_pre);

                                            foreach ($data as $value_pre) {
                                                $ha = $value_pre['hectareas'];
                                        ?>
                                        <option value="<?php echo $value_pre['id_precria']; ?>">
                                            <?php echo $value_pre['descripcion_piscina'] . ' / Ha ' . $value_pre['hectareas']; ?>
                                        </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            
                            <label class="col-sm-4 col-lg-5 col-form-label">Seleccione piscina destino</label>

                            <div class="col-sm-3 col-lg-3">
                                <div class="input-group">
                                    <select class="form-control" name="destino_psc_1" id="piscina">

                                        <option id="valor" value="0"> Seleccione piscina</option>
                                        <?php

                                            $objeto_psc = new corrida();

                                            if ($camaronera == 1) {
                                                $sql_psc= "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 2) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 3) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 4) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            }  else if ($camaronera == 5) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            }  else if ($camaronera == 6) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            }else{
                                                echo 'error en el servidor :(';
                                            }

                                            $data = $objeto_psc->mostrar($sql_psc);

                                            foreach ($data as $value_psc) {
                                                $ha = $value_psc['hectareas'];
                                        ?>
                                        <option value="<?php echo $value_psc['piscinas']; ?>">
                                            <?php echo $value_psc['piscinas'] . ' / Ha ' . $value_psc['hectareas']; ?>
                                        </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3 col-lg-3">
                                <div class="input-group">
                                    <select class="form-control" name="destino_psc_2" id="piscina">

                                        <option id="valor" value="0"> Seleccione piscina</option>
                                        <?php

                                            $objeto_psc = new corrida();

                                            if ($camaronera == 1) {
                                                $sql_psc= "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 2) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 3) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 4) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            } else if ($camaronera == 5) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            }  else if ($camaronera == 6) {
                                                $sql_psc = "SELECT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            }else{
                                                echo 'error en el servidor :(';
                                            }

                                            $data = $objeto_psc->mostrar($sql_psc);

                                            foreach ($data as $value_psc) {
                                                $ha = $value_psc['hectareas'];
                                        ?>
                                        <option value="<?php echo $value_psc['piscinas']; ?>">
                                            <?php echo $value_psc['piscinas'] . ' / Ha ' . $value_psc['hectareas']; ?>
                                        </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            
                        </div>


                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Peso de siembra (pelegramos)</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="pesoSiembra" step="any"
                                        id="pesoTransferencia" value="250">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Cantidad total de siembra</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="cantidad" step="any" id="densidad"
                                        value="1000000">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Codigo genetico</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="text" class="text-uppercase form-control" name="codigo_genetico"
                                        id="codigo" placeholder="N002022-C" value="N/A">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Nauplio</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="text" class="text-uppercase form-control" name="nauplio" id="nauplio"
                                        placeholder="Texcumar" value="N/A">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Laboratorio</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="text" class="text-uppercase form-control" name="laboratorio"
                                        id="laboratorio" placeholder="Guaimitolab" value="N/A">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="hidden" name="user" value="<?php echo $id_usuario; ?>">
                                    <input type="hidden" name="id" value="<?php echo rand(1, 300); ?>">
                                </div>
                            </div>
                        </div>

                        <center><button class="btn btn-danger btn-sm text-light mt-3" type="submit">guardar datos de
                                siembra</button></center>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- SIEMBRA DIRECTA DE PSICINA DE ENGORDE -->


        <!--div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background: #404e67;">
                    <h6 class="text-white" style="margin:auto;">SIEMBRA DE PISCINA</h6>
                </div>
                <div class="card-body">
                    <div class="mb-20">
                        <form id="form-insert-run" onsubmit="return addrun()" action="../controllers/insert-siembra.php" method="post">

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select class="form-control" name="camaronera" id="camaronera">
                                            <!?php
                                            
                                            //$objeto_tabla_camaronera = new corrida();
                                            //$sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                            //$data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                            //foreach ($data as $value) {
                                            ?>
                                                <option value="<!?php echo $value['id_camaronera']; ?>">
                                                    <!?php echo $value['descripcion_camaronera']; ?></option>

                                            <1?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Fecha de siembra</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="fechaActual" id="fechaActual2">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Seleccione piscina</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select class="form-control" name="origen_psc" id="piscina">
                                            <!?php

                                            //$objeto_tabla_piscina = new corrida();
                                            //$sql_tabla_piscina = "SELECT piscinas, descripcion_piscina FROM piscina WHERE id_camaronera = '$camaronera'";
                                            //$data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                                            foreach ($data as $value) {
                                            ?>
                                                <option value="<!?php echo $value['piscinas']; ?>">
                                                    <!?php echo $value['descripcion_piscina']; ?>
                                                </option>

                                            <!?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Peso de siembra</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="pesoTransferencia" step="any" id="pesoTransferencia" value="1.00">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Densidad sembrada por Ha</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="densidad" step="any" id="densidad" value="10000">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Origen</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select name="origen" id="origen" class="form-control">
                                            <option value="Bi-fasico">Bi-fasico</option-->
                                            <!--option value="Tri-fasico">Tri-fasico</option-->
                                            <!--option value="Siembra directa">Siembra directa</option>
                                        </select>
                                        <input type="hidden" name="user" value="<!?php echo $id_usuario; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Nauplio</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control text-uppercase" name="nauplio" step="any" id="nauplio" placeholder="Nauplio" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Laboratorio</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control text-uppercase" name="laboratorio" step="any" id="laboratorio" placeholder="Laboratorio" required>
                                    </div>
                                </div>
                            </div>
                            <center><button class="btn btn-danger btn-sm text-light mt-3" type="submit">guardar datos de siembra</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div-->

    
    <!-- SIEMBRA DIRECTA DE PSICINA DE ENGORDE -->

</div>

<script>
    function addrun() {

        var smspre = confirm("¿ Esta seguro que desea finalizar ?");

        if (smspre) {

            return true;
        } else {
            return false;
        }
    }

    function addrunpre() {

        let codigo = document.getElementById('codigo').value;
        let nauplio = document.getElementById('nauplio').value;
        let laboratorio = document.getElementById('laboratorio').value;

        if (codigo.length == 0 || codigo == null) {
            alert('Ingrese codigo genetico');
            return false;

        } else if (nauplio.length == 0 || nauplio == null) {
            alert('Ingrese nauplio');
            return false;

        } else if (laboratorio.length == 0 || laboratorio == null) {
            alert('Ingrese labolatorio o maduracion');
            return false;

        } else {

            var smspre = confirm("¿ Esta seguro que desea finalizar ?");

            if (smspre) {
                return true;
            } else {
                return false;
            }

        }
    }
</script>