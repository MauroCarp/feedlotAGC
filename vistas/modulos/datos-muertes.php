<?php
function formatearFecha($fecha){
  $fecha = explode('-',$fecha);
  $nuevaFecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
  return $nuevaFecha;
}

$alertaValida = array_key_exists('alerta',$_GET);

if($alertaValida){

  $alerta = $_GET['alerta'];

  if($alerta == 'datosRepetidos')

  echo'<script>

					swal({
						  type: "error",
						  title: "Los registros del mes y año que se quisieron cargar, ya estan cargados.",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "datos-muertes";

									}
								})

					</script>';

  if($alerta == 'cargadoCorrecto')  
    echo'<script>

            swal({
                type: "success",
                title: "Los registros se han cargado correctamente.",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result) {
                    if (result.value) {

                    window.location = "datos-muertes";

                    }
                  })

            </script>';

  if($alerta == 'archivoIncorrecto')
    echo'<script>

    swal({
        type: "error",
        title: "El archivo que se quiere cargar, no pertenece a la sección MUERTES",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result) {
            if (result.value) {

            window.location = "datos-muertes";

            }
          })

    </script>';

  if($alerta == 'errorFila'){

    $rowNumber = $_GET['errorFila'];
    
    $errorColumna = $_GET['errorColumna'];

    echo'<script>

    swal({
        type: "error",
        title: "Hay un error en la fila Nº'.$rowNumber.', en la columna '.$errorColumna.' de la base de datos de Excel (Verificar formatos de la columna)",
        showConfirmButton: true,
        confirmButtonText: "Cerrar"
        }).then(function(result) {
            if (result.value) {

            window.location = "datos";

            }
          })

    </script>';
    
  }

}


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Cargar Datos de Muertes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Cargar Datos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCargarDatos">
          
          Cargar Datos

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaMuertes" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Fecha de Muerte</th>
           <th>Consignatario</th>
           <th style="width:400px">Proveedor</th>
           <th>Tropa</th>
           <th>Motivo</th>
           <th>Diagnostico</th>
           <th>Tratado</th> 

         </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalCargarDatos" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data" action="cargar-datos-muertes.php">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cargar Datos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">Seleccionar Archivo</div>

              <input type="file" class="nuevosDatos" name="nuevosDatos">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Cargar Datos</button>

        </div>

      </form>

    </div>

  </div>

</div>






