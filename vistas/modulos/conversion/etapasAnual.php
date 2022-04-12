<div class="nav-tabs-custom">
    
    <ul class="nav nav-tabs" style="font-size:1.em;">
        
        <li class="tabs active" id="cicloCompletoEstadistica"><a href="#tab_1_estadistica" data-toggle="tab">Ciclo Completo</a></li>
        
        <li class="tabs" id="recriaPastorilEstadistica"><a href="#tab_2_estadistica" data-toggle="tab">Recr&iacute;a Pastoril</a></li>
        
        <li class="tabs" id="recriaCorralEstadistica"><a href="#tab_3_estadistica" data-toggle="tab">Recr&iacute;a Corral</a></li>
        
        <li class="tabs" id="terminacionEstadistica"><a href="#tab_4_estadistica" data-toggle="tab">Terminaci&oacute;n</a></li>
        
    </ul>
    
    <div class="tab-content">

        <div class="tab-pane active" id="tab_1_estadistica">
            
            <?php include('cicloCompletoAnual.php'); ?>
        
        </div>

        <div class="tab-pane recriaPastoril" id="tab_2_estadistica">
            
            <?php include('recriaPastorilAnual.php'); ?>

        </div>

        <div class="tab-pane recriaCorral" id="tab_3_estadistica">
        
            <?php include('recriaCorralAnual.php'); ?>

        </div>

        <div class="tab-pane terminacion" id="tab_4_estadistica">
     
           <?php include('terminacionAnual.php'); ?>

        </div>

    </div>

</div>