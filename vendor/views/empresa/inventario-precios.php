<div class="col-md-7" style="margin: auto;">
    <div class="card">
        <div class="card-header" style="background: #404e67;">
            <h6 class="text-white" style="margin: auto;">REGISTRO DE PRECIOS INSUMOS</h6>
        </div>
        <div class="card-body">
            <form id="form-register-price">
                <div class="form-group row">
                    <label for="familia" class="col-sm-4 col-form-label">Familia de Producto</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="familia" id="familia" onchange="fetchProductNames()">
                            <option value="0">[Seleccione]</option>
                            <?php
                            $objeto_tabla_familia = new corrida();
                            $sql_tabla_familia = "SELECT DISTINCT(familia) FROM insumos_camaronera";
                            $data = $objeto_tabla_familia->mostrar($sql_tabla_familia);

                            foreach ($data as $value) {
                                echo "<option value='{$value['familia']}'>{$value['familia']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="producto" class="col-sm-4 col-form-label">Nombre del Producto</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="producto" id="producto">
                            <option value="0">[Seleccione]</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fecha" class="col-sm-4 col-form-label">Fecha Vigencia</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="fecha" id="fecha">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="precio" class="col-sm-4 col-form-label">Precio</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="precio" id="precio" step="0.01">
                    </div>
                </div>
                <center>
                    <button class="btn btn-primary btn-sm text-light mt-3" id="register" type="button" onclick="registerPrice()">Registrar</button>
                </center>
            </form>
        </div>
    </div>
</div>
<script>
function fetchProductNames() {
    var familia = document.getElementById('familia').value;

    if (familia !== "0") {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var data = JSON.parse(xhr.responseText);
                    var productoSelect = document.getElementById('producto');
                    productoSelect.innerHTML = '<option value="0">[Seleccione]</option>';

                    data.forEach(function(item) {
                        productoSelect.innerHTML += '<option value="' + item.nombre + '">' + item.nombre + '</option>';
                    });
                } else {
                    console.error('Error:', xhr.statusText);
                }
            }
        };
        xhr.open('GET', '../controllers/fetch_product_names.php?familia=' + familia, true);
        xhr.send();
    }
}

function registerPrice() {
    var familia = document.getElementById('familia').value;
    var producto = document.getElementById('producto').value;
    var fecha = document.getElementById('fecha').value;
    var precio = document.getElementById('precio').value;

    if (familia === "0" || producto === "0" || !fecha || !precio) {
        alert('Por favor, complete todos los campos.');
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert('Precio registrado exitosamente.');
            } else {
                console.error('Error:', xhr.statusText);
            }
        }
    };
    xhr.open('POST', '../controllers/register_price.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('familia=' + familia + '&producto=' + producto + '&fecha=' + fecha + '&precio=' + precio);
}

function setMinDate() {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('fecha').setAttribute('min', today);
}

window.onload = function() {
    setMinDate();
};
</script>
