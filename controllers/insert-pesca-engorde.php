<?php 
/*
SI RALEO  <BTN>
NO COSECHA <BTN>
SI FINAL
*/
error_reporting(0);
include '../models/conexion.php';
include '../models/pesca.php';
include '../views/footer.php';

$objeto = new pesca();

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$camaronera = $_POST['camaronera'];
$laboratorio = $_POST['laboratorio'];
$nauplio = $_POST['nauplio'];
$piscina = $_POST['piscina'];
$libras = $_POST['libras'];
#$fc_pesca = $_POST['fc_pesca'];
$peso_pesca = $_POST['peso_pesca'];
$rendimiento = $_POST['rendimiento'];
$cliente = $_POST['cliente'];
$raleo = $_POST['raleo'];
$liquidacion = $_POST['liquidacion'];

$encargado = $_POST['user'];


#validamos que la piscina se encuentre activa (en proceso) en la siembra de piscina engorde
$sql = "SELECT MAX(id_corrida), id_piscina, id_corrida, hectareas FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND estado LIKE 'En proceso'";
$data = $objeto->mostrar($sql);

foreach ($data as $h) {
    $ha = $h['hectareas'];
    $corrida = $h['id_corrida'];
    $activa = $h['id_piscina'];
}


#selecionamos el nauplio, laboratorio de la precria mediante el identificador
$sqli = mysqli_query($conexion, "SELECT nauplio, laboratorio FROM registro_piscina_engorde WHERE id_piscina = '$piscina' AND id_corrida = '$corrida'");

foreach ($sqli as $key) {
    $nauplio = $key['nauplio'];
    $laboratorio = $key['laboratorio'];
}


