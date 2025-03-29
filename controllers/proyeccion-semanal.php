<?php
error_reporting(E_ALL);

include '../models/conexion.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();

date_default_timezone_set('America/Santiago');
$fechaActual = new DateTime();

// Consulta inicial
$SqlInicio = "SELECT rpe.id_camaronera, 
                rpe.id_piscina, 
                rpe.id_corrida, 
                rpe.hectareas, 
                rpe.densidad_transferencia, 
                rpe.estado, 
                rpe.fecha_siembra, 
                ps.dias, 
                ps.mortalidad,
                (SELECT MAX(spt.fecha_muestreo)
                FROM simulacion_proceso_test spt
                WHERE spt.id_camaronera = rpe.id_camaronera
                  AND spt.piscinas = rpe.id_piscina
                  AND spt.id_corrida = rpe.id_corrida) AS ultima_fecha_muestreo
                FROM registro_piscina_engorde rpe
                JOIN parametros_soreviviencia ps 
                ON rpe.id_camaronera = ps.id_camaronera
                WHERE rpe.id_camaronera IN (1)
                AND rpe.estado = 'En proceso'
                ORDER BY rpe.id_piscina ASC;";

$data_inicio = $conectar->mostrar($SqlInicio);

if (empty($data_inicio)) {
    echo "No se encontraron piscinas en proceso.";
    return;
}

// Tabla de resultados
echo "<table border='1' cellpadding='10'>";
echo "<tr>
        <th>Camaronera</th>
        <th>Piscina</th>
        <th>Corrida</th>
        <th>Hectáreas</th>
        <th>Días desde siembra</th>
        <th>Anim sembra.</th>
        <th>Anim proyect.</th>
        <th>% sob.</th>
        <th>Peso act.</th>
        <th>Tipo BW</th>
        <th>Inc Proyect</th>
        <th>Peso Suger</th>
        <th>Gr dia</th>
        <th>peso + Gr dia lun</th>
        <th>peso + Gr dia mar</th>
        <th>peso + Gr dia mie</th>
        <th>peso + Gr dia jue</th>
        <th>peso + Gr dia vie</th>
        <th>peso + Gr dia sab</th>
        <th>peso + Gr dia dom</th>

     
    </tr>";

