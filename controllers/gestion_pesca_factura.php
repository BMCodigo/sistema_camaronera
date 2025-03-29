<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

// Crear conexión
$conectar = new Conexion();
$conexion = $conectar->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $ids = $_POST['id'];
    $fechas_facturado = $_POST['fecha_facturado'];
    $libras_procesadas = $_POST['libras_procesadas'];
    $libras_solicitadas = $_POST['libras_solicitadas'];
    $estado = $_POST['estado'];
    $encargado = $_POST['encargado'];


    // Iterar sobre los registros para actualizar
    for ($i = 0; $i < count($ids); ++$i) {

        if($estado[$i] == 'Procesado'){
            $cheks[$i] = 'Si';
            $estado[$i] = 'Facturado';
            //$libras_procesadas = $_POST['libras_procesadas'];
            //$libras_solicitadas = $_POST['libras_solicitadas'];
        }else{
            $cheks[$i] = 'No';
            $estado[$i] = 'Por procesar';
            //$libras_procesadas = $_POST['libras_procesadas'];
            //$libras_procesadas = $_POST['libras_solicitadas'];
        }

        // Preparar la consulta de actualización
            $sqlUpdateFacturado = "UPDATE gestion_pesca_facturada 
            SET fecha_facturado = '$fechas_facturado[$i]', libras_gestionadas = '$libras_procesadas[$i]', estado = '$estado[$i]', encargado = '$encargado[$i]', checks = '$cheks[$i]' 
            WHERE id_facturado = '$ids[$i]'";
            //echo '</br>';
            $query = mysqli_query($conexion, $sqlUpdateFacturado);

    }
    
}
?>

<script>
    alert("Datos actualizados con éxito");
    window.location.href="../views/index.php?page=gestion-pesca";
</script>
