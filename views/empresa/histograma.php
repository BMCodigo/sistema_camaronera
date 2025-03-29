<div class="container">
    <h5>Cargar imagen de histograma de piscinas proximas a pesca</h5>

    <form action="../views/empresa/upload.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">
            <label for="camaronera">Camaronera</label>
            <input type="text" class="form-control"
                value="<?php if($camaronera == 1){ echo 'Darsacom'; }else if($camaronera == 2){ echo 'Aquacamaron'; }else if($camaronera == 3){ echo 'Jopisa'; }else if($camaronera == 5){ echo 'Grupo Camaron'; }else{ echo 'No existe dato de camaronera'; } ?>" readonly style="background:none;">
            <input type="hidden" class="form-control" id="camaronera" aria-describedby="camaronera"
                placeholder="camaronera" name="camaronera" value="<?php echo $camaronera; ?>" >

            <select class="form-control mt-3" name="piscina" id="piscina" required>
                <option value="0">
                    [Seleccione Piscina]
                </option>
                <?php

                    $objeto_tabla_piscina = new corrida();
                    $sql_tabla_piscina = "SELECT id_piscina FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso'";
                    $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                    foreach ($data as $value) {
                ?>
                <option value="<?php echo $value['id_piscina']; ?>">
                    <?php echo 'Piscina: '.$value['id_piscina']; ?>
                </option>

                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <input type="file" class="form-control mt-4" name="image" id="image" aria-describedby="image"
                placeholder="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Subir</button>

    </form>

</div>
<hr>
<h1 class="text-center" style="color:brown; margin-left: 25px;">Imágenes cargadas de histograma</h1>
<?php
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

// Consulta SQL con ordenación por fecha más reciente
$sql = "SELECT file_path, uploaded_at, id_piscina, id_camaronera FROM images  WHERE id_camaronera = '$camaronera' ORDER BY uploaded_at DESC";
$result = $conn->query($sql);
$images = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $images[] = [
            "path" => "views/empresa/" . $row['file_path'], // Ruta relativa para el HTML
            "date" => $row['uploaded_at'], // Fecha de subida
            "id_piscina" => $row['id_piscina'] // ID de la piscina
        ];
    }
?>

<div id="gallery">
    <?php if (!empty($images)): ?>
    <?php foreach ($images as $image): ?>
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="<?php echo htmlspecialchars($image['path']); ?>" 
            alt="Imagen subida el <?php echo htmlspecialchars($image['date']); ?>" 
            onclick="showModal('<?php echo htmlspecialchars($image['path']); ?>')" 
            style="max-width: 200px; height: auto;">
        <p style="color: #555; margin-top: 8px;">
            <strong>
                <?php 
                    // Configurar la localización a español de Ecuador
                    setlocale(LC_TIME, 'es_EC.UTF-8', 'es_EC', 'es_ES.UTF-8', 'spanish');
                    echo "Piscina: " . htmlspecialchars($image['id_piscina']) . " - " . strftime("%d-%b-%Y", strtotime($image['date'])); 
                ?>
            </strong>
        </p>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php } else { ?>
    <p style="color:red; margin-left: 15px; margin-left: 55px; margin-top: 15px;">no existen imagenes</p>
<?php }?>

<!-- Modal para mostrar imagen grande -->
<div id="modal">
    <span id="close" onclick="closeModal()">&times;</span>
    <img id="modal-img" src="" alt="Imagen ampliada">
</div>

<script>
const modal = document.getElementById('modal');
const modalImg = document.getElementById('modal-img');
const closeBtn = document.getElementById('close');

function showModal(imageSrc) {
    modal.style.display = "flex";
    modalImg.src = imageSrc;
}

function closeModal() {
    modal.style.display = "none";
    modalImg.src = "";
}

// Cierra el modal al hacer clic fuera de la imagen
modal.addEventListener('click', (e) => {
    if (e.target === modal || e.target === closeBtn) {
        closeModal();
    }
});
</script>

<style>
#gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    padding: 20px;
}

#gallery img {
    width: 150px;
    height: 150px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid #ddd;
    border-radius: 5px;
    transition: transform 0.2s;
}

#gallery img:hover {
    transform: scale(1.1);
}

#modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    justify-content: center;
    align-items: center;
    z-index: 9999; /* Asegura que el modal se muestre por encima de otros elementos */
    padding: 20px;
}

#modal img {
    max-width: 90%;
    max-height: 90%;
    margin: auto; /* Asegura que la imagen se alinee correctamente */
}

#close {
    color: white;
    font-size: 30px;
    position: absolute;
    top: 10px;
    right: 30px;
    cursor: pointer;
    z-index: 10000; /* Asegura que el botón de cierre esté por encima de la imagen */
}
</style>

