const cobertura = ['vicia','triticale','avena','avena cobertura','cebada','vicia-triticale','cebadilla','triticale espinillo']

const cargarInfoPlanificacion = (props)=>{
  
  // Obtener DATA
  
  let data = new FormData()
  data.append('accion','mostrarData')
  data.append('campania1',props.campania1)
  data.append('campania2',props.campania2)
  data.append('seccion','planificacion')
  data.append('campo',props.campo)
  let url = 'ajax/agro.ajax.php'

  fetch(url,{
      method:'post',
      body:data
  }).then(resp=>resp.json())
  .then(respuesta=>{

    if(respuesta.length > 0){
        
      let datos = {
        'label': [],
        'costos':{
          'lote': [],
          'trigo':[],
          'carinata':[],
          'cobertura':[],
          'resto':[],
          'total':[]
        },
        'has':{
          'lote': [],
          'invernales': [],
          'cobertura': [],
          'estivales': [],
          'trigo':[],
          'carinata':[],
          'resto':[],
          'total':0
        },
      }
      
      respuesta.forEach(registro => {
        
        // DATA PARA GRAFICOS          
        
        if(registro.planificado != ''){
          
          let regex = /(\d+)/g
        
          let cultivoNumerico = registro.planificado.match(regex)
          
          let cultivo = registro.planificado

          if(cultivoNumerico != null){

            let index = registro.planificado.indexOf(cultivoNumerico[0])

            cultivo = registro.planificado.split('')
            cultivo.splice(index, 0, ' ')
            cultivo = cultivo.join('')

          }

          datos.label.push(`${registro.lote} / ${capitalizarPrimeraLetra(cultivo)}`)

          datos.has.lote.push(Number(registro.has))
          datos.has.total += Number(registro.has)
          
          // DATA PARA INFO
          if(registro.tipoCultivo == 'Invernal' && registro.tipoCultivo != '')
            datos.has.invernales.push(Number(registro.has))
          
          if(registro.tipoCultivo == 'Estival' && registro.tipoCultivo != '')
            datos.has.estivales.push(Number(registro.has))
          
          if(registro.planificado == 'trigo')
            datos.has.trigo.push(Number(registro.has))
          
          if(registro.planificado == 'carinata')
            datos.has.carinata.push(Number(registro.has))
          
          if(registro.planificado != 'trigo' && registro.planificado != 'carinata' && registro.planificado != ''){
            
            let cultivoHas = {
              'cultivo': registro.planificado,
              'has': Number(registro.has)
            }  
            
            datos.has.resto.push(cultivoHas)
            
          }
        
        }
        
        if(registro.cobertura != ''){
                          
            let cultivoHas = {
              'cultivo': registro.cobertura,
              'has': Number(registro.has)
            }  

            datos.has.total += Number(registro.has)

            datos.has.cobertura.push(cultivoHas)

        }
        

      });
            
      let data = new FormData()
      data.append('accion','mostrarCostos')
      data.append('cultivo','')
      data.append('campania1',respuesta.campania1)
      data.append('campania2',respuesta.campania2)
      data.append('seccion','planificacion')
      
      fetch(url,{
        method:'post',
        body:data
      }).then(res=>res.json())
      .then(costos=>{
        
        for (const reg of costos) {

            if(reg.cultivo == 'trigo'){
              
                let totalHas = (datos.has.trigo.length > 0) ? datos.has.trigo.reduce((acc,cur)=> acc + cur) : 0
                
                datos.costos.trigo =  totalHas * reg.costo
              
            }
            
            if(reg.cultivo == 'carinata'){
              
                let totalHas = (datos.has.carinata.length > 0) ? datos.has.carinata.reduce((acc,cur)=> acc + cur) : 0
                  
                datos.costos.carinata =  totalHas * reg.costo
          
            }

            for (const cultivo of datos.has.resto) {

              let cult = (cultivo.cultivo == 'soja') ? 'soja1era' : cultivo.cultivo        

              if(cult.replace(' ','') == reg.cultivo){              
                
                datos.costos.resto.push( cultivo.has * reg.costo)
                
              }
    
            }

            for (const cultivo of datos.has.cobertura) {

              if(cultivo.cultivo.replace(' ','') == reg.cultivo){              
                
                datos.costos.cobertura.push( cultivo.has * reg.costo)

                datos.costos.total.push(reg.costo * cultivo.has);
                
                
              }
    
            }
            
          }
          
        for (const lote of respuesta) {
          
          let cultivo = (lote.planificado == 'soja') ? 'soja1era' : lote.planificado
          
          for (const reg of costos) {       
            
            if(reg.cultivo == cultivo.replace(' ','')){
              
              datos.costos.lote.push(Number(reg.costo));
              datos.costos.total.push(reg.costo * lote.has);

            }
          
          }

        }        
        
        let hasInvernales =  (datos.has.invernales.length > 0) ? datos.has.invernales.reduce((acc,cur)=> acc + cur) : 0
        let hasEstivales =  (datos.has.estivales.length > 0) ? datos.has.estivales.reduce((acc,cur)=> acc + cur) : 0

        let hasCobertura = 0  
        if(datos.has.cobertura.length > 0){
            for(let cobertura of datos.has.cobertura) hasCobertura+= cobertura.has
        }
          
        let ratio = (hasInvernales + hasCobertura) / hasEstivales 


        // RENDER NUMERO CAMPAÑA
        let campania = `${costos[0].campania1}/${costos[0].campania2}`

        document.getElementById('campania').innerText = campania


        // HAS -> INV- EST- COB
        document.getElementById(`hasInvPlanificacion${props.idInfo}`).innerText = hasInvernales
        document.getElementById(`hasCobPlanificacion${props.idInfo}`).innerText = hasCobertura
        document.getElementById(`hasEstPlanificacion${props.idInfo}`).innerText = hasEstivales
        // RATIO-> INV+COB / EST
        document.getElementById(`ratioPlanificacion${props.idInfo}`).innerText = ratio.toFixed(2);
        

        // HAS-> TRIGO-COB-CAR-REST
        document.getElementById(`hasTrigoPlanificacion${props.idInfo}`).innerText = (datos.has.trigo.length > 0) ? datos.has.trigo.reduce((acc,cur)=> acc + cur) : 0;
        document.getElementById(`hasCarinataPlanificacion${props.idInfo}`).innerText = (datos.has.carinata.length > 0) ? datos.has.carinata.reduce((acc,cur)=> acc + cur) : 0;
        
        let totalHasResto = 0
        for(let resto of datos.has.resto) totalHasResto+= resto.has
        document.getElementById(`hasRestoPlanificacion${props.idInfo}`).innerText = totalHasResto
        
        
        let totalHasCobertura = 0
        for(let cobertura of datos.has.cobertura) totalHasCobertura+= cobertura.has
        document.getElementById(`hasCoberturaPlanificacion${props.idInfo}`).innerText = totalHasCobertura
        
        // $->TRIGO-COB-CAR-REST
        document.getElementById(`totalCostoTrigoPlanificacion${props.idInfo}`).innerText = datos.costos.trigo.toLocaleString('de-DE')
        
        document.getElementById(`totalCostoCarinataPlanificacion${props.idInfo}`).innerText = datos.costos.carinata.toLocaleString('de-DE')
        
        let totalCostoCoberturaPlanificacion = datos.costos.cobertura.reduce((acc,cur)=> acc + cur)

        document.getElementById(`totalCostoCoberturaPlanificacion${props.idInfo}`).innerText = (datos.costos.cobertura.length > 0) ? totalCostoCoberturaPlanificacion.toLocaleString('de-DE') : 0;

        let costoHasPlanificacion = totalCostoCoberturaPlanificacion / totalHasCobertura
        
        document.getElementById(`costoCoberturaPlanificacionHas${props.idInfo}`).innerText = costoHasPlanificacion.toFixed(2)

        document.getElementById(`totalCostoRestoPlanificacion${props.idInfo}`).innerText = (datos.costos.resto.length > 0) ? (datos.costos.resto.reduce((acc,cur)=> acc + cur)).toLocaleString('de-DE') : 0;
 
        // TOTAL ->HAS - COSTO
        // document.getElementById(`totalHasPlanificadas${props.idInfo}`).innerText = datos.has.lote.reduce((acc,cur)=> acc + cur)
        document.getElementById(`totalHasPlanificadas${props.idInfo}`).innerText =  datos.has.total
        
        document.getElementById(`totalInversionPlanificada${props.idInfo}`).innerText = (datos.costos.total.reduce((acc,cur)=> acc + cur)).toLocaleString('de-DE')        
        
        let configPlanificacion = {
            type: 'bar',
            data: {
              labels: datos.label,
              datasets: [
                {
                  type: 'line',
                  label: 'Inversión U$D',
                  borderColor: window.chartColors.red,
                  fill:false,
                  yAxisID: 'A',
                  data: datos.costos.lote
                }
                ,
                {
                  label: 'Has.',
                  type: 'bar',
                  backgroundColor: window.chartColors.green,
                  yAxisID: 'B',
                  data: datos.has.lote,
                  borderColor: 'white',
                  borderWidth: 2
                }
              ]
            },
            options: {
              scaleShowValues: true,
              scales: {
                xAxes: [{
                  display:true,
                  ticks: {
                    autoSkip: false
                  }
                }],
                yAxes: [{
                  id: 'A',
                  type: 'linear',
                  position: 'left',
                
                }, {
                  id: 'B',
                  type: 'linear',
                  position: 'right',
                }]
              },
              plugins:{
                labels:{                  
                    render:'value',
                }
              },
              legend:{
                labels: {
                      boxWidth: 5
                }
              }
            }
        }
                
        generarGraficoBar(props.idGrafico,configPlanificacion,'noOption');
        
  
      })
      .catch(err=>console.log(err))
  
    }else{
    }

  })
  .catch( err=>console.log(err))

}

