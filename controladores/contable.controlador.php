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
                                    $data['activos'] = formatearNumero($Row[5]); 

                                if($Row[1] == '2.01.01.02.010' || $Row[1] == '2.01.01.02.011' || $Row[1] == '2.01.01.02.015' || $Row[1] == '2.01.01.02.016' || $Row[1] == '2.01.01.08.000')
                                    $data['prestamos'][] = formatearNumero($Row[5]);
    
                                
                                if($Row[1] == '2.01.01.02.012' || $Row[1] == '2.01.01.02.013' || $Row[1] == '2.01.01.02.014')
                                    $data['tarjetas'][] = formatearNumero($Row[5]); 
    
                                
                                if($Row[1] == '2.01.01.07.000')
                                    $data['mutuales'] = formatearNumero($Row[5]); 
    
                            
                                if($Row[1] == '2.01.01.01.000')
                                    $data['proveedores'] = formatearNumero($Row[5]); 
            
                            
                                if($Row[1] == '5.01.01.14.004' || '5.01.01.14.005' || '5.01.01.14.006' || '5.02.01.02.017' || '5.02.01.05.003' || '5.02.01.06.011')
                                    $data['seguros'][] = formatearNumero($Row[5]); 
    
    
                                if($Row[1] == '4.00.00.00.000')
                                    $data['ganancias'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '5.00.00.00.000')
                                    $data['perdidas'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '2.01.01.02.000')
                                    $data['deudaBancaria'] = formatearNumero($Row[5]); 
    
                                
                                if($Row[1] == '1.01.04.00.000')
                                    $data['bienesDeCambio'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '1.01.01.01.000')
                                    $data['cajaBancos'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '2.01.00.00.000')
                                    $data['pasivoCorriente'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '2.00.00.00.000')
                                    $data['pasivoTotal'] = formatearNumero($Row[5]); 
                            
                                if($Row[1] == '3.00.00.00.000')
                                    $data['patrimonioNeto'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '4.01.01.00.000')
                                    $data['agricultura'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '4.01.02.00.000')
                                    $data['ganaderia'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '4.01.05.00.000' || $Row[1] == '4.02.00.00.000')
                                    $data['resto'][] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '5.02.01.01.001')
                                    $data['ingresoBrutoMensual'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '5.02.01.01.001')
                                    $data['inmobiliarioComuna'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '5.02.01.05.002')
                                    $data['cargasSocialesReales'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '5.02.01.05.001')
                                    $data['sueldos'] = formatearNumero($Row[5]); 
                            
                                if($Row[1] == '5.02.01.06.006' || $Row[1] == '5.02.01.06.007' || $Row[1] == '5.02.01.06.008' || $Row[1] == '5.02.01.06.009')
                                    $data['honorarios'][] = formatearNumero($Row[5]); 
    
                        
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
                                    $data['activos'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '2.01.01.02.010' || $Row[1] == '2.01.01.02.011' || $Row[1] == '2.01.01.02.015' || $Row[1] == '2.01.01.02.016' || $Row[1] == '2.01.01.08.000')
                                    $data['prestamos'][] = formatearNumero($Row[5]);

                    
                                if($Row[1] == '2.01.01.02.012' || $Row[1] == '2.01.01.02.013' || $Row[1] == '2.01.01.02.014')
                                    $data['tarjetas'][] = formatearNumero($Row[5]); 
    
                                
                                if($Row[1] == '2.01.01.07.000')
                                    $data['mutuales'] = formatearNumero($Row[5]); 
    
                            
                                if($Row[1] == '2.01.01.01.000')
                                    $data['proveedores'] = formatearNumero($Row[5]); 
            
                            
                                if($Row[1] == '5.01.01.14.004' || '5.01.01.14.005' || '5.01.01.14.006' || '5.02.01.02.017' || '5.02.01.05.003' || '5.02.01.06.011')
                                    $data['seguros'][] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '4.00.00.00.000')
                                    $data['ganancias'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '5.00.00.00.000')
                                    $data['perdidas'] = formatearNumero($Row[5]); 

                                if($Row[1] == '2.01.01.02.000')
                                    $data['deudaBancaria'] = formatearNumero($Row[5]); 
    
                                
                                if($Row[1] == '1.01.04.00.000')
                                    $data['bienesDeCambio'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '1.01.01.01.000')
                                    $data['cajaBancos'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '2.01.00.00.000')
                                    $data['pasivoCorriente'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '2.00.00.00.000')
                                    $data['pasivoTotal'] = formatearNumero($Row[5]); 
                            
                                if($Row[1] == '3.00.00.00.000')
                                    $data['patrimonioNeto'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '4.01.01.00.000')
                                    $data['agricultura'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '4.01.02.00.000')
                                    $data['ganaderia'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '4.01.05.00.000' || $Row[1] == '4.02.00.00.000')
                                    $data['resto'][] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '5.02.01.01.001')
                                    $data['ingresoBrutoMensual'] = formatearNumero($Row[5]); 
                                
                                if($Row[1] == '5.02.01.06.005')
                                    $data['inmobiliario'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '5.02.01.05.002')
                                    $data['cargasSocialesReales'] = formatearNumero($Row[5]); 
    
                                if($Row[1] == '5.02.01.05.001')
                                    $data['sueldos'] = formatearNumero($Row[5]); 
                            
                                if($Row[1] == '5.02.01.06.006' || $Row[1] == '5.02.01.05.007' || $Row[1] == '5.02.01.05.008' || $Row[1] == '5.02.01.05.009')
                                    $data['honorarios'][] = formatearNumero($Row[5]); 
    
                        
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

                                    $data['ganancias'][] = str_replace('*','.',str_replace(',','',str_replace('.','*',str_replace(')','',str_replace('(','',$Row[1])))));

                                }
    
                                if($rowNumber >= 78 AND $rowNumber <= 107)
                                    $data['perdidas'][] = $Row[1];
    
    
                                if($Row[0] == 'Venta de Cereales y Oleaginosas')
                                    $data['ventaAgricultura'] = $Row[1];
    
                                if($rowNumber >= 1 AND $rowNumber <= 43)
                                $data['activos'][] = $Row[1];
    
    
                                if($Row[0] == 'IMP. PROVINCIALES' || $Row[0] == 'API')
                                    $data['inmobiliario'][] = $Row[1];
                                
                                if($Row[0] == 'COMUNA DE BOUQUET')
                                    $data['comuna'] = $Row[1];


                            }
        
                            $rowNumber++;
    
                        }
                            
                    }

                    $data['ganancias'] = array_sum($data['ganancias']);
                    $data['perdidas'] = array_sum($data['perdidas']);
                    $data['activos'] = array_sum($data['activos']);
                    $data['inmobiliario'] = array_sum($data['inmobiliario']);
    
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

            $consolidado['ganancias'] = $consolidado['ganancias'] - $principal['ganancias'];
    
            $consolidado['perdidas'] = $consolidado['perdidas'] - $principal['perdidas'];

            // MARGEN SOBRE VENTAS
    
                $resultadoExplotacion = ($consolidado['ganancias'] - $consolidado['perdidas']) + ($paihuen['ganancias'] - $paihuen['perdidas']);
    
                $ingresosExplotacion = $consolidado['ganancias'] + $paihuen['ganancias'];
    
                $margenSobreVentas = ($ingresosExplotacion != 0) ? $resultadoExplotacion / $ingresosExplotacion : $resultadoExplotacion;

            // VENTAS
    
                $consolidado['agricultura'] = $consolidado['agricultura'] - $principal['agricultura'];
                
                $consolidado['ganaderia'] = $consolidado['ganaderia'] - $principal['ganaderia'];
                
                $consolidado['resto'] = $consolidado['resto'] - $principal['resto'];
    
                $ventas = $principal['agricultura'] + $consolidado['agricultura'] + $principal['ganaderia'] + $consolidado['ganaderia'] + $principal['resto'] + $consolidado['resto'] + $paihuen['ventasAgricultura'];


            // RENTABILIDAD ECONOMICA

                $consolidado['activos'] = $consolidado['activos'] - $principal['activos'];

                $rentabilidadEconomica = (($consolidado['activos'] + $paihuen['activos']) != 0) ? ($resultadoExplotacion / ($consolidado['activos'] + $paihuen['activos'])) : $resultadoExplotacion;

            // PRESTAMOS
                $prestamos = $consolidado['prestamos'] - $principal['prestamos'];
                $tarjetas = $consolidado['tarjetas'] - $principal['tarjetas'];
                $mutuales = $consolidado['mutuales'] - $principal['mutuales'];
                $seguros = $consolidado['seguros'] - $principal['seguros'];
                $proveedores = $consolidado['proveedores'] - $principal['proveedores'];

            // ENDEUDAMIENTO
    
                $endeudamiento = array('prestamos'=>$prestamos,'tarjetas'=>$tarjetas,'mutuales'=>$mutuales,'seguros'=>$seguros,'proveedores'=>$proveedores);

            // DEUDA TOTAL 

                $deudaBancaria = $consolidado['deudaBancaria'] - $principal['deudaBancaria'];
    
                $bienesDeCambio = $consolidado['bienesDeCambio'] - $principal['bienesDeCambio'];
                
                $deudaTotal = ($bienesDeCambio != 0) ? $deudaBancaria / $bienesDeCambio : $deudaBancaria;

            // ACTIVO CIRCULANTE
    
                $cajaBancos = $consolidado['cajaBancos'] - $principal['cajaBancos']; 
    
                $pasivoCorriente = $consolidado['pasivoCorriente'] - $principal['pasivoCorriente'];
    
                $activoCirculante = ($pasivoCorriente != 0) ? $cajaBancos / $pasivoCorriente : $cajaBancos;
    
            // PASIVO PATRIMONIO
    
                $pasivoTotal = $consolidado['pasivoTotal'] - $principal['pasivoTotal'];
    
                $patrimonio = $consolidado['patrimonioNeto'] - $principal['patrimonioNeto'];
    
                $pasivoPatrimonio = ($patrimonio != 0) ? $pasivoTotal / $patrimonio : $pasivoTotal;

            // INGRESOS BRUTOS
                
                $ingresosBrutos = $consolidado['ingresoBrutoMensual'] - $principal['ingresoBrutoMensual'];

            // INMOBILIARIO COMUNA

                if($paihuen['comuna'] != 0){
    
                    $inmobiliario =  (($consolidado['inmobiliario'] - $principal['inmobiliario']) + $paihuen['inmobiliario']) / $paihuen['comuna'];
                }else{
                    

                    $inmobiliario =  (($consolidado['inmobiliario'] - $principal['inmobiliario']) + $paihuen['inmobiliario']);
                
                }

            // CARGAS SOCIALES 
                $cargasSociales = floatval($consolidado['cargasSocialesReales']);

            // SUELDOS
                $sueldos = $consolidado['sueldos'] / $ventas;
            
            // SUELDOS HONORARIOS
         
                $sueldosHonorarios = (floatval($consolidado['sueldos']) + floatval($consolidado['honorarios'])) / $ventas;

            return array(
                'periodo'=>$labelMeses[$ultimoMes + 1],
                'cajas'=>array(
                    'margenSobreVentas'=>$margenSobreVentas,'resultadoExplotacion'=>$resultadoExplotacion,'rentabilidadEconomica'=>$rentabilidadEconomica,'deudaTotal'=>$deudaTotal,'activoCirculante'=>$activoCirculante,'ventas'=>$ventas,'pasivoPatrimonio'=>$pasivoPatrimonio,'ingresosBrutos'=>$ingresosBrutos,'inmobiliario'=>$inmobiliario,'cargasSociales'=>$cargasSociales,'sueldos'=>$sueldos,'sueldosHonorarios'=>$sueldosHonorarios),
                'graficos'=>array(
                        'resultadoExplotacion'=>array('ganancias'=>($consolidado['ganancias'] + $paihuen['ganancias']),'perdidas'=>($consolidado['perdidas'] + $paihuen['perdidas'])),'ingresoExplotacion'=>array('Barlovento'=>$consolidado['ganancias'],'Paihuen'=>$paihuen['ganancias']),'agricultura'=>array('principal'=>$principal['agricultura'],'consolidado'=>$consolidado['agricultura'],'paihuen'=>$paihuen['ventasAgricultura']),'ganaderia'=>array('principal'=>$principal['ganaderia'],'consolidado'=>$consolidado['ganaderia']),'resto'=>array('principal'=>$principal['resto'],'consolidado'=>$consolidado['resto']),'activos'=>array('principal'=>$principal['activos'],'consolidado'=>$consolidado['activos'],'paihuen'=>$paihuen['activos']),'endeudamiento'=>$endeudamiento,'cajaBancos'=>array('Principal'=>$principal['cajaBancos'],'Consolidado'=>$consolidado['cajaBancos'])));

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
            }
            
            $valor = 'Consolidado';
            
            $consolidado = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);
            
            $item = null;
    
            $valor = 'Paihuen';
    
            $paihuen = ControladorContable::ctrMostrarDatos($item,$valor,$item2,$valor2);

            $data[] = calcularData($consolidado,$principal,$paihuen,$ultimoMes);

        }

        return $data;
    }

    
}

    