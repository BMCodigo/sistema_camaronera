    <!-- Modal detalle de alimento samanal de pisicinas -->
    <!--div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"-->
    <div class="modal fade bd-example-modales-sm<?php echo $pre = $value_pre['id_precria']; $c_pre = $value_pre['identificacion'] ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Tipo de balanceado </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container text-danger mt-3">

                    <h6><?php   echo 'Precria #'.$pre; ?></h6>

                </div>
                <div class="modal-body text-justify text-left" style="margin-top: -12px;">

                    <?php

                    $sql = "SELECT id_tipo_alimento, fecha_alimentacion FROM registro_alimentacion_precria WHERE id_precria = '$pre' AND id_camaronera = '$camaronera' AND identificacion = '$c_pre' AND fecha_alimentacion BETWEEN '$dia' AND '$dx' ORDER BY fecha_alimentacion";
                    $data = $objeto->mostrar($sql);

                    foreach ($data as $xt) {

                        $t = $xt['id_tipo_alimento'];
                        $fch = $xt['fecha_alimentacion'];

                        $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                        $data = $objeto->mostrar($sql);
                        foreach ($data as $xx) { ?>
                        
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="fas fa-calendar-alt"></i> Fecha: <?php echo $fch ?> </br> <i class="fas fa-balance-scale"></i> Alimento: <?php echo $xx['descripcion_alimento'] . ' ' . $xx['gramaje_alimento']; ?></li>

                            </ul>

                        
                        <?php } ?>
                    <?php }
                    ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>