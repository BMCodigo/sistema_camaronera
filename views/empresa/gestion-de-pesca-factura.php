<div class="row">
    <div class="col-12">
        <div class="px-0 pb-2">
            <div class="media">
                <img src="../src/img/grupo_vasco_2.png" class="mr-3" alt="grupo vasco" style="width:80px;">
                <div class="media-body">
                    <h4 class="mt-0" style="color: #081665;">Detalle de raleo y pesca faturado</h4>
                    <p style="color: #081665;"> Datos de pescas facturadas.</p>
                </div>
            </div>
            <div class="card">
                </br><h5 class="text-center mt-3" style="color: #404e67;"><strong>Detalles de raleo y pescas</strong></h5>
                <hr>

                <div class="container text-center">
                    <p class="text-center mt-2" style="color: #404e67;"><strong>Seleccione camaroenra</strong></p>
                    <form method="POST" action="" style="margin-left:37%;">
                        <div class="form-row align-items-center">
                            <div class="col-4">
                                <select class="form-control" id="camaronera" name="camaronera">
                                    <?php
                                        
                                        // Consulta para obtener solo semanas de piscinas en proceso
                                        $sqlCamaronera = "SELECT DISTINCT (descripcion_camaronera) AS camaronera FROM camaronera";
                                        
                                        $data = $objeto->mostrar($sqlCamaronera);
    
                                        foreach ($data as $key) : ?>
                                            <option value="<?php echo $key['camaronera'] ?>">
                                                <?php echo ucfirst(strtolower($key['camaronera'])); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    
                                </select>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-lg" style="background:#4785e3; color:white;"><i class="fas fa-search"></i> Ver datos </button>
                            </div>
                        </div>
                    </form>

                    <!-- inicio tabla alimentacion engorde -->
                <?php
                    // Si se selecciona una semana desde el formulario
                    if (isset($_POST['camaronera'])) {
                        $camaronera = $_POST['camaronera'];
                    } else {
                        // Si no se selecciona una semana, usamos la semana actual
                        $camaronera = 'Darsacom'; 
                    }
                ?>
                </div><br>
                <h6 class="text-center" style="color: #4785e3; "><strong><?php echo ucfirst(strtolower($camaronera));  ?></strong></h6>
                
                    <table class="container table table-bordered mt-5 text-center" id="tablaDatos">

                        <thead style="background: #404e67; color: white;">
                            <tr>
                                <th scope="col" class="text-white text-center">ID</th>
                                <th scope="col" class="text-white text-center">Fecha</th>
                                <th scope="col" class="text-white text-center">Piscina</th>
                                <th scope="col" class="text-white text-center">Corrida</th>
                                <th scope="col" class="text-white text-center">Libras solicitadas</th>
                                <th scope="col" class="text-white text-center">Libras procesadas</th>
                                <th scope="col" class="text-white text-center">Accion</th>
                                <th scope="col" class="text-white text-center">Cliente</th>
                                <th scope="col" class="text-white text-center">Estado</th>
                                <!--th scope="col" class="text-white text-center">Encargado</th-->
                                <th scope="col" class="text-white text-center">Facturar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $sqlTablaGestion = "SELECT 
                                gp.id_gestion, gp.fecha_gestion, gp.camaronera, gp.id_piscina, gp.id_corrida, gp.libras_gestionadas AS libras_solicitadas, gp.estado AS estado_solicitado, gp.cliente, gp.accion AS accion_solicitado,
                                gl.libras_gestionadas AS libras_procesadas, gl.estado as estado_procesado,
                                gf.libras_gestionadas AS libras_facturado, gf.estado AS estado_facturado, gf.encargado AS encargado_facturado  
                                FROM 
                                    gestion_pesca_facturada gf
                                JOIN 
                                    gestion_pesca gp 
                                    ON gf.camaronera = gp.camaronera AND gf.id_facturado = gp.id_gestion
                                JOIN 
                                    gestion_pesca_liquidacion gl 
                                    ON gp.id_gestion = gl.id_liquidacion
                                WHERE 
                                    gf.camaronera = 'Darsacom'
                                ORDER BY 
                                    gf.id_facturado DESC;
                                ";

                                $data = $conectar->mostrar($sqlTablaGestion); 
                                foreach($data as $key):
                            ?>
                            <form action="../controllers/gestion_pesca_factura.php" method="POST">
                                <tr>
                                    <td><?php echo $key['id_gestion']; ?></td>  
                                    <td><input type="text" class="form-control text-center" id="fecha_facturado" name="fecha_facturado[]" value="<?php echo $key['fecha_gestion']; ?>" style="background: none; border: none; width: 115px;" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="id_piscina" name="id_piscina[]" value="<?php echo $key['id_piscina']; ?>" style="background: none; border: none; width: 50px;" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="id_corrida" name="id_corrida[]" value="<?php echo $key['id_corrida']; ?>" style="background: none; border: none; width: 50px;" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="libras_solicitadas" name="libras_solicitadas[]" value="<?php echo $key['libras_solicitadas']; ?>" style="background: none; border: none; width: 90px;" readonly></td>
                                    <td><input type="number" class="form-control text-center" id="libras_procesadas" name="libras_procesadas[]" value="<?php echo $key['libras_facturado']; ?>" style="background: none; border: none; width: 125px;"></td>
                                    <td><input type="text" class="form-control text-center" id="accion_solicitado"  value="<?php echo $key['accion_solicitado']; ?>" style="background: none; border: none; width: 115px;" readonly></td>
                                    <td><input type="text" class="form-control text-center" id="cliente" name="cliente[]" value="<?php echo $key['cliente']; ?>" style="background: none; border: none; width: 100px;" readonly></td>
                                    
                                    <td>
                                        <input type="text" class="form-control text-center" id="estado" name="estado[]" value="<?php echo $key['estado_procesado']; ?>" style="border: none; width: 115px;" readonly>   
                                    </td>


                                        <input type="hidden" name="encargado[]" value="<?php echo $nombre .' '. $apellido; ?>">
                                        <input type="hidden" id="id" name="id[]" value="<?php echo $key['id_gestion']; ?>">
                                    <td>
                                        <?php
                                            if($key['estado_procesado'] == 'Procesado'){ ?>
                                            <button type="submit" class="btn btn-sm" name="liquidar"
                                                style="background:none; color: #4785e3; margin-top:-5px;"
                                                title="Aprobar liquidacion"> Si - <i class="fas fa-cloud-upload-alt"></i>
                                            </button>
                                        <?php }else if($key['estado_procesado'] != 'Procesado' || $key['estado_procesado'] != 'Por procesar'){ ?>
                                                <i class="fas fa-ban text-danger" title="Aun no se procesa"></i>
                                        <?php }else{ ?>
                                                <i class="fas fa-check-circle text-success" title="La liqudacion ya fue procesada"></i>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </form>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="mb-4" style="margin-left: 43%;">

                        <!--button type="submit" class="btn btn-sm" style="background: #4785e3; color:white;"><i class="fas fa-cloud-upload-alt"></i> grabar cambios</button-->
                        <button type="button" class="btn btn-sm" style="background: #1b8c0c; color:white;" onclick="window.location.href='../controllers/excel-liquidacion.php'"><i class="fas fa-file-excel"></i> Generar Excel</button>

                    </div>
                        
            </div>
        </div>
    </div>
</div>

<script>
    // Seleccionar todas las filas de la tabla
    document.querySelectorAll("#tablaDatos tr").forEach(row => {
        // Agregar un evento click a cada fila
        row.addEventListener("click", function() {
            // Eliminar el color de la fila previamente seleccionada
            document.querySelectorAll("#tablaDatos tr").forEach(r => r.style.backgroundColor = "");
            // Establecer el color de la fila seleccionada
            this.style.backgroundColor = "#ffffff"; // Puedes cambiar el color a tu preferencia
        });
    }); 

</script>