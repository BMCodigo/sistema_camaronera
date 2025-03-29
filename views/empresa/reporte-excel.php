
<div class="alert alert-info alert-dismissible text-uppercase fade show" role="alert">
  <strong>Generador de reportes excel de precrias y piscinas.</strong>
</div>

<div class="row">

    <!-- datos de siembra de psicinas -->


    <div class="col-xl-4 col-md-12">
        <a href="../controllers/excel-datos-siembra.php?datos=<?php echo $camaronera; ?>">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i title="Descargar" class="fas fa-file-excel text-green f-30"></i>
                        </div>
                        <div class="col pl-0">
                            <h6 class="mb-5"><strong> Datos de piscinas </strong></h6>
                            <h6 class="mb-0" style="color: #581845 ;"> <strong><u> Sembradas </u></strong></h6>
                        </div>
                    </div>
                    <h6 class="pt-badge" style="background: #10186E;">
                        <i class="fas fa-cloud-download-alt"></i>
                    </h6>
                </div>
            </div>
        </a>
    </div>

    <!-- datos de pesca de psicinas -->

    <div class="col-xl-4 col-md-12">
        <a href="../controllers/excel-datos-siembra-pre.php?datos=<?php echo $camaronera; ?>">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i title="Descargar" class="fas fa-file-excel text-green f-30"></i>
                        </div>
                        <div class="col pl-0">
                            <h6 class="mb-5"><strong> Reporte de precrias </strong></h6>
                            <h6 class="mb-0" style="color: #581845 ;"> <strong><u> Sembradas </u></strong></h6>
                        </div>
                    </div>

                    <h6 class="pt-badge" style="background: #AB231A;"><i class="fas fa-cloud-download-alt"></i></h6>
                </div>
            </div>
        </a>
    </div>


    <!-- datos de alimetacion de psicinas -->

    <div class="col-xl-4 col-md-12">
        <a href="#" data-toggle="modal" data-target="#exampleModal">
            <div class="card proj-t-card">
                <div class="card-body">
                    <div class="row align-items-center mb-30">
                        <div class="col-auto">
                            <i title="Descargar" class="fas fa-file-excel text-green f-30"></i>
                        </div>
                        <div class="col pl-0">
                            <h6 class="mb-5"><strong> Tabla de alimentacion </strong></h6>
                            <h6 class="mb-0" style="color: #581845 ;"> <strong><u> Semanal </u></strong></h6>
                        </div>
                    </div>
                    <h6 class="pt-badge" style="background: #10186E;"><i class="fas fa-cloud-download-alt"></i></h6>
                </div>
            </div>
        </a>
        <?php include 'modal-excel.php'; ?>
    </div>


</div>

