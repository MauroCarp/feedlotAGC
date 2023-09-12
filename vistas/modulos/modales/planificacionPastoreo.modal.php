<div id="planificacionPastoreo" class="modal fade" role="dialog" >
  
    <div class="modal-dialog">

        <div class="modal-content">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Cargar Planificaci&oacute;n Pastoreo</h4>

            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body" style="font-size:1.6em;margin-bottom:0;padding-bottom:0;">

                <form method="POST" enctype="multipart/form-data">

                    <div class="box-body" style="margin-bottom:0;padding-bottom:0;">
                    
                        <div class="box-header with-border" style="margin-bottom:0">

                            <input type="file" class="form-control" name="planificacionFile" required>

                        </div>
                    
                    </div>
                    
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                        <input type="submit" class="btn btn-primary pull-right" name="cargarPlantillaPastoreo" value="Cargar Planificaci&oacute;n" accept=".xls,.xlsx" />


                    </div>

                </form>

            </div>

        </div>

    </div>
    
</div>

<?php 

$cargarPlantilla = new ControladorPastoreo();
$cargarPlantilla->ctrCargarPlanilla();
