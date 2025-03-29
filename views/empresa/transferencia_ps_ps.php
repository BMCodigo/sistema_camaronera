<?php

error_reporting(0);
include './models/conexion.php';
include './models/corrida.php';

$objeto = new corrida();
$conectar = new Conexion();
$conexion = $conectar->conectar();

?>
   

<div class="container col-md-7 mt-3">
    <div class="card">
        <div class="card-header" style="background: #404e67;">
            <marquee><h6 class="text-white" style="margin:auto;"><strong>TRANSFERENCIA DE PISCINA A PISCINA </strong></h6></marquee>
        </div>
        <div class="card-body">


            <div class="mb-20 mt-3">
                <form onsubmit="return pescapre()" action="../controllers/insert-transferencia-ps-ps.php" method="post">

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
                        <label class="col-sm-4 col-lg-5 col-form-label">Fecha de pesca</label>
                        <div class="col-sm-8 col-lg-7">
                            <div class="input-group">
                                <input type="date" class="form-control" name="fechaActual" id="fechaActualpsps" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-lg-5 col-form-label">Peso de pesca</label>
                        <div class="col-sm-8 col-lg-7">
                            <div class="input-group">
                                <input type="number" class="form-control" step="any" name="peso_pesca" id="peso_pesca" value="1.00">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <label class="col-sm-4 col-lg-5 col-form-label">Seleccione origen</label>
                        <div class="col-sm-3 col-lg-7">
                            <div class="input-group">
                                <select class="form-control" name="piscina" id="piscina" onchange="valor_disponible_ps_ps()">

                                    <?php

                                    $objeto_tabla_piscina = new corrida();
                                    echo $sql_tabla_piscina = /*"SELECT te.id_piscina, te.secuencial, te.hectareas, te.cantidad_sembrada, (te.cantidad_sembrada - IFNULL( (SELECT SUM(ti.cantidad_sembrada) 
                                    FROM registro_piscina_engorde ti WHERE ti.id_camaronera = te.id_camaronera AND transferido_de_ps = te.id_piscina),0)) AS cantidad_disponible 
                                    FROM `registro_piscina_engorde` te WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' AND te.cantidad_sembrada > 0";*/
                                    
                                    "SELECT te.id_piscina, te.secuencial, te.hectareas, te.cantidad_sembrada, te.cantidad_sembrada as cantidad_disponible FROM `registro_piscina_engorde` te WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' AND te.cantidad_sembrada > 0";
                                    $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                                    ?>
                                    <option id="valor" value="0"> Seleccione piscina</option>

                                    <?php
                                    
                                    foreach ($data as $value) {

                                        //if ($sobrante_mostrar < 0 || $value['id_piscina'] != $id_sobrante_mostrar) {
                                            $sobrante_mostrar = $value['cantidad_disponible'];
                                        //}

                                    ?>
                                        <option value="<?php echo $value['id_piscina']; ?>" data-id="<?php echo $sobrante_mostrar; ?>">
                                            <?php echo '# 000' . $secuencial = $value['secuencial'] . ' - piscina ' . $value['id_piscina']; ?>
                                        </option>

                                    <?php } ?>
                                    
                                </select>

                                <script>
                                    function valor_disponible_ps_ps() {
                                        var dataid = $("#piscina option:selected").attr('data-id');
                                        // alert(dataid);
                                        $('#sembrado').val(parseInt(dataid));
                                    }
                                </script>

                            </div>
                        </div>

                    </div>

                    <div class="alert text-white text-center text-uppercase" style="background: #404e67;" role="alert">
                        <strong>Piscina destino</strong>
                    </div>

                    <!--destino 1-->

                    <div id="ps_1">

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label"> Piscina #1</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="piscina_destino[]" id="piscina_destino">
                                    <?php

                                        $objeto_tabla_piscina = new corrida();
                                        $sql_tabla_piscina = "SELECT DISTINCT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);
                                        ?>

                                        <option id="valor_1" value="0"> Seleccione pisicina</option>

                                        <?php
                                        foreach ($data as $value) {
                                        ?>

                                        <option value="<?php echo $value['piscinas']; ?>">
                                            <?php echo 'Piscina ' . $value['piscinas']; ?>
                                        </option>

                                    <?php } ?>
                                    </select>
                                    <a href="#" class="ml-2 text-success" id="add_ps_1" onclick="add_1()"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Cantidad</label>
                            <div class="col-sm-6 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="libras[]" step="any" id="libras" value="0.0" onkeyup="lib1()">

                                </div>
                            </div>
                        </div>

                    </div>

                    <!--destino 2-->

                    <div id="ps_2">

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label"> Piscina #2</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="piscina_destino[]" id="piscina_destino">
                                    <?php

                                        $objeto_tabla_piscina = new corrida();
                                        $sql_tabla_piscina = "SELECT DISTINCT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);
                                        ?>

                                        <option id="valor_1" value="0"> Seleccione pisicina</option>

                                        <?php
                                        foreach ($data as $value) {
                                        ?>

                                        <option value="<?php echo $value['piscinas']; ?>">
                                            <?php echo 'Piscina ' . $value['piscinas']; ?>
                                        </option>

                                    <?php } ?>
                                    </select>
                                    <a href="#" class="ml-2 text-center text-success" id="add_ps_2" onclick="add_2()"><i class="fas fa-plus"></i></a><br>
                                    <a href="#" class="ml-2 text-center text-danger" id="rmv_ps_2" onclick="rmv_2()"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Cantidad</label>
                            <div class="col-sm-6 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="libras[]" step="any" id="libras2" value="0.0" onkeyup="lib2()">
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--destino 3-->

                    <div id="ps_3">

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label"> Piscina #3</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="piscina_destino[]" id="piscina_destino">
                                    <?php

                                        $objeto_tabla_piscina = new corrida();
                                        $sql_tabla_piscina = "SELECT DISTINCT piscinas, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);
                                        ?>

                                        <option id="valor_1" value="0"> Seleccione pisicina</option>

                                        <?php
                                        foreach ($data as $value) {
                                        ?>

                                        <option value="<?php echo $value['piscinas']; ?>">
                                            <?php echo 'Piscina ' . $value['piscinas']; ?>
                                        </option>

                                    <?php } ?>
                                    </select>
                                    <a href="#" class="ml-2 text-center text-danger" id="rmv_ps_3" onclick="rmv_3()"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Cantidad</label>
                            <div class="col-sm-6 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="libras[]" step="any" id="libras3" value="0.0" onkeyup="lib3()">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="alert text-white text-center text-uppercase" style="background: #404e67;" role="alert">
                        <strong>Total a transferir </strong>
                    </div>

                    <!-- total sembrada de toda la cantidad -->

                    <div class="row">
                        <label class="col-sm-4 col-lg-5 col-form-label">Cantidad sembrada</label>
                        <div class="col-sm-6 col-lg-7">
                            <div class="input-group">
                                <input type="text" class="form-control text-center text-danger" name="sembrado" step="any" id="sembrado" readonly style="background:none;" placeholder="No ha selecionado precria">
                            </div>
                        </div>
                    </div>

                    <!-- suma total de toda la cantidad -->

                    <div class="row">
                        <label class="col-sm-4 col-lg-5 col-form-label">Suma total</label>
                        <div class="col-sm-6 col-lg-7">
                            <div class="input-group">
                                <input type="text" class="form-control text-center text-danger" name="valor_tot" step="any" id="valor_tot" readonly style="background:none;" placeholder="0.00">
                            </div>
                        </div>
                    </div>

                    <!-- porcentaje de sobrevivencia -->

                    <div class="row">
                        <label class="col-sm-4 col-lg-5 col-form-label">% Sobrevivencia</label>
                        <div class="col-sm-6 col-lg-7">
                            <div class="input-group">
                                <input type="text" class="form-control text-center text-danger" name="sobrevivencia" step="any" id="sobrevivencia" readonly style="background:none;" placeholder="0 %">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="user" value="<?php echo $id_usuario; ?>">

                    <!-- mensaje de validacion -->
                    <div class="container text-center">

                        <label>¿ Transferencia completa ?</label><br>
                        <div class="container">

                            <button type="button" onclick="si()" class="btn btn-dark text-white btn-sm">Si</button>
                            <button type="button" onclick="no()" class="btn btn-dark text-white btn-sm">No</button>

                            <div class="alert alert-info mt-3" role="alert" id="completo">
                                ¡ Listo al guardar datos de la transferencia se creará automaticamente la piscina !

                            </div>

                            <div class="alert alert-danger mt-3" role="alert" id="incompleto">
                                ¡ Queda pendiente producto por transferir !
                            </div>

                            <input type="hidden" name="estado" class="text-white" step="any" id="estado">
                        </div>
                    </div>


                    <center><button class="btn btn-danger btn-sm text-light mt-3" id="datos" type="submit">guardar datos de transferencia</button></center>
                </form>
            </div>
        </div>
    </div>

