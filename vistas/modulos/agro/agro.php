<div class="content-wrapper">
  
    <div class="box">
    
        <section class="content">

          <div class="widget-user-header bg-aqua-active">

              <h2 class="widget-user-username" style="padding:20px">Campa&ntilde;a: <span id="campania">2022/2023</span></h2>
          
          </div>

          <div class="row">

                  <div class="col-md-12">

                      <div class="nav-tabs-custom">

                          <ul class="nav nav-tabs" id="tabsCiclos" style="font-size:1.5em;">
                    
                              <li class='tabs active' id='planificacionTab'><a href='#tab_1' data-toggle='tab' id="btnPlanificacion"><b>Planificaci&oacute;n</b></a></li>
                              <li class='tabs' id='ejecucionTab'><a href='#tab_2' data-toggle='tab' id="btnEjecucion"><b>Ejecuci&oacute;n</b></a></li>
                              <li class='tabs' id='produccionTab'><a href='#tab_3' data-toggle='tab' id="btnProduccion"><b>Producci&oacute;n</b></a></li>

                          </ul>

                          <div class="tab-content">


                            <div class='tab-pane active' id='tab_1'>

                              <button class="btn btn-secondary" data-toggle="modal" data-target="#modalVerCostosInversion">

                                <i class="fa fa-dollar" style="color:#3c8dbc;font-size:1.2em;"></i><b>&nbsp;Costos Inversi&oacute;n</b>

                              </button>

                              <br>
                              <br>
                              
                              <div class="row">

                                  <div class="col-lg-4">

                                      <div class="row">
                                          
                                          <div class="col-lg-12">

                                              <div class="box box-widget widget-user">
                                      
                                                  <div class="widget-user-header bg-aqua-active">
                                                      <h2 class="widget-user-username">| Cultivos Invernales: <span id="hasInvPlanificacion">111</span> Has.<br>| Cultivos Estivales: <span id="hasEstPlanificacion">222</span>  Has.</h2>
                                                  </div>
                                      
                                                  <div class="box-footer">
                                      
                                                      <div class="row"  style="font-size:1.5em;">
                                      
                                                          <div class="col-sm-4 border-right">
                                      
                                                              <div class="description-block">
                                                                  <h4 class="description-text"><span id="hasTrigoPlanificacion">32</span> Has. | <span id="totalCostoTrigoPlanificacion">32</span> U$D</h4>
                                                                  <span class="description-text">TRIGO</span>
                                                              </div>
                                      
                                                          </div>
                                      
                                                          <div class="col-sm-4 border-right">
                                      
                                                              <div class="description-block">
                                                                  <h4 class="description-text"><span id="hasCarinataPlanificacion">32</span> Has. | <span id="totalCostoCarinataPlanificacion">32</span> U$D</h4>
                                                                  <span class="description-text">CARINATA</span>
                                                              </div>
                                      
                                                          </div>
                                      
                                                          <div class="col-sm-4">
                                      
                                                              <div class="description-block">
                                                                  <h4 class="description-text"><span id="hasRestoPlanificacion">32</span> Has. | <span id="totalCostoRestoPlanificacion">32</span> U$D</h4>
                                                                  <span class="description-text">RESTO</span>
                                                              </div>
                                      
                                                          </div>
                                      
                                                      </div>
                                      
                                                  </div>
                                      
                                              </div>

                                          </div>
                                      
                                      </div>

                                      <div class="row">
                                          
                                          <div class="col-lg-6">
                                              
                                              <div class="info-box">

                                                  <span class="info-box-icon bg-aqua"><i class="fa fa-map-o"></i></span>
                                                  <div class="info-box-content">
                                                  <span class="info-box-text">Hectareas Totales</span>
                                                  <span class="info-box-number">1100</span>
                                                  </div>
                                      
                                              </div>

                                          </div>
                                  
                                          <div class="col-lg-6">
                                              
                                              <div class="info-box">

                                                  <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>
                                                  <div class="info-box-content">
                                                  <span class="info-box-text">Inversion <br> Total Proyectada</span>
                                                  <span class="info-box-number">U$D 15000</span>
                                                  </div>
                                      
                                              </div>

                                          </div>
                                      
                                      </div>


                                  </div>

                                  <div class="col-lg-8">

                                      <?php include "graficosPlanificacion.php"; ?>

                                  </div>

                              </div> 

                              <?php // include 'planificacion.php';?>
                           
                            </div>

                            <div class='tab-pane' id='tab_2'>
                              <h1>EJECUCION</h1>
                              <?php //include 'ejecucion.php';?>
                            </div>
                            <div class='tab-pane' id='tab_3'>
                              
                              <h1>PRODUCCION</h1>
                              <?php //include 'produccion.php';?>
                            </div>

                      </div>

                  </div>

          </div>

        </section>

    </div>

</div>
