
<body>

    <div class="jumbotron">
        <h2>Actualizacion de informacion semanal</h2>
        <p class="lead">Para actualizar los datos del resumen general, por favor dar click sobre el boton <strong>CARGAR INFORMACION</strong>.</p>
        <hr class="my-4">

        <form class="col-6" id="acceso">
            <div class="form-group">
                <label for="passwordInput">Clave de acceso</label>
                <input type="password" class="form-control" id="passwordInput" placeholder="**************">
            </div>
            <button type="button" class="btn btn-danger" onclick="validatePassword()">Aceder</button>
        </form>

        <div id="secretDiv" style="display:none; margin-top: 10px;">
            <p class="text-danger"><strong>¡ Acceso concedido, puede caragar la informacion ! </strong></p>     
            <!-- Ajustar el m谷todo a POST para no mostrar par芍metros en la URL -->
            <form action="" class="mt-5" method="post">
                <button type="submit" class="btn btn-primary btn-lg" name="loader"> Cargar informacion</button>
            </form>
        
            <?php  if(isset($_POST['loader'])){ ?>
            
                </br>
                <div class="alert alert-success mt-5 col-6" role="alert">
                    Informacion actualizada con exito.
                </div>

                    <table class="table table-responsive">
                                    <thead class="thead-dark">
                                        <tr>
                                        <th scope="col">Fecha Muestreo</th>
                                        <th scope="col">#</th>
                                        <th scope="col">aabb</th>
                                        <th scope="col">ha</th>
                                        <th scope="col">dias</th>
                                        <th scope="col">dens tran</th>
                                        <th scope="col">peso trab</th>
                                        <th scope="col">peso act</th>
                                        <th scope="col">gr/dia</th>
                                        <th scope="col">inc</th>
                                        <th scope="col">inc/prom</th>
                                        <th scope="col">kg/ha prom</th>
                                        <th scope="col">ind/m2</th>
                                        <th scope="col">alerta alim</th>
                                        <th scope="col">dens bio</th>
                                        <th scope="col">poblac</th>
                                        <th scope="col">proyect AABB</th>
                                        <th scope="col">proyect D</th>
                                        <th scope="col">lbs/ha</th>
                                        <th scope="col">lbs/tot</th>
                                        <th scope="col">raleo</th>
                                        <th scope="col">fcv</th>
                                        </tr>
                                    </thead>


                    <?php

                        date_default_timezone_set('America/Santiago');

                        $sqlDelete = "SELECT * FROM `pw_resumen_general`";
                        $delete = mysqli_query($conexion, $sqlDelete); // Realizar la inserci車n

                        if($delete){
                            
                            $sqlDatos = "SELECT sp.id_camaronera, sp.piscinas, sp.id_corrida, sp.hectareas, sp.fecha_muestreo, sp.id_bio, sp.Dias, sp.densidad_transferencia, sp.peso_trasferencia, sp.Peso_final, sp.fecha_siembra,
                            sp.incremento, sp.incrprm3s, sp.tipo_nombre, sp.gr_dias, sp.n, sp.alim_sum2, sp.alim_acu, (sp.Dif_Ali / sp.alim_sum2) AS prctj_dif_al, sp.densidad, 
                            sp.poblacion, sp.libras_tot, sp.Animales_bw, sp.alim_acu, sp.semana_alim, 
                            (sp.alim_sum2 / sp.hectareas) / sp.n AS kg_ha_semana_m,
                            (sp.alim_sum2/sp.hectareas)/7 AS kg_ha_semana_d, 
                            1.00 / (0.007963335 + 0.1387779 / sp.Peso_final) AS kg_10_m, 
                            ((sp.alim_sum2/sp.hectareas)/sp.n) * 10 / (1.00/(0.007963335+0.1387779/ sp.Peso_final)) AS ind_x_metro_m, 
                            ((sp.alim_sum2/sp.hectareas)/7) * 10 / (1.00/(0.007963335+0.1387779/ sp.Peso_final)) AS ind_x_metro_d,
                            DATE_SUB(sp.fecha_muestreo, INTERVAL 7 DAY) AS fecha_poblacion, 
                    
                            CASE sp.id_camaronera
                                WHEN 1 THEN 'Darsacom'
                                WHEN 2 THEN 'Aquacamaron'
                                WHEN 3 THEN 'Jopisa'
                                WHEN 5 THEN 'Grupo Camaron'
                                ELSE 0
                            END AS nombre_camaronera,
                    
                            CASE sp.id_camaronera
                                WHEN 1 THEN (35.00 - (sp.incrprm3s / 7) * 25)
                                WHEN 2 THEN (29.00 - (sp.incrprm3s / 7) * 23)
                                WHEN 3 THEN (35.00 - (sp.incrprm3s / 7) * 25)
                                WHEN 5 THEN (34.00 - (sp.incrprm3s / 7) * 20)            
                            END AS pedidos_de_larva,
                    
                            CASE sp.id_camaronera
                                WHEN 1 THEN ABS((sp.Peso_final - (35.00 - (sp.incrprm3s / 7) * 25)) / (sp.incrprm3s / 7))
                                WHEN 2 THEN ABS((sp.Peso_final - (29.00 - (sp.incrprm3s / 7) * 36)) / (sp.incrprm3s / 7))
                                WHEN 3 THEN ABS((sp.Peso_final - (35.00 - (sp.incrprm3s / 7) * 25)) / (sp.incrprm3s / 7))
                                WHEN 5 THEN ABS((sp.Peso_final - (20.00 - (sp.incrprm3s / 7) * 25)) / (sp.incrprm3s / 7))
                                ELSE 0 
                            END AS fechas_estimadas, 
                    
                            CASE sp.id_camaronera
                                WHEN 1 THEN 'BI'
                                WHEN 2 THEN 'BI'
                                WHEN 3 THEN 'BI'
                                WHEN 5 THEN 'BI'
                                ELSE 0
                            END AS bi_tri,
                    
                            CASE sp.id_camaronera
                                WHEN 1 THEN 200000
                                WHEN 2 THEN 250000
                                WHEN 3 THEN 200000
                                WHEN 5 THEN 200000
                                ELSE 0
                            END AS cantidad_larva_ha,
                    
                            CASE sp.id_camaronera
                                WHEN 1 THEN (200000 * sp.hectareas)
                                WHEN 2 THEN (250000 * sp.hectareas)
                                WHEN 3 THEN (200000 * sp.hectareas)
                                WHEN 5 THEN (200000 * sp.hectareas)
                                ELSE 0
                            END AS cantidad_larva_total,
                    
                            CASE
                                WHEN sp.tipo_nombre IN ('HID EXT 2', 'HID EXT FNS 2', 'HID EXT 1.2', 'HID EXT FNS 1.2', 'HID P 1.2', 'HID P FNS 1.2', 'HID P 2', 'HID PLT 37% 2.0', 'HID SPD 37% 2.0' , 'HID PLT 37% 2.0') THEN
                                    CASE
                                        WHEN sp.Peso_final BETWEEN 0.10 AND 1.99 THEN ((25 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 02.00 AND 4.99 THEN ((30 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 05.00 AND 9.99 THEN ((40 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 10.00 AND 12.99 THEN ((45 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 13.00 AND 14.99 THEN ((50 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 15.00 AND 16.99 THEN ((60 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 17.00 AND 18.99 THEN ((65 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 19.00 AND 20.99 THEN ((70 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 21.00 AND 22.99 THEN ((75 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 23.00 AND 24.99 THEN ((80 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 25.00 AND 28.99 THEN ((85 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 29.00 AND 32.99 THEN ((90 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                        WHEN sp.Peso_final BETWEEN 33.00 AND 37.00 THEN ((95 * ((sp.alim_sum2/sp.hectareas)/7) / 2.204) * 1000 / sp.Peso_final / 10000)
                                    END
                                WHEN sp.tipo_nombre IN ('KTL 2.5', 'KTL 1.2', 'KTL 2.0', 'KTL BIO 2.0', 'KTL ACL 2.0', 'KTLPTS 1.2', 'KTL 33% 2.0', 'KTL 35% 2.0', 'KTL XG 35% 2.0', 'KTL PLUS 33% 2.0', 'KTL AD 35% 2.0', 'KTL PLUS 33% 2.0') THEN
                                    CASE
                                        WHEN sp.Peso_final BETWEEN 0.10 AND 1.99 THEN ((25 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 2.00 AND 4.99 THEN ((40 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 5.00 AND 10.99 THEN ((55 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 11.00 AND 12.99 THEN ((57 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 13.00 AND 14.99 THEN ((60 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 15.00 AND 16.99 THEN ((65 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 17.00 AND 18.99 THEN ((70 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 19.00 AND 22.99 THEN ((75 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 23.00 AND 25.99 THEN ((76 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 26.00 AND 27.99 THEN ((82 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 28.00 AND 30.99 THEN ((85 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 31.00 AND 37.00 THEN ((90 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                    END
                                WHEN sp.tipo_nombre IN ('CLA 2.0', 'CLA 1.2', 'CLA 0.8', 'CLAEQAD 2.0', 'CLAEQAD BIO 2.0') THEN
                                    CASE
                                        WHEN sp.Peso_final BETWEEN 0.10 AND 1.99 THEN ((20 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 0.1 AND 1.99 THEN ((25 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 2.00 AND 4.99 THEN ((35 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 5.00 AND 9.99 THEN ((45 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 10.00 AND 12.99 THEN ((47 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 13.00 AND 14.99 THEN ((52 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 15.00 AND 16.99 THEN ((55 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 17.00 AND 18.99 THEN ((58 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 19.00 AND 20.99 THEN ((60 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 21.00 AND 22.99 THEN ((65 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 23.00 AND 25.99 THEN ((70 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 26.00 AND 28.99 THEN ((75 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 29.00 AND 32.99 THEN ((80 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 33.00 AND 37.00 THEN ((88 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                    END

                                WHEN sp.tipo_nombre IN ('Aquaxcel 2.0') THEN
                                    CASE
                                        WHEN sp.Peso_final BETWEEN 0.10 AND 1.99 THEN ((20 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 0.1 AND 1.99 THEN ((25 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 2.00 AND 4.99 THEN ((35 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 5.00 AND 9.99 THEN ((45 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 10.00 AND 12.99 THEN ((47 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 13.00 AND 14.99 THEN ((52 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 15.00 AND 16.99 THEN ((55 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 17.00 AND 18.99 THEN ((58 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 19.00 AND 20.99 THEN ((60 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 21.00 AND 22.99 THEN ((65 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 23.00 AND 25.99 THEN ((70 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 26.00 AND 28.99 THEN ((75 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 29.00 AND 32.99 THEN ((80 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 33.00 AND 37.00 THEN ((88 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                    END
                                WHEN sp.tipo_nombre IN ('TRP 2', 'TRP 1.2') THEN
                                    CASE
                                        WHEN sp.Peso_final BETWEEN 0.10 AND 1.99 THEN ((20 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 0.1 AND 1.99 THEN ((25 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 2.00 AND 4.99 THEN ((35 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 5.00 AND 9.99 THEN ((45 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 10.00 AND 12.99 THEN ((47 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 13.00 AND 14.99 THEN ((52 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 15.00 AND 16.99 THEN ((55 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 17.00 AND 18.99 THEN ((58 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 19.00 AND 20.99 THEN ((60 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 21.00 AND 22.99 THEN ((65 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 23.00 AND 25.99 THEN ((70 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 26.00 AND 28.99 THEN ((75 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 29.00 AND 32.99 THEN ((80 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                        WHEN sp.Peso_final BETWEEN 33.00 AND 37.00 THEN ((88 * ((sp.alim_sum2/sp.hectareas)/7)) / 2.204) * 1000 / sp.Peso_final / 10000
                                    END
                            END AS fact_rendimiento_d,

                       
                    
                            lb.lbs_proyeccion as lbs_proyecciones
                    
                            FROM simulacion_proceso_test sp, libras_proyectadas_bi lb
                    
                    
                            WHERE sp.id_camaronera IN (1,2,3,5) 
                            AND sp.id_camaronera = lb.id_camaronera
                            /*and sp.piscinas = 7
                            and sp.id_corrida = 22*/
                            AND sp.id_bio IN ('BW 7 dias', 'BW 6 dias')
                            AND sp.ciclos = 'Actual'
                            /*and sp.piscinas = 5*/
                            ORDER BY sp.id_camaronera, sp.piscinas";
                    
                            $data = $conectar->mostrar($sqlDatos);

                            $descuentoAnt = null; // Variable para almacenar el descuento anterior
                      

                            
                            foreach ($data as $row){

                                $sqlPoblacion = "SELECT ((enfermos/cantidad_animales_totales)*100) AS porcentaje_emf, 
                                        ((muertos_frescos/cantidad_animales_totales)*100) AS porcentaje_mf, 
                                        ((muertos_rojos/cantidad_animales_totales)*100) AS porcentaje_mr  
                                FROM registro_poblacion 
                                WHERE id_camaronera = '$id_camaronera' 
                                AND id_piscina = '$piscinas' 
                                AND id_corrida = '$id_corrida' 
                                AND fechaActual >= DATE_SUB(CURDATE(), INTERVAL 10 DAY) 
                                ORDER BY fechaActual DESC 
                                LIMIT 1";

                                $dataPoblacion = $conectar->mostrar($sqlPoblacion);

                                if (!empty($dataPoblacion)) {
                                    foreach ($dataPoblacion as $pb) {
                                        $porcentaje_emf = $pb['porcentaje_emf'];
                                        $porcentaje_mf = $pb['porcentaje_mf'];
                                        $porcentaje_mr = $pb['porcentaje_mr'];
                                
                                        if ($porcentaje_emf >= 1.00 || $porcentaje_mf >= 1.00 || $porcentaje_mr >= 1.00) {
                                            $mortalidad = 'Aplicar Bacterias';
                                        } else {
                                            $mortalidad = 'Normal';
                                        }
                                    }
                                } else {
                                    $mortalidad = 'Hacer Poblacion';
                                }
                                
                                // Si la condición de aplicar bacterias se cumple pero no hay datos recientes, combinar mensajes
                                if ($mortalidad === 'Aplicar Bacterias' && empty($dataPoblacion)) {
                                    $mortalidad = 'Aplicar Bacterias / Hacer Poblacion';
                                }


                            // inicio variable de uso para calculos

                                $nombre_camaronera = $row['nombre_camaronera'];
                                $id_camaronera = $row['id_camaronera'];
                                $id_bio = $row['id_bio'];
                                $fecha_muestreo = $row['fecha_muestreo'];
                                $semana_del_anio = date('W', strtotime($fecha_muestreo));
                                $piscinas = $row['piscinas'];
                                $id_corrida = $row['id_corrida'];
                                $tipo_nombre = $row['tipo_nombre'];
                                $hectareas = $row['hectareas'];
                                $dias = $row['Dias'];
                                $densidad_transferencia = $row['densidad_transferencia'];
                                $peso_transferencia = $row['peso_trasferencia'];
                                $peso_final = $row['Peso_final'];
                                $gr_dias = $row['gr_dias'];
                                $incremento = $row['incremento'];
                                $incrprm3s = $row['incrprm3s'];
                                $n = $row['n'];
                                $kg_ha_semana_m = $row['kg_ha_semana_m'];
                                $ind_x_metro_m = $row['ind_x_metro_m'];
                                $ind_x_metro_d = $row['ind_x_metro_d'];
                                $prctj_dif_al = $row['prctj_dif_al'];
                                //$poblacion = $row['poblacion'];
                                $libras_tot = $row['libras_tot'];
                                $alim_acu = $row['alim_acu'];

                                $pedidos_de_larva = $row['pedidos_de_larva'];
                                $fechas_estimadas = $row['fechas_estimadas'];
                                $bi_tri = $row['bi_tri'];
                                $cantidad_larva_ha = $row['cantidad_larva_ha'];
                                $cantidad_larva_total = $row['cantidad_larva_total'];

                                $alim_sem = $row['alim_sum2'];
                                $alim_acum = $row['alim_acu'];
                                $fecha_poblacion = $row['fecha_poblacion'];
                                $fecha_muestreo_anterior = $row['fecha_muestreo_anterior'];
                                $fecha_muestreo_anterior_max = $row['fecha_muestreo_anterior_max'];

                                $lbs_proyecciones = $row['lbs_proyecciones'];
                                $semana_alim = $row['semana_alim'];
                                



                            // fin variable de uso para calculos


                            // inicio proyeccion david
                                $b = floatval($row['Animales_bw']);
                                $c = floatval($row['fact_rendimiento_d']);
                                $d = floatval($row['ind_x_metro_d']);
                                $e = floatval($row['densidad']);
                                
                                
                                // Validar que los valores sean numéricos y no nulos.
                                $values = array_filter([$b, $c, $d, $e], function($value) {
                                    return is_numeric($value) && $value !== null;
                                });
                                
                                if (empty($values)) {
                                    // Manejar el caso en que todos los valores son inválidos.
                                    $f = 0;
                                    $g = 0;
                                } else {
                                    // Obtener el máximo y el mínimo.
                                    $f = max($values);
                                    $g = min($values);
                                }


                                $numerador = $b+$c+$d+$e-$f-$g;
                                $condicionB = ($b <> 0) ? 1 : 0; 
                                $condicionC = ($c <> 0) ? 1 : 0;
                                $condicionD = ($d <> 0) ? 1 : 0;
                                $condicionE = ($e <> 0) ? 1 : 0;

                                // Calcula el denominador
                                    $denominador = $condicionB+$condicionC+$condicionD+$condicionE+-2;

                                // Calcular el promedioNuevo
                            
                                    $promedioNuevo = $numerador / $denominador; // Calcular el promedio
                                

                                // Suponiendo que $camaronera y $tipo_nombre ya est芍n definidos y $promedioNuevo ha sido calculado previamente

                                if($id_camaronera == 2){ //AQUACAMARON


                                    if($tipo_nombre == 'CLA 2.0' || $tipo_nombre == 'CLA 1.2' || $tipo_nombre == 'CLA 0.8' || $tipo_nombre == 'CLAEQAD 2.0' || $tipo_nombre == 'CLAEQAD BIO 2.0' ){
                                        $descuento = $promedioNuevo - ($promedioNuevo * 0.05); // Redundante pero mantenido por similitud al DAX
                                    }else{
                                        $descuento = $promedioNuevo - ($promedioNuevo * 0.02); // Redundante pero mantenido por similitud al DAX
                                    }
                                }else if($id_camaronera == 5){ //GRUPO CAMARON

                                    if($tipo_nombre == 'CLA 2.0' || $tipo_nombre == 'CLA 1.2' || $tipo_nombre == 'CLA 0.8' || $tipo_nombre == 'CLAEQAD 2.0' || $tipo_nombre == 'CLAEQAD BIO 2.0' ){
                                        $descuento = $promedioNuevo - ($promedioNuevo * 0.02); // Redundante pero mantenido por similitud al DAX
                                    }else{
                                        $descuento = $promedioNuevo - ($promedioNuevo * 0.00); // Redundante pero mantenido por similitud al DAX
                                    }
                                }else if($id_camaronera == 1){ //DARSACOM


                                    if($tipo_nombre == 'CLA 2.0' || $tipo_nombre == 'CLA 1.2' || $tipo_nombre == 'CLA 0.8' || $tipo_nombre == 'CLAEQAD 2.0' || $tipo_nombre == 'CLAEQAD BIO 2.0' ){
                                        $descuento = $promedioNuevo - ($promedioNuevo * 0.06); // Redundante pero mantenido por similitud al DAX
                                    }else{
                                        $descuento = $promedioNuevo - ($promedioNuevo * 0.06); // Redundante pero mantenido por similitud al DAX
                                    }
                                }else if($id_camaronera == 3){ //JOPISA

                                    
                                    if($tipo_nombre == 'CLA 2.0' || $tipo_nombre == 'CLA 1.2' || $tipo_nombre == 'CLA 0.8' || $tipo_nombre == 'CLAEQAD 2.0' || $tipo_nombre == 'CLAEQAD BIO 2.0' ){
                                        $descuento = $promedioNuevo - ($promedioNuevo * 0.02); // Redundante pero mantenido por similitud al DAX
                                    }else{
                                        $descuento = $promedioNuevo - ($promedioNuevo * 0.02); // Redundante pero mantenido por similitud al DAX
                                    }
                                }
                                   
                                      
                            // fin proyeccion david

                            // Inicio nuevo calculo proyeccion David
                                
                                // Si hay un descuento anterior guardado, úsalo; de lo contrario, calcula el primero
                                if ($descuentoAnt === null) {
                                    $descuentoAnt = $descuento - (0.030 * $descuento);
                                }

                                // Determinar qué valor mostrar en la nueva columna
                                $valorMostrado = ($descuento < $descuentoAnt) ? $descuentoAnt : $descuento;

                                $valorMostrado;
                                // Guardar el descuento actual ajustado para la siguiente iteración
                                $descuentoAnt = $descuento - (0.030 * $descuento);


                            // Inicio nuevo calculo proyeccion David


                            // inicio libras por m2 segun proyeccion

                                $resultado_d = (($descuento * 10000) * $peso_final) / 454;
                        
                                $resultado_balanc = (($d * 10000) * $peso_final) / 454;
                        
                                $resultado_blgo = (($e * 10000) * $peso_final) / 454;

                            // fin libras por m2 segun proyeccion
                            

                            // inicio libras totales segun proyeccion
                        
                                $resultado_d_total = ((($descuento * 10000) * $peso_final) / 454 ) * $hectareas;
                        
                                $resultado_balanc_total = ((($d * 10000) * $peso_final) / 454 ) * $hectareas;
                        
                                $resultado_blgo_total = ((($e * 10000) * $peso_final) / 454 ) * $hectareas;
                        
                            // fin libras totales egun proyeccion
                            

                            // inicio factor de conversion real

                                if($libras_tot != 0){

                                    $fcvm_final_raleo_d = ($alim_acu * 2.204) / (($resultado_d + $libras_tot) * $hectareas);
                                    $fcvm_final_raleo_balan = ($alim_acu * 2.204) / (($resultado_balanc + $libras_tot) * $hectareas);
                                    $fcvm_final_raleo_blgo = ($alim_acu * 2.204) / (($resultado_blgo + $libras_tot) * $hectareas);

                                }else{

                                    $fcvm_final_raleo_d = ($alim_acu * 2.204) / (($resultado_d + 0.001) * $hectareas);
                                    $fcvm_final_raleo_balan = ($alim_acu * 2.204) / (($resultado_balanc + 0.001) * $hectareas);
                                    $fcvm_final_raleo_blgo = ($alim_acu * 2.204) / (($resultado_blgo + 0.001) * $hectareas);

                                }

                            // fin factor de conversion real
                        

                            // Inicio fcv sugerido mediante datos
                                $fcv_sugerido = 0;
                                if ($peso_final >= 0.30 && $peso_final <= 2.50) {
                                    $fcv_sugerido = 0.25;
                                } elseif ($peso_final >= 2.51 && $peso_final <= 3.50) {
                                    $fcv_sugerido = 0.30;
                                } elseif ($peso_final >= 3.51 && $peso_final <= 4.50) {
                                    $fcv_sugerido = 0.33;
                                } elseif ($peso_final >= 4.51 && $peso_final <= 5.50) {
                                    $fcv_sugerido = 0.35;
                                } elseif ($peso_final >= 5.51 && $peso_final <= 6.50) {
                                    $fcv_sugerido = 0.40;
                                } elseif ($peso_final >= 6.51 && $peso_final <= 7.50) {
                                    $fcv_sugerido = 0.45;
                                } elseif ($peso_final >= 7.51 && $peso_final <= 8.50) {
                                    $fcv_sugerido = 0.55;
                                } elseif ($peso_final >= 8.51 && $peso_final <= 9.50) {
                                    $fcv_sugerido = 0.60;
                                } elseif ($peso_final >= 9.51 && $peso_final <= 10.50) {
                                    $fcv_sugerido = 0.63;
                                } elseif ($peso_final >= 10.51 && $peso_final <= 11.50) {
                                    $fcv_sugerido = 0.65;
                                } elseif ($peso_final >= 11.51 && $peso_final <= 12.50) {
                                    $fcv_sugerido = 0.67;
                                } elseif ($peso_final >= 12.51 && $peso_final <= 13.50) {
                                    $fcv_sugerido = 0.70;
                                } elseif ($peso_final >= 13.51 && $peso_final <= 14.50) {
                                    $fcv_sugerido = 0.73;
                                } elseif ($peso_final >= 14.51 && $peso_final <= 15.50) {
                                    $fcv_sugerido = 0.75;
                                } elseif ($peso_final >= 15.51 && $peso_final <= 16.50) {
                                    $fcv_sugerido = 0.77;
                                } elseif ($peso_final >= 16.51 && $peso_final <= 17.50) {
                                    $fcv_sugerido = 0.80;
                                } elseif ($peso_final >= 17.51 && $peso_final <= 18.50) {
                                    $fcv_sugerido = 0.83;
                                } elseif ($peso_final >= 18.51 && $peso_final <= 19.50) {
                                    $fcv_sugerido = 0.85;
                                } elseif ($peso_final >= 19.51 && $peso_final <= 20.50) {
                                    $fcv_sugerido = 0.87;
                                } elseif ($peso_final >= 20.51 && $peso_final <= 21.50) {
                                    $fcv_sugerido = 0.90;
                                } elseif ($peso_final >= 21.51 && $peso_final <= 22.50) {
                                    $fcv_sugerido = 0.95;
                                } elseif ($peso_final >= 22.51 && $peso_final <= 23.50) {
                                    $fcv_sugerido = 1.05;
                                } elseif ($peso_final >= 23.51 && $peso_final <= 24.50) {
                                    $fcv_sugerido = 1.10;
                                } elseif ($peso_final >= 24.51 && $peso_final <= 25.50) {
                                    $fcv_sugerido = 1.15;
                                } elseif ($peso_final >= 25.51 && $peso_final <= 26.50) {
                                    $fcv_sugerido = 1.20;
                                } elseif ($peso_final >= 26.51 && $peso_final <= 27.50) {
                                    $fcv_sugerido = 1.25;
                                } elseif ($peso_final >= 27.51 && $peso_final <= 28.50) {
                                    $fcv_sugerido = 1.30;
                                } elseif ($peso_final >= 28.51 && $peso_final <= 29.50) {
                                    $fcv_sugerido = 1.32;
                                } elseif ($peso_final >= 29.51 && $peso_final <= 30.50) {
                                    $fcv_sugerido = 1.34;
                                } elseif ($peso_final >= 30.51 && $peso_final <= 31.50) {
                                    $fcv_sugerido = 1.35;
                                } elseif ($peso_final >= 31.51 && $peso_final <= 32.50) {
                                    $fcv_sugerido = 1.36;
                                } elseif ($peso_final >= 32.51 && $peso_final <= 33.50) {
                                    $fcv_sugerido = 1.37;
                                } elseif ($peso_final >= 33.51 && $peso_final <= 34.50) {
                                    $fcv_sugerido = 1.38;
                                } elseif ($peso_final >= 34.51 && $peso_final <= 35.50) {
                                    $fcv_sugerido = 1.39;
                                } elseif ($peso_final >= 35.51 && $peso_final <= 36.50) {
                                    $fcv_sugerido = 1.40;
                                } elseif ($peso_final >= 36.51 && $peso_final <= 40.00) {
                                    $fcv_sugerido = 1.40;
                                }

                            // fin fcv sugerido mediante datos
                            
                            // inicio raleso realizados en la corrida


                                  $sqlRaleos = "SELECT 
                                subquery.id_camaronera,
                                subquery.id_piscina,
                                MAX(CASE WHEN subquery.raleo_num = 1 THEN subquery.fecha_pesca END) AS fecha_pesca_1,
                                MAX(CASE WHEN subquery.raleo_num = 1 THEN subquery.peso_pesca END) AS peso_raleo_1,
                                MAX(CASE WHEN subquery.raleo_num = 1 THEN subquery.libras_pescadas END) AS libras_raleo_1,
                                MAX(CASE WHEN subquery.raleo_num = 2 THEN subquery.fecha_pesca END) AS fecha_pesca_2,
                                MAX(CASE WHEN subquery.raleo_num = 2 THEN subquery.peso_pesca END) AS peso_raleo_2,
                                MAX(CASE WHEN subquery.raleo_num = 2 THEN subquery.libras_pescadas END) AS libras_raleo_2,
                                MAX(CASE WHEN subquery.raleo_num = 3 THEN subquery.fecha_pesca END) AS fecha_pesca_3,
                                MAX(CASE WHEN subquery.raleo_num = 3 THEN subquery.peso_pesca END) AS peso_raleo_3,
                                MAX(CASE WHEN subquery.raleo_num = 3 THEN subquery.libras_pescadas END) AS libras_raleo_3
                                FROM (
                                SELECT 
                                    t1.id_camaronera,
                                    t1.id_piscina,
                                    t1.fecha_pesca,
                                    t1.peso_pesca,
                                    t1.libras_pescadas,
                                    ROW_NUMBER() OVER (PARTITION BY t1.id_camaronera, t1.id_piscina ORDER BY t1.fecha_pesca) AS raleo_num
                                FROM 
                                    registro_pesca_engorde AS t1
                                WHERE 
                                    t1.id_camaronera = '$id_camaronera'
                                    AND t1.id_piscina = '$piscinas'
                                    AND t1.id_corrida = '$id_corrida'
                                    AND t1.estado = 'Raleo'
                                ) AS subquery";
                                        $dataRaleo = $conectar->mostrar($sqlRaleos);


                                        foreach ($dataRaleo as $r) {
                                            
                                            $fecha_pesca_1 = $r['fecha_pesca_1'];
                                            $peso_raleo_1 = $r['peso_raleo_1'];
                                            $libras_raleo_1 = $r['libras_raleo_1'];
                                            $fecha_pesca_2 = $r['fecha_pesca_2'];
                                            $peso_raleo_2 = $r['peso_raleo_2'];
                                            $libras_raleo_2 = $r['libras_raleo_2'];
                                            $fecha_pesca_3 = $r['fecha_pesca_3'];
                                            $peso_raleo_3 = $r['peso_raleo_3'];
                                            $libras_raleo_3 = $r['libras_raleo_3'];
                                            
                                            
                                        }

                            // fin raleso realizados en la corrida

                            // inicio poblacion promedio 


                                $sqlPoblacionProm = "SELECT 
                                t1.id_camaronera, 
                                t1.id_piscina, 
                                t1.id_corrida, 
                                t1.cantidad AS ultima_poblacion,  
                                t1.fechaActual AS fechaUltima
                            FROM registro_poblacion AS t1
                            WHERE 
                                t1.id_camaronera = '$id_camaronera'
                                AND t1.id_piscina = '$piscinas'
                                AND t1.id_corrida = '$id_corrida'
                                AND t1.fechaActual = (
                                    SELECT MAX(t2.fechaActual) 
                                    FROM registro_poblacion AS t2
                                    WHERE 
                                        t2.id_camaronera = t1.id_camaronera
                                        AND t2.id_piscina = t1.id_piscina
                                        AND t2.id_corrida = t1.id_corrida
                                        AND t2.fechaActual <= 
                                            (SELECT 
                                                IF(MAX(fechaActual) >= '$fecha_muestreo', MAX(fechaActual), MAX(fechaActual) - INTERVAL 1 DAY) 
                                            FROM registro_poblacion 
                                            WHERE 
                                                id_camaronera = '$id_camaronera' 
                                                AND id_piscina = '$piscinas' 
                                                AND id_corrida = '$id_corrida')
                                )
                            ORDER BY t1.fechaActual DESC
                            LIMIT 1";
                                

                                        $dataPoblacion = $conectar->mostrar($sqlPoblacionProm);


                                        foreach ($dataPoblacion as $p) {
                                            
                                            $ultima_poblacion = $p['ultima_poblacion']/10000;
    
                                        }

                            // fin poblacion promedio

                            


                        
                            // inicio consulta SQL para insertar los datos

                                $sql_insert = "INSERT INTO `pw_resumen_general`( `nombre_camaronera`, `id_camaronera`, `semana`, `fecha_muestreo`, `id_bio`, `id_piscina`, `id_corrida`, `tipo_nombre`, 
                                `hectareas`, `dias`, `densidad_transferencia`, `peso_transferencia`, `peso_final`, `gr_dias`, `incremento`, `incrprm3s`, `n`, `kg_ha_semana_m`, `ind_x_metro_m`, `ind_x_metro_d`,
                                `prctj_dif_al`, `densidad`, `poblacion`, `proyeccion_balanc`, `proyeccion_david`, `lbs_proyecciones`, `resultado_d`, `resultado_balanc`, `resultado_blgo`, `resultado_d_total`,
                                `resultado_balanc_total`, `resultado_blgo_total`, `libras_tot`, `fcvm_final_raleo_d`, `fcvm_final_raleo_balan`, `fcvm_final_raleo_blgo`, `fcv_sugerido`, `pedidos_de_larva`, 
                                `fechas_estimadas`, `bi_tri`, `cantidad_larva_ha`, `cantidad_larva_total`, `mortalidad`, `alim_sem`, `alim_acum`, `fecha_siembra`, `fecha_pesca_1`, `peso_raleo_1`, `libras_raleo_1`,
                                `fecha_pesca_2`, `peso_raleo_2`, `libras_raleo_2`, `fecha_pesca_3`, `peso_raleo_3`, `libras_raleo_3`, `valorMostrado`, `ultima_poblacion`
                                
                                ) VALUES (
                                    '$nombre_camaronera', '$id_camaronera', '$semana_del_anio', '$fecha_muestreo', '$id_bio', '$piscinas', '$id_corrida', '$tipo_nombre', '$hectareas', '$dias', 
                                    '$densidad_transferencia', '$peso_transferencia', '$peso_final', '$gr_dias', '$incremento', 
                                    '$incrprm3s', '$n', '$kg_ha_semana_m', '$ind_x_metro_m', '$ind_x_metro_d', '$prctj_dif_al', '$e', '$poblacion', 
                                    '$d', '$descuento', '$lbs_proyecciones', '$resultado_d', '$resultado_balanc', '$resultado_blgo', 
                                    '$resultado_d_total', '$resultado_balanc_total', '$resultado_blgo_total', '$libras_tot', '$fcvm_final_raleo_d', 
                                    '$fcvm_final_raleo_balan', '$fcvm_final_raleo_blgo', '$fcv_sugerido', '$pedidos_de_larva', '$fechas_estimadas', '$bi_tri', '$cantidad_larva_ha', '$cantidad_larva_total',
                                    '$mortalidad', '$alim_sem', '$alim_acum', '$fecha_siembra', '$fecha_pesca_1', '$peso_raleo_1', '$libras_raleo_1', '$fecha_pesca_2', '$peso_raleo_2', '$libras_raleo_2', 
                                    '$fecha_pesca_3', '$peso_raleo_3', '$libras_raleo_3', '$valorMostrado', '$ultima_poblacion'
                                )";

                                        
                                //$insert = mysqli_query($conexion, $sql_insert);
                                
                            // fin consulta SQL para insertar los datos
?>
                    <tbody>
                        
                        
                      
                           
                    <tr>
                        
                            <td><?php echo $fecha_muestreo;  ?></td>
                            <td><?php echo $piscinas;  ?></td>
                            <td><?php echo $tipo_nombre; ?></td>
                            <td><?php echo $hectareas; ?></td>
                            <td><?php echo $dias; ?></td>
                            <td><?php echo $densidad_transferencia; ?></td>
                            <td><?php echo $peso_transferencia; ?></td>
                            <td><?php echo $peso_final; ?></td>
                            <td><?php echo $gr_dias; ?></td>
                            <td><?php echo $incremento; ?></td>
                            <td><?php echo $incrprm3s; ?></td>
                            
                            <td><?php echo $kg_ha_semana_m; ?></td>
                            <td><?php echo $ind_x_metro_m; ?></td>
                            <td><?php echo $prctj_dif_al; ?></td>
                            <td><?php echo $e; ?></td>
                            <td><?php echo $poblacion; ?></td>
                            <td><?php echo $d; ?></td>
                            <td><?php echo $descuento; ?></td>
                            <td><?php echo $resultado_d; ?></td>
                            <td><?php echo $resultado_d_total; ?></td>
                            <td><?php echo $fcvm_final_raleo_d; ?></td>
                            <td><?php echo $fcv_sugerido; ?></td>
                            
                        </tr>

                                                        
                            
                        
                    </tbody>
                        <?php  } ?>
                          
                     <?php   } ?>


            <?php } ?>

            </table>
        </div>

    </div>
</body>

<script>
    function validatePassword() {
        const password = document.getElementById('passwordInput').value;
        const correctPassword = 'developer'; // Cambia esta clave a la que desees

        if (password === correctPassword) {
            document.getElementById('secretDiv').style.display = 'block'; // Muestra el div
            document.getElementById('acceso').style.display = 'none'; // Muestra el div
        } else {
            alert('Clave incorrecta, inténtalo de nuevo.');
        }
    }
</script>
