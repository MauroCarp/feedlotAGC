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

                              <?php include 'planificacion.php';?>
                           
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
