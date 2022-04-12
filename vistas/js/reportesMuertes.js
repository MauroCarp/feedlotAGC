// function validarCamposFiltro(consignatario,proveedor,tropa){
//   var consignatarioValido = false;
//   var tropaValido = false;
//   var proveedorValido = false;

//   if(!consignatarioValido){
    
//     consignatarioValido = (consignatario != 'Consignatario') ? true : false;
    
//   } 
  
//   if(!proveedorValido){
    
//     proveedorValido = (proveedor != 'Proveedor') ? true : false; 
    
//   } 
  
//   if(!tropaValido){
    
//     tropaValido = (tropa != 'Tropa ' ) ? false : true; 
  
//   } 


//   formularioValido = (consignatarioValido || proveedorValido || tropaValido) ? true : false;
     

//   if(!formularioValido){

//     swal({
//       type: "error",
//       title: "En algún filtro, no se seleccionó ninguno",
//       showConfirmButton: true,
//       confirmButtonText: "Cerrar"
//       }).then(result=>{

//         console.log(result);
        
//       });
      
//     }

//     return;

// }


/*=============================================
GENERAR REPORTE
=============================================*/

$('#generarReporteMuertes').click(()=>{
  // SI NO SE SELECCIONA NINGUNA FECHA O ALGUN FILTRO QUEDA VACIO, NO GENERA REPORTE


  var contador = 1;

  var datosConsignatarios = "";

  var datosProveedores = "";

  var datosTropas = "";

  
  var arrayValidacion = [];
  
  $('.consignatarios').each(function(){
    
    var formularioValido = false;
    
    var id = $(this).attr('id');
    
    var numeroId = id.substr(-1);
    
    
    
    var tropa = $('#tropa' + numeroId).val();
    
    datosTropas += 'tropa' + contador + '=' + tropa + '&';

    var proveedor = $('#proveedor' + numeroId).val();
    
    datosProveedores += 'proveedor' + contador + '=' + proveedor + '&';

    
    var consignatario = $(this).val();

    datosConsignatarios += 'consignatario' + contador + '=' + consignatario + '&';




    // VALIDACION 

    var consignatarioValido = false;
    var tropaValido = false;
    var proveedorValido = false;
  
    if(!consignatarioValido){
      
      consignatarioValido = (consignatario != 'Consignatario') ? true : false;
      
    } 

      console.log(consignatario);
      
      if(!proveedorValido){
        
        proveedorValido = (proveedor != 'Proveedor') ? true : false; 
        
      } 
      
      
      console.log(proveedor);    
      
      
      if(!tropaValido){
        
        tropaValido = (tropa != 'Tropa' ) ? true : false; 
        
      } 
            
    
    formularioValido = (consignatarioValido || proveedorValido || tropaValido) ? true : false;

    arrayValidacion.push(formularioValido);

    contador++;

  });

  datosTropas = datosTropas.slice(0, -1);
  
  datosProveedores = datosProveedores.slice(0,-1);
  
  datosConsignatarios = datosConsignatarios.slice(0,-1);
  
  
  var rango = (localStorage.getItem('rangoMuertes') == null) ? '1970-01-01/2090-01-01' : localStorage.getItem('rangoMuertes');

  // PARA QUE REDIRECCIONE TODOS TIENEN Q SER TRUE
  var camposValidos = true;

    for (let index = 0; index < arrayValidacion.length; index++) {

        if (arrayValidacion[index] == false) {

            camposValidos = false;

            break;

        }

    }

    
  if (!camposValidos) {

    window.location = 'index.php?ruta=reportes/reportes-muertesRango&rango=' + rango;

  }else{
    
    window.location = 'index.php?ruta=reportes/reportesFiltradosMuertes&' + datosConsignatarios + '&' + datosProveedores + '&' + datosTropas + '&rango=' + rango + '&cantidad=' + (contador - 1);

  }


  



});

/*=============================================
  CREAR GRAFICO
=============================================*/

