<?php

error_reporting(0);
include '../models/conexion.php';
include '../models/corrida.php';


$objeto = new corrida();

$conectar = new Conexion();
$conexion = $conectar->conectar();

    $fechaActual = $_POST['fechaActual'];
    $fechacosecha = date("Y-m-d",strtotime($fechaactual." + 25 days")); 
    $camaronera = $_POST['camaronera'];
    $precria = $_POST['origen_pre'];
    $psc1 = $_POST['destino_psc_1'];
    $psc2 = $_POST['destino_psc_2'];
    $pesoSiembra= $_POST['pesoSiembra'];
    $cantidad = $_POST['cantidad'];
    $codigo = $_POST['codigo_genetico'];
    $nauplio = $_POST['nauplio'];
    $laboratorio = $_POST['laboratorio'];

    $estado = 'En proceso';
    $encargado = $_POST['user'];
    $id = $_POST['id'];

    $secuencial = $_POST['secuencial'];

    if($precria > 0){

        if($camaronera == 1){

            $sqli=mysqli_query($conexion,"SELECT hectareas FROM precria_darsacom WHERE id_precria LIKE '$precria'");

        }else if($camaronera == 2){

            $sqli=mysqli_query($conexion,"SELECT hectareas FROM precria_aquacamaron WHERE id_precria LIKE '$precria'");

        }else if($camaronera == 3){
            
            $sqli=mysqli_query($conexion,"SELECT hectareas FROM precria_jopisa WHERE id_precria LIKE '$precria'");

        }else if($camaronera == 4){

            $sqli=mysqli_query($conexion,"SELECT hectareas FROM precria_aquanatura WHERE id_precria LIKE '$precria'");

        }else if($camaronera == 5){

            $sqli=mysqli_query($conexion,"SELECT hectareas FROM precria_grupo_camaron WHERE id_precria LIKE '$precria'");

        }else if($camaronera == 6){

            $sqli=mysqli_query($conexion,"SELECT hectareas FROM precria_calica WHERE id_precria LIKE '$precria'");

        }else{
            echo 'error en el servidor ... =(';
        }
        
        foreach ($sqli as $key){
            $hectarea = $key['hectareas'];   
        }

        $datos = array( $fechaActual, $fechacosecha, $camaronera, $precria, $hectarea, $pesoSiembra, $cantidad, $codigo, $nauplio, $laboratorio, $origen, $dias_aprox, $piscina_1, $piscina_2, $piscina_3, $estado, $encargado, $id);

            #validamos que los datos no se encuentren repetidos en la tabla.
            $sql=mysqli_query($conexion,"SELECT * FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND id_precria = '$precria' AND estado LIKE 'En proceso'");
            $query=mysqli_num_rows($sql);

            if($query>0) { 
            ?>

            <script>
                alert(' ¡ los datos ingresado ya están en proceso !');
                window.history.go(-1);
            </script>
                
            <?php 
        
            }else{      

                #insertamos en la valores por defectos para tener un valor de innio
                $sql = "INSERT INTO `registro_piscina_precria`(`fecha_siembra`, `fecha_cosecha`, `id_camaronera`, `id_precria`, `destino_psc_1`, `destino_psc_2`, `hectareas`, `peso_siembra`, `cantidad_siembra`, `codigo_genetico`, `nauplio`, `laboratorio`, `origen`, `dias_aprox`, `estado`, `id_usuario`, `identificacion`, `secuencial`) 
                VALUES ('$fechaActual', '$fechacosecha', '$camaronera', '$precria', '$psc1', '$psc2', '$hectarea', '$pesoSiembra', '$cantidad', '$codigo', '$nauplio', '$laboratorio', 'Siembra directa', '25', '$estado', '$encargado', '$id', '$secuencial')";
                $query = mysqli_query( $conexion, $sql );
                
                #insertamos el secuencial nuevo 
                $sql_scl = "INSERT INTO `secuencial`(`fecha_secuencial`, `camaronera`, `secuencial`) VALUES ('$fechaActual', '$camaronera', '$secuencial')";
                $query_scl = mysqli_query( $conexion, $sql_scl );

                #insertamos en la valores por defectos para tener un valor
                $sqli = "INSERT INTO `calculo_datos`(`precria`, `numero_dias`, `siembra`, `hectareas`, `sobrevivencia`, `p_sobrevivencia`, `ab_c`, `peso_siembra`, `identificacion`, `mortalidad`, `cre_fase_uno`, `cre_fase_dos`, `cre_fase_tres`, `sugerido`, `subir`) 
                VALUES ('$precria', 25, '$cantidad', '$hectarea', '100', '0', '0.500', '$pesoSiembra', '$id', '0.009', '0.020', '0.040', '0.050', '0.0', '0.25')";
                $query_sqli = mysqli_query( $conexion, $sqli );  

                header ('Location:../views/index.php?page=idprecria&id='.$id);
                
            } 
    
    }else{
        ?>
            <script>
                alert(' ¡ Seleccione precria !');
                window.history.go(-1);
            </script>
        <?php
    }

?>