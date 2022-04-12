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

function porcentaje($dato,$total){
  $porcentaje = ($dato * 100) / $total;
  return $porcentaje;
}

include 'ajax/datosReporteCompras.ajax.php';
include 'ajax/datosReporteComprasCostos.ajax.php';


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reportes de Compras
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reportes de Compras</li>
    
    </ol>

  </section>
  
  
  <div class="box">
   
    <section class="content" style="padding-top:10px;">
      <div class="row">
        <div class="col-md-6">
        <?php
        
          if(!$dataAnimalesConsignatario){
            
            echo "<br>
            <div class='row'>
              
              <div class='col-md-12'>

                <div class='info-box' style='padding-bottom:35px;padding-left:10px;padding-top:10px;box-shadow:0px 0px 15px 5px rgba(0, 0, 0, 0.2);'>
                  
                  <span class='info-box-icon bg-info' style='border-radius:10px;background-color:#dc3545;'>
                    
                    <i class='fa fa-times' style='color:white'></i>
                  
                  </span>

                  <div class='info-box-content'>
                    
                    <h3>No se encontraron registros que coincidan con el rango de fechas buscado.</h3>

                  </div>
                
                  </div>
                
                </div>
              
              </div>

            </div>
            </div></div></div>";

              return;
          }
        ?>
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-costos" data-toggle="modal" data-target="#modalCostos">
                  <b>Costos &nbsp </b><i class="fa fa-usd" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="imprimirCompras">
                  <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>
          
          <p class="btn" style="cursor:default;font-size:1.1em;">Peridodo: <?php echo formatearFecha($fechaInicial)." / ".formatearFecha($fechaFinal);?>  </p>
        </div>
      </div>
       <div class="row">

              <div class="col-md-12" id="reportesGeneral">
                      
                <?php include('reportes/compras.php'); ?>

              </div>

        </div>

    </section>
    </div>

</div>

<?php

include 'modales/costos.modal.php';

?>

<script>
  $(function () {


    var dataConsignatario = <?php echo $dataAnimalesConsignatario?>;

    generarGraficoPie('cantCabezas',confCantTotal);

    generarGraficoPie('cantCabezasSexo',confCantCabezasSexo);

    let configPrecioKiloCons = {
      type: 'bar',
      data: {
        labels: [<?php echo $nombresPorConsignatarioResumidos;?>],
        datasets: [
        {
          type: 'line',
          label: '$/Kg Precio Promedio del Kilo',
          borderColor: window.chartColors.red,
          fill:false,
          yAxisID: 'A',
          data: [
            <?php echo $precioPromedioTotalPorConsignatario;?>
          ]
        }
        ,
        {
          label: 'Cabezas',
          type: 'bar',
          backgroundColor: window.chartColors.green,
          yAxisID: 'B',
          data: [
            <?php echo $animalesPorConsignatario;?>
          ],
          borderColor: 'white',
          borderWidth: 2
        }
        ]
        },
        options: {
          scaleShowValues: true,
          scales: {
            xAxes: [{
              display:true,
              ticks: {
                autoSkip: false
              }
            }],
            yAxes: [{
              id: 'A',
              type: 'linear',
              position: 'left',
            
            }, {
              id: 'B',
              type: 'linear', // BARCHART CON LA CANTIDAD DE KILOS PROMEDIO
              position: 'right',
            }]
          },
          plugins:{
            labels:{
              render: 'value'
            }
          },
          legend:{
            labels: {
                  boxWidth: 5
            }
          }
        }
    };

    generarGraficoBar('precioKiloConsignatario',configPrecioKiloCons,'noOption');
    
    generarGraficoPie('cantConsignatario',confCantConsignatario);
    

    let confCantConsSexo = {
				type: 'bar',
				data: confCantConsignatarioSexo,
				options: {
					title: {
						display: false,
						text: 'Cabezas por Consignatario y Sexo'
					},
					tooltips: {
						mode: 'index',
						intersect: false
					},
					responsive: true,
					scales: {
						xAxes: [{
							stacked: true,
              display:true,
						}],
						yAxes: [{
							stacked: true
						}]
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          legend:{
            labels: {
                boxWidth: 5
            }
          },
          scaleShowValues: true,
          scales: {
            xAxes: [{
              ticks: {
                autoSkip: false
              }
            }]
          }
				}
    };

    generarGraficoBar('cantConsignatarioSexo',confCantConsSexo,'noOption');
    
    
    let confCantProv = {
      type: 'bar',
      data: confCantProveedor,
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
          text: 'Cabezas por Proveedor'
        },
        plugins: {
          labels: {
            render: 'value'
          }
          },
          scales: {
            xAxes: [{
              display:false,
						}],
            yAxes: [{
              ticks: {
                suggestedMin: 0,
                suggestedMax: 100
              }
            }]
          }
				}
      };
      
    generarGraficoBar('cantProveedor',confCantProv,'noOption');

  })

</script> 
