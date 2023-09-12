<div class="row">
    <div class="col-lg-1">

        <button id="eliminarEjecucion" type="button" class="btn btn-secondary">
        
            <i class="fa fa-times" style="color:#3c8dbc;font-size:1.2em;"></i>
            <b>&nbsp;Borrar Datos</b>
        
        
        </button>

    </div>

    <div class="col-lg-2">
        
        <div class="input-group" bis_skin_checked="1">
            <span class="input-group-addon"><b>ETAPA</B></span>
            <select class="form-control" id="etapaEjecucion">
                <option value="1">Al 31 de Mayo</option>
                <option value="2">Al 31 de Agosto</option>
                <option value="3">Al 31 de Diciembre</option>
            </select>
        </div>

    </div>

</div>

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
