<?php 
error_reporting(0);
include '../models/conexion.php';
include '../models/pesca.php';
include '../views/footer.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();
$objeto = new pesca();

//PREPROCESAR AL PESCAR


//INSERT COSTO ACTUAL

// UPDATE CORRIDA ACTUAL ANTERIOR HISTORICA

// SELECT ACTUAL id_camaronera,id_piscina, id corrida, familia,fecha_consumo,dias proceso




// inc SEMANA by fecha - tipo_ciclo
$getdata1 ="select id_camaronera,id_piscina from costos_camaronera where id_camaronera = 1 and id_corrida = 38 and id_piscina =1 and familia = 1 ;";
$data = $objeto->mostrar($getdata1);


for ($x=1; $x>=count($data); $x++) {}
$camaroneras[$x]= $data['id_camaronera'];
$piscinas[$x] = $data['id_piscina'];

$getdata2 ="";
$ciclo = $objeto->mostrar($getdata2);
$corridas[$x] = $ciclo['id_corrida'];
 

// piscina corrida familia


/*

$data = array(
    "Semana 1" => 100,
    "Semana 2" => 150,
    "Semana 3" => 120,
    "Semana 4" => 180
);

$data = array(
    "product1" => array(
        "Semana 1" => 100,
        "Semana 2" => 150,
        "Semana 3" => 120,
        "Semana 4" => 180
    ),
    "product2" => array(
        "Semana 1" => 120,
        "Semana 2" => 160,
        "Semana 3" => 130
    ),
    "product3" => array(
        "Semana 1" => 120,
        "Semana 2" => 160,
        "Semana 3" => 130,
         "Semana 4" => 180,
          "Semana 5" => 180
    ),

);*/

header('Content-Type: application/json');
echo json_encode($data);
?>
