<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

 
  
}
   

?>
<div class="content-wrapper">
  
  <div class="box">
   
    <section class="content" style="padding-top:0;">

          <!-- // FILTROS -->
          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="btn-filtros" data-toggle="modal" data-target="#modalFiltros">
            <b>Filtros </b><i class="fa fa-filter" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

          <button class="btn btn-secondary" style="margin-top:10px;margin-bottom:10px;" id="imprimirVentasGeneral">
                  <b>Imprimir Reporte &nbsp </b><i class="fa fa-print" style="color:#3c8dbc;font-size:1.2em;"></i>
          </button>

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
                        
                        <?php include('reportes/cicloCompleto.php'); ?>
                      
                      </div>

                      <div class="tab-pane recriaPastoril" id="tab_2">
                      <?php include('reportes/recriaPastoril.php'); ?>

                      </div>

                      <div class="tab-pane recriaCorral" id="tab_3">
                      <?php include('reportes/recriaCorral.php'); ?>

                      </div>

                      <div class="tab-pane terminacion" id="tab_4">
                      <?php include('reportes/terminacion.php'); ?>

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
      var poblacionSexo = document.getElementById('pieChart').getContext('2d');
      window.myPie = new Chart(poblacionSexo, configPSS);

      
      var adpv = document.getElementById('barChart').getContext('2d');
      var chartAdpvGeneral = new Chart(adpv, {
        type: 'bar',
        data: configADPV,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Adpv'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: <?php echo $promedioAdpvCC;?>
                  }
              }]
          }
        }
      });

      var dias = document.getElementById('barChart1').getContext('2d');
      var chartDiasGeneral = new Chart(dias, {
        type: 'bar',
        data: configDias,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Dias'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgIng = document.getElementById('barChart2').getContext('2d');
      var chartKgIngGeneral = new Chart(kgIng, {
        type: 'bar',
        data: configKgIng,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Kg Ingreso'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgEgr = document.getElementById('barChart3').getContext('2d');
      var chartkgEgrGeneral = new Chart(kgEgr, {
        type: 'bar',
        data: configKgEgr,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Kg Salida'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      
      var kgProd = document.getElementById('barChart4').getContext('2d');
      var chartkgProdGeneral = new Chart(kgProd, {
        type: 'bar',
        data: configKgProd,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Kg Prod.'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });


    ////// RECRIA PASTORIL ///////

      var porcentajePoblacionRP = document.getElementById('pieChart1RP').getContext('2d');
      window.myPie = new Chart(porcentajePoblacionRP, configPPRP);
    
      
      var adpvRP = document.getElementById('barChartRP').getContext('2d');
      var chartAdpvRPGeneral = new Chart(adpvRP, {
        type: 'bar',
        data: configADPVRP,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Adpv'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: <?php echo $promedioAdpvRP;?>
                  }
              }]
          }
        }
      });

      var diasRP = document.getElementById('barChart1RP').getContext('2d');
      var chartDiasRPGeneral = new Chart(diasRP, {
        type: 'bar',
        data: configDiasRP,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Dias'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });


      var kgProdRP = document.getElementById('barChart4RP').getContext('2d');
      var chartKgProdRPGeneral = new Chart(kgProdRP, {
        type: 'bar',
        data: configKgProdRP,
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


    
    ////// RECRIA CORRAL ///////



      var porcentajePoblacionRC = document.getElementById('pieChart1RC').getContext('2d');
      window.myPie = new Chart(porcentajePoblacionRC, configPPRC);
      

      
      var adpvRC = document.getElementById('barChartRC').getContext('2d');
      var chartAdpvRCGeneral = new Chart(adpvRC, {
        type: 'bar',
        data: configADPVRC,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Adpv'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: <?php echo $promedioAdpvRC;?>
                  }
              }]
          }
        }
      });

      var diasRC = document.getElementById('barChart1RC').getContext('2d');
      var chartDiasRCGeneral = new Chart(diasRC, {
        type: 'bar',
        data: configDiasRC,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Dias'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgProdRC = document.getElementById('barChart4RC').getContext('2d');
      var chartKgProdRCGeneral = new Chart(kgProdRC, {
        type: 'bar',
        data: configKgProdRC,
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

        
    ////// TERMINACION ///////

      var porcentajePoblacionT = document.getElementById('pieChart1T').getContext('2d');
      window.myPie = new Chart(porcentajePoblacionT, configPPT);
      

      
      var adpvT = document.getElementById('barChartT').getContext('2d');
      var chartAdpvTGeneral = new Chart(adpvT, {
        type: 'bar',
        data: configADPVT,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Adpv'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          },
          scales: {
              yAxes: [{
                  ticks: {
                      suggestedMin: 0,
                      suggestedMax: <?php echo $promedioAdpvT;?>
                  }
              }]
          }
        }
      });

      var diasT = document.getElementById('barChart1T').getContext('2d');
      var chartDiasTGeneral = new Chart(diasT, {
        type: 'bar',
        data: configDiasT,
        options: {
          responsive: true,
          legend: {
            position: 'top',
          },
          title: {
            display: false,
            text: 'Prom. Dias'
          },
          plugins: {
            labels: {
              render: 'value'
            }
          }
        }
      });

      var kgProdT = document.getElementById('barChart4T').getContext('2d');
      var chartKgProdTGeneral = new Chart(kgProdT, {
        type: 'bar',
        data: configKgProdT,
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



  })
</script> 
