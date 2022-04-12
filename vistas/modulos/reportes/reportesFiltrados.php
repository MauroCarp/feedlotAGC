<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}
   function formatearFecha($fecha){
     $nuevaFecha = explode('-',$fecha);
     $nuevaFecha = $nuevaFecha[2]."-".$nuevaFecha[1]."-".$nuevaFecha[0];
     return $nuevaFecha;
  
}

include 'ajax/datosReporte.ajax.php';

?>
<div class="content-wrapper">  
  
  <div class="box">
   
    <section class="content">
          <!-- // FILTROS -->
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-filtros" data-toggle="modal" data-target="#modalFiltros">
            <b>Filtros </b><i class="fa fa-filter" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-alimento" data-toggle="modal" data-target="#modalAlimento">
            <b>Alimento Consumido &nbsp </b><i class="icon-corn" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="imprimirVentas">
            <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>
          <p class="btn" style="cursor:default;font-size:1.1em;">Peridodo General: <?php echo formatearFecha($fechaInicial)." / ".formatearFecha($fechaFinal);?>  </p>
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
 
<?php

  $idCalendar = 'daterange-btn';

  $tabla = 'animales';

  $idGenerar = 'generarReporte';

  $idModal = 'modalPrincipalVentas';

  $idModalComparar = 'modalCompararVentas';

  $seccion = 'Ventas';
  
  include 'vistas/modulos/modales/filtros.modal.php';
  
  include 'vistas/modulos/modales/alimento.modal.php';

?>

<script>

