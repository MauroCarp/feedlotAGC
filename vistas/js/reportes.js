
/*=============================================
AGREGAR FILTROS
=============================================*/
function agregarFiltro(contador,URLactual,tabla,item,comparar){

  var contenido = '';
  contenido += '<hr>';
  contenido +=      '<div class="row">';
  contenido +=      '<div class="col-md-4">';
  contenido +=        '<div class="form-group"><label>Consignatario</label>';
  contenido +=          '<select class="form-control consignatarios' + comparar + '" id="consignatario' + contador + comparar + '" onchange="(generarProveedores(this.id,\''+ tabla +'\'))">';
  contenido +=            '<option value="Consignatario">Consignatario</option>';

  var rango = localStorage.getItem('rango');

  if(URLactual.includes('muertes') || URLactual.includes('reportesFiltradosMuertes')){

    rango = localStorage.getItem('rangoMuertes');

  }

  var campo = 'consignatario';
  
  if(rango != null){

    cargarSelectSegunFecha(contador,rango,tabla,campo,item,comparar);
  
  }else{

    var consignatarios = localStorage.getItem("consignatarios").split(',');
    consignatarios.forEach(valor => {
      contenido += '<option value="' + valor + '">' + valor + '</option>';
    });

  }
  
  
  contenido +=          '</select>';
  contenido +=        '</div></div>';  
  contenido +=      '<div class="col-md-4">';
  contenido +=        '<div class="form-group"><label>Proveedor</label>';
  contenido +=          '<select class="form-control proveedores' + comparar + '" id="proveedor' + contador + comparar + '" onchange="(generarTropas(this.id,\''+ tabla +'\'))">';
  contenido +=            '<option value="Proveedor">Proveedor</option>';

  campo = 'proveedor';
  if(rango != null){

  cargarSelectSegunFecha(contador,rango,tabla,campo,item,comparar);
  
  }else{

    var proveedores = localStorage.getItem("proveedores").split(',');
    proveedores.forEach(valor => {
    contenido += '<option value="' + valor + '">' + valor + '</option>';
    });

  }
      
  contenido +=          '</select>';
  contenido +=        '</div></div>';  
  contenido +=      '<div class="col-md-4">';
  contenido +=        '<div class="form-group"><label>Tropa</label>';
  contenido +=          '<select class="form-control tropas' + comparar + '" id="tropa' + contador + comparar + '" onchange="(bloquearProveedor(this.id))">';
  contenido +=            '<option value="Tropa">Tropa</option>';

  campo = 'tropa';

  if(rango != null){

  cargarSelectSegunFecha(contador,rango,tabla,campo,item,comparar);
  
  }else{
    
    var tropas = localStorage.getItem("tropas").split(',');
  
    tropas.forEach(valor => {
      contenido += '<option value="' + valor + '">' + valor + '</option>';
    });

  }
  
  
  contenido +=          '</select>';
  contenido +=        '</div></div>';  
  contenido +=      '</div>';
  contenido +=     '</div>';

  return contenido;

}

var contador = 2;

var URLactual = window.location;

URLactual = URLactual.href;

var tabla = (URLactual.includes('muertes') || URLactual.includes('reportesFiltradosMuertes')) ? 'muertes' : 'animales';

var item = (URLactual.includes('muertes') || URLactual.includes('reportesFiltradosMuertes')) ? 'fechaMuerte' : 'fechaSalida';

$('#comparar').click(function(){

  let contenido = agregarFiltro(contador,URLactual,tabla,item,'');

  $("#btn-plus").before(contenido);

  contador++;

});

$('#compararValidoVentas').change(function(){

  let compararValido = $(this).is(':checked');

  if(compararValido){

    $('#modalPrincipalVentas').css('left','-250px');
    
    $('#modalPrincipalVentas').css('transition','left 1s');

    $('#modalCompararVentas').show(1000);
    
    
  }else{
    
    $('#modalCompararVentas').hide(800);

    $('#modalPrincipalVentas').css('left','0');
    
    $('#modalPrincipalVentas').css('transition','left 1s');

  }


});

var contadorComparar = 2;

$('#compararComp').click(function(){
  console.log('gadsg');

  let contenidoComp = agregarFiltro(contadorComparar,URLactual,tabla,item,'Comp');

  $("#btn-plusComp").before(contenidoComp);

  contadorComparar++;

});


