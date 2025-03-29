    <div class="col-md-7 " style="margin: auto;">
        <div class="card">

                    <div class="card-header" style="background: #404e67;">
                        <h6 class="text-white" style="margin: auto;">TRAZABILIDAD DE INSUMOS CAMARONERA</h6>
                    </div>
                    <div class="card-body">
                        <form id="form-insert-run" onsubmit="return pesca()" action="../controllers/insert-inventario-general.php" method="post">
                            <div class="form-group row">
                                <label for="camaronera" class="col-sm-4 col-form-label">Camaronera</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="camaronera" id="camaronera">
                                        <?php
                                        $objeto_tabla_camaronera = new corrida();
                                        $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                        foreach ($data as $value) {
                                            echo "<option value='{$value['id_camaronera']}'>{$value['descripcion_camaronera']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="producto" class="col-sm-4 col-form-label">Seleccione Producto</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="producto" id="producto" onchange="toggleAddButton()">
                                        <option value="0">[Seleccione]</option>
                                        <?php
                                        $objeto_tabla_piscina = new corrida();
                                        $sql_tabla_piscina = "SELECT DISTINCT(familia) FROM `insumos_camaronera`";
                                        $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                                        foreach ($data as $value) {
                                          echo "<option value='{$value['familia']}'>{$value['familia']}</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>


                            <center>
                                <button class="btn btn-danger btn-sm text-light mt-3" id="sender" style="display:;" type="submit" onclick="(confirmar)">Consultar</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>