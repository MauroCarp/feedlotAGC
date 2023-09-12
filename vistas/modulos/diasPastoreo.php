<?php
function formatearFecha($fecha){
	$fecha = explode('-',$fecha);
	$nuevaFecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
	return $nuevaFecha;
}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Dias Pastoreo
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Dias Pastoreo</li>
    
    </ol>

  </section>

  <section class="content">

  <div class="row">

    <div class="col-12">

      <div class="box-header with-border">
        
            <div class="box box-primary">
    
              <div class="box-header with-border">
    
                <h3 class="box-title">Lotes</h3>
    
              </div>
    
              <div class="text-center">
                <img src="vistas/img/plantilla/lotes.png" alt="Lotes" usemap="#image-map">
                <map name="image-map">
                  <area alt="Lote 1" class="lotes" title="Lote 1"  data-lote="15" coords="95,243,139,231,61,34,4,30,55,172,66,176" shape="poly">
                  <area alt="Lote 2" class="lotes" title="Lote 2" data-lote="11" coords="141,232,201,215,149,32,60,31" shape="poly">
                  <area alt="Lote 3" class="lotes" title="Lote 3" data-lote="11" coords="204,214,260,196,245,146,268,140,236,28,150,32" shape="poly">
                  <area alt="Lote 4" class="lotes" title="Lote 4" data-lote="11" coords="272,137,449,89,431,25,240,30" shape="poly">
                  <area alt="Lote 5" class="lotes" title="Lote 5" data-lote="15" coords="133,322,203,307,179,223,99,244" shape="poly">
                  <area alt="Lote 6" class="lotes" title="Lote 6" data-lote="15" coords="206,305,283,285,312,293,282,196,183,225" shape="poly">
                  <area alt="Lote 7" class="lotes" title="Lote 7" data-lote="15" coords="326,300,327,285,359,277,363,168,466,138,499,284,421,311" shape="poly">
                </map>

              </div>
    
            </div>
      
      </div>
      
    </div>

    <!-- <div class="col-lg-7">
    
      <div class="box">

        <div class="box-body">
          
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          
          <thead>
          
          <tr>
            
            <th>Tropa</th>
            <th>Fecha Entrada</th>
            <th>Fecha Salida</th>
            <th>Dias desde u.d.p</th>
            <th>Dias proximos a pastorear</th>
            <th></th>

          </tr> 

          </thead>

          <tbody>

          <?php

            // $item = null;
            // $valor = null;
            // $campo = '*';
            // $registrosPastoreo = ControladorPastoreo::ctrMostrarRegistros($campo,$item,$valor);

            // foreach ($registrosPastoreo as $key => $value){

            //   if($value["fechaSalida"] != ''){
                
            //     $tdFechaSalida = formatearFecha($value["fechaSalida"]);

            //   } else {

            //     $tdFechaSalida = '<button class="btn btn-info" onclick="$(`#ventanaModalFechaPastoreoSalida`).modal(`show`);cargarDatos(' . $value["id"] . ')" idRegistro="' . $value["id"] . '">Cargar Fecha</button>';

            //   }
              
            //   echo ' <tr>
                              
            //           <td>'.$value["tropa"].'</td>
            //           <td>'.formatearFecha($value["fechaEntrada"]).'</td>
            //           <td>'.$tdFechaSalida.'</td> 
            //           <td>'.$value["diasDesdeUDP"].'</td>
            //           <td>'.$value["diasProxPastorear"].'</td>

            //           <td>

            //           <div class="btn-group">
                        
            //             <button class="btn btn-warning btnModificarRegistro" onclick="cargarDatos(`' . $value["id"] . '`)" idRegistro="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
            //             <button class="btn btn-danger btnEliminarRegistro" idRegistro="'.$value["id"].'"><i class="fa fa-times"></i></button>

            //           </div>  

            //         </td>

            //         </tr>';
            // }


          ?> 

          </tbody>

        </table>

        </div>

      </div>

    </div> -->

  </section>

</div>

<script>

$('#tropaPastoreo').select2()


function cargarDatos(idTropa){

  $.ajax({
    url:'ajax/pastoreo.ajax.php',
    method:'POST',
    data: `item=id&valor=${idTropa}&accion=mostrarData`,
    success:function(response){

      var data = JSON.parse(response)

      $('#tropaPastoreo').val(data['id'])
      $('#tropaPastoreo').select2({
        disabled: true
      })
      
      

    }

  })
}

$('.tablas').on('click','.btnEliminarRegistro',function(){
  var id = $(this).attr('idRegistro')

  swal({
    title: `¿Está seguro de borrar el registro?`,
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar datos!'
  }).then(respuesta=>{

    if(respuesta.value){

        window.location.href = `index.php?ruta=diasPastoreo&id=${id}&accion=eliminarRegistro`;

    }

  })  

})

$('#submitPastoreosalida').on('click', function() {
  $('#tropaPastoreo').prop('disabled', false); // Habilitar el select2 antes de enviar el formulario
  // Aquí puedes hacer otras validaciones o acciones antes de enviar el formulario
  $('#formPastoreosalida').submit(); // Enviar el formulario
});

$(document).ready(function(){

  $('[data-toggle="tooltip"]').tooltip();

})

$('.lotes').each(function(){

  $(this).on('click',function(e){

    e.preventDefault()

    var lote = $(this).attr('data-lote')

    var url = 'ajax/pastoreo.ajax.php'

    var data = `accion=mostrarData&item=lote&valor=${lote}`

    $('#tituloFechaPastoreo').html(lote)

    $.ajax({
      method:'POST',
      url,
      data,
      beforeSend:function(){
        $('#formPastoreo')[0].reset()
      },
      success:function(response){

        $('#fechaPastoreo').modal('show')
      
        var resultado = JSON.parse(response)

        $('#parcelas').empty()
        $('#parcelas').append(`<option value="">Seleccionar Parcela</option>`)

        resultado.forEach(element => {
        
          $('#parcelas').append(`<option value="${element.parcela}">Parcela ${element['parcela']}</option>`)

        });

      }
    })
    
  })

})

$('#parcelas').on('change',function(){

  var parcela = $(this).val()
  var lote = $('#tituloFechaPastoreo').val()
  
  $.ajax({
    method:'POST',
    url: 'ajax/pastoreo.ajax.php',
    data:`accion=mostrarData&item=parcela&valor=${parcela}&item2=lote&valor2=${lote}`,
    success:function(response){
      
      var resultado = JSON.parse(response)
      resultado = resultado[0]

      $('#entradaPlanificada').val(resultado['fechaEntradaPlanificada'])
      $('#salidaPlanificada').val(resultado['fechaSalidaPlanificada'])
      $('#diasPlanificado').val(resultado['diasPastoreo'])
      $('#idRegistro').val(resultado['id'])

      if(resultado['fechaEntrada']) 
        $('#entradaReal').val(resultado['fechaEntrada'])

      if(resultado['fechaSalida']) 
        $('#salidaReal').val(resultado['fechaSalida'])

      if(resultado['fechaEntrada'] && resultado['fechaSalida'])
        $('#diasReal').val(moment(resultado['fechaSalida']).diff(moment(resultado['fechaEntrada']), 'days'))
            
    }
  })

})

</script>

<?php
  
  $editarPlanilla = new ControladorArchivos();
  $editarPlanilla -> ctrEditarPlanilla();

  $eliminarRegistro = new ControladorPastoreo();
  $eliminarRegistro -> ctrEliminarRegistro();

?> 


