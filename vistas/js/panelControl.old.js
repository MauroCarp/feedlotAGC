let date = new Date();
let month = date.getMonth() + 1;

month = (month < 10) ? '0' + month : month;

let year = date.getFullYear();

let monthValue = year + '-' + month;

/*=============================================
AGREGAR PERIODO
=============================================*/

function agregarPeriodo(contador,inputID){


      let contenido = '<div class="row">';
      
      contenido += '<div class="col-md-8">';
      
      contenido += '<label><h4><b>Periodo ' + contador + '</b></h4></label>';
      
      contenido += '</div>';
      
      contenido += '</div>';
      
      contenido += '<div class="row">';
      
      contenido += '<div class="col-md-12">';

      contenido += `<input class="form-control months${inputID}" type="month" id="periodo${inputID}${contador}">`;

      contenido += '</div>';
      
      contenido += '</div>';

  return contenido;

}

let contadorPC = 2;

let contenido = '';

$('#compararPC').click(()=>{

  contenido = agregarPeriodo(contadorPC,'PC');
  
  $('#btn-plusPC').before(contenido);
  
  $('#btn-plusPC').before('<br>');
  
  $('#periodoPC' + contadorPC )[0].value = monthValue;
  
  contadorPC++;

});

/*=============================================
BOTON GENERAR REPORTE
=============================================*/

$('#generarPanelControl').click(()=>{

    let periodos = [];
    
    $('.monthsPC' ).each(function(){

      periodos.push($(this).val());

    });

    periodos = periodos.join('/');

    window.location.href = 'index.php?ruta=panelControl&periodos=' + periodos, _self;

});


/*=============================================
MODAL MOSTRAR COMPARAR
=============================================*/

$('#compararValidoFechaPanelControl').change(function(){
	
	let compararValido = $(this).is(':checked');
	
	if(compararValido){
  
	  $('#modalFechaPanelControlComparar').show(1000);
  
	  $('#modalFechaPanelControl').css('left','-250px');
	  
	  $('#modalFechaPanelControl').css('transition','left 1s');
	  
	  
	}else{
	  
	  $('#modalFechaPanelControlComparar').hide(800);
  
	  $('#modalFechaPanelControl').css('left','0');
	  
	  $('#modalFechaPanelControl').css('transition','left 1s');
  
	}
  
  
  });

/*=============================================
AGREGAR FILTROS
=============================================*/

$('#daterange-btnPanel').daterangepicker(
    {
      ranges   : {
  
      },
      startDate: moment(),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btnPanel span').html(start.format('d/m/Y') + ' - ' + end.format('DD/MM/YYYY'));
  
      var fechaInicial = start.format('YYYY-MM-DD');
  
      var fechaFinal = end.format('YYYY-MM-DD');
  
      localStorage.setItem('rangoPanel', fechaInicial + '/' + fechaFinal);
  
      var capturarRango = $("#daterange-btnPanel span").html();
  
    }
  
  )
  

