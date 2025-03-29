<?php 
error_reporting(0);
include '../models/conexion.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();
 $fechaActual = date('Y-m-d');
$desde = date('Y-m-d', strtotime('next Monday -1 week', strtotime('this sunday')));
$hasta = date('Y-m-d', strtotime($desde . ' + 6 days', strtotime('this sunday')));
$piscinas = $_POST['piscinas'];
$piscinasCount = count($piscinas);
for ($i = 0; $i < count($_POST['piscinas']); $i++) {
    $fecha = $_POST['fecha'][$i];
    $alimento = $_POST['alimento'][$i];
    $porcentaje = $_POST['porcentaje'][$i];
    $ps = $_POST['piscinas'][$i];
    $ha = $_POST['has'][$i];
    $dias = $_POST['dias'][$i];
    $densidad = $_POST['densidades'][$i];
    $peso_inicial = $_POST['peso'][$i];
    $crecimiento = $_POST['crecimientos'][$i];
    $peso_proyectado = $_POST['pesofinales'][$i];
    $bw = $_POST['factores'][$i];
    $lun = $_POST['alimento1'][$i];
    $mar = $_POST['alimento2'][$i];
    $mie = $_POST['alimento3'][$i];
    $jue = $_POST['alimento4'][$i];
    $vie = $_POST['alimento5'][$i];
    $sab = $_POST['alimento6'][$i];
    $dom = $_POST['alimento7'][$i];
    $total = $_POST['alimento0'][$i];
    $total_real = $_POST['total_real'][$i];
    $porcentaje_real = $_POST['porcentaje_real'][$i];
    $camaronera = $_POST['camaroneras'][$i];
    $ciclo = $_POST['corridas'][$i];
    $intermedio = $_POST['intermedio'][$i];
    $proyectado = $lun+$mar+$mie+$jue+$vie+$sab+$dom;
    $superviv = $_POST['supervive'][$i];
     $fcv = $_POST['fcv'][$i];
    $getdias = $_POST['getdias'][$i];
    if($ps == '17B'){ $ps ='22';}

      
      $updater = "
UPDATE proyeccion_alimento_test SET 
    porcentaje = '$porcentaje',
    bw = '$bw',
    supervivencia = '$superviv',
    ha = '$ha',
    ps = '$ps',
    dias = '$dias',
    densidad = '$densidad',
    peso_inicial = '$peso_inicial',
    crecimiento = '$crecimiento',
    peso_proyectado = '$peso_proyectado',
    total = '$total',
    ciclo = '$ciclo',
    intermedio = '$intermedio',
    alimento_proyectado = '$total',
    fcv_proyectado = '$fcv',
    estado = '1'
WHERE
    camaronera = '$camaronera' 
    AND ps = '$ps'
    AND fecha >= '$desde'
    AND estado = '2';
";//echo $updater;

mysqli_query($conexion, $updater);

      
    $sql = "INSERT INTO proyeccion_alimento_test 
        (fecha, alimento, porcentaje, ps, ha, dias, densidad, peso_inicial, crecimiento, peso_proyectado, bw, 
         total, total_real, porcentaje_real, camaronera, ciclo, intermedio,alimento_proyectado,supervivencia) 
        VALUES 
        ((NOW()), '$alimento', '$porcentaje', '$ps', '$ha', '$dias', '$densidad', '$peso_inicial', '$crecimiento', 
        '$peso_proyectado', '$bw', '$total', '$total_real', 
        '$porcentaje_real', '$camaronera', '$ciclo','$intermedio','$total','$superviv');";
  //     $query = mysqli_query($conexion, $sql);
       
     


}



