
<div id="ventanaModalAnual" class="modal fade" role="dialog">
 
  <div class="modal-dialog">

    <div class="modal-content" id="modalPrincipal" style="width:300px">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Filtro Conversi&oacute;n</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class='modal-body' style='padding-top:0px;margin-top:0px;'>

            <div class='box-body' style='padding-top:0px;margin-top:0px;'>
            
                <div class='box-header'>
                                    
                    <div class="row">
                        
                        <div class="col-md-8">
                        
                            <label><h4><b>Año</b></h4></label>
                            
                        </div>
                    
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-md-12">
                        
                           <input 
                            class="form-control years" 
                            id="anioConv"
                            type="number" 
                            min="1900" 
                            max="2099" 
                            step="1"
                            value="<?php echo date('Y');?>" />

                        </div>

                    </div>

                    <br>

                    
                    
                    <!-- <div class='row' id='btn-plusPC'>

                        <div class='col-md-1'>
                            <button type='button' class='btn btn-info' id='compararPC'><i class='fa fa-plus'></i></button>
                        </div>

                    </div> -->

                </div>

            </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="generarReporteConversion">Generar Reporte</button>

        </div>

    </div>
 
  </div>

</div>