$(function () {

  
        function stringToNumber(array){
          for (let index = 0; index < array.length; index++) {
              array[index] = parseFloat(array[index]);
          }
        }

        var cantidad = <?php echo $cantidad;?>;

        var resultados = [<?php echo $label;?>];
  
        var datosGraficos = <?php echo $datosGraficos;?>;
        var kgConsumidos = datosGraficos[0]['kg'].split(',');
        var adpvGeneral = datosGraficos[0]['adpv'].split(',');
        var conversion = datosGraficos[0]['conv'].split(',');
        stringToNumber(adpvGeneral);
        stringToNumber(kgConsumidos);
        stringToNumber(kgConsumidos);

        generarGraficoAlimento('alimentoConsumidoGeneral',adpvGeneral,kgConsumidos,conversion);
        var contador = 1;


        resultados.forEach(element => {
          var tab = '<li class="tabs" id="tabFiltro' + contador + '"><a href="#filtro' + contador + '" data-toggle="tab"><b>' + element + '</b></a></li>';

          var grafico = '<div class="tab-pane" id="filtro' + contador + '">'
          grafico    +=   '<div class="box-header with-border"><div class="row">';
          grafico    +=     '<div class="col-md-12">';
          grafico    +=       '<div class="box box-success">';
          grafico    +=         '<div class="box-body">';
          grafico    +=           '<div class="chart">';
          grafico    +=             '<canvas id="alimentoConsumidoFiltro' + contador + '"></canvas>';
          grafico    +=           '</div></div></div></div></div></div></div>';

          $('.navTabAlimento').append(tab);
          $('.tabContAlimento').append(grafico);

          var idCanvas = 'alimentoConsumidoFiltro' + contador;
          var adpvData =  datosGraficos[contador]['adpv'].split(',');
          var kgConsumidos =  datosGraficos[contador]['kg'].split(',');
          conversion = datosGraficos[contador]['conv'].split(',');
          stringToNumber(adpvData);
          stringToNumber(kgConsumidos);
          
          generarGraficoAlimento(idCanvas,adpvData,kgConsumidos,conversion);
          contador++;
        });

        var color = Chart.helpers.color;

      // CONFIGURACION

        //POBLACION

          //CC
          let label = [<?php echo $label.",'Resto'";?>];

          let poblacionCC = [<?php echo $poblacionCC;?>];

          let coloresCC = [<?php echo $coloresCC;?>];

          let configPCC = configuracionPie(poblacionCC,coloresCC,label);
          
          //RP

          let poblacionRP = [<?php echo $poblacionRP;?>];

          let coloresRP = [<?php echo $coloresRP;?>];

          let configPRP = configuracionPie(poblacionRP,coloresRP,label);
          
          
          //RC

          let poblacionRC = [<?php echo $poblacionRC;?>];

          let coloresRC = [<?php echo $coloresRC;?>];

          let configPRC = configuracionPie(poblacionRC,coloresRC,label);
          
          
          //T

          let poblacionT = [<?php echo $poblacionT;?>];

          let coloresT = [<?php echo $coloresT;?>];

          let configPT = configuracionPie(poblacionT,coloresT,label);

        // ADPV
          
          //CC
          label = 'Kg Prom';

          let adpvCC = [<?php echo $adpvCC;?>];

          let configAdpvCC = configuracionBar(label,adpvCC);
        
          //RP
          let adpvRP = [<?php echo $adpvRP;?>];

          let configAdpvRP = configuracionBar(label,adpvRP);

          //RC
          let adpvRC = [<?php echo $adpvRC;?>];

          let configAdpvRC = configuracionBar(label,adpvRC);

          //T
          let adpvT = [<?php echo $adpvT;?>];

          let configAdpvT = configuracionBar(label,adpvT);

        // DIAS

          //CC
          
          label = 'Días Prom.';

          let diasCC = [<?php echo $diasCC;?>];

          let configDiasCC = configuracionBar(label,diasCC);

          //RP
          
          let diasRP = [<?php echo $diasRP;?>];

          let configDiasRP = configuracionBar(label,diasRP);

          //RC
          
          let diasRC = [<?php echo $diasRC;?>];

          let configDiasRC = configuracionBar(label,diasRC);

          //RC
          
          let diasT = [<?php echo $diasT;?>];

          let configDiasT = configuracionBar(label,diasT);       

        // KG ING

          //CC

          label = 'Kg Prom.';

          let kgIngCC = [<?php echo $kgIngCC;?>];

          let configKgIngCC = configuracionBar(label,kgIngCC);

        // KG EGR 
          
          //CC
        
          let kgEgrCC = [<?php echo $kgEgrCC;?>];

          let configKgEgrCC = configuracionBar(label,kgEgrCC);

        // KG PROD 

          //CC
        
          let kgProdCC = [<?php echo $kgProdCC;?>];

          let configKgProdCC = configuracionBar(label,kgProdCC);

          //RP
        
          let kgProdRP = [<?php echo $kgProdRP;?>];

          let configKgProdRP = configuracionBar(label,kgProdRP);

          //RC
        
          let kgProdRC = [<?php echo $kgProdRC;?>];

          let configKgProdRC = configuracionBar(label,kgProdRC);

          //T
        
          let kgProdT = [<?php echo $kgProdT;?>];

          let configKgProdT = configuracionBar(label,kgProdT);
         

      //GRAFICOS 
      
        // GRAFICOS ADPV
          generarGraficoBar('barChartFiltrado',configAdpvCC);
          generarGraficoBar('barChartRPFiltrado',configAdpvRP);
          generarGraficoBar('barChartRCFiltrado',configAdpvRC);
          generarGraficoBar('barChartTFiltrado',configAdpvT);
        
        // GRAFICOS DIAS

          generarGraficoBar('barChart1Filtrado',configDiasCC);
          generarGraficoBar('barChart1RPFiltrado',configDiasRP);
          generarGraficoBar('barChart1RCFiltrado',configDiasRC);
          generarGraficoBar('barChart1TFiltrado',configDiasT);
        
        // GRAFICOS KG ING
        
          generarGraficoBar('barChart2Filtrado',configKgIngCC);
        
        // GRAFICOS KG EGR

          generarGraficoBar('barChart3Filtrado',configKgEgrCC);

        // GRAFICOS KG PROD

          generarGraficoBar('barChart4Filtrado',configKgProdCC);
          generarGraficoBar('barChart4RPFiltrado',configKgProdRP);
          generarGraficoBar('barChart4RCFiltrado',configKgProdRC);
          generarGraficoBar('barChart4TFiltrado',configKgProdT);

        // GRAFICOS POBLACION
          
          generarGraficoPie('pieChart1Filtrado',configPCC);
          generarGraficoPie('pieChart1RPFiltrado',configPRP);
          generarGraficoPie('pieChart1RCFiltrado',configPRC);
          generarGraficoPie('pieChart1TFiltrado',configPT);


})
</script> 