/* 

CAMARONERA
 
ARRAY DIAS?

BW ESPECIFICO

INSERT INTO proyeccion_alimento_test (fecha, alimento, porcentaje, ps, ha, dias, densidad, peso_inicial, crecimiento, peso_proyectado, bw,
                                  lun, mar, mie, jue, vie, sab, dom, total, total_real, porcentaje_real, camaronera, ciclo) 
VALUES 
('2024-06-03', 'Alimento A', 0.5, 10.5, 8.2, 30, 1.2, 200, 5, 220, 1, 20.1, 21.5, 22.3, 20.8, 21.2, 22.6, 21.4, 1500, 1450, 96.7, 1, 1),
('2024-06-04', 'Alimento B', 0.6, 12.5, 9.8, 31, 1.3, 210, 5.5, 230, 1, 21.1, 22.8, 23.5, 21.6, 22.8, 24.1, 22.5, 1550, 1480, 95.5, 2, 1),
('2024-06-05', 'Alimento C', 0.7, 14.5, 10.2, 32, 1.4, 220, 6, 240, 1, 22.1, 23.5, 24.1, 22.9, 23.5, 24.9, 23.2, 1600, 1520, 94.5, 1, 2);


array(16) { 

/---------------------- PS
["piscinas"]=> array(19) { [0]=> string(1) "1" [1]=> string(1) "2" [2]=> string(1) "3" [3]=> string(1) "4" [4]=> string(1) "5" [5]=> string(1) "6" [6]=> string(1) "7" [7]=> string(1) "8"
[8]=> string(2) "10" [9]=> string(2) "11" [10]=> string(2) "12" [11]=> string(2) "13" [12]=> string(2) "14" [13]=> string(2) "15" [14]=> string(2) "18" [15]=> string(2) "19"
[16]=> string(2) "20" [17]=> string(2) "21" [18]=> string(3) "17B" } 

/---------------------- HA
["corridas"]=> array(19) { [0]=> string(2) "20" [1]=> string(2) "19" [2]=> string(2) "19" [3]=> string(2) "21" [4]=> string(2) "20" [5]=> string(2) "19" [6]=> string(2) "19" [7]=> string(2) "19"
[8]=> string(2) "20" [9]=> string(2) "20" [10]=> string(2) "20" [11]=> string(2) "20" [12]=> string(2) "19" [13]=> string(2) "16" [14]=> string(2) "18" [15]=> string(2) "12" [16]=> string(2) "19"
[17]=> string(2) "20" [18]=> string(1) "8" }

/---------------------- DIAS
["has"]=> array(19) { [0]=> string(4) "3.40" [1]=> string(4) "7.50" [2]=> string(4) "7.70" [3]=> string(4) "7.80" [4]=> string(4) "9.50" [5]=> string(4) "6.50" [6]=> string(4) "5.06"
[7]=> string(4) "6.00" [8]=> string(4) "7.50" [9]=> string(4) "5.40" [10]=> string(4) "4.40" [11]=> string(4) "4.70" [12]=> string(4) "4.40" [13]=> string(5) "10.00" [14]=> string(4) "6.60"
[15]=> string(4) "3.00" [16]=> string(4) "6.60" [17]=> string(4) "6.50" [18]=> string(4) "5.00" }

/---------------------- DENSIDAD
["densidades"]=> array(19) { [0]=> string(6) "240000" [1]=> string(6) "255000" [2]=> string(6) "140000" [3]=> string(6) "250000" [4]=> string(6) "210000" [5]=> string(6) "120000" 
[6]=> string(6) "125000" [7]=> string(6) "175000" [8]=> string(6) "260000" [9]=> string(6) "230000" [10]=> string(6) "240000" [11]=> string(6) "250000" [12]=> string(6) "200000" 
[13]=> string(6) "110000" [14]=> string(6) "120000" [15]=> string(6) "125000" [16]=> string(6) "135000" [17]=> string(6) "220000" [18]=> string(6) "180000" }

/---------------------- PESO INICIAL
["peso"]=> array(19) { [0]=> string(4) "0.85" [1]=> string(4) "0.80" [2]=> string(5) "19.10" [3]=> string(4) "2.00" [4]=> string(5) "12.60" [5]=> string(5) "16.00" [6]=> string(5) "26.00"
[7]=> string(5) "12.55" [8]=> string(4) "2.10" [9]=> string(5) "14.55" [10]=> string(4) "1.10" [11]=> string(4) "1.00" [12]=> string(5) "15.00" [13]=> string(5) "26.16" [14]=> string(5) "22.00"
[15]=> string(5) "27.02" [16]=> string(5) "29.20" [17]=> string(5) "13.62" [18]=> string(5) "14.01" }

/---------------------- CRECIMIENTO
["crecimientos"]=> array(19) { [0]=> string(1) "1" [1]=> string(1) "2" [2]=> string(0) "" [3]=> string(0) "" [4]=> string(0) "" [5]=> string(0) "" [6]=> string(0) "" [7]=> string(0) ""
[8]=> string(0) "" [9]=> string(0) "" [10]=> string(0) "" [11]=> string(0) "" [12]=> string(0) "" [13]=> string(0) "" [14]=> string(0) "" [15]=> string(0) "" [16]=> string(0) "" 
[17]=> string(0) "" [18]=> string(0) "" }

/---------------------- PESO PROYECTADO
["pesofinales"]=> array(19) { [0]=> string(4) "1.85" [1]=> string(3) "2.8" [2]=> string(0) "" [3]=> string(0) "" [4]=> string(0) "" [5]=> string(0) "" [6]=> string(0) "" [7]=> string(0) "" 
[8]=> string(0) "" [9]=> string(0) "" [10]=> string(0) "" [11]=> string(0) "" [12]=> string(0) "" [13]=> string(0) "" [14]=> string(0) "" [15]=> string(0) "" [16]=> string(0) ""
[17]=> string(0) "" [18]=> string(0) "" }


/---------------------- BODY WEIGHT

["factores"]=> array(19) { [0]=> string(0) "" [1]=> string(0) "" [2]=> string(0) "" [3]=> string(0) "" [4]=> string(0) "" [5]=> string(0) "" [6]=> string(0) "" [7]=> string(0) ""
[8]=> string(0) "" [9]=> string(0) "" [10]=> string(0) "" [11]=> string(0) "" [12]=> string(0) "" [13]=> string(0) "" [14]=> string(0) "" [15]=> string(0) "" [16]=> string(0) "" 
[17]=> string(0) "" [18]=> string(0) "" } 

/---------------------- ALIMENTOS

["alimento1"]=> array(19) { [0]=> string(4) "7429" [1]=> string(5) "19041" [2]=> string(5) "64446" [3]=> string(5) "29757" [4]=> string(5) "94012" [5]=> string(5) "42058" [6]=> string(5) "44895" 
[7]=> string(5) "49416" [8]=> string(5) "30917" [9]=> string(5) "63610" [10]=> string(5) "10129" [11]=> string(5) "10422" [12]=> string(5) "45804" [13]=> string(5) "78271" [14]=> string(5) "51052"
[15]=> string(5) "27155" [16]=> string(5) "67385" [17]=> string(5) "70505" [18]=> string(5) "45014" }

["alimento2"]=> array(19) { [0]=> string(4) "8498" [1]=> string(5) "24052" [2]=> string(5) "64446" [3]=> string(5) "29757" [4]=> string(5) "94012" [5]=> string(5) "42058" [6]=> string(5) "44895"
[7]=> string(5) "49416" [8]=> string(5) "30917" [9]=> string(5) "63610" [10]=> string(5) "10129" [11]=> string(5) "10422" [12]=> string(5) "45804" [13]=> string(5) "78271" [14]=> string(5) "51052"
[15]=> string(5) "27155" [16]=> string(5) "67385" [17]=> string(5) "70505" [18]=> string(5) "45014" }

["alimento3"]=> array(19) { [0]=> string(4) "9567" [1]=> string(5) "29062" [2]=> string(5) "64446" [3]=> string(5) "29757" [4]=> string(5) "94012" [5]=> string(5) "42058" [6]=> string(5) "44895"
[7]=> string(5) "49416" [8]=> string(5) "30917" [9]=> string(5) "63610" [10]=> string(5) "10129" [11]=> string(5) "10422" [12]=> string(5) "45804" [13]=> string(5) "78271" [14]=> string(5) "51052"
[15]=> string(5) "27155" [16]=> string(5) "67385" [17]=> string(5) "70505" [18]=> string(5) "45014" }

["alimento4"]=> array(19) { [0]=> string(5) "10636" [1]=> string(5) "34073" [2]=> string(5) "64446" [3]=> string(5) "29757" [4]=> string(5) "94012" [5]=> string(5) "42058" [6]=> string(5) "44895"
[7]=> string(5) "49416" [8]=> string(5) "30917" [9]=> string(5) "63610" [10]=> string(5) "10129" [11]=> string(5) "10422" [12]=> string(5) "45804" [13]=> string(5) "78271" [14]=> string(5) "51052"
[15]=> string(5) "27155" [16]=> string(5) "67385" [17]=> string(5) "70505" [18]=> string(5) "45014" } 

["alimento5"]=> array(19) { [0]=> string(5) "11705" [1]=> string(5) "39084" [2]=> string(5) "64446" [3]=> string(5) "29757" [4]=> string(5) "94012" [5]=> string(5) "42058" [6]=> string(5) "44895"
[7]=> string(5) "49416" [8]=> string(5) "30917" [9]=> string(5) "63610" [10]=> string(5) "10129" [11]=> string(5) "10422" [12]=> string(5) "45804" [13]=> string(5) "78271" [14]=> string(5) "51052"
[15]=> string(5) "27155" [16]=> string(5) "67385" [17]=> string(5) "70505" [18]=> string(5) "45014" } 

["alimento6"]=> array(19) { [0]=> string(5) "12774" [1]=> string(5) "44095" [2]=> string(5) "64446" [3]=> string(5) "29757" [4]=> string(5) "94012" [5]=> string(5) "42058" [6]=> string(5) "44895"
[7]=> string(5) "49416" [8]=> string(5) "30917" [9]=> string(5) "63610" [10]=> string(5) "10129" [11]=> string(5) "10422" [12]=> string(5) "45804" [13]=> string(5) "78271" [14]=> string(5) "51052"
[15]=> string(5) "27155" [16]=> string(5) "67385" [17]=> string(5) "70505" [18]=> string(5) "45014" } 

["alimento7"]=> array(19) { [0]=> string(5) "13843" [1]=> string(5) "49105" [2]=> string(5) "64446" [3]=> string(5) "29757" [4]=> string(5) "94012" [5]=> string(5) "42058" [6]=> string(5) "44895"
[7]=> string(5) "49416" [8]=> string(5) "30917" [9]=> string(5) "63610" [10]=> string(5) "10129" [11]=> string(5) "10422" [12]=> string(5) "45804" [13]=> string(5) "78271" [14]=> string(5) "51052"
[15]=> string(5) "27155" [16]=> string(5) "67385" [17]=> string(5) "70505" [18]=> string(5) "45014" } 

["alimento0"]=> array(19) { [0]=> string(5) "74453" [1]=> string(6) "238512" [2]=> string(6) "451123" [3]=> string(6) "208299" [4]=> string(6) "658087" [5]=> string(6) "294403" 
[6]=> string(6) "314264" [7]=> string(6) "345909" [8]=> string(6) "216421" [9]=> string(6) "445272" [10]=> string(5) "70904" [11]=> string(5) "72956" [12]=> string(6) "320628" 
[13]=> string(6) "547895" [14]=> string(6) "357366" [15]=> string(6) "190086" [16]=> string(6) "471692" [17]=> string(6) "493537" [18]=> string(6) "315099" } }

*/
?>

<script>
   alert(" ¡ Se ha guardado la proyeccion ! ", );
  window.location.href="../views/index.php?page=Alimentos";
</script>