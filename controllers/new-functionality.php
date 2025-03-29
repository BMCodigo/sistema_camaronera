<?php
error_reporting(0);
include '../models/conexion.php';
$conectar = new Conexion();
$conexion = $conectar->conectar();
$camaronera =($_POST["camaronera"]);
$fechaActual =($_POST["fechaActual"]);
$encargado =($_POST["encargado"]);
$insumo =($_POST["insumo"]);
$piscinas =($_POST["piscina"]);
$corridas =($_POST["corrida"]);
$cantidades =($_POST["cantidad"]);
// COSTO , FAMILIA DE PRODUCTOS


 $get="SELECT id_insumos,	producto, marca, proveedor,	medida,	descripcion, costo_actual,	estado FROM insumos_camaronera ;";
 
FOR ($n=1;$n<=count($piscinas);$n++){
    if (isset($piscinas[$n])){
    
    $sqls[$n]= "
     INSERT INTO costos_camaronera (`fecha_consumo`, `id_camaronera`, `id_piscina`, `id_corrida`, `familia`, `producto`, `cantidad`, `costo`, `responsable`)
                VALUES ('$fechaActual', '$camaronera', '$piscinas[$n]', '$corridas[$n]','NO DEFINIDA', '$insumo', '$cantidades[$n]','0.01', '$encargado');
    ";    echo ($sqls[$n]);
    
        
    }}
    
   FOR ($n=1;$n<25;$n++){ 
           if (isset($piscinas[$n])){
       
      try {
       $query[$n] = mysqli_query($conexion, $sqls[$n]);
      
}  catch (Exception $e) {
    
    
}
       
   } }

 $tmp="

 costos_camaronera
 SELECT fecha_consumo, id_camaronera, id_piscina, id_corrida, producto, cantidad, costo, responsable FROM costos_camaronera; //  +ccosto  +id_insumos


 
 insumos_camaronera
 SELECT id_insumos,	familia, producto, marca, proveedor,	medida,	descripcion, costo_actual,	estado FROM insumos_camaronera ;// + ccosto_actual +piva +viva
 
 insumos_costos
 SELECT id_insumo_costo, id_insumos,fecha_inicio, precio,fecha_fin, proveedor, marca, descripcion, centro_costos FROM insumos_costos;	+piva +viva


A [C# JAVA PHP COBOL] [HTML CSS JAVASCRIPT JQUERY BOOTSTRAP] [MYSQL SQLSERVER][R PYTHON POWERBI SQL TENSORFLOW] [WPF]

B [JAVA PHP] [HTML CSS JAVASCRIPT JQUERY BOOTSTRAP]  [MYSQL SQLSERVER]

C [C# JAVA PHP COBOL] [HTML CSS JAVASCRIPT JQUERY BOOTSTRAP] [ANGULAR] [POSTGRESQL ORACLE] [R PYTHON POWERBI SQL TENSORFLOW] 

D [JAVA PHP] [HTML CSS JAVASCRIPT JQUERY BOOTSTRAP] [POSTGRESQL ORACLE] [JAVAFX]
 ";

?>
