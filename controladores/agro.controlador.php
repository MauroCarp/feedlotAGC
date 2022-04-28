<?php
error_reporting(E_ERROR | E_PARSE);

function tipoCultivo($cultivo){

    switch ($cultivo) {
        case 'trigo':
        case 'carinata':
        case 'vicia':
        case 'triticale':
        case 'vicia-triticale':
        case 'triticale-vicia':
            $tipo = 'Invernal';
            break;

        case 'maiz':
        case 'soja':
        case 'soja1ra':
        case 'soja1era':
        case 'soja2da':
        case 'maiz1ra':
        case 'maiz1era':
        case 'maiz2da':
            $tipo = 'Estival';
            break;
    }

    return $tipo;

}

class ControladorAgro{

	/*=============================================
	CARGAR ARCHIVO
	=============================================*/

	static public function ctrCargarArchivo(){

        
        require_once('extensiones/excel/php-excel-reader/excel_reader2.php');
        require_once('extensiones/excel/SpreadsheetReader.php');

        if(isset($_POST['btnCargarAgro'])){

            $tabla = 'planificacion';

            $error = false;
            
            $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            
            if(in_array($_FILES["nuevosDatosAgro"]["type"],$allowedFileType)){

                $ruta = "carga/" . $_FILES['nuevosDatosAgro']['name'];
                
                move_uploaded_file($_FILES['nuevosDatosAgro']['tmp_name'], $ruta);
                
                $nombreArchivo = str_replace(' ', '',$_FILES['nuevosDatosAgro']['name']);
                                        
                $rowNumber = 0;
                
                $rowValida = false;

                $data = array();

                $cultivoCosto = array();
                
                $dateTime = date('Y-m-d H:i:s');

                $Reader = new SpreadsheetReader($ruta);	
                
                $sheetCount = count($Reader->sheets());
        
                for($i=0;$i<$sheetCount;$i++){
        
                    $Reader->ChangeSheet($i);

                    foreach ($Reader as $Row){
                        
                        if($rowNumber < 6){

                            $cultivoCosto[str_replace(' ','',trim(lcfirst($Row[6])))] = trim(preg_replace('/[^0-9]/', '', $Row[7]));

                        }

                        if($rowNumber == 1){
                            
                            $rowValida = true;

                            $campania = explode('/',$Row[0]);
                            $campania1 = substr($campania[0],-4,4);
                            $campania2 = $campania[1];
                            
                        }

                        if($Row[0] == 'TOTAL'){

                            $rowValida = false;

                        }

                        if($rowValida){

                            if($rowNumber != 1 AND $rowNumber != 2 AND $rowNumber != 3 AND $rowNumber != 6 AND $rowNumber != 5){

                                if($rowNumber == 4){

                                    $campo = $Row[0];
                                
                                }else{

                                    $lote = $Row[0];

                                    $has = $Row[1];
                                    $actual = $Row[2];
                                    $variedad = $Row[3];
                                    $dobleCultivoValido = strpos($Row[5],'/');

                                    if($dobleCultivoValido){

                                        $cultivos = explode('/',$Row[5]);

                                        for ($i=0; $i < sizeof($cultivos) ; $i++) { 
                                            
                                            $planificado = str_replace(' ','',trim(strtolower($cultivos[$i])));
                                            
                                            $tipoCultivo = tipoCultivo($planificado);
                                            
                                            $data[] = "('$campania1','$campania2','$campo','$tipoCultivo','$lote',$has,'$actual','$planificado','$dateTime')";

                                        }

                                    }else{

                                        $planificado = str_replace(' ','',trim(strtolower($Row[5])));
                                        
                                        $tipoCultivo = tipoCultivo($planificado);

                                        $data[] = "('$campania1','$campania2','$campo','$tipoCultivo','$lote',$has,'$actual','$planificado','$dateTime')";

                                    }

                                    // if($lote != 'Lote 8'){

                                    //     $has = $Row[1];
                                    //     $actual = $Row[2];
                                    //     $variedad = $Row[3];
                                    //     $dobleCultivoValido = strpos($Row[5],'/');
    
                                    //     if($dobleCultivoValido){
    
                                    //         $cultivos = explode('/',$Row[5]);
    
                                    //         for ($i=0; $i < sizeof($cultivos) ; $i++) { 
                                                
                                    //             $planificado = str_replace(' ','',trim(strtolower($cultivos[$i])));
                                                
                                    //             $tipoCultivo = tipoCultivo($planificado);
                                                
                                    //             $data[] = "('$campania1','$campania2','$campo','$tipoCultivo','$lote',$has,'$actual','$planificado','$dateTime')";
    
                                    //         }
    
                                    //     }else{
    
                                    //         $planificado = str_replace(' ','',trim(strtolower($Row[5])));
                                            
                                    //         $tipoCultivo = tipoCultivo($planificado);
    
                                    //         $data[] = "('$campania1','$campania2','$campo','$tipoCultivo','$lote',$has,'$actual','$planificado','$dateTime')";
    
                                    //     }

                                    // }else{

                                    //     $has = 70;
                                        
                                    //     $actual = $Row[2];
                                        
                                    //     $cultivos = explode('/',$Row[5]);

                                    //     for ($i=0; $i < sizeof($cultivos) ; $i++) { 

                                    //         if($i == 1){

                                    //             $cultivo = explode('-',$cultivos[$i]);

                                    //             for ($a=0; $a < sizeof($cultivo) ; $a++) { 
                                                    
                                    //                 if($a == 1)
                                    //                     $has = 68;        
                                                        
                                    //                 $planificado = str_replace(' ','',trim(strtolower($cultivo[$a])));
                                                    
                                    //                 $tipoCultivo = tipoCultivo($planificado);
                                                    
                                    //                 $data[] = "('$campania1','$campania2','$campo','$tipoCultivo','$lote',$has,'$actual','$planificado','$dateTime')";

                                    //             }

                                    //         }else{

                                    //             $planificado =str_replace(' ','',trim(strtolower($cultivo[$a])));

                                    //             $tipoCultivo = tipoCultivo($planificado);
                                                    
                                    //             $data[] = "('$campania1','$campania2','$campo','$tipoCultivo','$lote',$has,'$actual','$planificado','$dateTime')";

                                    //         }

                                    //     }
                                    // }

                                }

                            }

                        }
    
                        $rowNumber++;

                    }
                        
                }
                
                $respuesta = ModeloAgro::mdlCargarArchivo($tabla,$data);
                
                $errors = array($respuesta);
                
                $tabla = 'planificacion';

                $item = 'cultivo';
                
                $item2 = 'campania1';

                $item3 = 'campania2';

                foreach ($cultivoCosto as $cultivo => $costo) {

                    $respuesta = ControladorAgro::ctrCargarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2,$costo);

                    $errors[] = $respuesta;

                }
              
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

    /*=============================================
	CARGAR COSTOS
	=============================================*/

	static public function ctrCargarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2,$costo){

        $respuesta = ControladorAgro::ctrMostrarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2);

        if($respuesta){

            return $respuesta = ModeloAgro::mdlEditarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2,$costo);
            
        }else{
            
            return $respuesta = ModeloAgro::mdlCargarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2,$costo);

        }
            
	}

    /*=============================================
	VER COSTOS
	=============================================*/

	static public function ctrMostrarCostos($tabla,$item,$value,$item2,$value2,$item3,$value3){

        return $respuesta = ModeloAgro::mdlMostrarCostos($tabla,$item,$value,$item2,$value2,$item3,$value3);

	}

    /*=============================================
	VER DATA
	=============================================*/
    
	static public function ctrMostrarData($tabla, $item, $valor, $item2, $valor2, $item3, $valor3){

        return $respuesta = ModeloAgro::mdlMostrarData($tabla, $item, $valor, $item2, $valor2, $item3, $valor3);

	}
}

	