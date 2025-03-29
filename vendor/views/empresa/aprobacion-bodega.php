<?php

date_default_timezone_set("America/Lima");
$fechaActual = date('Y-m-d');
$objeto = new corrida();

?>
<div class="card">
    <div class="card-header" style="background: #404e67;">
        <h6 class="text-white" style="margin:auto;"><?php $page; if($page == 'Aprobacion-solicitud'){ echo 'SOLICITUDES DE DESPACHO'; } ?></h6>
        <ul class="time-horizontal nav justify-content-center">
             <!--   <li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li>-->
             <!--     <li><b><a class="nav-link text-white " href="index.php?page=Ingreso"><i class="fas fa-copy text-info"></i>
                            Ingresar balanceado </a></b></li>-->
                <li>

                    <div class="dropdown mt-2">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-minus-circle text-warning"></i>
                            <b> Ordenes Generadas</b>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="index.php?page=Aprobado-bodega"> <i class="fas fa-check-circle text-primary"> </i> Aprobado </a>
                            <a class="dropdown-item" href="index.php?page=Aprobacion-solicitud"> <i class="fas fa-times-circle text-danger"> </i> Por aprobar  </a>
                        </div>
                    </div>
                </li>
            </ul>

    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <a href="javascript:location.reload()" class="btn btn-secondary mb-5 float-right">Actualizar pagina</a><br>
            
                <table id="data_table" class="table table-sm table-bordered mt-5">
                    <thead>
                        <tr class="text-center bg-dark">
                        <th class=" text-white">N Solicitud</th>
                            <th class=" text-white">Fecha generada</th>
                            <th class=" text-white">Solicitado por</th>
                            <th class=" text-white">Estado</th>
                            <th class=" text-white">Opciones</th>
                        </tr>
                    </thead>
                    <?php

                    $sql_soli = "SELECT DISTINCT id_secuencia FROM solicitud_balanceados WHERE camaronera = '$camaronera' ORDER BY id_secuencia";
                    $data_soli = $objeto->mostrar($sql_soli);
                        foreach ($data_soli as $val) {
                            $solicitud=$val['id_secuencia'];

                            $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$solicitud' AND id_secuencia > 0 AND estado = 'En proceso' ORDER BY id_secuencia LIMIT 1";
                            $data = $objeto->mostrar($sql);
                                foreach ($data as $key) {
                                    $estado = $key['estado'];
                                    $estado = 'Por aprobar'
                    ?>
                        <tbody>
                            <tr class="text-center">
                                <td><?php echo '# '.$key['id_secuencia']; ?></td>
                                <td><?php echo $key['fecha_entrega']; ?></td>
                                <td><?php echo $key['encargado']; ?></td>
                                
                                <?php if($estado == 'Por aprobar'){ ?>

                                <td class="text-warning"><?php echo $estado; ?></td>

                                <?php } ?>

                                <?php if($estado == 'Por aprobar'){ ?>
                                    <td>
                                        <div class="table-actions text-center">
                                            <a title="Editar" data-toggle="modal" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $key['id_secuencia']; ?>"><i class="fas fa-edit text-warning"></i></a>
                                            <a title="Aprobar" href="../controllers/aprobar-solicitud-bodega.php?id=<?php echo $key['id_secuencia']; ?>&camaronera=<?php echo $camaronera; ?>&user=<?php echo $nombre.' '.$apellido; ?>" class="fas fa-check-circle text-primary"></i></a>
                                            <a title="Rechazar" href="../controllers/rechazar-solicitud-bodega.php?id=<?php echo $key['id_secuencia']; ?>&camaronera=<?php echo $camaronera; ?>&user=<?php echo $nombre.' '.$apellido; ?>" class="fas fa-times-circle text-danger"></i></a>
                                        </div>
                                        <!-- Modal previsualizacion -->
                                        <?php include 'modal-vista-solicitud-bod.php'; ?>

                                    </td>
                                <?php }else if($key['estado'] == 'Aprobado' ){ ?>
                                    <a href="../controllers/aprobar-solicitud-bodega.php?page=<?php echo $key['id_secuencia']; ?>&camaronera=<?php echo $camaronera; ?>&user=<?php echo $nombre.' '.$apellido; ?>" class="fas fa-times-circle text-danger"></i></a>
                                <?php } } ?>
                                            
                            </tr>
                        </tbody>
                    <?php }  ?>
                </table>
            </div>
        </div>
    </div>
</div>
             