<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Chart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.css">
    <style>
        /* Estilos para el contenedor del gráfico */
        .chart-container {
            width: 600px; /* Ancho del contenedor */
            height: 300px; /* Altura del contenedor */
            margin: 0 auto; /* Centrar horizontalmente */
            border: 1px solid #ccc; /* Borde del contenedor */
            border-radius: 5px; /* Borde redondeado */
            overflow: hidden; /* Ocultar desbordamiento */
        }

        /* Estilos para la leyenda */
        .ct-legend {
            position: relative; /* Posición relativa */
            z-index: 10; /* Elevar por encima del gráfico */
            text-align: center; /* Alinear al centro */
            margin-top: 10px; /* Margen superior */
        }

        /* Estilos para las etiquetas del eje X */
        .ct-axis-x .ct-label {
            font-size: 10px; /* Tamaño de fuente */
        }

        /* Estilos para las etiquetas del eje Y */
        .ct-axis-y .ct-label {
            font-size: 10px; /* Tamaño de fuente */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.js"></script>
</head>
<body>
    <div class="chart-container">
        <div class="ct-chart" id="balanceChart"></div>
        <div class="ct-legend"></div>
    </div>

    <script>
        // Generar datos de ejemplo para 30 días
        const generateData = () => {
            const labels = [];
            const series1 = [];
            const series2 = [];
            for (let i = 1; i <= 30; i++) {
                const date = new Date(2024, 3, i);
                labels.push(`${date.getFullYear()}-${date.getMonth() + 1}-${date.getDate()}`);
                series1.push(Math.floor(Math.random() * 20) + 5); // Cantidad de cambios aleatoria entre 5 y 25
                series2.push(Math.sqrt(series1[series1.length - 1])); // Desviación estándar
            }
            return {
                labels,
                series: [series1, series2]
            };
        };

        // Configuración del gráfico
        const options = {
            width: '100%', // Ancho del gráfico
            height: '100%', // Altura del gráfico
            axisX: {
                labelInterpolationFnc: function (value, index) {
                    return index % 3 === 0 ? value : null; // Mostrar cada 3ª etiqueta x
                }
            },
            axisY: {
                labelInterpolationFnc: function (value) {
                    return value; // Mostrar todas las etiquetas y
                }
            },
            chartPadding: {
                top: 20, // Espacio superior
                right: 10, // Espacio derecho
                bottom: 20, // Espacio inferior
                left: 10 // Espacio izquierdo
            }
        };

        // Obtener datos de ejemplo
        const data = generateData();

        // Crear el gráfico
        const chart = new Chartist.Line('#balanceChart', data, options);

        // Agregar leyenda al contenedor del gráfico
        const legend = document.querySelector('.ct-legend');
        legend.innerHTML = chart.data.series.map((serie, index) => `<div><span class="ct-series-${index}"></span> Serie ${index + 1}</div>`).join('');
    </script>
</body>
</html>
