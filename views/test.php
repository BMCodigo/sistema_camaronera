<?php 
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
?>
<div class="card">

    <div class="d-flex flex-row bd-highlight ">
        <div class="p-2 bd-highlight">
            <a href="index.php?page=insumostrazabilidad" class="text-white text-decoration-none"><li class="list-group-item  text-white text-center" style="background: #404e67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">Presupuesto general camaronera</li></a>
        </div>
        <div class="p-2 bd-highlight">
            <a href="index.php?page=detalle_piscina_insumos" class="text-white text-decoration-none"><li class="list-group-item  text-white text-center" style="background: #404e67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">Aplicación de insumos general</li></a>
        </div>

        <div class="p-2 bd-highlight">
            <?php
                // Consulta para obtener todas las piscinas en proceso
                $sqlPiscinas = "SELECT DISTINCT id_piscina, hectareas FROM registro_piscina_engorde WHERE estado = 'En proceso' AND id_camaronera = '$camaronera' ORDER BY id_piscina ASC LIMIT 1;";
                $piscinasData = $conectar->mostrar($sqlPiscinas);

            ?>
            <a href="index.php?page=detalle_piscina.php&piscina=<?php echo $piscinasData[0]['id_piscina']; ?>&ha=<?php echo $piscinasData[0]['hectareas']; ?>" class="text-white text-decoration-none">
            <li class="list-group-item text-white text-center" style="background: #404e67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">
            Detalle por piscina </li></a>
        </div>
    </div>



    <div class="container d-flex justify-content-center align-items-center vh-100 mt-4">
        <h5>Presupuesto valorizado general camaronera</h5>
    </div>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <hr style="width: 900px; background:#404e67;">
    </div>

    <div class="row">

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

<div class="card-body">

    <table class="table table-hover table-sm" style="margin-top:-20px;">

        <thead style="background: #404e67;">

            <tr>
                <th scope="col" class="text-white text-center" style="  cursor:pointer;">Presupuesto (Dolares)</th>
                <th scope="col" class="text-white text-center" style="cursor:pointer;">-</th>
                <th scope="col" class="text-white text-center" style="cursor:pointer;">-</th>
                <th scope="col" class="text-white text-center" style="cursor:pointer;">-</th>
                <th scope="col" class="text-white text-center" style="cursor:pointer;"> Total ejecucion (Dolares)</th>

            </tr>

        </thead>



        <tbody>

        <?php
                
                $descripcion = $data[0]['descripcion'];
                $idNormalizado =  $descripcion;

                $sqlFamilias = "SELECT * FROM familiascuentacontable WHERE id_camaronera = '$camaronera'";
                $dataFamilias = $conectar->mostrar($sqlFamilias);

                foreach($dataFamilias as $f){
                    echo $familia = $f['familia'];

                    if($familia == 'reguladores_no_inv'){
                        $familia  = 'reguladores no inventario';
                    }else if($familia == 'otras_materias_primas'){
                        $familia = 'otras materias primas';
                    }else if($familia == 'otras_materias_primas_no_inv'){
                        $familia = 'Otras materias primas no inventario';
                    }
                

                

                
                    
        ?>

            <tr>       
                <th class="text-justyfi text-dark bg-white"><strong><?php echo $familia; ?></strong></th>
           
            </tr>


     

        </tbody>

    <?php } ?>
    </table>

</div>

