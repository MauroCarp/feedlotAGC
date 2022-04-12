<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

 
  
}
   
function formatearFecha($fecha){

  $fecha = explode('-',$fecha);

  $fecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];

  return $fecha;
}

include 'ajax/datosReporteMuertesRango.ajax.php';

?>
<div class="content-wrapper">

<table>
      
  <tr>

    <td>

      <img src="vistas/img/plantilla/logo-barlovento-impresion.png" alt="barlovento SRL" style="height:35px!important;">

    </td>

  </tr>

</table>
  
  <div class="box">
   
    <section class="content">

    <h2>Reporte de Muertes</h2>

          <div class="row">

                <div class="col-md-12" id="reportesMuertes">

                <b><?php echo "Rango de Fechas: ".formatearFecha($fechaInicial)." / ".formatearFecha($fechaFinal); ?></b>

                <?php include 'reportes/muertesRango.imprimir.php'; ?>

                </div>

          </div>

    </section>

  </div>

</div>

<!--=====================================
MODAL GRAFICO DISTRIBUCION MUERTES
======================================-->

<div id="modalMuertesMeses">
  
  <div class="modal-dialog" style="width:100%;">

    <div class="modal-content">

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
            
            <div class="box-header with-border" id="graficoMuertesMeses">
                   
              <div class="box box-success">

                <div class="box-header with-border">

                  <h2 class="box-title">Distribución Mensual de Muertes</h2>

                </div>

                <div class="box-body">

                  <div class="chart">

                    <canvas id="muertesMesGeneral" style="height:200px"></canvas>

                  </div>

                </div>

                </div>

              </div>

          </div>

        </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL GRAFICO  MUERTES TRATADAS
======================================-->

<div id="modalMuertesTratadas">
  
  <div class="modal-dialog" style="width:100%;">

    <div class="modal-content">

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Filtros -->

            
            <div class="box-header with-border" id="graficoMuertesMeses">
                   
              <div class="box box-success">

                <div class="box-header with-border">

                  <h2 class="box-title">Distribución de Muertes Tratadas</h2>

                </div>

                <div class="box-body">

                  <div class="chart">

                    <canvas id="muertesTratadasGeneral" style="height:200"></canvas>

                  </div>

                </div>

                </div>

              </div>

          </div>

        </div>

    </div>

  </div>

</div>


<script>
  $(function () {
    generarGraficoPie('muertesMotivo',configMuertesCausa);
   
    generarGraficoPie('porcentajeMotivo',configPorcentajeMuertesCausa);
    
    generarGraficoPie('muertesSexo',configMuertesSexo);

    generarGraficoBar('muertesConsignatario',confMuertesConsignatario,'atZero');

    generarGraficoBar('muertesProveedor',confMuertesProveedor,'skipFalse');
          
      var datos = <?php echo $datosJson;?>;
      
      var dataSet = datos['muertesMesesGeneral'];
      dataSet.shift();        
      
      var labelsMeses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

      var id = 'muertesMesGeneral';
      
      var valor = 'value';
      
      var colorChart = '#ff6b6b';
     
      graficoChart(dataSet,labelsMeses,id,valor,colorChart);

 
      var muertesTratadas = <?php echo $muertesTratadasJson;?>;
      
      muertesTratadas[0].shift();

      muertesTratadas[1].shift();
      
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
