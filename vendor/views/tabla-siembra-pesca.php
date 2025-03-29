<div class="container mt-5">

    <?php

    if($departamento == 'Gerencia' || $departamento == 'sistemas' || $departamento == 'Analisis de datos' || $departamento == 'Biologo general'){
        #dashboard siembra-pesca-general-admin
        echo '<iframe title="siembra-piscina - pesca de piscina" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiOGZiOTUwYmMtM2I5My00MDEyLTk5NTMtYThmN2E2NmMwZWQ4IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

    }else{
                            
        if ($camaronera == 1) {

            #dashboard siembra-pesca-darsacom
            echo '<iframe title="siembra-piscina-darsacom - siembra de piscina"  class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNTE0NGMzZmQtOTFlZC00MzQ0LThmYTktZThjZTEyYmM2MGVlIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        } else if ($camaronera == 2) {

            #dashboard siembra-pesca-aquacamaron
            echo '<iframe title="siembra-piscina-aquacamaron - siembra de piscina" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNTkyN2VmZjEtMjQzZS00ODMxLTgwOTEtNmU2MjJmYjc0ZmM0IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        } else if ($camaronera == 3) {

            #dashboard siembra-pesca-jopisa
            echo '<iframe title="siembra-piscina-jopisa - siembra de piscina" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiMzRhOTc0Y2MtNDIzYi00Y2FiLWIzZTAtYjJlZjlmYzdlYTQzIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

        } else {
            echo 'error en el servidor ... =(';
        }
    }

    ?>
</div>