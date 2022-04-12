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

    $item3 = 'fechaSalida'; 

    $fecha1 = $fechaInicial;

    $fecha2 = $fechaFinal;
    
    $totalMachos = ControladorDatos::ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

    // HEMBRAS
                                    
    $valor2 = 'H';

    $totalHembras = ControladorDatos::ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

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

    $item2 = 'fechaSalida';
    
    $campo = 'adpvT';

    $sumaADPV = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    $totalAdpvT = $sumaADPV[0][0];
    $promedioAdpvT = number_format(($totalAdpvT / $totalAnimalesT),2);

                                
    /*********
                     DIAS 
                                    ********/
    
    $campo = 'diasT';
    $totalDias = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    $totalDiasT = $totalDias[0][0];

    $promedioDiasT = round(($totalDiasT / $totalAnimalesT));
            
    /*********
                    KG INGRESO
                                    ********/
    
    // $campo = 'kgIngresoT';
    // $kilosIng = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    // $kilosIngRR = $kilosIng[0][0];

    // $promedioKgIngT = number_format(($kilosIngRR / $totalAnimalesT),2);

    // /*********
    //                 KG SALIDA
    //                                 ********/
    
    // $campo = 'kgSalidaT';
    // $kilosEgrPR = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    // $kilosEgrPR = $kilosEgrPR[0][0];

    // $promedioKgEgrT = number_format(($kilosEgrPR / $totalAnimalesT),2);

                                    
    /*********
                 KG PRODUCCION
                                    ********/

    
    $campo = 'kgProdT';
    $kilosProd = ControladorDatos::ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    $kilosProdT = $kilosProd[0][0];

    $promedioKgProdT = number_format(($kilosProdT / $totalAnimalesT),2);

?>
<br>


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
            
            <h3 class="box-title">% Participaci&oacute;n  / Total: <?php echo $totalAnimalesT;?> Animales</h3>

            </div>
            
            <div class="box-body">

                <canvas id="pieChart1T" style="height:150px"></canvas>

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
              <!-- <canvas id="barChart2T" style="height:230px"></canvas> -->
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
              <!-- <canvas id="barChart3T" style="height:230px"></canvas> -->
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

// POBLACION

data = [<?php echo $totalMachos[0].",".$totalHembras[0].",";?>];

label = ['Macho','Hembra'];
        
let configPSST = configuracionPie(data,label);

// PARTICIPACION

data = [<?php echo $totalAnimalesT.",".$restoAnimales.",";?>];

label = ['Población T','Resto Población'];

let configPPT = configuracionPie(data,label);

// ADPV

var color = Chart.helpers.color;

data = [ <?php echo $promedioAdpvT;?> ];

label = ['Prom. Adpv'];

label2 = 'Kg. Prom';

let configADPVT = configuracionBar(label,data,label2);

// DIAS

label = ['Prom. Dias'];

label2 = 'Dias';

data = [<?php echo $promedioDiasT;?>];

let configDiasT = configuracionBar(label,data,label2);

// KG PROD

label = ['Prom. Kg Produc.'];

data = [<?php echo $promedioKgProdT;?>];

let configKgProdT = configuracionBar(label,data,label2);





</script>
