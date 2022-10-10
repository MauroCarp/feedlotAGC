<?php

$periodos = $_GET['periodos'];

$cantidadPeriodos = sizeof(explode('/',$_GET['periodos']));

$periodosExplode = explode('/',$_GET['periodos']);

$meses = Array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

function formatearNumero($number){

  return number_format($number,2);

}
// DATA ULTIMOS 6 PERIODOS

  $cantidad = 6;

  // LABELS

  $campo = 'periodo';

  $ultimosLabels = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);
  

  // CONVERSION

  $campo = 'converMSEstADPV';

  $conversion = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);

  // COSTO KG MS

  $campo = 'CKgRacPromMS';

  $costoKgMS = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);


  // POBLACION

  $campo = 'poblDiaPromPeriodo';

  $poblacion = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);

  // ESTADIA

  $campo = 'estadiaProm';

  $estadia = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);

  $campo = 'indiceReposicion';

  $indiceReposicion = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);

  // $ KG PRODUCIDO

  $campo = 'CProdKgAES';

  $costoKgProd = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);

  // MARGEN TECNICO POR CABEZAS SALIDAS

  $campo = 'margenTecKgProd';

  $margenTec = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);

  // CABEZAS SALIDAS

  $campo = 'cabTrazSalidas';

  $cabSalidas = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);

  // KG GANADOS PERIODO TRAZAD

  $campo = 'kilosGanPeriodoTraz';

  $kgGanPeriodoTraz = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);


  // CONSUMO SOJA

  $campo = 'consumoSoja';

  $consumoSoja = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);

  // CONSUMO MAIZ

  $campo = 'consumoMaiz';

  $consumoMaiz = ControladorPanelControl::ctrMostrarUltimos($campo,$cantidad);


  $dataGraficos = array();


  for ($i=5; $i >= 0 ; $i--) { 
      
      $tempExp = explode('-',$ultimosLabels[$i][0]);

      $temp = number_format($tempExp[1]);

      $temp = $meses[$temp - 1];

      $dataGraficos['Labels'][] = $temp." ".$tempExp[0];

      $dataGraficos['Conversion'][] = formatearNumero($conversion[$i][0]);
      
      $dataGraficos['CostoKgMS'][] = formatearNumero($costoKgMS[$i][0]);

      $dataGraficos['Poblacion'][] = $poblacion[$i][0];

      $dataGraficos['Estadia'][] = round($estadia[$i][0]);

      $dataGraficos['IndiceReposicion'][] = $indiceReposicion[$i][0];

      $dataGraficos['KgProd'][] = $costoKgProd[$i][0];
      
      $dataGraficos['MargenTec'][] = number_format(($margenTec[$i][0] * $cabSalidas[$i][0]) * $kgGanPeriodoTraz[$i][0],2,'.','');     
      
      $dataGraficos['ConsumoSoja'][] = $consumoSoja[$i][0];
      
      $dataGraficos['ConsumoMaiz'][] = $consumoMaiz[$i][0];

  }

  $dataGraficos = json_encode($dataGraficos);
  
