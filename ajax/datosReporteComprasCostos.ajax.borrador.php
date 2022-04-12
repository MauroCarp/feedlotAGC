<?php

$colores = array('red','blue','green','yellow','orange','purple','grey');

$colores2 = array('#F5B7B1','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB','#00ffcc','#6699ff','#ff66cc','#99ff33','#9966ff','#999966','#ccffcc','#ffccff','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB','#00ffcc','#6699ff','#ff66cc','#99ff33','#9966ff','#999966','#ccffcc','#ffccff');


function fechaUniversal($fecha){

    $fecha = explode('-',$fecha);

    $fechaUniversal = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

    return $fechaUniversal;

}
tosCompras::ctrMostrarDatosDistincRango($item, $valor,$campo,$item2,$fechaInicial,$fechaFinal);

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
     FECHAS PIRI ,$/Kg, KgTotalIngreso  DE CADA COMPRA COSTOS 

    ********/


    $item = null;
    $valor = null;
    $campo = 'fecha,kgComprado,precioTotalKg';
    $item2 = 'fecha';

    $data = ControladorDatosCompras::ctrMostrarDatosRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);
    $dataCostos = array();

    $campo = 'precio';

    $listaPiris = ControladorPiri::ctrMostrarDatos(null,null);
    $arrayFechaPiris = array();

    for ($p=0; $p < sizeof($listaPiris) ; $p++) { 
        
        $arrayFechaPiris[] = $listaPiris[$p]['fecha'];

    }

    for ($i=0; $i < sizeof($data) ; $i++) { 

        $fecha = $data[$i][0]; 

        $dataCostos[$i]['fecha'] = "'".formatearFecha($fecha)."'";
        
        $fechaBuscar = $fecha;
        
        if(!in_array($fecha,$arrayFechaPiris)){

            $arrayFechaPiris[] = $fecha;

            sort($arrayFechaPiris, SORT_STRING);

            $key = (array_search($fecha,$arrayFechaPiris) - 1);

            $fechaBuscar = $arrayFechaPiris[$key];

            $keyBorrar = $key + 1; 

            unset($arrayFechaPiris[$keyBorrar]);

        }
        
        $piri = ControladorDatosCompras::ctrBuscarPiri($item2,$fechaBuscar,$campo);

        $dataCostos[$i]['piri'] = $piri[0];

        $precioKg = ($data[$i][1] > 0) ? ($data[$i][2] / $data[$i][1]) : 0;

        $dataCostos[$i]['totalKg'] = $data[$i][1];

        $dataCostos[$i]['precioKg'] = number_format($precioKg,2,'.','');

    }


    
    $fechasCompra = fechaUniversal($dataCostos[0]['fecha']);
    var_dump($dataCostos[0]['fecha']);


    $precioKilo = $dataCostos[0]['precioKg'];
    $precioPiri = $dataCostos[0]['piri'];
    $totalKgIng = $dataCostos[0]['totalKg'];


    for ($i=1; $i < sizeof($dataCostos) ; $i++) { 

        $fecha = fechaUniversal($dataCostos[$i]['fecha']);

        $fechasCompra = $fechasCompra.','.$fecha;

        $precioKilo = $precioKilo.','.$dataCostos[$i]['precioKg'];

        $precioPiri = $precioPiri.','.$dataCostos[$i]['piri'];

        $totalKgIng = $totalKgIng.','.$dataCostos[$i]['totalKg'];


    }    
    
}

foreach ($dataCostos as $key => $value) {

    $aux[$key] = $value['fecha'];

}

array_multisort($aux, SORT_ASC, $dataCostos);

foreach ($dataCostos as $key => $value) {
    
    echo $value['fecha']."<br>";

}

?>
