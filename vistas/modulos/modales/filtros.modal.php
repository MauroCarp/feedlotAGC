<?php

function generarBodyModal($idCalendar,$tabla,$consignatarios,$proveedores,$tropas,$comparar,$seccion){

  echo "
  <div class='modal-body' style='padding-bottom:0px;'>

          <div class='box-body'>
            
            <div class='box-header with-border' id='filtros'>
            
              <div class='input-group'>
                
                <div class='row'>

                  <div class='col-md-8'>
                    <label>Rango de Fechas - General -</label>

                    <button type='button' class='btn btn-default' id='".$idCalendar.$comparar."'>
                    
                      <span>
                        <i class='fa fa-calendar'></i> 
                          Rango de Fecha
                      </span>

                      <i class='fa fa-caret-down'></i>

                    </button>

                  </div>

                </div>

              </div>
              <br>
              <div class='row'>
                
                <div class='col-md-4'>

                  <div class='form-group'>
                    <label>Consignatario</label>
                    <select class='form-control consignatarios' name='consignatario1".$comparar."' id='consignatario1".$comparar."' onchange=(generarProveedores(this.id,".$tabla."))>
                      <option value='Consignatario'>Consignatario</option>";

                      foreach ($consignatarios as $key => $value) {
                        
                      echo "<option value='".utf8_decode($value[0])."'>".utf8_decode($value[0])."</option>";

                      }
          
               echo "</select>

                  </div>

                </div>

                  <div class='col-md-4'>

                    <div class='form-group'>
                      <label>Proveedor</label>
                      <select class='form-control proveedores' name='proveedor1".$comparar."' id='proveedor1".$comparar."' onchange=(generarTropas(this.id,".$tabla."))>
                      <option value='Proveedor'>Proveedor</option>";
                          
                          foreach ($proveedores as $key => $value) {
                          
                            echo "<option value='".$value[0]."'>".$value[0]."</option>";
                          
                        }
                          
              echo "</select>

                    </div>

                  </div>

                  <div class='col-md-4'>

                    <div class='form-group'>
                      <label>Tropa</label>
                      <select class='form-control tropas' name='tropa1".$comparar."' id='tropa1".$comparar."' onchange=(bloquearProveedor(this.id))>
                      <option value='Tropa'>Tropa</option>";

                        foreach ($tropas as $key => $value) {
                          
                          echo "<option value='".$value[0]."'>".$value[0]."</option>";
                          
                        }
                          
                echo "</select>

                    </div>

                  </div>

              </div>

              <div class='row' id='btn-plus".$comparar."'>
                <div class='col-md-1'>
                  <button type='button' class='btn btn-info' id='comparar".$comparar."'><i class='fa fa-plus'></i></button>
                </div>
              </div>

            </div>";

            // if($comparar == ''){
            //   echo "
            //   <div class='row'>

            //     <div class='col-md-2 botonComparar'>
            //       <input type='checkbox' name='compararValido".$seccion."' id='compararValido".$seccion."'>
            //       <b>&nbsp;Comparar</b>
            //     </div>
                
            //   </div>";
              
  
            // }
     
            echo "
          
            </div>
        
          </div>";

};

?>
              
<div id="modalFiltros" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content" id="<?php echo $idModal;?>" style="left:0px">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Filtros de reportes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <?php

        $item = null;

        $valor = null;

        $variable = 'consignatario';

        $consignatarios = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);

        asort($consignatarios);
        
        $variable = 'proveedor';
        
        $proveedores = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);
        
        asort($proveedores);

        $variable = 'tropa';
          
        $tropas = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);
          
        asort($tropas);

        generarBodyModal($idCalendar,$tabla,$consignatarios,$proveedores,$tropas,'',$seccion);

        ?>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="<?php echo $idGenerar;?>">Generar Reporte</button>

        </div>

    </div>

    <!-- <div class="modal-content" id="<?php // echo $idModalComparar;?>" style="display:none;width:600px;position:absolute;top:0;left:380px;">  -->


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

      <!--  <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Filtros de reportes Comparar</h4>

        </div>  -->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <?php

        // generarBodyModal($idCalendar,$tabla,$consignatarios,$proveedores,$tropas,'Comp',$seccion);

        ?>      

  <!--  </div> -->
 
  </div>

</div>
