<?php $objeto = new corrida(); ?>
<div class=" mt-5">
    <form id="main" action="../controllers/#" method="post">
            <span class="text-secondary text-xs font-weight-bold align-middle text-center">
            <table>   
            <tr>
            <td><input type="number" class="input2 form-control"   style="width:100%;" onfocus="myFunction(this)"></td>
            <td><button type="submit" class="btn btn-danger btn-sm mt-3 text-center" style="width:100%;" id="add-egres">Aplicar</button></td>
               </tr>
            </table>  
                        </span>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr class="text-center" style="border: solid 2px #343a40;">
                            <th style="background:orange; border: solid 2px #343a40; color:black;min-height:17px;margin:auto;" colspan="3"><b>BW ACELERADO</b></th>
                        </tr>
                        <tr class="text-center" style="border: solid 2px #343a40;">
                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Factor</th>
                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">BW</th>
                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                             <?php

                                $sql_piscina = "SELECT factor,	
                                bw_acelerado,	
                                rendimiento	
                                FROM `datos_conversion_1` ORDER BY factor DESC ;";
                                $data = $objeto->mostrar($sql_piscina);
                                $array = array();
                               
                                foreach ($data as $value) {
                                   
                                ?>
                                   <tr>
                            <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                <span class="text-secondary text-xs font-weight-bold">
                                    <?php echo $value['factor'] ?>
                                </span>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                <span class="text-secondary text-xs font-weight-bold">
                                     <?php echo $value['bw_acelerado'] ?>
                                </span>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                <span class="text-secondary text-xs font-weight-bold">
                                     <?php echo $value['rendimiento'] ?>
                                </span>
                            </td>
                               </tr>
                               <?php
                                    }
                                ?>
                      
                    </tbody>
                </table>
            </div>
            
            
            <div class="col-md-6">
                <table class="table table-sm table-striped">
                    <thead>
                        <tr class="text-center" style="border: solid 2px #343a40;">
                            <th style="background:orange; border: solid 2px #343a40; color:black;min-height:17px;margin:auto;" colspan="3"><b>BW 2</b></th>
                        </tr>
                        <tr class="text-center" style="border: solid 2px #343a40;">
                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Factor</th>
                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">BW</th>
                            <th style="background: #555557; border: solid 2px #343a40; color:white;min-height:17px;">Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                           <?php

                                $sql_piscina = "SELECT factor,	
                                bw_acelerado,	
                                rendimiento	
                                FROM `datos_conversion_1`;";
                                $data = $objeto->mostrar($sql_piscina);
                                $array = array();
                               
                                foreach ($data as $value) {
                                   
                                ?>
                                   <tr>
                            <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                <span class="text-secondary text-xs font-weight-bold">
                                    <?php echo $value['factor2'] ?>
                                </span>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid #40497C;">
                                <span class="text-secondary text-xs font-weight-bold">
                                     <?php echo $value['bw_acelerado2'] ?>
                                </span>
                            </td>
                            <td class="align-middle text-center" style="border: 1px solid #40497C;height:30.12px;">
                                <span class="text-secondary text-xs font-weight-bold">
                                     <?php echo $value['rendimiento2'] ?>
                                </span>
                            </td>
                               </tr>
                               <?php
                                    }
                                ?>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
