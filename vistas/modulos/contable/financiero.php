<?php

include 'cajasFinanciero.php';

?>

<div class="row">
    
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Evoluci&oacute;n Endeudamiento</h3>

                <div class="box-tools pull-right" bis_skin_checked="1">

                    <button type="button" class="btn btn-box-tool zoomGraficos" data-modal="zGraficoEndeudamiento" data-widget="zoom"><i class="fa fa-search-plus"></i>
                    </button>

                </div>

            </div>


            <div class="box-body">

                <div class="chart">

                    <canvas id="endeudamientoChart"></canvas>

                </div>

            </div>

        </div>
        
    </div>
            
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">
                
                <h3 class="box-title">Deuda Bancaria</h3>
                
            </div>
            
            <div class="box-body">
                
                <div class="chart">

                    <canvas id="deudaBancariaChart" style="height:100px"></canvas>
                
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">
                
                <h3 class="box-title">Intereses Pagados</h3>
                
            </div>
            
            <div class="box-body">
                
                <div class="chart">

                    <canvas id="interesesPagadosChart" style="height:100px"></canvas>
                
                </div>

            </div>

        </div>

    </div>
  
    <!-- <div class="col-lg-4">
                
        <div class="box box-success">


            <div class="box-header with-border">
                
                <h3 class="box-title">Caja / Bancos</h3>
                
            </div>
            
            <div class="box-body">
            
                <div class="chart">
                
                    <canvas id="cajaBancosPie" style="height:100px"></canvas>
                
                </div>
                
            </div>

        </div>

    </div> -->
    
</div>

<?php

include 'cajasFinancieroFooter.php';

$tituloGrafico = 'Deuda Bancaria';
$idGraficoModal = 'graficoDeudaBancariaModal';
$idGrafico = 'idGraficoDeudaBancaria';

include 'graficoContable.modal.php';

?>
