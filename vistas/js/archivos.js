const arrayMeses = new Array;
arrayMeses.push('enero');
arrayMeses.push('febrero');
arrayMeses.push('marzo');
arrayMeses.push('abril');
arrayMeses.push('mayo');
arrayMeses.push('junio');
arrayMeses.push('julio');
arrayMeses.push('agosto');
arrayMeses.push('septiembre');
arrayMeses.push('octubre');
arrayMeses.push('noviembre');
arrayMeses.push('diciembre');

/*=============================================
ELIMINAR ARCHIVO
=============================================*/
$(".tablas").on("click", ".btnEliminarArchivo", function(){

  var nombreArchivo = $(this).attr("nombreArchivo");
  var tabla = $(this).attr("tablaDB");

  swal({
    title: '¿Está seguro de borrar los registros asociados a este Archivo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=archivosCarga&nombreArchivo=" + nombreArchivo + "&tabla=" + tabla;

    }

  })

})


// MENSAJE CARGANDO
const showLoading = ()=>{
  swal({
  title: 'Cargando...',
  allowEscapeKey: false,
  allowOutsideClick: false,
  onOpen: () => {
    swal.showLoading();
  }
  });
}

/*=============================================
MOSTRAR MODAL ARCHIVO
=============================================*/
$(document).on("click",".modalEditar",function(){

  let nombreArchivo = $(this).attr("archivo");
  let periodo = $(this).attr("periodo");

  periodoSlice = periodo.split('-');

  let anio = periodoSlice[0];
  let mes = parseFloat(periodoSlice[1]);
    
  $('#tituloEditarPlanilla').html(`Editar Planilla ${arrayMeses[mes-1].charAt(0).toUpperCase() + arrayMeses[mes-1].slice(1)} - ${anio}`);

  $('.btnEditarArchivo').attr('periodo', periodo);

  let data = `accion=valuesEditar&periodo=${periodo}`;

  let url = 'ajax/datosPanelControl.ajax.php';

  showLoading();

  $.ajax({

    method: 'POST',

    url: url,
    
    data: data,

    success: function(response){
      
      swal.close();
      
      response = JSON.parse(response);
      console.log(response);
      
      $('#periodo').val(response.periodo);
      $('#CSanCabPeriodo').val(response.CSanCabPeriodo);
      $('#CDiaAlimTCCab').val(response.CDiaAlimTCCab);
      $('#CKgRacPromTC').val(response.CKgRacPromTC);
      $('#CKgRacPromMS').val(response.CKgRacPromMS);
      $('#consumTCPondCab').val(response.consumTCPondCab);
      $('#consumMSPondCab').val(response.consumMSPondCab);
      $('#converMSEstADPV').val(response.converMSEstADPV);
      $('#consumoSoja').val(response.consumoSoja);
      $('#consumoMaiz').val(response.consumoMaiz);
      $('#poblDiaPromPeriodo').val(response.poblDiaPromPeriodo);
      $('#totalCabSalida').val(response.totalCabSalida);
      $('#muertosPeriodo').val(response.muertosPeriodo);
      $('#estadiaProm').val(response.estadiaProm);
      $('#cabTrazSalidas').val(response.cabTrazSalidas);
      $('#pesoPromIngSalTraz').val(response.pesoPromIngSalTraz);
      $('#pesoPromEgrTraz').val(response.pesoPromEgrTraz);
      $('#kilosGanPeriodoTraz').val(response.kilosGanPeriodoTraz);
      $('#adpvGanDiaPeriodo').val(response.adpvGanDiaPeriodo);
      $('#totalCabFaenadas').val(response.totalCabFaenadas);
      $('#totalKgCarne').val(response.totalKgCarne);
      $('#totalPesosFaena').val(response.totalPesosFaena);
      $('#rinde').val(response.rinde);
      $('#valorKgObtRinde').val(response.valorKgObtRinde);
      $('#porceDesbaste').val(response.porceDesbaste);
      $('#CProdKgAlim').val(response.CProdKgAlim);
      $('#CProdKgAES').val(response.CProdKgAES);
      $('#margenTecKgProd').val(response.margenTecKgProd);
      $('#maiz').val(response.consumoMaiz);
      $('#soja').val(response.consumoSoja);
      $('#indiceReposicion').val(response.indiceReposicion);
      
        
    }

  });
   
})




