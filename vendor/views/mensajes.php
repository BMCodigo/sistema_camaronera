<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/fondo-login.jpg');">
        <span class="mask  bg-gradient-dark  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6 mb-4">
        <div class="row mb-5">
            <div class="row">
                <div class="col-12 col-xl-5">
                    <div class="card card-plain h-100">
                        <div class="notificacion card-header pb-0 p-3 opacity-9" style="background: #e8573a;">
                            <div class="row">
                                <div class="col-md-8 d-flex align-items-center">
                                    <h6 class="notificacion mb-0 text-white">Asignación de comentarios</h6>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <strong>
                                <p class="text-md text-dark">
                                    Selecciones la empresa a quien va dirigido el comentario.
                                </p>
                            </strong>
                            <form action="../controllers/insert-mensaje.php" method="post">
                            
                                <select class="form-control" name="camaronera" id="camaronera">
                                    <?php
                                    
                                        $objeto = new corrida();
                                        $sql = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $value) { ?>
                                            <option value="<?php echo $value['id_camaronera']; ?>">
                                                <?php echo $value['descripcion_camaronera']; ?>
                                            </option>
                                        <?php } ?>

                                </select>

                                <textarea id="" cols="40" rows="3" name="mensaje" class="form-control mt-3" id="" placeholder="Escriba comentario ..." required></textarea>

                                <input type="hidden" name="fechaActual" id="fecha">
                                <input type="hidden" name="usuario" value="<?php echo $correo; ?>">
                                <button type="submit" class="btn btn-success btn-sm mt-3 ml-1 float-right"> enviar comenatario </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-7">
                    <div class="card card-plain h-100">
                        <div class="sms card-header pb-0 p-3" style="background: #C70039;">
                            <h6 class="sms mb-0 text-white">Comentarios</h6>
                        </div>
                        <div class="card-body p-3">

                            <div class="container">

                                <ul class="list-group">
                                    <?php

                                    $objeto = new corrida();
                                    $sql = "SELECT mensaje, usuario, id_mensaje FROM mensajes WHERE id_camaronera = '$camaronera'";
                                    $data = $objeto->mostrar($sql);

                                    foreach ($data as $key) {$id=$key['id_mensaje'];
                                    $usuario = $key['usuario']; ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?php echo $key['mensaje'];
                                            if ($usuario == 'deguiguren') { ?>
                                                <span class="badge badge-info badge-pill"><?php echo $key['usuario']; ?></span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger badge-pill"><?php echo $key['usuario']; ?></span>
                                            <?php } ?>
  
                                        </li>
                                        
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="index.php?page=Mensaje&leido=leido" name="leido" class="btn btn-dark btn-sm mt-3 ml-1 float-right"> marcar como leido </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_GET['leido'])){

        $conectar = new Conexion();
        $conexion = $conectar->conectar();

        $id;
        $estado = 'Leido';
        
        $sql = "UPDATE `mensajes` SET `estado` = '$estado' WHERE id_camaronera = '$camaronera'";
        $query = mysqli_query( $conexion, $sql );  
        echo '
            <script>
                window.history.go(-1);
            </script>
        ';
    }

?>
<script>
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    });

    document.getElementById('fecha').value = new Date().toDateInputValue();
</script>