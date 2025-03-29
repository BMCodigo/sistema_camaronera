<div class="row">
    <div class="col-12">
        <div class="px-0 pb-2">
            <div class="media">
                <img src="../src/img/grupo_vasco_2.png" class="mr-3" alt="grupo vasco" style="width:80px;">
                <div class="media-body">
                    <h4 class="mt-0" style="color: #081665;">Gestion de raleo y pesca programadas en camaronera</h4>
                    <p style="color: #081665;"> Datos de pescas programadas.</p>
                </div>
            </div>
            <div class="card">
                </br><h5 class="text-center mt-5" style="color: #404e67;"><strong>Registro de datos de pesca</strong></h5></br>
                <form class="container mt-1" action="../controllers/gestion_pesca.php" method="POST">
                    <div class="form-group row">
                        <label for="fecha" class="col-sm-2 col-form-label">Fecha de solicitud</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fecha_gestion" name="fecha_gestion" placeholder="fecha de gestion">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Camaronera</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="camaronera" name="camaronera" onchange="cargarPiscinas(this.value)">
                                <?php

                                    $objeto_tabla_camaronera = new corrida();
                                    $sql_tabla_camaronera = "SELECT DISTINCT(id_camaronera) AS id_camaronera FROM registro_piscina_engorde WHERE estado = 'En proceso'";
                                    $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                    foreach ($data as $value) {

                                        $id_camaronera = $value['id_camaronera'];

                                        if($id_camaronera == 1){
                                            echo $camaronera = 'Darsacom';
                                        }else if($id_camaronera == 2){
                                            echo $camaronera = 'Aquacamaron';
                                        }else if($id_camaronera == 3 ){
                                            echo $camaronera = 'Jopisa';
                                        }else if($camaronera == 4){
                                            echo $camaronera = 'Aquanatura';
                                        }else if($id_camaronera == 5){
                                            echo $camaronera = 'Grupo Camaron';
                                        }else{
                                            echo $camaronera = 'Calica';
                                        }
                                    ?>
                                    <option value="<?php echo $id_camaronera; ?>">
                                        <?php  echo $camaronera; ?>
                                    </option>

                                <?php } ?>

                            </select>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Piscina</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="id_piscina" name="id_piscina">
                                <?php

                                $objeto_tabla_camaronera = new corrida();
                                $sql_tabla_camaronera = "SELECT DISTINCT(id_piscina) AS id_piscina FROM registro_piscina_engorde WHERE estado = 'En proceso' ORDER BY id_piscina ASC";
                                $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                foreach ($data as $value) {
                                ?>
                                <option value="<?php echo $value['id_piscina']; ?>">
                                    <?php echo $value['id_piscina']; ?>
                                </option>

                                <?php } ?>

                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fecha" class="col-sm-2 col-form-label">Libras solicitadas</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="libras_gestionadas" name="libras_gestionadas"
                                placeholder="50000" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fecha" class="col-sm-2 col-form-label">Peso de pesca</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="peso_pesca" name="peso_pesca" step="0.1" 
                                placeholder="28" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Tipo de cosecha</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="accion" name="accion">
                                <option value="Raleo">Raleo</option>
                                <option value="Repaña">Repania</option>
                                <!--option value="Pesca">Pesca</option-->
                                <option value="Pesca parcial">Pesca parcial</option>
                                <option value="Pesca final">Pesca final</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Empacadora</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="cliente" name="cliente">
                                <?php

                                $objeto_tabla_camaronera = new corrida();
                                $sql_tabla_camaronera = "SELECT id_cliente, descripcion_cliente FROM empacadora";
                                $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                foreach ($data as $value) {
                                ?>
                                <option value="<?php echo $value['descripcion_cliente']; ?>">
                                    <?php echo $value['descripcion_cliente']; ?>
                                </option>

                                <?php } ?>

                            </select>
                            <input type="hidden" name="encargado" id="encargado"
                                value="<?php echo $nombre .' '. $apellido; ?>">
                            <input type="hidden" name="estado" id="estado" value="Solicitado">
                        </div>
                    </div>

                    <div class="form-group row text-center">
                        <div class="col-12">
                            <button type="submit" class="btn btn-sm" style="background: #333e52; color:white;"> <i class="fas fa-save"></i> Agregar gestion</button>
                        </div>
                    </div>


                </form>
                <hr>

                <div class="container text-center">
                    <p class="text-center mt-2" style="color: #404e67;"><strong>Seleccione camaronera</strong></p>
                    <form method="POST" action="" style="margin-left:33%;">
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
                            </div></br>
                            
                            <div class="col-auto">
                                <button type="submit" class="btn btn-lg" style="background:#4785e3; color:white;"><i class="fas fa-search"></i> ver empresa </button>
                            </div>
                            <a href="index.php?page=gestion-pesca"class="btn btn-success " style="margin-left:1%;">Ver todos</a>
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

                <!--div class="d-flex flex-row-reverse bd-highlight" style="margin-right:5px;">
                    <div class="p-1 bd-highlight">
                        <div class="btn-group" role="group" aria-label="Third group"><a href="index.php?page=gestion-pesca?id=facturado&camaronera=<?php echo ucfirst(strtolower($camaronera));  ?>" type="button" class="btn btn-sm" style="background: #cecfcd; color: black;">Facturado</a></div>
                    </div>
                    <div class="p-1 bd-highlight">
                        <div class="btn-group" role="group" aria-label="Third group"><a href="index.php?page=gestion-pesca?id=procesado&camaronera=<?php echo ucfirst(strtolower($camaronera));  ?>" type="button" class="btn btn-sm" style="background: #cecfcd; color: black;">Procesado</a></div>
                    </div>
                    <div class="p-1 bd-highlight">
                        <div class="btn-group" role="group" aria-label="Third group"><a href="index.php?page=gestion-pesca&id=Solicitado&empresa=<?php echo ucfirst(strtolower($camaronera)); ?>" type="button" class="btn btn-sm" style="background: #cecfcd; color: black;"><?php echo ucfirst(strtolower($camaronera));  ?> Solicitado</a></div>
                    </div>
                </div-->

                <div class="scroll" >

                    <table class="container  tabla table-bordered mt-5 text-center" id="tablaDatos">
                        <thead>
                            <tr>
                                <!--th scope="col" class="text-white text-center">ID</th-->
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Camaronera</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Fecha solicitada</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Piscina</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Corrida</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Libras solicitadas</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Libras procesadas</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Peso de pesca</th>
                                <!--th scope="col" class="text-white text-center" style="background: #404e67; color: white;">Situacion</th-->
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Empacadora</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Tipo cosecha</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;"># Factura</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Aprobar</th>
                                <th scope="col" class="text-white text-center p-2" style="background: #404e67; color: white;">Estado</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                            // Si se selecciona una semana desde el formulario
                        

                            // Si se selecciona una camaronera desde el formulario
                                if (isset($_POST['camaronera'])) {

                                    $camaronera = $_POST['camaronera'];
                                
                                    $sqlTablaGestion = "SELECT 
                                        gp.id_gestion,
                                        gp.fecha_gestion, 
                                        gp.camaronera, 
                                        gp.id_piscina as id_piscina_gestion, 
                                        gp.id_corrida as id_corrida_gestion, 
                                        gp.libras_gestionadas,
                                        gp.accion as accion_gestion, 
                                        gp.encargado as encargardo_gestion, 
                                        gp.estado as estado_gestion,
                                        gp.numero_factura as numero_factura_gestion,
                                        gp.peso_pesca
                                    FROM 
                                        gestion_pesca gp
                                    WHERE
                                        gp.camaronera  = '$camaronera' 
                                    ORDER BY 
                                        gp.fecha_gestion DESC";

                                }else{

                                    $sqlTablaGestion = "SELECT 
                                            gp.id_gestion,
                                            gp.fecha_gestion, 
                                            gp.camaronera, 
                                            gp.id_piscina as id_piscina_gestion, 
                                            gp.id_corrida as id_corrida_gestion, 
                                            gp.libras_gestionadas,
                                            gp.accion as accion_gestion, 
                                            gp.encargado as encargardo_gestion, 
                                            gp.estado as estado_gestion,
                                            gp.numero_factura as numero_factura_gestion,
                                            gp.peso_pesca
                                        FROM 
                                            gestion_pesca gp
                                        WHERE
                                            gp.camaronera  IN ('Darsacom', 'Aquacamaron', 'Jopisa', 'Grupo Camaron', 'Calica')
                                        ORDER BY 
                                            gp.fecha_gestion DESC";
                                }

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
                                    <td><input type="text" class="form-control text-center" value="<?php echo $key['camaronera']; ?>" style="background: none; border: none; width: 115px;" readonly></td>
                                    <td><input type="text" class="form-control text-center" value="<?php echo $key['fecha_gestion']; ?>" style="background: none; border: none; width: 115px;" readonly></td>
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
                                            <td><input type="number" class="form-control text-center" id="libras_pesca" name="libras_pesca" step="0.01"  value="<?php echo $detalle['libras_gestionadas']; ?>" style="background: none; border: none; width:135px;"></td>
                                        <?php } ?>
                                        <td><input type="number" class="form-control text-center" value="<?php echo $key['peso_pesca']; ?>" style="background: none; border: none; width:115px;" readonly></td>
                                        

                                            <?php if($detalle['estado'] == 'Solicitado'){ ?>

                                            
                                                <input type="hidden" class="form-control text-center" id="estado" name="estado" value="Procesado" readonly style="background: none; border: none; width:105px;" >

                                            <?php }else if($detalle['estado'] == 'Procesado'){  ?>

                                                
                                                <input type="hidden" class="form-control text-center" id="estado" name="estado" value="Facturado" readonly style="background: none; border: none; width:105px;" >

                                            <?php } ?>

                                        

                                        <td><input type="text" class="form-control text-center" id="cliente" name="cliente" value="<?php echo $detalle['cliente']; ?>" readonly style="background: none; border: none; width:105px;" readonly></td>
                                        <input class="form-control text-center"  type="hidden" name="encargado" value="<?php echo $nombre .' '. $apellido; ?>" style="background: none; border: none; width: 125px;" readonly>
                                        <input type="hidden" name="id" name="id" value="<?php echo $idGestion; ?>">
                                        <td><input type="text" class="form-control text-center" value="<?php echo $key['accion_gestion']; ?>" style="background: none; border: none; width:97px;" readonly></td>
                                        <td>

                                        <?php if($detalle['estado'] == 'Solicitado'){ ?>

                                        <input type="text" class="form-control text-center" name="numero_factura" id="numero_factura" value="<?php echo $detalle['numero_factura']; ?>" style="background: none; border: none; width:97px;" readonly>

                                        <?php }else if($detalle['estado'] == 'Procesado' && $detalle['numero_factura'] == 'S/N'){ ?>

                                        <input type="text" class="form-control text-center" value="" name="numero_factura" id="numero_factura" placeholder="00000" style="background: none; border: none; width:97px;" oninput="allowOnlyNumbers(this)">
                                            
                                        <?php }else if($detalle['estado'] == 'Procesado' && $detalle['numero_factura'] != 'S/N'){ ?>
                                                
                                        <input type="text" class="form-control text-center" name="numero_factura" id="numero_factura" value="<?php echo $detalle['numero_factura']; ?>" style="background: none; border: none; width:97px;" readonly>

                                        <?php } ?>
                                        </td>

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
                                            <td id="estados_liquidacion">
                                                <?php 

                                                    $sqlFactura = "SELECT id_facturado, estado, numero_factura FROM gestion_pesca_facturada WHERE camaronera = '$camaronera' AND id_facturado = '$idGestion' LIMIT 1";
                                                    $data = $conectar->mostrar($sqlFactura); 

                                                    foreach($data as $f):

                                                        $idFactura = $f['id_facturado'];
                                                        $estadoFactura = $f['estado'];
                                                        $numero_factura = $f['numero_factura'];
                                                ?>

                                                        <?php if($estadoFactura == 'Solicitado'){ ?>
                                                            <input type="text" class="form-control text-center" id="estado" name="estado" value="<?php echo $estadoFactura; ?>" readonly style="background: #eaeaea; color: black; border: none; width:105px;" readonly>
                                                        <?php }else if($estadoFactura == 'Procesado') { ?>
                                                        <input type="text" class="form-control text-center" id="estado" name="estado" value="<?php echo $estadoFactura; ?>" readonly style="background: #feccaf; color: black; border: none; width:105px;" readonly>
                                                        <?php }else{ ?>
                                                        <input type="text" class="form-control text-center" id="estado" name="estado" value="<?php echo $estadoFactura; ?>" readonly style="background: #e0feaf; color:black; border: none; width:105px;" readonly>
                                                        
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
                <br>
                <div class="mb-4" style="margin-left: 47%;">
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
            this.style.backgroundColor = "#fffff"; // Puedes cambiar el color a tu preferencia
        });
    });

    function allowOnlyNumbers(input) {
        // Elimina cualquier carácter que no sea un número
        input.value = input.value.replace(/[^0-9]/g, '');
    }

    // Crear un objeto de fecha ajustado a la zona horaria de Ecuador (America/Guayaquil)
    const fechaActual = new Date();
        const fechaEcuador = new Date(fechaActual.toLocaleString('en-ES', { timeZone: 'America/Guayaquil' }));

        // Obtener los componentes de la fecha
        const anio = fechaEcuador.getFullYear();
        const mes = String(fechaEcuador.getMonth() + 1).padStart(2, '0'); // Mes comienza desde 0, por eso +1
        const dia = String(fechaEcuador.getDate()).padStart(2, '0');

        // Formatear la fecha como YYYY-MM-DD
        const fechaFormateada = `${anio}-${mes}-${dia}`;

        // Asignar la fecha al campo de entrada
        document.getElementById('fecha_gestion').value = fechaFormateada;

        document.getElementById('peso_pesca').addEventListener('input', function (e) {
        const value = e.target.value;

        // Permitir números decimales con un punto.
        if (!/^(\d+(\.\d{0,2})?)?$/.test(value)) {
            e.target.value = value.slice(0, -1); // Elimina el último carácter si no es válido.
        }
    });

</script>

<style>
    .d-flex {
    margin-bottom: -3px; /* Espaciado entre la barra de botones y la tabla */
    margin-top:-35px;
    
}



</style>