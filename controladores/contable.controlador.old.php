<?php

class ControladorContable{

	/*=============================================
	CARGAR ARCHIVO
	=============================================*/
    
	static public function ctrCargarArchivo(){

        function formatearNumero($number){

            return str_replace('*','.',
                                        str_replace(',','',
                                                    str_replace('.','*',
                                                                str_replace('?','',$number))));

        }

        function numberPaihuen($number){
            return str_replace('(','',str_replace(')','',str_replace('*','',str_replace(',','',str_replace('?','',$number)))));
        }
        // VALIDAR INGRESOS REPETIDOS⁄
        
        if(isset($_POST['btnCargar'])){
            
            require_once('extensiones/excel/php-excel-reader/excel_reader2.php');
            require_once('extensiones/excel/SpreadsheetReader.php');

            if(isset($_FILES['nuevosDatosBarlovento'])){

                $tabla = 'contable';
                
                $error = false;
                
                $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    
                if(in_array($_FILES["nuevosDatosBarlovento"]["type"],$allowedFileType)){
    
                    $ruta = "carga/" . $_FILES['nuevosDatosBarlovento']['name'];
                    
                    move_uploaded_file($_FILES['nuevosDatosBarlovento']['tmp_name'], $ruta);
                    
                    $nombreArchivo = str_replace(' ', '',$_FILES['nuevosDatosBarlovento']['name']);
                                            
                    $rowNumber = 0;
                    
                    $rowValida = false;
                    
                    $dateTime = date('Y-m-d H:i:s');
    
                    $Reader = new SpreadsheetReader($ruta);	
                    
                    $sheetCount = count($Reader->sheets());
                    
                    $data = array('archivo'=>$_FILES['nuevosDatosBarlovento']['name'],'libro'=>'Principal','prestamos' => array(),'tarjetas' => array(),'honorarios' => array());
    
                    for($i=0;$i<$sheetCount;$i++){
    
                        $Reader->ChangeSheet($i);
    
                        foreach ($Reader as $Row){
    
                            if($rowNumber == 4){
    
                                $año = substr(substr($Row[4],-7),3);
    
                                $mes = substr(substr($Row[4],-7),0,2);
    
                                $date = "$año-$mes-01";
                            
                                $data['periodo'] = $date;
    
                                $item = 'libro';
                                
                                $valor = 'Principal';
    
                                $item2 = 'periodo';
    
                                $valor2 = $data['periodo'];
                                                       
                                $cargaValida = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);
    
                                if($cargaValida){
                                    
                                    echo'<script>
        
                                        swal({
                                                type: "error",
                                                title: "Ya hay una planilla Principal en este periodo!",
                                                showConfirmButton: true,
                                                confirmButtonText: "Cerrar"
                                                }).then(function(result) {
                                                if (result.value) {
                                                    
                                                    window.location = "index.php?ruta=contable/contable"
                    
                                                }
                                            })
                    
                                        </script>';

                                        die();
                                }
                                
                                
                            }

                            
                            if($rowNumber >= 6){

                                if($Row[1] == '1.00.00.00.000')
                                    $data['activos'] = $Row[5]; 
                                
                                if($Row[1] == '1.01.00.00.000')
                                    $data['activoCorriente'] = $Row[5]; 
                                
                                if($Row[1] == '2.01.01.00.000')
                                    $data['deudaTotal'] = $Row[5];    

                                if($Row[1] == '2.01.01.02.010' || $Row[1] == '2.01.01.02.011' || $Row[1] == '2.01.01.02.015' || $Row[1] == '2.01.01.02.016' || $Row[1] == '2.01.01.08.000')
                                    $data['prestamos'][] = $Row[5];
    
                                
                                if($Row[1] == '2.01.01.02.012' || $Row[1] == '2.01.01.02.013' || $Row[1] == '2.01.01.02.014')
                                    $data['tarjetas'][] = $Row[5];
    
                                
                                if($Row[1] == '2.01.01.07.000')
                                    $data['mutuales'] = $Row[5]; 
    
                            
                                if($Row[1] == '2.01.01.01.000')
                                    $data['proveedores'] = $Row[5]; 
            
                            
                                if($Row[1] == '5.01.01.14.004' || $Row[1] == '5.01.01.14.005' || $Row[1] == '5.01.01.14.006' || $Row[1] == '5.02.01.02.017' || $Row[1] == '5.02.01.05.003' || $Row[1] == '5.02.01.06.011')
                                    $data['seguros'][] = $Row[5]; 
    
                                if($Row[1] == '4.00.00.00.000')
                                    $data['ganancias'] = $Row[5]; 
    
                                if($Row[1] == '5.00.00.00.000')
                                    $data['perdidas'] = $Row[5]; 
    
                                if($Row[1] == '2.01.01.02.000')
                                    $data['deudaBancaria'] = $Row[5]; 
    
                                if($Row[1] == '1.01.03.03.006')
                                    $data['saldoTecnico'] = $Row[5]; 

                                if($Row[1] == '1.01.03.03.008')
                                    $data['sld'] = $Row[5]; 
                                
                                if($Row[1] == '1.01.04.00.000')
                                    $data['bienesDeCambio'] = $Row[5]; 
                                
                                if($Row[1] == '1.01.01.01.000')
                                    $data['cajaBancos'] = $Row[5]; 
                                
                                if($Row[1] == '2.01.00.00.000')
                                    $data['pasivoCorriente'] = $Row[5]; 
                                
                                if($Row[1] == '2.00.00.00.000')
                                    $data['pasivoTotal'] = $Row[5]; 
                            
                                if($Row[1] == '3.00.00.00.000')
                                    $data['patrimonioNeto'] = $Row[5]; 
    
                                if($Row[1] == '4.01.01.00.000')
                                    $data['agricultura'] = $Row[5]; 
                                
                                if($Row[1] == '4.01.02.00.000')
                                    $data['ganaderia'] = $Row[5]; 
    
                                if($Row[1] == '4.01.05.00.000' || $Row[1] == '4.02.00.00.000')
                                    $data['resto'][] = $Row[5]; 
    
                                if($Row[1] == '5.02.01.01.001')
                                    $data['ingresoBrutoMensual'] = $Row[5]; 
                                
                                if($Row[1] == '5.02.01.06.005')
                                    $data['inmobiliario'] = $Row[5]; 
    
                                if($Row[1] == '5.02.01.05.002')
                                    $data['cargasSocialesReales'] = $Row[5]; 
    
                                if($Row[1] == '5.02.01.05.001')
                                    $data['sueldos'] = $Row[5]; 
                            
                                if($Row[1] == '5.02.01.06.006' || $Row[1] == '5.02.01.06.007' || $Row[1] == '5.02.01.06.008' || $Row[1] == '5.02.01.06.009')
                                    $data['honorarios'][] = $Row[5]; 
    
                        
                            }
                                
                            $rowNumber++;
    
                        }
                            
                    }
                

                    $data['resto'] = array_sum($data['resto']);
                    $data['prestamos'] = array_sum($data['prestamos']);
                    $data['tarjetas'] = array_sum($data['tarjetas']);
                    $data['seguros'] = array_sum($data['seguros']);
                    $data['honorarios'] = array_sum($data['honorarios']);
                    
                    $respuesta = ModeloContable::mdlCargarArchivo($tabla,$data);
    
                    $errors = array($respuesta);
                
                    if(in_array('error',$respuesta)){
    
                        echo'<script>
        
                            swal({
                                    type: "error",
                                    title: "¡No se pudo cargar la planilla!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result) {
                                    if (result.value) {
                                        
                                        
        
                                    }
                                })
        
                            </script>';
    
                    }else{
    
                        echo'<script>
    
                        swal({
                                type: "success",
                                title: "La planilla ha sido cargada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result) {
                                        if (result.value) {
    
    
                                        }
                                    })
    
                        </script>';
    
                    }
    
                }

            }
    
            if(isset($_FILES['nuevosDatosBarloventoConsolidado'])){
    
                $tabla = 'contable';
    
                $error = false;
                
                $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

                if(in_array($_FILES["nuevosDatosBarloventoConsolidado"]["type"],$allowedFileType)){
    
                    $ruta = "carga/" . $_FILES['nuevosDatosBarloventoConsolidado']['name'];
                    
                    move_uploaded_file($_FILES['nuevosDatosBarloventoConsolidado']['tmp_name'], $ruta);
                    
                    $nombreArchivo = str_replace(' ', '',$_FILES['nuevosDatosBarloventoConsolidado']['name']);
                                            
                    $rowNumber = 0;
                    
                    $rowValida = false;
                    
                    $dateTime = date('Y-m-d H:i:s');
    
                    $Reader = new SpreadsheetReader($ruta);	
                    
                    $sheetCount = count($Reader->sheets());
                    
                    $data = array('archivo'=>$_FILES['nuevosDatosBarloventoConsolidado']['name'],'libro'=>'Consolidado','prestamos' => array(),'tarjetas' => array(),'honorarios' => array());
    
                    for($i=0;$i<$sheetCount;$i++){
    
                        $Reader->ChangeSheet($i);
    
                        foreach ($Reader as $Row){
    
                            if($rowNumber == 4){
    
                                $año = substr(substr($Row[4],-7),3);
    
                                $mes = substr(substr($Row[4],-7),0,2);
    
                                $date = "$año-$mes-01";
                            
                                $data['periodo'] = $date;

                                $item = 'libro';
                                
                                $valor = 'Consolidado';
    
                                $item2 = 'periodo';
    
                                $valor2 = $data['periodo'];
                                                       
                                $cargaValida = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);
    
                                if($cargaValida){

                                    echo'<script>
        
                                        swal({
                                                type: "error",
                                                title: "Ya hay una planilla Consolidado en este periodo!",
                                                showConfirmButton: true,
                                                confirmButtonText: "Cerrar"
                                                }).then(function(result) {
                                                if (result.value) {
                                                    
                                                    window.location = "index.php?ruta=contable/contable"
                    
                                                }
                                            })
                    
                                        </script>';

                                        die();
                                        

                                }

                            }                          

                            
                            if($rowNumber >= 6){

                                if($Row[1] == '1.00.00.00.000')
                                    $data['activos'] = $Row[5]; 
                                
                                if($Row[1] == '1.01.00.00.000')
                                    $data['activoCorriente'] = $Row[5]; 
                                
                                if($Row[1] == '2.01.01.00.000')
                                    $data['deudaTotal'] = $Row[5];    

                                if($Row[1] == '2.01.01.02.010' || $Row[1] == '2.01.01.02.011' || $Row[1] == '2.01.01.02.015' || $Row[1] == '2.01.01.02.016' || $Row[1] == '2.01.01.08.000')
                                    $data['prestamos'][] = $Row[5];
    
                                
                                if($Row[1] == '2.01.01.02.012' || $Row[1] == '2.01.01.02.013' || $Row[1] == '2.01.01.02.014')
                                    $data['tarjetas'][] = $Row[5]; 
    
                                
                                if($Row[1] == '2.01.01.07.000')
                                    $data['mutuales'] = $Row[5]; 
    
                            
                                if($Row[1] == '2.01.01.01.000')
                                    $data['proveedores'] = $Row[5]; 
            
                            
                                if($Row[1] == '5.01.01.14.004' || $Row[1] == '5.01.01.14.005' || $Row[1] == '5.01.01.14.006' || $Row[1] == '5.02.01.02.017' || $Row[1] == '5.02.01.05.003' || $Row[1] == '5.02.01.06.011')
                                    $data['seguros'][] = $Row[5];     
    
                                if($Row[1] == '4.00.00.00.000')
                                    $data['ganancias'] = $Row[5]; 
    
                                if($Row[1] == '5.00.00.00.000')
                                    $data['perdidas'] = $Row[5]; 
    
                                if($Row[1] == '2.01.01.02.000')
                                    $data['deudaBancaria'] = $Row[5]; 
    
                                if($Row[1] == '1.01.03.03.006')
                                    $data['saldoTecnico'] = $Row[5]; 

                                if($Row[1] == '1.01.03.03.008')
                                    $data['sld'] = $Row[5]; 
                                
                                if($Row[1] == '1.01.04.00.000')
                                    $data['bienesDeCambio'] = $Row[5]; 
                                
                                if($Row[1] == '1.01.01.01.000')
                                    $data['cajaBancos'] = $Row[5]; 
                                
                                if($Row[1] == '2.01.00.00.000')
                                    $data['pasivoCorriente'] = $Row[5]; 
                                
                                if($Row[1] == '2.00.00.00.000')
                                    $data['pasivoTotal'] = $Row[5]; 
                            
                                if($Row[1] == '3.00.00.00.000')
                                    $data['patrimonioNeto'] = $Row[5]; 
    
                                if($Row[1] == '4.01.01.00.000')
                                    $data['agricultura'] = $Row[5]; 
                                
                                if($Row[1] == '4.01.02.00.000')
                                    $data['ganaderia'] = $Row[5]; 
    
                                if($Row[1] == '4.01.05.00.000' || $Row[1] == '4.02.00.00.000')
                                    $data['resto'][] = $Row[5]; 
    
                                if($Row[1] == '5.02.01.01.001')
                                    $data['ingresoBrutoMensual'] = $Row[5]; 
                                
                                if($Row[1] == '5.02.01.06.005')
                                    $data['inmobiliario'] = $Row[5]; 
    
                                if($Row[1] == '5.02.01.05.002')
                                    $data['cargasSocialesReales'] = $Row[5]; 
    
                                if($Row[1] == '5.02.01.05.001')
                                    $data['sueldos'] = $Row[5]; 
                            
                                if($Row[1] == '5.02.01.06.006' || $Row[1] == '5.02.01.06.007' || $Row[1] == '5.02.01.06.008' || $Row[1] == '5.02.01.06.009')
                                    $data['honorarios'][] = $Row[5]; 
    
                        
                            }
                                
                            $rowNumber++;
    
                        }
                            
                    }
                
                    $data['resto'] = array_sum($data['resto']);
                    $data['prestamos'] = array_sum($data['prestamos']);
                    $data['tarjetas'] = array_sum($data['tarjetas']);
                    $data['seguros'] = array_sum($data['seguros']);
                    $data['honorarios'] = array_sum($data['honorarios']);
                    
                    $respuesta = ModeloContable::mdlCargarArchivo($tabla,$data);

                    $errors = array($respuesta);
                
                    if(in_array('error',$respuesta)){
    
                        echo'<script>
        
                            swal({
                                    type: "error",
                                    title: "¡No se pudo cargar la planilla!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result) {
                                    if (result.value) {
                                        
                                        
        
                                    }
                                })
        
                            </script>';
    
                    }else{
    
                        echo'<script>
    
                        swal({
                                type: "success",
                                title: "La planilla ha sido cargada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result) {
                                        if (result.value) {
    
    
                                        }
                                    })
    
                        </script>';
    
                    }
    
                }
    
            }
            
