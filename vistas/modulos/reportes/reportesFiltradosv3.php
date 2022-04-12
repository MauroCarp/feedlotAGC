<?php

if($_SESSION["perfil"] == "Ganadero" || $_SESSION["perfil"] == "Agro"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

 
  
}
$colores = array('','red','blue','green','yellow');
if(array_key_exists('consignatario1',$_GET)){
    $cantidad = $_GET['cantidad'];

    $datos = array();

    $datos['labels'] = array('Consignatario'=>(''),'Tropa'=>(''));
    $datos['dias'] = array('CC'=> (''),'RP'=> array(),'RC'=> array(),'T'=> array());
    $datos['adpv'] = array('CC'=> (''),'RP'=> array(),'RC'=> array(),'T'=> array());
    $datos['kgIng'] = array('CC'=> array(),'RP'=> array(),'RC'=> array(),'T'=> array());
    $datos['kgEgr'] = array('CC'=> array(),'RP'=> array(),'RC'=> array(),'T'=> array());
    $datos['kgProd'] = array('CC'=> array(),'RP'=> array(),'RC'=> array(),'T'=> array());

    
    
    for ($i=1; $i <= $cantidad ; $i++) { 
        
        $consignatarioIndex = 'consignatario'.$i; 
        $tropaIndex = 'tropa'.$i;
        
        
        $item = 'consignatario';
        $valor = $_GET[$consignatarioIndex];
        
        $item2 = 'tropa';
        $valor2 = $_GET[$tropaIndex];
    
        $tropaValido = ($valor2 != 'Tropa') ? TRUE : FALSE;


        /*********
                      LABELS
                                    ********/


        $datos['labels']['Consignatario'] = $datos['labels']['Consignatario'].','.$valor;
        $datos['labels']['Tropa'] = $datos['labels']['Tropa'].','.$valor2; 


        /*********
                 CANTIDAD 
                                ********/

        $totalCC= ControladorDatosComparar::ctrContarAnimalesComparar($item,$item2,$valor,$valor2,'adpvCC');
        $totalAnimalesCC = $totalCC[0][0];
    
        $totalRP= ControladorDatosComparar::ctrContarAnimalesComparar($item,$item2,$valor,$valor2,'adpvRP');
        $totalAnimalesRP = $totalRP[0][0];
    
        $totalRC= ControladorDatosComparar::ctrContarAnimalesComparar($item,$item2,$valor,$valor2,'adpvRC');
        $totalAnimalesRC = $totalRC[0][0];
        
        $totalT= ControladorDatosComparar::ctrContarAnimalesComparar($item,$item2,$valor,$valor2,'adpvT');
        $totalAnimalesT = $totalT[0][0];
        
        if ($tropaValido) {
            
            $totalAnimalesCC = $totalCC[0];
            
            $totalAnimalesRP = $totalRP[0];
            
            $totalAnimalesRC = $totalRC[0];
            
            $totalAnimalesT = $totalT[0];
            
        }
        

         /*********
                      ADPV 
                                    ********/

        //CC

        $campo = 'adpvCC';
        $sumaADPV = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        $totalAdpv = $sumaADPV[0];
        $promedioAdpv = ($totalAdpv != 0) ? number_format(($totalAdpv / $totalAnimalesCC),2) : 0;
        $dataSet = " {
            label: 'Kg Prom',
            backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
            borderColor: window.chartColors.".$colores[$i].",
            borderWidth: 1, 
            data: [".$promedioAdpv."
            ]
        }";

        $datos['adpv']['CC'] = ($cantidad > 1) ? $datos['adpv']['CC'].",".$dataSet : $dataSet;

        // // RP
        // $campo = 'adpvRP';
        // $sumaADPV = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $totalAdpv = $sumaADPV[0];
        // $promedioAdpv = ($totalAdpv != 0) ? number_format(($totalAdpv / $totalAnimalesRP),2) : 0;
        // $datos['adpv']['RP'] = $datos['adpv']['RP'].' , '.$promedioAdpv;
      
        // // RC
        // $campo = 'adpvRC';
        // $sumaADPV = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $totalAdpv = $sumaADPV[0];
        // $promedioAdpv = ($totalAdpv != 0) ? number_format(($totalAdpv / $totalAnimalesRC),2) : 0;
        // $datos['adpv']['RC'] = $datos['adpv']['RC'].' , '.$promedioAdpv;

        // // T
        // $campo = 'adpvT';
        // $sumaADPV = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $totalAdpv = $sumaADPV[0];
        // $promedioAdpv = ($totalAdpv != 0) ? number_format(($totalAdpv / $totalAnimalesT),2) : 0;
        // $datos['adpv']['T'] = $datos['adpv']['T'].' , '.$promedioAdpv;


    
        // /*********
        //              DIAS 
        //                         ********/
    

        // //CC

        // $campo = 'diasCC';
        // $totalDias = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $totalDias = $totalDias[0];
        // $promedioDias = ($totalDias != 0) ? round(($totalDias / $totalAnimalesCC)) : 0;
        // $datos['dias']['CC'] = $datos['dias']['T'].' , '.$promedioDias;

        // //RP

        // $campo = 'diasRP';
        // $totalDias = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $totalDias = $totalDias[0];
        // $promedioDias = ($totalDias != 0) ? round(($totalDias / $totalAnimalesRP)) : 0;
        // $datos['dias']['RP'] = $datos['dias']['RP'].' , '.$promedioDias;
        // //RC

        // $campo = 'diasRC';
        // $totalDias = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $totalDias = $totalDias[0];
        // $promedioDias = ($totalDias != 0) ? round(($totalDias / $totalAnimalesRC)) : 0;
        // $datos['dias']['RC'] = $datos['dias']['RC'].' , '.$promedioDias;
        // //T

        // $campo = 'diasT';
        // $totalDias = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $totalDias = $totalDias[0];
        // $promedioDias = ($totalDias != 0) ? round(($totalDias / $totalAnimalesT)) : 0;
        // $datos['dias']['T'] = $datos['dias']['T'].' , '.$promedioDias;

            
        // /*********
        //             KG INGRESO
        //                             ********/

        // //CC
        // $campo = 'kgIngresoCC';
        // $kilosIng = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosIng = $kilosIng[0]; 
        // $promedioKgIng = ($kilosIng != 0) ? round(($kilosIng / $totalAnimalesCC)) : 0;
        // $datos['kgIng']['CC'] = $datos['kgIng']['CC'].' , '.$promedioKgIng;

        // //RP
        // $campo = 'kgIngresoRP';
        // $kilosIng = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosIng = $kilosIng[0]; 
        // $promedioKgIng =  ($kilosIng != 0) ? round(($kilosIng / $totalAnimalesRP)) : 0;
        // $datos['kgIng']['RP'] = $datos['kgIng']['RP'].' , '.$promedioKgIng;

        // //RC
        // $campo = 'kgIngresoRC';
        // $kilosIng = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosIng = $kilosIng[0]; 
        // $promedioKgIng = ($kilosIng != 0) ? round(($kilosIng / $totalAnimalesRC)) : 0;
        // $datos['kgIng']['RC'] = $datos['kgIng']['RC'].' , '.$promedioKgIng;

        // //T
        // $campo = 'kgIngresoT';
        // $kilosIng = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosIng = $kilosIng[0]; 
        // $promedioKgIng =  ($kilosIng != 0) ? round(($kilosIng / $totalAnimalesT)) : 0;
        // $datos['kgIng']['T'] = $datos['kgIng']['T'].' , '.$promedioKgIng;



        // /*********
        //             KG SALIDA
        //                             ********/

        // //CC
        // $campo = 'kgSalidaCC';
        // $kilosEgr = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosEgr = $kilosEgr[0];
        // $promedioKgEgr = ($kilosEgr != 0) ? round(($kilosEgr / $totalAnimalesCC)) : 0 ;
        // $datos['kgEgr']['CC'] = $datos['kgEgr']['CC'].' , '.$promedioKgEgr;

        // //RP
        // $campo = 'kgSalidaRP';
        // $kilosEgr = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosEgr = $kilosEgr[0];
        // $promedioKgEgr = ($kilosEgr != 0) ? round(($kilosEgr / $totalAnimalesRP)) : 0 ;
        // $datos['kgEgr']['RP'] = $datos['kgEgr']['RP'].' , '.$promedioKgEgr;

        // //RC
        // $campo = 'kgSalidaRC';
        // $kilosEgr = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosEgr = $kilosEgr[0];
        // $promedioKgEgr = ($kilosEgr != 0) ? round(($kilosEgr / $totalAnimalesRC)) : 0 ;
        // $datos['kgEgr']['RC'] = $datos['kgEgr']['RC'].' , '.$promedioKgEgr;

        // //T
        // $campo = 'kgSalidaT';
        // $kilosEgr = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosEgr = $kilosEgr[0];
        // $promedioKgEgr = ($kilosEgr != 0) ? round(($kilosEgr / $totalAnimalesT)) : 0 ;
        // $datos['kgEgr']['T'] = $datos['kgEgr']['T'].' , '.$promedioKgEgr;

                                
        // /*********
        //          KG PRODUCCION
        //                         ********/
        // //CC

        // $campo = 'kgProdCC';
        // $kilosProd = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosProd = $kilosProd[0];
        // $promedioKgProd = ($kilosProd != 0) ? round(($kilosProd / $totalAnimalesCC)) : 0 ;
        // $datos['kgProd']['CC'] = $datos['kgProd']['CC'].' , '.$promedioKgProd;

        // //RP
        // $campo = 'kgProdRP';
        // $kilosProd = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosProd = $kilosProd[0];
        // $promedioKgProd = ($kilosProd != 0) ? round(($kilosProd / $totalAnimalesRP)) : 0 ;
        // $datos['kgProd']['RP'] = $datos['kgProd']['RP'].' , '.$promedioKgProd;

        // //RC
        // $campo = 'kgProdRC';
        // $kilosProd = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosProd = $kilosProd[0];
        // $promedioKgProd = ($kilosProd != 0) ? round(($kilosProd / $totalAnimalesRC)) : 0 ;
        // $datos['kgProd']['RC'] = $datos['kgProd']['RC'].' , '.$promedioKgProd;

        // //T
        // $campo = 'kgProdT';
        // $kilosProd = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$valor,$valor2,$campo);
        // $kilosProd = $kilosProd[0];
        // $promedioKgProd = ($kilosProd != 0) ? round(($kilosProd / $totalAnimalesT)) : 0 ;
        // $datos['kgProd']['T'] = $datos['kgProd']['T'].' , '.$promedioKgProd;


    }

    // $data = json_encode($datos);
}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reportes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reportes</li>
    
    </ol>

  </section>
  
  
  <div class="box">
   
    <section class="content">

          <!-- // FILTROS -->
          <div class="box-header with-border">

            <div class="input-group" id="filtros">
              
              <div class="row">
                  
                  <div class="col-md-4">
                    <label>Rango de Fechas</label><br>

                    <button type="button" class="btn btn-default" id="daterange-btn">
                    
                      <span>
                        <i class="fa fa-calendar"></i> 

                        <?php

                          if(isset($_GET["fechaInicial"])){

                            echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
                          
                          }else{
                          
                            echo 'Rango de fecha';

                          }

                        ?>
                      </span>

                      <i class="fa fa-caret-down"></i>

                    </button>

                  </div>
              
                <div class="col-md-4">

                  <div class="form-group">
                    <label>Consignatario</label>
                    <select class="form-control consignatarios" name="consignatario1" id="consignatario1" onchange=(cargarTropaConsignatario(this.id))>
                      <option value=''>Consignatario</option>";

                    <?php
                      $item = null;
                      $valor = null;
                      $variable = 'consignatario';
                      $consignatarios = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);
                      asort($consignatarios);
                      foreach ($consignatarios as $key => $value) {
                       echo "<option value='".utf8_decode($value[0])."'>".utf8_decode($value[0])."</option>";
                      }
                    ?>
                    </select>

                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <label>Tropa</label>
                    <select class="form-control tropas" name="tropa1" id="tropa1" onchange="bloquearConsignatario(this.id)">
                    <option value='Tropa'>Tropa</option>";
                      <?php
                        
                        $item = null;
                        $valor = null;
                        $variable = 'tropa';
                        $tropas = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);
                        asort($tropas);
                        foreach ($tropas as $key => $value) {
                        echo "<option value='".$value[0]."'>".$value[0]."</option>";
                        }
                        
                      ?>
                    </select>

                  </div>

                </div>

              </div>

            </div>
            
            <div class="box-tools pull-right">

              <?php

              if(isset($_GET["fechaInicial"])){

                echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

              }else{

                echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

              }         

              ?>
              
              <button class="btn btn-success" style="margin-top:5px" disabled>Imprimir Reporte</button>

              </a>

            </div>

            <br>
            <div class="row">
            
                <div class="col-md-1">

                  <button type="button" class="btn btn-info" id="comparar">Comparar</button>

                </div>

                <div class="col-md-3">

                  <button type="button" class="btn btn-info" id="generarReporte">Generar Reportes</button>

                </div>

            </div>

          </div>
          
          <br>

          <div class="row">

                <div class="col-md-12" id="reportesFiltrados">

                  <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs" style="font-size:1.5em;">
                          <li class="tabs active" id="cicloCompletoFiltrado"><a href="#tab_1F" data-toggle="tab">Ciclo Completo</a></li>
                          <li class="tabs" id="recriaPastorilFiltrado"><a href="#tab_2F" data-toggle="tab">Recr&iacute;a Pastoril</a></li>
                          <li class="tabs" id="recriaCorralFiltrado"><a href="#tab_3F" data-toggle="tab">Recr&iacute;a Corral</a></li>
                          <li class="tabs" id="terminacionFiltrado"><a href="#tab_4F" data-toggle="tab">Terminaci&oacute;n</a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1F">
                              
                              <?php include('cicloCompletoFiltrado.php'); ?>
                          
                          </div>

                          <div class="tab-pane recriaPastoril" id="tab_2F">

                              <?php include('recriaPastorilFiltrado.php'); ?>

                          </div>

                          <div class="tab-pane recriaCorral" id="tab_3F">

                              <?php include('recriaCorralFiltrado.php'); ?>

                          </div>

                          <div class="tab-pane terminacion" id="tab_4F">
                          
                              <?php include('terminacionFiltrado.php'); ?>

                          </div>

                      </div>

                  </div>

                </div>
          </div>
    </section>
    </div>

