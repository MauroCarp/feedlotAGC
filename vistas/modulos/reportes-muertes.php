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
  
  <div class="box">
   
    <section class="content" style="padding-top:0;">
      <?php

      if(!$datosJson){
            echo "<h2>No hay registros</h2>
            </div></div></div></div>";

            return;
        }
      
      ?>

          <!-- // FILTROS -->
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-filtrosMuertes" data-toggle="modal" data-target="#modalFiltros">
            <b>Filtros </b><i class="fa fa-filter" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-muertesMes" data-toggle="modal" data-target="#modalMuertesMeses">
            <b>Distribuci&oacute;n Mensual de Muertes </b><i class="icon-muerteIco" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-muertesTratadas" data-toggle="modal" data-target="#modalMuertesTratadas">
            <b>Distribuci&oacute;n Muertes Tratadas &nbsp;</b><i class="fa fa-plus-square" style="color:#d834eb;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="imprimirMuertesGeneral">
                  <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          

          <div class="row">

                <div class="col-md-12" id="reportesMuertes">

                <?php include 'reportes/muertes.php'; ?>

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
  
  include 'modales/filtros.modal.php';
  
  include 'modales/distribucionMuertes.modal.php';
  
  include 'modales/muertesTratadas.modal.php';
?>

<script>
  $(function () {
    

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
      
      colorChart = ['#ff6b6b','#f06bff'];

      var id = 'muertesTratadasGeneral';
      
      var etiqueta = ['','No Tratados','Tratados'];
      
      cantidad = 2;

      graficoChartStack(muertesTratadas,labelsMeses,etiqueta,id,valor,colorChart,cantidad);



  })
</script> 
