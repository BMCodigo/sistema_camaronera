<?php
$objeto = new corrida();
date_default_timezone_set("America/Lima");
$fecha = date('Y-m-d');
?>



<div class="card">

    <div class="card-header text-center" style="background: #404e67;"> 
        <h6 class="text-white" style="margin:auto;text-align:center">INSUMOS REGISTRADOS EN BODEGA</h6>
    </div>

    <div class="card-body">

        <ul class="nav justify-content-center mt-1">
            <li class="nav-item">
                <a class="nav-link active" href="index.php?page=Ingreso">Detalles de compras facturadas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=IngresoBodega">Detalles de ingresos a bodega</a>
            </li>
           
        </ul>

        <hr>

        <div class="form-group container col-2 mt-4 text-center">
    <label for="exampleFormControlSelect1">Seleccion insumo</label>

    <?php
    $sql = "SELECT DISTINCT tipo_balanceado FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND checklist = 'si' GROUP BY tipo_balanceado, asientoId";
    $data = $objeto->mostrar($sql); ?>

    <select class="form-control" id="exampleFormControlSelect1" onchange="filtrarDatos()">
        <option value="">Todos los insumos</option>
        <?php foreach ($data as $key) { 
            // Eliminar solo el ÚLTIMO par de paréntesis y su contenido
            $tipo_balanceado_limpio = preg_replace('/\s*\([^)]*\)\s*$/', '', $key['tipo_balanceado']);
            $tipo_balanceado_limpio = ucfirst(strtolower($tipo_balanceado_limpio));
        ?>
        <option value="<?php echo $tipo_balanceado_limpio; ?>"><?php echo $tipo_balanceado_limpio ?></option>
        <?php } ?>
    </select>
</div>

<div class="row mt-3">
    <div class="col-6 container">
        <div class="table table-sm table-responsive mb-4 mt-3">
            <div class="scroll"><b> Detalles de ingresos a bodega</b>
            <table class="table table-sm table-hover table-sm table-bordered table-striped align-items-center mb-0 overflow-auto">
                <thead>
                    <tr class="text-center">
                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Fecha de </br> ingreso</th>
                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Codigo </br> factura</th>
                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Tipo de </br> insumo</th>
                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cantidad </br> solicitada</th>
                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cantidad </br> ingresada</th>
                        <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Encargado</th>
                    </tr>
                </thead>
                <tbody id="tablaDetalles">
                    <?php
                    $sql = "SELECT *, SUM(cantidad_balanceado) AS cantidad_balanceado_sum FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND checklist = 'si' GROUP BY tipo_balanceado, asientoId";
                    $data = $objeto->mostrar($sql);

                    foreach ($data as $key) {
                    ?>
                        <tr class="detalle-row" data-tipo="<?php echo ucfirst(strtolower($key['tipo_balanceado'])); ?>">
                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $key['fecha_ingreso']; ?></span>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $key['asientoId']; ?></span>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold"><?php $tipo_balanceado_limpio = preg_replace('/\s*\([^)]*\)\s*$/', '', $key['tipo_balanceado']); echo $tipo_balanceado_limpio = ucfirst(strtolower($tipo_balanceado_limpio)); ?></span>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $key['cantidad_solicitada']; ?></span>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid #40497C; <?php echo ($key['cantidad_balanceado_sum'] < $key['cantidad_solicitada']) ? 'background-color: #fcafa7;' : ''; ?>">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $key['cantidad_balanceado_sum']; ?></span>
                            </td>

                            <td class="align-middle text-center" style="border: 1px solid #40497C">
                                <span class="text-secondary text-xs font-weight-bold"><?php echo $key['encargado']; ?></span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>



    </div>

</div>
</center>



<script>


    $(document).keydown(function (event) {
        if (event.keyCode == 123) { // Prevent F12
            return false;
        } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
            return false;
        }
    });

    document.oncontextmenu = function(){
        return false;
    }



</script>

<script>
    function filtrarDatos() {
        var tipoSeleccionado = document.getElementById('exampleFormControlSelect1').value;
        var rows = document.querySelectorAll('.detalle-row');

        rows.forEach(function(row) {
            var tipoInsumo = row.getAttribute('data-tipo');
            if (tipoSeleccionado === "" || tipoInsumo === tipoSeleccionado) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }
</script>







