<div id="<?=$idGraficoModal?>" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:70%;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title"><?=$tituloGrafico?></h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Filtros -->

            
            <div class="box-header with-border">
                   
              <div class="box box-success">

                <div class="box-header with-border">

                  <h3 class="box-title"><?=$tituloGrafico?></h3>
                </div>

                <div class="box-body">

                  <div class="chart">

                    <canvas id="<?=$idGrafico?>" style="height:100%"></canvas>

                  </div>

                </div>

                </div>

              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

    </div>

  </div>

</div>