<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
            width: 100%;
            height: auto;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div style="max-width: 800px; margin: auto;">
        <canvas id="balanceChart"></canvas>
    </div>

    <script>
        // Sample data
        const registrationDates = ['2024-01-01', '2024-02-01', '2024-03-01', '2024-04-01'];
        const balancedQuantities = [100, 150, 200, 180]; // Hypothetical balanced quantities

        // Chart initialization
        const ctx = document.getElementById('balanceChart').getContext('2d');
        const balanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: registrationDates,
                datasets: [{
                    label: 'Balanced Quantities',
                    data: balancedQuantities,
                    fill: false,
                    borderColor: 'rgb(75, 192, 192)',
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointHitRadius: 10,
                    pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.4
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        type: 'time',
                        time: {
                            unit: 'month',
                            displayFormats: {
                                month: 'MMM YYYY'
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Registration Date',
                            fontSize: 14
                        },
                        ticks: {
                            fontSize: 12
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Balanced Quantity',
                            fontSize: 14
                        },
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return value.toLocaleString(); // Format y-axis labels with thousands separator
                            },
                            fontSize: 12
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let label = data.datasets[tooltipItem.datasetIndex].label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += tooltipItem.yLabel.toLocaleString(); // Format tooltip value with thousands separator
                            return label;
                        }
                    }
                },
                legend: {
                    display: true,
                    labels: {
                        fontSize: 14
                    }
                }
            }
        });
    </script>
</body>
</html>
