<div class="modal fade bd-example-modal-md<?php echo $id = $key['id_balanceado'];echo $psc=$key['id_piscina']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
                <div class="modal-body">
                    <form action="../controllers/insert-sugerencia-alimento-psc.php" method="post">
                        <div class="form-row">

                            <?php

                            $objeto_tabla_camaronera = new corrida();
                            $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                            $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                            foreach ($data as $value) { ?>
                                <input type="hidden" class="form-control" name="camaronera" value="<?php echo $value['id_camaronera']; ?>">
                            <?php } ?>

                            <div class="form-group col-md-12">
                                <label for="inputPassword4">Encargado</label>
                                <input type="text" class="form-control" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>" readonly style="background:none;">
                            </div>

                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Fecha</label>
                                <input type="text" class="form-control" name="fechaActual" value="<?php echo date('Y-m-d'); ?>" readonly style="background:none;">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Seleccione piscina</label>
                                <input type="text" class="form-control" name="piscina" value="<?php echo $psc; ?>" readonly style="background:none;">
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Cantidad</label>
                                <input type="number" class="form-control" name="cantidad" value="0.0" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Tipo de alimento</label>
                                <select class="form-control" name="tipo_alimento">
                                    <?php

                                    $sqli = "SELECT DISTINCT tipo_balanceado FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND descripcion = 'Compra' ORDER BY tipo_balanceado ASC";
                                    $data = $objeto->mostrar($sqli);
                                    foreach ($data as $value) {
                                    ?>

                                        <option class="text-center" value="<?php echo $value['tipo_balanceado'] ?>">
                                            <?php echo $value['tipo_balanceado']; ?>
                                        </option>

                                    <?php } ?>
                                </select>
                                <input type="text" class="form-control" name="id" value="<?php echo $id; ?>" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Enviar solicitud</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>