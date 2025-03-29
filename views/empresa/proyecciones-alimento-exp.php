<?php
    $fechaActual = date('Y-m-d');
    $desde = date('Y-m-d', strtotime('next Monday -1 week', strtotime('this sunday')));
    $hasta = date('Y-m-d', strtotime($desde . ' + 6 days', strtotime('this sunday')));
    $dia_dos = strtotime($desde . "+ 1 days");
    $dia_tres = strtotime($desde . "+ 2 days");
    $dia_cuatro = strtotime($desde . "+ 3 days");
    $dia_cinco = strtotime($desde . "+ 4 days");
    $dia_seis = strtotime($desde . "+ 5 days");
    $dia_siete = strtotime($desde . "+ 6 days");
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    $sql = " select * from proyeccion_alimento_test WHERE fecha >='$desde' AND fecha <='$hasta' AND camaronera= '$camaronera' AND estado = '1' ;"; 
    $datar = $conectar->mostrar($sql);
    $desde_ante = date('Y-m-d', strtotime('next Monday -2 week', strtotime('this sunday')));
    $hasta_ante = date('Y-m-d', strtotime($desde_ante . ' + 6 days', strtotime('this sunday')));
    $desde_trasante = date('Y-m-d', strtotime('next Monday -3 week', strtotime('this sunday')));
    $hasta_trasante = date('Y-m-d', strtotime($desde_trasante . ' + 6 days', strtotime('this sunday')));
    $date = new DateTime($fechaActual);
    $weekNumber = $date->format("W");
    $monday = clone $date;
    $monday->modify('Monday this week');
    $mondayDate = $monday->format('Y-m-d');
        echo '<b>Semana #'.$weekNumber.'';
         ?>
          <br><span class="text-secondary text-xs font-weight-bold" id = "semini" name = "semini"><?php echo $desde;  ?></span><br>
          <span class="text-secondary text-xs font-weight-bold" id = "semfin" name = "semfin"><?php echo $hasta;  ?></span>
          <div style = "color:#f6f7fb;" id = "getantes" name = "getantes"><?php echo $hasta_ante;  ?></div><h1><b style="color:red;"></b></h1>
         <?php
    if (count($datar)>=1){
        
?>


         <div class="scroll mt-5" id = "saved" style="display:;">
                                              <form id="mains" action="../controllers/proyeccion-alimento-fcv.php" method="post">
                                  <!-- por PISCINA, INCLUIR TOTAL SEMANAL -->  
                                     
                       <table class="table table-sm tab table-striped">
                            <thead>
                                 <tr class="text-center" style="border: solid 2px #343a40"><th style="background:orange; border: solid 2px #343a40; color:black;min-height:17px;margin:auto;" colspan="11"><b>PROYECCION</b></th>
                                 <th  style="background: black; color:white; border: solid 2px #343a40;margin:auto;" colspan="8"><b>ALIMENTO REAL</b></th>
                                 <th  style="background: white; color:black; border: solid 2px #343a40;margin:auto;" colspan="3"><b>PROYECTADO</b></th>
                                       <th  style="background: white; color:black; border: solid 2px #343a40;margin:auto;" colspan="6"><b>SEMANA ANTERIOR</b></th>
                                 </tr>
                                <tr class="text-center" style="border: solid 2px #343a40">

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ps</th>

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ha</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Días</th>
                                    
                                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Siembra</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Dens.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    
                                        <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">% sup.</th>
                                     
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso Inicial </th>
                                    
                                 <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Inc.&nbsp;&nbsp;&nbsp; </th>
                                    
                                     <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso <br> Proy.</th>
                                             <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">  Incremento <br>Intermedio</th>
                                      <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">BW</th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        Lun<br><strong><?php $uno = $desde; ?></strong></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mar<br>
                                        <?php $dos = date('Y-m-d', $dia_dos); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mie<br>
                                        <?php $tres = date('Y-m-d', $dia_tres); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Jue<br>
                                        <?php $cuatro = date('Y-m-d', $dia_cuatro); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Vie<br>
                                        <?php $cinco = date('Y-m-d', $dia_cinco); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Sab<br>
                                        <?php $seis = date('Y-m-d', $dia_seis); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Dom<br>
                                        <?php $siete = date('Y-m-d', $dia_siete); ?></th>

                                        <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        TOTAL <br>REAL</th>
                                             <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                       <b>TOTAL<br> SUGER</b> </th>
                                  <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                        <b>% <br>EJEC.&nbsp;&nbsp;</b></th>
                                 <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                        <b>FCV <br>PROY</b></th>

   <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        ALIM. <br>ANT.</th>
                                          
                                           <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        INC. <br>ANT.</th>
                                <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        AL. PROY <br>ANT.</th>
                                 <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        DENS.PROY <br>ANT.</th>
                                         <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        PROYECT. <br>BALANC.&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                  <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        FCV <br> ANT.&nbsp;</th>
                                       
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                $sql_piscina = "SELECT DISTINCT id_piscina, id_corrida, hectareas FROM registro_piscina_engorde WHERE estado != 'Cosechado' AND id_camaronera = '$camaronera' ORDER BY id_piscina ASC";
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
                                    
                                $sql = " select * from proyeccion_alimento_test WHERE fecha >='$desde' AND fecha <='$hasta' AND camaronera= '$camaronera' AND ps= '$psm' AND estado = '1' ;"; 
                             $datosatomicos = $conectar->mostrar($sql); 
                                ?>
 
                                    <tr>

                                        <!-- numero de piscina -->
                                        <td class="align-middle text-center" data-toggle="modal" data-target=".bd-example-modal-sm<?php echo $psm; ?>" style="padding:1px;border: 1px solid #40497C" alt="<?php echo 'piscinas[]'.$value['id_piscina'];?>">
                                            <span class="text-secondary text-xs font-weight-bold" class=" form-control" id="<?php echo 'piscinas[]'.$value['id_piscina'];?>" name="<?php echo 'piscinas[]'.$value['id_piscina'];?>">
                                                <?php
                                                    
                                                    //echo $aux = $value['id_piscina'];
                                                    $aux_corrida = $value['id_corrida']; 
                                                    
                                                    if($value['id_piscina'] == 17){
                                                        
                                                     //   echo '17A';
                                                        $aux = $value['id_piscina'];
                                                        
                                                    }else if($value['id_piscina'] == 22){
                                                      //  echo '17B';
                                                        $aux = 22;
                                                    }else{
                                                     $aux = $value['id_piscina'];
                                                    }
                                                ?>
                                            </span>
                                                <input type="text" class="input2 form-control"  id = "<?php echo 'piscinas[]'.$value['id_piscina']; ?>"  name="<?php echo 'piscinas[]'.$value['id_piscina']; ?>" readonly value="<?php  if($value['id_piscina'] == 22 ){ echo '17B'; }else{ echo $value['id_piscina'];} ?>" readonly style = "padding:0px;margin:0px;border:0px;text-align:center;">
                                                <input type="hidden" name="corridas[]" value="<?php echo $value['id_corrida']; ?>">
                                                  
                                            <?php include 'modal-alimento.php'; ?>
                                        </td>


                                        <!-- hectareas de picina -->
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" class="input2 form-control"  id = "<?php echo 'hastd[]'.$value['id_piscina']; ?>"  name="<?php echo 'hastd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php $ha = $value['hectareas']; ?>
                                     <input type="text" class="input2 form-control"  id = "<?php echo 'has[]'.$value['id_piscina']; ?>"  name="<?php echo 'has[]'.$value['id_piscina']; ?>" readonly value="<?php echo  $value['hectareas']; ?>" readonly style = "padding:0px;margin:0px;border:0px;text-align:center;">
                                            </span>
                                        </td>
                                        
                                         <!-- peso muestreo -->
                                   <?php

                                        $sql_peso_actual = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_peso_actual = $objeto->mostrar($sql_peso_actual);

                                        foreach ($data_peso_actual as $values_peso_actual) {
                                            $peso1 = $values_peso_actual['total'];
                                        }

                                        ?>


                                        
                                                                                <!-- dias transcurridos -->
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_dias = "SELECT fecha_siembra FROM `registro_piscina_engorde` WHERE id_piscina = '$aux' AND estado != 'Cosechado' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_dias = $objeto->mostrar($sql_dias);

                                            foreach ($data_dias as $values_dias) {
                                                $siembra = $values_dias['fecha_siembra'];
                                            }

                                            $fecha1 = new DateTime($siembra);
                                            $fecha2 = new DateTime($fechaActual);
                                            $diff = $fecha1->diff($fecha2);



                                            ?>
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $alldays = $diff->days-1;  ?></span>
                                        </td>
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidads = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidads = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MIN(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidads = $objeto->mostrar($sql_densidads);

                                            foreach ($data_densidads as $values_densidads) {
                                                $densidads = $values_densidads['densidad'];
                                                
                                            }
                                            
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidads[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'densidadess[]'.$value['id_piscina'];?>" name="<?php echo 'densidadess[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" value ="<?php  if ($densidads == 0 || $densidads == null) {
                                                                                                        echo $densidads = 0;
                                                                                                    } else {
                                                                                                        echo  intval($densidads);
                                                                                                    } ?>">
                                            </span>
                                        
                                        
                                        
                                        
                                                                                                    
                                        </td>
                                        
                             <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidad = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidad = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MAX(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidad = $objeto->mostrar($sql_densidad);

                                            foreach ($data_densidad as $values_densidad) {
                                                $densidad = $values_densidad['densidad'];
                                            }
                                            
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'densidades[]'.$value['id_piscina'];?>" name="<?php echo 'densidades[]'.$value['id_piscina'];?>" step="any" readonly  placeholder="0.00" style="" value ="<?php  if ($densidad == 0 || $densidad == null) {
                                                                                                       echo $datosatomicos[0]['densidad']; 
                                                                                                    } else {
                                                                                                        echo $datosatomicos[0]['densidad']; 
                                                                                                    } ?>">    
                                            </span>
                                        
                                        
                                        
                                        
                                                                                                    
                                        </td>
                                        
                                                                                   <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                         <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'superviv[]'.$key['id_piscina'];?>">
                                        <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'supervive[]'.$value['id_piscina'];?>" name="<?php echo 'supervive[]'.$value['id_piscina'];?>" step="any"  readonly style="" 
                                                value ="<?php   echo $datosatomicos[0]['supervivencia']; ?>">
                                                    
                                            </span>
                                            
                                         
                                                
                                                  </td>


                                        <!-- acumulado semanal
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde' AND fecha_alimentacion <= '$hasta' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                        </td> -->

                                        <!-- acumulado total
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php

                                            $sql_acumulado = "SELECT SUM(cantidad + cantidad_2) AS total FROM `registro_alimentacion_engorde` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                        </td>-->

                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"><?php if ($peso1 == 0 || $peso1 == null) {
                                                                                                         $peso1 = 0.00;
                                                                                                    } else {
                                                                                                      //  echo  $peso1;
                                                                                                    } ?>
                             <input type="text" class="input2 form-control"  id = "<?php echo 'peso[]'.$value['id_piscina']; ?>"  name="<?php echo 'peso[]'.$value['id_piscina']; ?>" readonly value="<?php echo $peso1; ?>" readonly style = "padding:0px;margin:0px;border:0px;text-align:center;">
                                         
                                                                                                    </span>
                                        </td>
 
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                 <?echo $datosatomicos[0]['crecimiento']; ?>
                                            </span>
                                        </td>
                                        
                                           <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C" id="<?php echo 'pesofinalestd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                   <?echo $datosatomicos[0]['peso_proyectado']; ?>
                                            </span>

                                         </td>
                                                 <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php
                                            $sql = "SELECT MAX(peso) as peso FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo < '$fechaActual' LIMIT 1";
                                           // $sql = "SELECT peso FROM registro_peso WHERE fecha_peso > '$desde_ante' and fecha_peso < '$hasta_ante' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' ORDER BY fecha_peso DESC LIMIT 1;";
                                            
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $m = $x['peso'];
                                            }

                                            $sql = "SELECT  MAX(fecha_peso) as fecha_peso FROM registro_peso WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {

                                                $fm = $x['fecha_peso'];
                                            }

                                            $sql = "SELECT peso FROM registro_peso WHERE fecha_peso = '$fm' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            
                                            $sql = "SELECT peso FROM registro_peso WHERE fecha_peso > '$desde' and fecha_peso < '$hasta' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' ORDER BY fecha_peso DESC LIMIT 1;";
                                            
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $mm = $x['peso'];
                                            }
                                            ?>

                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                if($mm == NULL){ echo '_';}else
                                                {
                                                $r = sprintf('%.2f', abs($m - $mm));
                                                if ($r >= 3.00) {
                                                     $r2 = 0;
                                                } else {
                                                     $r2 = $r;
                                                }
                                                }
                                                ?>
                         <input type="text" class="input2 form-control"  id = "<?php echo 'intermedio[]'.$value['id_piscina']; ?>"  name="<?php echo 'intermedio[]'.$value['id_piscina']; ?>" readonly value="<?php echo $r2; ?>" readonly style = "padding:0px;margin:0px;border:0px;text-align:center;">
                                
                                            </span>
                                            <?php ?>
                                        </td>
                                         
                                                                                 
                                        
                                      <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C" id = "<?php echo 'factorestd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'factor[]'.$value['id_piscina']; ?>">

                             <?
                                 $xc = $datosatomicos[0]['bw'];
                                 $sql = " select tipo from tipos_conversion WHERE id_tipo = '$xc' AND id_camaronera ='$camaronera' ;"; 
                                $datars = $conectar->mostrar($sql);
                         // echo $datars[0]['tipo'];
                         echo substr($datars[0]['tipo'], 0, 14);
                              ?>

                                            </span>
                                            
                                        </td>
                                         <!-- cantidad dia lunes -->
                                        <?php
                                        
                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_corrida = '$aux_corrida' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$uno'";
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; } ?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_uno = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$uno' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_uno = $objeto->mostrar($sql_uno);
                                            foreach ($data_uno as $x) {

                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a1= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_dos = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$dos' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_dos = $objeto->mostrar($sql_dos);
                                            foreach ($data_dos as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a2= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_tres = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$tres' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_tres = $objeto->mostrar($sql_tres);
                                            foreach ($data_tres as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a3= floatval($x['total']) ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_cuatro = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$cuatro' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_cuatro = $objeto->mostrar($sql_cuatro);
                                            foreach ($data_cuatro as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a4= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_cinco = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$cinco' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_cinco = $objeto->mostrar($sql_cinco);
                                            foreach ($data_cinco as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a5= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_seis = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$seis' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_seis = $objeto->mostrar($sql_seis);
                                            foreach ($data_seis as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a6= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_siete = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$siete' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_siete = $objeto->mostrar($sql_siete);
                                            foreach ($data_siete as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a7= floatval($x['total']); ?></span>
                                            <?php } ?>
                                        </td>

                                        <!-- cantidad dia lunes 

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd1[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                   <?echo $datosatomicos[0]['lun']; ?>
                                            </span>

                                         </td>-->

                                        <!-- cantidad dia martes 

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd2[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                <?echo $datosatomicos[0]['mar']; ?>
                                            </span>

                                         </td>-->


                                        <!-- cantidad dia miercoles 
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd3[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <?echo $datosatomicos[0]['mie']; ?>
                                            </span>

                                         </td>-->




                                        <!-- cantidad dia jueves 
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd4[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                <?echo $datosatomicos[0]['jue']; ?>
                                            </span>

                                         </td>-->



                                        <!-- cantidad dia viernes 
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd5[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                              <?echo $datosatomicos[0]['vie']; ?>
                                            </span>

                                         </td>           -->


                                        <!-- cantidad dia sabado 
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd6[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                  <?echo $datosatomicos[0]['sab']; ?>
                                            </span>

                                         </td>-->
  


                                        <!-- cantidad dia domingo    
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd7[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                               <?echo $datosatomicos[0]['dom']; ?>
                                            </span>

                                         </td>-->
                                         

                                <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;width:5%;">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde' AND fecha_alimentacion <= '$hasta' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                              <input type="hidden" name="acumulado[]" value="<?php echo intval($acum_semanal); ?>" id="<?php echo 'acumulado[]'.$value['id_piscina'];?>" >
                                        </td>
                                        
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'alimentotd0[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <?php echo 
                            $semanatotal = $datosatomicos[0]['alimento_proyectado'];
                               
                                      ?>
                                            </span>

                                         </td>
                                        
                                     <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'porcentajetd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                           <?php if ($semanatotal <=0) {
                                                   echo $semana_percent =  '0.00';
                                           } else {
                                                   $semana_percent = intval($acum_semanal) / $semanatotal;
                                            $semana_percent_formatted = number_format($semana_percent * 100, 2);
                                            echo $semana_percent_formatted . '%';
                                           }
                                        ?>
                                            </span>

                                         </td>
                                                                             <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'fcvtd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'fcvt[]'.$key['id_piscina'];?>">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:blue;" class=" form-control" id="<?php echo 'fcv[]'.$value['id_piscina'];?>" name="<?php echo 'fcv[]'.$value['id_piscina'];?>" value="<?php echo $datosatomicos[0]['fcv_proyectado'];?>" step="any"  readonly  placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde_ante' AND fecha_alimentacion <= '$hasta_ante' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                              <input type="hidden" name="acumulado[]" value="<?php echo intval($acum_semanal); ?>" id="<?php echo 'acumulado[]'.$value['id_piscina'];?>" >
                                        </td>
                                        
                                         <?php

                                      //  $sql_peso_actual = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $sql_peso_actual = "SELECT COALESCE(peso, 0.00) AS pesofinal
                                              FROM `registro_muestreo`
                                                                       WHERE id_piscina = '$aux'
                                                                                                 AND id_camaronera = '$camaronera'  AND id_corrida = '$aux_corrida'
                                                                                                  AND fecha_muestreo >= '$hasta' AND fecha_muestreo <= CURDATE()
                                                    ORDER BY fecha_muestreo DESC
                                                            LIMIT 1;";


  $sql_peso_actual = "
SELECT *,COALESCE(peso, 0.00) AS pesofinal FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo <= '$hasta_ante' ORDER BY fecha_muestreo DESC LIMIT 1;
";
                                        $data_peso_actual = $objeto->mostrar($sql_peso_actual);

                                        foreach ($data_peso_actual as $values_peso_actual) {
                                            $peso11 = $values_peso_actual['pesofinal'];
                                        }

                                        ?>

  <?php

                                      //  $sql_peso_actual = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $sql_peso_actual = "SELECT COALESCE(peso, 0.00) AS pesofinal
                                              FROM `registro_muestreo`
                                                                       WHERE id_piscina = '$aux'
                                                                                                 AND id_camaronera = '$camaronera'  AND id_corrida = '$aux_corrida'
                                                                                                  AND fecha_muestreo >= '$hasta' AND fecha_muestreo <= CURDATE()
                                                    ORDER BY fecha_muestreo DESC
                                                            LIMIT 1;";


  $sql_peso_actual = "
SELECT *,COALESCE(peso, 0.00) AS pesofinal FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo <= '$hasta_ante' ORDER BY fecha_muestreo DESC LIMIT 1;
";
                                        $data_peso_actual = $objeto->mostrar($sql_peso_actual);

                                        foreach ($data_peso_actual as $values_peso_actual) {
                                            $peso11 = $values_peso_actual['pesofinal'];
                                        }

                                        ?>

                                                                                <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            #incremento actual
                                            //$f = date('Y-m-d', $dia_siete);
                                            $dx_7 = date('Y-m-d', strtotime($hasta . "- 7 days"));
                                            $sql = "SELECT MAX(incremento) AS total FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx_7'";
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
                                        
                                                                                                                        <td class="align-middle text-center" style="padding:1px;margin:0px;border: 1px solid #40497C;" id="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>">
                                            <?php
                                            $sql_histo = "SELECT densidad, alimento_proyectado FROM proyeccion_alimento WHERE camaronera = '$camaronera' AND ps = '$aux' AND fecha >= '$desde_ante' AND fecha <= '$hasta_ante';";
                                            $data_histo = $objeto->mostrar($sql_histo);
                                            foreach ($data_histo as $histo) {
                                            $alimento_proyectado_ante = $histo['alimento_proyectado'];
                                            }
                                            ?>
                                    <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'fcv_fijo[]'.$key['id_piscina'];?>">
                                            <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" step="any" readonly style="" 
                                                value ="<?php echo $alimento_proyectado_ante ;  ?>"> 
                                    </span> </td>
                                    <td class="align-middle text-center" style="padding:1px;margin:0px;border: 1px solid #40497C;" id="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>">
                                            <?php
                                            $sql_histo = "SELECT densidad, alimento_proyectado FROM proyeccion_alimento WHERE camaronera = '$camaronera' AND ps = '$aux' AND fecha >= '$desde_ante' AND fecha <= '$hasta_ante';";
                                            $data_histo = $objeto->mostrar($sql_histo);
                                            foreach ($data_histo as $histo) {
                                            $densidad_ante = $histo['densidad'];
                                            }
                                            ?>
                                    <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'fcv_fijo[]'.$key['id_piscina'];?>">
                                            <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" step="any" readonly style="" 
                                                value ="<?php echo $densidad_ante ;  ?>"> 
                                    </span> </td>
                                        
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidad = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidad = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MAX(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidad = $objeto->mostrar($sql_densidad);

                                            foreach ($data_densidad as $values_densidad) {
                                                $densidad = $values_densidad['densidad'];
                                            }
                                            
                                            ?>
                                
                                        <?php   $currentday =$diff->days-1;
                                        $sql_param = "SELECT dias, mortalidad FROM parametros_soreviviencia WHERE id_camaronera = '$camaronera';";
                                        $data_param = $objeto->mostrar($sql_param);
                                        
                                        if ($currentday <= $data_param[0]['dias'] AND FALSE ){
                                            $mor_total =$densidads * ($data_param[0]['mortalidad']/100) ;
                                            $mor_diaria = ($mor_total / $data_param[0]['dias']);

                                        ?>
                                        
                                                                                        <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidadfijo[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" name="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" 
                                                value ="<?php       echo $densref =  intval($densidads - ($mor_diaria*$currentday)); ?>">
                                            </span>
                                        
                                        <?php   
                                        } else {
                                            
                                                             $getproyect = "select densidad, libras_tot, peso_final, hectareas, alim_sum2, n
                                                                ,  1.00/(0.007963335+0.1387779/peso_final) AS kg_10_m 
                                                                    , (alim_sum2 / hectareas) / n AS kg_ha_semana_m
                                                                        from simulacion_proceso_test 
                                                                            WHERE fecha_muestreo = '$hasta_ante'
                                                                                AND id_camaronera = '$camaronera'
                                                                                    AND piscinas = '$aux'
                                                                                        AND id_bio = 'BW Prom'";
                                             $data_proyect = $objeto->mostrar($getproyect);
                                           $proyecto= ($data_proyect[0]['kg_ha_semana_m']*10)/$data_proyect[0]['kg_10_m'];
                                            //var_dump($proyecto);
                                            
                                            
                                            
                                        
                                        ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidadfijo[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" name="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" value ="<?php  if ($densidad == 0 || $densidad == null) {
                                                                                                        echo $densidad = 0;
                                                                                                    } else {
                                                                                               echo  $densref = intval($proyecto*10000);         // echo  $densref = intval($densidad);
                                                                                                    } ?>">
                                            </span>
                                                                                <?php   
                                        } 
                                        
                                        ?>
                                        
                                        
                                        
                                        
                                                                                                    
                                        </td>
                                                                                <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>">
                                            <?php
                                            $sql_acumulado = "SELECT SUM(cantidad + cantidad_2) AS total FROM `registro_alimentacion_engorde` 
                                            WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_alimentacion <= '$hasta_ante' 
                                            ;";
                                            $data_acumulado = $objeto->mostrar($sql_acumulado);
                                            foreach ($data_acumulado as $acumulado) {
                                            $acum = $acumulado['total'];
                                            }
                                            
                                           // $sql_conversion = "SELECT acum_anterior FROM `proyeccion_alimento_test` WHERE ps = '$aux' AND camaronera = '$camaronera' AND fecha >= '$desde' AND fecha <= '$hasta'";
                                            //$data_conversion = $objeto->mostrar($sql_conversion);

                                            //foreach ($data_conversion as $base_conversion) {
                                                $pounds = 2.204;$grams = 454;
                                              //  $acum_anterior = $base_conversion['acum_anterior'];
                                                $fcv = (($acum/ $value['hectareas']) * $pounds)/(($densref * $peso11) / $grams); 
                                                $fcv = ($acum * $pounds) / (($densref * $peso11 / $grams + $data_proyect[0]['libras_tot']) * $value['hectareas']);
                                              //  $fcv = ($acum * $pounds) / (($data_proyect[0]['densidad'] * 10000 * $peso11 / $grams + $data_proyect[0]['libras_tot']) * $value['hectareas']);
                                                $den = $densref * $peso11/454;  // 854.59 lbs camaron
                                                $num = ($acum / $value['hectareas']) * 2.2; //4125 lbs de comida 
                                                
                                        //    }
                                            ?>
                                    <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'fcv_fijo[]'.$key['id_piscina'];?>">
                                            <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:blue;" class=" form-control" id="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" step="any" readonly 
                                                value ="<?php echo number_format($fcv, 2) ;  ?>"> 
                                    </span> </td>
                                                  
                                                  <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;display:none;">
                                              <?php   
                 $factorTotal = + ($a1/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['lun'] * $datosatomicos[0]['bw1']) 
                            + ($a2/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['mar'] * $datosatomicos[0]['bw2'])
                            + ($a3/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['mie'] * $datosatomicos[0]['bw3'])
                            + ($a4/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['jue'] * $datosatomicos[0]['bw4'])
                            + ($a5/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['vie'] * $datosatomicos[0]['bw5'])
                            + ($a6/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['sab'] * $datosatomicos[0]['bw6'])
                            + ($a7/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['dom'] * $datosatomicos[0]['bw7']);
                                //  echo $factorTotal ;
                                    //  $factorTotal = + ($datosatomicos[0]['total']/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['lun'] * $datosatomicos[0]['bw1']) ;
                                  echo intval($factorTotal) ;
                                        ?>
                                     </td>
                                    <?php } ?>
                                   



                                    </tr>

                                                    
                                                
                                     <tr style=" border: solid 2px #343a40; color:white;">
                                 <td class="align-middle text-center" style="padding:1px;border: solid 2px #343a40; color:white;"  colspan="18">
                                
                                     </td>
                                     </tr>
                                     <?php if($_SESSION['id']==2 OR $_SESSION['id']==59 OR $_SESSION['id']==29 OR $_SESSION['id']==28 OR $_SESSION['id']==37
                                     OR $_SESSION['id']==4 OR $_SESSION['id']==84 OR $_SESSION['id']==61 OR $_SESSION['id']==39 
                                     OR $_SESSION['id']==21 OR $_SESSION['id']==12 OR $_SESSION['id']==17
                                     ){?>
                                          <tr style=" border: solid 0px #343a40; color:white;">
                                 <td class="align-middle text-center" style="padding:1px;border: solid 0px #343a40; color:white;"  colspan="28">
                                   <button type="button" class="btn btn-danger btn-sm mt-3 text-center" id="mod">EDITAR </button>
                                     </td>
                                     </tr>
                                     <?php } ?>
                            </tbody>
                           
                        </table>
                       </form>
                    </div>
                    
                    
        
        
             <div class="scroll mt-5" id = "edited" style="display:none;">
                                              <form id="main" action="../controllers/proyeccion-alimento-fcv.php" method="post">
                                  <!-- por PISCINA, INCLUIR TOTAL SEMANAL -->  
                       <table class="table table-sm tab table-striped">
                            <thead>
                                 <tr class="text-center" style="border: solid 2px #343a40"><th style="background:orange; border: solid 2px #343a40; color:black;min-height:17px;margin:auto;" colspan="11"><b>PROYECCION</b></th>
                                 <th  style="background: black; color:white; border: solid 2px #343a40;margin:auto;" colspan="8"><b>ALIMENTO REAL</b></th>
                                 <th  style="background: white; color:black; border: solid 2px #343a40;margin:auto;" colspan="3"><b>PROYECTADO</b></th>
                                       <th  style="background: white; color:black; border: solid 2px #343a40;margin:auto;" colspan="4"><b> SEMANA ANTERIOR</b></th>
                                 </tr>
                                <tr class="text-center" style="border: solid 2px #343a40">

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ps</th>

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ha</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Días</th>
                                    
                                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Siembra</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Dens.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    
                                        <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">% sup.</th>
                                     
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso Inicial </th>
                                    
                                 <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Inc.&nbsp;&nbsp;&nbsp; </th>
                                    
                                     <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso <br> Proy.</th>
                                             <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">  Incremento <br>Intermedio</th>
                                      <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">BW</th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        Lun<br><strong><?php $uno = $desde; ?></strong></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mar<br>
                                        <?php $dos = date('Y-m-d', $dia_dos); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mie<br>
                                        <?php $tres = date('Y-m-d', $dia_tres); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Jue<br>
                                        <?php $cuatro = date('Y-m-d', $dia_cuatro); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Vie<br>
                                        <?php $cinco = date('Y-m-d', $dia_cinco); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Sab<br>
                                        <?php $seis = date('Y-m-d', $dia_seis); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Dom<br>
                                        <?php $siete = date('Y-m-d', $dia_siete); ?></th>

                                        <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        TOTAL <br>REAL</th>
                                             <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                       <b>TOTAL<br> SUGER</b> </th>
                                  <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                        <b>% <br>EJEC.&nbsp;&nbsp;</b></th>
                                 <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                        <b>FCV <br>PROY</b></th>

   <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        ALIM. <br>ANT.</th>
                                          
                                           <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        INC. <br>ANT.</th>
                                         <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        DENS. <br>ANT.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                  <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        FCV <br> ANT.&nbsp;</th>
                                       
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                $sql_piscina = "SELECT DISTINCT id_piscina, id_corrida, hectareas FROM registro_piscina_engorde WHERE estado != 'Cosechado' AND id_camaronera = '$camaronera' ORDER BY id_piscina ASC";
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
                                    
                             $sql = " select * from proyeccion_alimento_test WHERE fecha >='$desde' AND fecha <='$hasta' AND camaronera= '$camaronera' AND ps= '$psm' ;"; 
                             $datosatomicos = $conectar->mostrar($sql); 
                                ?>

                                    <tr>

                                        <!-- numero de piscina -->
                                        <td class="align-middle text-center" data-toggle="modal" data-target=".bd-example-modal-sm<?php echo $psm; ?>" style="padding:1px;border: 1px solid #40497C" alt="<?php echo 'piscinas[]'.$value['id_piscina'];?>">
                                            <span class="text-secondary text-xs font-weight-bold" class=" form-control" id="<?php echo 'piscinas[]'.$value['id_piscina'];?>" name="<?php echo 'piscinas[]'.$value['id_piscina'];?>">
                                                <?php
                                                    
                                                    //echo $aux = $value['id_piscina'];
                                                    $aux_corrida = $value['id_corrida']; 
                                                    
                                                    if($value['id_piscina'] == 17){
                                                        
                                                     //   echo '17A';
                                                        $aux = $value['id_piscina'];
                                                        
                                                    }else if($value['id_piscina'] == 22){
                                                      //  echo '17B';
                                                        $aux = 22;
                                                    }else{
                                                     $aux = $value['id_piscina'];
                                                    }
                                                ?>
                                            </span>
                                                <input type="text" class="input2 form-control"  id = "<?php echo 'piscinas[]'.$value['id_piscina']; ?>"  name="<?php echo 'piscinas[]'.$value['id_piscina']; ?>" readonly value="<?php  if($value['id_piscina'] == 22 ){ echo '17B'; }else{ echo $value['id_piscina'];} ?>" readonly style="background:none;border:0">
                                                <input type="hidden" name="corridas[]" value="<?php echo $value['id_corrida']; ?>">
                                                <input type="hidden" name="<?php echo 'corrida[]'.$value['id_piscina']; ?>" id="<?php echo 'corrida[]'.$value['id_piscina']; ?>" value="<?php echo $value['id_corrida']; ?>">
                                                 <input type="hidden" name="camaroneras[]" value="<?php echo $camaronera ?>">
                                            <?php include 'modal-alimento.php'; ?>
                                        </td>


                                        <!-- hectareas de picina -->
                                        <td class="align-middle text-center" style = "padding:0px;margin:0px;border:0px;text-align:center;" class="input2 form-control"  id = "<?php echo 'hastd[]'.$value['id_piscina']; ?>"  name="<?php echo 'hastd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php $ha = $value['hectareas']; ?>
                                     <input type="text" class="input2 form-control"  id = "<?php echo 'has[]'.$value['id_piscina']; ?>"  name="<?php echo 'has[]'.$value['id_piscina']; ?>" readonly value="<?php echo  $value['hectareas']; ?>" readonly style = "padding:0px;margin:0px;border:0px;text-align:center;">
                                            </span>
                                        </td>
                                        
                                         <!-- peso muestreo -->
                                   <?php

                                        $sql_peso_actual = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_peso_actual = $objeto->mostrar($sql_peso_actual);

                                        foreach ($data_peso_actual as $values_peso_actual) {
                                            $peso1 = $values_peso_actual['total'];
                                        }

                                        ?>


                                        
                                                                                <!-- dias transcurridos -->
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_dias = "SELECT fecha_siembra FROM `registro_piscina_engorde` WHERE id_piscina = '$aux' AND estado != 'Cosechado' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_dias = $objeto->mostrar($sql_dias);

                                            foreach ($data_dias as $values_dias) {
                                                $siembra = $values_dias['fecha_siembra'];
                                            }

                                            $fecha1 = new DateTime($siembra);
                                            $fecha2 = new DateTime($fechaActual);
                                            $diff = $fecha1->diff($fecha2);



                                            ?>
                                          <input type="hidden" value="<?php echo $diff->days-1; ?>" id="<?php echo 'dias[]'.$value['id_piscina'];?>" name="<?php echo 'dias[]'.$value['id_piscina'];?>">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'getdias[]'.$value['id_piscina']; ?>" name = "<?php echo 'getdias[]'.$value['id_piscina']; ?>"><?php echo $diff->days-1;  ?></span>
                                        </td>
                                        
                                        
                             <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidads = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidads = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MIN(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidads = $objeto->mostrar($sql_densidads);

                                            foreach ($data_densidads as $values_densidads) {
                                                $densidads = $values_densidads['densidad'];
                                                
                                            }
                                            
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidads[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'densidadess[]'.$value['id_piscina'];?>" name="<?php echo 'densidadess[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" value ="<?php  if ($densidads == 0 || $densidads == null) {
                                                                                                        echo $densidads = 0;
                                                                                                    } else {
                                                                                                        echo  intval($densidads);
                                                                                                    } ?>">
                                            </span>
                                        
                                        
                                        
                                        
                                                                                                    
                                        </td>
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidad = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidad = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MAX(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidad = $objeto->mostrar($sql_densidad);

                                            foreach ($data_densidad as $values_densidad) {
                                                $densidad = $values_densidad['densidad'];
                                            }
                                            
                                            ?>
                                
                                        <?php   $currentday =$diff->days-1;
                                        $sql_param = "SELECT dias, mortalidad FROM parametros_soreviviencia WHERE id_camaronera = '$camaronera';";
                                        $data_param = $objeto->mostrar($sql_param);
                                        
                                        if ($currentday <= $data_param[0]['dias'] ){
                                            $mor_total =$densidads * ($data_param[0]['mortalidad']/100) ;
                                            $mor_diaria = ($mor_total / $data_param[0]['dias']);

                                        ?>
                                        
                                                                                        <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:red;" class=" form-control" id="<?php echo 'densidades[]'.$value['id_piscina'];?>" name="<?php echo 'densidades[]'.$value['id_piscina'];?>" step="any"  placeholder="0.00" style="" 
                                                value ="<?php       echo $densref =  $densidads - ($mor_diaria*$currentday); ?>">
                                            </span>
                                        
                                        <?php   
                                        } else {
                                            
                                                             $getproyect = "select densidad, libras_tot, peso_final, hectareas, alim_sum2, n
                                                                ,  1.00/(0.007963335+0.1387779/peso_final) AS kg_10_m 
                                                                    , (alim_sum2 / hectareas) / n AS kg_ha_semana_m
                                                                        from simulacion_proceso_test 
                                                                            WHERE fecha_muestreo = '$hasta_ante'
                                                                                AND id_camaronera = '$camaronera'
                                                                                    AND piscinas = '$aux'
                                                                                        AND id_bio = 'BW Prom'";
                                             $data_proyect = $objeto->mostrar($getproyect);
                                           $proyecto= ($data_proyect[0]['kg_ha_semana_m']*10)/$data_proyect[0]['kg_10_m'];
                                            //var_dump($proyecto);
                                            
                                            
                                            
                                        
                                        ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:green;" class=" form-control" id="<?php echo 'densidades[]'.$value['id_piscina'];?>" name="<?php echo 'densidades[]'.$value['id_piscina'];?>" step="any"  placeholder="0.00" style="" value ="<?php   
                                                                                               echo  $densref = $datosatomicos[0]['densidad'];       
                                                                                                    ?>">
                                            </span>
                                                                                <?php   
                                        } 
                                        
                                        ?>
                                        
                                        
                                        
                                        
                                                                                                    
                                        </td>
                                           <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'supervivetd[]'.$value['id_piscina'];?>">
                                         <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'superviv[]'.$key['id_piscina'];?>">
                                        <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'supervive[]'.$value['id_piscina'];?>" name="<?php echo 'supervive[]'.$value['id_piscina'];?>" step="any"  readonly style="" 
                                                value ="<?php echo number_format(floatval($densref / $densidads)*100, 2, '.', ''); ?>">
                                            </span>
                                            
                                         
                                                
                                                  </td>


                                        <!-- acumulado semanal
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde' AND fecha_alimentacion <= '$hasta' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                        </td> -->

                                        <!-- acumulado total
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php

                                            $sql_acumulado = "SELECT SUM(cantidad + cantidad_2) AS total FROM `registro_alimentacion_engorde` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                        </td>-->

                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"><?php if ($peso1 == 0 || $peso1 == null) {
                                                                                                         $peso1 = 0.00;
                                                                                                    } else {
                                                                                                      //  echo  $peso1;
                                                                                                    } ?>
                             <input type="text" class="input2 form-control"  id = "<?php echo 'peso[]'.$value['id_piscina']; ?>"  name="<?php echo 'peso[]'.$value['id_piscina']; ?>" readonly value="<?php echo $peso1; ?>" readonly style = "padding:0px;margin:0px;border:0px;text-align:center;">
                                         
                                                                                                    </span>
                                        </td>
 
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'crecimientos[]'.$value['id_piscina'];?>" name="<?php echo 'crecimientos[]'.$value['id_piscina'];?>" value ="<?echo $datosatomicos[0]['crecimiento']; ?>" step="any"  placeholder="0.00" style="">
                                            </span>
                                        </td>
                                        
                                           <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C" id="<?php echo 'pesofinalestd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'pesofinales[]'.$value['id_piscina'];?>" name="<?php echo 'pesofinales[]'.$value['id_piscina'];?>" value ="<?echo $datosatomicos[0]['peso_proyectado']; ?>" step="any"  readonly placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                         
                                                                                 </td>
                                        
                                        
                                                                <!-- peso miercoles -->
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php
                                            $sql = "SELECT MAX(peso) as peso FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo < '$fechaActual' LIMIT 1";
                                           // $sql = "SELECT peso FROM registro_peso WHERE fecha_peso > '$desde_ante' and fecha_peso < '$hasta_ante' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' ORDER BY fecha_peso DESC LIMIT 1;";
                                            
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $m = $x['peso'];
                                            }

                                            $sql = "SELECT  MAX(fecha_peso) as fecha_peso FROM registro_peso WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {

                                                $fm = $x['fecha_peso'];
                                            }

                                            $sql = "SELECT peso FROM registro_peso WHERE fecha_peso = '$fm' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            
                                            $sql = "SELECT peso FROM registro_peso WHERE fecha_peso > '$desde' and fecha_peso < '$hasta' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' ORDER BY fecha_peso DESC LIMIT 1;";
                                            
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $mm = $x['peso'];
                                            }
                                            ?>

                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                if($mm == NULL){ echo '_';}else
                                                {
                                                $r = sprintf('%.2f', abs($m - $mm));
                                                if ($r >= 3.00) {
                                                     $r2 = 0;
                                                } else {
                                                     $r2 = $r;
                                                }
                                                }
                                                ?>
                         <input type="text" class="input2 form-control"  id = "<?php echo 'intermedio[]'.$value['id_piscina']; ?>"  name="<?php echo 'intermedio[]'.$value['id_piscina']; ?>" readonly value="<?php echo $r2; ?>" readonly style = "padding:0px;margin:0px;border:0px;text-align:center;">
                                
                                            </span>
                                            <?php ?>
                                        </td>
                                        
                                        
                                      <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C" id = "<?php echo 'factorestd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'factor[]'.$value['id_piscina']; ?>">

                                    <select class="select"   id = "<?php echo 'factores[]'.$value['id_piscina']; ?>" name= "<?php echo 'factores[]'.$value['id_piscina']; ?>">
                                                     <option class="text-center"  id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="0" style"display:;">
                                                        [Seleccione]
                                                        </option>
                                                    <?php
                                       
                                              $sqli = "select * from tipos_conversion where estado = 1 AND id_camaronera ='$camaronera';";
                                          $data = $objeto->mostrar($sqli);
                                          // echo $datars[0]['tipo'];
                                                    foreach ($data as $valuer) {                                          ?>

                                         <option class="text-center" id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="<?php echo $valuer['id_tipo'] ?>">
                                      <?php echo $valuer['tipo']; ?>
                                        </option>
                                                                     }
                                                    <?php } 
                                    
                                ?>  <!-- <option class="text-center" id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="<?php echo '6'; ?>">
                                      BWs
                                        </option>-->
                                                  
                                                </select>

                                            </span>
                                            
                                        </td>
                                        

  <!-- cantidad dia lunes -->
                                        <?php
                                        
                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_corrida = '$aux_corrida' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$uno'";
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; } ?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_uno = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$uno' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_uno = $objeto->mostrar($sql_uno);
                                            foreach ($data_uno as $x) {

                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a1= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_dos = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$dos' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_dos = $objeto->mostrar($sql_dos);
                                            foreach ($data_dos as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a2= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_tres = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$tres' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_tres = $objeto->mostrar($sql_tres);
                                            foreach ($data_tres as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a3= floatval($x['total']) ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_cuatro = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$cuatro' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_cuatro = $objeto->mostrar($sql_cuatro);
                                            foreach ($data_cuatro as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a4= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_cinco = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$cinco' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_cinco = $objeto->mostrar($sql_cinco);
                                            foreach ($data_cinco as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a5= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_seis = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$seis' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_seis = $objeto->mostrar($sql_seis);
                                            foreach ($data_seis as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a6= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;padding:1px;padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_siete = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$siete' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_siete = $objeto->mostrar($sql_siete);
                                            foreach ($data_siete as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a7= floatval($x['total']); ?></span>
                                            <?php } ?>
                                        </td>
                                        <!-- cantidad dia lunes

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd1[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento1[]'.$value['id_piscina'];?>" name="<?php echo 'alimento1[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->

                                        <!-- cantidad dia martes 

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd2[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento2[]'.$value['id_piscina'];?>" name="<?php echo 'alimento2[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>-->


                                        <!-- cantidad dia miercoles
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd3[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento3[]'.$value['id_piscina'];?>" name="<?php echo 'alimento3[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->




                                        <!-- cantidad dia jueves
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd4[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento4[]'.$value['id_piscina'];?>" name="<?php echo 'alimento4[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->



                                        <!-- cantidad dia viernes 
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd5[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento5[]'.$value['id_piscina'];?>" name="<?php echo 'alimento5[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>         -->  


                                        <!-- cantidad dia sabado
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd6[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento6[]'.$value['id_piscina'];?>" name="<?php echo 'alimento6[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->
  


                                        <!-- cantidad dia domingo   
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd7[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento7[]'.$value['id_piscina'];?>" name="<?php echo 'alimento7[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->


                                        

                                         

                                <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde' AND fecha_alimentacion <= '$hasta' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                              <input type="hidden" name="acumulado[]" value="<?php echo intval($acum_semanal); ?>" id="<?php echo 'acumulado[]'.$value['id_piscina'];?>" >
                                        </td>
                                        
                                     <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'alimentotd0[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'alimento0[]'.$value['id_piscina'];?>" name="<?php echo 'alimento0[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                        
                                     <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'porcentajetd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'porcentaje[]'.$value['id_piscina'];?>" name="<?php echo 'porcentaje[]'.$value['id_piscina'];?>" value="0.00" step="any"  readonly  placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                                                             <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'fcvtd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:blue;" class=" form-control" id="<?php echo 'fcv[]'.$value['id_piscina'];?>" name="<?php echo 'fcv[]'.$value['id_piscina'];?>" value="0.00" step="any"  readonly  placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                                                         <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde_ante' AND fecha_alimentacion <= '$hasta_ante' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                              <input type="hidden" name="acumulado[]" value="<?php echo intval($acum_semanal); ?>" id="<?php echo 'acumulado[]'.$value['id_piscina'];?>" >
                                        </td>
                                         <?php

                                      //  $sql_peso_actual = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $sql_peso_actual = "SELECT COALESCE(peso, 0.00) AS pesofinal
                                              FROM `registro_muestreo`
                                                                       WHERE id_piscina = '$aux'
                                                                                                 AND id_camaronera = '$camaronera'  AND id_corrida = '$aux_corrida'
                                                                                                  AND fecha_muestreo >= '$hasta' AND fecha_muestreo <= CURDATE()
                                                    ORDER BY fecha_muestreo DESC
                                                            LIMIT 1;";


  $sql_peso_actual = "
SELECT *,COALESCE(peso, 0.00) AS pesofinal FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo <= '$hasta_ante' ORDER BY fecha_muestreo DESC LIMIT 1;
";
                                        $data_peso_actual = $objeto->mostrar($sql_peso_actual);

                                        foreach ($data_peso_actual as $values_peso_actual) {
                                            $peso11 = $values_peso_actual['pesofinal'];
                                        }

                                        ?>

                                                                                <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            #incremento actual
                                            //$f = date('Y-m-d', $dia_siete);
                                            $dx_7 = date('Y-m-d', strtotime($hasta . "- 7 days"));
                                            $sql = "SELECT MAX(incremento) AS total FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx_7'";
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
                                        
                                                         <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidad = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidad = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MAX(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidad = $objeto->mostrar($sql_densidad);

                                            foreach ($data_densidad as $values_densidad) {
                                                $densidad = $values_densidad['densidad'];
                                            }
                                            
                                            ?>
                                
                                        <?php   $currentday =$diff->days-1;
                                        $sql_param = "SELECT dias, mortalidad FROM parametros_soreviviencia WHERE id_camaronera = '$camaronera';";
                                        $data_param = $objeto->mostrar($sql_param);
                                        
                                        if ($currentday <= $data_param[0]['dias'] AND FALSE){
                                            $mor_total =$densidads * ($data_param[0]['mortalidad']/100) ;
                                            $mor_diaria = ($mor_total / $data_param[0]['dias']);

                                        ?>
                                        
                                                                                        <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidadfijo[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" name="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" 
                                                value ="<?php       echo $densref =  $densidads - ($mor_diaria*$currentday); ?>">
                                            </span>
                                        
                                        <?php   
                                        } else {
                                            
                                                             $getproyect = "select densidad, libras_tot, peso_final, hectareas, alim_sum2, n
                                                                ,  1.00/(0.007963335+0.1387779/peso_final) AS kg_10_m 
                                                                    , (alim_sum2 / hectareas) / n AS kg_ha_semana_m
                                                                        from simulacion_proceso_test 
                                                                            WHERE fecha_muestreo = '$hasta_ante'
                                                                                AND id_camaronera = '$camaronera'
                                                                                    AND piscinas = '$aux'
                                                                                        AND id_bio = 'BW Prom'";
                                             $data_proyect = $objeto->mostrar($getproyect);
                                           $proyecto= ($data_proyect[0]['kg_ha_semana_m']*10)/$data_proyect[0]['kg_10_m'];
                                            //var_dump($proyecto);
                                            
                                            
                                            
                                        
                                        ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidadfijo[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" name="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" value ="<?php  if ($densidad == 0 || $densidad == null) {
                                                                                                        echo $densidad = 0;
                                                                                                    } else {
                                                                                               echo  $densref = intval($proyecto*10000);         // echo  $densref = intval($densidad);
                                                                                                    } ?>">
                                            </span>
                                                                                <?php   
                                        } 
                                        
                                        ?>
                                        
                                        
                                        
                                        
                                                                                                    
                                        </td>
                                        
                                                                                <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>">
                                            <?php
                                            $sql_acumulado = "SELECT SUM(cantidad + cantidad_2) AS total FROM `registro_alimentacion_engorde` 
                                            WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_alimentacion <= '$hasta_ante' 
                                            ;";
                                            $data_acumulado = $objeto->mostrar($sql_acumulado);
                                            foreach ($data_acumulado as $acumulado) {
                                            $acum = $acumulado['total'];
                                            }
                                            
                                           // $sql_conversion = "SELECT acum_anterior FROM `proyeccion_alimento_test` WHERE ps = '$aux' AND camaronera = '$camaronera' AND fecha >= '$desde' AND fecha <= '$hasta'";
                                            //$data_conversion = $objeto->mostrar($sql_conversion);

                                            //foreach ($data_conversion as $base_conversion) {
                                                $pounds = 2.2;$grams = 454;
                                              //  $acum_anterior = $base_conversion['acum_anterior'];
                                                $fcv = (($acum/ $value['hectareas']) * $pounds)/(($densref * $peso11) / $grams); 
                                                $fcv = ($acum * $pounds) / (($densref * $peso11 / $grams + $data_proyect[0]['libras_tot']) * $value['hectareas']);
                                              //    $fcv = ($acum * $pounds) / (($data_proyect[0]['densidad'] * 10000 * $peso11 / $grams + $data_proyect[0]['libras_tot']) * $value['hectareas']);
                                                $den = $densref * $peso11/454;  // 854.59 lbs camaron
                                                $num = ($acum / $value['hectareas']) * 2.2; //4125 lbs de comida 
                                                
                                        //    }
                                            ?>
                                    <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'fcv_fijo[]'.$key['id_piscina'];?>">
                                            <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:blue;" class=" form-control" id="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" step="any" readonly style="" 
                                                value ="<?php echo number_format($fcv, 2) ;  ?>"> 
                                    </span> </td>
                                                <td class="align-middle text-center" style="padding:1px;padding:1px;border: solid 0px #343a40;display:none;">
                                              <?php   
                 $factorTotal = + ($a1/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['lun'] * $datosatomicos[0]['bw1']) 
                            + ($a2/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['mar'] * $datosatomicos[0]['bw2'])
                            + ($a3/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['mie'] * $datosatomicos[0]['bw3'])
                            + ($a4/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['jue'] * $datosatomicos[0]['bw4'])
                            + ($a5/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['vie'] * $datosatomicos[0]['bw5'])
                            + ($a6/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['sab'] * $datosatomicos[0]['bw6'])
                            + ($a7/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['dom'] * $datosatomicos[0]['bw7']);
                                  echo intval($factorTotal) ;
                                  // $densidad[$i] = ($kgha_dia[$i] * 100000) / ($phas * $peso_diario[$i] * $bw_data[$i]);
                                        ?>
                                     </td>
                                    <?php } ?>
                                   



                                    </tr>

                                                    
                                                
                                     <tr style=" border: solid 0px #343a40; color:white;">
                                 <td class="align-middle text-center" style="padding:1px;border: solid 0px #343a40; color:white;"  colspan="25">
                                   <button type="submit" class="btn btn-danger btn-sm mt-3 text-center" id="add-egres">Grabar proyeccion</button>
                                     </td>
                                     </tr>
                            </tbody>
                           
                        </table>
                       </form>
                    </div>
        
        
        
        
        
                    


<?php
} else {
        
?>
         <div class="scroll mt-5">
                                              <form id="main" action="../controllers/proyeccion-alimento-fcv.php" method="post">
                                  <!-- por PISCINA, INCLUIR TOTAL SEMANAL -->  
                        <table class="table table-sm tab table-striped">
                            <thead>
                                 <tr class="text-center" style="border: solid 2px #343a40"><th style="background:orange; border: solid 2px #343a40; color:black;min-height:17px;margin:auto;" colspan="11"><b>PROYECCION</b></th>
                                 <th  style="background: black; color:white; border: solid 2px #343a40;margin:auto;" colspan="8"><b>ALIMENTO REAL</b></th>
                                 <th  style="background: white; color:black; border: solid 2px #343a40;margin:auto;" colspan="3"><b>PROYECTADO</b></th>
                                       <th  style="background: white; color:black; border: solid 2px #343a40;margin:auto;" colspan="6"><b> SEMANA ANTERIOR</b></th>
                                 </tr>
                                <tr class="text-center" style="border: solid 2px #343a40">

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ps</th>

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ha</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Días</th>
                                    
                                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Siembra</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Dens.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    
                                        <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">% sup.</th>
                                     
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso Inicial </th>
                                    
                                 <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Inc.&nbsp;&nbsp;&nbsp; </th>
                                    
                                     <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso <br> Proy.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                             <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">  Incremento <br>Intermedio</th>
                                      <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">BW</th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        Lun<br><strong><?php $uno = $desde; ?></strong></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mar<br>
                                        <?php $dos = date('Y-m-d', $dia_dos); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mie<br>
                                        <?php $tres = date('Y-m-d', $dia_tres); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Jue<br>
                                        <?php $cuatro = date('Y-m-d', $dia_cuatro); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Vie<br>
                                        <?php $cinco = date('Y-m-d', $dia_cinco); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Sab<br>
                                        <?php $seis = date('Y-m-d', $dia_seis); ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Dom<br>
                                        <?php $siete = date('Y-m-d', $dia_siete); ?></th>

                                        <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        TOTAL <br>REAL</th>
                                             <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                       <b>TOTAL<br> SUGER</b> </th>
                                  <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                        <b>% <br>EJEC.&nbsp;&nbsp;</b></th>
                                 <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                        <b>FCV <br>PROY</b></th>

   <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        ALIM. <br>ANT.</th>
                                          
                                           <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        INC. <br>ANT.</th>
                                     <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        AL. PROY <br>ANT.</th>
                                 <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        DENS.PROY <br>ANT.</th>
                                     <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        PROYECT. <br>BALANC.&nbsp;&nbsp;&nbsp;</th>
                                  <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        FCV <br> ANT.&nbsp;</th>
                                       
                                </tr>
                            </thead>

                            <tbody>

                                <?php

                                $sql_piscina = "SELECT DISTINCT id_piscina, id_corrida, hectareas FROM registro_piscina_engorde WHERE estado != 'Cosechado' AND id_camaronera = '$camaronera' ORDER BY id_piscina ASC";
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

                                    <tr>

                                        <!-- numero de piscina -->
                                        <td class="align-middle text-center" data-toggle="modal" data-target=".bd-example-modal-sm<?php echo $psm; ?>" style="padding:1px;border: 1px solid #40497C" alt="<?php echo 'piscinas[]'.$value['id_piscina'];?>">
                                            <span class="text-secondary text-xs font-weight-bold" class=" form-control" id="<?php echo 'piscinas[]'.$value['id_piscina'];?>" name="<?php echo 'piscinas[]'.$value['id_piscina'];?>">
                                                <?php
                                                    
                                                    //echo $aux = $value['id_piscina'];
                                                    $aux_corrida = $value['id_corrida']; 
                                                    
                                                    if($value['id_piscina'] == 17){
                                                        
                                                     //   echo '17A';
                                                        $aux = $value['id_piscina'];
                                                        
                                                    }else if($value['id_piscina'] == 22){
                                                      //  echo '17B';
                                                        $aux = 22;
                                                    }else{
                                                     $aux = $value['id_piscina'];
                                                    }
                                                ?>
                                            </span>
                                                <input type="text" class="input2 form-control"  id = "<?php echo 'piscinas[]'.$value['id_piscina']; ?>"  name="<?php echo 'piscinas[]'.$value['id_piscina']; ?>" readonly value="<?php  if($value['id_piscina'] == 22 ){ echo '17B'; }else{ echo $value['id_piscina'];} ?>" readonly style="background:none;border:0">
                                                <input type="hidden" name="corridas[]" value="<?php echo $value['id_corrida']; ?>">
                                                <input type="hidden" name="<?php echo 'corrida[]'.$value['id_piscina']; ?>" id="<?php echo 'corrida[]'.$value['id_piscina']; ?>" value="<?php echo $value['id_corrida']; ?>">
                                                 <input type="hidden" name="camaroneras[]" value="<?php echo $camaronera ?>">
                                            <?php include 'modal-alimento.php'; ?>
                                        </td>


                                        <!-- hectareas de picina -->
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" class="input2 form-control"  id = "<?php echo 'hastd[]'.$value['id_piscina']; ?>"  name="<?php echo 'hastd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php $ha = $value['hectareas']; ?>
                                     <input type="text" class="input2 form-control" style = "padding:0px;margin:0px;border:0px;text-align:center;"  id = "<?php echo 'has[]'.$value['id_piscina']; ?>"  name="<?php echo 'has[]'.$value['id_piscina']; ?>" readonly value="<?php echo  $value['hectareas']; ?>" readonly style="background:none;border:0;">
                                            </span>
                                        </td>
                                        
                                         <!-- peso muestreo -->
                                   <?php

                                        $sql_peso_actual = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $data_peso_actual = $objeto->mostrar($sql_peso_actual);

                                        foreach ($data_peso_actual as $values_peso_actual) {
                                            $peso1 = $values_peso_actual['total'];
                                        }

                                        ?>


                                        
                                                                                <!-- dias transcurridos -->
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_dias = "SELECT fecha_siembra FROM `registro_piscina_engorde` WHERE id_piscina = '$aux' AND estado != 'Cosechado' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_dias = $objeto->mostrar($sql_dias);

                                            foreach ($data_dias as $values_dias) {
                                                $siembra = $values_dias['fecha_siembra'];
                                            }

                                            $fecha1 = new DateTime($siembra);
                                            $fecha2 = new DateTime($fechaActual);
                                            $diff = $fecha1->diff($fecha2);



                                            ?>
                                          <input type="hidden" value="<?php echo $diff->days-1; ?>" id="<?php echo 'dias[]'.$value['id_piscina'];?>" name="<?php echo 'dias[]'.$value['id_piscina'];?>">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'getdias[]'.$value['id_piscina']; ?>" name = "<?php echo 'getdias[]'.$value['id_piscina']; ?>"><?php echo $diff->days-1;  ?></span>
                                        </td>
                                        
                                        
                             <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidads = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidads = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MIN(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidads = $objeto->mostrar($sql_densidads);

                                            foreach ($data_densidads as $values_densidads) {
                                                $densidads = $values_densidads['densidad'];
                                                
                                            }
                                            
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidads[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'densidadess[]'.$value['id_piscina'];?>" name="<?php echo 'densidadess[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" value ="<?php  if ($densidads == 0 || $densidads == null) {
                                                                                                        echo $densidads = 0;
                                                                                                    } else {
                                                                                                        echo  intval($densidads);
                                                                                                    } ?>">
                                            </span>
                                        
                                        
                                        
                                        
                                                                                                    
                                        </td>
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidad = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidad = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MAX(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidad = $objeto->mostrar($sql_densidad);

                                            foreach ($data_densidad as $values_densidad) {
                                                $densidad = $values_densidad['densidad'];
                                            }
                                            
                                            ?>
                                
                                        <?php   $currentday =$diff->days-1;
                                        $sql_param = "SELECT dias, mortalidad FROM parametros_soreviviencia WHERE id_camaronera = '$camaronera';";
                                        $data_param = $objeto->mostrar($sql_param);
                                        
                                        if ($currentday <= $data_param[0]['dias'] ){
                                            $mor_total =$densidads * ($data_param[0]['mortalidad']/100) ;
                                            $mor_diaria = ($mor_total / $data_param[0]['dias']);

                                        ?>
                                        
                                                                                        <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:red" class=" form-control" id="<?php echo 'densidades[]'.$value['id_piscina'];?>" name="<?php echo 'densidades[]'.$value['id_piscina'];?>" step="any"  placeholder="0.00" style="" 
                                                value ="<?php       echo $densref = intval($densidads - ($mor_diaria*$currentday)); ?>">
                                            </span>
                                        
                                        <?php   
                                        } else {
                                            
                                                             $getproyect = "select densidad, libras_tot, peso_final, hectareas, alim_sum2, n
                                                                ,  1.00/(0.007963335+0.1387779/peso_final) AS kg_10_m 
                                                                    , (alim_sum2 / hectareas) / n AS kg_ha_semana_m
                                                                        from simulacion_proceso_test 
                                                                            WHERE fecha_muestreo = '$hasta_ante'
                                                                                AND id_camaronera = '$camaronera'
                                                                                    AND piscinas = '$aux'
                                                                                        AND id_bio = 'BW Prom'";
                                             $data_proyect = $objeto->mostrar($getproyect);
                                           $proyecto= ($data_proyect[0]['kg_ha_semana_m']*10)/$data_proyect[0]['kg_10_m'];
                                            //var_dump($proyecto);
                                            
                                            
                                            
                                        
                                        ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:green;" class=" form-control" id="<?php echo 'densidades[]'.$value['id_piscina'];?>" name="<?php echo 'densidades[]'.$value['id_piscina'];?>" step="any"  placeholder="0.00" style="width:85px;" value ="<?php  if ($densidad == 0 || $densidad == null) {
                                                                                                        echo $densidad = 0;
                                                                                                    } else {
                                                                                               echo  $densref = intval($proyecto*10000);         // echo  $densref = intval($densidad);
                                                                                                    } ?>">
                                            </span>
                                                                                <?php   
                                        } 
                                        
                                        ?>
                                        
                                        
                                        
                                        
                                                                                                    
                                        </td>
                                           <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'supervivetd[]'.$value['id_piscina'];?>">
                                         <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'superviv[]'.$key['id_piscina'];?>">
                                        <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'supervive[]'.$value['id_piscina'];?>" name="<?php echo 'supervive[]'.$value['id_piscina'];?>" step="any"  readonly style="" 
                                                value ="<?php echo number_format(floatval($densref / $densidads)*100, 2, '.', ''); ?>">
                                            </span>
                                            
                                         
                                                
                                                  </td>


                                        <!-- acumulado semanal
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde' AND fecha_alimentacion <= '$hasta' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                        </td> -->

                                        <!-- acumulado total
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php

                                            $sql_acumulado = "SELECT SUM(cantidad + cantidad_2) AS total FROM `registro_alimentacion_engorde` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                        </td>-->

                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"><?php if ($peso1 == 0 || $peso1 == null) {
                                                                                                         $peso1 = 0.00;
                                                                                                    } else {
                                                                                                      //  echo  $peso1;
                                                                                                    } ?>
                             <input type="text" class="input2 form-control" style = "padding:0px;margin:0px;border:0px;text-align:center;" id = "<?php echo 'peso[]'.$value['id_piscina']; ?>"  name="<?php echo 'peso[]'.$value['id_piscina']; ?>" readonly value="<?php echo '  '.$peso1; ?>" readonly style="background:none;border:0;">
                                         
                                                                                                    </span>
                                        </td>
 
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'crecimientos[]'.$value['id_piscina'];?>" name="<?php echo 'crecimientos[]'.$value['id_piscina'];?>" step="any"  placeholder="0.00" style="">
                                            </span>
                                        </td>
                                        
                                           <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C" id="<?php echo 'pesofinalestd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'pesofinales[]'.$value['id_piscina'];?>" name="<?php echo 'pesofinales[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                         
                                                                                
                                        
                                        
                                                                <!-- peso miercoles -->
                                        <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php
                                            $sql = "SELECT MAX(peso) as peso FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo < '$fechaActual' LIMIT 1";
                                           // $sql = "SELECT peso FROM registro_peso WHERE fecha_peso > '$desde_ante' and fecha_peso < '$hasta_ante' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' ORDER BY fecha_peso DESC LIMIT 1;";
                                            
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $m = $x['peso'];
                                            }

                                            $sql = "SELECT  MAX(fecha_peso) as fecha_peso FROM registro_peso WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {

                                                $fm = $x['fecha_peso'];
                                            }

                                            $sql = "SELECT peso FROM registro_peso WHERE fecha_peso = '$fm' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            
                                            $sql = "SELECT peso FROM registro_peso WHERE fecha_peso > '$desde' and fecha_peso < '$hasta' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' ORDER BY fecha_peso DESC LIMIT 1;";
                                            
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $mm = $x['peso'];
                                            }
                                            ?>

                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                if($mm == NULL){ echo '_';}else
                                                {
                                                $r = sprintf('%.2f', abs($m - $mm));
                                                if ($r >= 3.00) {
                                                     $r2 = 0;
                                                } else {
                                                     $r2 = $r;
                                                }
                                                }
                                                ?>
                         <input type="text" class="input2 form-control" style = "padding:0px;margin:0px;border:0px;text-align:center;" id = "<?php echo 'intermedio[]'.$value['id_piscina']; ?>"  name="<?php echo 'intermedio[]'.$value['id_piscina']; ?>" readonly value="<?php echo $r2; ?>" readonly style="background:none;border:0;">
                                
                                            </span>
                                            <?php ?>
                                        </td>
                                        <?php
                                         $sqlbw="select bw from proyeccion_alimento_test WHERE camaronera = '$camaronera' AND ps = '$aux' AND fecha >= '$desde' AND fecha <='$hasta' AND estado = '1'";
                                    $databw = $objeto->mostrar($sqlbw);
                                    foreach ($databw as $valbw) { $choosen = $valbw['bw'];  }   
                                    if ($choosen < 1 ){
                                    $sqlbw="select bw from proyeccion_alimento WHERE camaronera = '$camaronera' AND ps = '$aux' AND fecha >= '$desde_ante' AND fecha <='$hasta_ante' AND estado = '1'";
                                    $databw = $objeto->mostrar($sqlbw);
                                    foreach ($databw as $valbw) { $choosen = $valbw['bw'];  } 
                                    } 
                                        ?>
                                      <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id = "<?php echo 'factorestd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'factor[]'.$value['id_piscina']; ?>">

                                    <select class="select"   id = "<?php echo 'factores[]'.$value['id_piscina']; ?>" name= "<?php echo 'factores[]'.$value['id_piscina']; ?>">
                                                     <option class="text-center"  id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="0" style"display:;">
                                                        [Seleccione]
                                                        </option>
                                                    <?php
                                       
                                              $sqli = "select * from tipos_conversion where estado = 1 AND id_camaronera ='$camaronera';";
                                          $data = $objeto->mostrar($sqli);
                                          // echo $datars[0]['tipo'];
                              foreach ($data as $valuer) {      $selected = ($valuer['id_tipo'] == $choosen) ? 'selected' : '';                                     ?>
                                         <?php  if ($choosen >= 1 ){ ?>
                                         <option class="text-center" id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="<?php echo $valuer['id_tipo'] ?>" <?php echo $selected; ?>>
                                      <?php echo $valuer['tipo']; ?>
                                        </option>
                                        <?php } else { ?>
                                 <option class="text-center" id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="<?php echo $valuer['id_tipo'] ?>" <?php echo $selected; ?>>
                                      <?php echo $valuer['tipo']; ?>
                                        </option>
                                        <? } $choosen=0; ?>
                                                                     }
                                                    <?php } 
                                    
                                ?>  <!-- <option class="text-center" id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="<?php echo '6'; ?>">
                                      BWs
                                        </option>-->
                                                  
                                                </select>

                                            </span>
                                            
                                        </td>

  <!-- cantidad dia lunes -->
                                        <?php
                                        
                                        $sql = "SELECT id_tipo_alimento, metodo_alimento FROM registro_alimentacion_engorde WHERE  id_piscina = '$aux' AND id_corrida = '$aux_corrida' AND id_camaronera = '$camaronera' AND fecha_alimentacion = '$uno'";
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; } ?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_uno = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$uno' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_uno = $objeto->mostrar($sql_uno);
                                            foreach ($data_uno as $x) {

                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a1= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_dos = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$dos' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_dos = $objeto->mostrar($sql_dos);
                                            foreach ($data_dos as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a2= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_tres = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$tres' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_tres = $objeto->mostrar($sql_tres);
                                            foreach ($data_tres as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a3= floatval($x['total']) ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_cuatro = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$cuatro' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_cuatro = $objeto->mostrar($sql_cuatro);
                                            foreach ($data_cuatro as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a4= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_cinco = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$cinco' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_cinco = $objeto->mostrar($sql_cinco);
                                            foreach ($data_cinco as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a5= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_seis = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$seis' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_seis = $objeto->mostrar($sql_seis);
                                            foreach ($data_seis as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a6= floatval($x['total']); ?></span>
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
                                        <td class="align-middle text-center" title="<?php echo $td . ' ' . $tg; if($observacion != 'S/N'){ echo ' / '.$observacion; }?>" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_siete = "SELECT SUM(cantidad + cantidad_2) as total FROM registro_alimentacion_engorde WHERE fecha_alimentacion = '$siete' AND id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                            $data_siete = $objeto->mostrar($sql_siete);
                                            foreach ($data_siete as $x) {
                                            ?>
                                                <span class="text-secondary text-xs font-weight-bold"><?php echo $a7= floatval($x['total']); ?></span>
                                            <?php } ?>
                                        </td>
                                        <!-- cantidad dia lunes

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd1[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento1[]'.$value['id_piscina'];?>" name="<?php echo 'alimento1[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->

                                        <!-- cantidad dia martes 

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd2[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento2[]'.$value['id_piscina'];?>" name="<?php echo 'alimento2[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>-->


                                        <!-- cantidad dia miercoles
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd3[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento3[]'.$value['id_piscina'];?>" name="<?php echo 'alimento3[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->




                                        <!-- cantidad dia jueves
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd4[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento4[]'.$value['id_piscina'];?>" name="<?php echo 'alimento4[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->



                                        <!-- cantidad dia viernes 
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd5[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento5[]'.$value['id_piscina'];?>" name="<?php echo 'alimento5[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>         -->  


                                        <!-- cantidad dia sabado
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd6[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento6[]'.$value['id_piscina'];?>" name="<?php echo 'alimento6[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->
  


                                        <!-- cantidad dia domingo   
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd7[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento7[]'.$value['id_piscina'];?>" name="<?php echo 'alimento7[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td> -->


                                        

                                         

                                <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde' AND fecha_alimentacion <= '$hasta' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                              <input type="hidden" style = "padding:0px;margin:0px;border:0px;text-align:center;" name="acumulado[]" value="<?php echo intval($acum_semanal); ?>" id="<?php echo 'acumulado[]'.$value['id_piscina'];?>" >
                                        </td>
                                        
                                                                                </td>
                                                <td class="align-middle text-center" style="padding:1px;border: solid 0px #343a40;display:none;">
                                              <?php   
                 $factorTotal = + ($a1/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['lun'] * $datosatomicos[0]['bw1']) 
                            + ($a2/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['mar'] * $datosatomicos[0]['bw2'])
                            + ($a3/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['mie'] * $datosatomicos[0]['bw3'])
                            + ($a4/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['jue'] * $datosatomicos[0]['bw4'])
                            + ($a5/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['vie'] * $datosatomicos[0]['bw5'])
                            + ($a6/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['sab'] * $datosatomicos[0]['bw6'])
                            + ($a7/$datosatomicos[0]['ha']*1000)/($datosatomicos[0]['dom'] * $datosatomicos[0]['bw7']);
                                  echo intval($factorTotal) ;
                                  // $densidad[$i] = ($kgha_dia[$i] * 100000) / ($phas * $peso_diario[$i] * $bw_data[$i]);
                                        ?>
                                     </td>
                                        
                                     <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'alimentotd0[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'alimento0[]'.$value['id_piscina'];?>" name="<?php echo 'alimento0[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                        
                                     <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'porcentajetd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'porcentaje[]'.$value['id_piscina'];?>" name="<?php echo 'porcentaje[]'.$value['id_piscina'];?>" value="0.00" step="any"  readonly  placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                    
                                    <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C;" id="<?php echo 'fcvtd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:blue;" class=" form-control" id="<?php echo 'fcv[]'.$value['id_piscina'];?>" name="<?php echo 'fcv[]'.$value['id_piscina'];?>" value="0.00" step="any"  readonly  placeholder="" style="" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                                                         <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            $sql_semanal = "SELECT SUM(cantidad + cantidad_2) AS total FROM registro_alimentacion_engorde WHERE id_piscina = '$aux' AND fecha_alimentacion >= '$desde_ante' AND fecha_alimentacion <= '$hasta_ante' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
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
                                              <input type="hidden" style = "padding:0px;margin:0px;border:0px;text-align:center;" name="acumulado[]" value="<?php echo intval($acum_semanal); ?>" id="<?php echo 'acumulado[]'.$value['id_piscina'];?>" >
                                        </td>
                                         <?php

                                      //  $sql_peso_actual = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida'";
                                        $sql_peso_actual = "SELECT COALESCE(peso, 0.00) AS pesofinal
                                              FROM `registro_muestreo`
                                                                       WHERE id_piscina = '$aux'
                                                                                                 AND id_camaronera = '$camaronera'  AND id_corrida = '$aux_corrida'
                                                                                                  AND fecha_muestreo >= '$hasta_ante' AND fecha_muestreo <= CURDATE()
                                                    ORDER BY fecha_muestreo DESC
                                                            LIMIT 1;";


  $sql_peso_actualOff = "
SELECT *,COALESCE(peso, 0.00) AS pesofinal FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo <= '$hasta_ante' ORDER BY fecha_muestreo DESC LIMIT 1;
";
                                        $data_peso_actual = $objeto->mostrar($sql_peso_actual);

                                        foreach ($data_peso_actual as $values_peso_actual) {
                                            $peso11 = $values_peso_actual['pesofinal'];
                                        }

                                        ?>

                                                                                <td class="align-middle text-center" style="padding:1px;border: 1px solid #40497C">
                                            <?php

                                            #incremento actual
                                            //$f = date('Y-m-d', $dia_siete);
                                            $dx_7 = date('Y-m-d', strtotime($hasta . "- 7 days"));
                                            $sql = "SELECT MAX(incremento) AS total FROM registro_muestreo WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$dx_7'";
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
                                                                                <td class="align-middle text-center" style="padding:1px;margin:0px;border: 1px solid #40497C;" id="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>">
                                            <?php
                                            $sql_histo = "SELECT densidad, alimento_proyectado FROM proyeccion_alimento WHERE camaronera = '$camaronera' AND ps = '$aux' AND fecha >= '$desde_ante' AND fecha <= '$hasta_ante';";
                                            $data_histo = $objeto->mostrar($sql_histo);
                                            foreach ($data_histo as $histo) {
                                            $alimento_proyectado_ante = $histo['alimento_proyectado'];
                                            }
                                            ?>
                                    <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'fcv_fijo[]'.$key['id_piscina'];?>">
                                            <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" step="any" readonly style="" 
                                                value ="<?php echo $alimento_proyectado_ante ;  ?>"> 
                                    </span> </td>
                                    <td class="align-middle text-center" style="padding:1px;margin:0px;border: 1px solid #40497C;" id="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>">
                                            <?php
                                            $sql_histo = "SELECT densidad, alimento_proyectado FROM proyeccion_alimento WHERE camaronera = '$camaronera' AND ps = '$aux' AND fecha >= '$desde_ante' AND fecha <= '$hasta_ante';";
                                            $data_histo = $objeto->mostrar($sql_histo);
                                            foreach ($data_histo as $histo) {
                                            $densidad_ante = $histo['densidad'];
                                            }
                                            ?>
                                    <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'fcv_fijo[]'.$key['id_piscina'];?>">
                                            <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;" class=" form-control" id="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" step="any" readonly style="" 
                                                value ="<?php echo $densidad_ante ;  ?>"> 
                                    </span> </td>
                                        
                                                         <td class="align-middle text-center" style="padding:1px;margin:0px;border: 1px solid #40497C;">
                                            <?php
                                            
                                            $f = date('Y-m-d', $dia_siete);
                                            $sql_densidad = "SELECT densidad AS densidad FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_muestreo = '$f'";
                                            
                                            $sql_densidad = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND id_registro_muestreo = ( SELECT MAX(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida= '$aux_corrida' );";
                                            
                                            $data_densidad = $objeto->mostrar($sql_densidad);

                                            foreach ($data_densidad as $values_densidad) {
                                                $densidad = $values_densidad['densidad'];
                                            }
                                            
                                            ?>
                                
                                        <?php   $currentday =$diff->days-1;
                                        $sql_param = "SELECT dias, mortalidad FROM parametros_soreviviencia WHERE id_camaronera = '$camaronera';";
                                        $data_param = $objeto->mostrar($sql_param);
                                        
                                        if ($currentday <= $data_param[0]['dias'] AND FALSE){
                                            $mor_total =$densidads * ($data_param[0]['mortalidad']/100) ;
                                            $mor_diaria = ($mor_total / $data_param[0]['dias']);

                                        ?>
                                        
                                                                                        <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidadfijo[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;"  class=" form-control" id="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" name="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" 
                                                value ="<?php       echo $densref =  intval($densidads - ($mor_diaria*$currentday)); ?>">
                                            </span>
                                        
                                        <?php   
                                        } else {
                                            
                                                             $getproyect = "select densidad, libras_tot, peso_final, hectareas, alim_sum2, n
                                                                ,  1.00/(0.007963335+0.1387779/peso_final) AS kg_10_m 
                                                                    , (alim_sum2 / hectareas) / n AS kg_ha_semana_m
                                                                        from simulacion_proceso_test 
                                                                            WHERE fecha_muestreo = '$hasta_ante'
                                                                                AND id_camaronera = '$camaronera'
                                                                                    AND piscinas = '$aux'
                                                                                        AND id_bio = 'BW Prom'";
                                             $data_proyect = $objeto->mostrar($getproyect);
                                           $proyecto= ($data_proyect[0]['kg_ha_semana_m']*10)/$data_proyect[0]['kg_10_m'];
                                            //var_dump($proyecto);
                                            
                                            
                                            
                                        
                                        ?>
                                                <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidadfijo[]'.$key['id_piscina'];?>">
                                                <input type="number"  style = "padding:0px;margin:0px;border:0px;text-align:center;"  class=" form-control" id="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" name="<?php echo 'densidadesfijo[]'.$value['id_piscina'];?>" step="any" readonly placeholder="0.00" style="" value ="<?php  if ($densidad == 0 || $densidad == null) {
                                                                                                        echo $densidad = 0;
                                                                                                    } else {
                                                                                               echo  $densref = intval($proyecto*10000);         // echo  $densref = intval($densidad);
                                                                                                    } ?>">
                                            </span></td>
                                                                                <?php   
                                        } 
                                        
                                        ?>
                                        
                                        <td class="align-middle text-center" style="padding:1px;margin:0px;border: 1px solid #40497C;" id="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyecttd[]'.$value['id_piscina'];?>">
                                            <?php
                                            $sql_acumulado = "SELECT SUM(cantidad + cantidad_2) AS total FROM `registro_alimentacion_engorde` 
                                            WHERE id_piscina = '$aux' AND id_camaronera = '$camaronera' AND id_corrida = '$aux_corrida' AND fecha_alimentacion <= '$hasta_ante' 
                                            ;";
                                            $data_acumulado = $objeto->mostrar($sql_acumulado);
                                            foreach ($data_acumulado as $acumulado) {
                                            $acum = $acumulado['total'];
                                            }
                                            
                                           // $sql_conversion = "SELECT acum_anterior FROM `proyeccion_alimento_test` WHERE ps = '$aux' AND camaronera = '$camaronera' AND fecha >= '$desde' AND fecha <= '$hasta'";
                                            //$data_conversion = $objeto->mostrar($sql_conversion);

                                            //foreach ($data_conversion as $base_conversion) {
                                                $pounds = 2.204;$grams = 454;$densrefull =$data_proyect[0]['libras_tot']+$densref;
                                              //  $acum_anterior = $base_conversion['acum_anterior'];
                                                $fcv = (($acum/ $value['hectareas']) * $pounds)/(($densrefull * $peso11) / $grams); 
                                                $fcv = ($acum * $pounds) / (($densref * $peso11 / $grams + $data_proyect[0]['libras_tot']) * $value['hectareas']);
                                              //   $fcv = ($acum * $pounds) / (($data_proyect[0]['densidad'] * 10000 * $peso11 / $grams + $data_proyect[0]['libras_tot']) * $value['hectareas']);

                                                $den = $densref * $peso11/454;  // 854.59 lbs camaron
                                                $num = ($acum / $value['hectareas']) * 2.2; //4125 lbs de comida 
                                                
                                        //    }
                                            ?>
                                    <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'fcv_fijo[]'.$key['id_piscina'];?>">
                                            <input type="number" style = "padding:0px;margin:0px;border:0px;text-align:center;color:blue;" class=" form-control" id="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" name="<?php echo 'fcv_proyect[]'.$value['id_piscina'];?>" step="any" readonly style="" 
                                                value ="<?php echo number_format($fcv, 2) ;  ?>"> 
                                    </span> </td>


                                     
                          <?php  $fcv = "SELECT anim_min FROM simulacion_proceso_test WHERE fecha_muestreo = '$hasta_ante' AND id_camaronera = '$camaronera' and piscinas = '$aux' AND id_bio = 'BW Prom';";
                            $datafcv = $objeto->mostrar($fcv);foreach ($datafcv as $fcv) { $fcv = $fcv['anim_min'];} ?>
                            <td class="align-middle text-center" style="padding:1px;border: solid 1px #343a40;display:none;">  <span class="text-secondary text-xs font-weight-bold"><?php echo $fcv; ?> </span> </td>   
                                            
                                            
                                    <?php } ?>
                                   



                                    </tr>

                                                    
                                                

                            </tbody>
                           
                        </table>
                          <img id="loading" src="../src/img/loader.gif" class="header-brand-img" alt="lavalite" style="display:none; position:absolute;top:512px;right:400px;z-index:9999;width:64px;">
                       </form>
                    </div>
    <?php
} 
        
?>
                    <script>
function pesos(suffix) {
                                 
   var ajaxValue = '<?php echo $_SESSION['ajax']; ?>';
    var camaroneras = '<?php echo $_SESSION['llc']; ?>';
    var pesos =  document.getElementById('peso[]' + suffix).value;
    var pesosp =  document.getElementById('crecimientos[]' + suffix).value;
   // var masa =  document.getElementById('factor[]' + suffix).value;
    //  alert(pesos);
    //  alert(pesosp);
     //   alert(parseFloat(pesos) + parseFloat(pesosp));
     var formData = new FormData();
   formData.append('pcamaronera', camaroneras);
    formData.append('ppiscina', suffix);
       formData.append('ppeso', pesos); 
     formData.append('ppesofinal', pesosp);
     
                  
         var xhr = new XMLHttpRequest();
           xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
             var response = JSON.parse(xhr.responseText);
                var cantidades = parseFloat(response.costofinal);
                var pesof = parseFloat(pesos) + parseFloat(pesosp);
                   document.getElementById('pesofinalestd[]' + suffix).querySelector('input').value = pesof;
            } else {

                console.error('Error: ' + xhr.status);
            }
        }
    };
    
    xhr.open('POST', ajaxValue, true);
    xhr.send(formData);
}

function masas(suffix) {
    document.getElementById("loading").style.display = "block";            
   var ajaxValue = '<?php echo $_SESSION['ajaxtest']; ?>';
    var camaroneras = '<?php echo $_SESSION['llc']; ?>';
    var pesos =  document.getElementById('peso[]' + suffix).value;
    var pesosp =  document.getElementById('crecimientos[]' + suffix).value;
    var masa =  document.getElementById('factores[]' + suffix).value;
    var densidad =  document.getElementById('densidades[]' + suffix).value;
    var siembra =  document.getElementById('densidadess[]' + suffix).value;
   // alert(siembra);
    var has =  document.getElementById('has[]' + suffix).value;
    var pesof = parseFloat(pesos) + parseFloat(pesosp);
     var acumulado =  document.getElementById('acumulado[]' + suffix).value;
      var thiscorrida =  document.getElementById('corrida[]' + suffix).value;
    var getdias = document.getElementById('getdias[]' + suffix).innerHTML;
     var getantes = document.getElementById('getantes').innerHTML;
       var getdesde = document.getElementById('semini').innerHTML;
        document.getElementById('pesofinalestd[]' + suffix).querySelector('input').value = pesof;
       document.getElementById('supervivetd[]' + suffix).querySelector('input').value = ((densidad/siembra)*100).toFixed(2);
    //  alert(getantes);
    //    alert(pesof);
    //   alert(masa);
   // alert(has);
      var formData = new FormData();
   formData.append('pcamaronera', camaroneras);
    formData.append('ppiscina', suffix);
       formData.append('ppeso', pesos); 
     formData.append('ppesop', pesosp);
          formData.append('ppesof', pesof);
        formData.append('pmasa', masa);
             formData.append('pdensidad', densidad);
        formData.append('phas', has);
     formData.append('thisdias', getdias);
     formData.append('thisantes', getantes);
       formData.append('thisdesde', getdesde);
       formData.append('thiscorrida', thiscorrida);
  var xhr = new XMLHttpRequest();
    //  alert(masa);
                 xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
             var response = JSON.parse(xhr.responseText);
               document.getElementById("loading").style.display = "none"; 
           //  alert(response.data);
             
                var kgha_lunes = parseFloat(response.kgha_lunes);
                var kgha_martes = parseFloat(response.kgha_martes);
                var kgha_miercoles = parseFloat(response.kgha_miercoles);
                var kgha_jueves = parseFloat(response.kgha_jueves);
                var kgha_viernes = parseFloat(response.kgha_viernes);
                var kgha_sabado = parseFloat(response.kgha_sabado);
                var kgha_domingo = parseFloat(response.kgha_domingo);
              //   alert(response.proyeccion);
            /*   alert(kgha_martes);
                alert(kgha_miercoles);
                alert(kgha_jueves);
                alert(kgha_viernes);
                alert(kgha_sabado);
                alert(kgha_domingo);*/
            var kgha_total = kgha_lunes + kgha_martes + kgha_miercoles + kgha_jueves + kgha_viernes + kgha_sabado + kgha_domingo ;
                            document.getElementById('porcentajetd[]' + suffix).querySelector('input').value = (acumulado / Math.round(kgha_total) * 100).toFixed(2);
                 document.getElementById('fcvtd[]' + suffix).querySelector('input').value = (response.proyeccion).toFixed(2);
                document.getElementById('alimentotd0[]' + suffix).querySelector('input').value = Math.round(kgha_total) ;
                    document.getElementById('alimentotd1[]' + suffix).querySelector('input').value = Math.round(kgha_lunes);
                    document.getElementById('alimentotd2[]' + suffix).querySelector('input').value = Math.round(kgha_martes) ;
                       document.getElementById('alimentotd3[]' + suffix).querySelector('input').value = Math.round(kgha_miercoles) ;
                        document.getElementById('alimentotd4[]' + suffix).querySelector('input').value = Math.round(kgha_jueves) ;
                        document.getElementById('alimentotd5[]' + suffix).querySelector('input').value = Math.round(kgha_viernes) ;
                        document.getElementById('alimentotd6[]' + suffix).querySelector('input').value = Math.round(kgha_sabado) ;
                        document.getElementById('alimentotd7[]' + suffix).querySelector('input').value = Math.round(kgha_domingo) ;
        
                    
                        /*
                    document.getElementById('alimentotd0[]' + suffix).querySelector('input').value = kgha_total;
                    document.getElementById('alimentotd1[]' + suffix).querySelector('input').value = kgha_lunes;
                    document.getElementById('alimentotd2[]' + suffix).querySelector('input').value = kgha_martes;
                       document.getElementById('alimentotd3[]' + suffix).querySelector('input').value = kgha_miercoles;
                        document.getElementById('alimentotd4[]' + suffix).querySelector('input').value = kgha_jueves;
                        document.getElementById('alimentotd5[]' + suffix).querySelector('input').value = kgha_viernes;
                        document.getElementById('alimentotd6[]' + suffix).querySelector('input').value = kgha_sabado;
                        document.getElementById('alimentotd7[]' + suffix).querySelector('input').value = kgha_domingo;
                        */
            } else {

                console.error('Error: ' + xhr.status);
            }
        }
    };
    
    xhr.open('POST', ajaxValue, true);
    xhr.send(formData);
}

   for (let i = 1; i <= 100; i++) {
       if ((document.getElementById('crecimientos[]' + i.toString())) !== null) {
    const element = document.getElementById('crecimientos[]' + i.toString());
     const body = document.getElementById('factor[]' + i.toString());
      const densi = document.getElementById('densidades[]' + i.toString());
    if (element) {
        element.addEventListener('change', function() {
            masas(i.toString());
        });
                body.addEventListener('change', function() {
            masas(i.toString());
        });
                densi.addEventListener('change', function() {
            masas(i.toString());
       });
    }
}}

document.getElementById('main').addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    event.preventDefault();
  }
});

  document.getElementById('mod').addEventListener('click', function() {
   //   document.getElementById("loading").style.display = "block";      
          window.location.href="../views/index.php?page=Alimentos-test";
            var saved = document.getElementById('saved');
            var edited = document.getElementById('edited');
            if (saved.style.display !== 'none') {
                saved.style.display = 'none';
                edited.style.display = 'block';
            } else {
                saved.style.display = 'block';
                edited.style.display = 'none';
            }
        });
                    </script>