<?php

error_reporting(0);

?>

<!--=====================================
GRÁFICO DE Alimento
======================================-->


<!-- BAR CHART -->
<div class="box box-success">

  <div class="box-body">

    <div class="chart">

    	<canvas id="alimentoConsumido"></canvas>

    </div>

  </div>

</div>


<?php


?>
<script>

window.onload = function() {
	var ctx = document.getElementById('alimentoConsumido').getContext('2d');
	new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ['R. Pastoril', 'R. Corral', 'Terminacion'],
			datasets: [{
			type: 'line',
			label: 'ADPV',
			borderColor: window.chartColors.red,
			fill:false,
			yAxisID: 'A',
			data: [
				1.5,1.2,0.8
			]
			},{
				label: 'Kg Alimento Consumido',
				type: 'bar',
				backgroundColor: window.chartColors.green,
				yAxisID: 'B',
				data: [
					200,180,150
				],
				borderColor: 'white',
				borderWidth: 2
			}
			]
			},
			options: {
				scales: {
				yAxes: [{
					id: 'A',
					type: 'linear',
					position: 'left',
					ticks: {
						suggestedMin: 0,
						suggestedMax: 2
					}
				}, {
					id: 'B',
					type: 'linear', // BARCHART CON LA CANTIDAD DE KILOS PROMEDIO
					position: 'right',
					ticks: {
					max: 250,
					min: 0
					}
				}]
				},
				plugins:{
					labels:{
						render: 'value'
					}
				}
			}
			});
};
</script>