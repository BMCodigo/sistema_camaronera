<?php

date_default_timezone_set("America/Lima");
$fechaActual = date('Y-m-d');
$objeto = new corrida();

?>
<div class="modal fade bd-example-modal-lg<?php echo $id; ?>" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">PRECIO DE VENTA DE RALEO Y PESCA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span> 
                </button>
            </div>

            
            <div class="modal-body"><div class="alert alert-success" role="alert">
                <strong>
                    <?php  if($camaronera == 1){ echo 'Camaronera: Darsacom';}else if($camaronera == 2){ echo 'Camaronera: Aquacamaron'; }else if($camaronera == 3){ echo 'Camaronera: Jopisa';}else{ echo 'Camaronera: Aquanatura'; }  ?>
                    <?php  echo '</br> Piscina: '.$psc; ?>
                </strong>    
            </div>
                <form class="container" action="../controllers/insert-precio-venta-pesca.php" method="post">

                    <?php 
                        $sql="SELECT 
                            DISTINCT t1.psc as psc, t1.mysql, t1.id, t1.ha, t1.anim_semb, t1.pesoSiembra, t1.talla, t1.talla2, t1.dias, t1.pesoActual, t1.grDia, t1.raleo, t1.lbsHa, t1.fcv, t1.costoBalkgHa, t1.costoLarvaHa, t1.costoIndHaDia, 
                            t1.balaPorLibras, t1.larvaPorLibras,
                            t1.indPorLibras, t1.totalPorLibras, t1.vantalibra, t1.librasprimeratalla, t1.costoRealDolares, t1.diferencia, t1.porcentajet, t1.librassegundatalla, t1.porcentaje2, 
                            t2.id_camaronera, t2.id_piscina, t2.id_corrida, t2.peso_pesca, (SELECT t.libras_pescadas FROM registro_pesca_engorde t WHERE t.id_camaronera = t1.mysql AND t.id_piscina = t1.psc AND t.id_corrida = t1.id_corrida AND t.estado='Cosechado' ) AS pesca

                            FROM pyg_piscinas t1, registro_pesca_engorde t2
                            WHERE t1.mysql = '$buscar' AND t1.mysql = t2.id_camaronera AND t1.psc = t2.id_piscina AND t1.id_corrida = t2.id_corrida 
                            AND calculoFecha = (SELECT MAX(t.calculoFecha) FROM pyg_piscinas t WHERE t.mysql = t1.mysql AND t.psc = t1.psc AND t.id_corrida = t1.id_corrida) AND id = '$id'";
                            $data = $objeto->mostrar($sql);
                            foreach ($data as $val) {

                                $raleo = $val['raleo'];
                                $pesca = $val['pesca'];
                                $peso_pesca = $val['peso_pesca'];
                                $mysql = $val['mysql'];
                                $psc = $val['psc'];
                                $corrida = $val['id_corrida'];


                                $sqlPrecio="SELECT precio_raleo, precio_pesca FROM precio_venta_pesca WHERE id_camaronera = '$camaronera' AND id_piscina = '$psc' AND id_corrida = '$corrida'";
                                $dataPrecio = $objeto->mostrar($sqlPrecio);
                                foreach($dataPrecio as $p){
                                    $precioRaleo=$p['precio_raleo'];
                                    $precioPesca=$p['precio_pesca'];
                                }
                            }
                    ?>

                    <?php if($raleo > 0.00){ ?>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><strong>Libras Raleadas</strong></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-danger" id="inputPassword" name="librasRaleo"
                                placeholder="0.00" readonly value="<?php echo $raleo; ?>"
                                style="background: none; ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><strong>Precio de venta</strong></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword" name="precioRaleo"
                                placeholder="0.0" value="<?php echo $precioRaleo; ?>" step="0.01">
                        </div>
                    </div>

                    <?php } ?>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><strong>Libras pescadas</strong></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-danger" id="inputPassword" name="librasPesca"
                                placeholder="0.0" readonly value="<?php echo $pesca; ?>"
                                style="background: none; ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><strong>Peso de pesca</strong></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-primary" id="inputPassword"
                                readonly value="<?php echo $peso_pesca; ?>"
                                style="background: none; ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><strong>Precio de venta</strong></label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputPassword" name="precioPesca"
                                placeholder="0.0" value="<?php echo $precioPesca; ?>" step="0.01">
                            <input type="hidden" name="camaronera" readonly value="<?php echo $mysql; ?>">
                            <input type="hidden" name="piscina" readonly value="<?php echo $psc; ?>">
                            <input type="hidden" name="corrida" readonly value="<?php echo $corrida; ?>">
                        </div>
                    </div>
                    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <?php if($precioRaleo <= 0 && $precioPesca <= 0){?>
                <button type="submit" class="btn btn-success">Agregar datos</button>
                <?php } ?>
            </div>
            </form>
        </div>
    </div>
</div>