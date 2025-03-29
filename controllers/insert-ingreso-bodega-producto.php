<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$categoria = $_POST['categoria'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$camaronera = $_POST['camaronera'];
$fechaActual = $_POST['fechaActual'];
$motivo = $_POST['motivo'];
$encargado = $_POST['encargado'];

$sql = "SELECT proveedor, unidad_medida, precio, descripcion FROM registro_producto WHERE id_camaronera = '$camaronera' AND producto = '$producto'";
$data = $conectar->mostrar($sql);
foreach ($data as $value):
    $proveedor = $value['proveedor'];
    $unidad_medida = $value['unidad_medida'];
    $costo_actual = $value['precio'];
    $descripcion = $value['descripcion'];
endforeach;


$sqlInsert ="INSERT INTO `insumos_camaronera`(`id_camaronera`, `categoria`, `producto`, `proveedor`, `medida`, `cantidad`, `descripcion`, `motivo`, `encargado`, `costo_actual` , `fecha_registro`)
VALUES ('$camaronera', '$categoria', '$producto', '$proveedor', '$unidad_medida', '$cantidad', '$descripcion', '$motivo', '$encargado', '$costo_actual', '$fechaActual')";
$query = mysqli_query($conexion, $sqlInsert);

?>

<script>
    alert(' ¡ Producto ingresado a bodega !');
    window.history.go(-1);
</script>