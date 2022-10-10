
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
                                                    beginAtZero: true
                                                }
                                            }]
                                          },
                                          plugins: {
                                            labels: {
                                              render: 'value'
                                            },
                                            legend: {
                                              display: false,
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
                                      scales: {
                                        xAxes: [{
                                              gridLines: {
                                                  color: "rgba(0, 0, 0, 0)",
                                              }
                                          }],
                                          yAxes: [{
                                            ticks: {
                                                  beginAtZero: true
                                              }
                                            }]
                                      
                                        },
                                        plugins: {
                                          labels: {
                                            render: 'value',
                                          },
                                        }
                                    }
                                  });
    
    
      return myChart; 
    
    }

    
    let url = 'ajax/contable.ajax.php';

    let data = new FormData()
    data.append('periodo','last')
    data.append('accion','mostrarData')

    fetch(url,{
        method:'POST',
        body:data
    }).then(resp=>resp.json())
    .then(respuesta=>{
        console.log(respuesta);
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

        // CAJAS SUPERIORES
        // ECONOMICO
        console.log(respuesta)

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
        
        let deudaBienes = respuesta[0].cajas.deudaTotal / respuesta[0].cajas.bienesDeCambio
        document.getElementById('duedaBienes').innerHTML = '$ ' + numberWithCommas(deudaBienes.toFixed(2))
        document.getElementById('activoCircActivoCorr').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.activoCorriente.toFixed(2))
        document.getElementById('pasivoPatrimonio').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.pasivoPatrimonio.toFixed(2))

        // IMPOSITIVO
        document.getElementById('ingresoBruto').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.ingresosBrutos.toFixed(2))
        document.getElementById('inmobiliarioComuna').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.inmobiliario.toFixed(2))
        document.getElementById('cargasSociales').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.cargasSociales.toFixed(2))
        document.getElementById('sueldosVentas').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.sueldosVentas.toFixed(2))
        document.getElementById('sueldosTotal').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.sueldos.toFixed(2))

        // GRAFICOS

        let divId = 'ventasChart'
        let dataAgricultura = respuesta.map(registro=> Number(registro.graficos.ventas.agricultura.toFixed(2)))
        dataAgricultura.reverse()
        let dataGanaderiaResto = respuesta.map(registro=> Number(registro.graficos.ventas.ganaderiaResto.toFixed(2)))
        dataGanaderiaResto.reverse()
        let dataTotal = respuesta.map(registro=> Number(registro.graficos.ventas.total.toFixed(2)))
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
        registros = respuesta.map(registro=> Number(registro.graficos.margenSobreVentas.toFixed(2)))
        registros.reverse()      
        
        dataResultExpl = respuesta.map(registro=>Number(registro.graficos.resultadoExplotacion.toFixed(2)))
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
                type: 'bar',
                backgroundColor:'rgba(0,255,0,.2)',
                borderColor: 'rgb(0,255,0)',
                yAxisID: 'B',
                data: registros,
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
                  autoSkip: false,
                }
              }],
              yAxes: [{
                id: 'A',
                type: 'linear',
                position: 'left',
                ticks:{
                  beginAtZero: true
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
              
        generarGraficoBar(divId,configMargenVentasChart,'noOption');
        
        generarGraficoBar('idGraficoMargenVentas',configMargenVentasChart,'noOption');
        
        // FINANCIERO
        divId = 'endeudamientoChart'
        let dataPrestamos = respuesta.map(registro=> Number(registro.graficos.endeudamiento.prestamos.toFixed(2)))
        dataPrestamos.reverse()
        let dataTarjetas = respuesta.map(registro=> Number(registro.graficos.endeudamiento.tarjetas.toFixed(2)))
        dataTarjetas.reverse()
        let dataProveedores = respuesta.map(registro=> Number(registro.graficos.endeudamiento.proveedores.toFixed(2)))
        dataProveedores.reverse()
        let dataSeguros = respuesta.map(registro=> Number(registro.graficos.endeudamiento.seguros.toFixed(2)))
        dataSeguros.reverse()
        let dataMutuales = respuesta.map(registro=> Number(registro.graficos.endeudamiento.mutuales.toFixed(2)))
        dataMutuales.reverse()
        dataTotal = respuesta.map(registro=> Number(registro.graficos.endeudamiento.total.toFixed(2)))
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
        let dataDeudaBancaria = respuesta.map(registro=> Number(registro.graficos.deudaBancaria.toFixed(2)))
        dataDeudaBancaria.reverse()
        tituloLabel = 'Deuda Bancaria'

        generarGraficoBarSimple(dataDeudaBancaria,divId,labels,tituloLabel)

        divId = 'sueldosHonorariosVentas'
        let dataSueldosVentas = respuesta.map(registro=> Number(registro.graficos.sueldosVentas.toFixed(2)))
        dataSueldosVentas.reverse()
        tituloLabel = 'Sueldos + Honorarios / Ventas'

        generarGraficoBarSimple(dataSueldosVentas,divId,labels,tituloLabel)

        // divId = 'ventasChart'
        // tituloLabel = 'Ventas'
        // registros = respuesta.map(registro=>  Number(registro.cajas.ventas).toFixed(2))
        // registros.reverse()

        // generarGraficoBarSimple(registros,divId,labels,tituloLabel)
        
        // divId = 'rentabilidadEconomicaChart'
        // tituloLabel = 'Rentabilidad Economica'
        // registros = respuesta.map(registro=>  Number(registro.cajas.rentabilidadEconomica).toFixed(2))
        // registros.reverse()

        // generarGraficoBarSimple(registros,divId,labels,tituloLabel)
        
        // divId = 'endeudamientoChart'
        // tituloLabel = 'Evolucion Endeudamiento'
        // registros = respuesta.map(registro=>  Number(registro.cajas.deudaTotal).toFixed(2))
        // registros.reverse()

        // generarGraficoBarSimple(registros,divId,labels,tituloLabel)
        
        // divId = 'resultadoExplotacionPie'
        // registros = [respuesta[0].graficos.resultadoExplotacion.ganancias.toFixed(2),respuesta[0].graficos.resultadoExplotacion.perdidas.toFixed(2)]
        
        // labels = ['Ganancias','Perdidas']

        // generarGraficoPieContable(divId,registros,labels)    

        // divId = 'ingresosExplotacionPie'
        // registros = [Number(respuesta[0].graficos.ingresoExplotacion.Barlovento).toFixed(2),Number(respuesta[0].graficos.ingresoExplotacion.Paihuen).toFixed(2)]
        
        // labels = ['Barlovento','Paihuen']

        // generarGraficoPieContable(divId,registros,labels)    
        
        // divId = 'agriculturaPie'

        // registros = [Number(respuesta[0].graficos.agricultura.principal).toFixed(2),Number(respuesta[0].graficos.agricultura.consolidado).toFixed(2),Number(respuesta[0].graficos.agricultura.paihuen).toFixed(2)]
        
        // labels = ['Prin','Cons','Pai']

        // generarGraficoPieContable(divId,registros,labels)    

        // divId = 'ganaderiaPie'

        // registros = [Number(respuesta[0].graficos.ganaderia.principal).toFixed(2),respuesta[0].graficos.ganaderia.consolidado.toFixed(2)]
        
        // labels = ['Principal','Consolidado']

        // generarGraficoPieContable(divId,registros,labels)    

        // divId = 'restoPie'
        // registros = [Number(respuesta[0].graficos.resto.principal).toFixed(2),respuesta[0].graficos.resto.consolidado.toFixed(2)]
        
        // labels = ['Principal','Consolidado']

        // generarGraficoPieContable(divId,registros,labels)    

        // divId = 'activosPie'
        // registros = [Number(respuesta[0].graficos.activos.principal).toFixed(2),Number(respuesta[0].graficos.activos.consolidado).toFixed(2),Number(respuesta[0].graficos.activos.paihuen).toFixed(2)]
        
        // labels = ['Prin','Cons','Pai']

        // generarGraficoPieContable(divId,registros,labels)    

        // divId = 'endeudamientoPie'

        // registros = [Number(respuesta[0].graficos.endeudamiento.prestamos).toFixed(2),Number(respuesta[0].graficos.endeudamiento.tarjetas).toFixed(2),Number(respuesta[0].graficos.endeudamiento.seguros).toFixed(2),Number(respuesta[0].graficos.endeudamiento.mutuales).toFixed(2),Number(respuesta[0].graficos.endeudamiento.proveedores).toFixed(2)]
        
        // labels = ['Prestamos','Tarjetas','Seguros','Mutuales','Proveedores']

        // generarGraficoPieContable(divId,registros,labels)    

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
            
              default:
                break;
            }
          })

        });



    })
    .catch(err=>console.log(err))

