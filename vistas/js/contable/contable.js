
    const generarColores = (cantidad,tipo)=>{

        let coloresBg = ['rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)','rgba(255, 159, 64, 0.2)','rgba(100, 255, 64, 0.2)'];

        let coloresBr = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)','rgba(100, 255, 64, 1)'];

        let colores = [];

        for (let index = 0; index < cantidad; index++) {

        if(tipo == 'bg'){
            
            colores.push(coloresBg[index])
            
        }else{
            
            colores.push(coloresBr[index]);
            
        }
        
        }

        return colores;

    }

    const formatearFecha = (fecha)=>{

        if(fecha){

            let fechaSplit = fecha.split('-')
            
            return `${fechaSplit[2]}-${fechaSplit[1]}-${fechaSplit[0]}`
        
        }else{

            return '-'
        
        }
    }

    const numberWithCommas = (num)=>{

        var parts = num.toString().split(".");
        
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        
        return parts.join(",");
    
    }

    const format = (number)=>{

      if(number > 1){

      
        let num = number.toString().replace(/\./g,'*');
              
        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
      
        num = num.split('').reverse().join('').replace(/^[\.]/,'');
      
        num = num.replace('*',',');

        return num

      }else{
        return number
      }
    }

    const generarGraficoBarSimple = (registros,divId,labels,tituloLabel)=>{

        let coloresBg = generarColores(registros.length,'bg');
                
        let coloresBr = generarColores(registros.length,'br');
                
        let ctx = document.getElementById(divId).getContext('2d');
      
        let myChart = new Chart(ctx, {
                                      type: 'bar',
                                      data: {
                                          labels: labels,
                                          datasets: [{
                                              label: tituloLabel,
                                              data: registros,
                                              backgroundColor: coloresBg,
                                              borderColor: coloresBr,
                                              borderWidth: 1
                                          }]
                                      },
                                      options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true,
                                                    callback: function(value, index, ticks) {
                                                        return  format(value);
                                                    }
                                                }
                                            }]
                                        },
                                        tooltips: {
                                          callbacks: {
                                            label: function(tooltipItem, data) {
                                                  return `$ ${tooltipItem.yLabel.toLocaleString('de-DE')}`
                                              }
                                          }
                                        },
                                        plugins: {
                                          labels: {
                                            // render: 'value'
                                            render: (val)=>{ return format(val.value);},

                                          },
                                          legend: {
                                            display: false,
                                          },
                                          tooltip: {
                                            callbacks: {
                                                label: function(context) {

                                                    let label = `$ ${context.dataset.label}`;

                                                    return label;
                                                }
                                            }
                                          }
                                        }
                                      }
                                    });   
      
        return myChart; 
      
    }

    const generarGraficoPieContable = (idDiv,data,label)=>{
        
        let colores = generarColores(data.length,'bg');

        let pieChart = document.getElementById(idDiv).getContext('2d');   

        let configuracion = {
            type: 'pie',
            data: {
              datasets: [{
                data: data,
                backgroundColor:colores,
                label: 'Porcentaje'
              }],
              labels: label
            },
            options: {
              responsive: true,
              title: {
                display: false,
              },
              scales: {
                yAxes: [{
                    ticks: {
                        callback: function(value, index, ticks) {
                            return  format(value);
                        }
                    }
                }]
              },
              legend: {
                labels: {
                    boxWidth: 5
                }
              }
        
            }
        };   

        let grafico = new Chart(pieChart, configuracion);
      
        return grafico;
      
    }

    const generarGraficoMultiBar = (divId,labels,dataset)=>{
  
      let ctx = document.getElementById(divId).getContext('2d');
     
      let myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                      labels  : labels,
                                      datasets: dataset
                                    },
                                    options: {
                                      tooltips: {
                                        callbacks: {
                                          label: function(tooltipItem, data) {
                                                return `$ ${tooltipItem.yLabel.toLocaleString('de-DE')}`
                                            }
                                        }
                                      },
                                      scales: {
                                        xAxes: [{
                                              gridLines: {
                                                  color: "rgba(0, 0, 0, 0)",
                                              }
                                          }],
                                          yAxes: [{
                                            ticks: {
                                                  beginAtZero: true,
                                                  callback: function(value, index, ticks) {
                                                      return  format(value);
                                                  }
                                              }
                                            }]
                                      
                                        },
                                        plugins: {
                                          labels: {

                                            render: (val)=>{ 
                                              if(divId != 'endeudamientoChart'){
                                                return format(val.value);
                                              }else{
                                                return '';
                                              }
                                            },
                                            // render: 'value',
                                          },
                                        }
                                    }
                                  });
      return myChart; 
    
    }

    const generarGraficoStackedGroup = (divId,labels,dataset)=>{
  
      let ctx = document.getElementById(divId).getContext('2d');
      
      let myChart = new Chart(ctx,
                                  {
                                    type: 'bar',
                                    data: dataset,
                                    options: {
                                      tooltips: {
                                        callbacks: {
                                          label: function(tooltipItem, data) {
                                                return `$ ${tooltipItem.yLabel.toLocaleString('de-DE')}`
                                            }
                                        }
                                      },
                                      interaction:{
                                        intersect:false
                                      },
                                      scales: {
                                        xAxes: [{
                                              gridLines: {
                                                  color: "rgba(0, 0, 0, 0)",
                                              }
                                        }],
                                        yAxes: [{
                                          ticks: {
                                                beginAtZero: true,
                                                callback: function(value, index, ticks) {
                                                    return  format(value);
                                                }
                                            }
                                        }],
                                        x:{
                                          stacked:true
                                        },
                                        y:{
                                          stacked:true
                                        }
                                      },
                                      plugins: {
                                        labels: {
                                          render: (val)=>{ 
                                            if(divId != 'ventasChart2'){
                                              return format(val.value);
                                            }else{
                                              return '';
                                            }
                                          }
                                          // render: 'value',
                                        },
                                      }
                                    }
                                  });
      return myChart; 



    
    }

    const getMonthData = (respuesta,dato)=>{

      let data = []

      for (const key in respuesta) {

        if(key < 6){
          if(respuesta.length > 1){

            if(respuesta[key].periodo == 'Jun'){
              data.push(Number(respuesta[key].graficos[dato]).toFixed(2))
            }else{

              if(dato == 'sueldos12Honorarios' && respuesta[key].periodo == 'Sep'){
                // console.log(respuesta[key].periodo);console.log(respuesta[key].graficos[dato]);console.log(respuesta[Number(key) + 1].graficos[dato])
                // console.log(respuesta[key].graficos[dato] - respuesta[Number(key) + 1].graficos[dato])
              } 
              data.push((respuesta[key].graficos[dato] - respuesta[Number(key) + 1].graficos[dato]).toFixed(2))
            }

          }else{
            data.push(Number(respuesta[key].graficos[dato]).toFixed(2))
          } 
        }

      }

      return data
      
    }
    
    const getMonthDataCajas = (respuesta,dato)=>{
      
      let data = []


        if(respuesta.length > 1){

          if(respuesta[0].periodo == 'Jun'){
            data.push(Number(respuesta[0].cajas[dato]).toFixed(2))
          }else{
            data.push((respuesta[0].cajas[dato] - respuesta[1].cajas[dato]).toFixed(2))
          }

        }else{
          data.push(Number(respuesta[0].cajas[dato]).toFixed(2))
        }

    

      return data
      
    }

    const btnGenerarReporte = document.getElementById('generarReporteContabilidad')

    if(btnGenerarReporte != null){
      btnGenerarReporte.addEventListener('click',function(){

        let periodo = document.querySelector('.periodoContable').value

        window.location = `index.php?ruta=contable/contable&periodo=${periodo}`

      })
    }
    
    let url = 'ajax/contable.ajax.php';

    let periodo = getQueryVariable('periodo')

    let periodoData = 'last'

    if(periodo != '') periodoData = `${periodo}-01`
    
    let data = new FormData()
    data.append('periodo',periodoData)
    data.append('accion','mostrarData')

    // console.log(periodoData)
    fetch(url,{
        method:'POST',
        body:data
    }).then(resp=>resp.json())
    .then(respuesta=>{
      // console.log(respuesta)
      if(!respuesta){

        swal({
          title: "No hay información para el mes seleccionado.",
          text: ``,
          type: "error",
          confirmButtonText: "¡Cerrar!"
        }).then(()=>{
          window.location = `index.php?ruta=contable/contable`
        });
        return
      }

      if(respuesta.error){

        let padre = document.querySelector('.content-wrapper .box .content')

        padre.removeChild(padre.lastChild)

        let alert = document.createElement('H1')
        alert.innerHTML = 'Buscar informacion desde el boton de filtros.'
        padre.appendChild(alert)

        swal({
            title: "Falta cargar una planillas.",
            text: `Ultimas planillas cargadas:
            PRINCIPAL - ${formatearFecha(respuesta.principal)} ||
            CONSOLIDADO - ${formatearFecha(respuesta.consolidado)}`,
            type: "error",
            confirmButtonText: "¡Cerrar!"
          });
    
          return
        
      }
      // PERIODO VISIBLE

      console.log(respuesta)

      document.getElementById('periodoVisible').innerHTML = respuesta[0].periodoVisible

        /* CAJAS SUPERIORES */
          // ECONOMICO
            document.getElementById('agricultura1').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.agricultura1 / 1000).toFixed(0))
            document.getElementById('agricultura2').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.agricultura2 / 1000).toFixed(0))
            document.getElementById('ganaderiaResto1').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.ganaderiaResto1 / 1000).toFixed(0))
            document.getElementById('ganaderiaResto2').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.ganaderiaResto2 / 1000).toFixed(0))
            let ventasTotales = respuesta[0].cajas.agricultura1 + respuesta[0].cajas.agricultura2 + respuesta[0].cajas.ganaderiaResto1 + respuesta[0].cajas.ganaderiaResto2
            document.getElementById('ventasTotales').innerHTML = '$ ' + numberWithCommas((ventasTotales / 1000).toFixed(0))
            
          
          // FINANCIERO
            document.getElementById('deudaTotal').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.deudaTotal / 1000).toFixed(0))
            document.getElementById('pasivoTotal').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.pasivoTotal / 1000).toFixed(0))
            document.getElementById('activoCirculante').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.activoCirculante / 1000).toFixed(0))
            document.getElementById('patrimonioNeto').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.patrimonioNeto / 1000).toFixed(0))

            let deudaBienes = respuesta[0].cajas.deudaBancaria / respuesta[0].cajas.bienesDeCambio
            document.getElementById('duedaBienes').innerHTML = numberWithCommas((deudaBienes * 100).toFixed(2)) + '%'

            let activoCircActivoCorr = respuesta[0].cajas.activoCirculante / respuesta[0].cajas.activoCorriente

            document.getElementById('activoCircActivoCorr').innerHTML = numberWithCommas((activoCircActivoCorr * 100).toFixed(2)) + '%'

            let pasivoPatrimonio = respuesta[0].cajas.pasivoTotal / respuesta[0].cajas.patrimonioNeto
            document.getElementById('pasivoPatrimonio').innerHTML = numberWithCommas((pasivoPatrimonio * 100).toFixed(2)) + '%'

            let actPasCorriente = Number(respuesta[0].cajas.activoCorriente) / Number(respuesta[0].cajas.pasivoCorriente)
            document.getElementById('indiceActPasCorriente').innerHTML = numberWithCommas((actPasCorriente).toFixed(2))
            // document.getElementById('indiceActPasCorriente').innerHTML = numberWithCommas((pasivoPatrimonio * 100).toFixed(2)) + '%'

          // IMPOSITIVO
            document.getElementById('ingresoBruto').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.ingresosBrutos / 1000).toFixed(0))
            document.getElementById('inmobiliarioComuna').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.inmobiliarioComuna / 1000).toFixed(0))
            document.getElementById('cargasSociales').innerHTML = '$ ' + numberWithCommas((respuesta[0].cajas.cargasSociales / 1000).toFixed(0))

            let sueldosVentas = respuesta[0].cajas.sueldos / ventasTotales

            document.getElementById('sueldosVentas').innerHTML = '$ ' + numberWithCommas((getMonthDataCajas(respuesta,'sueldos12') / 1000).toFixed(0))

            document.getElementById('sueldosTotal').innerHTML = '$ ' + numberWithCommas((getMonthDataCajas(respuesta,'sueldos12Honorarios') / 1000).toFixed(0))

        /* GRAFICOS */

          // ECONOMICO
            let divId = 'ventasChart'

            // console.log('ver')
            // console.log(respuesta)
            let dataAgricultura1 = getMonthData(respuesta,'agricultura1')
            // console.log(dataAgricultura1)
            dataAgricultura1.reverse()
            // let dataAgricultura = respuesta.map(registro=> Number(registro.graficos.agricultura).toFixed(2))
            let dataAgricultura2 = getMonthData(respuesta,'agricultura2')
            // console.log(dataAgricultura2)
            dataAgricultura2.reverse()

            // let dataGanaderiaResto = respuesta.map(registro=> Number(registro.graficos.ganaderiaResto).toFixed(2))
            let dataGanaderiaResto1= getMonthData(respuesta,'ganaderiaResto1')
            dataGanaderiaResto1.reverse()

            let dataGanaderiaResto2 = getMonthData(respuesta,'ganaderiaResto2')
            dataGanaderiaResto2.reverse()
            
            let registros = [{
                              label: 'Agricultura 1',
                              backgroundColor: 'rgba(255,0,100,.2)',
                              borderColor: 'rgb(255,0,0)',
                              borderWidth: 1, 
                              data: dataAgricultura1
                          },{
                            label: 'Agricultura 2',
                            backgroundColor: 'rgba(50,0,255,.2)',
                            borderColor: 'rgb(0,0,255)',
                            borderWidth: 1, 
                            data: dataAgricultura2
                        }
                      ]

            
            let labels = []; 
          
            // let labels = respuesta.map((registro,index)=> { if(index < 6) registro.periodo})

            for (let index = 0; index < 6; index++) {

              if(respuesta[index]?.periodo != undefined){
                labels.push(respuesta[index]?.periodo)
              }
              
            }

            labels.reverse()


            generarGraficoMultiBar(divId,labels,registros)
            generarGraficoMultiBar('idGraficoVentas',labels,registros)

            // divId = 'ventasChart2'

            // var registrosGanaderia = [{
            //                   label: 'Ganaderia / Resto 1',
            //                   backgroundColor: 'rgba(255,0,100,.2)',
            //                   borderColor: 'rgb(255,0,0)',
            //                   borderWidth: 1, 
            //                   data: dataGanaderiaResto1
            //               },{
            //                 label: 'Ganaderia / Resto 2',
            //                 backgroundColor: 'rgba(50,0,255,.2)',
            //                 borderColor: 'rgb(0,0,255)',
            //                 borderWidth: 1, 
            //                 data: dataGanaderiaResto2
            //             }
            //           ]
     
                      
            // generarGraficoMultiBar(divId,labels,registrosGanaderia)
            // generarGraficoMultiBar('idGraficoVentas2',labels,registrosGanaderia)

            divId = 'ventasChart2'

            // var totalGanaderiaResto = dataGanaderiaResto1.map((value,key)=>{
            //   return Number(value) + Number(dataGanaderiaResto2[key]);
            // })
                  
            var registrosGanaderia = {
              labels: labels,
              datasets: [
                {
                  label: 'G/R 1',
                  data: dataGanaderiaResto1,
                  backgroundColor: 'rgba(255,0,100,.2)',
                  borderColor: 'rgb(255,0,0)',
                  borderWidth: 1, 
                  stack: 'Stack 0',
                },
                {
                  label: 'G/R 2',
                  data: dataGanaderiaResto2,
                  backgroundColor: 'rgba(50,0,255,.2)',
                  borderColor: 'rgb(0,0,255)',
                  borderWidth: 1,
                  stack: 'Stack 0',
                },
                // {
                //   label: 'Total',
                //   data: totalGanaderiaResto,
                //   backgroundColor: 'rgba(0,255,0,.2)',
                //   borderColor: 'rgb(0,255,0)',
                //   borderWidth: 1,
                //   stack: 'Stack 1',
                // },
              ]
            };
                                  
            generarGraficoStackedGroup(divId,labels,registrosGanaderia)
            generarGraficoStackedGroup('idGraficoVentas2',labels,registrosGanaderia)


            divId = 'margenVentasChart'
            tituloLabel = 'Margen/Ventas'
            // registros = respuesta.map((registro,index)=> {
            //                                                 console.log(index);
            //                                                 if(index < 5){
            //                                                     return Number(registro.graficos.margenSobreVentas).toFixed(2)
            //                                                   }
            //                                                 })
            registros = []

            for (const key in respuesta) {
              if(key < 6){
                registros.push(Number(respuesta[key].graficos.margenSobreVentas).toFixed(2))
              }
            }
            registros.reverse()      
            
            // dataResultExpl = respuesta.map(registro=>Number(registro.graficos.resultadoExplotacion2).toFixed(2))
            dataResultExpl = getMonthData(respuesta,'resultadoExplotacion2')
            console.log(dataResultExpl);  
            dataResultExpl.reverse()

            let configMargenVentasChart = {
              type: 'bar',
              data: {
                labels: labels,
                datasets: [
                  {
                    type: 'line',
                    label: 'BAAI',
                    borderColor: window.chartColors.red,
                    fill:false,
                    yAxisID: 'A',
                    data: dataResultExpl
                  }
                  ,
                  {
                    label: 'm/v',
                    type: 'line',
                    backgroundColor:'rgba(0,255,0,.2)',
                    borderColor: 'rgb(0,255,0)',
                    yAxisID: 'B',
                    data: registros,
                    borderWidth: 2
                  }
                ]
              },
              options: {
                tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {

                        if(tooltipItem.datasetIndex == 1){
                          return `${tooltipItem.yLabel}%`
                        }else{
                          return `$ ${tooltipItem.yLabel.toLocaleString('de-DE')}`
                        }
                      }
                  }
                },
                scaleShowValues: true,
                scales: {
                  xAxes: [{
                    display:true,
                    ticks: {
                      autoSkip: false,
                    }
                  }],
                  yAxes: [{
                    id: 'A',
                    type: 'linear',
                    position: 'left',
                    ticks:{
                      beginAtZero: true,
                      callback: function(value, index, ticks) {
                        return  format(value);
                      }     
                    }
                  }, {
                    id: 'B',
                    type: 'linear',
                    position: 'right',
                    ticks:{
                      beginAtZero: true
                    }
                  }]
                },
                plugins:{
                  labels:{                  
                    render: (val)=>{ return format(val.value);},
                  }
                },
                legend:{
                  labels: {
                        boxWidth: 5
                  }
                }
              }
            }
                  
            generarGraficoBar(divId,configMargenVentasChart,'noOption');
            generarGraficoBar('idGraficoMargenVentas',configMargenVentasChart,'noOption')

        
            divId = 'rentabilidadEconomicaChart'
            tituloLabel = 'Renta/Activo'

            registros = []

            for (const key in respuesta) {
              if(key < 6){
                registros.push(Number(respuesta[key].graficos.rentabilidadEconomica).toFixed(2))
              }
            }

            // registros = respuesta.map(registro=>  Number(registro.graficos.rentabilidadEconomica).toFixed(2))
            registros.reverse()

            let configRentabilidadChart = {
              type: 'line',
              data: {
                labels: labels,
                datasets: [
                  {
                    type: 'line',
                    label: 'R/A',
                    borderColor: window.chartColors.red,
                    data: registros
                  }
                ]
              },
              options: {
                tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {
                          return `${tooltipItem.yLabel}%`
                      }
                  }
                },
                scaleShowValues: true,
                scales: {
                  xAxes: [{
                    display:true,
                    ticks: {
                      autoSkip: false,
                    }
                  }],
                },
                plugins:{
                  labels:{                  
                    render: (val)=>{ return format(val.value);},
                  }
                },
                legend:{
                  labels: {
                        boxWidth: 5
                  }
                }
              }
            }

            generarGraficoBar(divId,configRentabilidadChart,'noOption');

          // FINANCIERO
            divId = 'endeudamientoChart'

            // let dataPrestamos = respuesta.map(registro=> Number(registro.graficos.endeudamiento.prestamos).toFixed(2))
            let dataPrestamos = []

            for (const key in respuesta) {
              if(key < 6){
                dataPrestamos.push(Number(respuesta[key].graficos.endeudamiento.prestamos).toFixed(2))
              }
            }

            dataPrestamos.reverse()

            // let dataTarjetas = respuesta.map(registro=> Number(registro.graficos.endeudamiento.tarjetas).toFixed(2))
            let dataTarjetas = []

            for (const key in respuesta) {
              if(key < 6){
                dataTarjetas.push(Number(respuesta[key].graficos.endeudamiento.tarjetas).toFixed(2))
              }
            }

            dataTarjetas.reverse()

            // let dataProveedores = respuesta.map(registro=> Number(registro.graficos.endeudamiento.proveedores).toFixed(2))
            let dataProveedores = []

            for (const key in respuesta) {
              if(key < 6){
                dataProveedores.push(Number(respuesta[key].graficos.endeudamiento.proveedores).toFixed(2))
              }
            }

            dataProveedores.reverse()

            // let dataSgr = respuesta.map(registro=> Number(registro.graficos.endeudamiento.sgr).toFixed(2))

            let dataSgr = []

            for (const key in respuesta) {
              if(key < 6){
                dataSgr.push(Number(respuesta[key].graficos.endeudamiento.sgr).toFixed(2))
              }
            }

            dataSgr.reverse()

            // let dataMutuales = respuesta.map(registro=> Number(registro.graficos.endeudamiento.mutuales).toFixed(2))
            let dataMutuales = []

            for (const key in respuesta) {
              if(key < 6){
                dataMutuales.push(Number(respuesta[key].graficos.endeudamiento.mutuales).toFixed(2))
              }
            }

            dataMutuales.reverse()
            
            // let dataCLP = respuesta.map(registro=> Number(registro.graficos.endeudamiento.cerealPL).toFixed(2))
            let dataCLP = []

            for (const key in respuesta) {
              if(key < 6){
                dataCLP.push(Number(respuesta[key].graficos.endeudamiento.cerealPL).toFixed(2))
              }
            }
            dataCLP.reverse()

            registros = [{
                              label: 'Prestamos',
                              backgroundColor: 'rgba(255,0,100,.2)',
                              borderColor: 'rgb(255,0,0)',
                              borderWidth: 1, 
                              data: dataPrestamos
                          },{
                            label: 'Tarjetas',
                            backgroundColor: 'rgba(50,0,255,.2)',
                            borderColor: 'rgb(0,0,255)',
                            borderWidth: 1, 
                            data: dataTarjetas
                          },{
                            label: 'Sgr',
                            backgroundColor: 'rgba(0,255,0,.2)',
                            borderColor: 'rgb(0,255,0)',
                            borderWidth: 1, 
                            data: dataSgr
                          },{
                            label: 'Mutuales',
                            backgroundColor: 'rgba(0,255,255,.2)',
                            borderColor: 'rgb(0,255,255)',
                            borderWidth: 1, 
                            data: dataMutuales
                          },{
                            label: 'Proveedores',
                            backgroundColor: 'rgba(200,0,255,.2)',
                            borderColor: 'rgb(200,0,255)',
                            borderWidth: 1, 
                            data: dataProveedores
                          },{
                            label: 'CPL',
                            backgroundColor: 'rgba(236,255,0,.2)',
                            borderColor: 'rgb(236,255,0)',
                            borderWidth: 1, 
                            data: dataCLP
                          }]

            generarGraficoMultiBar(divId,labels,registros)
            generarGraficoMultiBar('idGraficoDeudaBancaria',labels,registros)

            divId = 'deudaBancariaChart'
            // let dataDeudaBancaria = respuesta.map(registro=> Number(registro.graficos.deudaBancaria).toFixed(2))
            let dataDeudaBancaria = []

            for (const key in respuesta) {
              if(key < 6){
                dataDeudaBancaria.push(Number(respuesta[key].graficos.deudaBancaria).toFixed(2))
              }
            }

            dataDeudaBancaria.reverse()
            tituloLabel = 'Deuda Bancaria'

            generarGraficoBarSimple(dataDeudaBancaria,divId,labels,tituloLabel)

            divId = 'interesesPagadosChart'
            // let dataDeudaBancaria = respuesta.map(registro=> Number(registro.graficos.deudaBancaria).toFixed(2))
            // let datainteresesPagados = []

            // for (const key in respuesta) {
            //   if(key < 6){
            //     datainteresesPagados.push(Number(respuesta[key].graficos.interesesPagados).toFixed(2))
            //   }
            // }

            datainteresesPagados = getMonthData(respuesta,'interesesPagados')

            datainteresesPagados.reverse()
            tituloLabel = 'Intereses Pagados'

            generarGraficoBarSimple(datainteresesPagados,divId,labels,tituloLabel)

          // IMPOSITIVO

                            
            divId = 'saldoIva'
            // let dataSld = respuesta.map(registro=> Number(registro.graficos.saldos.sld).toFixed(2))

            let dataSld = []

            for (const key in respuesta) {
              if(key < 6){
                dataSld.push(Number(respuesta[key].graficos.saldos.sld).toFixed(2))
              }
            }

            dataSld.reverse()


            // let dataSaldoTecnico = respuesta.map(registro=> Number(registro.graficos.saldos.saldoTecnico).toFixed(2))

            let dataSaldoTecnico = []

            for (const key in respuesta) {
              if(key < 6){
                dataSaldoTecnico.push(Number(respuesta[key].graficos.saldos.saldoTecnico).toFixed(2))
              }
            }
            dataSaldoTecnico.reverse()

            registros = [{
                              label: 'SLD',
                              backgroundColor: 'rgba(255,0,100,.2)',
                              borderColor: 'rgb(255,0,0)',
                              borderWidth: 1, 
                              data: dataSld
                          },{
                            label: 'Saldo Técnico',
                            backgroundColor: 'rgba(50,0,255,.2)',
                            borderColor: 'rgb(0,0,255)',
                            borderWidth: 1, 
                            data: dataSaldoTecnico
            }]

            generarGraficoMultiBar(divId,labels,registros)

            generarGraficoMultiBar('idGraficoSaldoIva',labels,registros)

            let ventasTotalesGraficos = getMonthData(respuesta,'ventasTotales')

            divId = 'sueldos12Ventas'
            // let dataSueldos12 = respuesta.map(registro=> Number(registro.graficos.sueldos12).toFixed(2))
            let dataSueldos12 = getMonthData(respuesta,'sueldos12')
            let dataSueldos12Ventas = dataSueldos12.map((registro,index)=> Number(((registro / ventasTotalesGraficos[index]) * 100)).toFixed(2))
            
            dataSueldos12.reverse()
            dataSueldos12Ventas.reverse()

            tituloLabel = 'Sueldos 1 + 2 / Ventas'

            // generarGraficoBarSimple(dataSueldosHonorariosVentas,divId,labels,tituloLabel)

            let configSueldos12VentasChart = {
              type: 'bar',
              data: {
                labels: labels,
                datasets: [
                  {
                    type: 'bar',
                    label: 'Suedos 1 + 2',
                    borderColor: window.chartColors.red,
                    backgroundColor:'rgba(255,0,0,.2)',
                    borderColor: 'rgb(255,0,0)',
                    yAxisID: 'A',
                    data: dataSueldos12
                  }
                  ,
                  {
                    label: 'Sueldos 1 + 2 / Ventas.',
                    type: 'line',
                    borderColor: 'rgb(0,255,0)',
                    yAxisID: 'B',
                    fill:false,
                    data: dataSueldos12Ventas,
                    borderWidth: 2
                  }
                ]
              },
              options: {
                tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {

                        if(tooltipItem.datasetIndex == 1){
                          return `${tooltipItem.yLabel}%`
                        }else{
                          return `$ ${tooltipItem.yLabel.toLocaleString('de-DE')}`
                        }
                      }
                  }
                },
                scaleShowValues: true,
                scales: {
                  xAxes: [{
                    display:true,
                    ticks: {
                      autoSkip: false,
                    }
                  }],
                  yAxes: [{
                    id: 'A',
                    type: 'linear',
                    position: 'left',
                    ticks:{
                      beginAtZero: true,
                      callback: function(value, index, ticks) {
                        return  format(value);
                      }     
                    }
                  }, {
                    id: 'B',
                    type: 'linear',
                    position: 'right',
                    ticks:{
                      beginAtZero: true
                    }
                  }]
                },
                plugins:{
                  labels:{                  
                    render: (val)=>{ return format(val.value);},
                  }
                },
                legend:{
                  labels: {
                        boxWidth: 5
                  }
                }
              }
            }
                  
            generarGraficoBar(divId,configSueldos12VentasChart,'noOption');
            generarGraficoBar('idGraficoSueldo12',configSueldos12VentasChart,'noOption');
            // generarGraficoBar('idGraficoSueldos12Ventas',configSueldos12VentasChart,'noOption')
            
            divId = 'sueldos12HonorariosVentas'
            // let dataSueldos12Honorarios = respuesta.map(registro=> Number(registro.graficos.sueldos12Honorarios).toFixed(2))
            let dataSueldos12Honorarios = getMonthData(respuesta,'sueldos12Honorarios')
            // console.log(dataSueldos12Honorarios)
            ventasTotalesGraficos = getMonthData(respuesta,'ventasTotales')
            let dataSueldos12HonorariosVentas = dataSueldos12.map((registro,index)=> Number(((registro / ventasTotalesGraficos[index]) * 100)).toFixed(2))


            dataSueldos12Honorarios.reverse()
            dataSueldos12HonorariosVentas.reverse()
            
            tituloLabel = 'Sueldos 1 + 2 + Honorarios / Ventas' 

            let configSueldos12HonorariosVentasChart = {
              type: 'bar',
              data: {
                labels: labels,
                datasets: [
                  {
                    type: 'bar',
                    label: 'Suedos 1 + 2 + Honorarios',
                    backgroundColor:'rgba(255,0,0,.2)',
                    borderColor: 'rgb(255,0,0)',
                    yAxisID: 'A',
                    data: dataSueldos12Honorarios
                  }
                  ,
                  {
                    label: 'Sueldos 1 + 2 + Honorarios / Ventas.',
                    type: 'line',
                    borderColor: 'rgb(0,255,0)',
                    yAxisID: 'B',
                    fill:false,
                    data: dataSueldos12HonorariosVentas,
                    borderWidth: 2
                  }
                ]
              },
              options: {
                tooltips: {
                  callbacks: {
                    label: function(tooltipItem, data) {

                        if(tooltipItem.datasetIndex == 1){
                          return `${tooltipItem.yLabel}%`
                        }else{
                          return `$ ${tooltipItem.yLabel.toLocaleString('de-DE')}`
                        }
                      }
                  }
                },
                scaleShowValues: true,
                scales: {
                  xAxes: [{
                    display:true,
                    ticks: {
                      autoSkip: false,
                    }
                  }],
                  yAxes: [{
                    id: 'A',
                    type: 'linear',
                    position: 'left',
                    ticks:{
                      beginAtZero: true,
                      callback: function(value, index, ticks) {
                        return  format(value);
                      }     
                    }
                  }, {
                    id: 'B',
                    type: 'linear',
                    position: 'right',
                    ticks:{
                      beginAtZero: true,
                      callback: function(value, index, ticks) {
                        return  format(value);
                      } 
                    }
                  }]
                },
                plugins:{
                  labels:{                  
                    render: (val)=>{ return format(val.value);},
                  }
                },
                legend:{
                  labels: {
                        boxWidth: 5
                  }
                }
              }
            }
            generarGraficoBar(divId,configSueldos12HonorariosVentasChart,'noOption');

            generarGraficoBar('idGraficoSueldo12Honorario',configSueldos12HonorariosVentasChart,'noOption');

            // generarGraficoBarSimple(dataSueldosVentas,divId,labels,tituloLabel)

          
        const btnsZoomGrafico = document.querySelectorAll('.zoomGraficos')

        btnsZoomGrafico.forEach(element => {

          element.addEventListener('click',()=>{

            switch (element.attributes['data-modal'].value) {
              case 'zGraficoVentas':
                  $('#graficoVentaModal').modal('show')

                break;
              
              case 'zGraficoVentas2':
                  $('#graficoVenta2Modal').modal('show')

                break;

                case 'zGraficoMargenVentas':
                  $('#graficoMargenVentaModal').modal('show')

                break;

                case 'zGraficoEndeudamiento':
                  $('#graficoDeudaBancariaModal').modal('show')

                break;

                case 'zGraficoSaldoIva':
                  $('#graficoSaldoIvaModal').modal('show')
                  break;

                case 'zGraficoSueldos12':
                  $('#graficoSueldo12Modal').modal('show')
                  break;

                case 'zGraficoSueldos12Honorarios':
                  $('#graficoSueldo12HonorarioModal').modal('show')
                  break;
            
              default:
                break;
            }
          })

        });



    })
    .catch(err=>console.log(err))



/*=============================================
ELIMINAR ARCHIVO
=============================================*/
$(".tablas").on("click", ".btnEliminarArchivoContable", function(){

  var idArchivo = $(this).attr("idArchivo");
  var tabla = $(this).attr("tablaDB");

  swal({
    title: '¿Está seguro de borrar los registros asociados a este Archivo?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar!'
  }).then(function(result){

    if(result.value){

      if(tabla != 'contable' && tabla != 'contablePaihuen'){ 
        window.location = "index.php?ruta=archivosCarga&nombreArchivo=" + idArchivo + "&tabla=" + tabla;
      }else{
        window.location = "index.php?ruta=contable/archivos&nombreArchivo=" + idArchivo + "&tabla=" + tabla;
      }

    }

  })

})