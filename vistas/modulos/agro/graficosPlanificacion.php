<div class="nav-tabs-custom" style="box-shadow:none;margin-bottom:0;">

    <ul class="nav nav-tabs" id="tabsCiclos" style="font-size:1.5em;">

        <li class='tabs active' id='betyTab'><a href='#tab_1' data-toggle='tab' id="btnBety"><b>La Bety</b></a></li>
        <li class='tabs' id='pichiTab'><a href='#tab_2' data-toggle='tab' id="btnPichi"><b>El Pichi</b></a></li>

    </ul>

    <div class="tab-content">


        <div class='tab-pane active' id='tab_1'>
            
            <?php
        
                $idGraficoPlanificacion = 'graficoPlanifiacionBety';
                
                include 'graficos/planificacion.php';
                
            ?>

    </div>

    <div class='tab-pane' id='tab_2'>

        <?php 
        
            $idGraficoPlanificacion = 'graficoPlanifiacionPichi';

            include 'graficos/planificacion.php';
            
        ?>

    </div>

</div>

