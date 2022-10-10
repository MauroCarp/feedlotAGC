
        <div class="row">
            
            <div class="col-lg-12">

                <div class="box box-widget widget-user">
    
                    <button type="button" class="close eliminarArchivoAgro" style="padding:15px;font-size:2.5em;" campo="<?php echo $campo;?>" seccion="planificacion">&times;</button>

                    <div class="widget-user-header bg-aqua-active infoAgro">

                        <h2 class="widget-user-username">
                            | <b> <?php echo $campo;?></b><br>
                            | Cultivos Invernales: <span id="hasInvPlanificacion<?php echo $campoId;?>"></span> Has.<br>
                            | Cultivos Cobertura: <span id="hasCobPlanificacion<?php echo $campoId;?>"></span>  Has.<br>
                            | Cultivos Estivales: <span id="hasEstPlanificacion<?php echo $campoId;?>"></span>  Has.<br>
                            | Ratio de Cultivo: <span id="ratioPlanificacion<?php echo $campoId;?>"></span>  %.
                        </h2>
                    
                    </div>
        
                    <div class="box-footer" style="padding-top:0px;padding-bottom:0px;">
        
                        <div class="row"  style="font-size:1.5em;">
        
                            <div class="col-sm-3 border-right">
        
                                <div class="description-block">
                                    <h4 class="description-text"><span id="hasTrigoPlanificacion<?php echo $campoId;?>"></span> Has. <br><span id="totalCostoTrigoPlanificacion<?php echo $campoId;?>"></span> U$D</h4>
                                    <span class="description-text">TRIGO</span>
                                </div>
        
                            </div>
        
                            <div class="col-sm-3 border-right">
        
                                <div class="description-block">
                                    <h4 class="description-text">
                                        <span id="hasCoberturaPlanificacion<?php echo $campoId;?>"></span> Has. <br>
                                        <span id="totalCostoCoberturaPlanificacion<?php echo $campoId;?>"></span> U$D <br>
                                        <span id="costoCoberturaPlanificacionHas<?php echo $campoId;?>"></span> U$D/Has <br>
                                    </h4>
                                    <span class="description-text">COBERTURA</span>
                                </div>
        
                            </div>
        
                            <div class="col-sm-3 border-right">
        
                                <div class="description-block">
                                    <h4 class="description-text"><span id="hasCarinataPlanificacion<?php echo $campoId;?>"></span> Has. <br><span id="totalCostoCarinataPlanificacion<?php echo $campoId;?>"></span> U$D</h4>
                                    <span class="description-text">CARINATA</span>
                                </div>
        
                            </div>
        
                            <div class="col-sm-3">
        
                                <div class="description-block">
                                    <h4 class="description-text"><span id="hasRestoPlanificacion<?php echo $campoId;?>"></span> Has. <br><span id="totalCostoRestoPlanificacion<?php echo $campoId;?>"></span> U$D</h4>
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
                        
                        <span class="info-box-number"><span id="totalHasPlanificadas<?php echo $campoId;?>"></span> Has.</span>

                    </div>
        
                </div>

            </div>
     
            <div class="col-lg-6">
                
                <div class="info-box">

                    <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Inversion <br> Total Proyectada</span>
                    <span class="info-box-number">U$D <span id="totalInversionPlanificada<?php echo $campoId;?>"></span></span>
                    </div>
        
                </div>

            </div>
        
        </div>
