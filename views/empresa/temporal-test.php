
                                    <?php if ($camaronera != 1) { ?>

                                        <tr class="text-center">
                                            <?php

                                            $sql = "SELECT id_piscina FROM `registro_piscina_engorde` WHERE id_camaronera = '$camaronera' AND estado LIKE 'En proceso' AND id_piscina = 2";
                                            $data = $objeto->mostrar($sql);

                                            foreach ($data as $x) {
                                                $ps = $x['id_piscina'];
                                            }

                                            ?>
                                            <?php if ($ps == 2) { ?>
                                                <td>
                                                    <div class="container">
                                                        <input type="text" class="inputs text-center" name="piscina[]" id="piscina" readonly step="any" value="<?php echo $p2 = 2; ?>">
                                                        <?php

                                                        $sqli = "SELECT IF(count(id_corrida) > 0, id_corrida, 0) AS id_corrida FROM registro_piscina_engorde WHERE id_piscina = '$p2' AND estado LIKE 'En proceso' AND id_camaronera = '$camaronera'";
                                                        $data = $objeto_camaronera->mostrar($sqli);
                                                        foreach ($data as $value) {
                                                        ?>

                                                            <input type="hidden" name="corrida[]" value="<?php echo $value['id_corrida']; ?>">

                                                        <?php } ?>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">

                                                        <div class="row">
                                                            <div>
                                                                <i id="addDos" class="far fa-calendar-plus text-primary"></i>
                                                                
                                                                <select class="select" name="tipo_alimento[]">
                                                                    <?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="mt-1 mb-1">
                                                            <div class="row" id="alimento_2_2">
                                                                <div>
                                                                    <i id="deleteDos" class="fas fa-trash-alt text-danger"></i>
                                                                    <select class="select" name="tipo_alimento_2[]">
<?php
            
                                                                $sqli = "SELECT * FROM `tipo_alimento`";
                                                                $data = $objeto->mostrar($sqli);
                                                                foreach ($data as $value) {
                                                                ?>
            
                                                                    <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                                        <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                                    </option>
            
                                                                <?php } ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <input type="number" class="inputs text-center" name="cantidad[]" id="cantidad" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                        <div class="">
                                                            <input type="number" class="inputs text-center" name="cantidad_2[]" id="cantidad_2_2" step="any" value="0.0" onkeyup="saltar(event,'input2')">
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="container">
                                                        <div class=>
                                                            <select class="select" class="select" name="observacion[]" id="observacion">
                                                            <option class="text-center" value="S/N">Sin novedad</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Oxigenacion">Oxigenacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Muda">Muda</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Sobrante">Sobrante</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Raleo">Raleo</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Poblacion">Poblacion</option>
                                                            <option class="text-center" value="No se alimenta o se baja la dieta por Pesca">Pesca</option>
                                                        </select>
                                                        </div>

                                                    </div>
                                                </td>
                                            <?php } ?>
                                        </tr>

                                    <?php } ?>