<?php

$colores = array('red','blue','green','yellow','orange','purple','grey');

$colores2 = array('#F5B7B1','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB','#00ffcc','#6699ff','#ff66cc','#99ff33','#9966ff','#999966','#ccffcc','#ffccff','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB','#00ffcc','#6699ff','#ff66cc','#99ff33','#9966ff','#999966','#ccffcc','#ffccff');

$rango = $_GET['rango'];
$rango = explode('/',$rango);
$fechaInicial = $rango[0];
$fechaFinal = $rango[1];


/*********
           CANTIDAD DE ANIMALES
                            ********/
$item = null;
$valor = null;
$item2 = 'fecha';
$campo = 'cantidad';
$cantidadTotal = ControladorDatosCompras::ctrSumarCampoRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);

/*********
 CANTIDAD DE MACHOS
 ********/

$campo = 'machos';
$cantidadMachos = ControladorDatosCompras::ctrSumarCampoRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);


/*********
 CANTIDAD DE HEMBRAS
 ********/

$campo = 'hembras';
$cantidadHembras = ControladorDatosCompras::ctrSumarCampoRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);



/*********
 CANTIDAD DE ANIMALES Y PRECIO POR CONSIGNATARIO
 ********/

$campo = 'consignatario';
$consignatarios = ControladorDatosCompras::ctrMostrarDatosDistincRango($item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);

