<?php

    if ($camaronera == 1 || $camaronera == 2 || $camaronera == 3 || $camaronera == 4 || $camaronera == 5) {

        include_once 'empresa/intermedio-muestreo.php';

    } else {

        echo 'error en el servidor ... =(';
    }

?>

<script>
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    });

    document.getElementById('fechaActualpoblacional').value = new Date().toDateInputValue();

    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    });

    document.getElementById('fechaActualmuestreo').value = new Date().toDateInputValue();
</script>