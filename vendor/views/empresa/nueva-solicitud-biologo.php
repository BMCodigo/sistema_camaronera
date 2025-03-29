<?php
//var_dump($_SERVER); 

/*
IF ($_SERVER["HTTP_SEC_FETCH_SITE"]== "same-origin" &&
$_SERVER["HTTP_SEC_FETCH_MODE"]==  "navigate" &&
$_SERVER["SERVER_NAME"]== "test.gvasco.com" &&
$_SERVER["SERVER_PORT"]==  "443" &&
$_SERVER["REQUEST_SCHEME"]==  "https" && 
$_SERVER["REQUEST_URI"]==  "/views/index.php?page=Nueva-solicitud-biologo" && 
$_SERVER["HTTPS"]==  "on" ){$valid=1;}



*/
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    date_default_timezone_set("America/Lima");
    $fecha = date('Y-m-d');
    $msj = explode( ';', $_GET['alerta'] );
    //echo $_POST['alerta'];
    
      for ($i=0; $i<count($msj); $i++){ 
      if ($msj[$i] !=NULL){
      ?>
          <div class="alert alert-danger" role="alert">
              <p style=""><?php echo $msj[$i];?></p>
              </div>
        <?php
    }}
    
        if (count($msj)>0 AND $msj[0] !=NULL){
         ?>
          <script>
            //    alert('Solicitud negada, revise los detalles de su solicitud!');
              //  window.history.go(-1);
            //    window.location.href="../views/index.php?page=Nueva-solicitud-biologo&alerta=" + "<?php echo $alerta ;?>" ;
            </script><?php
        
        
    }
?>


 
 
 

