<?php date_default_timezone_set("America/Ecuador"); ?>
<?php $objeto_camaronera = new corrida(); 
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
?>

<div class="row" style="margin: auto;">

    <div class="col-md-5">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white">INGRESO DE PRODUCTO A BODEGA</h6>
            </div>
            <div class="card-body">
                <form id="form-insert-run"  action="../controllers/insert-ingreso-bodega-producto.php" method="post">
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
                        <label for="fechaActual" class="col-sm-4 col-form-label">Fecha de ingreso</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="fechaActual" id="fechaActual" readonly style="background: none;">                   
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="categoria" class="col-sm-4 col-form-label">Categoria</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="familia" name="categoria" onchange="updateProductos()">
                                <option value="">[Seleccione categoria]</option>
                                <?php
                                $sql = "SELECT DISTINCT(categoria) AS categoria, 
                                
                                            CASE 
                                                WHEN categoria = 'reguladores' THEN 'Reguladores Suelo y Agua'
                                                WHEN categoria = 'fertilizantes' THEN 'Fertilizantes'
                                                WHEN categoria = 'otras_materias' THEN 'Otras Materias Primas'
                                                WHEN categoria = 'bacterias' THEN 'Bacterias'
                                                WHEN categoria = 'peroxido' THEN 'Peroxido'
                                                ELSE 'Otro'
                                            END AS descripcionFamilia
                                

                                FROM registro_producto WHERE id_camaronera = '$camaronera'";
                                $data = $conectar->mostrar($sql);
                                foreach ($data as $value) { ?>
                                    <option value="<?php echo $value['categoria']; ?>"><?php echo $value['descripcionFamilia']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="producto" class="col-sm-4 col-form-label">Producto</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="producto" name="producto" style="text-transform: capitalize;">
                                <option value="">[Seleccione producto]</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fechaActual" class="col-sm-4 col-form-label">Cantidad</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="cantidad" id="cantidad"  style="background: none;" placeholder="0.00">                   
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-4 col-form-label">Motivo</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="motivo" name="motivo">
                                <option value="compra">Compra</option>
                                <option value="ajuste">Ajuste</option>
                            </select>
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
        $sqli = "SELECT *,
        
                    CASE 
                        WHEN categoria = 'reguladores' THEN 'Reguladores Suelo y Agua'
                        WHEN categoria = 'fertilizantes' THEN 'Fertilizantes'
                        WHEN categoria = 'otras_materias' THEN 'Otras Materias Primas'
                        WHEN categoria = 'bacterias' THEN 'Bacterias'
                        WHEN categoria = 'peroxido' THEN 'Peroxido'
                        ELSE 'Otro'
                    END AS descripcionFamilia

        FROM insumos_camaronera WHERE id_camaronera = '$camaronera' ORDER BY fecha_registro ASC";
        $producto = $objeto_camaronera->mostrar($sqli);
        ?>
        <table class="table table-sm table-hover table-bordered align-items-center " style="width:100%;">
            <thead>
                <tr class="text-white text-center">
                    <th colspan="9" class="bg-dark" style="height:48px;">
                        <span class="text-white">PRODUCTOS AGREGADOS A BODEGA</span>
                    </th>
                </tr>
                <tr class="text-center">
                 
                    
                    <th class="text-center text-white" style="background: #404e67;">Fecha registro</th>
                    <th class="text-center text-white" style="background: #404e67;">Categoria</th>
                    <th class="text-center text-white" style="background: #404e67;">Producto</th>
                    <th class="text-center text-white" style="background: #404e67;">Cantidad</th>
                    <th class="text-center text-white" style="background: #404e67;">Uni. de medida</th>
                    <th class="text-center text-white" style="background: #404e67;">Precio $</th>
                    <th class="text-center text-white" style="background: #404e67;">Descripcion</th>
                    <th class="text-center text-white" style="background: #404e67;">Motivo</th>
                    <th class="text-center text-white" style="background: #404e67;">Responsable</th>
                    
               
                </tr>
            </thead>
            <tbody>
                <?php foreach ($producto as $key) { ?>
                    <tr>
                       
                    <td class="align-middle text-center"><?php echo $key['fecha_registro']; ?></td>
                    <td class="align-middle text-center" style=""><?php echo $key['descripcionFamilia']; ?></td>
                    <td class="align-middle text-center" style="text-transform: capitalize;"><?php echo ucwords(strtolower($key['producto'])); ?></td>
                    <td class="align-middle text-center"><?php echo $key['cantidad']; ?></td>
                    <td class="align-middle text-center"><?php echo $key['medida']; ?></td>
                    <td class="align-middle text-center"><?php echo $key['costo_actual']; ?></td>
                    <td class="align-middle text-center" style="text-transform: capitalize;"><?php echo ucwords(strtolower($key['descripcion'])); ?></td>
                    <td class="align-middle text-center" style="text-transform: capitalize;"><?php echo ucwords(strtolower($key['motivo'])); ?></td>
                    <td class="align-middle text-center" style="text-transform: capitalize;"><?php echo ucwords(strtolower($key['encargado'])); ?></td>

                        
                    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    
</div>

<script>
    function updateProductos() {
        const categoria = document.getElementById('familia').value;
        const productoSelect = document.getElementById('producto');
        productoSelect.innerHTML = '<option value="">[Seleccione producto]</option>';

        if (categoria !== '') {
            // Obtener todos los productos para la categoría seleccionada
            const productos = <?php
                $sql_tabla_productos = "SELECT DISTINCT(producto) AS producto, categoria FROM registro_producto WHERE id_camaronera = '$camaronera'";
                $data_productos = $objeto_camaronera->mostrar($sql_tabla_productos);
                echo json_encode($data_productos);
            ?>;

            productos.forEach(function(item) {
                if (item.categoria === categoria) {
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
