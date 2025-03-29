<?php

    error_reporting(0);
    $origen_pre = $_POST['origen_pre'].'</br>';
    $origen_psc = $_POST['origen_psc'].'</br>';

    /*if($origen_psc > 0 && $origen_pre > 0){
        ?>
            <script>
                alert(' ¡ No puede registrar dos siembras !');
                window.history.go(-1);
            </script>
        <?php
    }else*/ if($origen_pre > 0){
        include_once './insert-precria.php';
    }else if($origen_psc > 0){
        include_once './insert-engorde.php';
    }else{
        ?>
            <script>
                alert(' ¡ Seleccione precria !');
                window.history.go(-1);
            </script>
        <?php
    }

?>
