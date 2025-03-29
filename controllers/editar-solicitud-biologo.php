<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$piscina = $_POST['piscina'];
$corrida = $_POST['corrida'];
$faltante = $_POST['faltante'];
$cantidad = $_POST['cantidad'];
$tipo_alimento = $_POST['tipo_alimento'];

$encargado = $_POST['encargado'];
$camaronera = $_POST['camaronera'];
$secuencia = $_POST['secuencia'];
$id = $_POST['id'];

$ban = 0;


$tipo_alimento_comp = array();

for ($i = 0; $i < count($tipo_alimento); ++$i){
    if (isset($agtipo_alimento_compe[$tipo_alimento[$i]])){
        $agtipo_alimento_compe[$tipo_alimento[$i]] = $agtipo_alimento_compe[$tipo_alimento[$i]] + $cantidad[$i];
    }else{
        $tipo_alimento_comp += array($tipo_alimento[$i] => $cantidad[$i]);
    }
    
}

for ($i = 0; $i < count($tipo_alimento); ++$i){

    #validamos que la cantidad no sea mayor y que exista en el ingreso de balanceado
    $consulta = "SELECT IF(ti.cant-te.tot_egre > 0,ti.cant-te.tot_egre,-1) * 25 AS disponible FROM ((SELECT *, SUM(t1.cantidad_balanceado) AS cant FROM `ingreso_balanceado` t1 WHERE t1.camaronera ='$camaronera' AND t1.tipo_balanceado = '$tipo_alimento[$i]' GROUP BY t1.tipo_balanceado) UNION (SELECT 0,0,0,0,0,0,0,0 AS cant) LIMIT 1) ti, ((SELECT SUM(t3.cantidad_balanceado) / 25 AS tot_egre FROM egreso_balanceado t3 WHERE t3.camaronera ='$camaronera' AND t3.tipo_balanceado = '$tipo_alimento[$i]' GROUP BY t3.tipo_balanceado) UNION (SELECT 0) LIMIT 1) te";

    $result = $conexion->query($consulta);

    if($result->num_rows == 0){
        ?>

            <script>
                alert(' ¡ No existe suficiente alimento ingresado de ' + "<?php echo $tipo_alimento[$i] ;?>" + ' para la piscina ' + "<?php echo $piscina[$i] ;?>" + ' !');
                window.history.go(-1);
                //window.location.href="../views/index.php?page=Egreso-ps";
            </script>
            <?php  
            $ban +=1;
    }

    while ($row = $result->fetch_assoc()) {
        if($row['disponible'] < 0 || $tipo_alimento_comp[$tipo_alimento[$i]] > $row['disponible'] || $ban > 0){
            ?>

            <script>
                alert(' ¡ No existe suficiente alimento ingresado de ' + "<?php echo $tipo_alimento[$i] ;?>" + '!');
                window.history.go(-1);
                //window.location.href="../views/index.php?page=Egreso-ps";
            </script>
            <?php  
            $ban +=1;
        }
    }
    if($ban > 0){
        break;
    }  
}

if ($ban == 0){
    #recorremos la tabla mediante el array obtenido
    for ($i = 0; $i < count($piscina); ++$i) {

        #insertamos los valores en la tabla egreso balanceado
        if($cantidad[$i] > 0 || $faltante[$i] > 0){

            $update = "UPDATE solicitud_balanceados SET sobrante = '$faltante[$i]', cantidad_balanceado = '$cantidad[$i]', tipo_balanceado = '$tipo_alimento[$i]', estado = 'En proceso' WHERE camaronera ='$camaronera' AND id_piscina = '$piscina[$i]' AND id_corrida = '$corrida[$i]' AND id_secuencia = '$secuencia'";
            $query = mysqli_query($conexion, $update);

        }   
    }
    ?>
        <script>
            alert(" ¡ Solicitud actualizada ! ", );
            window.location.href="../views/index.php?page=Solicitud-generadas-biologo";
            //window.history.go(-1);
        </script>

    <?php
}