</div> 

        <div class="container col-9 mt-1">
            <div class="accordion " id="accordionExample">
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead style="background: #404e67;">

                            <?php 

                                if($camaronera == 1){
                                    $empresaId = 115;
                                }else if($camaronera == 2){
                                    $empresaId = 117;
                                }else if($camaronera == 3){
                                    $empresaId = 118;
                                }

                                $sqlPresupuesto = "SELECT p.*, p.id_camaronera AS empresaId,
                                pa.*,
                                CASE 
                                WHEN p.id_camaronera = 115 THEN 
                                    CASE 
                                       
                                    WHEN p.codigoCuenta = 34 THEN 'balanceado'
                                        WHEN p.codigoCuenta = 35 THEN 'larva'
                                        WHEN p.codigoCuenta = 37 THEN 'reguladores'
                                        WHEN p.codigoCuenta = 36 THEN 'fertilizantes'
                                        WHEN p.codigoCuenta = 38 THEN 'otras_materias'
                                        WHEN p.codigoCuenta = 1743 THEN 'bacterias'
                                        WHEN p.codigoCuenta = 1745 THEN 'peroxido'
                                        WHEN p.codigoCuenta = 1744 THEN 'desparasitantes'
                                        WHEN p.codigoCuenta = 1746 THEN 'ntibioticos'
                                    END
                                WHEN p.id_camaronera = 117 THEN 
                                    CASE 
                                    WHEN p.codigoCuenta = 648 THEN 'balanceado'
                                        WHEN p.codigoCuenta = 1106 THEN 'larva'
                                        WHEN p.codigoCuenta = 1036 THEN 'reguladores'
                                        WHEN p.codigoCuenta = 1329 THEN 'fertilizantes'
                                        WHEN p.codigoCuenta = 1331 THEN 'otras_materias'
                                        WHEN p.codigoCuenta = 1330 THEN 'bacterias'
                                        WHEN p.codigoCuenta = 1332 THEN 'peroxido'
                                        WHEN p.codigoCuenta = 1333 THEN 'desparasitantes'
                                        WHEN p.codigoCuenta = 1334 THEN 'antibioticos'
                                    END
                                WHEN p.id_camaronera = 118 THEN 
                                    CASE 
                                    WHEN p.codigoCuenta = 410 THEN 'balanceado'
                                        WHEN p.codigoCuenta = 1229 THEN 'larva'
                                        WHEN p.codigoCuenta = 1169 THEN 'reguladores'
                                        WHEN p.codigoCuenta = 36 THEN 'fertilizantes'
                                        WHEN p.codigoCuenta = 38 THEN 'otras_materias'
                                        WHEN p.codigoCuenta = 1743 THEN 'bacterias'
                                        WHEN p.codigoCuenta = 1745 THEN 'peroxido'
                                        WHEN p.codigoCuenta = 1744 THEN 'desparasitantes'
                                        WHEN p.codigoCuenta = 1746 THEN 'antibioticos'
                                    END
                                ELSE 'Otro Tipo'
                                END AS descripcion
                                FROM presupuestos p
                                INNER JOIN (
                                    SELECT id_camaronera, codigoCuenta, MAX(id) AS max_id
                                    FROM presupuestos
                                    GROUP BY id_camaronera, codigoCuenta
                                ) AS latest
                                ON p.id = latest.max_id
                                AND p.id_camaronera IN ($empresaId)
                                LEFT JOIN presupuestos_aporbados pa
                                ON p.id_camaronera = pa.empresa_id
                                AND pa.fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM presupuestos_aporbados WHERE id_camaronera = '$camaronera')
                                ORDER BY p.id_camaronera, p.codigoCuenta, p.fecha, p.asiento";

                                $data = $conectar->mostrar($sqlPresupuesto);


                                                                    
                                $totalPresupuesto = 0;
                                $totalEjecucionCamaronera = 0;
                                $totalEjecucion = 0;

                                foreach($data as $p):
                                    $presupuesto = 0;
                                    /* cuenta Darsacom */
                                    if ($p['codigoCuenta'] == 36) $presupuesto = $p['fertilizantes'];
                                    if ($p['codigoCuenta'] == 37) $presupuesto = $p['reguladores'];
                                    if ($p['codigoCuenta'] == 38) $presupuesto = $p['otras_materias'];
                                    if ($p['codigoCuenta'] == 1743) $presupuesto = $p['bacterias'];
                                    if ($p['codigoCuenta'] == 1745) $presupuesto = $p['peroxido'];
                                    if ($p['codigoCuenta'] == 1744) $presupuesto = $p['desparasitantes'];
                                    if ($p['codigoCuenta'] == 1746) $presupuesto = $p['antibioticos'];
                                    
                                    /* cuenta aquacamaron */
                                    if ($p['codigoCuenta'] == 1329) $presupuesto = $p['fertilizantes'];
                                    if ($p['codigoCuenta'] == 1036) $presupuesto = $p['reguladores'];
                                    if ($p['codigoCuenta'] == 1331) $presupuesto = $p['otras_materias'];
                                    if ($p['codigoCuenta'] == 1330) $presupuesto = $p['bacterias'];
                                    if ($p['codigoCuenta'] == 1332) $presupuesto = $p['peroxido'];
                                    if ($p['codigoCuenta'] == 1333) $presupuesto = $p['desparasitantes'];
                                    if ($p['codigoCuenta'] == 1334) $presupuesto = $p['antibioticos'];

                                    /* cuenta jopisa */
                                    if ($p['codigoCuenta'] == 36) $presupuesto = $p['fertilizantes'];
                                    if ($p['codigoCuenta'] == 1169) $presupuesto = $p['reguladores'];
                                    if ($p['codigoCuenta'] == 38) $presupuesto = $p['otras_materias'];
                                    if ($p['codigoCuenta'] == 1743) $presupuesto = $p['bacterias'];
                                    if ($p['codigoCuenta'] == 1745) $presupuesto = $p['peroxido'];
                                    if ($p['codigoCuenta'] == 1744) $presupuesto = $p['desparasitantes'];
                                    if ($p['codigoCuenta'] == 1746) $presupuesto = $p['antibioticos'];

                                    $totalPresupuesto += $presupuesto;

                                    $totalEjecucion += $p['saldo'];


                                    $id_camaronera = $p['empresaId'];
                                    $descripcion = $p['descripcion'];

                                   

                                    $sqlEjecutadoCamaronera = "SELECT SUM(total) AS total_ejecutado_camaronera FROM `costos_camaronera` WHERE nombre_camaronera = '$id_camaronera' AND familia = '$descripcion'";
                                    $dataEjecucionCamaronera = $conectar->mostrar($sqlEjecutadoCamaronera);

                                    foreach($dataEjecucionCamaronera as $cm){
                                        $totalEjecucionCamaronera += $cm['total_ejecutado_camaronera'];
                                    }
                                    
                                    endforeach ?>
                                                                    
                                
                                <tr>
                                    <th scope="col" class="text-white text-center"
                                        style=" border-right: 3px solid white;">Materia prima</th>
                                        <td class="text-center text-white">
                                        <span><?php echo number_format($totalPresupuesto,2); ?> </span>
                                    </td>
                                    <td class="text-center text-white">
                                        <span><?php echo number_format($totalEjecucionCamaronera,2); ?> </span>
                                    </td>



                                    <td class="text-center text-white" style=" border-right: 3px solid white;">
                                        <?php

                                    echo ($totalPresupuesto > 0) ? round(($totalEjecucionCamaronera / $totalPresupuesto) * 100, 2) . ' %' : '0 %'; ?>
                                    </td>

                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $data = $conectar->mostrar($sqlPresupuesto);


                                
                                $totalPresupuesto = 0;
                                $totalEjecucionCamaronera = 0;
                                $totalEjecucion = 0;
                                
                                foreach($data as $p):
                                    $presupuesto = 0;
                                   
                                    /* cuenta Darsacom */
                                    if ($p['codigoCuenta'] == 36) $presupuesto = $p['fertilizantes'];
                                    if ($p['codigoCuenta'] == 37) $presupuesto = $p['reguladores'];
                                    if ($p['codigoCuenta'] == 38) $presupuesto = $p['otras_materias'];
                                    if ($p['codigoCuenta'] == 1743) $presupuesto = $p['bacterias'];
                                    if ($p['codigoCuenta'] == 1745) $presupuesto = $p['peroxido'];
                                    if ($p['codigoCuenta'] == 1744) $presupuesto = $p['desparasitantes'];
                                    if ($p['codigoCuenta'] == 1746) $presupuesto = $p['antibioticos'];
                                    
                                    /* cuenta aquacamaron */
                                    if ($p['codigoCuenta'] == 1329) $presupuesto = $p['fertilizantes'];
                                    if ($p['codigoCuenta'] == 1036) $presupuesto = $p['reguladores'];
                                    if ($p['codigoCuenta'] == 1331) $presupuesto = $p['otras_materias'];
                                    if ($p['codigoCuenta'] == 1330) $presupuesto = $p['bacterias'];
                                    if ($p['codigoCuenta'] == 1332) $presupuesto = $p['peroxido'];
                                    if ($p['codigoCuenta'] == 1333) $presupuesto = $p['desparasitantes'];
                                    if ($p['codigoCuenta'] == 1334) $presupuesto = $p['antibioticos'];

                                    /* cuenta jopisa */
                                    if ($p['codigoCuenta'] == 36) $presupuesto = $p['fertilizantes'];
                                    if ($p['codigoCuenta'] == 1169) $presupuesto = $p['reguladores'];
                                    if ($p['codigoCuenta'] == 38) $presupuesto = $p['otras_materias'];
                                    if ($p['codigoCuenta'] == 1743) $presupuesto = $p['bacterias'];
                                    if ($p['codigoCuenta'] == 1745) $presupuesto = $p['peroxido'];
                                    if ($p['codigoCuenta'] == 1744) $presupuesto = $p['desparasitantes'];
                                    if ($p['codigoCuenta'] == 1746) $presupuesto = $p['antibioticos'];
                                    
                                    $totalPresupuesto += $presupuesto;
                                    $totalEjecucion += $p['saldo'];


                                    $id_camaronera = $p['empresaId'];
                                    $descripcion = $p['descripcion'];

                                  

                                    $sqlEjecutadoCamaronera = "SELECT SUM(total) AS total_ejecutado_camaronera FROM `costos_camaronera` WHERE nombre_camaronera = '$id_camaronera' AND familia = '$descripcion'";
                                    $dataEjecucionCamaronera = $conectar->mostrar($sqlEjecutadoCamaronera);

                                    foreach($dataEjecucionCamaronera as $cm){
                                        $totalEjecucionCamaronera += $cm['total_ejecutado_camaronera'];
                            ?>
                                <tr>
                                    
                                    <td style="width:130px; border-right: 3px solid #404e67; padding: 5px;">
                                        <?php echo $p['descripcion']; ?> </td>
                                    <td class="text-center" style="width:80px;">
                                    <form action="../controllers/insert-presupuesto-camaronera.php" method="post">
                                        <!--span><?php echo number_format($presupuesto,2).'--'; ?> </span-->
                                        <input type="text" class="form-control text-center" name="presupuesto[]" id="presupuesto" value="<?php echo floatval($presupuesto); ?>" style="border:none;">
                                        <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                                        <input type="hidden" name="descripcion[]" value="<?php echo $descripcion; ?>">
                                        <input type="hidden" name="encargado" value="<?php echo $user; ?>">
                                        <input type="hidden" name="fecha_registro" value="<?php $fecha_hora = date("Y-m-d H:i:s");  echo $fecha_hora; ?>">
                                  
                                </td>
                                
                                

                                    <!-- inicio ejecutado pro camaronera general-->

                                    <td class="text-center" style="width:80px;">
                                        <span> <?php echo number_format($cm['total_ejecutado_camaronera'],2); ?>
                                        </span>
                                    </td>

                                    <td class="text-center"
                                        style="width:80px; border-right: 3px solid #404e67; padding: 1px;">
                                        <?php 
                                        // Asegurar que $presupuesto no sea 0 para evitar división por cero
                                        $porcentaje = ($presupuesto > 0) ? round(($cm['total_ejecutado_camaronera'] / $presupuesto) * 100, 2) : 0;
                                        
                                        // Definir el color basado en la comparación con $totalPresupuesto
                                        $color = ($cm['total_ejecutado_camaronera'] > $totalPresupuesto) ? 'red' : 'green';
                                        $sms = ($cm['total_ejecutado_camaronera'] > $totalPresupuesto) ? 'excedido' : 'normal';

                                        echo "<span style='color: $color;  title='$sms'>$porcentaje %</span>"; 
                                    ?>
                                    </td>


                                    <!-- fin ejecutado pro camaronera general-->

                                    <!--td class="text-center" style="width:80px;">
                                        <?php echo number_format($p['saldo'],2); ?> </td>

                                    <td class="text-center" style="width:80px;">
                                        <?php echo ($presupuesto > 0) ? round(($p['saldo'] / $presupuesto) * 100, 2) . ' %' : '0 %'; ?>
                                    </td-->
                                </tr>
                                <?php } ?>
                                <?php  endforeach; ?>
                            </tbody>
 
                        </table>
                        <div class="container" style="margin-left:27%;">
                            <button type="submit" class="btn btn-danger btn-sm" style="height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">actualizar</button>
                        </div>
                        </form>
                    </div> 
                </div>
            </div>
        </div>
        
    </div>

