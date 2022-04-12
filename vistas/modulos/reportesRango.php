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

$rango = $_GET['rango'];

$fechas = explode('/',$rango);

$fechaInicial = $fechas[0];

$fechaFinal = $fechas[1];

?>
<div class="content-wrapper">  
  
  <div class="box">
   
    <section class="content" style="padding-top:0;">

          <!-- // FILTROS -->
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-filtros" data-toggle="modal" data-target="#modalFiltros">
            <b>Filtros </b><i class="fa fa-filter" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="imprimirVentasRango">
                  <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <b><?php echo "Rango de Fechas: ".formatearFecha($fechaInicial)." / ".formatearFecha($fechaFinal); ?></b>

          <div class="row">

                <div class="col-md-12" id="reportesGeneral">

                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" style="font-size:1.em;">
                      <li class="tabs active"><a href="#tab_1" data-toggle="tab">Ciclo Completo</a></li>
                      <li class="tabs" id="recriaPastoril"><a href="#tab_2" data-toggle="tab">Recr&iacute;a Pastoril</a></li>
                      <li class="tabs" id="recriaCorral"><a href="#tab_3" data-toggle="tab">Recr&iacute;a Corral</a></li>
                      <li class="tabs" id="terminacion"><a href="#tab_4" data-toggle="tab">Terminaci&oacute;n</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="tab_1">
                        
                        <?php include('reportes/cicloCompletoRango.php'); ?>
                      
                      </div>

                      <div class="tab-pane recriaPastoril" id="tab_2">
                      <?php include('reportes/recriaPastorilRango.php'); ?>

                      </div>

                      <div class="tab-pane recriaCorral" id="tab_3">
                      <?php include('reportes/recriaCorralRango.php'); ?>

                      </div>

                      <div class="tab-pane terminacion" id="tab_4">
                      <?php include('reportes/terminacionRango.php'); ?>

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
  
  include 'modales/filtros.modal.php';

?>

<script>
  $(function () {
    
   
    var url = window.location;
    if(url.toString().includes('activo')){
      
      var activo = url.toString().split("=");
      activo = activo[1];

      $('.tabs').each(function(){
        
        $(this).removeClass('active');
        
        var id = $(this).attr('id');
        
        if(id == activo){
          
          $(this).addClass('active');
          
        }
        
      });

      $('.tab-pane').each(function(){
        
        $(this).removeClass('active');

        var clase = $(this).attr('class');
        
        if(clase.includes(activo)){
        
          $(this).addClass('active');
        
        }

      });

    }; 

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
  

   
    // CICLO COMPLETO
      
    generarGraficoBar('barChart',configADPV,'atZero');
    
    generarGraficoBar('barChart1',configDias,null);
    
    generarGraficoPie('pieChart',configPSS);
    
    generarGraficoBar('barChart2',configKgIng,null);
    
    generarGraficoBar('barChart3',configKgEgr,null);
    
    generarGraficoBar('barChart4',configKgProd,null);
    
    ////// RECRIA PASTORIL ///////
    
    generarGraficoBar('barChartRP',configADPVRP,'atZero');
    
    generarGraficoBar('barChart1RP',configDiasRP,null);
    
    generarGraficoPie('pieChart1RP',configPPRP);
    
    generarGraficoBar('barChart4RP',configKgProdRP,null);
      
    ////// RECRIA CORRAL ///////
    
    generarGraficoBar('barChartRC',configADPVRC,'atZero');
    
    generarGraficoBar('barChart1RC',configDiasRC,null);
    
    generarGraficoPie('pieChart1RC',configPPRC);
    
    generarGraficoBar('barChart4RC',configKgProdRC,null);
    
    ////// TERMINACION ///////
    
    generarGraficoBar('barChartT',configADPVT,'atZero');
    
    generarGraficoBar('barChart1T',configDiasT,null);
    
    generarGraficoPie('pieChart1T',configPPT);
    
    generarGraficoBar('barChart4T',configKgProdT,null);


  })
</script> 
