<div class="row">

    <!-- KG ING -->
      
    <div class="col-md-4">
      
        <div class="box box-success">
      
            <div class="box-header with-border">
        
            <h3 class="box-title">Kg Ingreso</h3>
        
            </div>
      
            <div class="box-body">
      
                <div class="chart">
            
                    <canvas id="kgIngChartT" style="height:230px"></canvas>
            
                </div>
      
            </div>

        </div>
        
    </div>

    <!-- KG EGR -->

    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Kg Salida</h3>

            </div>

            <div class="box-body">

                <div class="chart">

                    <canvas id="kgEgrChartT" style="height:230px"></canvas>

                </div>

            </div>

        </div>
       
    </div>

    <!-- KG PROD -->
    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Kg Produc.</h3>

            </div>

            <div class="box-body">

                <div class="chart">

                    <canvas id="kgProdChartT" style="height:230px"></canvas>

                </div>

            </div>

        </div>
        
    </div>

</div>

<div class="row">
    
    <!-- ADPV -->
    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">ADPV</h3>

            </div>

            <div class="box-body">

                <div class="chart">

                    <canvas id="adpvChartT" style="height:230px"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- DIAS -->
    <div class="col-md-4">

        <div class="box box-success">

            <div class="box-header with-border">

                <h3 class="box-title">Días</h3>

            </div>

            <div class="box-body">

                <div class="chart">

                    <canvas id="diasChartT" style="height:230px"></canvas>

                </div>

            </div>

        </div>

    </div>

    <!-- CONVERSION -->
    <div class="col-md-4">  
    
      <div class="box box-success">
      
          <div class="box-header with-border">
          
            <h3 class="box-title">Conversi&oacute;n MS</h3>

          </div>
          
            <div class="box-body">

                <div class="chart">

                    <canvas id="conversionChartT" style="height:230px"></canvas>

                </div>

            </div>
      
      </div>

    </div> 

</div>

<script>
    

    // // DIAS

    //     data = [Math.round(<?php //echo $value['diasCC'];?>)];
        
    //     label = ['Prom. Dias'];

    //     label2 = 'Dias';

    //     config = generarConfigBarChart(label,data,label2);

    //     idChart = 'diasChartCC' + <?php //echo $mes?> 

    //     generarChartResumen(idChart,config)

    // // ADPV

    //     data = [ <?php //echo $value['adpvCC'];?> ];

    //     label = ['Prom. Adpv'];

    //     label2 = 'Kg';

    //     config = generarConfigBarChart(label,data,label2);

    //     idChart = 'adpvChartCC' + <?php //echo $mes?> 

    //     generarChartResumen(idChart,config)

    // // KG ING

    //     data = [<?php //echo $value['kgIngCC'];?>];
    
    //     label = ['Prom. Kg Ingreso'];

    //     config = generarConfigBarChart(label,data,label2);

    //     idChart = 'kgIngChartCC' + <?php //echo $mes?> 

    //     generarChartResumen(idChart,config)


    // // KG EGR

    //     data = [<?php //echo $value['kgEgrCC'];?>];
    
    //     label = ['Prom. Kg Egreso'];

    //     config = generarConfigBarChart(label,data,label2);

    //     idChart = 'kgEgrChartCC' + <?php //echo $mes?> 

    //     generarChartResumen(idChart,config)


    // // KG PROD

    //     data = [<?php //echo $value['kgProdCC'];?>];
            
    //     label = ['Prom. Kg Produc.'];

    //     config = generarConfigBarChart(label,data,label2);

    //     idChart = 'kgProdChartCC' + <?php //echo $mes?> 

    //     generarChartResumen(idChart,config)
    // // CONVERCION

    //     data = [<?php //echo $value['convMsCC'];?>];
            
    //     label = ['Conversion MS'];

    //     config = generarConfigBarChart(label,data,label2);

    //     idChart = 'conversionChartCC' + <?php //echo $mes?> 

    //     generarChartResumen(idChart,config)

</script>
