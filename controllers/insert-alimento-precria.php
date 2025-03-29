<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$camaronera = $_POST['camaronera'];

#datos obtenidos de los input
$piscina_1 = $_POST['piscina'];
$observacion = $_POST['observacion'];
$tipo_alimento_1 = $_POST['tipo_alimento'];
$tipo_alimento_2 = $_POST['tipo_alimento_2'];
$consumo_1 = $_POST['consumo'];
$cantidad_1 = $_POST['cantidad'];
$cantidad_2 = $_POST['cantidad_2'];
$encargado = $_POST['encargado'];
$id = $_POST['id'];



list($año, $mes, $dia) = explode('-', $fechaActual);
if (substr($dia, 0, 1) == '0') {
    $dia = substr($dia, 1);
      }
         $fecha = $año . '-' . $mes . '-' . $dia;



#validamos que los datos no se encuentren repetidos en la tabla. 
$sql = "SELECT * FROM registro_alimentacion_precria WHERE fecha_alimentacion LIKE '$fechaActual' AND id_camaronera = '$camaronera'";
$result = $conexion->query($sql);

$bandera1 = 0;
$bandera2 = 0;

if ($result->num_rows > 0) {

?>
    <script>
        alert(' ¡ No se grabo el registro: esta alimentacion ya fue ingresada anteriormente !');
        window.history.go(-1)
    </script>

    <?php

} else {

    #recorremos la tabla mediante el array obtenido

    for ($i = 0; $i < count($id); ++$i) {

        if($cantidad_1[$i] > 0 || $cantidad_2[$i] > 0){
        // AQUI ABAJO HACE LA VALIDACION PARA VER SI HAY UN EGRESO DEL TIPO DE ALIMENTO SELECCIONADO; EN LA PISCINA Y CORRIDA PARA EL ALIMENTO 1
        if($cantidad_1[$i] > 0){
            
             $sql_a_1 = "SELECT cantidad_balanceado + sobrante AS alimento_disponible FROM egreso_balanceado WHERE id_piscina =  (SELECT id_precria FROM registro_piscina_precria WHERE identificacion = '$id[$i]' AND id_camaronera='$camaronera' AND estado = 'En proceso' AND id_precria = '$piscina_1[$i]') AND camaronera = '$camaronera' AND id_corrida = '$id[$i]' AND tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento) FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_1[$i]')  AND (fecha_entrega = (SELECT(CURDATE())) OR fecha_entrega = (SELECT date_add(CURDATE(), interval -1 day))) ORDER BY fecha_entrega DESC LIMIT 1";
            $para_alimento_1 = $conexion->query($sql_a_1);
            $para_alimento_1->num_rows;

            if ($para_alimento_1->num_rows == 0){
                $bandera1 += 1;
                ?>
                    <script>
                        alert(' ¡ No hay egreso de este alimento en la piscina ' + "<?php echo $piscina_1[$i] ;?>" + '!');
                     window.location.href="../views/index.php?page=Alimentacion";
                    </script>

                <?php
            }else{
                foreach($para_alimento_1 as $pa1){
                    if($cantidad_1[$i] > $pa1['alimento_disponible']){
                        $bandera1 += 1;
                        ?>
                            <script>
                               alert('Alimento ingresado es superior al disponible\nAlimento disponible para la precria '+ <?php echo $piscina_1[$i] ;?> +' es = '+ <?php echo $pa1["alimento_disponible"] ?>);
                               window.location.href="../views/index.php?page=Alimentacion";
                            </script>
            
                        <?php
                    }
                }
            }
        }


        // AQUI ABAJO HACE LA VALIDACION PARA VER SI HAY UN EGRESO DEL TIPO DE ALIMENTO SELECCIONADO; EN LA PISCINA Y CORRIDA  PARA EL ALIMENTO 2
        if($cantidad_2[$i] > 0){
            $sql_a_2 = "SELECT cantidad_balanceado + sobrante AS alimento_disponible FROM egreso_balanceado WHERE id_piscina =  (SELECT id_precria FROM registro_piscina_precria WHERE identificacion = '$id[$i]' AND estado = 'En proceso' AND id_precria = '$piscina_1[$i]' AND id_camaronera = '$camaronera') AND camaronera = '$camaronera' AND id_corrida = '$id[$i]' AND tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento) FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_2[$i]')  AND (fecha_entrega = (SELECT(CURDATE())) OR fecha_entrega = (SELECT date_add(CURDATE(), interval -1 day))) ORDER BY fecha_entrega DESC LIMIT 1";
            $para_alimento_2 = $conexion->query($sql_a_2);
            $para_alimento_2->num_rows;
            if ($para_alimento_2->num_rows == 0){
                $bandera2 += 1;
                ?>
                    <script>
                       alert(' ¡ No hay egreso de este alimento en la precria ' + "<?php echo $piscina_1 ;?>" + '!');
                  window.location.href="../views/index.php?page=Alimentacion";
                    </script>

                <?php
            }else{
                foreach($para_alimento_2 as $pa2){
                    if($cantidad_2[$i] > $pa2['alimento_disponible']){
                        $bandera2 += 1;
                        ?>
                            <script>
                               alert('Alimento ingresado es superior al disponible\nAlimento disponible para la precria '+ <?php echo $piscina_1[$i] ;?> +' es = '+ <?php echo $pa1["alimento_disponible"] ?>);
                              window.location.href="../views/index.php?page=Alimentacion";
                            </script>
            
                        <?php
                    }
                }
            }
        }
    }
}
   //  $bandera1=0; $bandera2=0; 
    if($bandera1 == 0 && $bandera2 == 0){
        
    for ($i = 0; $i < count($id); ++$i) {

        if($cantidad_1[$i] > 0 || $cantidad_2[$i] > 0){
            
           $sql = "SELECT cantidad_balanceado - '$cantidad_1[$i]' AS sobrantes FROM egreso_balanceado WHERE fecha_entrega = '$fechaActual' AND id_piscina = '$piscina_1[$i]' AND tipo_balanceado = '$tipo_alimento_1[$i]'";
            $query = mysqli_query( $conexion, $sql );
            $array = mysqli_fetch_assoc($query);
            $sobrantes = $array['sobrantes'];
            
            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM `tipo_alimento`where id_tipo_alimento = ".$tipo_alimento_1[$i];
            $query = mysqli_query( $conexion, $sql );
            $array = mysqli_fetch_assoc($query);
            $tipobalanceado = $array['descripcion_alimento'];
            $tipobalanceado = $array['descripcion_alimento'].' '.$array['gramaje_alimento'];
            
            $sql = "SELECT nombre, apellido FROM `usuarios` where id_usuario =".$encargado;
            $query = mysqli_query( $conexion, $sql );
            $array = mysqli_fetch_assoc($query);
            $getencargado = $array['nombre'].' '.$array['apellido'];
            
            $sql = "SELECT max(id_corrida) as id_corrida , max(id_secuencia) as id_secuencia  FROM solicitud_balanceados where camaronera =".$camaronera." and id_piscina =".$piscina_1[$i]." and fecha_entrega ='".$fechaActual."'";
            $query = mysqli_query( $conexion, $sql );
            $array = mysqli_fetch_assoc($query);
            $getcorrida = $array['id_corrida'];
            $getsecuencia = $array['id_secuencia'];

            
           $sql = "INSERT INTO `registro_alimentacion_precria`(`fecha_alimentacion`, `id_camaronera`, `id_precria`, `metodo_alimento`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `tiempo`, `consumo`, `camarones_muertos`, `oxigeno`, `temperatura`, `id_usuario`, `identificacion`)
                    VALUES('$fechaActual', '$camaronera', $piscina_1[$i], '$observacion[$i]', '$tipo_alimento_1[$i]', '$tipo_alimento_2[$i]', '$cantidad_1[$i]', '$cantidad_2[$i]', '0.0', '0.0', '0.0', '0.0', '0.0', '$encargado', '$id[$i]')";
            $query = mysqli_query($conexion, $sql);

            $sqlKardexPsc = "SELECT (ingreso_bodega_piscina - $cantidad_1[$i]) as saldo_actual  FROM kardex_piscina WHERE id_camaronera  = '$camaronera' AND tipo_balanceado_kardex = '$tipobalanceado' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$id[$i]'";
            $querykdxPsc = mysqli_query( $conexion, $sqlKardexPsc );
            foreach($querykdxPsc as $key):
                $saldo_actual = $key['saldo_actual'];
            endforeach; 
            
            
            $updateKardexPscina = "UPDATE `kardex_piscina` SET `egreso_alimentacion`= '$cantidad_1[$i]' ,`tipo_balanceado_alimentacion`= '$tipobalanceado', `saldo_actual`= '$saldo_actual', `responsable`= '$encargado' WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$id[$i]' AND fecha_ingreso = '$fecha'";
            mysqli_query($conexion, $updateKardexPscina);
            $updateSolicitud = "UPDATE solicitud_balanceados SET cantidad_sobrante = '0.00' WHERE fecha_entrega = '$fecha' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$id[$i]' AND tipo_balanceado = '$tipobalanceado'";
           mysqli_query($conexion, $updateSolicitud);
            $update = "UPDATE egreso_balanceado SET sobrante = '0.00' WHERE fecha_entrega = '$fecha' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$id[$i]' AND tipo_balanceado = '$tipobalanceado'";
         mysqli_query($conexion, $update);
        
        ?>

        <script>
          alert(' ¡ Alimentacion Fue agregada con exito !');
            window.location.href="../views/index.php?page=Alimentacion";
        </script>
    <?php
        }
            
        }
    }

}

?>