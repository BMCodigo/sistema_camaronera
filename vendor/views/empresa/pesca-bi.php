EF  eeff ef,
RPE   registro_pesca_engorde rpe,
TS  simulacion_proceso_test ts,
 TI simulacion_proceso_test ti,
  RE  registro_piscina_engorde re

SELECT *, CAST(ts.hectareas AS FLOAT) AS hectareas,#(lf)#(lf)#(lf)rpe.fecha_pesca, rpe.peso_pesca, rpe.libras_pescadas, rpe.estado, rpe.nauplio, rpe.laboratorio, rpe.rendimiento,#(lf)#(lf)ef.id_camaronera, ef.anio, ef.ha_cosechadas, ef.ciclo_anio, ef.dias_secado, ef.dias_ciclo, ef.dias_cultivo, ef.gramaje, ef.conversion_engorde, ef.densidad as densidad_ef, ef.conversion_total, ef.costo_venta_lb, ef.costo_ha_dia_ind,#(lf)#(lf)re.fecha_siembra AS fechas_aquapro,#(lf)#(lf)suma_catidad_engorde(rpe.id_camaronera,rpe.id_piscina, rpe.id_corrida) AS alim_sum1,#(lf)#(lf)acumulado(rpe.id_camaronera,rpe.id_piscina, rpe.id_corrida) AS acumulado,#(lf)#(lf)cumplimiento_camaronera(rpe.id_camaronera,rpe.id_piscina, rpe.id_corrida) AS cumpli_camaronera#(lf)#(lf)#(lf)#(lf)FROM #(lf)#(tab)simulacion_proceso_test ts, eeff ef, registro_pesca_engorde rpe, registro_piscina_engorde re#(lf)WHERE #(lf)    #ts.id_camaronera = 1#(lf)    #AND ts.piscinas = 5#(lf)    #AND ts.id_corrida = 29#(lf)    #AND #(lf)    ts.Dias = (SELECT MAX(ti.Dias) FROM simulacion_proceso_test ti WHERE ti.id_camaronera = ts.id_camaronera AND ti.piscinas = ts.piscinas AND ti.id_corrida = ts.id_corrida)#(lf)#(lf)    AND ts.id_camaronera = rpe.id_camaronera#(lf)    AND ts.id_camaronera = ef.id_camaronera#(lf)    AND ts.id_camaronera = re.id_camaronera#(lf)    AND ts.piscinas = rpe.id_piscina#(lf)    AND ts.id_corrida = rpe.id_corrida#(lf)    AND ts.piscinas = re.id_piscina#(lf)    AND ts.id_corrida = re.id_corrida#(lf)    #(lf)#(tab)#AND ef.anio = ""TOTAL anio 2023""#(lf)    AND rpe.estado = 'Cosechado'#(lf)#(lf)ORDER BY ts.id_camaronera, ts.piscinas, ts.id_corrida  ASC

