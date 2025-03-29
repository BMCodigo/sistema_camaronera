<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$camaronera = $_POST['camaronera'];
$tipo_balanceado = $_POST['descripcion_corta']; 
$cantidad_recibida = $_POST['cantidad_recibida'];
$encargado = $_POST['encargado'];
$descripcion = 'Compra';

$asiento_id = $_POST['asiento_id'];
$cantidad_solicitada = $_POST['cantidad_solicitada'];
$id_producto = $_POST['id_producto'];
$codigo_cuenta_contable = $_POST['codigo_cuenta_contable'];
$checklist = $_POST['checklist'];

for ($i = 0; $i < count($cantidad_recibida); ++$i) {

// Eliminar solo el ÚLTIMO par de paréntesis y su contenido
$tipo_balanceado_limpio = preg_replace('/\s*\([^)]*\)\s*$/', '', $tipo_balanceado[$i]);

// Convertir la primera letra en mayúscula manteniendo el resto del texto igual
$tipo_balanceado_limpio = ucfirst($tipo_balanceado_limpio);


    if ($cantidad_recibida[$i] > 0) {
        #insertamos los valores en la tabla ingreso balanceado
       $sql = "INSERT INTO `ingreso_balanceado`(`fecha_ingreso`, `camaronera`, `tipo_balanceado`, `cantidad_balanceado`, `encargado`, `descripcion`, `cantidad_solicitada`, `ProductoId`, `CodigoCuentaContable`, `asientoId`, `checklist`)
                    VALUES((NOW()), '$camaronera', '$tipo_balanceado_limpio', '$cantidad_recibida[$i]','$encargado', '$descripcion', '$cantidad_solicitada[$i]', '$id_producto[$i]', '$codigo_cuenta_contable[$i]', '$asiento_id[$i]', '$checklist[$i]')";
        $query = mysqli_query($conexion, $sql);
    }

    if($checklist[$i] == 'si'){

            $sqlInsert = "SELECT SUM(cantidad_balanceado) AS cantidad_balanceado_suma FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND asientoId = '{$asiento_id[$i]}' AND cantidad_solicitada = '{$cantidad_solicitada[$i]}'";
            $result = $conexion->query($sqlInsert);        

            if ($row = $result->fetch_assoc()) {

                $cantidad_balanceado_suma_total = $row['cantidad_balanceado_suma']+$cantidad_recibida[$i] ?? 0; // Asegurar que haya un valor numérico
                $cantidad_balanceado_suma = $row['cantidad_balanceado_suma'] ?? 0; // Asegurar que haya un valor numérico
            

                if ($cantidad_solicitada[$i] == $cantidad_balanceado_suma) {
                    
                    $sql = "UPDATE comprasfacturasaquapro SET parcial = 'no' WHERE DescripcionCorta = '{$tipo_balanceado[$i]}' AND AsientoId = '{$asiento_id[$i]}' AND id_camaronera = '$camaronera'";
                    $query = mysqli_query($conexion, $sql);

                    $sql = "UPDATE `comprasfacturasaquapro` SET `cheklist`='si' WHERE DescripcionCorta = '$tipo_balanceado[$i]' AND AsientoId = '$asiento_id[$i]' AND id_camaronera = '$camaronera'";
                    $query = mysqli_query($conexion, $sql);

                }else if($cantidad_balanceado_suma  < $cantidad_solicitada[$i] && $cantidad_recibida[$i] > 0){

                    $sql = "UPDATE `comprasfacturasaquapro` SET `parcial`='parcial' WHERE DescripcionCorta = '$tipo_balanceado[$i]' AND AsientoId = '$asiento_id[$i]' AND id_camaronera = '$camaronera'";
                    $query = mysqli_query($conexion, $sql);    
                    
                    $sql = "UPDATE `comprasfacturasaquapro` SET `cheklist`='si' WHERE DescripcionCorta = '$tipo_balanceado[$i]' AND AsientoId = '$asiento_id[$i]' AND id_camaronera = '$camaronera'";
                    $query = mysqli_query($conexion, $sql);

                }else{

                    $sql = "UPDATE `comprasfacturasaquapro` SET `cheklist`='si' WHERE DescripcionCorta = '$tipo_balanceado[$i]' AND AsientoId = '$asiento_id[$i]' AND id_camaronera = '$camaronera'";
                    $query = mysqli_query($conexion, $sql);

                    $sql = "UPDATE `comprasfacturasaquapro` SET `parcial`='no' WHERE DescripcionCorta = '$tipo_balanceado[$i]' AND AsientoId = '$asiento_id[$i]' AND id_camaronera = '$camaronera'";
                    $query = mysqli_query($conexion, $sql);
                 
                }
            }

    }else if($checklist[$i] == 'no'){

        $sql = "UPDATE `comprasfacturasaquapro` SET `parcial`='parcial' WHERE DescripcionCorta = '$tipo_balanceado[$i]' AND AsientoId = '$asiento_id[$i]' AND id_camaronera = '$camaronera'";
        $query = mysqli_query($conexion, $sql);
    }



        $sql = "SELECT max(kardex_id) as kardex_id FROM `kardex` where camaronera_id = '".$camaronera."' and tipo_balanceado = '".$tipo_balanceado_limpio."'";
        $result = $conexion->query($sql);
        $array = mysqli_fetch_assoc($result);
         $sql = "SELECT saldo FROM `kardex` where kardex_id = '".$array['kardex_id']."'";
        $result = $conexion->query($sql);
        $array = mysqli_fetch_assoc($result);
        
        
        $getsaldo = $array['saldo'] + ($cantidad_recibida[$i]); //echo $sql;

        // Verificar si la cantidad recibida es mayor a 0
        if ($cantidad_recibida[$i] > 0) {
            $sql = "INSERT INTO `kardex`(`fecha`, `descripcion`, `tipo_balanceado`, `camaronera_id`, `ingreso`, `egreso`, `saldo_piscina`, `saldo`, `responsable`) 
                VALUES(
                    (NOW()),
                    '$descripcion',
                    '$tipo_balanceado_limpio',
                    '$camaronera',
                    '$cantidad_recibida[$i]',  
                    '0.00',   
                    '$faltante',
                    '$getsaldo',   
                    '$encargado'
                )"; //echo $sql;
            
            // Ejecutar la consulta
            $query = mysqli_query($conexion, $sql);
        } 



}

echo '<script>
    alert("¡Ingreso de producto registrado!");
    window.location.href = "http://127.0.0.1/aquapro/views/index.php?page=Ingreso";
</script>';