function graficoChart(dataSet,labels,canvas,valor,color){

var configuracion = {
  labels: labels,
  datasets: [
    {
        label: 'Muertes por Meses',
        backgroundColor: color,
        borderColor: color,
        borderWidth: 1,
        data: dataSet
        
    }
]
};



var canva = document.getElementById(canvas).getContext('2d');
var chart = new Chart(canva, {
  type: 'bar',
  data: configuracion,
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
    },
    plugins: {
      labels: {
        render: valor
      }
    },
    scaleShowValues: true,

    scales: {
        xAxes: [{
          ticks: {
            autoSkip: false
          }
        }],
        yAxes: [{
            ticks: {
                suggestedMin: 0,
            }
        }]
    }
  }
});

return chart;
}

function graficoChartStack(dataSet,labels,etiquetas,canvas,valor,color,cantidad){
var dataSetsStack = [];
var maximo = [];
// console.log(cantidad);

for (let index = 0; index < cantidad; index++) {
  var etiqueta = "'" + etiquetas[index + 1 ] + "'";
  var backgroundColor = color[index];
  var muertes = dataSet[index];

  for (let a = 0; a < muertes.length; a++) {

    if(muertes[a] == 0)
    muertes[a] = '';
      
  }

  
  dataSetsStack.push(
    {
        label: 
        // Etiqueta (filtro)
        etiqueta,
        backgroundColor: backgroundColor,
        stack: 'Stack 0',
        data: 
          muertes  
      }
  );
  

  maximo.push(Math.max.apply(null,muertes));
}

maximo = Math.max.apply(null,maximo);

var configuracion = {
  labels: 
    //MESES 
    labels
  ,
  datasets: dataSetsStack


};

var canva = document.getElementById(canvas).getContext('2d');
var chart = new Chart(canva, {
      type: 'bar',
      data: configuracion,
      options: {
        barValueSpacing: 50,
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
            render: valor
          }
        },
        legend:{
          labels: {
              boxWidth: 5
          },
          position:'top'
        },
        scaleShowValues: true,
        scales: {
          xAxes: [{
            ticks: {
              autoSkip: false
            }
          }],
          yAxes: [{
            ticks: {
                suggestedMax:5,
            }
          }]
        }
      }
  });

return chart;

}

function graficoChartStack2(dataSet,labels,etiquetas,canvas,valor,color,cantidad){
var dataSetsStack = [];
var maximo = [];
  
for (let index = 0; index < cantidad; index++) {
  var etiqueta = "'" + etiquetas[index] + "'";
  var backgroundColor = color[index];
  
  var muertesPorMesSegunCausa = dataSet[index];

  muertesPorMesSegunCausa.shift();

  let causaValida = (muertesPorMesSegunCausa.reduce((a, b) => a + b, 0) > 0) ? true : false;

  
  if (causaValida) {

    //SE CAMBIAN LOS CEROS POR ESPACIO VACIO
    for (let a = 0; a < muertesPorMesSegunCausa.length; a++) {
      
      if(muertesPorMesSegunCausa[a] == 0)
      muertesPorMesSegunCausa[a] = '';
      
    }
    
    dataSetsStack.push(
      {
          label: 
          // Etiqueta (filtro)
          etiqueta,
          backgroundColor: backgroundColor,
          stack: 'Stack 0',
          data: 
          muertesPorMesSegunCausa  
        }
    );

    maximo.push(Math.max.apply(null,muertesPorMesSegunCausa));
  
  }

}
      
maximo = Math.max.apply(null,maximo);

// console.log(dataSetsStack);

var configuracion = {
  labels: 
  //MESES 
  labels
  ,
  datasets: dataSetsStack
  

};

// console.log(configuracion);


var canva = document.getElementById(canvas).getContext('2d');
var chart = new Chart(canva, {
      type: 'bar',
      data: configuracion,
      options: {
        barValueSpacing: 50,
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
            render: valor
          }
        },
        legend:{
          labels: {
              boxWidth: 5
          },
          position:'top'
        },
        scaleShowValues: true,
        scales: {
          xAxes: [{
            ticks: {
              autoSkip: false
            }
          }],
          yAxes: [{
            ticks: {
                suggestedMax: maximo + 1,
            }
          }]
        }
      }
  });

return chart;

}

function graficoPie(dataPie,color,labelPie,canvas,valor){
id = "'" + canvas + "'";

var configuracion = {
      type: 'pie',
      data: {
        datasets: [{
          data: dataPie,
          backgroundColor: color,
        }],
      labels: 
          labelPie,
      },
      options: {
        responsive: true,
        title: {
          display: false,
        },
        plugins:{
          labels:{
            render: valor
          }
        },
        legend: {
          labels: {
              boxWidth: 5
          },
          position:'left'

        }
      }
};

var canva = document.getElementById(canvas).getContext('2d');
var chart = new Chart(canva, configuracion);

return chart;
}