SELECT *,
    CAST(ts.hectareas AS FLOAT) AS hectareas,
    rpe.fecha_pesca,
    rpe.peso_pesca,
    rpe.libras_pescadas,
    rpe.estado,
    rpe.nauplio,
    rpe.laboratorio,
    rpe.rendimiento,
    
    
    
    ef.id_camaronera,
    ef.anio,
    ef.ha_cosechadas,
    ef.ciclo_anio,
    ef.dias_secado,
    ef.dias_ciclo,
    ef.dias_cultivo,
    ef.gramaje,
    ef.conversion_engorde,
    ef.densidad AS densidad_ef,
    ef.conversion_total,
    ef.costo_venta_lb,
    ef.costo_ha_dia_ind,
    
    
    
    re.fecha_siembra AS fechas_aquapro,
    suma_catidad_engorde(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS alim_sum1,
    acumulado(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS acumulado,
    cumplimiento_camaronera(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS cumpli_camaronera
FROM
    simulacion_proceso_test ts,
    eeff ef,
    registro_pesca_engorde rpe,
    registro_piscina_engorde re
WHERE
    ts.id_camaronera = 1
    AND ts.piscinas = 5
    AND ts.id_corrida = 29
    AND ts.Dias = (
        SELECT MAX(ti.Dias) FROM simulacion_proceso_test ti 
        WHERE ti.id_camaronera = ts.id_camaronera 
        AND ti.piscinas = ts.piscinas 
        AND ti.id_corrida = ts.id_corrida
    )
    AND ts.id_camaronera = rpe.id_camaronera
    AND ts.id_camaronera = ef.id_camaronera
    AND ts.id_camaronera = re.id_camaronera
    AND ts.piscinas = rpe.id_piscina
    AND ts.id_corrida = rpe.id_corrida
    AND ts.piscinas = re.id_piscina
    AND ts.id_corrida = re.id_corrida
    AND ef.anio = "TOTAL anio 2023"
    AND rpe.estado = 'Cosechado'
ORDER BY 
    ts.id_camaronera, 
    ts.piscinas, 
    ts.id_corrida ASC


////////////////////////////////////////////////////////////////////////////////

SELECT *,
    CAST(ts.hectareas AS FLOAT) AS hectareas,
    rpe.fecha_pesca,
    rpe.peso_pesca,
    rpe.libras_pescadas,
    rpe.estado,
    rpe.nauplio,
    rpe.laboratorio,
    rpe.rendimiento,
    re.fecha_siembra AS fechas_aquapro,
    suma_catidad_engorde(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS alim_sum1,
    acumulado(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS acumulado,
    cumplimiento_camaronera(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS cumpli_camaronera
FROM
    simulacion_proceso_test ts,
    registro_pesca_engorde rpe,
    registro_piscina_engorde re
WHERE
    ts.id_camaronera = 1
    AND ts.piscinas = 5
    AND ts.id_corrida = 29
    AND ts.Dias = (
        SELECT MAX(ti.Dias) FROM simulacion_proceso_test ti 
        WHERE ti.id_camaronera = ts.id_camaronera 
        AND ti.piscinas = ts.piscinas 
        AND ti.id_corrida = ts.id_corrida
    )
    AND ts.id_camaronera = rpe.id_camaronera
    AND ts.id_camaronera = re.id_camaronera
    AND ts.piscinas = rpe.id_piscina
    AND ts.id_corrida = rpe.id_corrida
    AND ts.piscinas = re.id_piscina
    AND ts.id_corrida = re.id_corrida
    AND rpe.estado = 'Cosechado'
ORDER BY 
    ts.id_camaronera, 
    ts.piscinas, 
    ts.id_corrida ASC


////////////////////////////////////////////////////////////////////////////////

SELECT *,
    CAST(ts.hectareas AS FLOAT) AS hectareas,
    rpe.fecha_pesca,
    rpe.peso_pesca,
    rpe.libras_pescadas,
    rpe.estado,
    rpe.nauplio,
    rpe.laboratorio,
    rpe.rendimiento,
    re.fecha_siembra AS fechas_aquapro,
    suma_catidad_engorde(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS alim_sum1,
    acumulado(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS acumulado,
    cumplimiento_camaronera(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS cumpli_camaronera
FROM
    simulacion_proceso_test ts,
    registro_pesca_engorde rpe,
    registro_piscina_engorde re
WHERE
    ts.id_camaronera = 5
   -- AND ts.piscinas = 5
   -- AND ts.id_corrida = 29
    AND ts.Dias = (
        SELECT MAX(ti.Dias) FROM simulacion_proceso_test ti 
        WHERE ti.id_camaronera = ts.id_camaronera 
     --   AND ti.piscinas = ts.piscinas 
     --   AND ti.id_corrida = ts.id_corrida
    )
    AND ts.id_camaronera = rpe.id_camaronera
    AND ts.id_camaronera = re.id_camaronera
    AND ts.piscinas = rpe.id_piscina
    AND ts.id_corrida = rpe.id_corrida
    AND ts.piscinas = re.id_piscina
    AND ts.id_corrida = re.id_corrida
    AND rpe.estado = 'Cosechado'
ORDER BY 
    ts.id_camaronera, 
    ts.piscinas, 
    ts.id_corrida ASC;
    
////////////////////////////////////////////////////////////////////////////////

SELECT *,
    CAST(ts.hectareas AS FLOAT) AS hectareas,
    rpe.fecha_pesca,
    rpe.peso_pesca,
    rpe.libras_pescadas,
    rpe.estado,
    rpe.nauplio,
    rpe.laboratorio,
    rpe.rendimiento,
    re.fecha_siembra AS fechas_aquapro,
    suma_catidad_engorde(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS alim_sum1,
    acumulado(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS acumulado,
    cumplimiento_camaronera(rpe.id_camaronera, rpe.id_piscina, rpe.id_corrida) AS cumpli_camaronera
FROM
    simulacion_proceso_test ts,
    registro_pesca_engorde rpe,
    registro_piscina_engorde re
WHERE
    ts.id_camaronera = 5
   -- AND ts.piscinas = 5
   -- AND ts.id_corrida = 29
    AND ts.Dias = (
        SELECT MAX(ti.Dias) FROM simulacion_proceso_test ti 
        WHERE ti.id_camaronera = ts.id_camaronera 
     --   AND ti.piscinas = ts.piscinas 
     --   AND ti.id_corrida = ts.id_corrida
    )
    AND ts.id_camaronera = rpe.id_camaronera
    AND ts.id_camaronera = re.id_camaronera
    AND ts.piscinas = rpe.id_piscina
    AND ts.id_corrida = rpe.id_corrida
    AND ts.piscinas = re.id_piscina
    AND ts.id_corrida = re.id_corrida
    AND rpe.estado = 'Cosechado'
ORDER BY 
    ts.id_camaronera, 
    ts.piscinas, 
    ts.id_corrida ASC;
    
    