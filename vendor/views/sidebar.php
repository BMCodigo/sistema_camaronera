<?php
$conectar = new Conexion();
$conexion = $conectar->conectar();
 $sql_tabla = "SELECT count(*) AS quant FROM bitacora_balanceado ;";
$sql_tabla = " SELECT count(*) AS quant
FROM bitacora_balanceado 
WHERE fecha_registro >='2024-06-24' AND
fecha_registro >= DATE(NOW()) - INTERVAL 15 DAY 
  AND fecha_registro <= DATE(NOW());";
  $data = $conectar->mostrar($sql_tabla);
  $quant = $data[0]['quant'];
$objeto = new Session();
$user = $_SESSION['sesion'];
$sql = "SELECT * FROM usuarios WHERE correo LIKE '$user'";
$logeado = $objeto->mostrar($sql);
foreach ($logeado as $key) {
    $departamento = $key['departamento'];
    $c = $key['camaronera_id'];
    $roles = $key['roles'];
}
$_SESSION['camaronera']= $camaronera;
?>

<div class="sidebar-header">
    <a class="header-brand mt-2 mb-2" href="./index.php">
        <div class="logo-img">
            <img src="../src/img/grupo_vasco_2.png" class="header-brand-img" alt="lavalite" style="width: 55px; margin-left:-10px;">
        </div>
        <span class="text" style="margin-left:30px;">Aquapro</span>
    </a>
    <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
    <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
</div>

