
<div id="<?php  echo $modalSeccion;?>" class="modal fade" role="dialog">
 
  <div class="modal-dialog">

    <div class="modal-content" id="modalPrincipal" style="width:300px">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Filtro <?php echo $titulo;?></h4>

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
                        
                           <input class="form-control months<?php echo $inputID;?>" type="month" id='periodo<?php echo $inputID;?>'>
                            
                        </div>

                    </div>

                    <br>

                    
                    
                    <div class='row' id='<?php echo $divBtnPlus;?>'>

                        <div class='col-md-1'>
                            <button type='button' class='btn btn-info' id='<?php echo $btnPlus;?>'><i class='fa fa-plus'></i></button>
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

          <button type="submit" class="btn btn-primary" id="<?php echo $idGenerar;?>">Generar Reporte</button>

        </div>

    </div>
 
  </div>

</div>

<script>
$(function () {
  
$('#periodoPC')[0].value = monthValue;

});

</script>