const cargarInfoEjecucion = (props)=>{

  // Obtener DATA
  
  let url = 'ajax/agro.ajax.php'
  
  let data = new FormData()
  data.append('accion','mostrarData')
  data.append('campania1',props.campania1)
  data.append('campania2',props.campania2)
  data.append('seccion','ejecucion')
  data.append('campo',props.campo)

  fetch(url,{
      method:'post',
      body:data
  }).then(resp=>resp.json())
  .then(respuesta=>{
    
    if(respuesta.length == 0)
      return

    
    let datos = {
      'label': [],
      'costos':{
        'lote': [],
        'trigo':[],
        'carinata':[],
        'cobertura':[],
        'resto':[],
        'total':[]
      },
      'has':{
        'lote': [],
        'invernales': [],
        'cobertura': [],
        'estivales': [],
        'trigo':[],
        'carinata':[],
        'resto':[],
        'total':0
      },
    }  
    respuesta.forEach(element => {

      if(document.getElementById('campania').innerText == ''){

        document.getElementById('campania').innerText = element.campania1 + '/' + element.campania2

      }

      if(element.fina != undefined && element.fina != '' && element.fina != null){
                
        if(cobertura.find(cultivo => cultivo == element.fina)){

          datos.has.cobertura.push(element.has)
          datos.costos.cobertura.push(element.has * element.costoFina)


        }else{

          datos.has.invernales.push(element.has)
          datos.label.push(`${element.lote} / ${element.fina}`)
          datos.has.lote.push(element.has)
          datos.costos.lote.push(element.costoFina)

        }
          
        if(element.fina == 'trigo'){

          datos.has.trigo.push(element.has)
          datos.costos.trigo.push(element.has * element.costoFina)

        }
        
        if(element.fina == 'carinata'){
          
          datos.has.carinata.push(element.has)
          datos.costos.carinata.push(element.has * element.costoFina)

        }
        
        if(element.fina != 'carinata' || element.fina != 'trigo'){

          datos.has.resto.push(element.has)
          datos.costos.resto.push(element.has * element.costoFina)

        }

      }
     
      if(element.gruesa != undefined && element.gruesa != '' && element.gruesa != null){
                
        if(cobertura.find(cultivo => cultivo == element.gruesa)){

          datos.has.cobertura.push(element.has)
          datos.costos.cobertura.push(element.has * element.costoGruesa)


        }else{

          datos.has.estivales.push(element.has)
          datos.label.push(`${element.lote} / ${element.gruesa}`)
          datos.has.lote.push(element.has)
          datos.costos.lote.push(element.costoGruesa)
        
        }
          
        if(element.gruesa == 'trigo'){

          datos.has.trigo.push(element.has)
          datos.costos.trigo.push(element.has * element.costoGruesa)

        }
        
        if(element.gruesa == 'carinata'){
          
          datos.has.carinata.push(element.has)
          datos.costos.carinata.push(element.has * element.costoGruesa)

        }
        
        if(element.gruesa != 'carinata' || element.gruesa != 'trigo'){

          datos.has.resto.push(element.has)
          datos.costos.resto.push(element.has * element.costoGruesa)

        }

      }

    });

    let hasInvernales = (datos.has.invernales.length > 0) ? datos.has.invernales.reduce((acc,cur)=> Number(acc) + Number(cur))
    
     : 0

    let hasCobertura = (datos.has.cobertura.length > 0) ? datos.has.cobertura.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    let hasEstivales = (datos.has.estivales.length > 0) ? datos.has.estivales.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    // HAS INFO
    document.getElementById(`hasInvEjecucion${props.idInfo}`).innerText = hasInvernales
    
    document.getElementById(`hasCobEjecucion${props.idInfo}`).innerText = hasCobertura
    
    document.getElementById(`hasEstEjecucion${props.idInfo}`).innerText = hasEstivales

    // CAJAS HAS
    document.getElementById(`hasTrigoEjecucion${props.idInfo}`).innerText = (datos.has.trigo.length > 0) ? datos.has.trigo.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    document.getElementById(`hasCoberturaEjecucion${props.idInfo}`).innerText = (datos.has.cobertura.length > 0) ? datos.has.cobertura.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    
    document.getElementById(`hasCarinataEjecucion${props.idInfo}`).innerText = (datos.has.carinata.length > 0) ? datos.has.carinata.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    document.getElementById(`hasRestoEjecucion${props.idInfo}`).innerText = (datos.has.resto.length > 0) ? datos.has.resto.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0


    // CAJAS COSTO

    let costosTrigo = (datos.has.trigo.length > 0) ? datos.costos.trigo.reduce((acc,cur)=> acc + Number(cur)) : 0

    let costosCobertura = (datos.has.cobertura.length > 0) ? datos.costos.cobertura.reduce((acc,cur)=> acc + Number(cur)) : 0
    
    let costosCarinata = (datos.has.carinata.length > 0) ? datos.costos.carinata.reduce((acc,cur)=> acc + Number(cur)) : 0
    
    let costosResto = (datos.has.resto.length > 0) ? datos.costos.resto.reduce((acc,cur)=> acc + Number(cur)) : 0


    document.getElementById(`totalCostoTrigoEjecucion${props.idInfo}`).innerText = costosTrigo.toLocaleString('de-DE') 

    document.getElementById(`totalCostoCoberturaEjecucion${props.idInfo}`).innerText = costosCobertura.toLocaleString('de-DE') 
    
    document.getElementById(`totalCostoCarinataEjecucion${props.idInfo}`).innerText = costosCarinata.toLocaleString('de-DE') 

    document.getElementById(`totalCostoRestoEjecucion${props.idInfo}`).innerText = costosResto.toLocaleString('de-DE') 
    
    // TOTALES

    document.getElementById(`totalHasEjecucion${props.idInfo}`).innerText = (Number(hasInvernales) + Number(hasCobertura) + Number(hasEstivales))

    document.getElementById(`totalInversionEjecucion${props.idInfo}`).innerText = (costosTrigo + costosCobertura + costosCarinata + costosResto).toLocaleString('de-DE') 

    let ratio = (hasInvernales + hasCobertura) / hasEstivales || ''

    document.getElementById(`ratioEjecucion${props.idInfo}`).innerText = ratio.toFixed(2)

    let configPlanificacion = {
        type: 'bar',
        data: {
          labels: datos.label,
          datasets: [
            {
              type: 'line',
              label: 'Inversión U$D',
              borderColor: window.chartColors.red,
              fill:false,
              yAxisID: 'A',
              data: datos.costos.lote
            }
            ,
            {
              label: 'Has.',
              type: 'bar',
              backgroundColor: window.chartColors.green,
              yAxisID: 'B',
              data: datos.has.lote,
              borderColor: 'white',
              borderWidth: 2
            }
          ]
        },
        options: {
          scaleShowValues: true,
          scales: {
            xAxes: [{
              display:true,
              ticks: {
                autoSkip: false
              }
            }],
            yAxes: [{
              id: 'A',
              type: 'linear',
              position: 'left',
            
            }, {
              id: 'B',
              type: 'linear',
              position: 'right',
            }]
          },
          plugins:{
            labels:{                  
                render:'value',
            }
          },
          legend:{
            labels: {
                  boxWidth: 5
            }
          }
        }
    }
            
    generarGraficoBar(props.idGrafico,configPlanificacion,'noOption');
  

  })
  .catch( err=>console.log(err))

}

