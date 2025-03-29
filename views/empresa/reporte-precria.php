<?php

$id = $_GET['id'];

$sqli = "SELECT * FROM calculo_datos WHERE identificacion = '$id'";
$data = $objeto->mostrar($sqli);

foreach ($data as $key) {

    $precria  = $key['precria'];
    $dias  = intval($key['numero_dias']);
    $siembra  = $key['siembra'];
    $hectareas  = $key['hectareas'];

    $sobrevivencia  = $key['sobrevivencia']; #campo agregado
    $ab_c  = $key['ab_c']; #campo agregado

    $peso_siembra  = $key['peso_siembra'];
    $mortalidad  = $key['mortalidad'];
    $cre_fase_uno  = $key['cre_fase_uno'];
    $cre_fase_dos  = $key['cre_fase_dos'];
    $cre_fase_tres  = $key['cre_fase_tres'];
    $sugerido  = $key['sugerido'];

    $subir  = $key['subir'];
    $id  = $key['identificacion'];
}

$in_m2 = floatval(($siembra / $hectareas) / 10000);

$sobrevivencia = $sobrevivencia / 100;

$porcentage = 0;

$array = array();
$array2 = array();
$array3 = array();
$array4 = array();
$array5 = array();
$array6 = array();
$array7 = array();

$sobrevivencia_aux = $sobrevivencia;

for ($i = 0; $i < $dias; ++$i) {

    if ($i == 0) {

        $ps_aux = $sobrevivencia_aux;

        array_push($array, $sobrevivencia_aux * 100);

        array_push($array2, ROUND($sobrevivencia_aux * $in_m2));

        array_push($array3, $ab_c);

        $num_aux = $ab_c * $in_m2 / 10;

        /////////////////////////////////////
        $n = $num_aux;
        $ent = floor($n);
        $dec = $n - $ent;
        if ($n % 5 >= 2 && $dec >= 0.5){
            array_push($array4, ceil(ROUND($num_aux) / 5) * 5);
        }else{
            array_push($array4, floor(ROUND($num_aux) / 5) * 5);
        }
        ////////////////////////////////////

        //array_push($array4, floor(ROUND($num_aux) / 5) * 5);

        array_push($array5, 1 / $peso_siembra);

        array_push($array6, $array2[$i] *  $array5[$i] * 10);

        array_push($array7, $array4[$i] * 100 /  $array6[$i]);

        $x += $array4[$i];
        
    } else {

        $sobrevivencia_aux = $ps_aux - $mortalidad;

        $ps_aux = $sobrevivencia_aux;

        array_push($array, round($sobrevivencia_aux * 100));

        array_push($array2, ROUND($sobrevivencia_aux * $in_m2));

        array_push($array3, $array3[$i - 1] + $subir);

        $num_aux = $array3[$i] * $array2[$i] / 10;

        /////////////////////////////////////
        $n = $num_aux;
        $ent = floor($n);
        $dec = $n - $ent;
        if ($n % 5 >= 2 && $dec >= 0.5){
            array_push($array4, ceil(ROUND($num_aux) / 5) * 5);
        }else{
            array_push($array4, floor(ROUND($num_aux) / 5) * 5);
        }
        ////////////////////////////////////

        //array_push($array4, floor(ROUND($num_aux) / 5) * 5); //

        array_push($array5, $array5[$i - 1] + $cre_fase_uno);

        array_push($array6, $array2[$i] *  $array5[$i] * 10);

        array_push($array7, $array4[$i] * 100 /  $array6[$i]);

        $x += $array4[$i];
    }
}

?>

