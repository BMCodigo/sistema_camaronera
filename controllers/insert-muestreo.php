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
$densidad = $_POST['densidad'];
$talla = $_POST['talla'];
$encargado = $_POST['encargado'];

$bandera = 0;

for ($i = 0; $i < count($peso); $i++) {

    if ($peso[$i] <= 0 || $densidad[$i] <= 0) {
        $bandera += 1;
    }
}

if ($bandera == 0) {

    $sql = "SELECT * FROM registro_muestreo WHERE fecha_muestreo LIKE '$fechaActual' AND id_camaronera = '$camaronera'";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {

        ?>
            <script>
            alert(' ¡ El muestreo ya fue registrado!');
            window.location.href="../views/index.php?page=Control-peso";
            </script>
        <?php

    } else {

        #recorremos la tabla mediante el array obtenido
        for ($i = 0; $i < count($piscina); ++$i) {

            #selecionamos el ultimo agregado
            $sql = "SELECT MAX(peso) as total FROM `registro_muestreo` WHERE id_piscina = '$piscina[$i]' AND id_camaronera = '$camaronera' AND id_corrida = '$corrida[$i]'";
            $data = $conectar->mostrar($sql);

            foreach ($data as $key) {
                $peso2 = $key['total'];
            }

            #caluculamos el incremento
            if ($peso2 == 0) {
                $incremento = 0;
            } else {
                $incremento =  $peso[$i] - $peso2;
            }

            if( $piscina[$i] == '17B'){
                $piscina[$i] = 22;
            }else if( $piscina[$i] == '15B'){
                $piscina[$i] = 24;
            }else{
                $piscina[$i];
            }


            #insertamos datos 
            $sql = "INSERT INTO `registro_muestreo`(`fecha_muestreo`, `id_camaronera`, `id_piscina`, `id_corrida`, `peso`, `densidad`, `incremento`, `talla`, `id_usuario`)
                                VALUES('$fechaActual', '$camaronera', '$piscina[$i]', '$corrida[$i]', '$peso[$i]', '$densidad[$i]', '$incremento', '0', '$encargado')";

            $result = $conexion->query($sql);

            if($result){

                $sql_poblacion = "SELECT MAX(fecha_muestreo) as fecha_muestreo FROM `registro_muestreo` WHERE id_camaronera = '$camaronera'  AND id_piscina = '$piscina[$i]' AND id_corrida = '$corrida[$i]'";
                $data_poblacion = $conectar->mostrar($sql_poblacion);

                foreach ($data_poblacion as $key_poblacion) {
                    $fecha = $key_poblacion['fecha_muestreo']; //2023-01-22
                    $poblacion = date('Y-m-d', strtotime($fecha . ' - 6 days', strtotime('this sunday')));//2023-01-16

                    $sql_p = "SELECT cantidad  FROM `registro_poblacion` where fechaActual BETWEEN '$poblacion' AND '$fecha' AND id_camaronera = '$camaronera' and id_piscina = '$piscina[$i]' and id_corrida = '$corrida[$i]' LIMIT 1";
                    $data_p = $conectar->mostrar($sql_p);
     
                    foreach ($data_p as $key_p) {
                        $cant = $key_p['cantidad'];   
                    }

                    if($cant[$i] == 0 || $cant[$i] == NULL || $cant[$i] == ""){
                        
                    #obtenemos promedio de los 4 ultimos poblacionales
                    $sql_prom = "SELECT cantidad_biologo, hectareas FROM `registro_poblacion` where fechaActual BETWEEN DATE_ADD(NOW(),INTERVAL -30 DAY) and NOW() AND id_camaronera = '$camaronera' and id_piscina = '$piscina[$i]' and id_corrida = '$corrida[$i]' ORDER BY fechaActual ASC";
                    $data_prom = $conectar->mostrar($sql_prom);

                    #selecinamos la corrida y hectreas de la piscina solicitada 
                    $suma = 0;
                    $denominador = count($data_prom);
                    foreach ($data_prom as $key_prom) {
                        
                        $total = intval($key_prom['cantidad_biologo']);
                        $suma = $suma+$total;
                        $ha = $key_prom['hectareas'];
                    }
                        $cant_sin_poblacion = ($suma + $cantidad_animales) / $denominador;
                        $sql_ipoblacion = "INSERT INTO `registro_poblacion`(`fechaActual`, `id_camaronera`, `id_piscina`, `id_corrida`, `hectareas`, `cantidad`, `cantidad_biologo`, `id_usuario`) VALUES ('$fechaActual', '$camaronera', '$piscina[$i]', '$corrida[$i]', '$ha', '$cant_sin_poblacion', 0, '$encargado')";
                       // $result_poblacion = $conexion->query($sql_ipoblacion);
                    }
                }
            }
        }
        ?>

            <script>
            alert(" ¡ Muestreo registrado ! ", );
            window.location.href="../views/index.php?page=Control-peso";
            </script>

        <?php
    }

} else {

    ?>
        <script>
        alert(' ¡ Debe ingresar un valor en cada piscina para peso o densidad ! ');
        window.history.go(-1);
        </script>
        
    <?php

}