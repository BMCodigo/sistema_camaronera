<?php
$serverName = "200.124.243.107\\sqlexpress"; 
$connectionOptions = array( "Database"=>"ECUACAMARON", "UID"=>"bgvalarezo", "PWD"=>"bg1721437125VS$$$"); 

try {
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    
 //   if ($conn === false) {
 //       die(print_r(sqlsrv_errors(), true));
  //  }
   // $tsql = "{CALL SIS_ALIMENTACION_COSTOS_PISCINAS_DARSACOM}";

   // $stmt = sqlsrv_query($conn, $tsql);
   // if ($stmt === false) {
   //     die(print_r(sqlsrv_errors(), true));
   // }
   echo " successfully";
  //  sqlsrv_free_stmt($stmt);
  //  sqlsrv_close($conn);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>