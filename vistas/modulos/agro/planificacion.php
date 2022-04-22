<button class="btn btn-secondary" data-toggle="modal" data-target="#modalVerCostosInversion">

    <i class="fa fa-dollar" style="color:#3c8dbc;font-size:1.2em;"></i><b>&nbsp;Costos Inversi&oacute;n</b>

</button>

<br>
<br>

<div class="row">

    <div class="col-lg-4">
            
        <?php

        $campo = 'La Bety';

        $campoId = 'Bety';
        
        include 'infoPlanificacion.php';
        
        $campo = 'El Pichi';
        
        $campoId = 'Pichi';

        include 'infoPlanificacion.php';
        
        ?>

    </div>

    <div class="col-lg-8">

        <?php include "graficosPlanificacion.php"; ?>

    </div>

</div>
