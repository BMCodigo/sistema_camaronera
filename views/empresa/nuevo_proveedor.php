<?php date_default_timezone_set("America/Ecuador"); ?>
<?php $objeto_camaronera = new corrida(); 
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
?>

<div class="row" style="margin: auto;">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white">REGISTRO DE PROVEEDOR</h6>
            </div>
            <div class="card-body">
                <form id="form-insert-run"  action="../controllers/insert-proveedor.php" method="post">
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
                            <input type="text" class="form-control" name="fechaActual" id="fechaActual" readonly style="background: none;">                   
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="razon_social" class="col-sm-4 col-form-label">Empresa o razon social</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="razon_social" id="razon_social" placeholder = "Ingrese datos ...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ruc_cedula" class="col-sm-4 col-form-label">Ruc o cedula</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ruc_cedula" id="ruc_cedula" placeholder = "Ingrese datos ...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="direccion" class="col-sm-4 col-form-label">Direccion</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder = "Ingrese datos ...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefono" class="col-sm-4 col-form-label">Telefono de ocntacto</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="telefono" id="telefono" placeholder = "Ingrese datos ...">
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
        $sqli = "SELECT * FROM registro_proveedor WHERE id_camaronera = '$camaronera' ORDER BY fecha_registro ASC";
        $proveedor = $objeto_camaronera->mostrar($sqli);
        ?>
        <table class="table table-sm table-hover table-bordered align-items-center " style="width:100%;">
            <thead>
                <tr class="text-white text-center">
                    <th colspan="7" class="bg-dark" style="height:48px;">
                        <span class="text-white">PROVEEDORES AGREGADOS</span>
                    </th>
                </tr>
                <tr class="text-center">
                 
                    
                    <th class="text-center text-white" style="background: #404e67;">Fecha registro</th>
                    <th class="text-center text-white" style="background: #404e67;">Empresa</th>
                    <th class="text-center text-white" style="background: #404e67;">Ruc/cedula</th>
                    <th class="text-center text-white" style="background: #404e67;">Telefono</th>
                    <th class="text-center text-white" style="background: #404e67;">Responsable</th>
                    
               
                </tr>
            </thead>
            <tbody>
                <?php foreach ($proveedor as $key) { ?>
                    <tr>
                       
                        
                        <td class="align-middle text-center" ><?php echo $key['fecha_registro']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['empresa_razon_social']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['ruc_cedula']; ?></td>
                        <td class="align-middle text-center" ><?php echo $key['telefono']; ?></td>
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
