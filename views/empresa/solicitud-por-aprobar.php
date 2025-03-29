<?php

date_default_timezone_set("America/Lima");
$fechaActual = date('Y-m-d');
$objeto = new corrida();

?>
<div class="card">
    <div class="card-header" style="background: #404e67;">
    <h6 class="text-white" style="margin:auto;"><?php $page; if($page == 'Aprobado-bodega-biologo'){ echo 'SOLICITUDES DE BALANCEADO APROBADAS'; } ?></h6>
        <ul class="time-horizontal nav justify-content-center">
        <li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li>ge=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li-->
            <li>

                <div class="dropdown mt-2">
                    <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs text-danger"></i>
                        <b> Solicitud de AABB </b>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="index.php?page=Nueva-solicitud-biologo">Nuevas solicitud de AABB </a>
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
            <a href="javascript:location.reload()" class="btn btn-success mb-5 float-right">Actualizar pagina</a><br>
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

                    $sql_soli = "SELECT DISTINCT id_solicitud FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND estado = 'No aprobado' ORDER BY id_solicitud";
                    $data_soli = $objeto->mostrar($sql_soli);
                        foreach ($data_soli as $val) {
                            $solicitud=$val['id_solicitud'];

                            $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_solicitud = '$solicitud' AND id_solicitud > 0 AND estado = 'No aprobado' ORDER BY id_solicitud LIMIT 1";
                            $data = $objeto->mostrar($sql);
                                foreach ($data as $key) {
                    ?>
                        <tbody>
                            <tr class="text-center">
                                <td><?php echo '# '.$key['id_solicitud']; ?></td>
                                <td><?php echo $key['fecha_entrega']; ?></td>
                                <td><?php echo $key['encargado']; ?></td>
                                <td class="text-danger"><?php echo $key['estado']; ?></td>
                                
                                <?php if($key['estado'] == 'No aprobado'){ ?>
                                    <td>
                                        <div class="table-actions text-center">
                                            <a href="../controllers/editar-sugerencia-bodega.php?id=<?php echo $key['id']?>&user=<?php echo $nombre . ' ' . $apellido;?>&cant=<?php echo $cant;?>&aabb=<?php echo $aabb;?>&ps=<?php echo $ps;?>&camaronera=<?php echo $camaronera;?>&name=<?php echo $name; ?>" title="visualizar solicitud"><i class="fas fa-eye text-primary"></i></a>
                                            <a href="../controllers/editar-sugerencia-bodega.php?id=<?php echo $key['id']?>&user=<?php echo $nombre . ' ' . $apellido;?>&cant=<?php echo $cant;?>&aabb=<?php echo $aabb;?>&ps=<?php echo $ps;?>&camaronera=<?php echo $camaronera;?>&name=<?php echo $name; ?>" title="Editar solicitud"><i class="fas fa-edit text-warning"></i></a>
                                        </div>
                                    </td>
                                <?php }else{ ?>
                                    <td>
                                        <div class="table-actions text-center">
                                            <a href="#" title="Aprobado"><i class="fas fa-unlock-alt text-danger"></i></a>
                                        </div>
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