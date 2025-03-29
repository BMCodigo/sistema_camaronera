<?php
date_default_timezone_set("America/Lima");
$objeto = new corrida();
$conectar = new Conexion();
$conexion = $conectar->conectar();
$objeto = new corrida();

$fecha_hora_actual = date('Y-m-d H:i:s');
$datetime = new DateTime($fecha_hora_actual);

if(isset($_GET['e'])){
    echo 'datos';
}

?>


<div class="col-lg-12 col-md-12">

    <div class="card">

        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a href="#" onclick="solicitud();" class="nav-link" role="tab" aria-controls="pills-profile" id="solicitud_sms"
                    aria-selected="false"><strong>Parametros de solicitud de larva</strong></a>
            </li>
            <li class="nav-item">
                <a href="#" onclick="venta();" class="nav-link" role="tab" aria-controls="pills-profile"
                    aria-selected="false" id="venta_sms" style="background:#900C3F;"><strong>Parametros de precio venta por libra</strong></a>
            </li>
                        <li class="nav-item">
                <a href="#" onclick="biomasa();"  class="nav-link" role="tab" aria-controls="pills-profile" id="biomasa_sms"
                    aria-selected="false"><strong>Parametros Biomasa</strong></a>
            </li>
        </ul>

        

        <div class="container" id="ventas">

        <div class="col-7 mt" style="margin-left:290px; margin-top: 20px; width: 530px;">
            <div class="alert alert-success text-center" role="alert" >
                <strong> REGISTRO DE PRECIO VENTA DE LIBRA DE CAMARON </strong>
            </div>
        </div>
            <div class="row" style="margin:auto; margin-top: 20px; width: 500px;">
                <div>
                <form action="../controllers/insert-precio-venta.php" method="post">
                    <?php include './tabla-talla.php'; ?>
                </form>
                </div>
            </div>
        </div>

        <div class="col-7 mt" style="margin:auto; margin-top: 20px; width: 480px;" id="mensaje">
            <div class="alert alert-primary text-center" role="alert" >
                <strong> REGISTRO DE PARAMETROS PARA SOLICITUD DE LARVA</strong>
            </div>
        </div>

        <div class="row" style="margin:auto;" id="solicitudes">

            <div class="col-4 justify-content-center">
                <ul class="list-group list-group-flush text-uppecasse text-center"
                    style="list-style-type:none; border:none;">
                    <!--li class=" text-uppercase"><strong>camaronera
                                <?php if($camaronera == 1){ echo "Darsacom";}else if($camaronera == 2){ echo "Aquacamaron";}else if($camaronera == 3){ echo "Jopisa";}else if($camaronera == 4){ echo "Aquanatura";}else if($camaronera == 5){ echo "Grupo Camaron";}; ?></strong>
                        </li-->
                </ul>
                <br>
                <form action="../controllers/insert-parametros-piscina.php" method="post" style="width:450px;">
                    <div class="alert text-white" role="alert" style="width:450px; background: #404e67;">
                        Parametros de larva de camaronera
                    </div>
                    <div class="form-group">
                        <!--label>Camaronera</label-->
                        <input type="hidden" class="form-control bg-white" name="camaronera" readonly
                            value="<?php if($camaronera == 1){ echo "Darsacom";}else if($camaronera == 2){ echo "Aquacamaron";}else if($camaronera == 3){ echo "Jopisa";}else if($camaronera == 4){ echo "Aquanatura";}else if($camaronera == 5){ echo "Grupo Camaron";}; ?>">
                        <input type="hidden" name="fecha_parametro"
                            value="<?php echo $datetime->format('Y-m-d H:i:s'); ?>">
                        <!--span  name="span">span</span-->
                    </div>

                    <div class="form-group">
                        <label><strong>Proceso de siembra</strong> </label>
                        <select class="form-control" name="procesoSiembra">
                            <option value="Bi-fasico">Bifasico</option>
                            <option value="Tri-fasico">Trifasico</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><strong>Cantidad de larva por hectarea</strong></label>
                        <input type="number" class="form-control" id="NumberCant" name="cantidadHa" maxlength="6"
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label><strong>Gramaje de pesca</strong></label>
                        <input type="number" class="form-control" id="NumberCant" name="pesoPesca" maxlength="6"
                            placeholder="">
                    </div>

                    <div class="form-group">
                        <label><strong>Dias estimados de proceso</strong></label>
                        <input type="number" class="form-control" id="NumberCant" name="diasProceso" maxlength="6"
                            placeholder="">
                    </div>
                    <center>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar parametros</button>
                    </center>
                </form>
            </div>

        </div><br>
        <hr><br>

        <!-- filtro de fecha -->
        <div class="container col-4 mt-5" id="solicitudes2">
            <form action="index.php?page=Parametros" method="POST">
                <div class="input-group mb-3">
                    <?php

                            $sqlTablafecha="SELECT DISTINCT(fecha_parametro) AS fecha_parametro FROM parametro_camaronera_psc WHERE id_camaronera = '$camaronera' ORDER BY fecha_parametro DESC";
                            $datafecha = $objeto->mostrar($sqlTablafecha);

                        ?>
                    <select name="fechaRegistro" id="" class="form-control">
                        <option value="">Seleccione fecha</option>
                        <?php foreach ($datafecha as $f) { $fechaUltima=$f['fecha_parametro']; ?>
                        <option value="<?php echo $f['fecha_parametro']; ?>"><?php echo $f['fecha_parametro']; ?>
                        </option>
                        <?php } ?>
                        ?>
                        <option value=""></option>
                    </select>

                    <div class="input-group-append">
                        <button class="btn btn-danger btn-sm" type="submit" name="search" id="button-addon2"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <!--fecha de ultimo registro -->
        <div class="container" id="solicitudes3">

            <?php if(isset($_POST['search'])){ ?>

            <div class="container col-3">
                <ul class="list-group">
                    <li
                        style="list-style-type:none; border:none; margin-left:50px; margin-top:10px; margin-bottom:20px;">
                        <strong>Fecha: <?php $ff=$_POST['fechaRegistro'];  echo substr($ff, 0, 10);  ?></strong>
                    </li>
                </ul>
            </div>

            <?php }else{
        
                    $sqlTablafecha="SELECT MAX(fecha_parametro) AS fecha_parametro FROM parametro_camaronera_psc WHERE id_camaronera = '$camaronera'";
                    $datafecha = $objeto->mostrar($sqlTablafecha);
                    foreach ($datafecha as $f) { 
                ?>

            <div class="container col-3">
                <ul class="list-group">
                    <li
                        style="list-style-type:none; border:none; margin-left:50px; margin-top:10px; margin-bottom:20px;">
                        <strong>Fecha: <?php $ff=$f['fecha_parametro'];  echo substr($ff, 0, 10); ?></strong>
                    </li>
                </ul>
            </div>

            <?php } } ?>
        </div>

        <!--tabla de datos -->
        <div class="container" id="solicitudes4">

            <div class="row mt-5">

                <!-- table de proceso bi-fasico -->
                <div class="col-6">

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-uppercase text-center"><strong>proceso bi-fasico</strong></li>
                    </ul>
                    <br>
                    <table class="table table-sm table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Piscina</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Cant. de
                                        larva</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>G/Dia</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;">
                                    <strong>Increm3s</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Peso de
                                        pesca</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Dias</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Solicitar
                                        a</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;">
                                    <strong>Opciones</strong>
                                </th>
                            </tr>
                        </thead>
                        <?php
                            if(isset($_POST['search'])){

                            $fecha = $_POST['fechaRegistro'];
                            $sqlTablaParametro="SELECT * FROM parametro_camaronera_psc WHERE id_camaronera = '$camaronera' AND fecha_parametro = '$fecha' AND proceso = 'Bi-fasico' ORDER BY id_piscina ASC";
                            $dataParametro = $objeto->mostrar($sqlTablaParametro);
                            foreach ($dataParametro as $tp) { 
                                $id_piscina=$tp['id_piscina'];
                                $cantidad_ha=$tp['cantidad_ha'];
                                $gr_dias=$tp['gr_dias'];
                                $incremento=$tp['incre_3_sem'];
                                $peso=$tp['gramaje_pesca'];
                                $dias=$tp['dias_proceso'];
                            ?>

                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $id_piscina; ?></th>
                                <th scope="row"><?php echo $cantidad_ha; ?></th>
                                <th scope="row"><?php echo $gr_dias; ?></th>
                                <th scope="row"><?php echo $incremento; ?></th>
                                <th scope="row"><?php echo $peso; ?></th>
                                <th scope="row"><?php echo $dias; ?></th>
                                <th scope="row">
                                    <?php
                                    $a=($incremento/7)*$dias; 
                                    echo $b=number_format($peso-$a,2).' / Gr.';
                                ?>
                                </th>
                                <th scope="row">
                                    <a
                                        href="../controllers/proceso-parametro-piscina.php?cBiTri=<?php echo $tp['id_camaronera'];?>&transferir=<?php echo $tp['id_parametro'];?> "><i
                                            class="fas fa-share pl-5 text-primary"></i></a>

                                    <a data-toggle="modal"
                                        data-target=".bd-example-modal-lg<?php echo $tp['id_parametro']; ?>"><i
                                            class="fas fa-edit pl-5 text-danger"></i></a>

                                    <div class="modal fade bd-example-modal-lg<?php echo $id = $tp['id_parametro'];  ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="col-12">
                                                        <div class="widget bg-navy">
                                                            <div class="widget-body">
                                                                <div class="overlay">
                                                                    <i class="ik ik-refresh-ccw loading"></i>
                                                                    <span class="overlay-text"><?php ?></span>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <h6>PISCINA </h6>
                                                                    <h2>
                                                                        <?php 
                                                                            $sqlEdit="SELECT * FROM parametro_camaronera_psc WHERE id_parametro ='$id'"; 
                                                                            $dataParametro = $objeto->mostrar($sqlEdit);
                                                                            foreach ($dataParametro as $tp) {
                                                                                echo '#'. $tp['id_piscina'];
                                                                            
                                                                        ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <h5 class="text-white"> PARAMETROS DE SOLICITUD </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <form action="../controllers/editar-parametro-piscina.php"
                                                        method="POST">

                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Proceso de
                                                                siembra</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo $tp['proceso'] ?>" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Cantidad de
                                                                larva por
                                                                Ha</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="cantidad_ha"
                                                                    value="<?php echo $tp['cantidad_ha'] ?>">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Gramaje de
                                                                pesca</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="gramaje_pesca"
                                                                    value="<?php echo $tp['gramaje_pesca'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Dias</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="dias_proceso"
                                                                    value="<?php echo $tp['dias_proceso'] ?>">
                                                                <input type="hidden" class="form-control"
                                                                    name="camaronera"
                                                                    value="<?php echo $tp['id_camaronera'] ?>">
                                                                <input type="hidden" class="form-control" name="id"
                                                                    value="<?php echo $id; ?>">
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <button type="sumbit" class="btn btn-primary">Actualizar <i
                                                                class="fas fa-edit pl-5 text-white"></i></button>
                                                        <a href="../controllers/eliminar-parametro-piscina.php?delete=<?php echo $tp['id_parametro'];?> "
                                                            class="btn btn-danger">Eliminar <i
                                                                class="fas fa-trash-alt pl-5 text-white"></i> </a>
                                                        <br><br>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </th>
                            </tr>
                        </tbody><?php 
                            }

                        }else{

                            $sqlTablafecha="SELECT MAX(fecha_parametro) AS fecha_parametro FROM parametro_camaronera_psc ";
                            $datafecha = $objeto->mostrar($sqlTablafecha);
                            foreach ($datafecha as $f) {

                                $fecha=$f['fecha_parametro'];

                                $sqlTablaParametro="SELECT * FROM parametro_camaronera_psc WHERE fecha_parametro = '$fecha' AND proceso = 'Bi-fasico' ORDER BY id_piscina ASC";
                                $dataParametro = $objeto->mostrar($sqlTablaParametro);
                                foreach ($dataParametro as $tp) { 
                                    $id_piscina=$tp['id_piscina'];
                                    $cantidad_ha=$tp['cantidad_ha'];
                                    $gr_dias=$tp['gr_dias'];
                                    $incremento=$tp['incre_3_sem'];
                                    $peso=$tp['gramaje_pesca'] .'----';
                                    $dias=$tp['dias_proceso'];
                                ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $id_piscina; ?></th>
                                <th scope="row"><?php echo $cantidad_ha; ?></th>
                                <th scope="row"><?php echo $gr_dias; ?></th>
                                <th scope="row"><?php echo $incremento; ?></th>
                                <th scope="row"><?php echo $peso; ?></th>
                                <th scope="row"><?php echo $dias; ?></th>
                                <th scope="row">
                                    <?php
                                    $a=($incremento/7)*$dias; 
                                    echo $b=number_format($peso-$a,2).' / Gr.';
                                ?>
                                </th>
                                <th scope="row">
                                    <a
                                        href="../controllers/proceso-parametro-piscina.php?cBiTri=<?php echo $tp['id_camaronera'];?>&transferir=<?php echo $tp['id_parametro'];?> "><i
                                            class="fas fa-share pl-5 text-primary"></i></a>

                                    <a data-toggle="modal"
                                        data-target=".bd-example-modal-lg<?php echo $tp['id_parametro']; ?>"><i
                                            class="fas fa-edit pl-5 text-danger"></i></a>

                                    <div class="modal fade bd-example-modal-lg<?php echo $id = $tp['id_parametro'];  ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="col-12">
                                                        <div class="widget bg-navy">
                                                            <div class="widget-body">
                                                                <div class="overlay">
                                                                    <i class="ik ik-refresh-ccw loading"></i>
                                                                    <span class="overlay-text"><?php ?></span>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <h6>PISCINA </h6>
                                                                    <h2>
                                                                        <?php 
                                                                            $sqlEdit="SELECT * FROM parametro_camaronera_psc WHERE id_parametro ='$id'"; 
                                                                            $dataParametro = $objeto->mostrar($sqlEdit);
                                                                            foreach ($dataParametro as $tp) {
                                                                                echo '#'. $tp['id_piscina'];
                                                                            
                                                                        ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <h5 class="text-white"> PARAMETROS DE SOLICITUD </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <form action="../controllers/editar-parametro-piscina.php"
                                                        method="POST">
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Proceso de
                                                                siembra</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo $tp['proceso'] ?>" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Cantidad de
                                                                larva por
                                                                Ha</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="cantidad_ha"
                                                                    value="<?php echo $tp['cantidad_ha'] ?>">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Gramaje de
                                                                pesca</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="gramaje_pesca"
                                                                    value="<?php echo $tp['gramaje_pesca'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Dias</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="dias_proceso"
                                                                    value="<?php echo $tp['dias_proceso'] ?>">
                                                                <input type="hidden" class="form-control"
                                                                    name="camaronera"
                                                                    value="<?php echo $tp['id_camaronera'] ?>">
                                                                <input type="hidden" class="form-control" name="id"
                                                                    value="<?php echo $id; ?>">
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <button type="sumbit" class="btn btn-primary">Actualizar <i
                                                                class="fas fa-edit pl-5 text-white"></i></button>
                                                        <a href="../controllers/eliminar-parametro-piscina.php?delete=<?php echo $tp['id_parametro'];?> "
                                                            class="btn btn-danger">Eliminar <i
                                                                class="fas fa-trash-alt pl-5 text-white"></i> </a>
                                                        <br><br>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </th>
                            </tr>
                        </tbody><?php 
                                } 
                            } 
                        } 
                    ?>
                    </table>
                </div>

                <!-- table de proceso tri-fasico -->
                <div class="col-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item text-uppercase text-center"><strong>proceso tri-fasico</strong></li>
                    </ul>
                    <br>
                    <table class="table table-sm table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Piscina</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Cant. de
                                        larva</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>G/Dia</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;">
                                    <strong>Increm3s</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Peso de
                                        pesca</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Dias</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Solicitar
                                        a</strong>
                                </th>
                                <th class="text-white" scope="col" style="background: #404e67;"><strong>Accion</strong>
                                </th>
                            </tr>
                        </thead>
                        <?php
                        if(isset($_POST['search'])){

                            $fecha = $_POST['fechaRegistro'];
                            $sqlTablaParametroTri="SELECT * FROM parametro_camaronera_psc WHERE fecha_parametro = '$fecha' AND proceso = 'Tri-fasico' ORDER BY id_piscina ASC";
                            $dataParametroTri = $objeto->mostrar($sqlTablaParametroTri);
                            foreach ($dataParametroTri as $tri) { ?>

                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $tri['id_piscina']?></th>
                                <th scope="row"><?php echo $tri['cantidad_ha']?> </th>
                                <th scope="row"><?php echo $tri['gr_dias']?></th>
                                <th scope="row"><?php echo $tri['incre_3_sem']?></th>
                                <th scope="row"><?php echo $tri['gramaje_pesca']?></th>
                                <th scope="row"><?php echo $tri['dias_proceso']?></th>
                                <th scope="row">
                                    <?php
                                    $a=($incremento/7)*$dias; 
                                    echo $b=number_format($peso-$a,2).' / Gr.';
                                ?>
                                </th>
                                <th scope="row">
                                    <a
                                        href="../controllers/proceso-parametro-piscina.php?cTriBi=<?php echo $tri['id_camaronera'];?>&transferir=<?php echo $tri['id_parametro'];?> "><i
                                            class="fas fa-reply pl-5 text-primary"></i></a>

                                    <a data-toggle="modal" data-target=".modals<?php echo $tri['id_parametro']; ?>"><i
                                            class="fas fa-edit pl-5 text-danger"></i></a>

                                    <div class="modal fade modals<?php echo $id = $tri['id_parametro'];  ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="col-12">
                                                        <div class="widget bg-navy">
                                                            <div class="widget-body">
                                                                <div class="overlay">
                                                                    <i class="ik ik-refresh-ccw loading"></i>
                                                                    <span class="overlay-text"><?php ?></span>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <h6>PISCINA </h6>
                                                                    <h2>
                                                                        <?php 
                                                                            $sqlEdit="SELECT * FROM parametro_camaronera_psc WHERE id_parametro ='$id'"; 
                                                                            $dataParametro = $objeto->mostrar($sqlEdit);
                                                                            foreach ($dataParametro as $tp) {
                                                                                echo '#'. $tp['id_piscina'];
                                                                            
                                                                        ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <h5 class="text-white"> PARAMETROS DE SOLICITUD </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <form action="../controllers/editar-parametro-piscina.php"
                                                        method="POST">
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Proceso de
                                                                siembra</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo $tp['proceso'] ?>" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Cantidad de
                                                                larva por
                                                                Ha</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="cantidad_ha"
                                                                    value="<?php echo $tp['cantidad_ha'] ?>">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Gramaje de
                                                                pesca</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="gramaje_pesca"
                                                                    value="<?php echo $tp['gramaje_pesca'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Dias</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="dias_proceso"
                                                                    value="<?php echo $tp['dias_proceso'] ?>">
                                                                <input type="hidden" class="form-control"
                                                                    name="camaronera"
                                                                    value="<?php echo $tp['id_camaronera'] ?>">
                                                                <input type="hidden" class="form-control" name="id"
                                                                    value="<?php echo $id; ?>">
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <button type="sumbit" class="btn btn-primary">Actualizar <i
                                                                class="fas fa-edit pl-5 text-white"></i></button>
                                                        <a href="../controllers/eliminar-parametro-piscina.php?delete=<?php echo $tp['id_parametro'];?> "
                                                            class="btn btn-danger">Eliminar <i
                                                                class="fas fa-trash-alt pl-5 text-white"></i> </a>
                                                        <br><br>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </th>
                            </tr>
                        </tbody><?php 
                            }

                        }else{

                            $sqlTablafechaTri="SELECT MAX(fecha_parametro) AS fecha_parametro FROM parametro_camaronera_psc";
                            $datafechaTri = $objeto->mostrar($sqlTablafechaTri);
                            foreach ($datafechaTri as $f) {

                                $fecha=$f['fecha_parametro'];

                                $sqlTablaParametroTri="SELECT * FROM parametro_camaronera_psc WHERE fecha_parametro = '$fecha' AND proceso = 'Tri-fasico' ORDER BY id_piscina ASC";
                                $dataParametroTri = $objeto->mostrar($sqlTablaParametroTri);
                                foreach ($dataParametroTri as $tri) { ?>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $tri['id_piscina']?></th>
                                <th scope="row"><?php echo $tri['cantidad_ha']?> </th>
                                <th scope="row"><?php echo $tri['gr_dias']?></th>
                                <th scope="row"><?php echo $incremento=$tri['incre_3_sem']?></th>
                                <th scope="row"><?php echo $peso=$tri['gramaje_pesca']?></th>
                                <th scope="row"><?php echo $dias=$tri['dias_proceso']?></th>
                                <th scope="row">
                                    <?php
                                    $a=($incremento/7)*$dias; 
                                    echo $b=number_format($peso-$a,2).' / Gr.';
                                ?>
                                </th>
                                <th scope="row">
                                    <a
                                        href="../controllers/proceso-parametro-piscina.php?cTriBi=<?php echo $tri['id_camaronera'];?>&transferir=<?php echo $tri['id_parametro'];?> "><i
                                            class="fas fa-reply pl-5 text-primary"></i></a>

                                    <a data-toggle="modal" data-target=".modals<?php echo $tri['id_parametro']; ?>"><i
                                            class="fas fa-edit pl-5 text-danger"></i></a>

                                    <div class="modal fade modals<?php echo $id = $tri['id_parametro'];  ?>"
                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="col-12">
                                                        <div class="widget bg-navy">
                                                            <div class="widget-body">
                                                                <div class="overlay">
                                                                    <i class="ik ik-refresh-ccw loading"></i>
                                                                    <span class="overlay-text"><?php ?></span>
                                                                </div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <h6>PISCINA </h6>
                                                                    <h2>
                                                                        <?php 
                                                                            $sqlEdit="SELECT * FROM parametro_camaronera_psc WHERE id_parametro ='$id'"; 
                                                                            $dataParametro = $objeto->mostrar($sqlEdit);
                                                                            foreach ($dataParametro as $tri) {
                                                                                echo '#'. $tri['id_piscina'];
                                                                            
                                                                        ?>
                                                                    </h2>
                                                                </div>
                                                            </div>
                                                            <h5 class="text-white"> PARAMETROS DE SOLICITUD </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container">
                                                    <form action="../controllers/editar-parametro-piscina.php"
                                                        method="POST">
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Proceso de
                                                                siembra</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    value="<?php echo $tri['proceso'] ?>" readonly>

                                                            </div>
                                                        </div>
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Cantidad de
                                                                larva por
                                                                Ha</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="cantidad_ha"
                                                                    value="<?php echo $tri['cantidad_ha'] ?>">

                                                            </div>
                                                        </div>
                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Gramaje de
                                                                pesca</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="gramaje_pesca"
                                                                    value="<?php echo $tri['gramaje_pesca'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row container">
                                                            <label for="" class="col-sm-2 col-form-label">Dias</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control"
                                                                    name="dias_proceso"
                                                                    value="<?php echo $tri['dias_proceso'] ?>">
                                                                <input type="hidden" class="form-control"
                                                                    name="camaronera"
                                                                    value="<?php echo $tri['id_camaronera'] ?>">
                                                                <input type="hidden" class="form-control" name="id"
                                                                    value="<?php echo $id; ?>">
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                        <button type="sumbit" class="btn btn-primary">Actualizar <i
                                                                class="fas fa-edit pl-5 text-white"></i></button>
                                                        <a href="../controllers/eliminar-parametro-piscina.php?delete=<?php echo $tri['id_parametro'];?> "
                                                            class="btn btn-danger">Eliminar <i
                                                                class="fas fa-trash-alt pl-5 text-white"></i> </a>
                                                        <br><br>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </th>
                            </tr>
                        </tbody><?php 
                                } 
                            } 
                        } 
                    ?>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

<style>
.inputParametroPsc {
    width: 50px;
    margin-left: 25px;
    text-align: center;
}

.inputParametroCant {
    width: 300px;
    margin-left: 35px;
    text-align: center;
}


</style>

<script>
let input = document.getElementById("NumberCant");

input.addEventListener("input", function() {
    let valor = input.value;

    if (valor.length < 5) {
        input.setCustomValidity("El campo debe tener al menos 5 caracteres.");
    } else if (valor.length > 6) {
        input.setCustomValidity("El campo no debe tener más de 6 caracteres.");
    } else {
        input.setCustomValidity("");
    }
});

//ocultar contenido de solictud de larva
var elemento = document.getElementById("ventas");
elemento.style.display = "none";

var solicitud_sms = document.getElementById("solicitud_sms");
solicitud_sms.style.background = "#900C3F";

var solicitud_sms = document.getElementById("solicitud_sms");
solicitud_sms.style.color = "white";

var venta_sms = document.getElementById("venta_sms");
venta_sms.style.background = "white";

var venta_sms = document.getElementById("venta_sms");
venta_sms.style.color = "black";







function solicitud() {

    //ocultar contenido de solictud de larva
    var elemento = document.getElementById("solicitudes");
    elemento.style.display = "block";
    var elemento2 = document.getElementById("solicitudes2");
    elemento2.style.display = "block";
    var elemento3 = document.getElementById("solicitudes3");
    elemento3.style.display = "block";
    var elemento4 = document.getElementById("solicitudes4");
    elemento4.style.display = "block";
    var elemento5 = document.getElementById("mensaje");
    elemento5.style.display = "block";
    var solicitud_sms = document.getElementById("solicitud_sms");
    solicitud_sms.style.background = "#900C3F";
    var solicitud_sms = document.getElementById("solicitud_sms");
    solicitud_sms.style.color = "white";
    var venta_sms = document.getElementById("venta_sms");
    venta_sms.style.background = "white";
    var venta_sms = document.getElementById("venta_sms");
    venta_sms.style.color = "black";
    //mostar contenido venta
    var elemento = document.getElementById("ventas");
    elemento.style.display = "none";


}

function venta() {

    //ocultar contenido de solictud de larva
    var elemento = document.getElementById("ventas");
    elemento.style.display = "block";

    //mostrar contenido de solicitu de larva
    var elemento = document.getElementById("solicitudes");
    elemento.style.display = "none";
    var elemento2 = document.getElementById("solicitudes2");
    elemento2.style.display = "none";
    var elemento3 = document.getElementById("solicitudes3");
    elemento3.style.display = "none";
    var elemento4 = document.getElementById("solicitudes4");
    elemento4.style.display = "none";
    var elemento5 = document.getElementById("mensaje");
    elemento5.style.display = "none";
    var solicitud_sms = document.getElementById("solicitud_sms");
    solicitud_sms.style.background = "white";
    var solicitud_sms = document.getElementById("solicitud_sms");
    solicitud_sms.style.color = "black";
    var venta_sms = document.getElementById("venta_sms");
    venta_sms.style.background = "#900C3F";
    var venta_sms = document.getElementById("venta_sms");
    venta_sms.style.color = "white";

}
function biomasa() {
                var biomasa_sms = document.getElementById("biomasa_sms");
    biomasa_sms.style.background = "#900C3F";
    biomasa_sms.style.color = "white";
     var solicitud_sms = document.getElementById("solicitud_sms");
    solicitud_sms.style.background = "white";
    var solicitud_sms = document.getElementById("solicitud_sms");
    solicitud_sms.style.color = "black";
    var venta_sms = document.getElementById("venta_sms");
    venta_sms.style.background = "white";
    var venta_sms = document.getElementById("venta_sms");
    venta_sms.style.color = "black";
                window.location.href="../views/index.php?page=parametrosbio";
}
</script>