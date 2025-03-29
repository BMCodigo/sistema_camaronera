
<div class="row">

    <div class="container col-md-6">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">INGRESO DE INSUMOS CONSUMIDOS POR DIA</h6>
            </div>
            <div class="card-body">
                <div class="mb-20">
                      <table id="inputTable">
                    <form id="form-insert-run" onsubmit="return pesca()"
                        action="../controllers/test.php" method="post">

                        <div class="col-md-12">
                            <div class="">
                               
                            </div>
                        </div>

                        <div class="row mt-2">
                            <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                            <div class="col-sm-8 col-lg-7">
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
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Fecha</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                      <input type="text" class="form-control" name="fechaActual" id="fechaActual" readonly style="background: none;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Seleccione Producto</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="piscina" id="piscina">
                                          <option value="0">
                                            [Seleccione]
                                        </option>
                                        <?php

                                        $objeto_tabla_piscina = new corrida();
                                        $sql_tabla_piscina = "SELECT * FROM `insumos_camaronera`";
                                        $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                                                                foreach ($data as $value) {
                                                                ?> 
            
                                                                    <option class="text-center" value="<?php echo $value['id_insumos'] ?>" style="min-height:32px;">
                                                                        <?php echo $value['producto'].' '.$value['marca'].' '.$value['proveedor'].' '.$value['medida']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                    </select>
                                       <button type="button" class="btn btn-primary" onclick="addRow()">+</button>
                                </div>
                            </div>
                        </div>
                        
                         <thead>
                <tr>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Piscina</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
                        
         <tbody>
            </tbody>







                        <center><button class="btn btn-danger btn-sm text-light mt-3" id="sender" style="display:none;" type="submit" onclick="fechar()">guardar</button></center>
                    </form>
                    </table>
                </div>
            </div>
        </div>





    </div>
                <div class="col-6">
               <?php $sqli = "
            SELECT 	id_ccostos,	fecha_consumo,	id_camaronera,	id_piscina,	id_corrida,	familia,
                producto,	cantidad,	costo,	responsable	
                    FROM `costos_camaronera`
                        WHERE TRUE
                    AND id_camaronera =  '$camaronera'
                AND fecha_consumo = NOW();
                ";  $insumos = $objeto->mostrar($sqli);
                    ?>

                                      
                                       
                      <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2" style="width:712px;">
                          
                        <thead>
                                                                <tr class="text-white text-center">
                                        <th colspan="7" class="bg-dark" style="height:48px;">
                                            <span class="text-white"> <br> REPORTE INSUMOS CONSUMIDOS HOY<br> </span>
                                        </th>
                                    </tr>
                           
                            <tr class="text-center">
                                 
                                 <!--<th class="text-center text-white" style="background: #404e67;">
                                    Saldo en sacos
                                </th>-->
                                 <th class="text-center text-white" style="background: #404e67;">
                                    Fecha
                                </th>
                                  <th class="text-center text-white" style="background: #404e67;">
                                    Piscina
                                </th>
                                 <th class="text-center text-white" style="background: #404e67;">
                                    Familia
                                </th>
                                  <th class="text-center text-white" style="background: #404e67;display:;">
                                    Producto
                                </th>
                               <th class="text-center text-white" style="background: #404e67;display:;">
                                    Cantidad
                                </th>
                                <th class="text-center text-white" style="background: #404e67;display:;">
                                    Responsable
                                </th>
                   
      
                            </tr>
                        </thead>
                          <tbody>
                                       <?php  foreach ($insumos as $insumo) { 
                                       
                                       ?>
                                       
                                    <tr>
                                          
                                        
                                        <td class="align-middle text-center" style="border: 1px solid #40497C;background-color:#beedd3;">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                 <?php  echo $insumo['fecha_consumo']; ?>
                                                </span>
                                        </td>
                                          <td class="align-middle text-center" style="border: 1px solid #40497C;background-color:#beedd3;">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php  echo 'totalkilos[]'.$descripcion_alimento; ?>">
                                     <?php  echo $insumo['id_piscina']; ?>
                                                </span>
                                        </td>
                                          <td class="align-middle text-center" style="border: 1px solid #40497C;background-color:#beedd3;">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php  echo 'totalkilos[]'.$descripcion_alimento; ?>">
                                     <?php  echo $insumo['familia']; ?>
                                                </span>
                                        </td>
                                        
                                         <td class="align-middle text-center" style="border: 1px solid #40497C;background-color:#beedd3;">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $insumo['producto']; ?>
                                                </span>
                                        </td> 
                                        
                                                                                <td class="align-middle text-center" style="border: 1px solid #40497C;background-color:#beedd3;">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $insumo['cantidad']; ?>
                                                </span>
                                        </td>
                                        
                                        <td class="align-middle text-center" style="border: 1px solid #40497C;background-color:#beedd3;">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $insumo['responsable']; ?>
                                                </span>
                                        </td>
                                        
                
                                    </tr>
                                      <?php }  ?>
                             <tbody>
                       </table>
                       
                         </form>
                </div>
</div>


    <script>
        function addRow() {
            const table = document.getElementById('inputTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();

            for (let i = 0; i < 4; i++) {
                const newCell = newRow.insertCell(i);
                const input = document.createElement('input');
                input.type = 'text';
                input.name = `field${i+1}[]`;  
                newCell.appendChild(input);
            }
        }
    </script>