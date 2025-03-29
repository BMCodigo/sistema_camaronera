<?php

date_default_timezone_set("America/Lima");
$fechaActual = date('Y-m-d');
$objeto = new corrida();

?>
<div class="card">
    <div class="card-header" style="background: #404e67;">
        <h6 class="text-white" style="margin:auto;">SUGERENCIA DE BALANCEADO A PRODUCCION</h6>
        <ul class="time-horizontal nav justify-content-center">
            <!--li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li-->
                <li>

                    <div class="dropdown mt-2">
                        <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs text-danger"></i>
                            <b> Sugerencia de AABB </b>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="index.php?page=Egreso">Orden de balanceado </a>
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
                <table id="data_table" class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center bg-dark">
                            <th class=" text-white">Sugerido Por</th>
                            <th class=" text-white">Aprobado Por</th>
                            <th class=" text-white">Fecha</th>
                            <th class=" text-white">Psc / Pre</th>
                            <th class=" text-white">Cantidad</th>
                            <th class=" text-white">Tipo AABB</th>
                            <th class=" text-white">Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php

                        $sql = "SELECT * FROM sugerencia_balanceado WHERE camaronera = '$camaronera'";
                        $data = $objeto->mostrar($sql);
                        foreach ($data as $key) {
                    ?>
                    <tbody>
                        <tr class="text-center">
                            <td><?php echo $key['encargado']; ?></td>   
                            <td><?php echo $key['aprobador_por']; ?></td> 
                            <td><?php echo $key['fecha_entrega']; ?></td>
                            <td><?php echo $key['id_piscina'] .' - '. $key['psc_pre']; ?></td>
                            <td><?php echo $key['cantidad_balanceado']; ?></td>
                            <td><?php echo $key['tipo_balanceado']; ?></td>
                            <?php if($key['detalles'] == 'Por aprobar'){?>
                            <td class="text-danger"><b><?php echo $key['detalles']; ?></b></td>
                            <?php }else{ ?>
                            <td class="text-success"><b><?php echo $key['detalles']; ?></b></td>
                            <?php }?>
                            <?php if($key['detalles'] == 'Por aprobar'){?>
                            <td>
                                <div class="table-actions text-center"> 
                                    <a href="../controllers/eliminar-sugerencia-bodega.php?id=<?php echo $key['id']?>" title="Borrar"><i class="fas fa-trash-alt text-primary"></i></a>  
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
                    </tbody><?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>