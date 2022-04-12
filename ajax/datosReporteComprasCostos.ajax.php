<?php

$colores = array('red','blue','green','yellow','orange','purple','grey');

$colores2 = array('#F5B7B1','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB','#00ffcc','#6699ff','#ff66cc','#99ff33','#9966ff','#999966','#ccffcc','#ffccff','#C39BD3','#7FB3D5','#48C9B0','#F4D03F','#F5B041','#A1887F','#43A047','#D81B60','#76448A','#C62828','#3300FF','#BBDEFB','#00ffcc','#6699ff','#ff66cc','#99ff33','#9966ff','#999966','#ccffcc','#ffccff');


function fechaUniversal($fecha){

    $fecha = explode('-',$fecha);

    $fechaUniversal = $fecha[2].'-'.$fecha[1].'-'.$fecha[0];

    return $fechaUniversal;

}

    /*********
     FECHAS PIRI ,$/Kg, KgTotalIngreso  DE CADA COMPRA COSTOS 

    ********/


    // OBTENGO LOS DATOS DE COMPRAS DENTRO DEL RANGO

    $item = null;

    $valor = null;

    $campo = 'fecha,kgComprado,precioTotalKg,cantidad';

    $item2 = 'fecha';

    $data = ControladorDatosCompras::ctrMostrarDatosRango($item,$valor,$campo,$item2,$fechaInicial,$fechaFinal);

    
    
    $dataCostos = array();
    
    for ($i=0; $i < sizeof($data) ; $i++) { 

        $dataCostos[$i]['fecha'] = $data[$i]['fecha'];
        
        $precioKgPromedio = number_format(($data[$i]['precioTotalKg'] / $data[$i]['kgComprado']),2);

        $dataCostos[$i]['precioKgPromedio'] = $precioKgPromedio;

        $kilosTotalPromedio = number_format(($data[$i]['kgComprado'] / $data[$i]['cantidad']),2);

        $dataCostos[$i]['kilosPromedio'] = $kilosTotalPromedio;

        $campo = 'precio';

        $item = 'fecha';

        $fechaBuscar = $data[$i]['fecha'];

        
        $piri = ControladorDatosCompras::ctrBuscarPiri($item,$fechaBuscar,$campo);
        
        $dataCostos[$i]['precioPiri'] = $piri['precio'];

    }


    $fechasCompras = '';

    $precioKgPromedio = '';

    $kilosPromedio = '';

    $preciosPiri = '';

    function formatoFechaLabel($fecha){

        $fechaExplode = explode('-',$fecha);

        $fechaNueva = $fechaExplode[2]."-".$fechaExplode[1]."-".$fechaExplode[0];

        return $fechaNueva;

    }

    for ($a=0; $a < sizeof($dataCostos); $a++) { 

        $fechasCompras = $fechasCompras.",'".formatearFecha($dataCostos[$a]['fecha'])."'";
        
        $precioKgPromedio = $precioKgPromedio.','.$dataCostos[$a]['precioKgPromedio'];

        $kilosPromedio = $kilosPromedio.','.$dataCostos[$a]['kilosPromedio'];
        
        $preciosPiri = $preciosPiri.','.$dataCostos[$a]['precioPiri'];

    }
    
    ?>