/*=============================================
GENERAR REPORTE
=============================================*/

$('#generarReporte').click(()=>{

    var contador = 1;
    var datosConsignatarios = "";
    var datosProveedores = "";
    var datosTropas = "";
    var arrayValidacion = [];

    $('.consignatarios').each(function(){
      
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
        
        if(!proveedorValido){
          
          proveedorValido = (proveedor != 'Proveedor') ? true : false; 
          
        } 
        
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
    
    var rango = (localStorage.getItem('rango') == null) ? '1970-01-01/2090-01-01' : localStorage.getItem('rango');

    
    var camposValidos = true;

    for (let index = 0; index < arrayValidacion.length; index++) {
      
        if (arrayValidacion[index] == false) {
            camposValidos = false;
            break;
        }

    }

    
    if (!camposValidos) {

      window.location = 'index.php?ruta=reportesRango&rango=' + rango;


    }else{
      
      window.location = 'index.php?ruta=reportes/reportesFiltrados&' + datosConsignatarios + '&' + datosProveedores + '&' + datosTropas + '&rango=' + rango + '&cantidad=' + (contador - 1);

    }


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
    datasets:[
      data
    ]
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

function generarGraficoBar(idDiv,configuracion,opcion){

  let barChart = document.getElementById(idDiv).getContext('2d');      
  

  let grafico;

  switch (opcion) {
    case null:

      grafico = new Chart(barChart, opciones(configuracion))
      
      break;
      
    case 'atZero':
      
      grafico = new Chart(barChart, opcionesAtZero(configuracion))
      
      break;
        
    case 'skipFalse':
        
        grafico = new Chart(barChart, opcionesSkipFalse(configuracion))
        
        break;
    
    case 'noOption':
        
        grafico = new Chart(barChart, configuracion)
        
        break;
        
    default:
      
      grafico = new Chart(barChart, opciones(configuracion))
    
      break;

  }

  return grafico;

}

function generarGraficoPie(idDiv,configuracion){

  let pieChart = document.getElementById(idDiv).getContext('2d');      
  let grafico = new Chart(pieChart, configuracion);

  return grafico;

}

/*=============================================
OPCIONES GRAFICOS
=============================================*/

function opcionesAtZero(configuracion){
  var opciones = {
    type: 'bar',
    data: configuracion,
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
      legend: {
        labels: {
            boxWidth: 5
        }
      },
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
      }
    }

  }

  return opciones;
}

function opciones(configuracion){
  var opciones = {
    type: 'bar',
    data: configuracion,
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
      legend: {
        labels: {
            boxWidth: 5
        }
      }
    }

  }

  return opciones;
}

/*=============================================
CONFIGURACION GRAFICOS
=============================================*/

function configuracionPie(data,color,label){
          
  let configuracion = {
    type: 'pie',
    data: {
      datasets: [{
        data: data,
        backgroundColor:

          color
        ,
        label: 'Porcentaje'
      }],
      labels: label
    },
    options: {
      responsive: true,
      title: {
        display: false,
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

function generarGraficoAlimento(idCanvas,adpvData,kgConsumidos,conversion){

  var ctx = document.getElementById(idCanvas).getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
    labels: ['Ciclo Completo','R. Pastoril', 'R. Corral', 'Terminacion'],
    datasets: [{
      type: 'line',
      label: 'ADPV',
      borderColor: window.chartColors.red,
      fill:false,
      yAxisID: 'A',
      data: adpvData
    },{
      label: 'CONVERSIÓN MS',
      type: 'bar',
      yAxisID: 'A',
      data: conversion,
      fill:false,
      borderColor: window.chartColors.blue,
      backgroundColor: window.chartColors.blue,
      borderWidth: 2

    }]
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
    }]
    },
    plugins:{
      labels:{
        render: 'value'
      }
    }
  }
  });

}

/*=============================================
BLOQUEAR PROVEEDOR Y CONSIG
=============================================*/

