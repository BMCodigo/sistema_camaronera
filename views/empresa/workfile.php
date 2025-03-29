/*******************************
SELECT id_camaronera AS Camaronera,fecha_alimentacion AS fecha,id_piscina AS Piscina,id_corrida AS Corrida,id_tipo_alimento AS Alimento,
cantidad AS Cantidad, id_tipo_alimento_2 AS Alimento2, cantidad_2 AS Cantidad2, 'Pendiente' AS Estado FROM registro_alimentacion_engorde
WHERE fecha_alimentacion >= '2024-04-01' AND fecha_alimentacion <='2024-04-21';

SELECT id_camaronera AS Camaronera,fecha_alimentacion AS fecha,id_precria AS Piscina,/*id_corrida AS Corrida,*/
id_tipo_alimento AS Alimento,
cantidad AS Cantidad, id_tipo_alimento_2 AS Alimento2, cantidad_2 AS Cantidad2, 'Pendiente' AS Estado FROM registro_alimentacion_precria
WHERE fecha_alimentacion >= '2024-04-01' AND fecha_alimentacion <='2024-04-21';
*/

SELECT * FROM `solicitud_balanceados` WHERE fecha_entrega >= '2024-04-15' AND  fecha_entrega <= '2024-04-18'
AND camaronera = 3 AND tipo_balanceado = 'Katal 2.0';
UPDATE `solicitud_balanceados` SET tipo_balanceado = 'Katal Bio 2.0' WHERE fecha_entrega >= '2024-04-15' AND  fecha_entrega <= '2024-04-18'
AND camaronera = 3 AND tipo_balanceado = 'Katal 2.0';

UPDATE `solicitud_balanceados` SET `tipo_balanceado` = 'Katal 2.00' WHERE `solicitud_balanceados`.`id_balanceado` = 34762;


UPDATE `solicitud_balanceados` SET tipo_balanceado = 'Katal Bio 2.0' WHERE fecha_entrega >= '2024-04-15' AND  fecha_entrega <= '2024-04-18'
AND camaronera = 3 AND tipo_balanceado = 'Katal 2.0';

SELECT * FROM `egreso_balanceado` WHERE fecha_entrega >= '2024-04-15' AND  fecha_entrega <= '2024-04-18'
AND camaronera = 3 AND tipo_balanceado = 'Katal 2.0';


UPDATE `egreso_balanceado` SET tipo_balanceado = 'Katal Bio 2.0' WHERE fecha_entrega >= '2024-04-15' AND  fecha_entrega <= '2024-04-18'
AND camaronera = 3 AND tipo_balanceado = 'Katal 2.0';

SELECT * FROM `registro_alimentacion_engorde` WHERE fecha_alimentacion >= '2024-04-15' AND  fecha_alimentacion <= '2024-04-18'
AND id_camaronera = 3 AND id_tipo_alimento = '17'; 

UPDATE `registro_alimentacion_engorde` SET id_tipo_alimento = '39' WHERE fecha_alimentacion >= '2024-04-15' AND  fecha_alimentacion <= '2024-04-18'
AND id_camaronera = 3 AND id_tipo_alimento = '17';


SELECT id_camaronera AS Camaronera,fecha_alimentacion AS fecha,id_precria AS Piscina, id_tipo_alimento AS Alimento, cantidad AS Cantidad, id_tipo_alimento_2 AS Alimento2, cantidad_2 AS Cantidad2, 'Pendiente' AS Estado FROM registro_alimentacion_precria WHERE fecha_alimentacion >= '2024-04-01' AND fecha_alimentacion <='2024-04-21' ORDER BY `fecha` ASC

INSERT INTO [INV].[tbRegistroDatosCamaronera] ([Camaronera], [fecha], [Piscina], [Alimento], [Cantidad], [Alimento2], [Cantidad2], [Estado]) VALUES
(3, '2024-04-01', '2', 2, CAST('185.00' AS NUMERIC), 0, CAST('0.00' AS NUMERIC), 'Pendiente'),
(5, '2024-04-01', '4', 44, CAST('25.00' AS NUMERIC), 0, CAST('0.00' AS NUMERIC), 'Pendiente'),
(5, '2024-04-01', '3', 44, CAST('25.00' AS NUMERIC), 0, CAST('0.00' AS NUMERIC), 'Pendiente'),
...
