<?php
require_once "../controladores/panelControl.controlador.php";

require_once "../modelos/panelControl.modelo.php";

function formatearNumero2($number){

    return number_format($number,2,",",".");

}

function formatearNumero($number){

    return number_format($number,0,",",".");

}

$accion = $_POST['accion'];

$periodo = $_POST['periodo'];

if($accion == 'chequear'){

    $campo = 'chequeado';

    $condition = $periodo;
    
    $respuesta = ControladorPanelControl::ctrChequear($campo,$condition);

    echo $respuesta;
    
}

if($accion == 'data'){

    $item = 'periodo';

    $campo = '*';

    $valor = $periodo;

    $datos = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

    $respuesta = array();

    $respuesta['Consumo1'] = "
        <tbody>

            <tr>
                                    
                <td>Costo de Sanidad por Cabeza Per&iacute;odo</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['CSanCabPeriodo'])."</span></td>

            </tr>

            <tr>
                                    
                <td>Costo Diario en Alimentaci&oacute;n en Tal Cual por Cabeza</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['CDiaAlimTCCab'])."</span></td>

            </tr>

            <tr>
                                    
                <td>Costo Kilo de Raci&oacute;n Prom. en TC</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['CKgRacPromTC'])."</span></td>

            </tr>

            <tr>
                                    
                <td>Costo Kilo de Raci&oacute;n Prom. en MS</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['CKgRacPromMS'])."</span></td>

            </tr>

        </tbody>
    ";

    $respuesta['Consumo2'] = "
        <tbody>

            <tr>
                                    
                <td>Consumo en TC PONDERADO por Cabeza</td>
                
                <td><span class='badge bg-blue'>".formatearNumero2($datos['consumTCPondCab'])." Kg</span></td>

            </tr>

            <tr>
                                    
                <td>Consumo en MS PONDERADO por Cabeza</td>
                
                <td><span class='badge bg-blue'>".formatearNumero2($datos['consumMSPondCab'])." Kg</span></td>

            </tr>

            <tr>
                                    
                <td>Conversión MS ESTIMADA según última ADPV</td>
                
                <td><span class='badge bg-blue'>".formatearNumero2($datos['converMSEstADPV'])." Kg</span></td>

            </tr>
        
            <tr>
                                    
                <td>Consumo de Soja</td>
                
                <td><span class='badge bg-blue'>".formatearNumero($datos['consumoSoja'])." Kg</span></td>

            </tr>
        
            <tr>
                                    
                <td>Consumo de Maiz</td>
                
                <td><span class='badge bg-blue'>".formatearNumero($datos['consumoMaiz'])." Kg</span></td>

            </tr>

        </tbody>
    ";

    $respuesta['Poblacion'] = "
        <tbody>

            <tr>
                                    
                <td>Poblaci&oacute;n Diaria Prom. Per&iacute;odo</td>
                
                <td><span class='badge bg-blue'>".formatearNumero($datos['poblDiaPromPeriodo'])." Cabezas</span></td>

            </tr>

            <tr>
                                    
                <td>Total Cabezas Salidas (No incluye Muertos)</td>
                
                <td><span class='badge bg-blue'>".formatearNumero($datos['totalCabSalida'])." Cabezas</span></td>

            </tr>

            <tr>
                                    
                <td>Muertos en el Per&iacute;odo</td>
                
                <td><span class='badge bg-blue'>".formatearNumero($datos['muertosPeriodo'])." Cabezas</span></td>

            </tr>

            <tr>
                                    
                <td>Estadia Promedio</td>
                
                <td><span class='badge bg-blue'>".Round($datos['estadiaProm'])." D&iacute;as</span></td>

            </tr>

            <tr>
                                    
                <td>Cabezas Trazadas Salidas (No incluye Muertos)</td>
                
                <td><span class='badge bg-blue'>".$datos['cabTrazSalidas']." Cabezas</span></td>

            </tr>

            <tr>
                                    
                <td>Peso Promedio Ingreso/Salidos - Trazados	</td>
                
                <td><span class='badge bg-blue'>".$datos['pesoPromIngSalTraz']." Kg</span></td>

            </tr>

            <tr>
                                    
                <td>Peso Promedio Egresos -  Trazados</td>
                
                <td><span class='badge bg-blue'>".formatearNumero2($datos['pesoPromEgrTraz'])." Kg</span></td>

            </tr>

            <tr>
                                    
                <td>Kilos Ganados Periodo - Trazados</td>
                
                <td><span class='badge bg-blue'>".formatearNumero2($datos['kilosGanPeriodoTraz'])." Kg</span></td>

            </tr>

            <tr>
                                    
                <td>ADPV Ganancia Diaria en el Periodo</td>
                
                <td><span class='badge bg-blue'>".formatearNumero2($datos['adpvGanDiaPeriodo'])." Kg</span></td>

            </tr>

            <tr>
                                    
            <td>Indice de Reposición</td>
            
            <td><span class='badge bg-blue'>".formatearNumero2($datos['indiceReposicion'])."</span></td>

            </tr>


        </tbody>
    ";

    $respuesta['Produccion1'] = "
        <tbody>

            <tr>
                                    
                <td>Total Cabezas Faenadas</td>
                
                <td><span class='badge bg-blue'>".$datos['totalCabFaenadas']."</span></td>

            </tr>

            <tr>
                                    
                <td>Total Kilos Carne (Faena)</td>
                
                <td><span class='badge bg-blue'>".formatearNumero2($datos['totalKgCarne'])." Kg</span></td>

            </tr>

            <tr>
                                    
                <td>Total $ Faena (Sin Gastos)</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['totalPesosFaena'])."</span></td>

            </tr>

            <tr>
                                    
                <td>Rinde</td>
                
                <td><span class='badge bg-blue'>".$datos['rinde']." %</span></td>

            </tr>

            <tr>
                                    
                <td>Valor Kg Obtenido aplicando Rinde</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['valorKgObtRinde'])."</span></td>

            </tr>

            <tr>
                                    
                <td>% Desbaste</td>
                
                <td><span class='badge bg-blue'>".formatearNumero2($datos['porceDesbaste'])." %</span></td>
                
            </tr>

        </tbody>
    ";

    $respuesta['Produccion2'] = "

        <tbody>

            <tr>
                                    
                <td>Costo Producción 1 Kg (Solo Alimentación)</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['CProdKgAlim'])."</span></td>

            </tr>

            <tr>
                                    
                <td>Costo Producción 1 Kg ( Alimentación+ Estructura + Sanidad )</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['CProdKgAES'])."</span></td>

            </tr>

            <tr>
                                    
                <td>Margen Técnico por Kilo Producido</td>
                
                <td><span class='badge bg-blue'>$ ".formatearNumero2($datos['margenTecKgProd'])."</span></td>

            </tr>

        </tbody>

    ";

    $respuesta['CajaPoblacion'] = $datos['poblDiaPromPeriodo'];

    $respuesta['CajaConversion'] = formatearNumero2($datos['converMSEstADPV']);

    $respuesta['CajaAdpv'] = formatearNumero2($datos['adpvGanDiaPeriodo']);

    $respuesta['CajaKgProd'] = formatearNumero2($datos['CProdKgAES']);

    $respuesta['CajaEstadia'] = Round($datos['estadiaProm']);

    $respuesta['Chequeado'] = $datos['chequeado'];

    echo json_encode($respuesta);
}

if($accion == 'estadisticas'){

    $anio = explode('-',$periodo);

    $anio = $anio[0];

    $item = 'periodoTime';

    $data = ControladorPanelControl::ctrMostrarDataPorAnio($item,$anio);

    print_r(json_encode($data));
    
}

if($accion == 'valuesEditar'){

    $item = 'periodo';

    $campo = '*';

    $valor = $periodo;

    $datos = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

    echo json_encode($datos);
}

?>