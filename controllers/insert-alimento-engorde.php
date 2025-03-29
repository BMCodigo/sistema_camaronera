<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera = $_POST['camaronera'];
$fechaActual = $_POST['fechaActual'];
$piscina_1 = $_POST['piscina'];
$corrida = $_POST['corrida'];
$tipo_alimento_1 = $_POST['tipo_alimento'];
var_dump($tipo_alimento_1);
$observacion = $_POST['observacion'];
$tipo_alimento_2 = $_POST['tipo_alimento_2'];
$cantidad_1 = $_POST['cantidad'];
$cantidad_2 = $_POST['cantidad_2'];
$sobrante_alimento = $_POST['sobrante'];
$muda = $_POST['muda'];
$mortalidad = $_POST['mortalidad'];
$encargado = $_POST['encargado'];
$bandera1 = 0;$bandera2 = 0;$bandera3 = 0;
        list($año, $mes, $dia) = explode('-', $fechaActual);
            if (substr($dia, 0, 1) == '0') {
                $dia = substr($dia, 1);
                  }
                     $fecha = $año . '-' . $mes . '-' . $dia;
//var_dump($piscina_1);


#validamos que los datos no se encuentren repetidos en la tabla.
$sql_fecha_alimento = "SELECT MAX(fecha_alimentacion) as fecha_alimentacion FROM registro_alimentacion_engorde WHERE id_camaronera = '$camaronera'";
$result = mysqli_query($conexion, $sql_fecha_alimento);

