<?php
    // Conexión a la base de datos (ajusta tus datos de conexión)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "grupo_vasco";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recuperar el valor de 'id_balanceado'
    $id_balanceado = $_GET['id_balanceado'];

    // Recuperar los valores del formulario
    $cantidad = $_GET['cantidad'];
    $sobrante = $_GET['sobrante'];
    $despacho = $_GET['despacho'];
    $tipo_alimento = $_GET['tipo_alimento'];

    $sqlSolicitud = "SELECT cantidad_balanceado, cantidad_sobrante, cantidad_despacho, tipo_balanceado, encargado
        FROM solicitud_balanceados 
        WHERE id_balanceado = '$id_balanceado'";
    $select = mysqli_query($conn, $sqlSolicitud); // Realizar la inserción

    foreach($select AS $s){
        //echo '</br>';
        $cantidad_inicial = $s['cantidad_balanceado'];
        //echo '</br>';
        $cantidad_sobrante_inicial = $s['cantidad_sobrante'];
        //echo '</br>';
        $cantidad_despacho_inicial = $s['cantidad_despacho'];
        //echo '</br>';
        $tipo_balanceado_inicial = $s['tipo_balanceado'];
        //echo '</br>';
        $encargado_inicial = $s['encargado'];
        //echo '</br>';
        
            $sqlBitacora = "INSERT INTO bitacora_balanceado (id_balanceado, fecha_registro, cantidad_balanceado, tipo_balanceado, sobrante, estado, responsable) 
            VALUES ('$id_balanceado', NOW(), '$cantidad_inicial', '$tipo_balanceado_inicial', '$cantidad_sobrante_inicial', 'm', '$encargado_inicial')";
            $insert = mysqli_query($conn, $sqlBitacora); // Realizar la inserción
    }



    // Consulta SQL para actualizar los valores en la tabla solicitud_balanceado
    $sql = "UPDATE solicitud_balanceados 
            SET cantidad_balanceado = '$cantidad', cantidad_sobrante = '$sobrante', cantidad_despacho = '$despacho', tipo_balanceado = '$tipo_alimento' 
            WHERE id_balanceado = '$id_balanceado'";

   


    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
       // echo "Los datos se han actualizado correctamente.";
        header("Location: ../index.php?page=Aprobacion-solicitud");
    } else {
      //  echo "Error al actualizar los datos: " . $conn->error;
        echo '<script>alert("Error al actualizar los datos.")</script>';
        header("Location: ../index.php?page=Aprobacion-solicitud");
    }

    // Cerrar la conexión
    $conn->close();
?>
