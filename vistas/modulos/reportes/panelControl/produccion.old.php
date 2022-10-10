<div class="row">

    <div class="col-md-4">

        <div class="box box-success">
                
            <div class="box-header with-border">
            
                <i class="fa fa-dollar"></i>

                <h3 class="box-title">Kilos Carne y Rinde</h3>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            
                <table class="table table-striped" id="kgCarneRinde<?php echo $i + 1;?>">
                   
                </table>
            
            </div>
            
        </div>

    </div>
    
    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Costo Kilo Producido</h3>

            </div>


            <div class="box-body">

                <div class="chart">

                    <canvas id="graficoCostoKgProd<?php echo $i + 1;?>"></canvas>

                </div>

            </div>

        </div>

    </div>
 
    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Margen Tecnico por Kg Producido Por Cantidad de Cabezas Salidas</h3>

            </div>


            <div class="box-body">

                <div class="chart">

                    <canvas id="graficoMargenTec<?php echo $i + 1;?>"></canvas>

                </div>

            </div>

        </div>

    </div>


</div>

<div class="row">
    
    <div class="col-md-4">

        <div class="box box-success">
                
            <div class="box-header with-border">
            
                <i class="fa fa-dollar"></i>

                <h3 class="box-title">Costo y Margen por Kg Producido</h3>
            
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
            
                <table class="table table-striped" id="costoMargeKg<?php echo $i + 1;?>">
                
                </table>
            
            </div>
            
        </div>

    </div>
 
   
</div>
