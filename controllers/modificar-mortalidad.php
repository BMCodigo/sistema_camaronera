<?php 
error_reporting(0);
include '../models/conexion.php';
include '../models/pesca.php';
include '../views/footer.php';
$objeto = new pesca();
$conectar = new Conexion();
$conexion = $conectar->conectar();
$fechaActual = $_POST['fecha_parametro'];
$camaronera = $_POST['camaronera'];
$mortalidad = $_POST['mortalidad'];
$dias = $_POST['dias'];
$sql = "UPDATE parametros_soreviviencia SET `dias` = '$dias', `mortalidad` = '$mortalidad' WHERE id_camaronera = '$camaronera';";
    mysqli_query($conexion, $sql);?><script>  alert(" Se han modificado los parametros!", );  window.location.href="../views/index.php?page=Parametros";</script>
         
                    
