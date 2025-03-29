<?php date_default_timezone_set("America/Ecuador"); ?>
<?php $objeto_camaronera = new corrida(); 
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
?>

<div class="row" style="margin: auto;">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white">INGRESO DE INSUMOS CONSUMIDOS POR DIA</h6>
            </div>
            <div class="card-body">
                <form id="form-insert-run" onsubmit="return pesca()" action="../controllers/insert-inventario-general.php" method="post">
                    <div class="form-group row">
                        <label for="camaronera" class="col-sm-4 col-form-label">Camaronera</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="camaronera" id="camaronera">
                                <?php
                                $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                $data = $objeto_camaronera->mostrar($sql_tabla_camaronera);
                                foreach ($data as $value) {
                                    echo "<option value='{$value['id_camaronera']}'>{$value['descripcion_camaronera']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="fechaActual" class="col-sm-4 col-form-label">Fecha</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="fechaActual" id="fechaActual" readonly style="background: none;">
                            
                                        <input type="hidden"  class="form-control" name="encargado" id="encargado" value="<?php echo  $_SESSION['id']; ?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="producto" class="col-sm-4 col-form-label">Seleccione Producto</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="producto" id="producto" onchange="toggleAddButton()">
                                <option value="0">[Seleccione]</option>
                                <?php
                                $sql_tabla_piscina = "SELECT DISTINCT(familia) FROM `insumos_camaronera`";
                                $data = $objeto_camaronera->mostrar($sql_tabla_piscina);
                                foreach ($data as $value) {
                                    echo "<option value='{$value['familia']}'>{$value['familia']}</option>";
                                }
                                ?>
                            </select>
                            <button type="button" class="btn btn-primary mt-12" style="height:27px;width:100%;" id="addButton" onclick="addRow()" disabled>
                                <i class="fas fa-plus"></i> Añadir ítem
                            </button>
                        </div>
                    </div>

                    <table id="inputTable" class="table mt-3">
                        <thead>
                            <tr>
                                <th style="width:20%;">Producto</th>
                                <th style="width:55%;">Tipo</th>
                                <th style="width:15%;">Cantidad</th>
                                <th style="width:10%;">Piscina</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                     <input type="hidden" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>">
                    <center>
                        <button class="btn btn-danger btn-sm text-light mt-3" id="sender" type="submit">Guardar</button>
                    </center>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
         <div class="card">
        <?php
        $sqli = "SELECT id_ccostos, fecha_consumo, id_camaronera, id_piscina, id_corrida, familia, producto, cantidad, costo, responsable FROM costos_camaronera WHERE id_camaronera = '$camaronera' and fecha_consumo = CURRENT_DATE";
        $insumos = $objeto_camaronera->mostrar($sqli);
        ?>
        <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2" style="width:100%;">
            <thead>
                <tr class="text-white text-center">
                    <th colspan="7" class="bg-dark" style="height:48px;">
                        <span class="text-white">REPORTE INSUMOS CONSUMIDOS HOY</span>
                    </th>
                </tr>
                <tr class="text-center">
                 
                    <th class="text-center text-white" style="background: #404e67;">Piscina</th>
                    <th class="text-center text-white" style="background: #404e67;">Familia</th>
                    <th class="text-center text-white" style="background: #404e67;">Producto</th>
                    <th class="text-center text-white" style="background: #404e67;">Cantidad</th>
               
                </tr>
            </thead>
            <tbody>
                <?php foreach ($insumos as $insumo) { ?>
                    <tr>
                       
                        <td class="align-middle text-center" ><?php echo $insumo['id_piscina']; ?></td>
                        <td class="align-middle text-center" ><?php echo $insumo['familia']; ?></td>
                        <td class="align-middle text-center" ><?php echo $insumo['producto']; ?></td>
                        <td class="align-middle text-center" ><?php echo $insumo['cantidad']; ?></td>
                    
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div></div>

<script>
   let rowCount = 0;

function toggleAddButton() {
    const addButton = document.getElementById('addButton');
    const selectedProduct = document.getElementById('producto').value;
    addButton.disabled = selectedProduct === "0";
}

function addRow() {
    const table = document.getElementById('inputTable').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();
    rowCount++;

    const selectedProduct = document.getElementById('producto').value;
    const selectedProductText = document.getElementById('producto').options[document.getElementById('producto').selectedIndex].text;

    const productCell = newRow.insertCell(0);
    const productInput = document.createElement('input');
    productInput.type = 'hidden';
    productInput.name = `producto[]`;
    productInput.value = selectedProduct;
    productInput.id = `producto_row${rowCount}`;
    productCell.appendChild(productInput);
    productCell.appendChild(document.createTextNode(selectedProductText));

    var ajaxValue = '<?php echo $_SESSION['ajax']; ?>';
    var camaroneras = '<?php echo $_SESSION['llc']; ?>';
    var familia = document.getElementById('producto').value;
    var formData = new FormData();
    formData.append('familia', familia);
    formData.append('camaroneras', camaroneras);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                
                // Add Tipo Select
                const tipoCell = newRow.insertCell(1);
                const tipoSelect = document.createElement('select');
                tipoSelect.name = `tipo[]`;
                tipoSelect.id = `tipo_row${rowCount}`;
                tipoSelect.className = 'form-control';
                tipoSelect.innerHTML = createOptionsItems(response.tipos);
                tipoCell.appendChild(tipoSelect);

                // Add Cantidad Input
                const cantidadCell = newRow.insertCell(2);
                const cantidadInput = document.createElement('input');
                cantidadInput.type = 'number';
                cantidadInput.step = '0.01';
                cantidadInput.name = `cantidad[]`;
                cantidadInput.id = `cantidad_row${rowCount}`;
                cantidadInput.className = 'form-control';
                cantidadCell.appendChild(cantidadInput);

                // Add Piscina Select
                const piscinaCell = newRow.insertCell(3);
                const piscinaSelect = document.createElement('select');
                piscinaSelect.name = `piscina[]`;
                piscinaSelect.id = `piscina_row${rowCount}`;
                piscinaSelect.className = 'form-control';
                piscinaSelect.innerHTML = createOptionsItemspiscinas(response.piscinas);
                piscinaCell.appendChild(piscinaSelect);
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    xhr.open('POST', ajaxValue, true);
    xhr.send(formData);
}

function createOptionsItems(items) {
    return items.map(item => {
        return `<option value="${item.producto}">${item.producto}</option>`;
    }).join('');
}

function createOptionsItemspiscinas(items) {
    return items.map(item => {
        return `<option value="${item.id_piscina}_${item.id_corrida}">${item.id_piscina}</option>`;
    }).join('');
}

function confirmar() {
    return false;
}

</script>

<style>
    .card-header {
        background: #404e67;
    }
    .card-header h6 {
        margin: auto;
    }
    .text-white {
        color: #ffffff !important;
    }
    table, th, td {
        border: 0px solid black;
        border-collapse: collapse;
        padding: 0px;
    }
    .form-control, .btn {
        height: 100%;
    }
</style>