            if(isset($_FILES['nuevosDatosPaihuen'])){
    
                $tabla = 'contablePaihuen';

                $error = false;
                
                $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

                if(in_array($_FILES["nuevosDatosPaihuen"]["type"],$allowedFileType)){
    
                    $ruta = "carga/" . $_FILES['nuevosDatosPaihuen']['name'];
                    
                    move_uploaded_file($_FILES['nuevosDatosPaihuen']['tmp_name'], $ruta);
                    
                    $nombreArchivo = str_replace(' ', '',$_FILES['nuevosDatosPaihuen']['name']);
                                            
                    $rowNumber = 0;
                    
                    $rowValida = false;
                    
                    $dateTime = date('Y-m-d H:i:s');
    
                    $Reader = new SpreadsheetReader($ruta);	
                    
                    $sheetCount = count($Reader->sheets());
                    
                    $data = array('planilla'=>'paihuen','archivo'=>$_FILES['nuevosDatosPaihuen']['name'],'periodo'=>$_POST['periodoContable']."-01");

                    $item = NULL;
                            
                    $valor = 'Paihuen';

                    $item2 = 'periodo';

                    $valor2 = $data['periodo'];

                    $cargaValida = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);
    
                    if($cargaValida){
                        
                        echo'<script>

                            swal({
                                    type: "error",
                                    title: "Ya hay una planilla Paihuen en este periodo!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result) {
                                    if (result.value) {
                                        
                                        window.location = "index.php?ruta=contable/contable"
        
                                    }
                                })
        
                            </script>';

                            die();
                            

                    }
    
                    for($i=0;$i<$sheetCount;$i++){
            
                        $Reader->ChangeSheet($i);
    
                        foreach ($Reader as $Row){
    
                            if($rowNumber == 0)
                                $rowValida = true;
    
                            if($rowValida){
                                if($rowNumber >= 70 AND $rowNumber <= 77){
                                    $data['ganancias'][] = floatval(str_replace('*','-',$Row[1]));
                                }

                                if($rowNumber >= 78 AND $rowNumber <= 107){
                                    $data['perdidas'][] =  floatval(str_replace('*','-',$Row[1]));
                                }
    
                                if($Row[0] == 'Venta de Cereales y Oleaginosas'){
                                    $data['ventaAgricultura'] = floatval(str_replace('*','-',$Row[1]));
                                }
    
                                if($rowNumber >= 1 AND $rowNumber <= 43){   
                                    $data['activos'][] =  floatval(str_replace('*','-',$Row[1]));
                                }
    
                                if($Row[0] == 'IMP. PROVINCIALES'){                                    
                                    $data['inmobiliario'] = floatval(str_replace('*','-',$Row[1]));
                                }
                                
                                if($Row[0] == 'COMUNA DE BOUQUET'){                                   
                                    $data['comuna'] = floatval(str_replace('*','-',$Row[1]));
                                }
                                
                                if($Row[0] == 'SALDO A FAVOR SEGUNDO PARRAFO'){                                   
                                    $data['sld'] = floatval(str_replace('*','-',$Row[1]));
                                }
 
                            }
        
                            $rowNumber++;
    
                        }
                            
                    }

                    $data['ganancias'] = array_sum($data['ganancias']);
                    $data['perdidas'] = array_sum($data['perdidas']);
                    $data['activos'] = array_sum($data['activos']);
        

                    $respuesta = ModeloContable::mdlCargarArchivo($tabla,$data);
                    
                    $errors = array($respuesta);
                
                    if(in_array('error',$respuesta)){
    
                        echo'<script>
        
                            swal({
                                    type: "error",
                                    title: "¡No se pudo cargar la planilla!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result) {
                                    if (result.value) {
                                        
                                        
        
                                    }
                                })
        
                            </script>';
    
                    }else{
    
                        echo'<script>
    
                        swal({
                                type: "success",
                                title: "La planilla ha sido cargada correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result) {
                                        if (result.value) {
    
    
                                        }
                                    })
    
                        </script>';
    
                    }
    
                }
    
            }

        }
            
        
	}

    /*=============================================
	MOSTRAR DATOS
	=============================================*/
    static public function ctrMostrarDatos($item,$valor,$item2,$valor2){
        
        $tabla = ($valor == 'Paihuen') ? 'contablePaihuen' : 'contable';
        
        return $respuesta = ModeloContable::mdlMostrarDatos($tabla,$item,$valor,$item2,$valor2);
        
    }
    
    
    /*=============================================
    ULTIMO PERIODO
    =============================================*/
    
    static public function ctrUltimoPeriodo(){
        
        $principal = ModeloContable::mdlUltimoPeriodo('Principal','contable');        
        $consolidado = ModeloContable::mdlUltimoPeriodo('Consolidado','contable');
        $paihuen = ModeloContable::mdlUltimoPeriodo(null,'contablePaihuen');

        $periodos = array($principal[0],$consolidado[0],$paihuen[0]);

        if(count(array_unique($periodos)) == 1){

            return $principal[0];

        }else{

            return array('error'=>true,'principal'=>$principal[0],'consolidado'=>$consolidado[0],'paihuen'=>$paihuen[0]);

        }
        
    }
    
    /*============================================
    CALCULAR DATA
    =============================================*/
    
    static public function ctrCalcularData($periodo){

        function calcularData($consolidado,$principal,$paihuen,$ultimoMes){
            
            $labelMeses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
            $anio = explode('-',$consolidado['periodo']);
            $anio = $anio[0];
            // CAJAS
                /* ECONOMICO */

                    // AGRICULTURA
                        $agricultura1 = $principal['agricultura'];
                        $agricultura2 = $consolidado['agricultura'] - $principal['agricultura'];
                    
                    // GANADERIAS  Y RESTOS
                        $ganaderiaResto1 = $principal['ganaderia'] + $principal['resto'];
                        $ganaderiaResto2 = ($consolidado['ganaderia'] + $consolidado['resto']) - $ganaderiaResto1;

                    // VENTAS TOTALES
                        $ventasTotales = $agricultura1 + $agricultura2 + $ganaderiaResto1 + $ganaderiaResto2; 
                /* FINANCIERO */

                    // DEUDA TOTAL
                        $deudaTotal = floatVal($consolidado['deudaTotal']);

                    // PASIVO TOTAL
                        $pasivoTotal = floatVal($consolidado['pasivoTotal']);

                    // ACTIVO CIRCULANTE

                        $cajaBancos = floatVal($consolidado['cajaBancos']); 
                
                        $activoCirculante = $cajaBancos;
                    
                    // PATRIMONIO NETO
                        $patrimonioNeto = floatVal($consolidado['patrimonioNeto']);

                    // DEUDA BANCARIA
                        $deudaBancaria = floatVal($consolidado['deudaBancaria']);

                    // BIENES DE CAMBIO
                        $bienesDeCambio = floatVal($consolidado['bienesDeCambio']);
                    
                    // PASIVO TOTAL
                        $pasivoTotal = floatVal($consolidado['pasivoTotal']);

                /* IMPOSITIVO */

                    // INGRESO BRUTO
                        $ingresosBrutos = floatVal($consolidado['ingresoBrutoMensual']);
                    
                    // INMOBILIARIO / COMUNA
                        $inmobiliarioPaihuen = $paihuen['inmobiliario'];
                        $comuna = $paihuen['comuna'];
                        $inmobiliarioComuna =  $inmobiliarioPaihuen + $comuna;
                    
                    // CARGAS SOCIALES REALES
                        $cargasSociales = floatVal($consolidado['cargasSocialesReales']);
                    
                    // SUELDOS 
                        $sueldos = floatVal($consolidado['sueldos']);
                    

            // GRAFICOS
                /* ECONOMICO */

                    // MARGEN SOBRE VENTAS

                        $resultadoExplotacion = (floatVal($consolidado['ganancias']) - floatVal($consolidado['perdidas'])) + (floatVal(str_replace('-','',$paihuen['ganancias'])) - floatVal($paihuen['perdidas']));
            
                        $ingresosExplotacion = $consolidado['ganancias'];
                        //  + $paihuen['ganancias'];
            
                        $margenSobreVentas = ($ingresosExplotacion != 0) ? $resultadoExplotacion / $ingresosExplotacion : $resultadoExplotacion;

                    // RENTABILIDAD ECONOMICA

                        $rentabilidadEconomica = ($consolidado['activos'] != 0) ? ($resultadoExplotacion / ($consolidado['activos'])) : $resultadoExplotacion;

                /* FINANCIERO */

                    // PRESTAMOS
                        $prestamos = $consolidado['prestamos'];
                        $tarjetas = $consolidado['tarjetas'];
                        $mutuales = $consolidado['mutuales'];
                        $seguros = $consolidado['seguros'];
                        $proveedores = $consolidado['proveedores'];

                    // ENDEUDAMIENTO    
    
                        $endeudamiento = array('prestamos'=>$prestamos,'tarjetas'=>$tarjetas,'mutuales'=>$mutuales,'seguros'=>$seguros,'proveedores'=>$proveedores,'total'=>($prestamos + $tarjetas + $mutuales + $seguros + $proveedores));

                    // DEUDA BANCARIA 

                        $deudaBancaria = $consolidado['deudaBancaria'];

                /* IMPOSITIVO */

                    // SALDOS
                        $saldos = array('sld'=>($consolidado['sld'] + $paihuen['sld']),'saldoTecnico'=>$consolidado['saldoTecnico']);
                        
                    // SUELDOS HONORARIOS
                
                        $sueldosHonorarios = ($consolidado['sueldos'] + $consolidado['honorarios']);

                    // SUELDOS HONORARIOS / VENTAS
                
                        $sueldosHonorariosVentas = ($consolidado['sueldos'] + $consolidado['honorarios']) / $ventasTotales;

            return array(
                'periodo'=>$labelMeses[$ultimoMes - 1],
                'periodoVisible'=> $labelMeses[$ultimoMes - 1] . ' ' . $anio,
                'cajas'=>array('agricultura1'=>floatVal($agricultura1),
                               'agricultura2'=>floatVal($agricultura2),
                               'ganaderiaResto1'=>$ganaderiaResto1,
                               'ganaderiaResto2'=>$ganaderiaResto2,
                               'deudaTotal'=>$deudaTotal,
                               'deudaBancaria'=>$deudaBancaria,
                               'patrimonioNeto'=>floatVal($patrimonioNeto),
                               'activoCirculante'=>$activoCirculante,
                               'activoCorriente'=>$consolidado['activoCorriente'],
                               'pasivoTotal'=>$pasivoTotal,
                               'bienesDeCambio'=>$bienesDeCambio,
                               'ingresosBrutos'=>$ingresosBrutos,
                               'inmobiliarioComuna'=>$inmobiliarioComuna,
                               'cargasSociales'=>$cargasSociales,
                               'sueldos'=>$sueldos),     
                'graficos'=>array('ventasTotales'=>$ventasTotales,
                                  'agricultura'=>(floatVal($principal['agricultura']) + floatVal($consolidado['agricultura'])),
                                  'ganaderiaResto'=>($ganaderiaResto1 + $ganaderiaResto2),
                                  'margenSobreVentas'=>$margenSobreVentas,
                                  'resultadoExplotacion'=>$resultadoExplotacion,
                                  'rentabilidadEconomica'=>$rentabilidadEconomica,
                                  'endeudamiento' => $endeudamiento,
                                  'deudaBancaria' => $deudaBancaria,
                                  'saldos'=>$saldos,
                                  'sueldosHonorarios' => $sueldosHonorarios,
                                  'sueldosHonorariosVentas' => $sueldosHonorariosVentas),
                'test'=>array('gananciasB'=>floatVal($consolidado['ganancias']),
                'perdidasB'=>floatVal($consolidado['perdidas']),
                'gananciasP'=>$paihuen['ganancias'],
                'perdidasP'=>$paihuen['perdidas'])
                
            );

        }

        // ULTIMO MES⁄
        $item = 'libro';

        $valor = 'Principal';

        $item2 = 'periodo';

        $principal = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$periodo);        

        $valor = 'Consolidado';
        
        $consolidado = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$periodo);
        
        $item = null;
        
        $valor = 'Paihuen';
        
        $paihuen = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$periodo);
                
        // MESES ANTERIORES
        
        $dateExplode = explode('-',$periodo);
        
        $ultimoMes = intval($dateExplode[1]);
        $ultimoAnio = intval($dateExplode[0]);
        
        $data = array(calcularData($consolidado,$principal,$paihuen,$ultimoMes));

        for ($i=0; $i < 6; $i++) { 
            
            if($ultimoMes == 1){
    
                $ultimoMes = 12;
                $ultimoAnio = $ultimoAnio--;
    
            }else{
    
                $ultimoMes--;
    
            }

            $item = 'libro';

            $valor = 'Principal';
    
            $item2 = 'periodo';

            $valor2 = array($ultimoMes,$ultimoAnio);

            $principal = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);        

            if(!$principal){

                return $data;
                
            }else{

                $valor = 'Consolidado';
                
                $consolidado = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);
                
                $item = null;
        
                $valor = 'Paihuen';
        
                $paihuen = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);

                $data[] = calcularData($consolidado,$principal,$paihuen,$ultimoMes);

            }
        }

        return $data;
    }

    
}

    