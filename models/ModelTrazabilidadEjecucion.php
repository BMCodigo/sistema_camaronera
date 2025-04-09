<?php

class ModeloTrazabilidadEjecucion {
    private $conectar;
    private $camaronera;
  
    public function __construct($conectar, $camaronera) {
      $this->conectar = $conectar;
      $this->camaronera = $camaronera;
    }

    public function getHectareasYdias() {
      $sql = "SELECT DISTINCT(hectareas), dias FROM presupuestos_aporbados WHERE id_camaronera = '{$this->camaronera}' AND fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM presupuestos_aporbados WHERE id_camaronera = '{$this->camaronera}')";
      return $this->conectar->mostrar($sql)[0];
    }
  
    public function getHectareasEnProceso() {
      $sql = "SELECT SUM(hectareas) AS hectareas FROM registro_piscina_engorde WHERE id_camaronera = '{$this->camaronera}' AND estado = 'En proceso'";
      return $this->conectar->mostrar($sql)[0];
    }
  
    public function getPresupuestoYejecucionTotal() {
      $sqlPresupuesto = "SELECT SUM(p.presupuesto_aprobado) AS presupuesto_aprobado_camaronera FROM presupuestos_aporbados p WHERE p.id_camaronera = '{$this->camaronera}' AND p.cuentaMadre IN ('materia_prima', 'mano_obra', 'indirectos') AND fecha_ingreso = (SELECT MAX(fecha_ingreso) FROM presupuestos_aporbados WHERE id_camaronera = '{$this->camaronera}')";
      $presupuesto = $this->conectar->mostrar($sqlPresupuesto)[0]['presupuesto_aprobado_camaronera'];
  
      $sqlEjecutado = "SELECT SUM(t1.total) AS costoTotal FROM costos_camaronera t1 JOIN registro_piscina_engorde t2 ON t1.id_camaronera = t2.id_camaronera AND t1.id_piscina = t2.id_piscina AND t1.id_corrida = t2.id_corrida WHERE t2.estado = 'En proceso' AND t1.cuentaMadre IN ('materia_prima', 'mano_obra', 'indirectos') AND t1.id_camaronera = '{$this->camaronera}'";
      $ejecutado = $this->conectar->mostrar($sqlEjecutado)[0]['costoTotal'];
  
      return [
        'presupuesto' => $presupuesto,
        'ejecutado' => $ejecutado
      ];
    }
  
    // Puedes hacer métodos similares por cuentaMadre: materia_prima, mano_obra, indirectos
    // También puedes incluir uno general para todas las familias
  
    public function getPorFamilia($cuentaMadre) {
      $sql = "SELECT 
                f.familia, f.codigocuenta, 
                COALESCE(p.presupuesto_aprobado, 0) AS presupuesto_aprobado,
                TRIM(LOWER(f.familia)) AS descripcion
              FROM familiascuentacontable f
              LEFT JOIN (
                SELECT familia, MAX(fecha_ingreso) AS max_fecha
                FROM presupuestos_aporbados
                WHERE id_camaronera = '{$this->camaronera}'
                GROUP BY familia
              ) subq ON f.familia = subq.familia
              LEFT JOIN presupuestos_aporbados p
                ON p.familia = subq.familia 
                AND p.fecha_ingreso = subq.max_fecha
              WHERE f.id_camaronera = '{$this->camaronera}' AND p.cuentaMadre = '{$cuentaMadre}'
              GROUP BY f.familia, f.codigocuenta
              ORDER BY f.id ASC";
  
      return $this->conectar->mostrar($sql);
    }
  
    public function getEjecucionPorFamilia($familia) {
      $sql = "SELECT 
                SUM(t1.total) AS costoTotal
              FROM costos_camaronera t1
              JOIN registro_piscina_engorde t2 
                ON t1.id_camaronera = t2.id_camaronera 
                AND t1.id_piscina = t2.id_piscina
                AND t1.id_corrida = t2.id_corrida
              WHERE t2.estado = 'en proceso'
              AND t1.id_camaronera = '{$this->camaronera}'
              AND t1.familia = '{$familia}'";
  
      return $this->conectar->mostrar($sql)[0]['costoTotal'] ?? 0;
    }

    // Consulta para obtener todas las piscinas en proceso
    public function getPiscinasEnProceso() {
      $sql = "SELECT DISTINCT id_piscina, hectareas FROM registro_piscina_engorde WHERE estado = 'En proceso' AND id_camaronera = '{$this->camaronera}' ORDER BY id_piscina ASC";
      echo "getPiscinasEnProceso: "+$sql;
      return $this->conectar->mostrar($sql);
    }

