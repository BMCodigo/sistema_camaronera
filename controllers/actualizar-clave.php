<?php

include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$sql_user = "SELECT correo FROM usuarios WHERE correo = '$usuario'";
$query = mysqli_query($conexion, $sql_user);


foreach ($query as $value) {

    $user = $value['correo'];
}

if ($usuario == $user) {
    $update = "UPDATE usuarios SET clave = '$clave' WHERE correo ='$usuario'";
    if (mysqli_query($conexion, $update)) {
?>
        <script>
            alert(" ¡ Contraseña actualizada ! ", );
            window.location.href="https://aquapro.gvasco.com/";
        </script>
    <?php
    } else {
    ?>
        <script>
            alert(" ¡ Error en la actualizacion ! ", );
            window.history.go(-1);
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert(" ¡ Usuario invalido ! ", );
        window.history.go(-1);
    </script>
<?php
}





?>