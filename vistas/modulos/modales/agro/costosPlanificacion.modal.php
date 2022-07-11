<div id="modalVerCostosInversion" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:20%;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" id="tituloCostoPlanifiacion"></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" style="font-size:1.6em;margin:0;padding:0;">

          <div class="box-body" style="margin:0;padding:0;">
          
            <div class="box-header with-border" style="margin-bottom:0">
                   
              <div class="box-body" style="margin-bottom:0" id="editarCostosPlanificacion">
              
                <form role="form" method="post" id="formCostosPlanificacion">
                <input type="hidden" name="seccion" value="planificacion">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button class="btn btn-warning btn-block" style="font-size:1.5em;" name="btnEditarCosto" id="btnEditarCosto"><i class="fa fa-pencil"></i><b> Editar</b></button>

        </div>
      
      </form>

    </div>

  </div>

</div>

<?php

$editarCostosPlanificacion = new ControladorAgro();
$editarCostosPlanificacion-> ctrEditarCostos();

?>
