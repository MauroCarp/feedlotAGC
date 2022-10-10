<?php

include 'cajasImpositivo.php';

?>

<div class="row">
    
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Saldo Iva - Saldo Tecnico - SLD - Total</h3>

            </div>


            <div class="box-body">

                <div class="chart">

                    <canvas id="sITLDTChart"></canvas>

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

</div>