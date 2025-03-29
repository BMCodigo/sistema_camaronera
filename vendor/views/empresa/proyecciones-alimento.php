<?php
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
    $sql = " select * from proyeccion_alimento WHERE fecha >='$desde' AND fecha <='$hasta' AND camaronera= '$camaronera' ;"; 
    $datar = $conectar->mostrar($sql);
    
    if (count($datar)>=1){
        
?>


         <div class="scroll mt-5">
                                              <form id="main" action="../controllers/proyeccion-alimento.php" method="post">
                                  <!-- por PISCINA, INCLUIR TOTAL SEMANAL -->  
                        <table class="table table-sm tab table-striped">
                            <thead>
                                 <tr class="text-center" style="border: solid 2px #343a40"><th style="background:orange; border: solid 2px #343a40; color:black;min-height:17px;margin:auto;" colspan="8"><b>PROYECCION</b></th>
                                 <th  style="background: black; color:white; border: solid 2px #343a40;margin:auto;" colspan="8"><b>ALIMENTO</b></th>
                                 <th  style="background: white; color:black; border: solid 2px #343a40;margin:auto;" colspan="2"><b>Real</b></th>
                                 </tr>
                                <tr class="text-center" style="border: solid 2px #343a40">

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ps</th>

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ha</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Días</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Densidad</th>
                                     
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso Inicial </th>
                                    
                                 <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Cre. </th>
                                    
                                     <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso <br> Proyectado</th>
                                     
                                      <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">BW</th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        Lun<br><strong><?php $uno = $desde;echo $uno; ?></strong></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mar<br>
                                        <?php $dos = date('Y-m-d', $dia_dos);echo $dos; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mie<br>
                                        <?php $tres = date('Y-m-d', $dia_tres);echo $tres; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Jue<br>
                                        <?php $cuatro = date('Y-m-d', $dia_cuatro);echo $cuatro; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Vie<br>
                                        <?php $cinco = date('Y-m-d', $dia_cinco);echo $cinco; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Sab<br>
                                        <?php $seis = date('Y-m-d', $dia_seis);echo $seis; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Dom<br>
                                        <?php $siete = date('Y-m-d', $dia_siete);echo $siete; ?></th>

                                        <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        TOTAL</th>
                                             <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                       <b>#</b> </th>
                                                                                     <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                        <b>%</b></th>

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
                                    
                                $sql = " select * from proyeccion_alimento WHERE fecha >='$desde' AND fecha <='$hasta' AND camaronera= '$camaronera' AND ps= '$psm' ;"; 
                             $datosatomicos = $conectar->mostrar($sql); 
                                ?>
 <tr><td></td></tr>
                                    <tr>

                                        <!-- numero de piscina -->
                                        <td class="align-middle text-center" data-toggle="modal" data-target=".bd-example-modal-sm<?php echo $psm; ?>" style="border: 1px solid #40497C" alt="<?php echo 'piscinas[]'.$value['id_piscina'];?>">
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
                                                  
                                            <?php include 'modal-alimento.php'; ?>
                                        </td>


                                        <!-- hectareas de picina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C;width:10%;" class="input2 form-control"  id = "<?php echo 'hastd[]'.$value['id_piscina']; ?>"  name="<?php echo 'hastd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php $ha = $value['hectareas']; ?>
                                     <input type="text" class="input2 form-control"  id = "<?php echo 'has[]'.$value['id_piscina']; ?>"  name="<?php echo 'has[]'.$value['id_piscina']; ?>" readonly value="<?php echo  $value['hectareas']; ?>" readonly style="background:none;border:0;width:100%;">
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
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
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
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $diff->days;  ?></span>
                                        </td>
                                        
                             <td class="align-middle text-center" style="border: 1px solid #40497C;width:8%;">
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
                                                <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'densidades[]'.$value['id_piscina'];?>" name="<?php echo 'densidades[]'.$value['id_piscina'];?>" step="any" readonly  placeholder="0.00" style="width:85px;" value ="<?php  if ($densidad == 0 || $densidad == null) {
                                                                                                        echo $densidad = 0;
                                                                                                    } else {
                                                                                                        echo  intval($densidad);
                                                                                                    } ?>">
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

                                        <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"><?php if ($peso1 == 0 || $peso1 == null) {
                                                                                                         $peso1 = 0.00;
                                                                                                    } else {
                                                                                                      //  echo  $peso1;
                                                                                                    } ?>
                             <input type="text" class="input2 form-control"  id = "<?php echo 'peso[]'.$value['id_piscina']; ?>"  name="<?php echo 'peso[]'.$value['id_piscina']; ?>" readonly value="<?php echo $peso1; ?>" readonly style="background:none;border:0;width:100%;">
                                         
                                                                                                    </span>
                                        </td>
 
                                        <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%;">
                                            <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                 <?echo $datosatomicos[0]['crecimiento']; ?>
                                            </span>
                                        </td>
                                        
                                           <td class="align-middle text-center" style="border: 1px solid #40497C" id="<?php echo 'pesofinalestd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                   <?echo $datosatomicos[0]['peso_proyectado']; ?>
                                            </span>

                                         </td>
                                         
                                                                                 </td>
                                        
                                      <td class="align-middle text-center" style="border: 1px solid #40497C" id = "<?php echo 'factorestd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'factor[]'.$value['id_piscina']; ?>">

                             <?
                                 $xc = $datosatomicos[0]['bw'];
                                 $sql = " select tipo from tipos_conversion WHERE id_biotipo = '$xc' ;"; 
                                $datars = $conectar->mostrar($sql);
                         echo $datars[0]['tipo'];
                              ?>

                                            </span>
                                            
                                        </td>

                                        <!-- cantidad dia lunes -->

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd1[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                   <?echo $datosatomicos[0]['lun']; ?>
                                            </span>

                                         </td>

                                        <!-- cantidad dia martes -->

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd2[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                <?echo $datosatomicos[0]['mar']; ?>
                                            </span>

                                         </td>


                                        <!-- cantidad dia miercoles -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd3[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <?echo $datosatomicos[0]['mie']; ?>
                                            </span>

                                         </td>




                                        <!-- cantidad dia jueves -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd4[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                <?echo $datosatomicos[0]['jue']; ?>
                                            </span>

                                         </td>



                                        <!-- cantidad dia viernes -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd5[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                              <?echo $datosatomicos[0]['vie']; ?>
                                            </span>

                                         </td>           


                                        <!-- cantidad dia sabado -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd6[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                  <?echo $datosatomicos[0]['sab']; ?>
                                            </span>

                                         </td>
  


                                        <!-- cantidad dia domingo    -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd7[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                               <?echo $datosatomicos[0]['dom']; ?>
                                            </span>

                                         </td>


                                        
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:7%" id="<?php echo 'alimentotd0[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <?echo 
                                 $semanatotal = $datosatomicos[0]['lun'] + $datosatomicos[0]['mar'] + $datosatomicos[0]['mie']+ $datosatomicos[0]['jue']+$datosatomicos[0]['vie']+$datosatomicos[0]['sab']+$datosatomicos[0]['dom']; ?>
                                            </span>

                                         </td>
                                         

                                <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%;">
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
                                        
                                     <td class="align-middle text-center" style="border: 1px solid #40497C;width:10%" id="<?php echo 'porcentajetd[]'.$value['id_piscina'];?>" >

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
                                    <?php } ?>
                                   



                                    </tr>

                                                    
                                                
                                     <tr style=" border: solid 2px #343a40; color:white;">
                                 <td class="align-middle text-center" style="border: solid 2px #343a40; color:white;"  colspan="18">
                                
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
                                              <form id="main" action="../controllers/proyeccion-alimento.php" method="post">
                                  <!-- por PISCINA, INCLUIR TOTAL SEMANAL -->  
                        <table class="table table-sm tab table-striped">
                            <thead>
                                 <tr class="text-center" style="border: solid 2px #343a40"><th style="background:orange; border: solid 2px #343a40; color:black;min-height:17px;margin:auto;" colspan="8"><b>PROYECCION</b></th>
                                 <th  style="background: black; color:white; border: solid 2px #343a40;margin:auto;" colspan="8"><b>ALIMENTO</b></th>
                                 <th  style="background: white; color:black; border: solid 2px #343a40;margin:auto;" colspan="2"><b>Real</b></th>
                                 </tr>
                                <tr class="text-center" style="border: solid 2px #343a40">

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ps</th>

                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Ha</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Días</th>
                                    
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Densidad</th>
                                     
                                    <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso Inicial </th>
                                    
                                 <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Cre. </th>
                                    
                                     <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Peso <br> Proyectado</th>
                                     
                                      <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">BW</th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        Lun<br><strong><?php $uno = $desde;echo $uno; ?></strong></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mar<br>
                                        <?php $dos = date('Y-m-d', $dia_dos);echo $dos; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Mie<br>
                                        <?php $tres = date('Y-m-d', $dia_tres);echo $tres; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Jue<br>
                                        <?php $cuatro = date('Y-m-d', $dia_cuatro);echo $cuatro; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Vie<br>
                                        <?php $cinco = date('Y-m-d', $dia_cinco);echo $cinco; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Sab<br>
                                        <?php $seis = date('Y-m-d', $dia_seis);echo $seis; ?></th>

                                    <th style="background: #404e67; color:white; border: solid 2px #343a40;">Dom<br>
                                        <?php $siete = date('Y-m-d', $dia_siete);echo $siete; ?></th>

                                        <th style="background: #404e67; color:white; border: solid 2px #343a40;">
                                        TOTAL</th>
                                             <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                       <b>#</b> </th>
                                                                                     <th style="background: orange; color:black; border: solid 2px #343a40;" colspan="1">
                                        <b>%</b></th>

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
 <tr><td></td></tr>
                                    <tr>

                                        <!-- numero de piscina -->
                                        <td class="align-middle text-center" data-toggle="modal" data-target=".bd-example-modal-sm<?php echo $psm; ?>" style="border: 1px solid #40497C" alt="<?php echo 'piscinas[]'.$value['id_piscina'];?>">
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
                                                 <input type="hidden" name="camaroneras[]" value="<?php echo $camaronera ?>">
                                            <?php include 'modal-alimento.php'; ?>
                                        </td>


                                        <!-- hectareas de picina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C;width:10%;" class="input2 form-control"  id = "<?php echo 'hastd[]'.$value['id_piscina']; ?>"  name="<?php echo 'hastd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php $ha = $value['hectareas']; ?>
                                     <input type="text" class="input2 form-control"  id = "<?php echo 'has[]'.$value['id_piscina']; ?>"  name="<?php echo 'has[]'.$value['id_piscina']; ?>" readonly value="<?php echo  $value['hectareas']; ?>" readonly style="background:none;border:0;width:100%;">
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
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
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
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $diff->days;  ?></span>
                                        </td>
                                        
                             <td class="align-middle text-center" style="border: 1px solid #40497C;width:7%;">
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
                                                <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'densidades[]'.$value['id_piscina'];?>" name="<?php echo 'densidades[]'.$value['id_piscina'];?>" step="any"  placeholder="0.00" style="width:85px;" value ="<?php  if ($densidad == 0 || $densidad == null) {
                                                                                                        echo $densidad = 0;
                                                                                                    } else {
                                                                                                        echo  intval($densidad);
                                                                                                    } ?>">
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

                                        <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"><?php if ($peso1 == 0 || $peso1 == null) {
                                                                                                         $peso1 = 0.00;
                                                                                                    } else {
                                                                                                      //  echo  $peso1;
                                                                                                    } ?>
                             <input type="text" class="input2 form-control"  id = "<?php echo 'peso[]'.$value['id_piscina']; ?>"  name="<?php echo 'peso[]'.$value['id_piscina']; ?>" readonly value="<?php echo $peso1; ?>" readonly style="background:none;border:0;width:100%;">
                                         
                                                                                                    </span>
                                        </td>
 
                                        <td class="align-middle text-center" style="border: 1px solid #40497C;width:10%;">
                                            <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'crecimientos[]'.$value['id_piscina'];?>" name="<?php echo 'crecimientos[]'.$value['id_piscina'];?>" step="any"  placeholder="0.00" style="width:85px;">
                                            </span>
                                        </td>
                                        
                                           <td class="align-middle text-center" style="border: 1px solid #40497C" id="<?php echo 'pesofinalestd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'pesofinales[]'.$value['id_piscina'];?>" name="<?php echo 'pesofinales[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:85px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                         
                                                                                 </td>
                                        
                                      <td class="align-middle text-center" style="border: 1px solid #40497C" id = "<?php echo 'factorestd[]'.$value['id_piscina']; ?>">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'factor[]'.$value['id_piscina']; ?>">

                                    <select class="select"   id = "<?php echo 'factores[]'.$value['id_piscina']; ?>" name= "<?php echo 'factores[]'.$value['id_piscina']; ?>">
                                                     <option class="text-center"  id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="0" style"display:;">
                                                        [Seleccione]
                                                        </option>
                                                    <?php
                                       
                                              $sqli = "select * from tipos_conversion where estado = 1;";
                                          $data = $objeto->mostrar($sqli);
                                          
                                                    foreach ($data as $valuer) {                                          ?>

                                         <option class="text-center" id ="<?php echo 'factorese[]'.$value['id_piscina']; ?>" value="<?php echo $valuer['id_biotipo'] ?>">
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

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd1[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento1[]'.$value['id_piscina'];?>" name="<?php echo 'alimento1[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>

                                        <!-- cantidad dia martes -->

                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd2[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento2[]'.$value['id_piscina'];?>" name="<?php echo 'alimento2[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>


                                        <!-- cantidad dia miercoles -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd3[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento3[]'.$value['id_piscina'];?>" name="<?php echo 'alimento3[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>




                                        <!-- cantidad dia jueves -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd4[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento4[]'.$value['id_piscina'];?>" name="<?php echo 'alimento4[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>



                                        <!-- cantidad dia viernes -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd5[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento5[]'.$value['id_piscina'];?>" name="<?php echo 'alimento5[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>           


                                        <!-- cantidad dia sabado -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd6[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento6[]'.$value['id_piscina'];?>" name="<?php echo 'alimento6[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
  


                                        <!-- cantidad dia domingo    -->
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:5%" id="<?php echo 'alimentotd7[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento7[]'.$value['id_piscina'];?>" name="<?php echo 'alimento7[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>


                                        
                                           <td class="align-middle text-center" style="border: 1px solid #40497C;width:7%" id="<?php echo 'alimentotd0[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'alimento0[]'.$value['id_piscina'];?>" name="<?php echo 'alimento0[]'.$value['id_piscina'];?>" step="any"  readonly placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                         

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
                                              <input type="hidden" name="acumulado[]" value="<?php echo intval($acum_semanal); ?>" id="<?php echo 'acumulado[]'.$value['id_piscina'];?>" >
                                        </td>
                                        
                                     <td class="align-middle text-center" style="border: 1px solid #40497C;width:10%" id="<?php echo 'porcentajetd[]'.$value['id_piscina'];?>" >

                                            <span class="text-secondary text-xs font-weight-bold">
                                 <input type="number" style = "width:100%;" class=" form-control" id="<?php echo 'porcentaje[]'.$value['id_piscina'];?>" name="<?php echo 'porcentaje[]'.$value['id_piscina'];?>" value="0.00" step="any"  readonly  placeholder="" style="width:100px;" onfocus="myFunction(this)">
                                           
                                            </span>

                                         </td>
                                    <?php } ?>
                                   



                                    </tr>

                                                    
                                                
                                     <tr style=" border: solid 2px #343a40; color:white;">
                                 <td class="align-middle text-center" style="border: solid 2px #343a40; color:white;"  colspan="18">
                                   <button type="submit" class="btn btn-danger btn-sm mt-3 text-center" id="add-egres">Grabar proyeccion</button>
                                     </td>
                                     </tr>
                            </tbody>
                           
                        </table>
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
                                 
   var ajaxValue = '<?php echo $_SESSION['ajax']; ?>';
    var camaroneras = '<?php echo $_SESSION['llc']; ?>';
    var pesos =  document.getElementById('peso[]' + suffix).value;
    var pesosp =  document.getElementById('crecimientos[]' + suffix).value;
    var masa =  document.getElementById('factores[]' + suffix).value;
    var densidad =  document.getElementById('densidades[]' + suffix).value;
    var has =  document.getElementById('has[]' + suffix).value;
    var pesof = parseFloat(pesos) + parseFloat(pesosp);
     var acumulado =  document.getElementById('acumulado[]' + suffix).value;
   //    alert(acumulado);
   //   alert(pesosp);
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
  var xhr = new XMLHttpRequest();
    //  alert(masa);
                 xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
             var response = JSON.parse(xhr.responseText);
             
           //  alert(response.data);
             
                var kgha_lunes = parseFloat(response.kgha_lunes);
                var kgha_martes = parseFloat(response.kgha_martes);
                var kgha_miercoles = parseFloat(response.kgha_miercoles);
                var kgha_jueves = parseFloat(response.kgha_jueves);
                var kgha_viernes = parseFloat(response.kgha_viernes);
                var kgha_sabado = parseFloat(response.kgha_sabado);
                var kgha_domingo = parseFloat(response.kgha_domingo);
                /*alert(kgha_lunes);
                alert(kgha_martes);
                alert(kgha_miercoles);
                alert(kgha_jueves);
                alert(kgha_viernes);
                alert(kgha_sabado);
                alert(kgha_domingo);*/
            var kgha_total = kgha_lunes + kgha_martes + kgha_miercoles + kgha_jueves + kgha_viernes + kgha_sabado + kgha_domingo ;
                document.getElementById('alimentotd0[]' + suffix).querySelector('input').value = Math.round(kgha_total) ;
                    document.getElementById('alimentotd1[]' + suffix).querySelector('input').value = Math.round(kgha_lunes);
                    document.getElementById('alimentotd2[]' + suffix).querySelector('input').value = Math.round(kgha_martes) ;
                       document.getElementById('alimentotd3[]' + suffix).querySelector('input').value = Math.round(kgha_miercoles) ;
                        document.getElementById('alimentotd4[]' + suffix).querySelector('input').value = Math.round(kgha_jueves) ;
                        document.getElementById('alimentotd5[]' + suffix).querySelector('input').value = Math.round(kgha_viernes) ;
                        document.getElementById('alimentotd6[]' + suffix).querySelector('input').value = Math.round(kgha_sabado) ;
                        document.getElementById('alimentotd7[]' + suffix).querySelector('input').value = Math.round(kgha_domingo) ;
                        document.getElementById('porcentajetd[]' + suffix).querySelector('input').value = (acumulado / Math.round(kgha_total) * 100).toFixed(2);

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
    if (element) {
        element.addEventListener('change', function() {
            pesos(i.toString());
        });
                body.addEventListener('change', function() {
            masas(i.toString());
       });
    }
}}

                    </script>