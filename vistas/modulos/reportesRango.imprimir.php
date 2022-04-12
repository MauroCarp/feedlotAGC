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

$fechaRango  = $_GET['rango'];

$fechaRango = explode('/',$fechaRango);

$fechaInicial = $fechaRango[0];

$fechaFinal = $fechaRango[1];
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
        <section class="content" style="padding-top:0;">
        

                    <div class="col-md-12" id="reportesGeneral">
                        
                        <b><?php echo "Rango de Fechas: ".formatearFecha($fechaInicial)." / ".formatearFecha($fechaFinal); ?></b>

                        <?php include('reportes/imprimir/cicloCompleto.imprimir.php'); ?>
                        
                        <div class="saltopagina"></div>

                        <?php include('reportes/imprimir/recriaPastoril.imprimir.php'); ?>

                        <div class="saltopagina"></div>

                        <?php include('reportes/imprimir/recriaCorral.imprimir.php'); ?>

                        <div class="saltopagina"></div>

                        <?php include('reportes/imprimir/terminacion.imprimir.php'); ?>

                    </div>
            </div>

        </section>

    </div>

</div>

<script>
  $(function () {
   
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

    $('.main-footer').hide();

    setTimeout(function () { window.print(); }, 1300);
    window.onfocus = function () { setTimeout('window.close();', .2);}
    })
</script> 
