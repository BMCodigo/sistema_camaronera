<?php
$targetDir = "../views/empresa/uploads/"; // Carpeta donde se guardarán las imágenes
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if (isset($_FILES['image'])) {
    $fileName = basename($_FILES['image']['name']);
    $targetFile = $targetDir . $fileName;
    $relativePath = "uploads/" . $fileName; // Ruta relativa para la base de datos
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $camaronera = $_POST['camaronera'];
    $piscina = $_POST['piscina'];

    // Validar tipo de archivo
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowedTypes)) {
        die("Solo se permiten archivos JPG, JPEG, PNG y GIF.");
    }

    // Configuración de conexión
    $servername = "190.90.160.172";
    $username = "gvascoco_aquapro_admin";
    $password = "d3v3l0p3r02023";
    $database = "gvascoco_aquapro";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Mover el archivo al servidor
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        // Preparar y ejecutar la inserción en la base de datos
        $stmt = $conn->prepare("INSERT INTO images (file_path, id_camaronera, id_piscina) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        $stmt->bind_param("sss", $relativePath, $camaronera, $piscina);
        if ($stmt->execute()) {
            echo "<script>alert('Imagen subida exitosamente.'); window.history.back();</script>";
        } else {
            echo "<script>alert('Error al guardar la imagen en la base de datos: " . $stmt->error . "'); window.history.back();</script>";
        }
        $stmt->close();
    } else {
        echo "Error al subir el archivo.";
    }

    $conn->close();
}
?>
