<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

date_default_timezone_set('America/Guayaquil');
require_once __DIR__ . '/../../models/ModelTrazabilidadEjecucion.php';
$modelo = new ModeloTrazabilidadEjecucion($conectar, $camaronera);
?>


<style>
  .scrollable-section {
    max-height: 300px;
    overflow-y: auto;
  }

  .scrollable-section thead {
    position: sticky;
    top: 0;
    background: #404E67;
    z-index: 2;
  }

  /* Others */

  body {
    font-family: Arial, sans-serif;
  }

  .container-general {
    display: grid;
    place-content: center;
    font-size: 11px;
  }

  .sticky {
    position: sticky;
    left: 0;
  }

  .table-container {
    width: 90%;
    max-width: 850px;
    max-height: 441.2px;
    height: auto;
    margin: 0 auto;
    overflow-x: scroll;
    overflow-y: scroll;
  }

  .table-header {
    color: white;
    font-weight: 600;
  }

  .table-header,
  .table-row {
    display: flex;
    flex-direction: row;
    width: max-content;
  }

  .sticky {
    position: sticky;
    left: 0;
  }

  .sticky-col-2 {
    position: sticky;
    left: 180px;
  }

  .sticky-y-1 {
    position: sticky;
    top: 0;
  }

  .sticky-y-2 {
    position: sticky;
    top: 20px;
    z-index: 10;
  }

  .sticky-y-3 {
    position: sticky;
    top: 40px;
    z-index: 10;
  }

  .sticky-y-4 {
    position: sticky;
    top: 60px;
    z-index: 10;
  }

  .sticky-y-5 {
    position: sticky;
    top: 80px;
    z-index: 10;
  }

  .sticky-y-6 {
    position: sticky;
    top: 100px;
    z-index: 10;
  } 

  .table-header {
    display: flex;
    flex-direction: row;
    width: max-content;
    top: 0;
    z-index: 10;
    background-color: #404e67;
  }

  .table-cell {
    padding: 1px 1px;
    border-bottom: 0.3px solid #DEE2E6;
    border-top: 0.3px solid 1px #DEE2E6;
    min-width: 180px;
    text-align: center;
    min-height: 15px
  }

  .table-cells {
    padding: 1px 1px;
    border-bottom: 0.3px solid #DEE2E6;
    border-top: 0.3px solid 1px #DEE2E6;
    min-width: 100px;
    text-align: center;
    min-height: 15px
  }	

  .table-category {
    background-color: #404E67;
    color: white;
    font-weight: bold;
    text-align: left;
  }

  .bg-white {
    background-color: white;
  }

  .bg-blue-custom {
    background-color: #404E67;
  }

</style>

