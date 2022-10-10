<div id="modalInforme" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" id="formCarga">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="tituloInforme"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body" >

            <div class="form-group" id="inputPeriodoInforme" style="font-size:2em;display:inline-block">
              
              <div class="panel">Periodo</div>

              <input type="number" min="1900" max="2099" step="1" value="2022" />


            </div>

            <div class="form-group" id="inputTipoCultivo" style="font-size:2em;display:inline-block">
              
                <div class="panel">Cultivo</div>

                <select name="" id="" style="padding:10px;">
                    <option value="Invernal">Invernal</option>
                    <option value="Estival">Estival</option>
                </select>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="btnInforme" name="btnInforme">Generar Informe</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php



?>