<script>
//piscina[]
// tipo_alimento[]
// cantidad[]
// sobrante[]
// despacho[]
document.addEventListener("DOMContentLoaded", function() {
    
    
    document.getElementById("main").addEventListener("submit", function(event) {
        event.preventDefault(); 
        if (revisar()) {
            document.getElementById("loading").style.display = "block";
            setTimeout(function() {
                document.getElementById("main").submit(); 
            }, 1000);
        }
    });
  
   function floater(r) {
       const res1 = parseFloat(parseFloat(r) * 1.00).toFixed(2);
  return res1;
}

  function revisar() {
      setInterval(1000);
      var referencer = 0;
      var elementosDespachos = document.querySelectorAll('span[id^="kilos[]"]');
for (var i = 0; i < elementosDespachos.length; i++) {
    var elemento = elementosDespachos[i];
    var nombreCompleto = elemento.id;
    var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[]') + 2);
    var disponer = document.getElementById('kilos[]' + tipo_alimentos).innerText;
    if (disponer <0){ referencer = disponer;}
}

 var choosed = 0;
    var elementosDespachos = document.querySelectorAll('input[name^="despachos[]"]');
    for (var i = 0; i < elementosDespachos.length; i++) {
        var elemento = elementosDespachos[i];
        if (elemento.name && elemento.name.startsWith('despachos[]')) {
            var nombreCompleto = elemento.name;
            var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[]') + 2);
            var valor = parseFloat(elemento.value);
if ( valor > 0 ) { choosed = valor;}
        }
    }
 if (referencer <0  || choosed <=0 ){ 
     alert("Su Solicitud esta vacia o incorrecta, favor revisar!");
     return false;
}
return true;
}
    
        function actualizar() {
        
        var elementosDespachos = document.querySelectorAll('span[id^="totalkilos[]"]');
for (var i = 0; i < elementosDespachos.length; i++) {
    var elemento = elementosDespachos[i];
    var nombreCompleto = elemento.id;
    var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[]') + 2);
    var kilos = parseFloat(elemento.textContent || elemento.innerText);
    document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos;
   // document.getElementById('kilos[]' + tipo_alimentos).style.backgroundColor = '#FF9966';
    fetchDatall(tipo_alimentos);
}

 /* var elementosDespachos = document.querySelectorAll('input[name^="despachos[]"]');
    var acumulados = {};
    for (var i = 0; i < elementosDespachos.length; i++) {
        var elemento = elementosDespachos[i];
        if (elemento.name && elemento.name.startsWith('despachos[]')) {
            var nombreCompleto = elemento.name;
           //    alert(nombreCompleto);
          //  var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[') + 1, nombreCompleto.indexOf(']'));
            var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[]') + 2);
                if (document.getElementById('totalkilos[]' + tipo_alimentos) !== null) {
               var kilos = document.getElementById('totalkilos[]' + tipo_alimentos);
                  var kilos = kilos.textContent || kilos.innerText;
                document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos;
            }
            var valor = parseFloat(elemento.value);
            if (!isNaN(valor)) {
                if (acumulados[tipo_alimentos] > 0) {
                    acumulados[tipo_alimentos] += valor;
                } else {
                    acumulados[tipo_alimentos] = valor;
                }
            }else{ alert(valor)}
        }
    }*/
    
   /*     for (var tipo_alimentos in acumulados) {
       // alert(tipo_alimentos);
        if (acumulados.hasOwnProperty(tipo_alimentos)) {
            const valor = acumulados[tipo_alimentos];
          //  if (document.getElementById('kilos[]' + tipo_alimentos) !== null) {
                var kilos = document.getElementById('totalkilos[]' + tipo_alimentos);
                  var kilos = kilos.textContent || kilos.innerText;
                //  alert(valor);
                document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos - valor;
          //  }
        }
    }*/
}
    
    
    
    function acumularTotalDespachosx(tipo_descripcion, tipo_kilo, tipo_alimentos) {
        
/*
var elementosDespachos = document.querySelectorAll('span[id^="totalkilos[]"]');
for (var i = 0; i < elementosDespachos.length; i++) {
     var elemento = elementosDespachos[i];
     //var kilos = parseFloat(elemento.value);
     var nombreCompleto = elemento.id;
     var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[]') + 2);
          //  var valor = parseFloat(elemento.value);
               var kilos = parseFloat(elemento.textContent || elemento.innerText);
    document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos;
}*/
/*
elementosDespachos.forEach(function(elemento) {
    var tipo_alimentos = elemento.id.replace('totalkilos[]', '');
    var valor = parseFloat(elemento.textContent || elemento.innerText);
    alert(valor);
});*/


        
     /*   var elementos = document.querySelectorAll('[id^="totalkilos[]"]').value;
alert(elementos);
elementos.forEach(function(elemento) {
    var valor = elemento.textContent || elemento.innerText;
    alert(valor);
    var tipo_alimentos = elemento.id.replace('totalkilos[]', ''); // Obtenemos el tipo de alimentos del id
    var kilos_elemento = document.getElementById('kilos[]' + tipo_alimentos); // Elemento donde se mostrará el valor
    
    if (kilos_elemento) {
        kilos_elemento.innerHTML = valor;
    }
});*/

        
        
        
        
               //   var elementos = document.querySelectorAll('span[id^="totalkilos[]"]');
                 // 
                 
                 
             //    var elementos = document.querySelectorAll('[id^="totalkilos[]"]').value;
               //  alert(elementos);
             /*   elementos.forEach(function(elemento) {
                var kilos = elemento.textContent || elemento.innerText;
                 document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos;
                });*/


         /*     elementos.forEach(function(elemento) {
                   var kilos = elemento.textContent || elemento.innerText;
                   document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos;
                document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos;
                          }*/
        
        
    var acumulados = {};
    var elementosDespachos = document.querySelectorAll('input[name^="despachos[]"]');
    for (var i = 0; i < elementosDespachos.length; i++) {
        var elemento = elementosDespachos[i];
        if (elemento.name && elemento.name.startsWith('despachos[]')) {
            var nombreCompleto = elemento.name;
            var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[]') + 2);
            var valor = parseFloat(elemento.value);
            if (!isNaN(valor) && valor > 0) {
                acumulados[tipo_alimentos] = (acumulados[tipo_alimentos] || 0) + valor;
            }
        }
    }
    for (var tipo_alimentos in acumulados) {
        if (acumulados.hasOwnProperty(tipo_alimentos)) {
            const valor = acumulados[tipo_alimentos];
             var kilos = document.getElementById('totalkilos[]' + tipo_alimentos);
            document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos - valor;
            document.getElementById('solicitud[]' + tipo_alimentos).innerHTML = valor;
        }
    }
}


    function acumularTotalDespachos(tipo_descripcion, tipo_kilo,tipo_alimentosx) {
        
        var elementosDespachos = document.querySelectorAll('span[id^="totalkilos[]"]');
for (var i = 0; i < elementosDespachos.length; i++) {
    var elemento = elementosDespachos[i];
    var nombreCompleto = elemento.id;
    var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[]') + 2);

    var kilos = parseFloat(elemento.textContent || elemento.innerText);
   /* if (kilos <= 0){
    document.getElementById('kilos[]' + tipo_alimentos).style.backgroundColor = '#FF9966';  
    } else {                          }*/
        document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos;
}


    var elementosDespachos = document.querySelectorAll('input[name^="despachos[]"]');
    var acumulados = {};
    for (var i = 0; i < elementosDespachos.length; i++) {
        var elemento = elementosDespachos[i];
        if (elemento.name && elemento.name.startsWith('despachos[]')) {
            var nombreCompleto = elemento.name;
           //    alert(nombreCompleto);
          //  var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[') + 1, nombreCompleto.indexOf(']'));
            var tipo_alimentos = nombreCompleto.substring(nombreCompleto.indexOf('[]') + 2);
                if (document.getElementById('totalkilos[]' + tipo_alimentos) !== null) {
               var kilos = document.getElementById('totalkilos[]' + tipo_alimentos);
                  var kilos = kilos.textContent || kilos.innerText;
                document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos;
            }
            var valor = parseFloat(elemento.value);
            if (!isNaN(valor)) {
                if (acumulados[tipo_alimentos] > 0) {
                    acumulados[tipo_alimentos] += valor;
                } else {
                    acumulados[tipo_alimentos] = valor;
                }
            }else{ alert(valor)}
        }
    }
    for (var tipo_alimentos in acumulados) {
       // alert(tipo_alimentos);
        if (acumulados.hasOwnProperty(tipo_alimentos)) {
            const valor = acumulados[tipo_alimentos];
          //  if (document.getElementById('kilos[]' + tipo_alimentos) !== null) {
                var kilos = document.getElementById('totalkilos[]' + tipo_alimentos);
                  var kilos = kilos.textContent || kilos.innerText;
                //  alert(valor);
                   if ((kilos -valor) <= 0){
   document.getElementById('tdkilos[]' + tipo_alimentos).style.background = '#a3fc93'; 
    document.getElementById('kilos[]' + tipo_alimentos).classList.remove('text-primary'); 
    document.getElementById('kilos[]' + tipo_alimentos).classList.add('text-danger');


    } else {      document.getElementById('kilos[]' + tipo_alimentos).classList.remove('text-danger');
                  document.getElementById('kilos[]' + tipo_alimentos).classList.add('text-primary');
                  document.getElementById('tdkilos[]' + tipo_alimentos).style.background = '#ffffff'; }
                document.getElementById('kilos[]' + tipo_alimentos).innerHTML = kilos - valor;
                document.getElementById('solicitud[]' + tipo_alimentos).innerHTML = valor;
          //  }
        }
    }
}

function acumularTotalDespachosprevio(tipo_descripcion, tipo_kilo,tipo_alimentos) {
    var elementosDespachos = document.querySelectorAll('input[name^="despachos[]"]');
      var acumulados = {};
    for (var i = 0; i < elementosDespachos.length; i++) {
        var elemento = elementosDespachos[i];
        if (elemento.name && elemento.name.startsWith('despachos[]')) {
            var nombre = tipo_alimentos;
            var valor = parseFloat(elemento.value);
            if (!isNaN(valor) && valor > 0) {
                            if (!acumulados[tipo_alimentos]) {
                    acumulados[tipo_alimentos] = 0;
                }
                acumulados[tipo_alimentos] += valor;
            }
        }
    }
    for (var nombre in acumulados) {
        if (acumulados.hasOwnProperty(nombre)) {
            document.getElementById('kilos[]' + tipo_alimentos).innerHTML = acumulados[tipo_alimentos];
        }
    }
}


function calcularTotalDespachos(tipo_descripcion, tipo_kilo,tipo_alimentos) {
    var elementosDespachos = document.querySelectorAll('input[name^="despachos[]"]');
    var total = 0;

    for (var i = 0; i < elementosDespachos.length; i++) {
        var elemento = elementosDespachos[i];
        if (elemento.name && elemento.name.startsWith('despachos[]')) {
            var valor = parseFloat(elemento.value);
            if (!isNaN(valor)) {
                total += valor;
            }
        }
    }
    
    // Actualizar el elemento HTML con el total calculado
     document.getElementById('kilos[]' + tipo_alimentos).innerHTML =  tipo_kilo ; 
   // document.getElementById('despachos[]' + tipo_descripcion).innerHTML = total; 
      document.getElementById('log').innerHTML = total; 
    
    // Puedes mostrar el total en una alerta si lo prefieres
   //  alert("Total de despachos:" + total);
}


    
function calcularTotalDespachosanterior(tipo_descripcion, tipo_kilo) {
    var elementosDespachos = document.querySelectorAll('input[id^="despachos[]"]');
   // var elementosDespachos = document.querySelectorAll('input[class^="' + tipo_descripcion + '"]');
    var total = 0;

    for (var i = 0; i < elementosDespachos.length; i++) {
     //   alert (elementosDespachos[i].name);
        var elemento = elementosDespachos[i];
        if (elemento.id && elemento.id.startsWith('despachos[]')) {
            var valor = parseFloat(elemento.value);
            if (!isNaN(valor)) {
                total += valor;
            }
        }
    }
    
//document.getElementById(tipo_descripcion).innerHTML = tipo_kilo - total; 
  //  alert("Total de despachos:" + total);
}


//calcularTotalDespachos();

//document.querySelectorAll('input[id^="despachos[]"]').forEach(function(elemento) {
 //   elemento.addEventListener('change', calcularTotalDespachos);
//});

    
    
        //     document.getElementById(idCampoTexto).id = Id;
    function fetchDatall(suffix) {
    document.getElementById('noner[]'+ suffix).style.display = 'none';
    var ajaxValue = '<?php echo $_SESSION['ajax']; ?>';
    var camaroneras = '<?php echo $_SESSION['llc']; ?>';
    var piscinas =  document.getElementById('piscinas[]' + suffix).value;
    // alert(piscinas);
    var tipo_alimentos = document.getElementById('gettipo_alimento[]' + suffix).value;
    // if (tipo_alimentos !== null && tipo_alimentos !== '') { } else { tipo_alimentos = -1; }
    var kilos = document.getElementById('kilos[]' + tipo_alimentos);
    var kilos = kilos.textContent || kilos.innerText;
    //alert(kilos);
    var cantidades = document.getElementById('cantidades[]' + suffix).value;
    //alert('x=' + tipo_alimentos);
    var sobrantes = document.getElementById('sobrantes[]' + suffix).value;
    var despachos = document.getElementById('despachos[]' + suffix).value;
    var formData = new FormData();
    formData.append('camaronera', camaroneras);
    formData.append('piscina', piscinas);
    formData.append('tipo_alimento', tipo_alimentos);
    formData.append('kilo', kilos);
    formData.append('cantidad', cantidades);
    formData.append('sobrante', sobrantes);
    formData.append('despacho', despachos);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                var cantidades = parseFloat(response.cantidades);
                var sobrantes = parseFloat(response.sobrantes);
                var despachos = parseFloat(response.despachos);
                var id_tipo = response.id_tipo;
                var tipo_descripcion = response.tipo;
                var tipo_kilo = response.kilo;
                 //   floater(despachos);
                document.getElementById('cantidad[]' + suffix).querySelector('input').value = cantidades;
                document.getElementById('sobrante[]' + suffix).querySelector('input').value = sobrantes;
                document.getElementById('despacho[]' + suffix).querySelector('input').value = despachos;
               // document.getElementById('kilos[]' + tipo_alimentos).innerHTML =  tipo_kilo ; 
                document.getElementById('despachos[]' + suffix).name = 'despachos[]' + tipo_alimentos;
               // alert(document.getElementById('despachos[]' + suffix).name);
               // document.getElementById('log').innerHTML = response.log; 
                acumularTotalDespachos(tipo_descripcion,kilos,tipo_alimentos); 
            } else {
                console.error('Error: ' + xhr.status);
            }
        }
    };
    xhr.open('POST', ajaxValue, true);
    xhr.send(formData);
}

    
    
    
    
    
    
    
    
      function fetchData() {
var ajaxValue = '<?php echo $_SESSION['ajax']; ?>';
var camaroneras = '<?php echo $_SESSION['llc']; ?>';
var piscinas =  document.getElementById('piscinas[]1').value;
var tipo_alimentos = document.getElementById('gettipo_alimento[]1').value;
var kilos = document.getElementById("kilos[]");
var kilos = kilos.textContent || kilos.innerText;
var cantidades = document.getElementById('cantidades[]1').value;
var sobrantes = document.getElementById('sobrantes[]1').value;
var despachos = document.getElementById('despachos[]1').value;
var formData = new FormData();
//formData.append('textInput', document.getElementById('textInput').value);
 // formData.append('numberInput', document.getElementById('numberInput').value);
//  formData.append('selectInput', document.getElementById('selectInput').value);
//  formData.append('fileInput', document.getElementById('fileInput').files[0]); /
formData.append('camaronera', camaroneras);
formData.append('piscina', piscinas);
formData.append('tipo_alimento', tipo_alimentos);
formData.append('kilo', kilos);
formData.append('cantidad', cantidades);
formData.append('sobrante', sobrantes);
formData.append('despacho', despachos);
           var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                   if (xhr.status === 200) {
                         var response = JSON.parse(xhr.responseText);
                     var cantidades = parseFloat(response.cantidades);
                     var sobrantes = parseFloat(response.sobrantes);
                        var despachos = parseFloat(response.despachos);
                     /*    var data4 = parseFloat(response.data4);
                          var data5 = parseFloat(response.data5);
                           var data6 = parseFloat(response.data6);
                            var data7 = parseFloat(response.data7);*/
document.getElementById('cantidad[]1').querySelector('input').value = cantidades;
document.getElementById('sobrante[]1').querySelector('input').value = sobrantes;
document.getElementById('despacho[]1').querySelector('input').value = despachos;/*
document.getElementById('despacho[]4').querySelector('input').value = data4;
document.getElementById('sobrante[]5').querySelector('input').value = data5;
document.getElementById('despacho[]5').querySelector('input').value = data6;
document.getElementById('sobrante[]6').querySelector('input').value = data7;*/
                      
//document.getElementById('sobrante[]5').innerHTML = '<input type="text" id="inputSobrante5" value="' + response.data5 + '">';
/*var elementosDespachos = document.querySelectorAll('input[id^="despachos[]"]');
var total = 0;

for (var i = 0; i < elementosDespachos.length; i++) {
    var elemento = elementosDespachos[i];
    if (elemento.id && elemento.id.startsWith('despachos[]')) {
        var valor = parseFloat(Number(elemento.value));
        if (!isNaN(valor)) {
            total += valor;
        }
    }
}
 */

//alert("Total de despachos:" + total);         
   
 //alert("Total de despachos:" + parseFloat(document.getElementById('despachos[]1').value));         
                      
                      
                      
                      
//var tipoTabla2 = document.getElementById("tipo_alimentor[]").innerText;
//var total = 0;
//var filasTabla1 = document.querySelectorAll('[id^="despacho[]"]');
//var contenidoFilas = "";

//filasTabla1.forEach(function(fila, indice) {
//    contenidoFilas += "Fila " + (indice + 1) + ": " + fila.outerHTML + "\n";
//});

//alert(contenidoFilas);
//  alert('::'+ filasTabla1 );
//filasTabla1.forEach(function(fila) {
 //   var tipoTabla1 = fila.querySelector("#tipo_alimento[]").innerText; 
  //  if (tipoTabla1 === tipoTabla2) {
  //  var valorCelda = fila.querySelector('[id^="despacho[]"]').;
   // alert(valorCelda);
     //   var valorCelda = parseFloat(fila.querySelector('[id^="despacho[]"]').innerText);
      //  total += valorCelda;
   // }
//});
//document.getElementById("solicitable").innerText = total;








//calcularTotalDespachos();//ENVIAR SUMANDOS ADICIONALEA
                   } else {
                        console.error('Error: ' + xhr.status);
                   }
                }
            };
            xhr.open('POST', ajaxValue, true);
            xhr.send(formData);
        
        }
             /*   function fetchData1() {  document.getElementById('sobrante[]1').innerHTML = '0.00'; }
     function fetchData2() {  document.getElementById('sobrante[]2').innerHTML = '0.00'; }
                function fetchData3() {  document.getElementById('sobrante[]3').innerHTML = '0.00'; }
        function fetchData4() {  document.getElementById('sobrante[]4').innerHTML = '0.00'; }
                function fetchData5() {  document.getElementById('sobrante[]5').innerHTML = '0.00'; }
        function fetchData6() {  document.getElementById('sobrante[]6').innerHTML = '0.00'; }
                function fetchData7() {  document.getElementById('sobrante[]7').innerHTML = '0.00'; }
        function fetchData8() {  document.getElementById('sobrante[]8').innerHTML = '0.00'; }
                function fetchData9() {  document.getElementById('sobrante[]9').innerHTML = '0.00'; }
        function fetchData10() {  document.getElementById('sobrante[]10').innerHTML = '0.00'; }
                function fetchData11() {  document.getElementById('sobrante[]11').innerHTML = '0.00'; }
        function fetchData12() {  document.getElementById('sobrante[]12').innerHTML = '0.00'; }*/

       // fetchData();

      /*   document.getElementById('tipo_alimento[]1').addEventListener('change', function() { fetchDatall('1'); });
          document.getElementById('tipo_alimento[]2').addEventListener('change', function() { fetchDatall('2'); });
        document.getElementById('tipo_alimento[]3').addEventListener('change', function() { fetchDatall('3'); });
        document.getElementById('tipo_alimento[]4').addEventListener('change', function() { fetchDatall('4'); });
        document.getElementById('tipo_alimento[]5').addEventListener('change', function() { fetchDatall('5'); });
        document.getElementById('tipo_alimento[]6').addEventListener('change', function() { fetchDatall('6'); });
        document.getElementById('tipo_alimento[]7').addEventListener('change', function() { fetchDatall('7'); });
        document.getElementById('tipo_alimento[]8').addEventListener('change', function() { fetchDatall('8'); });
        document.getElementById('tipo_alimento[]9').addEventListener('change', function() { fetchDatall('9'); });
        document.getElementById('tipo_alimento[]10').addEventListener('change', function() { fetchDatall('10'); });
        document.getElementById('tipo_alimento[]11').addEventListener('change', function() { fetchDatall('11'); });
        document.getElementById('tipo_alimento[]12').addEventListener('change', function() { fetchDatall('12'); });*/
        
   for (let i = 1; i <= 100; i++) {
       if ((document.getElementById('tipo_alimento[]' + i.toString())) !== null) {
    const element = document.getElementById('tipo_alimento[]' + i.toString());
     const slices = document.getElementById('cantidad[]' + i.toString());
    if (element) {
        element.addEventListener('change', function() {
            fetchDatall(i.toString());
        });
                slices.addEventListener('change', function() {
            fetchDatall(i.toString());
        });
    }
}}


 

             
    });
