<?php

date_default_timezone_set("America/Lima");
$fechaActual = date('Y-m-d');
$objeto = new corrida();

?>

<!-- filtrador por precria -->
<form action="index.php?page=Reporte-prolateo" method="POST">
    <label for="inputEmail3" class="col-sm-3 col-form-label"> <strong><u>Filtrar precria</u></strong></label>
    <div class="form-group row">

        <div class="col-sm-2">
            <select class="form-control" name="search" id="piscina" onchange="this.form.submit()">
                <?php

                $objeto_pre = new corrida();

                if ($camaronera == 1) {
                    $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_darsacom WHERE id_camaronera = '$camaronera'";
                } else if ($camaronera == 2) {
                    $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquacamaron WHERE id_camaronera = '$camaronera'";
                } else if ($camaronera == 3) {
                    $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_jopisa WHERE id_camaronera = '$camaronera'";
                } else if ($camaronera == 4) {
                    $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_aquanatura WHERE id_camaronera = '$camaronera'";
                } else if ($camaronera == 5) {
                    $sql_pre = "SELECT id_precria, descripcion_piscina, hectareas FROM precria_grupo_camaron WHERE id_camaronera = '$camaronera'";
                } else {
                    echo 'error en el servidor :(';
                }

                $data = $objeto_pre->mostrar($sql_pre);

                ?>
                <option value="<?php echo 'Seleccione' ?>">
                    <?php echo 'Seleccione precria'; ?>
                </option>
                <option value="<?php echo 'Ver todos' ?>">
                    <?php echo 'Ver todo los registros'; ?>
                </option>
                <?php

                foreach ($data as $value_pre) {
                ?>
                    <option value="<?php echo $value_pre['id_precria']; ?>">
                        <?php echo $value_pre['descripcion_piscina']; ?>
                    </option>

                <?php } ?>
            </select>
        </div>
    </div>
</form>

<div class="scroll">
    <table class="table table-sm tab table-striped">

        <thead>
            <tr class="text-left" style="border: solid 2px #343a40">
                <th colspan="19" style="background: #343a40;">
                    <h6 class="text-white mt-2 ml-2"> Prorrateo de larva y balanceado</h6>
                </th>
            </tr>
            <tr class="text-center" style="border: solid 2px #343a40">

                <th style="background: #343a40; color:white;">Fecha </br> Transf.</th>
                
                <th style="background: #343a40; color:white;">Pre o Psc</th>

                <th style="background: #343a40; color:white;">Peso</th>

                <th style="background: #343a40; color:white;">Pre o Psc </br> destino</th>

                <th style="background: #404e67; color:white;">Animales </br> Transf</th>

                <th style="background: #404e67; color:white;">Balanceado </th>

                <th style="background: #404e67; color:white;">Estado</th>

            </tr>
        </thead>

        <tbody>
            <?php

                $buscar = $_POST['search'];
                if ($buscar != 'Seleccione' && $buscar != 'Ver todos' && $buscar != '') {
                    $sql_psc = "SELECT * FROM registro_prolateo WHERE id_camaronera = '$camaronera' AND id_precria = '$buscar' ORDER BY id_precria ASC";
                }else{
                    $sql_psc = "SELECT * FROM registro_prolateo WHERE id_camaronera = '$camaronera' ORDER BY id_precria"; //AND estado LIKE 'En proceso'
                }

                $data = $objeto->mostrar($sql_psc);
                foreach ($data as $key) {
            ?>

            <tr>

                <!-- fecha de registro -->
                <td class="align-middle text-center" data-toggle="modal"
                    data-target=".bd-example-modal-sm" style="border: 1px solid #40497C">
                    <span
                        class="text-secondary text-xs font-weight-bold"><?php echo date("d-m-y", strtotime( $key['fecha_alimentacion'])); ?></span>
                </td>

                <!--  precria  -->
                <td class="align-middle text-center" data-toggle="modal"
                    data-target=".bd-example-modal-sm" style="border: 1px solid #40497C">
                    <span
                        class="text-secondary text-xs font-weight-bold"><?php echo '# '.$key['id_precria']; ?></span>
                </td>

                <!--  preso  -->
                <td class="align-middle text-center" data-toggle="modal"
                    data-target=".bd-example-modal-sm" style="border: 1px solid #40497C">
                    <span
                        class="text-secondary text-xs font-weight-bold"><?php echo $key['peso']; ?></span>
                </td>

                <!--  piscina destino  -->
                <td class="align-middle text-center" data-toggle="modal"
                    data-target=".bd-example-modal-sm" style="border: 1px solid #40497C">
                    <span
                        class="text-secondary text-xs font-weight-bold"><?php echo '# '.$key['id_piscina']; ?></span>
                </td>

                <!--  animales transferidos  -->
                <td class="align-middle text-center" data-toggle="modal"
                    data-target=".bd-example-modal-sm" style="border: 1px solid #40497C">
                    <span
                        class="text-secondary text-xs font-weight-bold"><?php echo $key['cant_animales']; ?></span>
                </td>

                <td class="align-middle text-center" data-toggle="modal"
                    data-target=".bd-example-modal-sm" style="border: 1px solid #40497C">
                    <span
                        class="text-secondary text-xs font-weight-bold"><?php echo $key['cantidad']; ?></span>
                </td>

                <td class="align-middle text-center" data-toggle="modal"
                    data-target=".bd-example-modal-sm" style="border: 1px solid #40497C">
                    <span
                        class="text-secondary text-xs font-weight-bold"><?php echo 'Transferido' ?></span>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>
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