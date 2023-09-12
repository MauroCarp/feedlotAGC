<?php

include 'cajasImpositivo.php';

?>

<div class="row">
    
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Saldo Iva</h3>

                <div class="box-tools pull-right" bis_skin_checked="1">

                    <button type="button" class="btn btn-box-tool zoomGraficos" data-modal="zGraficoSaldoIva" data-widget="zoom"><i class="fa fa-search-plus"></i>
                    </button>

                </div>


            </div>


            <div class="box-body">

                <div class="chart">

                    <canvas id="saldoIva"></canvas>

                </div>

            </div>

        </div>
        
    </div>
            
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">
                
                <h3 class="box-title">Sueldos + Horarios Mes / Ventas</h3>
                
            </div>
            
            <div class="box-body">
                
                <div class="chart">

                    <canvas id="sueldosHonorariosVentas" style="height:100px"></canvas>
                
                </div>

            </div>

        </div>

    </div>
            
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">
                
                <h3 class="box-title">Sueldos + Horarios Mes</h3>
                
            </div>
            
            <div class="box-body">
                
                <div class="chart">

                    <canvas id="sueldosHonorarios" style="height:100px"></canvas>
                
                </div>

            </div>

        </div>

    </div>

</div>

<?php

$tituloGrafico = 'Saldo IVA';
$idGraficoModal = 'graficoSaldoIvaModal';
$idGrafico = 'idGraficoSaldoIva';

include 'graficoContable.modal.php';