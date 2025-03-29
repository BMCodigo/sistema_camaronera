<div class="container mt-5">

    <?php

        $ps = $_GET['ps'];
        $d= $_GET['d'];

    if($d == 'Gerencia' || $d == 'sistemas' || $d == 'Contabilidad' || $d == 'Logisitca' || $d == 'Analisis de datos' || $d == 'Biologo general'){
        
        echo '<iframe title="alimentacion_pisicnas_precrias_pescadas - Historial de alimentacion" class="iframe" src="https://app.powerbi.com/view?r=eyJrIjoiN2ZkMDZlODMtOTgwYi00ODljLWFkZTAtNTBmNzQ1YjdlNjE2IiwidCI6IjZlMTI3MmVlLTBhZTUtNDEyZS1hNTQ0LTZlMTEyMTk2MjQzMyJ9" frameborder="0" allowFullScreen="true"></iframe>';

    }else{
                            
        echo 'error en el servidor ... =(';

    }

    ?>
</div>