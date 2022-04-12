<?php
function color_rand() {

    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));

}



$colores = array('red','blue','green','yellow','orange','violet','pink','grey','brown');


/*********
        LISTADO DE CAUSAS DE MUERTES
                                ********/
    $causas = array();

    $item = null;
    $valor = null;
    $campo = 'diagnostico';
    $causasMuertes = ControladorDatosMuertes::ctrMostrarDatosDistinc($item,$valor,$campo);

    for ($i=0; $i < sizeof($causasMuertes) ; $i++) { 
        $causa = $causasMuertes[$i][0];
        $causas[$causa] = 0;
    }


/*********
        LISTADO DE CONSIGNATARIOS
                                    ********/

    $campo = 'consignatario';
    $consignatarios = ControladorDatosMuertes::ctrMostrarDatosDistinc($item,$valor,$campo);

    for ($i=0; $i < sizeof($consignatarios) ; $i++) { 
        $consignatario = $consignatarios[$i][0];
        $listaConsignatarios[$consignatario] = 0;
    }

/*********
        LISTADO DE PROVEEDORES
                                    ********/

                                    
    $campo = 'proveedor';
    $proveedores = ControladorDatosMuertes::ctrMostrarDatosDistinc($item,$valor,$campo);

    for ($i=0; $i < sizeof($proveedores) ; $i++) { 
        $proveedor = $proveedores[$i][0];
        $listaProveedores[$proveedor] = 0;
    }


/*********
        DATOS MUERTES
                                ********/

    $item = null;
    $valor = null;
    $orden = 'fechaMuerte';
    $datosMuertes = ControladorDatosMuertes::ctrMostrarDatos($item,$valor,$orden);

    for ($i=0; $i < sizeof($datosMuertes) ; $i++) { 
        //  MUERTES POR CAUSA
        $causa = $datosMuertes[$i]['diagnostico'];
        $causas[$causa]++;


        //  MUERTES POR CONSIGNATARIOS
        $consignatario = $datosMuertes[$i]['consignatario'];
        $listaConsignatarios[$consignatario]++;

        //  MUERTES POR PROVEEDORES
        $proveedor = $datosMuertes[$i]['proveedor'];
        $listaProveedores[$proveedor]++;


    }

    $listadoCausas = array();
    $etiquetasCausas = array();

    foreach ($causas as $key => $value) {
        $listadoCausas[$key] = 0;
        $listadoCausasPie[$key] = 0;
        $etiquetasCausas[] = $key;
    }


    $labelsCausas = "";
    $muertesCausas = "";
    $chartData = "";

    foreach ($causas as $key => $value) {

        $labelsCausas = $labelsCausas.",'".$key."'";
        $dataSet = "{
            label: '".$key."',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [".$value."]
            
        }";

        $muertesCausas = $muertesCausas.','.$value;

        $chartData = $chartData.','.$dataSet;
    }

    $labelsCausas = substr($labelsCausas,1);
    $muertesCausas = substr($muertesCausas,1);

    $colorsPie = array('#F5B7B1','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB');
    $colorsPieStr = "";

    for ($i=0; $i < sizeof($causas) ; $i++) { 
        $colorsPieStr = $colorsPieStr.",'".$colorsPie[$i]."'";
    }

    $colorsPieStr = substr($colorsPieStr,1);

/*********
        MUERTES POR CONSIGNATARIO
                                ********/

    $labelsConsignatarios = "";                               
    $chartDataConsignatarios = "";   
    $dataConsignatario = "";
    $consignatariosResum = "";
    $cont = 0;
    foreach ($listaConsignatarios as $key => $value) {

        $consignatario = ($key == '') ? 'S/D' : $key;
        
        $labelsConsignatarios = $labelsConsignatarios.",'".$consignatario."'";

        $consignatariosResum = $consignatariosResum.",'".substr($consignatario,0,6 )."'";
        
        $dataSet = "{
            label: '".substr($consignatario,0,6)."',
            backgroundColor: '".$colorsPie[$cont]."',
            borderColor: '".$colorsPie[$cont]."',
            borderWidth: 1,
            data: [".$value."]
            
        }";

        $chartDataConsignatarios = $chartDataConsignatarios.','.$dataSet;

        $dataConsignatario = $dataConsignatario.','.$value;
        
        $cont++;
    }

    $labelsConsignatarios = substr($labelsConsignatarios,1);
    $chartDataConsignatarios = substr($chartDataConsignatarios,1);
    $dataConsignatario = substr($dataConsignatario,1);
    $consignatariosResum = substr($consignatariosResum,1);


/*********
        MUERTES POR PROVEEDORES
                                ********/

    $labelsProveedores = "";                               
    $chartDataProveedores = "";   
    $dataProveedor = "";
    $proveedoresResum = "";

    foreach ($listaProveedores as $key => $value) {

        $proveedor = ($key == '') ? 'S/D' : $key;
        
        $labelsProveedores = $labelsProveedores.",'".$proveedor."'";

        $proveedoresResum = $proveedoresResum.",'".substr($proveedor,0,8)."'";

        $dataSet = "{
            label: 'Muertes por proveedor',
            backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
            borderColor: window.chartColors.blue,
            borderWidth: 1,
            data: [".$value."]
            
        }";

        $chartDataProveedores = $chartDataProveedores.','.$dataSet;

        $dataProveedor = $dataProveedor.','.$value;


    }

    $labelsProveedores = substr($labelsProveedores,1);
    $chartDataProveedores = substr($chartDataProveedores,1);
    $dataProveedor = substr($dataProveedor,1);
    $proveedoresResum = substr($proveedoresResum,1);


