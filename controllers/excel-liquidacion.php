<?php

//Configurar encabezados para descargar el archivo Excel
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=Liquidacion.xls");
header("Pragma: no-cache");
header("Expires: 0");


// Conectar a la base de datos
$conexion = new mysqli("127.0.0.1:3307", "root", "", "grupo_vasco");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Configurar codificación en UTF-8
$conexion->set_charset("utf8");

// Consulta SQL
$sql = "SELECT 
f.*, f.libras_gestionadas AS libras_facturadas, f.estado AS estado_factudado, f.numero_factura AS factura_liquidado, f.peso_pesca AS peso_liquidado, -- Todos los campos de la tabla gestion_pesca_facturada
g.*, g.libras_gestionadas AS libras_solicitadas  -- Todos los campos de la tabla gestion_pesca
FROM 
gestion_pesca_facturada f
JOIN 
gestion_pesca g
ON 
f.camaronera = g.camaronera AND 
f.id_piscina = g.id_piscina AND 
f.id_corrida = g.id_corrida AND 
f.id_facturado = g.id_gestion
ORDER BY 
f.fecha_facturado DESC";
$resultado = $conexion->query($sql);

// Crear la primera fila con los encabezados (sin tabulaciones innecesarias)
echo "<html><head><style>";
// Estilos para los encabezados
echo "table {border-collapse: collapse; width: 100%;}";
echo "th {background-color: #404e67; color: white; font-weight: bold; padding: 10px;}";
echo "td {padding: 10px; text-align: center;}";
echo "th, td {border: 1px solid #ddd;}";
echo "input[type='text'] {padding: 5px;}";
echo "</style></head><body>";

echo "<div style='text-align: center; margin-bottom: 5px;'>";
echo "<h3 style='color: #404e67; margin-top: 25px;'>Liquidacion de Pesca Facturada</h3>";
echo "</div>";

echo "<table>";
echo "<thead><tr>";
echo "<th style='background: #404e67 ; color: white;'>Camaronera</th>";
echo "<th style='background: #404e67 ; color: white;'>Fecha</th>";
echo "<th style='background: #404e67 ; color: white;'>Piscina</th>";
echo "<th style='background: #404e67 ; color: white;'>Corrida</th>";
echo "<th style='background: #404e67 ; color: white;'>Libras Solicitadas</th>";
echo "<th style='background: #404e67 ; color: white;'>Libras Procesadas</th>";
echo "<th style='background: #404e67 ; color: white;'>Peso pesca</th>";
echo "<th style='background: #404e67 ; color: white;'>Cliente</th>";
echo "<th style='background: #404e67 ; color: white;'>Accion</th>";
echo "<th style='background: #404e67 ; color: white;'># factura</th>";
echo "<th style='background: #404e67 ; color: white;'>Estado</th>";
echo "<th style='background: #404e67 ; color: white;'>Check</th>";
echo "</tr></thead>";
echo "<tbody>";

// Imprimir las filas de datos con formato adecuado
while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($fila['camaronera'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . $fila['fecha_facturado'] . "</td>";
    echo "<td>" . $fila['id_piscina'] . "</td>";
    echo "<td>" . $fila['id_corrida'] . "</td>";
    echo "<td>" . number_format($fila['libras_solicitadas'], 2, ',', '') . "</td>";
    echo "<td>" . number_format($fila['libras_facturadas'], 2, ',', '') . "</td>";
    echo "<td>" . number_format($fila['peso_liquidado'], 2, ',', '') . "</td>";
    echo "<td>" . htmlspecialchars($fila['cliente'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($fila['accion'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($fila['factura_liquidado'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td>" . htmlspecialchars($fila['estado_factudado'], ENT_QUOTES, 'UTF-8') . "</td>";
    echo "<td><input type='checkbox' name='checks[]' value='' style='appearance: checkbox; -webkit-appearance: checkbox;'></td>";
    echo "</tr>";
}

echo "</tbody></table>";

// Cerrar la conexión
$conexion->close();

echo "</body></html>";
?>
