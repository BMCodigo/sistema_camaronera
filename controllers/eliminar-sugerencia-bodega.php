<?php

include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$id = $_GET['id'];

$delete = "DELETE FROM sugerencia_balanceado WHERE id='$id'";
$sentencia = mysqli_query($conexion, $delete);
?>
    <script>
        alert(" ¡ Sugerencia eliminada ! " );
        window.history.go(-1);
    </script>
<?php


?>