<div class="content-wrapper">
  
    <div class="box">
      
      <section class="content" style="padding-top:5px;">
        <div class="row">
          <div class="col-lg-1">
            <button class="btn btn-primary btn-block" id="btnFiltrarContable" style="margin-bottom:10px;" data-toggle="modal" data-target="#ventanaModalMensual"><b>Filtrar</b></button>

          </div>
          <div class="col-lg-2">
            <b style="font-size:1.8em;">Periodo: <span id="periodoVisible"></span></b>
          </div>
          <div class="col-lg-9" style="text-align:right">
            <small><b>*Los valores de las cajas superiores se representan en n/1000</b></small>
          </div>
        </div>
        <div class="row">

                <div class="col-md-12">

                    <div class="nav-tabs-custom">

                        <ul class="nav nav-tabs" id="tabsCiclos" style="font-size:1.5em;">
                  
                            <li class='tabs active' id='economicoTab'><a href='#tab_1' data-toggle='tab' id="btnEconomico"><b>Economico</b></a></li>
                            <li class='tabs' id='financieroTab'><a href='#tab_2' data-toggle='tab' id="btnFinanciero"><b>Financiero</b></a></li>
                            <li class='tabs' id='impositivoTab'><a href='#tab_3' data-toggle='tab' id="btnImpositivo"><b>Impositivo</b></a></li>

                        </ul>

                        <div class="tab-content">


                          <div class='tab-pane active' id='tab_1'>

                            <?php include 'economico.php';?>
                          
                          </div>

                          <div class='tab-pane' id='tab_2'>

                            <?php include 'financiero.php';?>

                          </div>

                          <div class='tab-pane' id='tab_3'>
                            
                            <?php include 'impositivo.php';?>
                          
                          </div>

                    </div>

                </div>

        </div>

      </section>

    </div>

</div>


<!-- MODAL FILTRO -->
<div id="ventanaModalMensual" class="modal fade" role="dialog">
 
  <div class="modal-dialog">

    <div class="modal-content" style="width:300px">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Contabilidad Mensual</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

            <div class='box-body' style='padding-top:0px;margin-top:0px;'>
            
                <div class='box-header'>
                                    
                    <div class="row">
                        
                        <div class="col-md-8">
                        
                            <label><h4><b>Periodo</b></h4></label>
                            
                        </div>
                    
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-md-12">
                        
                           <input class="form-control periodoContable" type="month" name="periodoContable" id="periodoContable" value="">

                        </div>

                    </div>

                    <br>

                </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="generarReporteContabilidad">Generar Reporte</button>

        </div>

    </div>
 
  </div>

</div>