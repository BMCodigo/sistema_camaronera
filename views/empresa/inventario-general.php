<?php date_default_timezone_set("America/Ecuador"); ?>
<?php $objeto_camaronera = new corrida(); 
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
?>

<div class="row" style="margin: auto;">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white">INGRESO DE INSUMOS (bacterias) CONSUMIDOS POR DIA</h6>
            </div>
            <div class="card-body">
                <form id="form-insert-run"  action="../controllers/insert-inventario-general.php" method="post">
                    <div class="form-group row">
                        <label for="camaronera" class="col-sm-4 col-form-label">Camaronera</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="camaronera" id="camaronera">
                                <?php
                                $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                $data = $objeto_camaronera->mostrar($sql_tabla_camaronera);
                                foreach ($data as $value) {
                                    echo "<option value='{$value['id_camaronera']}'>{$value['descripcion_camaronera']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fechaActual" class="col-sm-4 col-form-label">Fecha consumo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="fechaActual" id="fechaActual" readonly style="background: none;">
                            
                                        
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="camaronera" class="col-sm-4 col-form-label">Seleccione piscina</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="piscina" id="piscina">
                            <option value="0">[Seleccione]</option>
                                <?php
                                $sql_tabla_camaronera = "SELECT id_piscina, id_corrida, id_camaronera FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_piscina ASC";
                                $data = $objeto_camaronera->mostrar($sql_tabla_camaronera);
                                foreach ($data as $value) {
                                    echo "<option value='{$value['id_piscina']}'>{$value['id_piscina']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="familia" class="col-sm-4 col-form-label">Seleccione Familia</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="familia" id="familia" onchange="updateProductos()">
                                <option value="0">[Seleccione]</option>
                                <?php
                                $sql_tabla_familia = "SELECT DISTINCT familia FROM `insumos_camaronera`";
                                $data_familia = $objeto_camaronera->mostrar($sql_tabla_familia);
                                foreach ($data_familia as $value) {
                                    echo "<option value='{$value['familia']}'>{$value['familia']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="producto" class="col-sm-4 col-form-label">Seleccione Producto</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="producto" id="producto">
                                <option value="0">[Seleccione]</option>
                                <!-- Aquí se llenará dinámicamente con JS -->
                            </select>
                        </div>
                    </div>



                    <!--div class="form-group row">
                        <label for="producto" class="col-sm-4 col-form-label">Seleccione Producto (bacteria)</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="producto" id="producto" onchange="toggleAddButton()">
                                <option value="0">[Seleccione]</option>
                                <?php
                                $sql_tabla_piscina = "SELECT * FROM `insumos_camaronera` WHERE familia IN ('bacterias', 'fertilizantes', 'regulador agua/suelo', 'otras materias')";
                                $data = $objeto_camaronera->mostrar($sql_tabla_piscina);
                                foreach ($data as $value) {
                                    echo "<option value='{$value['producto']}'>{$value['producto']}</option>";
                                }
                                ?>
                            </select>
                            
                        </div>
                    </div-->

                    <div class="form-group row">
                        <label for="fechaActual" class="col-sm-4 col-form-label">Cantidad consumida</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="cantidad" id="cantidad" step="0.01" min="0" placeholder = "0.00" value = "0.00">
                        </div>
                    </div>

                     <input type="hidden" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>">
                    <center>
                        <button type="submit" class="btn btn-danger mt-12" style="height:35px;width:20%;">
                                <i class="fas fa-plus"></i> Añadir
                            </button>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
         <div class="card">
        <?php
        $sqli = "SELECT * FROM costos_camaronera WHERE id_camaronera = '$camaronera' ORDER BY id_piscina ASC";
        $insumos = $objeto_camaronera->mostrar($sqli);
        ?>
        <table class="table table-sm table-hover table-bordered align-items-center " style="width:100%;">
            <thead>
                <tr class="text-white text-center">
                    <th colspan="7" class="bg-dark" style="height:48px;">
                        <span class="text-white">REPORTE INSUMOS CONSUMIDOS</span>
                    </th>
                </tr>
                <tr class="text-center">
                 
                    
                    <th class="text-center text-white" style="background: #404e67;">Fecha consumo</th>
                    <th class="text-center text-white" style="background: #404e67;">Producto</th>
                    <th class="text-center text-white" style="background: #404e67;">Piscinas</th>
                    <th class="text-center text-white" style="background: #404e67;">Hectareas</th>
                    <th class="text-center text-white" style="background: #404e67;">Cantidad</th>
                    <th class="text-center text-white" style="background: #404e67;">Responsable</th>
                    
               
                </tr>
            </thead>
            <tbody>
                <?php foreach ($insumos as $insumo) { ?>
                    <tr>
                       
                        
                        <td class="align-middle text-center" ><?php echo $insumo['fecha_consumo']; ?></td>
                        <td class="align-middle text-center" ><?php echo $insumo['producto']; ?></td>
                        <td class="align-middle text-center" ><?php echo $insumo['id_piscina']; ?></td>
                        <td class="align-middle text-center" ><?php echo $insumo['hectareas']; ?></td>
                        <td class="align-middle text-center" ><?php echo $insumo['cantidad']; ?></td>
                        <td class="align-middle text-center" ><?php echo $insumo['responsable']; ?></td>
                        
                    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function updateProductos() {
        const familia = document.getElementById('familia').value;
        const productoSelect = document.getElementById('producto');
        productoSelect.innerHTML = '<option value="0">[Seleccione]</option>';

        if (familia !== '0') {
            <?php
            // Obtener todos los productos para pasarlos al script
            $sql_tabla_productos = "SELECT familia, producto FROM `insumos_camaronera`";
            $data_productos = $objeto_camaronera->mostrar($sql_tabla_productos);
            ?>
            const productos = <?php echo json_encode($data_productos); ?>;

            productos.forEach(function(item) {
                if (item.familia === familia) {
                    const option = document.createElement('option');
                    option.value = item.producto;
                    option.textContent = item.producto;
                    productoSelect.appendChild(option);
                }
            });
        }
    }
</script>


<style>
    .card-header {
        background: #404e67;
    }
    .card-header h6 {
        margin: auto;
    }
    .text-white {
        color: #ffffff !important;
    }
    table, th, td {
        border: 0px solid black;
        border-collapse: collapse;
        padding: 0px;
    }
    .form-control, .btn {
        height: 100%;
    }
</style>
