// $.ajax({

// 	url: "ajax/datatable-compras.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// });


$('.tablaCompras').DataTable( {
    "ajax": "ajax/datatable-compras.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			}

	}

} );


$('#compararValidoFechaCompras').change(function(){
	
	let compararValido = $(this).is(':checked');
	
	console.log(compararValido);

	if(compararValido){
  
	  $('#modalFechaComprasComparar').show(1000);
  
	  $('#modalFechaCompra').css('left','-250px');
	  
	  $('#modalFechaCompra').css('transition','left 1s');
	  
	  
	}else{
	  
	  $('#modalFechaComprasComparar').hide(800);
  
	  $('#modalFechaCompra').css('left','0');
	  
	  $('#modalFechaCompra').css('transition','left 1s');
  
	}
  
  
  });

  $('#daterange-btnCompras').daterangepicker(
	{
	  ranges   : {
  
	  },
	  startDate: moment(),
	  endDate  : moment()
	},
	function (start, end) {
	  $('#daterange-btnCompras span').html(start.format('d/m/Y') + ' - ' + end.format('DD/MM/YYYY'));
  
	  var fechaInicial = start.format('YYYY-MM-d');
  
	  var fechaFinal = end.format('YYYY-MM-d');
  
	  localStorage.setItem('rangoCompras', fechaInicial + '/' + fechaFinal);
  
	  var capturarRango = $("#daterange-btnCompras span").html();
  
	  cargarSelectSegunFecha('1',capturarRango,'compras','consignatario','fecha');
	  
	  cargarSelectSegunFecha('1',capturarRango,'compras','proveedor','fecha');
	  
	  cargarSelectSegunFecha('1',capturarRango,'compras','tropa','fecha');
	}
  
  );

  $('#daterange-btnComprasComp').daterangepicker(
	{
	  ranges   : {
  
	  },
	  startDate: moment(),
	  endDate  : moment()
	},
	function (start, end) {
	  $('#daterange-btnComprasComp span').html(start.format('d/m/Y') + ' - ' + end.format('DD/MM/YYYY'));
  
	  var fechaInicial = start.format('YYYY-MM-d');
  
	  var fechaFinal = end.format('YYYY-MM-d');
  
	  localStorage.setItem('rangoComprasComp', fechaInicial + '/' + fechaFinal);
  
	  var capturarRango = $("#daterange-btnComprasComp span").html();
  
	  cargarSelectSegunFecha('1',capturarRango,'compras','consignatario','fecha');
	  
	  cargarSelectSegunFecha('1',capturarRango,'compras','proveedor','fecha');
	  
	  cargarSelectSegunFecha('1',capturarRango,'compras','tropa','fecha');
	}
  
  );
  