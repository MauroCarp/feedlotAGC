<div id="modalCarga" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" id="formCarga">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="tituloCarga"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group hidden" id="inputPeriodoContable">
              
              <div class="panel">Periodo</div>

              <input type="month" id="periodoContable" name="periodoContable">

            </div>

             <div class="form-group">
              
              <div class="panel">Seleccionar Archivo</div>

              <input type="file" id="nuevosDatosCarga" name="">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="btnCargar" name="btnCargar" data-carga=""></button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php

if($_SESSION['perfil'] == 'Agro' OR $_SESSION['perfil'] == 'Administrador Agro')
  $cargarArchivo = new ControladorAgro();

if($_SESSION['perfil'] == 'Contable' OR $_SESSION['perfil'] == 'Administrador Contable')
  $cargarArchivo = new ControladorContable();


$cargarArchivo->ctrCargarArchivo();


?>

