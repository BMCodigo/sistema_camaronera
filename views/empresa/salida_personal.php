<?php $objeto = new corrida(); ?>

<div class="row">

    <!-- formulario de registro de salida -->
    <div class="col-md-5">

        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">SALIDA DE PERSONAL</h6>
            </div>
            <div class="card-body">
                <div class="mb-20">
                    <form action="../controllers/insert-salida-personal.php" method="post">

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

                        <!--fecha de salida-->
                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Fecha de salida</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fecha_salida_personal" style="background: none;" required>
                                </div>
                            </div>
                        </div>

                        <!--cargo-->
                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Cargo desempeñado</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="cargo" placeholder="Campo requerido" style="background: none;" required>
                                            <option value="Administrador">Administrador</option>
                                            <option value="Atarrayador">Atarrayador</option>
                                            <option value="Alimentador">Alimentador</option>
                                            <option value="Biologo">Biologo</option>
                                            <option value="Bodeguero">Bodeguero</option>
                                            <option value="Bombero">Bombero</option>
                                            <option value="Cocinero">Cocinero</option>
                                            <option value="Op.Aereadores">Op. Aereadores</option>
                                            <option value="Tec. alimentacion">Tec. alimentacion</option>
                                            <option value="Jefe Precria">Jefe Precria</option>
                                            <option value="Jefe de camp">Jefe de campo</option>
                                            <option value="Jefe Precria">Jefe Precria</option>
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
                                    <input type="text" class="form-control" name="nombres" placeholder="Campo requerido" tyle="background: none;" required>
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

                        <!--motivo de salida -->
                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Motivo de salida</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <textarea class="form-control" name="motivo" rows="3"></textarea>
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
                                <th class="text-white text-center" scope="col">Fe. salida</th>
                                <th class="text-white text-center" scope="col">Cargo</th>
                                <th class="text-white text-center" scope="col">Nombres y apellidos</th>
                                <th class="text-white text-center" scope="col">Cedula o pasaporte</th>
                                <th class="text-white text-center" scope="col">Motivo de salida</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php

                            $sql = "SELECT * FROM registro_salida_personal WHERE  camaronera = '$camaronera'";
                            $data = $objeto->mostrar($sql);
                            foreach ($data as $value) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $value['fecha_salida_personal']; ?></td>
                                    <td class="text-center"><?php echo $value['cargo']; ?></td>
                                    <td class="text-center"><?php echo $value['nombres'] . ' ' . $value['apellido']; ?></td>
                                    <td class="text-center"><?php echo $value['cedula']; ?></td>
                                    <td class="text-center"><?php echo $value['motivo']; ?></td>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

</div>