/*********
        MUERTES POR SEXO
                                ********/

    $campo = 'macho';
    $totalMacho = ControladorDatosMuertes::ctrSumarDatos($item,$valor,$campo);
    $totalMacho = $totalMacho[0][0];


    $campo = 'hembra';
    $totalHembra = ControladorDatosMuertes::ctrSumarDatos($item,$valor,$campo);
    $totalHembra = $totalHembra[0][0];

    $muertesSexo = $totalMacho.','.$totalHembra;


    
    
/****************
     MUERTES TRATADAS
                    ***********/
    
    $muertesMesesGeneral = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
    
    $muertesTratadas = array();
    
    for ($p=0; $p < 2 ; $p++) { 
     
        $muertesTratadas[] = $muertesMesesGeneral;
    
    }
    // 
/*********
        MUERTES POR MES
                                ********/

    for ($aa=0; $aa < sizeof($datosMuertes) ; $aa++) { 
                    
        $totalMuertes = $datosMuertes[$aa]['macho'] + $datosMuertes[$aa]['hembra'];
        
        $fecha = $datosMuertes[$aa]['fechaMuerte'];
        
        // SE DIVIDE LA FECHA EN AÑO-MES-DIA
        $mesFecha = explode('-',$fecha);
        
        //SE OBTIENE LOS KEYS DE LOS MESES
        
        $mesKey = $mesFecha[1];
        
        // SE LES SACAN LOS CEROS A LOS MENORES DE DIEZ

        if ($mesKey < 10) {

            $mesKey = substr($mesFecha[1],1);

        }                    
        
        foreach ($muertesMesesGeneral as $key => $value) {
            
            if ($key == $mesKey) {

                $muertesMesesGeneral[$key] += $totalMuertes; 

                if ($datosMuertes[$aa]['tratado'] == 0) {
                        
                    $muertesTratadas[0][$key] += $totalMuertes;
                    
                }else{
                    
                    $muertesTratadas[1][$key] += $totalMuertes;
    
                }

            }

        }

    }

    $datos['muertesMesesGeneral'] = $muertesMesesGeneral;


    $causasTotales = array();
    foreach ($causas as $key => $value) {
        $causasTotales[] = $key;
    }


/*********
        FILTRADO
                                ********/

$filtroValido = array_key_exists('rango',$_GET);

