<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera=$_GET['datos'];

$sql = "SELECT * FROM  registro_prolateo WHERE id_camaronera = '$camaronera'";
$data = $conectar->mostrar($sql);

header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=Tabla-Prorrateo.xls');

?>

<table border="1">
    <caption> Tabla Prorrateo </caption>
    <tr>
        <th>Fecha transferencia</th>

        <th>Psc o Pre</th>

        <th>Peso transferencia</th>

        <th>Pre o Psc destino</th>
        
        <th>Animales Transf</th>
        
        <th>Cant. Balanceado</th>

    </tr>

    <?php

        foreach ($data as $value) { ?>

            <tr>
                <td><?php echo $value['fecha_alimentacion']; ?></td>

                <td><?php echo $pre=$value['id_precria']; ?></td>

                <td><?php echo $value['peso']; ?></td>

                <td><?php echo $ps=$value['id_piscina']; ?></td>

                <td><?php echo $value['cant_animales']; ?></td>

                <td>
                    <?php

                        $sql = "SELECT cantidad FROM registro_prolateo WHERE id_camaronera = '$camaronera' AND id_precria = '$pre' AND id_piscina = '$ps'";
                        $data = $conectar->mostrar($sql);
                        foreach ($data as $value) {
                            echo intval($value['cantidad']);
                        }

                    ?>
                </td>
                
            </tr>

        <?php } ?>

</table>