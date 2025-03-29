<?php $objeto = new corrida();?>
<div class="card">

 <div class="card-header text-center" style="background: #404e67;">
    <h6 class="text-white" style="margin:auto;"></h6>
        <h6 class="text-white" style="margin:auto;text-align:center">KARDEX</h6>
       
         <ul class="time-horizontal nav justify-content-center">
           <!--  <li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li> 
            <li><b><a class="nav-link text-white " href="index.php?page=Ingreso"><i class="fas fa-copy text-info"></i> Ingresos de balanceado </a></b></li> 
            <li><b><a class="nav-link text-white " href="index.php?page=Aprobacion-solicitud"><i class="fas fa-minus-circle text-warning"></i> Aprobacion de solicitud</a></b></li>   -->
            <li><b><a class="nav-link text-white " href="index.php?page=Kardex-base"><i class="fas fa-cogs text-danger"></i> Historico kardex hasta Abril 15 2024</a></b></li> 
        </ul>
      
    </div>

</div>
<div class="container">
    <center>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background: #404e67;">
                    <h6 class="text-white" style="margin:auto;">CONSULTA DE EXISTENCIA DE BALANCEADO</h6>
                </div>
                <div class="card-body">
                    <div class="mb-20">
                        <form action="#" method="post">

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <?php
                                        $sqli = "SELECT DISTINCT id_camaronera FROM registro_piscina_engorde WHERE estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                        $data = $objeto->mostrar($sqli);
                                        ?>
                                        <select class="form-control" name="camaronera" id="camaronera">
                                            <?php
                                            foreach ($data as $value) {
                                            ?>
                                                <option value="<?php echo $aux = $value['id_camaronera']; ?>">
                                                    <?php
                                                    $sqli_camaronera = "SELECT DISTINCT descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                                    $data_camaronera = $objeto->mostrar($sqli_camaronera);
                                                    foreach ($data_camaronera as $value) {
                                                    ?>
                                                        <?php echo $value['descripcion_camaronera']; ?></option>
                                        <?php }
                                                } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Rango de Fechas </label>
                                <div class="col-sm-2 col-lg-3">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="fechaInicial" id="fechaInicial" value="" style="background: none;">
                                    </div>
                                </div>
                                <!-- <label class="col-sm-3 col-lg-4 col-form-label">Fecha final</label>-->
                                <div class="col-sm-2 col-lg-3">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="fechaFinal" id="fechaFinal" value="" style="background: none;">
                                    </div>
                            </div>
                                <div class="row">
                               
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Seleccione Balanceado</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select class="form-control" name="tipo_balanceado" id="tipo_balanceado">
                                             <?php
                                        $sql = "SELECT * FROM tipo_alimento";
                                        $data = $objeto->mostrar($sql);
                                        $alimentos = $data;
                                        foreach ($data as $value) {
                                        ?>
                                            <option value="<?php echo $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento'] ?>">
                                                <?php echo '<a href="#">' . $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento'] . '</a>'; ?>
                                            </option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                          
                                <center><button class="btn btn-primary btn-sm text-light mt-3" type="submit">CONSULTAR KARDEX</button></center>
                        </form>
                          <?php if ($_POST['mode_all']!="1" AND isset($_POST['camaronera'])) {    ?>
                            <input type="hidden" class="form-control" name="mode_all" id="mode_all" value="1" style="background: none;">
                                 <a href="index.php?page=Kardex" class="btn btn-danger mb-5 float-right" style="height:32px;position:absolute;left:-96px;top:20%;">REGRESAR A SALDOS GENERALES</a><br>
                                 
                                 
                           
                            <?php            } else {?>
                         
                            <?php    } ?>
                    </div>
                </div>
            </div>
        </div>
    </center>
    <?php
    if (
        isset($_POST['camaronera']) AND
        isset($_POST['fechaInicial']) AND
        isset($_POST['fechaFinal']) AND
        isset($_POST['tipo_balanceado']) AND
        $_POST['mode_all'] !="1"
        )
    
    {
        ?>
    <?php    
    $sql1="SELECT * FROM `kardex` WHERE camaronera_id = '".$_POST['camaronera']."' AND tipo_balanceado = '".$_POST['tipo_balanceado']."' ";
    if ($_POST['fechaInicial'] !=  ''){
    $sql2 =" AND fecha >= '".$_POST['fechaInicial']."' ";  
      }
     if ($_POST['fechaFinal'] !=  '' ){
    $sql2 =" AND fecha <= '".$_POST['fechaFinal']."' ";  
      }
    $sql3 = "ORDER BY `kardex`.`kardex_id` DESC";
    $sql = $sql1.$sql2.$sql3;
    $data = $objeto->mostrar($sql);
    ?>
    
         <div class="row">
        <div class="col-12">
            <div class="table table-sm table-responsive mb-4 ">
                <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
 <div class="card"><b></b> <p style="position:absolute;right:0px;" class="text-primary">Saldo a la fecha de corte:&nbsp;<?php echo $data[0]['saldo']; ?></p></b>
  <?php    
    $sql1="SELECT * FROM `kardex` WHERE camaronera_id = '".$_POST['camaronera']."' AND tipo_balanceado = '".$_POST['tipo_balanceado']."' ";
    if ($_POST['fechaInicial'] !=  ''){
    $sql2 =" AND fecha >= '".$_POST['fechaInicial']."' ";  
      }
     if ($_POST['fechaFinal'] !=  '' ){
    $sql2 =" AND fecha <= '".$_POST['fechaFinal']."' ";  
      }
    $sql3 = "ORDER BY `kardex`.`kardex_id` ASC";
    $sql = $sql1.$sql2.$sql3;
    $data = $objeto->mostrar($sql);
    ?>
<div class="card-body"><b>
    <?php 
switch ($_POST['camaronera']) {
    case 1:
        $name="DARSACOM";
        break;
}
    if (($_POST['fechaInicial'] ==  '') AND ($_POST['fechaFinal'] ==  ''  )){
$charset= "KARDEX ".$name."     /     COMPLETO ".$_POST['fechaInicial']."".$_POST['fechaFinal']."     /     BALANCEADO ".$_POST['tipo_balanceado']; 
    } else {
  $charset= "KARDEX ".$name."     /     DESDE ".$_POST['fechaInicial']."     /     HASTA ".$_POST['fechaFinal']."     /     BALANCEADO ".$_POST['tipo_balanceado'];     
    }
      if (($_POST['fechaInicial'] !=  '') AND ($_POST['fechaFinal'] ==  ''  )){
 $charset= "KARDEX ".$name."     /     DESDE ".$_POST['fechaInicial']."     /     HASTA la Actualidad ".$_POST['fechaFinal']."     /     BALANCEADO ".$_POST['tipo_balanceado'];     
    }
        if (($_POST['fechaInicial'] ==  '') AND ($_POST['fechaFinal'] !=  ''  )){
$charset= "KARDEX ".$name."     /     DESDE EL INICIO ".$_POST['fechaInicial']."     /     HASTA ".$_POST['fechaFinal']."     /     BALANCEADO ".$_POST['tipo_balanceado'];     
    } echo $charset;
?>
</b>
    </div>
    </div>
    <thead>
                            <tr class="text-center">
                                <th class="text-center text-white" style="background: #404e67;">Fecha de movimiento
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Balanceado
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Descripcion
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">ingreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Egreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">En Psc
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Saldo
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Responsable
                                </th>
                            </tr>
                        </thead>
    <? foreach ($data as $x) {?>
                        <tbody>
                                    <tr>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php  echo $x['fecha']; ?>
                                        <!-- balanceado -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $x['tipo_balanceado']; ?>
                                        </td>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                               <?php echo $x['descripcion']; ?></span>
                                        </td>
                                        <!-- Ingreso inicial -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <?php echo $x['ingreso'];  ?>
                                        </td>
                                        <!-- Egreso -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                           <?php echo  $x['egreso'];  ?>
                                        </td>
                                        <!-- sobrante en piscina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <?php echo $x['saldo_piscina'];  ?>
                                        </td>
                                        <!-- Saldo disponible -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php $s = $i - $e; ?>
                                            <span class="text-secondary text-xs font-weight-bold">
                                          <?php echo $x['saldo'];  ?>
                                            </span>
                                        </td>
                                        <!-- Responsable -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                         <?php echo $x['responsable'];  ?>
                                        </td>
                                    </tr>
                        </tbody>
                           <?php } ?>
                    </table>
                    </div>  </div>  </div>

    <?
    }
    else 
    {
    ?>
         <div class="row">
        <div class="col-12">
            <div class="table table-sm table-responsive mb-4 ">
                <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                    <?php
                    $b = $_POST['tipo_alimento'];
                    $alimento = explode(" ", $b);
                    if (isset($_POST['tipo_alimento']) && $b != '') { ?>
                        <thead>
                            <tr class="text-center">
                                <th class="text-center text-white" style="background: #404e67;">Fecha de movimiento
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Balanceado
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Descripcion
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">ingreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Egreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">En Psc
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Saldo
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Responsable
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * 
                                    FROM(
                                        SELECT DISTINCT e.fecha_entrega AS fecha, e.descripcion AS descripcion
                                        FROM egreso_balanceado e
                                        WHERE e.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
                                        AND e.fecha_entrega < '2024-04-16'
                                        ORDER BY e.fecha_entrega ASC) t1
                                    UNION
                                        (SELECT DISTINCT i.fecha_ingreso AS fecha, i.descripcion AS descripcion
                                        FROM ingreso_balanceado i
                                        WHERE i.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
                                        AND i.fecha_ingreso < '2024-04-16'
                                        ORDER BY i.descripcion ASC)
                                    ORDER BY fecha ASC";
                            $data = $objeto->mostrar($sql);
                            if (count($b) > 0) {
                                foreach ($data as $x) {
                                    $este_te_sobra_koketa = 0.00;
                                    $fecha_consumo = $x["fecha"];
                                    if ($x['descripcion'] == 'Consumo piscina' || $x['descripcion'] == 'Consumo precria') {
                                        if ($x['descripcion'] == 'Consumo piscina') {
                                            $sql_sobrante = "SELECT 
                                                            SUM((e.cantidad_balanceado) + e.sobrante) -
                                                            IF (
                                                                a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'), 
                                                                SUM(a.cantidad),
                                                                IF (
                                                                    a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                    SUM(a.cantidad_2),
                                                                    IF (
                                                                        a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')
                                                                        AND
                                                                        a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento  = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                        SUM(a.cantidad + a.cantidad_2),
                                                                        0
                                                                    )
                                                                )
                                                            )as alimentaste    
                                                        FROM 
                                                            egreso_balanceado e, registro_alimentacion_engorde a
                                                        WHERE
                                                            e.id_piscina = a.id_piscina
                                                            AND a.id_piscina BETWEEN 1 AND 12
                                                            AND e.camaronera = a.id_camaronera
                                                            AND a.id_camaronera = '$camaronera'
                                                            AND e.fecha_entrega = a.fecha_alimentacion
                                                            AND a.fecha_alimentacion = '$fecha_consumo'
                                                            AND (e.id = 'Piscina')
                                                            AND e.tipo_balanceado = '$b'
                                                            AND a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')";
                                        } /*else {
                                            $sql_sobrante = "SELECT 
                                                            SUM((e.cantidad_balanceado) + e.sobrante) -
                                                            IF (
                                                                a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'), 
                                                                SUM(a.cantidad),
                                                                IF (
                                                                    a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                    SUM(a.cantidad_2),
                                                                    IF (
                                                                        a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')
                                                                        AND
                                                                        a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento  = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                        SUM(a.cantidad + a.cantidad_2),
                                                                        0
                                                                    )
                                                                )
                                                            )as alimentaste    
                                                        FROM 
                                                            egreso_balanceado e, registro_alimentacion_precria a
                                                        WHERE
                                                            e.id_piscina = a.id_precria
                                                            AND a.id_precria BETWEEN 1 AND 12
                                                            AND e.camaronera = a.id_camaronera
                                                            AND a.id_camaronera = '$camaronera'
                                                            AND e.fecha_entrega = a.fecha_alimentacion
                                                            AND a.fecha_alimentacion = '$fecha_consumo'
                                                            AND (e.id = 'Precria')
                                                            AND e.tipo_balanceado = '$b'
                                                            AND a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')";
                                        }*/
                                       /* $data_sobrante = $objeto->mostrar($sql_sobrante);
                                        foreach ($data_sobrante as $datos_sobrante) {
                                            if ($datos_sobrante['alimentaste']) {
                                                $este_te_sobra_koketa = $datos_sobrante['alimentaste'];
                                            } else {
                                                $este_te_sobra_koketa = 0.00;
                                            }
                                        }*/
                                    }
                            ?>
                                    <tr>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $d = $x['fecha'];$getdate = $d; ?>
                                        <!-- balanceado -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $b;$getbalanceado = $b; ?></span>
                                        </td>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $x['descripcion'];$getdescripcion = $x['descripcion'];  ?></span>
                                        </td>
                                        <!-- Ingreso inicial -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            $descrip = $x['descripcion'];
                                            $sql = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado FROM ingreso_balanceado WHERE tipo_balanceado LIKE '$b' AND descripcion = '$descrip' AND camaronera = '$camaronera' AND fecha_ingreso = ( SELECT MAX(fecha_ingreso) FROM ingreso_balanceado WHERE fecha_ingreso = '$d')";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $i_aux = $s;
                                                $i = $x['cantidad_balanceado'];
                                                $ingresito = $i;
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $i . '</span>';
                                                 $getingreso =  $i;
                                                   $getingreso = str_replace(",", "", $getingreso);
                                            }
                                            ?>
                                        </td>
                                        <!-- Egreso -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            $sql = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado, tipo_balanceado FROM egreso_balanceado WHERE tipo_balanceado LIKE '$b' AND camaronera = '$camaronera' AND fecha_entrega = '$d' AND descripcion = '$descrip'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                if($x['tipo_balanceado'] == 'Origin 0.5'){
                                                    $e = $x['cantidad_balanceado'] / 10;
                                                }else if($x['tipo_balanceado'] == 'Origin 0.3'){
                                                    $e = $x['cantidad_balanceado'] / 10;
                                                }else {
                                                    $e = $x['cantidad_balanceado'] / 25;
                                                }

                                                if ($i) {
                                                    echo '<span class="text-secondary text-xs font-weight-bold">' . $e . '</span>';
                                                    $i = $s + $i;
                                                } else {
                                                    echo '<span class="text-secondary text-xs font-weight-bold">' . $e . '</span>';
                                                    $i = $s;
                                                }
                                                $getegreso =  $e;
                                                 $getegreso = str_replace(",", "", $getegreso);
                                            }
                                            ?>
                                        </td>
                                        <!-- sobrante en piscina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            echo $este_te_sobra_koketa/25;
                                            $getsobrante = $est/25;
                                             $getsobrante = str_replace(",", "", $getsobrante);
                                            ?>
                                        </td>
                                        <!-- Saldo disponible -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php $s = $i - $e; ?>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php if ($s <= 0) {
                                                    echo '0.00';$getsaldo = 0.00;
                                                } else {
                                                    $valor_e = number_format(substr($s, -4), 2);
                                                    if ($valor_e == 'E-14' || $valor_e == 'E-15' || $valor_e == 'E-16') {
                                                        echo '0.00';$getsaldo = 0.00;
                                                    } else {
                                                        echo number_format(sprintf($s), 2); $getsaldo = number_format(sprintf($s), 2);
                                                     
                                                        $getsaldo = str_replace(",", "", $getsaldo);
                                                    };
                                                } ?>
                                            </span>
                                        </td>
                                        <!-- Responsable -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            if ($ingresito) {
                                                $sql = "SELECT DISTINCT i.encargado AS encargado
                                                FROM ingreso_balanceado i
                                                WHERE i.tipo_balanceado =  '$b' 
                                                AND i.fecha_ingreso = '$d'
                                                AND i.fecha_ingreso < '2024-04-16'
                                                AND i.camaronera = '$camaronera'";
                                            } else {
                                                $sql = "SELECT DISTINCT e.encargado AS encargado
                                                FROM egreso_balanceado e
                                                WHERE e.tipo_balanceado =  '$b' 
                                                AND e.fecha_entrega = '$d'
                                                AND e.fecha_entrega < '2024-04-16'
                                                AND e.camaronera = '$camaronera'";
                                            }

                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $x['encargado'] . '</span>';
                                                $getresponsable = $x['encargado'];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                        </tbody>
                <?php
                 $sql = "INSERT INTO `kardex`(`fecha`, `descripcion`, `tipo_balanceado`, `camaronera_id`, `ingreso`, `egreso`, `saldo_piscina`, `saldo`, `responsable`) 
            VALUES(
                '$getdate',
                '$getdescripcion',
                '$getbalanceado',
                '1',
                '$getingreso',
                '$getegreso',
                '$getsobrante',
                '$getsaldo',
                '$getresponsable'
            );"; 
        // echo $sql;
                                }
                            }
                            //VALIDAMOS Y VISUALIZAMOS EL KARDEX CON LOS SALDOS DEL ULTIMO MOVIMIENTO
                        } else { ?>
                        
                <div class="col-6">
               <?php $sqli = "
                SELECT k.fecha, k.tipo_balanceado, k.saldo
                            FROM kardex k
                                JOIN (
                                    SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id
                                        FROM kardex
                                            WHERE camaronera_id = '$camaronera'
                                                GROUP BY tipo_balanceado
                                                    ) max_ids
                                                        ON k.tipo_balanceado = max_ids.tipo_balanceado
                                                            AND k.kardex_id = max_ids.max_kardex_id;
                                                                ";$balanceados = $objeto->mostrar($sqli);
                    ?>
                    
                    
                    
                    
                    <?php
                      $sql = "SELECT * FROM tipo_alimento";
                                        $data = $objeto->mostrar($sql);

                                        $alimentos = $data;

                                        foreach ($data as $value) {
                                    
                                          $tipoalimentacion = $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento'];
                                         
                                             } ?>
                                       <b> RESUMEN GENERAL DE STOCK ACTUAL</b>
                      <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                        <thead>
                            <tr class="text-center">
                                  <th class="text-center text-white" style="background: #404e67;">Balanceado
                                </th>
                                 <th class="text-center text-white" style="background: #404e67;">
                                    Saldo
                                </th>
                            </tr>
                        </thead>
                          <tbody>
                                       <?php  foreach ($balanceados as $balanceado) {  ?>
                                    <tr>
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php  echo $balanceado['tipo_balanceado']; ?>
                                                </span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                 <?php  echo $balanceado['saldo']; ?>
                                                </span>
                                        </td>
                                    </tr>
                                      <?php }  ?>
                             <tbody>
                       </table>
                       
                       
                      
                        
                    <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                      
                        <?php
                            $numero_alimentos = count($alimentos);
                            //$cont = 0;
                            foreach ($alimentos as $alimentito) {
                                $aux_alimentito = $alimentito['descripcion_alimento'] . ' ' . $alimentito['gramaje_alimento'];
                                
                                $movimientos = $objeto->mostrar($sql1);
                                $ban1 = 0;
                                $s = 0;
                                foreach ($movimientos as $movimiento) {
                                   
                                    foreach ($cantidad_ingreso as $cantidad_i) {
                                        $i_aux = $s;
                                        $i = $cantidad_i['cantidad_balanceado'];
                                        if ($cantidad_i['cantidad_balanceado']) {
                                            $i_m = $i;
                                        }
                                    }
                                }
                             }
                        } ?>

                    </table>
                    
                    
                    
                </div>
                
            </div>
        </div>
    </div>
    <?php
    }
    ?>
