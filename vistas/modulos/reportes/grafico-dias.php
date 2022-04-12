<?php

error_reporting(0);

?>

<!--=====================================
GRÁFICO DE Dias
======================================-->


<!-- BAR CHART -->
<div class="box box-success">

  <div class="box-header with-border">

    <h3 class="box-title">Dias</h3>

    <div class="box-tools pull-right">

      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>

      </button>

      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>

    </div>

  </div>

  <div class="box-body">

    <div class="chart">

      <canvas id="barChart" style="height:550px"></canvas>

    </div>

  </div>

</div>


<?php


/******
     LABELS TROPAS 
                * *****/


$item = NULL;
$valor = NULL;
$variable = 'tropa';
  
$tropas = ControladorDatos::ctrMostrarTropas($variable,$item,$valor);
$arrayTropasComillas = array();
$arrayTropas = array();

for ($i=0; $i < sizeof($tropas) ; $i++) { 

    $arrayTropasComillas[] = "'".$tropas[$i][0]."'";

    $arrayTropas[] = $tropas[$i][0];

}

asort($arrayTropasComillas);
$arrayTropasComillas = array_values($arrayTropasComillas);

asort($arrayTropas);
$arrayTropas = array_values($arrayTropas);

$labelsTropa = implode(",",$arrayTropasComillas);


/****
     DIAS PROMEDIO POR TROPA
                          *******/

$item = "tropa";
$arrayDiasPromedio = array();
for ($i=0; $i < sizeof($arrayTropas); $i++) { 

  $valor = $arrayTropas[$i];

  $datosTropa = ControladorDatos::ctrContarDiasTropa($item,$valor);
  
  $totalAnimales = $datosTropa['totalAnimales'];
  $diasTotalPorTropa = $datosTropa['totalDias'];
  $diasPromedioPorTropa = $diasTotalPorTropa / $totalAnimales;
  $arrayDiasPromedio[] = ROUND($diasPromedioPorTropa); 
}

$valoresDias = implode(",",$arrayDiasPromedio);
?>
<script>
  $(function () {
    var color = Chart.helpers.color;

    var configDiasPromedio = {
      labels: [
        <?php echo $labelsTropa;?>
      ],
      datasets: [{
        label: 'Dias Prom.',
        backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
        borderColor: window.chartColors.red,
        borderWidth: 1, 

        data: [
        <?php
        echo $valoresDias;
        ?>
        ]
      }]

    };

    var diasPromedio = document.getElementById('barChart').getContext('2d');
    window.myBar = new Chart(diasPromedio, {
      type: 'bar',
      data: configDiasPromedio,
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
    });
	 
});



</script>