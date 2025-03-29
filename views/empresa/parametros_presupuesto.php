<?php 
    date_default_timezone_set('America/Guayaquil');
    // Inicializar objetos
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
   

?>
    

<div class="container">

    <div class="container d-flex justify-content-center align-items-center vh-100 mt-4">        
        <h5>Presupuesto para aprobacion camaronera <?php if ($camaronera == 1){ echo 'Darsacom'; }else if($camaronera == 2){ echo 'Aquacamaron'; }else if($camaronera == 3){ echo 'Jopisa'; }else{ echo 'Grupo Camaron'; }; ?></h5>
    </div>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <hr style="width: 900px; background:#404e67;">
    </div>

    <div class="d-flex justify-content-center align-items-center vh-100 mt-2" style="color:#404e67;"><strong>Simulacion de presupuesto y costo por hectarea dia</strong></div>

    <div class="container d-flex justify-content-center align-items-center vh-100 mt-3">
        <div class="row w-100 justify-content-center">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total presupuesto</h5>
                        <p class="card-text" id="totalPresupuesto">0.00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total costo hectárea día</h5>
                        <p class="card-text" id="presupuestoPorUnidad">0.00</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alert text-center mb-4" style="background: #404e67; color:white; width:700px; margin:auto;" role="alert">
        Formulario de registro
    </div>

    <form action="../controllers/insert-presupuesto-camaronera.php" method="post">

        <div class="container" style="width:350px;">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 100px;">Ha</span>
                </div>
                <input type="number" id="haInput" class="form-control" step="0.01" value="0.00" name="hectareas">
                </div>

                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="width: 100px;">Días</span>
                </div>
                <input type="number" id="diasInput" class="form-control" step="1" value="0.00" name="dias">
            </div>
        </div>

        <hr>
    
        <div class="row">   

            <div class="col-4">
            

                    <div class="d-flex justify-content-center align-items-center vh-100 mt-2 mb-3" style="color:#404e67;"><strong>Materia prima</strong></div>
                        <!-- Campos para Ha y Días -->
                    <hr class="mb-4">


                    <?php 
                        $sqlFamila = "SELECT * FROM familiascuentacontable WHERE id_camaronera = '$camaronera' AND cuentaMadre = 'materia_prima' ORDER BY id ASC";
                        $data = $conectar->mostrar($sqlFamila);
                        foreach($data as $f):
                        $familia = $f['familia'];
                        $codigoCuenta = $f['codigoCuenta'];
                        $cuentaMadre = $f['cuentaMadre'];

                        switch ($familia) {
                            case 'reguladores':
                            $familiaFormat = 'Reguladores (agua / suelo)';
                            break;
                            
                            case 'otras_materias_primas':
                            $familiaFormat = 'Otras materias primas';
                            break;

                            default:

                            $familiaFormat = $familia;

                            break;
                        }
                    ?>

                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 195px;"><?php echo ucfirst(strtolower($familiaFormat)); ?></span>
                    </div>
                    <input type="number" class="form-control presupuesto" name="presupuesto[]" value="0.00" step="0.01">
                    <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                    <input type="hidden" name="fecha_registro" value="<?php echo date("Y-m-d H:i:s"); ?>">
                    <input type="hidden" name="descripcion[]" value="<?php echo $familia; ?>">
                    <input type="hidden" name="codigoCuenta[]" value="<?php echo $codigoCuenta; ?>">
                    <input type="hidden" name="cuentaMadre[]" value="<?php echo $cuentaMadre; ?>">
                    <input type="hidden" name="encargado" value="<?php echo $user; ?>">
                    </div>

                    <?php endforeach; ?>




            </div>

            <div class="col-4">
                
            

                    <div class="d-flex justify-content-center align-items-center vh-100 mt-2 mb-3" style="color:#404e67;"><strong>Mano de obra</strong></div>
                        <!-- Campos para Ha y Días -->
                    <hr class="mb-4">


                    <?php 
                        $sqlFamila = "SELECT * FROM familiascuentacontable WHERE id_camaronera = '$camaronera' AND cuentaMadre = 'mano_obra' ORDER BY id ASC";
                        $data = $conectar->mostrar($sqlFamila);
                        foreach($data as $f):
                        $familia = $f['familia'];
                        $codigoCuenta = $f['codigoCuenta'];
                        $cuentaMadre = $f['cuentaMadre'];

                        switch ($familia) {

                        
                            case 'sueldo_personal':
                            $familiaFormat = 'Sueldo personal';
                            break;
                            case 'beneficio_social':
                            $familiaFormat = 'Beneficio social iess';
                            break;
                            case 'extras_personal':
                            $familiaFormat = 'Extras de personal';
                            break;

                            default:

                            $familiaFormat = $familia;

                            break;
                        }
                    ?>

                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 195px;"><?php echo ucfirst(strtolower($familiaFormat)); ?></span>
                    </div>
                    <input type="number" class="form-control presupuesto" name="presupuesto[]" value="0.00" step="0.01">
                    <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                    <input type="hidden" name="fecha_registro" value="<?php echo date("Y-m-d H:i:s"); ?>">
                    <input type="hidden" name="descripcion[]" value="<?php echo $familia; ?>">
                    <input type="hidden" name="codigoCuenta[]" value="<?php echo $codigoCuenta; ?>">
                    <input type="hidden" name="cuentaMadre[]" value="<?php echo $cuentaMadre; ?>">
                    <input type="hidden" name="encargado" value="<?php echo $user; ?>">
                    </div>

                    <?php endforeach; ?>



                </form>


            </div>

            <div class="col-4">
    
            

                    <div class="d-flex justify-content-center align-items-center vh-100 mt-2 mb-3" style="color:#404e67;"><strong>Indirectos</strong></div>
                    <hr class="mb-4">
                    <?php 
                        $sqlFamila = "SELECT * FROM familiascuentacontable WHERE id_camaronera = '$camaronera' AND cuentaMadre = 'indirectos' ORDER BY id ASC";
                        $data = $conectar->mostrar($sqlFamila);
                        foreach($data as $f):
                        $familia = $f['familia'];
                        $codigoCuenta = $f['codigoCuenta'];
                        $cuentaMadre = $f['cuentaMadre'];

                        switch ($familia) {
                            case 'mantenimiento_red_electica':
                            $familiaFormat = 'Matenimiento red electrica';
                            break;
                        

                            default:

                            $familiaFormat = $familia;

                            break;
                        }
                    ?>

                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" style="width: 195px;"><?php echo ucfirst(strtolower($familiaFormat)); ?></span>
                    </div>
                    <input type="number" class="form-control presupuesto" name="presupuesto[]" value="0.00" step="0.01">
                    <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                    <input type="hidden" name="fecha_registro" value="<?php echo date("Y-m-d H:i:s"); ?>">
                    <input type="hidden" name="descripcion[]" value="<?php echo $familia; ?>">
                    <input type="hidden" name="codigoCuenta[]" value="<?php echo $codigoCuenta; ?>">
                    <input type="hidden" name="cuentaMadre[]" value="<?php echo $cuentaMadre; ?>">
                    <input type="hidden" name="encargado" value="<?php echo $user; ?>">
                    </div>

                    <?php endforeach; ?>

                    


            </div>

            <div class="container d-flex justify-content-center align-items-center vh-100 mt-4">
                <button type="submit" class="btn btn-danger btn-sm">grabar presupuesto</button>
            </div>

            
        </div>

    </form>



