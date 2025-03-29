<?php

error_reporting(0);
include '../models/conexion.php';
include '../models/corrida.php';

$objeto = new corrida();

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fecha_entrega = $_POST['fecha_entrega'];
$encargado = $_POST['encargado'];
$camaronera = $_POST['camaronera'];

for ($i = 0; $i < count($fecha_entrega); ++$i) {

    $select = "SELECT id_piscina, id_corrida, cantidad_balanceado, sobrante, tipo_balanceado FROM solicitud_balanceados WHERE fecha_entrega = '$fecha_entrega' AND camaronera = '$camaronera' AND id = 'Precria  ' ORDER BY id_piscina";
    $query = mysqli_query($conexion, $select);

    foreach ($query as $data) {

        $piscina = $data['id_piscina'];
        $corrida = $data['id_corrida'];
        $cantidad_alim = $data['cantidad_balanceado'];
        $sobrante = $data['sobrante'];
        $tipo_alimento = $data['tipo_balanceado'];
        $cantidad = intval($cantidad_alim - $sobrante); 

        $ban = 0;
        $tipo_alimento_comp = array();

        for ($i = 0; $i < count($tipo_alimento); ++$i) {
            if (isset($agtipo_alimento_compe[$tipo_alimento])) {
                echo  $agtipo_alimento_compe[$tipo_alimento] = $agtipo_alimento_compe[$tipo_alimento] + $cantidad;
            } else {
                $tipo_alimento_comp += array($tipo_alimento => $cantidad);
            }
        }

        for ($i = 0; $i < count($tipo_alimento); ++$i) {

            #validamos que la cantidad no sea mayor y que exista en el ingreso de balanceado
            $consulta = "SELECT IF(ti.cant-te.tot_egre > 0,ti.cant-te.tot_egre,-1) * 25 AS disponible FROM ((SELECT *, SUM(t1.cantidad_balanceado) AS cant FROM `ingreso_balanceado` t1 WHERE t1.camaronera ='$camaronera' AND t1.tipo_balanceado = '$tipo_alimento' GROUP BY t1.tipo_balanceado) UNION (SELECT 0,0,0,0,0,0,0,0 AS cant) LIMIT 1) ti, ((SELECT SUM(t3.cantidad_balanceado) / 25 AS tot_egre FROM egreso_balanceado t3 WHERE t3.camaronera ='$camaronera' AND t3.tipo_balanceado = '$tipo_alimento' GROUP BY t3.tipo_balanceado) UNION (SELECT 0) LIMIT 1) te";

            $result = $conexion->query($consulta);

            if ($result->num_rows == 0) {
                ?>
                <script>
                    alert(' ¡ No existe suficiente alimento ingresado de ' + "<?php echo $tipo_alimento; ?>" + ' para la piscina ' +
                        "<?php echo $piscina; ?>" + ' !');
                    window.location.href="../views/index.php?page=Egreso";
                </script>
                <?php
                $ban += 1;
            }

            while ($row = $result->fetch_assoc()) {
                if ($row['disponible'] < 0 || $tipo_alimento_comp[$tipo_alimento] > $row['disponible'] || $ban > 0) {
                    ?>
                        <script>
                            alert(' ¡ No existe suficiente alimento ingresado de ' + "<?php echo $tipo_alimento; ?>" + '!');
                            window.location.href="../views/index.php?page=Egreso";
                        </script>
                    <?php
                    $ban += 1;
                }
            }
            if ($ban > 0) {
                break;
            }
        }

        if ($ban == 0) {
            #recorremos la tabla mediante el array obtenido
            for ($i = 0; $i < count($piscina); ++$i) {
                #insertamos los valores en la tabla egreso balanceado
                if ($cantidad > 0) {
                    $sql = "INSERT INTO `egreso_balanceado`(`fecha_entrega`, `id_piscina`, `id_corrida`, `cantidad_balanceado`, `tipo_balanceado`, `camaronera`, `encargado`, `descripcion`, `id`, `sobrante`) 
                    VALUES((NOW()),'$piscina', '$corrida', '$cantidad', '$tipo_alimento', '$camaronera', '$encargado', 'Consumo precria', 'Precria', '0')";
                    $query = mysqli_query($conexion, $sql);
                }
            }
        }
    }

    ?>
        <script>
            alert(" ¡ Egreso aprobado ! " );
            //window.history.go(-1);
            window.location.href = "../views/index.php?page=Egreso";
        </script>
    <?php
}

?>