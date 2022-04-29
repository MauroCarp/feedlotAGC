const cobertura = ['vicia','triticale','avena','cebada','vicia-triticale','cebadilla']

const cargarGraficoPlanificacion = (props)=>{

  // Obtener DATA
  
  let url = 'ajax/agro.ajax.php'
  
  let data = new FormData()
  data.append('accion','mostrarDataPlanificacion')
  data.append('campania1',props.campania1)
  data.append('campania2',props.campania2)
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

          if(cobertura.includes(registro.planificado) && registro.planificado != ''){
                          
              let cultivoHas = {
                'cultivo': registro.planificado,
                'has': Number(registro.has)
              }  

              datos.has.cobertura.push(cultivoHas)

          }
          
          if(!cobertura.includes(registro.planificado) && registro.planificado != 'trigo' && registro.planificado != 'carinata' && registro.planificado != ''){
            
            let cultivoHas = {
              'cultivo': registro.planificado,
              'has': Number(registro.has)
            }  
            
            datos.has.resto.push(cultivoHas)
            
          }
        
        }
        
        

      });
      
      let data = new FormData()
      data.append('accion','mostrarCostos')
      data.append('campania1',props.campania1)
      data.append('campania2',props.campania2)
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
        document.getElementById(`totalCostoCoberturaPlanificacion${props.idInfo}`).innerText = (datos.costos.cobertura.length > 0) ? (datos.costos.cobertura.reduce((acc,cur)=> acc + cur)).toLocaleString('de-DE') : 0;
        document.getElementById(`totalCostoRestoPlanificacion${props.idInfo}`).innerText = (datos.costos.resto.length > 0) ? (datos.costos.resto.reduce((acc,cur)=> acc + cur)).toLocaleString('de-DE') : 0;
 
        // TOTAL ->HAS - COSTO
        document.getElementById(`totalHasPlanificadas${props.idInfo}`).innerText = datos.has.lote.reduce((acc,cur)=> acc + cur)
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
  
    }

  })
  .catch( err=>console.log(err))

}

let campania = getQueryVariable('campania')

if(campania){
  
  campania = campania.split('/')

  let props = {
    campo: 'LA BETY',
    idGrafico: 'graficoPlanifiacionBety',
    idInfo:'Bety',
    campania1: campania[0],
    campania2: campania[1]
  }

  cargarGraficoPlanificacion(props)

  props = {
    campo: 'EL PICHI',
    idGrafico: 'graficoPlanifiacionPichi',
    idInfo:'Pichi',
    campania1: campania[0],
    campania2: campania[1]
  }

  cargarGraficoPlanificacion(props)

}else{
  
  let props = {
    campo: 'LA BETY',
    idGrafico: 'graficoPlanifiacionBety',
    idInfo:'Bety',
    campania1: '',
    campania2: ''
  }

  cargarGraficoPlanificacion(props)

  props = {
    campo: 'EL PICHI',
    idGrafico: 'graficoPlanifiacionPichi',
    idInfo:'Pichi',
    campania1: '',
    campania2: ''
  }

  cargarGraficoPlanificacion(props)

}