const eliminarArchivoCampo = (campo,seccion,campania1,campania2)=>{

  swal({
    title: `¿Está seguro de borrar los datos del campo ${campo} de la seccion ${seccion}?`,
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar datos!'
  }).then(respuesta=>{

    if(respuesta.value){

        window.location = `index.php?ruta=agro/agro&campo=${campo}&tabla=${seccion}&campania1=${campania1}&campania2=${campania2}`;

    }

})
  
}

const mostrarInfoPlanificacion = (campania)=>{

  let url = 'ajax/agro.ajax.php'
  let dataInfo = new FormData()
  dataInfo.append('accion','mostrarInfo')
  dataInfo.append('campania',campania)
  dataInfo.append('seccion','info_planificacion')
  
  fetch(url,{
      method:'post',
      body:dataInfo
    }).then(resp=>resp.json())
    .then(respuesta=>{

      if(respuesta[0].cerrada == 1){
        document.getElementById('btnCerrarPlanificacion').style.display = 'none'
        document.getElementById('btnEditarCosto').style.display = 'none'

        setTimeout(() => {
          let inputCostos = document.querySelectorAll('.costosPlanificacion')
          inputCostos.forEach(element => {
            element.setAttribute('readOnly','readOnly')
          });
        }, 500);

        let btnsEliminar = document.querySelectorAll('.eliminarArchivoAgro')
        btnsEliminar.forEach(el => {
          el.style.display = 'none'
        })

      }else{

        document.getElementById('btnCerrarPlanificacion').addEventListener('click',()=>{

          swal({
            title: '¿Está seguro de cerrar la planificación?',
            text: "¡Si no lo está puede cancelar la acción!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, cerrar Planificación'
          }).then(function(result){
       
            if(result.value){

              let dataUpdate = new FormData()
              dataUpdate.append('accion','cerrarPlanifiacion')
              dataUpdate.append('campania',campania)
              dataUpdate.append('seccion','info_planificacion')
              
              fetch(url,{
                  method:'post',
                  body:dataUpdate
                }).then(res=>res.json())
                .then(close=>{

                  if(close == 'ok'){
                    window.location = "index.php?ruta=agro/agro";
                  }else{
                    swal({
                      type: "error",
                      title: "Hubo un error al cerrar la campaña.",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      })
                  }

                })         
                .catch(err=>console.log(err))

            }
       
          })

        })

      }



    })
    .catch(err=>{
      console.log(err)
    })

}

