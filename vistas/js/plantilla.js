/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree()

/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({
	"ordering": false,
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

});

/*=============================================
 //iCheck for checkbox and radio inputs
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

/*=============================================
 //input Mask
=============================================*/

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND	
=============================================*/

if(window.matchMedia("(max-width:767px)").matches){
	
	$("body").removeClass('sidebar-collapse');

}else{

	$("body").addClass('sidebar-collapse');
}


/*=============================================
PRIMER LETRA MAYUSCULAS
=============================================*/

const capitalizarPrimeraLetra = (str)=>{

	return str.charAt(0).toUpperCase() + str.slice(1);

}

/*=============================================
OBTENER GET
=============================================*/

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
  

/*=============================================
REDIRIGIR SI ES MOBILE
=============================================*/
// Redirigir a la URL específica si se accede desde un dispositivo móvil
function redirectToMobileURL() {
	const isMobileDevice = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
	const mobileURL = "index.php?ruta=diasPastoreo";
	const currentPage = window.location.pathname.split('/').pop();
	console.log(currentPage)

	if (isMobileDevice && currentPage == '') {
	  window.location.href = mobileURL;
	}

}

// Llamar a la función para redirigir al cargar la página
window.onload = redirectToMobileURL;
