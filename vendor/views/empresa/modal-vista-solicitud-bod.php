<?php $camaronera = $_SESSION['llc']; ?> 
<div class="modal fade bd-example-modal-lg<?php echo $id = $key['id_secuencia'];  ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <div class="col-12">
                <div class="widget bg-navy">
                    <div class="widget-body">
                        <div class="overlay">
                           <!-- <i class="ik ik-refresh-ccw loading"></i>-->
                            <span class="overlay-text"><?php echo'CORREGIR E IMPRIMIR DESPACHO DE BALANCEADO'; ?></span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="state">
                                <h6>Solicitud </h6>
                                <h2><?php echo '# '.$id; ?></h2>
                            </div>
                            <div class="icon">
                                <i class="ik ik-trending-up"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: -20px;">

            <table class="conatiner table table-bordered table-sm">
                <thead  style="background: #404e67;">
                    <tr>
                    <th class="text-white" scope="col"># Psc</th>
                    <th class="text-white" scope="col">Cant. <br> en Psc / Sacos</th>
                    <th class="text-white" scope="col">Cant. <br> Requerida / Kg</th>
                    <th class="text-white" scope="col">Destino</th>
                    <th class="text-white" scope="col">Tipo <br> Balanceado</th>
                      <th class="text-white" scope="col">Grabar Cambios</th>
                    </tr>
                </thead>
                <?php
//                               -----------------------------------------------------------

                    $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$id' AND id = 'Piscina'";
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $val) {
                ?>
                <tbody>
                    <tr>
                    <td id="<?php echo 'piscina[]'.$val['id_balanceado']  ?>"><?php if($val['id_piscina'] == 64){ echo '17B'; }else{ echo $val['id_piscina'];} ?></td>
                    <td id="<?php echo 'sobrante[]'.$val['id_balanceado']  ?>">
                     <?php 
                    
                        if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                    echo floatval($val['sobrante']/10);
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                                  echo floatval($val['sobrante']/10);
                                                }else {
                                                  echo floatval($val['sobrante']/25);
                                                }
                         ?></td>
                    
                    
                    
                    <!--<td><?php echo $val['cantidad_balanceado']; ?></td>-->
                    <td><input class="input-edit" type="number" style="width:100%;border:0;" id="<?php echo 'sol_cantidad[]'.$val['id_balanceado']  ?>" name="cantidad[]" value="<?php echo floatval($val['cantidad_balanceado']); ?>"></td>
                    <td style="color:  #0e6655 ; "><b><?php echo $val['id']; ?></b></td>
                    <!--<td><?php echo $val['tipo_balanceado']; ?></td>-->
                                                    <td>
                                    <select class="form-control" name="tipo_alimento[]" id="<?php echo 'sol_tipo[]'.$val['id_balanceado']  ?>" style="width:100%;">
                                    
                                    
                                        <option class="text-center" value="<?php echo $val['tipo_balanceado'] ?>">
                                        <?php echo $val['tipo_balanceado']; ?>
                                        </option>
                                    
                                        <?php

                                        $sqli = "SELECT DISTINCT tipo_balanceado FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND descripcion = 'Compra' ORDER BY tipo_balanceado ASC";
                                        $data = $objeto->mostrar($sqli);
                                        foreach ($data as $value) {
                                            
                                        ?>

                                            <option class="text-center" value="<?php echo $value['tipo_balanceado'] ?>">
                                                <?php echo $value['tipo_balanceado']; ?>
                                            </option>

                                        <?php } ?>
                                    </select>
                                </td>
                                <td id="<?php $val['id_balanceado']  ?>">
                                     <a class="btn btn-warning "  style="display:;background-color:#FF9966;border:0;" id="<?php echo 'button[]'.$val['id_balanceado']  ?>"  onclick="fetchDatall(<?php echo $val['id_balanceado']; ?>)" title="<?php echo $val['id_balanceado']  ?>">
                                            <i id="<?php echo 'icon[]'.$val['id_balanceado']  ?>"class="fas fa-exchange-alt text-white"></i>  </a>
                                </td>
                    </tr>
                </tbody>

                <?php } ?>

                <?php