</div>

PARTE 2

<div class="card">

 <div class="card-header text-center" style="background: #404e67;">
    <h6 class="text-white" style="margin:auto;"></h6>
        <h6 class="text-white" style="margin:auto;text-align:center">KARDEX</h6>
       
         <ul class="time-horizontal nav justify-content-center">
           <!--  <li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li> 
            <li><b><a class="nav-link text-white " href="index.php?page=Ingreso"><i class="fas fa-copy text-info"></i> Ingresos de balanceado </a></b></li> 
            <li><b><a class="nav-link text-white " href="index.php?page=Aprobacion-solicitud"><i class="fas fa-minus-circle text-warning"></i> Aprobacion de solicitud</a></b></li>   -->
            <li><b><a class="nav-link text-white " href="index.php?page=Kardex-base"><i class="fas fa-cogs text-danger"></i> Historico kardex hasta Abril 15 2024</a></b></li> 
        </ul>
      
    </div>

</div>
<div class="container">
         <div class="row">
        <div class="col-12">
            <div class="table table-sm table-responsive mb-4 ">
                <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                        <?php    
    $sql1="SELECT * FROM `kardex` WHERE camaronera_id = '".$_POST['camaronera']."' AND tipo_balanceado = '".$_POST['tipo_balanceado']."' ";
    if ($_POST['fechaInicial'] !=  ''){
    $sql2 =" AND fecha >= '".$_POST['fechaInicial']."' ";  
      }
     if ($_POST['fechaFinal'] !=  '' ){
    $sql2 =" AND fecha <= '".$_POST['fechaFinal']."' ";  
      }
    $sql3 = "ORDER BY `kardex`.`kardex_id` DESC";
    $sql = $sql1.$sql2.$sql3;
    $data = $objeto->mostrar($sql);
    ?>
    

 <div class="card"><b></b> <p style="position:absolute;right:0px;" class="text-primary">Saldo a la fecha de corte:&nbsp;<?php echo $data[0]['saldo']; ?></p></b>
  <?php    
    $sql1="SELECT * FROM `kardex` WHERE camaronera_id = '".$_POST['camaronera']."' AND tipo_balanceado = '".$_POST['tipo_balanceado']."' ";
    if ($_POST['fechaInicial'] !=  ''){
    $sql2 =" AND fecha >= '".$_POST['fechaInicial']."' ";  
      }
     if ($_POST['fechaFinal'] !=  '' ){
    $sql2 =" AND fecha <= '".$_POST['fechaFinal']."' ";  
      }
    $sql3 = "ORDER BY `kardex`.`kardex_id` ASC";
    $sql = $sql1.$sql2.$sql3;
    $data = $objeto->mostrar($sql);
    ?>
