<div class="content-wrapper">
  
    <div class="box">
    
        <section class="content" style="padding-top:5px;">

          <div class="widget-user-header bg-aqua-active">

              <button class="btn btn-info" style="padding:10px;margin-top:5px;margin-left:5px;font-size:1.3em;" data-toggle="modal" data-target="#modalSelectCampania"><b>Campa&ntilde;a: <span id="campania"></span></b></button>

          </div>

          <div class="row">

                  <div class="col-md-12">

                      <div class="nav-tabs-custom">

                          <ul class="nav nav-tabs" id="tabsCiclos" style="font-size:1.5em;">
                    
                              <li class='tabs active' id='planificacionTab'><a href='#tab_1' data-toggle='tab' id="btnPlanificacion"><b>Planificaci&oacute;n</b></a></li>
                              <li class='tabs' id='ejecucionTab'><a href='#tab_2' data-toggle='tab' id="btnEjecucion"><b>Ejecuci&oacute;n</b></a></li>
                              <?php if(in_array('Produccion',$_SESSION['perfilAgro'])){ ?>
                                <li class='tabs' id='produccionTab'><a href='#tab_3' data-toggle='tab' id="btnProduccion"><b>Producci&oacute;n</b></a></li>
                              <?php } ?>

                          </ul>

                          <div class="tab-content">


                            <div class='tab-pane active' id='tab_1'>

                              <?php include 'planificacion.php';?>
                           
                            </div>

                            <div class='tab-pane' id='tab_2'>
                              <?php include 'ejecucion.php';?>
                            </div>

                            <?php if(in_array('Produccion',$_SESSION['perfilAgro'])){ ?>

                            <div class='tab-pane' id='tab_3'>
                              
                              <h1>PRODUCCION</h1>
                              <?php //include 'produccion.php';?>
                            </div>

                            <?php } ?>

                      </div>

                  </div>

          </div>

        </section>

    </div>

</div>

<?php

include 'vistas/modulos/modales/agro/selectCampania.modal.php';

include 'vistas/modulos/modales/agro/costosPlanificacion.modal.php';

$eliminarArchivo = new ControladorAgro;

$eliminarArchivo -> ctrEliminarArchivo();

$campaniaAgro = isset($_COOKIE['campaniaAgro']) ? true : false;

?>
