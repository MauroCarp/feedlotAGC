
<div id="modalAlimento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:800px;">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Alimento Diario consumido durante Proceso Productivo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Grafico -->

            <div class="nav-tabs-custom">
              
              <ul class="nav nav-tabs navTabAlimento">
                  
                  <li class="tabs active" id="tabGeneral"><a href="#general" data-toggle="tab"><b>GENERAL</b></a></li>
                  
              </ul>
              
              <div class="tab-content tabContAlimento">
                
                <div class="tab-pane active" id="general">
                  
                  <div class="box-header with-border">
                  
                    <div class="row">
                      
                      <div class="col-md-12">
                        
                        <div class="box box-success">
                          
                          <div class="box-body">
                            
                            <div class="chart">
                              
                              <canvas id="alimentoConsumidoGeneral"></canvas>
                          
                            </div>
                          
                          </div>
                        
                        </div>

                      </div>

                    </div>

                  </div>
        
                </div>

              </div>

            </div>

          </div>

        </div>

    </div>

  </div>

</div>