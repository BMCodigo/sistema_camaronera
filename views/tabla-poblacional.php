<div class="container mt-5">

    <?php

    if($departamento == 'Gerencia' || $departamento == 'sistemas' || $departamento == 'Analisis de datos' || $departamento == 'Biologo general'){
        #dashboard poblacional-general-admin
        echo '<iframe title="poblacion - poblacional" class="iframe"  src="https://app.powerbi.com/view?r=eyJrIjoiM2UzYWQ3ODQtNTJhMi00NDVhLThhMzMtNWY4OTZjYzcwN2VlIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';
    }else{
                            
        if ($camaronera == 1) {

            #dashboard poblacion-darsacom
            echo '<iframe title="poblacion_darsacom - poblacional" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiMDNjZDQzOWMtZWY0OS00NTc2LWJiZGEtZWVlY2RhOGI1YTAxIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        } else if ($camaronera == 2) {

            #dashboard poblacion-aquacamaron
            echo '<iframe title="poblacion_aquacamaron - poblacional" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiZDVjNzU5MTUtMjFjZi00ZDgxLThhYTItMjIwYTZjOGUzZmQyIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        } else if ($camaronera == 3) {

            #dashboard poblacion-jopisa            
            echo '<iframe title="poblacion_jopisa - poblacional" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNTcxYjRkMmYtMzE3Yy00OThjLTgxZWQtYzM0OGNhYjFlNmEwIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        } else if($camaronera == 4) {
            
            echo '<iframe title="poblacion_aquanatura - poblacional" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNDEyYTdkOGEtZDFjOS00ZmI3LWJhY2YtMWJmMjQxMTBhMTY5IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        }else if($camaronera == 5) {
            
            echo '<iframe title="poblacion_aquanatura - poblacional" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNDEyYTdkOGEtZDFjOS00ZmI3LWJhY2YtMWJmMjQxMTBhMTY5IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        }else if($camaronera == 6) {
            
            echo '<iframe title="poblacion_aquanatura - poblacional" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNDEyYTdkOGEtZDFjOS00ZmI3LWJhY2YtMWJmMjQxMTBhMTY5IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        }else{
    
            echo 'error en el servidor ... =(';

        }
    }

    ?>
</div>