<?php

error_reporting(0);
include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();


if(isset($_GET['delete'])){
    
    $id=$_GET['delete'];

    $sqleliminar = "DELETE FROM parametro_camaronera_psc WHERE id_parametro  = $id";

    if ($conexion->query($sqleliminar) === TRUE) { ?>
    
        <script>
            window.location.href="../views/index.php?page=Parametros";
        </script>

<?php } }?>