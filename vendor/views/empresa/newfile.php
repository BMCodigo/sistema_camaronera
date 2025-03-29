
<div class="row">
        <div class="container col-md-6">
    
            <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;"></h6>
            </div>
            <div class="card-body">
                <div class="mb-20">
    
    

    <form method="post" action="#">
        <label for="product">Seleccione Producto:</label>
        <select id="product" name="product">
            <option value="Product1">Producto 1</option>
            <option value="Product2">Producto 2</option>
            <option value="Product3">Producto 3</option>
        </select>
        <button type="button" onclick="addRow()">+</button>

        <table id="inputTable">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Piscina</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <input type="submit" value="Submit">
    </form>
    
    </div></div></div>
    
            <div class="card">
            <div class="card-header" style="background: #404e67;">
                <h6 class="text-white" style="margin:auto;"></h6>
            </div>
            <div class="card-body">
                <div class="mb-20">
    
    
      </div></div></div>
    
    
    </div>   
    </div>

    <script>
        function addRow() {
            const table = document.getElementById('inputTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();

            for (let i = 0; i < 4; i++) {
                const newCell = newRow.insertCell(i);
                const input = document.createElement('input');
                input.type = 'text';
                input.name = `field${i+1}[]`; alert( input.name);
                newCell.appendChild(input);
            }
        }
    </script>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product = $_POST['product'];
    $field1 = $_POST['field1'];
    $field2 = $_POST['field2'];
    $field3 = $_POST['field3'];
    $field4 = $_POST['field4'];

  /*   echo "<table border='1'>
           <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>";*/
    for ($i = 0; $i < count($field1); $i++) {
   /*     echo "<tr>";
        echo "<td>" . htmlspecialchars($field1[$i]) . "</td>";
        echo "<td>" . htmlspecialchars($field2[$i]) . "</td>";
        echo "<td>" . htmlspecialchars($field3[$i]) . "</td>";
        echo "<td>" . htmlspecialchars($field4[$i]) . "</td>";
        echo "</tr>";*/
    }
    echo "</table>";
}
?>



