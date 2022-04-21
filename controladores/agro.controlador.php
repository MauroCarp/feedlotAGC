<?php
error_reporting(E_ERROR | E_PARSE);

function tipoCultivo($cultivo){

    switch ($cultivo) {
        case 'trigo':
        case 'carinata':
            $tipo = 'Invernal';
            break;

        case 'maiz':
        case 'soja':
        case 'soja 1ra':
        case 'soja 1era':
        case 'soja 2da':
        case 'maiz 1ra':
        case 'maiz 1era':
        case 'maiz 2da':
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

                            $cultivoCosto[icfirst($Row[6])] = trim(preg_replace('/[^0-9]/', '', $Row[7]));

                        }

                        if($rowNumber == 1){
                            
                            $rowValida = true;

                            $campania = explode('/',$Row[0]);
                            $anio1 = substr($campania[0],-4,4);
                            $anio2 = $campania[1];
                            
                            $campania = "$anio1/$anio2";

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
                                            
                                            $planificado = trim(strtolower($cultivos[$i]));

                                            $tipoCultivo = tipoCultivo($planificado);

                                            $data[] = "('$campania','$campo','$tipoCultivo','$lote',$has,'$actual','$planificado','$dateTime')";

                                        }

                                    }else{

                                        $planificado = trim(strtolower($Row[5]));
                                        
                                        $tipoCultivo = tipoCultivo($planificado);

                                        $data[] = "('$campania','$campo','$tipoCultivo','$lote',$has,'$actual','$planificado','$dateTime')";

                                    }
                                
                                }

                            }

                        }
    
                        $rowNumber++;

                    }
                        
                }

                $respuesta = ModeloAgro::mdlCargarArchivo($tabla,$data);
                
                $errors = array($respuesta);
                
                $tabla = 'costoPlanificacion';

                $item = 'campania';

                $item2 = 'cultivo';

                foreach ($cultivoCosto as $cultivo => $costo) {

                    $respuesta = ControladorAgro::ctrCargarCostos($tabla,$item,$campania,$item2,$cultivo,$costo);

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

	static public function ctrCargarCostos($tabla,$item,$value,$item2,$value2,$costo){

        $respuesta = ControladorAgro::ctrMostrarCostos($tabla,$item,$value,$item2,$value2);

        if($respuesta){

            return $respuesta = ModeloAgro::mdlEditarCostos($tabla,$item,$value,$item2,$value2,$costo);
            
        }else{

            return $respuesta = ModeloAgro::mdlCargarCostos($tabla,$item,$value,$item2,$value2,$costo);

        }
            
	}

    /*=============================================
	VER COSTOS
	=============================================*/

	static public function ctrMostrarCostos($tabla,$item,$value){

        return $respuesta = ModeloAgro::mdlMostrarCostos($tabla,$item,$value);

	}

    
    /*=============================================
	VER DATA
	=============================================*/
    
	static public function ctrMostrarData($tabla,$item,$value,$item2,$value2){

        return $respuesta = ModeloAgro::mdlMostrarData($tabla,$item,$value,$item2,$value2);

	}
}

	