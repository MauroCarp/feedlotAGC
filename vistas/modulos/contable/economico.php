<?php

include 'cajasEconomico.php';


?>

<div class="row">


    <div class="col-lg-4">
        
        <div class="row">

            <div class="col-lg-12">
                
                <div class="box box-success">

                    <div class="box-header with-border">

                        <h3 class="box-title">Ventas Agricultura</h3>

                        <div class="box-tools pull-right" bis_skin_checked="1">

                            <button type="button" class="btn btn-box-tool zoomGraficos" data-modal="zGraficoVentas" data-widget="zoom"><i class="fa fa-search-plus"></i>
                            </button>

                        </div>
                    </div>


                    <div class="box-body">

                        <div class="chart">

                            <canvas id="ventasChart"></canvas>

                        </div>

                    </div>
                
                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">
    
        <div class="row">

            <div class="col-lg-12">
            
                <div class="box box-success">

                    <div class="box-header with-border">

                        <h3 class="box-title">M/V | BAAI</h3>

                        <div class="box-tools pull-right" bis_skin_checked="1">

                            <button type="button" class="btn btn-box-tool zoomGraficos" data-modal="zGraficoMargenVentas" data-widget="zoom"><i class="fa fa-search-plus"></i>
                            </button>

                        </div>

                    </div>


                    <div class="box-body">

                        <div class="chart">

                            <canvas id="margenVentasChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">
    
        <div class="row">

            <div class="col-lg-12">
            
                <div class="box box-success">

                    <div class="box-header with-border">

                        <h3 class="box-title">Renta/Activo</h3>

                    </div>


                    <div class="box-body">

                        <div class="chart">
                        
                            <canvas id="rentabilidadEconomicaChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- <div class="row">
                
            <div class="col-lg-6">

                <div class="box-header with-border" style="padding:0">

                <h3 class="box-title">Resto</h3>

                </div>

                <div class="box-body" style="padding:0">
                    
                    <canvas id="restoPie" style="height:100px"></canvas>
                    
                </div>

            </div>

            <div class="col-lg-6">

                    
                <div class="box-header with-border" style="padding:0">
                    
                    <h3 class="box-title">Activos</h3>                        
                </div>
                
                <div class="box-body" style="padding:0">
                    
                    <canvas id="activosPie" style="height:100px"></canvas>
                    
                </div>
                

            </div>


        </div> -->

    </div>

</div>
<div class="row">


    <div class="col-lg-4">
        
        <div class="row">

            <div class="col-lg-12">
                
                <div class="box box-success">

                    <div class="box-header with-border">

                        <h3 class="box-title">Ventas Ganaderia</h3>

                        <div class="box-tools pull-right" bis_skin_checked="1">

                            <button type="button" class="btn btn-box-tool zoomGraficos" data-modal="zGraficoVentas2" data-widget="zoom"><i class="fa fa-search-plus"></i>
                            </button>

                        </div>
                    </div>


                    <div class="box-body">

                        <div class="chart">

                            <canvas id="ventasChart2"></canvas>

                        </div>

                    </div>
                
                </div>

            </div>

        </div>

    </div>

</div>
<?php

$tituloGrafico = 'Ventas Agricultura';
$idGraficoModal = 'graficoVentaModal';
$idGrafico = 'idGraficoVentas';
include 'graficoContable.modal.php';

$tituloGrafico = 'Ventas Ganaderia';
$idGraficoModal = 'graficoVenta2Modal';
$idGrafico = 'idGraficoVentas2';
include 'graficoContable.modal.php';

$tituloGrafico = 'M/V - BAAI';
$idGraficoModal = 'graficoMargenVentaModal';
$idGrafico = 'idGraficoMargenVentas';
include 'graficoContable.modal.php';

?>