    public function getCamaronera() {
      $sql = "SELECT id_camaronera, descripcion_camaronera FROM camaronera WHERE id_camaronera = '{$this->camaronera}'";
      $id_camaronera = $this->conectar->mostrar($sql)[0]['id_camaronera'];
      $descripcion_camaronera = $this->conectar->mostrar($sql)[0]['descripcion_camaronera'];
      // Si no se encuentra la camaronera, puedes manejarlo como desees
      return [
        'id_camaronera' => $id_camaronera,
        'descripcion_camaronera' => $descripcion_camaronera
      ];
    }

    public function getResumenCuentaMadre($cuentaMadre)
    {
      $camaronera = $this->camaronera;
    
      // Presupuesto aprobado
      $sqlPresupuesto = "SELECT 
                          SUM(p.presupuesto_aprobado) AS presupuesto_aprobado_camaronera, 
                          p.cuentaMadre
                        FROM 
                          presupuestos_aporbados p
                        WHERE 
                          p.id_camaronera = '$camaronera' 
                          AND p.cuentaMadre = '$cuentaMadre' 
                          AND fecha_ingreso = (
                              SELECT MAX(fecha_ingreso) 
                              FROM presupuestos_aporbados 
                              WHERE id_camaronera = '$camaronera' 
                              AND cuentaMadre = '$cuentaMadre'
                          )";
    
      $dataPresupuesto = $this->conectar->mostrar($sqlPresupuesto);
      $totalPresupuesto = isset($dataPresupuesto[0]['presupuesto_aprobado_camaronera']) ? $dataPresupuesto[0]['presupuesto_aprobado_camaronera'] : 0;
    
      // Ejecución real
      $sqlEjecutado = "SELECT 
                        SUM(t1.total) AS costoTotal
                      FROM costos_camaronera t1
                      JOIN registro_piscina_engorde t2 
                        ON t1.id_camaronera = t2.id_camaronera 
                        AND t1.id_piscina = t2.id_piscina
                        AND t1.id_corrida = t2.id_corrida
                      WHERE 
                        t2.estado = 'En proceso'
                        AND t1.cuentaMadre = '$cuentaMadre'
                        AND t1.id_camaronera = '$camaronera'";
    
      $dataEjecutado = $this->conectar->mostrar($sqlEjecutado);
      $totalEjecutado = isset($dataEjecutado[0]['costoTotal']) ? $dataEjecutado[0]['costoTotal'] : 0;
    
      $porcentaje = ($totalPresupuesto > 0) ? ($totalEjecutado / $totalPresupuesto) * 100 : 0;
    
      return [
        'cuentaMadre' => $cuentaMadre,
        'presupuesto' => $totalPresupuesto,
        'ejecutado' => $totalEjecutado,
        'porcentaje' => $porcentaje
      ];
    }
     