// Recorrido de los datos
foreach ($data_inicio as $i) {

    $id_camaronera = $i['id_camaronera'];
    $id_piscina = $i['id_piscina'];
    $id_corrida = $i['id_corrida'];
    $hectareas = $i['hectareas'];
    $densidad_transferencia = $i['densidad_transferencia'];
    $dias = $i['dias'];
    $mortalidad = $i['mortalidad'];
    $fecha_siembra = new DateTime($i['fecha_siembra']);
    $diff = $fecha_siembra->diff($fechaActual);
    $dias_desde_siembra = $diff->days;

    // Variables inicializadas
    $mor_total = 0;
    $mor_diaria = 0;
    $densalterna = 0;
    $densidadActual = 0; 
    $densidadSiembra = 0; 

    $ultima_fecha_muestreo = $i['ultima_fecha_muestreo'];

    // Consulta secundaria para proyecciones
    $getproyect = "SELECT densidad, libras_tot, peso_final, hectareas, alim_sum2, n, gr_dias, 
                    1.00/(0.007963335+0.1387779/peso_final) AS kg_10_m, 
                    (alim_sum2 / hectareas) / n AS kg_ha_semana_m
                    FROM simulacion_proceso_test 
                    WHERE fecha_muestreo = '$ultima_fecha_muestreo'
                    AND id_camaronera = '$id_camaronera'   
                    AND piscinas = '$id_piscina'
                    AND id_bio = 'BW 7 dias'";

    $data_proyect = $conectar->mostrar($getproyect);

    foreach ($data_proyect as $i_proyect) {
        $pesoActual = $i_proyect['peso_final'];
        $gr_dias = $i_proyect['gr_dias'];
    }

    // Lógica para calcular densidad alternativa o proyectada
    if ($dias_desde_siembra <= $dias) {
        $mor_total = $densidad_transferencia * ($mortalidad / 100);
        $mor_diaria = $mor_total / $dias;
        $densalterna = intval($densidad_transferencia - ($mor_diaria * $dias_desde_siembra));
    } else {
        if (!empty($data_proyect)) {
            foreach ($data_proyect as $i_proyect) {
                $proyecto = ($i_proyect['kg_ha_semana_m'] * 10) / $i_proyect['kg_10_m'];
                $densalterna = intval($proyecto * 10000); 
            }
        }
    }

    // Ajuste de las variables de densidad
    if ($densidad_transferencia < 1) {
        $densalterna = $densidad_transferencia;
        $densidadSiembra = $densalterna;
    } else {
        $densidadActual = $densalterna;
        $densidadSiembra = $densidad_transferencia;
    }

    // Cálculo de sobrevivencia
    $sobrevivencia = $densidadSiembra > 0 ? number_format(($densidadActual / $densidadSiembra) *100, 2) : 0;



    $sqlTipoConversion = "SELECT id_tipo, tipo FROM tipos_conversion WHERE id_camaronera ='$id_camaronera' AND tipo IN('BW Combinado Darsacom', 'BW - N FRIO', 'BW - N FRIO')";
    $dataTipoConversion = $conectar->mostrar($sqlTipoConversion);

                                        
?>

<tr>
    <td id="id_camaronera"><?php echo $id_camaronera; ?></td>
    <td><?php echo $id_piscina; ?></td>
    <td><?php echo $id_corrida; ?></td>
    <td><?php echo $hectareas; ?></td>
    <td><?php echo $dias_desde_siembra; ?></td>
    <td><?php echo $densidad_transferencia; ?></td>
    <td id="densalterna_<?php echo $id_piscina; ?>"><?php echo $densalterna; ?></td>
    <td><?php echo $sobrevivencia; ?></td>
    <td><?php echo $pesoActual; ?></td>

    <!-- Select para tipo BW -->
    <td>
        <select name="tipo_bw" id="tipo_bw">
            <option value="0">Seleccione Bw</option>
            <option value="1">BW combinado Darsacom</option>
            <option value="2">BW Frio</option>
            <option value="3">BW combinado</option>
            <option value="4">Vacio 4</option>
            <option value="5">Vacio 5</option>
            <option value="6">Vacio 6</option>
            
        </select>
    </td>

    <div>

        <!-- Input de incremento sugerido -->
        <td>
            <input type="number" class="input2 form-control" id="inc_sugerido_<?php echo $id_piscina; ?>" value="0.0" 
                onchange="updatePesoSugerido(<?php echo $id_piscina; ?>, <?php echo $pesoActual; ?>)">
        </td>

        <!-- Input de peso sugerido -->
        <td>
            <input type="number" class="input2 form-control" id="peso_sugerido_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>

        <!-- Input para gr_dia, también basado en la piscina -->
        <td>
            <input type="number" class="input2 form-control" id="gr_dia_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>

        <!-- Input para peso + gr_dia lun -->
        <td>
            <input type="number" class="input2 form-control" id="peso_mas_grdia_lun_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>

        <!-- Input para peso + gr_dia mar -->
        <td>
            <input type="number" class="input2 form-control" id="peso_mas_grdia_mar_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>

        <!-- Input para peso + gr_dia mie -->
        <td>
            <input type="number" class="input2 form-control" id="peso_mas_grdia_mie_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>
            
        <!-- Input para peso + gr_dia jue -->
        <td>
            <input type="number" class="input2 form-control" id="peso_mas_grdia_jue_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>
        
        <!-- Input para peso + gr_dia vie -->
        <td>
            <input type="number" class="input2 form-control" id="peso_mas_grdia_vie_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>
        
        <!-- Input para peso + gr_dia sab -->
        <td>
            <input type="number" class="input2 form-control" id="peso_mas_grdia_sab_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>
            
        <!-- Input para peso + gr_dia dom -->
        <td>
            <input type="number" class="input2 form-control" id="peso_mas_grdia_dom_<?php echo $id_piscina; ?>" value="0" readonly>
        </td>

    </div>

    <td>
        <input type="text" id="comida_lun_<?php echo $id_piscina; ?>" readonly><br>
    </td>
    
    <td>
        <input type="text" id="comida_mar_<?php echo $id_piscina; ?>" readonly><br>
    </td>

    <td>
        <input type="text" id="comida_mie_<?php echo $id_piscina; ?>" readonly><br>
    </td>

    <td>
        <input type="text" id="comida_jue_<?php echo $id_piscina; ?>" readonly><br>
    </td>

    <td>
        <input type="text" id="comida_vie_<?php echo $id_piscina; ?>" readonly><br>
    </td>

    <td>
        <input type="text" id="comida_sab_<?php echo $id_piscina; ?>" readonly><br>
    </td>

    <td>
        <input type="text" id="comida_dom_<?php echo $id_piscina; ?>" readonly><br>
    </td>

</tr>

<?php }
echo "</table>";
?>


