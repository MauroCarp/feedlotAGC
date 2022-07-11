 // ELIMINAR DATOS EJECUCION

 document.getElementById('eliminarEjecucion').addEventListener('click',()=>{

    let [campania1,campania2] = document.getElementById('campania').innerText.split('/')

    swal({
      title: `¿Está seguro de borrar los datos de la seccion EJECUCION, campaña ${campania1}/${campania2}?`,
      text: "¡Si no lo está puede cancelar la acción!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar datos!'
    }).then(respuesta=>{

        if(respuesta.value){

            window.location = `index.php?ruta=agro/agro&seccion=ejecucion&campania1=${campania1}&campania2=${campania2}`;

        }

    })

  })