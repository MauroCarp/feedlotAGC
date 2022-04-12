<div class="row">

    <div class="col-md-4">

        <div class="box box-success">
                
            <div class="box-header with-border">
            
                <i class="fa fa-dollar"></i>

                <h3 class="box-title">Costos Diarios del Periodo</h3>

                <div class="box-tools pull-right">
                
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    
                    </button>
                                    
                </div>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            
                <table class="table table-striped" id="CostoDiario<?php echo $i + 1;?>">
                    
                
                </table>
            
            </div>
            
        </div>

    </div>
    
    <div class="col-md-4">

        <div class="box box-success">
                
            <div class="box-header with-border">
            
                <i class="icon-corn"></i>

                <h3 class="box-title">Datos Consumo</h3>

                <div class="box-tools pull-right">
                
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    
                    </button>
                                    
                </div>
            
            </div>

            <div class="box-body no-padding">
            
                <table class="table table-striped" id="datoConsumo<?php echo $i + 1;?>"> 
                    
                    
                
                </table>
            
            </div>
            
        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Costo Kilo en MS</h3>

            </div>
        

            <div class="box-body">

                <div class="chart">

                    <canvas id="graficoCostoKgMS<?php echo $i + 1;?>"></canvas>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Consumo de Soja y Maiz</h3>

            </div>
        

            <div class="box-body">

                <div class="chart">

                    <canvas id="graficoSojaMaiz<?php echo $i + 1;?>"></canvas>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Conversion</h3>

            </div>
        

            <div class="box-body">

                <div class="chart">

                    <canvas id="graficoConversion<?php echo $i + 1;?>"></canvas>

                </div>

            </div>

        </div>

    </div>

</div>
