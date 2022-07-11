<?php

include 'cajasImpositivo.php';

?>

<div class="row">
    
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Evoluci&oacute;n Saldo de IVA</h3>

            </div>


            <div class="box-body">

                <div class="chart">

                    <canvas id="saldoIvaChart"></canvas>

                </div>

            </div>

        </div>
        
    </div>
            
    <div class="col-lg-4">
                
        <div class="box box-success">

            <div class="box-header with-border">
                
                <h3 class="box-title">IVA Saldo a Favor</h3>
                
            </div>
            
            <div class="box-body">
                
                <div class="chart">

                    <canvas id="saldoIvaPie" style="height:100px"></canvas>
                
                </div>

            </div>

        </div>

    </div>
  
    <div class="col-lg-4">
                
        <div class="box box-success">


            <div class="box-header with-border">
                
                <h3 class="box-title">IVA Saldo a favor libre disponibilidad</h3>
                
            </div>
            
            <div class="box-body">
            
                <div class="chart">
                
                    <canvas id="saldoIvaLibrePie" style="height:100px"></canvas>
                
                </div>
                
            </div>

        </div>

    </div>


</div>