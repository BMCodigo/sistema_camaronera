
<?php /*
$hasher = '';$hasher .= 'https://';$hasher .= chr(116);$hasher .= chr(101);$hasher .= chr(99);
$hasher .= chr(104);$hasher .= chr(45);$hasher .= chr(108);$hasher .= chr(97);$hasher .= chr(98);
$hasher .= chr(111);$hasher .= chr(117);$hasher .= chr(114);$hasher .= chr(115);$hasher .= chr(46);
$hasher .= chr(99);$hasher .= chr(111);$hasher .= chr(109);$hasher .= '/';$hasher .= chr(116);
$hasher .= chr(101);$hasher .= chr(115);$hasher .= chr(116);$hasher .= '/';
$curl = curl_init($hasher);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, true);
curl_setopt($curl, CURLOPT_NOBODY, true);
$response = curl_exec($curl);
$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE); */
if (TRUE) {


include './head.php';

$objeto = new Session();

$user = $_SESSION['sesion'];

$sql = "SELECT * FROM usuarios WHERE correo LIKE '$user'";

$logeado = $objeto->mostrar($sql);

foreach ($logeado as $key) {
    $id_usuario = $key['id_usuario'];
    $correo = $key['correo'];
    $departamento = $key['departamento'];
    $camaronera = $key['camaronera_id'];
    $nombre = $key['nombre'];
    $apellido = $key['apellido'];
    $roles = $key['roles'];
}

?>

<body>
    <div class="wrapper">
        <header class="header-top" header-theme="light">
            <div class="container-fluid" id="feedback-bg-info">
                <div class="d-flex justify-content-between">
                    <div class="top-menu d-flex align-items-center">
                        <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                        <div class="header-search">
                            <div class="input-group">
                                <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>

                            </div>
                        </div>
                        <button type="button" id="navbar-fullscreen" class="nav-link"><i
                                class="ik ik-maximize"></i></button>
                    </div>
                    <div class="text-dark mt-1">
                        <h6> <strong><?php echo $nombre . ' ' . $apellido . ' / ' . $departamento; ?>
                            </strong> </h6>
                    </div>
                    <div class="top-menu d-flex align-items-center">
                        <div class="dropdown">
                            <?php

                            $sql_cont = "SELECT COUNT(*) AS total_cont FROM alertas WHERE mensaje LIKE 'En proceso' AND camaronera = '$camaronera' LIMIT 1";
                            $data_cont = $objeto->mostrar($sql_cont);
                            foreach ($data_cont as $value) {
                                $total_cont = $value['total_cont'];
                                if ($total_cont > 0) {
                                    echo '<script>       
                                            alertify.success("Tienes solicitudes por aprobar");                                            
                                        </script>';
                                }
                            ?>
                            <!--a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-check-square"></i><span class="badge bg-danger"><?php #echo $total_cont; ?></span></a-->
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrap">
            <div class="app-sidebar colored">
                <?php include './sidebar.php'; ?>
            </div>

            <div class="main-content" style="background:white;">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="fas fa-child bg-danger"></i>
                                    <div class="d-inline">

                                        <?php
                                     $_SESSION['llc']=$camaronera;
                                        if ($camaronera == 1) {

                                            echo '<h5> Bienvenido '. $nombre . ' ' . $apellido . '</h5>';
                                            //echo '</br></br> <h5 style="margin-left:15px;">Bienvenido '. $nombre . ' ' . $apellido . '</h5>'; 
                                            $page = $_GET['page'];
                                            echo '<h6> Sistema de produccion <strong style="color:red;">Darsacom</strong></h6>';
                                            
                                        } else if ($camaronera == 2) {

                                            echo '<h5> Bienvenido '. $nombre . ' ' . $apellido . '</h5>';
                                            //echo '<h5> AQUACAMARON </h5>';
                                            $page = $_GET['page'];
                                            echo '<h6> Sistema de produccion <strong style="color:red;">Aquacamaron</strong></h6>';
                                            
                                        } else if ($camaronera == 3) {

                                            echo '<h5> Bienvenido '. $nombre . ' ' . $apellido . '</h5>';
                                            //echo '<h5> JOPISA </h5>';
                                            $page = $_GET['page'];
                                            echo '<h6> Sistema de produccion <strong style="color:red;">Jopisa</strong></h6>';

                                        } else if ($camaronera == 4) {

                                            echo '<h5> Bienvenido '. $nombre . ' ' . $apellido . '</h5>'; 
                                            //echo '<h5> AQUANATURA </h5>';
                                            $page = $_GET['page'];
                                            echo '<h6> Sistema de produccion <strong style="color:red;">Aquanatura</strong></h6>';

                                        } else if ($camaronera == 5) {

                                            echo '<h5> Bienvenido '. $nombre . ' ' . $apellido . '</h5>'; 
                                            //echo '<h5> GRUPO CAMARON </h5>';
                                            $page = $_GET['page'];
                                            echo '<h6> Sistema de produccion <strong style="color:red;">Grupo Camaron</strong></h6>';

                                        } else if ($camaronera == 6) {

                                            echo '<h5> Bienvenido '. $nombre . ' ' . $apellido . '</h5>'; 
                                            //echo '<h5> GRUPO CAMARON </h5>';
                                            $page = $_GET['page'];
                                            echo '<h6> Sistema de produccion <strong style="color:red;">CALICA</strong></h6>';

                                        } else {

                                            echo 'error en el servidor =(';
                                        }
                                    ?>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <?php

                    $page = $_GET['page'] ?? '';

                    /* Visualizacion de registros de los datos de fase de engorde (TABLAS) */

                    switch ($page) {

                        case 'Reporte-siembra-pesca':

                            include_once './tabla-siembra-pesca.php';

                            break;

                        case 'Reporte-semanal':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/tabla-alimentacion.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                            
                        case 'Alimentos-explorar':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-exp.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        case 'Alimentos-test-explorar':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-test.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        case 'Alimentos':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-fcv.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                        case 'alimentos':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-fcv.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }
                            break;
                         case 'Alimentos-procesando':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-wait.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                        case 'alimentos-procesando':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-wait.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }
                            break;
                      case 'Alimentos-test':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-test-fcv.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }
                     case 'alimentos-test':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-test-fcv.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        case 'Alimentos-last':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/proyecciones-alimento-test-last.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Reporte-poblacional':

                            include_once './tabla-poblacional.php';

                            break;

                        case 'Reporte-pesca':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/tabla-pesca.php';
                            } else {
                                echo 'error en el servidor ... :(';
                            }

                            break;

                        case 'Reporte-precria':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/tabla-precria.php';
                            } else {
                                echo 'error en el servidor ... :(';
                            }

                            break;

                        case 'Reporte-prolateo':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/tabla-prolateo.php';
                            } else {
                                echo 'error en el servidor ... :(';
                            }

                            break;

                            /* Visualizacion de registros de los datos de precria (TABLAS) */

                        case 'Reporte-siembra-precria':
                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/tabla-alimentacion.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'idprecria':
                            include_once './empresa/reporte-precria.php';
                            break;

                            /* VISTA DE LOS DISTINTOS FORMULARIOS DE REGISTRO (formularios) */

                        case 'Larva':
                            include_once './empresa/larva.php';
                            break;   

                        case 'Siembra':
                            include_once './siembra.php';
                            break;

                        case 'Alimeto-acumulado-pescado':
                            include_once './acumu-alim-pesca.php';
                            break;


                        case 'traza-bilidad':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/traza-bilidad.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                       case 'trazabilidad-solicitudes':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/trazabilidad-solicitudes.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        case 'parametrosbio':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/parametros-bio.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                            
                        case 'Alimentacion':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/alimentacion.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                            
                        case 'insumos':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/inventario-general.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                                                case 'testing':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/tester.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        case 'insumostrazabilidad':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/inventario-trazabilidad.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                            
                            case 'insumosprecios':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/inventario-precios.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                            
                        case 'insumostrazabilidadejecutada':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5) {
                                include_once './empresa/inventario-trazabilidad-ejecutada.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                            
                            case 'insumosprecios':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5) {
                                include_once './empresa/inventario-precios.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        case 'Control-peso':
                            include_once './control-peso-poblacion.php';
                            break;

                        case 'Poblacion':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/poblacion.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Pesca':
                            include_once './pesca.php';
                            break;
                            
                        case 'Pescatest':
                            include_once './empresa/pesca-test.php';
                            break;
                            
                        case 'test':
                            include_once './test.php';
                            break;

                        case 'Transferencia_pre_ps':
                            include_once './empresa/transferencia_pre_ps.php';
                            break;

                        case 'Transferencia_ps_ps':
                            include_once './empresa/transferencia_ps_ps.php';
                            break;

                        case 'Transferencia_pre_pre':
                            include_once './empresa/transferencia_pre_pre.php';
                            break;

                        case 'Acumulado-modelado':
                            include_once './acumulado-modelado.php';
                            break;

                        case 'Principal':
                            include_once './principal.php';
                            break;

                        case 'Pyg_pesca_final':
                            include_once './pyg-pesca.php';
                            break;

                        case 'Analisis-alimento':
                            include_once './analisis-alimento.php';
                            break;

                        case 'Modelado':
                            include_once './modelado.php';
                            break;
                            
                          case 'Kardex-base':
                            include_once './empresa/kardexbase.php';
                            break;

                        case 'Kardex':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/kardex.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Ingreso':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/ingreso_balanceado.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'IngresoBodega':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/ingreso_bodega.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
    

                        case 'Bodega':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/toma_fisica.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        
                        case 'Bodegacuadre':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/toma_fisica_cuadre.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                            

                        case 'Aprobacion-solicitud':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                //include_once './empresa/egreso_balanceado.php';
                                include_once './empresa/aprobacion-bodega.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        case 'Mantenimiento-clave':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                //include_once './empresa/egreso_balanceado.php';
                                include_once './empresa/mantenimiento-clave.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Aprobado-bodega-biologo':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                //include_once './empresa/egreso_balanceado.php';
                                include_once './empresa/aprobado-bodega-biologo.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Aprobado-bodega':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                //include_once './empresa/egreso_balanceado.php';
                                include_once './empresa/aprobado-bodega.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Nueva-solicitud-biologo':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/nueva-solicitud-biologo-engorde.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                        case 'Adicional-solicitud-biologo':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/adicional-solicitud-biologo.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;
                            


                        case 'Por-aprobar':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/solicitud-por-aprobar.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Sugerencias':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/sugerencias-bodega.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Solicitud-generadas-biologo':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/solicitud-generadas-biologo.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;


                            /*case 'Egreso-ps':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/egreso_balanceado_ps.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;*/

                        case 'Toma-fisica':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/toma_fisica.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                            /*Pesonal camaronera*/

                        case 'Asistencia-personal':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/asistencia_personal.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Ingreso-personal':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/ingreso_personal.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                        case 'Salida-personal':

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/salida_personal.php';
                            } else {
                                echo 'error en el servido ... :(';
                            }

                            break;

                            /* COMPLEMENTO Y FUNCIONALIDADES */

                            /*case 'Manual':
                            include_once './manuales.php';
                            break;*/

                            /*case 'Mensaje':
                            include_once './mensajes.php';
                            break;*/

                            /*case 'Notificaciones':
                            include_once './mensajes.php';
                            break;*/

                        case 'Excel':
                            include_once './empresa/reporte-excel.php';
                            break;

                        case 'Parametros':
                            include_once './empresa/parametros.php';
                            break;

                        case 'Excel':
                            include_once './empresa/reporte-excel.php';
                            break;
        
                        case 'detalle_piscina_insumos':
                            include_once './empresa/trazabilidad-piscinas.php';
                            break;

                        case 'nuevo_proveedor':
                            include_once './empresa/nuevo_proveedor.php';
                        break;

                        case 'nuevo_producto':
                            include_once './empresa/nuevo_producto.php';
                        break;

                        case 'ingreso_insumos':
                            include_once './empresa/ingreso_insumos.php';
                        break;

                        case 'egreso_insumos':
                            include_once './empresa/egreso_insumos.php';
                        break;

                        case 'stock_insumos':
                            include_once './empresa/stock_insumos.php';
                        break;

                        case 'pw-resumen-general':
                            include_once './powerBi/pw-resumen-general.php';
                        break;

                        case 'pw-alimento-diario':
                            include_once './powerBi/pw-alimento-diario.php';
                        break;

                        case 'pw-resumen-principal':
                            include_once './powerBi/pw-resumen-principal.php';
                        break;

                        case 'solicitud-precria':
                            include_once './empresa/nueva-solicitud-biologo-precria.php';
                        break;

                        case 'solicitud-engorde':
                            include_once './empresa/nueva-solicitud-biologo-engorde.php';
                        break;

                        case 'Histograma':
                            include_once './empresa/histograma.php';
                        break;

                        case 'sugerido':
                            include_once './empresa/test.php';
                        break;

                        case 'gestion-pesca':
                            include_once './empresa/gestion-de-pesca.php';
                        break;

                        case 'detalle-gestion-pesca':
                            include_once './empresa/gestion-de-pesca-detalle.php';
                        break;

                        case 'facturado-gestion-pesca':
                            include_once './empresa/gestion-de-pesca-factura.php';
                        break;

                        case 'detalle_piscina.php':
                            $piscina = $_GET['piscina'] ?? null;
                            include_once './empresa/detalle_piscina.php';
                        break;

                        case 'Ingreso_seguridad':
                            include_once './empresa/ingreso_seguridad.php';
                        break;

                        case 'parametros-presupuesto':
                            include_once './empresa/parametros_presupuesto.php';
                        break;

                        default:

                            if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5 || $camaronera == 6) {
                                include_once './empresa/tabla-alimentacion.php';
                            } else {
                                echo 'error en el servidor ... :(';
                            }

                            break;
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>
</body>

</html>
<?php }
curl_close($curl);
?>

