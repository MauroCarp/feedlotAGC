<?php
 /// OBTENCION DE DATOS


    /*********
             POBLACION SEGUN SEXO
                                    ********/
    // MACHOS
    $item = 'adpvRC';

    $valor = '';

    $item2 = 'sexo';

    $valor2 = 'M';

    $operador = '!=';
    $totalMachos = ControladorDatos::ctrContarDatos($item,$valor,$item2,$valor2,$operador);

    // HEMBRAS
                                    
    $valor2 = 'H';

    $totalHembras = ControladorDatos::ctrContarDatos($item,$valor,$item2,$valor2,$operador);

    /*********
                 % POBLACION
                                    ********/
    $totalAnimalesRC = $totalMachos[0] + $totalHembras[0];

    $restoAnimales = $totalAnimalesCC - $totalAnimalesRC;

                                    
    /*********
                     ADPV
                                    ********/

    $item = NULL;
    $valor = NULL;
    $campo = 'adpvRC';
    $sumaADPV = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $totalAdpvRC = $sumaADPV[0][0];
    $promedioAdpvRC = number_format(($totalAdpvRC / $totalAnimalesRC),2);

                                
    /*********
                     DIAS 
                                    ********/
    
    $campo = 'diasRC';
    $totalDias = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $totalDiasRC = $totalDias[0][0];

    $promedioDiasRC = round(($totalDiasRC / $totalAnimalesRC));
            
    /*********
                    KG INGRESO
                                    ********/
    
    $campo = 'kgIngresoRC';
    $kilosIng = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosIngRR = $kilosIng[0][0];

    $promedioKgIngRC = number_format(($kilosIngRR / $totalAnimalesRC),2);

    /*********
                    KG SALIDA
                                    ********/
    
    $campo = 'kgSalidaRC';
    $kilosEgrPR = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosEgrPR = $kilosEgrPR[0][0];

    $promedioKgEgrRC = number_format(($kilosEgrPR / $totalAnimalesRC),2);

                                    
    /*********
                 KG PRODUCCION
                                    ********/

    
    $campo = 'kgProdRC';
    $kilosProd = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosProdRC = $kilosProd[0][0];

    $promedioKgProdRC = number_format(($kilosProdRC / $totalAnimalesRC),2);

?>

<h2>Recr&iacute;a Corral</h2>

<div class="row">

    <div class="col-md-4">
      <!-- BAR CHART -->
      <div class="box box-success">
          <div class="box-header with-border">
          <h3 class="box-title">ADPV</h3>
          </div>
          <div class="box-body">
          <div class="chart">
              <canvas id="barChartRC" style="height:230px"></canvas>
          </div>
          </div>

      </div>
      
    </div>

    <div class="col-md-4">
      <!-- BAR CHART -->
      <div class="box box-success">
          <div class="box-header with-border">
          <h3 class="box-title">Días</h3>
          </div>
          <div class="box-body">
          <div class="chart">
              <canvas id="barChart1RC" style="height:230px"></canvas>
          </div>
          </div>

      </div>
    
    </div>

    <div class="col-md-4">  
        
        <!-- DONUT CHART -->
        <div class="box box-danger">
        
            <div class="box-header with-border">
            
            <h3 class="box-title">% Población / Total: <?php echo $totalAnimalesRC;?> Animales</h3>

            </div>
            
            <div class="box-body">

                <canvas id="pieChart1RC" style="height:100px"></canvas>

            </div>
        
        </div>

    </div>   
</div>
<div class="saltopagina"></div>
<div class="row">

      <div class="col-md-4">
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Kg Ingreso</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="barChart2RC" style="height:230px"></canvas>
            </div>
          </div>

        </div>
        

      </div>

      <div class="col-md-4">
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Kg Salida</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="barChart3RC" style="height:230px"></canvas>
            </div>
          </div>

        </div>
        

      </div>

      <div class="col-md-4">
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Kg Produc.</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="barChart4RC" style="height:230px"></canvas>
            </div>
          </div>

        </div>
        

      </div>

</div>

<script>
function configuracionPie(data,color,label,label2){
          
  let configuracion = {
    type: 'pie',
    data: {
      datasets: [{
        data: data,
        backgroundColor:

          color
        ,
        label: label2
      }],
      labels: label
    },
    options: {
        responsive: true,
        title: {
          display: false,
        },
        plugins:{
          labels:{
            render: 'value'
          }
        },
        legend: {
          labels: {
              boxWidth: 5
          }
        }
      }
  };
    
  return configuracion;

}


function configuracionBar(labels,data,labels2){

  let configuracion = {
    labels: labels,
    datasets: [{
      label: labels2,
      backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
      borderColor: window.chartColors.red,
      borderWidth: 1, 

      data: data
    }]

  }

  return configuracion;

}

data = [<?php $totalMachos[0].",".$totalHembras[0].",";?>];

colors = [window.chartColors.red,window.chartColors.orange];

labels = ['Macho','Hembra'];

let configPSSRC = configuracionPie(data,colors,labels,'Sexo');


data = [<?php echo $totalAnimalesRC.",".$restoAnimales.",";?>];

labels = ['Población RC','Resto Población'];

let configPPRC = configuracionPie(data,colors,labels,'value');

var color = Chart.helpers.color;

data = [<?php echo $promedioAdpvRC;?>];

labels = ['Prom. Adpv'];

let configADPVRC = configuracionBar(labels,data,'Kg. Prom');

data = [<?php echo $promedioDiasRC;?>];

labels = ['Prom. Dias'];

let configDiasRC = configuracionBar(labels,data,'Dias Prom.');

data = [<?php echo $promedioKgProdRC;?>];

labels = ['Kg Produc. Promedio'];

let configKgProdRC = configuracionBar(labels,data,'Kg Produc. Promedio');

</script>
