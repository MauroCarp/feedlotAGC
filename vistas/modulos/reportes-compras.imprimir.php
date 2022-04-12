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
  
  <div class="box">
   
    <section class="content" style="padding-top:10px;">
      
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
        <br>
       <div class="row">

              <div class="col-md-12" id="reportesGeneral">
                      
                <?php include('reportes/compras.imprimir.php'); ?>

              </div>

        </div>

    </section>
    </div>

</div>

<div class="saltopagina"></div>

 
<div id="modalCostos">
  
  <div class="modal-dialog">

    <div class="modal-content" style="width:100%;">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <h4 class="modal-title">Relacion Precio Kg Pagado, Precio Piri - Promedio de Kilos Comprados</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Grafico -->

            
            <div class="box-header with-border" id="graficoCosto">
            
              <div class="row">
                
                <div class="col-md-12">

                <?php include "reportes/grafico-costos.php";?>

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

    $('.main-footer').hide();

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

    generarGraficoBar('precioCantidaConsignatario',configPrecioKiloCons,'noOption');


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


    setTimeout(function () { window.print(); }, 1300);
    window.onfocus = function () { setTimeout('window.close();', .2);}
  
  })

</script> 