//                               -----------------------------------------------------------
                    $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$id' AND id = 'Precria'";
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $val) {
                ?>
                <tbody>
                    <tr>
                    <td id="<?php echo 'piscina[]'.$val['id_balanceado']  ?>"><?php echo $val['id_piscina']; ?></td>
                    <td id="<?php echo 'sobrante[]'.$val['id_balanceado']  ?>">
                        
                         <?php 
                    
                        if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                    echo floatval($val['sobrante']/10);
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                                  echo floatval($val['sobrante']/10);
                                                }else {
                                                  echo floatval($val['sobrante']/25);
                                                }
                         ?></td>
                    <!--<td><?php echo $val['cantidad_balanceado']; ?></td>-->
                      <td><input class="input-edit" type="number" style="width:100%;border:0;" id="<?php echo 'sol_cantidad[]'.$val['id_balanceado']  ?>" name="cantidad[]" value="<?php echo floatval($val['cantidad_balanceado']); ?>"></td>
                    <td style="color:  #784212; "><b><?php echo $val['id']; ?></b></td>
                    <!--<td><?php echo $val['tipo_balanceado']; ?></td>-->
                                                                        <td>
                                    <select class="form-control" id="<?php echo 'sol_tipo[]'.$val['id_balanceado']  ?>" name="tipo_alimento[]"  style="width:100%;">
                                    
                                    
                                        <option class="text-center" value="<?php echo $val['tipo_balanceado'] ?>">
                                        <?php echo $val['tipo_balanceado']; ?>
                                        </option>
                                    
                                        <?php

                                        $sqli = "SELECT DISTINCT tipo_balanceado FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND descripcion = 'Compra' ORDER BY tipo_balanceado ASC";
                                        $data = $objeto->mostrar($sqli);
                                        foreach ($data as $value) {
                                            
                                        ?>

                                            <option class="text-center" value="<?php echo $value['tipo_balanceado'] ?>">
                                                <?php echo $value['tipo_balanceado']; ?>
                                            </option>

                                        <?php } ?>
                                    </select>
                                </td>
                                 <td id="<?php $val['id_balanceado']  ?>" >
                                     <a class="btn btn-warning " style="display:;background-color:#ff9966;border:0;" id="<?php echo 'button[]'.$val['id_balanceado']  ?>" onclick="fetchDatall(<?php echo $val['id_balanceado']; ?>)"  title="<?php echo $val['id_balanceado']  ?>">
                                         <i id="<?php echo 'icon[]'.$val['id_balanceado']  ?>"class="fas fa-exchange-alt text-white"></i>  </a>
                                </td>
                    </tr>
                </tbody>

                <?php } ?>
            </table>
            <div class="contauner mb-5">
               
        <br><br>
                <a class="btn btn-danger " href="../controllers/pdf.php?id=<?php echo $id; ?>&camaronera=<?php echo $camaronera;?>" title="Imprimir"><i class="fas fa-print text-white"></i> Imprimir </a>
                      
            </div><br>      
        </div>

        </div>
    </div>
</div>
<script>
    function fetchDatall(suffix) {
document.getElementById('button[]' + suffix).style.backgroundColor = '#FF9966';
var ajaxValue = '<?php echo $_SESSION['ajax']; ?>';   
var camaroneras = '<?php echo $_SESSION['llc']; ?>'; 
var piscinas =  document.getElementById('piscina[]' + suffix).innerText;  
var tipos =  document.getElementById('sol_tipo[]' + suffix).value;     
var cantidades =  document.getElementById('sol_cantidad[]' + suffix).value;  
    var formData = new FormData();
    formData.append('tipo', tipos);
    formData.append('cantidad', cantidades);
    formData.append('suffix', suffix);
    formData.append('modpiscina', piscinas);
    formData.append('modcamaronera', camaroneras);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var tipos = response.tipo;
                var cantidades =response.cantidad //parseFloat(response.cantidad);
                var sobrantes = response.sobrante;
                var base_tipos = response.base_tipo;
                var base_cantidades =response.base_cantidad //parseFloat(response.cantidad);
                var base_sobrantes = response.base_sobrante;
                document.getElementById('button[]' + suffix).style.backgroundColor = '#009900';
                 document.getElementById('button[]' + suffix).style.border = '0';
                // alert(sobrantes);
              //  document.getElementById('icon[]' + suffix).classList.remove("fas fa-exchange-alt text-white");
               // document.getElementById('icon[]' + suffix).classList.remove("fas fa-lock text-white");
               // var suffix = parseFloat(response.suffix);
                //alert(suffix);
                //    document.getElementById('sol_tipo[]' + suffix).value = 0;
              //  document.getElementById('sol_tipo[]' + suffix).value = tipos ;
             //   document.getElementById('sol_cantidad[]' + suffix).value = cantidades;
                  if (tipos == 'Origin 0.5' || tipos == 'Origin 0.3') {
                    document.getElementById('sobrante[]' + suffix).innerText = sobrantes/10.00;
                  } else {
                 document.getElementById('sobrante[]' + suffix).innerText = sobrantes/25.00;}
                 if(base_cantidades > 0){
                        alert('Originalmente se solicito ' + base_cantidades + ' de '+ base_tipos + ' restando ' + base_sobrantes + ' en piscina' );
                 }
              
             //    document.getElementById('gestion_cambios').innerText = 'test' ;
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    xhr.open('POST', ajaxValue, true);
    xhr.send(formData);
}
</script>
