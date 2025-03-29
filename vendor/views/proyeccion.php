<div style="display:none;">
    <thead id="headDavid">
        <tr class="text-center">
        <th colspan="10" style="background: #5D6D7E;">
        <h6 class="text-white mt-2"> <strong>DATOS DE
        PRODUCCION</strong> </h6>
        </th>
        <th colspan="6" style="background: #D0D3D4;">
        <h6 class="text-dark"> <strong>COSTO DE PRODUCCION</strong>
        </h6>
        </th>
        <th colspan="4" style="background: #5D6D7E;">
        <h6 class="text-white"><strong>RENTABILIDAD</strong></h6>
        </th>
        </tr>
        <tr style="background: #404e67;">
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Psc</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Ha</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Anim. Semb./Ha</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Peso Siemb.</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Dias</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Peso Act</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Gr/Dia</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Raleo/Ha</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Lbs/Ha</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>FCV</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Cto/Bal/kg</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Cto/Precria</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><strong>Cto/Indi/Ha</strong></th>
        <th class="text-dark text-center" scope="col" style="background: #f2c1a4; font-size:12px;"><strong>Bal/por/Lbs</strong></th>
        <th class="text-dark text-center" scope="col" style="background: #f2c1a4; font-size:12px;"><strong>Larva/por/Lbs</strong></th>
        <th class="text-dark text-center" scope="col" style="background: #f2c1a4; font-size:12px;"><strong>Ind/por/Lbs</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><trong>Cto./Tot/Lbs</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><trong>Vta/Por/Lbs</strong></th>
        <th class="text-white text-center" scope="col" style="font-size:12px;"><trong>Rent.</strong></th>
        </tr>
    </thead>

    <tbody id="bodyDavid" class="text-center">

        <?php


        $sqlPyg = "SELECT DISTINCT psc AS psc, ha, anim_semb, pesoSiembra, talla, talla2, dias, pesoActual, grDia, raleo, lbsHa, fcv, costoBalkgHa, costoLarvaHa, costoIndHaDia, balaPorLibras, larvaPorLibras, indPorLibras, totalPorLibras, vantalibra, librasprimeratalla, costoRealDolares, diferencia, porcentajet, librassegundatalla, porcentaje2 FROM pyg_piscinas
        WHERE mysql = '$buscar' AND proyeccion = '$proyeccion' AND calculoFecha = (
        SELECT MAX(calculoFecha) FROM pyg_piscinas
        WHERE mysql='$buscar' AND proyeccion = '$proyeccion')  ORDER BY psc";
        $datapyg = $objeto->mostrar($sqlPyg);
        $ha = 0.00;
        $anim_semb = 0.00;
        $pesoSiembra = 0.00;
        $dias = 0.00;
        $pesoActual = 0.00;
        $grDia = 0.00;
        $raleo = 0.00;
        $lbsHa = 0.00;
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
        $librasprimeratalla = 0.00;
        $librassegundatalla = 0.00;
        $venta = 0.00;
        $rentabilidad = 0.00;
        $total_promedio = count($datapyg);

        foreach($datapyg as $row){

        $p=$row['psc'];
        $promedio=$row['promedio'];

        $psc=str_replace(',', '.', $row['psc']);
        $ha=str_replace(',', '.', $row['ha']);

        $anim_semb=intval($row['anim_semb']/$ha);
        //$anim_semb= str_replace('.', '', $numberAnim);
        // $anim_semb = intval(str_replace('.', '', $number_anim_semb));

        $pesoSiembra=str_replace(',', '.', $row['pesoSiembra']);
        $dias=str_replace(',', '.', $row['dias']);
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

        $Talla=$row['talla'];
        $Talla2=$row['talla2'];

        $promedio_ha += floatval($ha);
        $promedio_anim_semb += intval($anim_semb);
        $promedio_pesoSiembra += floatval($pesoSiembra);
        $promedio_dias += floatval($dias);
        $promedio_pesoActual += floatval($pesoActual);
        $promedio_grDia += floatval($grDia);
        $promedio_raleo += floatval($raleo);
        $promedio_lbsHa += floatval($lbsHa);
        $promedio_fcv += floatval($fcv);
        $promedio_costoBalkgHa += floatval($costoBalkgHa);
        $promedio_costoLarvaHa += floatval($costoLarvaHa);
        $promedio_costoIndHaDia += floatval($costoIndHaDia);
        $promedio_balaPorLibras += floatval($balaPorLibras);
        $promedio_larvaPorLibras += floatval($larvaPorLibras);
        $promedio_indPorLibras += floatval($indPorLibras);
        $promedio_librasprimeratalla += floatval($librasprimeratalla);
        $promedio_librassegundatalla += floatval($librassegundatalla);
        $promedio_totalPorLibras += floatval($totalPorLibras);
        $promedio_venta += floatval($venta);




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



        ?>

        <tr>
            <!-- ********* datos de produccion ********* -->

            <td><strong><?php echo intval($psc);  ?></strong>
            </td>

            <td><strong><?php echo $ha; ?></strong></td>

            <td><strong><?php echo $anim_semb; ?></strong></td>

            <td><strong><?php echo $pesoSiembra; ?></strong></td>

            <td><strong><?php echo intval($dias); ?></strong></td>

            <td style="color:#2980B9;">
            <strong><?php echo $pesoActual; ?></strong></td>

            <td><strong><?php echo $grDia; ?></strong></td>

            <td><strong><?php echo $raleo; ?></strong></td>

            <td><strong><?php echo $lbsHa; ?></strong></td>

            <td>
            <strong>
            <?php  

            if($fcv >= 1.40){
            echo '<span style="color: red;">'.$fcv.'</span>'; 
            }else{
            echo '<span style="color: #28B463;">'.$fcv.'</span>'; }
            ?>
            </strong>
            </td>

            <!-- ********* costos de produccion ********* -->

            <td><strong><?php echo $costoBalkgHa; ?></strong></td>

            <td><strong><?php echo $costoLarvaHa; ?></strong></td>

            <td><strong><?php echo $costoIndHaDia; ?></strong></td>

            <td><strong><?php echo $balaPorLibras; ?></strong></td>

            <td><strong><?php echo $larvaPorLibras; ?></strong></td>

            <td><strong><?php echo $indPorLibras;   ?></strong></td>

            <td><strong><?php echo $totalPorLibras; ?></strong></td>

            <td>
            <strong>
            <?php echo $venta = number_format((($librasKilosPrimero + $librasKilosSegundo)/$lbsHa)/2.2046,2);?>
            </strong>
            </td>

            <td>
            <strong>
            <?php  

            $rentabilidad = number_format($venta - $totalPorLibras,2);
            $promedio_rentabilidad += floatval($rentabilidad);

            if((number_format($venta - $totalPorLibras,2)) < 0.0){
            echo '<span style="color: red;">'. number_format($venta - $totalPorLibras,2) .'</span>'; 
            }else{
            echo '<span style="color: #28B463;">'. number_format($venta - $totalPorLibras,2).'</span>'; 
            }
            ?>
            </strong>
            </td>

        </tr>


        <?php } ?>


    </tbody>
</div>