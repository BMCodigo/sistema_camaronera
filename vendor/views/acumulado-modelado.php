<?php 

    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    $objeto = new corrida();

    $buscar = $camaronera;
    if($buscar == 1){
    $buscar_sql = 115;
    }else if($buscar == 2){
        $buscar_sql == 117;
    }else if($buscar == 3){
        $buscar_sql = 118;
    }else{
        $buscar_sql = 119;
    }

?>


<div class="col-lg-12 col-md-12">
    <div class="card">
        <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
        <?php if($roles == "superadmin"){ ?>

            <li class="nav-item">
                <a href="./index.php?page=Principal&d=<?php echo $departamento; ?>" class="nav-link" role="tab"
                    aria-controls="pills-profile" aria-selected="false"><strong class="">Pyg <?php 
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
                                    ?></strong></a>
            </li>
            <li class="nav-item">
                <a href="./index.php?page=Pyg_pesca_final&d=<?php echo $departamento; ?>" class="nav-link text-dark"
                    role="tab" aria-controls="pills-profile" aria-selected="false" style="background:white;">
                    <strong class="">Pyg Pesca Final
                        <?php
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
                        ?>
                    </strong>
                </a>
            </li>
            <li class="nav-item">
                <a href="./index.php?page=Acumulado-modelado&d=<?php echo $departamento; ?>" class="nav-link text-white"
                    role="tab" aria-controls="pills-profile" aria-selected="false"
                    style="background:#900C3F;">
                    <strong>
                        Reporte de produccion 
                        <?php 
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
                        ?>
                    </strong>
                </a>
            </li>
            <?php } ?>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="current-month" role="tabpanel"
                aria-labelledby="pills-timeline-tab">
                <div class="container">
                    <?php

                        $ps = $_GET['ps'];
                        $d= $_GET['d'];
                        $roles;

                        if($d == 'Gerencia' || $d == 'sistemas' || $d == 'Biologo general' || $d == 'Analisis de datos' || $d == 'Contabilidad'   ){
                            
                        if( $roles == 'superadmin'){
                               echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiYmQ5NzFmMjYtNzRiNC00N2FjLTgzZjYtOTA3MzlkYjczYzRiIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                            
                               //    echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/reportEmbed?reportId=ec6b1814-20a6-4ed4-81ed-2f3f4a88d700&autoAuth=true&ctid=6e1272ee-0ae5-412e-a544-6e1121962433" frameborder="0" allowFullScreen="true"></iframe>';
                            } else {
                                
                                
                          
                            
                            
                            #echo '<iframe title="Version_final_general" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection7634d793dcdcc9d35d4d" frameborder="0" allowFullScreen="true"></iframe>';
                              #  echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                                echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiYmQ5NzFmMjYtNzRiNC00N2FjLTgzZjYtOTA3MzlkYjczYzRiIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                            }
                        }else if($d == 'Biologo general' && $roles == 'admin'){
        
                           # echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                            echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiYmQ5NzFmMjYtNzRiNC00N2FjLTgzZjYtOTA3MzlkYjczYzRiIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';

                        }else{
                                                
                            if ($camaronera == 1 && $roles == 'admin') {
                                
                                echo '<iframe title="Simulacion_Darsacom - Menu" class="iframe" 3.5" src="https://app.powerbi.com/view?r=eyJrIjoiOWQ5YmY0OGItMzY0Mi00MTJlLTlkYjAtMWU2NWJjZGYxNTg5IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

                            } else if ($camaronera == 2 && $roles == 'admin' && $d == 'Biologo general') {
                                            
                                //echo '<iframe title="Simulacion_Aquacamaron - Menu" class="iframe"= src="https://app.powerbi.com/view?r=eyJrIjoiNjBhMGFlOTEtY2IyNy00ZWM2LWI1ZGUtMmRhMmFiNTYwNzgyIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                             #  echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';
                                echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiYmQ5NzFmMjYtNzRiNC00N2FjLTgzZjYtOTA3MzlkYjczYzRiIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';

                            } else if ($camaronera == 2 && $roles == 'admin') {
                                            
                                echo '<iframe title="Simulacion_Aquacamaron - Menu" class="iframe"= src="https://app.powerbi.com/view?r=eyJrIjoiOTlmMzE3ZjctZGZmYS00NjM2LWIyZTUtZTU5N2JkYjQzMTk0IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
                                //echo '<iframe title="Version_final_general" class="iframe"src="https://app.powerbi.com/view?r=eyJrIjoiMGIzNDhiMDMtMWQ3YS00ODg2LWFmOGMtZjk3NzI2MWNiOGUzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection57060c1b4330c80a0eb2" frameborder="0" allowFullScreen="true"></iframe>';

                            } else if ($camaronera == 3 && $roles == 'admin') {
                                
                                //echo '<iframe title="Simulacion_Jopisa" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiODcwN2Y5M2QtMzNjMC00MzU1LWE4YmUtOWJhYzNiMjUxMWI5IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSection7634d793dcdcc9d35d4d" frameborder="0" allowFullScreen="true"></iframe>';
                                
                                echo '<iframe title="Simulacion_Jopisa" class="iframe"  src="https://app.powerbi.com/view?r=eyJrIjoiYmY4ZjBhMjQtMGFkNy00ZjNmLThhZmQtNmI3YjA5MGViMmYxIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

                            } else if($camaronera == 4 && $roles == 'admin') {
                                
                                echo '<iframe title="Simulacion_Aquanatura" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNTgzYjJiNGUtZjc3My00MmJlLTkyYzAtMjViZjFhZGY2MmJlIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

                            } else if($camaronera == 5 && $roles == 'admin') {
                                
                                echo '<iframe title="Simulacion_Grupo_Camaron" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiYTlkNjc0NGQtMTFhYi00ODg0LWE3NTYtYWJkN2FkZWEyNmNlIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

			                } else{

                                echo 'Error en el servidor :(';
                            }
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

