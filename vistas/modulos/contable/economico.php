<?php

include 'cajasEconomico.php';

?>

<div class="row">
    
    <div class="col-lg-4">
    
        <div class="row">

            <div class="col-lg-12">
            
                <div class="box box-success">

                    <div class="box-header with-border">

                        <h3 class="box-title">Margen s/Ventas</h3>

                    </div>


                    <div class="box-body">

                        <div class="chart">

                            <canvas id="margenVentasChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-6">
                    
                <div class="box-header with-border" style="padding:0">
                    
                    <h3 class="box-title">Result. de la Explot.</h3>
                    
                </div>
                
                <div class="box-body" style="padding:0">
                    
                    <canvas id="resultadoExplotacionPie" style="height:100px"></canvas>
                    
                </div>
                    
            </div>

            <div class="col-lg-6">
                    
                <div class="box-header with-border" style="padding:0">
                    
                    <h3 class="box-title">Ingresos de Explotacion</h3>
                    
                </div>
                
                <div class="box-body" style="padding:0">
                    
                    <canvas id="ingresosExplotacionPie" style="height:100px"></canvas>
                    
                </div>
            
            </div>

        </div>

    </div>

    <div class="col-lg-4">
    
        <div class="row">

            <div class="col-lg-12">
                <div class="box box-success">

                    <div class="box-header with-border">

                        <h3 class="box-title">Ventas</h3>

                    </div>


                    <div class="box-body">

                        <div class="chart">

                            <canvas id="ventasChart"></canvas>

                        </div>

                    </div>
                
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-6">
      
                <div class="box-header with-border" style="padding:0">
                    
                    <h3 class="box-title">Agricultura</h3>                        
                </div>
                
                <div class="box-body" style="padding:0">
                    
                    <canvas id="agriculturaPie" style="height:100px"></canvas>
                    
                </div>
                    
            </div>

            <div class="col-lg-6">
      
                <div class="box-header with-border" style="padding:0">
                    
                    <h3 class="box-title">Ganaderia</h3>                        
                </div>
                
                <div class="box-body" style="padding:0">
                    
                    <canvas id="ganaderiaPie" style="height:100px"></canvas>
                    
                </div>
                    
            </div>



        </div>

    </div>

    <div class="col-lg-4">
    
        <div class="row">

            <div class="col-lg-12">
            
                <div class="box box-success">

                    <div class="box-header with-border">

                        <h3 class="box-title">Rentabilidad Economica</h3>

                    </div>


                    <div class="box-body">

                        <div class="chart">
                        
                            <canvas id="rentabilidadEconomicaChart"></canvas>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">
                
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


        </div>

    </div>

</div>