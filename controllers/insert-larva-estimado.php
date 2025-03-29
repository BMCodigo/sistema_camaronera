<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$camaronera = $_POST['camaronera'];
#datos obtenidos de los input
$precria = $_POST['precria'];
$estimado = $_POST['estimado'];
$secuancial = $_POST['secuencial'];
$encargado = $_POST['encargado'];

$bandera = 0;

for ($i = 0; $i < count($estimado); $i++) {

    if ($estimado[$i] <= 0 ) {
        $bandera += 1;
    }
}


if ($bandera == 0) {

    $sql = "SELECT * FROM registro_estimado_larva WHERE fecha_registro_estimado LIKE '$fechaActual' AND id_camaronera = '$camaronera'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {

        ?>
            <script>
                alert(' ¡ La estimacion ya fue registrada !');
                window.location.href="../views/index.php?page=Control-peso";
            </script>

        <?php

    } else {
        #recorremos la tabla mediante el array obtenido
        for ($i = 0; $i < count($precria); ++$i) {

            #insertamos datos 
            $sql = "INSERT INTO `registro_estimado_larva`( `fecha_registro_estimado`, `id_camaronera`, `id_precria`, `secuencial`, `cantidad_estimada`, `encargado`)
                    VALUES ('$fechaActual', '$camaronera', '$precria[$i]', '$secuancial[$i]', '$estimado[$i]', '$encargado')";

            $result = $conexion->query($sql);
        }

        ?>
            <script>
                alert(' ¡ Estimacion registrada !');
                window.location.href="../views/index.php?page=Control-peso";
            </script>

        <?php
    }

}else{
    
    ?>
        <script>
            alert(' ¡ No puede ingresar valor menor a cero en la estimacion !');
            window.history.go(-1);
        </script>
    <?php
}
?>