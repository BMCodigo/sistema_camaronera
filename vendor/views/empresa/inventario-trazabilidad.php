<div class="col-md-7" style="margin: auto;">
    <div class="card">
        <div class="card-header" style="background: #404e67;">
            <h6 class="text-white" style="margin: auto;">TRAZABILIDAD DE INSUMOS CAMARONERA</h6>
        </div>
        <div class="card-body">
            <form id="form-insert-run">
                <div class="form-group row">
                    <label for="camaronera" class="col-sm-4 col-form-label">Camaronera</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="camaronera" id="camaronera">
                            <?php
                            $objeto_tabla_camaronera = new corrida();
                            $sql_tabla_camaronera = "SELECT id_camaronera, descripcion_camaronera FROM camaronera";
                            $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                            foreach ($data as $value) {
                                echo "<option value='{$value['id_camaronera']}'>{$value['descripcion_camaronera']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="producto" class="col-sm-4 col-form-label">Seleccione Producto</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="producto" id="producto">
                            <option value="0">[Seleccione]</option>
                            <?php
                            $objeto_tabla_piscina = new corrida();
                            $sql_tabla_piscina = "SELECT DISTINCT(familia) FROM insumos_camaronera";
                            $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                            foreach ($data as $value) {
                                echo "<option value='{$value['familia']}'>{$value['familia']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <center>
                    <button class="btn btn-danger btn-sm text-light mt-3" id="sender" type="button" onclick="consultarConsumo()">Consultar</button>
                </center>
            </form>
        </div>
    </div>
</div>
<div id="overlay" style="display:none;z-index: 999;"></div>
<div id="weeklyConsumptionPopup" style="display:none;width:70%;margin: auto;">
    <div id="calendarTable"></div>

</div>
<div id="dailyConsumptionPopup" style="display:none;z-index:9999;width:70%;margin: auto;">
    <div id="dailyTable" style="z-index:9999;"></div>
</div>
<script>
function consultarConsumo() {
    var camaronera = document.getElementById('camaronera').value;
    var producto = document.getElementById('producto').value;
    var periodo = 1;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                displayWeeklyConsumptionPopup(data);
            } else {
                console.error('Error:', xhr.statusText);
                alert('Error fetching data. Please try again later.');
            }
        }
    };
    xhr.open('POST', '../controllers/fetch_weekly_consumption.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('camaronera=' + encodeURIComponent(camaronera) + '&producto=' + encodeURIComponent(producto));
}

function displayWeeklyConsumptionPopup(data) {
    var calendarTable = document.getElementById('calendarTable');
    var tableContent = '<h5>Consumo Semanal de Materias Primas</h5>';
    tableContent += '<table class="table table-sm table-bordered align-items-center mb-0"><thead><tr>';

    // Header row for weeks
    Object.keys(data).forEach(function(week) {
        tableContent += '<th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Semana ' + week + '</th>';
    });
    tableContent += '</tr></thead><tbody><tr>';

    // Data rows for consumption
    Object.keys(data).forEach(function(week) {
        tableContent += '<td class="align-middle text-center" style="border: 1px solid #40497C"><a href="#" onclick="showDailyDetail(\'' + week + '\')">' + data[week].total + '</a></td>';
    });
    tableContent += '</tr></tbody></table>';

    calendarTable.innerHTML = tableContent;
    document.getElementById('weeklyConsumptionPopup').style.display = 'block';
}

function showDailyDetail(week) {
 var periodo = 2;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                displayDailyDetailPopup(data);
            } else {
                console.error('Error:', xhr.statusText);
                alert('Error fetching data. Please try again later.');
            }
        }
    };
    xhr.open('POST', '../controllers/fetch_daily_consumption.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('week=' + encodeURIComponent(week));
}

function displayDailyDetailPopup(data) {
    var dailyTable = document.getElementById('dailyTable');
    var tableContent = '<h5>Detalle Diario de Consumo para la Semana</h5>';
    tableContent += '<table class="table table-bordered"><thead><tr>';

    // Header row for days
    Object.keys(data).forEach(function(day) {
        tableContent += '<th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">' + day + '</th>';
    });
    tableContent += '</tr></thead><tbody><tr>';

    // Data rows for daily consumption
    Object.keys(data).forEach(function(day) {
        tableContent += '<td class="align-middle text-center" style="border: 1px solid #40497C">' + data[day] + '</td>';
    });
    tableContent += '</tr></tbody></table>';

    dailyTable.innerHTML = tableContent;

    // Mostrar el overlay y el popup
    var overlay = document.getElementById('overlay');
    overlay.style.display = 'block';
    document.getElementById('dailyConsumptionPopup').style.display = 'block';
}

</script>
<style>
#calendarTable table, #dailyTable table {
    width: 100%;
    border-collapse: collapse;
}

#calendarTable th, #calendarTable td, #dailyTable th, #dailyTable td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

#calendarTable th, #dailyTable th {
    background-color: #f2f2f2;
    font-weight: bold;
}

#overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); 
    z-index: 100; 
    display: none;
}


</style>