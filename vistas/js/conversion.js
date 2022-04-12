// GENERAR REPORTE
let btnGenerarReporte = document.getElementById('generarResumen')

btnGenerarReporte.addEventListener('click',()=>{

    let inputsPeriodos = document.getElementsByClassName('monthsConv')
 
    let periodos = []

    for (const iterator of inputsPeriodos) {

        periodos.push(iterator.value)
        
    }
    
    window.location = `index.php?ruta=resumenConversion&periodos=${periodos}`

});

// COMPARAR PERIODO
document.getElementById('periodoConv').value = monthValue

let contadorConv = 2;

let contenidoConv = '';

$('#compararConversion').click(()=>{

  contenidoConv = agregarPeriodo(contadorConv,'Conv');
  
  $('#btn-plusConv').before(contenidoConv);
  
  $('#btn-plusConv').before('<br>');
  
  $('#periodoConv' + contadorConv )[0].value = monthValue;
  
  contadorConv++;

});

// CARGAR CHARTS

let urlConversion = window.location.href;

if(URLactual.includes('resumenConversion')){ 
        
    let etapas = ['CC','RP','RC','T']

    let graficos = ['kgIng','kgEgr','kgProd','adpv','dias','conversion']

    const meses =['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    const mesesShort =['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

    const borderColors = ['rgb(255, 77, 77)','rgb(24, 220, 255)','rgb(255, 175, 64)','rgb(50, 255, 126)','rgb(255, 250, 101)','rgb(125, 95, 255)','rgb(209, 204, 192)','rgb(44, 44, 84)','rgb(189, 197, 129)','rgb(205, 97, 51)','rgb(204, 174, 98)','rgb(33, 140, 116)']

    const colors = ['rgba(255, 77, 77,0.5)','rgba(24, 220, 255,0.5)','rgba(255, 175, 64,0.5)','rgba(50, 255, 126,0.5)','rgba(255, 250, 101,0.5)','rgba(125, 95, 255,0.5)','rgba(209, 204, 192,0.5)','rgba(44, 44, 84,0.5)','rgba(189, 197, 129,0.5)','rgba(205, 97, 51,0.5)','rgba(204, 174, 98,0.5)','rgba(33, 140, 116,0.5)']

    let url = 'ajax/conversion.ajax.php'

    let periodos = getQueryVariable('periodos')

    let data = `accion=filtros&periodos=${periodos}`
    
    $.ajax({
        method:'post',
        url,
        data,
        success:(response)=>{
    
            let data = JSON.parse(response)

            // RECORRER LAS 4 ETAPAS

            for (const etapa of etapas) {
                
                // RECORRER LOS GRAFICOS Y GENERAR LA DATA DE CADA UNO
                // Y GRAFICARLOS
                
                for (const key in graficos) {

                    let contador = 0

                    let datos = data.map(reg=>{

                        let fecha = reg.periodo.split('-')
                        
                        mesIndex = Number(fecha[1])
                        
                        let mesLabel = `${mesesShort[mesIndex - 1]} ${fecha[0]}` 

                        let indexData = `${graficos[key]}${etapa}` 

                        if(graficos[key] == 'conversion')
                            indexData = `convMs${etapa}`
                        
                        let dataset = {'label':mesLabel,'backgroundColor':colors[contador],'borderColor':borderColors[contador],'borderWidth':1,'data':[reg[indexData]]}

                        contador ++
                        
                        return dataset
                
                    })
                

                    let configuracion = {
                        "type":"bar",
                        "data":{
                            "datasets":datos
                        },
                        "options":{
                            "responsive":true,
                            "legend":{
                                "position":"top",
                                "labels":{
                                    "boxWidth":5
                                }
                            },
                            "title":{
                                "display":false,
                                "text":graficos[key]
                            },
                            "plugins":{
                                "labels":{
                                    "render":"value"
                                }
                            },
                            "scales":{
                                "xAxes":[
                                    {"display":false}
                                ],
                                "yAxes":[
                                    {"ticks":{
                                        "suggestedMin":0,
                                    }}
                                ]
                            }
                        }
                    }
                    
                    generarGraficoBar(`${graficos[key]}Chart${etapa}`,configuracion,'noOption');

                }
               
            }
    
        }

    })

	periodos = periodos.split(',')

	anios = []

    for (const periodo of periodos) {
        
        anios.push(periodo.split('-')[0]);

    }
    
    anios = [...new Set(anios)]
		
	anios.join(',')
    
    data = `accion=anual&periodos=${anios}` 

    $.ajax({
        method:'post',
        url,
        data,
        success:(response)=>{

            let data = JSON.parse(response)
            
            console.table(data);
            
            // GENERAR EL ARRAY CON LOS AÑOS, CADA AÑO CON MESES Y LAS ETAPAS

            let dataAnios = {}
            
            for (const anio of anios) {
                
                let index = `'${anio}'`

                dataAnios[index] = {
                    '1':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '2':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '3':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '4':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '5':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '6':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '7':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '8':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '9':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '10':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '11':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }, 
                    '12':{
                        'CC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RP':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'RC':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        },
                        'T':{
                            'kgIng':'',
                            'kgEgr':'',
                            'kgProd':'',
                            'adpv':'',
                            'dias':'',
                            'conversion':'',
                        }
                    }
                }

            }
            
            // RECORRER LOS AÑOS SELECCIONADOS

            for (const anio of anios) {
            
            // RECORRER LAS 4 ETAPAS

                for (const etapa of etapas) {
        
                    // RECORRER LOS GRAFICOS Y GENERAR LA DATA DE CADA UNO
                    // Y GRAFICARLOS
                    
                    for (const key in graficos) {

                        
                        for (const reg of data) {
                            
                            let periodoSplit = reg.periodo.split('-')

                            let anioReg = `'${periodoSplit[0]}'`

                            let mesReg = Number(periodoSplit[1])

                            let indexValue = `${graficos[key]}${etapa}`
                            
                            if(graficos[key] == 'conversion')
                                indexValue = `convMs${etapa}`


                            dataAnios[anioReg][mesReg][etapa][graficos[key]] = reg[indexValue]
                            
                        }
                        

                        let contador = 0
                        
                        let datasets = []

                        for (const anio in dataAnios) {
                            

                            let stack = `'Stack ${contador}`
                            
                            let label = anio.replace("'","").replace("'","")
                            
                            let dataSetMeses = {
                                label,
                                backgroundColor: colors[contador],
                                stack,
                                data:[]
                            }

                            let dataValue = [];

                            for (const mes in dataAnios[anio]) {
                                
                                let value = (dataAnios[anio][mes][etapa][graficos[key]] != '') ? Number(dataAnios[anio][mes][etapa][graficos[key]]) : 0

                                dataValue.push(value)
                            
                            }
                            
                            dataSetMeses.data = dataValue

                            datasets.push(dataSetMeses)

                            contador++

                        }

                        let datos = {
                            labels: mesesShort,
                            datasets
                        }
                                      
                        let graphType = 'horizontalBar'
                        
                        if(graficos[key] == 'conversion'){
                            
                            graphType = 'bar'

                            datos.labels = mesesShort
                        
                        }

                        let configuracion = {
                            type: 'bar',
                            data: datos,
                            options: {
                                title: {
                                    display: false,
                                    text: 'Cabezas por Consignatario y Sexo'
                                },
                                tooltips: {
                                    mode: 'index',
                                    intersect: false
                                },
                                responsive: true,
                                scales: {
                                    xAxes: [{
                                        stacked: true,
                                        display:true,
                                    }],
                                    yAxes: [{
                                        stacked: true
                                    }]
                                },
                                plugins: {
                                    labels: {
                                    render: 'value'
                                    }
                                },
                                legend:{
                                    labels: {
                                        boxWidth: 5
                                    }
                                },
                                scaleShowValues: true,
                                scales: {
                                    xAxes: [{
                                    ticks: {
                                        autoSkip: false
                                    }
                                    }]
                                }
                                        }
                        };                        
                                                
                        generarGraficoBar(`${graficos[key]}Chart${etapa}Anual`,configuracion,'noOption');

                    
                    }

                }
        
            }
    
        }

    })

}

