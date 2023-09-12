
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
                                            render: (val)=>{ return format(val.value);},
                                            // render: 'value',
                                          },
                                        }
                                    }
                                  });
      return myChart; 
    
    }

    const btnGenerarReporte = document.getElementById('generarReporteContabilidad')

    btnGenerarReporte.addEventListener('click',function(){

      let periodo = document.querySelector('.periodoContable').value

      window.location = `index.php?ruta=contable/contable&periodo=${periodo}`

    })

    
    let url = 'ajax/contable.ajax.php';

    let periodo = getQueryVariable('periodo')

    let periodoData = 'last'

    if(periodo != '') periodoData = `${periodo}-01`
    
    let data = new FormData()
    data.append('periodo',periodoData)
    data.append('accion','mostrarData')

    fetch(url,{
        method:'POST',
        body:data
    }).then(resp=>resp.json())
    .then(respuesta=>{
      console.log(respuesta)

      if(respuesta.error){

            let padre = document.querySelector('.content-wrapper .box .content')

            padre.removeChild(padre.lastChild)

            let alert = document.createElement('H1')
            alert.innerHTML = 'Buscar informacion desde el boton de filtros.'
            padre.appendChild(alert)

            swal({
                title: "Falta cargar una o mas planillas.",
                text: `Ultimas planillas cargadas:
                PRINCIPAL - ${formatearFecha(respuesta.principal)} ||
                CONSOLIDADO - ${formatearFecha(respuesta.consolidado)} ||
                PAIHUEN - ${formatearFecha(respuesta.paihuen)}`,
                type: "error",
                confirmButtonText: "¡Cerrar!"
              });
        
              return
        
      }

      // PERIODO VISIBLE

      document.getElementById('periodoVisible').innerHTML = respuesta[0].periodoVisible

        /* CAJAS SUPERIORES */
          // ECONOMICO

            document.getElementById('agricultura1').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.agricultura1.toFixed(2))
            document.getElementById('agricultura2').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.agricultura2.toFixed(2))
            document.getElementById('ganaderiaResto1').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.ganaderiaResto1.toFixed(2))
            document.getElementById('ganaderiaResto2').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.ganaderiaResto2.toFixed(2))
            let ventasTotales = respuesta[0].cajas.agricultura1 + respuesta[0].cajas.agricultura2 +respuesta[0].cajas.ganaderiaResto1 + respuesta[0].cajas.ganaderiaResto2
            document.getElementById('ventasTotales').innerHTML = '$ ' + numberWithCommas(ventasTotales.toFixed(2))
            
          
          // FINANCIERO
            document.getElementById('deudaTotal').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.deudaTotal.toFixed(2))
            document.getElementById('pasivoTotal').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.pasivoTotal.toFixed(2))
            document.getElementById('activoCirculante').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.activoCirculante.toFixed(2))
            document.getElementById('patrimonioNeto').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.patrimonioNeto.toFixed(2))

            let deudaBienes = respuesta[0].cajas.deudaBancaria / respuesta[0].cajas.bienesDeCambio
            document.getElementById('duedaBienes').innerHTML = '$ ' + numberWithCommas(deudaBienes.toFixed(2))

            let activoCircActivoCorr = respuesta[0].cajas.activoCirculante / respuesta[0].cajas.activoCorriente

            document.getElementById('activoCircActivoCorr').innerHTML = '$ ' + numberWithCommas(activoCircActivoCorr.toFixed(3))

            let pasivoPatrimonio = respuesta[0].cajas.pasivoTotal / respuesta[0].cajas.patrimonioNeto
            document.getElementById('pasivoPatrimonio').innerHTML = '$ ' + numberWithCommas(pasivoPatrimonio.toFixed(2))

          // IMPOSITIVO
            document.getElementById('ingresoBruto').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.ingresosBrutos.toFixed(2))
            document.getElementById('inmobiliarioComuna').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.inmobiliarioComuna.toFixed(2))
            document.getElementById('cargasSociales').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.cargasSociales.toFixed(2))

            let sueldosVentas = respuesta[0].cajas.sueldos / ventasTotales

            document.getElementById('sueldosVentas').innerHTML = '$ ' + numberWithCommas(sueldosVentas.toFixed(2))

            document.getElementById('sueldosTotal').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.sueldos.toFixed(2))

        /* GRAFICOS */

          // ECONOMICO
            let divId = 'ventasChart'
            let dataAgricultura = respuesta.map(registro=> Number(registro.graficos.agricultura).toFixed(2))
            dataAgricultura.reverse()
            let dataGanaderiaResto = respuesta.map(registro=> Number(registro.graficos.ganaderiaResto).toFixed(2))
            dataGanaderiaResto.reverse()
            let dataTotal = respuesta.map(registro=> Number(registro.graficos.ventasTotales).toFixed(2))
            dataTotal.reverse()

            let registros = [{
                              label: 'Agricultura',
                              backgroundColor: 'rgba(255,0,100,.2)',
                              borderColor: 'rgb(255,0,0)',
                              borderWidth: 1, 
                              data: dataAgricultura
                          },{
                            label: 'Ganaderia / Resto',
                            backgroundColor: 'rgba(50,0,255,.2)',
                            borderColor: 'rgb(0,0,255)',
                            borderWidth: 1, 
                            data: dataGanaderiaResto
                        },{
                          label: 'Total',
                          backgroundColor: 'rgba(255,255,0,.2)',
                          borderColor: 'rgb(255,255,0)',
                          borderWidth: 1, 
                          data: dataTotal
            }]

            let labels = respuesta.map(registro=> registro.periodo)
            labels.reverse()
            generarGraficoMultiBar(divId,labels,registros)
            generarGraficoMultiBar('idGraficoVentas',labels,registros)


            divId = 'margenVentasChart'
            tituloLabel = 'Margen s/ Ventas'
            registros = respuesta.map(registro=> Number(registro.graficos.margenSobreVentas).toFixed(2))
            registros.reverse()      
            
            dataResultExpl = respuesta.map(registro=>Number(registro.graficos.resultadoExplotacion).toFixed(2))
            dataResultExpl.reverse()

            let configMargenVentasChart = {
              type: 'bar',
              data: {
                labels: labels,
                datasets: [
                  {
                    type: 'line',
                    label: 'Resultado Explotaciòn',
                    borderColor: window.chartColors.red,
                    fill:false,
                    yAxisID: 'A',
                    data: dataResultExpl
                  }
                  ,
                  {
                    label: 'Margen/Ventas.',
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
                          return `$ ${tooltipItem.yLabel.toLocaleString('de-DE')}`
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
            tituloLabel = 'Rentabilidad Economica'
            registros = respuesta.map(registro=>  Number(registro.graficos.rentabilidadEconomica).toFixed(2))
            registros.reverse()

            generarGraficoBarSimple(registros,divId,labels,tituloLabel)

          // FINANCIERO
            divId = 'endeudamientoChart'
            let dataPrestamos = respuesta.map(registro=> Number(registro.graficos.endeudamiento.prestamos).toFixed(2))
            dataPrestamos.reverse()
            let dataTarjetas = respuesta.map(registro=> Number(registro.graficos.endeudamiento.tarjetas).toFixed(2))
            dataTarjetas.reverse()
            let dataProveedores = respuesta.map(registro=> Number(registro.graficos.endeudamiento.proveedores).toFixed(2))
            dataProveedores.reverse()
            let dataSeguros = respuesta.map(registro=> Number(registro.graficos.endeudamiento.seguros).toFixed(2))
            dataSeguros.reverse()
            let dataMutuales = respuesta.map(registro=> Number(registro.graficos.endeudamiento.mutuales).toFixed(2))
            dataMutuales.reverse()
            dataTotal = respuesta.map(registro=> Number(registro.graficos.endeudamiento.total).toFixed(2))
            dataTotal.reverse()

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
                            label: 'Seguros',
                            backgroundColor: 'rgba(0,255,0,.2)',
                            borderColor: 'rgb(0,255,0)',
                            borderWidth: 1, 
                            data: dataSeguros
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
                              label: 'Total',
                              backgroundColor: 'rgba(255,255,0,.2)',
                              borderColor: 'rgb(255,255,0)',
                              borderWidth: 1, 
                              data: dataTotal}]

            generarGraficoMultiBar(divId,labels,registros)
            generarGraficoMultiBar('idGraficoDeudaBancaria',labels,registros)

            divId = 'deudaBancariaChart'
            let dataDeudaBancaria = respuesta.map(registro=> Number(registro.graficos.deudaBancaria).toFixed(2))
            dataDeudaBancaria.reverse()
            tituloLabel = 'Deuda Bancaria'

            generarGraficoBarSimple(dataDeudaBancaria,divId,labels,tituloLabel)

          // IMPOSITIVO

                            
            divId = 'saldoIva'
            let dataSld = respuesta.map(registro=> Number(registro.graficos.saldos.sld).toFixed(2))
            dataSld.reverse()
            let dataSaldoTecnico = respuesta.map(registro=> Number(registro.graficos.saldos.saldoTecnico).toFixed(2))
            dataSaldoTecnico.reverse()
            
            dataTotal = respuesta.map(registro=> {return Number(registro.graficos.saldos.sld) + Number(registro.graficos.saldos.saldoTecnico)})
            dataTotal.reverse()

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
                        },{
                          label: 'Total',
                          backgroundColor: 'rgba(255,255,0,.2)',
                          borderColor: 'rgb(255,255,0)',
                          borderWidth: 1, 
                          data: dataTotal
            }]

            generarGraficoMultiBar(divId,labels,registros)

            generarGraficoMultiBar('idGraficoSaldoIva',labels,registros)


            divId = 'sueldosHonorariosVentas'
            let dataSueldosHonorariosVentas = respuesta.map(registro=> Number(registro.graficos.sueldosHonorariosVentas).toFixed(2))
            dataSueldosHonorariosVentas.reverse()
            tituloLabel = 'Sueldos + Honorarios / Ventas'

            generarGraficoBarSimple(dataSueldosHonorariosVentas,divId,labels,tituloLabel)

            
            divId = 'sueldosHonorarios'
            let dataSueldosVentas = respuesta.map(registro=> Number(registro.graficos.sueldosHonorarios).toFixed(2))
            dataSueldosVentas.reverse()
            tituloLabel = 'Sueldos + Honorarios'

            generarGraficoBarSimple(dataSueldosVentas,divId,labels,tituloLabel)

          
        const btnsZoomGrafico = document.querySelectorAll('.zoomGraficos')

        btnsZoomGrafico.forEach(element => {

          element.addEventListener('click',()=>{

            switch (element.attributes['data-modal'].value) {
              case 'zGraficoVentas':
                  $('#graficoVentaModal').modal('show')

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
            
              default:
                break;
            }
          })

        });



    })
    .catch(err=>console.log(err))

