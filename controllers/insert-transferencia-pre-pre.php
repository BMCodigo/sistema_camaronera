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
$piscina = $_POST['precria'];
$peso_pesca = $_POST['peso_pesca'];
$piscina_destino = $_POST['piscina_destino'];
$cantidad = $_POST['libras'];
$sembrado = $_POST['sembrado'];
$valor_total = $_POST['valor_tot'];
$encargado = $_POST['user'];
$estado = $_POST['estado'];
$flag = 0;
$flag_igual = 0;
$msg = "La o las precria</br>";

$sum_div = array();
$t_a_arr = array();


if ($piscina != 0) {

    if ($piscina_destino[0] == 0 && $cantidad[0] == 0) {

        //echo 'Que chuchas quieres transferir si no seleccionas la puta piscina ni pones una pucta cantidad mmv, no seas imbecil, vales es 23, no, casi 24 hectareas de verga!';

        ?>
            <script>
                alert(" ¡ Selecione precria destino ! ");
                //window.history.go(-1);
                window.location.href="../views/index.php?page=Transferencia_pre_pre";
            </script>

        <?php

    } else {

        if (($piscina_destino[0] == 0 && $cantidad[0] > 0) || ($piscina_destino[1] == 0 && $cantidad[1] > 0) || ($piscina_destino[2] == 0 && $cantidad[2] > 0)) {

            //echo 'No ha seleccionado el destino en una cantidad que quiere transferir';

            ?>

            <script>
                alert(" ¡ Selecione precria destino ! ");
                //window.history.go(-1);
                window.location.href="../views/index.php?page=Transferencia_pre_pre";
            </script>

            <?php

        } else {

            if (($piscina_destino[0] != 0 && $cantidad[0] == 0) || ($piscina_destino[1] != 0 && $cantidad[1] == 0) || ($piscina_destino[2] != 0 && $cantidad[2] == 0)){
                //echo 'no ha puesto ninguna catidad';
                ?>
                    <script>
                        alert(" ¡ No ha ingresado cantidad ! ");
                        //window.history.go(-1);
                        window.location.href="../views/index.php?page=Transferencia_pre_pre";
                    </script>

                <?php
            }else{

                if (intval($valor_total) > intval($sembrado)) {
                    ?>
                    <script>
                        alert('¡ Cantidad de transferencia es mayor a la sembrada ( ' + '<?php echo intval($sembrado); ?>' + ' ) !');
                        //window.history.go(-1);
                        window.location.href="../views/index.php?page=Transferencia_pre_pre";
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

                        for ($i = 0; $i < count($piscina_destino); ++$i) {
                            #selecionamos y verificamos si la piscina está en proceso
                            $sql = "SELECT * FROM registro_piscina_precria WHERE id_precria = '$piscina_destino[$i]' AND id_camaronera = '$camaronera' AND estado = 'En proceso'";
                            $data = $objeto->mostrar($sql);

                            foreach ($data as $key) {
                                $estado_proceso = $key['estado'];
                            }

                            #si esta en proceso no permite registrar
                            if ($estado_proceso == 'En proceso' && $piscina_destino[$i] != 0) {

                                $flag += 1;
                                $msg .= ' ' . $piscina_destino[$i] . '</br>';

                            }
                        }

                        //$msg .= 'Ya se encuentran en proceso';

                        if ($flag > 0) {
                            //echo $msg;
                        ?>
                            <script>
                                alert('La precria se encuentra en proceso');
                                //window.history.go(-1);
                                window.location.href="../views/index.php?page=Transferencia_pre_pre";
                            </script>

                        <?php

                        } else {

                            for ($i = 0; $i < count($piscina_destino); ++$i) {

                                if ($piscina_destino[$i] != 0 && $cantidad[$i]) {

                                    #selecionamos el secuencial, nauplio, laboratorio de la pisicna que se esta trasnfiriendo
                                    $sql = "SELECT identificacion FROM registro_piscina_precria WHERE id_precria = '$piscina' AND id_camaronera = '$camaronera' AND estado LIKE 'En proceso'";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $key) {
                                        $id = $key['identificacion'];
                                    }

                                    #prolateo de balanceado
                                    $sql_alim = "SELECT id_tipo_alimento, id_tipo_alimento_2, SUM(cantidad + cantidad_2) as acumulado FROM `registro_alimentacion_precria` WHERE id_camaronera = '$camaronera' AND id_precria = '$piscina' AND identificacion = '$id'";
                                    $data_alim = $objeto->mostrar($sql_alim);

                                    foreach ($data_alim as $row) {
                                        $acumulado = $row['acumulado'];
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

                                        $t_1 = ($cantidad[$i] / $sembrado);
                                        array_push($sum_div, $t_1);
                                        $t_a = round($acumulado);
                                        array_push($t_a_arr, $t_a);
                                    }

                                    #selecionamos las hectareas de la piscina destino
                                    if ($camaronera == 1) {
                                        $sql_hectareas = "SELECT hectareas FROM precria_darsacom WHERE id_camaronera = '$camaronera'";
                                    } else if ($camaronera == 2) {
                                        $sql_hectareas = "SELECT hectareas FROM precria_aquacamaron WHERE id_camaronera = '$camaronera'";
                                    } else if ($camaronera == 3) {
                                        $sql_hectareas = "SELECT hectareas FROM precria_jopisa WHERE id_camaronera = '$camaronera'";
                                    } else if ($camaronera == 4){
                                        $sql_hectareas = "SELECT hectareas FROM precria_aquanatura WHERE id_camaronera = '$camaronera'";
                                    } else if ($camaronera == 5){
                                        $sql_hectareas = "SELECT hectareas FROM precria_grupo_camaron WHERE id_camaronera = '$camaronera'";
                                    } else if ($camaronera == 6){
                                        $sql_hectareas = "SELECT hectareas FROM precria_calica WHERE id_camaronera = '$camaronera'";
                                    }else{
                                        echo 'error en el servidor :(';
                                    }

                                    $data_hectareas = $objeto->mostrar($sql_hectareas);

                                    foreach ($data_hectareas as $value_pre) {
                                        $ha = $value_pre['hectareas'];
                                    }

                                    #selecionamos el secuencial, nauplio, laboratorio de la pisicna que se esta trasnfiriendo
                                    $sql = "SELECT secuencial, codigo_genetico, nauplio, laboratorio FROM registro_piscina_precria WHERE id_precria = '$piscina' AND id_camaronera = '$camaronera'  AND identificacion = '$id'";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $key) {
                                        $secuencial = $key['secuencial'];
                                        $nauplio = $key['nauplio'];
                                        $laboratorio = $key['laboratorio'];
                                        $codigo_genetico = $key['codigo_genetico'];
                                    }


                                    #insertamos el alimento de la precria a una tabla
                                    $sql_alimento = "INSERT INTO `registro_prolateo`(`fecha_alimentacion`, `id_camaronera`, `id_precria`, `id_piscina`, `peso`, `cant_animales`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `identificacion`, `encargado`, `secuencial`)
                                                    VALUES('$fechaActual', '$camaronera', '$piscina', '$piscina_destino[$i]', '$peso_pesca', '$cantidad[$i]', '$alim_1', '$alim_2', '$t_a_arr[$i]', '0', '$id', '$encargado', '$secuencial')";
                                    $query = mysqli_query( $conexion, $sql_alimento );

                                    if ($piscina_destino[$i] > 0) {

                                        #insertamos los datos ya validados
                                        $sql_siembra = "INSERT INTO `registro_piscina_precria`(`fecha_siembra`, `fecha_cosecha`, `id_camaronera`, `id_precria`, `hectareas`, `peso_siembra`, `cantidad_siembra`, `transferido_de_pre`, `codigo_genetico`, `nauplio`, `laboratorio`, `origen`, `dias_aprox`, `estado`, `id_usuario`, `identificacion`, `secuencial`) 
                                                VALUES('$fechaActual', '$fechaActual', '$camaronera', '$piscina_destino[$i]', '$ha',  '$peso_pesca', '$cantidad[$i]', '$piscina', '$codigo_genetico', '$nauplio', '$laboratorio',  'Bifasico', '25', 'En proceso', '$encargado', '$id', '$secuencial')";
                                        $query = mysqli_query( $conexion, $sql_siembra );
                                    }

                                    if($estado == 'Cosechado'){

                                        $sql_update = "UPDATE registro_piscina_precria SET estado = 'Cosechado' WHERE id_precria = '$piscina' AND identificacion = '$id'";
                                        $query = mysqli_query( $conexion, $sql_update );

                                    }
                                }
                            }

                            ?>

                                <script>
                                    alert(" ¡ Tranferencia registrada ! ");
                                    //window.history.go(-1);
                                    window.location.href="../views/index.php?page=Reporte-semanal";
                                </script>

                            <?php
                        }
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
            window.history.go(-1);
            //window.location.href="../views/index.php?page=Transferencia_pre_pre";

        </script>

    <?php

}
