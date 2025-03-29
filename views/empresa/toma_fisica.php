<?php
//katal 1.2
$objeto = new corrida();
$conectar = new Conexion();
$conexion = $conectar->conectar();
date_default_timezone_set("America/Lima");
$fecha = date('Y-m-d');
$fechaActual = date('Y-m-d');
    $desde = date('Y-m-d', strtotime('next Monday -1 week', strtotime('this sunday')));
    $hasta = date('Y-m-d', strtotime($desde . ' + 6 days', strtotime('this sunday')));
    $dia_dos = strtotime($desde . "+ 1 days");
    $dia_tres = strtotime($desde . "+ 2 days");
    $dia_cuatro = strtotime($desde . "+ 3 days");
    $dia_cinco = strtotime($desde . "+ 4 days");
    $dia_seis = strtotime($desde . "+ 5 days");
    $dia_siete = strtotime($desde . "+ 6 days");
    
    
    $sqlbase="SELECT * FROM RegistroTomaFisica WHERE fecha >= '$desde' AND fecha <= '$hasta' and responsable = '$camaronera' ;";
    $datas = $objeto->mostrar($sqlbase);
   // echo count($datas);
?>


<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-12">
                <?php 
                    if(count($datas)>=1 AND $_SESSION['id']==2){ 
                ?>


                <?php } else {?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"><strong>Importante !</strong></h4>
                    <p>Por medidas de valicación y cuadre de inventario, es necesario realizar el conteo y registro de
                        toma física de cada tipo de balanceado que tenemos disponible en bodega. </p>
                    <hr>
                    <p class="mb-0">Por favor registre la cantidad y tipo de balanceado que tenemos disponible.</p>
                </div>
                <?php } ?>
                <div class="card col-12">
                    <div class="card-header">
                        
                        <div class="alert alert-success col-12 text-center" role="alert">
                            <h3><b>Registro de toma física de balanceado en kilos. (SEMANA ACTUAL)</b></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../controllers/insert-toma-fisica.php" method="post">
                            <?php

                                if(count($datas)>=1){ 
                                    
                                    $sqli = "SELECT DISTINCT producto,cantidad FROM RegistroTomaFisica x LEFT JOIN kardex y ON x.producto = y.tipo_balanceado  WHERE x.responsable = '$camaronera' AND x.fecha >= '$desde' AND x.fecha <= '$hasta' AND saldo > 0";
                                    $data = $objeto->mostrar($sqli);       
                                } else {
                                    
                                    $sqli = "SELECT k.tipo_balanceado, k.fecha, k.saldo
                                    FROM kardex k
                                    INNER JOIN (
                                        SELECT tipo_balanceado, MAX(fecha) AS ultima_fecha
                                        FROM kardex
                                        WHERE camaronera_id = '$camaronera' AND saldo > 0
                                        AND fecha >= DATE_SUB(CURDATE(), INTERVAL 21 DAY)  -- Filtra por los últimos 21 días
                                        GROUP BY tipo_balanceado
                                    ) sub ON k.tipo_balanceado = sub.tipo_balanceado AND k.fecha = sub.ultima_fecha
                                    WHERE k.camaronera_id = '$camaronera' AND k.saldo > 0
                                    GROUP BY k.tipo_balanceado;
                                    ";
                                    $data = $objeto->mostrar($sqli);                                        
                                        
                                } 

                                foreach ($data as $value) {
                            ?>
                            <div class="row">
                                <div class="col-sm-8 col-lg-10">
                                    <div class="input-group">
                                        <label class="col-sm-5 col-lg-3 col-form-label">
                                            <?php 
                                                if(count($datas)>=1){ 
                                                    echo $value['producto']; 
                                                } else {
                                                    echo $value['tipo_balanceado'];       
                                                }
                                            ?>
                                        </label>
                                        <span class="input-group-prepend">
                                            <label class="input-group-text"><i class="fas fa-cube"></i></label>
                                        </span>
                                        <input type="hidden" class="form-control"
                                            value="<?php echo $value['tipo_balanceado']; ?>" name="nombre_alimento[]">
                                        <input type="hidden" class="form-control" value="<?php echo $camaronera; ?>"
                                            name="camaronera">
                                        <?php 
                                                if(count($datas)>=1){ 
                                                    if($_SESSION['id']==2){ ?>
                                                        
                                                        <input type="text" class="form-control" value="<?php echo $value['cantidad'] ?>"  readonly style="background:none;">
                                                <?php    }
                                                } else {
                                            ?>
                                        <input type="text" class="form-control" value="0.0" name="cantidad_alimento[]"
                                            required>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="text-center">
                                <?php
                                    if(count($datas)>=1){ 
                                ?>
                                
                                <div class="alert alert-danger mt-3" role="alert">
                                    <h6><b>Ya se realizo la toma fisica!</b></h6>
                                </div>
                                <?php
                                    } else {
                                ?>
                                <button type="submit" class="btn btn-primary">Guardar toma física</button>
                                <?php } ?>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <?php 
                $sqli = "SELECT k.fecha, k.tipo_balanceado, k.saldo
                FROM kardex k JOIN ( SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id FROM kardex WHERE camaronera_id = '$camaronera' GROUP BY tipo_balanceado ) max_ids
                ON k.tipo_balanceado = max_ids.tipo_balanceado
                AND k.kardex_id = max_ids.max_kardex_id";
                $balanceados = $objeto->mostrar($sqli);
            ?>

            <table style="display:none;" class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2"
                style="width:512px;">

                <thead>
                    <tr class="text-white text-center">
                        <th colspan="4" class="bg-dark">
                            <span class="text-white"> RESUMEN GENERAL DE STOCK EN BODEGA </span>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th class="text-center text-white" style="background: #404e67;">Balanceado </th>
                        <th class="text-center text-white" style="background: #404e67;"> Saldo en kilos </th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                    
                        foreach ($balanceados as $balanceado) { 
                                       
                            $sql="SELECT MIN(id_tipo_alimento) AS descripcion_alimento from tipo_alimento WHERE CONCAT(descripcion_alimento,' ',gramaje_alimento) = '".$balanceado['tipo_balanceado']."'";
                            $tipo_alimento = $objeto->mostrar($sql);
                            foreach ($tipo_alimento as $value) {
                                $descripcion_alimento = $value['descripcion_alimento'];
                            }
                    ?>


                    <?php }  ?>
                <tbody>
            </table>
            <?php 
                if(count($datas)>=1 AND $_SESSION['id']==2){ 
            ?>

            <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                <thead>
                    <tr class="text-center">
                        <th class="text-center text-white" style="background: #404e67;">Balanceado
                        </th>
                        <th class="text-center text-white" style="background: #404e67;">
                            Saldo (En sacos)
                        </th>
                        <th class="text-center text-white" style="background: #404e67;">
                            Saldo (En Kilos)
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach ($balanceados as $balanceado) {  if($balanceado['saldo'] >0.00){ ?>
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
                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                            <span class="text-secondary text-xs font-weight-bold">
                                <?php  echo $balanceado['saldo'] *25; ?>
                            </span>
                        </td>
                    </tr>
                    <?php } } ?>
                <tbody>
            </table>

            <?php } ?>
        </div>

    </div>
</div>