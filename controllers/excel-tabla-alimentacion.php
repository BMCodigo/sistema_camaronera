<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$camaronera = $_POST['camaronera'];
$psc_pre = $_POST['psc_pre'];

if($psc_pre == 'psc'){
    $excel = "SELECT * FROM registro_alimentacion_engorde WHERE id_camaronera = '$camaronera' AND (fecha_alimentacion BETWEEN '$desde' AND '$hasta' /*OR fecha_alimentacion = '2020-01-01'*/) ORDER BY fecha_alimentacion ASC";
}else if($psc_pre == 'pre'){
    $excel = "SELECT * FROM registro_alimentacion_precria WHERE id_camaronera = '$camaronera' AND (fecha_alimentacion BETWEEN '$desde' AND '$hasta' /*OR fecha_alimentacion = '2020-01-01'*/) ORDER BY fecha_alimentacion ASC";
}else{
    echo 'error en el servidor =(';
}

header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=Tabla-Alimentacion.xls');

?>

<table border="1">
    <caption> Tabla alimentacion </caption>
    <tr>
        <th>Fecha alimentacion</th>

        <th>Piscina</th>
        <th>Corrida</th>

        <th>Tipo Balanceado</th>
        <th>Cantidad en KG</th>

        <th>Tipo Balanceado #2</th>
        <th>Cantidad en KG #2</th>
    </tr>

    <?php

        $data = $conectar->mostrar($excel);
        foreach ($data as $value) { ?>

            <tr>
                <td><?php echo $value['fecha_alimentacion']; ?></td>
                <td>
                    <?php  if($psc_pre == 'pre'){ echo $value['id_precria'];}else{ echo $value['id_piscina']; } ?>
                </td>
                <td>
                    <?php  if($psc_pre == 'pre'){ echo $value['identificacion']; }else{ echo $value['id_corrida']; } ?>
                </td>
                <?php $b1=$value['id_tipo_alimento']; ?>
                <?php
                    $alim = "SELECT * FROM tipo_alimento WHERE id_tipo_alimento = '$b1'";
                    $data_alim = $conectar->mostrar($alim);
                    foreach ($data_alim as $alim) { ?>
                        <td><?php echo $alim['descripcion_alimento'].' '.$alim['gramaje_alimento']; ?></td>
                <?php } ?>
                <td><?php echo $value['cantidad']; ?></td>
                <?php  $b2=$value['id_tipo_alimento_2']; ?>
                <?php
                    $alim2 = "SELECT * FROM tipo_alimento WHERE id_tipo_alimento = '$b2'";
                    $data_alim2 = $conectar->mostrar($alim2);
                    foreach ($data_alim2 as $alim2) { ?>
                        <td><?php echo $alim2['descripcion_alimento'].' '.$alim2['gramaje_alimento']; ?></td>
                <?php } ?>
                <td><?php echo $value['cantidad_2']; ?></td>

            </tr>

        <?php } ?>

</table>