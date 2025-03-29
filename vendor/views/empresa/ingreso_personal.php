<?php $objeto = new corrida(); ?>


    <div class="row">

        <!-- formulario de registro -->
        <div class="col-md-5">

            <div class="card">
                <div class="card-header" style="background: #404e67;">
                    <h6 class="text-white" style="margin:auto;">INGRESO DE PERSONAL</h6>
                </div>
                <div class="card-body">
                    <div class="mb-20">
                        <form action="../controllers/insert-ingreso-personal.php" method="post">

                            <!--camaronera-->   
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <?php

                                        $sqli = "SELECT DISTINCT id_camaronera FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto->mostrar($sqli);

                                        ?>
                                        <select class="form-control" name="camaronera">
                                            <?php

                                            foreach ($data as $value) {

                                            ?>
                                                <option value="<?php echo $value['id_camaronera']; ?>">

                                                    <?php

                                                        $sqli_camaronera = "SELECT DISTINCT descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                                        $data_camaronera = $objeto->mostrar($sqli_camaronera);

                                                        foreach ($data_camaronera as $value) {

                                                    ?>
                                                    <?php echo $camaronera = $value['descripcion_camaronera']; ?>
                                                </option>

                                        <?php }
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--fecha de ingreso-->
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Fecha de ingreso</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="fecha_ingreso_personal" style="background: none;" required>
                                    </div>
                                </div>
                            </div>

                            <!--cargo-->
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Cargo que aplica</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select class="form-control" name="cargo" placeholder="Campo requerido" style="background: none;" required>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Atarrayador">Atarrayador</option>
                                            <option value="Alimentador">Alimentador</option>
                                            <option value="Biologo">Biologo</option>
                                            <option value="Bodeguero">Bodeguero</option>
                                            <option value="Cocinero">Cocinero</option>
                                            <option value="Jefe de campo">Jefe de campo</option>
                                            <option value="Guardia">Guardia</option>
                                            <option value="Parametrista">Parametrista</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--nombres-->
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Nombres completos</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="nombres" placeholder="Campo requerido"  tyle="background: none;" required>
                                    </div>
                                </div>
                            </div>

                            <!--apellidos-->
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Apellidos completos</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="apellido" placeholder="Campo requerido" style="background: none;" required>
                                    </div>
                                </div>
                            </div>

                            <!--cedula-->
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Cedula o pasaporte</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="cedula" placeholder="Campo requerido" style="background: none;" required>
                                    </div>
                                </div>
                            </div>

                            <!--banco-->
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Entidad bancaria</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select  class="form-control" name="banco" required>
                                            <option value="Bnc. Pichincha">Bnc. Pichincha</option>
                                            <option value="Bnc. Guayaquil">Bnc. Guayaquil</option>
                                            <option value="Bnc. Pacifico">Bnc. Pacifico</option>
                                            <option value="Bnc. Bolivariano">Bnc. Bolivariano</option>
                                            <option value="Ban Ecuador">Ban Ecuador</option>
                                            <option value="Bnc. del Austro">Bnc. del Austro</option>
                                            <option value="Bnc. Internacional">Bnc. Internacional</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!--cuenta-->
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Número de cuenta</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="numero_cuenta" placeholder="Campo requerido" style="background: none;" required>
                                    </div>
                                </div>
                            </div>

                            <center><button class="btn btn-danger btn-sm text-light mt-3" type="submit">Guardar datos</button></center>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        <!-- tabla de registros -->
        <div class="col-md-7">
            <div class="card">
            <div class="card-header" style="background: #404e67;">
                    <h6 class="text-white" style="margin:auto;">DATOS REGISTRADOS</h6>
                </div>
                <div class="card-body">
                    <div class="mb-20">

                        <table class="table table-bordered table-sm">

                            <thead>
                                <tr style="background: #404e67;">
                                <th class="text-white text-center" scope="col">Fe. ingreso</th>
                                <th class="text-white text-center" scope="col">Cargo</th>
                                <th class="text-white text-center" scope="col">Nombres y apellidos</th>
                                <th class="text-white text-center" scope="col">Cedula o pasaporte</th>
                                <th class="text-white text-center" scope="col">Banco</th>
                                <th class="text-white text-center" scope="col"># de cuenta</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                    <?php

                                        $sql = "SELECT * FROM registro_ingreso_personal WHERE  camaronera = '$camaronera'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $value) { 
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $value['fecha_ingreso_personal']; ?></td>
                                        <td class="text-center"><?php echo $value['cargo']; ?></td>
                                        <td class="text-center"><?php echo $value['nombres'].' '.$value['apellido']; ?></td>
                                        <td class="text-center"><?php echo $value['cedula']; ?></td>
                                        <td class="text-center"><?php echo $value['banco']; ?></td>
                                        <td class="text-center"><?php echo $value['numero_cuenta']; ?></td>
                                    </tr>

                                <?php } ?>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>

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