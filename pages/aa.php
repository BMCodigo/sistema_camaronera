<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance Chart</title>
    <script src="https://d3js.org/d3.v7.min.js"></script>
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

        .line {
            fill: none;
            stroke: #4CAF50;
            stroke-width: 2;
        }

        .dot {
            fill: #4CAF50;
            stroke: #fff;
            stroke-width: 2;
        }

        .text {
            font-size: 12px;
            fill: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <svg id="balanceChart"></svg>
    </div>

    <script>
        // Sample data for one month (April 2024)
        const data = [];
        const registrationDates = [];

        // Generate data for all days of April 2024
        for (let i = 1; i <= 30; i++) {
            const date = `2024-04-${i < 10 ? '0' + i : i}`;
            registrationDates.push(date);
            // Add hypothetical changes count data (replace with your actual data)
            // For demonstration purposes, let's use random numbers between 0 and 10
            const count = Math.floor(Math.random() * 11);
            data.push({ date, count });
        }

        // Set up SVG dimensions
        const margin = { top: 20, right: 20, bottom: 30, left: 50 };
        const width = 800 - margin.left - margin.right;
        const height = 400 - margin.top - margin.bottom;

        // Append SVG
        const svg = d3.select("#balanceChart")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        // Parse the date / time
        const parseTime = d3.timeParse("%Y-%m-%d");

        // Set the ranges
        const x = d3.scaleTime().range([0, width]);
        const y = d3.scaleLinear().range([height, 0]);

        // Define the line
        const valueline = d3.line()
            .x(d => x(parseTime(d.date)))
            .y(d => y(d.count));

        // Scale the range of the data
        x.domain(d3.extent(data, d => parseTime(d.date)));
        y.domain([0, d3.max(data, d => d.count)]);

        // Add the valueline path
        svg.append("path")
            .data([data])
            .attr("class", "line")
            .attr("d", valueline);

        // Add dots
        svg.selectAll(".dot")
            .data(data)
            .enter().append("circle")
            .attr("class", "dot")
            .attr("cx", d => x(parseTime(d.date)))
            .attr("cy", d => y(d.count))
            .attr("r", 5);

        // Add labels
        svg.selectAll(".text")
            .data(data)
            .enter().append("text")
            .attr("class", "text")
            .attr("x", d => x(parseTime(d.date)))
            .attr("y", d => y(d.count) - 10)
            .text(d => d.count);
    </script>
</body>
</html>
