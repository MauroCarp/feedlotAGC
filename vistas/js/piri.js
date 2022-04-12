/*****
 * 
 * ACTUALIZAR PIRI
 * 
 * */

 let btnPiri = document.getElementById('btn-piri');

 if(btnPiri != null){
    btnPiri.addEventListener('click',function(){

        $.ajax({
            url: "ajax/piri.ajax.php",
            // here
            beforeSend: function() {
                swal({
                    title: 'Verificando P.I.R.I',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    onOpen: () => {
                    swal.showLoading();
                    }
                });
            },
            success: function(respuesta) {
                if(respuesta){
                    swal({

                        type: "success",
                        title: "¡La tabla P.I.R.I fue actualizada correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function() {
                        window.location = "piri";
                    })
                }else{
                    swal({

                        type: "error",
                        title: "No se encontraro nuevos datos. La tabla P.I.R.I se encuentra actualizada.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    });
                }

            }

        });
    });

}
/*=============================================
ELIMINAR PIRI
=============================================*/
$(".tablas").on("click", ".btnEliminarPiri", function(){

	let idPiri = $(this).attr("idPiri");
	
	swal({
        title: '¿Está seguro de borrar el Registro?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Piri!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=piri&idPiri="+idPiri;
        }

  })
});

