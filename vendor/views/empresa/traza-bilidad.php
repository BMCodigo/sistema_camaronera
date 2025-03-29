<?php 


try {
    
 //   $conn = new PDO("odbc:Driver={SQL Server};Server=192.168.10.4;Database=ECUACAMARON", "sa", "Solmak*2");
  //  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);var_dump($conn);
  //  echo "Conexión exitosa.";
} catch(PDOException $e) {
 //  echo "Error de conexión: " . $e->getMessage();
}

/*

try {
    $serverName='200.124.243.107';
    $conn = new PDO("sqlsrv:Server=$serverName;Database=" . $connectionOptions['ECUACAMARON'], $connectionOptions['sa'], $connectionOptions['Solmak*2']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión establecida correctamente.";
} catch (PDOException $e) {
    die("Error en la conexion: " . $e->getMessage());
}


$conn = null;

if (extension_loaded('pdo_sqlsrv')) {
    echo "La extensin pdo_sqlsrv est habilitada.";
} else {
    echo "La extensin pdo_sqlsrv no est habilitada.";
}

if (extension_loaded('sqlsrv')) {
    echo "La extensin sqlsrv est habilitada.";
} else {
    echo "La extensin sqlsrv no est habilitada.";
}
*/

/*
<?php
$serverName = "localhost";
$connectionOptions = array(
    "Database" => "",
    "Uid" => "",
    "PWD" => ""
);

try {
    $conn = new PDO("sqlsrv:Server=$serverName;Database=NombreBaseDeDatos", $connectionOptions['Uid'], $connectionOptions['PWD']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión establecida correctamente.";
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}


$conn = null;
?>



<?php
$serverName = "localhost";
$connectionOptions = array(
    "Database" => "",
    "Uid" => "",
    "PWD" => ""
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Conexión establecida correctamente.";
}


sqlsrv_close($conn);
?>




$serverName = "serverName\\sqlexpress"; //serverName\instanceName
$connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

$serverName = "serverName\\sqlexpress, 1542"; //serverName\instanceName, portNumber (default is 1433)
$connectionInfo = array( "Database"=>"dbName", "UID"=>"userName", "PWD"=>"password");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}









<?php
$serverName = "nombre_servidor";
$connectionOptions = array(
    "Database" => "nombre_base_datos",
    "Uid" => "nombre_usuario",
    "PWD" => "contraseña"
);


?>

*/

            $sql_trace = "
    (SELECT y.id_secuencia, y.fecha_entrega, y.id_piscina, 
         y.id_corrida, y.cantidad_balanceado, y.tipo_balanceado,
            y.camaronera, y.encargado,y.descripcion,y.sobrante, y.estado,
                 x.fecha_registro, x.cantidad_balanceado, x.tipo_balanceado, x.sobrante, x.responsable, x.id_bitacora 
                     FROM bitacora_balanceado x
                         INNER JOIN solicitud_balanceados y 
                      ON x.id_balanceado = y.id_balanceado 
                WHERE TRUE 
            AND y.fecha_entrega = '2024-04-29'
    	AND y.camaronera <= '1'
    AND y.estado = 'Aprobado' 
         ORDER BY y.id_piscina ASC , x.id_bitacora ASC);
     ";
$trace = new corrida();
if (isset($_POST['start-date']) AND ($_POST['start-date'] !=NULL) AND
    isset($_POST['end-date']) AND ($_POST['end-date'] !=NULL))
{
         $date_ini=$_POST['start-date']; $date_fin = $_POST['end-date'];
        $sql_trace = "
        (SELECT COUNT(*) AS modificaciones, y.camaronera AS camaronera, y.fecha_entrega AS fecha FROM bitacora_balanceado x
            INNER JOIN solicitud_balanceados y 
                ON x.id_balanceado = y.id_balanceado 
                    WHERE TRUE 
                        AND y.fecha_entrega >= '$date_ini'
                    AND y.fecha_entrega <= '$date_fin'
                AND y.estado = 'Aprobado'  GROUP BY fecha
            ORDER BY y.fecha_entrega ASC , y.camaronera ASC);
        ";
            $data = $trace->mostrar($sql_trace);  
    
} else {
        $sql_trace = "
        (SELECT COUNT(*) AS modificaciones, y.camaronera AS camaronera, y.fecha_entrega AS fecha FROM bitacora_balanceado x
            INNER JOIN solicitud_balanceados y 
                ON x.id_balanceado = y.id_balanceado 
                    WHERE TRUE 
                    AND y.fecha_entrega >='2024-06-24'
                AND y.estado = 'Aprobado'  GROUP BY fecha
            ORDER BY y.fecha_entrega ASC , y.camaronera ASC);
        ";
            $data = $trace->mostrar($sql_trace);//var_dump($data);
}
//echo $data[0]['fecha'].'---|';
//echo $data[0]['camaronera'].'---|';
//echo $data[0]['modificaciones'].'---|';

     for($x = 1; $x <= count($data); $x++){ 
        for ($y=1; $y <=5 ; $y++){
                $matrix[$x][$data[$x-1]['fecha']][$y]= 0;
     //   echo $matrix[$data[$x-1]['fecha']][$y];
        }
     }

     for($x = 1; $x <= count($data); $x++){ 

         $matrix[$x][$data[$x-1]['fecha']][$data[$x-1]['camaronera']]= intval($data[$x-1]['modificaciones']);
          $matrix[$x]['fecha'] = $data[$x-1]['fecha'];
     }
