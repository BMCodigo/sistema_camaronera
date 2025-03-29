<?php date_default_timezone_set("America/Ecuador"); ?>
<?php $objeto_camaronera = new corrida(); 
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
?>

<div class="row" style="margin: auto;">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white">REGISTRO DE PRODUCTO</h6>
            </div>
            <div class="card-body">
                <form id="form-insert-run"  action="../controllers/insert-nuevo-producto.php" method="post">
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
                        <label for="fechaActual" class="col-sm-4 col-form-label">Fecha de registro</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="fechaActual" >                   
                        </div>
                    </div>

                    <!--div class="form-group row">
                        <label for="categoria" class="col-sm-4 col-form-label">Proveedor</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="proveedor" name="proveedor" >
                            <option value=""> [Seleccione proveedor]</option>
                            <<?php
                                $sql_tabla_camaronera = "SELECT DISTINCT(empresa_razon_social) AS proveedor FROM registro_proveedor WHERE id_camaronera = '$camaronera'";
                                $data = $objeto_camaronera->mostrar($sql_tabla_camaronera);
                                foreach ($data as $value) { ?>
                                    <option value="<?php echo $value['proveedor'] ?>"><?php echo $value['proveedor'] ?></option>
                                <?php  } ?>
                        </select>
                        </div>
                    </div-->

                    <div class="form-group row">
                        <label for="categoria" class="col-sm-4 col-form-label">Categoria</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="categoria" name="categoria" >
                            <option value=""> [Seleccione categoria]</option>
                            <option value="bacterias" style="text-transform: capitalize;">Bacterias</option>
                            <option value="balanceado" style="text-transform: capitalize;">Balanceado</option>
                            <option value="fertilizantes" style="text-transform: capitalize;">Fertilizantes</option>
                            <option value="reguladores" style="text-transform: capitalize;">Reguladores Suelo y Agua</option>
                            <option value="otras_materias" style="text-transform: capitalize;">Otras Materias Primas</option>
                            <option value="peroxido" style="text-transform: capitalize;">Peroxido</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="producto" class="col-sm-4 col-form-label">Nombre de producto</label>
                        <div class="col-sm-8">
                            

                        <select class="form-control" id="producto" name="producto">
                            <option value=""> [Seleccione producto]</option>
                            <?php
                                $sql_tabla_camaronera = "SELECT DISTINCT(DescripcionCorta) AS producto FROM comprasfacturasaquapro WHERE id_camaronera = '$camaronera' AND cheklist = 'si' AND parcial = 'no' AND auditoria = 'Autorizado' ORDER BY DescripcionCorta ASC";
                                $data = $objeto_camaronera->mostrar($sql_tabla_camaronera);
                                foreach ($data as $value) { ?>
                                    <option value="<?php echo $value['producto'] ?>">
                                        <?php echo ucfirst(strtolower($value['producto'])) ?>
                                    </option>
                            <?php  } ?>
                        </select>


                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="unidad_medida" class="col-sm-4 col-form-label">Unidad de medida</label>
                        <div class="col-sm-8">
                        <select class="form-control" id="unidad_medida" name="unidad_medida">
                            <option value=""> [Seleccione unidad de medida]</option>
                            <option value="litro" style="text-transform: capitalize;">Litro</option>
                            <option value="kilo" style="text-transform: capitalize;">kilo</option>
                            <option value="libra" style="text-transform: capitalize;">Libra</option>
                        </select>
                        </div>
                    </div>

                    <!--div class="form-group row">
                        <label for="precio" class="col-sm-4 col-form-label">Precio unitario</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="precio" id="precio" placeholder = "Ingrese datos ..." style="text-transform: uppercase;">
                        </div>
                    </div-->

                    

                    <!--div class="form-group row">
                        <label for="descripcion" class="col-sm-4 col-form-label">Descripcion</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder = "Breve detalle" style="text-transform: capitalize;">
                        </div>
                    </div-->

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
        
        FROM registro_producto WHERE id_camaronera = '$camaronera' ORDER BY fecha_registro ASC";
        $producto = $objeto_camaronera->mostrar($sqli);
        ?>
        <table class="table table-sm table-hover table-bordered align-items-center " style="width:100%;">
            <thead>
                <tr class="text-white text-center">
                    <th colspan="8" class="bg-dark" style="height:48px;">
                        <span class="text-white">PRODUCTOS AGREGADOS</span>
                    </th>
                </tr>
                <tr class="text-center">
                 
                    
                    <th class="text-center text-white" style="background: #404e67;">Fecha registro</th>
                    <th class="text-center text-white" style="background: #404e67;">codigo</th>
                    <th class="text-center text-white" style="background: #404e67;">Categoria</th>
                    <th class="text-center text-white" style="background: #404e67;">Producto</th>
                    <th class="text-center text-white" style="background: #404e67;">Uni. de medida</th>
                    <th class="text-center text-white" style="background: #404e67;">Precio $</th>
                    <th class="text-center text-white" style="background: #404e67;">Descripcion</th>
                    <th class="text-center text-white" style="background: #404e67;">Responsable</th>
                    
               
                </tr>
            </thead>
            <tbody>
                <?php foreach ($producto as $key) { ?>
                    <tr>
                       
                        
                        <td class="align-middle text-center" ><?php echo $key['fecha_registro']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['codigo']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['descripcionFamilia']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['producto']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['unidad_medida']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['precio']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['descripcion']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['encargado']; ?></td>
                        
                        
                    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


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

