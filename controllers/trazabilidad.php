<?php
error_reporting(0);
include '../models/conexion.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();

if ( isset($_POST['camaroneras']) AND
     isset($_POST['responsables']) AND
     TRUE
){

$camaronera = $_POST['camaronera']; 
$responsable = $_POST['responsables'];

$piscina = $_POST['piscina']; 
$corrida = $_POST['corrida']; 
$tipo_alimento = $_POST['tipo_alimento']; 

$fecha_registro = $_POST['fecha_registros']; 
$id_balanceado = $_POST['id_balanceados']; 
$cambios = $_POST['cambios']; 

}

if ( isset($_POST['tipo']) AND
     isset($_POST['cantidad']) AND
     isset($_POST['suffix']) AND
     TRUE
)
{  
$tipo=$_POST['tipo'];   
$cantidad=$_POST['cantidad'];  
$suffix=$_POST['suffix'];  
$camaronera = $_POST['modcamaronera']; 
$piscina = $_POST['modpiscina']; 


 //GET TIPO#  
 $sql = "SELECT id_tipo_alimento  as tipo 
 FROM tipo_alimento where  CONCAT(descripcion_alimento,' ',gramaje_alimento)='".$_POST['tipo']."'";
  $datas = $conexion->query($sql);
 foreach ($datas as $key) {
$tipoint = $key['tipo'];

$sqli = "SELECT a.id_piscina, a.id_tipo_alimento,a.cantidad, c.cantidad_balanceado - a.cantidad AS cantidads, 
    CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as tipo
    FROM `registro_alimentacion_engorde`  a 
            INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento = b.id_tipo_alimento
            INNER JOIN `egreso_balanceado` c ON a.fecha_alimentacion = c.fecha_entrega AND a.id_camaronera = c.camaronera
            AND a.id_piscina = c.id_piscina
            AND c.tipo_balanceado = CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento)
                 WHERE true
                   AND  a.fecha_alimentacion = CURDATE()-1 
                        AND a.id_camaronera = '".$camaronera."'
                           AND a.id_piscina = '".$piscina."'  
                             AND a.id_tipo_alimento = '".$tipoint."';";
                             if (!isset($sobrante)){
                               $datas = $conexion->query($sqli);
                                foreach ($datas as $key) {
                                       $sobrante = $key['cantidads'];};}


}
if ($sobrante <= 0){$sobrante = 0.00;}


/////////////

$base ="SELECT (NOW()) as fecha_registro ,id_balanceado,	cantidad_balanceado,	tipo_balanceado,	sobrante, encargado	
 FROM solicitud_balanceados WHERE id_balanceado = '".$suffix."';" ; 
$database = $conexion->query($base);
foreach ($database as $key) {
$base_id_balanceado = $key['id_balanceado'];
$base_cantidad_balanceado = $key['cantidad_balanceado'];
$base_tipo_balanceado = $key['tipo_balanceado'];
$base_sobrante = $key['sobrante'];
$base_encargado = $key['encargado'];
$fecha_registro = $key['fecha_registro'];
}

if($base_cantidad_balanceado != $cantidad OR $base_tipo_balanceado != $tipo ) {
$register ="
INSERT INTO bitacora_balanceado (`id_bitacora`, `id_balanceado`, `fecha_registro`, `cantidad_balanceado`, `tipo_balanceado`, `sobrante`, `responsable`)
VALUES (
NULL, '$base_id_balanceado', '$fecha_registro', '$base_cantidad_balanceado', '$base_tipo_balanceado', '$base_sobrante', '$base_encargado');
";
$query = mysqli_query($conexion, $register);
}

$base ="SELECT id_bitacora, (NOW()) as fecha_registro ,id_balanceado,	cantidad_balanceado,	tipo_balanceado,	sobrante	
 FROM bitacora_balanceado WHERE id_balanceado = '".$suffix."' AND id_bitacora = ( SELECT MIN(id_bitacora) 
 FROM bitacora_balanceado WHERE id_balanceado = '".$suffix."' );";
$database = $conexion->query($base);
     if (count($database) > 0) {
         foreach ($database as $key) {
             
        $base_cantidad = $key['cantidad_balanceado'];
        $base_tipo = $key['tipo_balanceado'];
        $base_sobrante = $key['sobrante'];
}
         
         
     } else {
         
        $base_cantidad = $cantidad;
        $base_tipo = $tipo;
        $base_sobrante = $sobrante;
     }
     
    
/////////////


