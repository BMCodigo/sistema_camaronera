<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';


$conectar = new Conexion();
$conexion = $conectar->conectar();

if(isset($_POST['valor'])){

        $talla=$_POST['talla'];
        $nvo_valor=$_POST['nvo_valor'];
        $camaronera=$_POST['camaronera'];


        for ($i = 0; $i < count($talla); ++$i) {

                $sqlinsert="INSERT INTO `precio_talla_camaron`(`talla`, `precio_referencia`, `fecha_registro`, `camaronera`) 
                VALUES ('$talla[$i]', '$nvo_valor[$i]', (NOW()), '$camaronera')";
                $query = mysqli_query($conexion, $sqlinsert);
                echo '<script>window.history.go(-1);</script>';
        }


}else{
        echo 'Error en al conexion con el servidor';
}
