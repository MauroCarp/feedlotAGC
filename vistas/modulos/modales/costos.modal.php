
<div id="modalCostos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:1200px;margin-left:-300px">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Relacion Precio Kg Pagado, Precio Piri - Promedio de Kilos Comprados</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Grafico -->

            
            <div class="box-header with-border" id="graficoCosto">
            
              <div class="row">
                
                <div class="col-md-12">

                <?php include "vistas/modulos/reportes/grafico-costos.php";?>

                </div>

              </div>

            </div>

          </div>

        </div>

    </div>

  </div>

</div>
