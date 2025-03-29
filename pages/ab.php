<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .chart-container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <canvas id="balanceChart"></canvas>
    </div>

    <script>
        // Sample data for one month (April 2024)
        const registrationDates = [];
        const changesCount = [];
        const standardDeviations = [];

        // Generate data for all days of April 2024
        for (let i = 1; i <= 30; i++) {
            const date = `2024-04-${i < 10 ? '0' + i : i}`;
            registrationDates.push(date);
            // Add hypothetical changes count data (replace with your actual data)
            // For demonstration purposes, let's use random numbers between 0 and 10
            const count = Math.floor(Math.random() * 11);
            changesCount.push(count); 
            // Calculate standard deviation (replace this calculation with your own method)
            const deviation = Math.sqrt(count);
            standardDeviations.push({x: date, y: deviation, count: count});
        }

        // Chart initialization
        const ctx = document.getElementById('balanceChart').getContext('2d');
        const balanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: registrationDates,
                datasets: [{
                    label: 'Number of Changes',
                    data: changesCount,
                    fill: false,
                    borderColor: '#4CAF50',
                    pointBackgroundColor: '#4CAF50',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderWidth: 2
                }, {
                    label: 'Standard Deviation',
                    data: standardDeviations,
                    fill: false,
                    borderColor: '#FF5733',
                    pointRadius: 5,
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                        type: 'time',
                        time: {
                            unit: 'day',
                            displayFormats: {
                                day: 'DD MMM'
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Day of April 2024'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Changes'
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            const datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                            let label = datasetLabel;
                            if (label) {
                                label += ': ';
                            }
                            if (tooltipItem.datasetIndex === 1) {
                                const pointData = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                label += `Count: ${pointData.count}`;
                            } else {
                                label += tooltipItem.yLabel.toLocaleString();
                            }
                            return label;
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