//echo $matrix[1]['2024-04-29'][1];
//var_dump($matrix);


    $datas = [];
    for($x = 1; $x <= count($matrix); $x++){ 
    $date =  $matrix[$x]['fecha'];
    $formattedModifications = array_values($matrix[$x][$date]);
    $datas[] = ['date' => $date, 'modifications' => $formattedModifications];
     }
     $jsDatas = json_encode($datas);

//$matrix[][]=Null;
/*foreach ($data as $value) { 
     for($x = 1; $x >= 5; $x++){ 
  if ($matrix[$value['fecha']][$x]==NULL) {
$matrix[$value['fecha']][$x]=7;
    }
  
        }
      var_dump($matrix);
}*/
/*
foreach ($data as $value) { 
     for($x = 1; $x >= 5; $x++){ 
echo $value['fecha'];
        }}*/
        /*
foreach ($data as $value) { 
$matrix[$value['fecha']][$value['camaronera']]=$value['modificaciones'];
        }*/
/*foreach ($data as $value) {
 for($x = 1; $x >= 5; $x++){
    if (!isset($matrix[$value['fecha']][$value['camaronera']])) {
$matrix[$value['fecha']][$value['camaronera']]=0;
    }
}}*/
  // echo $matrix['2024-04-29'][1];echo $data[0]['modificaciones']

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;
    }

    svg {
        display: block;
        margin: 0 auto;
    }

    
    .axis path,
    .axis line {
        fill: none;
        stroke: #888;
        shape-rendering: crispEdges;
    }

    .axis text {
        font-size: 12px;
    }


    .diamond {
        stroke: none; 
    }

    
    .diamond {
        transition: r 0.3s ease;
    }

    .diamond:hover {
        r: 7;
    }

    
    .legend {
        font-size: 14px;
        display: flex; 
        align-items: center; /
        justify-content: flex-start; 
        position: absolute;
        top: 10px; 
        right: 10px; 
    }

    .legend rect {
        width: 10px;
        height: 10px;
        margin-right: 5px;
        cursor: pointer; 
    }

    .hidden {
        display: none; 
    }

    /* Styling for table */
    #table-container {
        margin-top: 20px;
        margin-left: auto;
        margin-right: auto;
        max-width: 600px;
        border-collapse: collapse;
        border: 1px solid #ccc;
        background-color: #fff;
    }

    #data-table th, #data-table td {
        padding: 8px 12px;
        border: 1px solid #ccc;
        text-align: left;
        min-width: 200px;
    }

    #data-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    
     form {
        margin-top: 20px;
        text-align: center;
    }

    form label {
        margin-right: 10px;
    }

    form input[type="date"] {
        padding: 6px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
    }

    form input[type="submit"] {
        padding: 8px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        background-color: #45a049;
    }
    
            .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0%;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            left: 10%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
</head>
<body>
     <form method="POST">
        <label for="start-date">Fecha Inicial:</label>
        <input type="date" id="start-date" name="start-date">
        <label for="end-date">Fecha Final:</label>
        <input type="date" id="end-date" name="end-date">
        <input type="submit" value="Actualizar">
    </form>
    <div id="table-container">
     <table id="data-table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Camaronera</th>
            <th>Modificaciones en Solicitud</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td id="fecha">--------------</td>
            <td id="camaronera">--------------</td>
            <td id="modificaciones">--------------</td>
        </tr>
    </tbody>
