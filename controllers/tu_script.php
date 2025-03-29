<?php
include '../models/conexion.php';

// Establece la conexión a la base de datos
$conectar = new Conexion();
$conexion = $conectar->conectar();

if (isset($_GET['id'])) {
    
    $id = $conexion->real_escape_string($_GET['id']); // Escapar el parámetro
    
    // Encabezado para JSON
    header('Content-Type: application/json');

    // Consulta SQL
    $sql = "SELECT DISTINCT(id_biotipo) AS id_biotipo, id_camaronera, factor, bodyweight FROM `datos_conversion` WHERE id_biotipo = '$id'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data); // Enviar resultados como JSON
    } else {
        echo json_encode(array('error' => 'No se encontraron resultados'));
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'No se proporcionó el ID'));
}



// Cerrar conexión
$conexion->close();
?>
