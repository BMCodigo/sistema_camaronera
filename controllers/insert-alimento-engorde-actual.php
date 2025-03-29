<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$camaronera = $_POST['camaronera'];
$piscina_1 = $_POST['piscina'];
$corrida = $_POST['corrida'];
$observacion = $_POST['observacion'];
$tipo_alimento_1 = $_POST['tipo_alimento'];
$tipo_alimento_2 = $_POST['tipo_alimento_2'];
$consumo_1 = $_POST['consumo'];
$cantidad_1 = $_POST['cantidad'];
$cantidad_2 = $_POST['cantidad_2'];
$encargado = $_POST['encargado'];

$bandera1 = 0;
$bandera2 = 0;
$bandera3 = 0;

//var_dump($piscina_1);


#validamos que los datos no se encuentren repetidos en la tabla.
$sql_fecha_alimento = "SELECT MAX(fecha_alimentacion) as fecha_alimentacion FROM registro_alimentacion_engorde WHERE id_camaronera = '$camaronera'";
$result = mysqli_query($conexion, $sql_fecha_alimento);

foreach ($result as $fech) {
    $fecha_alimento = $fech['fecha_alimentacion'];
}

if ($fecha_alimento == $fechaActual) {

?>
    <script>
        alert(' ¡ No se puede registrar! esta alimentacion ya fue ingresada !');
        window.history.go(-1);
    </script>

    <?php

} else {

    #recorremos la tabla mediante el array obtenido
    for ($i = 0; $i < count($piscina_1); ++$i) {

        if ($cantidad_1[$i] > 0 || $cantidad_2[$i] > 0) {

            // AQUI ABAJO HACE LA VALIDACION PARA VER SI HAY UN EGRESO DEL TIPO DE ALIMENTO SELECCIONADO; EN LA PISCINA Y CORRIDA  PARA EL ALIMENTO 1
            if ($cantidad_1[$i] > 0) {

                if( $piscina_1[$i] == '17B'){
                    $piscina_1[$i] = 22;
                }
                
                                /* 
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
                        SELECT id_secuencia FROM solicitud_balanceados
                    WHERE fecha_entrega = '$fechaActual'
                        AND camaronera = '$camaronera'
                            AND id_piscina = '$piscina_1[$i]'
                                AND id_corrida =  '$corrida[$i]' )
                AND x.tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento)  FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_1[$i]');
                "; */
                
                $sql_a_1 = "SELECT cantidad_balanceado + sobrante AS alimento_disponible FROM egreso_balanceado WHERE id_piscina = '$piscina_1[$i]' AND camaronera = '$camaronera' AND id_corrida = '$corrida[$i]' AND tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento)  FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_1[$i]')  AND (fecha_entrega = (SELECT(CURDATE())) OR fecha_entrega = (SELECT date_add(CURDATE(), interval -1 day))) ORDER BY fecha_entrega DESC LIMIT 1";
                $para_alimento_1 = $conexion->query($sql_a_1);
                $para_alimento_1->num_rows;
                if ($para_alimento_1->num_rows == 0) {
                    $bandera1 += 1;
                 
    ?>
                    <script>
                        alert(' ¡ No hay egreso de este alimento en la piscina ' + "<?php echo $piscina_1[$i]; ?>" + '!');
                        window.location.href = "../views/index.php?page=Alimentacion";
                    </script>

                    <?php
                } else {
                  /*  foreach ($para_alimento_1 as $pa1) {
                        if ($cantidad_1[$i] > $pa1['alimento_disponible']) {
                            $bandera1 = 1;

                    ?>
                            <script>
                               alert('Alimento disponible para la piscina ' + <?php echo $piscina_1[$i]; ?> + ' es = ' +
                                 <?php echo $pa1["alimento_disponible"] ?>);
                               window.location.href = "../views/index.php?page=Alimentacion";
                            </script>

                    <?php
                        }
                    }*/
                }
            }

            // AQUI ABAJO HACE LA VALIDACION PARA VER SI HAY UN EGRESO DEL TIPO DE ALIMENTO SELECCIONADO; EN LA PISCINA Y CORRIDA  PARA EL ALIMENTO 2
            if ($cantidad_2[$i] > 0) {
                $sql_a_2 = "SELECT cantidad_balanceado + sobrante AS alimento_disponible FROM egreso_balanceado WHERE id_piscina = '$piscina_1[$i]' AND camaronera = '$camaronera' AND id_corrida = '$corrida[$i]' AND tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento) FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento_2[$i]')  SELECT cantidad_balanceado + sobrante AS alimento_disponible FROM egreso_balanceado WHERE id_piscina = '6' AND camaronera = '1' AND id_corrida = '29' AND tipo_balanceado = (SELECT CONCAT(descripcion_alimento,' ',gramaje_alimento) FROM tipo_alimento WHERE id_tipo_alimento = '17') AND (fecha_entrega = (SELECT(CURDATE())) OR fecha_entrega = (SELECT date_add(CURDATE(), interval -1 day))) ORDER BY fecha_entrega DESC LIMIT 1";
                $para_alimento_2 = $conexion->query($sql_a_2);
                $para_alimento_2->num_rows;
                if ($para_alimento_2->num_rows == 0) {
                    $bandera2 += 1;
                    ?>
                    <script>
                        alert(' ¡ No hay egreso de este alimento en la piscina ' + "<?php echo $piscina_1[$i]; ?>" + '!');
                        window.location.href = "../views/index.php?page=Alimentacion";
                    </script>

                    <?php
                } else {
                   /* foreach ($para_alimento_2 as $pa2) {
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
                    }*/
                }
            }
        }
    }
           //  $bandera1=0; $bandera2=0; 
    if ($bandera1 == 0 && $bandera2 == 0) {

        for ($i = 0; $i < count($piscina_1); ++$i) {

            if( $piscina_1[$i] == '17B'){
                $piscina_1[$i] = 22;
            }

            if ($cantidad_1[$i] > 0 || $cantidad_2[$i] > 0) {
                
                

            
            $sql = "SELECT descripcion_alimento, gramaje_alimento FROM `tipo_alimento`where id_tipo_alimento = ".$tipo_alimento_1[$i];
            $query = mysqli_query( $conexion, $sql );
            $array = mysqli_fetch_assoc($query);
            $tipobalanceado = $array['descripcion_alimento'];
              $tipobalanceado = $array['descripcion_alimento'].' '.$array['gramaje_alimento'];
            
            $sql = "SELECT cantidad_balanceado - '$cantidad_1[$i]' AS sobrantes FROM egreso_balanceado WHERE fecha_entrega = '$fechaActual' AND id_piscina = '$piscina_1[$i]' AND camaronera = '$camaronera' AND tipo_balanceado = '$tipobalanceado'";
            $query = mysqli_query( $conexion, $sql );//echo $sql;
            $array = mysqli_fetch_assoc($query);
            $sobrantes = $array['sobrantes'];
            
            $sql = "SELECT nombre, apellido FROM `usuarios` where id_usuario =".$encargado;
            $query = mysqli_query( $conexion, $sql );
            $array = mysqli_fetch_assoc($query);
            $getencargado = $array['nombre'].' '.$array['apellido'];
            
             $sql = "SELECT max(id_corrida) as id_corrida , max(id_secuencia) as id_secuencia  FROM solicitud_balanceados where camaronera =".$camaronera." and id_piscina =".$piscina_1[$i]." and fecha_entrega ='".$fechaActual."'";
            $query = mysqli_query( $conexion, $sql );
            $array = mysqli_fetch_assoc($query);
            $getcorrida = $array['id_corrida'];
            $getsecuencia = $array['id_secuencia'];
            list($año, $mes, $dia) = explode('-', $fechaActual);
            if (substr($dia, 0, 1) == '0') {
            $dia = substr($dia, 1);
            }
            $fecha = $año . '-' . $mes . '-' . $dia;
            
            $sql = "SELECT sobrante FROM solicitud_balanceados WHERE id_secuencia = '$getsecuencia' AND camaronera = '$camaronera' AND id_piscina = '$piscina_1[$i]';";
            $query = mysqli_query( $conexion, $sql );
            $array = mysqli_fetch_assoc($query);
            $sobrantes += $array['sobrante'];
            if ($sobrantes < 0 ){ $bandera3 = 1;} 
          
                #insertamos los valores en la tabla alimentacion
                $insert[$i] = "INSERT INTO `registro_alimentacion_engorde`(`fecha_alimentacion`, `id_camaronera`, `id_piscina`, `id_corrida`, `metodo_alimento`, `id_tipo_alimento`, `id_tipo_alimento_2`, `cantidad`, `cantidad_2`, `tiempo`, `consumo`, `camarones_muertos`, `oxigeno`, `temperatura`, `acumulado_semanal`, `acumulado_total`, `id_usuario`) 
                        VALUES('$fechaActual', '$camaronera', '$piscina_1[$i]', '$corrida[$i]', '$observacion[$i]', '$tipo_alimento_1[$i]', '$tipo_alimento_2[$i]', '$cantidad_1[$i]', '$cantidad_2[$i]', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '0.0', '$encargado')";
             //  $query = mysqli_query($conexion, $insert[$i]);
               
            $update[$i]="UPDATE egreso_balanceado SET sobrante = '$sobrantes' WHERE fecha_entrega = '$fecha' AND id_piscina = '$piscina_1[$i]' AND tipo_balanceado = '$tipobalanceado'";
         //   mysqli_query($conexion, $update[$i]);
                
            $sql = "INSERT INTO `egreso_balanceado`(`fecha_entrega`, `id_piscina`, `id_corrida`, `cantidad_balanceado`, `tipo_balanceado`, `camaronera`, `encargado`, `descripcion`, `id`, `sobrante`, `id_secuencia`, `estado`)
            VALUES ((NOW()), '$piscina_1[$i]', '$corrida[$i]', '$cantidad_1[$i]', '$tipobalanceado', '$camaronera', '$getencargado', 'Consumo piscina', 'Piscina', '$faltante', '$getsecuencia', 'Aprobado')";
          
          
         //  $query = mysqli_query($conexion, $sql);
          // echo $sql;
         // echo "MODULO EN MANTENIMIENTO";
                ?>
                <script>
               //    alert(' ¡ Alimentacion agregada  !');
               //     window.location.href = "../views/index.php?page=Alimentacion";
                </script>

            <?php
            }
        }
    }
    
    
    
    
    
        if ($bandera3==0){
        
                                                               

try {
    
            for ($i = 0; $i < count($piscina_1); ++$i) { 
                 $query = mysqli_query($conexion, $insert[$i]);
                  mysqli_query($conexion, $update[$i]);
            }
    
  
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

                   ?>
                <script>
                   alert(' ¡ Alimentacion agregada Sin errores !');
                    window.location.href = "../views/index.php?page=Alimentacion";
                </script>

            <?php     
        
        
    }else {
          ?>
                <script>
                   alert(' ¡ Alimentacion ingresada supera la cantidad disponible, favor corregir !');
                    window.location.href = "../views/index.php?page=Alimentacion";
                </script>

            <?php
    }
}

?>
