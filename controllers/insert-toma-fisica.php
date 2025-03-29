<?php
error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();
$nombre_alimento = $_POST['nombre_alimento'];
$cantidad_alimento = $_POST['cantidad_alimento'];
$camaronera = $_POST['camaronera'];
$fechaActual = date('Y-m-d');


 
 foreach ($nombre_alimento as $fech) {
     
    $alimento = $fech;

}

for ($i = 0; $i < count($nombre_alimento); ++$i) {
    

$sql = "INSERT INTO RegistroTomaFisica (producto, cantidad, fecha, responsable) VALUES
('$nombre_alimento[$i]', '$cantidad_alimento[$i]', '$fechaActual', '$camaronera');";
$result = mysqli_query($conexion, $sql);
    


  }



$ban = 0;


for ($i = 0; $i < count($nombre_alimento); ++$i) {

  $sql= 
    "SELECT ( 
        IF(
            ISNULL((
                SELECT SUM(cantidad_balanceado) AS cantidad_balanceado 
                FROM ingreso_balanceado 
                WHERE tipo_balanceado 
                LIKE '$nombre_alimento[$i]' 
                AND camaronera = '$camaronera' 
                AND fecha_ingreso BETWEEN '2020-01-01' AND '$fechaActual'))
            ,0,(
                SELECT SUM(cantidad_balanceado) AS cantidad_balanceado 
                FROM ingreso_balanceado 
                WHERE tipo_balanceado LIKE '$nombre_alimento[$i]' 
                AND camaronera = '$camaronera' 
                AND fecha_ingreso BETWEEN '2020-01-01' AND '$fechaActual'))
            ) - ( 
        IF(
            ISNULL((
                SELECT SUM(cantidad_balanceado) / 25 AS cantidad_balanceado 
                FROM egreso_balanceado 
                WHERE tipo_balanceado LIKE '$nombre_alimento[$i]' 
                AND camaronera = '$camaronera' 
                AND fecha_entrega BETWEEN '2020-01-01' AND '$fechaActual'))
            ,0,(
                SELECT SUM(cantidad_balanceado) / 25 AS cantidad_balanceado 
                FROM egreso_balanceado 
                WHERE tipo_balanceado LIKE '$nombre_alimento[$i]' 
                AND camaronera = '$camaronera' 
                AND fecha_entrega BETWEEN '2020-01-01' AND '$fechaActual')) 
    ) AS cantidad" ;

    $data = $conexion->query($sql);
    
    foreach($data as $value){

        $cantidad_disponible = intval($value["cantidad"]);
        $toma_fisica = intval($cantidad_alimento[$i]);



        if($nombre_alimento[$i] == 'Origin 0.5'){

            $cantidad_disponible = intval($value["cantidad"]*10/10);
            $toma_fisica = intval($cantidad_alimento[$i]);

        }else if($nombre_alimento[$i] == 'Origin 0.3'){

            $cantidad_disponible = intval($value["cantidad"]*10/10);
            $toma_fisica = intval($cantidad_alimento[$i]);

        }else{
            $cantidad_disponible = intval($value["cantidad"]);
            $toma_fisica = intval($cantidad_alimento[$i]);
        }

        if($cantidad_disponible != $toma_fisica){

            $ban += 1;

        }

    }
}

    if($ban > 0 ){
        
        ?>
            <script>
                alert(' ¡ Se ha guardado correctamente. !');
                window.location.href = "../views/index.php?page=Toma-fisica";
            </script>
        <?php

    }else{
        ?>
            <script>
               alert(' ¡ Se ha guardado correctamente. !');
                window.location.href = "../views/index.php?page=Aprobacion-solicitud";
            </script>
        <?php           
    }