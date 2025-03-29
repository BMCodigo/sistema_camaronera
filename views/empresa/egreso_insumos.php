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
        <h6 class="text-white" style="margin:auto;">SOLICITUD DE INSUMOS DEL <strong class="badge" style="background:#4785e3; color:white;"><?php echo $fecha; ?></strong> PARA ENGORDE </h6>
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

  

    <div class="row container" style="margin-left: 15px;">



        <div class="col-md-3">
            <label for="producto" class="col-sm-4 col-form-label">Familia</label>
                <select class="form-control" id="familia" name="familia[]" onchange="updateProductos()">
                    <option value="">[Seleccione categoria]</option>
                    <?php
                    $sql = "SELECT DISTINCT(codigoCuenta) AS codigoCuenta  ,
                                CASE
                                    WHEN id_camaronera = 1 THEN 
                                        CASE 
                                        
                                            WHEN codigoCuenta = 36 THEN 'Fertilizantes'
                                            WHEN codigoCuenta = 37 THEN 'Reguladores Suelo y Agua'
                                            WHEN codigoCuenta = 38 THEN 'Otras Materias Primas'
                                            WHEN codigoCuenta = 1743 THEN 'Bacterias'
                                            WHEN codigoCuenta = 1744 THEN 'Desparasitantes'
                                            WHEN codigoCuenta = 1745 THEN 'Peroxido'
                                            WHEN codigoCuenta = 1746 THEN 'Antibioticos'

                                        END
                                    WHEN id_camaronera = 2 THEN 
                                        CASE 
                                            
                                            WHEN codigoCuenta = 1036 THEN 'Reguladores Suelo y Agua'
                                            WHEN codigoCuenta = 1329 THEN 'Fertilizantes'
                                            WHEN codigoCuenta = 1330 THEN 'Bacterias'
                                            WHEN codigoCuenta = 1331 THEN 'Otras Materias Primas'
                                            WHEN codigoCuenta = 1332 THEN 'Peroxido'
                                            WHEN codigoCuenta = 1333 THEN 'Desparasitantes'
                                            WHEN codigoCuenta = 1334 THEN 'Antibioticos'
                                        END
                                    WHEN id_camaronera = 3 THEN 
                                        CASE 
                                            
                                            WHEN codigoCuenta = 1169 THEN 'Reguladores Suelo y Agua'
                                        
                                        END

                                END AS descripcionFamilia

                    FROM familiascuentacontable  WHERE id_camaronera = '$camaronera' AND codigoCuenta IN ('36','37','38','1743','1744','1745','1746', '1329', '1036', '1331', '1330', '1333', '1332', '1334', '1169')";
                    $data = $conectar->mostrar($sql);
                    foreach ($data as $value) { ?>
                        <option value="<?php echo $value['codigoCuenta']; ?>"><?php echo $value['descripcionFamilia']; ?></option>
                    <?php } ?>
                </select>
        </div>


        <div class="col-md-3">
            <label for="producto" class="col-sm-4 col-form-label">Producto</label>
            <?php
            $sql_tabla_productos = "SELECT DISTINCT(DescripcionCorta) AS producto, ProductoId
                                    FROM comprasfacturasaquapro 
                                    WHERE id_camaronera = '$camaronera' 
                                    AND CodigoCuentaContable IN ('36','37','38','1743','1744','1745','1746', '1329', '1036', '1331', '1330', '1333', '1332', '1334', '1169')";
            $data_productos = $conectar->mostrar($sql_tabla_productos);
            ?>

            <select class="form-control" id="producto" name="producto">
                <option value="">[Seleccione producto]</option>
                <?php foreach ($data_productos as $value) { ?>
                    <option value="<?php echo $value['producto']; ?>" 
                            data-producto-id="<?php echo $value['ProductoId']; ?>">
                        <?php echo $value['producto']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <input type="hidden" class="form-control" name="" id="medida" readonly>


    </div>

 

    <div class="row mr-2 mt-3" style="margin-left: 25px;">

    
        <!-- SOLICITUD PARA PISICINA -->
            <form id="form-insert-run" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" action="../controllers/insert-egreso-bodega-producto.php" method="POST">
            
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 ">
                    <div class="table table-sm table-responsive">
                        <div class="scroll">
                            <table class="table table-sm table-bordered align-items-center mb-0">

                                <thead>
                                    <tr class="text-center">

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">#</br>Psc
                                        </th>

                                        <th class=" text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Tipo de <br> producto
                                        </th>

                                        <th class="text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Cantidad </br> solicitada (<span id="medida" class="text-success"></span>)
                                        </th>

                                        <th class="text-white text-xxs font-weight-bolder opacity-7"
                                            style="background: #404e67;">Und. medida </br> Conversion en (<span id="medida_conversion" class="text-success"></span>)
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
                                            <td class="align-middle text-center" style="border: 1px solid #40497C; padding: 1px; height: -2%; width: 50px;">
                                                <span class="text-secondary text-xs font-weight-bold"><?php  echo $key['id_piscina'];  ?>
                                                    
                                                    <input type="hidden" class="input2 form-control" name="piscina[]"
                                                        value="<?php  echo $key['id_piscina'];  ?>"
                                                        readonly
                                                        style="background:none; width: 35px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;">
                                                        
                                                </span>

                                            </td>
                                        <!-- fin  piscina en proceso -->

                                        <!-- inicio secuencial de psc en proceso -->

                                            <span class="text-secondary text-xs font-weight-bold" >
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


                                        <!-- inicio tipo balanceado -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C; padding: 1px; height: -2%; width: 50px;">
                                                <span class="text-secondary text-xs font-weight-bold" id="insumo">
                                                    </span>
                                                    <input type="hidden" class="form-control" name="insumo[]" id="insumo">
                                                    <input type="hidden" class="form-control" name="" id="medida">
                                                    <input type="hidden" name="productoIdHidden[]" id="productoIdHidden">
                                            </td>
                                        <!-- fin tipo balanceado -->

                                        <!-- inicio cantidad a solicitar en kilos -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C; padding: 1px; height: -2%; width: 50px;">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="number" class="form-control" name="cantidades[]"
                                                        id="cantidades_<?php echo $key['id_piscina']; ?>" step="any"
                                                        placeholder="0.00"
                                                        style="background:none; width: 75px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;"
                                                        oninput="calculateDifference('<?php echo $key['id_piscina']; ?>')">
                                                </span>
                                            </td>

                                        <!-- fin cantidad a solicitar en kilos -->

                                        <!-- inicio cantidad a solicitar en kilos -->
                                            <td class="align-middle text-center" style="border: 1px solid #40497C; padding: 1px; height: -2%; width: 50px;">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <input type="text" class="form-control" name="conversion[]"
                                                        id="conversion_<?php echo $key['id_piscina']; ?>" step="any"
                                                        placeholder="0.00"
                                                        style="background:none; width: 75px; text-align:center; border:none; outline:none; margin: 0 auto; display: block;" readonly>
                                                </span>
                                            </td>
                                        <!-- fin cantidad a solicitar en kilos -->

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

                

                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 mt-1">

                    <button type="submit" class="btn btn-sm mt-1 text-center add-egreso" id="add-egres"
                        style="background:#4785e3; color:white;">Generar solicitud de insumo para engorde
                    </button>

                    <table class="table table-responsive mt-3"><hr><strong><p style="color:#076808;">Simulador de insumos disponible en bodega.<p></strong>
                        <thead>
                            <tr>
                                <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Producto</th>
                                <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Saldo</th>
                                <th scope="col" class="text-center text-light" style="background: #404e67; border: solid 2px white;">Solicitado</th>
                        
                            </tr>
                        </thead>
                            <?php
                            
                               $sqli = "SELECT k.fecha, k.tipo_balanceado, k.saldo 
                                        FROM kardex k 
                                        JOIN ( SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id FROM kardex WHERE camaronera_id = '$camaronera' AND saldo >= 0 AND fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) GROUP BY tipo_balanceado ) max_ids
                                        ON k.tipo_balanceado = max_ids.tipo_balanceado
                                        AND k.kardex_id = max_ids.max_kardex_id
                                        WHERE k.saldo >= 0
                                        AND k.fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)";

                                        $balanceados = $objeto->mostrar($sqli);

                                        foreach ($balanceados as $balanceado) {

                                            $insumo = $balanceado['tipo_balanceado'];

                                            $sqli = "SELECT DISTINCT tipo_balanceado, CodigoCuentaContable 
                                                FROM ingreso_balanceado 
                                                WHERE tipo_balanceado = '$insumo' 
                                                AND camaronera = '$camaronera' 
                                                AND (CodigoCuentaContable IS NOT NULL AND TRIM(CodigoCuentaContable) != '' AND CodigoCuentaContable != '34')";

                                            $data = $objeto->mostrar($sqli);

                                            foreach ($data as $value) { 
                                                $codigo = $value['CodigoCuentaContable']; // Eliminar posibles espacios
                                                if ($codigo !== '34') { 
                                            ?>
                                                    <tbody>
                                                        <tr class="text-center">
                                                            <td id="balanceado_disponible_<?php echo $value['tipo_balanceado']; ?>">
                                                                <?php echo $value['tipo_balanceado']; ?>
                                                            </td>
                                                            <td id="saldo_actual_disponible_<?php echo $value['tipo_balanceado']; ?>">
                                                                <?php echo $balanceado['saldo']; ?>
                                                            </td>
                                                            <td id="despacho_<?php echo $value['tipo_balanceado']; ?>">0.00</td> 
                                                        </tr>
                                                    </tbody>
                                            <?php 
                                                } }
                                            } 
