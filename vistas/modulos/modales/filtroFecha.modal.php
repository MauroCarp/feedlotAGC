<?php
function generarContentModal($idModal,$idCalendar,$comparar,$seccion){
	
	$estilo = ($comparar != '') ? "display:none;width:300px;position:absolute;top:0;left:110px;" : "left:0" ; 

    echo "
	<div class='modal-content' id='".$idModal."' style='".$estilo."'>

        <div class='modal-header' style='background:#3c8dbc; color:white;'>

          <button type='button' class='close' data-dismiss='modal'>&times;</button>

          <h4 class='modal-title'>Reporte de Compras</h4>

        </div>
	<div class='modal-body' style='padding-bottom:0'>

    <div class='box-body'>
      
      <div class='box-header with-border'>
      
        <div class='input-group'>
          
          <div class='row'>

            <div class='col-md-12'>

              <button type='button' class='btn btn-default btn-lg btn-block' id='".$idCalendar.$comparar."'>
              
                <span>
                  <i class='fa fa-calendar'></i> 
                    Rango de Fecha
                </span>

                <i class='fa fa-caret-down'></i>

              </button>

            </div>

          </div>
              
          <br>";
          
          // if($comparar == ''){
          // echo "
          // <div class='row'>

          //     <div class='col-md-6 botonComparar'>

          //     <input type='checkbox' name='compararValidoFecha' id='compararValidoFecha".$seccion."'>

          //     <b>&nbsp;Comparar</b>

          //     </div>
              
          // </div>";

          // }
    
    echo "
        </div>

      </div>

    </div>

  </div>";


}
?>
<div id="<?php echo $modalSeccion;?>" class="modal fade" role="dialog" >
  
  <div class="modal-dialog" style="width:300px;">
        
        <?php
        
        generarContentModal($idModal,$idCalendar,'',$seccion);
        
        ?>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="<?php echo $idGenerar;?>">Generar Reporte</button>

        </div>

  </div>

        <?php
        
        $idModal = 'modalFecha'.$seccion.'Comparar';
        
        generarContentModal($idModal,$idCalendar,'Comp',$seccion);
        
        ?>

    </div>

  </div>

</div>