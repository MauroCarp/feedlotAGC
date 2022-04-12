<?php
function color_rand() {

    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));

}



$colores = array('red','blue','green','yellow','orange','violet','pink','grey','brown');

$fechasRango = $_GET['rango'];

$fechasRango = explode('/',$fechasRango);

$fechaInicial = $fechasRango[0];

$fechaFinal = $fechasRango[1];

/*********
        LISTADO DE CAUSAS DE MUERTES
                                ********/
    $causas = array();

    $item = null;
    
    $valor = null;

    $item2 = 'fechaMuerte';

    $fecha1 = $fechaInicial;

    $fecha2 = $fechaFinal;

    $campo = 'diagnostico';
    
    $causasMuertes = ControladorDatosMuertes::ctrMostrarDatosDistincRango($item, $valor,$campo,
    $item2,$fecha1,$fecha2);

    for ($i=0; $i < sizeof($causasMuertes) ; $i++) { 

        $causa = $causasMuertes[$i][0];

        $causas[$causa] = 0;

    }


/*********
        LISTADO DE CONSIGNATARIOS
                                    ********/

    $campo = 'consignatario';

    $consignatarios = ControladorDatosMuertes::ctrMostrarDatosDistincRango($item, $valor,$campo,
    $item2,$fecha1,$fecha2);
    
    // var_dump($consignatarios);

    for ($i=0; $i < sizeof($consignatarios) ; $i++) { 

        $consignatario = $consignatarios[$i][0];

        $listaConsignatarios[$consignatario] = 0;

    }

/*********
        LISTADO DE PROVEEDORES
                                    ********/

                                    
    $campo = 'proveedor';

    $proveedores = ControladorDatosMuertes::ctrMostrarDatosDistincRango($item, $valor,$campo,
    $item2,$fecha1,$fecha2);

    // var_dump($proveedores);

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

    $campo = '*';

    $datosMuertes = ControladorDatosMuertes::ctrMostrarDatosRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    // var_dump($datosMuertes);

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

    $totalMacho = ControladorDatosMuertes::ctrSumarDatosRango($item, $valor,$campo,$item2,$fecha1,$fecha2);

    $totalMacho = $totalMacho[0][0];


    $campo = 'hembra';

    $totalHembra = ControladorDatosMuertes::ctrSumarDatosRango($item, $valor,$campo,$item2,$fecha1,$fecha2)
    ;
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
$datosJson = json_encode($datos); 
$muertesTratadasJson = json_encode($muertesTratadas);

?>
