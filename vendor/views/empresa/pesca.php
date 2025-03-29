<div class="row">

    <div class="container col-md-6">
        <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;">PESCA DE PISCINA</h6>
            </div>
            <div class="card-body">
                <div class="mb-20">
                    <form id="form-insert-run" onsubmit="return pesca()"
                        action="../controllers/insert-pesca-engorde.php" method="post">

                        <div class="col-md-12">
                            <div class="">
                               
                                <div class="container" id='micropesca' style='display:block;'>
                                 <b> Registrar raleo ?</b>
                                    <button type="button" id="yes" style="background-color:#00000;" onclick="si()"
                                        class="btn btn-dark text-white btn-sm">Si</button>
                                    <button type="button" id="not" style="background-color:#00000;" onclick="no()"
                                        class="btn btn-dark text-white btn-sm">No</button>

                                    <div class="alert alert-success mt-3" role="alert" id="alerta">
                                          El raleo es un afloje parcial de una piscina
                                        <input type="hidden" name="raleo" class="text-white" step="any" id="raleo"
                                            style="border: none; background: none;" value="Cosecha">
                                    </div>
                                </div>
                                
                                <div class="container" id="pesca" style="display:none;color:red;">
                                     <b> Liquidar Pesca ?</b>
                                    <button type="button" id="liq" style="display:;" onclick="liquidar()"
                                        class="btn btn-dark text-white btn-sm">Si</button>
                                    <button type="button" id="acu" style="display:;" onclick="acumular()"
                                        class="btn btn-dark text-white btn-sm">No</button>
                                    <div class="alert alert-warning mt-3" role="alert" id="alerta2">
                                        <b> Liquidar pesca da por finalizada la corrida actual</b> 
                                        <input type="hidden" name="liquidacion" class="text-white" step="any" id="liquidacion"
                                            style="border: none; background: none;" value="parcial">
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="row mt-2">
                            <label class="col-sm-4 col-lg-5 col-form-label">Camaronera</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="camaronera" id="camaronera">
                                        <?php

                                        $objeto_tabla_camaronera = new corrida();
                                        $sql_tabla_camaronera = "SELECT id_camaronera , descripcion_camaronera FROM camaronera WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_camaronera->mostrar($sql_tabla_camaronera);

                                        foreach ($data as $value) {
                                        ?>
                                        <option value="<?php echo $value['id_camaronera']; ?>">
                                            <?php echo $value['descripcion_camaronera']; ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Fecha de pesca</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="date" class="form-control" name="fechaActual" id="fechaActualpesca">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Seleccione piscina</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="piscina" id="piscina">
                                          <option value="0">
                                            [Seleccione Piscina]
                                        </option>
                                        <?php

                                        $objeto_tabla_piscina = new corrida();
                                        $sql_tabla_piscina = "SELECT piscinas, descripcion_piscina FROM piscina WHERE id_camaronera = '$camaronera'";
                                        $data = $objeto_tabla_piscina->mostrar($sql_tabla_piscina);

                                        foreach ($data as $value) {
                                        ?>
                                        <option value="<?php echo $value['piscinas']; ?>">
                                            <?php echo $value['descripcion_piscina']; ?>
                                        </option>

                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Libras pescadas por Ha</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" name="libras" step="any" id="libras"
                                        value="1000">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Peso de pesca</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" step="any" name="peso_pesca"
                                        id="peso_pesca" value="1.00">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">% Renimiento</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <input type="number" class="form-control" step="any" name="rendimiento"
                                        id="rendimiento" value="0.0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-sm-4 col-lg-5 col-form-label">Cliente</label>
                            <div class="col-sm-8 col-lg-7">
                                <div class="input-group">
                                    <select class="form-control" name="cliente" id="cliente">
                                        <?php

                                        $objeto = new corrida();
                                        $sql = "SELECT id_cliente, descripcion_cliente FROM empacadora";
                                        $data = $objeto->mostrar($sql);

                                        foreach ($data as $value) {
                                        ?>
                                        <option value="<?php echo $value['id_cliente']; ?>">
                                            <?php echo $value['descripcion_cliente']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name="fase" value="<?php echo $ps; ?>">
                                    <input type="hidden" name="user" value="<?php echo $id_usuario; ?>">
                                </div>
                            </div>
                        </div>
                        <center><button class="btn btn-danger btn-sm text-light mt-3" id="sender" style="display:none;" type="submit" onclick="fechar()">guardar datos de
                                pesca</button></center>
                    </form>
                </div>
            </div>
        </div>





    </div>
                <div class="col-6">
               <?php $sqli = "
                SELECT 
                id_camaronera,
                    fecha_pesca,
                        id_piscina,
                            libras_pescadas,
                                peso_pesca,
                            rendimiento,
                        id_cliente AS id_clientes,estado,
                    (SELECT descripcion_cliente FROM empacadora WHERE id_cliente = id_clientes) AS cliente
                FROM registro_pesca_engorde WHERE id_camaronera =  '$camaronera' ORDER BY fecha_pesca DESC LIMIT 15;
                ";
                
                
               $sqli = " SELECT 
                x.id_camaronera,
                    x.fecha_pesca,
                        x.id_piscina,
                            x.libras_pescadas,
                                x.peso_pesca,
                            x.rendimiento,
                        x.id_cliente AS id_clientes,
                        x.estado,
                        x.id_corrida,
                    (SELECT descripcion_cliente FROM empacadora WHERE id_cliente = id_clientes) AS cliente
                FROM registro_pesca_engorde x WHERE x.id_camaronera =  '$camaronera'
                AND x.id_corrida = (select MAX(y.id_corrida) FROM registro_pesca_engorde y WHERE y.id_camaronera = x.id_camaronera and y.id_piscina = x.id_piscina) 
            ORDER BY `x`.`id_piscina` ASC,`x`.`fecha_pesca` DESC;
                 "; 
                 $sqli = "
                SELECT * 
FROM (
    SELECT 
        x.id_pesca,
        x.id_camaronera,
        x.fecha_pesca,
        x.id_piscina,
        x.libras_pescadas,
        x.peso_pesca,
        x.rendimiento,
        x.id_cliente AS id_clientes,
        x.estado,
        x.id_corrida,
        (SELECT descripcion_cliente 
         FROM empacadora 
         WHERE id_cliente = x.id_cliente) AS cliente
    FROM registro_pesca_engorde x 
    WHERE x.id_camaronera = '$camaronera'
      AND x.id_corrida = (SELECT MAX(y.id_corrida) 
                          FROM registro_pesca_engorde y 
                          WHERE y.id_camaronera = x.id_camaronera 
                            AND y.id_piscina = x.id_piscina)
                           -- AND x.estado != 'Cosechado'
    UNION ALL
    SELECT 
        z.id_pesca,
        z.id_camaronera,
        z.fecha_pesca,
        z.id_piscina,
        z.libras_pescadas,
        z.peso_pesca,
        z.rendimiento,
        z.id_cliente AS id_clientes,
        z.estado,
        z.id_corrida,
        (SELECT descripcion_cliente 
         FROM empacadora 
         WHERE id_cliente = z.id_cliente) AS cliente
    FROM registro_pesca_detalle z
    WHERE z.id_camaronera = '$camaronera'
      AND z.id_corrida = (SELECT MAX(y.id_corrida) 
                          FROM registro_piscina_engorde y 
                          WHERE y.id_camaronera = z.id_camaronera 
                            AND y.id_piscina = z.id_piscina)
) subquery
ORDER BY subquery.id_piscina ASC, subquery.fecha_pesca DESC, subquery.id_pesca DESC ; 
                ";  $pescas = $objeto->mostrar($sqli);
                    ?>

                                      
                                       
                      <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2" style="width:712px;">
                          
                        <thead>
                                                                <tr class="text-white text-center">
                                        <th colspan="7" class="bg-dark" style="height:48px;">
                                            <span class="text-white"> <br> RALEOS Y PESCAS<br> </span>
                                        </th>
                                    </tr>
                           
                            <tr class="text-center">
                                 
                                 <!--<th class="text-center text-white" style="background: #404e67;">
                                    Saldo en sacos
                                </th>-->
                                 <th class="text-center text-white" style="background: #404e67;">
                                    Fecha
                                </th>
                                 <th class="text-center text-white" style="background: #404e67;">
                                    Piscina
                                </th>
                                  <th class="text-center text-white" style="background: #404e67;display:;">
                                    libras
                                </th>
                                <th class="text-center text-white" style="background: #404e67;display:;">
                                    peso
                                </th>
                                <th class="text-center text-white" style="background: #404e67;display:;">
                                    rendimiento
                                </th>
                                <th class="text-center text-white" style="background: #404e67;display:;">
                                    cliente
                                </th>
                                <th class="text-center text-white" style="background: #404e67;display:;">
                                    Tipo Pesca
                                </th>
                            </tr>
                        </thead>
                          <tbody>
                                       <?php  foreach ($pescas as $pesca) { 
                                       $iter=2;
                                       ?>
                                       
                                    <tr>
                                            <?php    if ($pesca['id_piscina']%2==0 OR ($pesca['id_piscina']== 1 AND $pesca['id_camaronera']== 1) ){ ?>
                                        
                                        <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                 <?php  echo $pesca['fecha_pesca']; ?>
                                                </span>
                                        </td>
                                          <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php  echo 'totalkilos[]'.$descripcion_alimento; ?>">
                                     <?php  echo $pesca['id_piscina']; ?>
                                                </span>
                                        </td>
                                          <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php  echo 'totalkilos[]'.$descripcion_alimento; ?>">
                                     <?php  echo $pesca['libras_pescadas']; ?>
                                                </span>
                                        </td>
                                        
                                         <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $pesca['peso_pesca']; ?>
                                                </span>
                                        </td> 
                                        
                                        
                                        
                                        <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $pesca['rendimiento']; ?>
                                                </span>
                                        </td>
                                        
                                                     <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $pesca['cliente']; ?>
                                                </span>
                                        </td>
                                          <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $pesca['estado']; ?>
                                                </span>
                                        </td>
                                           <?php } else { ?>
                                           
                                                       
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                 <?php  echo $pesca['fecha_pesca']; ?>
                                                </span>
                                        </td>
                                          <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php  echo 'totalkilos[]'.$descripcion_alimento; ?>">
                                     <?php  echo $pesca['id_piscina']; ?>
                                                </span>
                                        </td>
                                          <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php  echo 'totalkilos[]'.$descripcion_alimento; ?>">
                                     <?php  echo $pesca['libras_pescadas']; ?>
                                                </span>
                                        </td>
                                        
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $pesca['peso_pesca']; ?>
                                                </span>
                                        </td> 
                                        
                                        
                                        
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $pesca['rendimiento']; ?>
                                                </span>
                                        </td>
                                        
                                                     <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $pesca['cliente']; ?>
                                                </span>
                                        </td>
                                          <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo $pesca['estado']; ?>
                                                </span>
                                        </td> <?php }  ?>
                                    </tr>
                                      <?php }  ?>
                             <tbody>
                       </table>
                       
                         </form>
                </div>
</div>
<script>
function pesca() {
    var smspre = document.getElementById("fechaActualpesca").value != "" && document.getElementById("piscina").value != 0;
    var smspre2 = document.getElementById("piscina").value != 0;
    if (smspre) {
        return true;
    } else {
        return false;
    }
}


document.getElementById("raleo").style.display = "none";
document.getElementById("alerta").style.display = "block";

function si() {

    document.getElementById("raleo").style.display = "block";
    document.getElementById("alerta").style.display = "none";
    document.getElementById("raleo").value = "Raleo";
    document.getElementById("pesca").style.display = "none";
    document.getElementById("micropesca").style.display = "block";
    document.getElementById("yes").style.backgroundColor = "red";
    document.getElementById("sender").style.display = "block";
       alert( document.getElementById("raleo").value);
}

function no() {

    document.getElementById("raleo").style.display = "none";
    document.getElementById("alerta").style.display = "none";
    document.getElementById("raleo").value = "Cosecha";
    document.getElementById("liquidacion").value = "parcial";
    document.getElementById("pesca").style.display = "block";
    document.getElementById("micropesca").style.display = "none";
    document.getElementById("not").style.backgroundColor = "block";
    document.getElementById("sender").style.display = "none";
     alert( document.getElementById("raleo").value);
}

function liquidar() {
 document.getElementById("liq").style.backgroundColor = "red";
 document.getElementById("acu").style.display = "none";
 document.getElementById("liquidacion").value = "final";
     document.getElementById("sender").style.display = "block";
  alert( document.getElementById("liquidacion").value);
}
function acumular() {
 document.getElementById("liq").style.display = "none";
 document.getElementById("acu").style.backgroundColor = "red";
  document.getElementById("liquidacion").value = "parcial";
      document.getElementById("sender").style.display = "block";
      document.getElementById("alerta2").innerText = "INGRESAR PESCA PARCIAL:";
   alert( document.getElementById("liquidacion").value);
 
}

function fechar(){
if (document.getElementById("fechaActualpesca").value == "" || 
    document.getElementById("piscina").value == 0
){
    alert('Debe elegir fecha de pesca y piscina!!!');
}    
}
</script>