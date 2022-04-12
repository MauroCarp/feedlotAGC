/*=============================================
GENERAR REPORTE
=============================================*/

$('#generarReporteCompras').click(()=>{
    
    var rango = (localStorage.getItem('rangoCompras') == null) ? '1970-01-01/2090-01-01' : localStorage.getItem('rangoCompras');

    window.location = 'index.php?ruta=reportes-compras&rango=' + rango;

    console.log(rango);
    
});


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

$('#daterange-btnCompras').daterangepicker(
  {
    ranges   : {

    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btnCompras span').html(start.format('DD/MM/Y') + ' - ' + end.format('DD/MM/YYYY'));

    var fechaInicial = start.format('Y-MM-DD');

    var fechaFinal = end.format('Y-MM-DD');

    localStorage.setItem('rangoCompras', fechaInicial + '/' + fechaFinal);
    var capturarRango = $("#daterange-btnCompras span").html();


    cargarSelectSegunFecha('1',capturarRango,'compras','consignatario','fecha');
    
    cargarSelectSegunFecha('1',capturarRango,'compras','proveedor','fecha');
    
    cargarSelectSegunFecha('1',capturarRango,'compras','tropa','fecha');
  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("rangoCompras");
  localStorage.clear();
  $('#daterange-btnCompras').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');

});

$('#daterange-btnCompras').click(()=>{

  localStorage.removeItem("rangoCompras");

  $('#daterange-btnCompras').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');

});


/*=============================================
IMPRIMIR REPORTE
=============================================*/

$('#imprimirCompras').click(()=>{

  var rango = (localStorage.getItem('rangoCompras') == null) ? '1970-01-01/2090-01-01' : localStorage.getItem('rangoCompras');

  window.open('index.php?ruta=reportes-compras.imprimir&rango=' + rango, '_blank');

});