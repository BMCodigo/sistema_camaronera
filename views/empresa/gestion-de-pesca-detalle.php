<div class="row">
    <div class="col-12">
        <div class="px-0 pb-2">
            <div class="media">
                <img src="../src/img/grupo_vasco_2.png" class="mr-3" alt="grupo vasco" style="width:80px;">
                <div class="media-body">
                    <h4 class="mt-0" style="color: #081665;">Detalle de raleo y pesca</h4>
                    <p style="color: #081665;"> Datos de pescas. </p>
                </div>
            </div>
            <div class="card">
                <h5 class="text-center mt-3" style="color: #404e67;"><strong>Detalle de liquidacion de raleos y pescas</strong></h5>
                <hr>

                <div class="container text-center">
                    <p class="text-center mt-2" style="color: #404e67;"><strong>Seleccione camaronera</strong></p>
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
                </div><br>

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

                <h6 class="text-center" style="color: #4785e3; "><strong><?php echo ucfirst(strtolower($camaronera));  ?></strong></h6>
            
                <table class="container table table-bordered mt-5 text-center" id="tablaDatos">
                    <thead>
                        <tr>
                            <!--th scope="col" class="text-white text-center">ID</th-->
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Fecha solicitada</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Accion</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Piscina</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Corrida</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Libras solicitadas</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Libras procesadas</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Estado</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Cliente</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Encargado</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Aprobar</th>
                            <th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Situacion</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $sqlTablaGestion = "SELECT 
                                gp.id_gestion,
                                gp.fecha_gestion, 
                                gp.camaronera, 
                                gp.id_piscina as id_piscina_gestion, 
                                gp.id_corrida as id_corrida_gestion, 
                                gp.libras_gestionadas,
                                gp.accion as accion_gestion, 
                                gp.encargado as encargardo_gestion, 
                                gp.estado as estado_gestion
                            FROM 
                                gestion_pesca gp
                            WHERE
                                gp.camaronera  = '$camaronera'
                            ORDER BY 
                                gp.fecha_gestion DESC";

                            $data = $conectar->mostrar($sqlTablaGestion); 
                            foreach ($data as $key) :
                                $idGestion = $key['id_gestion'];
                                $camaronera = $key['camaronera'];
                                $idPiscina = $key['id_piscina_gestion'];
                                $idCorrida = $key['id_corrida_gestion'];

                            // Query para obtener datos relacionados
                            $sqlLiquidador = "SELECT * FROM gestion_pesca_liquidacion 
                                                WHERE id_liquidacion = '$idGestion' 
                                                AND camaronera = '$camaronera' 
                                                AND id_piscina = '$idPiscina' 
                                                AND id_corrida = '$idCorrida'";
                            $dataLiquidador = $conectar->mostrar($sqlLiquidador);

                        ?>

                        <tr>

                            <!-- inicio datos de gestionador -->

                                
                                <!--td><input type="text" class="form-control text-center" value="<?php echo $idGestion; ?>" style="background: none; border: none; width: 115px;" readonly></td-->
                                <td><input type="text" class="form-control text-center" value="<?php echo $key['fecha_gestion']; ?>" style="background: none; border: none; width: 115px;" readonly></td>
                                <td><input type="text" class="form-control text-center" value="<?php echo $key['accion_gestion']; ?>" style="background: none; border: none; width:97px;" readonly></td>
                                <td><?php echo $idPiscina; ?></td>
                                <td><?php echo $idCorrida; ?></td>
                                <td><input type="number" class="form-control text-center" value="<?php echo $key['libras_gestionadas']; ?>" style="background: none; border: none; width:115px;" readonly></td>
                                
                                

                            <!-- fin datos de gestionador -->


                            <!-- inicio datos de liquidador -->

                                <form action="../controllers/gestion_pesca_detalle.php" method="POST">

                                        <?php foreach ($dataLiquidador as $detalle): ?>
                                            <input type="hidden" class="form-control text-center" id="fecha_liquidacion" name="fecha_liquidacion" value="<?php echo $detalle['fecha_liquidacion']; ?>" style="background: none; border: none;">
                                        <?php if($detalle['estado'] == 'Procesado'){ ?>
                                            <td><input type="number" class="form-control text-center" value="<?php echo $detalle['libras_gestionadas']; ?>" readonly style="background: none; border: none; width:135px;"></td>
                                        <?php }else{ ?>
                                            <td><input type="number" class="form-control text-center" id="libras_pesca" name="libras_pesca" value="<?php echo $detalle['libras_gestionadas']; ?>" style="background: none; border: none; width:135px;"></td>
                                        <?php } ?>

                                        <td>

                                            <?php if($detalle['estado'] == 'Por procesar'){ ?>

                                                <select class="form-control text-center" id="estado" name="estado" style="background: none; border: none; width: 115px;">
                                                    <option value="Procesado">Procesar</option>
                                                </select>

                                            <?php }else if($detalle['estado'] == 'Procesado'){  ?>

                                                <select class="form-control text-center" id="estado" name="estado" style="background: none; border: none; width: 115px;">
                                                    <option value="Facturado">Facturar</option>
                                                </select>

                                            <?php } ?>

                                        </td>

                                        <td><input type="text" class="form-control text-center" id="cliente" name="cliente" value="<?php echo $detalle['cliente']; ?>" readonly style="background: none; border: none; width:105px;" readonly></td>
                                        <td><input class="form-control text-center"  type="text" name="encargado" value="<?php echo $nombre .' '. $apellido; ?>" style="background: none; border: none; width: 125px;" readonly></td>
                                        <input type="hidden" name="id" name="id" value="<?php echo $idGestion; ?>">

                                        <td>
                                            <?php

                                            if($detalle['estado'] != 'Procesado'){ ?>

                                                <button type="submit" class="btn btn-sm" name="liquidar" style="background:none; color: #4785e3; margin-top:-5px;"
                                                    title="Aprobar liquidacion"> Si - <i class="fas fa-cubes"></i>
                                                </button>
                                                
                                            <?php }else{ ?>
                                                    <button type="submit" class="btn btn-sm text-danger" name="facturar" style="background:none; margin-top:-5px;"
                                                    title="Aprobar liquidacion"> Si -<i class="fas fa-dollar-sign text-danger" title="Facturar liqudacion">./</i>
                                                </button>

                                
                                            <?php  } ?>

                                            </form>
                                            <td>
                                                <?php 

                                                    $sqlFactura = "SELECT id_facturado, estado FROM gestion_pesca_facturada WHERE camaronera = '$camaronera' AND id_facturado = '$idGestion' LIMIT 1";
                                                    $data = $conectar->mostrar($sqlFactura); 

                                                    foreach($data as $f):

                                                        $idFactura = $f['id_facturado'];
                                                        $estadoFactura = $f['estado'];
                                                ?>

                                                        <?php if($estadoFactura == 'Por procesar'){ ?>
                                                            <input type="text" class="form-control text-center" id="estado" name="estado" value="<?php echo $estadoFactura; ?>" readonly style="background: ; border: none; width:105px;" readonly>
                                                        <?php }else if($estadoFactura == 'Procesado') { ?>
                                                        <input type="text" class="form-control text-center" id="estado" name="estado" value="<?php echo $estadoFactura; ?>" readonly style="background: #fe7d5d; color: white; border: none; width:105px;" readonly>
                                                        <?php }else{ ?>
                                                        <input type="text" class="form-control text-center" id="estado" name="estado" value="<?php echo $estadoFactura; ?>" readonly style="background: #c9fe5d; color:black; border: none; width:105px;" readonly>
                                                        <?php } ?>

                                            </td>
                                            <?php  endforeach;   ?>


                                        </td>



                                    <?php endforeach; ?>
                                

                            <!-- fin datos de liquidador -->

                        </tr>
                    
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".toggle-detail").forEach(function(icon) {
            icon.addEventListener("click", function() {
                const target = document.getElementById(this.getAttribute("data-target"));
                if (target.style.display === "none" || target.style.display === "") {
                    target.style.display = "table-row";
                } else {
                    target.style.display = "none";
                }
            });
        });
    });
</script>