<?php 

    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    $objeto = new corrida();

    if(isset( $_POST['searchPesca'])){
        $buscar = $_POST['searchPesca'];
    }else{
        $buscar = $camaronera;
    }

?>

<div class="col-lg-12 col-md-12 mt-5">
    <div class="card">
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <?php if($roles == "superadmin"){ ?>

            <li class="nav-item">
                <a href="./index.php?page=Principal&d=<?php echo $departamento; ?>" class="nav-link text-dark"
                    role="tab" aria-controls="pills-profile" aria-selected="false" style="background:white;">
                    <strong class="">Pyg
                        <?php
                            if($buscar == 1){
                                echo "Darsacom";   
                            }
                            else if ($buscar == 2){
                                echo "Aquacamaron";
                            }
                            else if ($buscar == 3){
                                echo "Jopisa" ;
                            }
                            else if ($buscar == 4){
                                echo "Aquanatura";
                            }
                        ?>
                    </strong>
                </a>
            </li>

            <li class="nav-item">
                <a href="./index.php?page=Pyg_pesca_final&d=<?php echo $departamento; ?>" class="nav-link text-white"
                    role="tab" aria-controls="pills-profile" aria-selected="false" style="background:#900C3F;">
                    <strong class="">Pyg Pesca Final
                        <?php
                            if($buscar == 1){
                                echo "Darsacom";   
                            }
                            else if ($buscar == 2){
                                echo "Aquacamaron";
                            }
                            else if ($buscar == 3){
                                echo "Jopisa" ;
                            }
                            else if ($buscar == 4){
                                echo "Aquanatura";
                            }
                        ?>
                    </strong>
                </a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a href="./index.php?page=Acumulado-modelado&d=<?php echo $departamento; ?>" class="nav-link text-dark" role="tab"
                    aria-controls="pills-profile" aria-selected="false"><strong>Reporte de Produccion</strong></a>   
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="current-month" role="tabpanel"
                aria-labelledby="pills-timeline-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div>

                            <!-- mostramos pyg para la gerencia -->
                            <?php if($roles == "superadmin"){ ?>
                                
                                <div class="d-flex bd-highlight"
                                    style="margin-left:40%; margin-top:25px; margin-botton:-15px;">
                                    <div class="bd-highlight">
                                        <form action="index.php?page=Pyg_pesca_final" method="POST">
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="searchPesca" id="camaronera"
                                                        onchange="this.form.submit()">
                                                        <option value="<?php echo 'Seleccione' ?>">
                                                            <?php echo 'Seleccione camaronera'; ?>
                                                        </option>
                                                        <?php

                                                                $objeto_tabla_camaronera = new corrida();
                                                                $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera ";
                                                                $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);?>

                                                        <?php foreach ($data as $value) { ?>
                                                        <option value="<?php echo $value['id_camaronera']; ?>">
                                                            <?php echo $value['descripcion_camaronera']; ?>
                                                        </option>

                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <div class="card-body" style="margin-top:-15px;">
                                    <div class="col-12 mt-5">
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-bordered table-sm table-hover" id="tabla">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th colspan="14" style="background: #5D6D7E;">
                                                                <h6 class="text-white mt-2"> <strong>DATOS DE
                                                                        PRODUCCION</strong> </h6>
                                                            </th>
                                                            <th colspan="7" style="background: #D0D3D4;">
                                                                <h6 class="text-dark"> <strong>COSTO DE PRODUCCION</strong>
                                                                </h6>
                                                            </th>
                                                            <th colspan="6" style="background: #5D6D7E;">
                                                                <h6 class="text-white"><strong>RENTABILIDAD</strong> </h6>
                                                            </th>
                                                        </tr>
                                                        <tr style="background: #404e67;">
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Anio</th>     
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Psc</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Anim. Semb./Ha</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Ha Pescadas</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Ciclos</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Dias de secado</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Dias de cultivo</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Dias de ciclo</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Peso Siembra</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Peso Pesca</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Gr/Dia</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Raleo/Ha</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Pesca/Ha</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">FCV</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Cto/Bal/kg</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Cto/Precria</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Cto/Indi/Ha</th>
                                                            <th class="text-dark text-center" scope="col" style="background: #f2c1a4; font-size:12px;">
                                                                Bal/por/Lbs</th>
                                                            <th class="text-dark text-center" scope="col" style="background: #f2c1a4; font-size:12px;">
                                                                Larva/por/Lbs</th>
                                                            <th class="text-dark text-center" scope="col" style="background: #f2c1a4; font-size:12px;">
                                                                Ind/por/Lbs</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Cto/Tot/Lbs</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Prec./Raleo</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Prec./Pesca</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Prec./Venta</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Renta.</th>
                                                            <th class="text-white text-center" scope="col" style="font-size:12px;">Opc.</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">

                                                        <?php

                                                                $sqlPyg = "SELECT 
                                                                            DISTINCT psc as psc, t1.id, t1.ha, t1.diasDeCultivo, t1.anim_semb, t1.pesoSiembra, t1.talla, t1.talla2, t1.dias, t1.pesoActual, t1.grDia, t1.raleo, t1.lbsHa, t1.fcv, t1.costoBalkgHa, t1.costoLarvaHa, t1.costoIndHaDia, t1.balaPorLibras, t1.larvaPorLibras,
                                                                            t1.indPorLibras, t1.totalPorLibras, t1.vantalibra, t1.librasprimeratalla, t1.costoRealDolares, t1.diferencia, t1.porcentajet, t1.librassegundatalla, t1.porcentaje2, 
                                                                            t2.id_camaronera, t2.id_piscina, t2.id_corrida, t2.peso_pesca, (SELECT t.libras_pescadas FROM registro_pesca_engorde t WHERE t.id_camaronera = t1.mysql AND t.id_piscina = t1.psc AND t.id_corrida = t1.id_corrida AND t.estado='Cosechado' ) AS pesca

                                                                            FROM pyg_piscinas t1, registro_pesca_engorde t2
                                                                            WHERE t1.mysql = '$buscar' AND t1.mysql = t2.id_camaronera AND t1.psc = t2.id_piscina AND t1.id_corrida = t2.id_corrida AND t2.estado = 'Cosechado'
                                                                            AND calculoFecha = (SELECT MAX(t.calculoFecha) FROM pyg_piscinas t WHERE t.mysql = t1.mysql AND t.psc = t1.psc AND t.id_corrida = t1.id_corrida) ";
    
                                                                $datapyg = $objeto->mostrar($sqlPyg);

                                                                $ha = 0.00;
                                                                $anim_semb = 0.00;
                                                                $peso_pesca = 0.00;
                                                                $dias = 0.00;
                                                                $pesoActual = 0.00;
                                                                $grDia = 0.00;
                                                                $raleo = 0.00;
                                                                $pesca = 0.00;
                                                                $anim_semb = 0;
                                                                $fcv = 0.00;
                                                                $costoBalkgHa = 0.00;
                                                                $costoLarvaHa = 0.00;
                                                                $costoIndHaDia = 0.00;
                                                                $balaPorLibras = 0.00;
                                                                $larvaPorLibras = 0.00;
                                                                $indPorLibras = 0.00;
                                                                $costoLarvaHa = 0.00;
                                                                $librasprimeratalla = 0.00;
                                                                $librassegundatalla = 0.00;
                                                                $totalPorLibras = 0.00;
                                                                $precioRaleo = 0.00;
                                                                $precioPesca = 0.00;
                                                                $venta = 0.00;
                                                                $rentabilidad = 0.00;
                                                                $diasDeSecado = 0.00;
                                                                $diasDeCiclo = 0.00;
                                                                $total_promedio = count($datapyg);

                                                                foreach($datapyg as $row){


                                                                    if($row['pesca'] > 0 || $row['pesca'] == NULL || $row['pesca'] == ''){
                                                                    $camaronera=$buscar;   
                                                                    $p=$row['psc'];
                                                                    $promedio=$row['promedio'];
                                                                    $peso_pesca = $row['peso_pesca'];
                                                                    
                                                                    
                                                                    $psc=str_replace(',', '.', $row['psc']);
                                                                    $ha=str_replace(',', '.', $row['ha']);
                                                                    
                                                                    //$numberAnim=;
                                                                    $anim_semb= intval($row['anim_semb']/$ha);
                                                                    // $anim_semb = intval(str_replace('.', '', $number_anim_semb));
                                                                    
                                                                    $pesoSiembra=str_replace(',', '.', $row['pesoSiembra']);
                                                                    $dias=str_replace(',', '.', $row['dias']);
                                                                    $diasDeCiclo = str_replace(',', '.',$row['diasDeCultivo']);
                                                                    $pesoActual=str_replace(',', '.', $row['pesoActual']);
                                                                    $grDia=str_replace(',', '.', $row['grDia']);
                                                                    
                                                                    $numberRaleo=$row['raleo'];
                                                                    $number_raleo= str_replace('.', '', $numberRaleo);
                                                                    $raleo = str_replace('.', '', $number_raleo);
                                                                    
                                                                    $lbsHa=str_replace('.', '', $row['lbsHa']);
                                                                    $fcv=str_replace(',', '.', $row['fcv']);
                                                                    $costoBalkgHa=str_replace(',', '.', $row['costoBalkgHa']);
                                                                    $costoLarvaHa=str_replace(',', '.', $row['costoLarvaHa']);
                                                                    $costoIndHaDia=str_replace(',', '.', $row['costoIndHaDia']);
                                                                    $balaPorLibras=str_replace(',', '.', $row['balaPorLibras']);
                                                                    $larvaPorLibras=str_replace(',', '.', $row['larvaPorLibras']);
                                                                    $indPorLibras=str_replace(',', '.', $row['indPorLibras']);
                                                                    $costoLarvaHa=str_replace(',', '.', $row['costoLarvaHa']);
                                                                    $librasprimeratalla=str_replace('.', '', $row['librasprimeratalla']);
                                                                    $librassegundatalla=str_replace('.', '', $row['librassegundatalla']);
                                                                    $totalPorLibras=str_replace(',', '.', $row['totalPorLibras']);
                                                                    $librasprimeratalla=str_replace(',', '.', $librasprimeratalla);
                                                                    $librassegundatalla=str_replace(',', '.', $librassegundatalla);
                                                                    
                                                                    $corrida=$row['id_corrida'];
                                                                    $id=$row['id'];
                                                                    $pesca=str_replace(',', '.', $row['pesca']);

                                                                    $Talla=$row['talla'];
                                                                    $Talla2=$row['talla2'];

                                                                    $promedio_ha += floatval($ha);
                                                                    $promedio_anim_semb += floatval($anim_semb);
                                                                    $promedio_pesoSiembra += floatval($pesoSiembra);
                                                                    $promedio_dias += floatval($dias);
                                                                    $promedio_pesoPesca += floatval($peso_pesca);
                                                                    $promedio_grDia += floatval($grDia);
                                                                    $promedio_raleo += floatval($raleo);

                                                                    $promedio_pesca += floatval($pesca);

                                                                    //$promedio_raleo += floatval($raleo);
                                                                    $promedio_fcv += floatval($fcv);
                                                                    $promedio_costoBalkgHa += floatval($costoBalkgHa);
                                                                    $promedio_costoLarvaHa += floatval($costoLarvaHa);
                                                                    $promedio_costoIndHaDia += floatval($costoIndHaDia);
                                                                    $promedio_balaPorLibras += floatval($balaPorLibras);
                                                                    $promedio_larvaPorLibras += floatval($larvaPorLibras);
                                                                    $promedio_indPorLibras += floatval($indPorLibras);

                                                                    
                                                                    $promedio_totalPorLibras += floatval($totalPorLibras);
                                                                    $promedio_diasDeCiclo += $diasDeCiclo;


                                                                    $sqlTalla="SELECT talla, precio_referencia, fecha_registro FROM `precio_talla_camaron` where  talla = '$Talla' and fecha_registro = (SELECT MAX(fecha_registro) as fecha_registro FROM precio_talla_camaron )";
                                                                    $datatalla = $objeto->mostrar($sqlTalla);
                                                                    foreach($datatalla as $r){
                                                                        $precio_referencia_uno = strval($r['precio_referencia']);
                                                                    }

                                                                    $sqlTallaDos="SELECT talla, precio_referencia, fecha_registro FROM `precio_talla_camaron` where  talla = '$Talla2' and fecha_registro = (SELECT MAX(fecha_registro) as fecha_registro FROM precio_talla_camaron )";
                                                                    $datatallaDos = $objeto->mostrar($sqlTallaDos);
                                                                    foreach($datatallaDos as $r_dos){
                                                                        $precio_referencia_dos = strval($r_dos['precio_referencia']);
                                                                    }

                                                                    $librasKilosPrimero = $precio_referencia_uno*$librasprimeratalla;
                                                                    $librasKilosSegundo = $precio_referencia_dos*$librassegundatalla;

                                                                    if($buscar == 1){ $haCamaronera = 84.60; }else if( $buscar == 2 ){ $haCamaronera = 124.38; }else if( $buscar == 3){ $haCamaronera = 64.49; }else if( $buscar == 4){ $haCamaronera = 108.25;}
                                                                    
                                                        ?>

                                                        <tr>
                                                            <!-- ************************** datos de produccion ************************** -->

                                                            <td><strong><?php echo intval('2023');  ?></strong></td>

                                                            <td><strong><?php echo intval($psc);  ?></strong></td>

                                                            <td><strong><?php echo $anim_semb; ?></strong></td>

                                                            <td><strong><?php echo $ha; ?></strong></td>

                                                            <td>
                                                                <strong>
                                                                <?php 
                                                                     

                                                                    $sql="SELECT SUM(hectareas) AS hectareas FROM registro_pesca_engorde WHERE id_camaronera = '$buscar' AND id_piscina = '$psc' AND id_corrida = '$corrida'";
                                                                    $dataHa = $objeto->mostrar($sql);

                                                                    foreach($dataHa as $k){
                                                                        $hectareas = $k['hectareas'];
                                                                    }

                                                                    $sumaHa=0.00; 
                                                                    echo $sumaHa += $ha/$ha;  
                                                                ?>
                                                                </strong>
                                                            </td>

                                                            <td><strong><?php echo $diasDeSecado = intval($diasDeCiclo-$dias);  $promedio_diasDeSecado += $diasDeSecado;?></strong></td>

                                                            <td><strong><?php echo intval($dias); ?></strong></td>

                                                            <td><strong><?php echo intval($diasDeCiclo); ?></strong></td>

                                                            <td><strong><?php echo $pesoSiembra; ?></strong></td>

                                                            <td style="color:#2980B9;">
                                                                <strong><?php echo $peso_pesca; ?></strong>
                                                            </td>

                                                            <td><strong><?php echo $grDia; ?></strong></td>

                                                            <td><strong><?php echo $raleo; ?></strong></td>

                                                            <td><strong><?php echo $pesca; ?></strong></td>

                                                            <td>
                                                                <strong>
                                                                    <?php  

                                                                        if($fcv >= 1.40){
                                                                            echo '<span style="color: red;">'.$fcv.'</span>'; 
                                                                        }else{
                                                                            echo '<span style="color: #28B463;">'.$fcv.'</span>'; 
                                                                        }
                                                                    ?>
                                                                </strong>
                                                            </td>

                                                            <!-- ************************** costos de produccion ************************** -->

                                                            <td><strong><?php echo $costoBalkgHa; ?></strong></td>

                                                            <td><strong><?php echo $costoLarvaHa; ?></strong></td>

                                                            <td><strong><?php echo $costoIndHaDia; ?></strong></td>

                                                            <td><strong><?php echo $balaPorLibras; ?></strong></td>

                                                            <td><strong><?php echo $larvaPorLibras; ?></strong></td>

                                                            <td><strong><?php echo $indPorLibras;   ?></strong></td>

                                                            <td><strong><?php echo $totalPorLibras; ?></strong></td>

                                                            <?php 

                                                                $sqlPrecio="SELECT COUNT(*) as total FROM precio_venta_pesca WHERE id_camaronera = '$camaronera' AND id_piscina = '$psc' AND id_corrida = '$corrida'";
                                                                $result = $conexion->query($sqlPrecio);
                                                                $row = $result->fetch_assoc();
                                                                $totalFilas = $row['total'];

                                                                $sqlPrecio="SELECT precio_raleo, precio_pesca FROM precio_venta_pesca WHERE id_camaronera = '$camaronera' AND id_piscina = '$psc' AND id_corrida = '$corrida'";
                                                                $dataPrecio = $objeto->mostrar($sqlPrecio);
                                                                foreach($dataPrecio as $p){
                                                                    $precioRaleo=$p['precio_raleo'];
                                                                    $precioPesca=$p['precio_pesca'];
                                                                }

                                                                if($totalFilas <= 0){
                                                                    $precioRaleo = 0.00;
                                                                    $precioPesca = 0.00;
                                                                }else{
                                                                    $precioRaleo;
                                                                    $precioPesca;
                                                                }

                                                                $promedio_precioRaleo += floatval($precioRaleo);
                                                                $promedio_precioPesca += floatval($precioPesca);
                                                                

                                                            ?>

                                                            <td><strong><?php echo $precioRaleo; ?></strong></td>

                                                            <td><strong><?php echo $precioPesca; ?></strong></td>

                                                            <td>
                                                                <strong>
                                                                    <?php  
                                                                        
                                                                        $ventaRaleo=($precioRaleo * $raleo)*$ha;
                                                                        $ventaPesca=($precioPesca * $pesca)*$ha;
                                                                        $totalVentaRaleoPesca = $ventaRaleo+$ventaPesca;

                                                                    /*-------------------------------------------------------*/

                                                                        $librasTotalRaleo = $raleo*$ha;
                                                                        $librasTotalPesca = $pesca*$ha;
                                                                        $totalLibrasCosechadas = $librasTotalRaleo+$librasTotalPesca;

                                                                    /*-------------------------------------------------------*/

                                                                        echo $venta = number_format($totalVentaRaleoPesca/$totalLibrasCosechadas,2);
                                                                        $promedio_venta += floatval($venta);

                                                                    ?>
                                                                </strong>
                                                            </td>

                                                            <td class="text-primary">
                                                                <strong>
                                                                    <?php 
                                                                        echo $rentabilidad = $totalPorLibras - $venta;  
                                                                        $promedio_rentabilidad += floatval($rentabilidad);  
                                                                    ?>
                                                                </strong>
                                                            </td>

                                                            <td>
                                                                <a title="Grabar datos" data-toggle="modal" data-toggle="modal" data-target=".bd-example-modal-lg<?php echo $id; ?>"><i class="fas fa-edit text-danger"></i></a>
                                                                <?php include 'modal-vista-precio-venta.php'; ?>
                                                            </td>

                                                        </tr>

                                                        <?php

                                                            } } 
                                                        

                                                            /* promedios */
                                                                $promedio_ha = $promedio_ha;
                                                                $promedio_anim_semb = $promedio_anim_semb / $total_promedio;
                                                                $promedio_pesoSiembra = $promedio_pesoSiembra / $total_promedio;
                                                                $promedio_dias = $promedio_dias / $total_promedio;
                                                                $promedio_pesoPesca = $promedio_pesoPesca / $total_promedio;
                                                                $promedio_grDia = $promedio_grDia / $total_promedio;
                                                                $promedio_raleo = $promedio_raleo / $total_promedio;
                                                                $promedio_pesca = $promedio_pesca / $total_promedio;
                                                                $promedio_fcv = $promedio_fcv / $total_promedio;
                                                                $promedio_costoBalkgHa = $promedio_costoBalkgHa / $total_promedio;
                                                                $promedio_costoLarvaHa = $promedio_costoLarvaHa / $total_promedio;
                                                                $promedio_costoIndHaDia = $promedio_costoIndHaDia / $total_promedio;
                                                                $promedio_balaPorLibras = $promedio_balaPorLibras / $total_promedio;
                                                                $promedio_larvaPorLibras = $promedio_larvaPorLibras / $total_promedio;
                                                                $promedio_indPorLibras = $promedio_indPorLibras / $total_promedio;
                                                                $promedio_precioRaleo = $promedio_precioRaleo / $total_promedio;
                                                                $promedio_precioPesca = $promedio_precioPesca / $total_promedio;
                                                                $promedio_totalPorLibras = $promedio_totalPorLibras / $total_promedio;
                                                                $promedio_venta = $promedio_venta / $total_promedio;
                                                                $promedio_rentabilidad = $promedio_rentabilidad / $total_promedio;
                                                                $promedio_diasDeSecado = $promedio_diasDeSecado / $total_promedio;
                                                                $promedio_diasDeCiclo = $promedio_diasDeCiclo / $total_promedio;


                                                            /* promedios */
                                                        
                                                        ?>
                                                    </tbody>
                                                    <th class="text-white mt-5 text-center" scope="col" colspan="2" style="background: #404e67; font-size:12px;">
                                                        Promedio
                                                    </th>

                                                    <div class="container">
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php 

                                                                    $promedio_anim_semb;
                                                                    echo $promedio_anim_semb= number_format(str_replace(',', '.', $promedio_anim_semb),0);
                                                                ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_ha,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_ha/$haCamaronera,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_diasDeSecado,0); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                            <?php echo number_format($promedio_dias,0); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_diasDeCiclo,0); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_pesoSiembra,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_pesoPesca,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_grDia,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_raleo,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_pesca,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_fcv,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_costoBalkgHa,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_costoLarvaHa,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_costoIndHaDia,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_balaPorLibras,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_larvaPorLibras,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_indPorLibras,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_totalPorLibras,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_precioRaleo,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_precioPesca,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_venta,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_rentabilidad,2); ?>
                                                            </strong>
                                                        </td>
                                                    </div>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                 

                            <?php }else{ ?>
                            <!-- mostramos power bi solo para la camaronera y no para la gerencia -->

                                <div class="container">
                                    <?php

                                        $ps = $_GET['ps'];
                                        $d= $_GET['d'];

                                        if($d == 'Gerencia' || $d == 'sistemas' || $d == 'Contabilidad'){
                            
                                            #echo '<iframe title="Version_final_general" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection7634d793dcdcc9d35d4d" frameborder="0" allowFullScreen="true"></iframe>';
                                                echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                                        }else if($d == 'Biologo general'){
                
                
                                            echo '<iframe title="Simulacion_Biologo_Supervisor" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNzc1NWRkOWMtMDVlYy00YTRjLTkzM2YtZDI4M2MzYjkyZGE0IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                
                                        }else{
                                                                
                                            if ($camaronera == 1) {
                                                
                                                echo '<iframe title="Simulacion_Darsacom - Menu" class="iframe" 3.5" src="https://app.powerbi.com/view?r=eyJrIjoiMzEzYzNhZmMtMjY5ZC00ZjZmLTkxMDgtZmViNDhjMTlkOGFjIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                
                                            } else if ($camaronera == 2) {
                                                
                                                echo '<iframe title="Simulacion_Aquacamaron - Menu" class="iframe"= src="https://app.powerbi.com/view?r=eyJrIjoiNjBhMGFlOTEtY2IyNy00ZWM2LWI1ZGUtMmRhMmFiNTYwNzgyIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                
                                            } else if ($camaronera == 3) {
                                                
                                                echo '<iframe title="Simulacion_Jopisa" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiODcwN2Y5M2QtMzNjMC00MzU1LWE4YmUtOWJhYzNiMjUxMWI5IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection7634d793dcdcc9d35d4d" frameborder="0" allowFullScreen="true"></iframe>';
                
                                            } else if($camaronera == 4) {
                                                
                                                echo '<iframe title="Simulacion_Aquanatura" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiMGFlMTBlMGItMzU0Yi00MWZjLWEyMTktZTUxNTczOTgyODE2IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection7634d793dcdcc9d35d4d" frameborder="0" allowFullScreen="true"></iframe>';
                
                                            }else{
                
                                                echo 'Error en el servidor :(';
                                            }
                                        }

                                    ?>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

               


<script>
     var tabla = document.querySelector("#tabla");
     var datatabla = new DataTable(tabla);
</script>

