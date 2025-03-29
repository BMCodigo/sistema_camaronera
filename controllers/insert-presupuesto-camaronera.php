<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera = $_POST['camaronera'];
$hectareas = $_POST['hectareas'];
$dias = $_POST['dias'];
$fecha_registro = $_POST['fecha_registro'];
$presupuesto = $_POST['presupuesto'];
$descripcion = $_POST['descripcion'];
$codigoCuenta = $_POST['codigoCuenta'];
$encargado = $_POST['encargado'];
$cuentaMadre = $_POST['cuentaMadre'];

// Mapear empresa_id según la camaronera
$empresa_id_map = [
    1 => 115,
    2 => 117,
    3 => 118
];
$empresa_id = $empresa_id_map[$camaronera] ?? 0;

// Recorrer los presupuestos y asignar solo el valor correspondiente sin sumar
for ($i = 0; $i < count($codigoCuenta); ++$i) {
    // Escapar los valores para evitar inyecciones SQL
    $descripcionEscapada = mysqli_real_escape_string($conexion, $descripcion[$i]);
    $codigoCuentaEscapado = mysqli_real_escape_string($conexion, $codigoCuenta[$i]);
    $presupuestoEscapado = mysqli_real_escape_string($conexion, $presupuesto[$i]);
    $encargadoEscapado = mysqli_real_escape_string($conexion, $encargado);
    $fechaRegistroEscapada = mysqli_real_escape_string($conexion, $fecha_registro);

    // Construir la consulta con solo los valores que existen
    $sqlInsert = "INSERT INTO `presupuestos_aporbados` 
        (`id_camaronera`, `empresa_id`, `familia`, `codigoCuenta`, `presupuesto_aprobado`, `hectareas`, `dias`, `cuentaMadre`, `encargado`, `fecha_ingreso`) 
    VALUES 
        ('$camaronera', '$empresa_id', '$descripcionEscapada', '$codigoCuentaEscapado', '$presupuestoEscapado', '$hectareas', '$dias', '$cuentaMadre[$i]', '$encargadoEscapado', '$fechaRegistroEscapada')";

    // Ejecutar la consulta
    $query = mysqli_query($conexion, $sqlInsert);
 
}


?>

<script>
  alert("¡ Presupuesto registrado !");
  window.location.href="../views/index.php?page=parametros-presupuesto";
</script>
