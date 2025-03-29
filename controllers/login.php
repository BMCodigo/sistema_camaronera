<?php

include '../models/conexion.php';
include '../models/session.php';

$ingresar = new Session();

if (isset($_POST['logear'])) {

    $user = $_POST['user_mail'];

    $sqli = "SELECT camaronera_id, roles FROM usuarios WHERE correo = '$user '";
    $data = $ingresar->mostrar($sqli);  

    foreach ($data as $key) {
        $camaronera = $key['camaronera_id'];
        $roles = $key['roles'];
    }

    $password = $_POST['password'];

    $datos = array( $user, $password, $camaronera, $roles );
    $ingresar->login($datos);

}

?>