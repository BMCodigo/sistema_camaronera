<!-- modal descargar excel -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title text-danger" id="exampleModalLabel">Tabla de alimentacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="../controllers/excel-tabla-alimentacion.php" onsubmit="return datoExcel()" method="POST">
                <div class="modal-body">

                    <div class="form-group row ml-5">
                        <label for="inputDesde text-dark" class="col-sm-2 col-form-label text-dark ml-4">Selecione </label>
                        <div class="col-sm-8 ml-4">
                        <select class="form-control" name="psc_pre" id="exampleFormControlSelect1">
                            <option value="psc">Piscina</option>
                            <option value="pre">Precria</option>
                        </select>
                        </div>
                    </div>

                    <div class="form-group row ml-5">
                        <label for="inputDesde text-dark" class="col-sm-2 col-form-label text-dark ml-4">Desde</label>
                        <div class="col-sm-8 ml-4">
                        <input type="date" class="form-control" id="inputDesde" name="desde" placeholder="desde" required>
                        </div>
                    </div>

                    <div class="form-group row ml-5">
                        <label for="inputHasta text-dark" class="col-sm-2 col-form-label ml-4 text-dark">Hasta</label>
                        <div class="col-sm-8 ml-4">
                        <input type="date" class="form-control" id="inputHasta" name="hasta" placeholder="hasta" required>
                        <input type="hidden" name="camaronera" value="<?php echo $camaronera; ?>">
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button href="submit" class="btn btn-success">Descagar</button>
                </div>
            </form>
                
        </div>
    </div>
</div>

<script>
    
function datoExcel(){

    let desde = document.getElementById('inputDesde').value;
    let hasta = document.getElementById('inputHasta').value;

    if(desde > hasta ){
 
        alert('Verifique las fechas por favor');
        return false;
    }
}
</script>