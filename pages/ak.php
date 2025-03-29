<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balanceados Chart</title>
</head>
<body>
    <!-- Contenedor del gráfico -->
    <div id="balance-chart"></div>

    <?php
    // Datos de ejemplo: balanceados
    $balanceadosData = [
        ['fecha' => '2024-01-01', 'cantidad' => 100],
        ['fecha' => '2024-02-01', 'cantidad' => 150],
        ['fecha' => '2024-03-01', 'cantidad' => 200],
        ['fecha' => '2024-04-01', 'cantidad' => 180]
    ];
    ?>

    <!-- Script para cargar Observable Plot desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@observablehq/plot@0.6/+esm"></script>

    <script>
        // Datos de ejemplo: balanceados
        const balanceadosData = <?php echo json_encode($balanceadosData); ?>;

        // Configuración del gráfico
        const plot = Plot.plot({
            marks: [
                Plot.Line(balanceadosData, {x: "fecha", y: "cantidad", stroke: "steelblue", strokeWidth: 2}),
                Plot.Points(balanceadosData, {x: "fecha", y: "cantidad", fill: "steelblue", size: 50})
            ],
            // Etiquetas de los ejes
            x: Plot.Axis.bottom({label: "Fechas", tickLabel: {fontSize: 12, fontFamily: "Arial"}}),
            y: Plot.Axis.left({label: "Cantidad de Balanceados", tickLabel: {fontSize: 12, fontFamily: "Arial"}}),
            color: null // Desactivar la leyenda de colores
        });

        // Mostrar el gráfico en el elemento DOM con el ID "balance-chart"
        plot(document.querySelector("#balance-chart"));
    </script>
</body>
</html>
