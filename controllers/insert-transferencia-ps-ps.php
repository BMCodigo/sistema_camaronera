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
$piscina = $_POST['piscina'];
$peso_pesca = $_POST['peso_pesca'];
$piscina_destino = $_POST['piscina_destino'];
$cantidad = $_POST['libras'];
$sembrado = $_POST['sembrado'];
$valor_total = $_POST['valor_tot'];
$encargado = $_POST['user'];
$estado = $_POST['estado'];
$flag = 0;
$flag_origen = 0;
$flag_destino = 0;
$msg = "La o las piscinas</br>";

$sum_div = array();
$t_a_arr = array();


if ($piscina != 0) {

    if ($piscina_destino[0] == 0 && $cantidad[0] == 0) {

        ?>
            <script>
                alert(" ¡ Selecione piscina destino ! ");
                //window.history.go(-1);
                window.location.href="../views/index.php?page=Transferencia_ps_ps";
            </script>

        <?php

    } else {

        if (($piscina_destino[0] == 0 && $cantidad[0] > 0) || ($piscina_destino[1] == 0 && $cantidad[1] > 0) || ($piscina_destino[2] == 0 && $cantidad[2] > 0)) {

            ?>

            <script>
                alert(" ¡ Selecione piscina destino ! ");
                //window.history.go(-1);
                window.location.href="../views/index.php?page=Transferencia"
            </script>

            <?php

        } else {

            if (($piscina_destino[0] != 0 && $cantidad[0] == 0) || ($piscina_destino[1] != 0 && $cantidad[1] == 0) || ($piscina_destino[2] != 0 && $cantidad[2] == 0)){
                //echo 'no ha puesto ninguna catidad';
                ?>
                    <script>
                        alert(" ¡ No ha ingresado cantidad ! ");
                        //window.history.go(-1);
                        window.location.href="../views/index.php?page=Transferencia_ps_ps";
                    </script>

                <?php
            }else{

                if (intval($valor_total) > intval($sembrado)) {
                    ?>
                    <script>
                        alert('¡ Cantidad de transferencia es mayor a la sembrada ( ' + '<?php echo intval($sembrado); ?>' + ' ) !');
                        //window.history.go(-1);
                        window.location.href="../views/index.php?page=Transferencia_ps_ps";
                    </script>

                    <?php

                } else {

                    if ($piscina_destino[0] == $piscina || $piscina_destino[1] == $piscina || $piscina_destino[2] == $piscina){
                        ?>
                        <script>
                            alert('¡ El origen y uno de los destinos son iguales, verifique por favor !');
                            //window.history.go(-1);
                            window.location.href="../views/index.php?page=Transferencia_pre_pre";
                        </script>

                    <?php
                    }else{
                        $sumita = array_sum($cantidad);

                        /*for ($i = 0; $i < count($piscina_destino); ++$i) {
                            #selecionamos y verificamos si la piscina está en proceso
                            $sql = "SELECT * FROM registro_piscina_engorde WHERE id_piscina = '$piscina_destino[$i]' AND id_camaronera = '$camaronera' AND estado LIKE 'En proceso'";
                            $data = $objeto->mostrar($sql);

                            foreach ($data as $key) {
                                $estado_proceso = $key['estado'];
                            }

                            #si esta en proceso no permite registrar
                            if ($estado_proceso == 'En proceso' && $piscina_destino[$i] != 0) {
                                $flag += 1;

                                $msg .= ' ' . $piscina_destino[$i] . '</br>';

                            }
                        }*/
                        
                        //$msg .= 'Ya se encuentran en proceso';

                        /*if ($flag > 0) {

                        ?>
                            <script>
                                alert(<?php echo $msg ?>);
                                //window.history.go(-1);
                                //window.location.href="../views/index.php?page=Transferencia_ps_ps";
                            </script>

                        <?php

                        } else {*/

                            for ($i = 0; $i < count($piscina_destino); ++$i) {

                                if ($piscina_destino[$i] != 0 && $cantidad[$i]) {

                                    #selecionamos el secuencial, nauplio, laboratorio de la pisicna que se esta trasnfiriendo
                                    $sql = "SELECT secuencial, nauplio, laboratorio, id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$piscina' AND id_camaronera = '$camaronera' AND estado LIKE 'En proceso'";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $key) {
                                        $secuencial = $key['secuencial'];
                                        $corrida_alim = $key['id_corrida'];
                                        $nauplio = $key['nauplio'];
                                        $laboratorio = $key['laboratorio'];
                                    }

                                    #prolateo de balanceado
                                    $sql_alim = "SELECT id_tipo_alimento, id_tipo_alimento_2, SUM(cantidad + cantidad_2) as acumulado FROM `registro_alimentacion_engorde` WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND id_corrida = '$corrida_alim'";
                                    $data_alim = $objeto->mostrar($sql_alim);

                                    foreach ($data_alim as $row) {
                                        echo $acumulado = intval($row['acumulado']);
                                        $alim_1 = $row['id_tipo_alimento'];
                                        $alim_2 = $row['id_tipo_alimento_2'];
                                    }

                                    
                                    #calculamos la cantidad que te le pertenece a cada piscina 
                                    if ($cantidad[0] > 0 && ($cantidad[1] > 0 || $cantidad[2] > 0)) {
                                        
                                        $t_1 = ($sumita / $cantidad[$i]);
                                        array_push($sum_div, $t_1);
                                        $t_a = round($acumulado / $sum_div[$i]);
                                        array_push($t_a_arr, $t_a);
                                       
                                    } else {
                                        
                                        $t_1 = ($sembrado / $cantidad[$i]);
                                        array_push($sum_div, $t_1);
                                        $t_a = round($acumulado / $sum_div[$i]);
                                        array_push($t_a_arr, $t_a);

                                        #restamos la contidad de alimento de la piscina que se selecciono como base de transferencia
                                        $new_acumulado=$acumulado-$t_a_arr[$i];

                                        $sql_alim_nue = "SELECT SUM(cantidad + cantidad_2) as new_acumulado FROM `registro_alimentacion_engorde` WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND id_corrida = '$corrida_alim'";
                                        $data_alim = $objeto->mostrar($sql_alim_nue);

                                        foreach ($data_alim as $row) {
                                            $new_acumulado_tot = $row['new_acumulado'] - $new_acumulado;
                                        }
                                        
                                    }

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

                                    #calculamos la densidad estimada
                                    $densidad = round(($cantidad[$i] / $hectareas), 0);

                                    #insertamos el peso de transferencia y densidad de la siembra
                                    $sql_muestro = "INSERT INTO `registro_muestreo`( `fecha_muestreo`, `id_camaronera`, `id_piscina`, `id_corrida`, `peso`, `densidad`, `incremento`, `talla`, `id_usuario`) 
                                    VALUES('$fechaActual', '$camaronera', '$piscina_destino[$i]', '$corrida', '$peso_pesca', '$densidad', '0.00', '0.00', '$encargado')";
                                    $query = mysqli_query( $conexion, $sql_muestro );

                                    #insertamos el alimento de la precria a una tabla
                                    $sql_alimento = "INSERT INTO `registro_prolateo`(`fecha_alimentacion`, `id_camaronera`, `id_precria`, `id_piscina`, `peso`, `cant_animales`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `identificacion`, `encargado`, `secuencial`)
                                    VALUES('$fechaActual', '$camaronera', '$piscina', '$piscina_destino[$i]', '$peso_pesca', '$cantidad[$i]', '$alim_1', '$alim_2', '$t_a_arr[$i]', '0', '$secuencial', '$encargado', '$secuencial')";
                                    $query = mysqli_query( $conexion, $sql_alimento );

                                    if ($piscina_destino[$i] > 0) {

                                        #insertamos el alimento prorrateado de la pesca
                                        $sql_alimento_engorde = "INSERT INTO `registro_alimentacion_engorde`(`fecha_alimentacion`, `id_camaronera`, `id_piscina`, `id_corrida`, `metodo_alimento`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `tiempo`, `consumo`, `camarones_muertos`, `oxigeno`, `temperatura`, `acumulado_semanal`, `acumulado_total`, `id_usuario`)
                                        VALUES('$fechaActual', '$camaronera', '$piscina_destino[$i]', '$corrida', 'boleo', '$alim_1', '$alim_2', '$t_a_arr[$i]', '0', '0', '0', '0', '0', '0', '0', '0', '$encargado')";
                                        $query = mysqli_query( $conexion, $sql_alimento_engorde );

                                        #insertamos los datos ya validados
                                        $sql_siembra = "INSERT INTO `registro_piscina_engorde`( `fecha_siembra`, `fecha_cosecha`, `id_camaronera`, `id_piscina`, `hectareas`, `id_corrida`, `peso_trasferencia`,  `densidad_transferencia`,  `cantidad_sembrada`, `transferido_de_ps`, `nauplio`, `laboratorio`, `origen`, `estado`, `id_usuario`, `secuencial`)
                                                        VALUES('$fechaActual', '$fechaActual', '$camaronera', '$piscina_destino[$i]', '$hectareas', '$corrida', '$peso_pesca', '$densidad', '$cantidad[$i]', '$piscina', '$nauplio', '$laboratorio',  'Trifasico', 'En proceso', '$encargado', '$secuencial')";
                                        $query = mysqli_query( $conexion, $sql_siembra );

                                        if($estado == 'Cosechado'){
                                            $sql_update = "UPDATE `registro_piscina_engorde` SET `estado` = 'Cosechado' WHERE id_camaronera = '$camaronera' and id_piscina = '$piscina' and estado = 'En proceso'";
                                            $query_update = mysqli_query( $conexion, $sql_update );
                                        }
                                    }
                                }
                            }

                            $para_restar = array_sum($t_a_arr) * -1;

                            $sql_alimento_nuevo= "INSERT INTO `registro_alimentacion_engorde`(`fecha_alimentacion`, `id_camaronera`, `id_piscina`, `id_corrida`, `metodo_alimento`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `tiempo`, `consumo`, `camarones_muertos`, `oxigeno`, `temperatura`, `acumulado_semanal`, `acumulado_total`, `id_usuario`)
                                VALUES('2020-01-01', '$camaronera', '$piscina', '$corrida_alim', 'boleo', '$alim_1', '$alim_2', '$para_restar', '0', '0', '0', '0', '0', '0', '0', '0', '$encargado')";
                                $query = mysqli_query( $conexion, $sql_alimento_nuevo );

                            ?>

                                <script>
                                    alert(" ¡ Tranferencia registrada ! ");
                                    //window.history.go(-1);
                                    window.location.href="../views/index.php?page=Reporte-semanal";
                                </script>

                            <?php
                        #}
                    }

                    
                }
            }

            
        }
    }
} else {
    //echo 'no ha seleccionado el origen';
    ?>
        <script>
            alert(" ¡ No ha seleccionado el origen ! ");
            //window.history.go(-1);
            window.location.href="../views/index.php?page=Transferencia_ps_ps";
        </script>

    <?php

}
