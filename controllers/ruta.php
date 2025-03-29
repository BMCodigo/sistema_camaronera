<?php
// Verificar si la solicitud es AJAX
//if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
    // Obtener los datos enviados por POST
    $id_piscina = $_POST['id_piscina'];
    $familia = $_POST['familia'];
    $semana = $_POST['semana'];
    $inicio_semana = $_POST['inicio_semana'];
    $fin_semana = $_POST['fin_semana'];
    $cantidad = $_POST['cantidad'];
    $costo = $_POST['costo'];
    $ciclo = $_POST['ciclo'];

    // Datos mockeados
    $response = [
        'id_piscina' => $id_piscina,
        'familia' => $familia,
        'semana' => $semana,
        'inicio_semana' => $inicio_semana,
        'fin_semana' => $fin_semana,
        'cantidad' => $cantidad,
        'costo' => $costo,
        'ciclo' => $ciclo,
        'additional_info' => 'Datos adicionales mockeados para la piscina ' . $id_piscina
    ];

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
//} else {
    // Si no es una solicitud AJAX, devolver un mensaje de error
  //  echo 'Solicitud no válida';
//}
?>