function bloquearProveedor(id){
  
  var numeroId = id.substr(-1);
  var valor = $('#tropa' + numeroId).val();
  if(valor == 'Tropa'){

    $('#proveedor' + numeroId).removeAttr('disabled');
    if($('#proveedor' + numeroId).val() == 'Proveedor'){

      $('#consignatario' + numeroId).removeAttr('disabled');
    
    }

  }

    
  if (valor != 'Tropa') {

    $('#proveedor' + numeroId).attr('disabled','disabled');
    $('#consignatario' + numeroId).attr('disabled','disabled');

  }

}


/*=============================================
CARGAR TROPA SEGUN PROVEEDOR
=============================================*/


function generarTropas(id,tabla){
  
  var numeroId = id.substr(-1);
  var tropa = $('#tropa' + numeroId).val();

  

  var proveedor = $('#proveedor' + numeroId).val();
  
  if(proveedor == 'Proveedor'){

    $('#consignatario' + numeroId).removeAttr('disabled');


  }

    
  if (proveedor != 'Proveedor') {
    $('#consignatario' + numeroId).attr('disabled','disabled');

  }

  
  // AJAX
  var datos = 'proveedor=' + proveedor + '&tabla=' + tabla;

  $.ajax({
    
    url: "ajax/cargarTropaProveedores.ajax.php",
    
    method: "POST",
    
    data: datos,
    
    success: function(respuesta){

      $('#tropa' + numeroId).html(respuesta);

    }

  });

}

/*=============================================
CARGAR SEGUN CONSIGNATARIO
=============================================*/

function generarProveedores(id,tabla){
  
  var rango = localStorage.getItem('rango');

  var numeroId = id.substr(-1);

  var consignatario = $('#consignatario' + numeroId).val();

  // AJAX
  var datos = 'consignatario=' + consignatario + '&tabla=' + tabla;

  $.ajax({
    
    url: "ajax/cargarTropaConsignatario.ajax.php",
    
    method: "POST",
    
    data: datos,
    
    beforeSend: function () {

      $('#proveedor' + numeroId).append("<option value=''><i>Cargando</i></option>");
  
    },

    success: function(respuesta){

      $('#proveedor' + numeroId).html(respuesta);

    }

  });

}

/*=============================================
CARGAR SELECTS FILTRO SEGUN FECHA
=============================================*/

function cargarSelectSegunFecha(numeroId,rango,tabla,campo,item,comparar){
    
  // AJAX
  var datos = 'tabla=' + tabla + '&rango=' + rango + '&campo=' + campo + '&item=' + item;


  $.ajax({
    
    url: "ajax/cargarSelectsFiltro.ajax.php",
    
    method: "POST",
    
    data: datos,
    
    beforeSend: function () {

      $('.' + campo + 's' + comparar).append("<option value=''><i>Cargando</i></option>");

    },

    success: function(respuesta){

      $('#' + campo + numeroId + comparar).html(respuesta);

    }

  });

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
    $('#daterange-btn span').html(start.format('DD/MM/Y') + ' - ' + end.format('DD/MM/YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    localStorage.setItem('rango', fechaInicial + '/' + fechaFinal);

    var capturarRango = $("#daterange-btn span").html();

    cargarSelectSegunFecha('1',capturarRango,'animales','consignatario','fechaSalida');
    
    cargarSelectSegunFecha('1',capturarRango,'animales','proveedor','fechaSalida');
    
    cargarSelectSegunFecha('1',capturarRango,'animales','tropa','fechaSalida');

  }

)


/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
  localStorage.clear();
  $('#daterange-btn').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');

});

$('#btn-filtros').click(()=>{

  localStorage.removeItem("rango");
  
  $('#daterange-btn').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');

});



/*=============================================
IMPRIMIR REPORTE
=============================================*/

$('#imprimirVentas').click(()=>{

  var URLactual = window.location;
  URLactual = URLactual['href'].substring(27);
  URLsplit = URLactual.split('&');
  URLsplit[0] = URLsplit[0] + '.imprimir';
  var getUrl = URLsplit.join('&');
  console.log(getUrl);

  window.open(getUrl,'_blank');

});


$('#imprimirVentasGeneral').click(()=>{

  window.open('index.php?ruta=reportes.imprimir','_blank');

});

$('#imprimirVentasRango').click(()=>{


  var rango = getQueryVariable('rango');

  window.open('index.php?ruta=reportesRango.imprimir&rango=' + rango,'_blank');

});