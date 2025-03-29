<?php $objeto = new corrida(); ?>
<div class="container">

    <center>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background: #404e67;">
                    <h6 class="text-white" style="margin:auto;">CONTROL POBLACIONAL</h6>
                </div>
                <div class="card-body">
                    <div class="mb-20">
                        <form onsubmit="return poblacion()" action="../controllers/insert-poblacion.php" method="post">

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
                                <label class="col-sm-4 col-lg-5 col-form-label">Fecha de peso</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="fechaActualModal" id="fechaActualModalPesos" readonly style="background: none;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Seleccione piscina</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select class="form-control" name="piscina" id="piscina">
                                            <?php

                                            $objeto_tabla_piscina = new corrida();
                                            $sql_tabla_piscina = "SELECT piscinas, descripcion_piscina FROM piscina WHERE id_camaronera = '$camaronera'";
                                            $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                                            foreach ($data as $value) {
                                            ?>
                                                <option value="<?php echo $value['piscinas']; ?>">
                                                    <?php echo $value['descripcion_piscina']; ?>
                                                </option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Densidad por Ha</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="cantidad_animales" name="cantidad_animales" value="100000" min="10000" max="999999">
                                        <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">
                                    </div>
                                </div>
                            </div>

                            <center><button class="btn btn-danger btn-sm text-light mt-3" type="submit">guardar datos de poblacional</button></center>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </center>

</div>

<script>
    
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    });

    document.getElementById('fechaActualModalPesos').value = new Date().toDateInputValue();


    function poblacion() {

        var smspre = confirm("è¢ƒ Esta seguro que desea finalizar ?");
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