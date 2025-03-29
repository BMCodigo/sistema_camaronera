<?php
error_reporting(0);
include '../models/conexion.php';

$conectar = new Conexion();
$conexion = $conectar->conectar();

$id = $_GET['id'];
$camaronera = $_GET['camaronera'];

$sql = "SELECT * FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id_secuencia = '$id'";
$result = $conexion->query($sql);

foreach ($result as $key) {
    $encargado = $key['encargado'];
    $fecha_entrega = $key['fecha_entrega'];
    $id_secuencia = $key['id_secuencia'];
}
?>
<script>
window.print();
// window.history.go(-1);
</script>

<body>

    <header id="main-header">

        <?php

            if ($camaronera == '1') {

                $llc= 'DARSACOM';

            } else if ($camaronera == '2') {

                    $llc= 'AQUACAMARON';

            } else if ($camaronera == '3') {

                    $llc= 'JOPISA';

            } else if ($camaronera == '4') {

                    $llc= 'AQUANATURA';

            } else if ($camaronera == '5') {

                    $llc= 'GRUPO AQUACAMARON';

            }  else if ($camaronera == '6') {

                    $llc= 'CALICA';

            }else {

                    $llc= 'error en el servidor =(';
            }
        ?>

        <a id="logo-header" href="#" style="">
            <span class="site-desc" style="color:black;"><strong><?php echo 'Encargado: '.$encargado; ?></strong></span>
            <span class="site-desc" style="color:black;"><strong><?php echo 'Fecha de solicitud: '.$fecha_entrega; ?></strong></span>
            <span class="site-desc" style="color:black;"><strong><?php echo 'Orden de solicitud: #'.$id_secuencia; ?></strong></span>
            <span class="site-desc" style="color:black;"><strong><?php echo 'Empresa: '.$llc ?></strong></span>
        </a> 

    </header>


    <article>

        <center>
            <!--<img src="../src/img/grupo_vasco.png"  alt="Gatito" />-->
        </center>
        <br>
        <div class="content">
            <center>
            <br><br>
                <img src="../src/img/grupo_vasco.png" alt="Grupo Vasco | solicitud de despachos" style="width:120px; height:120px; margin-top: -135px; margin-left: 1%;"><br>
                <table width="500;" style="text-align: center" border="1">
                    <b></b>TOTALES A DESPACHAR</b>
                    <?php
                    foreach ($result as $val) {
                    ?>



                    <?php
                     $piscina = "psc".$val['id_piscina'];
                     $tipo = "".$val['tipo_balanceado']."";
                     if ($totales[$tipo] > 0 ){
                         
                    
                    
                       if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                      $totales[$tipo]+=(($val['cantidad_balanceado']-$val['sobrante'])/10);  
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                                    $totales[$tipo]+=(($val['cantidad_balanceado']-$val['sobrante'])/10);  
                                                }else {
                                                  $totales[$tipo]+=(($val['cantidad_balanceado']-$val['sobrante'])/25);  
                                                } 
                    
                     } else {
                         
                         
                   
                    
                                           if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                     $totales[$tipo]=(($val['cantidad_balanceado']-$val['sobrante'])/10); 
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                                   $totales[$tipo]=(($val['cantidad_balanceado']-$val['sobrante'])/10); 
                                                }else {
                                                  $totales[$tipo]=(($val['cantidad_balanceado']-$val['sobrante'])/25);  
                                                } 
                     }
                    
                    
                      
                   
                    } ?>

                </table>
            </center><br>
            <center>
                <table width="500;" style="text-align: center" border="1">
                    <thead>
                        <tr>
                            <th>Balanceado</th>
                            <th>Total despachar en Sacos</th>

                        </tr>
                    </thead>
                    <?php
                     foreach ($totales as $key => $value) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?php  echo "{$key}"; ?></td>
                            <td><?php  echo "{$value}"; ?></td>
                        </tr>

                    </tbody>
                    <?php  } ?>
                </table>
            </center>
            <br>






            <div class="content"><br>
                <center>
                    <table width="500;" style="text-align: center" border="1">
                        <b></b>DISTRIBUCION POR PISCINAS</b>


                    </table>
                </center><br>






                <center>
                    <table width="500;" style="text-align: center" border="1">
                        <thead>
                            <tr>
                                <th>Destino</th>
                                <th>Tipo <br> Balanceado</th>
                                <th>Cant. <br> Despachar / Sacos</th>
                                <th>Cant. <br> Despachar / Kg</th>

                            </tr>
                        </thead>
                        <?php
                    foreach ($result as $val) {
                    ?>
                        <tbody>
                            <tr>

                                <td><b><?php echo $val['id']." ".$val['id_piscina']; ?></b></td>
                                <td><?php echo $val['tipo_balanceado']; ?></td>
                                <td><?php 
                                                    
                                           if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                   echo floatval(($val['cantidad_balanceado']-$val['sobrante'])/10);
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                                echo floatval(($val['cantidad_balanceado']-$val['sobrante'])/10);
                                                }else {
                                               echo floatval(($val['cantidad_balanceado']-$val['sobrante'])/25);
                                                } 
                                 ?>
                                </td>
                                <td><?php echo floatval($val['cantidad_balanceado']-$val['sobrante']); ?></td>


                            </tr>
                        </tbody>


                        <?php
                     $piscina = "psc".$val['id_piscina'];
                     $tipo = "".$val['tipo_balanceado']."";
                     if ($totales[$tipo] > 0 ){
                         
                         
                  
                    
                       if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                    $totales[$tipo]+=(($val['cantidad_balanceado']-$val['sobrante'])/10);  
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                                $totales[$tipo]+=(($val['cantidad_balanceado']-$val['sobrante'])/10);  
                                                }else {
                                            $totales[$tipo]+=(($val['cantidad_balanceado']-$val['sobrante'])/25);  
                                                } 
                    
                    
                    
                     } else {
                         
                                           if($val['tipo_balanceado'] == 'Origin 0.5'){
                                                    $totales[$tipo]=(($val['cantidad_balanceado']-$val['sobrante'])/10);  
                                                }else if($val['tipo_balanceado'] == 'Origin 0.3'){
                                              $totales[$tipo]=(($val['cantidad_balanceado']-$val['sobrante'])/10);   
                                                }else {
                                            $totales[$tipo]=(($val['cantidad_balanceado']-$val['sobrante'])/25);  
                                                } 
                     }
                    
                    
                      
                   
                    } ?>

                    </table>
                </center>
            </div>
            <br><br>
            <center>
                <p>--------------------------------- <br>Firma de responsable</p>
            </center>

    </article> <!-- /article -->


    <form class="container mt-3" action="../views/index.php?page=Aprobacion-solicitud" method="post">
        <center><button class="btn btn-danger btn-sm text-light mt-3" id="add-form-kardex" type="submit"
                style="background-color:red;color:white;height:54px;border:0;">DESPACHO</button></center>
    </form>
