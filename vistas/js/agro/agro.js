
const btnsMenuAgro = document.querySelectorAll('.menuAgro')

for (const menu of btnsMenuAgro) {
    
    menu.addEventListener('click',()=>{

        let menuAgro = menu.getAttribute('data-agro')
    
        document.getElementById('tituloAgro').innerText = `Cargar ${menuAgro}`
        document.getElementById('btnCargarAgro').setAttribute('data-agro',menuAgro)
        document.getElementById('btnCargarAgro').innerText = `Cargar ${menuAgro}`
    
    })

}