<?php $camaronera = $_SESSION['llc']; ?> 
<div class="modal fade bd-example-modal-lg<?php echo $id = $key['id_secuencia'];  ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <div class="col-12">
                <div class="widget bg-navy">
                    <div class="widget-body">
                        <div class="overlay">
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
                    <th class="text-white" scope="col">Cant. <br> solicitada(Kg)</th>
                    <th class="text-white" scope="col">Saldo <br> en Psc(Kg)</th>
                    <th class="text-white" scope="col">Cant. <br> despacho(Kg)</th>
                    <th class="text-white" scope="col">Destino</th>
                    <th class="text-white" scope="col">Tipo <br> balanceado</th>
                      <th class="text-white" scope="col">Grabar cambios</th>
                    </tr>
                </thead>
                <?php


                    $sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$id' AND id in ('Piscina','Precria') ORDER BY  id, id_piscina ASC";
                    $data = $objeto->mostrar($sql);
                    foreach ($data as $val) {
                ?>
                <tbody>
                    <tr>

                    <!-- inicio actualizar piscina -->
                        <td id="<?php echo 'piscina[]'.$val['id_balanceado']  ?>"><?php echo $val['id_piscina']; ?></td>
                    <!-- fin actualizar piscina -->

                    <!-- inicio actualizar solicitado -->
                        <td>
                            <input class="input-edit" type="number" style="width:100%;border:0;" 
                                id="<?php echo 'sol_cantidad_' . $val['id_balanceado']; ?>" 
                                name="cantidad[<?php echo $val['id_balanceado']; ?>]"  
                                value="<?php echo floatval($val['cantidad_balanceado']); ?>" 
                                oninput="calcularDespacho('<?php echo $val['id_balanceado']; ?>')">
                        </td>
                    <!-- fin actualizar solicitado -->

                    <!-- inicio actualizar sobrante -->
                        <td>          
                            <input class="text-dark text-center" type="number" style="width:100%;border:0;" 
                                id="<?php echo 'sobrante_' . $val['id_balanceado']; ?>" 
                                name="sobrante[<?php echo $val['id_balanceado']; ?>]"  
                                value="<?php echo floatval($val['cantidad_sobrante']); ?>" readonly>
                        </td>
                    <!-- fin actualizar sobrante -->

                    <!-- inicio actualizar despacho -->
                        <td id="<?php echo 'despachoTd_' . $val['id_balanceado']; ?>">
                            <input class="text-center" type="number" style="width:100%;border:0;" 
                                id="<?php echo 'resultado_despacho_' . $val['id_balanceado']; ?>" 
                                name="despacho[<?php echo $val['id_balanceado']; ?>]"  
                                value="<?php echo floatval($val['cantidad_despacho']); ?>" readonly>
                        </td>
                    <!-- fin actualizar despacho -->

                    <!-- inicio actualizar destino -->
                        <?php if(  $val['id'] == 'Precria'){ ?>
                            <td style="color:  #f7875d ; "><b><?php echo $val['id']; ?></b></td>
                        <?php }else{ ?> 
                            <td style="color:  #0e6655 ; "><b><?php echo $val['id']; ?></b></td>
                        <?php } ?>
                    <!-- fin actualizar destino -->

                    <!-- inicio actualizar tipo aabb -->
                        <td>
                            <select class="form-control" name="tipo_alimento[<?php echo $val['id_balanceado']; ?>]"  id="<?php echo 'sol_tipo[]'.$val['id_balanceado']  ?>" style="width:100%;">
                                    <option class="text-center" value="<?php echo $val['tipo_balanceado'] ?>">
                                        <?php echo $val['tipo_balanceado']; ?>
                                    </option>
                                
                                    <?php

                                        $sqli = "SELECT k.*, (k.saldo * 25) AS saldo_kg
                                        FROM kardex k
                                        JOIN (
                                            SELECT tipo_balanceado, MAX(kardex_id) AS max_id
                                            FROM kardex
                                            WHERE camaronera_id = '$camaronera'
                                            AND saldo > 0
                                            AND fecha >= CURDATE() - INTERVAL 10 DAY
                                            GROUP BY tipo_balanceado
                                        ) AS subquery
                                        ON k.kardex_id = subquery.max_id
                                        WHERE k.camaronera_id = '$camaronera'
                                        AND (k.saldo * 25) > 0
                                        ORDER BY k.tipo_balanceado";
                                        $data = $objeto->mostrar($sqli);
                                        foreach ($data as $value) {
                                            
                                    ?>

                                    <option class="text-center" value="<?php echo $value['tipo_balanceado'] ?>">
                                        <?php echo $value['tipo_balanceado']; ?>
                                    </option>

                                    <?php } ?>
                            </select>
                        </td>
                    <!-- fin actualizar tipo aabb -->

                    <td>
                        
                        <a href="javascript:void(0);" class="btn btn-warning" style="background-color:#FF9966;border:0;" 
                            title="<?php echo $val['id_balanceado']; ?>" 
                            onclick="actualizarBalanceado('<?php echo $val['id_balanceado']; ?>', this)">
                            <i class="fas fa-exchange-alt text-white"></i>
                        </a>
                                        
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

    function cambiarColor(element) {
        // Cambia el color del botón después de hacer clic
        element.style.backgroundColor = '#12712b'; 
    }

    function calcularDespacho(id_balanceado) {
        // Obtener los elementos de solicitado, sobrante y despacho
        const solicitado = parseFloat(document.getElementById('sol_cantidad_' + id_balanceado).value) || 0;
        const sobrante = parseFloat(document.getElementById('sobrante_' + id_balanceado).value) || 0;
        
        // Calcular la diferencia
        let diferencia = solicitado - sobrante;
        
        // Validar si la diferencia es negativa
        if (diferencia < 0) {
            diferencia = 0; // Establecer la diferencia como 0
            // Cambiar el estilo a color rojo con letras blancas
            const resultadoDespacho = document.getElementById('resultado_despacho_' + id_balanceado);
            const despachoTd = document.getElementById('despachoTd_' + id_balanceado);
            despachoTd.style.backgroundColor = 'rgba(252, 98, 98)';
            despachoTd.style.color = 'rgba(255, 255, 255)';
            resultadoDespacho.style.backgroundColor = 'rgba(252, 98, 98)';
            resultadoDespacho.style.color = 'rgba(255, 255, 255)';

        } else {
            // Restaurar los estilos si la diferencia no es negativa
            const resultadoDespacho = document.getElementById('resultado_despacho_' + id_balanceado);
            const despachoTd = document.getElementById('despachoTd_' + id_balanceado);
            despachoTd.style.backgroundColor = '';
            despachoTd.style.color = '';
            resultadoDespacho.style.backgroundColor = '';
            resultadoDespacho.style.color = '';
        }
        
        // Actualizar el campo de despacho con la diferencia calculada
        document.getElementById('resultado_despacho_' + id_balanceado).value = diferencia;
    }

    function actualizarBalanceado(idBalanceado, element) {
        // Cambiar el color del botón
        cambiarColor(element);

        // Añadir un retraso breve antes de mostrar el mensaje de éxito
        setTimeout(function() {
            // Mostrar mensaje de éxito
            alert('Datos actualizados con éxito');
            
            // Recoger los valores del formulario
            var cantidad = document.getElementById('sol_cantidad_' + idBalanceado).value;
            var sobrante = document.getElementById('sobrante_' + idBalanceado).value;
            var despacho = document.getElementById('resultado_despacho_' + idBalanceado).value;
            var tipoAlimento = document.getElementById('sol_tipo[]' + idBalanceado).value;

            // Redirigir a la página con los parámetros
            window.location.href = "../views/empresa/actualizar_balanceado.php?id_balanceado=" + idBalanceado + 
                "&cantidad=" + cantidad + "&sobrante=" + sobrante + "&despacho=" + despacho + "&tipo_alimento=" + tipoAlimento;
        }, 800); // Retraso de 800 ms
    }

</script>