</body>

</html>

<style>
btn {
    background: #0b76a6;


}



h3 {
    font-size: 1.3em;
    line-height: 1.3em;
    margin: 15px 0;
    text-align: center;
    font-weight: 300;
}

p {
    margin: 0 0 1.5em 0;
}

img {
    max-width: 70%;
    height: 20%;
}


#main-header {
    color: white;
    height: 80px;
}

#main-header a {
    color: white;
}

/*
 * Logo
 */
#logo-header {
    float: left;
    padding: 15px 0 0 20px;
    text-decoration: none;
}

#logo-header:hover {
    color: #0b76a6;
}

#logo-header .site-name {
    display: block;
    font-weight: 700;
    font-size: 1.2em;
}

#logo-header .site-desc {
    display: block;
    font-weight: 300;
    font-size: 15px;
    color: #999;
}

nav {
    float: right;
}

nav ul {
    margin: 0;
    padding: 0;
    list-style: none;
    padding-right: 20px;
}

nav ul li {
    display: inline-block;
    line-height: 80px;
}

nav ul li a {
    display: block;
    padding: 0 10px;
    text-decoration: none;
}

nav ul li a:hover {
    background: #0b76a6;
}


#main-content {
    background: white;
    width: 90%;
    max-width: 800px;
    margin: 20px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, .1);
}

#main-content header,
#main-content .content {
    padding: 40px;
}


#main-footer {
    background: #333;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 40px;
}

#main-footer p {
    margin: 0;
}

#main-footer a {
    color: white;
}
</style>