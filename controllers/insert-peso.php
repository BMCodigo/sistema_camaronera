<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$camaronera = $_POST['camaronera'];
#datos obtenidos de los input
$piscina = $_POST['piscina'];
$corrida = $_POST['corrida'];
$peso = $_POST['peso'];
$encargado = $_POST['user'];

$bandera = 0;

for ($i = 0; $i < count($peso); $i++) {

    if ($peso[$i] <= 0 ) {
        $bandera += 1;
    }
}


if ($bandera == 0) {

    $sql = "SELECT * FROM registro_peso WHERE fecha_peso LIKE '$fechaActual' AND id_camaronera = '$camaronera'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {

        ?>
            <script>
                alert(' ¡ El peso ya fue registrado !');
                window.location.href="../views/index.php?page=Control-peso";
            </script>

        <?php

    } else {
        #recorremos la tabla mediante el array obtenido
        for ($i = 0; $i < count($piscina); ++$i) {

            if( $piscina[$i] == '17B'){
                $piscina[$i] = 22;
            }

            #insertamos datos 
            $sql = "INSERT INTO `registro_peso`(`fecha_peso`, `id_camaronera`, `id_piscina`, `id_corrida`, `peso`, `id_usuario`) 
                    VALUES('$fechaActual', '$camaronera', '$piscina[$i]', '$corrida[$i]', '$peso[$i]', '$encargado')";

            $result = $conexion->query($sql);
        }

        ?>
            <script>
                alert(' ¡ Peso registrado !');
                window.location.href="../views/index.php?page=Control-peso";
            </script>

        <?php
    }

}else{
    
    ?>
        <script>
            alert(' ¡ No puede ingresar valor menor a cero en el peso !');
            window.history.go(-1);
        </script>
    <?php
}
?>