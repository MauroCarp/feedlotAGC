<div class="nav-tabs-custom">
    
    <ul class="nav nav-tabs" style="font-size:1.em;">
        
        <li class="tabs active" id="cicloCompleto<?php echo $mes;?>"><a href="#tab_1_<?php echo $mes;?>" data-toggle="tab">Ciclo Completo</a></li>
        
        <li class="tabs" id="recriaPastoril<?php echo $mes;?>"><a href="#tab_2_<?php echo $mes;?>" data-toggle="tab">Recr&iacute;a Pastoril</a></li>
        
        <li class="tabs" id="recriaCorral<?php echo $mes;?>"><a href="#tab_3_<?php echo $mes;?>" data-toggle="tab">Recr&iacute;a Corral</a></li>
        
        <li class="tabs" id="terminacion<?php echo $mes;?>"><a href="#tab_4_<?php echo $mes;?>" data-toggle="tab">Terminaci&oacute;n</a></li>
        
    </ul>
    
    <div class="tab-content">

        <div class="tab-pane active" id="tab_1_<?php echo $mes;?>">
            
            <?php include('cicloCompleto.php'); ?>
        
        </div>

        <div class="tab-pane recriaPastoril" id="tab_2_<?php echo $mes;?>">
            
            <?php include('recriaPastoril.php'); ?>

        </div>

        <div class="tab-pane recriaCorral" id="tab_3_<?php echo $mes;?>">
        
            <?php include('recriaCorral.php'); ?>

        </div>

        <div class="tab-pane terminacion" id="tab_4_<?php echo $mes;?>">
     
           <?php include('terminacion.php'); ?>

        </div>

    </div>

</div>