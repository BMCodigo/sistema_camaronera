<?php

error_reporting(0);
include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$secuencia = $_GET['id'];
$camaronera = $_GET['camaronera'];
$user = $_GET['user'];

$select = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$secuencia' AND estado = 'En proceso'";
$query_select = mysqli_query($conexion, $select);

$referencia=0; $registros=0; $minimo= 0;$disponible = 0;
foreach ($query_select as $data){
 
    $piscina = $data['id_piscina'];
    $corrida = $data['id_corrida'];
    $cantidad = $data['cantidad_despacho'];
    $cantidad_sobrante = $data['cantidad_sobrante'];
  
    $desc = $data['descripcion'];
    $id = $data['id'];
    $faltante = $data['cantidad_sobrante'];
    

  
    for ($i = 0; $i < count($piscina); ++$i) {
        
        $referencia=$referencia +1 ;
    
        $sql = "SELECT max(kardex_id) as kardex_id FROM `kardex` where camaronera_id = '".$camaronera."' and tipo_balanceado = '".$balaneado."'";
            $result = $conexion->query($sql);
            $array = mysqli_fetch_assoc($result);
            $sql = "SELECT saldo FROM `kardex` where kardex_id = '".$array['kardex_id']."'";
            $result = $conexion->query($sql);
            $array = mysqli_fetch_assoc($result);
            $getsaldo = $array['saldo'];//echo $getsaldo;
    
            $sql ="SELECT a.id_piscina, a.id_tipo_alimento,a.cantidad, CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as fullname FROM `registro_alimentacion_engorde`  a 
            INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento = b.id_tipo_alimento
            WHERE true
            AND a.fecha_alimentacion = CURDATE()-1
            AND a.id_camaronera = '".$camaronera."'AND a.id_piscina = '".$piscina."'AND CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) = '".$balaneado."';";
            $sobrante = $conectar->mostrar($sql);
                                    
            if($balaneado == 'Origin 0.5'){
                $despacho =$cantidad/10-$sobrante[0]['cantidad']/10;
            }else if($balaneado == 'Origin 0.3'){
                $despacho =$cantidad/10-$sobrante[0]['cantidad']/10;
            }else {
                $despacho =$cantidad/25-$sobrante[0]['cantidad']/25;
            } 

            $kilos =$cantidad-$sobrante[0]['cantidad'];
            $solicita[$balaneado]+=$despacho;
            $sql = "SELECT k.saldo - ".$solicita[$balaneado]." AS disponible FROM kardex k 
            JOIN (SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id 
            FROM kardex WHERE camaronera_id = '".$camaronera."'  
            AND tipo_balanceado = '".$balaneado."' 
            GROUP BY tipo_balanceado ) max_ids 
            ON k.tipo_balanceado = max_ids.tipo_balanceado 
            AND k.kardex_id = max_ids.max_kardex_id"; 
            $restante = $conectar->mostrar($sql);//echo$sql;
        
            if ($restante[0]['disponible'] >= 0 ){ 
                $registros=$registros+1;
            }
    }
}


    if (TRUE){
    foreach ($query_select as $data){

        $piscina = $data['id_piscina'];
        $corrida = $data['id_corrida'];
        $cantidad = $data['cantidad_despacho'];
        $cantidad_sobrante = $data['cantidad_sobrante'];
        $balaneado = $data['tipo_balanceado'];
        $desc = $data['descripcion'];
        $id = $data['id'];
        $faltante = $data['cantidad_sobrante'];

        
        $sql = "SELECT max(kardex_id) as kardex_id FROM `kardex` where camaronera_id = '".$camaronera."' and tipo_balanceado = '".$balaneado."'";
               $result = $conexion->query($sql);
               $array = mysqli_fetch_assoc($result);
               $sql = "SELECT saldo FROM `kardex` where kardex_id = '".$array['kardex_id']."'";
               $result = $conexion->query($sql);
               $array = mysqli_fetch_assoc($result);
               $getsaldo = $array['saldo'];


                $sql ="SELECT a.id_piscina, a.id_tipo_alimento,a.cantidad, CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as fullname FROM `registro_alimentacion_engorde`  a 
                    INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento = b.id_tipo_alimento
                    WHERE true
                    AND a.fecha_alimentacion = CURDATE()-1
                    AND a.id_camaronera = '".$camaronera."'
                    AND a.id_piscina = '".$piscina."'  
                    AND CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) = '".$balaneado."'";
                    $sobrante = $conectar->mostrar($sql);

                    if($balaneado == 'Origin 0.5'){
                        $despacho =floatval($cantidad/10)/*-floatval($faltante/10)*/;
                    }else if($balaneado == 'Origin 0.3'){
                        $despacho =floatval($cantidad/10)/*-floatval($faltante/10)*/;
                    }else {
                        $despacho =floatval($cantidad/25)/*-floatval($faltante/25)*/;
                    } 

                    $kilos =$cantidad-$sobrante[0]['cantidad'];
                    $sql = "SELECT k.saldo - ".$despacho." AS disponible
                    FROM kardex k JOIN ( SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id FROM kardex
                    WHERE camaronera_id = '".$camaronera."' 
                    AND tipo_balanceado = '".$balaneado."'
                    GROUP BY tipo_balanceado) max_ids
                    ON k.tipo_balanceado = max_ids.tipo_balanceado
                    AND k.kardex_id = max_ids.max_kardex_id;";
                    $restante = $conectar->mostrar($sql);
                                                   
                    if($balaneado == 'Origin 0.5'){
                        $cantidades = $despacho/10;
                    }else if($balaneado == 'Origin 0.3'){
                        $cantidades = $despacho/10;
                    }else {
                        $cantidades = $despacho/25;
                    } 

                $getsaldo = $getsaldo - $despacho;
                $faltante=$restante['disponible'];


                if($balaneado == 'Origin 0.5'){
                    $entrega=$despacho*10;
                }else if($balaneado == 'Origin 0.3'){
                    $entrega=$despacho*10;
                }else {
                    $entrega=$despacho*25;
                } 

            
            if ($totales[$balaneado]>0){
                $totales[$balaneado] = $totales[$balaneado] +  $despacho;
            }else {
                $totales[$balaneado] =  $despacho;
            }
            
            if ($totales[$balaneado] < $array['saldo']) {
                $undisposable = 1;
            }
        
                $sqli[$i] = "INSERT INTO `egreso_balanceado`(`fecha_entrega`, `id_piscina`, `id_corrida`, `cantidad_balanceado`, `tipo_balanceado`, `camaronera`, `encargado`, `descripcion`, `id`, `sobrante`, `id_secuencia`, `estado`)
                VALUES ((NOW()), '$piscina', '$corrida', '$entrega', '$balaneado', '$camaronera', '$user', '$desc', '$id', '$cantidad_sobrante', '$secuencia', 'Aprobado')"; //$faltante
                $query = mysqli_query($conexion, $sqli[$i]);

                $sqle[$i] = "INSERT INTO `kardex`(`fecha`, `descripcion`, `tipo_balanceado`, `camaronera_id`, `id_piscina`, `id_corrida`, `id_secuencial`, `ingreso`, `egreso`, `saldo_piscina`, `saldo`, `responsable`) 
                VALUES( (NOW()), '$desc', '$balaneado', '$camaronera', '$piscina', '$corrida', '$secuencia', '$faltante', '$despacho', '0.00', '$getsaldo', '$user')"; 
                $query = mysqli_query($conexion, $sqle[$i]);

                $selectAlimeto = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$secuencia' AND estado = 'En proceso' AND id_piscina = '$piscina' AND id_corrida = '$corrida'";
                $query_select_abb = mysqli_query($conexion, $selectAlimeto);

                foreach($query_select_abb as $a){
                    $tipo_balanceado_sobrante = $a['tipo_balanceado_sobrante'];

                }


                $despacho = $despacho*25;
                $cantidad_sobrante = $cantidad_sobrante;
                $ingreso_bodega_alimento = $despacho+$cantidad_sobrante;

                $sqlkP[$i] = "INSERT INTO `kardex_piscina`(`fecha_ingreso`, `descripcion`, `id_camaronera`, `id_piscina`, `id_corrida`, `egreso_bodega_principal`, `tipo_balanceado_kardex`, `sobrante_piscina`, `tipo_balanceado_sobrante`, `ingreso_bodega_piscina`, `egreso_alimentacion`, `tipo_balanceado_alimentacion`, `saldo_actual`, `responsable`) 
                VALUES (NOW(), '$desc', '$camaronera', '$piscina', '$corrida', '$despacho', '$balaneado', '$cantidad_sobrante', '$tipo_balanceado_sobrante', '$ingreso_bodega_alimento', '0.00', '$balaneado', '$ingreso_bodega_alimento', '$user' )";
                $query = mysqli_query($conexion, $sqlkP[$i]);
                
          
            $update[$i] = "UPDATE solicitud_balanceados SET estado = 'Aprobado' WHERE camaronera ='$camaronera' AND id_piscina = '$piscina' AND id_corrida = '$corrida' AND id_secuencia = '$secuencia'";
            $query_update = mysqli_query($conexion, $update[$i]);
    
            $update_sms = "UPDATE `alertas` SET mensaje = 'Aprobado' WHERE camaronera = '$camaronera' AND id_secuencia = '$secuencia'";
            $query = mysqli_query($conexion, $update_sms);
    }
?>
    <script>
        alert(" ¡ Solicitud de balanceado aprobada ! ", );
        window.location.href="../views/index.php?page=Aprobacion-solicitud";
    </script>
<?php
        
} else {

?>
    <script>
        alert(" ¡ Solicitud NEGADA, revise el kardex y solicite producro existente  ! ", );
        window.location.href="../views/index.php?page=Aprobacion-solicitud";
    </script>
<?php

}

?>