foreach ($result as $fech) {
    $fecha_alimento = $fech['fecha_alimentacion'];
}
if ($fecha_alimento == $fecha) {

?>
    <script>
        alert(' ¡ No se puede registrar! esta alimentacion ya fue ingresada !');
      //window.history.go(-1);
    </script>

    <?php

} else {
    
    #recorremos la tabla mediante el array obtenido
    for ($i = 0; $i < count($piscina_1); ++$i) {

        //if ($cantidad_1[$i] > 0 || $cantidad_2[$i] > 0) {

            // AQUI ABAJO HACE LA VALIDACION PARA VER SI HAY UN EGRESO DEL TIPO DE ALIMENTO SELECCIONADO; EN LA PISCINA Y CORRIDA  PARA EL ALIMENTO 1
            if ($cantidad_1[$i] > 0) {
                
                if( $piscina_1[$i] == '17B'){
                    $piscina_1[$i] = 22;
                }
                if( $piscina_1[$i] == '15A'){
                    $piscina_1[$i] = 23;
                }
                if( $piscina_1[$i] == '15B'){
                    $piscina_1[$i] = 24;
                }

                                
                $new="
                SELECT x.cantidad_balanceado + y.cantidad_sobrante AS alimento_disponible FROM egreso_balanceado x
                    INNER JOIN solicitud_balanceados y ON x.id_secuencia = y.id_secuencia 
                        AND x.camaronera = y.camaronera
                            AND x.id_piscina =  y.id_piscina
                                AND x.id_corrida =  y.id_corrida
                                    WHERE TRUE
                                        AND x.camaronera = '$camaronera'
                                    AND x.id_piscina = '$piscina_1[$i]'
                                AND x.id_corrida =  '$corrida[$i]'
                            AND x.id_secuencia = (
                        SELECT MAX(id_secuencia) FROM solicitud_balanceados
                    WHERE fecha_entrega = '$fecha'
                        AND camaronera = '$camaronera'
                            AND id_piscina = '$piscina_1[$i]'
                                AND id_corrida =  '$corrida[$i]' )
                AND x.tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento)  FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_1[$i]')  ORDER BY alimento_disponible DESC LIMIT 1;
                ";
                
                //$sql_a_1 = "SELECT cantidad_balanceado + sobrante AS alimento_disponible FROM egreso_balanceado WHERE id_piscina = '$piscina_1[$i]' AND camaronera = '$camaronera' AND id_corrida = '$corrida[$i]' AND tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento)  FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_1[$i]')  AND (fecha_entrega = (SELECT(CURDATE()))) ORDER BY fecha_entrega DESC LIMIT 1";
                $para_alimento_1 = $conexion->query($new);
                $para_alimento_1->num_rows;
                if ($para_alimento_1->num_rows == 0) {
                    $bandera1 += 1;
                 
    ?>
                    <script>
                        alert(' ¡ No hay egreso de este alimento en la piscina ' + "<?php echo $piscina_1[$i]; ?>" + '!');
                      // window.location.href = "../views/index.php?page=Alimentacion";
                    </script>

                    <?php
                } else {
                    foreach ($para_alimento_1 as $pa1) {
                        if ($cantidad_1[$i] > $pa1['alimento_disponible']) {
                            $bandera1 = 1;
                            //echo $pa1['alimento_disponible'] . ' ------- ' . $$cantidad_1 ;

                    ?>
                            <script>
                                alert('Alimento disponible para la piscina ' + <?php echo $piscina_1[$i]; ?> + ' es = ' +  <?php echo $pa1["alimento_disponible"] ?>);
                               //window.location.href = "../views/index.php?page=Alimentacion";
                            </script>

                    <?php
                        }
                    }
                }
            }

            // AQUI ABAJO HACE LA VALIDACION PARA VER SI HAY UN EGRESO DEL TIPO DE ALIMENTO SELECCIONADO; EN LA PISCINA Y CORRIDA  PARA EL ALIMENTO 2
            /*if ($cantidad_2[$i] > 0) {

                $new="
                SELECT x.cantidad_balanceado + y.sobrante AS alimento_disponible FROM egreso_balanceado x
                    INNER JOIN solicitud_balanceados y ON x.id_secuencia = y.id_secuencia 
                        AND x.camaronera = y.camaronera
                            AND x.id_piscina =  y.id_piscina
                                AND x.id_corrida =  y.id_corrida
                                    WHERE TRUE
                                        AND x.camaronera = '$camaronera'
                                    AND x.id_piscina = '$piscina_1[$i]'
                                AND x.id_corrida =  '$corrida[$i]'
                            AND x.id_secuencia = (
                        SELECT MAX(id_secuencia) FROM solicitud_balanceados
                    WHERE fecha_entrega = '$fecha'
                        AND camaronera = '$camaronera'
                            AND id_piscina = '$piscina_1[$i]'
                                AND id_corrida =  '$corrida[$i]' )
                AND x.tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento)  FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_2[$i]')  ORDER BY alimento_disponible DESC LIMIT 1;
                ";
                
                $sql_a_2 = "SELECT cantidad_balanceado + sobrante AS alimento_disponible FROM egreso_balanceado WHERE id_piscina = '$piscina_1[$i]' AND camaronera = '$camaronera' AND id_corrida = '$corrida[$i]' AND tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento) FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_2[$i]') AND (fecha_entrega = (SELECT(CURDATE())) OR fecha_entrega = (SELECT date_add(CURDATE(), interval -1 day))) ORDER BY fecha_entrega DESC LIMIT 1";
                $para_alimento_2 = $conexion->query($new);
                $para_alimento_2->num_rows;
                if ($para_alimento_2->num_rows == 0) {
                    $bandera2 += 1;
                    ?>
                    <script>
                        alert(' ¡ No hay egreso de este alimento en la piscina ' + "<?php echo $piscina_1[$i]; ?>" + '!');
                       // window.location.href = "../views/index.php?page=Alimentacion";
                    </script>

                    <?php
                } /*else {
                    foreach ($para_alimento_2 as $pa2) {
                        if ($cantidad_2[$i] > $pa2['alimento_disponible']) {
                            $bandera2 += 1;
                    ?>
                            <script>
                                alert('Alimento disponible para la piscina ' + <?php echo $piscina_1[$i]; ?> + ' es = ' +
                                    <?php echo $pa1["alimento_disponible"] ?>);
                                window.location.href = "../views/index.php?page=Alimentacion";
                            </script>

                <?php
                        }
                    }
                }
            }*/
        //}
    }
           //  $bandera1=0; $bandera2=0; 
    if ($bandera1 == 0 && $bandera2 == 0) {

        for ($i = 0; $i < count($piscina_1); ++$i) {
            
            if( $piscina_1[$i] == '17B'){
                $piscina_1[$i] = 22;
            }
            if( $piscina_1[$i] == '15A'){
                $piscina_1[$i] = 23;
            }
            if( $piscina_1[$i] == '15B'){
                $piscina_1[$i] = 24;
            }

        

            if ($cantidad_1[$i] >= 0 || $cantidad_2[$i] >= 0) {
                
              
                $sql = "SELECT descripcion_alimento, gramaje_alimento FROM `tipo_alimento`where id_tipo_alimento = ".$tipo_alimento_1[$i];
                $query = mysqli_query( $conexion, $sql );
                $array = mysqli_fetch_assoc($query);
                $tipobalanceado = $array['descripcion_alimento'];
                $tipobalanceado = $array['descripcion_alimento'].' '.$array['gramaje_alimento'];
                  
                $sql = "SELECT descripcion_alimento, gramaje_alimento FROM `tipo_alimento`where id_tipo_alimento = ".$tipo_alimento_2[$i];
                $query = mysqli_query( $conexion, $sql );
                $array2 = mysqli_fetch_assoc($query);
                $tipobalanceado2 = $array2['descripcion_alimento'];
                $tipobalanceado2 = $array2['descripcion_alimento'].' '.$array2['gramaje_alimento'];
                
                $sql = "SELECT nombre, apellido FROM `usuarios` where id_usuario =".$encargado;
                $query = mysqli_query( $conexion, $sql );
                $array = mysqli_fetch_assoc($query);
                $getencargado = $array['nombre'].' '.$array['apellido'];
                
                 $sql = "SELECT max(id_corrida) as id_corrida , max(id_secuencia) as id_secuencia  FROM solicitud_balanceados where camaronera =".$camaronera." and id_piscina =".$piscina_1[$i]." and fecha_entrega ='".$fecha."'";
                $query = mysqli_query( $conexion, $sql );
                $array = mysqli_fetch_assoc($query);
                $getcorrida = $array['id_corrida'];
                $getsecuencia = $array['id_secuencia'];
                
                $sql = "SELECT cantidad_sobrante FROM solicitud_balanceados WHERE id_secuencia = '$getsecuencia' AND camaronera = '$camaronera' AND tipo_balanceado = '$tipobalanceado' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$corrida[$i]';";
                $query = mysqli_query( $conexion, $sql );
                $array = mysqli_fetch_assoc($query);
                $sobrantes += $array['cantidad_sobrante'];
                
                if ($sobrantes < 0 ){ $bandera3 = 1;} 
              
    
                $insert = "INSERT INTO `registro_alimentacion_engorde`(`fecha_alimentacion`, `id_camaronera`, `id_piscina`, `id_corrida`, `metodo_alimento`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `tiempo`, `sobrante_alimento`, `camarones_muertos`, `muda`, `temperatura`, `acumulado_semanal`, `acumulado_total`, `id_usuario`) 
                VALUES('$fechaActual', '$camaronera', '$piscina_1[$i]', '$corrida[$i]', '$observacion[$i]', '$tipo_alimento_1[$i]', '$tipo_alimento_2[$i]', '$cantidad_1[$i]', '$cantidad_2[$i]', '0.0', '$sobrante_alimento[$i]', '$mortalidad[$i]', '$muda[$i]', '0.0', '0.0', '0.0', '$encargado')";
                mysqli_query($conexion, $insert);
                //echo '</br>';
    
                $sqlKardexPsc = "SELECT (ingreso_bodega_piscina - $cantidad_1[$i]) as saldo_actual  FROM kardex_piscina WHERE id_camaronera  = '$camaronera' AND tipo_balanceado_kardex = '$tipobalanceado' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$corrida[$i]'";
                $querykdxPsc = mysqli_query( $conexion, $sqlKardexPsc );
                foreach($querykdxPsc as $key):
                    $saldo_actual = $key['saldo_actual'];
                endforeach;   
    
                $updateKardexPscina = "UPDATE `kardex_piscina` SET `egreso_alimentacion`= '$cantidad_1[$i]' ,`tipo_balanceado_alimentacion`= '$tipobalanceado', `saldo_actual`= '$saldo_actual', `responsable`= '$encargado' WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$corrida[$i]' AND fecha_ingreso = '$fecha'";
                mysqli_query($conexion, $updateKardexPscina);
                $updateSolicitud = "UPDATE solicitud_balanceados SET cantidad_sobrante = '0.00' WHERE fecha_entrega = '$fecha' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$corrida[$i]' AND tipo_balanceado = '$tipobalanceado'";
                mysqli_query($conexion, $updateSolicitud);
                $updateEgreso = "UPDATE egreso_balanceado SET sobrante = '0.00' WHERE fecha_entrega = '$fecha' AND id_piscina = '$piscina_1[$i]' AND id_corrida = '$corrida[$i]' AND tipo_balanceado = '$tipobalanceado'";
                mysqli_query($conexion, $updateEgreso);
    
                }
        }
    }
    
    
    
    
    
        if ($bandera3==0){
        
                                                               

try {
    
            for ($i = 0; $i < count($piscina_1); ++$i) { 
               // mysqli_query($conexion, $insert[$i]);
                //mysqli_query($conexion, $updateKardexPscina[$i]);
               // mysqli_query($conexion, $updateSolicitud[$i]);
               // mysqli_query($conexion, $updateEgreso[$i]);
            }
    
  
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

                   ?>
                <script>
                   alert(' ¡ Alimentacion agregada Sin errores !');
                 // window.location.href = "../views/index.php?page=Alimentacion";
                </script>

            <?php     
        
        
    }else {
          ?>
                <script>
                  alert(' ¡ Alimentacion ingresada supera la cantidad disponible, favor corregir !');
             //   window.location.href = "../views/index.php?page=Alimentacion";
                </script>

            <?php
    }
}

?>
