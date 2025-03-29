<div class="row" style="margin: auto;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" style="background: #404e67;"><button style="background:green;color:#ffffff;"
                    onclick="Reload()">Actualizar</button>
                <h6 class="text-white" style="margin:auto;">ALIMENTACION DIARIA PISCINAS DE ENGORDE</h6>
            </div>
            <div class="card-body">
                <div class="dt-responsive">
                    <form onsubmit="return alim_engorde()" action="../controllers/insert-alimento-engorde.php"
                        method="post">
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

                            <label class="col-sm-6 col-lg-6 col-form-label">Fecha de alimentacion</label>
                            <div class="col-sm-6 col-lg-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="fechaActual" id="fechaActual" readonly  
                                        style="background: none;">
                                    <input type="hidden" name="encargado" value="<?php echo $id_usuario; ?>">
                                   
                                </div>
                            </div>
                        </div>
                        <?php
                        #validar piscinas en proceso
                        $sql_proceso = "SELECT id_piscina, id_corrida, estado FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_piscina ASC";
                        $data_proceso = $objeto_tabla_camaronera->mostrar($sql_proceso);
                        ?>
                        <div class="table col-12" style="width:100%">

                            <table id="scr-vtr-dynamic" class="table table-responsive table-bordered nowrap">
                                <thead>
                                    <tr class="text-white text-center">
                                        <th colspan="7" class="bg-dark">
                                            <span class="text-white"> ALIMENTACIÓN </span>
                                        </th>
                                    </tr>
                                    <tr class="text-center">
                                        <th style="background: #404e67; color:white;"># PS</th>
                                        <th style="background: #404e67; color:white;">Balanceado</th>
                                        <th style="background: #404e67; color:white;">Dosis real </br> alimentada</th>
                                        <th style="background: #404e67; color:white;">Sobrante</th>
                                        <th style="background: #404e67; color:white;">Muda</th>
                                        <th style="background: #404e67; color:white;">Cant. total </br> mf & mr</th>
                                        <th style="background: #404e67; color:white;">Observacion </br> (no se alimenta)
                                        </th>
                                        
                                    </tr>
                                </thead>

                                <tbody class="fromtime">
                                    <?php foreach($data_proceso as $index => $key): ?>
                                    <tr class="text-center">
                                        <td>
                                            <div class="container">
                                                <input type="number" class="inputs text-center" name="piscina[]"
                                                    id="piscina_<?php echo $index; ?>" step="any"
                                                    value="<?php echo $key['id_piscina']; ?>">
                                                <input type="hidden" class="inputs text-center" name="corrida[]"
                                                    id="corrida_<?php echo $index; ?>" step="any"
                                                    value="<?php echo $key['id_corrida']; ?>">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="container">
                                                <div class="row">
                                                    <div>
                                                        <i id="addUno_<?php echo $index; ?>"
                                                            class="far fa-calendar-plus text-primary"
                                                            onclick="toggleInput(<?php echo $index; ?>)"></i>
                                                        <select class="select" name="tipo_alimento[]">
                                                            <option class="text-center" value="0">[Seleccione]</option>

                                                            <?php
                                                                $sqli = "SELECT k.fecha, k.tipo_balanceado, k.saldo
                                                                        FROM kardex k
                                                                        JOIN (
                                                                            SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id
                                                                            FROM kardex
                                                                            WHERE camaronera_id = '$camaronera'
                                                                            AND saldo > 0
                                                                            AND fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)
                                                                            GROUP BY tipo_balanceado
                                                                        ) max_ids
                                                                        ON k.tipo_balanceado = max_ids.tipo_balanceado
                                                                        AND k.kardex_id = max_ids.max_kardex_id
                                                                        WHERE k.saldo > 0
                                                                        AND k.fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)";

                                                                $balanceados = $objeto_tabla_camaronera->mostrar($sqli);
                                                                foreach ($balanceados as $balanceado) { 
                                                                    $sqli = "SELECT * FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento, ' ', gramaje_alimento) = '".$balanceado['tipo_balanceado']."' AND id_tipo_alimento = (SELECT MIN(id_tipo_alimento) FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento, ' ', gramaje_alimento) = '".$balanceado['tipo_balanceado']."')";
                                                                    $data = $objeto_tabla_camaronera->mostrar($sqli);
                                                                    foreach ($data as $value) {
                                                            ?>
                                                            <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                            </option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="mt-1 mb-1">
                                                    <div class="row" id="alimento_2_<?php echo $index; ?>"
                                                        style="display: none;">
                                                        <div>
                                                            <i id="deleteUno_<?php echo $index; ?>"
                                                                class="fas fa-trash-alt text-danger"
                                                                onclick="toggleInput(<?php echo $index; ?>)"></i>
                                                            <select class="select" name="tipo_alimento_2[]">
                                                                <option class="text-center" value="0">[Seleccione]</option>

                                                                <?php
                                                                    $sqli = "SELECT k.fecha, k.tipo_balanceado, k.saldo
                                                                            FROM kardex k
                                                                            JOIN (
                                                                                SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id
                                                                                FROM kardex
                                                                                WHERE camaronera_id = '$camaronera'
                                                                                AND saldo > 0
                                                                                AND fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)
                                                                                GROUP BY tipo_balanceado
                                                                            ) max_ids
                                                                            ON k.tipo_balanceado = max_ids.tipo_balanceado
                                                                            AND k.kardex_id = max_ids.max_kardex_id
                                                                            WHERE k.saldo > 0
                                                                            AND k.fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY)";

                                                                    $balanceados = $objeto_tabla_camaronera->mostrar($sqli);
                                                                    foreach ($balanceados as $balanceado) { 
                                                                        $sqli = "SELECT * FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento, ' ', gramaje_alimento) = '".$balanceado['tipo_balanceado']."' AND id_tipo_alimento = (SELECT MIN(id_tipo_alimento) FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento, ' ', gramaje_alimento) = '".$balanceado['tipo_balanceado']."')";
                                                                        $data = $objeto_tabla_camaronera->mostrar($sqli);
                                                                        foreach ($data as $value) {
                                                                ?>
                                                                <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                    <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                </option>
                                                                <?php } } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                              
                                        <td>
                                            <div class="container">
                                                <input type="number" class="inputs text-center" name="cantidad[]"
                                                    id="cantidad_<?php echo $index; ?>" step="any" value="0.0"
                                                    onkeyup="saltar(event,'input2')">
                                                <div class="">
                                                    <input type="number" class="inputs text-center" name="cantidad_2[]"
                                                        id="cantidad_2_<?php echo $index; ?>" step="any" value="0.0"
                                                        onkeyup="saltar(event,'input2')" style="display: none;">
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="container">
                                                    <select class="select" class="select" name="sobrante[]"
                                                        id="cantidad_<?php echo $index; ?>">
                                                        <option class="text-center" value="No">No</option>
                                                        <option class="text-center" value="Si">Si</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="container">
                                                    <select class="select" class="select" name="muda[]"
                                                        id="cantidad_<?php echo $index; ?>">
                                                        <option class="text-center" value="No">No</option>
                                                        <option class="text-center" value="Si">Si</option>
                                                </select>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="container">
                                                <input type="number" class="inputs text-center" name="mortalidad[]"
                                                    id="cantidad_<?php echo $index; ?>" step="any" value="0.0" >
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="container">
                                                <select class="select" class="select" name="observacion[]"
                                                    id="observacion_<?php echo $index; ?>">
                                                    <option class="text-center" value="S/N">Sin novedad</option>
                                                    <option class="text-center"
                                                        value="No se alimenta o se baja la dieta por Oxigenacion">
                                                        Oxigenacion</option>
                                                    <option class="text-center"
                                                        value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                    <option class="text-center"
                                                        value="No se alimenta o se baja la dieta por Sobrante">Sobrante
                                                    </option>
                                                    <option class="text-center"
                                                        value="No se alimenta o se baja la dieta por Raleo">Raleo
                                                    </option>
                                                    <option class="text-center"
                                                        value="No se alimenta o se baja la dieta por Poblacion">
                                                        Poblacion</option>
                                                    <option class="text-center"
                                                        value="No se alimenta o se baja la dieta por Pesca">Pesca
                                                    </option>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>

                        </div>
                        <center>
                            <button class="btn btn-danger btn-sm text-light mt-1" name="engorde" id="add-form-foot"
                                type="submit" style="display:block;">guardar datos de alimentacion</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function Reload() {
    window.location.reload(true);
}

function alim_engorde() {

    var smspre = confirm("¿ Esta seguro que desea finalizar ?");
    if (smspre) {
        return true;
    } else {
        return false;
    }
}

function toggleInput(index) {
    $("#alimento_2_" + index).toggle();
    $("#cantidad_2_" + index).toggle();
}

// Función para mostrar el botón solo entre las 06:00 AM y 11:00 AM (hora de Ecuador)
    function toggleButtonVisibility() {
        // Obtener la hora actual en la zona horaria de Ecuador (GMT-5)
        const now = new Date();
        const currentHour = now.getUTCHours() - 5; // UTC -5 para Ecuador
        
        const button = document.getElementById('add-form-foot');

        // Si la hora está entre las 6:00 AM y las 11:00 AM, mostrar el botón
        if (currentHour >= 5 && currentHour < 19) {
            button.style.display = 'block';
        } else {
            button.style.display = 'none';
        }
    }

    // Ejecutar la función al cargar la página
    window.onload = toggleButtonVisibility;

    // Opción: Comprobar cada minuto si el botón debe estar visible
    setInterval(toggleButtonVisibility, 60000); // 60000 ms = 1 minuto

</script>