<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <div class="container">
        <h2>Trazabilidad - Consumo Semanal</h2>
        <button class="btn btn-primary" onclick="fetchWeeklyData()">Obtener datos semanales</button>
        <table id="weeklyTable" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Semana</th>
                    <th>Total Consumo</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dailyDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles de consumo diario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="dailyTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Consumption</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="path/to/bootstrap.bundle.min.js"></script>
    <script src="path/to/your/js/file.js"></script>
</body>
</html>
<script>
function fetchWeeklyData() {
    fetch('path/to/your/backend/endpoint.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ action: 'fetchWeeklyData' })
    })
    .then(response => response.json())
    .then(data => {
        populateWeeklyTable(data);
    })
    .catch(error => console.error('Error:', error));
}

function populateWeeklyTable(data) {
    const tableBody = document.getElementById('weeklyTable').getElementsByTagName('tbody')[0];
    tableBody.innerHTML = '';  // Clear previous data

    data.forEach(week => {
        const row = tableBody.insertRow();
        const cellWeek = row.insertCell(0);
        const cellTotal = row.insertCell(1);

        cellWeek.textContent = `Week ${week.weekNumber}`;
        cellTotal.textContent = week.totalConsumption;
        cellTotal.style.cursor = 'pointer';
        cellTotal.onclick = () => showDailyDetails(week.dailyDetails);
    });
}

function showDailyDetails(dailyDetails) {
    const tableBody = document.getElementById('dailyTable').getElementsByTagName('tbody')[0];
    tableBody.innerHTML = '';  // Clear previous data

    dailyDetails.forEach(day => {
        const row = tableBody.insertRow();
        const cellDate = row.insertCell(0);
        const cellConsumption = row.insertCell(1);

        cellDate.textContent = day.date;
        cellConsumption.textContent = day.consumption;
    });

    // Show modal
    const dailyDetailsModal = new bootstrap.Modal(document.getElementById('dailyDetailsModal'));
    dailyDetailsModal.show();
}
</script>