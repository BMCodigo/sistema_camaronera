<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera = $_POST['camaronera'];
$fechaActual = $_POST['fechaActual'];

$piscina = $_POST['piscina'];
$categoria = $_POST['familia'];
$productoId = $_POST['productoIdHidden'];
$medida = $_POST['medida'];

$producto = $_POST['insumo'];
$cantidad = $_POST['conversion'];
$motivo = $_POST['desc'];
$encargado = $_POST['encargado'];

if($camaronera == 1){
    $nombre_camaronera = 115;

}else if($camaronera == 2){
    $nombre_camaronera = 117;

}else if($camaronera == 3){
    $nombre_camaronera = 118;;

}else if($camaronera == 5){
    $nombre_camaronera = 'Grupo Camaron';
}



/* VALIDAR EL INGRESO DE DATOS EN LA BASE DE DATOS PARA VALIDAR EL KARDEX */
for ($i = 0; $i < count($producto); $i++) {

$sql = "SELECT DISTINCT(id_corrida) AS id_corrida, hectareas FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina[$i]'";
$data = $conectar->mostrar($sql);
foreach ($data as $value):
    $id_corrida = $value['id_corrida'];
    $hectareas = $value['hectareas'];
endforeach;



$sql = "SELECT id_camaronera, CodigoCuentaContable, Costo, DescripcionCorta, DescripcionUnidad, Abreviatura FROM comprasfacturasaquapro WHERE id_camaronera = '$camaronera' AND ProductoId = '$productoId[$i]' ORDER BY FechaEmision DESC LIMIT 1";
$data = $conectar->mostrar($sql);

foreach ($data as $value):
    $unidad_medida = $value['DescripcionUnidad'];
    $costo_actual = number_format($value['Costo'], 6);
    $abreviatura = $value['Abreviatura'];
    $descripcion = $value['DescripcionCorta'];
    $CodigoCuentaContable = $value['CodigoCuentaContable'];
endforeach;

$sql = "SELECT f.id_camaronera, f.familia,  f.cuentaMadre,  f.codigoCuenta FROM familiascuentacontable f WHERE f.id_camaronera = '$camaronera' AND f.codigoCuenta  = '$CodigoCuentaContable'";
$data = $conectar->mostrar($sql);                                


foreach($data as $f){

    $categoriaNombre = $f['familia'];
    $cuentaMadre = $f['cuentaMadre'];


    $costo_total = ($costo_actual/$abreviatura) * $cantidad[$i];
    $costo_total_presentacion = $costo_actual/$abreviatura;
    $costo_ha = $costo_total / $hectareas;

    $costo_total = ($costo_actual/$abreviatura) * $cantidad[$i];
    $costo_total_presentacion = $costo_actual/$abreviatura;
    $costo_ha = $costo_total * $hectareas;

    if($cantidad[$i] > 0){

        $sqlInsert ="INSERT INTO `registro_egreso_producto`( `id_camaronera`, `id_piscina`, `id_corrida`, `hectareas`, `fecha_registro`, `categoria`, `producto`, `unidad_medida`, `descripcion`, `costo_actual`, `cantidad`, `motivo`, `encargado`)
        VALUES ('$camaronera', '$piscina[$i]', '$id_corrida', '$hectareas', '$fechaActual', '$categoriaNombre', '$producto[$i]', '$abreviatura', '$unidad_medida', '$costo_actual', '$cantidad[$i]', '$motivo', '$encargado' )";
        $query = mysqli_query($conexion, $sqlInsert);
        
        $sqlcosto = "INSERT INTO `costos_camaronera`(`fecha_consumo`, `id_camaronera`, `nombre_camaronera`, `id_piscina`, `id_corrida`, `hectareas`, `familia`, `cuentaMadre`, `producto`, `medida`, `cantidad`, `costo`, `total`, `total_ha`,  `costo_presentacion`, `responsable`)
        VALUES ('$fechaActual', '$camaronera', '$nombre_camaronera', '$piscina[$i]', '$id_corrida', '$hectareas', '$categoriaNombre', '$cuentaMadre', '$producto[$i]', '$unidad_medida', '$cantidad[$i]', '$costo_actual', '$costo_total', '$costo_ha', '$costo_total_presentacion', '$encargado' )";
        $query = mysqli_query($conexion, $sqlcosto);

        $sql = "SELECT k.saldo, k.saldo - '$cantidad[$i]' AS disponible 
        FROM kardex k 
        JOIN ( 
            SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id 
            FROM kardex 
            WHERE camaronera_id = '$camaronera'  
            AND tipo_balanceado = '$producto[$i]' 
            GROUP BY tipo_balanceado 
        ) max_ids
        ON k.tipo_balanceado = max_ids.tipo_balanceado
        AND k.kardex_id = max_ids.max_kardex_id";

        $data = $conectar->mostrar($sql); 

        // Variable para saldo acumulado
        $saldo_actual = 0;

        foreach($data as $index => $s) {
            
            // Si es la primera iteración, el saldo inicial es el disponible de la consulta
            if ($index === 0) {
                $saldo_actual = $s['disponible'];
            } else {
                // En las siguientes iteraciones, restamos la cantidad correspondiente
                $saldo_actual -= $cantidad[$i];
            }
        
            // Generar el INSERT con el saldo actualizado
            $sqlKardex = "INSERT INTO `kardex`(`fecha`, `descripcion`, `tipo_balanceado`, `camaronera_id`, `id_piscina`, `id_corrida`, `id_secuencial`, `ingreso`, `egreso`, `saldo_piscina`, `saldo`, `responsable`)
            VALUES('$fechaActual', '$motivo', '$producto[$i]', '$camaronera', '$piscina[$i]', '$id_corrida', '0', '0', '$cantidad[$i]', '0', '$saldo_actual', '$encargado' );";
            $query = mysqli_query($conexion, $sqlKardex);
            
        }

}



} }
?>

<script>
    alert(' ¡ Egreso de producto de bodega regsitrado !');
    window.history.go(-1);
</script>