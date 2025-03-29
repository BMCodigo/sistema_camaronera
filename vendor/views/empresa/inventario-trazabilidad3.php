<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo de Materias Primas</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Consumo de Materias Primas</h1>
        <div id="weeklyConsumption" class="mt-4">
            <!-- Weekly consumption data will be displayed here -->
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="script.js"></script>
</body>
</html>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Load weekly consumption data when the page is loaded
    loadWeeklyConsumption();
});

function loadWeeklyConsumption() {
    // Make AJAX request to fetch weekly consumption data
    fetch('fetch_weekly_consumption.php')
    .then(response => response.json())
    .then(data => {
        // Display weekly consumption data
        displayWeeklyConsumption(data);
    })
    .catch(error => console.error('Error:', error));
}

function displayWeeklyConsumption(data) {
    const weeklyConsumptionDiv = document.getElementById('weeklyConsumption');
    weeklyConsumptionDiv.innerHTML = ''; // Clear previous content

    // Create a button for each week
    Object.keys(data).forEach(week => {
        const button = document.createElement('button');
        button.className = 'btn btn-primary mr-2 mb-2';
        button.textContent = `Semana ${week}: ${data[week]} unidades`;
        button.addEventListener('click', function() {
            // Show popup with daily consumption for this week
            showDailyConsumptionPopup(week, data[week]);
        });
        weeklyConsumptionDiv.appendChild(button);
    });
}

function showDailyConsumptionPopup(week, totalConsumption) {
    // Make AJAX request to fetch daily consumption data for this week
    fetch('fetch_daily_consumption.php?week=' + week)
    .then(response => response.json())
    .then(data => {
        // Construct HTML content for popup
        let popupContent = `<h5>Consumo diario de la semana ${week}</h5>`;
        popupContent += `<p>Total de unidades consumidas: ${totalConsumption}</p>`;
        popupContent += '<table class="table"><thead><tr><th>Día</th><th>Consumo</th></tr></thead><tbody>';
        // Add each day's consumption to the table
        Object.keys(data).forEach(day => {
            popupContent += `<tr><td>${day}</td><td>${data[day]} unidades</td></tr>`;
        });
        popupContent += '</tbody></table>';

        // Show Bootstrap modal popup
        $('#dailyConsumptionPopup .modal-body').html(popupContent);
        $('#dailyConsumptionPopup').modal('show');
    })
    .catch(error => console.error('Error:', error));
}

</script>>