</div>

</div>


<script>
    let ps_2 = document.getElementById('ps_2').style = "display:none;";
    let ps_3 = document.getElementById('ps_3').style = "display:none;";

    function add_1() {
        document.getElementById('add_ps_1').style = "display:none;";
        document.getElementById('ps_2').style = "display:block;";
    }

    function add_2() {
        document.getElementById('add_ps_2').style = "display:none;";
        document.getElementById('rmv_ps_2').style = "display:none;";
        document.getElementById('ps_3').style = "display:block;";
    }

    function rmv_2() {
        document.getElementById('ps_2').style = "display:none;";
        document.getElementById('add_ps_1').style = "display:block;";

        document.getElementById('libras2').value = "0.0";
        document.getElementById('valor_1').value = "0";
        lib1();
        lib2();
        lib3();

    }

    function rmv_3() {

        document.getElementById('ps_3').style = "display:none;";
        document.getElementById('add_ps_2').style = "display:block;";
        document.getElementById('rmv_ps_2').style = "display:block;";

        document.getElementById('libras3').value = "0.0";
        lib1();
        lib2();
        lib3();
    }

    function pescapre() {
        var smsps = confirm("¿ Esta seguro que desea finalizar ?");
        if (smsps) {
            return true;
        } else {
            return false;
        }
    }

    function lib1() {
        console.log("pes")
        var lib1 = parseFloat($('#libras').val());
        var lib2 = parseFloat($('#libras2').val());
        var lib3 = parseFloat($('#libras3').val());
        console.log("aqui cambia" + lib1);
        var total = lib1 + lib2 + lib3;
        $('#valor_tot').val(total);

        var sembradito = parseFloat($('#sembrado').val());

        var porcentage = total / sembradito * 100;
        $('#sobrevivencia').val(parseInt(porcentage) + ' %');
    }

    function lib2() {
        var lib1 = parseFloat($('#libras').val());
        var lib2 = parseFloat($('#libras2').val());
        var lib3 = parseFloat($('#libras3').val());
        console.log("aqui cambia2" + lib2);
        var total = lib1 + lib2 + lib3;
        $('#valor_tot').val(total);

        var sembradito = parseFloat($('#sembrado').val());

        var porcentage = total / sembradito * 100;
        $('#sobrevivencia').val(parseInt(porcentage) + ' %');
    }

    function lib3() {
        var lib1 = parseFloat($('#libras').val());
        var lib2 = parseFloat($('#libras2').val());
        var lib3 = parseFloat($('#libras3').val());
        console.log("aqui cambia2" + lib3);
        var total = lib1 + lib2 + lib3;
        $('#valor_tot').val(total);

        var sembradito = parseFloat($('#sembrado').val());

        var porcentage = total / sembradito * 100;
        $('#sobrevivencia').val(parseInt(porcentage) + ' %');
    }


    document.getElementById("estado").style.display = "none";
    document.getElementById("completo").style.display = "none";
    document.getElementById("datos").style.display = "none";
    document.getElementById("incompleto").style.display = "none";

    function si() {

        document.getElementById("estado").style.display = "block";
        document.getElementById("completo").style.display = "block";
        document.getElementById("estado").value = "Cosechado";
        document.getElementById("datos").style.display = "block";
        document.getElementById("incompleto").style.display = "none";

    }

    function no() {

        document.getElementById("estado").style.display = "none";
        document.getElementById("completo").style.display = "none";
        document.getElementById("datos").style.display = "block";
        document.getElementById("incompleto").style.display = "block";
        document.getElementById("estado").style.display = "block";
        document.getElementById("estado").value = "En proceso";

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