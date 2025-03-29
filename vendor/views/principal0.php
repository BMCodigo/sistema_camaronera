<?php 

    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    $objeto = new corrida();

    if(isset( $_POST['search'])){
       $buscar = $_POST['search'];
        //$proyeccion = 'david';
    }else{
       $buscar = $camaronera;
        //$proyeccion = 'david';
    }


?>

<div class="col-lg-12 col-md-12 mt-5">
    <div class="card">
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
            <?php if($roles == "superadmin"){ ?>

            <li class="nav-item">
                <a href="./index.php?page=Principal&d=<?php echo $departamento; ?>" class="nav-link text-white"
                    role="tab" aria-controls="pills-profile" aria-selected="false" style="background:#900C3F;">
                    <strong class="">Pyg 

                        <?php
                        

                            if(isset($_GET['e']) && $_GET['e'] == 1){ 

                                echo 'Darsacom'; 

                            }else if(isset($_GET['e']) && $_GET['e'] == 2){

                                echo 'Aquacamaron'; 

                            }else if(isset($_GET['e']) && $_GET['e'] == 3){ 

                                echo 'Jopisa'; 
                            
                            }else if(isset($_GET['e']) && $_GET['e'] == 4){ 

                                echo 'Aquanatura';

                            }else if(isset($_GET['e']) && $_GET['e'] == 5){ 

                                echo 'Grupo Camaron';

                            }else{ 
                                
                                if($buscar == 1){
                                    echo "Darsacom";   
                                }
                                else if ($buscar == 2){
                                    echo "Aquacamaron";
                                }
                                else if ($buscar == 3){
                                    echo "Jopisa" ;
                                }
                                else if ($buscar == 4){
                                    echo "Aquanatura";
                                }
                                  else if ($buscar == 5){
                                    echo "Grupo Camaron";
                                }
                            }
                        ?>
                    </strong>
                </a>
            </li>

            <li class="nav-item">
                <a href="./index.php?page=Pyg_pesca_final&d=<?php echo $departamento; ?>" class="nav-link"
                    role="tab" aria-controls="pills-profile" aria-selected="false" >
                    <strong class="">Pyg Pesca Final
                        <?php
                            if(isset($_GET['e']) && $_GET['e'] == 1){ 

                                echo 'Darsacom'; 

                            }else if(isset($_GET['e']) && $_GET['e'] == 2){

                                echo 'Aquacamaron'; 

                            }else if(isset($_GET['e']) && $_GET['e'] == 3){ 

                                echo 'Jopisa'; 
                                
                            }else if(isset($_GET['e']) && $_GET['e'] == 4){ 

                                echo 'Aquanatura';

                            }else if(isset($_GET['e']) && $_GET['e'] == 5){ 

                                echo 'Grupo Camaron';

                            }else{ 
                                
                                if($buscar == 1){
                                    echo "Darsacom";   
                                }
                                else if ($buscar == 2){
                                    echo "Aquacamaron";
                                }
                                else if ($buscar == 3){
                                    echo "Jopisa" ;
                                }
                                else if ($buscar == 4){
                                    echo "Aquanatura";
                                }
                                  else if ($buscar == 5){
                                    echo "Grupo Camaron";
                                }
                            }
                        ?>
                    </strong>
                </a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a href="./index.php?page=Acumulado-modelado&d=<?php echo $departamento; ?>" class="nav-link" role="tab"
                    aria-controls="pills-profile" aria-selected="false"><strong>Reporte de Produccion</strong></a>   
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="current-month" role="tabpanel"
                aria-labelledby="pills-timeline-tab">
                <div class="row">
                    <div class="col-md-12">
                        <div>

                            <!-- mostramos pyg para la gerencia -->
                            <?php if($roles == "superadmin"){ ?>
                                
                                <div class="d-flex bd-highlight"
                                    style="margin-left:43%; margin-top:20px;">
                                    <div class="bd-highlight">
                                        <form action="index.php?page=Principal" method="POST">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                
                                                    <select class="form-control" name="search" id="camaronera"
                                                        onchange="this.form.submit()">
                                                        <option value="<?php echo 'Seleccione' ?>">
                                                            <?php echo 'Seleccione camaronera'; ?>
                                                        </option>
                                                        <?php

                                                                $objeto_tabla_camaronera = new corrida();
                                                                $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera ";
                                                                $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);
                                                                
                                                        ?>

                                                        <?php foreach ($data as $value) { ?>
                                                        <option value="<?php echo $value['id_camaronera']; ?>">
                                                            <?php echo $value['descripcion_camaronera']; ?>
                                                        </option>

                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                
                                                <div class="container mt-5" style="margin-left:-33px;">
                                                <strong><p style="margin-top:25px; margin-left:60px; color:#900C3F;" id="proyect">Proyeccion <?php if(isset($_GET['proyeccionD'])){ echo 'David'; }else if(isset($_GET['proyeccionM'])){ echo 'Balanceado'; }else if(isset($_GET['proyeccionB'])){ echo 'Biologo'; }else{ echo 'David';} ?> </p></strong>
                                                
                                                    <a href="./index.php?page=Principal&d=<?php echo $departamento; ?>&e=<?php if(isset($_GET['e'])){ echo $buscar=$_GET['e']; }else{ echo $buscar;} ?>&proyeccionD=david" class="btn btn-outline-primary" onclick="david();"> David </a>
                                                    <a href="./index.php?page=Principal&d=<?php echo $departamento; ?>&e=<?php if(isset($_GET['e'])){ echo $buscar=$_GET['e']; }else{ echo $buscar;} ?>&proyeccionM=manuel" class="btn btn-outline-secondary" onclick="balanceado();"> Balanceado</a>
                                                    <a href="./index.php?page=Principal&d=<?php echo $departamento; ?>&e=<?php if(isset($_GET['e'])){ echo $buscar=$_GET['e']; }else{ echo $buscar;} ?>&proyeccionB=biologo" class="btn btn-outline-success" onclick="biologo();"> Biologo</a>
                                                </div>

                                                
                                            </div>

                                        </form>
                                    </div>
                                </div>

                                <div class="card-body" style="margin-top:-15px;">
                                    <div class="col-12 mt-5">
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <table class="table table-bordered table-sm table-hover" id="tabla">

                                                    <?php 

                                                        if(isset($_GET['proyeccionD']) == 'david'){

                                                            //echo 'proyect david';
                                                            $buscar=$_GET['e'];
                                                            $proyeccion=$_GET['proyeccionD'];
                                                            require_once './proyeccion.php'; 


                                                        }else if(isset($_GET['proyeccionM']) == 'manuel'){

                                                            //echo 'proyect balanceado';
                                                            $buscar=$_GET['e'];
                                                            $proyeccion=$_GET['proyeccionM'];
                                                            require_once './proyeccion.php'; 

                                                        }else if(isset($_GET['proyeccionB']) == 'biologo'){

                                                            //echo 'proyect biologo';
                                                            $buscar=$_GET['e'];
                                                            $proyeccion=$_GET['proyeccionB'];
                                                            require_once './proyeccion.php'; 

                                                        }else {

                                                            //echo 'proyect david';
                                                            $buscar;
                                                            $proyeccion='david';
                                                            require_once './proyeccion.php'; 

                                                        }

                                                        
                                                        /* promedios */
                                                            $promedio_ha = $promedio_ha / $total_promedio;
                                                            $promedio_anim_semb = $promedio_anim_semb / $total_promedio;
                                                            $promedio_pesoSiembra = $promedio_pesoSiembra / $total_promedio;
                                                            $promedio_dias = $promedio_dias / $total_promedio;
                                                            $promedio_pesoActual = $promedio_pesoActual / $total_promedio;
                                                            $promedio_grDia = $promedio_grDia / $total_promedio;
                                                            $promedio_raleo = $promedio_raleo / $total_promedio;
                                                            $promedio_lbsHa = $promedio_lbsHa / $total_promedio;
                                                            $promedio_fcv = $promedio_fcv / $total_promedio;
                                                            $promedio_costoBalkgHa = $promedio_costoBalkgHa / $total_promedio;
                                                            $promedio_costoLarvaHa = $promedio_costoLarvaHa / $total_promedio;
                                                            $promedio_costoIndHaDia = $promedio_costoIndHaDia / $total_promedio;
                                                            $promedio_balaPorLibras = $promedio_balaPorLibras / $total_promedio;
                                                            $promedio_larvaPorLibras = $promedio_larvaPorLibras / $total_promedio;
                                                            $promedio_indPorLibras = $promedio_indPorLibras / $total_promedio;
                                                            $promedio_librasprimeratalla = $promedio_librasprimeratalla / $total_promedio;
                                                            $promedio_librassegundatalla = $promedio_librassegundatalla / $total_promedio;
                                                            $promedio_totalPorLibras = $promedio_totalPorLibras / $total_promedio;
                                                            $promedio_venta = $promedio_venta / $total_promedio;
                                                            $promedio_rentabilidad = $promedio_rentabilidad / $total_promedio;
                                                        /* promedios */
                                                        
                                                    ?>

                                                    <th class="text-white mt-5" scope="col" style="background: #404e67; font-size:12px;">
                                                        Promedio
                                                    </th>

                                                    <div class="container">
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_ha,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php 

                                                                    $promedio_anim_semb;
                                                                    echo $promedio_anim_semb = number_format(str_replace(',', '.', $promedio_anim_semb),0);
                                                                ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_pesoSiembra,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_dias,0); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_pesoActual,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_grDia,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_raleo,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_lbsHa,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_fcv,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_costoBalkgHa,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_costoLarvaHa,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_costoIndHaDia,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_balaPorLibras,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_larvaPorLibras,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_indPorLibras,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_totalPorLibras,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_venta,2); ?>
                                                            </strong>
                                                        </td>
                                                        <td class="text-center text-white" style="background: #404e67;">
                                                            <strong>
                                                                <?php echo number_format($promedio_rentabilidad,2); ?>
                                                            </strong>
                                                        </td>
                                                    </div>
                                                     
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                 

                            <?php }else{ ?>
                            <!-- mostramos power bi solo para la camaronera y no para la gerencia -->

                                <div class="container">
                                    <?php 
                                    
                                        $roles;
                                        $ps = $_GET['ps'];
                                        $d= $_GET['d'];

                                        if($d == 'Gerencia' || $d == 'sistemas' || $d == 'Biologo general' || $d == 'Analisis de datos' || $d == 'Contabilidad'   ){
                            
                                            #echo '<iframe title="Version_final_general" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection7634d793dcdcc9d35d4d" frameborder="0" allowFullScreen="true"></iframe>';
                                                echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';

                                        }else if($d == 'Biologo general' && $roles == 'admin'){
                
                
                                            echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                
                                        }else{
                                                                
                                            if ($camaronera == 1 && $roles == 'admin') {
                                
                                                echo '<iframe title="Simulacion_Darsacom - Menu" class="iframe" 3.5" src="https://app.powerbi.com/view?r=eyJrIjoiMzEzYzNhZmMtMjY5ZC00ZjZmLTkxMDgtZmViNDhjMTlkOGFjIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                
                                            } else if ($camaronera == 2 && $roles == 'admin' && $d == 'Biologo general') {
                                                            
                                                //echo '<iframe title="Simulacion_Aquacamaron - Menu" class="iframe"= src="https://app.powerbi.com/view?r=eyJrIjoiNjBhMGFlOTEtY2IyNy00ZWM2LWI1ZGUtMmRhMmFiNTYwNzgyIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                                                echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                
                                            } else if ($camaronera == 2 && $roles == 'admin') {
                                                            
                                                echo '<iframe title="Simulacion_Aquacamaron - Menu" class="iframe"= src="https://app.powerbi.com/view?r=eyJrIjoiNjBhMGFlOTEtY2IyNy00ZWM2LWI1ZGUtMmRhMmFiNTYwNzgyIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                                                //echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                
                                            } else if ($camaronera == 3 && $roles == 'admin') {
                                                
                                                echo '<iframe title="Simulacion_Jopisa" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiODcwN2Y5M2QtMzNjMC00MzU1LWE4YmUtOWJhYzNiMjUxMWI5IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection7634d793dcdcc9d35d4d" frameborder="0" allowFullScreen="true"></iframe>';
                
                                            } else if($camaronera == 4 && $roles == 'admin') {
                                                
                                                echo '<iframe title="Simulacion_Aquanatura" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiMGFlMTBlMGItMzU0Yi00MWZjLWEyMTktZTUxNTczOTgyODE2IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection7634d793dcdcc9d35d4d" frameborder="0" allowFullScreen="true"></iframe>';
                
                
                                            } else if($camaronera == 5 && $roles == 'admin') {
                
                                             echo '<iframe title="Simulacion_Grupo_Camaron" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiN2U2YTJiZjYtMGExZi00NmIxLTliMjUtNjRiMTYyYjY2M2IyIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                  
                                            }else{
                
                                                echo 'Error en el servidor :(';
                                            }
                                        }

                                    ?>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

               


<script>
     var tabla = document.querySelector("#tabla");
     var datatabla = new DataTable(tabla);

   
</script>