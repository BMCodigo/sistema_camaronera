
<?php

error_reporting(0);
include '../models/conexion.php';
include '../views/footer.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$camaronera=$_GET['datos'];

$sql = "SELECT * FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND estado = 'En proceso'";
$data = $conectar->mostrar($sql);

header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=Precrias en proceso.xls');

?>
<style type="text/css">  .mayuscula { text-transform: uppercase;}   </style> 

<table border="1">
    <caption> REPORTE DE PRECRIAS EN PROCESO 
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

        <th>Precria</th>
        <th>Hectareas</th>

        <th>Peso de siembra</th>

        <th>Cantidad Anim. sembrada</th>
        <th>Codigo genetico</th>

        <th>Nauplio</th>
        <th>Laboratorio</th>

        <th>Estado</th>
    </tr>

    <?php
        foreach ($data as $value) { ?>

            <tr class="mayuscula">

                <td><?php echo $value['fecha_siembra']; ?></td>
                <td><?php echo $value['id_precria']; ?></td>
                <td><?php echo $value['hectareas']; ?></td>
                <td><?php echo $value['peso_siembra']; ?></td>
                <td><?php echo $value['cantidad_siembra']; ?></td>
                <td>
                    <?php 

                        if($value['codigo_genetico']== "" || $value['codigo_genetico'] == null){ 
                            echo 'SIN DATOS'; 
                        }else{ 
                            echo $value['codigo_genetico']; 
                        } 
                    ?>
                </td>

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