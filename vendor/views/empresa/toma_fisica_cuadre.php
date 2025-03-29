<?php

$objeto = new corrida();
$conectar = new Conexion();
$conexion = $conectar->conectar();
date_default_timezone_set("America/Lima");
$fecha = date('Y-m-d');
?>



<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-9">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading"><strong>Importante !</strong></h4>
                    <p>Por medidas de valicación y cuadre de inventario, es necesario realizar el conteo y registro de
                        toma física de cada tipo de balanceado que tenemos disponible en bodega. </p>
                    <hr>
                    <p class="mb-0">Por favor registre la cantidad y tipo de balanceado que tenemos disponible.</p>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Registro de toma física de balanceado. </h3>
                    </div>
                    <div class="card-body">
                        <form action="../controllers/insert-toma-fisica.php" method="post">
                            <?php

                            $sqli = "SELECT tc.id_tipo_alimento, tc.tipo_balanceado AS descripcion_alimento, tc.disponible * 25 AS disponible FROM (SELECT tg.id_tipo_alimento, tg.tipo_balanceado, tg.cant, SUM(tg.cant) as disponible FROM (SELECT ta.id_tipo_alimento, t1.tipo_balanceado, SUM(t1.cantidad_balanceado) AS cant FROM `ingreso_balanceado` t1, tipo_alimento ta WHERE t1.camaronera ='$camaronera' AND t1.tipo_balanceado = CONCAT(ta.descripcion_alimento,' ',ta.gramaje_alimento) GROUP BY t1.tipo_balanceado UNION (SELECT ta.id_tipo_alimento, t3.tipo_balanceado, SUM(t3.cantidad_balanceado) / 25 * -1 AS tot_egre FROM egreso_balanceado t3, tipo_alimento ta WHERE t3.camaronera ='$camaronera' AND t3.cantidad_balanceado > 0 AND t3.tipo_balanceado = CONCAT(ta.descripcion_alimento, ' ', ta.gramaje_alimento) GROUP BY t3.tipo_balanceado)) tg GROUP BY tg.id_tipo_alimento) tc WHERE tc.disponible > 0 ORDER BY descripcion_alimento ASC";
                            $data = $objeto->mostrar($sqli);

                            foreach ($data as $value) {
                            ?>
                                <div class="row">
                                    <div class="col-sm-8 col-lg-10">
                                        <div class="input-group">
                                            <label class="col-sm-5 col-lg-3 col-form-label"><?php echo $value['descripcion_alimento']; ?></label>
                                            <span class="input-group-prepend">
                                                <label class="input-group-text"><i class="fas fa-cube"></i></label>
                                            </span>
                                            <input type="hidden" class="form-control" value="<?php echo $value['descripcion_alimento']; ?>" name="nombre_alimento[]">
                                            <input type="hidden" class="form-control" value="<?php echo $camaronera; ?>" name="camaronera">
                                            <input type="text" class="form-control" value="0.0" name="cantidad_alimento[]" required>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Validar toma física</button>  
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-3 mt-5 mb-3">
                <div class="alert alert-dark alert-dismissible fade show opacity-7" style="background: #10305D ;" role="alert">
                    <strong class="text-white">Balanceado disponible en bodega</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                    </button>
                </div>
                <ul class="list-group" style="margin-top: -12px;">
                    <?php

                    $sqli = "SELECT tc.id_tipo_alimento, tc.tipo_balanceado AS descripcion_alimento, tc.disponible * 25 AS disponible FROM (SELECT tg.id_tipo_alimento, tg.tipo_balanceado, tg.cant, SUM(tg.cant) as disponible FROM (SELECT ta.id_tipo_alimento, t1.tipo_balanceado, SUM(t1.cantidad_balanceado) AS cant FROM `ingreso_balanceado` t1, tipo_alimento ta WHERE t1.camaronera ='$camaronera' AND t1.tipo_balanceado = CONCAT(ta.descripcion_alimento,' ',ta.gramaje_alimento) GROUP BY t1.tipo_balanceado UNION (SELECT ta.id_tipo_alimento, t3.tipo_balanceado, SUM(t3.cantidad_balanceado) / 25 * -1 AS tot_egre FROM egreso_balanceado t3, tipo_alimento ta WHERE t3.camaronera ='$camaronera' AND t3.cantidad_balanceado > 0 AND t3.tipo_balanceado = CONCAT(ta.descripcion_alimento, ' ', ta.gramaje_alimento) GROUP BY t3.tipo_balanceado)) tg GROUP BY tg.id_tipo_alimento) tc WHERE tc.disponible > 0 ORDER BY descripcion_alimento ASC";
                    $data = $objeto->mostrar($sqli);

                    foreach ($data as $value) {
                    ?>

                        <li class="list-group-item d-flex justify-content-between align-items-center text-secondary text-xs font-weight-bold">
                            <?php echo $value['descripcion_alimento'] ?>

                        </li>
                    <?php } ?>
                </ul>
            </div>

        </div>

    </div>
</div>
 
<script type="text/javascript">
    $(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
});
        document.oncontextmenu = function(){return false;}
</script>