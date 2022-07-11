
const btnsMenusCarga = document.querySelectorAll('.menusCarga')

for (const menu of btnsMenusCarga) {
    
    menu.addEventListener('click',()=>{

        let menuCarga = menu.getAttribute('data-carga')

        document.getElementById('tituloCarga').innerText = `Cargar ${menuCarga}`
        document.getElementById('btnCargar').setAttribute('data-carga',menuCarga.replace(' ',''))
        document.getElementById('nuevosDatosCarga').setAttribute('name',`nuevosDatos${menuCarga.replace(' ','')}`)
        document.getElementById('btnCargar').innerText = `Cargar ${menuCarga}`


        if(menuCarga == 'Paihuen'){

            document.getElementById('inputPeriodoContable').classList.remove('hidden')
            
        }else{

            document.getElementById('inputPeriodoContable').classList.add('hidden')
       
        }
    
    })

}
