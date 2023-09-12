<div id="fechaPastoreo" class="modal fade" role="dialog" >
  
    <div class="modal-dialog">

        <div class="modal-content">


            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Lote <span id="tituloFechaPastoreo"></span></h4>

            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body" style="font-size:1.6em;margin-bottom:0;padding-bottom:0;">

                <form method="POST" id="formPastoreo">

                    <div class="box-body" style="margin-bottom:0;padding-bottom:0;">
                    
                        <div class="form-group">

                            <label for="parcelas">Parcelas:</label>

                            <select class="form-control" name="parcelas" id="parcelas">
                            </select>
                            
                        </div>


                        <div id="parcelaData">

                            <div class="form-group">

                                <label for="entradaReal">Entrada Real</label>

                                <input type="hidden" class="form-control" name="idRegistro" id="idRegistro">
                                <input type="date" class="form-control" name="entradaReal" id="entradaReal">

                            </div>
                            <div class="form-group">

                                <label for="salidaReal">Salida Real</label>

                                <input type="date" class="form-control" name="salidaReal" id="salidaReal">

                            </div>
                            <div class="form-group">

                                <label for="diasReal">D&iacute;as Pastoreo Real</label>

                                <input type="text" class="form-control" id="diasReal" readOnly>

                            </div>

                            <div class="form-group">

                                <label for="entradaPlanificada">Entrada Planificada</label>

                                <input class="form-control" type="date" id="entradaPlanificada" readOnly>

                            </div>

                            <div class="form-group">

                                <label for="salidaPlanificada">Salida Planificada</label>

                                <input class="form-control" type="date" id="salidaPlanificada" readOnly>

                            </div>

                            <div class="form-group">

                                <label for="diasPlanificado">D&iacute;as Pastoreo Planificado</label>

                                <input type="text" class="form-control" id="diasPlanificado" readOnly>

                            </div>

                        </div>
                    
                    </div>
                    
                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    
                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                        <button type="submit" name="cargarPastoreo" class="btn btn-primary" id="submitPastoreo<?= $idGenerar?>">Cargar Fecha</button>

                    </div>
                    
                </form>

            </div>

        </div>

    </div>
    
</div>

<?php

$cargarPastoreo = new ControladorPastoreo();
$cargarPastoreo->ctrCargarRegistro();
