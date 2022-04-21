<button class="btn btn-secondary" data-toggle="modal" data-target="#modalVerCostosInversion">

    <i class="fa fa-dollar" style="color:#3c8dbc;font-size:1.2em;"></i><b>&nbsp;Costos Inversi&oacute;n</b>

</button>

<br>
<br>

<div class="row">

    <div class="col-lg-4">

        <div class="box box-widget widget-user">

            <div class="widget-user-header bg-aqua-active">
                <h2 class="widget-user-username">| Campa&ntilde;a: <span id="campania">2022/2023</span><br>| Cultivos Invernales: <span id="hasInvPlanificacion">111</span> Has.<br>| Cultivos Estivales: <span id="hasEstPlanificacion">222</span>  Has.</h2>
            </div>

            <div class="box-footer">

                <div class="row"  style="font-size:1.5em;">

                    <div class="col-sm-4 border-right">

                        <div class="description-block">
                            <h4 class="description-text"><span id="hasTrigoPlanificacion">32</span> Has. | <span id="totalCostoTrigoPlanificacion">32</span> U$D</h4>
                            <span class="description-text">TRIGO</span>
                        </div>

                    </div>

                    <div class="col-sm-4 border-right">

                        <div class="description-block">
                            <h4 class="description-text"><span id="hasCarinataPlanificacion">32</span> Has. | <span id="totalCostoCarinataPlanificacion">32</span> U$D</h4>
                            <span class="description-text">CARINATA</span>
                        </div>

                    </div>

                    <div class="col-sm-4">

                        <div class="description-block">
                            <h4 class="description-text"><span id="hasRestoPlanificacion">32</span> Has. | <span id="totalCostoRestoPlanificacion">32</span> U$D</h4>
                            <span class="description-text">RESTO</span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-8">

        <?php include "graficosPlanificacion.php"; ?>

    </div>

</div>