<form action="../controllers/calcular-datos.php" method="post">
    <div class="ml-1">
        <?php
        if ($correo == 'deguiguren' || $correo == 'deguiguren' || $correo == 'bvalarezo') { ?>
            <button type="submit" class="btn btn-primary btn-sm">actualizar</button>
        <?php } ?>
        <a href="index.php?page=Reporte-precria" class="btn btn-danger btn-sm ml-1">Regresar</a>
    </div>
    <div class="row mt-3">

        <div class="table-sm col-3">
            <div class="row">
                <div class="col-12">
                    <div class="table table-sm table-responsive mb-4">
                        <table class="table table-sm table-hover table-bordered table-striped  align-items-center mb-0">
                            <thead>
                                <tr class="text-center" style="border: 2px solid #343a40">

                                    <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #343a40;">Descripcion
                                    </th>

                                    <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #343a40;">
                                        valor
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="table-sm">
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">Precria</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $precria; ?></span>
                                    </td>
                                </tr>

                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">Siembra</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo $siembra; ?></span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">Ha</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo floatval($hectareas); ?></span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">Dias</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><input type="number" class="inputs bg-warning text-dark" name="dias" value="<?php echo $dias; ?>"></span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">%sobrevivencia</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><input type="number" class="inputs bg-warning text-dark" step="any" name="sobrevivencia" value="<?php echo $sobrevivencia * 100; ?>"></span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">in/m2</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo intval($in_m2); ?></span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">AB c/100000</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><input type="number" class="inputs bg-warning text-dark" step="any" name="ab_c" value="<?php echo $ab_c; ?>"></span>
                                    </td>
                                </tr>

                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">Mortalidad diaria</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><input type="number" step="any" class="inputs bg-warning text-dark" name="mortalidad" value="<?php echo $mortalidad; ?>">
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">crecimiento calor 14
                                            d</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><input type="number" step="any" class="inputs bg-warning text-dark" name="cre_fase_uno" value="<?php echo $cre_fase_uno; ?>">
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">crecimiento calor 14-20
                                            d</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><input type="number" step="any" class="inputs bg-warning text-dark" name="cre_fase_dos" value="<?php echo $cre_fase_dos; ?>">
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">crecimiento calor 21-27
                                            d</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><input type="number" step="any" class="inputs bg-warning text-dark" name="cre_fase_tres" value="<?php echo $cre_fase_tres; ?>">
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">peso siembra</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php echo round($peso_siembra, 2); ?></span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">%</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><?php
                                                                                                echo $array[count($array) - 1];
                                                                                                ?>
                                        </span>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">biomasa (kg)</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php echo $fca = floatval(round($array6[count($array6) - 1])); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">AB piscina(kg)</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <input type="number" step="any" class="inputs text-dark text-center ml-3" name="x" value="<?php echo $x; ?>" style="background:none;">

                                        </span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">FCA</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            <?php echo floatval(round($fca / $x, 2)); ?>
                                        </span>
                                    </td>
                                </tr>
                                <tr style="border: 1px solid #40497C">
                                    <td class="align-middle" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold">subir</span>
                                    </td>
                                    <td class="align-middle text-center" style="border: 1px solid #40497C">
                                        <span class="text-secondary text-xs font-weight-bold"><input type="number" name="subir" class="inputs bg-warning text-dark" step="any" value="<?php echo $subir; ?>">
                                            <input type="hidden" name="id" value="<?php echo $id; ?>"></span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive table-sm col-9">
            <div class="row">
                <div class="col-12">
                    <div class="table table-sm table-responsive mb-4">
                        <table class="table table-sm table-hover table-bordered table-striped  align-items-center mb-0">
                            <thead>

                                <tr class="text-center" style="border: 2px solid #40497C">

                                    <th class="text-white text-xxs font-weight-bolder opacity-7"  style="background: #404e67; color:white;">Dias
                                    </th>

                                    <th class="text-white text-xxs font-weight-bolder opacity-7"  style="background: #404e67; color:white;">% Sob
                                    </th>

                                    <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67; color:white;">in/m2
                                    </th>

                                    <th class="text-center text-white text-xxs font-weight-bolder opacity-7"  style="background: #404e67; color:white;">Ab</br>c/1000000
                                    </th>

                                    <th class="text-center text-white text-xxs font-weight-bolder opacity-7"  style="background: #404e67; color:white;">Ab</br>Ps (kg)
                                    </th>

                                    <th class="text-center text-white text-xxs font-weight-bolder opacity-7"  style="background: #404e67; color:white;">Crecimiento
                                    </th>

                                    <th class="text-center text-white text-xxs font-weight-bolder opacity-7"  style="background: #404e67; color:white;">Biomasa</br>(kg)
                                    </th>

                                    <th class="text-center text-white text-xxs font-weight-bolder opacity-7"  style="background: #404e67; color:white;">Bw %
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < count($array); ++$i) {  ?>

                                    <tr style="border: 2px solid #40497C">
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"><?php echo $i + 1; ?></span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                echo $array[$i];
                                                ?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php

                                                echo intval($array2[$i]);
                                                ?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php

                                                echo ($array3[$i]);
                                                ?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                echo $array4[$i];
                                                ?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                echo $array5[$i];
                                                ?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                echo floatval(round($array6[$i]));
                                                ?>
                                            </span>
                                        </td>
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php
                                                echo floatval(round($array7[$i], 2));
                                                ?>
                                            </span>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php

$sql = "UPDATE `calculo_datos` SET sugerido = '$x', p_sobrevivencia = '".$array[count($array) - 1]."' WHERE identificacion = '$id'";
$objeto->mostrar($sql);

?>