<div class="card">

  <div class="d-flex flex-row bd-highlight ">
    <div class="p-2 bd-highlight">
      <a href="index.php?page=insumostrazabilidad" class="text-white text-decoration-none">
        <li class="list-group-item  text-white text-center" style="background: #404e67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">Presupuesto general camaronera</li>
      </a>
    </div>

    <div class="p-2 bd-highlight">
      <a href="index.php?page=insumostrazabilidadejecutada" class="text-white text-decoration-none">
        <li class="list-group-item  text-white text-center" style="background: #404e67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">
          Insumos trazabilidad ejecutada
        </li>
      </a>
    </div>

    <div class="p-2 bd-highlight">
      <a href="index.php?page=detalle_piscina_insumos" class="text-white text-decoration-none">
        <li class="list-group-item  text-white text-center" style="background: #404E67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">Aplicación de insumos general</li>
      </a>
    </div>

    <div class="p-2 bd-highlight">
      <?php
        $piscinasData = $modelo->getHectareasEnProceso();
      ?>
      <a href="index.php?page=detalle_piscina.php&piscina=<?php echo $piscinasData[0]['id_piscina']; ?>&ha=<?php echo $piscinasData[0]['hectareas']; ?>" class="text-white text-decoration-none">
        <li class="list-group-item text-white text-center" style="background: #404E67; border-radius: 10px; height: 30px; padding: 7px 10px; font-size: 14px; line-height: 1;">
          Detalle por piscina </li>
      </a>
    </div>
  </div>

  <div class="container d-flex justify-content-center align-items-center vh-100 mt-4">
    <h5>Presupuesto Ejecutada
      <?php
        $descripcion = $modelo->getCamaronera();
        echo $descripcion['descripcion_camaronera'];
      ?>
    </h5>
  </div>

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <hr style="width: 900px; background:#404e67;">
  </div>

  <div class="container">
    <div class="text-dark" style="margin-bottom: -10px; margin-top:5px; margin-left: 12%;">
      Detalle presupuestal ejecutado
    </div>
  </div>

  <hr>

  <div class="container-general">

    <div class="table-container">
      
      <div class="table-header sticky-y-1">
        <div class="table-cell sticky bg-blue-custom">Rubros</div>
        <div class="table-cell sticky-col-2 bg-blue-custom">Presupuesto</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">Enero</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Ejec.</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Part.</div>

        <div class="table-cells">Febrero</div>
        <div class="table-cells">% Ejec.</div>
        <div class="table-cells">% Part.</div>

        <div class="table-cells" style="background: #fbd9cb; color:black;">Marzo</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Ejec.</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Part.</div>

        <div class="table-cells">Abril</div>
        <div class="table-cells">% Ejec.</div>
        <div class="table-cells">% Part.</div>

        <div class="table-cells" style="background: #fbd9cb; color:black;">Mayo</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Ejec.</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Part.</div>

        <div class="table-cells">Junio</div>
        <div class="table-cells">% Ejec.</div>
        <div class="table-cells">% Part.</div>

        <div class="table-cells" style="background: #fbd9cb; color:black;">Julio</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Ejec.</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Part.</div>

        <div class="table-cells">Agosto</div>
        <div class="table-cells">% Ejec.</div>
        <div class="table-cells">% Part.</div>

        <div class="table-cells" style="background: #fbd9cb; color:black;">Septiembre</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Ejec.</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Part.</div>

        <div class="table-cells">Octubre</div>
        <div class="table-cells">% Ejec.</div>
        <div class="table-cells">% Part.</div>

        <div class="table-cells" style="background: #fbd9cb; color:black;">Noviembre</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Ejec.</div>
        <div class="table-cells" style="background: #fbd9cb; color:black;">% Part.</div>

        <div class="table-cells">Diciembre</div>
        <div class="table-cells">% Ejec.</div>
        <div class="table-cells">% Part.</div>

      </div>
      
      <div class="table-row sticky-y-2">
        <div class="table-cell sticky bg-white">Hectareas</div>
        <div class="table-cell sticky-col-2 bg-white">
          <?php
            $sqlHa = $modelo->getHectareasYdias();
            echo number_format($sqlHa['hectareas'], 2);
          ?>
        </div>
        <?php
          for ($mes = 1; $mes <= 12; $mes++) {
            echo '<div class="table-cells bg-white"> '. number_format($sqlHa['hectareas'],2) .'</div>';
            echo '<div class="table-cells bg-white"></div>';
            echo '<div class="table-cells bg-white"></div>';
          }
        ?>
      </div>
      
      <div class="table-row sticky-y-3">
        <div class="table-cell sticky bg-white">Días</div>
        <div class="table-cell sticky-col-2 bg-white">
          <?php
            $sqlDias = $modelo->getHectareasYdias();
            echo number_format($sqlDias['dias'], 2);
          ?>
        </div>
        <?php
          $diaMes = $modelo->getDiasMeses();
          for ($mes = 1; $mes <= 12; $mes++) {
            echo '<div class="table-cells bg-white"> '. number_format($diaMes[$mes],2) .'</div>';
            echo '<div class="table-cells bg-white"></div>';
            echo '<div class="table-cells bg-white"></div>';
          }
        ?>
      </div>

      <div class="table-row sticky-y-4 ">
        <div class="table-cell sticky bg-white">Costo hectarea dia</div>
        <div class="table-cell sticky-col-2 bg-white">
          <?php
           $sqlRubros = $modelo->getPresupuestoYejecucionTotal();
           echo number_format($sqlRubros['presupuesto'] / $sqlHa['hectareas'] / $sqlDias['dias'], 2);
          ?>
        </div>
        <?php
            $costosMensuales = $modelo->getAllMesMes("'materia_prima', 'mano_obra', 'indirectos'");
            foreach ($costosMensuales as $mes => $valorMes) {
              echo '<div class="table-cells bg-white">' . number_format($valorMes / $sqlHa['hectareas'] / $sqlDias['dias'] , 2) . "</div>";
              $sqlRubros = $modelo->getPresupuestoYejecucionTotal();
              $valorEjecutado = isset($costosPorMes[$mes]) ? $costosPorMes[$mes] : 0;
             // echo '<div class="table-cells bg-white">' .  number_format(  ($valorMes / $sqlHa['hectareas'] / $sqlDias['dias']) / ( $sqlRubros['presupuesto'] / $sqlHa['hectareas'] / $sqlDias['dias']) * 100, 2) . ' %</div>';
              //$porcentaje = ($sqlHa['hectareas'] > 0) ? ($valorEjecutado / $sqlHa['hectareas']) * 100 : 0;
              //echo '<div class="table-cells bg-white">' . number_format($porcentaje, 2) . ' %</div>';
              
              echo '<div class="table-cells bg-white"></div>';
              echo '<div class="table-cells bg-white"></div>';
              
            }
        ?>
      </div>

      <div class="table-row sticky-y-5">
        <div class="table-cell sticky bg-white">Rubros ejecutados real</div>
        <div class="table-cell sticky-col-2 bg-white">
          <?php
            $sqlRubros = $modelo->getPresupuestoYejecucionTotal();
            echo number_format($sqlRubros['presupuesto'], 2);
          ?>
        </div>

        <?php
          $costosMensuales = $modelo->getAllMesMes("'materia_prima', 'mano_obra', 'indirectos'");
          $totalPresupuesto = $sqlRubros['presupuesto'];
          foreach ($costosMensuales as $mes => $valorMes) {
            echo '<div class="table-cells bg-white">' . number_format($valorMes, 2) . " </div>";
            $porcentajeMes = ($totalPresupuesto > 0) ? ($valorMes / $totalPresupuesto * 100) : 0;
            echo '<div class="table-cells bg-white">' . number_format($porcentajeMes, 2) . "%</div>";
            echo '<div class="table-cells bg-white"></div>';
          }
        ?>
      </div>

      <br>

      <div>
        <div class="table-row table-category sticky-y-6">
          <div class="table-cell sticky bg-blue-custom">Materia prima</div>
          <div class="table-cell sticky-col-2 bg-blue-custom">
            <?php
              $resumen = $modelo->getResumenCuentaMadre('materia_prima');
              echo number_format($resumen['presupuesto'], 2);
            ?>
          </div>
          <?php
            // Total mensual por todos los rubros
            $totalCostosMensuales = $modelo->getAllMesMes("'materia_prima', 'mano_obra', 'indirectos'");
            // Costos solo de materia prima
            $costosMateriaPrima = $modelo->getAllMesMes("'materia_prima'");

            $totalPresupuesto = $sqlRubros['presupuesto'];

            for ($mes = 1; $mes <= 12; $mes++) {
                // Valores de cada mes
                $valorMateriaPrima = isset($costosMateriaPrima[$mes]) ? $costosMateriaPrima[$mes] : 0;
                $valorTotalMes = isset($totalCostosMensuales[$mes]) ? $totalCostosMensuales[$mes] : 0;

                // Aplicar color especial a los meses impares
                $bgStyle = ($mes % 2 == 1) 
                    ? 'style="background: #fbd9cb; color:black;"' 
                    : '';

                // Valor de Materia Prima
                echo '<div class="table-cells bg-blue-custom" ' . $bgStyle . '>' . number_format($valorMateriaPrima, 2) . '</div>';

                // Porcentaje Materia Prima sobre Presupuesto total
                $porcentaje = ($sqlHa['hectareas'] > 0) ? ($valorMateriaPrima / $resumen['presupuesto']) * 100 : 0;
                echo '<div class="table-cells bg-blue-custom" ' . $bgStyle . '>' . number_format($porcentaje, 2) . ' %</div>';

                // Porcentaje de participación Materia Prima sobre el total del mes
                $procetajeParticipacion = ($valorTotalMes > 0) ? ($valorMateriaPrima / $valorTotalMes) * 100 : 0;
                echo '<div class="table-cells bg-blue-custom" ' . $bgStyle . '>' . number_format($procetajeParticipacion, 2) . ' %</div>';
            }
          ?>
        </div>

        <?php 
          echo $modelo->getDetallePresupuestoPorCuentaMadreHTML($camaronera, 'materia_prima');
          echo $modelo->getResumenCuentaCabeceraObra('mano_obra');
          echo $modelo->getDetallePresupuestoPorCuentaMadreHTML($camaronera, 'mano_obra');
          echo $CabeceraIndirecta = $modelo->getResumenCuentaCabeceraObra('indirectos');
          echo $modelo->getDetallePresupuestoPorCuentaMadreHTML($camaronera, 'indirectos');
        ?>
      </div>
    </div>
  </div>
  
</div>
