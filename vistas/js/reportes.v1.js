/*=============================================
AGREGAR FILTROS
=============================================*/
var contador = 2;
$('#comparar').click(function(){

  var contenido = '<hr>';
  contenido += '<div class="row">';
  contenido +=      '<div class="col-md-4">';
  contenido +=      '<label>Rango de Fechas</label><br>';
  contenido +=        '<button type="button" class="btn btn-default" id="daterange-btn' + contador + '">';
  contenido +=          '<span><i class="fa fa-calendar"></i> Rango de fecha';
  contenido +=          '</span><i class="fa fa-caret-down"></i>';
  contenido +=        '</button>';
  contenido +=      '</div>';
  contenido +=      '<div class="col-md-4">';
  contenido +=        '<div class="form-group"><label>Consignatario</label>';
  contenido +=          '<select class="form-control consignatarios" id="consignatario' + contador + '" onchange=(cargarTropaConsignatario(this.id))>';
  contenido +=            '<option value="">Consignatario</option>';


  var consignatarios = localStorage.getItem("consignatarios").split(',');

  consignatarios.forEach(valor => {
    contenido += '<option value="' + valor + '">' + valor + '</option>';
  });
  
  contenido +=          '</select>';
  contenido +=        '</div></div>';  
  contenido +=      '<div class="col-md-4">';
  contenido +=        '<div class="form-group"><label>Tropa</label>';
  contenido +=          '<select class="form-control tropas" id="tropa' + contador + '" onchange="bloquearConsignatario(this.id)">';
  contenido +=            '<option value="Tropa">Tropa</option>';

  var tropas = localStorage.getItem("tropas").split(',');

  tropas.forEach(valor => {
    contenido += '<option value="' + valor + '">' + valor + '</option>';
  });
   
  contenido +=          '</select>';
  contenido +=        '</div></div>';  
  contenido +=      '</div>';


  $('#filtros').append(contenido);
  contador++;

});


/*=============================================
GENERAR REPORTE
=============================================*/

$('#generarReporte').click(()=>{


    var contador = 1;
    var datosConsignatarios = "";
    var datosTropas = "";

    $('.consignatarios').each(function(){
      
      var id = $(this).attr('id');
      var numeroId = id.substr(-1);
      var tropa = $('#tropa' + numeroId).val();


      datosTropas += 'tropa' + contador + '=' + tropa + '&';

      var consignatario = $(this).val();
  
      datosConsignatarios += 'consignatario' + contador + '=' + consignatario + '&';

      contador++;
    });

    datosTropas = datosTropas.slice(0, -1);
    datosConsignatarios = datosConsignatarios.slice(0,-1);

    window.location = 'reportes.php?consignatario=' + datosConsignatarios + '&tropa=' + datosTropas;

  //   // AJAX
  //   var datos = datosConsignatarios + '&' + datosTropas;

  //   $.ajax({
      
  //     url: "ajax/datosReporte.ajax.php",
      
  //     method: "POST",
      
  //     data: datos,
      
  //     success: function(respuesta){

  //       console.log(respuesta);
        
  //       var data = JSON.parse(respuesta);

  //       //DIAS
          
  //         // var diasCC = data.dias.CC.valor.substr(-1);
  //         // var diasRP = data.dias.RP.valor.substr(-1);
  //         // var diasRC = data.dias.RC.valor.substr(-1);
  //         // var diasT = data.dias.T.valor.substr(-1);
        
  //       //ADPV
  //         var adpvCC = data.adpv.CC.valor.substr(2);
  //         var adpvRP = data.adpv.RP.valor.substr(2);
  //         var adpvRC = data.adpv.RC.valor.substr(2);
  //         var adpvT = data.adpv.T.valor.substr(2);


  //         actualizaGraficos(adpvCC,'Adpv','Kg Prom','barChartFiltrado');
  //         actualizaGraficos(adpvRP,'Adpv','Kg Prom','barChartRPFiltrado');
  //         actualizaGraficos(adpvRC,'Adpv','Kg Prom','barChartRCFiltrado');
  //         actualizaGraficos(adpvT,'Adpv','Kg Prom','barChartTFiltrado');
          
        
  //       //KG ING

  //         var kgIngCC = data.kgIng.CC.valor.substr(2);
  //         var kgIngRP = data.kgIng.RP.valor.substr(2);
  //         var kgIngRC = data.kgIng.RC.valor.substr(2);
  //         var kgIngT = data.kgIng.T.valor.substr(2);
          
  //         generarGraficos(kgIngCC,'Kg Ing. Prom','Kg Prom','barChart2Filtrado');
  //         generarGraficos(kgIngRP,'Kg Ing. Prom','Kg Prom','barChart2RPFiltrado');
  //         generarGraficos(kgIngRC,'Kg Ing. Prom','Kg Prom','barChart2RCFiltrado');
  //         generarGraficos(kgIngT,'Kg Ing. Prom','Kg Prom','barChart2TFiltrado');
        

  //       // //KG EGR

  //         var kgEgrCC = data.kgEgr.CC.valor.substr(2);
  //         var kgEgrRP = data.kgEgr.RP.valor.substr(2);
  //         var kgEgrRC = data.kgEgr.RC.valor.substr(2);
  //         var kgEgrT = data.kgEgr.T.valor.substr(2);
          
  //         generarGraficos(kgEgrCC,'Kg Egr. Prom','Kg Prom','barChart3Filtrado');
  //         generarGraficos(kgEgrRP,'Kg Egr. Prom','Kg Prom','barChart3RPFiltrado');
  //         generarGraficos(kgEgrRC,'Kg Egr. Prom','Kg Prom','barChart3RCFiltrado');
  //         generarGraficos(kgEgrT,'Kg Egr. Prom','Kg Prom','barChart3TFiltrado');
          
        
  //       // //KG PROD
        
  //         var kgProdCC = data.kgProd.CC.valor.substr(2);
  //         var kgProdRP = data.kgProd.RP.valor.substr(2);
  //         var kgProdRC = data.kgProd.RC.valor.substr(2);
  //         var kgProdT = data.kgProd.T.valor.substr(2);
          
  //         generarGraficos(kgProdCC,'Kg Prod. Prom','Kg Prom','barChart4Filtrado');
  //         generarGraficos(kgProdRP,'Kg Prod. Prom','Kg Prom','barChart4RPFiltrado');
  //         generarGraficos(kgProdRC,'Kg Prod. Prom','Kg Prom','barChart4RCFiltrado');
  //         generarGraficos(kgProdT,'Kg Prod. Prom','Kg Prom','barChart4TFiltrado');
          

  //     }

  //   })
     


  $('#reportesGeneral').hide();

  $('#reportesFiltrados').show();
  
});


