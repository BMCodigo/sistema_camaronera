<?php
$objeto = new corrida();
$conectar = new Conexion();
$conexion = $conectar->conectar();
$thisquery = "SELECT x.id_balanceado, fecha_entrega, x.encargado, x.camaronera, x.id_piscina, x.id_corrida, x.tipo_balanceado, x.cantidad_balanceado 
FROM solicitud_balanceados x WHERE  x.id = 'Piscina'  AND camaronera = '$camaronera' AND x.id_balanceado = (SELECT y.id_balanceado FROM bitacora_balanceado y WHERE y.id_balanceado = x.id_balanceado LIMIT 1);";
$data = $conectar->mostrar($thisquery);
?>

<div class="row justify-content-center">
    <div class="container col-md-4">
        <div class="card">
            <div class="card-header text-white text-center" style="background: #404e67;">
               <b style="position:relative;left:128px;"> TRAZABILIDAD SOLICITUDES </b>
            </div>
            <div class="card-body">
                <form id="form-insert-run" onsubmit="return checker()" action="" method="post">
                    <div class="form-group">
                        <label for="fecha"><b>Fecha</label>
                        <select id="fecha" name="fecha" class="form-control">
                           <option value ="">  [Seleccione] </option>
                             
  <?php  $thisquery = "SELECT DISTINCT(fecha_entrega) FROM solicitud_balanceados x WHERE
  x.id = 'Piscina' AND camaronera = '$camaronera' AND x.id_balanceado = (SELECT y.id_balanceado FROM bitacora_balanceado y WHERE y.id_balanceado = x.id_balanceado LIMIT 1);";
$dataoption = $conectar->mostrar($thisquery);
  for ($x = 0; $x < count($dataoption); $x++) { ?>
     <option value="<?php echo $dataoption[$x]['fecha_entrega']; ?>">
              <?php echo $dataoption[$x]['fecha_entrega']; ?></option>
   <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="camaronera">Piscina</label>
                        <select id="camaronera" name="camaronera" class="form-control">
                           <option value ="">  [Seleccione] </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="piscina">Ciclo</label>
                        <select id="piscina" name="piscina" class="form-control">
                  <option value ="">  [Seleccione] </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="balanceado">Balanceado</b></label>
                        <select id="balanceado" name="balanceado" class="form-control">
                            <option value ="">  [Seleccione] </option>
                        </select>
                    </div><br>
                    <button type="submit" class="btn btn-primary">FILTRAR</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="table-responsive">
            <form id="main" class="container" action="../controllers/filers" method="post">
                <table class="table table-sm table-bordered">
                    <thead class="text-center">
                        <tr colspan="7"><h5><b style="position:relative;left:412px;">SOLICITUDES MODIFICADAS</b></h5></tr>
                        <tr>
                        <tr colspan="7"><h5><b style="position:relative;left:412px;">&nbsp;</b></h5></tr>
                        <tr>
                            <th class="text-white" style="background: #404e67;">Fecha</th>
                            <th class="text-white" style="background: #404e67;">Responsable</th>
                            <!--<th class="text-white" style="background: #404e67;">Camaronera</th>-->
                            <th class="text-white" style="background: #404e67;">Piscina</th>
                            <th class="text-white" style="background: #404e67;">Ciclo</th>
                            <th class="text-white" style="background: #404e67;">Balanceado</th>
                            <th class="text-white" style="background: #404e67;">Cantidad</th>
                            <th class="text-white" style="background: #404e67;">VER</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($x = 0; $x < count($data); $x++) { ?>
                            <tr>
                                <td><?php echo $data[$x]['fecha_entrega']; ?></td>
                                <td><?php echo $data[$x]['encargado']; ?></td>
                                <!--<td><?php echo $data[$x]['camaronera']; ?></td>-->
                                <td><?php echo $data[$x]['id_piscina']; ?></td>
                                <td><?php echo $data[$x]['id_corrida']; ?></td>
                                <td><?php echo $data[$x]['tipo_balanceado']; ?></td>
                                <td><?php echo $data[$x]['cantidad_balanceado']; ?></td>
                            <td><i class="fas fa-eye text-center" style="color:red;position:relative;left:32px;"></i> </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<?php echo $data[$x]['id_balanceado']; ?>
