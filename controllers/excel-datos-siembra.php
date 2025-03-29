
<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera=$_GET['datos'];

$sql = "SELECT * FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso'";
$data = $conectar->mostrar($sql);

header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=Piscinas en proceso.xls');

?>
<style type="text/css">  .mayuscula { text-transform: uppercase;}   </style> 

<table border="1">
    <caption> REPORTE DE PISICINAS EN PROCESO 
        <?php 
            if($camaronera == 1){
                echo 'DARSACOM';
            }else if($camaronera == 2){
                echo 'AQUACAMARON';
            }else if($camaronera == 3){
                echo 'JOPISA';
            }else if($camaronera == 4){
                echo 'AQUANATURA';
            }else if($camaronera == 5){
                echo 'GRUPO CAMARON';
            }else if($camaronera == 6){
                echo 'CALICA';
            }
        ?>
    </caption>
    <tr>
        <th>Fecha de siembra</th>

        <th>Piscina</th>
        <th>Hectareas</th>

        <th>Corrida</th>
        <th>Peso trasnferencia</th>

        <th>Dens de transferencia</th>
        <th>Cant anim. sembrados</th>

        <th>Nauplio</th>
        <th>Laboratorio</th>

        <th>Estado</th>
    </tr>

    <?php
        foreach ($data as $value) { ?>

            <tr class="mayuscula">

                <td><?php echo $value['fecha_siembra']; ?></td>
                <td><?php echo $value['id_piscina']; ?></td>
                <td><?php echo $value['hectareas']; ?></td>
                <td><?php echo $value['id_corrida']; ?></td>
                <td><?php echo $value['peso_trasferencia']; ?></td>
                <td><?php echo $value['densidad_transferencia']; ?></td>
                <td>
                    <?php 

                        if($value['cantidad_sembrada']== "" || $value['cantidad_sembrada'] == null){ 
                            echo '0.00'; 
                        }else{ 
                            echo $value['cantidad_sembrada']; 
                        } 
                    ?>
                <td>
                    <?php 

                        if($value['nauplio']== "" || $value['nauplio'] == null){ 
                            echo 'SIN DATOS'; 
                        }else{ 
                            echo $value['nauplio']; 
                        } 
                    ?>
                </td>
                <td>
                    <?php 

                        if($value['laboratorio']== "" || $value['laboratorio'] == null){ 
                            echo 'SIN DATOS'; 
                        }else{ 
                            echo $value['laboratorio']; 
                        } 
                    ?>
                </td>
                <td><?php echo $value['estado']; ?></td>

            </tr>

        <?php } ?>

</table>