?>                                            
                                            

                        </tbody>
                    </table>

        
                </div>

            </div>

        </form>
        <hr>
    
    </div>

    <?php
        // Consulta para obtener productos de la camaronera
        $sql_tabla_productos = "SELECT DISTINCT(tipo_balanceado) AS producto, CodigoCuentaContable, ProductoId FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND CodigoCuentaContable IN ('36','37','38','1743','1744','1745','1746', '1329', '1036', '1331', '1330', '1333', '1332', '1334', '1169')";
        $data_productos = $conectar->mostrar($sql_tabla_productos);
        $productos_json = json_encode($data_productos);
    ?>

    <?php
        // Consulta SQL para obtener los datos del kardex
        $sqlKardex = "SELECT k.*, (k.saldo) AS saldo_kg FROM kardex k 
       JOIN ( SELECT tipo_balanceado, MAX(kardex_id) AS max_id FROM kardex 
       WHERE camaronera_id = '$camaronera' 
       AND saldo >= 0 AND fecha >= CURDATE() - INTERVAL 10 DAY 
       GROUP BY tipo_balanceado ) AS subquery 
       ON k.kardex_id = subquery.max_id 
       WHERE k.camaronera_id = '$camaronera' AND (k.saldo ) >= 0 
       ORDER BY k.tipo_balanceado";

        // Ejecutar la consulta
        $data = $conectar->mostrar($sqlKardex);
        
        // Convertir los resultados en JSON para poder ser utilizados en el script JS
        echo "<script>const datosBalanceados = " . json_encode($data) . ";</script>";
    ?>


    <script>

        function updateProductos() {

            const categoria = document.getElementById('familia').value;
            const productoSelect = document.getElementById('producto');
            
            productoSelect.innerHTML = '<option value="">[Seleccione producto]</option>';

            if (categoria !== '') {
                const productos = <?php echo $productos_json; ?>;
                const productosFiltrados = productos.filter(item => item.CodigoCuentaContable === categoria);

                productosFiltrados.forEach(function(item) {
                    
                    const option = document.createElement('option');
                    //option.value = item.ProductoId; // Usamos ProductoId como valor único
                    option.value = item.producto;
                    //option.textContent = item.ProductoId;
                    option.textContent = item.producto;
                    option.dataset.codigoCuenta = item.ProductoId; // Guardamos CodigoCuentaContable en dataset
                    productoSelect.appendChild(option);
                });
            }

        }

        // Escuchar cambios en el select de producto
        document.getElementById('producto').addEventListener('change', function() {
            const selectedValue = this.value;

            // Seleccionar todos los spans e inputs con id 'insumo' y actualizar su valor
            document.querySelectorAll('span#insumo').forEach(span => {
                span.textContent = selectedValue;
            });

            
            document.querySelectorAll('input#insumo').forEach(input => {
                input.value = selectedValue;
            });

            // Actualizar los inputs de 'medida' según el valor seleccionado
            document.querySelectorAll('input#medida').forEach(input => {

                if(selectedValue === 'ZEOLITA') {
                    input.value = 'kg';  // Se actualiza el input de medida con 'kg'
                } else if(selectedValue === 'BENTONITA') {
                    input.value = 'kg';  // Se actualiza el input de medida con 'kg'
                }else if(selectedValue === 'ADIPEG'){
                    input.value = 'ml';  // Se actualiza el input de medida con 'kg'
                }else if(selectedValue === 'BIO BAC A'){
                    input.value = 'ml';
                }else if(selectedValue === 'BIO BAC B'){
                    input.value = 'gr';
                }else if(selectedValue === 'CAL P24'){
                    input.value = 'kg';
                }else if(selectedValue === 'CARBONATO DE CALCIO'){
                    input.value = 'kg';
                }else if(selectedValue === 'CLORO GRANULADO'){
                    input.value = 'gr';
                }else if(selectedValue === 'CLORURO DE MAGNESIO'){
                    input.value = 'kg';
                }else if(selectedValue === 'FORDEX'){
                    input.value = 'ml';
                }else if(selectedValue === 'MURIATO DE POTASIO'){
                    input.value = 'kg';
                }else if(selectedValue === 'SILICAM PLUS'){
                    input.value = 'kg';
                }else if(selectedValue === 'METASILICATO DE SODIO'){
                    input.value = 'kg';
                }else if(selectedValue === 'PERCARBONATO DE SODIO'){
                    input.value = 'kg';
                }else if(selectedValue === 'SAL EN GRANO'){
                    input.value = 'kg';
                }else if(selectedValue === 'SILICATO'){
                    input.value = 'kg';
                }else if(selectedValue === 'SAPONINA'){
                    input.value = 'kg';
                }else if(selectedValue === 'SULFATO DE COBRE'){
                    input.value = 'kg';
                }else if(selectedValue === 'TOXIMAR'){
                    input.value = 'kg';
                }else if(selectedValue === 'SULFATO DE ALUMINIO'){
                    input.value = 'kg';
                }else if(selectedValue === 'UREA'){
                    input.value = 'kg';
                }else if(selectedValue === 'NITRATE'){
                    input.value = 'kg';
                }else if(selectedValue === 'ZYTRIKA'){
                    input.value = 'kg';
                }else{
                    input.value = 'kg';
                }
                
            });

            document.querySelectorAll('span#medida').forEach(span => {
                if(selectedValue === 'ZEOLITA') {
                    span.textContent = 'kg';  // Se actualiza el input de medida con 'kg'
                } else if(selectedValue === 'BENTONITA') {
                    span.textContent = 'kg';  // Se actualiza el input de medida con 'kg'
                }else if(selectedValue === 'ADIPEG'){
                    span.textContent = 'ml';  // Se actualiza el input de medida con 'kg'
                }else if(selectedValue === 'BIO BAC A'){
                    span.textContent = 'ml';
                }else if(selectedValue === 'BIO BAC B'){
                    span.textContent = 'gr';
                }else if(selectedValue === 'CAL P24'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'CARBONATO DE CALCIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'CLORO GRANULADO'){
                    span.textContent = 'gr';
                }else if(selectedValue === 'CLORURO DE MAGNESIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'FORDEX'){
                    span.textContent = 'ml';
                }else if(selectedValue === 'MURIATO DE POTASIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SILICAM PLUS'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'METASILICATO DE SODIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'PERCARBONATO DE SODIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SAL EN GRANO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SILICATO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SAPONINA'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SULFATO DE COBRE'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'TOXIMAR'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SULFATO DE ALUMINIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'UREA'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'NITRATE'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'ZYTRIKA'){
                    span.textContent = 'kg';
                }else{
                    span.textContent = 'kg';
                }
                
            });

            document.querySelectorAll('span#medida_conversion').forEach(span => {
                if(selectedValue === 'ZEOLITA') {
                    span.textContent = 'kg';  // Se actualiza el input de medida con 'kg'
                } else if(selectedValue === 'BENTONITA') {
                    span.textContent = 'kg';  // Se actualiza el input de medida con 'kg'
                }else if(selectedValue === 'ADIPEG'){
                    span.textContent = 'ml';  // Se actualiza el input de medida con 'kg'
                }else if(selectedValue === 'BIO BAC A'){
                    span.textContent = 'ml';
                }else if(selectedValue === 'BIO BAC B'){
                    span.textContent = 'gr';
                }else if(selectedValue === 'CAL P24'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'CARBONATO DE CALCIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'CLORO GRANULADO'){
                    span.textContent = 'gr';
                }else if(selectedValue === 'CLORURO DE MAGNESIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'FORDEX'){
                    span.textContent = 'ml';
                }else if(selectedValue === 'MURIATO DE POTASIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SILICAM PLUS'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'METASILICATO DE SODIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'PERCARBONATO DE SODIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SAL EN GRANO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SILICATO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SAPONINA'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SULFATO DE COBRE'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'TOXIMAR'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'SULFATO DE ALUMINIO'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'UREA'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'NITRATE'){
                    span.textContent = 'kg';
                }else if(selectedValue === 'ZYTRIKA'){
                    span.textContent = 'kg';
                }else{
                    span.textContent = 'kg';
                }
                
            });


            

        });


        function calcularDiferencia() {

            let selectProducto = document.getElementById("producto");
            let tipoBalanceadoSeleccionado = selectProducto.value.trim(); // Obtener el producto seleccionado
            let boton = document.getElementById("add-egres"); // Botón a deshabilitar/habilitar

            // Asegurarse de que hay un producto seleccionado
            if (!tipoBalanceadoSeleccionado) return;

            // Buscar el saldo actual disponible del producto seleccionado
            let saldoDisponibleCelda = document.getElementById("saldo_actual_disponible_" + tipoBalanceadoSeleccionado);
            let despachoCelda = document.getElementById("despacho_" + tipoBalanceadoSeleccionado);
            

            if (!saldoDisponibleCelda || !despachoCelda) return; // Si no existen las celdas, salir

            let saldoDisponible = parseFloat(saldoDisponibleCelda.innerText.trim()) || 0; // Convertir saldo a número

            // Buscar todos los inputs de conversión y sumarlos solo si tienen datos
            let totalConversion = 0;
            let conversionInputs = document.querySelectorAll("[id^='conversion_']");
            let anyInputFilled = false; // Variable para verificar si algún input tiene datos

            conversionInputs.forEach(input => {
                let valor = parseFloat(input.value.trim()) || 0;
                if (valor > 0) {
                    anyInputFilled = true; // Si hay algún valor en el input
                }
                totalConversion += valor;
            });

            // Si no hay ningún valor en los inputs de conversión, no hacer nada
            if (!anyInputFilled) return;

            // Realizar la resta
            let resultado = saldoDisponible - totalConversion;

            // Mostrar el resultado en la celda de despacho
            despachoCelda.innerText = resultado.toFixed(2); // Mostrar con 2 decimales
            despachoCelda.style.color = resultado < 0 ? "white" : "white"; // Color de letra blanco si es negativo, negro si es positivo
            despachoCelda.style.backgroundColor = resultado < 0 ? "red" : "green"; // Fondo rojo si es negativo, blanco si es positivo

            boton.disabled = resultado < 0; // Si es negativo, se deshabilita; si es positivo o 0, se habilita

          
        }

        // Ejecutar la función cuando el usuario escribe en los inputs de conversión
        document.querySelectorAll("[id^='cantidades_']").forEach(input => {
            input.addEventListener("input", calcularDiferencia);
        });

        // Actualizar el valor de despacho, cantidades y conversiones cuando se cambie el producto
        document.getElementById("producto").addEventListener("change", function () {

            let allDespachos = document.querySelectorAll("[id^='despacho_']");
            let allCantidades = document.querySelectorAll("[id^='cantidades_']");
            let allConversiones = document.querySelectorAll("[id^='conversion_']");
            let allBotones = document.querySelectorAll("[id^='add-egres_']"); // Suponiendo que los botones tienen un id único


            // Reiniciar todos los valores de despachos, cantidades y conversiones a cero
            allDespachos.forEach(despacho => {
                despacho.innerText = "0.00";
                despacho.style.color = "black"; // Establecer el color a negro por defecto
                despacho.style.backgroundColor = "white"; // Establecer el fondo blanco
            });

            allCantidades.forEach(cantidad => {
                cantidad.value = "0.00"; // Reiniciar el valor de los inputs de cantidades
            });

            allConversiones.forEach(conversion => {
                conversion.value = "0.00"; // Reiniciar el valor de los inputs de conversion
            });
        });


        function calculateDifference(idPiscina) {
            // Capturamos los valores de los inputs
            const cantidadInput = document.getElementById('cantidades_' + idPiscina);
            const conversionInput = document.getElementById('conversion_' + idPiscina);
            const medidaInput = document.getElementById('medida');

            const cantidad = parseFloat(cantidadInput.value);
            const medida = medidaInput.value.trim().toLowerCase(); // Obtenemos el valor de la medida y lo pasamos a minúsculas
            console.log(medidaInput);

            // Verificamos si la medida es mililitros
            if (medida === 'ml' ) {
                // Si es mililitros, lo convertimos a litros (1 litro = 1000 mililitros)
                const litros = cantidad / 1000;
                conversionInput.value = litros; // Mostramos el resultado en litros con 3 decimales

            } else if (medida === 'lt' ) {
                // Si no es mililitros, podemos manejar otros casos si es necesario (por ejemplo, no hacer ninguna conversión)
                const ml = cantidad;
                conversionInput.value = ml;

            } else if (medida === 'gr' ) {
                // Si no es mililitros, podemos manejar otros casos si es necesario (por ejemplo, no hacer ninguna conversión)
                const gr = cantidad / 1000;
                conversionInput.value = gr;

            }else if (medida === 'kg' ) {
                // Si no es mililitros, podemos manejar otros casos si es necesario (por ejemplo, no hacer ninguna conversión)
                const kg = cantidad;
                conversionInput.value = kg;
            }
        }

        

        document.querySelectorAll('[id^="cantidades_"]').forEach(input => {
            input.addEventListener('click', function () {
                const idPiscina = this.id.split('_')[1]; // Extrae el ID de la piscina desde el input clickeado
                const conversionInput = document.getElementById('conversion_' + idPiscina);
                
                this.value = ''; // Borra el valor del input clickeado
                if (conversionInput) {
                    conversionInput.value = ''; // Borra el valor del input de conversión si existe
                }
            });
        });


        document.getElementById("producto").addEventListener("change", function() {

            var selectedOption = this.options[this.selectedIndex];
            var producto = selectedOption.value;
            var productoId = selectedOption.getAttribute("data-codigo-cuenta");

            // Actualizar el valor del input de producto
            //document.getElementById("productoInput").value = productoId;

            // Actualizar el valor del input oculto con el productoId
            //document.getElementById("productoIdHidden").value = productoId;

            document.querySelectorAll('input#productoIdHidden').forEach(input => {
                        input.value = productoId;
                    });
            
        });

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