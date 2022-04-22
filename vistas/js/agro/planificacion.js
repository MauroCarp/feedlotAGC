const cargarGraficoPlanificacion = (props)=>{

  // Obtener DATA
  
  let url = 'ajax/agro.ajax.php'
  
  let data = new FormData()
  data.append('accion','mostrarDataPlanificacion')
  data.append('campania1',props.campania2)
  data.append('campania2',props.campania1)
  data.append('seccion','planificacion')
  data.append('campo',props.campo)

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
          'resto':[]
        },
        'has':{
          'lote': [],
          'invernales': [],
          'estivales': [],
          'trigo':[],
          'carinata':[],
          'resto':[]

        },
      }

      respuesta.forEach(registro => {
  
        // DATA PARA GRAFICOS          
          datos.label.push(`${registro.lote} / ${capitalizarPrimeraLetra(registro.planificado)}`)

          datos.has.lote.push(Number(registro.has))
        
        // DATA PARA INFO
          if(registro.tipoCultivo == 'Invernal' && registro.tipoCultivo != '')
            datos.has.invernales.push(Number(registro.has))
          
          if(registro.tipoCultivo == 'Estival' && registro.tipoCultivo != '')
            datos.has.estivales.push(Number(registro.has))
            
            if(registro.planificado == 'trigo')
              datos.has.trigo.push(Number(registro.has))
            
        
            if(registro.planificado == 'carinata')
              datos.has.carinata.push(Number(registro.has))
              
            if(registro.planificado != 'trigo' && registro.planificado != 'carinata')
              datos.has.resto.push(Number(registro.has))
            
      });

      console.log(datos)
      return
      let labels = []
      let has = []
      let hasInvernales = []
      let hasEstivales = []
      let hasCultivos = {}

      respuesta.forEach(reg => {
        
        labels.push(`${reg.lote} / ${capitalizarPrimeraLetra(reg.planificado)}`)

        has.push(reg.has)

        if(reg.tipocultivo == 'Invernal'){

          hasInvernales.push(reg.has)

        }else if(reg.tipocultivo == 'Estival'){

          hasEstivales.push(reg.has)

        }
        
        if(reg.planificado == 'trigo')
          hasCultivos['trigo'] = Number(reg.has)


        if(reg.planificado == 'carinata')
        hasCultivos['carinata'] = Number(reg.has)

        if(reg.planificado != 'trigo' && reg.planificado != 'carinata')
          hasCultivos[`${reg.planificado}`] = Number(reg.has)

      });      
            
      let data = new FormData()
      data.append('accion','mostrarCostos')
      data.append('campania1',respuesta[0]?.campania1)
      data.append('campania2',respuesta[0]?.campania2)
      data.append('seccion','planificacion')
    
      fetch(url,{
        method:'post',
        body:data
      }).then(res=>res.json())
      .then(costos=>{

        let totales ={
          'trigo':{
            'has': (hasTrigo.length > 0) ? hasTrigo.reduce((accumulator, curr) => Number(accumulator) + Number(curr)) : 0,
            'costo':0
          },
          'carinata':{
            'has': (hasCarinata.length > 0) ? hasCarinata.reduce((accumulator, curr) => Number(accumulator) + Number(curr)) : 0,  
            'costo':0
          },
          'resto':{
            'has': (hasResto.length > 0) ? hasResto.reduce((accumulator, curr) => Number(accumulator) + Number(curr)) : 0,
          }
        }

        let costoTotal = []

        for (const reg of respuesta) {
          
          let cultivo = (reg.planificado == 'soja') ? 'soja 1era' : reg.planificado
    
          let has = reg.has

          for (const costo of costos) {
            
            if(costo.cultivo == 'trigo')
              totales.trigo.costo = totales.trigo.has * costo.costo;
              
            if(costo.cultivo == 'carinata')
              totales.carinata.costo = totales.carinata.has * costo.costo;
            
            if(costo.cultivo != 'carinata' && costo.cultivo != 'trigo')     {
            

            }




              if (costo.cultivo == cultivo) {
                  
                costoTotal.push(costo.costo * has)
      
              }

          }         
            

    
          
            
        }
        console.log(totales);
        
    return        
        document.getElementById('hasInvPlanificacionlaBety').innerText = '';

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
    
      generarGraficoBar(props.idGrafico,configPlanificacion,'noOption');
      
  
    })
    .catch(err=>console.log(err))
  
  }

  })
  .catch( err=>console.log(err))

}

let campania = getQueryVariable('campania')

if(campania){

  let props = {
    campo: 'LA BETY',
    idGrafico: 'graficoPlanifiacionBety',
    campania
  }

  cargarGraficoPlanificacion(props)

  props = {
    campo: 'EL PICHI',
    idGrafico: 'graficoPlanifiacionPichi',
    campania
  }

  cargarGraficoPlanificacion(props)

}else{
  
  let props = {
    campo: 'LA BETY',
    idGrafico: 'graficoPlanifiacionBety',
    campania: ''
  }

  cargarGraficoPlanificacion(props)

  props = {
    campo: 'EL PICHI',
    idGrafico: 'graficoPlanifiacionPichi',
    campania: ''
  }

  cargarGraficoPlanificacion(props)

}







