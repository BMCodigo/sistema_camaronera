<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

    $dias = $_POST['dias'];
    echo $sobrevivencia = $_POST['sobrevivencia'];
    $ab_c = $_POST['ab_c'];
    $mortalidad = $_POST['mortalidad'];
    $cre_fase_uno  = $_POST['cre_fase_uno'];
    $cre_fase_dos  = $_POST['cre_fase_dos'];
    $cre_fase_tres  = $_POST['cre_fase_tres'];
    $sugerido = $_POST['sugerido'];
    $subir = $_POST['subir'];

    $id = $_POST['id'];

    $sqli = "SELECT * FROM calculo_datos WHERE identificacion = '$id'";
    $data = $conectar->mostrar($sqli);  

    foreach ($data as $key) {
        $new_sugerid = $key['sugerido'];
    }

    $new_sugerid = $sugerido;

    $sql = "UPDATE `calculo_datos` SET `numero_dias`= '$dias',  sobrevivencia = '$sobrevivencia', ab_c = '$ab_c',
                                             mortalidad = '$mortalidad', cre_fase_uno = '$cre_fase_uno', cre_fase_dos = '$cre_fase_dos',
                                             cre_fase_tres = '$cre_fase_tres',  subir = '$subir' WHERE identificacion = '$id'";
    $query = mysqli_query( $conexion, $sql );                                            

        echo '<script language="javascript">window.history.go(-1);</script>';
       
?>