</div>




<script>
    document.addEventListener("DOMContentLoaded", function () {
    const inputs = document.querySelectorAll(".presupuesto");
    const totalDisplay = document.getElementById("totalPresupuesto");
    const haInput = document.getElementById("haInput");
    const diasInput = document.getElementById("diasInput");
    const presupuestoPorUnidad = document.getElementById("presupuestoPorUnidad");

    function actualizarTotal() {
        let total = 0;
        inputs.forEach(input => {
        total += parseFloat(input.value) || 0;
        });
        totalDisplay.textContent = total.toFixed(2);
        calcularPresupuestoPorUnidad(total);
    }

    function calcularPresupuestoPorUnidad(total) {
        const ha = parseFloat(haInput.value) || 1;
        const dias = parseFloat(diasInput.value) || 1;
        const resultado = total / (ha * dias);
        presupuestoPorUnidad.textContent = resultado.toFixed(2);
    }

    inputs.forEach(input => {
        input.addEventListener("input", actualizarTotal);
    });

    haInput.addEventListener("input", () => calcularPresupuestoPorUnidad(parseFloat(totalDisplay.textContent) || 0));
    diasInput.addEventListener("input", () => calcularPresupuestoPorUnidad(parseFloat(totalDisplay.textContent) || 0));

    actualizarTotal(); // Inicializa el total al cargar
    });
</script>
