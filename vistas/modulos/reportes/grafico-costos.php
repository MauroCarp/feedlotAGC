<?php

$imprimirValido = ($_GET['ruta'] == 'reportes-compras.imprimir') ? TRUE : FALSE;

?>



<!--=====================================
GRÁFICO DE COSTOS 
======================================-->


<!-- BAR CHART -->
<div class="box box-succes">

  <div class="box-body">

    <div class="chart">

    	<canvas id="canvas"></canvas>

    </div>

  </div>

</div>


<?php


?>
<script>
// AGREGAR COLORES 

var canvas = document.getElementById('canvas');

new Chart(canvas, {
  type: 'bar',
  data: {
      labels: [<?php echo $fechasCompras;?>],
      datasets: [{
      type: 'line',
      label: '$/Kg',
      borderColor: window.chartColors.red,
      fill:false,
      yAxisID: 'A',
      data: [<?php echo $precioKgPromedio;?>]
      }, {
        label: '$ Piri',
        type: 'line',
        borderColor: window.chartColors.blue,
        yAxisID: 'A',
        fill:false,
        data: [<?php echo $preciosPiri;?>]
      },{
          label: 'Kg Ingreso Prom.',
          type: 'bar',
          backgroundColor: window.chartColors.green,
          yAxisID: 'B',
          data: [
            <?php echo $kilosPromedio;?>
          ],
          borderColor: 'white',
          borderWidth: 2
      }]
      
  },
  options: {
    scales: {
      yAxes: [{
        id: 'A',
        type: 'linear',
        position: 'right',
      }, {
        id: 'B',
        type: 'linear', // BARCHART CON LA CANTIDAD DE KILOS PROMEDIO
        position: 'left'
      }],
    },
    plugins:{
      
          
          labels:{
            render: function(value,index,dataset,label){

              var retorno = '';

              if(value.dataset.label == '$/Kg'){

                retorno = value.value;

              }

              return retorno;
            
            },
          }
    }
  }

});







</script>