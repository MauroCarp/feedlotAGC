<button id="eliminarEjecucion" type="button" class="btn btn-secondary">

    <i class="fa fa-times" style="color:#3c8dbc;font-size:1.2em;"></i>
    <b>&nbsp;Borrar Datos</b>

</button>

<br>
<br>
<div class="row">

    <div class="col-lg-5">
            
        <?php

        $campo = 'La Bety';

        $campoId = 'Bety';
        
        include 'infoEjecucion.php';
        
        $campo = 'El Pichi';
        
        $campoId = 'Pichi';

        include 'infoEjecucion.php';
        
        ?>

    </div>

    <div class="col-lg-7">

        <?php include "graficosEjecucion.php"; ?>

    </div>

</div>
