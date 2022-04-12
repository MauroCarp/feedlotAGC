<br>

<div class="row">

    <div class="col-md-4">

      <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Muertes según Causa:</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="muertesMotivo" style="height:200px"></canvas>

            </div>

          </div>

      </div>
    
    </div>

    <div class="col-md-4">

      <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">% según Causa</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="porcentajeMotivo" style="height:200px"></canvas>

            </div>

          </div>

      </div>
    
    </div>

    <div class="col-md-4">  
    
      <div class="box box-success">
      
          <div class="box-header with-border">
          
            <h3 class="box-title">Muertes por Sexo</h3>

          </div>
          
          <div class="box-body">
            
            <div class="chart">
            
                <canvas id="muertesSexo" style="height:200px"></canvas>
            
            </div>
            
          </div>
      
      </div>

    </div> 

</div>
<div class="saltopagina"></div>
<div class="row">

      <div class="col-md-6">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Muertes por Consignatario</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="muertesConsignatario" style="height:250px"></canvas>

            </div>

          </div>


        </div>
        

      </div>

      <div class="col-md-6">

        <div class="box box-success">

          <div class="box-header with-border">

            <h3 class="box-title">Muertes por Proveedor</h3>

          </div>

          <div class="box-body">

            <div class="chart">

              <canvas id="muertesProveedor" style="height:250px"></canvas>

            </div>

          </div>

        </div>
        

      </div>

</div>



<script>
function configuracionPieMuertes(data,color,label,position,value){

let configuracion = {
type: 'pie',
    data: {
      datasets: [{
        data: data,
        backgroundColor: color,
      }],
    labels: 
    label
      
  },
    options: {
      responsive: true,
      title: {
        display: false,
  },
  plugins:{
    labels:{
    render: value
    }
  },
  legend: {
    labels: {
      boxWidth: 5
    },
    position:position

  }
    }

}

return configuracion;

}

function configuracionBar(label,data){
        
let configuracion = {
  labels: [
    label
  ],
  datasets:
    data 
  
};

return configuracion;

}
    

function configuracionBarMuertes(labels,data,labels2){

let configuracion = {
  labels: labels,
  datasets: [
    {
      label: labels2,
      backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
      borderColor: window.chartColors.blue,
      borderWidth: 1,
      data: data
      
    }
    
  ]
};

return configuracion;

}
var color = Chart.helpers.color;

let data = [<?php echo $muertesCausas?>];

let colors = [<?php echo $colorsPieStr; ?>];

let labels = [<?php echo $labelsCausas;?>];

let configMuertesCausa = configuracionPieMuertes(data,colors,labels,'left','value');

data = [<?php echo $muertesCausas?>];

colors = [<?php echo $colorsPieStr; ?>];

labels = [<?php echo $labelsCausas;?>];

let configPorcentajeMuertesCausa = configuracionPieMuertes(data,colors,labels,'left',null);

data = [<?php echo $chartDataConsignatarios;?>];

labels = ['Consignatarios'];

let confMuertesConsignatario = configuracionBar(labels,data);
          
data = [<?php echo $dataProveedor;?>];

labels = [<?php echo $proveedoresResum;?>];

let labels2 = 'Muertes por Proveedor';

let confMuertesProveedor = configuracionBarMuertes(labels,data,labels2);

data = [<?php echo $muertesSexo?>];

colors = [<?php echo "'#7FB3D5','#F5B7B1'";?>];

labels = ['Machos','Hembras'];

let configMuertesSexo = configuracionPieMuertes(data,colors,labels,'left',null);


</script>
