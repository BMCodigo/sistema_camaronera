<?php
error_reporting(0);
include '../models/conexion.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera = $_POST['camaronera']; 
$piscina = $_POST['piscina']; 
$tipo_alimento = $_POST['tipo_alimento']; 
$kilo = $_POST['kilo']; 
$thisdias = $_POST['thisdias']; 
$cantidad = $_POST['cantidad']; 
//$sobrante = $_POST['sobrante'];  
$despacho = $_POST['despacho'];  
$familias =$_POST['familia'];
$camaroneras=$_POST['camaroneras'];
$estado = 1;
/*
<?php
if (isset($_POST['pcamaronera']) && isset($_POST['ppiscina'])) {
    if (isset($_POST['pmasa']) && is_numeric($_POST['pmasa'])) {
        $factores = intval($_POST['ppeso']);
        $base = "SELECT * FROM datos_conversion_1 WHERE factor >= :factores ORDER BY factor ASC LIMIT 1;";
        $stmt = $conexion->prepare($base);
        $stmt->bindValue(':factores', $factores, PDO::PARAM_INT);
        $stmt->execute();
        $key = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($key) {
            $bw_data = floatval($key['bw_acelerado']);
            $densidad = floatval($_POST['pdensidad']);
            $mortalidad = 0;
            $crecimiento = floatval($_POST['ppesop']) / 7;
            $incremento = $crecimiento;
            $kgha_dia = array();
            for ($i = 1; $i <= 7; $i++) {
                $peso_diario = $_POST['ppeso'] + ($incremento * $i);
                $kgha_base = ($peso_diario * $densidad * $bw_data);
                $kgha_dia[$i] = ($kgha_base * $_POST['phas']) / 1000;
            }
            header('Content-Type: application/json');
            $response = array(
                'kgha_lunes' => $kgha_dia[1],
                'kgha_martes' => $kgha_dia[2],
                'kgha_miercoles' => $kgha_dia[3],
                'kgha_jueves' => $kgha_dia[4],
                'kgha_viernes' => $kgha_dia[5],
                'kgha_sabado' => $kgha_dia[6],
                'kgha_domingo' => $kgha_dia[7]
            );
            echo json_encode($response);
        } else {
            header('Content-Type: application/json');
            $response = array('costofinal' => '00.01');
            echo json_encode($response);
        }
    }
}
?>

*/

if ( isset($_POST['pcamaronera']) AND
     isset($_POST['ppiscina']) AND
     TRUE
)

