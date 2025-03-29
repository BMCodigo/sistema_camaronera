<?php 
    $objeto = new corrida(); // Configurar la zona horaria de Guayaquil
    date_default_timezone_set('America/Guayaquil');
?>

    <div class="row" style="margin-left:9%;">
        <div class="col-6">
            <div class="card">
                <div class="card-header" style="background: #404e67;">
                    <h6 class="text-white" style="margin:auto;">Control poblacional</h6>
                </div>
                <div class="card-body">
                    <div class="mb-20">
                        <form onsubmit="return poblacion()" action="../controllers/insert-poblacion.php" method="post">

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
                                <label class="col-sm-4 col-lg-5 col-form-label">Fecha de peso</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="fechaActualModal" id="fechaActualModalPesos" readonly style="background: none;">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Seleccione piscina</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select class="form-control" name="piscina" id="piscina">
                                            <?php

                                            $objeto_tabla_piscina = new corrida();
                                            $sql_tabla_piscina = "SELECT piscinas, descripcion_piscina, hectareas FROM piscina WHERE id_camaronera = '$camaronera'";
                                            $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                                            foreach ($data as $value) {
                                            ?>
                                                <option value="<?php echo $value['piscinas']; ?>">
                                                    <?php echo $value['descripcion_piscina'].' / Ha '.$value['hectareas']; ?>
                                                </option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Tipo de marea </label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select class="form-control" name="tipo" id="tipo">
                                            <option value="Aguaje">Aguaje</option>
                                            <option value="Quiebra">Quiebra</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Camarones totales</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="cantidad_animales" name="cantidad_animales" value="2024.00" min="1" max="999999">
                                        <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Numero de lance</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="lances" name="lances" value="10.00" min="1" max="999999">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Area de atarraya</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="atarraya" name="atarraya" value="8.00" min="1" max="999999">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Batimetria</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="bactimetria" name="bactimetria" value="1.52">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Muertos rojos</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="muertos_rojos" name="muertos_rojos" value="5.00">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Muertos frescos</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="muertos_frescos" name="muertos_frescos" value="5.00">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Enfermos (color T)</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="enfermos" name="enfermos" value="5.00">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">% de Muda</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="number" step="any" class="form-control" id="muda" name="muda" value="10">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Tallas </label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <select class="form-control" name="talla" id="talla">
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-4 col-lg-5 col-form-label">Atarrayero</label>
                                <div class="col-sm-8 col-lg-7">
                                    <div class="input-group">
                                        <input type="text" step="any" class="form-control" id="encargado_poblacion" name="encargado_poblacion" placeholder="Nombre de la persona que realizar la poblacion">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <table class="table table-bordered mt-5">
                                <thead class="text-white mt-5">
                                <tr>
                                    <th scope="col" style="background: #404e67; color: white;">Camarones totales</th>
                                    <th scope="col" style="background: #404e67; color: white;">Camarones por lance</th>
                                    <th scope="col" style="background: #404e67; color: white;">Camarones por Ha</th>
                                    <th scope="col" style="background: #404e67; color: white;">Camarones por m2</th>
                                    <th scope="col" style="background: #404e67; color: white;">Muertos rojos</th>
                                    <th scope="col" style="background: #404e67; color: white;">Muertos frescos</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>

                            

                            <center><button class="btn btn-danger btn-sm text-light mt-3" type="submit">guardar datos de poblacional</button></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-5">
            <div class="card">
                <div class="card-header" style="background: #404e67;">
                    <h6 class="text-white" style="margin:auto;">Poblacional registrado de los ultimos 15 dias</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm text-center">
                        <thead style="background: #1c51a0;">
                            <tr>
                            <th class="text-white">Fecha</th>
                            <th class="text-white">Piscina</th>
                            <th class="text-white">Ind/m2</th>
                            <th class="text-white">Dens. Ha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
    
                                $objeto_tabla_piscina = new corrida();
                                $sqlPoblacion ="SELECT * FROM registro_poblacion WHERE id_camaronera = '$camaronera' ORDER BY fechaActual  DESC LIMIT 20";
                                $data = $objeto_tabla_piscina->mostrar($sqlPoblacion);
    
                                foreach($data as $p): 
                                    $fecha_original = $p['fechaActual']; 
                                    // Crear un objeto DateTime
                                    $fecha = DateTime::createFromFormat('Y-m-d', $fecha_original);
                                    // Convertir al nuevo formato
                                    $fecha_formateada = $fecha->format('Y-M-d');
                                    // Reemplazar los meses en inglés por español
                                    $meses_esp = [
                                        'Jan' => 'ene', 'Feb' => 'feb', 'Mar' => 'mar', 
                                        'Apr' => 'abr', 'May' => 'may', 'Jun' => 'jun', 
                                        'Jul' => 'jul', 'Aug' => 'ago', 'Sep' => 'sep', 
                                        'Oct' => 'oct', 'Nov' => 'nov', 'Dec' => 'dic'
                                    ];
    
                                    $fecha_formateada = strtr($fecha_formateada, $meses_esp);
                            ?>
                            <tr>
                                <td><?php echo $fecha_formateada; ?></td>
                                <td><?php echo $p['id_piscina']; ?></td>
                                <td><?php echo number_format(($p['cantidad_animales_totales'] / $p['lances'])/$p['atarraya'],2);  ?></td>
                                <td><?php echo number_format((($p['cantidad_animales_totales'] / $p['lances'])/$p['atarraya'])*10000,0); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    });

    document.getElementById('fechaActualModalPesos').value = new Date().toDateInputValue();

    function poblacion() {

        var smspre = confirm(" Esta seguro que desea finalizar ?");
        if (smspre) {
            return true;
        } else {
            return false;
        }
    }

    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        var cantidadAnimales = document.getElementById('cantidad_animales');
        var lances = document.getElementById('lances');
        var atarraya = document.getElementById('atarraya');
        var piscinaSelect = document.getElementById('piscina');
        var rojosSelect = document.getElementById('muertos_rojos');
        var frescosSelect = document.getElementById('muertos_frescos');
        
        function updateTable() {
            var camaronesTotales = parseFloat(cantidadAnimales.value) || 0;
            var numeroLances = parseFloat(lances.value) || 1; // evitar divisi��n por cero
            var areaAtarraya = parseFloat(atarraya.value) || 1; // evitar divisi��n por cero
            var muertosRojos = parseFloat(rojosSelect.value) || 0;
            var muertosFrescos = parseFloat(frescosSelect.value) || 0;

            var camaronesPorLance = (camaronesTotales / numeroLances).toFixed(2);
            var camaronesPorM2 = (camaronesPorLance / areaAtarraya).toFixed(2);
            var camaronesPorHa = (camaronesPorM2 * 10000).toFixed(0);
            var ratioMuertosRojos = (muertosRojos / camaronesTotales * 100).toFixed(2) + '%';
            var ratioMuertosFrescos = (muertosFrescos / camaronesTotales * 100).toFixed(2) + '%';

            // Actualiza la tabla
            var tableBody = document.querySelector('table tbody');
            tableBody.innerHTML = `
                <tr>
                    <th scope="row">${camaronesTotales}</th>
                    <td>${camaronesPorLance}</td>
                    <td>${camaronesPorHa}</td>
                    <td>${camaronesPorM2}</td>
                    <td>${ratioMuertosRojos}</td>
                    <td>${ratioMuertosFrescos}</td>
                </tr>
            `;
        }

        // Event listeners para actualizar la tabla en tiempo real
        cantidadAnimales.addEventListener('input', updateTable);
        lances.addEventListener('input', updateTable);
        atarraya.addEventListener('input', updateTable);
        rojosSelect.addEventListener('input', updateTable);
        frescosSelect.addEventListener('input', updateTable);
        piscinaSelect.addEventListener('change', updateTable);

        // Inicializa la tabla con los valores por defecto
        updateTable();
    });

</script>