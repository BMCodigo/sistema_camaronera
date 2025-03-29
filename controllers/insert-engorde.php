<?php

error_reporting(0);
include '../models/conexion.php';
include '../models/corrida.php';
include '../views/footer.php';


$objeto = new corrida();

$conectar = new Conexion();
$conexion = $conectar->conectar();

$fechaActual = $_POST['fechaActual'];
$fechacosecha = date("Y-m-d", strtotime($fechaactual . "- 1 days" . "+ 3 month"));
$pesoTransferencia = $_POST['pesoTransferencia'];
$camaronera = $_POST['camaronera'];
$densidad = $_POST['densidad'];
$piscina = $_POST['origen_psc'];
$origen = $_POST['origen'];
$nauplio = $_POST['nauplio'];
$laboratorio = $_POST['laboratorio'];
$encargado = $_POST['user'];
$estado = 'En proceso';


#selecciono el identificador de la tabla pesca de la pisicina engorde selecionada
$sqli = mysqli_query($conexion, "SELECT identificacion FROM registro_pesca_precria WHERE id_piscina_destino = '$piscina' AND estado LIKE 'Cosechado'");

foreach ($sqli as $key) {
    $id_p = $key['identificacion'];
}

#selecionamos el nauplio, laboratorio de la precria mediante el identificador
//$sqli = mysqli_query($conexion, "SELECT nauplio, laboratorio FROM registro_piscina_precria WHERE identificacion = '$id_p'");
//foreach ($sqli as $key) {
    //$nauplio = $key['nauplio'];
    //$laboratorio = $key['laboratorio'];
//}

#seleccionamos la corrida siguiente de la pisina selecionada
$sql = "SELECT MAX(id_corrida) AS corrida FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND id_piscina = '$piscina'";
$data = $objeto->mostrar($sql);

foreach ($data as $key) {
    intval($corrida = $key['corrida'] + 1);
}

#seleccionamos hectareas de la piscina de engorde
$sqli = mysqli_query($conexion, "SELECT hectareas FROM piscina WHERE id_camaronera = '$camaronera' AND piscinas LIKE '$piscina'");

foreach ($sqli as $key) {
    $hectarea = $key['hectareas'];
}

$datos = array($fechaActual, $fechacosecha, $camaronera, $piscina, $hectarea, $corrida, $pesoTransferencia, $densidad, $nauplio, $laboratorio, $origen, $estado, $encargado);

#validamos que los datos no se encuentren repetidos en la tabla.
$sql = mysqli_query($conexion, "SELECT * FROM registro_piscina_engorde WHERE id_camaronera LIKE '$camaronera' AND id_piscina LIKE '$piscina'");
$query = mysqli_num_rows($sql);

foreach ($sql as $key) {
    $aux = $key['id_corrida'];
    $status = $key['estado'];
}

if ($query > 0) {

    if ($status == 'Cosechado') {
        #mensaje de validacion correcta.
        if ($corrida <= $aux) { ?>

            <script>
                alert(' ¡ La piscina ya fue pescada !');
                window.location.href="../views/index.php?page=Reporte-semanal";
            </script>

        <?php } else { ?>

            <script>
                alert(' ¡ Piscina registrada !');
                window.location.href="../views/index.php?page=Reporte-semanal";
            </script>

        <?php
            #insertamos datos 
            $sql = "INSERT INTO `registro_muestreo`( `fecha_muestreo`, `id_camaronera`, `id_piscina`, `id_corrida`, `peso`, `densidad`, `incremento`, `talla`, `id_usuario`) 
                    VALUES('$fechaActual', '$camaronera', '$piscina', '$corrida', '$pesoTransferencia', '$densidad', '0.00', '0.00', '$encargado')";

            $query = mysqli_query($conexion, $sql);
            $objeto->insert_run_engorde($datos);
        }
    } else { ?>

        <script>
            alert(' ¡ La Piscina está en proceso !');
            window.location.href="../views/index.php?page=Reporte-semanal";
        </script>

    <?php
    }
} else { ?>

    <script>
        alert(' ¡ Piscina registrada !');
        window.location.href="../views/index.php?page=Reporte-semanal";
    </script>

<?php
    #insertamos datos 
    $sql = "INSERT INTO `registro_muestreo`(`fecha_muestreo`, `id_camaronera`, `id_piscina`, `id_corrida`, `peso`, `densidad`, `incremento`, `talla`, `id_usuario`) 
                    VALUES('$fechaActual', '$camaronera', '$piscina', '$corrida', '$pesoTransferencia', '$densidad', '0.00', '0.00', '$encargado')";

    $query = mysqli_query($conexion, $sql);
    $objeto->insert_run_engorde($datos);
}


?>