</table>
    </div>
    <svg id="traceability-graph"></svg>
     <div id="legend-container"></div> 
     
             <div class="container" style="margin-top: -20px;">
     <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
    <table id="modal-table" class="conatiner table table-bordered table-sm"></table>
    </div>
</div></div>

    <script>
    let data = <?php echo $jsDatas; ?>;
let datases = [
    { date: "2024-04-01", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-02", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-03", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-04", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-05", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-06", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-07", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-08", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-09", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-10", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-11", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-12", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-13", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-14", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-15", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-16", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-17", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-18", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-19", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-20", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-21", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-22", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-23", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-24", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-25", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-26", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-27", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-28", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-29", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
    { date: "2024-04-30", modifications: [Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10), Math.floor(Math.random() * 10)] },
];

let datas = [
  { date: "2024-04-29", modifications: [7, 0, 0, 0, 0] }
];


        // Set the dimensions of the SVG container
        const margin = { top: 20, right: 30, bottom: 30, left: 50 };
        const width = 800 - margin.left - margin.right;
        const height = 400 - margin.top - margin.bottom;

        // Append the SVG object to the body of the page
        const svg = d3.select("#traceability-graph")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", `translate(${margin.left}, ${margin.top})`);

        // Parse the date / time
        const parseDate = d3.timeParse("%Y-%m-%d");

        // Format the data
        data.forEach(d => {
            d.date = parseDate(d.date);
        });

        // Set the ranges
        const x = d3.scaleTime().range([0, width]);
        const y = d3.scaleLinear().range([height, 0]);

        // Scale the range of the data
        x.domain(d3.extent(data, d => d.date));
        y.domain([0, d3.max(data, d => d3.max(d.modifications))]);

        // Draw x-axis
        svg.append("g")
        //    .attr("transform", `translate(0, ${height})`)
         //   .call(d3.axisBottom(x).ticks(5).tickFormat(d3.timeFormat("%Y-%m-%d")));
    .attr("transform", `translate(0, ${height})`)
    .call(d3.axisBottom(x)
        .ticks(d3.timeDay.every(2)) 
        .tickFormat(d3.timeFormat("%d"))); 

        // Draw y-axis
        svg.append("g")
            .call(d3.axisLeft(y));

        // Draw the lines and points for each person
        const persons = ["Darsacom", "Jopisa", "Aquacamaron", "Aquanatura", "grupoCamaron"];
        const lines = [];
        const points = [];
        persons.forEach((person, i) => {
            // Draw the line
            const line = svg.append("path")
                .datum(data)
                .attr("fill", "none")
                .attr("stroke", () => d3.schemeCategory10[i])
                .attr("stroke-width", 4)
                .attr("class", "hidden") 
                .attr("d", d3.line()
                    .x(d => x(d.date))
                    .y(d => y(d.modifications[i]))
                );

            lines.push(line.node()); // Store line elements for toggling


// Draw the points
const point = svg.selectAll(`.${person}-point`)
    .data(data) 
    .enter().append("circle")
    .attr("class", `${person}-point diamond hidden`)
    .attr("cx", d => x(d.date))
    .attr("cy", d => y(d.modifications[i]))
    .attr("r", 5)
    .attr("fill", () => d3.schemeCategory10[i])
    .style("cursor", "pointer")
    .each(function(d, j) {
        d3.select(this).datum({
            date: d.date,
            person: person,
            modification: d.modifications[i]
        });
    });

            points.push(point); // Store point elements for click event
        });

        // Add legend outside the SVG
        const legend = d3.select("#legend-container")
            .append("svg")
            .attr("width", 120)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", `translate(10, ${margin.top})`)
            .selectAll("legend")
            .data(persons)
            .enter().append("g")
            .attr("transform", (d, i) => `translate(0, ${i * 20})`) // Move each legend item down
            .attr("id", (d, i) => `legend-${i}`) // Set unique ID for each legend item
            .each(function(_, i) {
        d3.select(this).on("click", () => {
            toggleLine(i);
        });
    });
        legend.append("rect")
            .attr("x", 0)
            .attr("width", 10)
            .attr("height", 10)
            .attr("fill", (d, i) => d3.schemeCategory10[i]);

        legend.append("text")
            .attr("x", 15)
            .attr("y", 9)
            .text(d => d)
            .style("font-size", "12px")
            .attr("alignment-baseline", "middle");

        // Function to toggle line visibility
        function toggleLine(index) {
            const line = d3.select(lines[index]);
            const currentState = line.classed("hidden");
            points[index].classed("hidden", !currentState);
            line.classed("hidden", !currentState); // Toggle hidden class
        }

        // Set up click event listeners for each data point
        svg.selectAll('.diamond')
    .on("click", function(d, i) {
       //  alert("Datos: " + JSON.stringify(d));
      //  alert("Índice: " + JSON.stringify(i));
        const clickedDate = i.date;
       // const person = persons[i];
       const person = i.person;
      //  const modification = d.modifications[i];
      const modification = i.modification;
    //    alert(modification);
        updateTable(clickedDate, person, modification);
    });

        // Function to update table with clicked data point
        function updateTable(clickedDate, person, modification) {
            // Clear existing table content
            d3.select("#data-table tbody").selectAll("tr").remove();

            // Append table row with clicked data
            const row = d3.select("#data-table tbody").append("tr");
            row.append("td").text(d3.timeFormat("%Y-%m-%d")(clickedDate));
            row.append("td").text(person);
            row.append("td").text(modification);
            
            var ajaxValue = '<?php echo $_SESSION['ajax']; ?>'; 
             var formData = new FormData();
             clickedDate = d3.timeFormat("%Y-%m-%d")(clickedDate);
             formData.append('fechas', clickedDate);
             formData.append('camaroneras', person);
             formData.append('modificaciones', modification);
             var xhr = new XMLHttpRequest();
             xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
            var responseData = JSON.parse(xhr.responseText);
            showModal(responseData.test);
         //   alert(responseData.test);
            if (responseData.test.length > 0) {
             //   responseData.test.forEach(function(x) {
              //      alert(x.id_bitacora);
             //   });
            } else {
                alert("No se encontraron registros.");
            }
            } else {
                console.error('Error: ' + xhr.status);
            }
        }};
        xhr.open('POST', ajaxValue, true);
        xhr.send(formData);
        }

    function showModal(responseData) {
        const modal = document.getElementById("myModal");
        const modalTable = document.getElementById("modal-table");
        modalTable.innerHTML = ""; 

        const header = modalTable.createTHead();
        const row = header.insertRow();
        row.insertCell().innerHTML = "<b>Piscina</b>";
         row.insertCell().innerHTML = "<b>Fecha</b>";
          row.insertCell().innerHTML = "<b>Tipo</b>";
           row.insertCell().innerHTML = "<b>Cantidad</b>";
            row.insertCell().innerHTML = "<b>Sobrante</b>";
             row.insertCell().innerHTML = "<b>Responsable</b>";
                       row.insertCell().innerHTML = "<b>Tipo Def</b>";
           row.insertCell().innerHTML = "<b>Cantidad Def</b>";
            row.insertCell().innerHTML = "<b>Sobrante Def</b>";
        const body = modalTable.createTBody();
         responseData.forEach(function(x) {
            const row = body.insertRow();
          //  row.insertCell().textContent = entry.date.toISOString().split('T')[0];
          //  row.insertCell().textContent = entry.modifications[0];
           /*   
                    x.id_secuencia,
                    x.fecha_entrega, 
                    x.id_piscina, 
         x.id_corrida, 
         x.cantidad_balanceado,
         x.tipo_balanceado,
            x.camaronera,
            x.encargado,
            x.descripcion,
            x.sobrante,
            x.estado,
                 x.fecha_registro, 
                  x.cantidad_base, 
                  x.tipo_base, 
                  x.sobrante_base
                  x.responsable_base,
                  x.id_bitacora 
                    
                    */
               row.insertCell().textContent = x.id_piscina;
              row.insertCell().textContent = x.fecha_registro;
               row.insertCell().textContent = x.tipo_base;
                row.insertCell().textContent = x.cantidad_base;
                 row.insertCell().textContent = x.sobrante_base;
                  row.insertCell().textContent = x.responsable_base;
                       row.insertCell().textContent = x.tipo_balanceado;
                row.insertCell().textContent = x.cantidad_balanceado;
                 row.insertCell().textContent = x.sobrante;
        });

        modal.style.display = "block";

        const span = document.getElementsByClassName("close")[0];
        span.onclick = function () {
            modal.style.display = "none";
        };

        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };
    }
    </script>
</body>
</html>