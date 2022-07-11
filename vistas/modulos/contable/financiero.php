<?php

include 'cajasFinanciero.php';

?>

<div class="row">
    
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Evoluci&oacute;n Endeudamiento</h3>

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
                
                <h3 class="box-title">Endeudamiento</h3>
                
            </div>
            
            <div class="box-body">
                
                <div class="chart">

                    <canvas id="endeudamientoPie" style="height:100px"></canvas>
                
                </div>

            </div>

        </div>

    </div>
  
    <div class="col-lg-4">
                
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

    </div>


</div>