
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
        document.getElementById('margenVentas').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.margenSobreVentas.toFixed(2))
        document.getElementById('resultadoExplotacion').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.resultadoExplotacion.toFixed(2))
        document.getElementById('ventasTotales').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.ventas.toFixed(2))
        document.getElementById('rentabilidadEconomica').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.rentabilidadEconomica.toFixed(2))
        document.getElementById('deudaTotal').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.deudaTotal.toFixed(2))
        document.getElementById('activoCirculante').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.activoCirculante.toFixed(2))
        document.getElementById('pasivoPatrimonio').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.pasivoPatrimonio.toFixed(2))
        document.getElementById('ingresoBruto').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.ingresosBrutos.toFixed(2))
        document.getElementById('inmobiliarioComuna').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.inmobiliario.toFixed(2))
        document.getElementById('cargasSociales').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.cargasSociales.toFixed(2))
        document.getElementById('sueldosVentas').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.sueldos.toFixed(2))
        document.getElementById('sueldosHonorariosVentas').innerHTML = '$ ' + numberWithCommas(respuesta[0].cajas.sueldosHonorarios.toFixed(2))

        // GRAFICOS

            let divId = 'margenVentasChart'
            let tituloLabel = 'Margen s/ Ventas'
            let registros = respuesta.map(registro=> Number(registro.cajas.margenSobreVentas).toFixed(2))
            registros.reverse()
            let labels = respuesta.map(registro=> registro.periodo)
            labels.reverse()

            generarGraficoBarSimple(registros,divId,labels,tituloLabel)
            
            divId = 'ventasChart'
            tituloLabel = 'Ventas'
            registros = respuesta.map(registro=>  Number(registro.cajas.ventas).toFixed(2))
            registros.reverse()

            generarGraficoBarSimple(registros,divId,labels,tituloLabel)
            
            divId = 'rentabilidadEconomicaChart'
            tituloLabel = 'Rentabilidad Economica'
            registros = respuesta.map(registro=>  Number(registro.cajas.rentabilidadEconomica).toFixed(2))
            registros.reverse()

            generarGraficoBarSimple(registros,divId,labels,tituloLabel)
            
            divId = 'endeudamientoChart'
            tituloLabel = 'Evolucion Endeudamiento'
            registros = respuesta.map(registro=>  Number(registro.cajas.deudaTotal).toFixed(2))
            registros.reverse()

            generarGraficoBarSimple(registros,divId,labels,tituloLabel)
            
            divId = 'resultadoExplotacionPie'
            registros = [respuesta[0].graficos.resultadoExplotacion.ganancias.toFixed(2),respuesta[0].graficos.resultadoExplotacion.perdidas.toFixed(2)]
            
            labels = ['Ganancias','Perdidas']

            generarGraficoPieContable(divId,registros,labels)    

            divId = 'ingresosExplotacionPie'
            registros = [Number(respuesta[0].graficos.ingresoExplotacion.Barlovento).toFixed(2),Number(respuesta[0].graficos.ingresoExplotacion.Paihuen).toFixed(2)]
            
            labels = ['Barlovento','Paihuen']

            generarGraficoPieContable(divId,registros,labels)    
            
            divId = 'agriculturaPie'

            registros = [Number(respuesta[0].graficos.agricultura.principal).toFixed(2),Number(respuesta[0].graficos.agricultura.consolidado).toFixed(2),Number(respuesta[0].graficos.agricultura.paihuen).toFixed(2)]
            
            labels = ['Prin','Cons','Pai']

            generarGraficoPieContable(divId,registros,labels)    

            divId = 'ganaderiaPie'

            registros = [Number(respuesta[0].graficos.ganaderia.principal).toFixed(2),respuesta[0].graficos.ganaderia.consolidado.toFixed(2)]
            
            labels = ['Principal','Consolidado']

            generarGraficoPieContable(divId,registros,labels)    

            divId = 'restoPie'
            registros = [Number(respuesta[0].graficos.resto.principal).toFixed(2),respuesta[0].graficos.resto.consolidado.toFixed(2)]
            
            labels = ['Principal','Consolidado']

            generarGraficoPieContable(divId,registros,labels)    

            divId = 'activosPie'
            registros = [Number(respuesta[0].graficos.activos.principal).toFixed(2),Number(respuesta[0].graficos.activos.consolidado).toFixed(2),Number(respuesta[0].graficos.activos.paihuen).toFixed(2)]
            
            labels = ['Prin','Cons','Pai']

            generarGraficoPieContable(divId,registros,labels)    

            divId = 'endeudamientoPie'

            registros = [Number(respuesta[0].graficos.endeudamiento.prestamos).toFixed(2),Number(respuesta[0].graficos.endeudamiento.tarjetas).toFixed(2),Number(respuesta[0].graficos.endeudamiento.seguros).toFixed(2),Number(respuesta[0].graficos.endeudamiento.mutuales).toFixed(2),Number(respuesta[0].graficos.endeudamiento.proveedores).toFixed(2)]
            
            labels = ['Prestamos','Tarjetas','Seguros','Mutuales','Proveedores']

            generarGraficoPieContable(divId,registros,labels)    

















    })
    .catch(err=>console.log(err))