</div>




<div class="container col-5">


    <?php 
        if($camaronera == 1){
            $haCamaronera = 84.60;    // produccion => 84.30 
            $dias = 30;
        }else if($camaronera == 2 ){
            $haCamaronera = 125.96;   // produccion =>
            $dias = 30;
        }else if($camaronera == 3){
            $haCamaronera = 70;      // produccion =>
            $dias = 30;
        }
    ?>

    <ul class="list-group">

        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Hectareas total</strong>
            <span class="badge badge-primary badge-pill"><?php echo number_format($haCamaronera,2); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Costo para prorrateo (sin inversion)</strong>

            <?php

                $sqlCostoHADiaApr = "SELECT presupuesto_aprobado FROM presupuesto_camaronera_general 
                WHERE empresaId = '$empresaId' AND descripcion in ('indirectos', 'manoObra') 
                ORDER BY fecha_registro DESC 
                LIMIT 2";

                $dataHaDiaAp = $conectar->mostrar($sqlCostoHADiaApr);

                // Inicializar la variable de suma
                $totalPresupuestos = 0;

                foreach($dataHaDiaAp as $hdp):
                    // Sumar el valor de cada presupuesto_aprobado
                    $totalPresupuestos += $hdp['presupuesto_aprobado'];
                endforeach;

                // Mostrar el total
                $totalPresupuestos;

            ?>

            <span
                class="badge badge-dark badge-pill"><?php echo number_format(($totalPresupuesto+$totalPresupuestos),2); ?></span>
        </li>

        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Costo hectarea dia aprobado</strong>

            <?php

                $sqlCostoHADiaApr = "SELECT presupuesto_aprobado FROM presupuesto_camaronera_general 
                WHERE empresaId = '117' AND descripcion in ('indirectos', 'manoObra') 
                ORDER BY fecha_registro DESC 
                LIMIT 2";

                $dataHaDiaAp = $conectar->mostrar($sqlCostoHADiaApr);

                // Inicializar la variable de suma
                $totalPresupuestos = 0;

                foreach($dataHaDiaAp as $hdp):
                    // Sumar el valor de cada presupuesto_aprobado
                    $totalPresupuestos += $hdp['presupuesto_aprobado'];
                endforeach;

                // Mostrar el total
                $totalPresupuestos;

            ?>

            <span
                class="badge badge-dark badge-pill"><?php echo number_format(($totalPresupuesto+$totalPresupuestos)/$dias/$haCamaronera,2); ?></span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <strong>Costo hectarea dia ejecutado</strong>

            <?php

                $sqlCostoHADiaApr = "SELECT ejecutado_contabilidad FROM presupuesto_camaronera_general 
                WHERE empresaId = '117' AND descripcion in ('indirectos', 'manoObra') 
                ORDER BY fecha_registro DESC 
                LIMIT 2";

                $dataHaDiaAp = $conectar->mostrar($sqlCostoHADiaApr);

                // Inicializar la variable de suma
                $totalPresupuestosConta = 0;

                foreach($dataHaDiaAp as $hdp):
                    // Sumar el valor de cada presupuesto_aprobado
                    $totalPresupuestosConta += $hdp['ejecutado_contabilidad'];
                endforeach;

                // Mostrar el total
                $totalPresupuestosConta;

            ?>

            <span
                class="badge badge-danger badge-pill"><?php echo number_format(($totalEjecucion+$totalPresupuestosConta)/$dias/$haCamaronera,2); ?>
            </span>
        </li>

    </ul>

</div>





<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.clickable-row').forEach(function(row) {
        row.addEventListener('click', function() {
            const target = row.getAttribute('data-target');
            document.querySelector(target).classList.toggle('collapse');
        });
    });
});
</script>