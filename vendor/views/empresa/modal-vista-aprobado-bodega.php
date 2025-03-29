<div class="modal fade bd-example-modal-lg<?php echo $id = $key['id_secuencia']; echo $camaronera = $key['camaronera'];  ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <div class="col-12">
                <div class="widget bg-navy">
                    <div class="widget-body">
                        <div class="overlay">
                            Camaronera <br>
                           <!-- <i class="ik ik-refresh-ccw loading"></i>-->
                            <span class="overlay-text">
                                <?php 
                                    
                                    $camaronera;

                                    if($camaronera == 1){
                                        echo 'Darsacom';
                                    }else if($camaronera == 2){
                                        echo 'Aquacamaron';
                                    }else if($camaronera == 3){
                                        echo 'Jopisa';
                                    }else if($camaronera == 4){
                                        echo 'Aquanatura';
                                    }else if($camaronera == 5){
                                        echo 'Grupo Camaron';
                                    }else{
                                        echo 'Error en el servidor';
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Solicitud </h6>
                                <h2><?php echo '# '.$id; ?></h2>
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

            <table class="conatiner table table-bordered table-sm">
                <thead  style="background: #404e67;">
                    <tr>
                    <th class="text-white" scope="col"># Psc</th>
                    <!--<th class="text-white" scope="col">Cant. <br> en Psc / Sacos</th>-->
                    <th class="text-white" scope="col">Cant. <br> Despachado / Kg</th>
                    <th class="text-white" scope="col">Destino</th>
                    <th class="text-white" scope="col">Tipo <br> Balanceado</th>
                    </tr>
                </thead>
                <?php

                    $sql = "SELECT * FROM egreso_balanceado WHERE camaronera = '$camaronera' AND id_secuencia = '$id' AND id = 'Piscina' AND estado = 'Aprobado'";
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $val) {
                ?>
                
                <tbody>
                    <tr>
                    
                    <td><?php if($val['id_piscina'] == 64){ echo '17B'; }else{ echo $val['id_piscina'];} ?></td>
                    <!--<td><?php echo intval($val['sobrante']); ?></td>-->
                    <td><?php echo intval($val['cantidad_balanceado']); ?></td>
                    <td style="color:  #0e6655 ; "><b><?php echo $val['id']; ?></b></td>
                    <td><?php echo $val['tipo_balanceado']; ?></td>
                    </tr>
                </tbody>

                <?php } ?>

                <?php

                    $sql = "SELECT * FROM egreso_balanceado WHERE camaronera = '$camaronera' AND id_secuencia = '$id' AND id = 'Precria' AND estado = 'Aprobado'";
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $val) {
                        $encargado = $val['encargado'];
                ?>
                <tbody>
                    <tr>
                    
                    <td><?php echo $val['id_piscina']; ?></td>
                    <!--<td><?php echo intval($val['sobrante']); ?></td>-->
                    <td><?php echo intval($val['cantidad_balanceado']); ?></td>
                    <td style="color:  #784212; "><b><?php echo $val['id']; ?></b></td>
                    <td><?php echo $val['tipo_balanceado']; ?></td>
                    </tr>
                </tbody>

                <?php } ?>
            </table>
            <div class="contauner mb-5">
                <span class="badge badge-pill badge-warning."><b>Solicitud de balanceado despachada. <?php echo $encargado; ?> </b> </span><br>
            </div><br>      
        </div>

        </div>
    </div>
</div>
