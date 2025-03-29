<?php

error_reporting(0);
include '../models/conexion.php';
include '../models/pesca.php';
include '../views/footer.php';

$objeto = new pesca();

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$camaronera = $_POST['camaronera'];
$precria = $_POST['precria'];
$peso_pesca = $_POST['peso_pesca'];
$piscina_destino = $_POST['piscina_destino'];
$cantidad = $_POST['libras'];
$encargado = $_POST['user'];
$valor_total = $_POST['valor_tot'];
$valor_precria = $_POST['estado'];


#validamos que la precria este selecionada 
$ban_msg = 0;
if ($precria != 0) {

    #validamos que la precria se encuentre activa (en proceso) en la siembra de piscina engorde
    $sql = "SELECT secuencial FROM registro_piscina_precria WHERE id_precria = '$precria' AND id_camaronera = '$camaronera' AND estado LIKE 'En proceso'";
    $data = $objeto->mostrar($sql);

    #verificamos que la piscina esté activa
    foreach ($data as $key) {
        $secuencial = $key['secuencial'];
    }

    #validamos que la precria se encuentre activa (en proceso) en la siembra de piscina engorde
    $sql = "SELECT * FROM registro_piscina_precria WHERE id_precria = '$precria' AND id_camaronera = '$camaronera' AND estado LIKE 'En proceso'";
    $data = $objeto->mostrar($sql);

    $sum_div = array();
    $t_a_arr = array();

    #verificamos que la piscina esté activa
    foreach ($data as $key) {
        $pre = $key['id_precria'];
        $id = $key['identificacion'];
        $estado_proceso = $key['estado'];
        $nauplio = $key['nauplio'];
        $laboratorio = $key['laboratorio'];
        $smb=intval($key['cantidad_siembra']);
        $cantidad_siembra = intval($smb-$tnsf);
    }

    $sql_pre = "SELECT cantidad FROM registro_pesca_precria WHERE id_camaronera = '$camaronera' AND id_precria = '$precria' AND estado = 'Sobrante'";
    $data = $objeto->mostrar($sql_pre);
    foreach ($data as $key_pre) {
        $tnsf=$key_pre['cantidad'];
    }

    $cantidad_siembra = intval($smb-$tnsf);

    if ($pre == $precria && $estado_proceso == 'En proceso') {

        $sumita = array_sum($cantidad);

        if ($sumita > $cantidad_siembra) {

?>
            <script>
                alert('¡ Cantidad de transferencia es mayor a la sembrada ( ' + '<?php echo intval($cantidad_siembra); ?>' + ' ) !');
                //window.history.go(-1);
                window.location.href="../views/index.php?page=Transferencia_pre_ps";
            </script>
            <?php

        } else {

            if(($piscina_destino[0] == 0 && $cantidad[0] > 0)|| ($piscina_destino[1] == 0 && $cantidad[1] > 0) || ($piscina_destino[2] == 0  && $cantidad[2] > 0)) {
                $ban_msg = 1;

                ?>

                <script>
                    alert(" ¡ Selecione pisicna destino ! ");
                    //window.history.go(-1);
                    window.location.href="../views/index.php?page=Transferencia_pre_ps";
                </script>

                <?php

            }

            if(($piscina_destino[0] > 0 && $cantidad[0] == 0)|| ($piscina_destino[1] > 0 && $cantidad[1] == 0) || ($piscina_destino[2] > 0  && $cantidad[2] == 0)) {
                $ban_msg = 1;

                ?>

                <script>
                    alert(" ¡ No ha ingresado cantidad ! ");
                    //window.history.go(-1);
                    window.location.href="../views/index.php?page=Transferencia_pre_ps";
                </script>

                <?php

            }

            for ($i = 0; $i < count($piscina_destino); ++$i) {

                #prolateo de balanceado
                $sql = "SELECT id_tipo_alimento, id_tipo_alimento_2, SUM(cantidad + cantidad_2) as acumulado FROM `registro_alimentacion_precria` WHERE id_camaronera = '$camaronera' AND id_precria = '$precria' AND identificacion = '$id'";
                $result = $conexion->query($sql);

                while ($row = $result->fetch_assoc()) {

                    $acumulado = $row['acumulado'];
                    $alim_1 = $row['id_tipo_alimento'];
                    $alim_2 = $row['id_tipo_alimento_2'];
                }

                if ($cantidad[0] > 0 && ($cantidad[1] > 0 || $cantidad[2] > 0)) {

                    $t_1 = ($sumita / $cantidad[$i]);
                    array_push($sum_div, $t_1);
                    $t_a = round($acumulado / $sum_div[$i]);
                    array_push($t_a_arr, $t_a);

                } else {

                    $t_1 = ($cantidad[$i] / $cantidad_siembra);
                    array_push($sum_div, $t_1);
                    $t_a = round($acumulado);
                    array_push($t_a_arr, $t_a);
                }
            }

            $ban_trans = 0;

            if(($ban_msg == 0)){

                for ($i = 0; $i < count($piscina_destino); ++$i) {

                    if ($piscina_destino[$i] != 0 && $cantidad[$i] > 0) {

                        $ban_trans += 1;
                        
                        if($valor_precria == 'Cosechado'){
                            $estado = 'Cosechado';
                        }else{
                            $estado = 'Sobrante';
                        }

                        #validamos el estado de la piscina en proceso
                        $sql = mysqli_query($conexion, "SELECT DISTINCT id_piscina FROM registro_piscina_engorde WHERE id_camaronera LIKE '$camaronera' AND id_piscina LIKE '$piscina_destino[$i]' AND estado = 'En proceso'");
                        $query = mysqli_num_rows($sql);

                        if ($query > 0) {
                            ?>

                                <script>
                                    alert(" ¡ La piscina seleccionada está en proceso ! ");
                                    //window.history.go(-1);
                                    window.location.href="../views/index.php?page=Transferencia_pre_ps";
                                </script>

                            <?php

                        }else{
                        
                            #insertamos los datos de la precria pescada en cada destino
                            $sql = "INSERT INTO `registro_pesca_precria`( `fecha_pesca`, `id_camaronera`, `id_precria`, `peso_pesca`, `piscina_destino`, `cantidad`, `identificacion`, `estado`, `nauplio`, `laboratorio`, `encargado`, `secuencial`)
                            VALUES('$fechaActual', '$camaronera', '$precria', '$peso_pesca', '$piscina_destino[$i]', '$cantidad[$i]', '$id', '$estado', '$nauplio', '$laboratorio', '$encargado', '$secuencial')";
                            $result = $conexion->query($sql);

                            #selecionamos las hectareas de la piscina destino
                            $sql_hectareas = "SELECT DISTINCT hectareas FROM piscina WHERE piscinas LIKE '$piscina_destino[$i]' AND id_camaronera = '$camaronera'";
                            $data_hectareas = $objeto->mostrar($sql_hectareas);

                            foreach ($data_hectareas as $vh) {
                                $hectareas = $vh['hectareas'];
                            }

                            #selecionamos la corrida maxima de la piscina destino
                            $sql_corrida = "SELECT MAX(id_corrida) AS id_corrida FROM registro_pesca_engorde WHERE id_piscina LIKE '$piscina_destino[$i]' AND id_camaronera = '$camaronera'";
                            $data_corrida = $objeto->mostrar($sql_corrida);

                            foreach ($data_corrida as $vc) {
                                $corrida = $vc['id_corrida'] + 1;
                            }

                            #obtenemos la densidad de la pisina destino
                            $densidad = round(($cantidad[$i] / $hectareas), 0);

                            #insertamos la nueva siembra
                            $sql_siembra = "INSERT INTO `registro_piscina_engorde`( `fecha_siembra`, `fecha_cosecha`, `id_camaronera`, `id_piscina`, `hectareas`, `id_corrida`, `peso_trasferencia`,  `densidad_transferencia`,  `cantidad_sembrada`, `nauplio`, `laboratorio`, `origen`, `estado`, `id_usuario`, `secuencial`)
                            VALUES('$fechaActual', '$fechaActual', '$camaronera', '$piscina_destino[$i]', '$hectareas', '$corrida', '$peso_pesca', '$densidad', '$cantidad[$i]', '$nauplio', '$laboratorio',  'Bifasico', 'En proceso', '$encargado', '$secuencial')";
                            $result = $conexion->query($sql_siembra);

                            #insertamos el peso de transferencia y densidad de la siembra
                            $sql_muestro = "INSERT INTO `registro_muestreo`( `fecha_muestreo`, `id_camaronera`, `id_piscina`, `id_corrida`, `peso`, `densidad`, `incremento`, `talla`, `id_usuario`) 
                            VALUES('$fechaActual', '$camaronera', '$piscina_destino[$i]', '$corrida', '$peso_pesca', '$densidad', '0.00', '0.00', '$encargado')";
                            $result = $conexion->query($sql_muestro);

                            #insertamos el alimento de la precria a una tabla
                            $sql_alimento = "INSERT INTO `registro_prolateo`(`fecha_alimentacion`, `id_camaronera`, `id_precria`, `id_piscina`, `peso`, `cant_animales`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `identificacion`, `encargado`, `secuencial`)
                            VALUES('$fechaActual', '$camaronera', '$precria', '$piscina_destino[$i]', '$peso_pesca', '$cantidad[$i]', '$alim_1', '$alim_2', '$t_a_arr[$i]', '0', '$id', '$encargado', '$secuencial')";
                            $result = $conexion->query($sql_alimento);

                            #actualizamos el estado 
                            if($valor_precria == 'Cosechado'){
                                $sqli = "UPDATE registro_piscina_precria SET estado = 'Cosechado' WHERE id_precria = '$pre' AND identificacion = '$id'";
                                $resulti = $conexion->query($sqli);

                                $sql_sobrante = "UPDATE registro_pesca_precria SET estado = 'Cosechado' WHERE id_precria = '$pre' AND identificacion = '$id' AND estado = 'Sobrante'";
                                $resulti_sobrante = $conexion->query($sql_sobrante);
                            }
                        
                        }
                    }
                }

            }
            if ($ban_trans > 0){
                ?>

                    <script>
                        alert(" ¡ Tranferencia registrada ! ");
                        //window.history.go(-1);
                        window.location.href="../views/index.php?page=Reporte-semanal";
                    </script>

                <?php
            }else if ($ban_msg == 0){
                ?>

                <script>
                    alert(" ¡ Selecione pisicna destino ! ");
                    //window.history.go(-1);
                    window.location.href="../views/index.php?page=Transferencia_pre_ps";
                </script>

                <?php
            }
        }

    } else {

        ?>
        <script>
            alert(" ¡ La precria ya fue transferida ! ", );
            //window.history.go(-1);
            window.location.href="../views/index.php?page=Transferencia_pre_ps"
        </script>

    <?php
    }
} else {

    ?>
    <script>
        alert(" ¡ No ha selecionado una precria ! ", );
        //window.history.go(-1);
        window.location.href="../views/index.php?page=Transferencia_pre_ps"
    </script>
<?php

}

?>