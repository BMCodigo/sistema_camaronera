<?php
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    date_default_timezone_set("America/Guayaquil");
    $fecha = date('Y-m-d');
    
?>


<div class="card">
    <div class="card-header" style="background: #404e67;">
        <h6 class="text-white" style="margin:auto;">SOLICITUD DE BALANCEADO DEL <strong class="badge" style="background:#4785e3; color:white;"><?php echo $fecha; ?></strong> PARA PRECRIA</h6>
        <ul class="time-horizontal nav justify-content-center">
        </ul>
    </div>


    <div class="container d-flex justify-content-center mt-3">
        <a href="index.php?page=solicitud-engorde" type="button" class="btn text-dark" style="background: #f8965a;"><strong>¿ Generar solicitud de engorde ?</strong></a>
    </div>
    <div class="container d-flex justify-content-center mt-3">
        <p id="habilitado" style="display:none; color:red;"><strong>La solicitud para precria se habilita de 05:00 AM a 09:00 AM</strong></p>
    </div>

    <div class="row mr-2">
        <!-- SOLICITUD PARA PISICINA -->
        <form class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="FormSolicitud"
            action="../controllers/insert-solicitud-biologo-precria.php" method="POST">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 mt-1">
                    <div class="table table-sm table-responsive">
                        <div class="scroll">
                            <table class="table table-sm table-bordered align-items-center mb-0">

                                <thead>
                                    <tr class="text-center">

                                        <!--th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Fecha </br> de Solicitud
                                        </th-->

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">#</br>Precria
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
    
                                        $sql = "SELECT DISTINCT(id_precria), identificacion  FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_precria";
                                        $data = $conectar->mostrar($sql);
                                        foreach ($data as $key) {
                                            $psc = $key['id_precria']; 
                                            $ciclo = $key['identificacion']; 
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
                                            <td class="align-middle text-center"
                                                style="border: 1px solid #40497C; padding: 1px; height: -5%; width: 10%;">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="text" class="input2 form-control" name="id_piscina[]"
                                                        value="<?php  echo $key['id_precria'];  ?>"
                                                        readonly
                                                        style="background:none; width: 35px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;">
                                                </span>

                                            </td>
                                        <!-- fin  piscina en proceso -->

                                        <!-- inicio secuencial de psc en proceso -->

                                            <span class="text-secondary text-xs font-weight-bold">

                                                    <?php
            
                                                        $sql_fe_sec = "SELECT MAX(id_secuencia) AS id_secuencia, MAX(fecha_entrega) AS fecha_entrega  FROM solicitud_balanceados WHERE camaronera = '$camaronera' /*AND id_piscina = '$psc' AND id_corrida = '$ciclo' */ AND id IN ('Piscina')";
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
                                                    <input type="hidden" class="input2 form-control" name="secuencial[]" value="<?php  echo $nuevo_secuencial; ?>" readonly>
                                                    <?php } ?>
                                            </span>

                                        <!-- fin secuencial de psc en proceso -->

                                        <!-- inicio corrida de psc en proceso -->
                                        <!--td class="align-middle text-center" style="border: 1px solid #40497C"-->
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <input type="hidden" class="input2 form-control" name="id_corrida[]"
                                                    value="<?php  echo $ciclo; ?>" readonly>
                                            </span>
                                        <!--/td-->
                                        <!-- fin corrida de psc en proceso -->

                                        <!-- inicio cantidad sobrante en kilos valido -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <?php 
            
                                                    $sqlEgreso = "SELECT fecha_entrega, tipo_balanceado FROM egreso_balanceado WHERE camaronera = '$camaronera' AND id_piscina = '$psc' AND id_corrida = '$ciclo' AND id_secuencia = '$id_secuencia'";
                                                    $dataEgreso = $conectar->mostrar($sqlEgreso);

                                                    foreach($dataEgreso as $abb){

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
                                                            foreach($data as $sob){ 
                                                                // Check if saldo_actual is 0.00 or empty
                                                                if ($sob['saldo_actual'] === '0.00' || $sob['saldo_actual'] === NULL || $sob['saldo_actual'] === '') {
                                                                    $diferencia_cantidad = '0.00';
                                                                    $sob['fecha_ingreso'];
                                                                } else {
                                                                    $diferencia_cantidad = $sob['saldo_actual'];
                                                                    $sob['fecha_ingreso'];
                                                                }
                                                            }
                                                        } else {
                                                            $diferencia_cantidad = '0.00';
                                                            $sob['fecha_ingreso'];
                                                        }
                                                    }
                                                ?>

                                                <span class="text-secondary text-xs font-weight-bold">

                                                    <input type="text" class="form-control"
                                                        id="<?php echo 'saldo_actual_'.$key['id_precria']; ?>"
                                                        name="cantidad_sobrante[]"
                                                        value="<?php echo $diferencia_cantidad; ?>" readonly
                                                        placeholder="0.00"
                                                        style="background:none; width: 65px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;">

                                                </span>

                                            </td>
                                        <!-- fin cantidad sobrante en kilos valido -->

                                        <!-- inicio cantidad a solicitar en kilos -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="number" class="form-control" name="cantidad_solicitada[]"
                                                        id="<?php echo 'cantidades_'.$key['id_precria']; ?>" step="any"
                                                        placeholder="0.00"
                                                        style="background:none; width: 75px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;"
                                                        oninput="calculateDifference('<?php echo $key['id_precria']; ?>')">
                                                </span>
                                            </td>
                                        <!-- fin cantidad a solicitar en kilos -->

                                        <!-- inicio tipo balanceado -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <select class="select" name="tipo_alimento[]"
                                                        id="tipo_alimento_<?php echo $psc; ?>"
                                                        onchange="handleSelectChange(<?php echo $psc; ?>)">
                                                        <option class="text-center" value="Sin balanceado">[Seleccione]
                                                        </option>

                                                        <?php
                                    
                                                                    $sqli = "SELECT k.*, (k.saldo * 25) AS saldo_kg
                                                                    FROM kardex k
                                                                    JOIN (
                                                                        SELECT tipo_balanceado, MAX(kardex_id) AS max_id
                                                                        FROM kardex
                                                                        WHERE camaronera_id = '$camaronera'
                                                                        AND saldo > 0
                                                                        AND fecha >= CURDATE() - INTERVAL 10 DAY
                                                                        GROUP BY tipo_balanceado
                                                                    ) AS subquery
                                                                    ON k.kardex_id = subquery.max_id
                                                                    WHERE k.camaronera_id = '$camaronera'
                                                                    AND (k.saldo * 25) > 0
                                                                    ORDER BY k.tipo_balanceado";

                                                                    $data = $objeto->mostrar($sqli);
                                                                    foreach ($data as $value) { ?>
                                                        <option class="text-center"
                                                            value="<?php echo $value['tipo_balanceado']; ?>">
                                                            <?php echo $value['tipo_balanceado']; ?>
                                                        </option>
                                                        <?php } ?>
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
                                                    id="tipo_alimento_egreso_<?php echo $psc; ?>"
                                                    name="tipo_alimento_saldo[]" readonly
                                                    style="background:none; width: 160px;">
                                            </span>
                                            <?php } ?>

                                        <!-- fin tipo aabb sobrante en kilos valido -->

                                        <!-- inicio cantidad despacho actual -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="text" class="form-control"
                                                        id="<?php echo 'despachos_'.$key['id_precria']; ?>"
                                                        name="cantidad_despacho[]" value="0.00" readonly placeholder="0.00"
                                                        style="background:none; width: 75px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;">
                                                </span>
                                            </td>
                                        <!-- fin cantidad despacho actual -->

                                        <!-- Inicio datos de identificacion de camaronera, encargado y descripcion -->

                                            <input type="hidden" name="encargado"
                                                value="<?php echo $nombre . ' ' . $apellido; ?>">
                                            <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                                            <input type="hidden" name="descripcion"
                                                value="<?php echo 'Consumo precria'; ?>">
                                            <input type="hidden" name="id" value="<?php echo 'Precria'; ?>">

                                        <!-- Fin datos de identificacion de camaronera, encargado y descripcion -->

                                        <?php } ?>

                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-3">

                    <div class="alert text-center" role="alert"
                        style="background: #404e67; border: solid 2px white; color:white;">
                        <h6><b>Sobrantes a considerar</b></h6>
                    </div>

                    <table class="table table-sm" style="margin-top:-15px;">

                        <thead>
                            <tr class="text-center">

                                <th class="text-white text-xxs font-weight-bolder opacity-7"
                                    style="background: #404e67; border: solid 2px white;">#</br>Precria
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
                            $sql = "SELECT DISTINCT(id_precria), identificacion  FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_precria";
                            $data = $conectar->mostrar($sql);
                            foreach ($data as $key) :
                                $psc = $key['id_precria']; 
                                $ciclo = $key['identificacion']; 
    
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
                                            <?php echo $key['id_precria'];  ?>
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

                    <div id="mensaje" style="color: red; display: none;"></div>
                    <!-- Mensaje que se mostrará si hay saldo negativo -->
                    <button type="submit" class="btn btn-sm mt-1 text-center add-egreso" id="add-egres"
                        style="background:#4785e3; color:white;">Generar solicitud de preria
                    </button>
                    


                    <!--table class="table table-responsive mt-3">
                        <thead>
                            <tr>
                            <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Balanceado</th>
                            <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Saldo</th>
                            <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Solicitado</th>
                            <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Disponible</th>
                            </tr>
                        </thead>
                            <?php
                            
                                $sqlKardex = "SELECT k.*, (k.saldo * 25) AS saldo_kg
                                FROM kardex k
                                JOIN (
                                    SELECT tipo_balanceado, MAX(kardex_id) AS max_id
                                    FROM kardex
                                    WHERE camaronera_id = '$camaronera'
                                    AND saldo > 0
                                    AND fecha >= CURDATE() - INTERVAL 10 DAY
                                    GROUP BY tipo_balanceado
                                ) AS subquery
                                ON k.kardex_id = subquery.max_id
                                WHERE k.camaronera_id = '$camaronera'
                                AND (k.saldo * 25) > 0
                                ORDER BY k.tipo_balanceado";
                                $data = $conectar->mostrar($sqlKardex);

                            ?>
                        <tbody>
                            <?php foreach ($data as $k): ?>
                            <tr class="text-center">
                                <th id="balanceado_disponoble"><?php echo $k['tipo_balanceado'];?></th>
                                <td id="saldo_actual_disponible"><?php echo $k['saldo_kg'];?></td>
                                <td id="solicitado"></td>
                                <td id="disponible"></td>
                            </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table-->

     

                </div>



            </div>

        </form>
        <hr>

    </div>





    <?php
        // Consulta SQL para obtener los datos del kardex
        $sqlKardex = "SELECT k.*, (k.saldo * 25) AS saldo_kg
                    FROM kardex k
                    JOIN (
                        SELECT tipo_balanceado, MAX(kardex_id) AS max_id
                        FROM kardex
                        WHERE camaronera_id = '$camaronera'
                        AND saldo > 0
                        AND fecha >= CURDATE() - INTERVAL 10 DAY
                        GROUP BY tipo_balanceado
                    ) AS subquery
                    ON k.kardex_id = subquery.max_id
                    WHERE k.camaronera_id = '$camaronera'
                    AND (k.saldo * 25) > 0
                    ORDER BY k.tipo_balanceado";

        // Ejecutar la consulta
        $data = $conectar->mostrar($sqlKardex);
        
        // Convertir los resultados en JSON para poder ser utilizados en el script JS
        echo "<script>const datosBalanceados = " . json_encode($data) . ";</script>";
    ?>


    <script>
        // inicio Función para capturar el valor seleccionado cada vez que se cambia
            function handleSelectChange(psc) {
                const tipoAlimentoSelect = document.getElementById('tipo_alimento_' + psc);
                const cantidadInput = document.getElementById('cantidades_' + psc);
                const despachosInput = document.getElementById('despachos_' + psc);

                /*if (cantidadInput) {
                    // Actualiza el valor del despacho
                    despachosInput.value = parseFloat(cantidadInput.value).toFixed(2);
                }*/

                // Llama a la función para sumar totales
                sumarTotalesPorTipoAlimento();

                // Llama a calculateDifference después de actualizar los despachos
                calculateDifference(psc);
            }
        // Fin Función para capturar el valor seleccionado cada vez que se cambia

        // Inicio Función para sumar los totales de los despachos por cada tipo de alimento seleccionado
            function sumarTotalesPorTipoAlimento() {
                const selects = document.querySelectorAll('select[name="tipo_alimento[]"]');
                const despachos = {};

                selects.forEach(function(select) {
                    const tipoAlimento = select.value;
                    const psc = select.id.split('_')[2];
                    const despachoInput = document.getElementById('despachos_' + psc);

                    console.log(`Tipo de alimento: ${tipoAlimento}, PSC: ${psc}, Despachos: ${despachoInput.value}`);

                    if (tipoAlimento !== 'Sin balanceado') {
                        const cantidadDespacho = parseFloat(despachoInput.value) || 0;

                        if (!despachos[tipoAlimento]) {
                            despachos[tipoAlimento] = 0;
                        }
                        despachos[tipoAlimento] += cantidadDespacho;
                    }
                });

                console.log('Despachos acumulados:', despachos);
                actualizarTablaDespachos(despachos, datosBalanceados);
            }
        // Fin Función para sumar los totales de los despachos por cada tipo de alimento seleccionado

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

        // Inicio Actulizar datos de la tabla simulador
            /*function actualizarTablaDespachos(despachos, datosBalanceados) {
                const tablaDespachos = document.getElementById('tablaDespachos');

                const botonEgreso = document.getElementById('add-egres'); // Obtener el botón
                const mensaje = document.getElementById('mensaje'); // Obtener el elemento para el mensaje
                tablaDespachos.innerHTML = ''; // Limpiamos el contenido previo de la tabla

                const encabezado = `
                            <thead style="background: #404e67; border: solid 2px white;">
                                <tr>
                                    <th class="text-white">Tipo de Balanceado</th>
                                    <th class="text-white">Disponible</th>
                                    <th class="text-white">Solicitado</th>
                                    <th class="text-white">Saldo Actual</th>
                                </tr>
                            </thead>
                        `;
                tablaDespachos.innerHTML += encabezado;

                let cuerpoTabla = '<tbody>';
                let saldoNegativo = false; // Variable para verificar saldos negativos

                for (const tipo in despachos) {
                    // Encontrar el saldo correspondiente al tipo de alimento
                    const itemBalanceado = datosBalanceados.find(item => item.tipo_balanceado === tipo);

                    // Si no se encuentra el item correspondiente, asigna saldo 0
                    const saldo = itemBalanceado ? parseFloat(itemBalanceado.saldo_kg) : 0;

                    // Calcular la diferencia: Saldo Actual - Total Despachado
                    const totalDespachado = despachos[tipo] || 0;
                    const saldoActualizado = saldo - totalDespachado; // Este es el nuevo saldo

                    console.log(
                        `Tipo: ${tipo}, Total Despachado: ${totalDespachado}, Saldo: ${saldo}, Saldo Actualizado: ${saldoActualizado}`
                        );

                    // Determina el estilo del saldo actualizado
                    const saldoColor = saldoActualizado < 0 ? 'color: white; background: #fd4949;' :
                        'color: white; background: #52ba54;';

                    // Verifica si hay saldo negativo
                    if (saldoActualizado < 0) {
                        saldoNegativo = true; // Hay al menos un saldo negativo
                    }

                    // Asegúrate de que el saldo es un número antes de usar toFixed
                    const fila = `
                                <tr class="text-center">
                                    <td>${tipo}</td>
                                    <td>${saldo.toFixed(2)}</td>
                                    <td>${totalDespachado.toFixed(2)}</td>
                                    <td style="${saldoColor}">${saldoActualizado.toFixed(2)}</td> 
                                </tr>
                            `;
                    cuerpoTabla += fila;
                }
                cuerpoTabla += '</tbody>';
                tablaDespachos.innerHTML += cuerpoTabla;

                // Mostrar el mensaje o el botón según el saldo negativo
                if (saldoNegativo) {
                    mensaje.innerHTML =
                    "<strong>No puede generar SOLICITUD, por favor revise su STOCK.</strong>"; // Mensaje de error
                    mensaje.style.display = 'block'; // Mostrar el mensaje
                    botonEgreso.style.display = 'none'; // Oculta el botón
                } else {
                    mensaje.style.display = 'none'; // Ocultar el mensaje
                    botonEgreso.style.display = 'block'; // Muestra el botón
                }
            }*/

        // Fin Actulizar datos de la tabla simulador

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