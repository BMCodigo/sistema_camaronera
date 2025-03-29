<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Chart</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <style>
        /* Estilos para el gráfico */
        .line {
            fill: none;
            stroke: steelblue;
            stroke-width: 2px;
        }
    </style>
</head>
<body>
    <svg id="balanceChart" width="800" height="400"></svg>

    <script>
        // Datos de ejemplo para un mes (abril de 2024)
        const data = [
            { date: new Date(2024, 3, 1), count: 5 },
            { date: new Date(2024, 3, 2), count: 8 },
            { date: new Date(2024, 3, 3), count: 12 },
            // Agrega más datos aquí
        ];

        // Configuración del gráfico
        const margin = { top: 20, right: 30, bottom: 30, left: 50 };
        const width = 800 - margin.left - margin.right;
        const height = 400 - margin.top - margin.bottom;

        // Escala x para las fechas
        const x = d3.scaleTime()
            .domain(d3.extent(data, d => d.date))
            .range([0, width]);

        // Escala y para el recuento de cambios
        const y = d3.scaleLinear()
            .domain([0, d3.max(data, d => d.count)])
            .range([height, 0]);

        // Generador de línea
        const line = d3.line()
            .x(d => x(d.date))
            .y(d => y(d.count));

        // SVG para el gráfico
        const svg = d3.select("#balanceChart")
            .append("g")
            .attr("transform", `translate(${margin.left},${margin.top})`);

        // Eje x
        svg.append("g")
            .attr("transform", `translate(0,${height})`)
            .call(d3.axisBottom(x));

        // Eje y
        svg.append("g")
            .call(d3.axisLeft(y));

        // Línea del gráfico
        svg.append("path")
            .datum(data)
            .attr("class", "line")
            .attr("d", line);
    </script>
</body>
</html>