{
    if ( 
     isset($_POST['pmasa']) AND
     TRUE){
         
        $camaronera = $_POST['pcamaronera'];
        $piscina = $_POST['ppiscina'];
            $hasta_ante = $_POST['thisantes'];
                $this_desde = $_POST['thisdesde'];
                    $this_dias = $_POST['thisdias'];
                     $this_corrida = $_POST['thiscorrida'];

 
      $sql_dias = "SELECT fecha_siembra, DATEDIFF('$this_desde', fecha_siembra) AS dias_ciclo FROM `registro_piscina_engorde` WHERE id_piscina = '$piscina' AND estado != 'Cosechado' AND id_camaronera = '$camaronera' AND id_corrida = '$this_corrida'";
     $fechabase = $conexion->query($sql_dias); 
      foreach ($fechabase as $values_dias) {
                   $dias_ciclo = $values_dias['dias_ciclo'];}
                   
                   
            $sql_densidads = " SELECT * FROM `registro_muestreo` WHERE id_piscina = '$piscina' AND id_camaronera = '$camaronera' AND id_corrida = '$this_corrida' AND id_registro_muestreo = ( SELECT MIN(id_registro_muestreo) FROM `registro_muestreo` WHERE id_piscina = '$piscina' AND id_camaronera = '$camaronera' AND id_corrida= '$this_corrida' );";
                    $data_densidads = $conexion->query($sql_densidads); 
                foreach ($data_densidads as $values_densidads) {
                                $densidads = $values_densidads['densidad'];
                                            }
                   
                   
          $sql_param = "SELECT dias, mortalidad FROM parametros_soreviviencia WHERE id_camaronera = '$camaronera';";
         $data_param = $conexion->query($sql_param); 
                         foreach ($data_param as $values_param) {
                                $param_dias = $values_param['dias'];
                                 $param_mort = $values_param['mortalidad'];
                                            }
     // $log= $param_mort;
    //   if ($dias_ciclo <= $data_param[0]['dias'] ){
                                            $mor_total =$densidads * ($param_mort/100) ;
                                            $mor_diaria = ($mor_total / $param_dias);
           
    //   }
       /*  if ($currentday <= $data_param[0]['dias'] ){
                                            $mor_total =$densidads * ($data_param[0]['mortalidad']/100) ;
                                            $mor_diaria = ($mor_total / $data_param[0]['dias']);*/
                                     
         
  /*     $fecha1 = new DateTime($siembra);
          $fecha2 = new DateTime($this_desde);
       $difer = $fecha1->diff($fecha1);*/

   // by Camaroneras

                        $getproyect = "select peso_final, hectareas, alim_sum2, n
                            ,  1.00/(0.007963335+0.1387779/peso_final) AS kg_10_m 
                                , (alim_sum2 / hectareas) / n AS kg_ha_semana_m
                                    from simulacion_proceso_test 
                                        WHERE fecha_muestreo = '$hasta_ante'
                                AND id_camaronera = '$camaronera'
                        AND piscinas = '$piscina'
                AND id_bio = 'BW Prom'";
                $data_proyect = $conexion->query($getproyect); 
                                foreach ($data_proyect as $values_proyect) {
                                $kg_10_m = $values_proyect['kg_10_m'];
                                 $kg_ha_semana_m = $values_proyect['kg_ha_semana_m'];
                                            }
                 
                $proyecto= (($kg_ha_semana_m*10)/$kg_10_m)*10000;
        

               $factores=$_POST['ppeso'];// 0.75
                 $masabw = $_POST['pmasa'];  //1 
               $base = "SELECT * FROM datos_conversion WHERE factor <='$factores' AND estado = '1' AND id_biotipo = '$masabw'  ORDER BY factor DESC LIMIT 1;";
       $database = $conexion->query($base); 
    foreach ($database as $key) {
            $bw_data = floatval($key['bodyweight']);// 8.18
        }  
                /*   $base = "SELECT * FROM datos_conversion_1 WHERE factor >='$factores' ORDER BY factor ASC LIMIT 1;";
       $database = $conexion->query($base);
    foreach ($database as $key) {
            $bw_data = floatval($key['bw_acelerado']);//2.41
        }    */
        
        $crec = $_POST['ppesop'];
        $hecta = $_POST['phas'];
        $densidad = $_POST['pdensidad'];// 290000
        $mortalidad= 0;
        $crecimiento= floatval($_POST['ppesop'])/7; //REDONDEAR SIMPLE
        $incremento=$crecimiento;
        $incremento = round($incremento,2); 
        $densidad_proyeccion =$proyecto ;                                   //DENSIDAD PROYECCION
        for($i=1; $i<=7; $i++)
        {
            $dia_densidad[$i] = $dias_ciclo +($i-1);
        $this_mortalidad[$i] = $mor_diaria * $dia_densidad[$i] ;                              //DENSIDAD SUPERVIVENCIA
         $densidad_supuesta[$i] = $densidads - $this_mortalidad[$i];

        $peso_diario[$i] = $factores +  ($incremento*$i);    // OK 
        $factorunico = $peso_diario[$i]; 
             $base = "SELECT * FROM datos_conversion WHERE factor <='$factorunico' AND estado = '1' AND id_biotipo = '$masabw' ORDER BY factor DESC LIMIT 1;";
       $database = $conexion->query($base); 
    foreach ($database as $key) {
            $bw_data = floatval($key['bodyweight']);// 8.18
        }  
        
        
       $kgha_base[$i]= ($peso_diario[$i] * $densidad * ($bw_data/100) ); //7699950
       
         $kgha_base[$i]= $kgha_base[$i]/1000; //76.99950
      $kgha_dia[$i]=  ($kgha_base[$i] * $_POST['phas']);
        
        if ($dia_densidad[$i]>=$param_dias){
        
      $kgha_base[$i]= ($peso_diario[$i] * $densidad_proyeccion * ($bw_data/100) ); //7699950
       
        $kgha_base[$i]= $kgha_base[$i]/1000; //76.99950
        $kgha_dia[$i]=  ($kgha_base[$i] * $_POST['phas']);    
            
            
        } else {
        
                $kgha_base[$i]= ($peso_diario[$i] *  $densidad_supuesta[$i] * ($bw_data/100) ); //7699950
         
         $kgha_base[$i]= $kgha_base[$i]/1000; //76.99950
          
      $kgha_dia[$i]=  ($kgha_base[$i] * $_POST['phas']);
            
            
        }
          
        
        }

        
        
       $hhas = $_POST['phas'];//6.96
     //   $peso = $_POST['ppesof']/7;
      //  $densidad = $_POST['pdensidad'];

//        $kgha_base= ($peso * $densidad * $bw_data );
 //       $kgha_lunes=  ($kgha_base * $_POST['phas'])/1000;//52297.68857142858   53591.652
         
                 /*
            $dias_ciclo
                   $densidads
                   $param_dias
                   $param_mort
                   $mor_total
                   $mor_diaria
                   $dia_densidad[1]
                   $this_mortalidad[1]
                   $densidad_supuesta[1]
                   */
        
                $logger = " 
        INSERT INTO `gvascoco_aquapro`.`constantes_generales` (`variable`, `texto`, `numero`)
VALUES
   ('kg_10_m', '$kg_10_m', '$kg_10_m'),
    ('kg_ha_semana_m', '$kg_ha_semana_m', '$kg_ha_semana_m'),
      ('proyectado', '$densidad_proyeccion', '$densidad_proyeccion'),
          ('hasta_ante', '$hasta_ante', '$hasta_ante'),
              ('camaronera', '$camaronera', '$camaronera'),
                  ('piscina', '$piscina', '$piscina'),
      ('densidad_D', '$densidad_proyeccion', '$densidad_proyeccion');
    ";
    
            $logger_mortalidad = " 
        INSERT INTO `gvascoco_aquapro`.`constantes_generales` (`variable`, `texto`, `numero`)
VALUES
   ('dias_ciclo', '$dias_ciclo', '$dias_ciclo'),
    ('densidad_siembra', '$densidads', '$densidads'),
      ('param_dias', '$param_dias', '$param_dias'),
        ('param_mort', '$param_mort', '$param_mort'),
          ('mor_total', '$mor_total', '$mor_total'),
            ('mor_diaria', '$mor_diaria', '$mor_diaria'),
        
                    ('dia_densidad1', '$dia_densidad[1]', '$dia_densidad[1]'),
                          ('dia_densidad2', '$dia_densidad[2]', '$dia_densidad[2]'),
                                ('dia_densidad3', '$dia_densidad[3]', '$dia_densidad[3]'),
                                      ('dia_densidad4', '$dia_densidad[4]', '$dia_densidad[4]'),
                                            ('dia_densidad5', '$dia_densidad[5]', '$dia_densidad[5]'),
                                                  ('dia_densidad6', '$dia_densidad[6]', '$dia_densidad[6]'),
                                                          ('dia_densidad7', '$dia_densidad[7]', '$dia_densidad[7]'),
                    ('dia_mortalidad1', '$this_mortalidad[1]', '$this_mortalidad[1]'),
                          ('dia_mortalidad2', '$this_mortalidad[2]', '$this_mortalidad[2]'),
                                ('dia_mortalidad3', '$this_mortalidad[3]', '$this_mortalidad[3]'),
                                      ('dia_mortalidad4', '$this_mortalidad[4]', '$this_mortalidad[4]'),
                                            ('dia_mortalidad5', '$this_mortalidad[5]', '$this_mortalidad[5]'),
                                                  ('dia_mortalidad6', '$this_mortalidad[6]', '$this_mortalidad[6]'),
                                                          ('dia_mortalidad7', '$this_mortalidad[7]', '$this_mortalidad[7]'),
          
    ('densidad_supuesta1', '$densidad_supuesta[1]', '$densidad_supuesta[1]'),
      ('densidad_supuesta2', '$densidad_supuesta[2]', '$densidad_supuesta[2]'),
        ('densidad_supuesta3', '$densidad_supuesta[3]', '$densidad_supuesta[3]'),
          ('densidad_supuesta4', '$densidad_supuesta[4]', '$densidad_supuesta[4]'),
            ('densidad_supuesta5', '$densidad_supuesta[5]', '$densidad_supuesta[5]'),
              ('densidad_supuesta6', '$densidad_supuesta[6]', '$densidad_supuesta[6]'),
                ('densidad_supuesta7', '$densidad_supuesta[7]', '$densidad_supuesta[7]'),
      ('densidad_D', '$densidad_proyeccion', '$densidad_proyeccion');
    ";
    
        $loggerOff = " 
        INSERT INTO `gvascoco_aquapro`.`constantes_generales` (`variable`, `texto`, `numero`)
VALUES
    ('peso', '$factores', '$factores'),
    ('idBw', '$masabw', '$masabw'),
    ('Bw', '$bw_data', '$bw_data'),
    ('densidad', '$densidad', '$densidad'),
    ('mortalidad', '$mortalidad', '$mortalidad'),
    ('crecimiento', '$crec', '$crec'),
    ('crecimientoDiario', '$crecimiento', '$crecimiento'),
    ('hectareas', '$hecta', '$hecta'),
    ('peso lunes', '$peso_diario[1]', '$peso_diario[1]'), 
    ('peso Martes', '$peso_diario[2]', '$peso_diario[2]'), 
    ('peso Miercoles', '$peso_diario[3]', '$peso_diario[3]'), 
    ('peso Jueves', '$peso_diario[4]', '$peso_diario[4]'), 
    ('peso Viernes', '$peso_diario[5]', '$peso_diario[5]'), 
    ('peso Sabado', '$peso_diario[6]', '$peso_diario[6]'), 
    ('peso Domingo', '$peso_diario[7]', '$peso_diario[7]'), 
    ('lunes', '$kgha_base[1]', '$kgha_base[1]'), 
    ('Martes', '$kgha_base[2]', '$kgha_base[2]'), 
    ('Miercoles', '$kgha_base[3]', '$kgha_base[3]'), 
    ('Jueves', '$kgha_base[4]', '$kgha_base[4]'), 
    ('Viernes', '$kgha_base[5]', '$kgha_base[5]'), 
    ('Sabado', '$kgha_base[6]', '$kgha_base[6]'), 
    ('Domingo', '$kgha_base[7]', '$kgha_base[7]');

 ";
$queryes = mysqli_query($conexion, $logger);

         header('Content-Type: application/json');


$response = array('log' => $log, 'kgha_lunes' => $kgha_dia[1], 'kgha_martes' =>  $kgha_dia[2],'kgha_miercoles' =>  $kgha_dia[3],'kgha_jueves' =>  $kgha_dia[4],'kgha_viernes' =>  $kgha_dia[5],'kgha_sabado' =>  $kgha_dia[6],'kgha_domingo' =>  $kgha_dia[7]); 


//$response = array('kgha_lunes' =>$kgha_dia[1], 'kgha_martes' =>  $kgha_dia[2],'kgha_miercoles' =>  $kgha_dia[3],'kgha_jueves' =>  $kgha_dia[4],'kgha_viernes' =>  $kgha_dia[5],'kgha_sabado' =>  $kgha_dia[6],'kgha_domingo' =>  $kgha_dia[7]); 

 $json_response = json_encode($response);
    echo $json_response;         
         
         
     } else {
         
         
         header('Content-Type: application/json');
$response = array('costofinal' =>  '00.01'); 
 $json_response = json_encode($response);
    echo $json_response;
    
}}

