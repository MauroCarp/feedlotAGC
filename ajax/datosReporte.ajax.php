<?php

$colores = array('red','blue','green','yellow','grey','orange','purple','brown');

if(array_key_exists('consignatario1',$_GET)){
    
    $cantidad = $_GET['cantidad'];

    $rango = $_GET['rango'];
    $rango = explode('/',$rango);
    $fechaInicial = $rango[0];
    $fechaFinal = $rango[1];


    $datosGraficos = array();
    $datosGraficos[0] = array('nombre' => 'General');
    
    $datos = array();
    $datos['labels'] = array('Consignatario'=>(''),'Proveedor'=>(''),'Tropa'=>(''));
    $datos['cantidad'] = array('CC'=> (''),'RP'=> (''),'RC'=> (''),'T'=> (''));
    $datos['poblacion'] = array('CC'=> array('Data'=>'','Color'=>''),'RP'=> array('Data'=>'','Color'=>''),'RC'=> array('Data'=>'','Color'=>''),'T'=> array('Data'=>'','Color'=>''));
    $datos['dias']   = array('CC'=> (''),'RP'=> (''),'RC'=> (''),'T'=> (''));
    $datos['adpv']   = array('CC'=> (''),'RP'=> (''),'RC'=> (''),'T'=> (''));
    $datos['kgIng']  = array('CC'=> (''),'RP'=> (''),'RC'=> (''),'T'=> (''));
    $datos['kgEgr']  = array('CC'=> (''),'RP'=> (''),'RC'=> (''),'T'=> (''));
    $datos['kgProd'] = array('CC'=> (''),'RP'=> (''),'RC'=> (''),'T'=> (''));

    $label = '';
    $labelArray = array();

    /*********  GENERAL
                                ********/
        
        $etiqueta = 'General';
        $item = NULL;
        $valor = NULL;
        $item2 = NULL;
        $valor2 = NULL;
        $operador = '!=';
        $item3 = 'fechaSalida';
        $totalGCC = ControladorDatos::ctrContarDatosRango($item,$valor,$item2,$valor2,$operador,$item3,$fechaInicial,$fechaFinal);
        
        $item = 'adpvRP';
        $valor = '';
        $totalGRP = ControladorDatos::ctrContarDatosRango($item,$valor,$item2,$valor2,$operador,$item3,$fechaInicial,$fechaFinal);
        
        $item = 'adpvRC';
        $totalGRC = ControladorDatos::ctrContarDatosRango($item,$valor,$item2,$valor2,$operador,$item3,$fechaInicial,$fechaFinal);
        
        $item = 'adpvT';
        $totalGT = ControladorDatos::ctrContarDatosRango($item,$valor,$item2,$valor2,$operador,$item3,$fechaInicial,$fechaFinal);
        
        $totalAnimalesGCC = $totalGCC[0][0];
        $totalAnimalesGRP = $totalGRP[0];
        $totalAnimalesGRC = $totalGRC[0];
        $totalAnimalesGT = $totalGT[0];

        $dataSet = " {
            label: '".$etiqueta."',
            backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
            borderColor: window.chartColors.".$colores[0].",
            borderWidth: 1, 
            data: [".$totalAnimalesGCC."
            ]
        }";

        $datos['cantidad']['CC'] = $datos['cantidad']['CC'].",".$dataSet;

        $dataSet = " {
            label: '".$etiqueta."',
            backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
            borderColor: window.chartColors.".$colores[0].",
            borderWidth: 1, 
            data: [".$totalAnimalesGRP."
            ]
        }";

        $datos['cantidad']['RP'] = $datos['cantidad']['RP'].",".$dataSet;

        $dataSet = " {
            label: '".$etiqueta."',
            backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
            borderColor: window.chartColors.".$colores[0].",
            borderWidth: 1, 
            data: [".$totalAnimalesGRC."
            ]
        }";

        $datos['cantidad']['RC'] = $datos['cantidad']['RC'].",".$dataSet;

        $dataSet = " {
            label: '".$etiqueta."',
            backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
            borderColor: window.chartColors.".$colores[0].",
            borderWidth: 1, 
            data: [".$totalAnimalesGT."
            ]
        }";

        $datos['cantidad']['T'] = $datos['cantidad']['T'].",".$dataSet;


    /*********  ADPV
                                    ********/
            $item = NULL;
            $valor = NULL;

            //CC
            $campo = 'adpvCC';
            $sumaADPV = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $totalAdpvCC = $sumaADPV[0][0];
            $promedioAdpvCC = number_format(($totalAdpvCC / $totalAnimalesGCC),2);
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioAdpvCC."
                ]
            }";
            $datos['adpv']['CC'] = $datos['adpv']['CC'].",".$dataSet;
            $datosGraficos[0]['adpv'] = $promedioAdpvCC; 





            //RP
            $campo = 'adpvRP';
            $sumaADPV = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $totalAdpvRP = $sumaADPV[0][0];
            $promedioAdpvRP = number_format(($totalAdpvRP / $totalAnimalesGRP),2);
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioAdpvRP."
                ]
            }";
            $datos['adpv']['RP'] = $datos['adpv']['RP'].",".$dataSet;
            $datosGraficos[0]['adpv'] = $datosGraficos[0]['adpv'].','.$promedioAdpvRP; 

            
            //RC
            $campo = 'adpvRC';
            $sumaADPV = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $totalAdpvRC = $sumaADPV[0][0];
            $promedioAdpvRC = number_format(($totalAdpvRC / $totalAnimalesGRC),2);
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioAdpvRC."
                ]
            }";
            $datos['adpv']['RC'] = $datos['adpv']['RC'].",".$dataSet;
            $datosGraficos[0]['adpv'] = $datosGraficos[0]['adpv'].','.$promedioAdpvRC;
            
            //T
            $campo = 'adpvT';
            $sumaADPV = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $totalAdpvT = $sumaADPV[0][0];
            $promedioAdpvT = number_format(($totalAdpvT / $totalAnimalesGT),2);
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioAdpvT."
                ]
            }";
            $datos['adpv']['T'] = $datos['adpv']['T'].",".$dataSet;
            $datosGraficos[0]['adpv'] = $datosGraficos[0]['adpv'].','.$promedioAdpvT;
            
    /*********  DIAS 
                    ********/
            //CC
            $campo = 'diasCC';
            $totalDias = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $totalDiasCC = $totalDias[0][0];
            $promedioDiasCC = round(($totalDiasCC / $totalAnimalesGCC));
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioDiasCC."
                ]
            }";
            $datos['dias']['CC'] = $datos['dias']['CC'].",".$dataSet;
            
            //RP
            $campo = 'diasRP';
            $totalDias = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $totalDiasRP = $totalDias[0][0];
            $promedioDiasRP = round(($totalDiasRP / $totalAnimalesGRP));
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioDiasRP."
                ]
            }";
            $datos['dias']['RP'] = $datos['dias']['RP'].",".$dataSet;
        
            //RC
            
            $campo = 'diasRC';
            $totalDias = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $totalDiasRC = $totalDias[0][0];
            $promedioDiasRC = round(($totalDiasRC / $totalAnimalesGRC));
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioDiasRC."
                ]
            }";
            $datos['dias']['RC'] = $datos['dias']['RC'].",".$dataSet;
            
            //T

            $campo = 'diasT';
            $totalDias = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $totalDiasT = $totalDias[0][0];
            $promedioDiasT = round(($totalDiasT / $totalAnimalesGT));
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioDiasT."
                ]
            }";
            $datos['dias']['T'] = $datos['dias']['T'].",".$dataSet;
            
            
    /*********  KG INGRESO
                                        ********/
            //CC
            $campo = 'kgIngresoCC';
            $kilosIng = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosIngCC = $kilosIng[0][0];
            $promedioKgIngCC = number_format(($kilosIngCC / $totalAnimalesGCC));
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioKgIngCC."
                ]
            }";
            $datos['kgIng']['CC'] = $datos['kgIng']['CC'].",".$dataSet;

            //RP
            $campo = 'kgIngresoRP';
            $kilosIng = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosIngRP = $kilosIng[0][0];
            $promedioKgIngRP = number_format(($kilosIngRP / $totalAnimalesGRP),2);
                    $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioKgIngRP."
                ]
            }";
            $datos['kgIng']['RP'] = $datos['kgIng']['RP'].",".$dataSet;

            //RC
            $campo = 'kgIngresoRC';
            $kilosIng = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosIngRR = $kilosIng[0][0];
            $promedioKgIngRC = number_format(($kilosIngRR / $totalAnimalesGRC),2);
                    $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioKgIngRC."
                ]
            }";
            $datos['kgIng']['RC'] = $datos['kgIng']['RC'].",".$dataSet;

            //T
            
            $campo = 'kgIngresoT';
            $kilosIng = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosIngRR = $kilosIng[0][0];
            $promedioKgIngT = number_format(($kilosIngRR / $totalAnimalesGT),2);
                    $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[0].",
                borderWidth: 1, 
                data: [".$promedioKgIngT."
                ]
            }";
            $datos['kgIng']['T'] = $datos['kgIng']['T'].",".$dataSet;

    /*********  KG SALIDA
                                        ********/
            //CC
            $campo = 'kgSalidaCC';
            $kilosEgr = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosEgrCC = $kilosEgr[0][0];
            $promedioKgEgrCC = number_format(($kilosEgrCC / $totalAnimalesGCC));
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[0].",
                    borderWidth: 1, 
                    data: [".$promedioKgEgrCC."
                    ]
                }";
                $datos['kgEgr']['CC'] = $datos['kgEgr']['CC'].",".$dataSet;

            //RP
            $campo = 'kgSalidaRP';
            $kilosEgrPR = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosEgrPR = $kilosEgrPR[0][0];
            $promedioKgEgrRP = number_format(($kilosEgrPR / $totalAnimalesGRP),2);
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[0].",
                    borderWidth: 1, 
                    data: [".$promedioKgEgrRP."
                    ]
                }";
                $datos['kgEgr']['RP'] = $datos['kgEgr']['RP'].",".$dataSet;

            //RC
            $campo = 'kgSalidaRC';
            $kilosEgrPR = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosEgrPR = $kilosEgrPR[0][0];
            $promedioKgEgrRC = number_format(($kilosEgrPR / $totalAnimalesGRC),2);
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[0].",
                    borderWidth: 1, 
                    data: [".$promedioKgEgrRC."
                    ]
                }";
                $datos['kgEgr']['RC'] = $datos['kgEgr']['RC'].",".$dataSet;
            //T
            
            $campo = 'kgSalidaT';
            $kilosEgrPR = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosEgrPR = $kilosEgrPR[0][0];
            $promedioKgEgrT = number_format(($kilosEgrPR / $totalAnimalesGT),2);
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[0].",
                    borderWidth: 1, 
                    data: [".$promedioKgEgrT."
                    ]
                }";
                $datos['kgEgr']['T'] = $datos['kgEgr']['T'].",".$dataSet;
                                        
    
    /*********  KG PRODUCCION
                                        ********/

            //CC
            $campo = 'kgProdCC';
            $kilosProd = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosProdCC = $kilosProd[0][0];
            $promedioKgProdCC = round(($kilosProdCC / $totalAnimalesGCC));
            $dataSet = " {
                    label: '".$etiqueta."',
                    backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                        borderColor: window.chartColors.".$colores[0].",
                        borderWidth: 1, 
                        data: [".$promedioKgProdCC."
                        ]
                    }";
            $datos['kgProd']['CC'] = $datos['kgProd']['CC'].",".$dataSet;

            //RP
            $campo = 'kgProdRP';
            $kilosProd = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosProdRP = $kilosProd[0][0];

            $promedioKgProdRP = number_format(($kilosProdRP / $totalAnimalesGRP),2);
            $dataSet = " {
                    label: '".$etiqueta."',
                    backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                        borderColor: window.chartColors.".$colores[0].",
                        borderWidth: 1, 
                        data: [".$promedioKgProdRP."
                        ]
                    }";
            $datos['kgProd']['RP'] = $datos['kgProd']['RP'].",".$dataSet;

            //RC
            $campo = 'kgProdRC';
            $kilosProd = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosProdRC = $kilosProd[0][0];
            $promedioKgProdRC = number_format(($kilosProdRC / $totalAnimalesGRC),2);
            $dataSet = " {
                    label: '".$etiqueta."',
                    backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                        borderColor: window.chartColors.".$colores[0].",
                        borderWidth: 1, 
                        data: [".$promedioKgProdRC."
                        ]
                    }";
            $datos['kgProd']['RC'] = $datos['kgProd']['RC'].",".$dataSet;
            //T

            $campo = 'kgProdT';
            $kilosProd = ControladorDatos::ctrSumarCampoRango($item,$valor,$campo,$item3,$fechaInicial,$fechaFinal);
            $kilosProdT = $kilosProd[0][0];
            $promedioKgProdT = number_format(($kilosProdT / $totalAnimalesGT),2);
            $dataSet = " {
                    label: '".$etiqueta."',
                    backgroundColor: color(window.chartColors.".$colores[0].").alpha(0.5).rgbString(),
                        borderColor: window.chartColors.".$colores[0].",
                        borderWidth: 1, 
                        data: [".$promedioKgProdT."
                        ]
                    }";
            $datos['kgProd']['T'] = $datos['kgProd']['T'].",".$dataSet;


    /*********  KG CONSUMIDOS
                                        ********/

            //CC
            $item = 'adpvCC';
            $valor = '';
            $campo = 'totalKgTC';
            $operador = '!=';
            $item2 = 'fechaSalida';
            $kilosConsumidos = ControladorDatos::ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fechaInicial,$fechaFinal);
            $kilosConsumidosCC = number_format(($kilosConsumidos[0] / $totalDiasCC),2);
            $datosGraficos[0]['kg'] = $kilosConsumidosCC; 

            //RP

            $item = 'adpvRP';
            $kilosConsumidos = ControladorDatos::ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fechaInicial,$fechaFinal);
            $kilosConsumidosRP = number_format(($kilosConsumidos[0] / $totalDiasRP),2);
            $datosGraficos[0]['kg'] = $datosGraficos[0]['kg'].','.$kilosConsumidosRP; 


            //RC

            $item = 'adpvRC';
            $kilosConsumidos = ControladorDatos::ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fechaInicial,$fechaFinal);
            $kilosConsumidosRC = number_format(($kilosConsumidos[0] / $totalDiasRC),2);
            $datosGraficos[0]['kg'] = $datosGraficos[0]['kg'].','.$kilosConsumidosRC; 

            //T


            $item = 'adpvT';
            $kilosConsumidos = ControladorDatos::ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fechaInicial,$fechaFinal);
            $kilosConsumidosT = number_format(($kilosConsumidos[0] / $totalDiasT),2);
            $datosGraficos[0]['kg'] = $datosGraficos[0]['kg'].','.$kilosConsumidosT; 


        
    /*********  CONVERSION
                                        ********/

            $item = null;
            
            //CC
            $campo = 'convMSCC';
            
            $conversionCC = ControladorDatos::ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fechaInicial,$fechaFinal);
            
            $conversionCC = ($conversionCC[0][0] / $totalAnimalesGCC);
            
            $datosGraficos[0]['conv'] = number_format($conversionCC,2);
                    
            //RP
            $campo = 'convMSRP';
            
            $conversionRP = ControladorDatos::ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fechaInicial,$fechaFinal);
            
            $conversionRP = ($conversionRP[0][0] / $totalAnimalesGRP);
            
            $datosGraficos[0]['conv'] = $datosGraficos[0]['conv'].','.number_format($conversionRP,2);
            
            //RC
            $campo = 'convMSRC';
            
            $conversionRC = ControladorDatos::ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fechaInicial,$fechaFinal);
            
            $conversionRC = ($conversionRC[0][0] / $totalAnimalesGRC);
            
            $datosGraficos[0]['conv'] = $datosGraficos[0]['conv'].','.number_format($conversionRC,2);
            
            //T
            $campo = 'convMST';
            
            $conversionT = ControladorDatos::ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fechaInicial,$fechaFinal);
        
            $conversionT = ($conversionT[0][0] / $totalAnimalesGT);
        
            $datosGraficos[0]['conv'] = $datosGraficos[0]['conv'].','.number_format($conversionT,2);


        $cantidadAnimalesCCGeneral = $totalAnimalesGCC;
        $cantidadAnimalesRPGeneral = $totalAnimalesGRP;
        $cantidadAnimalesRCGeneral = $totalAnimalesGRC;
        $cantidadAnimalesTGeneral = $totalAnimalesGT;

        
        for ($i=1; $i <= $cantidad ; $i++) { 
        
        $consignatarioIndex = 'consignatario'.$i; 

        $proveedorIndex = 'proveedor'.$i; 

        $tropaIndex = 'tropa'.$i;
        
        
        $item = 'consignatario';
        $valor = $_GET[$consignatarioIndex];

        $item2 = 'proveedor';
        $valor2 = $_GET[$proveedorIndex];
        
        $item3 = 'tropa';
        $valor3 = $_GET[$tropaIndex];

        /*********  LABELS
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
            $datosGraficos[$i]['nombre'] = $etiqueta;

        
        /*********  CANTIDAD 
                     ********/
        
            $totalCC= ControladorDatosComparar::ctrContarAnimalesComparar($item,$item2,$item3,$valor,$valor2,$valor3,'adpvCC');
            
            $totalRP= ControladorDatosComparar::ctrContarAnimalesComparar($item,$item2,$item3,$valor,$valor2,$valor3,'adpvRP');
            
            $totalRC= ControladorDatosComparar::ctrContarAnimalesComparar($item,$item2,$item3,$valor,$valor2,$valor3,'adpvRC');
            
            $totalT= ControladorDatosComparar::ctrContarAnimalesComparar($item,$item2,$item3,$valor,$valor2,$valor3,'adpvT');
        
            $totalAnimalesCC = $totalCC[0];
            
            $totalAnimalesRP = $totalRP[0];
            
            $totalAnimalesRC = $totalRC[0];
            
            $totalAnimalesT = $totalT[0];
                
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$totalAnimalesCC."
                ]
            }";
            $datos['cantidad']['CC'] = $datos['cantidad']['CC'].",".$dataSet;
            
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$totalAnimalesRP."
                ]
            }";
            $datos['cantidad']['RP'] = $datos['cantidad']['RP'].",".$dataSet;
            
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$totalAnimalesRC."
                ]
            }";
            $datos['cantidad']['RC'] = $datos['cantidad']['RC'].",".$dataSet;
            
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$totalAnimalesT."
                ]
            }";
            $datos['cantidad']['T'] = $datos['cantidad']['T'].",".$dataSet;
        
        /*********  PIE % PARTICIPACION POBLACION
                                    ********/
            
                                    
            $datos['poblacion']['CC']['Data'] = $datos['poblacion']['CC']['Data'].",".$totalAnimalesCC;
            $datos['poblacion']['CC']['Color'] = $datos['poblacion']['CC']['Color'].",".'window.chartColors.'.$colores[$i];
            $cantidadAnimalesCCGeneral -= $totalAnimalesCC;
            
            $datos['poblacion']['RP']['Data'] = $datos['poblacion']['RP']['Data'].",".$totalAnimalesRP;
            $datos['poblacion']['RP']['Color'] = $datos['poblacion']['RP']['Color'].",".'window.chartColors.'.$colores[$i];
            $cantidadAnimalesRPGeneral -= $totalAnimalesRP;
            
            $datos['poblacion']['RC']['Data'] = $datos['poblacion']['RC']['Data'].",".$totalAnimalesRC;
            $datos['poblacion']['RC']['Color'] = $datos['poblacion']['RC']['Color'].",".'window.chartColors.'.$colores[$i];
            $cantidadAnimalesRCGeneral -= $totalAnimalesRC;
            
            $datos['poblacion']['T']['Data'] = $datos['poblacion']['T']['Data'].",".$totalAnimalesT;
            $datos['poblacion']['T']['Color'] = $datos['poblacion']['T']['Color'].",".'window.chartColors.'.$colores[$i];
            $cantidadAnimalesTGeneral -= $totalAnimalesT;
    
        

        /*********  KG CONSUMIDOS 
                        ********/
            //CC
            $item = 'adpvCC';
            $valor = '';
            $item2 = $columna;
            $valor2 = $etiqueta;
            $campo = 'totalKgTC';
            $operador = '!=';

            $kilosConsumidos = ControladorDatos::ctrSumarAlimento($item,$valor,$item2,$valor2,$campo,$operador);
            $kilosConsumidosCC = $kilosConsumidos[0];
            //RP
            
            $item = 'adpvRP';
            $kilosConsumidos = ControladorDatos::ctrSumarAlimento($item,$valor,$item2,$valor2,$campo,$operador);
            $kilosConsumidosRP = $kilosConsumidos[0];
            
            //RC
            
            $item = 'adpvRC';
            $kilosConsumidos = ControladorDatos::ctrSumarAlimento($item,$valor,$item2,$valor2,$campo,$operador);
            $kilosConsumidosRC = $kilosConsumidos[0];
            
            //T

            $item = 'adpvT';
            $kilosConsumidos = ControladorDatos::ctrSumarAlimento($item,$valor,$item2,$valor2,$campo,$operador);
            $kilosConsumidosT = $kilosConsumidos[0];
            

        /*********  DIAS 
                    ********/
        
            
            //CC
            
            $campo = 'diasCC';
            $totalDias = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $totalDias = $totalDias[0];
            $promedioDias = ($totalDias != 0) ? round(($totalDias / $totalAnimalesCC)) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioDias."
                ]
            }";
            $datos['dias']['CC'] = $datos['dias']['CC'].",".$dataSet;
            
            $kilosConsumidosCC =  ($totalDias == 0) ? 0 : number_format(($kilosConsumidosCC / $totalDias),2);
            $datosGraficos[$i]['kg'] = $kilosConsumidosCC; 

            
            //RP
            $campo = 'diasRP';
            $totalDias = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $totalDias = $totalDias[0];
            $promedioDias = ($totalDias != 0) ? round(($totalDias / $totalAnimalesRP)) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioDias."
                ]
            }";
            $datos['dias']['RP'] = $datos['dias']['RP'].",".$dataSet;

            $kilosConsumidosRP = ($totalDias == 0) ? 0 : number_format(($kilosConsumidosRP / $totalDias),2);
            $datosGraficos[$i]['kg'] = $datosGraficos[$i]['kg'].','.$kilosConsumidosRP; 

            
            //RC
            $campo = 'diasRC';
            $totalDias = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);

            $totalDias = $totalDias[0];
            $promedioDias = ($totalDias != 0) ? round(($totalDias / $totalAnimalesRC)) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioDias."
                ]
            }";
            $datos['dias']['RC'] = $datos['dias']['RC'].",".$dataSet;
            
            $kilosConsumidosRC =  ($totalDias == 0) ? 0 : number_format(($kilosConsumidosRC / $totalDias),2);
            $datosGraficos[$i]['kg'] = $datosGraficos[$i]['kg'].','.$kilosConsumidosRC;         
            
            //T
            $campo = 'diasT';
            $totalDias = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $totalDias = $totalDias[0];
            $promedioDias = ($totalDias != 0) ? round(($totalDias / $totalAnimalesT)) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioDias."
                ]
            }";
            $datos['dias']['T'] = $datos['dias']['T'].",".$dataSet;
            
            $kilosConsumidosT =  ($totalDias == 0) ? 0 : number_format(($kilosConsumidosT / $totalDias),2);
            $datosGraficos[$i]['kg'] = $datosGraficos[$i]['kg'].','.$kilosConsumidosT;    
            

        /*********  ADPV 
                        ********/
        
            //CC
            
            $campo = 'adpvCC';
            $sumaADPV = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $totalAdpv = $sumaADPV[0];
            $promedioAdpv = ($totalAdpv != 0) ? number_format(($totalAdpv / $totalAnimalesCC),2) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioAdpv."
                ]
            }";
            $datos['adpv']['CC'] = $datos['adpv']['CC'].",".$dataSet;
            $datosGraficos[$i]['adpv'] = $promedioAdpv; 
            // $conversion = ($promedioAdpv != 0) ? number_format(($kilosConsumidosCC / $promedioAdpv),2) : 0;
            // $datosGraficos[$i]['conv'] = $conversion; 


            
            // RP
            $campo = 'adpvRP';
            $sumaADPV = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $totalAdpv = $sumaADPV[0];
            $promedioAdpv = ($totalAdpv != 0) ? number_format(($totalAdpv / $totalAnimalesRP),2) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioAdpv."
                ]
            }";
            $datos['adpv']['RP'] = $datos['adpv']['RP'].",".$dataSet;
            $datosGraficos[$i]['adpv'] = $datosGraficos[$i]['adpv'].','.$promedioAdpv; 

            // $conversion = ($promedioAdpv != 0) ? number_format(($kilosConsumidosRP / $promedioAdpv),2) : 0;
            // $datosGraficos[$i]['conv'] = $datosGraficos[$i]['conv'].','.$conversion; 
            


            // RC
            $campo = 'adpvRC';
            $sumaADPV = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $totalAdpv = $sumaADPV[0];
            $promedioAdpv = ($totalAdpv != 0) ? number_format(($totalAdpv / $totalAnimalesRC),2) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioAdpv."
                ]
            }";
            $datos['adpv']['RC'] = $datos['adpv']['RC'].",".$dataSet;
            $datosGraficos[$i]['adpv'] = $datosGraficos[$i]['adpv'].','.$promedioAdpv; 

            // $conversion = ($promedioAdpv != 0) ? number_format(($kilosConsumidosRC / $promedioAdpv),2) : 0;
            // $datosGraficos[$i]['conv'] = $datosGraficos[$i]['conv'].','.$conversion;
            


            // T
            $campo = 'adpvT';
            $sumaADPV = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $totalAdpv = $sumaADPV[0];
            $promedioAdpv = ($totalAdpv != 0) ? number_format(($totalAdpv / $totalAnimalesT),2) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioAdpv."
                ]
            }";
            $datos['adpv']['T'] = $datos['adpv']['T'].",".$dataSet;
            $datosGraficos[$i]['adpv'] = $datosGraficos[$i]['adpv'].','.$promedioAdpv; 

            // $conversion = ($promedioAdpv != 0) ? number_format(($kilosConsumidosT / $promedioAdpv),2) : 0;
            // $datosGraficos[$i]['conv'] = $datosGraficos[$i]['conv'].','.$conversion;

   
        /*********  KG INGRESO
                    ********/
            
            //CC
            $campo = 'kgIngresoCC';
            $kilosIng = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $kilosIng = $kilosIng[0];
            $promedioKgIng = ($kilosIng != 0) ? number_format(($kilosIng / $totalAnimalesCC),2) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioKgIng."
                ]
            }";
            $datos['kgIng']['CC'] = $datos['kgIng']['CC'].",".$dataSet;
            
            
            
            //RP
            $campo = 'kgIngresoRP';
            $kilosIng = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $kilosIng = $kilosIng[0];
            $promedioKgIng = ($kilosIng != 0) ? number_format(($kilosIng / $totalAnimalesRP),2) : 0;
            $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                    data: [".$promedioKgIng."
                    ]
                }";
                $datos['kgIng']['RP'] = $datos['kgIng']['RP'].",".$dataSet;
    
            //RC
                $campo = 'kgIngresoRC';
                $kilosIng = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosIng = $kilosIng[0];
                $promedioKgIng = ($kilosIng != 0) ? number_format(($kilosIng / $totalAnimalesRC),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgIng."
                    ]
                }";
                $datos['kgIng']['RC'] = $datos['kgIng']['RC'].",".$dataSet;
    
            //T
                $campo = 'kgIngresoT';
                $kilosIng = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosIng = $kilosIng[0];
                $promedioKgIng = ($kilosIng != 0) ? number_format(($kilosIng / $totalAnimalesT),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgIng."
                    ]
                }";
                $datos['kgIng']['T'] = $datos['kgIng']['T'].",".$dataSet;
    
    
    
        /*********  KG SALIDA
                                    ********/

            //CC
                $campo = 'kgSalidaCC';
                $kilosEgr = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosEgr = $kilosEgr[0];
                $promedioKgEgr = ($kilosEgr != 0) ? number_format(($kilosEgr / $totalAnimalesCC),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgEgr."
                    ]
                }";
                $datos['kgEgr']['CC'] = $datos['kgEgr']['CC'].",".$dataSet;



            //RP
                $campo = 'kgSalidaRP';
                $kilosEgr = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosEgr = $kilosEgr[0];
                $promedioKgEgr = ($kilosEgr != 0) ? number_format(($kilosEgr / $totalAnimalesRP),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgEgr."
                    ]
                }";
                $datos['kgEgr']['RP'] = $datos['kgEgr']['RP'].",".$dataSet;

            //RC
            $campo = 'kgSalidaRC';
                $kilosEgr = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $kilosEgr = $kilosEgr[0];
            $promedioKgEgr = ($kilosEgr != 0) ? number_format(($kilosEgr / $totalAnimalesRC),2) : 0;
            $dataSet = " {
            label: '".$etiqueta."',
            backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                borderColor: window.chartColors.".$colores[$i].",
                borderWidth: 1, 
                data: [".$promedioKgEgr."
                ]
            }";
            $datos['kgEgr']['RC'] = $datos['kgEgr']['RC'].",".$dataSet;

            //T
                $campo = 'kgSalidaT';
                    $kilosEgr = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosEgr = $kilosEgr[0];
                $promedioKgEgr = ($kilosEgr != 0) ? number_format(($kilosEgr / $totalAnimalesT),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgEgr."
                    ]
                }";
                $datos['kgEgr']['T'] = $datos['kgEgr']['T'].",".$dataSet;

                                
    
    
   
        /*********  KG PRODUCCION
                            ********/
            //CC
                $campo = 'kgProdCC';
                $kilosProd = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosProd = $kilosProd[0];
                $promedioKgProd = ($kilosProd != 0) ? number_format(($kilosProd / $totalAnimalesCC),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgProd."
                    ]
                }";
                $datos['kgProd']['CC'] = $datos['kgProd']['CC'].",".$dataSet;
    
    
    
            //RP
                $campo = 'kgProdRP';
                $kilosProd = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosProd = $kilosProd[0];
                $promedioKgProd = ($kilosProd != 0) ? number_format(($kilosProd / $totalAnimalesRP),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgProd."
                    ]
                }";
                $datos['kgProd']['RP'] = $datos['kgProd']['RP'].",".$dataSet;
    
            //RC
                $campo = 'kgProdRC';
                    $kilosProd = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosProd = $kilosProd[0];
                $promedioKgProd = ($kilosProd != 0) ? number_format(($kilosProd / $totalAnimalesRC),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgProd."
                    ]
                }";
                $datos['kgProd']['RC'] = $datos['kgProd']['RC'].",".$dataSet;
    
            //T
                $campo = 'kgProdT';
                $kilosProd = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
                $kilosProd = $kilosProd[0];
                $promedioKgProd = ($kilosProd != 0) ? number_format(($kilosProd / $totalAnimalesT),2) : 0;
                $dataSet = " {
                label: '".$etiqueta."',
                backgroundColor: color(window.chartColors.".$colores[$i].").alpha(0.5).rgbString(),
                    borderColor: window.chartColors.".$colores[$i].",
                    borderWidth: 1, 
                    data: [".$promedioKgProd."
                    ]
                }";
                $datos['kgProd']['T'] = $datos['kgProd']['T'].",".$dataSet;
                
        /*********  CONVERSION
                            ********/
            //CC
            $campo  = 'convMSCC'; 
            $conversionCC = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $conversionCC =  ($totalAnimalesCC == 0) ? 0 : ($conversionCC[0] / $totalAnimalesCC);
            $datosGraficos[$i]['conv'] = number_format($conversionCC,2);
            
            //RP
            $campo  = 'convMSRP'; 
            $conversionRP = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $conversionRP = ($totalAnimalesRP == 0) ? 0 : ($conversionRP[0] / $totalAnimalesRP);
            $datosGraficos[$i]['conv'] = $datosGraficos[$i]['conv'].','.number_format($conversionRP,2);
            
            //RC
            $campo  = 'convMSRC'; 
            $conversionRC = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $conversionRC =  ($totalAnimalesRC == 0) ? 0 : ($conversionRC[0] / $totalAnimalesRC);
            $datosGraficos[$i]['conv'] = $datosGraficos[$i]['conv'].','.number_format($conversionRC,2);
        
            //T
            $campo  = 'convMST'; 
            $conversionT = ControladorDatosComparar::ctrSumarCampoComparar($item,$item2,$item3,$valor,$valor2,$valor3,$campo);
            $conversionT =  ($totalAnimalesT == 0) ? 0 : ($conversionT[0] / $totalAnimalesT);
            $datosGraficos[$i]['conv'] = $datosGraficos[$i]['conv'].','.number_format($conversionT,2);
            
    
    }
    
    // % PARTICIPACION
        // CC
        $datos['poblacion']['CC']['Data'] = $datos['poblacion']['CC']['Data'].",".$cantidadAnimalesCCGeneral;
        $datos['poblacion']['CC']['Color'] = $datos['poblacion']['CC']['Color'].",".'window.chartColors.'.$colores[$i + 1];

        // RP
        $datos['poblacion']['RP']['Data'] = $datos['poblacion']['RP']['Data'].",".$cantidadAnimalesRPGeneral;
        $datos['poblacion']['RP']['Color'] = $datos['poblacion']['RP']['Color'].",".'window.chartColors.'.$colores[$i + 1];

        // RC
        $datos['poblacion']['RC']['Data'] = $datos['poblacion']['RC']['Data'].",".$cantidadAnimalesRCGeneral;
        $datos['poblacion']['RC']['Color'] = $datos['poblacion']['RC']['Color'].",".'window.chartColors.'.$colores[$i + 1];

        // T
        $datos['poblacion']['T']['Data'] = $datos['poblacion']['T']['Data'].",".$cantidadAnimalesTGeneral;
        $datos['poblacion']['T']['Color'] = $datos['poblacion']['T']['Color'].",".'window.chartColors.'.$colores[$i + 1];

    
    // CANTIDAD
    $cantidadCC = substr($datos['cantidad']['CC'],2);
    $cantidadRP = substr($datos['cantidad']['RP'],2);
    $cantidadRC = substr($datos['cantidad']['RC'],2);
    $cantidadT = substr($datos['cantidad']['T'],2);
    
    //POBLACION
    $poblacionCC =  substr($datos['poblacion']['CC']['Data'],1);
    $poblacionRP =  substr($datos['poblacion']['RP']['Data'],1);
    $poblacionRC =  substr($datos['poblacion']['RC']['Data'],1);
    $poblacionT =  substr($datos['poblacion']['T']['Data'],1);
    
    $coloresCC = substr($datos['poblacion']['CC']['Color'],1);
    $coloresRP = substr($datos['poblacion']['RP']['Color'],1);
    $coloresRC = substr($datos['poblacion']['RC']['Color'],1);
    $coloresT = substr($datos['poblacion']['T']['Color'],1);
    
    // ADPV
    $adpvCC = substr($datos['adpv']['CC'],2);
    $adpvRP = substr($datos['adpv']['RP'],2);
    $adpvRC = substr($datos['adpv']['RC'],2);
    $adpvT = substr($datos['adpv']['T'],2);
    
    //DIAS
    $diasCC = substr($datos['dias']['CC'],2);
    $diasRP = substr($datos['dias']['RP'],2);
    $diasRC = substr($datos['dias']['RC'],2);
    $diasT = substr($datos['dias']['T'],2);
    
    //KG INF
    $kgIngCC = substr($datos['kgIng']['CC'],2);
    $kgIngRP = substr($datos['kgIng']['RP'],2);
    $kgIngRC = substr($datos['kgIng']['RC'],2);
    $kgIngT = substr($datos['kgIng']['T'],2);
    
    //KG EGR
    $kgEgrCC = substr($datos['kgEgr']['CC'],2);
    $kgEgrRP = substr($datos['kgEgr']['RP'],2);
    $kgEgrRC = substr($datos['kgEgr']['RC'],2);
    $kgEgrT = substr($datos['kgEgr']['T'],2);
    
    //KG PROD
    $kgProdCC = substr($datos['kgProd']['CC'],2);
    $kgProdRP = substr($datos['kgProd']['RP'],2);
    $kgProdRC = substr($datos['kgProd']['RC'],2);
    $kgProdT = substr($datos['kgProd']['T'],2);
    
    
    // conversion

    

    $consignatarios = substr($datos['labels']['Consignatario'],1);
    
    $tropas = substr($datos['labels']['Tropa'],1);
    
    $label = substr($label,2);
    $label = $label."'";
    $datosGraficos = json_encode($datosGraficos);
}
?>