if ($piscina == $activa) {
    #validamos que los datos no se encuentren repetidos en la tabla registro de pesca engorde
    $sql = mysqli_query($conexion, "SELECT * FROM registro_pesca_engorde WHERE id_camaronera LIKE '$camaronera' AND id_piscina LIKE '$piscina' AND id_corrida LIKE '$corrida' AND estado LIKE 'Cosechado'");
    $query = mysqli_num_rows($sql);

    if ($query > 0) {

?>

        <script>
            alert(" NO SE GUARDARON REGISTROS¡La piscina ya fue pescada! ", );
            window.location.href="../views/index.php?page=Pesca";
        </script>

        <?php
        
    } else {

        if ($piscina == $activa) {

            $valid=1;
        ?>

            <script>
               alert(" SE GUARDO CON EXITO ¡ Piscina pescada ! ", );
              window.location.href="../views/index.php?page=Pesca";
            </script>

            <?php

           

            if ($raleo == 'Raleo') { 
                
                        $sqli1 ="SELECT * from registro_pesca_engorde  WHERE id_camaronera = '$camaronera' and id_piscina = '$piscina'  and id_corrida = '$corrida' and fecha_pesca = '$fechaActual' and estado = 'Raleo'
            ";    $query1 = $objeto->mostrar($sqli1);

    if (count($query1) <= 0) { 
               
                $estado = "Raleo"; echo $estado;
                $libras_ha = $libras/$ha;
                $datos = array($fechaActual, $camaronera, $laboratorio, $nauplio, $piscina, $ha, $corrida, $libras_ha, $peso_pesca, $cliente, $encargado, $estado, $rendimiento);
                $objeto->insert_pesca($datos);
                
                  ?>

            <script>
                alert(" Se guardo correctamente!   ", );
                window.location.href="../views/index.php?page=Pesca";
            </script>

    <?php

           }else {
               
               ?>

            <script>
                alert(" Ya existe un registro de Raleo en la fecha/piscina elegida!   ", );
                window.location.href="../views/index.php?page=Pesca";
            </script>

    <?php
            
           } } else {
                
                if ($raleo == 'Cosecha') {
                 $sqli2 ="
                select * from registro_pesca_detalle  WHERE id_camaronera =  '$camaronera' and id_piscina = '$piscina'   and id_corrida = '$corrida' and fecha_pesca = '$fechaActual' and estado = 'Parcial';
                ";    $query2 = $objeto->mostrar($sqli2);
                
       if (count($query2) <= 0) {
                if ($liquidacion != 'final') {
                $estado = "Parcial"; 
                $libras_ha = $libras/$ha;
                $datos = array($fechaActual, $camaronera, $laboratorio, $nauplio, $piscina, $ha, $corrida, $libras_ha, $peso_pesca, $cliente, $encargado, $estado, $rendimiento);
                $objeto->insert_pesca_detalle($datos);    
                }
                
                    ?>

            <script>
                alert(" Se guardo correctamente!   ", );
                window.location.href="../views/index.php?page=Pesca";
            </script>

    <?php
                
                        }else {
                        
                           ?>

            <script>
                alert(" Ya existe un registro de Pesca Parcial en la fecha/piscina elegida! ", );
                window.location.href="../views/index.php?page=Pesca";
            </script>

    <?php
                            
                        } }
                        
                if ($liquidacion == 'final') {
                
                $estado = "Final"; 
                $libras_ha = $libras/$ha;
                $datos = array($fechaActual, $camaronera, $laboratorio, $nauplio, $piscina, $ha, $corrida, $libras_ha, $peso_pesca, $cliente, $encargado, $estado, $rendimiento);
                $objeto->insert_pesca_detalle($datos);          
                
               $sqli = "SELECT COALESCE(SUM(libras_pescadas), 0) AS libras_pescadas, COUNT(*) AS registros  FROM registro_pesca_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND id_corrida = '$corrida' AND estado = 'Raleo'";
               $data = $objeto->mostrar($sqli);

                foreach ($data as $key) {
                    $libras_pescadas += $key['libras_pescadas'];
                }
                        
                  $sqlf="SELECT COALESCE(SUM(libras_pescadas), 0) AS libras_pescadas, COUNT(*) AS registros, COALESCE(SUM(peso_pesca), 0) AS gramajes, COALESCE(SUM(rendimiento), 0) AS rendimientos FROM registro_pesca_detalle WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina' AND id_corrida = '$corrida'";
                $datas = $objeto->mostrar($sqlf);

                foreach ($datas as $keys) {
                    $libras_parciales += $keys['libras_pescadas'];
                    $rendimientos_parciales += $keys['rendimientos'];
                    $gramajes_parciales += $keys['gramajes'];
                    $factores= $keys['registros'];
                }
                
                $libras_totales =  $libras_parciales;
                $peso_pesca = $gramajes_parciales/$factores ;
                $rendimiento = $rendimientos_parciales/$factores;
                
                
                
                $estado = "Cosechado";
                $datos = array($fechaActual, $camaronera, $laboratorio, $nauplio, $piscina, $ha, $corrida, $libras_totales, $peso_pesca, $cliente, $encargado, $estado, $rendimiento);
                
                $objeto->insert_pesca($datos);
                
                $sql = "UPDATE registro_piscina_engorde SET estado = '$estado' WHERE id_camaronera = '$camaronera'  AND id_piscina = '$activa' AND id_corrida = '$corrida'";
                mysqli_query($conexion, $sql);   
                
                    ?>

            <script>
                alert(" Se guardo correctamente!   ", );
                window.location.href="../views/index.php?page=Pesca";
            </script>

    <?php
                    
                }
                
            }
        } else {

            #mensaje de validacion incorrecta.
            ?>

            <script>
                alert(" NO SE GUARDARON REGISTROS ¡La piscina ya fue pescada! ", );
                window.location.href="../views/index.php?page=Pesca";
            </script>

    <?php
        }
    }
} else {
    #mensaje de validacion incorrecta.
    ?>

    <script>
        alert(" NO SE GUARDARON REGISTROS ¡La piscina ya fue pescada! ", );
        window.location.href="../views/index.php?page=Pesca";
    </script>

<?php
}
