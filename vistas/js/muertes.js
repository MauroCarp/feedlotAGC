// $.ajax({

// 	url: "ajax/datatable-compras.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// });


$('.tablaMuertes').DataTable( {
    "ajax": "ajax/datatable-muertes.ajax.php",
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


/*=============================================
OPCIONES GRAFICOS
=============================================*/

function opcionesSkipFalse(configuracion){
    var opciones = {
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
              render: 'value'
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
      }
    return opciones;

}

$('#compararValidoMuertes').change(function(){

  let compararValido = $(this).is(':checked');

  if(compararValido){

    $('#modalPrincipalMuertes').css('left','-250px');
    
    $('#modalPrincipalMuertes').css('transition','left 1s');

    $('#modalCompararMuertes').show(1000);
    
    
  }else{
    
    $('#modalCompararMuertes').hide(800);

    $('#modalPrincipalMuertes').css('left','0');
    
    $('#modalPrincipalMuertes').css('transition','left 1s');

  }


});
