<?php

error_reporting(0);
include '../models/conexion.php';
include '../models/corrida.php';
include '../views/footer.php';

    $objeto = new corrida();

    $conectar = new Conexion();
    $conexion = $conectar->conectar();

    $fechaActual = $_POST['fechaActualModal'];
    $camaronera = $_POST['camaronera'];
    $piscina = $_POST['piscina'];
    $tipo = $_POST['tipo'];
    $cantidad_animales_totales = $_POST['cantidad_animales'];
    $encargado = $_POST['encargado'];
    $lances = $_POST['lances'];
    $atarraya = $_POST['atarraya'];
    $bactimetria = $_POST['bactimetria'];
    $muertos_rojos = $_POST['muertos_rojos'];
    $muertos_frescos = $_POST['muertos_frescos'];
    $encargado_poblacion = $_POST['encargado_poblacion'];
    $enfermos = $_POST['enfermos'];
    $muda = $_POST['muda'];
    $talla = $_POST['talla'];


    $sql = "SELECT id_corrida, hectareas FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND estado LIKE 'En proceso'";
    $data = $objeto->mostrar($sql);

    #selecinamos la corrida y hectreas de la piscina solicitada
    foreach ($data as $key) {
        $corrida = $key['id_corrida'];
        $hectareas = $key['hectareas'];
    }

   
    //$sql_prom = "SELECT cantidad_biologo FROM registro_poblacion WHERE fechaActual BETWEEN DATE_SUB(NOW(), INTERVAL 15 DAY) AND NOW() AND id_camaronera = '$camaronera' and id_piscina = '$piscina' and id_corrida = '$corrida' ORDER BY fechaActual ASC";
    //$data_prom = $objeto->mostrar($sql_prom);

    if($camaronera == 1 OR $camaronera == 3 ){
    $sql_prom = "SELECT cantidad_biologo FROM registro_poblacion WHERE fechaActual BETWEEN DATE_SUB(NOW(), INTERVAL 6 DAY) AND NOW() AND id_camaronera = '$camaronera' and id_piscina = '$piscina' and id_corrida = '$corrida' ORDER BY fechaActual ASC";
    $data_prom = $objeto->mostrar($sql_prom);

    } else {
        $sql_prom = "SELECT cantidad_biologo FROM registro_poblacion WHERE fechaActual BETWEEN DATE_SUB(NOW(), INTERVAL 6 DAY) AND NOW() AND id_camaronera = '$camaronera' and id_piscina = '$piscina' and id_corrida = '$corrida' ORDER BY fechaActual ASC";
    $data_prom = $objeto->mostrar($sql_prom);    
        
    }
    
    #selecinamos la corrida y hectreas de la piscina solicitada 
    $suma = 0;
    $newArray=array();
    $cont = 0;


    $camarones_lance = $cantidad_animales_totales/$lances;
    $camaronera_m2 = $camarones_lance/$atarraya;
    $cantidad_animales = $camaronera_m2*10000;

    
    $cantidad_animales;/// sumar y contar para la divicion
    foreach ($data_prom as $key_prom) {
        
        $aux = intval($key_prom['cantidad_biologo']);

        if($aux > 0){

            $suma = $suma+$key_prom['cantidad_biologo'];
            $ha = $key_prom['hectareas'];
            $cont += 1;

        }
       
    }
    
    $cont = intval($cont+1);

    $sum_acum = intval($suma+$cantidad_animales);
    $prom = $sum_acum/$cont;

   
        #insertamos datos 
        $sql = "INSERT INTO `registro_poblacion`(`fechaActual`, `id_camaronera`, `id_piscina`, `id_corrida`, `hectareas`, `cantidad`, `cantidad_biologo`, `id_usuario`, `tipo`, `cantidad_animales_totales`, `lances`, `atarraya`, `bactimetria`, `muertos_rojos`, `muertos_frescos`, `enfermos`, `muda`, `talla`, `encargado_poblacion`)
                VALUES((NOW()), '$camaronera', '$piscina', '$corrida', '$hectareas',  '$prom', '$cantidad_animales',  '$encargado', '$tipo', '$cantidad_animales_totales', '$lances', '$atarraya', '$bactimetria', '$muertos_rojos', '$muertos_frescos', '$enfermos', '$muda', '$talla', '$encargado_poblacion')";
        $query = mysqli_query( $conexion, $sql );
        
?>

<script>
    alert(" ¡ Poblacional registrado ! ", );
    window.location.href="../views/index.php?page=Poblacion";
</script>