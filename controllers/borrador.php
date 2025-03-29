document.addEventListener('DOMContentLoaded', function() {
    var rows = document.querySelectorAll('.trazabilidad-row');
    var overlay = document.getElementById('overlay');
    var popupModal = document.getElementById('popupModal');
    var popupData = document.getElementById('popupData');
    var closeBtn = document.querySelector('.close');

    rows.forEach(function(row) {
        row.addEventListener('click', function() {
            var data = {
                id_piscina: row.getAttribute('data-id-piscina'),
                familia: row.getAttribute('data-familia'),
                semana: row.getAttribute('data-semana'),
                inicio_semana: row.getAttribute('data-inicio-semana'),
                fin_semana: row.getAttribute('data-fin-semana'),
                cantidad: row.getAttribute('data-cantidad'),
                costo: row.getAttribute('data-costo'),
                ciclo: row.getAttribute('data-ciclo')
            };

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'ruta_al_controlador_de_ajax.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    popupData.innerHTML = `
                        <p><strong>Piscina:</strong> ${response.id_piscina}</p>
                        <p><strong>Familia:</strong> ${response.familia}</p>
                        <p><strong>Semana:</strong> ${response.semana}</p>
                        <p><strong>Inicio Semana:</strong> ${response.inicio_semana}</p>
                        <p><strong>Fin Semana:</strong> ${response.fin_semana}</p>
                        <p><strong>Cantidad:</strong> ${response.cantidad}</p>
                        <p><strong>Costo:</strong> ${response.costo}</p>
                        <p><strong>Ciclo:</strong> ${response.ciclo}</p>
                        <p><strong>Información Adicional:</strong> ${response.additional_info}</p>
                    `;
                    overlay.style.display = 'block';
                    popupModal.style.display = 'block';
                } else {
                    alert('Error en la solicitud AJAX');
                }
            };

            var urlEncodedData = '';
            var urlEncodedDataPairs = [];
            for (var key in data) {
                urlEncodedDataPairs.push(encodeURIComponent(key) + '=' + encodeURIComponent(data[key]));
            }
            urlEncodedData = urlEncodedDataPairs.join('&').replace(/%20/g, '+');

            xhr.send(urlEncodedData);
        });
    });

    closeBtn.addEventListener('click', function() {
        overlay.style.display = 'none';
        popupModal.style.display = 'none';
    });

    overlay.addEventListener('click', function() {
        overlay.style.display = 'none';
        popupModal.style.display = 'none';
    });
});
