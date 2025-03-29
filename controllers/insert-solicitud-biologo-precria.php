<?php

error_reporting(0);
include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

echo $fechaActual = $_POST['fechaActual'];
echo $id_piscina = $_POST['piscina'];
$id_corrida = $_POST['id_corrida'];
$secuancia = $_POST['secuencial'];

$cantidad_sobrante = $_POST['cantidad_sobrante'];
$cantidad_solicitada = $_POST['cantidad'];
$tipo_alimento = $_POST['tipo_alimento'];
$tipo_alimento_saldo = $_POST['tipo_alimento_saldo'];
$cantidad_despacho = $_POST['cantidad_despacho'];

$encargado = $_POST['encargado'];
$camaronera = $_POST['camaronera'];
$descripcion = $_POST['descripcion'];
echo $id = $_POST['id'];

for ($i = 0; $i < count($id_piscina); ++$i) {

    // Insertar solo si cantidad_despacho es mayor a 0
    if ($cantidad_despacho[$i] > 0) {
       echo $sqli = "INSERT INTO `solicitud_balanceados`(`id_secuencia`, `fecha_entrega`, `id_piscina`, `id_corrida`, `cantidad_balanceado`, `cantidad_sobrante`, `cantidad_despacho`, `motivo`, `tipo_balanceado`, `camaronera`, `encargado`, `descripcion`, `id`, `sobrante`, `estado`) 
                VALUES('$secuancia[$i]', '$fechaActual', '$id_piscina[$i]', '$id_corrida[$i]', '$cantidad_solicitada[$i]', '$cantidad_sobrante[$i]', '$cantidad_despacho[$i]', 'Solicitud', '$tipo_alimento[$i]',  '$camaronera', '$encargado', '$descripcion', '$id', '$cantidad_sobrante[$i]', 'En proceso')";
        
        $query = mysqli_query($conexion, $sqli);
    }
}

// Mostrar mensaje de éxito y redirigir
echo "<script>
    alert('¡ Solicitud para precria generada con éxito !');
    window.location.href='../views/index.php?page=Nueva-solicitud-biologo';
</script>";

?>
