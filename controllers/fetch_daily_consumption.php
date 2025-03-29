<?php
header('Content-Type: application/json');

$week = $_POST['week'];

// Aquí iría la lógica para obtener los datos de consumo diario de la base de datos
// Ejemplo de datos devueltos
$data = [
    'Lunes' => 20,
    'Martes' => 15,
    'Miércoles' => 30,
    // ...
];

echo json_encode($data);
?>
