<?php

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

            #mensaje de validacion correcta.
        ?>

            <script>
                alert(" SE GUARDO CON EXITO ¡ Piscina pescada ! ", );
                window.location.href="../views/index.php?page=Pesca";
            </script>

            <?php

            if ($raleo == 'Raleo') {

                $estado = "Raleo";
                $datos = array($fechaActual, $camaronera, $laboratorio, $nauplio, $piscina, $ha, $corrida, $libras, $peso_pesca, $cliente, $encargado, $estado, $rendimiento);
                $objeto->insert_pesca($datos);

            } else {
                      
               $sqli = "SELECT SUM(libras_pescadas) AS libras_pescadas  FROM registro_pesca_engorde WHERE id_caaronera = $camaronera AND id_piscina = '$piscina' AND id_corrida = '$corrida' AND estado = 'Raleo'";
               $data = $objeto->mostrar($sqli);

                foreach ($data as $key) {
                    $libras_pescadas = $key['libras_pescadas'];
                }

                $libras_totales = $libras_pescadas + $libras;
                 //GET DETAILS
                $estado = "Cosechado";
                $datos = array($fechaActual, $camaronera, $laboratorio, $nauplio, $piscina, $ha, $corrida, $libras_totales, $peso_pesca, $cliente, $encargado, $estado, $rendimiento);
                $objeto->insert_pesca($datos);
                #actualizamos el estado de la piscina siembra emgorde "en proceso" a "cosechado"
                $sql = "UPDATE registro_piscina_engorde SET estado = '$estado' WHERE id_piscina = '$activa' AND id_corrida = '$corrida'";
                mysqli_query($conexion, $sql);
                
                if ($liqudacion == 'final') {
                    
                    //GET HEADER
                    //u
                    
                    
                    
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
