<?php date_default_timezone_set("America/Lima"); $objeto_camaronera = new corrida();?>

<div class="row" style="margin: auto;">
 
    <div class="col-md-6 ">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">INGRESO DIARIO DE INSUMOS CAMARONERA</h6>
            </div>
            <div class="card-body">
                <div class="dt-responsive">
                    <form  action="../controllers/insert-inventario-general.php" method="post">
                        <div class="row">
                            <label class="col-sm-6 col-lg-6 col-form-label">Camaronera</label>
                            <div class="col-sm-6 col-lg-6">
                                <div class="input-group">
                                    <select class="form-control" name="camaronera" id="camaronera">
                                        <?php

                                        $objeto_tabla_camaronera = new corrida();
                                        $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                        foreach ($data as $value) {
                                        ?>
                                            <option value="<?php echo $value['id_camaronera']; ?>">
                                                <?php echo $value['descripcion_camaronera']; ?></option>

                                        <?php } ?>
                                    </select>

                                </div>
                            </div>

                            <label class="col-sm-6 col-lg-6 col-form-label">Fecha de Ingreso</label>
                            <div class="col-sm-6 col-lg-6">
                                <div class="input-group">
                                    
                                
                                   
                                       <input type="text" class="form-control" name="fechaActual" id="fechaActual" readonly style="background: none;">
                                   

                                
                                    <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">
                                </div>
                            </div>
                            
                            <label class="col-sm-6 col-lg-6 col-form-label">Insumo</label>
                            <div class="col-sm-6 col-lg-6">
                                <div class="input-group">
                                    
                                
                                                           
                                      
                                                        <div>
                                                    
                                                            
                                                            <select class="select" style='width:150%;height:32px;background-color:#a3fc93;' name="insumo">
                                                                <?php
            
                                                                $sqli = "SELECT * FROM `insumos_camaronera`";
                                                                $data = $objeto->mostrar($sqli);?>
                                                                <option class="text-center" value="0">
                                                                 <div style="min-height:32px;background-color:#a3fc93;"> [Seleccione]</div>
                                                                    </option><?php
                                                                foreach ($data as $value) {
                                                                ?> 
            
                                                                    <option class="text-center" value="<?php echo $value['id_insumos'] ?>" style="min-height:32px;">
                                                                        <?php echo $value['producto'].' '.$value['marca'].' '.$value['proveedor'].' '.$value['medida']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                            </select>
                                                            
                                                            

                                                        </div>
                                               
                                                          
                           
                                   

                                
                                    <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">
                                </div>
                            </div>
                            
                        </div>
                        <?php
                        #validar piscinas en proceso
                        $sql_proceso = "SELECT id_piscina, estado FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso'";
                        $data_proceso = $objeto_tabla_camaronera->mostrar($sql_proceso);

                        foreach ($data_proceso as $proceso) {
                            $psc_proceso = $proceso['id_piscina'];
                        }

                        ?>
                        <div class="table-responsive">

                            <table id="scr-vtr-dynamic" class="table table-bordered nowrap">
                                <thead>
                                    <tr class="text-white text-center">
                                        <th colspan="4" class="bg-dark">
                                            <span class="text-white"> Consumos bodega </span>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="background: #404e67; color:white;">Piscina</th>
                                        <th style="background: #404e67; color:white;">Cantidad</th>
                                    </tr>
                                </thead>

                                <tbody>

                                        <?php
                                        $sql = "SELECT id_piscina,id_corrida FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' ORDER BY id_piscina ASC";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $x) {
                                            $ps = $x['id_piscina'];
                                             $corr = $x['id_corrida'];

                                        ?>

                                     
   <tr class="text-center">
                                            <td>
                                                <div class="container">
                                                    <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $x['id_piscina']; ?>">
                                                    <?php

                                                    $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p1' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                    $sqlitempo = " SELECT id_corrida FROM registro_piscina_engorde WHERE TRUE AND id_piscina = '$p1' AND id_camaronera = '$camaronera'  AND estado = 'En proceso' ORDER BY registro_piscina_engorde.id_registro_engorde DESC;";
                                                    $data = $objeto_camaronera->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <input type="hidden" name="corrida[]" value="<?php echo $corr; ?>">

                                       
                                                </div>
                                            </td>

                                            <td>
                                                <div class="container">
                                                    <div class=>
                                                        <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0">
                                                    </div>
                                                </div>
                                            </td>

                                        <?php }     ?>
                                        </tr>
      <?php  } 
   ?>
                                    
                                    
                                </tbody>
                            </table>

                        </div>
                        <center><button class="btn btn-danger btn-sm text-light mt-1" name="sender" id="add-form-foot" type="submit">Guardar</button></center>
                    </form>
                </div>
           
            </div>
            
        </div>
    </div>
















</div>