$('#daterange-btnPanelComp').daterangepicker(
  {
    ranges   : {

    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btnPanel span').html(start.format('d/m/Y') + ' - ' + end.format('DD/MM/YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    localStorage.setItem('rangoPanel', fechaInicial + '/' + fechaFinal);

    var capturarRango = $("#daterange-btnPanel span").html();

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

/*=============================================
GENERAR SOLAPA PERIODO
=============================================*/

function generarCajas(contador){
 
 let contenido = '<section class="content" style="min-height:0px">';
    
    contenido += ' <div class="row">';
     contenido += '     <div class="col-lg-3 col-xs-6">';
     contenido += '         <div class="small-box bg-yellow">';
     contenido += '             <div class="inner">';
     contenido += '             <h3>Poblaci&oacute;n Prom.</h3>'; 
     contenido += '             <h3><span id="panelPoblacion' + contador + '"></span> Animales</h3>';                 
     contenido += '             </div>'; 
     contenido += '             <div class="icon" style="padding-top:10px;">';
     contenido += '             <i class="icon-COW"></i>';                 
     contenido += '             </div>'; 
     contenido += '         </div>'; 
     contenido += '     </div>'; 
     contenido += '     <div class="col-lg-2 col-xs-4">';
     contenido += '         <div class="small-box bg-yellow">';
     contenido += '             <div class="inner">';
     contenido += '                 <h3>Conversi&oacute;n</h3>'; 
     contenido += '                 <h3><span id="panelConversion' + contador + '"></span></h3>'; 
     contenido += '             </div>'; 
     contenido += '             <div class="icon">';
     contenido += '                 <i class="fa fa-refresh"></i>';                 
     contenido += '             </div>'; 
     contenido += '         </div>'; 
     contenido += '     </div>'; 
     contenido += '     <div class="col-lg-2 col-xs-4">';
     contenido += '         <div class="small-box bg-aqua">';
     contenido += '             <div class="inner">';
     contenido += '                 <h3>ADPV</h3>'; 
     contenido += '                 <h3><span id="panelAdpv' + contador + '"></span> Kg</h3>';                 
     contenido += '             </div>'; 
     contenido += '             <div class="icon">';
     contenido += '                 <i class="fa fa-arrow-up"></i>';                 
     contenido += '             </div>';                 
     contenido += '         </div>'; 
     contenido += '     </div>'; 
     contenido += '     <div class="col-lg-2 col-xs-4">';
     contenido += '         <div class="small-box bg-yellow">';
     contenido += '             <div class="inner">';
     contenido += '                 <h3>$ Kg Prod.</h3>'; 
     contenido += '                 <h3>$ <span id="panelPrecioKiloProd' + contador + '"></span></h3>'; 
     contenido += '             </div>';  
     contenido += '             <div class="icon">';
     contenido += '                 <i class="fa fa-dollar"></i>';                 
     contenido += '             </div>'; 
     contenido += '         </div>'; 
     contenido += '     </div>'; 
     contenido += '     <div class="col-lg-3 col-xs-6">';
     contenido += '         <div class="small-box bg-green">';
     contenido += '             <div class="inner">';
     contenido += '                 <h3>Estadia</h3>'; 
     contenido += '                 <h3><span id="panelEstadia' + contador + '"></span> D&iacute;as</h3>';             
     contenido += '             </div>'; 
     contenido += '             <div class="icon" style="padding-top:10px;">';
     contenido += '                 <i class="icon-corral"></i>';                 
     contenido += '             </div>';                 
     contenido += '         </div>'; 
     contenido += '     </div>'; 
     contenido += ' </div>'; 
     contenido += ' </section>';

     return contenido;

}

function generarSolapasCPP(contador){

  let contenido;
  contenido = ' <div class="nav-tabs-custom">';
  contenido += '   <ul class="nav nav-tabs" style="font-size:1.em;">';
  contenido += '     <li class="tabs active"><a href="#tab_1' + contador + '" data-toggle="tab"><b>Consumos</b></a></li>';
  contenido += '     <li class="tabs"><a href="#tab_2' + contador + '" data-toggle="tab"><b>Poblacion</b></a></li>';
  contenido += '     <li class="tabs"><a href="#tab_3' + contador + '" data-toggle="tab"><b>Producci&oacute;n</b></a></li>';
  contenido += '   </ul>';
  contenido += '   <div class="tab-content">';
  contenido += '     <div class="tab-pane active" id="tab_1' + contador + '">';
  contenido += '       <h1>asdasdg</h1>';
  contenido += '     </div>';
  contenido += '     <div class="tab-pane poblacion" id="tab_2' + contador + '">';
  contenido += '       <h1>poblacion</h1>';
  contenido += '     </div>';
  contenido += '     <div class="tab-pane produccion" id="tab_3' + contador + '">';
  contenido += '       <h1>produccion</h1>';
  contenido += '     </div>';
  contenido += '   </div>';
  contenido += ' </div>';

  return contenido;

}  


/*=============================================
CHEQUEAR PLANILLA
=============================================*/

function chequearPlanilla(periodo,id,etiqueta){

	swal({
        title: `¿Planilla ${etiqueta} chequeada?`,
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, planilla chequeada!'
      }).then((result)=>{
        
        if (result.value) {
          
          let data = 'accion=chequear&periodo=' + periodo;

          url = 'ajax/datosPanelControl.ajax.php';

          $.ajax({
            
            method: 'POST',

            url: url,

            data: data,

            success: function(response){

              
              if (response == 'ok') {
                  
                swal({

                  type: "success",
                  title: "¡La Planilla ha sido chequeada correctamente!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"

                });

                $('#solapaPeriodo' + id).css('background-color','white');

                $('#btn-chequeado-' + id).html('');

              }
                        
            }

          })
          
        }

  })

}


/*=============================================
SECCION ESTADISTICAS
=============================================*/
$('.tabsPanelControl').on('click',function(){

  let tab = $(this).attr('href')

  tabSub = tab.substring(0, tab.length - 2)

  let countNumber = tab.substring(7, tab.length);
  
  if(tabSub == '#tab_4'){
     
     $(`#cajasPanelControl${countNumber}`).hide(200) 
     
    }else{
            
    $(`#cajasPanelControl${countNumber}`).show(200) 

  }
  
})