<div class="card-body"><b>
    <?php 
switch ($_POST['camaronera']) {
    case 1:
        $name="DARSACOM";
        break;
}
    if (($_POST['fechaInicial'] ==  '') AND ($_POST['fechaFinal'] ==  ''  )){
$charset= "KARDEX ".$name."     /     COMPLETO ".$_POST['fechaInicial']."".$_POST['fechaFinal']."     /     BALANCEADO ".$_POST['tipo_balanceado']; 
    } else {
  $charset= "KARDEX ".$name."     /     DESDE ".$_POST['fechaInicial']."     /     HASTA ".$_POST['fechaFinal']."     /     BALANCEADO ".$_POST['tipo_balanceado'];     
    }
      if (($_POST['fechaInicial'] !=  '') AND ($_POST['fechaFinal'] ==  ''  )){
 $charset= "KARDEX ".$name."     /     DESDE ".$_POST['fechaInicial']."     /     HASTA la Actualidad ".$_POST['fechaFinal']."     /     BALANCEADO ".$_POST['tipo_balanceado'];     
    }
        if (($_POST['fechaInicial'] ==  '') AND ($_POST['fechaFinal'] !=  ''  )){
$charset= "KARDEX ".$name."     /     DESDE EL INICIO ".$_POST['fechaInicial']."     /     HASTA ".$_POST['fechaFinal']."     /     BALANCEADO ".$_POST['tipo_balanceado'];     
    } echo $charset;
