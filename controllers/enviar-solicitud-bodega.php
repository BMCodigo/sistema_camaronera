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
$up= "UPDATE solicitud_balanceados SET estado='En proceso' WHERE camaronera = '$camaronera' AND id_secuencia = '$secuencia' AND estado = 'Rechazado'";
$query_up = mysqli_query($conexion, $up);
foreach ($query_select as $data){
 
    $piscina = $data['id_piscina'];
    $corrida = $data['id_corrida'];
    $cantidad = $data['cantidad_balanceado'];
    $balaneado = $data['tipo_balanceado'];
    $desc = $data['descripcion'];
    $id = $data['id'];
    $faltante = $data['sobrante'];
    

  
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
                           AND a.id_camaronera = '".$camaronera."'
                               AND a.id_piscina = '".$piscina."'  
                                   AND CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) = '".$balaneado."';";
                                     $sobrante = $conectar->mostrar($sql);
                                       $despacho =$cantidad/25-$sobrante[0]['cantidad']/25;
                                        $kilos =$cantidad-$sobrante[0]['cantidad'];
                                           $solicita[$balaneado]+=$despacho;
                                     $sql = "SELECT k.saldo - ".$solicita[$balaneado]." AS disponible
                                     FROM kardex k
                                         JOIN (
                                             SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id
                                                 FROM kardex
                                                     WHERE camaronera_id = '".$camaronera."' 
                                                        AND tipo_balanceado = '".$balaneado."'
                                                         GROUP BY tipo_balanceado
                                                             ) max_ids
                                                                 ON k.tipo_balanceado = max_ids.tipo_balanceado
                                                                     AND k.kardex_id = max_ids.max_kardex_id;";
                                                                     $restante = $conectar->mostrar($sql);//echo$sql;
                            

         
    if ($restante[0]['disponible'] >= 0 ){ 
    $registros=$registros+1;
    } 

}

// $REGISTROS Y $REFERENCIA
//echo $registros."---".$referencia."...";


//if (count($piscina)==$minimo){
    
//}

}


?>
<script>
           alert(" ¡ Solicitud REENVIADA! ", );
          window.location.href="../views/index.php?page=Solicitud-generadas-biologo";
        </script>