<?php

    if (isset($_GET['buscar'])) {

        $dia = date("Y-m-d", strtotime($buscar_datos_fecha . "- 7 days"));
    } else if (isset($_GET['siguiente'])) {

        $hasta = date('Y-m-d', strtotime($desde . ' + 6 days', strtotime('this sunday')));
        $fechaActual = date('Y-m-d');

        $dia = $buscar_datos_fecha_siguiente;
    }

    $hasta = date('Y-m-d', strtotime($dia . ' + 6 days', strtotime('this sunday')));
    $dia_dos = strtotime($dia . "+ 1 days");
    $dia_tres = strtotime($dia . "+ 2 days");
    $dia_cuatro = strtotime($dia . "+ 3 days");
    $dia_cinco = strtotime($dia . "+ 4 days");
    $dia_seis = strtotime($dia . "+ 5 days");
    $dia_siete = strtotime($dia . "+ 6 days");

    if ($hasta >= $fechaActual) {
        echo '<script language="javascript">window.location.href="../views/index.php?page=Reporte-semanal"</script>';
    }

?>

<div class="row">
    <div class="col-12">
        <div class="px-0 pb-2">
            <div style="margin-top: -30px;">
                <center> <a href="index.php?buscar=<?php echo $dia; ?> " class="enlace btn btn-sm mb-3">
                        << <?php $dia; echo $newDate = date("d-m-y", strtotime($dia)); ?></a>
                            <a href="index.php?siguiente=<?php echo $hasta = date('Y-m-d', strtotime($hasta . "+ 1 days")); ?> "
                                class="enlace btn btn-sm mb-3">
                                <?php  $dx = date('Y-m-d', strtotime($hasta . "- 1 days")); echo $newDate2 = date("d-m-y", strtotime($dx));  ?>
                                >> </a></center>
            </div>


            <div class="table table-sm table-responsive">
                <!-- Tabla alimentacion diaria de piscinas -->


                <div class="" style="background: #028E8C; border: solid 2px white; width:530px; margin:auto;">
                    <h6 class="text-white text-center mt-2 text-uppercase" style="font-size:12px;"> <strong>Alimentacion
                            diaria de piscinas de engorde y precrias en proceso</strong></h6>
                </div>

                <?php if($roles == "superadmin"){ ?>
                <!--div class="d-flex bd-highlight" style="margin-left:5px; margin-top:20px;">
                    <div class="bd-highlight">
                        <form action="index.php?page=Reporte-semanal" method="POST">
                            <select class="form-control text-white" name="search" id="camaronera"
                                onchange="this.form.submit()" method="POST" style="background:#404e67;">
                                <option value="<?php echo 'Seleccione' ?>" style="background:#404e67; color:black;">
                                    <?php echo 'Seleccione camaronera'; ?>
                                </option>
                                <?php
    
                                                $objeto_tabla_camaronera = new corrida();
                                            echo   $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera ";
                                                $data_camaronera = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);?>

                                <?php foreach ($data_camaronera as $value_camaronera) { ?>
                                <option value="<?php echo $value_camaronera['id_camaronera']; ?>"
                                    style="background:#F9F4F4; color:black;">
                                    <?php echo $value_camaronera['descripcion_camaronera']; ?>
                                </option>

                                <?php } ?>
                            </select>
                        </form>
                    </div>
                </div-->
                <?php } ?>

                <div class="scroll mt-5">
                    <table class="table table-sm tab table-striped">
                        <thead>

                        <tr class="text-center" style="border: solid 2px #343a40">

                            <th style="background: #555557; border: solid 2px #343a40; color:white;">Ps</th>

                            <th style="background: #555557; border: solid 2px #343a40; color:white;">Ha</th>

                            <th style="background: #555557; border: solid 2px #343a40; color:white;">Balanc </th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                Lun<strong><?php $uno = date('Y-m-d', strtotime('next Monday -1 week'));; ?></strong></th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mar
                                <?php $dos = date('Y-m-d', $dia_dos); ?></th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mie
                                <?php $tres = date('Y-m-d', $dia_tres); ?></th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Jue
                                <?php $cuatro = date('Y-m-d', $dia_cuatro); ?></th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Vie
                                <?php $cinco = date('Y-m-d', $dia_cinco); ?></th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Sab
                                <?php $seis = date('Y-m-d', $dia_seis); ?></th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Dom
                                <?php $siete = date('Y-m-d', $dia_siete); ?></th>

                            <th style="background: #555557; border: solid 2px #343a40; color:white;">Acum. </br> Sem.</th>

                            <th style="background: #555557; border: solid 2px #343a40; color:white;">Acum. </br> Total</th>

                            <th style="background: #555557; border: solid 2px #343a40; color:white;">Días</th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Inc.</br>Mie</th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Peso</br> Sem </th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Inc.</br>14 d</th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Inc.</br>7 d</th>

                            <th style="background: #404e67; color:white; border: solid 2px #343a40;">Inc.</br>act.</th>

                            <th style="background: #555557; border: solid 2px #343a40; color:white;">Dens.</th>

                            <th style="background: #555557; border: solid 2px #343a40; color:white;">F.C.</th>


                        </tr>
                        </thead>

                        <tbody>

                            <?php

                            $sql_piscina = "SELECT DISTINCT id_piscina, id_corrida, hectareas FROM registro_piscina_engorde WHERE estado LIKE 'En proceso' AND id_camaronera = '$camaronera' ORDER BY id_piscina ASC";
                            $data = $objeto->mostrar($sql_piscina);
                            $array = array();
                            $suma = 0;
                            $cont = 0;
                            $suma_0 = 0;
                            $cont_0 = 0;
                            $suma_1 = 0;
                            $cont_1 = 0;
                            foreach ($data as $value) {

                                $psm = $value['id_piscina'];
                                $pcm = $value['id_corrida'];

                            ?>

                            <tr style="border: 2px solid #40497C">

                                <!-- numero de piscina -->
                                <td class="align-middle text-center" data-toggle="modal"
                                    data-target=".bd-example-modal-sm<?php echo $psm; ?>"
                                    style="border: 1px solid #40497C">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        <?php   
                                                 

                                                    //echo $aux = $value['id_piscina'];
                                                    $aux_corrida = $value['id_corrida']; 

                                                    if($camaronera == 2){

                                                        if($value['id_piscina'] == 17){
                                                            
                                                            echo '17A';
                                                            $aux = $value['id_piscina'];
                                                            
                                                        }else if($value['id_piscina'] == 22 ){
                                                            echo '17B';
                                                            $aux = 22;
                                                        }else if($value['id_piscina'] == 23){
                                                            echo '15A';
                                                            $aux = 23;
                                                        }
                                                        else if($value['id_piscina'] == 24){
                                                            echo '15B';
                                                            $aux = 24;
                                                        }else{
                                                            echo $aux = $value['id_piscina'];
                                                        }
                                                    }else{
                                                        echo $aux = $value['id_piscina'];
                                                    }
                                            ?>
                                    </span>
                                    <?php include 'modal-alimento-busqueda.php'; ?>
                                </td>

                                <!-- hectareas de picina -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        <?php echo  $ha = $value['hectareas']; ?>
                                    </span>
                                </td>

                                <!-- tipo alimento de piscina -->
                                <?php
                                        $sql = "SELECT MAX(fecha_alimentacion) FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            echo $xt['fecha_alimentacion'];

                                            
                                            $sql = "SELECT id_tipo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$fch'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $xt) {

                                                $t = $xt['id_tipo_alimento'];

                                                $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                                $data = $objeto->mostrar($sql);
                                                foreach ($data as $xx) {
                                                    $td = $xx['descripcion_alimento'];
                                                    $tg = $xx['gramaje_alimento'];
                                                }
                                            }
                                        }
                                    ?>
                                <td class="align-middle text-center" style="border: 1px solid #40497C">

                                    <span class="text-secondary text-xs font-weight-bold">
                                        <?php

                                                if ($td == null || $td == "") {
                                                    echo 'Sin alimento';
                                                }else{

                                                    if ($td.' '.$tg == 'Katal 2.0') {
                                                        echo 'KTL 2.0';
                                                    }else if ($td.' '.$tg == 'Classic 1.2') {
                                                        echo 'CLA 1.2';
                                                    }else if ($td.' '.$tg == 'Classic ad equilibrium 2.0') {
                                                        echo 'CLAEQAD 2.0';
                                                    }else if ($td.' '.$tg == 'Masterline 5.0') {
                                                        echo 'MSTL 5.0';
                                                    }else if ($td.' '.$tg == 'Classic ad equilibrium Bio 2.0') {
                                                        echo 'CLAEQAD BIO 2.0';
                                                    }else if ($td.' '.$tg == 'Finalis Equilibre 2.0') {
                                                        echo 'FNLS EQ 2.0';
                                                    }else{
                                                        echo $td.' '.$tg;
                                                    }
                                                } 
                                            ?>
                                    </span>

                                </td>

                                <!-- cantidad dia lunes -->

                                <?php

                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$dia'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            $t = $xt['id_tipo_alimento'];
                                            $observacion = $xt['metodo_alimento'];

                                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                            $data = $objeto->mostrar($sql);
                                            
                                            foreach ($data as $xx) {
                                                $td = $xx['descripcion_alimento'];
                                                $tg = $xx['gramaje_alimento'];
                                                
                                            }
                                        }
                                    ?>
                                <td class="align-middle text-center"
                                    title="<?php echo $td.' '. $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }  ?>"
                                    style="border: 1px solid #40497C">
                                    <?php

                                        $sql_uno = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$dia' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_uno = $objeto->mostrar($sql_uno);
                                        foreach ($data_uno as $x) {

                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia martes -->

                                <?php

                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$dos'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            $t = $xt['id_tipo_alimento'];
                                            $observacion = $xt['metodo_alimento'];

                                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                            $data = $objeto->mostrar($sql);
                                            
                                            foreach ($data as $xx) {
                                                $td = $xx['descripcion_alimento'];
                                                $tg = $xx['gramaje_alimento'];
                                                
                                            }
                                        }
                                    ?>

                                <td class="align-middle text-center"
                                    title="<?php echo $td.' '. $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }  ?>"
                                    style="border: 1px solid #40497C">
                                    <?php

                                        $sql_dos = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$dos' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_dos = $objeto->mostrar($sql_dos);
                                        foreach ($data_dos as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia miercoles -->

                                <?php

                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$tres'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            $t = $xt['id_tipo_alimento'];
                                            $observacion = $xt['metodo_alimento'];

                                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                            $data = $objeto->mostrar($sql);
                                            
                                            foreach ($data as $xx) {
                                                $td = $xx['descripcion_alimento'];
                                                $tg = $xx['gramaje_alimento'];
                                                
                                            }
                                        }
                                    ?>

                                <td class="align-middle text-center"
                                    title="<?php echo $td.' '. $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }  ?>"
                                    style="border: 1px solid #40497C">
                                    <?php

                                        $sql_tres = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$tres' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_tres = $objeto->mostrar($sql_tres);
                                        foreach ($data_tres as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']) ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia jueves -->

                                <?php

                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$cuatro'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            $t = $xt['id_tipo_alimento'];
                                            $observacion = $xt['metodo_alimento'];

                                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                            $data = $objeto->mostrar($sql);
                                            
                                            foreach ($data as $xx) {
                                                $td = $xx['descripcion_alimento'];
                                                $tg = $xx['gramaje_alimento'];
                                                
                                            }
                                        }
                                    ?>

                                <td class="align-middle text-center"
                                    title="<?php echo $td.' '. $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; } ?>"
                                    style="border: 1px solid #40497C">
                                    <?php

                                        $sql_cuatro = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$cuatro' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_cuatro = $objeto->mostrar($sql_cuatro);
                                        foreach ($data_cuatro as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia viernes -->

                                <?php

                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$cinco'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            $t = $xt['id_tipo_alimento'];
                                            $observacion = $xt['metodo_alimento'];

                                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                            $data = $objeto->mostrar($sql);
                                            
                                            foreach ($data as $xx) {
                                                $td = $xx['descripcion_alimento'];
                                                $tg = $xx['gramaje_alimento'];
                                                
                                            }
                                        }
                                    ?>

                                <td class="align-middle text-center"
                                    title="<?php echo $td.' '. $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; } ?>"
                                    style="border: 1px solid #40497C">
                                    <?php

                                        $sql_cinco = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$cinco' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_cinco = $objeto->mostrar($sql_cinco);
                                        foreach ($data_cinco as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia sabado -->

                                <?php

                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$seis'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            $t = $xt['id_tipo_alimento'];
                                            $observacion = $xt['metodo_alimento'];

                                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                            $data = $objeto->mostrar($sql);
                                            
                                            foreach ($data as $xx) {
                                                $td = $xx['descripcion_alimento'];
                                                $tg = $xx['gramaje_alimento'];
                                                
                                            }
                                        }
                                    ?>

                                <td class="align-middle text-center"
                                    title="<?php echo $td.' '. $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }  ?>"
                                    style="border: 1px solid #40497C">
                                    <?php

                                        $sql_seis = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$seis' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_seis = $objeto->mostrar($sql_seis);
                                        foreach ($data_seis as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia domingo    -->

                                <?php

                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$siete'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            $t = $xt['id_tipo_alimento'];
                                            $observacion = $xt['metodo_alimento'];

                                            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                            $data = $objeto->mostrar($sql);
                                            
                                            foreach ($data as $xx) {
                                                $td = $xx['descripcion_alimento'];
                                                $tg = $xx['gramaje_alimento'];
                                                
                                            }
                                        }
                                    ?>

                                <td class="align-middle text-center"
                                    title="<?php echo $td.' '. $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; } ?>"
                                    style="border: 1px solid #40497C">
                                    <?php

                                        $sql_siete = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$siete' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_siete = $objeto->mostrar($sql_siete);
                                        foreach ($data_siete as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- acumulado semanal -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$dia' AND fecha_alimentacion <= '$dx' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_semanal = $objeto->mostrar($sql_semanal);

                                        foreach ($data_semanal as $values_semanal) {
                                            $acum_semanal = $values_semanal['total']; ?>
                                    <span class="text-secondary text-xs font-weight-bold">
                                        <?php

                                                if (floatval($acum_semanal) == 0.00) {

                                                    echo $acum = 0;
                                                } else {

                                                    echo intval($acum_semanal);
                                                }
                                                ?>
                                    </span>
                                    <?php } ?>
                                </td>

                                <!-- acumulado total-->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_acumulado = "SELECT SUM(cantidad + cantidad_2) AS total FROM `registro_alimentacion_engorde` WHERE fecha_alimentacion <= '$dx' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_acumulado = $objeto->mostrar($sql_acumulado);

                                        foreach ($data_acumulado as $acumulado) {
                                            $acum = $acumulado['total'];  ?>
                                    <span class="text-xs font-weight-bold">
                                        <strong>
                                            <?php

                                                    if (floatval($acum) == 0.00) {

                                                        $acum = 0;
                                                    } else {

                                                        echo intval($acum);
                                                    }
                                                    ?></strong></span>
                                    <?php } ?>
                                </td>

                                <!-- dias transcurridos -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_siembra = "SELECT fecha_siembra FROM `registro_piscina_engorde` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND estado = 'En proceso'";
                                        $data_siembra = $objeto->mostrar($sql_siembra);

                                        foreach($data_siembra as $value_siembra){
                                            $siembra = $value_siembra['fecha_siembra'];
                                        }

                                        //$sql_dias = "SELECT fecha_siembra FROM `registro_piscina_engorde` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND fecha_siembra <= '$dia' AND id_corrida = '$aux_corrida' AND estado = 'En proceso'";
                                        //$data_dias = $objeto->mostrar($sql_dias);

                                        //foreach ($data_dias as $values_dias) {
                                           // $siembra = $values_dias['fecha_siembra'];
                                        //}

                                        $fecha1 = new DateTime($siembra);
                                        $fecha2 = new DateTime($dx);
                                        $diff = $fecha1->diff($fecha2);
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php if($acum > 0 ){ echo  $diff->days; } else { echo 0; }  ?></span>
                                </td>

                                <!-- peso miercoles -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $df = date("Y-m-d", strtotime($hasta . "- 8 days"));
                                        $sql = "SELECT MAX(peso) as peso FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$df'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $x) {
                                            $m = $x['peso'] . '</br>';
                                        }

                                        $sql = "SELECT  MAX(fecha_peso) as fecha_peso FROM registro_peso WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_peso = '$tres'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $x) {
                                            $fm = $x['fecha_peso'];
                                        }

                                        $sql = "SELECT peso FROM registro_peso WHERE fecha_peso = '$fm' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $x) {
                                            $mm = $x['peso'];
                                        }
                                        ?>

                                    <span class="text-secondary text-xs font-weight-bold">
                                        <?php
                                            $r = sprintf('%.2f', abs($m - $mm));
                                            if ($r >= 3.00) {
                                                echo $r = 0;
                                            } else {
                                                echo $r = $r;
                                            }
                                            ?>
                                    </span>
                                    <?php ?>
                                </td>

                                <!-- peso muestreo -->
                                <?php

                                    $sql_peso_actual = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx'";
                                    $data_peso_actual = $objeto->mostrar($sql_peso_actual);

                                    foreach ($data_peso_actual as $values_peso_actual) {
                                        $peso1 = $values_peso_actual['total'];
                                    }

                                    ?>

                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <span class="text-secondary text-xs font-weight-bold"><?php if ($peso1 == 0 || $peso1 == null) {
                                                                                                    echo $peso1 = 0.00;
                                                                                                } else {
                                                                                                    echo  $peso1;
                                                                                                } ?></span>
                                </td>


                                <!-- incremento -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php
                                        $dx_14 = date('Y-m-d', strtotime($hasta . "- 15 days"));
                                        #incremento anterior
                                        $sql = "SELECT MAX(incremento) AS total FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx_14'";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $values_peso_actual) {
                                            $peso1 = floatval($values_peso_actual['total']);
                                            $suma_0 += $peso1;
                                            if ($peso1 > 0) {
                                                $cont_0 += 1;
                                            }
                                        }
                                        if ($peso1 < 2.00) {
                                            echo  ' <span class="text-danger text-xs font-weight-bold">' . abs($peso1) . '</span>';
                                        } else {
                                            echo  ' <span class="text-secondary text-xs font-weight-bold">' . abs($peso1) . '</span>';
                                        }

                                        ?>

                                </td>

                                <!-- incremento -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php
                                        $dx_7 = date('Y-m-d', strtotime($hasta . "- 8 days"));
                                        #incremento anterior
                                        $sql = "SELECT MAX(incremento) AS total FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx_7'";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $values_peso_actual) {
                                            $peso1 = floatval($values_peso_actual['total']);
                                            $suma_1 += $peso1;
                                            if ($peso1 > 0) {
                                                $cont_1 += 1;
                                            }
                                        }
                                        if ($peso1 < 2.00) {
                                            echo  ' <span class="text-danger text-xs font-weight-bold">' . abs($peso1) . '</span>';
                                        } else {
                                            echo  ' <span class="text-secondary text-xs font-weight-bold">' . abs($peso1) . '</span>';
                                        }

                                        ?>

                                </td>

                                <!-- incremento -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php
                                        #incremento anterior
                                        $sql = "SELECT MAX(incremento) AS total FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx'";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $values_peso_actual) {
                                            $peso1 = floatval($values_peso_actual['total']);
                                            $suma += $peso1;
                                            if ($peso1 > 0) {
                                                $cont += 1;
                                            }
                                        }

                                        if ($peso1 < 2.00) {
                                            echo  ' <span class="text-danger text-xs font-weight-bold">' . abs($peso1) . '</span>';
                                        } else {
                                            echo  ' <span class="text-secondary text-xs font-weight-bold">' . abs($peso1) . '</span>';
                                        }

                                        ?>

                                </td>

                                <!-- densidad -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php
                                        $sql_densidad = "SELECT MAX(densidad) AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx'";
                                        $data_densidad = $objeto->mostrar($sql_densidad);

                                        foreach ($data_densidad as $values_densidad) {
                                            $densidad = $values_densidad['densidad'];
                                        }
                                        ?>
                                    <span class="text-secondary text-xs font-weight-bold"><?php if ($densidad == 0 || $densidad == null) {
                                                                                                    echo $densidad = 0;
                                                                                                } else {
                                                                                                    echo  intval($densidad);
                                                                                                }  ?></span>
                                </td>

                                <!-- factor de conversion -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx'";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $key) {
                                            $peso1 = $key['total'];
                                        }

                                        if($densidad > 0){

                                            $sql_raleo = "SELECT SUM(libras_pescadas) AS libras_pescadas FROM `registro_pesca_engorde` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' ";
                                            $data_raleo = $objeto->mostrar($sql_raleo);

                                            foreach ($data_raleo as $key_raleo) {
                                                $raleo = $key_raleo['libras_pescadas']*$ha;
                                            }

                                            $r1=$acum * 2.204;
                                            $r2=($densidad * $peso1 * 0.0022) *$ha;
                                            $r3=$raleo;
                                            $r4=$r2+$r3;
                                            $factor=$r1/$r4;

                                        }else{

                                            $factor = $acum / (($densidad * $peso1 / 1000) * $ha);
                                        }

                                        ?>
                                    <span class="text-secondary text-xs font-weight-bold"> <?php if ($factor == 0 || $factor == null) {
                                                                                                    echo $factor = 0;
                                                                                                } else {
                                                                                                    echo number_format($factor, 2);
                                                                                                }; ?>
                                    </span>
                                </td>

                                <?php } ?>

                            </tr>

                            <!-- promedio -->

                            <tr style="background: #555557; border: solid 2px #343a40; color:white;">
                                <td class="align-middle text-right" colspan="15" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-right text-xs font-weight-bold">PROMEDIO</span>
                                </td>

                                <td class="align-middle text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <?php
                                    if ($suma_0 > 0) {
                                        $promedio_0 = floatval($suma_0) / floatval($cont_0);
                                    } else {
                                        $promedio_0 = 0;
                                    }
                                    ?>
                                    <span class="text-white text-xs font-weight-bold" style="background: #555557; "><?php echo number_format($promedio_0, 2); ?></span>
                                </td>

                                <td class="align-middle text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <?php
                                    if ($suma_1 > 0) {
                                        $promedio_1 = floatval($suma_1) / floatval($cont_1);
                                    } else {
                                        $promedio_1 = 0;
                                    }
                                    ?>
                                    <span class="text-white text-xs font-weight-bold"><?php echo number_format($promedio_1, 2); ?></span>
                                </td>

                                <td class="align-middle text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <?php
                                    if ($suma > 0) {
                                        $promedio = floatval($suma) / floatval($cont);
                                    } else {
                                        $promedio = 0;
                                    }
                                    ?>
                                    <span class="text-white text-xs font-weight-bold"><?php echo number_format($promedio, 2); ?></span>
                                </td>
                                <td class="align-middle text-right" colspan="5"
                                style="background: #555557; border: solid 2px #343a40;">
                                    <span class="text-white text-right text-xs font-weight-bold"></span>
                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>

                <!-- Tabla alimentacion diaria de precrias -->

                <div class="scroll">
                    <table class="table table-sm tab table-striped col-7">
                        <thead>
                            <tr class="text-center" style="border: solid 2px #343a40">

                                <th style="background: #555557; border: solid 2px #343a40; color:white;">Ps</th>

                                <th style="background: #555557; border: solid 2px #343a40; color:white;">Ha</th>

                                <th style="background: #555557; border: solid 2px #343a40; color:white;">Balanc</th>


                                <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                    Lun<strong><?php $uno = $desde; ?></strong></th>

                                <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mar
                                    <?php $dos = date('Y-m-d', $dia_dos); ?></th>

                                <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mie
                                    <?php $tres = date('Y-m-d', $dia_tres); ?></th>

                                <th style="background: #404e67; color:white; border: solid 2px #343a40;">Jue
                                    <?php $cuatro = date('Y-m-d', $dia_cuatro); ?></th>

                                <th style="background: #404e67; color:white; border: solid 2px #343a40;">Vie
                                    <?php $cinco = date('Y-m-d', $dia_cinco); ?></th>

                                <th style="background: #404e67; color:white; border: solid 2px #343a40;">Sab
                                    <?php $seis = date('Y-m-d', $dia_seis); ?></th>

                                <th style="background: #404e67; color:white; border: solid 2px #343a40;">Dom
                                    <?php $siete = date('Y-m-d', $dia_siete); ?></th>

                                <th style="background: #555557; border: solid 2px #343a40; color:white;">Acum. </br> Sem.</th>

                                <th style="background: #555557; border: solid 2px #343a40; color:white;">Acum. </br> Total</th>

                                <th style="background: #555557; border: solid 2px #343a40; color:white;">Días</th>



                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            $sql_precria = "SELECT DISTINCT id_precria, hectareas, identificacion  FROM registro_piscina_precria WHERE estado LIKE 'En proceso' AND id_camaronera = '$camaronera' ORDER BY id_precria ASC";
                            $data_precria = $objeto->mostrar($sql_precria);
                            $array = array();

                            foreach ($data_precria as $value_pre) {
                                $pre = $value_pre['id_precria'];
                                $iden = $value_pre['identificacion'];

                            ?>

                            <tr>

                                <!-- numero de piscina -->
                                <td class="align-middle text-center" data-toggle="modal"
                                    style="border: 1px solid #40497C">
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo $aux = $value_pre['id_precria']; ?></span>
                                </td>

                                <!-- hectareas de precria -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo $value_pre['hectareas']; ?></span>
                                </td>

                                <?php

                                        $sql = "SELECT MAX(fecha_alimentacion) FROM registro_alimentacion_precria WHERE id_precria = '$aux' AND id_camaronera = '$camaronera'";
                                        $data = $objeto->mostrar($sql);
                                        foreach ($data as $xt) {

                                            echo $xt['fecha_alimentacion'];


                                            $sql = "SELECT id_tipo_alimento FROM registro_alimentacion_precria WHERE  id_precria = '$aux' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$fch'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $xt) {

                                                $t = $xt['id_tipo_alimento'];

                                                if ($t == null || $t == '') {
                                                    echo 'balanceado';
                                                } else {

                                                    $sql = "SELECT descripcion_alimento, gramaje_alimento FROM tipo_alimento WHERE id_tipo_alimento = '$t'";
                                                    $data = $objeto->mostrar($sql);

                                                    foreach ($data as $xx) {
                                                        $td = $xx['descripcion_alimento'];
                                                        $tg = $xx['gramaje_alimento'];
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">

                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php

                                                if ($td == null || $td == "") {
                                                    echo 'Sin alimento';
                                                }else{

                                                    if ($td.' '.$tg == 'Katal 2.0') {
                                                        echo 'KTL 2.0';
                                                    }else if ($td.' '.$tg == 'Classic 1.2') {
                                                        echo 'CLA 1.2';
                                                    }else if ($td.' '.$tg == 'Classic ad equilibrium 2.0') {
                                                        echo 'CLAEQAD 2.0';
                                                    }else if ($td.' '.$tg == 'Masterline 5.0') {
                                                        echo 'MSTL 5.0';
                                                    }else if ($td.' '.$tg == 'Classic 0.8') {
                                                        echo 'CLA 0.8';
                                                    }else if ($td.' '.$tg == 'Origin 0.3') {
                                                        echo 'OGN 0.3';
                                                    }else if ($td.' '.$tg == 'Classic ad equilibrium Bio 2.0') {
                                                        echo 'CLAEQAD BIO 2.0';
                                                    }else if ($td.' '.$tg == 'Finalis Equilibre 2.0') {
                                                        echo 'FNLS EQ 2.0';
                                                    }else{
                                                        echo $td.' '.$tg;
                                                    }
                                                } 
                                            ?>
                                            
                                            </span>

                                        </td>

                                <!-- cantidad dia lunes -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_uno = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_precria WHERE fecha_alimentacion = '$dia' AND id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_uno = $objeto->mostrar($sql_uno);
                                        foreach ($data_uno as $x) {

                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia martes -->

                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_dos = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_precria WHERE fecha_alimentacion = '$dos' AND id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_dos = $objeto->mostrar($sql_dos);
                                        foreach ($data_dos as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia miercoles -->

                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_tres = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_precria WHERE fecha_alimentacion = '$tres' AND id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_tres = $objeto->mostrar($sql_tres);
                                        foreach ($data_tres as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']) ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia jueves -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_cuatro = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_precria WHERE fecha_alimentacion = '$cuatro' AND id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_cuatro = $objeto->mostrar($sql_cuatro);
                                        foreach ($data_cuatro as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia viernes -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_cinco = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_precria WHERE fecha_alimentacion = '$cinco' AND id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_cinco = $objeto->mostrar($sql_cinco);
                                        foreach ($data_cinco as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia sabado -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_seis = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_precria WHERE fecha_alimentacion = '$seis' AND id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_seis = $objeto->mostrar($sql_seis);
                                        foreach ($data_seis as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- cantidad dia domingo    -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_siete = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_precria WHERE fecha_alimentacion = '$siete' AND id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_siete = $objeto->mostrar($sql_siete);
                                        foreach ($data_siete as $x) {
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo floatval($x['total']); ?></span>
                                    <?php } ?>
                                </td>

                                <!-- acumulado semanal -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_precria WHERE id_precria = '$aux' AND fecha_alimentacion >= '$dia' AND fecha_alimentacion <= '$dx' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_semanal = $objeto->mostrar($sql_semanal);

                                        foreach ($data_semanal as $values_semanal) {
                                            $acum_semanal = $values_semanal['total']; ?>
                                    <span class="text-secondary text-xs font-weight-bold">
                                        <?php

                                                if (floatval($acum_semanal) == 0.00) {

                                                    echo $acum = 0;
                                                } else {

                                                    echo intval($acum_semanal);
                                                }
                                                ?>
                                    </span>
                                    <?php } ?>
                                </td>

                                <!-- acumulado total-->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_acumulado = "SELECT SUM(cantidad + cantidad_2) AS total FROM `registro_alimentacion_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$iden' AND fecha_alimentacion <= '$dx'";
                                        $data_acumulado = $objeto->mostrar($sql_acumulado);

                                        foreach ($data_acumulado as $acumulado) {
                                            $acum = $acumulado['total'];  ?>
                                    <span class="text-xs font-weight-bold">
                                        <strong>
                                            <?php

                                                    if ($acum == 0 || $acum == null) {

                                                        $acum = 0;
                                                    } else {

                                                        echo intval($acum);
                                                    }

                                                    ?></strong></span>
                                    <?php } ?>
                                </td>

                                <!-- dias transcurridos -->
                                <td class="align-middle text-center" style="border: 1px solid #40497C">
                                    <?php

                                        $sql_dias = "SELECT fecha_siembra FROM `registro_piscina_precria` WHERE id_precria = '$aux' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera' AND identificacion = '$iden'";
                                        $data_dias = $objeto->mostrar($sql_dias);

                                        foreach ($data_dias as $values_dias) {
                                            $siembra = $values_dias['fecha_siembra'];
                                        }

                                        $fecha1 = new DateTime($siembra);
                                        $fecha2 = new DateTime($fechaActual);
                                        $diff = $fecha1->diff($fecha2);



                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo $diff->days;  ?></span>
                                </td>
                                <?php } ?>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <!-- Tabla tipo de alimento dado en la semana -->

                <div class="table-sm table-responsive col-7">
                    <div class="" style="background: #028E8C; border: solid 2px white; width:350px; margin-left:-12px;">
                        <h6 class="text-white text-center mt-2 text-uppercase" style="font-size:12px;"> <strong>Sacos de balanceado consumidos</strong></h6>
                    </div>
                        <table class="table table-sm tab table-striped mt-5" style="margin-left: -10px;">

                        <thead>
                                <tr class="text-left" style="border: solid 2px #343a40">
                                    
                                </tr>
                                <tr class="text-center" style="border: solid 2px #343a40;">

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;">Balanc</th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        Lun<strong><?php $uno = $desde; ?></strong></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;"> Mar
                                        <?php $dos = date('Y-m-d', $dia_dos); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;"> Mie
                                        <?php $tres = date('Y-m-d', $dia_tres); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;"> Jue
                                        <?php $cuatro = date('Y-m-d', $dia_cuatro); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;"> Vie
                                        <?php $cinco = date('Y-m-d', $dia_cinco); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;"> Sab
                                        <?php $seis = date('Y-m-d', $dia_seis); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;"> Dom
                                        <?php $siete = date('Y-m-d', $dia_siete); ?></th>

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;">total</th>

                                </tr>
                            </thead>
                        <tbody>

                            <?php

                            $sql = "SELECT t2.descripcion_alimento AS descripcion, t2.gramaje_alimento AS gramaje, t2.id_tipo_alimento AS id FROM registro_alimentacion_engorde t1, tipo_alimento t2 WHERE t1.id_camaronera = '$camaronera' AND t1.fecha_alimentacion BETWEEN '$dia'AND '$hasta' AND (t1.id_tipo_alimento = t2.id_tipo_alimento OR t1.id_tipo_alimento_2 = t2.id_tipo_alimento) AND t2.descripcion_alimento != 'balanceado' GROUP BY t2.descripcion_alimento, t2.gramaje_alimento;";
                            $data = $objeto->mostrar($sql);

                            foreach ($data as $a) {
                                $id = $a['id'];
                            ?>

                            <tr style="border: 2px solid #40497C">

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">

                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo $a['descripcion'] . ' ' . $a['gramaje']; ?>
                                    </span>

                                </td>

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">
                                    <?php


                                        $uno = $dia;
                                        //$sql = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_camaronera = '$camaronera' AND fecha_alimentacion = '$uno' AND ( id_tipo_alimento = '$id' OR id_tipo_alimento_2 = '$id')";
                                        $sql = "SELECT t.tipo, SUM(t.can) AS total FROM (SELECT * FROM (SELECT ti.id_tipo_alimento AS tipo, SUM(ti.cantidad) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera' AND fecha_alimentacion = '$uno'  AND id_tipo_alimento = '$id' GROUP BY ti.id_tipo_alimento) t_1 UNION (SELECT ti.id_tipo_alimento_2 AS tipo, SUM(ti.cantidad_2) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera'  AND fecha_alimentacion = '$uno'  AND id_tipo_alimento_2 = '$id'  GROUP BY ti.id_tipo_alimento_2)) t GROUP BY t.tipo;";
                                        $data = $objeto->mostrar($sql);
                                        if (count($data) > 0) {
                                            foreach ($data as $a) {
                                                $l = $a['total'] / 25;
                                                $rl += $l;
                                        ?>

                                    <?php }  ?>
                                    <?php } else {
                                            $l = 0;
                                            $rl += $l;
                                        }  ?>
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $l; ?></span>

                                </td>

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">
                                    <?php
                                        $dos = date('Y-m-d', $dia_dos);
                                        $sql = "SELECT t.tipo, SUM(t.can) AS total FROM (SELECT * FROM (SELECT ti.id_tipo_alimento AS tipo, SUM(ti.cantidad) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera' AND fecha_alimentacion = '$dos'  AND id_tipo_alimento = '$id' GROUP BY ti.id_tipo_alimento) t_1 UNION (SELECT ti.id_tipo_alimento_2 AS tipo, SUM(ti.cantidad_2) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera'  AND fecha_alimentacion = '$dos'  AND id_tipo_alimento_2 = '$id'  GROUP BY ti.id_tipo_alimento_2)) t GROUP BY t.tipo;";
                                        $data = $objeto->mostrar($sql);
                                        if (count($data) > 0) {
                                            foreach ($data as $a) {
                                                $m = $a['total'] / 25;
                                                $rm += $m;
                                        ?>

                                    <?php }  ?>
                                    <?php } else {
                                            $m = 0;
                                            $rm += $m;
                                        }  ?>
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $m; ?></span>
                                </td>

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">
                                    <?php
                                        $tres = date('Y-m-d', $dia_tres);
                                        $sql = "SELECT t.tipo, SUM(t.can) AS total FROM (SELECT * FROM (SELECT ti.id_tipo_alimento AS tipo, SUM(ti.cantidad) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera' AND fecha_alimentacion = '$tres'  AND id_tipo_alimento = '$id' GROUP BY ti.id_tipo_alimento) t_1 UNION (SELECT ti.id_tipo_alimento_2 AS tipo, SUM(ti.cantidad_2) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera'  AND fecha_alimentacion = '$tres'  AND id_tipo_alimento_2 = '$id'  GROUP BY ti.id_tipo_alimento_2)) t GROUP BY t.tipo;";
                                        $data = $objeto->mostrar($sql);
                                        if (count($data) > 0) {
                                            foreach ($data as $a) {
                                                $mi = $a['total'] / 25;
                                                $rmi += $mi;
                                        ?>

                                    <?php }  ?>
                                    <?php } else {
                                            $mi = 0;
                                            $rmi += $mi;
                                        }  ?>
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $mi; ?></span>
                                </td>

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">
                                    <?php
                                        $cuatro = date('Y-m-d', $dia_cuatro);
                                        $sql = "SELECT t.tipo, SUM(t.can) AS total FROM (SELECT * FROM (SELECT ti.id_tipo_alimento AS tipo, SUM(ti.cantidad) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera' AND fecha_alimentacion = '$cuatro'  AND id_tipo_alimento = '$id' GROUP BY ti.id_tipo_alimento) t_1 UNION (SELECT ti.id_tipo_alimento_2 AS tipo, SUM(ti.cantidad_2) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera'  AND fecha_alimentacion = '$cuatro'  AND id_tipo_alimento_2 = '$id'  GROUP BY ti.id_tipo_alimento_2)) t GROUP BY t.tipo;";
                                        $data = $objeto->mostrar($sql);
                                        if (count($data) > 0) {
                                            foreach ($data as $a) {
                                                $j = $a['total'] / 25;
                                                $rj += $j;
                                        ?>

                                    <?php }  ?>
                                    <?php } else {
                                            $j = 0;
                                            $rj += $j;
                                        }  ?>
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $j; ?></span>
                                </td>

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">
                                    <?php
                                        $cinco = date('Y-m-d', $dia_cinco);
                                        $sql = "SELECT t.tipo, SUM(t.can) AS total FROM (SELECT * FROM (SELECT ti.id_tipo_alimento AS tipo, SUM(ti.cantidad) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera' AND fecha_alimentacion = '$cinco'  AND id_tipo_alimento = '$id' GROUP BY ti.id_tipo_alimento) t_1 UNION (SELECT ti.id_tipo_alimento_2 AS tipo, SUM(ti.cantidad_2) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera'  AND fecha_alimentacion = '$cinco'  AND id_tipo_alimento_2 = '$id'  GROUP BY ti.id_tipo_alimento_2)) t GROUP BY t.tipo;";
                                        $data = $objeto->mostrar($sql);
                                        if (count($data) > 0) {
                                            foreach ($data as $a) {
                                                $v = $a['total'] / 25;
                                                $rv += $v;
                                        ?>

                                    <?php }  ?>
                                    <?php } else {
                                            $v = 0;
                                            $rv += $v;
                                        }  ?>
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $v; ?></span>
                                </td>

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">
                                    <?php
                                        $seis = date('Y-m-d', $dia_seis);
                                        $sql = "SELECT t.tipo, SUM(t.can) AS total FROM (SELECT * FROM (SELECT ti.id_tipo_alimento AS tipo, SUM(ti.cantidad) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera' AND fecha_alimentacion = '$seis'  AND id_tipo_alimento = '$id' GROUP BY ti.id_tipo_alimento) t_1 UNION (SELECT ti.id_tipo_alimento_2 AS tipo, SUM(ti.cantidad_2) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera'  AND fecha_alimentacion = '$seis'  AND id_tipo_alimento_2 = '$id'  GROUP BY ti.id_tipo_alimento_2)) t GROUP BY t.tipo;";
                                        $data = $objeto->mostrar($sql);
                                        if (count($data) > 0) {
                                            foreach ($data as $a) {
                                                $s = $a['total'] / 25;
                                                $rs += $s;
                                        ?>

                                    <?php }  ?>
                                    <?php } else {
                                            $s = 0;
                                            $rs += $s;
                                        }  ?>
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $s; ?></span>
                                </td>

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">
                                    <?php
                                        $siete = date('Y-m-d', $dia_siete);
                                        $sql = "SELECT t.tipo, SUM(t.can) AS total FROM (SELECT * FROM (SELECT ti.id_tipo_alimento AS tipo, SUM(ti.cantidad) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera' AND fecha_alimentacion = '$siete'  AND id_tipo_alimento = '$id' GROUP BY ti.id_tipo_alimento) t_1 UNION (SELECT ti.id_tipo_alimento_2 AS tipo, SUM(ti.cantidad_2) AS can FROM registro_alimentacion_engorde ti WHERE id_camaronera = '$camaronera'  AND fecha_alimentacion = '$siete'  AND id_tipo_alimento_2 = '$id'  GROUP BY ti.id_tipo_alimento_2)) t GROUP BY t.tipo;";
                                        $data = $objeto->mostrar($sql);
                                        $data = $objeto->mostrar($sql);
                                        if (count($data) > 0) {
                                            foreach ($data as $a) {
                                                $d = $a['total'] / 25;
                                                $rd += $d;
                                        ?>

                                    <?php }  ?>
                                    <?php } else {
                                            $d = 0;
                                            $rd += $d;
                                        }  ?>
                                    <span class="text-secondary text-xs font-weight-bold"><?php echo $d; ?></span>
                                </td>

                                <td class="align-middle text-center" style="border: solid 2px #343a40;">
                                    <?php
                                        $suma = $l + $m + $mi + $j + $v + $s + $d;
                                        ?>
                                    <span
                                        class="text-secondary text-xs font-weight-bold"><?php echo intval($suma); ?></span>
                                </td>

                            </tr>
                            <?php } ?>

                            <tr class="bg-dark text-white" style="border: solid 2px #343a40;">
                                <td class="text-center" colspan="1" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-center">Total</span>
                                </td>
                                <td class="text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-center"><?php echo  $rl ?></span>
                                </td>
                                <td class="text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-center"><?php echo  $rm ?></span>
                                </td>
                                <td class="text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-center"><?php echo  $rmi ?></span>
                                </td>
                                <td class="text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-center"><?php echo  $rj ?></span>
                                </td>
                                <td class="text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-center"><?php echo  $rv ?></span>
                                </td>
                                <td class="text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-center"><?php echo  $rs ?></span>
                                </td>
                                <td class="text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span class="text-center"><?php echo  $rd ?></span>
                                </td>
                                <td class="text-center" style="background: #555557; border: solid 2px #343a40; color:white;">
                                    <span
                                        class="text-center"><?php echo  $rl + $rm + $rmi + $rj + $rv + $rs + $rd ?></span>
                                </td>


                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>