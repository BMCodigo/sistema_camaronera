<?php

$serverName = "208.67.222.222"; //serverName\instanceName
$serverName = "200.124.243.107"; //serverName\instanceName
$serverName = "201.183.228.143, 11431 \SQLEXPRESS"; //
$serverName = "SRV-CONTABLE\SQLEXPRESS"; 
$serverName = "192.168.10.4"; 
$serverName = "208.67.222.222"; 
$serverName = "200.124.243.107\SQLEXPRESS";
$connectionOptions = array( "Database"=>"ECUACAMARON", "UID"=>"bgvalarezo", "PWD"=>"bg1721437125VS$$$");
$connectionOptions = array( "Database"=>"ECUACAMARON", "UID"=>"sa", "PWD"=>"Solmak*2");                                           
                                                        


/*
$ip = "200.124.243.107";
exec("ping -c 4 $ip", $output, $return);

echo "Resultados del ping a $ip:\n";
foreach ($output as $line) {
    echo $line . "\n";
}*/

   
  
// Intentamos conectarnos al servidor SQL Server a través de la VPN
$serverName = "208.67.222.222:1431";
$connectionOptions = array(
    "Database" => "ECUACAMARON",
    "Uid" => "sa",
    "PWD" => "Solmak*2"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);
echo $conn;
// Verificamos si la conexión fue exitosa
if ($conn === false) {
    echo "Error de conexión: " . print_r(sqlsrv_errors(), true);
} else {
    echo "Conexión VPN exitosa. ";
    
    // Ejemplo de consulta a la base de datos
    $sql = "SELECT TOP 1 * FROM tu_tabla";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        echo "Error en la consulta: " . print_r(sqlsrv_errors(), true);
    } else {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        echo "Consulta exitosa. Primer registro: " . json_encode($row);
    }

    // Cerramos la conexión
    sqlsrv_close($conn);
}
?>
