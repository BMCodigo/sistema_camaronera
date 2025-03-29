<div class="row">

    <div class="container col-md-6">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">PESCA DE PISCINA</h6>
            </div>
            <div class="card-body">
                <div class="mb-20">
                    <form id="form-insert-run" onsubmit="return pesca()"
                        action="../controllers/insert-pesca-engorde.php" method="post">

                        <div class="col-md-12">
                            <div class="">
                                <label> Registrar raleo </label>
                                <div class="container">

                                    <button type="button" onclick="si()"
                                        class="btn btn-dark text-white btn-sm">Si</button>
                                    <button type="button" onclick="no()"
                                        class="btn btn-dark text-white btn-sm">No</button>

                                    <div class="alert alert-success mt-3" role="alert" id="alerta">
                                          El raleo es un afloje parcial de una piscina
                                        <input type="hidden" name="raleo" class="text-white" step="any" id="raleo"
                                            style="border: none; background: none;" value="Cosecha">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
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
                                    <input type="date" class="form-control" name="fechaActual" id="fechaActualpesca">
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
                            <label class="col-sm-4 col-lg-5 col-form-label">Libras pescadas por Ha</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="libras" step="any" id="libras"
                                        value="1000">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Peso de pesca</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" step="any" name="peso_pesca"
                                        id="peso_pesca" value="1.00">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">% Renimiento</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" step="any" name="rendimiento"
                                        id="rendimiento" value="0.0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Cliente</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="cliente" id="cliente">
                                        <?php

                                        $objeto = new corrida();
                                        $sql = "SELECT id_cliente, descripcion_cliente FROM empacadora";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $value) {
                                        ?>
                                        <option value="<?php echo $value['id_cliente']; ?>">
                                            <?php echo $value['descripcion_cliente']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="fase" value="<?php echo $ps; ?>">
                                    <input type="hidden" name="user" value="<?php echo $id_usuario; ?>">
                                </div>
                            </div>
                        </div>
                        <center><button class="btn btn-danger btn-sm text-light mt-3" type="submit">guardar datos de
                                pesca</button></center>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<script>
function pesca() {
    var smspre = confirm("Esta seguro que desea finalizar ?");
    if (smspre) {
        return true;
    } else {
        return false;
    }
}


document.getElementById("raleo").style.display = "none";
document.getElementById("alerta").style.display = "none";

function si() {

    document.getElementById("raleo").style.display = "block";
    document.getElementById("alerta").style.display = "block";
    document.getElementById("raleo").value = "Raleo";

}

function no() {

    document.getElementById("raleo").style.display = "none";
    document.getElementById("alerta").style.display = "none";
    document.getElementById("raleo").value = "Cosecha";

}
</script>