?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>
    <br>

  </section>

  <div class="row">

    <div class="col-md-12" id="reportesGeneral">

      <div class="nav-tabs-custom">

        <ul class="nav nav-tabs" id="solapasPeriodos" style="font-size:1.em;">

          <?php

          for ($i=0; $i < $cantidadPeriodos ; $i++) { 
            
            
            $periodoExplode = explode('-',$periodosExplode[$i]);

            $mesNumero = number_format($periodoExplode[1]);
          ?>
            
            <li class="tabs <?php echo ($i == 0) ? 'active' : '';?>">
              
              <a href="#periodo_<?php echo $i + 1; ?>" id="solapaPeriodo<?php echo $i + 1;?>" data-toggle="tab" style="background-color:rgba(255,0,0,.4)">
            
                <b><?php echo $meses[$mesNumero - 1]." ".$periodoExplode[0];?>  
                 <span id="btn-chequeado-<?php echo $i + 1;?>">
                  
                  <i class="btn btn-xs fa fa-check-square" onmouseover = "this.style.color = '#03fc6b'"
                  onmouseout = "this.style.color = '#00b84d'" style="cursor:pointer;font-size:1.8em;color:#00b84d;" onclick="chequearPlanilla('<?php echo $periodosExplode[$i].'\',\''.($i + 1).'\',\''.$meses[$mesNumero - 1].' '.$periodoExplode[0];?>')"></i>
                
                </span></b>
              </a>
            
            </li>
          
          <?php
          }
          ?>

        </ul>

        <div class="tab-content" id="contenidoSolapaPeriodos" style="padding-bottom:0px;">

          <?php

          for ($i=0; $i < $cantidadPeriodos ; $i++) { ?>
            
            <div class="tab-pane <?php echo ($i == 0) ? 'active' : '';?>" id="periodo_<?php echo $i + 1;?>">
                    
              <?php include('reportes/panelControl/cajasPanelControl.php'); ?>

              <div class="nav-tabs-custom">

                <ul class="nav nav-tabs" style="font-size:1.em;">

                  <li class="tabs active"><a href="#tab_1_<?php echo $i + 1;?>" data-toggle="tab" class="tabsPanelControl"><b>Consumos</b></a></li>

                  <li class="tabs"><a href="#tab_2_<?php echo $i + 1;?>" data-toggle="tab" class="tabsPanelControl"><b>Poblacion</b></a></li>

                  <li class="tabs"><a href="#tab_3_<?php echo $i + 1;?>" data-toggle="tab" class="tabsPanelControl"><b>Producci&oacute;n</b></a></li>
                  
                  <li class="tabs"><a href="#tab_4_<?php echo $i + 1;?>" data-toggle="tab" class="tabsPanelControl"><b>Estadisticas</b></a></li>

                </ul>

                <div class="tab-content" style="padding-bottom:0px;">

                  <div class="tab-pane active" id="tab_1_<?php echo $i + 1;?>">

                    <?php include 'reportes/panelControl/consumos.php'; ?>

                  </div>

                  <div class="tab-pane poblacion" id="tab_2_<?php echo $i + 1;?>">

                    <?php include 'reportes/panelControl/poblacion.php'; ?>

                  </div>

                  <div class="tab-pane produccion" id="tab_3_<?php echo $i + 1;?>">

                  <?php include('reportes/panelControl/produccion.php'); ?>

                  </div>

                  <div class="tab-pane estadisticas" id="tab_4_<?php echo $i + 1;?>">

                  <?php include('reportes/panelControl/estadisticas.php'); ?>

                  </div>
                
                </div>

              </div> 

            </div> 
    
          <?php
          }
          ?>
        
        </div> 
    
      </div> 
    
    </div> 
  
  </div> 

</div> 

<script>

function generarColores(cantidad,tipo){

  let coloresBg = ['rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)','rgba(255, 159, 64, 0.2)','rgba(100, 255, 64, 0.2)'];

  let coloresBr = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(100, 255, 64, 1)'];

  let colores = [];

  for (let index = 0; index < cantidad; index++) {

    if(tipo == 'bg'){
      
      colores.push(coloresBg[index])
      
    }else{
      
      colores.push(coloresBr[index]);
      
    }
    
  }

  return colores;

}

function format(number){

  let num = number.replace(/\./g,'');

  num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');

  num = num.split('').reverse().join('').replace(/^[\.]/,'');

  return num;

}


function generarGraficoBarSimple(registros,divId,labels,tituloLabel){

  let coloresBg = generarColores(registros.length,'bg');
          
  let coloresBr = generarColores(registros.length,'br');
          
  let ctx = document.getElementById(divId).getContext('2d');

  let myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: tituloLabel,
                                        data: registros,
                                        backgroundColor: coloresBg,
                                        borderColor: coloresBr,
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                  scales: {
                                      yAxes: [{
                                          ticks: {
                                              beginAtZero: true
                                          }
                                      }]
                                    },
                                    plugins: {
                                      labels: {
                                        render: 'value'
                                      },
                                      legend: {
                                        display: false,
                                      }
                                    }
                                }
                              });   

  return myChart; 

}

function generarGraficoLinea(registros,divId,labels,tituloLabel){

  let ctx = document.getElementById(divId).getContext('2d');
  
  let data = [0,0,0,0,0,0,0,0,0,0,0,0,0];

  for (let index = 1; index <= labels.length; index++) {
    
    data[index] = (registros[index]) ? registros[index] : 0;
    
  }  
  
  data.shift()
    
  let minimo = 0;


  if(tituloLabel == 'Conversión de MS' || tituloLabel == 'A.D.P.V'  || tituloLabel ==  'Estadia Promedio'){

    // console.log(tituloLabel);
      
    let  result = data.filter(valor => valor != 0);

    minimo = (tituloLabel == 'A.D.P.V') ? Math.min.apply(null, result) : (Math.min.apply(null, result) - 1)
    
    // console.log(minimo);
  }



  let myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: tituloLabel,
                                        data: registros,
                                        borderColor: window.chartColors.red,
                                        fill:false,
                                        data:data
                                    }]
                                },
                                options: {
                                  scales: {
                                      yAxes: [{
                                          ticks: {
                                              min: minimo,
                                          }
                                      }]
                                    },
                                    plugins: {
                                      labels: {
                                        render: 'value'
                                      },
                                      legend: {
                                        display: true,
                                      }
                                    }
                                }
  });   
    
  return myChart; 

}

