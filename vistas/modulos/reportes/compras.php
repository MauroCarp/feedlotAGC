<br>

<div class="row">

    <div class="col-md-4">

      <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cantidad de Animales comprados:</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantCabezas" style="height:230px"></canvas>

            </div>

          </div>

      </div>
    
    </div>

    <div class="col-md-4">

      <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cabezas Según Sexo</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantCabezasSexo" style="height:230px"></canvas>

            </div>

          </div>

      </div>
    
    </div>

    <div class="col-md-4">  
    
      <div class="box box-danger">
      
          <div class="box-header with-border">
          
            <h3 class="box-title">$/Kg Costo Promedio del Kilo según Consignatario</h3>

          </div>
          
          <div class="box-body">

            <canvas id="precioKiloConsignatario" style="height:230px"></canvas>
            
          </div>
      
      </div>

    </div> 

</div>

<div class="row">

      <div class="col-md-4">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cabezas por Consignatario</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantConsignatario" style="height:230px"></canvas>

            </div>

          </div>


        </div>
        

      </div>

      <div class="col-md-4">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cabezas por Consignatario y Sexo</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantConsignatarioSexo" style="height:230px"></canvas>

            </div>

          </div>

        </div>
        

      </div>

      <div class="col-md-4">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Cabezas por Proveedor TOP 5 Según Cantidad</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="cantProveedor" style="height:230px"></canvas>

            </div>

          </div>

        </div>
        

      </div>

</div>



<script>
function configuracionPie(data,color,label,label2){
          
  let configuracion = {
    type: 'pie',
    data: {
      datasets: [{
        data: data,
        backgroundColor:

          color
        ,
        label: label2
      }],
      labels: label
    },
    options: {
				responsive: true,
				title: {
					display: false,
        },
        plugins:{
          labels:{
            render: 'value'
          }
        },
        legend: {
          labels: {
              boxWidth: 5
          }
        }
			}
  };
    
  return configuracion;

}

let data = [<?php echo $cantidadTotal[0][0];?>];

let confCantTotal = configuracionPie(data,[window.chartColors.red],['Total'],'Cantidad de Animales');

data = [<?php echo $cantMachosHembras?>];

let colors = [window.chartColors.blue,window.chartColors.red];

let label = ['Macho','Hembra'];

let confCantCabezasSexo = configuracionPie(data,colors,label,'Cantidad de Animales por Sexo');

data =  [<?php echo $animalesPorConsignatario;?>];

colors = [<?php echo $coloresConsignatario;?>];

label = [<?php echo $nombresPorConsignatario;?>];

let confCantConsignatario = configuracionPie(data,colors,label,'Cantidad de Animales por Consignatario');

confCantConsignatario.options.plugins.labels.render = null;

var color = Chart.helpers.color;

var confCantConsignatarioSexo = {
  labels: [<?php echo $nombresPorConsignatarioResumidos;?>,
  ],
  datasets: [{
    label: '% Macho',
    backgroundColor: window.chartColors.blue,
    stack: 'Stack 0',
    data: [
      <?php echo $machosPorConsignatarioPorcentaje;?>
    ]
  }, {
    label: '% Hembra',
    backgroundColor: window.chartColors.red,
    stack: 'Stack 0',
    data: [
      <?php echo $hembrasPorConsignatarioPorcentaje;?>,
    ]
  }, {  
    label: 'Cantidad Cabezas',
    backgroundColor: window.chartColors.green,
    stack: 'Stack 1',
    data: [
      <?php echo $animalesPorConsignatario;?>
    ]
  }]

};

var confCantProveedor = {
  datasets: [

      <?php echo $cantidadAnimalesProveedores;?>

  ]
};




</script>
