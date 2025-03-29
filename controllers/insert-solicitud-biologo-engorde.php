<?php

error_reporting(0);
include '../models/conexion.php';
//$objeto = new corrida();

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$piscina = $_POST['piscina'];
$corrida = $_POST['corrida'];

$faltante = $_POST['sobrante'];
$cantidad_despacho = $_POST['despachos'];
$cantidad_sobrante = $_POST['saldo'];
$cantidad_solicitada = $_POST['cantidades'];

$tipo_alimento = $_POST['tipo_alimento'];

$encargado = $_POST['encargado'];
$camaronera = $_POST['camaronera'];

$des = $_POST['desc'];
$id = $_POST['id'];

$secuancia = $_POST['secuencia'];

$minimo= 0; $total = 0; 

for ($i = 0; $i < count($piscina); ++$i){
 
    $sqlAlimento="SELECT CONCAT(descripcion_alimento, ' ', gramaje_alimento) AS tipo_alimento   FROM tipo_alimento WHERE id_tipo_alimento = '$tipo_alimento[$i]'";
    $resultAlim = $conexion->query($sqlAlimento);

    foreach ($resultAlim as $key) {
        $alimento = $key['tipo_alimento'];
    }

    if($tipo_alimento[$i] >=0 && $cantidad_solicitada[$i] > 0 || $cantidad_sobrante[$i] > 0/*AND $_POST['cantidades'][$i] > 0*/){ 

        if( $piscina[$i] == '17B'){
            $piscina[$i] = 22;
        }
        if( $piscina[$i] == '15B'){
            $piscina[$i] = 24;
        }
        if( $piscina[$i] == '15A'){
            $piscina[$i] = 23;
        }

        
                                                         
        if($tipo_alimento[$i] == 'Origin 0.5'){
            $solicita[$tipo_alimento[$i]]+=$_POST['despachos'][$i]/10;
        }else if($tipo_alimento[$i] == 'Origin 0.3'){
            $solicita[$tipo_alimento[$i]]+=$_POST['despachos'][$i]/10;
        }else {
            $solicita[$tipo_alimento[$i]]+=$_POST['despachos'][$i]/25;
        } 

        
        
        $sql ="SELECT a.id_piscina, a.id_tipo_alimento,a.cantidad, c.cantidad_balanceado - a.cantidad AS cantidads,  CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as fullname FROM `registro_alimentacion_engorde`  a 
            INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento = b.id_tipo_alimento
            INNER JOIN `egreso_balanceado` c ON a.fecha_alimentacion = c.fecha_entrega AND a.id_camaronera = c.camaronera
            AND a.id_piscina = c.id_piscina
            AND c.tipo_balanceado = CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento)
            WHERE true
            AND  a.fecha_alimentacion = CURDATE()-1 
            AND a.id_camaronera = '".$camaronera."' AND a.id_piscina = '".$piscina[$i]."' AND CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) = '".$alimento."';";
            $datas = $conectar->mostrar($sql);
            
            if ($datas[0]['cantidad'] == NULL) {
                $faltante = '0.00';
            }else {
                $faltante = $datas[0]['cantidads'];
            }
                                       
            if($tipo_alimento[$i] == 'Origin 0.5'){
                $sacks =  $faltante /10;
            }else if($tipo_alimento[$i] == 'Origin 0.3'){
                $sacks =  $faltante /10;
            }else {
                $sacks =  $faltante /25;
            } 
         
        
            $sql = "SELECT k.saldo, k.saldo - ".$solicita[$tipo_alimento[$i]]." AS disponible, k.saldo + ".$sacks." AS stock FROM kardex k 
                    JOIN ( SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id FROM kardex WHERE camaronera_id = '".$camaronera."'  AND tipo_balanceado = '".$alimento."' GROUP BY tipo_balanceado ) max_ids
                    ON k.tipo_balanceado = max_ids.tipo_balanceado
                    AND k.kardex_id = max_ids.max_kardex_id;";
                    $restante = $conectar->mostrar($sql); 
                    $cantidad[$i] = $_POST['cantidades'][$i];
                                                            
        if ($cantidad[$i] > 0){  
            $total = $total + 1;
        }

        if ($restante[0]['disponible']>=0 AND $restante[0]['disponible'] != NULL ){ 

            $minimo=$minimo+1;

            if ($faltante <=0) {
                $faltante = 0.00;
            }

            $sqli ="INSERT INTO `solicitud_balanceados`(`id_secuencia`, `fecha_entrega`, `id_piscina`, `id_corrida`, `cantidad_balanceado`, `cantidad_sobrante`, `cantidad_despacho`, `motivo`, `tipo_balanceado`, `camaronera`, `encargado`, `descripcion`, `id`, `sobrante`, `estado`) 
            VALUES('$secuancia[$i]', '$fechaActual', '$piscina[$i]', '$corrida[$i]', '$cantidad[$i]', '$cantidad_sobrante[$i]', '$cantidad_despacho[$i]', 'Solicitud', '$alimento', '$camaronera', '$encargado', '$des', '$id', '$cantidad_sobrante[$i]', 'En proceso')";//echo '<br>'.$sqli[$i];
            $query = mysqli_query($conexion, $sqli);

        } else {

                $valor[$i]=$restante[0]['stock']*25;
                
                if($tipo_alimento[$i] == 'Origin 0.5'){
                    $valor[$i]=$restante[0]['stock']*10;
                }else if($tipo_alimento[$i] == 'Origin 0.3'){
                    $valor[$i]=$restante[0]['stock']*10;
                }else {
                    $valor[$i]=$restante[0]['stock']*25;
                } 
                
                 $lugar[$i]=$piscina[$i];
                $producto[$i]=$alimento;
        }
    } 
}

?>

<script>
    alert(" ¡ Solicitud registrada ! ", );
    window.location.href="../views/index.php?page=Nueva-solicitud-biologo";
</script>
