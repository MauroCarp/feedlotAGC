

const tipoCultivo = (cultivo)=>{

  switch (cultivo) {
      case 'trigo':
      case 'carinata':
      case 'vicia':
      case 'triticale':
      case 'vicia-triticale':
      case 'triticale-vicia':
      case 'avena':
          $tipo = 'Invernal';
          break;

      case 'maiz':
      case 'soja':
      case 'soja1ra':
      case 'soja1era':
      case 'soja2da':
      case 'maiz1ra':
      case 'maiz1era':
      case 'maiz2da':
          $tipo = 'Estival';
          break;
  }

  return $tipo;

}

let chartEjecucionBety, chartEjecucionPichi = undefined
console.log(chartEjecucionBety)
console.log(chartEjecucionPichi)

const cargarInfoEjecucion = (props)=>{
console.log(props)
  // Obtener DATA
  let url = 'ajax/agro.ajax.php'
  
  let data = new FormData()
  data.append('accion','mostrarData')
  data.append('campania1',props.campania1)
  data.append('campania2',props.campania2)
  data.append('seccion','ejecucion')
  data.append('etapa',props.etapa)

  fetch(url,{
      method:'post',
      body:data
  }).then(resp=>resp.json())
  .then(respuesta=>{

    if(respuesta.length == 0)
      return
    
    let dataBety = {
      'label': [],
      'costos':{
        'lote': [],
        'trigo':[],
        'carinata':[],
        'cobertura':[],
        'resto':[],
        'total':0
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

    let dataPichi = JSON.parse(JSON.stringify(dataBety))


    let dataCampos = {'LA BETY':dataBety,'EL PICHI':dataPichi}

    for (const element of respuesta) {

      dataCampos[element.campo].label.push(`${element.lote} / ${capitalizarPrimeraLetra(element.cultivo)}`)
      dataCampos[element.campo].has.lote.push(element.has)
      dataCampos[element.campo].costos.lote.push((parseInt(element.costoActividad) + parseInt(element.costoActividad2)))
      dataCampos[element.campo].has.total += parseInt(element.has)
      dataCampos[element.campo].costos.total += parseInt(element.has)

      if(tipoCultivo(element.cultivo) == 'Invernal'){}
        dataCampos[element.campo].has.invernales.push(element.has)

      if(tipoCultivo(element.cultivo) == 'Estival')
        dataCampos[element.campo].has.estivales.push(element.has)
        
      if(element.cultivo == 'trigo'){
        dataCampos[element.campo].has.trigo.push(element.has)
        dataCampos[element.campo].costos.trigo.push(parseInt(element.costoActividad) + parseInt(element.costoActividad2))
      }

      if(cobertura.find(e => e == element.cultivo) != undefined){
        dataCampos[element.campo].has.cobertura.push(element.has)  
        dataCampos[element.campo].costos.cobertura.push(parseInt(element.costoActividad) + parseInt(element.costoActividad2))
      }
      
      if(element.cultivo == 'carinata'){
        dataCampos[element.campo].has.carinata.push(element.has)  
        dataCampos[element.campo].costos.carinata.push(parseInt(element.costoActividad) + parseInt(element.costoActividad2))
      }

      if(cobertura.find(e => e == element.cultivo) == undefined && element.cultivo != 'trigo' && element.cultivo != 'carinata'){
        dataCampos[element.campo].has.resto.push(element.has)  
        dataCampos[element.campo].costos.resto.push(parseInt(element.costoActividad) + parseInt(element.costoActividad2))
      }

    }
    
    let hasInvernalesBety = (dataCampos['LA BETY'].has.invernales.length > 0) ? dataCampos['LA BETY'].has.invernales.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    let hasInvernalesPichi = (dataCampos['EL PICHI'].has.invernales.length > 0) ? dataCampos['EL PICHI'].has.invernales.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    let hasCoberturaBety = (dataCampos['LA BETY'].has.cobertura.length > 0) ? dataCampos['LA BETY'].has.cobertura.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    let hasCoberturaPichi = (dataCampos['EL PICHI'].has.cobertura.length > 0) ? dataCampos['EL PICHI'].has.cobertura.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    let hasEstivalesBety = (dataCampos['LA BETY'].has.estivales.length > 0) ? dataCampos['LA BETY'].has.estivales.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    let hasEstivalesPichi = (dataCampos['EL PICHI'].has.estivales.length > 0) ? dataCampos['EL PICHI'].has.estivales.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    // HAS INFO
    document.getElementById(`hasInvEjecucionBety`).innerText = hasInvernalesBety
    document.getElementById(`hasInvEjecucionPichi`).innerText = hasInvernalesPichi
    
    document.getElementById(`hasCobEjecucionBety`).innerText = hasCoberturaBety
    document.getElementById(`hasCobEjecucionPichi`).innerText = hasCoberturaPichi
    
    document.getElementById(`hasEstEjecucionBety`).innerText = hasEstivalesBety
    document.getElementById(`hasEstEjecucionPichi`).innerText = hasEstivalesPichi

    // CAJAS HAS
    document.getElementById(`hasTrigoEjecucionBety`).innerText = (dataCampos['LA BETY'].has.trigo.length > 0) ? dataCampos['LA BETY'].has.trigo.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    document.getElementById(`hasTrigoEjecucionPichi`).innerText = (dataCampos['EL PICHI'].has.trigo.length > 0) ? dataCampos['EL PICHI'].has.trigo.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    document.getElementById(`hasCoberturaEjecucionBety`).innerText = (dataCampos['LA BETY'].has.cobertura.length > 0) ? dataCampos['LA BETY'].has.cobertura.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    document.getElementById(`hasCoberturaEjecucionPichi`).innerText = (dataCampos['EL PICHI'].has.cobertura.length > 0) ? dataCampos['EL PICHI'].has.cobertura.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    
    document.getElementById(`hasCarinataEjecucionBety`).innerText = (dataCampos['LA BETY'].has.carinata.length > 0) ? dataCampos['LA BETY'].has.carinata.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    document.getElementById(`hasCarinataEjecucionPichi`).innerText = (dataCampos['EL PICHI'].has.carinata.length > 0) ? dataCampos['EL PICHI'].has.carinata.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0

    document.getElementById(`hasRestoEjecucionBety`).innerText = (dataCampos['LA BETY'].has.resto.length > 0) ? dataCampos['LA BETY'].has.resto.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0
    document.getElementById(`hasRestoEjecucionPichi`).innerText = (dataCampos['EL PICHI'].has.resto.length > 0) ? dataCampos['EL PICHI'].has.resto.reduce((acc,cur)=> Number(acc) + Number(cur)) : 0


    // CAJAS COSTO

    let costosTrigoBety = (dataCampos['LA BETY'].has.trigo.length > 0) ? dataCampos['LA BETY'].costos.trigo.reduce((acc,cur)=> acc + Number(cur)) : 0
    let costosTrigoPichi = (dataCampos['EL PICHI'].has.trigo.length > 0) ? dataCampos['EL PICHI'].costos.trigo.reduce((acc,cur)=> acc + Number(cur)) : 0

    let costosCoberturaBety = (dataCampos['LA BETY'].has.cobertura.length > 0) ? dataCampos['LA BETY'].costos.cobertura.reduce((acc,cur)=> acc + Number(cur)) : 0
    let costosCoberturaPichi = (dataCampos['EL PICHI'].has.cobertura.length > 0) ? dataCampos['EL PICHI'].costos.cobertura.reduce((acc,cur)=> acc + Number(cur)) : 0
    
    let costosCarinataBety = (dataCampos['LA BETY'].has.carinata.length > 0) ? dataCampos['LA BETY'].costos.carinata.reduce((acc,cur)=> acc + Number(cur)) : 0
    let costosCarinataPichi = (dataCampos['EL PICHI'].has.carinata.length > 0) ? dataCampos['EL PICHI'].costos.carinata.reduce((acc,cur)=> acc + Number(cur)) : 0
    
    let costosRestoBety = (dataCampos['LA BETY'].has.resto.length > 0) ? dataCampos['LA BETY'].costos.resto.reduce((acc,cur)=> acc + Number(cur)) : 0
    let costosRestoPichi = (dataCampos['EL PICHI'].has.resto.length > 0) ? dataCampos['EL PICHI'].costos.resto.reduce((acc,cur)=> acc + Number(cur)) : 0


    document.getElementById(`totalCostoTrigoEjecucionBety`).innerText = costosTrigoBety.toLocaleString('de-DE') 
    document.getElementById(`totalCostoTrigoEjecucionPichi`).innerText = costosTrigoPichi.toLocaleString('de-DE') 

    document.getElementById(`totalCostoCoberturaEjecucionBety`).innerText = costosCoberturaBety.toLocaleString('de-DE') 
    document.getElementById(`totalCostoCoberturaEjecucionPichi`).innerText = costosCoberturaPichi.toLocaleString('de-DE') 
    
    document.getElementById(`totalCostoCarinataEjecucionBety`).innerText = costosCarinataBety.toLocaleString('de-DE') 
    document.getElementById(`totalCostoCarinataEjecucionPichi`).innerText = costosCarinataPichi.toLocaleString('de-DE') 

    document.getElementById(`totalCostoRestoEjecucionBety`).innerText = costosRestoBety.toLocaleString('de-DE') 
    document.getElementById(`totalCostoRestoEjecucionPichi`).innerText = costosRestoPichi.toLocaleString('de-DE') 
    
    // TOTALES

    document.getElementById(`totalHasEjecucionBety`).innerText = (Number(hasInvernalesBety) + Number(hasCoberturaBety) + Number(hasEstivalesBety))
    document.getElementById(`totalHasEjecucionPichi`).innerText = (Number(hasInvernalesPichi) + Number(hasCoberturaPichi) + Number(hasEstivalesPichi))

    document.getElementById(`totalInversionEjecucionBety`).innerText = (costosTrigoBety + costosCoberturaBety + costosCarinataBety + costosRestoBety).toLocaleString('de-DE') 
    document.getElementById(`totalInversionEjecucionPichi`).innerText = (costosTrigoPichi + costosCoberturaPichi + costosCarinataPichi + costosRestoPichi).toLocaleString('de-DE') 

    let ratioBety = (hasEstivalesBety > 0) ? ((hasInvernalesBety + hasCoberturaBety) / hasEstivalesBety).toFixed(2) : ''
    let ratioPichi = (hasEstivalesPichi > 0) ? ((hasInvernalesPichi + hasCoberturaPichi) / hasEstivalesPichi).toFixed(2) : ''

    document.getElementById(`ratioEjecucionBety`).innerText = ratioBety
    document.getElementById(`ratioEjecucionPichi`).innerText = ratioPichi

    let configEjecucionBety = {
        type: 'bar',
        data: {
          labels: dataCampos['LA BETY'].label,
          datasets: [
            {
              type: 'line',
              label: 'Inversión U$D',
              borderColor: window.chartColors.red,
              fill:false,
              yAxisID: 'A',
              data: dataCampos['LA BETY'].costos.lote
            }
            ,
            {
              label: 'Has.',
              type: 'bar',
              backgroundColor: window.chartColors.green,
              yAxisID: 'B',
              data: dataCampos['LA BETY'].has.lote,
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

    let configEjecucionPichi = JSON.parse(JSON.stringify(configEjecucionBety))
    configEjecucionPichi.data.labels = dataCampos['EL PICHI'].label
    configEjecucionPichi.data.datasets[0].data = dataCampos['EL PICHI'].costos.lote
    configEjecucionPichi.data.datasets[1].data = dataCampos['EL PICHI'].has.lote

    let graficoEjecucionBety = document.getElementById('graficoEjecucionBety').getContext('2d');
    
    let graficoEjecucionPichi = document.getElementById('graficoEjecucionPichi').getContext('2d');

    if(typeof(chartEjecucionBety) != 'undefined' || typeof(chartEjecucionPichi) != 'undefined') {
      chartEjecucionBety.clear();
      chartEjecucionBety.destroy();
      chartEjecucionPichi.clear();
      chartEjecucionPichi.destroy();
    }

      chartEjecucionPichi = new Chart(graficoEjecucionPichi, configEjecucionPichi)
      chartEjecucionBety = new Chart(graficoEjecucionBety, configEjecucionBety)

    })
  .catch( err=>console.log(err))

}

// ELIMINAR DATOS EJECUCION

 const btnEliminarEjecucion = document.getElementById('eliminarEjecucion')
 
 if(btnEliminarEjecucion != null){

 btnEliminarEjecucion.addEventListener('click',()=>{

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
  
}


const selectEtapaEjecucion = document.getElementById('etapaEjecucion')

if(selectEtapaEjecucion != null){
  selectEtapaEjecucion.addEventListener('change',()=>{
    let etapa = selectEtapaEjecucion.value
    console.log(etapa)
    props = {
      etapa,
      campania1: campania[0],
      campania2: campania[1]
    }

    // VACIAMOS GRAFICOS
    cargarInfoEjecucion(props)

  })
}