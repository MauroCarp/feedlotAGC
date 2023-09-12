
        <div class="row">
            
            <div class="col-lg-12">

                <div class="box box-widget widget-user">
    
                    <div class="widget-user-header bg-aqua-active infoAgro">

                        <h2 class="widget-user-username">
                            | <b> <?php echo $campo;?></b><br>
                            | Cultivos Invernales: <span id="hasInvEjecucion<?php echo $campoId;?>"></span> Has.<br>
                            | Cultivos Cobertura: <span id="hasCobEjecucion<?php echo $campoId;?>"></span>  Has.<br>
                            | Cultivos Estivales: <span id="hasEstEjecucion<?php echo $campoId;?>"></span>  Has.<br>
                            | Ratio de Cultivo: <span id="ratioEjecucion<?php echo $campoId;?>"></span>  %.
                        </h2>
                    
                    </div>
        
                    <div class="box-footer" style="padding-top:0px;padding-bottom:0px;">
        
                        <div class="row"  style="font-size:1.5em;">
        
                            <div class="col-sm-3 border-right">
        
                                <div class="description-block">
                                    <h4 class="description-text"><span id="hasTrigoEjecucion<?php echo $campoId;?>"></span> Has. <br><span id="totalCostoTrigoEjecucion<?php echo $campoId;?>"></span> U$D</h4>
                                    <span class="description-text">TRIGO</span>
                                </div>
        
                            </div>
        
                            <div class="col-sm-3 border-right">
        
                                <div class="description-block">
                                    <h4 class="description-text"><span id="hasCoberturaEjecucion<?php echo $campoId;?>"></span> Has. <br><span id="totalCostoCoberturaEjecucion<?php echo $campoId;?>"></span> U$D</h4>
                                    <span class="description-text">COBERTURA</span>
                                </div>
        
                            </div>
        
                            <div class="col-sm-3 border-right">
        
                                <div class="description-block">
                                    <h4 class="description-text"><span id="hasCarinataEjecucion<?php echo $campoId;?>"></span> Has. <br><span id="totalCostoCarinataEjecucion<?php echo $campoId;?>"></span> U$D</h4>
                                    <span class="description-text">CARINATA</span>
                                </div>
        
                            </div>
        
                            <div class="col-sm-3">
        
                                <div class="description-block">
                                    <h4 class="description-text"><span id="hasRestoEjecucion<?php echo $campoId;?>"></span> Has. <br><span id="totalCostoRestoEjecucion<?php echo $campoId;?>"></span> U$D</h4>
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
                        
                        <span class="info-box-number"><span id="totalHasEjecucion<?php echo $campoId;?>"></span> Has.</span>

                    </div>
        
                </div>

            </div>
     
            <div class="col-lg-6">
                
                <div class="info-box">

                    <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>
                    <div class="info-box-content">
                    <span class="info-box-text">Inversion <br> Total Ejecutada</span>
                    <span class="info-box-number">U$D <span id="totalInversionEjecucion<?php echo $campoId;?>"></span></span>
                    </div>
        
                </div>

            </div>
        
        </div>
