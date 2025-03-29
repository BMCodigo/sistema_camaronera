<div class="modal fade bd-example-modal-lg<?php echo $id = $key['id_secuencia'];
                                                echo $camaronera = $key['camaronera'];
                                                  ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <div class="widget bg-navy">
                        <div class="widget-body">
                            <div class="overlay">
                                <!--<i class="ik ik-refresh-ccw loading"></i>-->
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="state">
                                    <h6>Solicitud </h6>
                                    <h2><?php echo '# ' . $id; ?></h2>
                                </div>
                                <div class="icon">
                                    <i class="ik ik-trending-up"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: -20px;">

                <table class=" table table-bordered table-sm">
                    <thead style="background: #404e67;">
                        <tr>
                            <th class="text-white" scope="col"># Psc</th>
                            <th class="text-white" scope="col">Cant. <br> Psc / Sacos</th>
                            <th class="text-white" scope="col">Cant. <br> Req. / Kg</th>
                            <th class="text-white" scope="col">Destino</th>
                            <th class="text-white" scope="col">Tipo <br> Balanceado</th>
                        </tr>
                    </thead>
                    <?php

                    $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$id' ORDER BY id";
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $val) {
                    ?>
                    <form action="../controllers/editar-solicitud-biologo.php" method="POST">
                        <tbody>
                            <tr>
                              <!--  <td><input class="input-edit" type="number" name="piscina[]" value="<?php echo $val['id_piscina']; ?>"></td>-->
                                 <td><?php echo $val['id_piscina']; ?></td>
                              <!--  <input type="hidden" name="corrida[]" value="<?php echo $val['id_corrida']; ?>"> 
                                <td><input class="input-edit" type="number" name="faltante[]" value="<?php echo intval($val['sobrante']); ?>"></td>-->
                                <td><?php echo intval($val['sobrante']/25); ?></td>
                                <td><input class="input-edit" type="number" name="cantidad[]" value="<?php echo intval($val['cantidad_balanceado']); ?>"></td>
                                <td><input class="input-edit" type="text" name="id[]" value="<?php echo $val['id']; ?>" readonly style="background:none;"></td>
                                <td>
                                    <select class="form-control" name="tipo_alimento[]" id="tipo_alimento" style="width:150px;">
                                    
                                    
                                        <option class="text-center" value="<?php echo $val['tipo_balanceado'] ?>">
                                        <?php echo $val['tipo_balanceado']; ?>
                                        </option>
                                    
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
                                </td>
                            </tr>
                        </tbody>

                    <?php } ?>


                    <input type="hidden" name="camaronera" value="<?php echo $val['camaronera']; ?>">
                    <input type="hidden" name="encargado" value="<?php echo $val['encargado']; ?>">
                    <input type="hidden" name="secuencia" value="<?php echo $id ?>">
                </table>
                <div class="contauner mb-5">
                    <button type="submit" class="btn btn-success" title="Actualizar"><i class="fas fa-print text-white"></i> Actualizar </button>
                </div>
                </form><br>
            </div>
        </div>
    </div>
</div>
<style>
    .input-edit {

        width: 80px;
        text-align: center;
        border: none;

    }
</style>