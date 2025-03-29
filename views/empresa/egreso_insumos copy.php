<?php date_default_timezone_set("America/Ecuador"); ?>
<?php $objeto_camaronera = new corrida(); 
    $conectar = new Conexion();

?>

<div class="row" style="margin: auto;">

    <div class="col-md-5">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white">EGRESO DE PRODUCTO DE BODEGA</h6>
            </div>
            <div class="card-body">
                <form id="form-insert-run"  action="../controllers/insert-egreso-bodega-producto.php" method="post">
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
                        <label for="fechaActual" class="col-sm-4 col-form-label">Piscina</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="piscina" name="piscina">
                                <option value="">[Seleccione piscina]</option>
                                <?php
                                $sql = "SELECT DISTINCT(id_piscina) AS id_piscina, id_corrida FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso'";
                                $data = $conectar->mostrar($sql);
                                foreach ($data as $value) { ?>
                                    <option value="<?php echo $value['id_piscina']; ?>"><?php echo  $value['id_piscina']; ?></option>
                                <?php } ?>
                            </select>                
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="categoria" class="col-sm-4 col-form-label">Categoria</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="familia" name="categoria" onchange="updateProductos()">
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
                    </div>

                    <div class="form-group row">
                        <label for="producto" class="col-sm-4 col-form-label">Producto</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="producto" name="producto">
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
                                <option value="consumo piscina">Consumo piscina</option>
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
                    WHEN categoria = 'otras_materias_primas' THEN 'Otras Materias Primas'
                    WHEN categoria = 'bacterias' THEN 'Bacterias'
                    WHEN categoria = 'peroxido' THEN 'Peroxido'
                    ELSE 'Otro'
                END AS descripcionFamilia

        FROM registro_egreso_producto WHERE id_camaronera = '$camaronera' ORDER BY fecha_registro ASC";
        $producto = $objeto_camaronera->mostrar($sqli);
        ?>
        <table class="table table-sm table-hover table-bordered align-items-center " style="width:100%;">
            <thead>
                <tr class="text-white text-center">
                    <th colspan="9" class="bg-dark" style="height:48px;">
                        <span class="text-white">PRODUCTOS EGRESADOS DE BODEGA</span>
                    </th>
                </tr>
                <tr class="text-center">
                 
                    
                    <th class="text-center text-white" style="background: #404e67;">Fecha registro</th>
                    <th class="text-center text-white" style="background: #404e67;">Piscina</th>
                    <th class="text-center text-white" style="background: #404e67;">Categoria</th>
                    <th class="text-center text-white" style="background: #404e67;">Producto</th>
                    <th class="text-center text-white" style="background: #404e67;">Cantidad</th>
                    <th class="text-center text-white" style="background: #404e67;">Medida</th>
                    <th class="text-center text-white" style="background: #404e67;">Motivo</th>
                    <th class="text-center text-white" style="background: #404e67;">Responsable</th>
                    
               
                </tr>
            </thead>
            <tbody>
                <?php foreach ($producto as $key) { ?>
                    <tr>
                       
                        
                        <td class="align-middle text-center" ><?php echo ucfirst(strtolower($key['fecha_registro'])); ?></td>
                        <td class="align-middle text-center" ><?php echo ucfirst(strtolower($key['id_piscina'])); ?></td>
                        <td class="align-middle text-center" ><?php echo ucfirst(strtolower($key['descripcionFamilia'])); ?></td>
                        <td class="align-middle text-center" ><?php echo ucfirst(strtolower($key['producto'])); ?></td>
                        <td class="align-middle text-center" ><?php echo ucfirst(strtolower($key['cantidad'])); ?></td>
                        <td class="align-middle text-center" ><?php echo ucfirst(strtolower($key['unidad_medida'])); ?></td>
                        <td class="align-middle text-center" ><?php echo ucfirst(strtolower($key['motivo'])); ?></td>
                        <td class="align-middle text-center" ><?php echo ucfirst(strtolower($key['encargado'])); ?></td>
                        
                        
                    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    
</div>

<?php
// Consulta para obtener productos de la camaronera
$sql_tabla_productos = "SELECT DISTINCT(DescripcionCorta) AS producto, CodigoCuentaContable FROM comprasfacturasaquapro WHERE id_camaronera = '$camaronera' AND CodigoCuentaContable IN ('36','37','38','1743','1744','1745','1746', '1329', '1036', '1331', '1330', '1333', '1332', '1334', '1169')";
$data_productos = $objeto_camaronera->mostrar($sql_tabla_productos);
$productos_json = json_encode($data_productos);
?>

<script>
    function updateProductos() {
        const categoria = document.getElementById('familia').value;
        //alert("Consulta SQL ejecutada: " + categoria + " \n<?php echo $sql_tabla_productos; ?>");

        const productoSelect = document.getElementById('producto');
        productoSelect.innerHTML = '<option value="">[Seleccione producto]</option>';

        if (categoria !== '') {
            // Obtener los productos desde PHP
            const productos = <?php echo $productos_json; ?>;
            //console.log("Todos los productos obtenidos:", productos);

            // Filtrar productos por el CódigoCuentaContable que coincide con la categoría seleccionada
            const productosFiltrados = productos.filter(item => item.CodigoCuentaContable === categoria);
            //console.log("Productos filtrados:", productosFiltrados);

            // Agregar opciones al select
            productosFiltrados.forEach(function(item) {
                const option = document.createElement('option');
                option.value = item.producto;
                option.textContent = item.producto;
                productoSelect.appendChild(option);
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