function generarGraficoBarDoble(divId,labels,consumoSoja,consumoMaiz){
  
  let ctx = document.getElementById(divId).getContext('2d');
 
  let myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                  labels  : labels,
                                  datasets: [
                                    {
                                      label               : 'Soja',
                                      type                : 'bar',
                                      backgroundColor     : 'rgba(154,215,117,0.9)',
                                      borderColor         : 'rgba(154,215,117, 1)',
                                      data                : consumoSoja,
                                      yAxisID             : 'A',

                                    },
                                    {
                                      label               : 'Maiz',
                                      type                : 'bar',
                                      backgroundColor     : 'rgba(255, 206, 86, 0.2)',
                                      borderColor         : 'rgba(255, 206, 86, 1)',
                                      data                : consumoMaiz,
                                      yAxisID             : 'B',

                                    }
                                  ]
                                },
                                options: {
                                  scales: {
                                    xAxes: [{
                                          gridLines: {
                                              color: "rgba(0, 0, 0, 0)",
                                          }
                                      }],
                                      yAxes: [{
                                        id: 'A',
                                        type: 'linear',
                                        position: 'left',
                                        ticks: {
                                              beginAtZero: true
                                          },
                                        gridLines: {
                                            color: "rgba(0, 0, 0, 0)",
                                        }
                                        }, {
                                          id: 'B',
                                          type: 'linear',
                                          position: 'right',
                                          ticks: {
                                                beginAtZero: true
                                            },
                                          gridLines: {
                                          color: "rgba(0, 0, 0, 0)",
                                            }
                                        }
                                        
                                      ]
                                  
                                    },
                                    plugins: {
                                      labels: {
                                        render: (val)=>{ return format(val.value);},
                                      },
                                      legend: {
                                        display: false,
                                        
                                      }
                                    }
                                }
                              });


  return myChart; 

}

meses = new Array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");

let periodos = <?php echo "'".$_GET['periodos']."'";?>;

periodos = periodos.split('/');

