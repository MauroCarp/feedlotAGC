<?php

require_once "../controladores/panelControl.controlador.php";

require_once "../modelos/panelControl.modelo.php";

$periodo = $_POST['periodo'];


$item = 'periodo';

$valor = $periodo;

// CONVERSION

$campo = 'converMSEstADPV';

$conversion = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['Conversion'] = number_format($conversion[0],2);

// COSTO KG MS

$campo = 'CKgRacPromMS';

$costoKgMS = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['CostoKgMS'] = number_format($costoKgMS[0],2);

// POBLACION

$campo = 'poblDiaPromPeriodo';

$poblacion = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['Poblacion'] = $poblacion[0];

// ESTADIA

$campo = 'estadiaProm';

$estadia = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['Estadia'] = $estadia[0];


// INDICE REPOSICION

$campo = 'indiceReposicion';

$indiceReposicion = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['IndiceReposicion'] = $indiceReposicion[0];

// $ KILO PROD

$campo = 'CProdKgAES';

$costoKg = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['KgProd'] = $costoKg[0];

// MARGEN TECNICO

$campo = 'margenTecKgProd';

$margenTec = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['MargenTec'] = $margenTec[0];

// CABEZAS SALIDAS

$campo = 'cabTrazSalidas';

$cabSalidas = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['CabSalidas'] = $cabSalidas[0];

// KG GANADOS PERIODO TRAZAD

$campo = 'kilosGanPeriodoTraz';

$kgGanPeriodoTraz = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['KgGanPerTraz'] = $kgGanPeriodoTraz[0];

// CONSUMO SOJA

$campo = 'consumoSoja';

$consumoSoja = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['ConsumoSoja'] = $consumoSoja[0];

// CONSUMO MAIZ

$campo = 'consumoMaiz';

$consumoMaiz = ControladorPanelControl::ctrMostrarDato($campo,$item,$valor);

$dataGraficos['ConsumoMaiz'] = $consumoMaiz[0];

echo json_encode($dataGraficos);

?>