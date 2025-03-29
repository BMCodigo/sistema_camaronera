<div class="row">
    <div class="col-6">

        <table class="table table-hover table-sm table-bordered">
            <thead style="backgroud:#dee2e6;" class="text-center">
                <tr>
                    <th scope="col" class="text-dark" style="height: 10px;">
                        <strong>Talla</strong>
                    </th>
                    <th scope="col" class="text-dark" style="height: 10px;">
                        <strong>Nvo valor</strong>
                    </th>

                </tr>
            </thead>
            <tbody class="text-center">

                <tr>
                    <th scope="row" style="height: 10px;">10.20</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0"  style="border:none;">
                        <input type="hidden" name="talla[]" value="10.20">
                    </th>
                </tr>
                <tr>
                    <th scope="row" style="height: 10px;">20.30</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0" style="border:none;">
                        <input type="hidden" name="talla[]" value="20.30">
                    </th>
                </tr>
                <tr>
                    <th scope="row" style="height: 10px;">30.40</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0" style="border:none;">
                        <input type="hidden" name="talla[]" value="30.40">
                    </th>
                </tr>
                <tr>
                    <th scope="row" style="height: 10px;">40.50</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0" style="border:none;">
                        <input type="hidden" name="talla[]" value="40.50">
                    </th>
                </tr>
                <tr>
                    <th scope="row" style="height: 10px;">50.60</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0" style="border:none;">
                        <input type="hidden" name="talla[]" value="50.60">
                    </th>
                </tr>
                <tr>
                    <th scope="row" style="height: 10px;">60.70</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0" style="border:none;">
                        <input type="hidden" name="talla[]" value="60.70">
                    </th>
                </tr>
                <tr>
                    <th scope="row" style="height: 10px;">70.80</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0" style="border:none;">
                        <input type="hidden" name="talla[]" value="70.80">
                    </th>
                </tr>
                <tr>
                    <th scope="row" style="height: 10px;">80.90</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0" style="border:none;">
                        <input type="hidden" name="talla[]" value="80.90">
                    </th>
                </tr>
                <tr>
                    <th scope="row" style="height: 10px;">100.120</th>
                    <th scope="row" style="height: 10px;">
                        <input type="number" name="nvo_valor[]" step="0.01" inputmode="decimal" class="input text-center" placeholder="0.0" style="border:none;">
                        <input type="hidden" name="talla[]" value="100.120">
                        <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                    </th>
                </tr>

            </tbody>
        </table>

        <div class="container"  style="border:none; margin-left:130px;">
            <center>
                <button type="submit" name="valor" class="btn btn-success btn-sm">Ingresar precio de venta</button>
            </center>
        </div>

    </div>

    <div class="col-6">

        <table class="table table-hover table-sm table-bordered">
            <thead style="backgroud:#dee2e6;" class="text-center">
                <tr>
                    <th scope="col" class="text-dark" style="height: 10px;">
                        <strong>Talla</strong>
                    </th>
                    <th scope="col" class="text-dark" style="height: 10px;">
                        <strong>Valor $/.</strong>
                    </th>
                </tr>
            </thead>
            <tbody class="text-center">
            <?php 
                $tablatalla = "SELECT talla, precio_referencia FROM precio_talla_camaron WHERE
                 fecha_registro = (SELECT MAX(fecha_registro) FROM precio_talla_camaron ) LIMIT 9"; 
                $data = $objeto->mostrar($tablatalla);

                foreach ($data as $a) {
                    $talla=$a['talla'];
            ?>
                <tr>
                    <th class="mt-5"><?php echo $talla; ?></th>
                    <td> <input type="text" class="input text-center" readonly value=" <?php echo $a['precio_referencia']; ?>" style="border:none;"></td>

                </tr>

            <?php } ?>

            </tbody>
        </table>

    </div>
</div>