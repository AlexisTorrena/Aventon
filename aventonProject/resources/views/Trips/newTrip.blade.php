<!-- Modal -->
<div class="modal fade" id="newTrip" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newTrip">Nuevo Aventon</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form role="form" method="POST" action="/Trips.php">
                <div class="form-group">
                  <label for="origin">Origen:</label>
                  <input type="text" class="form-control" id="origin">
                </div>
                <div class="form-group">
                  <label for="destination">Destino:</label>
                  <input type="text" class="form-control" id="destination">
                </div>
                <div class="form-group">
                    <label for="dateTime">Fecha y Hora:</label>
                    <div class='input-group date'>
                        <input id='datetimepicker1' type='text' class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="cost">Costo:</label>
                    <input type="text" class="form-control" id="cost">
                  </div>
                  <div class="form-group dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Frecuencia
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Diaria</a></li>
                        <li><a class="dropdown-item" href="#">Semanal</a></li>
                        <li><a class="dropdown-item" href="#">Mensual</a></li>
                      </ul>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
              </form>
        </div>
      </div>
    </div>
  </div>