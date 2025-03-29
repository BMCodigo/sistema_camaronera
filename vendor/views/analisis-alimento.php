<div class="container mt-5">

    <?php

        $ps = $_GET['ps'];
        $d= $_GET['d'];

    if($d == 'Gerencia' || $d == 'sistemas' || $d == 'Biologo general' || $d == 'Analisis de datos'){
        
        echo '<iframe title="Manuel Tabla" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiNGU0ZjI3NWItYTZkOS00OGI3LThjYjktMDRkZDUyOTZhZjcxIiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9&pageName=ReportSectiondff9f0a0565a35230607" frameborder="0" allowFullScreen="true"></iframe>';
            
    }else{

        echo 'Error en el servidor :(';
    }

    ?>
</div>