    public function getDetallePresupuestoPorCuentaMadreHTML($camaroneraId, $cuentaMadre) {
        $sql = "SELECT 
                  f.familia, 
                  f.codigocuenta, 
                  COALESCE(p.presupuesto_aprobado, 0) AS presupuesto_aprobado,
                  TRIM(LOWER(f.familia)) AS descripcion
                FROM 
                  familiascuentacontable f
                LEFT JOIN (
                  SELECT 
                    familia, MAX(fecha_ingreso) AS max_fecha
                  FROM 
                    presupuestos_aporbados
                  WHERE 
                    id_camaronera = '$camaroneraId'
                  GROUP BY 
                    familia
                ) subq ON f.familia = subq.familia
                LEFT JOIN presupuestos_aporbados p
                  ON p.familia = subq.familia AND p.fecha_ingreso = subq.max_fecha
                WHERE 
                  f.id_camaronera = '$camaroneraId'
                AND p.cuentaMadre = '$cuentaMadre'
                GROUP BY 
                  f.familia, f.codigocuenta
                ORDER BY 
                  f.id ASC";
      
        $data = $this->conectar->mostrar($sql);
        $html = '';
      
        foreach ($data as $item) {
          $descripcion = $item['descripcion'];
          if ($descripcion === 'otras_materias_primas') $descripcion = 'Otras materias primas';
          if ($descripcion === 'reguladores') $descripcion = 'Reguladores de suelo y agua';
          if ($descripcion === 'sueldo_personal') $descripcion = 'Sueldo personal';
          if ($descripcion === 'beneficio_social') $descripcion = 'Beneficio social iess';
          if ($descripcion === 'extras_personal') $descripcion = 'Extras de personal';
          if ($descripcion === 'mantenimiento_red_electica') $descripcion = 'Mantenimiento red eléctrica';
      
          $presupuesto_aprobado = $item['presupuesto_aprobado'];
      
          $sqlEjecucion = "SELECT 
                            SUM(t1.total) AS costoTotal 
                          FROM costos_camaronera t1
                          INNER JOIN registro_piscina_engorde t2 
                            ON t1.id_camaronera = t2.id_camaronera
                            AND t1.id_piscina = t2.id_piscina 
                            AND t1.id_corrida = t2.id_corrida 
                          WHERE 
                            t1.id_camaronera = '$camaroneraId' 
                            AND t1.familia = '{$item['descripcion']}'
                            AND t2.estado = 'en proceso'";
      
          $ejecucion = $this->conectar->mostrar($sqlEjecucion);
          $costoTotal = isset($ejecucion[0]['costoTotal']) ? $ejecucion[0]['costoTotal'] : 0;
      
          $porcentaje = ($presupuesto_aprobado > 0) ? ($costoTotal / $presupuesto_aprobado) * 100 : 0;
      
          $hue = max(0, min(120 - ($porcentaje * 1.2), 120));
          $color = "hsl($hue, 80%, 40%)";
      
          $html .= "
          <div class='table-row'>
            <div class='table-cell sticky bg-white'>" . ucfirst($descripcion) . "</div>
            <div class='table-cell sticky-col-2 bg-white'>" . number_format($presupuesto_aprobado, 2) . "</div>";
            $costosMensuales = $this->getCostosMensualesPorFamilia($item['descripcion']);
            foreach ($costosMensuales as $valorMes) {
              $html .= "<div class='table-cells bg-white'>" . number_format($valorMes, 2) . "</div>";
              $porcentajeMes = ($presupuesto_aprobado > 0) ? ($valorMes / $presupuesto_aprobado * 100) : 0;
              $html .= "<div class='table-cells bg-white'>" . number_format($porcentajeMes, 2) . "%</div>";
              $html .= "<div class='table-cells bg-white'>" . number_format(0, 2) . "%</div>";
            }
          $html .= "</div>";
          
        }
      
        return $html;
      }
      
      private function getCostosMensualesPorCuentaMadre($cuentaMadre) {
        $sql = "SELECT 
                  EXTRACT(MONTH FROM t1.fecha_consumo) AS mes,
                  SUM(t1.total) AS costoTotal
                FROM costos_camaronera t1
                JOIN registro_piscina_engorde t2 
                  ON t1.id_camaronera = t2.id_camaronera 
                  AND t1.id_piscina = t2.id_piscina 
                  AND t1.id_corrida = t2.id_corrida
                WHERE t1.cuentaMadre = '$cuentaMadre' 
                  AND t2.estado = 'En proceso' 
                  AND t1.id_camaronera = '{$this->camaronera}'
                  AND t1.fecha_consumo BETWEEN '2025-01-01' AND CURRENT_DATE
                GROUP BY mes";
      
        $result = $this->conectar->mostrar($sql);
        $meses = array_fill(1, 12, 0);
        foreach ($result as $row) {
          $meses[(int)$row['mes']] = (float)$row['costoTotal'];
        }
        return $meses;
      }
      
