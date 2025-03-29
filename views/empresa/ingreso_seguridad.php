<?php
$objeto = new corrida();
date_default_timezone_set("America/Lima");
$fecha = date('Y-m-d');

?>



<div class="card">

    <div class="card-header text-center" style="background: #404e67;"> 
        <h6 class="text-white" style="margin:auto;text-align:center">INGRESO DE INSUMOS A CAMARONERA</h6>
    </div>

    <div class="card-body">

  
        

        <div class="row mt-3">

            <div class="col-6">
                <div class="table table-sm table-responsive mb-4 mt-3">
                    <div class="scroll"><b> Detalles de compras facturadas</b>


                    <table class="table table-sm table-hover table-sm table-bordered table-striped align-items-center mb-0 overflow-auto">
                        <thead>
                            <tr class="text-center">
                                <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Fecha de </br> emision</th>
                                <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Codigo </br> factura</th>
                                <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Detalle de </br> compra</th>
                                <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Seleccion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            
                            $sql = "SELECT * FROM comprasfacturasaquapro WHERE id_camaronera = '$camaronera' AND cheklist = 'no' AND parcial = 'no' AND auditoria != 'Autorizado' GROUP BY AsientoId";
                            $data = $objeto->mostrar($sql);

                            foreach ($data as $key) {
                            ?>
                                <tr>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $key['FechaEmision']; ?></span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $key['AsientoId']; ?></span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $key['Glosa']; ?></span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <a href="index.php?page=Ingreso_seguridad&asiento=<?php echo $key['AsientoId']; ?>"  name="asiento" value="<?php echo $key['AsientoId']; ?>)">Ver</a>
                                        </span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    </div>

                </div>




            </div>

            

            <div class="col-6 mt-3">
                <div class="mb-20">
                    
                    
                        <?php 
                            

                                $asiento = $_GET['asiento'];
                                //echo '</br>';
                                $parcial = $_GET['parcial'];
                                //echo '</br>';

                                
                                if($parcial == 'parcial'){
                                    $thead = '</br>parcial';
                                }else{
                                    $thead = '</br>facturada';
                                }
                                
                                $sql = "SELECT * FROM comprasfacturasaquapro WHERE id_camaronera = '$camaronera' AND AsientoId = '$asiento' AND auditoria != 'Autorizado'";
                                $g = $objeto->mostrar($sql);

                                ?>
                                
                                <div class="text-dark">
                                    <b>Detalle de compra #</b> - <b class="text-danger"><?php echo $g[0]['AsientoId'];?></b> <hr> 
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                                    <div class="col-sm-8 col-lg-7">
                                        <div class="input-group">
                                            <?php

                                            $sqli = "SELECT DISTINCT id_camaronera FROM registro_piscina_engorde WHERE estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                            $data = $objeto->mostrar($sqli);

                                            ?>
                                            <select class="form-control" name="camaronera" id="camaronera">
                                                <?php

                                                foreach ($data as $value) {

                                                ?>
                                                    <option value="<?php echo $aux = $value['id_camaronera']; ?>">

                                                        <?php

                                                        $sqli_camaronera = "SELECT DISTINCT descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                                        $data_camaronera = $objeto->mostrar($sqli_camaronera);

                                                        foreach ($data_camaronera as $value) {

                                                        ?>
                                                            <?php echo $value['descripcion_camaronera']; ?></option>

                                            <?php }
                                                    } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <label class="col-sm-4 col-lg-5 col-form-label">Fecha de ingreso</label>
                                    <div class="col-sm-8 col-lg-7">
                                        <div class="input-group">
                                            <input type="datetime" class="form-control" name="fechaActualModal" id="fechaActual" readonly style="background: none;">
                                        </div>
                                    </div>
                                </div>

                                <div class="text-dark mt-2">
                                    <b>Glosa de compra</b> - <b class="text-danger"><?php echo $g[0]['Glosa']; ?></b> <hr> 
                                </div>
                                <form class="container mt-1" action="../controllers/insert-ingreso-camaronera-seguridad.php" method="post">
                                <table class="table table-sm table-bordered text-center" id="tablaDetalles" style="width:650px;">

                                    <thead>
                                        <tr>
                                        
                                        <th style="background: #404e67;" class="text-white">Producto</th>
                                        <th style="background: #404e67;" class="text-white">Cantidad <?php echo $thead; ?></th>
                                        <th style="background: #404e67;" class="text-white">Cantidad </br> recibida</th>
                                        <th style="background: #404e67;" class="text-white">Breve </br> descripcion</th>
                                        

                                        </tr>
                                    </thead>

                                    <?php

                                        if($parcial == 'parcial'){
                                            $parcial;
                                            //echo '</br>';
                                            $sql = "SELECT * FROM comprasfacturasaquapro 
                                            WHERE id_camaronera = '$camaronera' 
                                            AND AsientoId = '$asiento'
                                            AND ((parcial = '$parcial' AND cheklist = 'si') 
                                            OR (parcial = '$parcial' AND cheklist = 'no'))";    
                                        }

                                        $data = $objeto->mostrar($sql);
                                            foreach($data as $a){

                                                $AsientoId = $a['AsientoId'];
                                                $cantidad = $a['Cantidad'];
                                                $DescripcionCorta = $a['DescripcionCorta'];
                                                $ProductoId = $a['ProductoId'];
                                                $Glosa = $a['Glosa'];
                                                $CodigoCuentaContable = $a['CodigoCuentaContable'];  

                                                $sqlInsert= "SELECT  SUM(cantidad_balanceado) AS cantidad_balanceado_suma  FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND asientoId = '$asiento' AND cantidad_solicitada = '$cantidad'";
                                                $dataInsert = $objeto->mostrar($sqlInsert);
                                           
                                    ?>
                                    
                                    <tbody>
                                        <tr>

                                            <?php 
                                                // Verifica si la diferencia es diferente de cero antes de mostrarla
                                                $diferencia = $cantidad - $dataInsert[0]['cantidad_balanceado_suma'];

                                                if ($diferencia != 0) { ?>

                                                    <td><?php echo $DescripcionCorta; ?></td>
                                                    
                                                    <td><?php echo $diferencia; ?></td>
                                                    <!-- Otros campos ocultos o visibles si es necesario -->
                                                    <input type="hidden" name="descripcion_corta[]" readonly value="<?php echo $DescripcionCorta; ?>">
                                                    <input type="hidden" name="asiento_id[]" readonly value="<?php echo $AsientoId; ?>">
                                                    <input type="hidden" name="cantidad_solicitada[]" readonly value="<?php echo $cantidad; ?>">
                                                    <input type="hidden" name="id_producto[]" readonly value="<?php echo $ProductoId; ?>">
                                                    <input type="hidden" name="codigo_cuenta_contable[]" readonly value="<?php echo $CodigoCuentaContable; ?>">
                                                    <input type="hidden" name="encargado" readonly value="<?php echo $user; ?>">
                                                    <input type="hidden" name="camaronera" readonly value="<?php echo $camaronera; ?>">

                                                    <!-- Cantidad recibida -->
                                                    <td>
                                                        <center>
                                                            <input type="number" name="cantidad_recibida[]" class="form-control text-center" value="0.00" style="width:100px; height: 10px; margin:auto;">
                                                        </center>
                                                    </td>

                                                    <!-- Checklist -->
                                                    <td>
                                                        <div class="container">
                                                            
                                                            <select class="form-control text-center" id="exampleFormControlSelect1" name="descripcion[]" style="width:250px; height: 10px; margin:auto; border:none;">
                                                                <option value="sin novedad">Sin novedad</option>
                                                                <option value="cantidad recibida es menor a la facturada">Cantidad recibida es menor a la facturada</option>
                                                                
                                                            </select>
                                                            <input type="hidden" name="checklist[]" readonly value="autorizado">
                                                        </div>
                                                    </td>
                                                <?php } ?>

                                        </tr>
                                    </tbody>

                                    <?php }  ?>
                                </table>
                                <center><button class="btn btn-danger btn-sm text-light" id="add-form-kardex" type="submit">Registar datos</button></center> 

                        <?php ?>


                    </form>
                </div>
            </div>

        </div>

        <!--div class="row" style="margin-top: -13%;">
            <div class="col-6">
                
            </div>
        </div-->

        
    </div>

</div>
</center>



<script>



    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });

    document.oncontextmenu = function(){
        return false;
    }

    document.querySelectorAll('input[name="cantidad_recibida[]"]').forEach(input => {

        input.addEventListener('focus', function() {
            if (this.value === "0.00") {
                this.value = "";
            }
        });

        input.addEventListener('blur', function() {
            if (this.value === "") {
                this.value = "0.00";
            }
        });
    });

    document.querySelectorAll('input[name="cantidad_recibida[]"]').forEach((input, index) => {
        input.addEventListener('input', function() {
            let allValid = true; // Variable para verificar si todas las cantidades son válidas

            // Recorre todos los inputs de cantidad_recibida y verifica la condición
            document.querySelectorAll('input[name="cantidad_recibida[]"]').forEach((input, i) => {
                const cantidadRecibida = parseFloat(input.value) || 0;
                const cantidadSolicitada = parseFloat(document.querySelectorAll('input[name="cantidad_solicitada[]"]')[i].value);

                if (cantidadRecibida > cantidadSolicitada ) {
                    input.style.backgroundColor = "#fac6c6"; // Cambia el fondo a rojo
                    allValid = false; // Al menos uno no es válido
                } else {
                    input.style.backgroundColor = ""; // Restaura el fondo
                }
            });

            // Habilita o deshabilita el botón dependiendo de si todas las cantidades son válidas
            const button = document.getElementById('add-form-kardex');
            if (allValid) {
                button.style.display = ''; // Muestra el botón
            } else {
                button.style.display = 'none'; // Oculta el botón
            }
        });

    });


</script>