if($base_cantidad_balanceado != $cantidad OR $base_tipo_balanceado != $tipo ) {
    
$update="
UPDATE solicitud_balanceados SET cantidad_balanceado = '".$cantidad."',tipo_balanceado =  '".$tipo."',sobrante =  '".$sobrante."' WHERE id_balanceado =  '".$suffix."';";
// $datas = $conexion->query($sql);
mysqli_query($conexion, $update);    
    
}


 header('Content-Type: application/json');
//$response = array('tipo' =>  $tipo, 'cantidad' => $cantidad, 'suffix' => $suffix, 'sobrante' => $sobrante); 
$response = array('tipo' =>  $tipo, 'cantidad' => $cantidad, 'suffix' => $suffix, 'sobrante' => $sobrante,'base_tipo' =>  $base_tipo, 'base_cantidad' => $base_cantidad, 'base_sobrante' => $base_sobrante); 
 $json_response = json_encode($response);
    echo $json_response;
}

if ( isset($_POST['camaronera']) AND
     isset($_POST['piscina']) AND
   //  ($_POST['tipo_alimento'] != NULL) AND
     TRUE
)
{
    
 $sql = "SELECT  CONCAT(descripcion_alimento,' ',gramaje_alimento) as tipo 
 FROM `tipo_alimento` where id_tipo_alimento ='".$_POST["tipo_alimento"]."';";
$datas = $conexion->query($sql);
foreach ($datas as $key) {
$tipo = $key['tipo'];
}



 $sql2 ="SELECT a.id_piscina, a.id_tipo_alimento_2,a.cantidad_2, c.cantidad_balanceado - a.cantidad_2 AS cantidads, 
    CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as tipo
    FROM `registro_alimentacion_engorde`  a 
            INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento_2 = b.id_tipo_alimento
            INNER JOIN `egreso_balanceado` c ON a.fecha_alimentacion = c.fecha_entrega AND a.id_camaronera = c.camaronera
            AND a.id_piscina = c.id_piscina
            AND c.tipo_balanceado = CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento)
                 WHERE true
                   AND  a.fecha_alimentacion = CURDATE()-1 
                        AND a.id_camaronera = '".$_POST["camaronera"]."'
                            AND a.id_piscina = '".$_POST["piscina"]."'  
                               AND a.id_tipo_alimento_2 = '".$_POST["tipo_alimento"]."';";
                                 $datas = $conexion->query($sql2);
                                   if (count($datas) < 1 ) {$sobrante = 0;}
                                    foreach ($datas as $key) {
                                       $sobrante = $key['cantidads'];
                                            }
        if ($sobrante == 0 AND 
    ($_POST['tipo_alimento'] == 9 OR $_POST['tipo_alimento'] == 10 OR
    $_POST['tipo_alimento'] == 13 OR $_POST['tipo_alimento'] == 0  )
    ) {
    $sqli ="
    SELECT
MAX(id_tipo_alimento) as maximo
FROM `tipo_alimento`
WHERE
descripcion_alimento =
(SELECT descripcion_alimento 
    FROM `tipo_alimento`
    WHERE id_tipo_alimento = '".$_POST["tipo_alimento"]."')
    AND
    gramaje_alimento =
(SELECT gramaje_alimento 
    FROM `tipo_alimento`
    WHERE id_tipo_alimento = '".$_POST["tipo_alimento"]."');
    ";             
     $datas = $conexion->query($sqli);
    foreach ($datas as $key) {
     $maximo = $key['maximo'];
     }  
                             
    $sqlic ="SELECT a.id_piscina, a.id_tipo_alimento_2, a.cantidad_2, c.cantidad_balanceado - a.cantidad_2 AS cantidads, 
    CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as tipo
    FROM `registro_alimentacion_engorde`  a 
            INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento_2 = b.id_tipo_alimento
              INNER JOIN `egreso_balanceado` c ON a.fecha_alimentacion = c.fecha_entrega AND a.id_camaronera = c.camaronera
            AND a.id_piscina = c.id_piscina
            AND c.tipo_balanceado = CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento)
                 WHERE true
                   AND  a.fecha_alimentacion = CURDATE()-1 
                        AND a.id_camaronera = '".$_POST["camaronera"]."'
                            AND a.id_piscina = '".$_POST["piscina"]."'  
                               AND a.id_tipo_alimento_2 = '".$maximo."';";
                                   $datas = $conexion->query($sqlic);
                                    foreach ($datas as $key) {
                                       $sobrante = $key['cantidads'];
                                            }
     
                                       }
                                       
                               
          if ($sobrante == 0){                         
                               
 $sql ="SELECT a.id_piscina, a.id_tipo_alimento,a.cantidad, c.cantidad_balanceado - a.cantidad AS cantidads, 
    CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as tipo
    FROM `registro_alimentacion_engorde`  a 
            INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento = b.id_tipo_alimento
            INNER JOIN `egreso_balanceado` c ON a.fecha_alimentacion = c.fecha_entrega AND a.id_camaronera = c.camaronera
            AND a.id_piscina = c.id_piscina
            AND c.tipo_balanceado = CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento)
                 WHERE true
                   AND  a.fecha_alimentacion = CURDATE()-1 
                        AND a.id_camaronera = '".$_POST["camaronera"]."'
                            AND a.id_piscina = '".$_POST["piscina"]."'  
                               AND a.id_tipo_alimento = '".$_POST["tipo_alimento"]."';";
                                   $datas = $conexion->query($sql);
                                   if (count($datas) < 1 ) {$sobrante = 0;}
                                    foreach ($datas as $key) {
                                       $sobrante = $key['cantidads'];
                                     //  $tipo = $datas['tipo'];
                                       //if ($sobrante <=0){
                                    //    $sobrante = "0.00";   
                                      // }
                                            }
                                            
    if ($sobrante == 0 AND 
    ($_POST['tipo_alimento'] == 9 OR $_POST['tipo_alimento'] == 10 OR
    $_POST['tipo_alimento'] == 13 OR $_POST['tipo_alimento'] == 0  )
    ) {
    $sqli ="
    SELECT
MAX(id_tipo_alimento) as maximo
FROM `tipo_alimento`
WHERE
descripcion_alimento =
(SELECT descripcion_alimento 
    FROM `tipo_alimento`
    WHERE id_tipo_alimento = '".$_POST["tipo_alimento"]."')
    AND
    gramaje_alimento =
(SELECT gramaje_alimento 
    FROM `tipo_alimento`
    WHERE id_tipo_alimento = '".$_POST["tipo_alimento"]."');
    ";             
     $datas = $conexion->query($sqli);
    foreach ($datas as $key) {
     $maximo = $key['maximo'];
     }  
                             
    $sqlib ="SELECT a.id_piscina, a.id_tipo_alimento, a.cantidad, c.cantidad_balanceado - a.cantidad AS cantidads, 
    CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as tipo
    FROM `registro_alimentacion_engorde`  a 
            INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento = b.id_tipo_alimento
              INNER JOIN `egreso_balanceado` c ON a.fecha_alimentacion = c.fecha_entrega AND a.id_camaronera = c.camaronera
            AND a.id_piscina = c.id_piscina
            AND c.tipo_balanceado = CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento)
                 WHERE true
                   AND  a.fecha_alimentacion = CURDATE()-1 
                        AND a.id_camaronera = '".$_POST["camaronera"]."'
                            AND a.id_piscina = '".$_POST["piscina"]."'  
                               AND a.id_tipo_alimento = '".$maximo."';";
                                   $datas = $conexion->query($sqlib);
                                    foreach ($datas as $key) {
                                       $sobrante = $key['cantidads'];
                                     //  $tipo = $datas['tipo'];
                                       //if ($sobrante <=0){
                                    //    $sobrante = "0.00";   
                                      // }
                                            }
     
                                       }
                                       
}
                                       
                                        //$sobrante = $datas['cantidad'];
                                      //   $sobrante = var_dump($datas);
                                     //$sobrante = 10.00;
                                     $despacho= $cantidad - $sobrante;
                                     if ($despacho < 0){ $despacho = 0;}
                                    $kilo = $kilo - $despacho;
                                    if ($tipo_alimento == NULL) {$cantidad = 0; }
                                     if ($sobrante <=0){
                                        $sobrante = "0.00";   
                                       }

                                      
  header('Content-Type: application/json');
 $response = array('cantidades' => $cantidad, 'sobrantes' => $sobrante, 'despachos' => $despacho, 'id_tipo' => $tipo_alimento, 'tipo' => $tipo, 'kilo' => $kilo/*, 'log' => $sobrante*/);
//$response = array('data1' =>  $camaronera, 'data2' => $piscina, 'data3' => $tipo_alimento, 'data4' => $kilo, 'data5' => $cantidad, 'data6' => $sobrante, 'data7' => $despacho);
  $json_response = json_encode($response);
    echo $json_response;
    }
?>

