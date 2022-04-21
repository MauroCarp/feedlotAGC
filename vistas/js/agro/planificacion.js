// GRAFICO CAMPO BETY

// Obtener DATA

let url = 'ajax/agro.ajax.php'

// let data = `accion=mostrarDataPlanificacion&campania=null&seccion=planificacion&campo=LA BETY`

// $.ajax({
//     method:'post',
//     url,
//     data,
//     success:(resp)=>{

//         console.log(resp)
        
//     }
// })

let data = new FormData()
data.append('accion','mostrarDataPlanificacion')
data.append('campania','')
data.append('seccion','planificacion')
data.append('campo','LA BETY')

fetch(url,{
    method:'post',
    body:data
}).then(resp=>resp.json())
.then(respuesta=>{
  
  let labels = respuesta.map(reg=>{
    
    return  `${reg.lote} / ${capitalizarPrimeraLetra(reg.planificado)}`

  })

  let has = respuesta.map(reg=>{

    return reg.has

  })

  let data = new FormData()
  data.append('accion','mostrarCostos')
  data.append('campania',respuesta[0].campania)
  data.append('seccion','planificacion')

  fetch(url,{
    method:'post',
    body:data
  }).then(res=>res.json())
  .then(costos=>{
    
    let costoTotal = []

    for (const reg of respuesta) {
      
      let cultivo = (reg.planificado == 'soja') ? 'soja 1era' : reg.planificado

      let has = reg.has

      for (const costo of costos) {
        
        if (costo.cultivo == cultivo) {
            
          costoTotal.push(costo.costo * has)

        }

      }
        
    }

    let configPlanificacion = {
      type: 'bar',
      data: {
        labels,
        datasets: [
          {
            type: 'line',
            label: 'Inversión U$D',
            borderColor: window.chartColors.red,
            fill:false,
            yAxisID: 'A',
            data: costoTotal
          }
          ,
          {
            label: 'Has.',
            type: 'bar',
            backgroundColor: window.chartColors.green,
            yAxisID: 'B',
            data: has,
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
            render: 'value'
          }
        },
        legend:{
          labels: {
                boxWidth: 5
          }
        }
      }
   }

   generarGraficoBar('graficoPlanifiacionBety',configPlanificacion,'noOption');

  })
  .catch(err=>console.log(err))
    
})
.catch( err=>console.log(err))

  // Ejecutar el Grafico