if ( isset($_POST['familia']) AND
     isset($_POST['camaroneras']) AND
     TRUE
){
    
        $tipos = "
    SELECT CONCAT(producto,' ',marca,' ',proveedor,' ',medida) AS producto FROM `insumos_camaronera` where familia = '$familias' and estado = '$estado';
    ";
   $alltipos = $conexion->query($tipos);
 
       foreach ($alltipos as $key => $value) {
         $tipos1[] = $value;
            
}
      
    $piscinas = "SELECT DISTINCT(id_piscina), id_corrida  FROM registro_piscina_engorde WHERE id_camaronera = '$camaroneras' AND estado = 'En proceso' ORDER BY id_piscina;
    ";
    $allpiscinas = $conexion->query($piscinas);

        foreach ($allpiscinas as $value) {
         $piscinas1[] = $value;
            
}
    

    
    
     header('Content-Type: application/json');
$response = array('tipos' =>  $tipos1,'piscinas' =>  $piscinas1); 
 $json_response = json_encode($response);
    echo $json_response;
    
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

    /* SPECIAL PROCESS
    $sql_advice="
    (SELECT y.id_secuencia, y.fecha_entrega, y.id_piscina, 
         y.id_corrida, y.cantidad_balanceado, y.tipo_balanceado,
            y.camaronera, y.encargado,y.descripcion,y.sobrante, y.estado, x.id_balanceado,
                 x.fecha_registro, x.cantidad_balanceado AS cantidad_base, x.tipo_balanceado AS tipo_base, x.sobrante AS sobrante_base, x.responsable AS responsable_base, x.id_bitacora 
                     FROM bitacora_balanceado x
                         INNER JOIN solicitud_balanceados y 
                      ON x.id_balanceado = y.id_balanceado 
                WHERE TRUE 
            AND y.fecha_entrega = '2024-04-29'
             AND y.camaronera = '1'
            AND  y.id_piscina = '3'
         --     AND y.tipo_balanceado = 'Katal Bio 2.0'
   AND y.estado = 'Aprobado' 
         ORDER BY y.id_piscina ASC, x.id_bitacora ASC);";
            $datas = $conexion->query($sql_advice);
            echo $datas[0]['cantidad_balanceado']
               echo $datas[0]['tipo_balanceado']
               echo $datas[0]['cantidad_base']
               echo $datas[0]['tipo_base']
               if ($datas[0]['tipo_base'] == $datas[0]['tipo_balanceado']){
                     if ($datas[0]['cantidad_base'] > $datas[0]['cantidad_balanceado']){
                     //PROCESSING [C reg ]
                     echo $suffix;
               } }
    */
    
                                      
  header('Content-Type: application/json');
 $response = array('cantidades' => $cantidad, 'sobrantes' => $sobrante, 'despachos' => $despacho, 'id_tipo' => $tipo_alimento, 'tipo' => $tipo, 'kilo' => $kilo/*, 'log' => $sobrante*/);
//$response = array('data1' =>  $camaronera, 'data2' => $piscina, 'data3' => $tipo_alimento, 'data4' => $kilo, 'data5' => $cantidad, 'data6' => $sobrante, 'data7' => $despacho);
  $json_response = json_encode($response);
    echo $json_response;
    }
    
    if ( isset($_POST['fechas']) AND
     isset($_POST['camaroneras']) AND
     isset($_POST['modificaciones']) AND
     TRUE
)
{ 
                           switch ($_POST['camaroneras']) {

                        case 'Darsacom':
                          $id_camaronera=1 ;
                            break;
                        case 'Jopisa':
                          $id_camaronera=2 ;
                            break;
                        case 'Aquacamaron':
                          $id_camaronera=3 ;
                            break;
                        case 'Aquanatura':
                          $id_camaronera=4 ;
                            break;
                        case 'grupoCamaron':
                          $id_camaronera=5 ;
                            break;

                       }
                       
        $dateString = $_POST['fechas'];
            $timestamp = strtotime($dateString);
                $formattedDate = date('Y-m-d', $timestamp);

    if($_POST['modificaciones']==0){
        
        
    } else {
        
                $sql_trace = "
    (SELECT y.id_secuencia, y.fecha_entrega, y.id_piscina, 
         y.id_corrida, y.cantidad_balanceado, y.tipo_balanceado,
            y.camaronera, y.encargado,y.descripcion,y.sobrante, y.estado,
                 x.fecha_registro, x.cantidad_balanceado AS cantidad_base, x.tipo_balanceado AS tipo_base, x.sobrante AS sobrante_base, x.responsable AS responsable_base, x.id_bitacora 
                     FROM bitacora_balanceado x
                         INNER JOIN solicitud_balanceados y 
                      ON x.id_balanceado = y.id_balanceado 
                WHERE TRUE 
            AND y.fecha_entrega = '$dateString' AND y.camaronera = '$id_camaronera'
    AND y.estado = 'Aprobado' 
         ORDER BY y.id_piscina ASC, x.id_bitacora ASC);
     ";   $datas = $conexion->query($sql_trace);
 //foreach ($datas as $key) {
//$bitacora = $key['cantidad_base']; 
 //   }
 
  //  $datab = array();
    while ($row = $datas->fetch_assoc()) {
        $datab[] = $row;
    }
  //   $datab = $datas->fetch_all(MYSQLI_ASSOC);
     
    
    }
  //  $tmps=var_dump($datas);
    header('Content-Type: application/json');
 $response = array('test' => $datab);
  $json_response = json_encode($response);
    echo $json_response; 
    
}
?>