</div>
 

<script>

$(function () {

  var color = Chart.helpers.color;

        // var data = <?php //print_r($data) ?>;
        //DIAS
        
        // var diasCC = data.dias.CC.substr(2);
        // var diasRP = data.dias.RP.substr(2);
        
        // var diasRC = data.dias.RC.substr(2);
        // var diasT = data.dias.T.substr(2);
        // generarGraficos('chartDiasCC',diasCC,'Dias Prom','Dias','barChart1Filtrado');
        // generarGraficos('chartDiasRP',diasRP,'Dias Prom','Dias','barChart1RPFiltrado');
        // generarGraficos('chartDiasRC',diasRC,'Dias Prom','Dias','barChart1RCFiltrado');
        // generarGraficos('chartDiasT',diasT,'Dias Prom','Dias','barChart1TFiltrado');
        
        
        // //ADPV
        // var adpvCC = data.adpv.CC.substr(2);
        // var adpvRP = data.adpv.RP.substr(2);
        // var adpvRC = data.adpv.RC.substr(2);
        // var adpvT = data.adpv.T.substr(2);

  
        var config = {
          labels: [
            'ADPV'
          ],
          datasets:[

            <?php 
              $valor = substr($datos['adpv']['CC'],2);
              echo $valor;
            ?>
          
          
          ]
        };

        var canvas = document.getElementById('barChartFiltrado').getContext('2d');
        var chart = new Chart(canvas, {
          type: 'bar',
          data: config,
          options: {
            responsive: true,
            legend: {
              position: 'top',
            },
            title: {
              display: false,
            },
            plugins: {
              labels: {
                render: 'value'
              }
            }
          }
        });






        // generarGraficos('chartAdpvCC','adpvCC','Kg Prom','ADPV','barChartFiltrado');
        // generarGraficos('chartAdpvRP',adpvRP,'Kg Prom','ADPV','barChartRPFiltrado');
        // generarGraficos('chartAdpvRC',adpvRC,'Kg Prom','ADPV','barChartRCFiltrado');
        // generarGraficos('chartAdpvT',adpvT,'Kg Prom','ADPV','barChartTFiltrado');
        
        // //KG ING

        // var kgIngCC = data.kgIng.CC.substr(2);
        // var kgIngRP = data.kgIng.RP.substr(2);
        // var kgIngRC = data.kgIng.RC.substr(2);
        // var kgIngT = data.kgIng.T.substr(2);
        // generarGraficos('chartKgIngCC',kgIngCC,'Kg Prom','Kg Ing. Prom','barChart2Filtrado');
        // generarGraficos('chartKgIngRP',kgIngRP,'Kg Prom','Kg Ing. Prom','barChart2RPFiltrado');
        // generarGraficos('chartKgIngRC',kgIngRC,'Kg Prom','Kg Ing. Prom','barChart2RCFiltrado');
        // generarGraficos('chartKgIngT',kgIngT,'Kg Prom','Kg Ing. Prom','barChart2TFiltrado');


        // //KG EGR

        // var kgEgrCC = data.kgEgr.CC.substr(2);
        // var kgEgrRP = data.kgEgr.RP.substr(2);
        // var kgEgrRC = data.kgEgr.RC.substr(2);
        // var kgEgrT = data.kgEgr.T.substr(2);

        // generarGraficos('chartKgEgrCC',kgEgrCC,'Kg Prom','Kg Egr. Prom','barChart3Filtrado');
        // generarGraficos('chartKgEgrRP',kgEgrRP,'Kg Prom','Kg Egr. Prom','barChart3RPFiltrado');
        // generarGraficos('chartKgEgrRC',kgEgrRC,'Kg Prom','Kg Egr. Prom','barChart3RCFiltrado');
        // generarGraficos('chartKgEgrT',kgEgrT,'Kg Prom','Kg Egr. Prom','barChart3TFiltrado');


        // //KG PROD

        // var kgProdCC = data.kgProd.CC.substr(2);
        // var kgProdRP = data.kgProd.RP.substr(2);
        // var kgProdRC = data.kgProd.RC.substr(2);
        // var kgProdT = data.kgProd.T.substr(2);

        // generarGraficos('chartKgProdCC',kgProdCC,'Kg Prom','Kg Prod. Prom','barChart4Filtrado');
        // generarGraficos('chartKgProdRP',kgProdRP,'Kg Prom','Kg Prod. Prom','barChart4RPFiltrado');
        // generarGraficos('chartKgProdRC',kgProdRC,'Kg Prom','Kg Prod. Prom','barChart4RCFiltrado');
        // generarGraficos('chartKgProdT',kgProdT,'Kg Prom','Kg Prod. Prom','barChart4TFiltrado');
          



  })
</script> 
