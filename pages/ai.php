<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balanceados Chart</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <style>
        /* Estilos para el contenedor del gráfico */
        .chart-container {
            width: 100%;
            max-width: 800px;
            margin: auto;
            font-family: 'Arial', sans-serif;
        }

        /* Estilos para el gráfico */
        .chart {
            width: 100%;
            height: auto;
        }

        /* Estilos para la línea */
        .line {
            fill: none;
            stroke: #007bff;
            stroke-width: 3px;
        }

        /* Estilos para los puntos */
        .point {
            fill: #007bff;
            stroke: none;
            stroke-width: 2px;
        }

        /* Estilos para el tooltip */
        .tooltip {
            position: absolute;
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #007bff;
            padding: 10px;
            border-radius: 5px;
            display: none;
            font-size: 14px;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <!-- Contenedor del gráfico -->
    <div class="chart-container">
        <svg class="chart"></svg>
        <!-- Tooltip para mostrar información detallada -->
        <div class="tooltip"></div>
    </div>

    <script>
        // Datos de ejemplo: balanceados
        const balanceadosData = [
            { fecha: '2024-01-01', cantidad: 100 },
            { fecha: '2024-02-01', cantidad: 150 },
            { fecha: '2024-03-01', cantidad: 200 },
            { fecha: '2024-04-01', cantidad: 180 }
        ];

        // Dimensiones del gráfico y márgenes
        const margin = { top: 20, right: 20, bottom: 50, left: 50 },
            width = 800 - margin.left - margin.right,
            height = 400 - margin.top - margin.bottom;

        // Crear el contenedor SVG
        const svg = d3.select(".chart")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", `translate(${margin.left},${margin.top})`);

        // Escalas para los ejes X e Y
        const x = d3.scaleBand()
            .domain(balanceadosData.map(d => d.fecha))
            .range([0, width])
            .padding(0.1);

        const y = d3.scaleLinear()
            .domain([0, d3.max(balanceadosData, d => d.cantidad)])
            .range([height, 0]);

        // Definir la función de línea
        const line = d3.line()
            .x(d => x(d.fecha) + x.bandwidth() / 2)
            .y(d => y(d.cantidad));

        // Dibujar la línea del gráfico
        svg.append("path")
            .datum(balanceadosData)
            .attr("class", "line")
            .attr("d", line);

        // Dibujar los puntos del gráfico
        svg.selectAll(".point")
            .data(balanceadosData)
            .enter().append("circle")
            .attr("class", "point")
            .attr("cx", d => x(d.fecha) + x.bandwidth() / 2)
            .attr("cy", d => y(d.cantidad))
            .attr("r", 5)
            .on("mouseover", function(d) {
                d3.select(this).attr("fill", "#0056b3"); // Cambiar el color del punto al pasar el ratón
                // Mostrar tooltip con información detallada
                d3.select('.tooltip')
                    .style("display", "block")
                    .style("left", (d3.event.pageX + 10) + "px")
                    .style("top", (d3.event.pageY - 20) + "px")
                    .html(`<strong>${d.fecha}:</strong> ${d.cantidad} balanceados`);
            })
            .on("mouseout", function(d) {
                d3.select(this).attr("fill", "#007bff"); // Restaurar el color original del punto al salir del tooltip
                // Ocultar tooltip
                d3.select('.tooltip').style("display", "none");
            });

        // Eje X
        svg.append("g")
            .attr("class", "axis axis--x")
            .attr("transform", `translate(0,${height})`)
            .call(d3.axisBottom(x))
            .selectAll("text")
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", "rotate(-45)");

        // Eje Y
        svg.append("g")
            .attr("class", "axis axis--y")
            .call(d3.axisLeft(y));

        // Agregar título al eje Y
        svg.append("text")
            .attr("transform", "rotate(-90)")
            .attr("y", 0 - margin.left)
            .attr("x", 0 - (height / 2))
            .attr("dy", "1em")
            .style("text-anchor", "middle")
            .text("Cantidad de Balanceados")
            .attr("class", "axis-title");

        // Agregar título al gráfico
        svg.append("text")
            .attr("x", (width / 2))
            .attr("y", 0 - (margin.top / 2))
            .attr("text-anchor", "middle")
            .text("Balanceados Chart")
            .attr("class", "chart-title");

        // Tooltip
        const tooltip = d3.select(".chart-container")
            .append("div")
            .attr("class", "tooltip")
            .style("opacity", 0);
    </script>
</body>
</html>
