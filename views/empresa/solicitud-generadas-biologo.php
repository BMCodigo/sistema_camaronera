 <?php

date_default_timezone_set("America/Lima");
$fechaActual = date('Y-m-d');
$objeto = new corrida();

?>
<div class="card">
    <div class="card-header" style="background: #404e67;">
        <h6 class="text-white" style="margin:auto;"><?php $page; if($page == 'Solicitud-generadas-biologo'){ echo 'SOLICITUDES DE BALANCEADO POR APROBAR'; } ?></h6>
        <ul class="time-horizontal nav justify-content-center">
     <!--   <li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li>-->
            <li>
               <!-- <li><b><a class="nav-link text-white " href="index.php?page=Nueva-solicitud-biologo"><i class="fas fa-clipboard text-danger"></i><b>  Nueva solicitud </b> </a></b></li>
            </li>-->

            <li>
                <div class="dropdown mt-2">
                    <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-minus-circle text-warning"></i>
                        <b> Ver Solicitudes</b>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="index.php?page=Aprobado-bodega-biologo"> <i class="fas fa-check-circle text-primary"> </i> Aprobadas </a>
                        <a class="dropdown-item" href="index.php?page=Solicitud-generadas-biologo"> <i class="fas fa-times-circle text-danger"> </i> Por aprobar  </a>
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
                <table id="data_table" class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center bg-dark">
                        <th class=" text-white">N° Solicitud</th>
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

                            $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$solicitud' AND estado != 'Aprobado' ORDER BY id_secuencia LIMIT 1";
                            $data = $objeto->mostrar($sql);
                                foreach ($data as $key) {
                    ?>
                        <tbody>
                            <tr class="text-center">
                                <td><?php echo '# '.$key['id_secuencia']; ?></td>
                                <td><?php echo $key['fecha_entrega']; ?></td>
                                <td><?php echo $user=$key['encargado']; ?></td>
                                
                                <?php if($key['estado'] == 'Rechazado'){ ?>
                                <td class="text-danger"><?php echo $key['estado']; ?></td>
                                <?php }else if($key['estado'] == 'En proceso'){ ?> 
                                <td class="text-warning"><?php echo $key['estado']; ?></td>
                                <?php } ?>
                                <?php if($key['estado'] == 'En proceso'){ ?>
                                    <td>
                                        <div class="table-actions text-center">
                                        <a data-toggle="modal" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $key['id_secuencia']; ?>"><i class="fas fa-eye text-primary"></i></a>
                                        </div>
                                        <!-- Modal previsualizacion -->
                                        <?php include 'modal-vista-solicitud-bio.php'; ?>

                                    </td>
                                <?php }else if($key['estado'] == 'Rechazado'){ ?>
                                    <td>    
                                        <div class="table-actions text-center">
                            
                                            <a title="Editar" data-toggle="modal" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $key['id_secuencia']; ?>"><i class="fas fa-edit text-warning"></i></a>
                                        <a title="Reenviar" href="../controllers/enviar-solicitud-bodega.php?id=<?php echo $key['id_secuencia']; ?>&camaronera=<?php echo $camaronera; ?>" class="fas fa-envelope text-primary"></i></a>
                                        </div>
                                        <!-- Modal editar solicitud -->
                                        <?php include 'modal-editar-solicitud-bio.php'; ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        </tbody>
                    <?php } } ?>
                </table>
            </div>
        </div>
    </div>
</div>

      