if(campania){

  mostrarInfoPlanificacion(campania)

  // PLANIFICACION
  campania = campania.split('/')

  let props = {
    campo: 'LA BETY',
    idGrafico: 'graficoPlanifiacionBety',
    idInfo:'Bety',
    campania1: campania[0],
    campania2: campania[1]
  }

  cargarInfoPlanificacion(props)

  props = {
    campo: 'EL PICHI',
    idGrafico: 'graficoPlanifiacionPichi',
    idInfo:'Pichi',
    campania1: campania[0],
    campania2: campania[1]
  }

  cargarInfoPlanificacion(props)

  // EJECUCION

  props = {
    campo: 'LA BETY',
    idGrafico: 'graficoEjecucionBety',
    idInfo:'Bety',
    campania1: campania[0],
    campania2: campania[1]
  }

  cargarInfoEjecucion(props)

  props = {
    campo: 'EL PICHI',
    idGrafico: 'graficoEjecucionPichi',
    idInfo:'Pichi',
    campania1: campania[0],
    campania2: campania[1]
  }

  cargarInfoEjecucion(props)

}

const btnCostosPlanificacion = document.getElementById('btnCostosPlanificacion')

setTimeout(() => {
  
  if(btnCostosPlanificacion != null){
    
    let campania = document.getElementById('campania').innerText.split('/')
    
    let [campania1,campania2] = campania

    let url = 'ajax/agro.ajax.php'
  
    let data = new FormData()
    data.append('accion','mostrarCostos')
    data.append('cultivo','')
    data.append('campania1',campania1)
    data.append('campania2',campania2)
    data.append('seccion','planificacion')
  
    fetch(url,{
      method:'post',
      body:data
    }).then(resp => resp.json())
    .then(respuesta=>{
      
      document.getElementById('tituloCostoPlanifiacion').innerText = 'Costos Planificación'

      let inputs = document.createDocumentFragment()
      
      let inputCampania1 = document.createElement('INPUT')
      let inputCampania2 = document.createElement('INPUT')
      inputCampania1.setAttribute('name','campania1')      
      inputCampania2.setAttribute('name','campania2')      
      inputCampania1.setAttribute('type','hidden')      
      inputCampania2.setAttribute('type','hidden')     
      inputCampania1.setAttribute('value',campania1)      
      inputCampania2.setAttribute('value',campania2)    
       
      inputs.appendChild(inputCampania1)
      inputs.appendChild(inputCampania2)

      respuesta.map(reg=>{

        let row = document.createElement('DIV')
        let label = row.cloneNode(true)
        let inputDiv = row.cloneNode(true)
        let input = document.createElement('INPUT')

        row.setAttribute('class','row')
        row.setAttribute('style','margin-bottom:5px;')
        
        label.setAttribute('class','col-md-7')
        
        inputDiv.setAttribute('class','col-md-5')
        input.setAttribute('class','form-control costosPlanificacion')
        input.setAttribute('type','number')
        input.setAttribute('step','0.01')
        input.setAttribute('name',`${reg.cultivo}Costo`)
        input.setAttribute('id',`${reg.cultivo}Costo`)
        input.setAttribute('required','required')
        input.setAttribute('value', reg.costo)
        
        let regex = /(\d+)/g
        
        let cultivoNumerico = reg.cultivo.match(regex)
            
        let cultivo = reg.cultivo

        if(cultivoNumerico != null){

            let index = reg.cultivo.indexOf(cultivoNumerico[0])

            cultivo = reg.cultivo.split('')
            cultivo.splice(index, 0, ' ')
            cultivo = cultivo.join('')
          
        }
                
        label.innerText = capitalizarPrimeraLetra(cultivo)        

        inputDiv.appendChild(input)
        row.appendChild(label)
        row.appendChild(inputDiv)

        inputs.appendChild(row)

      })
      
      document.getElementById('formCostosPlanificacion').appendChild(inputs)
      
    })
    .catch(er=>console.log(er))
  
  }

  // ELIMINAR DATOS PLANIFICACION⁄
  document.querySelectorAll('.eliminarArchivoAgro').forEach(btnEliminar => {

    btnEliminar.addEventListener('click',()=>{

      let campo = btnEliminar.getAttribute('campo')    
      let seccion = btnEliminar.getAttribute('seccion')
      let [campania1,campania2] = document.getElementById('campania').innerText.split('/')

      eliminarArchivoCampo(campo,seccion,campania1,campania2)
    
    })
    
  });

}, 200);


const btnMostrarCampania = document.getElementById('btnMostrarCampania')

btnMostrarCampania.addEventListener('click',(e)=>{
  e.preventDefault()
  let campaniaAgro = document.getElementById('campaniaAgro').value
  localStorage.setItem('campaniaAgro',campaniaAgro)
  window.location = 'index.php?ruta=agro/agro'

})



