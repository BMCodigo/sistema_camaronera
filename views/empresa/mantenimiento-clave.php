               <div class="row" style="margin:auto;" id="mortalidad">
                   <br><br>
                     <?php 
                                     $_SESSION['llc']=$camaronera;
                                        if ($camaronera == 1) {

                                         //   echo '<h6>  <strong style="color:red;">Darsacom</strong></h6><br>';
                                            
                                        } else if ($camaronera == 2) {

                                      
                                        //    echo '<h6> <strong style="color:red;">Aquacamaron</strong></h6><br>';
                                            
                                        } else if ($camaronera == 3) {

                                          
                                       //     echo '<h6>  <strong style="color:red;">Jopisa</strong></h6><br>';

                                        } else if ($camaronera == 4) {

                                      
                                      //      echo '<h6> <strong style="color:red;">Aquanatura</strong></h6><br>';

                                        } else if ($camaronera == 5) {

                    
                                      //      echo '<h6>  <strong style="color:red;">Grupo Camaron</strong></h6><br>';

                                        } else if ($camaronera == 6) {

                    
                                      //      echo '<h6>  <strong style="color:red;">Calica</strong></h6><br>';

                                        } else {

                                            echo 'error en el servidor =(';
                                        }
                                    ?> <br><br>
            <div class="col-4 justify-content-center"> 
                    <?php
                                        $objeto = new corrida();$thisuser = $_SESSION['id'];
                                        $sql_ = "Select id_usuario from usuarios WHERE id_usuario = '$thisuser';";
                                        $data = $objeto->mostrar($sql_);

                                        foreach ($data as $value) {
                                          ?>  
        <br><br> <br><br>
        <form action="../controllers/actualizar-mantenimiento.php" method="post" >
                <div class="form-group"><h6><strong style="color:red;"> CAMBIE SU CONTRASEÑA </strong></h6><br><br>
        <label><strong>INGRESAR NUEVA CLAVE</strong></label>
        <input type="text" style="height:57px;" class="form-control" id="registrobase1" name="registrobase1"  placeholder="**************" value="">
    </div><br><br>
    <div class="form-group">
        <label><strong>CONFIRMAR NUEVA CLAVE</strong></label>
        <input type="text" style="height:57px;" class="form-control" id="registrobase2" name="registrobase2"  placeholder="**************" value="">
    </div><br><br><br><br>
                      <input type="hidden" name="thisisuser" value="<?php echo $_SESSION['id']; ?>">
              <center>
        <button type="submit" style="height:57px;" class="btn btn-primary btn-sm">Actualizar</button>
    </center>
            </form>

<?php
                                     }
                                        ?>
</div></div>