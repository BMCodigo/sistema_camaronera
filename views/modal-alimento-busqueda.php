    <!-- Modal detalle de alimento samanal de pisicinas -->
    <!--div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
    <div class="modal fade bd-example-modal-sm<?php echo $ps = $value['id_piscina']; $c = $value['id_corrida'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Tipo de balanceado </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container text-danger mt-3">

                    <h6><?php   echo 'Piscina #'.$ps.'</br> Corrida # '. $c; ?></h6>

                </div>
                <div class="modal-body text-justify text-left" style="margin-top: -12px;">

                    <?php

                        $sql = "SELECT fecha_alimentacion, id_tipo_alimento, cantidad, id_tipo_alimento_2, cantidad_2 FROM registro_alimentacion_engorde WHERE id_piscina = '$ps' AND id_camaronera = '$camaronera' AND id_corrida = '$c' AND fecha_alimentacion BETWEEN '$dia' AND '$dx' ORDER BY fecha_alimentacion";
                        $data = $objeto->mostrar($sql);

                        foreach ($data as $xt) {

                            $fch = $xt['fecha_alimentacion'];

                            $t = $xt['id_tipo_alimento'];
                            $cant = $xt['cantidad'];

                            $t2 = $xt['id_tipo_alimento_2'];
                            $cant2 = $xt['cantidad_2'];

                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                            $data = $objeto->mostrar($sql);
                            foreach ($data as $xx) {
                                
                                $dsc = $xx['descripcion_alimento'];
                                $gmj = $xx['gramaje_alimento'];
                                
                            }

                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t2'";
                            $data = $objeto->mostrar($sql);
                            foreach ($data as $xx2) {
                                
                                $dsc2 = $xx2['descripcion_alimento'];
                                $gmj2 = $xx2['gramaje_alimento'];
                                
                            }
                        ?>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
        
                                    Fecha: <?php echo $fch ?> </br> 
                                    Alimento: <?php echo $dsc . ' ' . $gmj; ?> </br>
                                    Cantidad: <?php echo $cant; ?> </br>
                                    <?php if($cant2 > 0 ){?>
                                    Alimento: <?php echo $dsc2 . ' ' . $gmj2; ?> </br>
                                    Cantidad: <?php echo $cant2; ?>
                                    <?php } ?>
                                        
                                </li>
                            </ul>

                        <?php } ?>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>