</script>
<!-- TABLA DE EGRESO -->
  <div id="tipo_alimentor[]">  </div>
    <img id="loading" src="../src/img/loader.gif" class="header-brand-img" alt="lavalite" style="display:none;width: 55px; position:relative;top:512px;left:400px;z-index:9999;">
 <div class="custom-alert">
</div>
 </div>
<div class="card">
<div id = "log"> </div>
    <div class="card-header" style="background: #404e67;">
        <h6 class="text-white" style="margin:auto;">BIOLOGO: NUEVA SOLICITD DE BALANCEADO</h6>
        <ul class="time-horizontal nav justify-content-center">
        <!--<li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li>-->
           <!-- <li><b><a class="nav-link text-white " href="index.php?page=Solicitud-generadas-biologo"><i class="fas fa-check-square text-success"></i><b>  Solicitudes generedas </b> </a></b></li>-->
            <!--li><b><a class="nav-link text-white " href="index.php?page=Kardex"><i class="fas fa-cubes text-success"></i> Kardex </a></b></li>-->
        </ul>
    </div>

    <div class="row mt-5 mr-2">
        <!-- SOLICITUD PARA PISICINA -->
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 mt-3">
            <div class="table table-sm table-responsive">
                <div class="scroll">
                    <form id="main" class="container" action="../controllers/insert-solicitud-biologo.php" method="post">
                        <table class="table table-sm table-bordered align-items-center mb-0">
                        
                    
                            <thead>
                                <tr class="text-center">

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Fecha </br> de entrega
                                    </th>

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">#</br>Psc
                                    </th>

                                    <!--th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cant. en </br> Psc /sacos
                                    </th-->
                                     <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Tipo <br> Balanceado
                                    </th>
                                    <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cant. </br> solicitada en kg
                                    </th>
                                             <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cant. </br> Sob.
                                    </th>
                                              <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cant. </br> desp.
                                    </th>

                                </tr>
                            </thead>

                            <tbody class="untiltime" style="display:;">

                                <?php

                                $sql = "SELECT DISTINCT(id_piscina), id_corrida  FROM registro_piscina_engorde WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_piscina";
                                $data = $conectar->mostrar($sql);
                                foreach ($data as $key) { ?>

                                    <tr>
                                        
                                        <?php if ($camaronera== 5){   ?>
                                         <!-- fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold"><input type="text" class=" form-control" name="fechaActual" value="<?php echo $fecha; ?>"  readonly style="background:none; width: 102px;"></span>
                                        </td>
                                          <?php } else {   ?>
                                                                                 <!-- fecha de entrega -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold"><input type="text" class=" form-control" name="fechaActual" value="<?php echo $fecha; ?>" readonly style="background:none; width: 102px;"></span>
                                        </td>
                                           <?php }   ?>


                                        <!-- piscina en proceso -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'piscina[]'.$key['id_piscina']; ?>" >
                                            <?php

                                                $sql_fe_sec = "SELECT MAX(fecha_entrega) AS fecha_entrega FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id = 'Piscina'";
                                                $data_fe_sec = $conectar->mostrar($sql_fe_sec);
                                                foreach ($data_fe_sec as $f) {
                                                    $fechaMax = $f['fecha_entrega'];
                                                }

                                                $sql_sec = "SELECT MAX(id_secuencia) AS id_secuencia FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id = 'Piscina'";
                                                $data_sec = $conectar->mostrar($sql_sec);
                                                foreach ($data_sec as $val) { 

                                                    if($fechaMax == $fecha){ ?>
                                                        <input type="hidden" name="secuencia" value="<?php echo $val['id_secuencia']; ?>">
                                                    <?php }else{ ?>
                                                        <input type="hidden" name="secuencia" value="<?php echo $val['id_secuencia']+1; ?>">
                                                    <?php }?>
                                            <?php } ?>

                                                <input type="text" class="input2 form-control"  id = "<?php echo 'piscinas[]'.$key['id_piscina']; ?>"  name="piscina[]" value="<?php  if($key['id_piscina'] == 22 ){ echo '17B'; }else{ echo $key['id_piscina'];} ?>" readonly style="background:none;">
                                                <input type="hidden" name="corrida[]" value="<?php echo $key['id_corrida']; ?>">

                                            </span>

                                        </td>

                                        <!-- cantidad en psicina en sacos -->
                                        <!--td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs text-center font-weight-bold"><input type="number" class="form-control text-center" name="sobrante[]" placeholder="0.0" style="width:65px;" onfocus="myFunction(this)"></span>
                                        </td-->

                                      
                                                                              <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php echo 'tipo_alimento[]'.$key['id_piscina']; ?>">

                                                <select class="select"   id = "<?php echo 'gettipo_alimento[]'.$key['id_piscina']; ?>" name= "<?php echo 'tipo_alimento[]'.$key['id_piscina']; ?>">
                                                     <option class="text-center"  id ="<?php echo 'noner[]'.$key['id_piscina']; ?>" value="-1" style"display:;">
                                                        [Seleccione]
                                                        </option>
                                                    <?php
                                                    
                                                                 $sqli = "
                                                            SELECT k.fecha, k.tipo_balanceado, k.saldo
                                                                FROM kardex k
                                                                     JOIN (
                                                                    SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id
                                                                FROM kardex
                                                                      WHERE camaronera_id = '$camaronera'
                                                                         GROUP BY tipo_balanceado
                                                                        ) max_ids
                                                                         ON k.tipo_balanceado = max_ids.tipo_balanceado
                                                                          AND k.kardex_id = max_ids.max_kardex_id;
                                                                            ";$balanceados = $objeto->mostrar($sqli);
                    
                                                //    $sqli = "SELECT * FROM `tipo_alimento` WHERE id_tipo_balanceado = '".$balanceados[0]['tipo_balanceado']."'";
                                                    
                                                    foreach ($balanceados as $balanceado) { 
                                       
                                     //  $sql="SELECT MIN(id_tipo_alimento) AS descripcion_alimento from tipo_alimento WHERE CONCAT(descripcion_alimento,' ',gramaje_alimento) = '".$balanceado['tipo_balanceado']."'";
                                     //   $tipo_alimento = $objeto->mostrar($sql);
                                      //  foreach ($tipo_alimento as $value) {
                                       //   $descripcion_alimento = $value['descripcion_alimento'];
                                          //   }
                                          
                                           $sqli = "SELECT * FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento,' ',gramaje_alimento) = '".$balanceado['tipo_balanceado']."'
                                           AND id_tipo_alimento = (SELECT MIN(id_tipo_alimento) FROM `tipo_alimento` WHERE CONCAT(descripcion_alimento,' ',gramaje_alimento) = '".$balanceado['tipo_balanceado']."'
                                           )";
                                          $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {                                          ?>

                                                        <option class="text-center" id ="<?php echo 'tipo_alimentos[]'.$key['id_piscina']; ?>" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                            <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                        </option>
                                                                     }
                                                    <?php } 
                                    
                                }?>
                                                  
                                                </select>

                                            </span>

                                            <input type="hidden" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>">
                                            <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                                            <input type="hidden" name="desc" value="<?php echo 'Consumo piscina'; ?>">
                                            <input type="hidden" name="id" value="<?php echo 'Piscina'; ?>">
                                            
                                        </td>
                                          <!-- cantidad a solicitar en kilos -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold" id="<?php echo 'cantidad[]'.$key['id_piscina'];?>">
                                                <input type="number" class=" form-control" id="<?php echo 'cantidades[]'.$key['id_piscina'];?>" name="<?php echo 'cantidades[]'.$key['id_tipo_alimento'];?>" step="any"  placeholder="0.00" style="width:85px;" onfocus="myFunction(this)">
                                            </span>
                                        </td>
                                        
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold" id="<?php echo 'sobrante[]'.$key['id_piscina'];?>">
                                            <input type="text" class=" form-control" id="<?php echo 'sobrantes[]'.$key['id_piscina'];?>" value="0.00" readonly placeholder="0.00" style="background:none; width: 54px;"></span>
                                        </td>
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold" id="<?php echo 'despacho[]'.$key['id_piscina'];?>">
                                                <input type="text" class=" form-control" id="<?php echo 'despachos[]'.$key['id_piscina'];?>" name="<?php echo 'despachos[]'.$key['id_tipo_alimento'];?>" value="0.00"  readonly placeholder="0.00" style="background:none; width: 54px;"></span>
                                        </td>

                                    <?php } ?>

                                    </tr>

                            </tbody>

                        </table>
                        
                        
                        <?php
                        $sql = "
                        SELECT count(*) AS registros FROM `solicitud_balanceados`  
                            WHERE TRUE 
                                 AND fecha_entrega >= CURDATE()
                                     AND estado = 'Aprobado'
                                          AND camaronera = '".$camaronera."'
                                               AND descripcion = 'Consumo piscina'
                                                     ORDER BY `solicitud_balanceados`.`fecha_entrega` DESC;";
                                                       
                                                          $aprobados = $objeto->mostrar($sql); 
                                                          if (intval($aprobados[0]['registros']) > 0 ) { ?>
                                                               <b style ="color:red"> Ya existe una solicitud ENGORDE aprobada el dia de hoy</b>
                                                               
                                                       <?php    } else {    ?>
                                                    <button type="submit" class="btn btn-danger btn-sm mt-3 text-center" id="add-egres">Generar solicitud Engorde</button>
                                                      <?php     }   ?>
                        
                        
                    </form>
                </div>
            </div>
        </div>

        <!-- SOLICITUD PARA PRECRIA -->
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 mt-3">
            <div class="table table-sm table-responsive">
                <div class="scroll">
                    <form class="container" action="../controllers/insert-solicitud-biologo-precria.php" method="post">
                        <table class="table table-sm table-bordered align-items-center mb-0">

                            <thead>
                                <tr class="text-center">

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Fecha </br> de entrega
                                    </th>

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">#</br>Pre
                                    </th>

                                    <!--th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cant. en </br> Psc /sacos
                                    </th-->

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Tipo <br> Balanceado
                                    </th>

                                    <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cant. </br> solicitada en kg
                                    </th>
                                    
                                   <!--  <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cant. </br> Sob.
                                    </th>
                                              <th class="text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Cant. </br> desp.
                                    </th>-->

                                </tr>
                            </thead>

                            <tbody class="untiltime" style="display:;">

                                <?php

                                    $sql_pre = "SELECT id_precria, identificacion FROM registro_piscina_precria WHERE id_camaronera = '$camaronera' AND estado = 'En proceso' ORDER BY id_precria";
                                    $data_pre = $conectar->mostrar($sql_pre);
                                    foreach ($data_pre as $key) {
                                ?>
                                    <tr>
                                          <?php if ($camaronera== 5){   ?> 
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold"><input type="text" class=" form-control" name="fechaActual" value="<?php echo $fecha; ?>" readonly style="background:none; width: 102px;"></span>
                                        </td>
                                          <?php } else {   ?>  
                                                                                  <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold"><input type="text" class=" form-control" name="fechaActual" value="<?php echo $fecha; ?>" readonly style="background:none; width: 102px;"></span>
                                        </td>
                                          <?php }   ?>
                                        <!-- fecha de entrega -->


                                        <!-- piscina en proceso -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                            <?php

                                            $sql_sec = "SELECT MAX(id_secuencia) AS id_secuencia FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id = 'Piscina'";
                                            $data_sec = $conectar->mostrar($sql_sec);
                                            foreach ($data_sec as $val) { ?>
                                            <input type="hidden" name="secuencia" value="<?php echo $val['id_secuencia']; ?>">
                                            <?php } ?>

                                                <input type="text" class="input2 form-control" name="piscina[]" value="<?php echo $key['id_precria']; ?>" readonly style="background:none;">
                                                <input type="hidden" name="corrida[]" value="<?php echo $key['identificacion']; ?>">
                                            </span>
                                        </td>

                                        <!-- cantidad en psicina en sacos -->
                                        <!--td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs text-center font-weight-bold"><input type="text" class="form-control text-center" name="sobrante[]" placeholder="0.0" style="width:65px;" onfocus="myFunction(this)"></span>
                                        </td-->



                                        <!-- tipo de alimento    -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">

                                                <!--select class="form-control" name="tipo_alimento[]" style="width:150px;">
                                                    <#?php

                                                    #$sqli = "SELECT DISTINCT tipo_balanceado FROM ingreso_balanceado WHERE camaronera = '$camaronera' AND descripcion = 'Compra' ORDER BY tipo_balanceado ASC";
                                                    #$data = $objeto->mostrar($sqli);
                                                    #foreach ($data as $value) {
                                                    #?>

                                                        <option class="text-center" value="<#?php echo $value['tipo_balanceado'] ?>">
                                                            <#?php echo $value['tipo_balanceado']; ?>
                                                        </option>

                                                    <#?php } ?>
                                                </select-->

                                                <select class="select" name="tipo_alimento[]">
                                                     <option class="text-center" value="">
                                                        [Seleccione]
                                                        </option>
                                                    <?php
                
                                                    $sqli = "SELECT * FROM `tipo_alimento`";
                                                    $data = $objeto->mostrar($sqli);
                                                    foreach ($data as $value) {
                                                    ?>

                                                        <option class="text-center" value="<?php echo $value['id_tipo_alimento'] ?>">
                                                            <?php echo $value['descripcion_alimento'].' '.$value['gramaje_alimento']; ?>
                                                        </option>

                                                    <?php } ?>
                                                </select>

                                            </span>
                                            <input type="hidden" name="encargado" value="<?php echo $nombre . ' ' . $apellido; ?>">
                                            <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                                            <input type="hidden" name="desc" value="<?php echo 'Consumo precria'; ?>">
                                            <input type="hidden" name="id" value="<?php echo 'Precria'; ?>">
                                            
                                        </td>
                                                                                <!-- cantidad a solicitar en kilos -->
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <input type="text" class="input2 form-control" name="cantidad[]" step="any" placeholder="0.0" style="width:85px;" onfocus="myFunction(this)">
                                            </span>
                                        </td>
                                           <!--<td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold"><input type="text" class=" form-control" id="sobrante2" name="sobrante2" value="<?php echo $sobrante; ?>" readonly style="background:none; width: 54px;"></span>
                                        </td>
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold"><input type="text" class=" form-control" id="despachado2" name="despachado2" value="<?php echo $despachar; ?>" readonly style="background:none; width: 54px;"></span>
                                        </td>-->

                                    <?php } ?>

                                    </tr>

                            </tbody>

                        </table>
                        <?php

                            $sqli_boton = "SELECT MAX(fecha_entrega) AS fecha_entrega FROM solicitud_balanceados WHERE camaronera = '$camaronera' AND id = 'Piscina'";
                            $data_boton = $objeto->mostrar($sqli_boton);
                            foreach ($data_boton as $value) {

                              $f_ultima=$value['fecha_entrega'];
                              $fecha;

                                if($f_ultima == $fecha){ ?>
                                
                                
                                
                                
                                
                                            <?php
                        $sql = "
                        SELECT count(*) AS registros FROM `solicitud_balanceados`  
                            WHERE TRUE 
                                 AND fecha_entrega >= CURDATE()
                                     AND estado = 'Aprobado'
                                          AND camaronera = '".$camaronera."'
                                               AND descripcion = 'Consumo precria'
                                                     ORDER BY `solicitud_balanceados`.`fecha_entrega` DESC;";
                                                       
                                                          $aprobados = $objeto->mostrar($sql); 
                                                          if (intval($aprobados[0]['registros']) > 0 ) { ?>
                                                               <b style ="color:red"> Ya existe una solicitud PRECRIA Aprobada el dia de hoy</b>
                                                               
                                                       <?php    } else {    ?>
                                                    <button type="submit" class="btn btn-primary btn-sm mt-3 text-center" id="add-egres">Gerenar solicitud Precria</button>
                                                      <?php     }   ?>
                                
                                
                                
                                
                                
                                
                                
                                
                                  
                                <?php }else{?>
                                         <?php if ($camaronera== 5){   ?>  
                                         <br/> <div class="alert alert-danger" role="alert">
                                     Debe registrar la solicitud de piscina !
                                    </div>
                                         <?php } else {   ?>  
                                                                            <br/> <div class="alert alert-danger" role="alert">
                                     Debe registrar la solicitud de piscina !
                                    </div>
                                         <?php }   ?>
                                         
                                         
                                         

                                    
                                <?php } ?>

                        <?php } ?>
                  
    
        
        
        
        
        
                <!--  -->
                     <?php  $sql ="SELECT a.id_piscina, a.id_tipo_alimento,a.cantidad, CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) as fullname FROM `registro_alimentacion_engorde`  a 
            INNER JOIN `tipo_alimento` b ON a.id_tipo_alimento = b.id_tipo_alimento
                 WHERE true
                    AND  a.fecha_alimentacion = CURDATE()-1 
                        AND a.id_camaronera = '".$camaronera."'
                           -- AND a.id_piscina = '".$piscina[$i]."'  
                            --    AND CONCAT(b.descripcion_alimento,' ',b.gramaje_alimento) = '".$alimento."';";
                             $datas = $objeto->mostrar($sql);
                             
                ?>
            <!--<div class="table table-sm table-responsive"><h6><b>Sobrantes Engorde:</b></h6>
                <div class="scroll">
                
                        <table class="table table-sm table-bordered align-items-center mb-0">

                            <thead>
                                <tr class="text-center">

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Piscina<br>Engorde
                                    </th>

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Balanceado
                                    </th>

                                    <th class=" text-white text-xxs font-weight-bolder opacity-7" style="background: #404e67;">Sobrante Kg
                                    </th>

                                </tr>
                            </thead>

                            <tbody>

                                 <?php
                          for ($i = 0; $i < count($datas); ++$i) {
                    ?>
                                <tr>
                                      
                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold"> <?php  echo $datas[$i]['id_piscina']  ; ?>
                                            </span>
                                        </td>

                                        <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"><?php   echo $datas[$i]['fullname'] ; ?>
                                                
                                            </span>
                                        </td>
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class=" text-secondary text-xs font-weight-bold"> <?php   echo $datas[$i]['cantidad'] ; ?>
                                            </span>
                                        </td>

                                    </tr>
                          <?php  } ?>
   
                                   

                            </tbody>

                        </table>
                       
                
                </div>
            </div>-->
            
            
            
                        
                <div class="col-6">
               <?php $sqli = "
                SELECT k.fecha, k.tipo_balanceado, k.saldo
                            FROM kardex k
                                JOIN (
                                    SELECT tipo_balanceado, MAX(kardex_id) AS max_kardex_id
                                        FROM kardex
                                            WHERE camaronera_id = '$camaronera'
                                                GROUP BY tipo_balanceado
                                                    ) max_ids
                                                        ON k.tipo_balanceado = max_ids.tipo_balanceado
                                                            AND k.kardex_id = max_ids.max_kardex_id;
                                                                ";$balanceados = $objeto->mostrar($sqli);
                    ?>
                    
                    
                    
                    
                    <?php
                      $sql = "SELECT * FROM tipo_alimento";
                                        $data = $objeto->mostrar($sql);

                                        $alimentos = $data;

                                        foreach ($data as $value) {
                                    
                                          $tipoalimentacion = $value['descripcion_alimento'] . ' ' . $value['gramaje_alimento'];
                                         
                                             } ?>
                                       
                                       
                      <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2" style="width:512px;">
                          
                        <thead>
                              <tr class="text-white text-center">
                                        <th colspan="4" class="bg-dark">
                                            <span class="text-white">  RESUMEN GENERAL DE STOCK EN BODEGA </span>
                                        </th>
                                    </tr>
                            <tr class="text-center">
                                  <th class="text-center text-white" style="background: #404e67;">Balanceado
                                </th>
                                 <!--<th class="text-center text-white" style="background: #404e67;">
                                    Saldo en sacos
                                </th>-->
                                 <th class="text-center text-white" style="background: #404e67;">
                                    Saldo en kilos
                                </th>
                                 <th class="text-center text-white" style="background: #404e67;">
                                    Total Solicitud
                                </th>
                                  <th class="text-center text-white" style="background: #404e67;display:;">
                                    Kg. Disponibles
                                </th>
                            </tr>
                        </thead>
                          <tbody>
                                       <?php  foreach ($balanceados as $balanceado) { 
                                       
                                       $sql="SELECT MIN(id_tipo_alimento) AS descripcion_alimento from tipo_alimento WHERE CONCAT(descripcion_alimento,' ',gramaje_alimento) = '".$balanceado['tipo_balanceado']."'";
                                        $tipo_alimento = $objeto->mostrar($sql);
                                        foreach ($tipo_alimento as $value) {
                                          $descripcion_alimento = $value['descripcion_alimento'];
                                             }
                                       ?>
                                       
                                    <tr>
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                <?php  echo $balanceado['tipo_balanceado']; ?>
                                                </span>
                                        </td>
                                       <!-- <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                 <?php  echo $balanceado['saldo']; ?>
                                                </span>
                                        </td>-->
                                          <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold" id = "<?php  echo 'totalkilos[]'.$descripcion_alimento; ?>">
                                                 <?php  
                                                       if($balanceado['tipo_balanceado'] == 'Origin 0.5'){
                                                    echo $balanceado['saldo']*10;
                                                }else if($$balanceado['tipo_balanceado'] == 'Origin 0.3'){
                                                   echo $balanceado['saldo']*10;
                                                }else {
                                                   echo $balanceado['saldo']*25;
                                                }  ?>
                                                </span>
                                        </td>
                                         <td class="align-middle text-center" style="border: 1px solid #40497C">
                                            <span class="text-secondary text-xs font-weight-bold"  id="<?php  echo 'solicitud[]'.$descripcion_alimento; ?>">
                                                 <?php  echo "0.00"; ?>
                                                </span>
                                        </td>  <td class="align-middle text-center" style="border: 1px solid #40497C;color:#336699;display:;"  id ="<?php  echo 'tdkilos[]'.$descripcion_alimento; ?>">
                                            <span class="text-secondary text-xs font-weight-bold" id ="<?php  echo 'kilos[]'.$descripcion_alimento; ?>">
                                                                                         <?php  
                                                       if($balanceado['tipo_balanceado'] == 'Origin 0.5'){
                                                    echo $balanceado['saldo']*10;
                                                }else if($$balanceado['tipo_balanceado'] == 'Origin 0.3'){
                                                   echo $balanceado['saldo']*10;
                                                }else {
                                                   echo $balanceado['saldo']*25;
                                                }  ?>
                                                    
                                                    
                                                    
                                                </span>
                                        </td>
                                    </tr>
                                      <?php }  ?>
                             <tbody>
                       </table>
                       
                         </form>
                </div>
            </div>
                      
                        
                    <table class="table table-sm table-hover table-bordered align-items-center mb-0 mt-2">
                      
                        <?php
                            $numero_alimentos = count($alimentos);
                            //$cont = 0;
                            foreach ($alimentos as $alimentito) {
                                $aux_alimentito = $alimentito['descripcion_alimento'] . ' ' . $alimentito['gramaje_alimento'];
                                
                                $movimientos = $objeto->mostrar($sql1);
                                $ban1 = 0;
                                $s = 0;
                                foreach ($movimientos as $movimiento) {
                                   
                                    foreach ($cantidad_ingreso as $cantidad_i) {
                                        $i_aux = $s;
                                        $i = $cantidad_i['cantidad_balanceado'];
                                        if ($cantidad_i['cantidad_balanceado']) {
                                            $i_m = $i;
                                        }
                                    }
                                }
                             }
                        ?>

        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        
        



                
                
                
    </div>

</div>

<style>
    .custom-alert {
  display: none;
  position: fixed;
  top: 128px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #f44336;
  color: white;
  padding: 15px;
  border-radius: 10px;
  z-index: 99999;
}
</style>