let url = 'ajax/datosPanelControl.ajax.php';

  for (let index = 0; index < periodos.length; index++) {

    let data = 'accion=data&periodo=' + periodos[index];

    $.ajax({
      
      method: 'POST',
      
      url: url,
      
      data: data,
      
      success: function(response){

        response = JSON.parse(response);
          
        if(response.CajaPoblacion != null){

          $('#CostoDiario' + (index + 1)).html(response.Consumo1);

          $('#datoConsumo' + (index + 1)).html(response.Consumo2);

          $('#datosPoblacionales' + (index + 1)).html(response.Poblacion);

          $('#kgCarneRinde' + (index + 1)).html(response.Produccion1);

          $('#costoMargeKg' + (index + 1)).html(response.Produccion2);
          
          $('#panelPoblacion' + (index + 1)).html(response.CajaPoblacion);
          
          $('#panelConversion' + (index + 1)).html(response.CajaConversion);

          $('#panelAdpv' + (index + 1)).html(response.CajaAdpv);

          $('#panelPrecioKiloProd' + (index + 1)).html(response.CajaKgProd);

          $('#panelEstadia' + (index + 1)).html(response.CajaEstadia);
          
          if(response.Chequeado == 1){

            $('#solapaPeriodo' + (index + 1 )).css('background-color','white');

            $('#btn-chequeado-' + (index + 1 )).html('');
            
          }

        }else{

          $('#periodo_' + (index + 1 )).html('<h1>No hay resultados</h1>');

          $('#solapaPeriodo' + (index + 1 )).css('background-color','white');

          $('#btn-chequeado-' + (index + 1 )).html('');

        }

      }

    });

    // GRAFICOS
    
    let urlGraficos = 'ajax/graficosPanelControl.ajax.php';

    let dataGraficos = <?php echo $dataGraficos;?>;

    data = 'periodo=' + periodos[index];

    
    $.ajax({
      
      method: 'POST',
      
      url:urlGraficos,
      
      data:data,
      
      success:function(response){
        
        response = JSON.parse(response);

        dataGraficos['IndiceReposicion'].push(response['IndiceReposicion']);
        dataGraficos['Conversion'].push(response['Conversion']);
        dataGraficos['CostoKgMS'].push(response['CostoKgMS']);
        dataGraficos['Poblacion'].push(response['Poblacion']);
        dataGraficos['Estadia'].push(Math.round(response['Estadia']));
        dataGraficos['KgProd'].push(response['KgProd']);
        dataGraficos['MargenTec'].push((response['MargenTec'] * response['CabSalidas'] * response['KgGanPerTraz']).toFixed(2));
        dataGraficos['ConsumoSoja'].push(response['ConsumoSoja']);
        dataGraficos['ConsumoMaiz'].push(response['ConsumoMaiz']);

        
        let tempExp = periodos[index].split('-');

        let temp = parseInt(tempExp[1]);

        temp = meses[temp - 1];

        dataGraficos['Labels'].push(temp + " " + tempExp[0]);

        // CONVERSION
        let divId = 'graficoConversion' + (index + 1);

        generarGraficoBarSimple(dataGraficos['Conversion'],divId,dataGraficos['Labels'],'Conversión');

        // COSTO KG MS
        divId = 'graficoCostoKgMS' + (index + 1);

        generarGraficoBarSimple(dataGraficos['CostoKgMS'],divId,dataGraficos['Labels'],'$ Kg de MS');
        
        // POBLACION
        divId = 'graficoPoblacion' + (index + 1);

        generarGraficoBarSimple(dataGraficos['Poblacion'],divId,dataGraficos['Labels'],'Población Prom.');
        
        // ESTADIA
        divId = 'graficoEstadia' + (index + 1);

        generarGraficoBarSimple(dataGraficos['Estadia'],divId,dataGraficos['Labels'],'Estadia Prom.');
        
        //  INDICE REPOSICION
         divId = 'graficoIndiceReposicion' + (index + 1);

        generarGraficoBarSimple(dataGraficos['IndiceReposicion'],divId,dataGraficos['Labels'],'Indice de Rep.');
        
        // $ Kg Prod
        divId = 'graficoCostoKgProd' + (index + 1);

        generarGraficoBarSimple(dataGraficos['KgProd'],divId,dataGraficos['Labels'],'$ Kg Prod.');
        
        // MARGEN TEC * CAB SALIDAS 
        divId = 'graficoMargenTec' + (index + 1);
        
        let graficoMargenTec = generarGraficoBarSimple(dataGraficos['MargenTec'],divId,dataGraficos['Labels'],'Margen Tec. x Cab Salidas');
        graficoMargenTec.options.plugins.labels.render =  () => {return;} 
        
        // CONSUMOS SOJA Y MAIZ
        divId = 'graficoSojaMaiz' + (index + 1);    

        let graficoConsumoSojaMaiz = generarGraficoBarDoble(divId,dataGraficos['Labels'],dataGraficos['ConsumoSoja'],dataGraficos['ConsumoMaiz']);        

      }

    });



  }

  for (let index = 0; index < periodos.length; index++) {

      let data = 'accion=estadisticas&periodo=' + periodos[index];

      $.ajax({
        
        method: 'POST',
        
        url: url,
        
        data: data,
        
        success: function(respuesta){

          let response = JSON.parse(respuesta);
                              
          
          console.log(response);
          
          let divAnual = `tasaMSPrecioVentaAnual${index + 1}`

          let precioKgMSAnual = response.precioKgMSAnual

          let precioVentaAnual = response.precioVentaAnual

          let tasaAnual = (precioKgMSAnual / precioVentaAnual)
          
          $(`#${divAnual}`).html(tasaAnual.toFixed(2))

          let divId = `graficoTasaMsPrecioVenta${index + 1}`
          
          let precioKgMS = response.precioKgMS;

          let precioVenta = response.precioVenta

          let tasa = {}
          
          for (const key in precioKgMS) {

            let valor = (precioKgMS[key] / precioVenta[key]).toFixed(3)

            tasa[key] = valor
              
          }

          generarGraficoLinea(tasa,divId,meses,'$ MS / $  Venta')
          
          // 

          divAnual = `conversionMSAnual${index + 1}`

          $(`#${divAnual}`).html(response.conversionMSAnual.toFixed(2))

          divId = `graficoConversionMS${index + 1}`
          
          generarGraficoLinea(response.conversionMS,divId,meses,'Conversión de MS')
          
          // 

          divAnual = `ADPVAnual${index + 1}`

          $(`#${divAnual}`).html(response.adpvAnual.toFixed(2))

          divId = `graficoADPV${index + 1}`
          
          generarGraficoLinea(response.adpv,divId,meses,'A.D.P.V')
          
          // 
          
          divAnual = `poblacionPromAnual${index + 1}`

          $(`#${divAnual}`).html(response.poblacionPromAnual.toFixed(2))

          divId = `graficoPoblacionProm${index + 1}`
          
          generarGraficoLinea(response.poblacionProm,divId,meses,'Población Promedio')
          
          // 
          
          divAnual = `estadiaPromAnual${index + 1}`

          $(`#${divAnual}`).html(response.estadiaPromAnual.toFixed(2))
          
          divId = `graficoEstadiaProm${index + 1}`
          
          generarGraficoLinea(response.estadiaProm,divId,meses,'Estadia Promedio')
        
          //

          divAnual = `indiceReposicionAnual${index + 1}`

          $(`#${divAnual}`).html(response.indiceReposicionAnual.toFixed(2))
          
          divId = `graficoIR${index + 1}`
                                            
          generarGraficoLinea(response.indiceReposicion,divId,meses,'Indice Reposicion')

        }

      })
      
    }


</script>