      public function getResumenCuentaCabeceraObra($cuentaMadre) {
        $html = "";
      
        // Obtener presupuesto total
        $sqlPresupuesto = "SELECT 
            SUM(p.presupuesto_aprobado) AS presupuesto_aprobado_camaronera, 
            p.cuentaMadre
            FROM presupuestos_aporbados p
            WHERE p.id_camaronera = '{$this->camaronera}' 
            AND p.cuentaMadre = '$cuentaMadre' 
            AND fecha_ingreso = (
            SELECT MAX(fecha_ingreso) 
            FROM presupuestos_aporbados 
            WHERE id_camaronera = '{$this->camaronera}' 
            AND cuentaMadre = '$cuentaMadre'
            )";
      
        $data = $this->conectar->mostrar($sqlPresupuesto);
        $totalPresupuesto = isset($data[0]['presupuesto_aprobado_camaronera']) ? $data[0]['presupuesto_aprobado_camaronera'] : 0;
      
        // Obtener ejecución total
        $sqlEjecutadoCamaronera = "SELECT 
            SUM(t1.total) AS costoTotal
            FROM costos_camaronera t1
            JOIN registro_piscina_engorde t2 
            ON t1.id_camaronera = t2.id_camaronera 
            AND t1.id_piscina = t2.id_piscina
            AND t1.id_corrida = t2.id_corrida
            WHERE t2.estado = 'En proceso'
            AND t1.cuentaMadre = '$cuentaMadre'
            AND t1.id_camaronera = '{$this->camaronera}'";
      
        $dataEjecutado = $this->conectar->mostrar($sqlEjecutadoCamaronera);
        $totalCostoEjecutado = isset($dataEjecutado[0]['costoTotal']) ? $dataEjecutado[0]['costoTotal'] : 0;
      
        $porcentaje = ($totalPresupuesto > 0) ? ($totalCostoEjecutado / $totalPresupuesto) * 100 : 0;
        $hue = max(0, min(120 - ($porcentaje * 1.2), 120));
        $color = "hsl($hue, 80%, 40%)";
      
        $titulo = ucfirst(str_replace('_', ' ', $cuentaMadre));
      
        // Obtener costos mensuales
        $costosMensuales = $this->getCostosMensualesPorCuentaMadre($cuentaMadre);
      
        $html .= "<div class='table-row table-category'>
            <div class='table-cell sticky bg-blue-custom'>$titulo</div>
            <div class='table-cell sticky-col-2 bg-blue-custom'>" . number_format($totalPresupuesto, 2) . "</div>";
      
        // Agregar 12 columnas (una por mes)
        foreach ($costosMensuales as $mes => $valorMes) {
          $html .= "<div class='table-cells bg-blue-custom'>" . number_format($valorMes, 2) . "</div>";
          $porcentajeMes = ($totalPresupuesto > 0) ? ($valorMes / $totalPresupuesto * 100) : 0;
          $html .= "<div class='table-cells bg-blue-custom'>" . number_format($porcentajeMes, 2) . "%</div>";
          $html .= "<div class='table-cells bg-blue-custom'>" . number_format(0, 2) . "%</div>";
        }
      
        $html .= "</div>";
      
        return $html;
      }
      
      

    /*
      SELECT EXTRACT(YEAR FROM t1.fecha_consumo) AS anio, 
      EXTRACT(MONTH FROM t1.fecha_consumo) AS mes, 
      SUM(t1.total) AS costoTotal 
      FROM costos_camaronera t1 
      JOIN registro_piscina_engorde t2 ON t1.id_camaronera = t2.id_camaronera 
      AND t1.id_piscina = t2.id_piscina AND t1.id_corrida = t2.id_corrida 
      WHERE t2.estado = 'En proceso' AND t1.fecha_consumo 
      BETWEEN '2025-01-01' 
      AND CURRENT_DATE AND t1.cuentaMadre IN ('materia_prima', 'mano_obra', 'indirectos') 
      GROUP BY anio, mes ORDER BY anio, mes;
    */


    public function getAllMesMes($tablas) {
      $sql = "SELECT 
                EXTRACT(YEAR FROM t1.fecha_consumo) AS anio, 
                EXTRACT(MONTH FROM t1.fecha_consumo) AS mes, 
                SUM(t1.total) AS costoTotal 
              FROM costos_camaronera t1 
              JOIN registro_piscina_engorde t2 
                ON t1.id_camaronera = t2.id_camaronera 
                AND t1.id_piscina = t2.id_piscina 
                AND t1.id_corrida = t2.id_corrida 
              WHERE t2.estado = 'En proceso' 
                AND t1.fecha_consumo BETWEEN '2025-01-01' AND CURRENT_DATE 
                -- 'materia_prima', 'mano_obra', 'indirectos'
                AND t1.cuentaMadre IN ($tablas) 
              GROUP BY anio, mes 
              ORDER BY anio, mes";
          $result = $this->conectar->mostrar($sql);

          // Transformamos el resultado
          $meses = array_fill(1, 12, 0); // Inicializa meses vacíos
          foreach ($result as $row) {
            $meses[(int)$row['mes']] = (float)$row['costoTotal'];
          }

        return $meses;
    }	

    private function getCostosMensualesPorFamilia($familia) {
      $sql = "SELECT 
                EXTRACT(MONTH FROM t1.fecha_consumo) AS mes,
                SUM(t1.total) AS costoTotal
              FROM costos_camaronera t1
              JOIN registro_piscina_engorde t2 
                ON t1.id_camaronera = t2.id_camaronera 
                AND t1.id_piscina = t2.id_piscina 
                AND t1.id_corrida = t2.id_corrida
              WHERE t1.familia = '$familia' 
                AND t2.estado = 'En proceso' 
                AND t1.id_camaronera = '{$this->camaronera}' 
                AND t1.fecha_consumo BETWEEN '2025-01-01' AND CURRENT_DATE
              GROUP BY mes";
    
      $result = $this->conectar->mostrar($sql);
      $meses = array_fill(1, 12, 0); // Inicializa todos en 0
      foreach ($result as $row) {
        $meses[(int)$row['mes']] = (float)$row['costoTotal'];
      }
      return $meses;
    }
    

  }
  
?>