<div class="sidebar-content">
    <div class="nav-container">
        <nav id="main-menu-navigation" class="navigation-main">

            <div class="nav-lavel"> Empresa:
                <?php

                if ($camaronera == 1) {

                    echo 'Darsacom';
                    $page = $_GET['page'];
                    #include './switch-titulo.php';
                } else if ($camaronera == 2) {

                    echo 'Aquacamaron';
                    $page = $_GET['page'];
                    #include './switch-titulo.php';
                } else if ($camaronera == 3) {

                    echo 'Jopisa';
                    $page = $_GET['page'];
                    #include './switch-titulo.php';
                } else if ($camaronera == 4) {

                    echo 'Aquanatura';
                    $page = $_GET['page'];
                    #include './switch-titulo.php';
                } else if ($camaronera == 5) {

                    echo 'Grupo Camaron';
                    $page = $_GET['page'];
                    #include './switch-titulo.php';
                } else {

                    echo 'error en el servidor =(';
                }
                ?>
            </div>

           <!-- daschboard  -->
           <div class="nav-item">
                    <a title="Reportes estadisticos" href="index.php?page=Principal&d=<?php echo $departamento; ?>"> <i class="fas fa-chart-bar"></i><span>Dashboard</span></a>
            </div>

            <!-- Descarga de excel 
                <div class="nav-item">
                    <a title="Generar excel" href="index.php?page=Excel"><i class="fas fa-file-excel"></i><span>Generar reportes</span></a>
                </div>
             -->

            <!-- reporteria  -->
            <div class="nav-item has-sub">
                <a href="javascript:void(0)"><i class="fas fa-paste"></i><span>Reporte de piscinas y precrias </span> </a>
                <div class="submenu-content">
                    <a title="contol alimento semanal fase de engorde y precrias" href="index.php?page=Reporte-semanal" class="menu-item"> Alimentacion diaria </a>
                    <a title="Control de precria" href="index.php?page=Reporte-precria" class="menu-item">Control de precrias</a>
                    <a title="Generar excel" href="index.php?page=Excel" class="menu-item">Generar reporte en excel</a>
                        <!--a title="Prolateo" href="index.php?page=Reporte-prolateo" class="menu-item">Prorrateo de balanceado</a-->
                                        <?php if ($roles == 'superadmin') {  ?>
                      <a title="Alimentacion Sugerida" href="index.php?page=Alimentos" class="menu-item">Alimentacion sugerida</a>
                        <? } ?>
                </div>
            </div>

            <!-- ingresos -->
            <div class="nav-item has-sub">
                <a href="javascript:void(0)"><i class="fas fa-edit"></i><span> Ingreso de datos </span> </a>
                <div class="submenu-content">
                        
                        <a href="index.php?page=Siembra" title="Siembra de precrias" class="menu-item">Siembra de precria</a>
                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)" class="menu-item">Transferencia</a>
                            <div class="submenu-content">
                                <a href="index.php?page=Transferencia_pre_ps" class="menu-item" title="Precria a piscina">Precria a piscina</a>
                                <a href="index.php?page=Transferencia_ps_ps" class="menu-item" title="Piscina a piscina">Piscina a piscina</a>
                                <a href="index.php?page=Transferencia_pre_pre" class="menu-item" title="Precria a precria">Precria a precria</a>
                            </div>
                        </div>
                        <?php if ($roles == 'superadmin') {  ?>
                         <? } ?>
                        <a href="index.php?page=Pesca" class="menu-item" title="Pesca piscina">Pesca piscina</a>
                       
                        <a href="index.php?page=Alimentacion" class="menu-item" title="Alimentacion">Alimentacion </a>
                        <a href="index.php?page=Control-peso" class="menu-item" title="Control de peso intermedio y muestreo semanal">Control de peso intermedio y</br> muestreo
                            semanal</a>
                        <a href="index.php?page=Poblacion" class="menu-item" title="Conrtol poblacional">Control poblacional </a>
                        <?php if ($_SESSION['id']==2){   ?>
                         <a href="index.php?page=insumos" class="menu-item" title="Conrtol poblacional">Insumos diarios </a>
                          <?php } ?>
                        
                        
                </div>
            </div>
 
            <!-- bodega    -->
            <div class="nav-item has-sub">
                <a href="#"><i class="fas fa-cubes"></i><span>Gestion Bodega </span></a>
                <!-- if ($departamento == 'Gerencia' || $departamento == 'sistemas' || $departamento == 'Contabilidad') { -->
                <div class="submenu-content">
                    <a href="index.php?page=Kardex" class="menu-item" title="Kardex de bodega">Kardex</a>
                </div>
                
                 <div class="submenu-content">
                    <a href="index.php?page=Ingreso" class="menu-item" title="Ingreso de Alimento a bodega">Ingreso Balanceado Bodega</a>
                </div>
                
                 
                 <div class="submenu-content">
                    <a href="index.php?page=Aprobacion-solicitud" class="menu-item" title="Despachar">Ver Solicitudes Despacho </a>
                </div>               

                <div class="submenu-content">
                        <a href="index.php?page=Bodega" class="menu-item" title="Toma fisica">Toma fisica</a>
                </div>

            </div>
            
                        <!-- biologo    -->
            <div class="nav-item has-sub">
                <a href="#"><i class="fas fa-file-archive"></i><span>Solicitudes Alimento </span></a>
                <!-- if ($departamento == 'Gerencia' || $departamento == 'sistemas' || $departamento == 'Contabilidad') { -->
                <div class="submenu-content">
                    <a href="index.php?page=Kardex" class="menu-item" title="Kardex de bodega">Kardex</a>
                </div>

                <div class="submenu-content">
                    <a href="index.php?page=Nueva-solicitud-biologo" class="menu-item" title="Solicitud de balanceado">Solicitar balanceado</a>
                </div>
                
                                <div class="submenu-content">
                    <a href="index.php?page=Solicitud-generadas-biologo" class="menu-item" title="ver solicitudes biologo">Ver solicitudes biologo</a>
                </div>
   
            </div>

            <!-- parametros  -->
            <?php if ($roles == 'superadmin') {  ?>
            <div class="nav-item">
                <a title="Parametros" href="index.php?page=Parametros"><i class="fas fa-list"></i><span>Parametros</span></a>
            </div>
            <?php } ?>
           

            <!-- personal  
                <div class="nav-item has-sub">
                    <a href="javascript:void(0)"><i class="fas fa-child"></i>
                    <span> Personal 
                        <?php
                        if ($camaronera == 1) {
                            echo 'darsacom';
                        } else if ($camaronera == 2) {

                            echo 'aquacamaron';
                        } else if ($camaronera == 3) {

                            echo 'jopisa';
                        } else if ($camaronera == 4) {

                            echo 'aquanatura';
                        } else if ($camaronera == 5) {

                            echo 'grupo camaron';
                        } else {
        
                            echo 'error en el servidor =(';
                        }
                        ?> 
                    </span> </a>
                    <div class="submenu-content">
                        
                        <a title="Ingreso nuevo personal" href="index.php?page=Ingreso-personal" class="menu-item"> Ingreso de personal </a>
                            <a title="Salida de personal" href="index.php?page=Salida-personal" class="menu-item">Salida de personal</a>
                    </div>
                </div>
            -->
            <!-- empresas  -->
            <?php if ($roles == 'superadmin') {  ?>
            <div class="nav-item has-sub">
                <a href="#"><i class="fas fa-exclamation" style= "color:#FF9933"></i><span style= "color:#FF9933">
               <?php echo $quant.' Cambios Recientes Balanc. ';   ?>
                    </span></a>
                <div class="submenu-content">
                <a href="index.php?page=traza-bilidad" class="menu-item" style= "color:#FF9933">Ver detalles</a>
                </div>
            </div>
            
                 <?php if (count($data)>0) {    ?>


            <?php } else {  ?>
              
              
      <?php }   ?>
                <div class="nav-item has-sub">
                    <a href="#"><i class="fas fa-building"></i><span>Camaronera</span></a>
                    <div class="submenu-content">
                        <a href="../controllers/empresa.php?e=2&c=<?php echo $c; ?>&u=<?php echo $user = substr($user, 0); ?>" class="menu-item" title="Aquacamaron">Aquacamaron</a>
                        <a href="../controllers/empresa.php?e=4&c=<?php echo $c; ?>&u=<?php echo $user2 = substr($user, 0); ?>" class="menu-item" title="Aquanatura">Aquanatura</a>
                        <a href="../controllers/empresa.php?e=1&c=<?php echo $c; ?>&u=<?php echo $user3 = substr($user, 0); ?>" class="menu-item" title="Darsacom">Darsacom</a>
                        <a href="../controllers/empresa.php?e=3&c=<?php echo $c; ?>&u=<?php echo $user4 = substr($user, 0); ?>" class="menu-item" title="Jopisa">Jopisa</a>
                        <a href="../controllers/empresa.php?e=5&c=<?php echo $c; ?>&u=<?php echo $user5 = substr($user, 0); ?>" class="menu-item" title="Grupo Camaron">Grupo Camaron</a>
                    </div>
                </div>
            <?php } ?>

            <!-- autenticacion  -->
            <div class="nav-item has-sub">
                <a href="#"><i class="fas fa-lock"></i><span>Autenticacion</span></a>
                <div class="submenu-content">
                    <a href="./destroy.php" class="menu-item">Cerra sesion</a>

                </div>
            </div>

   
        </nav>
    </div>
</div>