if($filtroValido){
    
    $rangoMuertes = $_GET['rango'];

    $rangoMuertes = explode('/',$rangoMuertes);

    $fechaInicial = $rangoMuertes[0];

    $fechaFinal = $rangoMuertes[1];

    $cantidad = $_GET['cantidad'];

    $datos['labels']  = array('Consignatario'=>(''),'Proveedor'=>(''),'Tropa'=>(''));
    $datos['muertes'] = array();
    $datos['causas'] = array();
    $datos['mesesMuertes'] = array();
    $datos['mesesCausa'] = array();

    $dataCantMuertes = '';

    $label = '';

    $colorsPieStr = '';


    for ($i=1; $i <= $cantidad ; $i++) { 
        
        $colorsPieStr = $colorsPieStr.",'".$colorsPie[$i]."'";
        
        $consignatarioIndex = 'consignatario'.$i; 
        
        $proveedorIndex = 'proveedor'.$i; 
        
        $tropaIndex = 'tropa'.$i;
        
        
        $item = 'consignatario';
        $valor = $_GET[$consignatarioIndex];
        
        $item2 = 'proveedor';
        $valor2 = $_GET[$proveedorIndex];
        
        $item3 = 'tropa';
        $valor3 = $_GET[$tropaIndex];
        
        /*********
         LABELS
         ********/
        
            
            $datos['labels']['Consignatario'] = $datos['labels']['Consignatario'].','.$valor;
            $datos['labels']['Proveedor'] = $datos['labels']['Proveedor'].','.$valor2; 
            $datos['labels']['Tropa'] = $datos['labels']['Tropa'].','.$valor3; 
            $etiqueta = $valor3;
            $labelArray[$i] = array('Tropa',$valor3);
            $columna = 'Tropa';

            
            if ($valor3 == 'Tropa') {
                
                $etiqueta = $valor2;
                $columna = 'Proveedor';
                $labelArray[$i] = array('Proveedor',$valor2);
                if ($valor2 == 'Proveedor' ) {

                    $columna = 'Consignatario';
                    $etiqueta = $valor;
                    $labelArray[$i] = array('Consignatario',$valor);
                    
                }
            }

            $label = $label."','".$etiqueta;
            $datosGraficos[$i] = $etiqueta;


        /*********
                MUERTES POR SEXO
                                ********/

            // COLUMNA EN LA TABLA ( consignatario - proveedor - Tropa)
            $item = strtolower($columna);

            // VALOR DE LA COLUMNA
            $valor = $etiqueta;

            $item2 = 'fechaMuerte';
            
        
            $campo = 'macho';
            $totalMacho = ControladorDatosMuertes::ctrSumarCampoRango( $item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);
            $totalMacho = $totalMacho[0];
            $datos['muertes'][$i]['machos'] = $totalMacho;
            
            $campo = 'hembra';
            $totalHembra = ControladorDatosMuertes::ctrSumarCampoRango( $item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);
            $totalHembra = $totalHembra[0];
            $datos['muertes'][$i]['hembras'] = $totalHembra;
            
            $datos['muertes'][$i]['total'] = $totalMacho + $totalHembra;

            $dataCantMuertes = $dataCantMuertes.','.$datos['muertes'][$i]['total'];


        /*********
                MUERTES POR CAUSA
                                ********/
            
            $campo = '*';
            $datosCausas2 = ControladorDatosMuertes::ctrMostrarDatosRango($item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);

            $dataPie = array();
            $labelPie = array();

            for ($index=0; $index < sizeof($datosCausas2); $index++) { 
                
                $causaPie = $datosCausas2[$index]['diagnostico'];
                $muertesMachoPie = $datosCausas2[$index]['macho'];
                $muertesHembraPie = $datosCausas2[$index]['hembra'];
                $muertesPie = $muertesMachoPie + $muertesHembraPie;

                foreach ($listadoCausasPie as $key => $value) {

                    if($key == $causaPie) {

                        $listadoCausasPie[$key] += $muertesPie;

                    }

                }

            }

            foreach ($listadoCausasPie as $key => $value) {
                if ($value > 0) {
                    
                    $dataPie[] = $value;
                    $labelPie[] = $key;

                }

            }

            $datos['causas'][$i]['muertes'] = $dataPie;
            $datos['causas'][$i]['label'] = $labelPie;


        /*********
                FECHA MUERTES
                                ********/

            $campo = 'fechaMuerte,macho,hembra,diagnostico';
            $item2 = 'fechaMuerte';

            $datosFechaCantidad = ControladorDatosMuertes::ctrMostrarDatosRango($item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);

            $fechas = array();

            // SE CREA ARRAY DE MESES KEY = MESES ,VALUE = CANTIDAD DE MUERTES
            $muertesMeses = array(0,0,0,0,0,0,0,0,0,0,0,0,0);


            // SE CREA ARRA MULTIDIMENSIONAL, PRIMER NIVER KEYS = CAUSAS (Key 0 = Neumonia) , 
            // SEGUNDO NIVEL, ARRAY MESES $muertesMeses

            $arrayCausasMeses = array();

            for ($nn=0; $nn < sizeof($etiquetasCausas); $nn++) { 
                
                $arrayCausasMeses[] = $muertesMeses;

            }

            
            // SE ITERAN LOS REGISTROS DE MUERTES

            for ($n=0; $n < sizeof($datosFechaCantidad) ; $n++) { 
                
                $totalMuertes = $datosFechaCantidad[$n]['macho'] + $datosFechaCantidad[$n]['hembra'];
                
                $causaMuerte = $datosFechaCantidad[$n]['diagnostico'];

                $fecha = $datosFechaCantidad[$n]['fechaMuerte'];
                
                // SE DIVIDE LA FECHA EN AÑO-MES-DIA
                $mesFecha = explode('-',$fecha);
                
                //SE OBTIENE LOS KEYS DE LOS MESES
                
                $mesKey = $mesFecha[1];
                
                // SE LES SACAN LOS CEROS A LOS MENORES DE DIEZ

                if ($mesKey < 10) {

                    $mesKey = substr($mesFecha[1],1);

                }                


                $fechas[] = $mesKey;
                
                
                foreach ($muertesMeses as $key => $value) {
                    if ($key == $mesKey) {
                        $muertesMeses[$key] += $totalMuertes; 
                    }
                }
                

                $keyCausa = '';

                foreach ($etiquetasCausas as $key => $value) {
                    
                    if($causaMuerte == $value)
                    
                        $keyCausa = $key;
                    }
                
                $arrayCausasMeses[$keyCausa][$mesKey] += $totalMuertes;     
                
            }

            $datos['mesesMuertes'][$i] = $muertesMeses;
            $datos['mesesCausas'][$i] = $arrayCausasMeses;

            foreach ($causas as $key => $value) {

                $listadoCausasPie[$key] = 0;

            }

        }
        

    /********
                FIN FILTROS 
                        //     *****/
                        
        $dataCantMuertes = substr($dataCantMuertes,1);
        $colorsPieStr    = substr($colorsPieStr,1);
        $label           = substr($label,2);
        $label = $label."'";
        $datosGraficosJson = json_encode($datosGraficos);        
        $etiquetasCausasJson = json_encode($etiquetasCausas);

}
$datosJson = json_encode($datos); 
$muertesTratadasJson = json_encode($muertesTratadas);

?>
