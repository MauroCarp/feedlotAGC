<?php
 /// OBTENCION DE DATOS


    /*********
             POBLACION SEGUN SEXO
                                    ********/
    // MACHOS
    $item = 'adpvT';

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
    $totalAnimalesT = $totalMachos[0] + $totalHembras[0];

    $restoAnimales = $totalAnimalesCC - $totalAnimalesT;

                                    
    /*********
                     ADPV
                                    ********/

    $item = NULL;
    $valor = NULL;
    $campo = 'adpvT';
    $sumaADPV = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $totalAdpvT = $sumaADPV[0][0];
    $promedioAdpvT = number_format(($totalAdpvT / $totalAnimalesT),2);

                                
    /*********
                     DIAS 
                                    ********/
    
    $campo = 'diasT';
    $totalDias = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $totalDiasT = $totalDias[0][0];

    $promedioDiasT = round(($totalDiasT / $totalAnimalesT));
            
    /*********
                    KG INGRESO
                                    ********/
    
    $campo = 'kgIngresoT';
    $kilosIng = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosIngRR = $kilosIng[0][0];

    $promedioKgIngT = number_format(($kilosIngRR / $totalAnimalesT),2);

    /*********
                    KG SALIDA
                                    ********/
    
    $campo = 'kgSalidaT';
    $kilosEgrPR = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosEgrPR = $kilosEgrPR[0][0];

    $promedioKgEgrT = number_format(($kilosEgrPR / $totalAnimalesT),2);

                                    
    /*********
                 KG PRODUCCION
                                    ********/

    
    $campo = 'kgProdT';
    $kilosProd = ControladorDatos::ctrSumarCampo($item,$valor,$campo);

    $kilosProdT = $kilosProd[0][0];

    $promedioKgProdT = number_format(($kilosProdT / $totalAnimalesT),2);

?>

<h2>Terminaci&oacute;n</h2>

<div class="row">

    <div class="col-md-4">
      <!-- BAR CHART -->
      <div class="box box-success">
          <div class="box-header with-border">
          <h3 class="box-title">ADPV</h3>
          </div>
          <div class="box-body">
          <div class="chart">
              <canvas id="barChartT" style="height:230px"></canvas>
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
              <canvas id="barChart1T" style="height:230px"></canvas>
          </div>
          </div>

      </div>
    
    </div>

    <div class="col-md-4">  
        
        <!-- DONUT CHART -->
        <div class="box box-danger">
        
            <div class="box-header with-border">
            
            <h3 class="box-title">% Población / Total: <?php echo $totalAnimalesT;?> Animales</h3>

            </div>
            
            <div class="box-body">

                <canvas id="pieChart1T" style="height:150px"></canvas>

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
              <canvas id="barChart2T" style="height:230px"></canvas>
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
              <canvas id="barChart3T" style="height:230px"></canvas>
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
              <canvas id="barChart4T" style="height:230px"></canvas>
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

let configPSST = configuracionPie(data,colors,labels,'Sexo');


data = [<?php echo $totalAnimalesT.",".$restoAnimales.",";?>];

labels = ['Población T','Resto Población'];

let configPPT = configuracionPie(data,colors,labels,'value');

var color = Chart.helpers.color;

data = [<?php echo $promedioAdpvT;?>];

labels = ['Prom. Adpv'];

let configADPVT = configuracionBar(labels,data,'Kg. Prom');

data = [<?php echo $promedioDiasT;?>];

labels = ['Prom. Dias'];

let configDiasT = configuracionBar(labels,data,'Dias Prom.');

data = [<?php echo $promedioKgProdT;?>];

labels = ['Kg Produc. Promedio'];

let configKgProdT = configuracionBar(labels,data,'Kg Produc. Promedio');


</script>
