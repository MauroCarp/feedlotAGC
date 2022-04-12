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
    
    $item3 = 'fechaSalida';

    $totalMachos = ControladorDatos::ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

    // HEMBRAS
                                    
    $valor2 = 'H';

    $totalHembras = ControladorDatos::ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

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
    
    $item2 = 'fechaSalida';

    $campo = 'adpvRC';

    $sumaADPV = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    $totalAdpvRC = $sumaADPV[0][0];
    $promedioAdpvRC = number_format(($totalAdpvRC / $totalAnimalesRC),2);

                                
    /*********
                     DIAS 
                                    ********/
    
    $campo = 'diasRC';
    $totalDias = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    $totalDiasRC = $totalDias[0][0];

    $promedioDiasRC = round(($totalDiasRC / $totalAnimalesRC));
            
    /*********
                    KG INGRESO
                                    ********/
    
    // $campo = 'kgIngresoRC';
    // $kilosIng = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    // $kilosIngRR = $kilosIng[0][0];

    // $promedioKgIngRC = number_format(($kilosIngRR / $totalAnimalesRC),2);

    // /*********
    //                 KG SALIDA
    //                                 ********/
    
    // $campo = 'kgSalidaRC';
    // $kilosEgrPR = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    // $kilosEgrPR = $kilosEgrPR[0][0];

    // $promedioKgEgrRC = number_format(($kilosEgrPR / $totalAnimalesRC),2);

                                    
    /*********
                 KG PRODUCCION
                                    ********/

    
    $campo = 'kgProdRC';
    $kilosProd = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    $kilosProdRC = $kilosProd[0][0];

    $promedioKgProdRC = number_format(($kilosProdRC / $totalAnimalesRC),2);

?>
<br>
<div class="row">

   

</div>

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

<div class="row">

      <div class="col-md-4">
        <!-- BAR CHART -->
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Kg Ingreso</h3>
          </div>
          <div class="box-body">
            <div class="chart">
              <!-- <canvas id="barChart2RC" style="height:230px"></canvas> -->
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
              <!-- <canvas id="barChart3RC" style="height:230px"></canvas> -->
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

// POBLACION

data = [<?php echo $totalMachos[0].",".$totalHembras[0].",";?>];

label = ['Macho','Hembra'];
        
let configPSSRC = configuracionPie(data,label);

// PARTICIPACION

data = [<?php echo $totalAnimalesRC.",".$restoAnimales.",";?>];

label = ['Población RC','Resto Población'];

let configPPRC = configuracionPie(data,label);

// ADPV

var color = Chart.helpers.color;

data = [ <?php echo $promedioAdpvRC;?> ];

label = ['Prom. Adpv'];

label2 = 'Kg. Prom';

let configADPVRC = configuracionBar(label,data,label2);

// DIAS

label = ['Prom. Dias'];

label2 = 'Dias';

data = [<?php echo $promedioDiasRC;?>];

let configDiasRC = configuracionBar(label,data,label2);

// KG PROD

label = ['Prom. Kg Produc.'];

data = [<?php echo $promedioKgProdRC;?>];

let configKgProdRC = configuracionBar(label,data,label2);




</script>