function graficoPie2(dataPie,color,labelPie,canvas,valor,listadoCausas){

    function vacioAsinDato(array){
      for (let index = 0; index < array.length; index++) {

          if(!array[index]){
            array[index] = '';
          }
        
      }
      return array
    }

    id = "'" + canvas + "'";

    var nuevoListadoLabels = [];
    var nuevoListadoMuertes = [];
    var coloresPie = [];

    for (let index = 0; index < listadoCausas.length; index++) {

      
      for (let index2 = 0; index2 < labelPie.length; index2++) {
        
        if(listadoCausas[index] == labelPie[index2]){
          
          nuevoListadoLabels[index] = labelPie[index2];
          nuevoListadoMuertes[index] = (dataPie[index2]);
          coloresPie[index] = color[index];

        }
        
      }
      
    }

    nuevoListadoLabels = vacioAsinDato(nuevoListadoLabels);
    nuevoListadoMuertes = vacioAsinDato(nuevoListadoMuertes);
    coloresPie = vacioAsinDato(coloresPie);

    nuevoListadoLabels = nuevoListadoLabels.filter(function(dato){
      return dato != ''
    });
    nuevoListadoMuertes = nuevoListadoMuertes.filter(function(dato){
      return dato != ''
    });
    coloresPie = coloresPie.filter(function(dato){
      return dato != ''
    });


    var configuracion = {
          type: 'pie',
          data: {
            datasets: [{
              data: nuevoListadoMuertes,
              backgroundColor: coloresPie,
            }],
          labels: 
          nuevoListadoLabels,
          },
          options: {
            responsive: true,
            title: {
              display: false,
            },
            plugins:{
              labels:{
                render: valor
              }
            },
            legend: {
              labels: {
                  boxWidth: 5
              },
              position:'left'

            }
          }
    };

    var canva = document.getElementById(canvas).getContext('2d');
    var chart = new Chart(canva, configuracion);

    return chart;
}





$('#daterange-btnMuertes').daterangepicker(
{
  ranges   : {

  },
  startDate: moment(),
  endDate  : moment()
},
function (start, end) {
  $('#daterange-btnMuertes span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

  var fechaInicial = start.format('YYYY-MM-DD');

  var fechaFinal = end.format('YYYY-MM-DD');

  localStorage.setItem('rangoMuertes', fechaInicial + '/' + fechaFinal);
  var capturarRango = $("#daterange-btnMuertes span").html();


  cargarSelectSegunFecha('1',capturarRango,'muertes','consignatario','fechaMuerte');
    
  cargarSelectSegunFecha('1',capturarRango,'muertes','proveedor','fechaMuerte');
  
  cargarSelectSegunFecha('1',capturarRango,'muertes','tropa','fechaMuerte');


}

);

$('#btn-filtrosMuertes').click(()=>{

  localStorage.removeItem("rangoMuertes");
  
  $('#daterange-btnMuertes').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');

});



/*=============================================
IMPRIMIR REPORTE
=============================================*/

$('#imprimirMuertes').click(()=>{

  var URLactual = window.location;

  URLactual = URLactual['href'].substring(27);

  URLsplit = URLactual.split('&');

  URLsplit[0] = URLsplit[0] + '.imprimir';

  var getUrl = URLsplit.join('&');  

  console.log(getUrl);

  window.open(getUrl,'_blank');

});


$('#imprimirMuertesGeneral').click(()=>{

  window.open('index.php?ruta=reportes-muertes.imprimir','_blank');

});


function getQueryVariable(variable) {

  var query = window.location.search.substring(1);

  var vars = query.split("&");

  for (var i=0; i < vars.length; i++) {

      var pair = vars[i].split("=");

      if(pair[0] == variable) {

          return pair[1];

      }

  }

  return false;

}


$('#imprimirMuertesGeneralRango').click(()=>{

  var rango = getQueryVariable('rango');

  window.open('index.php?ruta=reportes-muertesRango.imprimir&rango=' + rango,'_blank');

});