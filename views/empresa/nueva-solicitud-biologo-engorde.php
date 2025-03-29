<?php
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    date_default_timezone_set("America/Guayaquil");
    $fecha = date('Y-m-d');
    //$camaronera = 2;
    
?>


<div class="card">
    <div class="card-header" style="background: #404e67;">
        <h6 class="text-white" style="margin:auto;">SOLICITUD DE BALANCEADO DEL <strong class="badge" style="background:#4785e3; color:white;"><?php echo $fecha; ?></strong> PARA ENGORDE </h6>
        <ul class="time-horizontal nav justify-content-center">
        </ul>
    </div>


    <div class="container d-flex justify-content-center mt-3">
        <!--button type="button" class="btn btn-dark">Solicitud de engorde</button-->
        <a href="index.php?page=solicitud-precria" type="button" class="btn text-dark" style="background: #f8965a;"><strong>¿ Ver formulario de solicitud de precria ?</strong></a>
    </div>
    <div class="container d-flex justify-content-center mt-3">
        <p id="habilitado" style="display:none; color:red;"><strong>La solicitud para engorde se habilita de 05:00 AM a 09:00 AM</strong></p>
    </div>


    <div class="row mr-2">
        <!-- SOLICITUD PARA PISICINA -->
        <form class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="FormSolicitu" action="../controllers/insert-solicitud-biologo-engorde.php"
            method="POST">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 ">
                    <div class="table table-sm table-responsive">
                        <div class="scroll">
                            <table class="table table-sm table-bordered align-items-center mb-0">

                                <thead>
                                    <tr class="text-center">

                                        <!--th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Fecha </br> de Solicitud
                                        </th-->

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">#</br>Psc
                                        </th>
                                        <!--th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">#</br>Secuencial
                                        </th-->
                                        <!--th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">#</br>Corrida
                                        </th-->


                                        <th class="text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Kilos </br> sobrantes
                                        </th>
                                        <th class="text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Kilos </br> solicitados
                                        </th>

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Tipo de <br> balanceado
                                        </th>

                                        <!--th class="text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Tipo. </br> AABB. Sob
                                        </th-->

                                        <th class="text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Kilos </br> despachados
                                        </th>

                                    </tr>
                                </thead>

                                <tbody class="untiltime">

                                    <?php
    
                                        $sql = "SELECT DISTINCT(id_piscina), id_corrida  FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_piscina";
                                        $data = $conectar->mostrar($sql);
                                        foreach ($data as $key) {
                                            $psc = $key['id_piscina']; 
                                            $ciclo = $key['id_corrida']; 
                                    ?>

                                    <tr>

                                        <!-- inicio fecha de entrega -->
                                            <!--td class="align-middle text-center" style="border: 1px solid #40497C"-->
                                            <span class=" text-secondary text-xs font-weight-bold"><input type="hidden"
                                                    class=" form-control" name="fechaActual" value="<?php echo $fecha; ?>"
                                                    readonly
                                                    style="background:none; width: 100px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;"></span>
                                            <!--/td-->
                                        <!-- fin fecha de entrega -->

                                        <!-- inicio piscina en proceso -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C; padding: 1px; height: -5%; width: 10%;">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    
                                                    <input type="text" class="input2 form-control" name="piscina[]"
                                                        value="<?php  echo $key['id_piscina'];  ?>"
                                                        readonly
                                                        style="background:none; width: 35px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;">
                                                        
                                                </span>

                                            </td>
                                        <!-- fin  piscina en proceso -->

                                        <!-- inicio secuencial de psc en proceso -->

                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
        
                                                    $sql_fe_sec = "SELECT MAX(id_secuencia) AS id_secuencia, MAX(fecha_entrega) AS fecha_entrega  FROM solicitud_balanceados WHERE camaronera = '$camaronera'  AND id IN ('Piscina') LIMIT 1";
                                                    $data_fe_sec = $conectar->mostrar($sql_fe_sec);
                                                    foreach ($data_fe_sec as $f) {
                                                        $id_secuencia = $f['id_secuencia'];
                                                        $fecha_entrega = $f['fecha_entrega'];

                                                        // Verificar si la fecha de registro es la actual
                                                        if ($fecha_entrega === $fecha) {
                                                            // Si es la fecha actual, usar el secuencial más reciente
                                                            $nuevo_secuencial = $id_secuencia;
                                                        } else {
                                                            // Si no es la fecha actual, sumar 1 al secuencial
                                                            $nuevo_secuencial = $id_secuencia + 1;
                                                        }
                                                ?>

                                                <input type="hidden" class="input2 form-control" name="secuencia[]"
                                                    value="<?php  echo $nuevo_secuencial; ?>" readonly>
                                                <?php } ?>
                                            </span>

                                        <!-- fin secuencial de psc en proceso -->

                                        <!-- inicio corrida de psc en proceso -->
                                            <!--td class="align-middle text-center" style="border: 1px solid #40497C"-->
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="hidden" class="input2 form-control" name="corrida[]" value="<?php  echo $ciclo; ?>" readonly>
                                                </span>
                                            <!--/td-->
                                        <!-- fin corrida de psc en proceso -->

                                        <!-- inicio cantidad sobrante en kilos valido -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <?php 
                                                    // Ejecutar la primera consulta
                                                    $sqlEgreso = "SELECT fecha_entrega, tipo_balanceado FROM egreso_balanceado 
                                                                WHERE camaronera = '$camaronera' 
                                                                AND id_piscina = '$psc' 
                                                                AND id_corrida = '$ciclo' 
                                                                AND id_secuencia = '$id_secuencia'";

                                                    $dataEgreso = $conectar->mostrar($sqlEgreso);

                                                    // Validar si no hay resultados en $dataEgreso
                                                    if (empty($dataEgreso)) {
                                                        // Si no hay resultados, mostrar 0.00 y continuar
                                                        $diferencia_cantidad = '0.00';
                                                    } else {
                                                        // Si hay resultados, proceder con el foreach
                                                        foreach ($dataEgreso as $abb) {
                                                            // Inicializar diferencia_cantidad para cada iteración
                                                            $diferencia_cantidad = '0.00';

                                                            $aabb = $abb['tipo_balanceado'];
                                                            $fecha_entrega = $abb['fecha_entrega'];

                                                            $sql = "SELECT * 
                                                                    FROM kardex_piscina 
                                                                    WHERE id_camaronera = '$camaronera' 
                                                                    AND id_piscina = '$psc' 
                                                                    AND id_corrida = '$ciclo' 
                                                                    AND tipo_balanceado_kardex = '$aabb'
                                                                    AND fecha_ingreso = '$fecha_entrega'";
                                                            
                                                            $data = $objeto->mostrar($sql);

                                                            if (!empty($data)) {
                                                                foreach ($data as $sob) { 
                                                                    if ($sob['saldo_actual'] === '0.00' || $sob['saldo_actual'] === NULL || $sob['saldo_actual'] === '') {
                                                                        $diferencia_cantidad = '0.00';
                                                                    } else {
                                                                        $diferencia_cantidad = $sob['saldo_actual'];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="text" class="form-control"
                                                        id="<?php echo 'saldo_actual_'.$key['id_piscina']; ?>"
                                                        name="saldo[]" 
                                                        value="<?php echo $diferencia_cantidad; ?>" 
                                                        readonly
                                                        placeholder="0.00"
                                                        style="background:none; width: 65px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;">
                                                </span>
                                            </td>
                                        <!-- fin cantidad sobrante en kilos valido -->

                                        <!-- inicio cantidad a solicitar en kilos -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="number" class="form-control" name="cantidades[]"
                                                        id="<?php echo 'cantidades_'.$key['id_piscina']; ?>" step="any"
                                                        placeholder="0.00"
                                                        style="background:none; width: 75px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;"
                                                        oninput="calculateDifference('<?php echo $key['id_piscina']; ?>')">
                                                </span>
                                            </td>
                                        <!-- fin cantidad a solicitar en kilos -->

                                        <!-- inicio tipo balanceado -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <select class="select" name="tipo_alimento[]"
                                                        id="tipo_alimento_<?php echo $psc; ?>"
                                                        onchange="handleSelectChange(this.value, <?php echo $psc; ?>)">
                                                        <option class="text-center" value="Sin balanceado">[Seleccione]</option>

                                                        <?php
                                                            $sqli = "SELECT k.fecha, k.tipo_balanceado, k.saldo
                                                                    FROM kardex k
                                                                    JOIN (
                                                                        SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id
                                                                        FROM kardex
                                                                        WHERE camaronera_id = '$camaronera'
                                                                        AND saldo > 0
                                                                        AND fecha >= DATE_SUB(CURDATE(), INTERVAL 35 DAY)
                                                                        GROUP BY tipo_balanceado
                                                                    ) max_ids
                                                                    ON k.tipo_balanceado = max_ids.tipo_balanceado
                                                                    AND k.kardex_id = max_ids.max_kardex_id
                                                                    WHERE k.saldo > 0
                                                                    AND k.fecha >= DATE_SUB(CURDATE(), INTERVAL 35 DAY)";

                                                            $balanceados = $objeto->mostrar($sqli);
                                                            foreach ($balanceados as $balanceado) { 
                                                                $sqli = "SELECT * FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento, ' ', gramaje_alimento) = '".$balanceado['tipo_balanceado']."' AND id_tipo_alimento = (SELECT MIN(id_tipo_alimento) FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento, ' ', gramaje_alimento) = '".$balanceado['tipo_balanceado']."')";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                        ?>
                                                        <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                            <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                        </option>
                                                        <?php } } ?>
                                                    </select>
                                                </span>
                                            </td>


                                        <!-- fin tipo balanceado -->

                                        <!-- inicio tipo aabb sobrante en kilos valido -->

                                            <?php 
                                                $sqlEgreso = "SELECT tipo_balanceado FROM egreso_balanceado WHERE camaronera = '$camaronera' AND id_piscina = '$psc' AND id_corrida = '$ciclo' AND id_secuencia = '$id_secuencia'";
                                                $dataEgreso = $conectar->mostrar($sqlEgreso);
                                                foreach($dataEgreso as $abb){
                                                    $aabb_mostrar = $abb['tipo_balanceado'];
                                            ?>
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <input type="hidden" class="form-control"
                                                    value="<?php echo $aabb_mostrar; ?>"
                                                    id="tipo_alimento_egreso_<?php echo $psc; ?>" name="tipo_alimento_saldo[]" readonly
                                                    style="background:none; width: 160px;">
                                            </span>
                                            <?php } ?>

                                        <!-- fin tipo aabb sobrante en kilos valido -->

                                        <!-- inicio cantidad despacho actual -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="text" class="form-control"
                                                        id="<?php echo 'despachos_'.$key['id_piscina']; ?>"
                                                        name="despachos[]" value="0.00" readonly placeholder="0.00"
                                                        style="background:none; width: 75px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;">
                                                </span>
                                            </td>
                                            
                                        <!-- fin cantidad despacho actual -->

                                        <!-- Inicio datos de identificacion de camaronera, encargado y descripcion -->

                                            <input type="hidden" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>">
                                            <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                                            <input type="hidden" name="desc" value="<?php echo 'Consumo piscina'; ?>">
                                            <input type="hidden" name="id" value="<?php echo 'Piscina'; ?>">

                                        <!-- Fin datos de identificacion de camaronera, encargado y descripcion -->

                                        <?php } ?>

                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-3">

                    <div class="alert text-center" role="alert" style="background: #404e67; border: solid 2px white; color:white;">
                        <h6><b>Sobrantes a considerar</b></h6>
                    </div>

                    <table class="table table-sm" style="margin-top:-15px;">

                        <thead>
                            <tr class="text-center">

                                <th class="text-white text-xxs font-weight-bolder opacity-7"
                                    style="background: #404e67; border: solid 2px white;">#</br>Psc
                                </th>

                                <th class="text-white text-xxs font-weight-bolder opacity-7"
                                    style="background: #404e67; border: solid 2px white;">Cantidad </br> sobrante
                                </th>

                                <th class="text-white text-xxs font-weight-bolder opacity-7"
                                    style="background: #404e67; border: solid 2px white;">Tipo </br> de balanceado
                                </th>

                            </tr>
                        </thead>

                        <?php
                            $sql = "SELECT DISTINCT(id_piscina), id_corrida  FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_piscina";
                            $data = $conectar->mostrar($sql);
                            foreach ($data as $key) :
                                $psc = $key['id_piscina']; 
                                $ciclo = $key['id_corrida']; 
    
                                // Inicializamos $diferencia_cantidad en 0.00 por defecto
                                $diferencia_cantidad = '0.00';
    
                                // Consulta para obtener la información de egreso balanceado
                                $sqlEgreso = "SELECT fecha_entrega, tipo_balanceado FROM egreso_balanceado WHERE camaronera = '$camaronera' AND id_piscina = '$psc' AND id_corrida = '$ciclo' AND id_secuencia = '$id_secuencia'";
                                $dataEgreso = $conectar->mostrar($sqlEgreso);
    
                                foreach($dataEgreso as $abb):
                                    $aabb = $abb['tipo_balanceado'];
                                    $fecha_entrega = $abb['fecha_entrega'];
    
                                    // Consulta para obtener el saldo actual
                                    $sql = "SELECT * 
                                            FROM kardex_piscina 
                                            WHERE id_camaronera = '$camaronera' 
                                            AND id_piscina = '$psc' 
                                            AND id_corrida = '$ciclo' 
                                            AND tipo_balanceado_kardex = '$aabb'
                                            AND fecha_ingreso = '$fecha_entrega'";
                                    $data = $objeto->mostrar($sql);
    
                                    if (!empty($data)) {
                                        foreach($data as $sob):
                                            if ($sob['saldo_actual'] !== '0.00' && $sob['saldo_actual'] !== NULL && $sob['saldo_actual'] !== '') {
                                                $diferencia_cantidad = $sob['saldo_actual'];
                                                $tipo_balanceado_kardex = $sob['tipo_balanceado_kardex'];
                                            }
                                        endforeach;
                                    }
                                endforeach;
    
                                // Solo mostramos las piscinas donde $diferencia_cantidad es mayor a 0.00
                                if ($diferencia_cantidad > 0.00) {
                        ?>

                        <tbody class="untiltime">
                            <tr>
                                <!-- inicio piscina en proceso -->
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php if($camaronera == 2){ if($key['id_piscina'] == 22  OR $key['id_piscina'] == 24 ){  if($key['id_piscina'] == 22 ){ echo '17B'; }else{ echo '15B'; } }else{ echo $key['id_piscina']; } }else{ echo $key['id_piscina']; } ?>
                                        </span>
                                    </td>
                                <!-- fin  piscina en proceso -->

                                <!-- inicio cantidad sobrante en kilos valido -->
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php echo $diferencia_cantidad; ?>
                                        </span>
                                    </td>
                                <!-- fin cantidad sobrante en kilos valido -->

                                <!-- inicio tipo aabb sobrante en kilos valido -->
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php echo $tipo_balanceado_kardex; ?>
                                        </span>
                                    </td>

                                <!-- fin tipo aabb sobrante en kilos valido -->
                            </tr>

                            <?php } endforeach; ?>

                        </tbody>

                    </table>

                    <div id="mensaje" style="color: red; display: none;"></div> <!-- Mensaje que se mostrará si hay saldo negativo -->
                    <button type="submit" class="btn btn-sm mt-1 text-center add-egreso" id="add-egres"
                        style="background:#4785e3; color:white;">Generar solicitud de engorde
                    </button>
                    


                    <table class="table table-responsive mt-3"><hr><strong><p style="color:#076808;">Simulador de balanceado disponible en bodega.<p></strong>
                        <thead>
                            <tr>
                            <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Balanceado</th>
                            <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Saldo (kg)</th>
                            <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Solicitado (kg)</th>
                            <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Disponible (kg)</th>
                            </tr>
                        </thead>
                            <?php
                            
                                $sqli = "SELECT k.fecha, k.tipo_balanceado, k.saldo FROM kardex k JOIN ( SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id FROM kardex WHERE camaronera_id = '$camaronera' AND saldo >= 0 AND fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) GROUP BY tipo_balanceado ) max_ids
                                        ON k.tipo_balanceado = max_ids.tipo_balanceado
                                        AND k.kardex_id = max_ids.max_kardex_id
                                        WHERE k.saldo >= 0
                                        AND k.fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)";
                                        $balanceados = $objeto->mostrar($sqli);
                                        foreach ($balanceados as $balanceado) { 
                                            $sqli = "SELECT * FROM `tipo_alimento` 
                                                    WHERE CONCAT(descripcion_alimento, ' ', gramaje_alimento) = '".$balanceado['tipo_balanceado']."' AND id_tipo_alimento = ( SELECT MIN(id_tipo_alimento) FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento, ' ', gramaje_alimento) = '".$balanceado['tipo_balanceado']."')";
                                            $data = $objeto->mostrar($sqli);
                                                foreach ($data as $value) { ?>
                                                    <tbody>
                                                        <tr class="text-center">
                                                            <td id="balanceado_disponible_<?php echo $value['id_tipo_alimento']; ?>">
                                                                <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                            </td>
                                                            <td id="saldo_actual_disponible_<?php echo $value['id_tipo_alimento']; ?>">
                                                                <?php echo $balanceado['saldo'] * 25; ?>
                                                            </td>
                                                            <td id="despacho_<?php echo $value['id_tipo_alimento']; ?>">0.00</td> <!-- Aquí se mostrará el valor acumulado -->
                                                            <td id="disponible_<?php echo $value['id_tipo_alimento']; ?>">0.00</td> <!-- Aquí se mostrará la diferencia -->
                                                        </tr>
                                                    </tbody>
                            <?php } } ?>

                        </tbody>
                    </table>

                    

     
                </div>

            </div>

        </form>
        <hr>
    
    </div>
    

    <?php
        // Consulta SQL para obtener los datos del kardex
        $sqlKardex = "SELECT k.*, (k.saldo * 25) AS saldo_kg FROM kardex k 
       JOIN ( SELECT tipo_balanceado, MAX(kardex_id) AS max_id FROM kardex 
       WHERE camaronera_id = '$camaronera' 
       AND saldo >= 0 AND fecha >= CURDATE() - INTERVAL 10 DAY 
       GROUP BY tipo_balanceado ) AS subquery 
       ON k.kardex_id = subquery.max_id 
       WHERE k.camaronera_id = '$camaronera' AND (k.saldo * 25) >= 0 
       ORDER BY k.tipo_balanceado";

        // Ejecutar la consulta
        $data = $conectar->mostrar($sqlKardex);
        
        // Convertir los resultados en JSON para poder ser utilizados en el script JS
        echo "<script>const datosBalanceados = " . json_encode($data) . ";</script>";
    ?>


    <script>

        // inicio Función para capturar el valor seleccionado cada vez que se cambia

            let acumulados = {};

            function handleSelectChange(selectedValue, psc) {
                // Buscar el elemento de la fila correspondiente al tipo de alimento
                const balanceadoDisponible = document.getElementById("balanceado_disponible_" + selectedValue);
                const saldoActualDisponible = document.getElementById("saldo_actual_disponible_" + selectedValue);
                
                // Buscar el input de despacho correspondiente al id_piscina
                const despachoInput = document.getElementById("despachos_" + psc);

                // Buscar la celda de despacho en la fila correspondiente
                const despachoCell = document.getElementById("despacho_" + selectedValue);

                // Buscar la celda para mostrar la diferencia
                const disponibleCell = document.getElementById("disponible_" + selectedValue);

                // Obtener el valor del despacho del input
                let despachoValue = parseFloat(despachoInput.value);

                if (balanceadoDisponible && saldoActualDisponible && despachoInput) {
                    // Verificar si el tipo de balanceado ya existe en el objeto acumulados
                    if (!acumulados[selectedValue]) {
                        acumulados[selectedValue] = 0;  // Inicializar si no existe
                    }

                    // Calcular la diferencia entre saldo y despacho antes de acumular
                    let saldoDisponible = parseFloat(saldoActualDisponible.innerText);
                    let diferencia = saldoDisponible - acumulados[selectedValue] - despachoValue;

                    // Verificar si el acumulado es mayor que el saldo disponible
                    if (acumulados[selectedValue] + despachoValue > saldoDisponible) {
                        alert("No tiene balanceado disponible del " + balanceadoDisponible.innerText );
                        return; // Detener la ejecución y no continuar
                    }

                    // Sumar el valor actual al acumulado
                    acumulados[selectedValue] += despachoValue;

                    // Actualizar el valor de la celda de despacho con el valor acumulado
                    if (despachoCell) {
                        despachoCell.textContent = acumulados[selectedValue].toFixed(2); // Mostrar con dos decimales
                    }

                    // Actualizar la celda para mostrar la diferencia
                    if (disponibleCell) {
                        disponibleCell.textContent = diferencia.toFixed(2); // Mostrar la diferencia con dos decimales

                        // Cambiar el color de fondo de la celda dependiendo de la diferencia
                        if (diferencia >= 0) {
                            disponibleCell.style.backgroundColor = '#259c44'; // Pintar de verde si la diferencia es positiva
                            disponibleCell.style.color = 'white'; // Pintar de verde si la diferencia es positiva
                        } else {
                            disponibleCell.style.backgroundColor = 'white'; // Pintar de verde si la diferencia es positiva
                            disponibleCell.style.color = 'black'; // Pintar de verde si la diferencia es positiva
                        }
                    }

                    // Mostrar los valores en una alerta (opcional)
                    /*alert("Descripción: " + balanceadoDisponible.innerText + 
                        "\nSaldo actual: " + saldoActualDisponible.innerText + 
                        "\nValor acumulado del despacho: " + acumulados[selectedValue].toFixed(2) + 
                        "\nDiferencia: " + diferencia.toFixed(2));*/

                } else {
                    // Si no coincide, muestra un mensaje indicando que no hay coincidencia
                    alert("El balanceado seleccionado no esta disponible, comuniquese con el administrador");
                }
            }

        // Fin Función para capturar el valor seleccionado cada vez que se cambia

        // Inicio Calcular la diferencia entre cantidad y saldo
            function calculateDifference(psc) {
                const cantidadInput = document.getElementById('cantidades_' + psc);
                const saldoActualInput = document.getElementById('saldo_actual_' + psc);
                const despachosInput = document.getElementById('despachos_' + psc);
                const botonEgreso = document.getElementById('add-egres'); // Obtener el botón
                const mensaje = document.getElementById('mensaje'); // Obtener el elemento para el mensaje

                // Validar que los inputs se obtienen correctamente
                if (!cantidadInput || !saldoActualInput || !despachosInput) {
                    console.error('Input elements not found for PSC:', psc);
                    return;
                }

                const cantidad = parseFloat(cantidadInput.value) || 0;
                const saldoActual = parseFloat(saldoActualInput.value) || 0;

                let diferencia = cantidad - saldoActual;
                

                // Si la diferencia es negativa, mostrar 0 en despachosInput
                if (diferencia < 0) {

                    diferencia = 0;
                    saldoActualInput.style.backgroundColor = 'rgba(254, 178, 99)';
                    saldoActualInput.style.color = 'rgba(1, 4, 0)';
                    despachosInput.style.backgroundColor = 'rgba(252, 98, 98)';
                    despachosInput.style.color = 'rgba(255, 255, 255)';

                } else {
                    // Si la diferencia es positiva o 0, mostrarla en despachosInput y estilos neutros
                    saldoActualInput.style.backgroundColor = 'transparent';
                    saldoActualInput.style.color = 'black';
                    despachosInput.style.backgroundColor = 'transparent';
                    despachosInput.style.color = 'black';
                }

                despachosInput.value = diferencia.toFixed(2); // Mostrar diferencia ajustada a dos decimales
                
            }

        // Fin Calcular la diferencia entre cantidad y saldo

        // Inicio Función para mostrar el botón solo entre las 05:00 AM y 09:00 AM (hora de Ecuador)
            function toggleButtonVisibility() {
                // Obtener la hora actual en la zona horaria de Ecuador (GMT-5)
                const now = new Date();
                const currentHour = now.getUTCHours() - 5; // UTC -5 para Ecuador
                
                const button = document.getElementById('add-egres');
                const message = document.getElementById('habilitado'); // Obtener el elemento de mensaje

                // Si la hora está entre las 05:00 AM y las 09:00 AM, mostrar el botón
                if (currentHour >= 5 && currentHour < 19) {
                    button.style.display = 'block';
                    message.style.display = 'none'; // Ocultar mensaje
                } else {
                    button.style.display = 'none';
                    message.style.display = 'block'; // Mostrar mensaje
                }
            }

            // Ejecutar la función al cargar la página
            window.onload = toggleButtonVisibility;

            // Comprobar cada minuto si el botón debe estar visible
            setInterval(toggleButtonVisibility, 60000); // 60000 ms = 1 minuto
        // Fin Función para mostrar el botón solo entre las 05:00 AM y 09:00 AM (hora de Ecuador)

    </script>


    <style>
        .custom-alert {
            display: none;
            position: fixed;
            top: 128px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f44336;
            color: white;
            padding: 15px;
            border-radius: 10px;
            z-index: 99999;
        }
    </style>