?>
</b>
    </div>
    </div>
                    <?php
                    $inicialdate = $_POST['fechaInicial'];
                    $finaldate = $_POST['fechaFinal'];
                    
                       if (isset($_POST['fechaInicial']) && $_POST['fechaInicial'] != ''){
                           
                        $dater1 = "AND e.fecha_entrega >= '$inicialdate'";
                        $dater3 = "AND i.fecha_ingreso >= '$inicialdate'";
                       
                           
                       } else { $dater1='' ;  $dater3=''; }
                        if (isset($_POST['fechaFinal']) && $_POST['fechaFinal'] != ''){
                        $dater2 = "AND e.fecha_entrega <= '$finaldate'";
                        $dater4 = "AND i.fecha_ingreso <= '$finaldate'";
                        } else { $dater2='';   $dater4='';}
                       
                    
                    $b = $_POST['tipo_balanceado']; /*************************  $_POST['tipo_balanceado'] *************************************/    
                    $alimento = explode(" ", $b);
                    if (isset($_POST['tipo_balanceado']) && $b != '') { ?>  
                        <thead>
                            <tr class="text-center">
                                <th class="text-center text-white" style="background: #404e67;">Fecha de movimiento
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Balanceado
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Descripcion
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">ingreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Egreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">En Psc
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Saldo
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Responsable
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * 
                                    FROM(
                                        SELECT DISTINCT e.fecha_entrega AS fecha, e.descripcion AS descripcion
                                        FROM egreso_balanceado e
                                        WHERE e.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
                                        AND e.fecha_entrega < '2024-04-16'".$dater1.$dater2."
                                        ORDER BY e.fecha_entrega ASC) t1
                                    UNION
                                        (SELECT DISTINCT i.fecha_ingreso AS fecha, i.descripcion AS descripcion
                                        FROM ingreso_balanceado i
                                        WHERE i.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
                                        AND i.fecha_ingreso < '2024-04-16'".$dater3.$dater4."  
                                        ORDER BY i.descripcion ASC)
                                    ORDER BY fecha ASC"; 
                            $data = $objeto->mostrar($sql);
                            if (count($b) > 0) {
                                foreach ($data as $x) {
                                    $este_te_sobra_koketa = 0.00;
                                    $fecha_consumo = $x["fecha"];
                                    if ($x['descripcion'] == 'Consumo piscina' || $x['descripcion'] == 'Consumo precria') {
                                        if ($x['descripcion'] == 'Consumo piscina') {
                                            $sql_sobrante = "SELECT 
                                                            SUM((e.cantidad_balanceado) + e.sobrante) -
                                                            IF (
                                                                a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'), 
                                                                SUM(a.cantidad),
                                                                IF (
                                                                    a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                    SUM(a.cantidad_2),
                                                                    IF (
                                                                        a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')
                                                                        AND
                                                                        a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento  = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                        SUM(a.cantidad + a.cantidad_2),
                                                                        0
                                                                    )
                                                                )
                                                            )as alimentaste    
                                                        FROM 
                                                            egreso_balanceado e, registro_alimentacion_engorde a
                                                        WHERE
                                                            e.id_piscina = a.id_piscina
                                                            AND a.id_piscina BETWEEN 1 AND 12
                                                            AND e.camaronera = a.id_camaronera
                                                            AND a.id_camaronera = '$camaronera'
                                                            AND e.fecha_entrega = a.fecha_alimentacion
                                                            AND a.fecha_alimentacion = '$fecha_consumo'
                                                            AND (e.id = 'Piscina')
                                                            AND e.tipo_balanceado = '$b'
                                                            AND a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')";
                                        }  
                                    }
                            ?>
                                    <tr>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $d = $x['fecha'];$getdate = $d; ?>
                                        <!-- balanceado -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $b;$getbalanceado = $b; ?></span>
                                        </td>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $x['descripcion'];$getdescripcion = $x['descripcion'];  ?></span>
                                        </td>
                                        <!-- Ingreso inicial -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            $descrip = $x['descripcion'];
                                            $sql = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado FROM ingreso_balanceado WHERE tipo_balanceado LIKE '$b' AND descripcion = '$descrip' AND camaronera = '$camaronera' AND fecha_ingreso = ( SELECT MAX(fecha_ingreso) FROM ingreso_balanceado WHERE fecha_ingreso = '$d')";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $i_aux = $s;
                                                $i = $x['cantidad_balanceado'];
                                                $ingresito = $i;
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $i . '</span>';
                                                 $getingreso =  $i;
                                                   $getingreso = str_replace(",", "", $getingreso);
                                            }
                                            ?>
                                        </td>
                                        <!-- Egreso -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            $sql = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado, tipo_balanceado FROM egreso_balanceado WHERE tipo_balanceado LIKE '$b' AND camaronera = '$camaronera' AND fecha_entrega = '$d' AND descripcion = '$descrip'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                if($x['tipo_balanceado'] == 'Origin 0.5'){
                                                    $e = $x['cantidad_balanceado'] / 10;
                                                }else if($x['tipo_balanceado'] == 'Origin 0.3'){
                                                    $e = $x['cantidad_balanceado'] / 10;
                                                }else {
                                                    $e = $x['cantidad_balanceado'] / 25;
                                                }

                                                if ($i) {
                                                    echo '<span class="text-secondary text-xs font-weight-bold">' . $e . '</span>';
                                                    $i = $s + $i;
                                                } else {
                                                    echo '<span class="text-secondary text-xs font-weight-bold">' . $e . '</span>';
                                                    $i = $s;
                                                }
                                                $getegreso =  $e;
                                                 $getegreso = str_replace(",", "", $getegreso);
                                            }
                                            ?>
                                        </td>
                                        <!-- sobrante en piscina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            echo $este_te_sobra_koketa/25;
                                            $getsobrante = $est/25;
                                             $getsobrante = str_replace(",", "", $getsobrante);
                                            ?>
                                        </td>
                                        <!-- Saldo disponible -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php $s = $i - $e; ?>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php if ($s <= 0) {
                                                    echo '0.00';$getsaldo = 0.00;
                                                } else {
                                                    $valor_e = number_format(substr($s, -4), 2);
                                                    if ($valor_e == 'E-14' || $valor_e == 'E-15' || $valor_e == 'E-16') {
                                                        echo '0.00';$getsaldo = 0.00;
                                                    } else {
                                                        echo number_format(sprintf($s), 2); $getsaldo = number_format(sprintf($s), 2);
                                                     
                                                        $getsaldo = str_replace(",", "", $getsaldo);
                                                    };
                                                } ?>
                                            </span>
                                        </td>
                                        <!-- Responsable -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            if ($ingresito) {
                                                $sql = "SELECT DISTINCT i.encargado AS encargado
                                                FROM ingreso_balanceado i
                                                WHERE i.tipo_balanceado =  '$b' 
                                                AND i.fecha_ingreso = '$d'
                                                           
                                                AND i.camaronera = '$camaronera'";
                                            } else {
                                                $sql = "SELECT DISTINCT e.encargado AS encargado
                                                FROM egreso_balanceado e
                                                WHERE e.tipo_balanceado =  '$b' 
                                                AND e.fecha_entrega = '$d'
                                                AND e.fecha_entrega < '2024-04-16'
                                                AND e.camaronera = '$camaronera'";
                                            }

                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $x['encargado'] . '</span>';
                                                $getresponsable = $x['encargado'];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                        </tbody>
                <?php
                 $sql = "INSERT INTO `kardex`(`fecha`, `descripcion`, `tipo_balanceado`, `camaronera_id`, `ingreso`, `egreso`, `saldo_piscina`, `saldo`, `responsable`) 
            VALUES(
                '$getdate',
                '$getdescripcion',
                '$getbalanceado',
                '1',
                '$getingreso',
                '$getegreso',
                '$getsobrante',
                '$getsaldo',
                '$getresponsable'
            );"; 
        // echo $sql;
                                }
                            }
                            //VALIDAMOS Y VISUALIZAMOS EL KARDEX CON LOS SALDOS DEL ULTIMO MOVIMIENTO
                        } ?>

                    </table>
                    
                    
                    
                </div>
                
            </div>
        </div>
            <?php
    if (
        isset($_POST['camaronera']) AND
        isset($_POST['fechaInicial']) AND
        isset($_POST['fechaFinal']) AND
        isset($_POST['tipo_balanceado']) AND
        $_POST['mode_all'] !="1"
        )
    
    {
        ?>
    
    
         <div class="row">
        <div class="col-12">
            <div class="table table-sm table-responsive mb-4 ">
                <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">

    <? foreach ($data as $x) {?>
                        <tbody>
                                    <tr>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php  echo $x['fecha']; ?>
                                        <!-- balanceado -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $x['tipo_balanceado']; ?>
                                        </td>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                               <?php echo $x['descripcion']; ?></span>
                                        </td>
                                        <!-- Ingreso inicial -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <?php echo $x['ingreso'];  ?>
                                        </td>
                                        <!-- Egreso -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                           <?php echo  $x['egreso'];  ?>
                                        </td>
                                        <!-- sobrante en piscina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <?php echo $x['saldo_piscina'];  ?>
                                        </td>
                                        <!-- Saldo disponible -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php $s = $i - $e; ?>
                                            <span class="text-secondary text-xs font-weight-bold">
                                          <?php echo $x['saldo'];  ?>
                                            </span>
                                        </td>
                                        <!-- Responsable -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                         <?php echo $x['responsable'];  ?>
                                        </td>
                                    </tr>
                        </tbody>
                           <?php } ?>
                    </table>
                    </div>  </div>  </div>

    <?
    }
    else 
    {
    ?>
         <div class="row">
        <div class="col-12">
            <div class="table table-sm table-responsive mb-4 ">
                <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                    <?php
                    $b = $_POST['tipo_alimento'];
                    $alimento = explode(" ", $b);
                    if (isset($_POST['tipo_alimento']) && $b != '') { ?>
                        <thead>
                            <tr class="text-center">
                                <th class="text-center text-white" style="background: #404e67;">Fecha de movimiento
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Balanceado
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Descripcion
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">ingreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">Egreso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">En Psc
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Saldo
                                </th>
                                <th class="text-center text-white" style="background: #404e67;">
                                    Responsable
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * 
                                    FROM(
                                        SELECT DISTINCT e.fecha_entrega AS fecha, e.descripcion AS descripcion
                                        FROM egreso_balanceado e
                                        WHERE e.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
                                        AND e.fecha_entrega < '2024-04-16'
                                        ORDER BY e.fecha_entrega ASC) t1
                                    UNION
                                        (SELECT DISTINCT i.fecha_ingreso AS fecha, i.descripcion AS descripcion
                                        FROM ingreso_balanceado i
                                        WHERE i.tipo_balanceado =  '$b' AND camaronera = '$camaronera'
                                        AND i.fecha_ingreso < '2024-04-16'
                                        ORDER BY i.descripcion ASC)
                                    ORDER BY fecha ASC";
                            $data = $objeto->mostrar($sql);
                            if (count($b) > 0) {
                                foreach ($data as $x) {
                                    $este_te_sobra_koketa = 0.00;
                                    $fecha_consumo = $x["fecha"];
                                    if ($x['descripcion'] == 'Consumo piscina' || $x['descripcion'] == 'Consumo precria') {
                                        if ($x['descripcion'] == 'Consumo piscina') {
                                            $sql_sobrante = "SELECT 
                                                            SUM((e.cantidad_balanceado) + e.sobrante) -
                                                            IF (
                                                                a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'), 
                                                                SUM(a.cantidad),
                                                                IF (
                                                                    a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                    SUM(a.cantidad_2),
                                                                    IF (
                                                                        a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')
                                                                        AND
                                                                        a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento  = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                        SUM(a.cantidad + a.cantidad_2),
                                                                        0
                                                                    )
                                                                )
                                                            )as alimentaste    
                                                        FROM 
                                                            egreso_balanceado e, registro_alimentacion_engorde a
                                                        WHERE
                                                            e.id_piscina = a.id_piscina
                                                            AND a.id_piscina BETWEEN 1 AND 12
                                                            AND e.camaronera = a.id_camaronera
                                                            AND a.id_camaronera = '$camaronera'
                                                            AND e.fecha_entrega = a.fecha_alimentacion
                                                            AND a.fecha_alimentacion = '$fecha_consumo'
                                                            AND (e.id = 'Piscina')
                                                            AND e.tipo_balanceado = '$b'
                                                            AND a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')";
                                        } /*else {
                                            $sql_sobrante = "SELECT 
                                                            SUM((e.cantidad_balanceado) + e.sobrante) -
                                                            IF (
                                                                a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'), 
                                                                SUM(a.cantidad),
                                                                IF (
                                                                    a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                    SUM(a.cantidad_2),
                                                                    IF (
                                                                        a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')
                                                                        AND
                                                                        a.id_tipo_alimento_2 = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento  = '$alimento[0]' AND gramaje_alimento = '$alimento[1]'),
                                                                        SUM(a.cantidad + a.cantidad_2),
                                                                        0
                                                                    )
                                                                )
                                                            )as alimentaste    
                                                        FROM 
                                                            egreso_balanceado e, registro_alimentacion_precria a
                                                        WHERE
                                                            e.id_piscina = a.id_precria
                                                            AND a.id_precria BETWEEN 1 AND 12
                                                            AND e.camaronera = a.id_camaronera
                                                            AND a.id_camaronera = '$camaronera'
                                                            AND e.fecha_entrega = a.fecha_alimentacion
                                                            AND a.fecha_alimentacion = '$fecha_consumo'
                                                            AND (e.id = 'Precria')
                                                            AND e.tipo_balanceado = '$b'
                                                            AND a.id_tipo_alimento = (SELECT id_tipo_alimento FROM tipo_alimento WHERE descripcion_alimento = '$alimento[0]' AND gramaje_alimento = '$alimento[1]')";
                                        }*/
                                       /* $data_sobrante = $objeto->mostrar($sql_sobrante);
                                        foreach ($data_sobrante as $datos_sobrante) {
                                            if ($datos_sobrante['alimentaste']) {
                                                $este_te_sobra_koketa = $datos_sobrante['alimentaste'];
                                            } else {
                                                $este_te_sobra_koketa = 0.00;
                                            }
                                        }*/
                                    }
                            ?>
                                    <tr>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $d = $x['fecha'];$getdate = $d; ?>
                                        <!-- balanceado -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $b;$getbalanceado = $b; ?></span>
                                        </td>
                                        <!-- Fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php echo $x['descripcion'];$getdescripcion = $x['descripcion'];  ?></span>
                                        </td>
                                        <!-- Ingreso inicial -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            $descrip = $x['descripcion'];
                                            $sql = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado FROM ingreso_balanceado WHERE tipo_balanceado LIKE '$b' AND descripcion = '$descrip' AND camaronera = '$camaronera' AND fecha_ingreso = ( SELECT MAX(fecha_ingreso) FROM ingreso_balanceado WHERE fecha_ingreso = '$d')";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                $i_aux = $s;
                                                $i = $x['cantidad_balanceado'];
                                                $ingresito = $i;
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $i . '</span>';
                                                 $getingreso =  $i;
                                                   $getingreso = str_replace(",", "", $getingreso);
                                            }
                                            ?>
                                        </td>
                                        <!-- Egreso -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            $sql = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado, tipo_balanceado FROM egreso_balanceado WHERE tipo_balanceado LIKE '$b' AND camaronera = '$camaronera' AND fecha_entrega = '$d' AND descripcion = '$descrip'";
                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                if($x['tipo_balanceado'] == 'Origin 0.5'){
                                                    $e = $x['cantidad_balanceado'] / 10;
                                                }else if($x['tipo_balanceado'] == 'Origin 0.3'){
                                                    $e = $x['cantidad_balanceado'] / 10;
                                                }else {
                                                    $e = $x['cantidad_balanceado'] / 25;
                                                }

                                                if ($i) {
                                                    echo '<span class="text-secondary text-xs font-weight-bold">' . $e . '</span>';
                                                    $i = $s + $i;
                                                } else {
                                                    echo '<span class="text-secondary text-xs font-weight-bold">' . $e . '</span>';
                                                    $i = $s;
                                                }
                                                $getegreso =  $e;
                                                 $getegreso = str_replace(",", "", $getegreso);
                                            }
                                            ?>
                                        </td>
                                        <!-- sobrante en piscina -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            echo $este_te_sobra_koketa/25;
                                            $getsobrante = $est/25;
                                             $getsobrante = str_replace(",", "", $getsobrante);
                                            ?>
                                        </td>
                                        <!-- Saldo disponible -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php $s = $i - $e; ?>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php if ($s <= 0) {
                                                    echo '0.00';$getsaldo = 0.00;
                                                } else {
                                                    $valor_e = number_format(substr($s, -4), 2);
                                                    if ($valor_e == 'E-14' || $valor_e == 'E-15' || $valor_e == 'E-16') {
                                                        echo '0.00';$getsaldo = 0.00;
                                                    } else {
                                                        echo number_format(sprintf($s), 2); $getsaldo = number_format(sprintf($s), 2);
                                                     
                                                        $getsaldo = str_replace(",", "", $getsaldo);
                                                    };
                                                } ?>
                                            </span>
                                        </td>
                                        <!-- Responsable -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <?php
                                            if ($ingresito) {
                                                $sql = "SELECT DISTINCT i.encargado AS encargado
                                                FROM ingreso_balanceado i
                                                WHERE i.tipo_balanceado =  '$b' 
                                                AND i.fecha_ingreso = '$d'
                                                AND i.fecha_ingreso < '2024-04-16'
                                                AND i.camaronera = '$camaronera'";
                                            } else {
                                                $sql = "SELECT DISTINCT e.encargado AS encargado
                                                FROM egreso_balanceado e
                                                WHERE e.tipo_balanceado =  '$b' 
                                                AND e.fecha_entrega = '$d'
                                                AND e.fecha_entrega < '2024-04-16'
                                                AND e.camaronera = '$camaronera'";
                                            }

                                            $data = $objeto->mostrar($sql);
                                            foreach ($data as $x) {
                                                echo '<span class="text-secondary text-xs font-weight-bold">' . $x['encargado'] . '</span>';
                                                $getresponsable = $x['encargado'];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                        </tbody>
                <?php
                 $sql = "INSERT INTO `kardex`(`fecha`, `descripcion`, `tipo_balanceado`, `camaronera_id`, `ingreso`, `egreso`, `saldo_piscina`, `saldo`, `responsable`) 
            VALUES(
                '$getdate',
                '$getdescripcion',
                '$getbalanceado',
                '1',
                '$getingreso',
                '$getegreso',
                '$getsobrante',
                '$getsaldo',
                '$getresponsable'
            );"; 
        // echo $sql;
                                }
                            }
                            //VALIDAMOS Y VISUALIZAMOS EL KARDEX CON LOS SALDOS DEL ULTIMO MOVIMIENTO
                        } else { ?>
                        
                <div class="col-6">
               <?php $sqli = "
                SELECT k.fecha, k.tipo_balanceado, k.saldo
                            FROM kardex k
                                JOIN (
                                    SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id
                                        FROM kardex
                                            WHERE camaronera_id = '$camaronera'
                                                GROUP BY tipo_balanceado
                                                    ) max_ids
                                                        ON k.tipo_balanceado = max_ids.tipo_balanceado
                                                            AND k.kardex_id = max_ids.max_kardex_id;
                                                                ";$balanceados = $objeto->mostrar($sqli);
                    ?>
                    
                    
                    
                    
                    <?php
                      $sql = "SELECT * FROM tipo_alimento";
                                        $data = $objeto->mostrar($sql);

                                        $alimentos = $data;

                                        foreach ($data as $value) {
                                    
                                          $tipoalimentacion = $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento'];
                                         
                                             } ?>
                                       <b> RESUMEN GENERAL DE STOCK ACTUAL</b>
                      <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                        <thead>
                            <tr class="text-center">
                                  <th class="text-center text-white" style="background: #404e67;">Balanceado
                                </th>
                                 <th class="text-center text-white" style="background: #404e67;">
                                    Saldo
                                </th>
                            </tr>
                        </thead>
                          <tbody>
                                       <?php  foreach ($balanceados as $balanceado) {  ?>
                                    <tr>
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php  echo $balanceado['tipo_balanceado']; ?>
                                                </span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                 <?php  echo $balanceado['saldo']; ?>
                                                </span>
                                        </td>
                                    </tr>
                                      <?php }  ?>
                             <tbody>
                       </table>
                       
                       
                      
                        
                    <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                      
                        <?php
                            $numero_alimentos = count($alimentos);
                            //$cont = 0;
                            foreach ($alimentos as $alimentito) {
                                $aux_alimentito = $alimentito['descripcion_alimento'] . ' ' . $alimentito['gramaje_alimento'];
                                
                                $movimientos = $objeto->mostrar($sql1);
                                $ban1 = 0;
                                $s = 0;
                                foreach ($movimientos as $movimiento) {
                                   
                                    foreach ($cantidad_ingreso as $cantidad_i) {
                                        $i_aux = $s;
                                        $i = $cantidad_i['cantidad_balanceado'];
                                        if ($cantidad_i['cantidad_balanceado']) {
                                            $i_m = $i;
                                        }
                                    }
                                }
                             }
                        } ?>

                    </table>
                    
                    
                    
                </div>
                
            </div>
        </div>
    </div>
    <?php
    }
    ?>
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