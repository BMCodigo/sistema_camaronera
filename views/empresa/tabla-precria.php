<?php

include './reporte-precria.php';
date_default_timezone_set("America/Lima");
$fechaActual = date('Y-m-d');
$objeto = new corrida();


?>


<?php 
    if (isset($_POST['search'])) {
        $buscar = $_POST['search'];
    }else if(isset($_POST['search_proceso'])){
        $buscar_proceso = $_POST['search_proceso'];
    }else if(isset($_POST['search_laboratorio'])){
        $buscar_laboratorio = $_POST['search_laboratorio'];
    }

?>

<!-- filtrador por precria -->

<div class="d-flex bd-highlight mb-6">
  <div class="p-2 bd-highlight">
    <form action="index.php?page=Reporte-precria" method="POST">
        
        <label for="inputEmail3" class="col-sm-12 col-form-label"> <strong><u>Filtrar precria</u></strong></label>
        <div class="form-group row">
    
            <div class="col-sm-12">
                <select class="form-control" name="search" id="piscina" onchange="this.form.submit()">
                    <?php
    
                    $objeto_pre = new corrida();
    
                    if ($camaronera == 1) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_darsacom WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 2) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquacamaron WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 3) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_jopisa WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 4) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquanatura WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 5) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_grupo_camaron WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 6) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_calica WHERE id_camaronera = '$camaronera'";
                    } else {
                        echo 'error en el servidor :(';
                    }
    
                    $data = $objeto_pre->mostrar($sql_pre);
    
                    ?>
                    <option value="<?php echo 'Seleccione' ?>">
                        <?php echo 'Seleccione precria'; ?>
                    </option>
                    <option value="<?php echo 'Ver todos' ?>">
                        <?php echo 'Ver todo los registros'; ?>
                    </option>
                    <?php
    
                    foreach ($data as $value_pre) {
                        $ha = $value_pre['hectareas'];
                    ?>
                        <option value="<?php echo $value_pre['id_precria']; ?>">
                            <?php echo $value_pre['descripcion_piscina']; ?>
                        </option>
    
                    <?php } ?>
                </select>
            </div>
        </div>
    
    </form>
  </div>
  <div class="p-2 bd-highlight">
    <form action="index.php?page=Reporte-precria" method="POST">
        
        <label for="inputEmail3" class="col-sm-12 col-form-label"> <strong><u>Filtrar precria en proceso</u></strong></label>
        <div class="form-group row">
    
            <div class="col-sm-12">
                <select class="form-control" name="search_proceso" id="piscina" onchange="this.form.submit()">
                    <?php
    
                    $objeto_pre = new corrida();
    
                    if ($camaronera == 1) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_darsacom WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 2) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquacamaron WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 3) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_jopisa WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 4) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquanatura WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 5) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_grupo_camaron WHERE id_camaronera = '$camaronera'";
                    }  else if ($camaronera == 6) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_calica WHERE id_camaronera = '$camaronera'";
                    } else {
                        echo 'error en el servidor :(';
                    }
    
                    $data = $objeto_pre->mostrar($sql_pre);
    
                    ?>
                    } <option value="<?php echo 'Seleccione' ?>">
                        <?php echo 'Selecione estado'; ?>
                    </option>
                    <option value="<?php echo 'Proceso' ?>">
                        <?php echo 'En proceso'; ?>
                    </option>
                    <option value="<?php echo 'Ver todos' ?>">
                        <?php echo 'Ver todo los registros'; ?>
                    </option>
                </select>
            </div>
        </div>
    
    </form>
  </div>
  <div class="p-2 bd-highlight">
    <form action="index.php?page=Reporte-precria" method="POST">
        
        <label for="inputEmail3" class="col-sm-12 col-form-label"> <strong><u>Filtrar laboratorio</u></strong></label>
        <div class="form-group row">
    
            <div class="col-sm-12">
                <select class="form-control" name="search_laboratorio" id="piscina" onchange="this.form.submit()">
                    <?php
    
                    $objeto_pre = new corrida();
    
                    if ($camaronera == 1) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_darsacom WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 2) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquacamaron WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 3) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_jopisa WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 4) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquanatura WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 5) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_grupo_camaron WHERE id_camaronera = '$camaronera'";
                    } else if ($camaronera == 6) {
                        $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_calica WHERE id_camaronera = '$camaronera'";
                    } else {
                        echo 'error en el servidor :(';
                    }
    
                    $data = $objeto_pre->mostrar($sql_pre);
    
                    ?>
                    } <option value="<?php echo 'Seleccione' ?>">
                        <?php echo 'Seleccione lab.'; ?>
                    </option>
                    <?php 
                        $lab = "SELECT DISTINCT laboratorio FROM registro_piscina_precria WHERE id_camaronera = '$camaronera'";
                        $data = $objeto_pre->mostrar($lab);
                    foreach ($data as $l){ ?>
                    <option class="text-uppercase" value="<?php echo $l['laboratorio']; ?>">
                        <?php echo $l['laboratorio']; ?>
                    </option>
                    <?php } ?>
                    <option value="<?php echo 'Ver todos' ?>">
                        <?php echo 'Ver todo los registros'; ?>
                    </option>
                </select>
            </div>
        </div>
    
    </form>
  </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="table table-sm table-responsive mb-4" style="margin-top: -15px;">

            <table class="table table-sm tab table-striped">
                <thead>
                    <tr class="text-center" style="border: solid 2px #0F579E;">
                        <th colspan="9" style="background: #193D7B;">
                            <h6 class="text-white mt-2"> Datos de Siembra </h6>
                        </th>

                        <th colspan="15" style="background: #343a40;">
                            <h6 class="text-white"> Datos de Tranasferencia </h6>
                        </th>
                    </tr>
                    <tr class="text-center">

                        <th style="background: #343a40; color:white;">Precria</th>

                        <th style="background: #343a40; color:white;">Ha</th>

                        <th style="background: #404e67; color:white; width:150px">Fecha</br>siembra</th>

                        <th style="background: #404e67; color:white;">Laboratorio</th>

                        <th style="background: #404e67; color:white;">Nauplio</th>

                        <th style="background: #404e67; color:white;">Codigo </br> genetico</th>

                        <th style="background: #404e67; color:white;">Peso</br>siembra</th>

                        <th style="background: #404e67; color:white;">Cant.</br>siembra</th>

                        <th style="background: #404e67; color:white;">Cant.</br>transf.</th>

                        <th style="background: #404e67; color:white;">Cant.</br>mort.</th>

                        <th style="background: #404e67; color:white;">%</br>Sobre</th>

                        <th style="background: #404e67; color:white;">Psc</br>Destino</th>

                        <th style="background: #404e67; color:white; width:150px;">Fecha</br>transf.</th>

                        <th style="background: #404e67; color:white;">Psc Destino</th>

                        <th style="background: #404e67; color:white;">Ha</th>

                        <th style="background: #404e67; color:white;">Peso transf.</th>

                        <th style="background: #404e67; color:white;">Cant. Trans</th>

                        <th style="background: #404e67; color:white;">Cant. Trans / Ha</th>

                        <th style="background: #404e67; color:white;">AABB </br> acum (kg)</th>

                        <!--th style="background: #404e67; color:white;">% </br> Sobre</th-->

                        <th style="background: #404e67; color:white;">Dias de </br> cultivo</th>

                        <th style="background: #404e67; color:white;">FCV</th>

                        <th style="background: #404e67; color:white;">%</br>Sobre</th>

                        <!--th style="background: #404e67; color:white;">Costo de larva </br> estimado</th-->

                        <th style="background: #343a40; color:white;">Estado</th>

                        <th style="background: #343a40; color:white;">Detalles</th>

                    </tr>
                </thead>
                <tbody>

                    <!-- buscar datos por precria -->
                    <?php

                    if ($buscar != 'Seleccione' && $buscar != 'Ver todos' && $buscar != '') {
                        $sql_piscina = "SELECT * FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND id_precria = '$buscar' ORDER BY fecha_siembra DESC"; 

                    } else if ($buscar_proceso != 'Seleccione' && $buscar_proceso != 'Ver todos' && $buscar_proceso != '') {
                        $sql_piscina = "SELECT * FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' ORDER BY fecha_siembra DESC";
                        
                    }else if ($buscar_laboratorio != 'Seleccione' && $buscar_laboratorio != 'Ver todos' && $buscar_laboratorio != '') {
                        $sql_piscina = "SELECT * FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND laboratorio LIKE '$buscar_laboratorio' ORDER BY fecha_siembra DESC ";

                    }else{
                        $sql_piscina = "SELECT * FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' ORDER BY fecha_siembra DESC"; 
                    }

                    $data = $objeto->mostrar($sql_piscina);
                    foreach ($data as $key) {
                        $id = $key['identificacion'];

                    ?>
                        <tr style="border: 2px solid #40497C">
                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $aux = $key['id_precria']; ?></span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $key['hectareas']; ?></span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                <span class="text-secondary text-xs font-weight-bold">
                                    <?php
                                    $f_siembra = $key['fecha_siembra'];
                                    echo date("d-m-y", strtotime($key['fecha_siembra']));
                                    ?>
                                </span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-uppercase text-xs font-weight-bold"><?php echo $key['laboratorio']; ?></span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-uppercase text-xs font-weight-bold"><?php echo $key['nauplio']; ?></span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-uppercase text-xs font-weight-bold"><?php echo $key['codigo_genetico']; ?></span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $key['peso_siembra']; ?></span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                <span class="text-secondary text-xs font-weight-bold">
                                    <div style="color: #0F58A5"><?php echo $c_aux = intval($key['cantidad_siembra']); ?></div>
                                </span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold">
                                    <div style="color: #61B42E ">
                                        <?php
                                        #cantidad transferidad parte 1
                                        $sobre = "SELECT estado, cantidad, SUM(cantidad) AS suma_cantidad FROM `registro_pesca_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' AND estado = 'Cosechado'";
                                        $data_sob = $objeto->mostrar($sobre);
                                        foreach ($data_sob as $data) {
                                            $sob = $data['suma_cantidad'];
                                            $estado = $data['estado'];
                                        }
                                        if ($estado == 'Cosechado') {
                                            echo intval($sob);
                                        } else {
                                            echo 0.00;
                                        }
                                        ?>
                                    </div>
                                </span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold">
                                    <div style="color:#C70039">
                                        <?php
                                        #mortalidad parte 1
                                        if ($estado == 'Cosechado') {

                                            echo intval($key['cantidad_siembra'] - $sob);
                                        } else {
                                            echo 0.00;
                                        }
                                        ?>
                                    </div>
                                </span>
                            </td>
                            
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold">
                                    <div style="color: #19A403">
                                        <?php
                                        #sobrevivencia parte 1
                                        echo round($sob / $c_aux * 100) . ' %';
                                        ?>
                                    </div>
                                </span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-uppercase text-xs font-weight-bold">
                                    <?php 
                                        if($key['destino_psc_1'] > 0 && $key['destino_psc_2'] > 0){
                                            echo $key['destino_psc_1'].' - '.$key['destino_psc_2'];
                                        }else if($key['destino_psc_1'] > 0){
                                            echo $key['destino_psc_1'];
                                        }else{
                                            echo '-';
                                        }
                                    ?>
                                </span>
                            </td>

                            <?php

                            $sql_cosecha = "SELECT * FROM registro_pesca_precria WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' AND estado = 'Cosechado'";
                            $data_acosecha = $objeto->mostrar($sql_cosecha);

                            $sql_cantidad_total = "SELECT SUM(cantidad) as cantidad FROM registro_pesca_precria WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' AND estado = 'Cosechado'";
                            $data_cantidad_total = $objeto->mostrar($sql_cantidad_total);
                            foreach ($data_cantidad_total as $cantidad_calc) {
                                $cantidad_total = $cantidad_calc['cantidad'];
                            }

                            if (count($data_acosecha) > 1) {

                                foreach ($data_acosecha as $cosecha) {

                            ?>

                                    <?php
                                    if ($cosecha != reset($data_acosecha)) {
                                        for ($i = 0; $i < 12; $i++) {
                                    ?>

                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                </span>
                                            </td>
                                    <?php }
                                    } ?>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php $f_cosecha = $cosecha['fecha_pesca'];
                                                                                                echo date("d-m-y", strtotime($cosecha['fecha_pesca'])) ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php
                                            echo $ps = $cosecha['piscina_destino'];
                                            ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php
                                            $ha = "SELECT hectareas FROM piscina WHERE piscinas = '$ps' AND id_camaronera = '$camaronera'";
                                            $data_ha = $objeto->mostrar($ha);

                                            foreach ($data_ha as $v_ha) {
                                                echo $ha_a = $v_ha['hectareas'];
                                            }
                                            ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $peso_pesca = $cosecha['peso_pesca']; ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $transf = $cosecha['cantidad']; ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo intval($transf / $ha_a); ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <div style="color: #0740E2 ">
                                                <?php
                                                #balanceado acumulado parte 1
                                                $sobre = "SELECT cantidad, SUM(cantidad) AS suma_cantidad FROM `registro_pesca_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' AND estado = 'Cosechado'";
                                                $data_sob = $objeto->mostrar($sobre);
                                                foreach ($data_sob as $data) {
                                                    $sob = $data['suma_cantidad'];
                                                }

                                                 $pctj = round($cosecha['cantidad'] / $sob * 100) ;

                                                $alim_acum = "SELECT SUM(cantidad + cantidad_2) AS acumulado FROM `registro_alimentacion_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' LIMIT 1";
                                                $data_acum = $objeto->mostrar($alim_acum);
                                                foreach ($data_acum as $data) {
                                                    echo  $acu = intval($data['acumulado'] * $pctj/100);
                                                }

                                                ?>
                                            </div>
                                        </span>
                                    </td>

                                    

                                    <!--DATOS DE TRANSFERENCIA DE PRECRIA A PISCINA -->

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php

                                            $sql_dias = "SELECT fecha_siembra FROM `registro_piscina_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' AND estado LIKE 'Cosechado'";
                                            $data_dias_s = $objeto->mostrar($sql_dias);

                                            foreach ($data_dias_s as $values_dias_s) {
                                                $f_siembra = $values_dias_s['fecha_siembra'];
                                            }

                                            $sql_dias_pesca = "SELECT fecha_pesca FROM `registro_pesca_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' AND estado = 'Cosechado'";
                                            $data_dias_pesca = $objeto->mostrar($sql_dias_pesca);
                                            foreach ($data_dias_pesca as $values_dias_pesca) {
                                                $fecha_pesca = $values_dias_pesca['fecha_pesca'];
                                            }

                                            $fecha1 = new DateTime($f_siembra);
                                            $fecha2 = new DateTime($fecha_pesca);
                                            $diff = $fecha1->diff($fecha2);
                                            echo $diff->days;

                                            ?>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <div style="color:#EF0A07">
                                                <?php
                                                #factor de conversion parte 1
                                                $v1 = 1000 * $acu . '</br>';
                                                $v2 = $transf * $peso_pesca . '</br>';
                                                $peso_pesca . '</br>';
                                                $transf . '</br>';
                                                $acu . '</br>';
                                                echo number_format($v1 / $v2, 2) . '</br>';
                                                ?>
                                            </div>
                                        </span>
                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <div style="color:#1AA913">
                                                <?php echo round($cosecha['cantidad'] / $c_aux * 100) . '%'; ?>
                                            </div>
                                        </span>
                                    </td>

                                    <!--td class="align-middle text-center" style="border: 1px solid #40497C">

                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $f_cosecha = $cosecha['estado']; ?>
                                        </span>

                                    </td-->

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">

                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $f_cosecha = $cosecha['estado']; ?>
                                        </span>

                                    </td>

                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-xs font-weight-bold"><a title="ver detalles" href="index.php?page=idprecria&id=<?php echo $id; ?>"><i class="fas fa-eye text-danger"></i></a></span>
                                    </td>

                        </tr>
                    <?php   }
                                #
                                #DATOS DE TRANSFERENCIA 


                            } else {
                                foreach ($data_acosecha as $cosecha) {
                    ?>

                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold"><?php $f_cosecha = $cosecha['fecha_pesca'];
                                                                                    echo  date("d-m-y", strtotime($cosecha['fecha_pesca'])); ?>
                            </span>
                        </td>

                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $ps2 = $cosecha['piscina_destino']; ?>
                            </span>
                        </td>

                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold">
                                <?php
                                    $ha2 = "SELECT hectareas FROM piscina WHERE piscinas = '$ps2' AND id_camaronera = '$camaronera'";
                                    $data_ha2 = $objeto->mostrar($ha2);

                                    foreach ($data_ha2 as $v_ha2) {
                                        echo $ha_a2=$v_ha2['hectareas'];
                                    }
                                ?>
                            </span>
                        </td>

                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $peso_pesca2 = $cosecha['peso_pesca']; ?>
                            </span>
                        </td>

                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo $transf2 = $cosecha['cantidad']; ?>
                            </span>
                        </td>

                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold"><?php echo intval($transf2 / $ha_a2); ?>
                            </span>
                        </td>



                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold">
                                <div style="color: #0740E2">
                                    <?php
                                    #acumulado parte  2
                                    $sobre = "SELECT cantidad, SUM(cantidad) AS suma_cantidad FROM `registro_pesca_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' AND estado = 'Cosechado'";
                                    $data_sob = $objeto->mostrar($sobre);
                                    foreach ($data_sob as $data) {
                                        $sob2 = $data['suma_cantidad'];
                                    }

                                    $pctj2 = round($cosecha['cantidad'] / $sob2 * 100) . '%';

                                    $alim_acum = "SELECT SUM(cantidad + cantidad_2) AS acumulado FROM `registro_alimentacion_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id'";
                                    $data_acum = $objeto->mostrar($alim_acum);
                                    foreach ($data_acum as $data) {
                                        echo  $acum = intval($data['acumulado'] * $pctj2 / 100);
                                    }

                                    ?>
                                </div>
                            </span>
                        </td>



                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold">
                                <?php

                                    $sql_dias = "SELECT estado FROM `registro_piscina_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id' AND estado LIKE 'En proceso'";
                                    $data_dias = $objeto->mostrar($sql_dias);

                                    foreach ($data_dias as $values_dias) {

                                        $estado = $values_dias['estado'];
                                    }

                                    if ($estado == 'En proceso') {

                                        $fecha1 = new DateTime($f_siembra);
                                        $fecha2 = new DateTime($fechaActual);
                                        $diff = $fecha1->diff($fecha2);
                                        echo $diff->days;
                                    } else {

                                        $sql_dias_pesca = "SELECT fecha_pesca FROM `registro_pesca_precria` WHERE id_precria = '$aux' AND id_camaronera = '$camaronera' AND identificacion = '$id'";
                                        $data_dias_pesca = $objeto->mostrar($sql_dias_pesca);
                                        foreach ($data_dias_pesca as $values_dias_pesca) {
                                            $fecha_pesca = $values_dias_pesca['fecha_pesca'];
                                        }

                                        $fecha1 = new DateTime($f_siembra);
                                        $fecha2 = new DateTime($fecha_pesca);
                                        $diff = $fecha1->diff($fecha2);
                                        echo $diff->days;
                                    }


                                ?>
                            </span>
                        </td>

                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold">
                                <div style="color:#EF0A07">
                                    <?php
                                    #factor de conversion parte 2
                                    $v_1 = 1000 * $acum;

                                    $v_2 = $transf2 * $peso_pesca2;

                                    echo number_format($v_1 / $v_2, 2);
                                    ?>
                                </div>
                            </span>
                        </td>

                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold">
                                <div style="color:#1AA913">
                                    <?php echo round($cosecha['cantidad'] / $c_aux * 100) . '%'; ?>
                                </div>
                            </span>
                        </td>

                        <!--td class="align-middle text-center" style="border: 1px solid #40497C">

                            <span class="text-secondary text-xs font-weight-bold"><?php echo $f_cosecha = $cosecha['estado']; ?>
                            </span>

                        </td-->

                        <td class="align-middle text-center" style="border: 1px solid #40497C">

                            <span class="text-secondary text-xs font-weight-bold"><?php echo $f_cosecha = $cosecha['estado']; ?>
                            </span>


                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-xs font-weight-bold"><a title="ver detalles" href="index.php?page=idprecria&id=<?php echo $id; ?>"><i class="fas fa-eye text-danger"></i></a></span>
                        </td>

            <?php }
                            }
                        } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
});
        document.oncontextmenu = function(){return false;}
</script>