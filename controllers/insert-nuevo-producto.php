<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera =  $_POST['camaronera']; // cambiar a camaronera
$fechaActual = $_POST['fechaActual'];
$categoria = $_POST['categoria'];
//$proveedor = $_POST['proveedor'];
$producto = $_POST['producto'];
$unidad_medida = $_POST['unidad_medida'];
//$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$encargado = $_POST['encargado'];

$sqlPrecio = "SELECT Costo, Codigo, EmpresaId, Abreviatura, DescripcionUnidad FROM costoproductosgestionmak WHERE id_camaronera = '$camaronera' AND DescripcionCorta = '$producto'";
$data = $conectar->mostrar($sqlPrecio);

foreach($data as $ct):
    $precio = $ct['Costo'];
    $codigo = $ct['Codigo'];
    $empresaId = $ct['EmpresaId'];
    $descripcion = $ct['DescripcionUnidad'];
    $Abreviatura = $ct['Abreviatura'];
    /*CAMBIAR EL CODIGO POR UN ID UNICO */
    $sqlInsert ="INSERT INTO `registro_producto`(`codigo`, `proveedor`, `categoria`, `producto`, `unidad_medida`, `precio`, `descripcion`, `abreviatura`, `id_camaronera`, `fecha_registro`, `encargado`)
    VALUES ( '$codigo', '$empresaId', '$categoria', '$producto', '$unidad_medida', '$precio', '$descripcion', '$Abreviatura', '$camaronera', '$fechaActual', '$encargado')";
    $query = mysqli_query($conexion, $sqlInsert);
endforeach;



?>

<script>
    alert(' ¡ Producto registrado !');
    window.history.go(-1);
</script>
