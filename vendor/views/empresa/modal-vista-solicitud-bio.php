<div class="modal fade bd-example-modal-lg<?php echo $id = $key['id_secuencia'];  ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <div class="col-12">
                <div class="widget bg-navy">
                    <div class="widget-body">
                        <div class="overlay">
                            <!--<i class="ik ik-refresh-ccw loading"></i>-->
                            <span class="overlay-text"><?php ?></span>
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
                    <th class="text-white" scope="col">Cant. <br> en Psc / Sacos</th>
                    <th class="text-white" scope="col">Cant. <br> Despacho / Kg</th>
                    <th class="text-white" scope="col">Destino</th>
                    <th class="text-white" scope="col">Tipo <br> Balanceado Despacho</th>
                    <th class="text-white" scope="col">Cant. <br> Solicitada / Kg</th>
                    <th class="text-white" scope="col">Tipo. <br> Solicitado</th>
                    </tr>
                </thead>
                <?php

                    $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$id' AND id = 'Piscina'";
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $val) {
                        
                        $base="SELECT y.cantidad_balanceado as cantidad_, y.tipo_balanceado as tipo_  FROM solicitud_balanceados x 
                            LEFT JOIN bitacora_balanceado y 
                                ON x.id_balanceado = y.id_balanceado
                                    AND y.id_bitacora = 
                                    ( SELECT MIN(id_bitacora) 
                                        FROM bitacora_balanceado WHERE id_balanceado = '".$val['id_balanceado']."' )
                                            WHERE x.id_balanceado = '".$val['id_balanceado']."'";
                                             $bases = $objeto->mostrar($base);
                ?>
                <tbody>
                    <tr>
                    
                    <td><?php if($val['id_piscina'] == 64){ echo '17B'; }else{ echo $val['id_piscina'];} ?></td>
                    <td><?php 
                    
                        if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                    echo floatval($val['sobrante']/10);
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                                  echo floatval($val['sobrante']/10);
                                                }else {
                                                  echo floatval($val['sobrante']/25);
                                                }
                         ?></td>
                                                
                    <td><?php echo floatval($val['cantidad_balanceado']) - floatval($val['sobrante']); ?></td>
                    <td style="color:  #0e6655 ; "><b><?php echo $val['id']; ?></b></td>
                    <td><?php echo $val['tipo_balanceado']; ?></td>
                    <td><?php if (isset($bases[0]['cantidad_'])){echo $bases[0]['cantidad_'];}else{echo $val['cantidad_balanceado']; } ?></td>
                    <td><?php if (isset($bases[0]['tipo_'])){echo $bases[0]['tipo_'];}else{echo $val['tipo_balanceado']; } ?></td>
                    </tr>
                </tbody>

                <?php } ?>

                <?php

                    $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$id' AND id = 'Precria'";
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $val) {
                ?>
                <tbody>
                    <tr>
                    
                    <td><?php echo $val['id_piscina']; ?></td>
                    
                     <td><?php 
                    
                        if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                    echo floatval($val['sobrante']/10);
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                                  echo floatval($val['sobrante']/10);
                                                }else {
                                                  echo floatval($val['sobrante']/25);
                                                }
                         ?></td>
                    
                    
                    
                    <td><?php echo $val['cantidad_balanceado']; ?></td>
                    <td style="color:  #784212; "><b><?php echo $val['id']; ?></b></td>
                    <td><?php echo $val['tipo_balanceado']; ?></td>
                    </tr>
                </tbody>

                <?php } ?>
            </table>
          <!--  <div class="contauner mb-5">
                <a class="btn btn-danger " href="../controllers/pdf.php?id=<?php echo $id; ?>&camaronera=<?php echo $camaronera;?>" title="Imprimir"><i class="fas fa-print text-white"></i> Imprimir </a>
            </div><br>      
        </div>-->

        </div>
    </div>
</div>