/*=============================================
GENERAR GRAFICOS
=============================================*/
function generarGraficos(chart,data,titulo,label,canvas){

  var color = Chart.helpers.color;
  


  var config = {
    labels: [
      titulo
    ],
    datasets: [{
      label: label,
      backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
      borderColor: window.chartColors.red,
      borderWidth: 1, 
      data: [
        data
      ]
    }]

  };

  var canvas = document.getElementById(canvas).getContext('2d');
  var chart = new Chart(canvas, {
    type: 'bar',
    data: config,
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

}

/*=============================================
ACTUALIZAR GRAFICOS
=============================================*/
// function actualizaGraficos(data,titulo,label,canvas){



//   var canvas = document.getElementById(canvas).getContext('2d');
//   myBar.config.labels = titulo;
//   myBar.config.datasets.label = label;
//   myBar.config.datasets.data = data;
  
//   window.myBar.update();



// }

/*=============================================
BLOQUEAR CONSIGNATARIO
=============================================*/

function bloquearConsignatario(id){
  
  var numeroId = id.substr(-1);
  var valor = $('#tropa' + numeroId).val();

  if(valor == 'Tropa'){

    $('#consignatario' + numeroId).removeAttr('disabled');


  }

    
  if (valor != 'Tropa') {

    $('#consignatario' + numeroId).attr('disabled','disabled');

  }

}

/*=============================================
CARGAR TROPA SEGUN CONSIGNATARIO
=============================================*/
function cargarTropaConsignatario(id){
  
  
  var numeroId = id.slice(-1);
  var valor = $('#' + id).val();
  
  // AJAX
  var datos = 'consignatario=' + valor;
  $.ajax({
    
    url: "ajax/cargarTropaConsignatario.ajax.php",
    
    method: "POST",
    
    data: datos,
    
    success: function(respuesta){

      $('#tropa' + numeroId).html(respuesta);

    }

  })
  

}

/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("capturarRango") != null){

	$("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));


}else{

	$("#daterange-btn2 span").html('<i class="fa fa-calendar"></i> Rango de fecha')

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-btn').daterangepicker(
  {
    ranges   : {

    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    console.log(fechaFinal);
    console.log(fechaInicial);

    var capturarRango = $("#daterange-btn span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	// window.location = "index.php?ruta=reportes&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
  localStorage.clear();
  $('#daterange-btn').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');

})




function actualizaGraficos(chart,data,titulo,label){
  
chart.config.data.labels = [titulo];
chart.config.data.datasets[0].data = [data];
chart.config.data.datasets[0].label = label;

window.chart.update();

}


