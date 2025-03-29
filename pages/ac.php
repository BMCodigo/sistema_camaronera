<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Chart</title>
    <script src="https://code.highcharts.com/highcharts.js"></script>
</head>
<body>
    <div id="balanceChart" style="width: 80%; margin: auto;"></div>

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
            standardDeviations.push(deviation);
        }

        // Create the chart
        Highcharts.chart('balanceChart', {
            title: {
                text: 'Balance Chart'
            },
            xAxis: {
                categories: registrationDates,
                title: {
                    text: 'Date'
                }
            },
            yAxis: [{
                title: {
                    text: 'Number of Changes'
                }
            }, {
                title: {
                    text: 'Count of Changes (Standard Deviation)'
                },
                opposite: true
            }],
            series: [{
                name: 'Number of Changes',
                data: changesCount
            }, {
                name: 'Standard Deviation (Count of Changes)',
                data: standardDeviations,
                yAxis: 1
            }]
        });
    </script>
</body>
</html>
