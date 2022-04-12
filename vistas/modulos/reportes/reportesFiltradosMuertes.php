<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

 
  
}
   
include 'ajax/datosReporteMuertes.ajax.php';

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
   
    <section class="content" style="padding-top:0;">

          <!-- // FILTROS -->
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-filtrosMuertes" data-toggle="modal" data-target="#modalFiltros">
            <b>Filtros </b><i class="fa fa-filter" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-muertesTratadas" data-toggle="modal" data-target="#modalMuertesTratadas">
            <b>Distribuci&oacute;n Muertes Tratadas &nbsp;</b><i class="fa fa-plus-square" style="color:#d834eb;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="imprimirMuertes">
                  <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>


          <div class="row">

                <div class="col-md-12" id="reportesMuertesFiltradas">

                  <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" style="font-size:1.5em;">
                            <li class="tabs active" id="general"><a href="#tab_F" data-toggle="tab">Comp. General</a></li>
                            
                            <?php

                              for ($i=0; $i < $cantidad ; $i++) { ?> 
                                
                                <li class="tabs" id="etiqueta<?php echo $i;?>"><a href="#tab_<?php echo $i;?>F" data-toggle="tab"><?php echo $datosGraficos[$i + 1];?></a></li>
                            
                            <?php }
                            ?>

                        </ul>
                        <div class="tab-content">

                        <?php include 'muertesFiltradas.php' ?>

                        </div>

                    </div>

                  </div>

          </div>
    </section>
    </div>

</div>

<?php

  $idCalendar = 'daterange-btnMuertes';

  $tabla = 'muertes';

  $idGenerar = 'generarReporteMuertes';

  $idModal = 'modalPrincipalMuertes';

  $idModalComparar = 'modalCompararMuertes';

  $seccion = 'Muertes';
  
  include 'vistas/modulos/modales/filtros.modal.php';
  
  include 'vistas/modulos/modales/muertesTratadas.modal.php';

?>

<script>
  $(function () {
    var colores = ['#48C9B0','#F5B7B1','#C39BD3','#7FB3D5','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB'];

    var tropas = [];
    <?php 
      foreach ($tropas as $key => $value) {
    ?>
    tropas.push(<?php echo "'".$value[0]."'";?>);
    <?php
      }
    ?>

    localStorage.setItem("tropas", tropas);

    var proveedores = [];
    <?php 
      foreach ($proveedores as $key => $value) {
    ?>
    proveedores.push(<?php echo "'".$value[0]."'";?>);
    <?php
      }
    ?>

   localStorage.setItem("proveedores", proveedores);


   var consignatarios = [];
    <?php 
      foreach ($consignatarios as $key => $value) {
    ?>
    consignatarios.push(<?php echo "'".$value[0]."'";?>);
    <?php
      }
    ?>

   localStorage.setItem("consignatarios", consignatarios);

  function opciones(configuracion){
    var opciones = {
      type: 'bar',
        data: configuracion,
        options: {
          responsive: true,
          legend: {
            position: 'top',
            labels: {
                boxWidth: 5
            }
          },
          title: {
            display: false,
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scaleShowValues: true,

          scales: {
              xAxes: [{
                ticks: {
                  autoSkip: false
                }
              }],
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                  }
              }]
          }
        }
      }
    return opciones;
  }

  var cantidad = <?php echo $cantidad;?>;

  var id = 'cantMuertes';
  var cantMuertes = [<?php echo $dataCantMuertes;?>];
  var color = [<?php echo $colorsPieStr;?>];
  var label = [<?php echo $label;?>];
  var valor = 'value';

  graficoPie(cantMuertes,color,label,id,valor);

  var id = 'porcentajeMuertes';
  var valor = 'percentage';
  graficoPie(cantMuertes,color,label,id,valor);

  var datos = <?php echo $datosJson;?>;
  var datosGrafico = <?php echo $datosGraficosJson;?>;

  labelsMeses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

  var dataSetStackMeses = [];
  var dataSetStackMesesCausa = [];

  var labelsCausas = <?php echo $etiquetasCausasJson;?>;

  
  /****
      FILTRO POR FILTRO 
                        *****/

  for (let index = 1; index <= cantidad; index++) {
    // GRAFICO CANTIDAD DE MUERTES

    var dataPie = datos['causas'][index]['muertes'];

    var labelPie = datos['causas'][index]['label'];
  
    valor = 'value';

    var id = 'muertesMotivo' + (index - 1);
    
    graficoPie2(dataPie,colores,labelPie,id,valor,labelsCausas);

    // GRAFICO PORCENTAJE DE MUERTES
    
    valor = 'percentage';

    id = 'porcentajeMotivo' + (index - 1);

    graficoPie2(dataPie,colores,labelPie,id,valor,labelsCausas);

    // MUERTES SEGUN MESES

    valor = 'value';
    id = 'muertesMeses' + (index - 1);

    var dataSet = datos['mesesMuertes'][index];

    dataSet.shift();
    
    var colorChart = '#7FB3D5';
      
    
    graficoChart(dataSet,labelsMeses,id,valor,colorChart);


    dataSetStackMeses.push(dataSet);

    // GRAFICO MUERTES MES SEGUN CAUSA

    id = 'muertesMesCausa' + (index - 1);

    var cantidadCausas = labelsCausas.length;

    dataSet = datos['mesesCausas'][index];
    
    graficoChartStack2(dataSet,labelsMeses,labelsCausas,id,valor,colores,cantidadCausas);

    dataSetStackMesesCausa.push(dataSet);

  }

  id = 'muertesPorMes';

  graficoChartStack(dataSetStackMeses,labelsMeses,datosGrafico,id,valor,colores,cantidad);
  
  id = 'muertesMesGeneral';
  dataSet = datos['muertesMesesGeneral'];
  dataSet.shift();  
  
  var colorChart = '#ff6b6b';

  graficoChart(dataSet,labelsMeses,id,valor,colorChart);


  var muertesTratadas = <?php echo $muertesTratadasJson;?>;
      
  colorChart = ['#ff6b6b','#f06bff'];

  var id = 'muertesTratadasGeneral';
  
  var etiqueta = ['','No Tratados','Tratados'];
  
  cantidad = 2;
  
  graficoChartStack(muertesTratadas,labelsMeses,etiqueta,id,valor,colorChart,cantidad);




  })
</script> 