if(!empty($consignatarios)){

    $dataAnimalesConsignatario = array();

    $campo = 'cantidad';
    $campo2 = 'precioTotalKg';
    $campo3 = 'machos';
    $campo4 = 'hembras';
    $campo5 = 'kgComprado';
    $item = 'consignatario';
    $item2 = 'fecha';

    for ($i=0; $i < sizeof($consignatarios) ; $i++) { 
        
        $consignatario = $consignatarios[$i][0];

        $dataAnimalesConsignatario[$i]['nombre'] = $consignatario;

        $cantAnimales = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['animales'] = $cantAnimales[0];

        $precioTotal = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo2,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['precio'] = $precioTotal[0];
    
        $cantMachos = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo3,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['machos'] = $cantMachos[0];

        $cantHembras = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo4,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['hembras'] = $cantHembras[0];

        $kgComprado = ControladorDatosCompras::ctrSumarCampoRango($item,$consignatario,$campo5,$item2,$fechaInicial,$fechaFinal);
        $dataAnimalesConsignatario[$i]['kgComprado'] = $kgComprado[0];
    }


    /*********
     CANTIDAD DE ANIMALES POR PROVEEDOR
    ********/

    $cantidadAnimalesProveedores = '';
    $campo = 'proveedor';
    $item = null;
    $valor = null;
    $item2 = 'fecha';  
    $proveedores = ControladorDatosCompras::ctrMostrarDatosDistincRango($item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);

    $cantAnimalesProveedores = array();

    $item = 'proveedor';

    for ($i=0; $i < sizeof($proveedores) ; $i++) { 
        
        $valor = $proveedores[$i][0];
        
        $proveedor = (strlen($valor) > 20) ? substr($valor,0,20) : $valor;


        $cantAnimalesProveedores[$i]['nombre'] = $proveedor;

        $campo = 'cantidad';
        
        $cantidadAnimales = ControladorDatosCompras::ctrSumarCampoRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);

        $cantAnimalesProveedores[$i]['cantidad'] = $cantidadAnimales[0];

    }

    $arrayProveedorCantidad = array();

    for ($aa=0; $aa < sizeof($cantAnimalesProveedores) ; $aa++) { 
        
        $proveedor = $cantAnimalesProveedores[$aa]['nombre'];
        $cantidad = $cantAnimalesProveedores[$aa]['cantidad'];
        $arrayProveedorCantidad[$proveedor] = $cantidad;

    }      

    arsort($arrayProveedorCantidad);
    $cantidadAnimalesProveedores = '';
    $nombreProveedores = '';

    $contador = 0;
    foreach ($arrayProveedorCantidad as $key => $value) {
        
        if ($contador == 5) {
        break;
        }
        $cantidadAnimalesProveedores = $cantidadAnimalesProveedores."{
            label: '".$key."',
            backgroundColor:'".$colores2[$contador]."',
            borderColor: '".$colores2[$contador]."',
            borderWidth: 1,
            data: [".$value."]
        },";
        
        $nombreProveedores = $nombreProveedores."'".$key."',";
        
        $contador++;
    }

    $cantidadAnimalesProveedores = substr($cantidadAnimalesProveedores,0,-1);
    $nombreProveedores = substr($nombreProveedores,0,-1);


    $cantMachosHembras = $cantidadMachos[0][0].','.$cantidadHembras[0][0];

    $nombresPorConsignatarioResumidos = "'".substr($dataAnimalesConsignatario[0]['nombre'],0,6)."'";

    $nombresPorConsignatario = "'".$dataAnimalesConsignatario[0]['nombre']."'";
    
    $animalesPorConsignatario = $dataAnimalesConsignatario[0]['animales'];
    
    $dataSetAnimalesPorConsignatario = "{
        label: '".$dataAnimalesConsignatario[0]['nombre']."',
        type: 'bar',
        backgroundColor: '".$colores2[0]."',
        yAxisID: 'B',
        data: [". $dataAnimalesConsignatario[0]['animales']."],
        borderColor: 'white',
        borderWidth: 2
    }";


    $machosPorConsignatario = $dataAnimalesConsignatario[0]['machos'];
    $hembrasPorConsignatario = $dataAnimalesConsignatario[0]['hembras'];

    $hembrasPorConsignatarioPorcentaje = round(porcentaje($dataAnimalesConsignatario[0]['hembras'], $dataAnimalesConsignatario[0]['animales']));
    $machosPorConsignatarioPorcentaje = round(porcentaje($dataAnimalesConsignatario[0]['machos'], $dataAnimalesConsignatario[0]['animales']));
    
    $precioTotalPorConsignatario = $dataAnimalesConsignatario[0]['precio'];
    
    $precioPromedioTotalPorConsignatario = number_format($dataAnimalesConsignatario[0]['precio'] / $dataAnimalesConsignatario[0]['kgComprado'] , 2);

    $coloresConsignatario = "'".$colores2[0]."'";


    for ($i=1; $i < sizeof($dataAnimalesConsignatario) ; $i++) { 

        $nombresPorConsignatario = $nombresPorConsignatario.",'".$dataAnimalesConsignatario[$i]['nombre']."'";

        $nombresPorConsignatarioResumidos = $nombresPorConsignatarioResumidos.",'".substr($dataAnimalesConsignatario[$i]['nombre'],0,5)."'";

        $animalesPorConsignatario = $animalesPorConsignatario.','.$dataAnimalesConsignatario[$i]['animales'];

        $dataSetAnimalesPorConsignatario = $dataSetAnimalesPorConsignatario.",{
            label: '".$dataAnimalesConsignatario[$i]['nombre']."',
            type: 'bar',
            backgroundColor: '".$colores2[$i]."',
            yAxisID: 'B',
            data: [". $dataAnimalesConsignatario[$i]['animales']."],
            borderColor: 'white',
            borderWidth: 2
        }";



        $machosPorConsignatario = $machosPorConsignatario.','.$dataAnimalesConsignatario[$i]['machos'];
        $hembrasPorConsignatario = $hembrasPorConsignatario.','.$dataAnimalesConsignatario[$i]['hembras'];

        $hembrasPorConsignatarioPorcentaje = $hembrasPorConsignatarioPorcentaje.','.round(porcentaje($dataAnimalesConsignatario[$i]['hembras'], $dataAnimalesConsignatario[$i]['animales']));
        $machosPorConsignatarioPorcentaje = $machosPorConsignatarioPorcentaje.','.round(porcentaje($dataAnimalesConsignatario[$i]['machos'], $dataAnimalesConsignatario[$i]['animales']));


        $precioTotalPorConsignatario = $precioTotalPorConsignatario.','.$dataAnimalesConsignatario[$i]['precio'];
        $precioPromedioTotalPorConsignatario = $precioPromedioTotalPorConsignatario.','.number_format($dataAnimalesConsignatario[$i]['precio'] / $dataAnimalesConsignatario[$i]['kgComprado'] , 2);


        $coloresConsignatario = $coloresConsignatario.",'".$colores2[$i]."'";

        
    }

    $dataAnimalesConsignatario = json_encode($dataAnimalesConsignatario);
    
    
}

?>
