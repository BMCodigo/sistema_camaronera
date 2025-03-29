<?php
    $objeto = new corrida();
    $conectar = new Conexion();
    $conexion = $conectar->conectar();
    $sql = "select tipo from tipos_conversion WHERE id_camaronera = '$camaronera';";
    $data = $conectar->mostrar($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Reportes Excel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="alert alert-info alert-dismissible text-uppercase fade show" role="alert">
      <strong> CRITERIOS DE CONVERSION</strong>
    </div>

    <div class="row">
        <!-- datos de alimentación de piscinas -->
        <div class="col-xl-4 col-md-12">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i title="Subir archivos" class="fas fa-file-excel text-green f-30"></i>
                        </div>
                           <form action="../controllers/actualizar-parametros1.php" method="post" enctype="multipart/form-data">
                        <div class="col pl-0">
                            <h6 class="mb-5"><strong>
                        <input type="text" class="form-control" id="registro" name="registro" value ="<?php echo $data[0]["tipo"]; ?>"  required>
                         <input type="hidden" id="camaronera" name="camaronera" class="form-control" value="<?php echo $camaronera; ?>">
                                  </strong></h6>
                            <h6 class="mb-0" style="color: #581845 ;"> <strong><u></u></strong></h6>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="excelFiles">Seleccione archivo actualizacion Excel:</label>
                            <input type="file" class="form-control" id="excelFiles" name="excels[]"  required>
                           
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </form>
                </div>
            </div>
        </div>
        
                <!-- datos de alimentación de piscinas -->
        <div class="col-xl-4 col-md-12">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i title="Subir archivos" class="fas fa-file-excel text-green f-30"></i>
                        </div>
                       <form action="../controllers/actualizar-parametros2.php" method="post" enctype="multipart/form-data">
                        <div class="col pl-0">
                            <h6 class="mb-5"><strong> 
                              <input type="text" class="form-control" id="registro" name="registro" value ="<?php echo $data[1]["tipo"]; ?>"  required>
                               <input type="hidden" id="camaronera" name="camaronera" class="form-control" value="<?php echo $camaronera; ?>">
                            </strong></h6>
                            <h6 class="mb-0" style="color: #581845 ;"> <strong><u></u></strong></h6>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="excelFiles">Seleccione archivo actualizacion Excel:</label>
                            <input type="file" class="form-control" id="excelFiles" name="excels[]"  required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </form>
                </div>
            </div>
        </div>
    
            <!-- datos de alimentación de piscinas -->
        <div class="col-xl-4 col-md-12">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i title="Subir archivos" class="fas fa-file-excel text-green f-30"></i>
                        </div>
                        <form action="../controllers/actualizar-parametros3.php" method="post" enctype="multipart/form-data">
                        <div class="col pl-0">
                            <h6 class="mb-5"><strong> 
                              <input type="text" class="form-control" id="registro" name="registro" value ="<?php echo $data[2]["tipo"]; ?>"  required>
                               <input type="hidden" id="camaronera" name="camaronera" class="form-control" value="<?php echo $camaronera; ?>">
                            </strong></h6>
                            <h6 class="mb-0" style="color: #581845 ;"> <strong><u></u></strong></h6>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="excelFiles">Seleccione archivo actualizacion Excel:</label>
                            <input type="file" class="form-control" id="excelFiles" name="excels[]"  required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </form>
                </div>
            </div>
        </div>
    
            <!-- datos de alimentación de piscinas -->
        <div class="col-xl-4 col-md-12">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i title="Subir archivos" class="fas fa-file-excel text-green f-30"></i>
                        </div>
                          <form action="../controllers/actualizar-parametros4.php" method="post" enctype="multipart/form-data">
                        <div class="col pl-0">
                            <h6 class="mb-5"><strong> 
                              <input type="text" class="form-control" id="registro" name="registro" value ="<?php echo $data[3]["tipo"]; ?>"  required>
                               <input type="hidden" id="camaronera" name="camaronera" class="form-control" value="<?php echo $camaronera; ?>">
                            </strong></h6>
                            <h6 class="mb-0" style="color: #581845 ;"> <strong><u></u></strong></h6>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="excelFiles">Seleccione archivo actualizacion Excel:</label>
                            <input type="file" class="form-control" id="excelFiles" name="excels[]"  required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </form>
                </div>
            </div>
        </div>
        
        
                <!-- datos de alimentación de piscinas -->
        <div class="col-xl-4 col-md-12">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i title="Subir archivos" class="fas fa-file-excel text-green f-30"></i>
                        </div>
                         <form action="../controllers/actualizar-parametros5.php" method="post" enctype="multipart/form-data">
                        <div class="col pl-0">
                            <h6 class="mb-5"><strong> 
                              <input type="text" class="form-control" id="registro" name="registro" value ="<?php echo $data[4]["tipo"]; ?>"  required>
                               <input type="hidden" id="camaronera" name="camaronera" class="form-control" value="<?php echo $camaronera; ?>">
                            </strong></h6>
                            <h6 class="mb-0" style="color: #581845 ;"> <strong><u></u></strong></h6>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="excelFiles">Seleccione archivo actualizacion Excel:</label>
                            <input type="file" class="form-control" id="excelFiles" name="excels[]"  required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </form>
                </div>
            </div>
        </div>
        
<div class="col-xl-4 col-md-12" style="border-radius: 10%;padding:10px;">
    <div class="card proj-t-card" style="border-radius: 50%;overflow: hidden;background-color:#DDEEFF">
        <div class="card-body" style="margin:15px;">
            <div class="row align-items-center mb-30">
                <div class="col-auto">
                    <i title="Subir archivos" class="fas fa-file-excel text-green f-30"></i>
                </div>
                <div class="col pl-0">
                    <h6 class="mb-5"><strong>Descargar Plantilla</strong></h6>
                    <h6 class="mb-0" style="color: #581845;"><strong><u></u></strong></h6>
                </div>
            </div>
            <div class="form-group">
                <label for="excelFiles">archivo actualizacion Excel:</label>
            </div>
            <a href="/../archivos/plantilla.xlsx" class="btn btn-danger">Descargar</a>
        </div>
    </div>
</div>

        
        

    </div>
</div>


<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>