<script>
 
const tipo_bw_select = document.getElementById('tipo_bw');
// Agregar un evento 'change' al select para actualizar el valor dinámicamente
tipo_bw_select.addEventListener('change', function() {
    // Obtener el valor seleccionado
    const tipo_bw = tipo_bw_select.value;
    console.log(tipo_bw);  // Ver el valor seleccionado en la consola
});









function updatePesoSugerido(idPiscina, pesoActual) {











// Obtener todos los elementos con la clase 'densalterna' 
// y que tengan un ID que comienza con 'densalterna_'
let densAlternaElements = document.querySelectorAll('[id^="densalterna_"]');

// Creamos un objeto para almacenar los valores de densalterna por idPiscina
let densalternaValuesByPiscina = {};

// Recorremos cada elemento y extraemos su valor
densAlternaElements.forEach((element) => {
    // Extraemos el idPiscina del id del elemento
    let idPiscina = element.id.split('_')[1]; // Suponiendo que el id tiene el formato 'densalterna_<idPiscina>'

    // Convertimos el valor a número
    let densalternaValue = parseFloat(element.textContent); // Convertir a número

    // Si no existe el idPiscina en el objeto, lo inicializamos con un array vacío
    if (!densalternaValuesByPiscina[idPiscina]) {
        densalternaValuesByPiscina[idPiscina] = [];
    }

    // Almacenamos el valor en el array correspondiente
    densalternaValuesByPiscina[idPiscina].push(densalternaValue);
});

// Mostrar los valores en la consola
for (const [idPiscina, values] of Object.entries(densalternaValuesByPiscina)) {
    let densalternaValuesString = values.join(', '); // Unir los valores en una cadena
    console.log(`Densalterna para idPiscina ${idPiscina}: ${densalternaValuesString}`); // Mostrar en consola
}





    const tipo_bw = tipo_bw_select.value;
    // Obtener el valor de la celda con el ID 'id_camaronera'
    let id_camaronera = document.getElementById('id_camaronera').textContent;
    // Obtener el valor de incremento
    let incremento = parseFloat(document.getElementById('inc_sugerido_' + idPiscina).value);
    // Calcular gr_dia como el incremento dividido por 7
    let gr_dia = incremento / 7;
    // Calcular el nuevo peso sugerido
    let nuevoPeso = pesoActual + incremento;

// variable de suma de dias

    // Actualizar el campo de peso_sugerido y gr_dia correspondientes a la piscina
    document.getElementById('peso_sugerido_' + idPiscina).value = nuevoPeso.toFixed(2); // Limitar a 2 decimales
    document.getElementById('gr_dia_' + idPiscina).value = gr_dia.toFixed(2); // Limitar a 2 decimales

    // Calcular pesoActual + gr_dia lun y actualizar el campo correspondiente
    let pesoMasGrDiaLun = pesoActual + gr_dia;
    document.getElementById('peso_mas_grdia_lun_' + idPiscina).value = pesoMasGrDiaLun.toFixed(1); // Limitar a 1 decimal

    // Calcular pesoActual + gr_dia mar y actualizar el campo correspondiente
    let pesoMasGrDiaMar = pesoMasGrDiaLun + gr_dia;
    document.getElementById('peso_mas_grdia_mar_' + idPiscina).value = pesoMasGrDiaMar.toFixed(2); // Limitar a 2 decimales

    // Calcular pesoActual + gr_dia mie y actualizar el campo correspondiente
    let pesoMasGrDiaMie = pesoMasGrDiaMar + gr_dia;
    document.getElementById('peso_mas_grdia_mie_' + idPiscina).value = pesoMasGrDiaMie.toFixed(2); // Limitar a 2 decimales

    // Calcular pesoActual + gr_dia jue y actualizar el campo correspondiente
    let pesoMasGrDiaJue = pesoMasGrDiaMie + gr_dia;
    document.getElementById('peso_mas_grdia_jue_' + idPiscina).value = pesoMasGrDiaJue.toFixed(2); // Limitar a 2 decimales

    // Calcular pesoActual + gr_dia vie y actualizar el campo correspondiente
    let pesoMasGrDiaVie = pesoMasGrDiaJue + gr_dia;
    document.getElementById('peso_mas_grdia_vie_' + idPiscina).value = pesoMasGrDiaVie.toFixed(2); // Limitar a 2 decimales

    // Calcular pesoActual + gr_dia sab y actualizar el campo correspondiente
    let pesoMasGrDiaSab = pesoMasGrDiaVie + gr_dia;
    document.getElementById('peso_mas_grdia_sab_' + idPiscina).value = pesoMasGrDiaSab.toFixed(2); // Limitar a 2 decimales

    // Calcular pesoActual + gr_dia dom y actualizar el campo correspondiente
    let pesoMasGrDiaDom = pesoMasGrDiaSab + gr_dia;
    document.getElementById('peso_mas_grdia_dom_' + idPiscina).value = pesoMasGrDiaDom.toFixed(2); // Limitar a 2 decimales
//


    fetch('tu_script.php?id=' + tipo_bw) // Cambia esto por la ruta correcta a tu archivo PHP
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Convierte la respuesta a JSON
    })
    .then(data => {

        // Convierte a número y redondea
        let pesos = {
            lun: parseFloat(pesoMasGrDiaLun.toFixed(1)), // Cambiar topFixed a toFixed
            mar: parseFloat(pesoMasGrDiaMar.toFixed(1)), // Cambiar topFixed a toFixed
            mie: parseFloat(pesoMasGrDiaMie.toFixed(1)), // Cambiar topFixed a toFixed
            jue: parseFloat(pesoMasGrDiaJue.toFixed(1)), // Cambiar topFixed a toFixed
            vie: parseFloat(pesoMasGrDiaVie.toFixed(1)), // Cambiar topFixed a toFixed
            sab: parseFloat(pesoMasGrDiaSab.toFixed(1)), // Cambiar topFixed a toFixed
            dom: parseFloat(pesoMasGrDiaDom.toFixed(1))  // Cambiar topFixed a toFixed
        };

        // Almacena los resultados para cada día
        let resultados = {
            lun: null,
            mar: null,
            mie: null,
            jue: null,
            vie: null,
            sab: null,
            dom: null
        };

        // Busca coincidencias en los datos para cada peso
        data.forEach(item => {

            let factor = parseFloat(item.factor); // Asegúrate de que sea un número
            const tipo_bw = tipo_bw_select.value;

           // Verifica si el peso coincide con el factor
            for (let dia in pesos) {
                // Verifica que selectedValue sea del mismo tipo que item.id_biotipo
                if (pesos[dia] === factor && item.id_camaronera === id_camaronera && item.id_biotipo === tipo_bw) {
                    let comida_camaron = ((pesos[dia] * item.bodyweight) / 100).toFixed(6);

                    console.log(`Día ${dia} = peso: ${pesos[dia]} Bw: ${item.bodyweight} alim: ${comida_camaron} densalterna: ${densalternaValuesString}`);


                    // Almacena el valor en resultados
                    resultados[dia] = comida_camaron; // Guardar comida_camaron en resultados
                }
            }
        });












        
        // Enviar resultados a los inputs
        for (let dia in resultados) {
            if (resultados[dia] !== null) {
                // Asignar el valor a los inputs correspondientes
                const inputDia = document.getElementById(`comida_${dia}_${idPiscina}`); // Agregar id_piscina
                if (inputDia) {
                    inputDia.value = resultados[dia]; // Asigna el valor calculado
                }
            }
        }

        // Muestra los resultados para cada día
       /* for (let dia in resultados) {
            if (resultados[dia] !== null) {
                console.log(Bodyweight para ${dia}:, resultados[dia]);
                
            } else {
                console.log(No se encontraron coincidencias para ${dia});
            }
        }*/
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });



}


// Asegúrate de que el DOM esté completamente cargado


</script>