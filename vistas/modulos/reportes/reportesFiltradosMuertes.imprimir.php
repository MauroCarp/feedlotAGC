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

include 'ajax/datosReporteMuertes.ajax.php';

?>
<div class="content-wrapper">

<table>
      
      <tr>
    
        <td>
    
          <img src="vistas/img/plantilla/logo-barlovento-impresion.png" alt="barlovento SRL" style="height:35px!important;">

        </td>
    
        <td>

          <p class="btn" style="cursor:default;font-size:1.1em;">Peridodo: <?php echo formatearFecha($fechaInicial)." / ".formatearFecha($fechaFinal);?>  </p>

        </td>
    
      </tr>
    
    </table>

  <div class="box">
   
    <section class="content" style="padding-top:0;">

          <div class="row">

                <div class="col-md-12" id="reportesMuertesFiltradas">

                    <?php include 'muertesFiltradas.imprimir.php' ?>

                </div>

          </div>

    </section>

  </div>

</div>


<!--=====================================
MODAL GRAFICO  MUERTES TRATADAS
======================================-->

<div id="modalMuertesTratadas" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width:70%;">

    <div class="modal-content">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Distribuci&oacute;n de Muertes Tratadas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Filtros -->

            
            <div class="box-header with-border" id="graficoMuertesMeses">
                   
              <div class="box box-success">

                <div class="box-header with-border">

                  <h3 class="box-title">Distribución de Muertes Tratadas General</h3>

                </div>

                <div class="box-body">

                  <div class="chart">

                    <canvas id="muertesTratadasGeneral" style="height:100%"></canvas>

                  </div>

                </div>

                </div>

              </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

    </div>

  </div>

</div>


<script>
  $(function () {
    var colores = ['#48C9B0','#F5B7B1','#C39BD3','#7FB3D5','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB'];


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

  $('.main-footer').hide();

  setTimeout(function () { window.print(); }, 1300);
  window.onfocus = function () { setTimeout('window.close();', .2);}

  })
</script> 
