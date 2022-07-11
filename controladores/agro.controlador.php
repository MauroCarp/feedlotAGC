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

        if(isset($_POST['btnCargar'])){
            
            $error = false;
            
            $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

            
        // CARGA PLANIFIACION
            
            if(in_array($_FILES["nuevosDatosPlanificacion"]["type"],$allowedFileType)){
                
                $tabla = 'planificacion';

                $ruta = "carga/" . $_FILES['nuevosDatosPlanificacion']['name'];
                
                move_uploaded_file($_FILES['nuevosDatosPlanificacion']['tmp_name'], $ruta);
                
                $nombreArchivo = str_replace(' ', '',$_FILES['nuevosDatosPlanificacion']['name']);
                                        
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

                        if($rowNumber  > 0 AND $Row[8] != ''){

                            $costo = trim(str_replace(',','.',str_replace('u$s/ha','',$Row[9])), "\xC2\xA0");
                            $cultivo = htmlentities(str_replace(' ','',$Row[8]));
                            $cultivo = strtolower(str_replace('&nbsp;','',$cultivo));

                            $cultivoCosto[$cultivo] = trim($costo);
                        
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
                                    $cobertura = strtolower($Row[5]);
                                    $dobleCultivoValido = strpos($Row[6],'/');

                                    if($dobleCultivoValido){

                                        $cultivos = explode('/',$Row[6]);

                                        for ($i=0; $i < sizeof($cultivos) ; $i++) { 
                                            
                                            $planificado = str_replace(' ','',trim(strtolower($cultivos[$i])));
                                            
                                            $tipoCultivo = tipoCultivo($planificado);
                                            
                                            $data[] = "('$campania1','$campania2','$campo','$tipoCultivo','$lote',$has,'$actual','$cobertura','$planificado','$dateTime')";

                                        }

                                    }else{

                                        $planificado = str_replace(' ','',trim(strtolower($Row[6])));
                                        
                                        $tipoCultivo = tipoCultivo($planificado);

                                        $data[] = "('$campania1','$campania2','$campo','$tipoCultivo','$lote',$has,'$actual','$cobertura','$planificado','$dateTime')";

                                    }

                                }

                            }

                        }
    
                        $rowNumber++;

                    }
                        
                }

                $respuesta = ModeloAgro::mdlCargarArchivo($tabla,$data);

                $errors = array($respuesta);
                
                $item = 'cultivo';
                
                $item2 = 'campania1';

                $item3 = 'campania2';

                foreach ($cultivoCosto as $cultivo => $costo) {

                    $respuesta = ControladorAgro::ctrCargarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2,$costo);

                    $errors[] = $respuesta;

                }

            }
            
        // CARGA EJECUCION
            if(in_array($_FILES["nuevosDatosEjecucion"]["type"],$allowedFileType)){
                
                $tabla = 'ejecucion';

                $ruta = "carga/" . $_FILES['nuevosDatosEjecucion']['name'];
                
                move_uploaded_file($_FILES['nuevosDatosEjecucion']['tmp_name'], $ruta);
                
                $nombreArchivo = str_replace(' ', '',$_FILES['nuevosDatosEjecucion']['name']);
                                        
                $rowNumber = 0;
                
                $rowValida = false;

                $data = array();

                $cultivoCosto = array();
                
                $dateTime = date('Y-m-d H:i:s');

                $Reader = new SpreadsheetReader($ruta);	
                
                $sheetCount = count($Reader->sheets());
        
                $primeraValida = true;

                for($i=0;$i<$sheetCount;$i++){
        
                    $Reader->ChangeSheet($i);

                    foreach ($Reader as $Row){

                        if($rowNumber == 0)
                            list($campania1,$campania2) = explode('-',$Row[0]);

                        if($rowValida){

                            if($Row[0] == ''){

                                $rowValida = false;

                            }else{

                                $data = array('campania1'=>$campania1,'campania2'=>$campania2,'campo'=>$campo,'lote'=>$Row[0],'has'=>$Row[1],'fina'=>strtolower(trim($Row[2])),'precioFina'=>$Row[3],'gruesa'=>strtolower($Row[4]),'precioGruesa'=>$Row[5],'periodoTime'=>$dateTime);

                                $respuesta = ModeloAgro::mdlCargarArchivo($tabla,$data);

                                $errors = array($respuesta);
                            }

                        }

                        if($Row[0] == 'LOTES'){

                            $rowValida = true;

                            if($primeraValida){

                                $campo = 'EL PICHI';
                                $primeraValida = false;

                            }else{

                                $campo = 'LA BETY';

                            }

                        }
                        $rowNumber++;

                    }
                        
                }

            }

        // VALIDA PROGRAMA DE CARGA                    
            if(in_array('error',$errors)){

                echo'<script>

                    swal({
                            type: "error",
                            title: "¡No se pudo cargar la planilla!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result) {
                            if (result.value) {
                                
                                window.location = "index.php?ruta=agro/agro"

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

    /*=============================================
	CARGAR COSTOS
	=============================================*/

	static public function ctrCargarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2,$costo){

        $respuesta = ControladorAgro::ctrMostrarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2);

        if(empty($respuesta)){

            return $respuesta = ModeloAgro::mdlCargarCostos($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2,$costo);
            
        }else{
            
            return $respuesta = ModeloAgro::mdlEditarCosto($tabla,$item,$cultivo,$item2,$campania1,$item3,$campania2,$costo);

        }
            
	}

    /*=============================================
	EDITAR COSTOS
	=============================================*/

	static public function ctrEditarCostos(){

        if(isset($_POST['btnEditarCosto'])){

            $tabla = $_POST['seccion'];

            $data = array();

            foreach ($_POST as $key => $value) {
                
                if($key != 'seccion' AND $key != 'btnEditarCosto' AND $key != 'campania1' AND $key != 'campania2'){
                        
                    $data[str_replace('Costo','',$key)] = $value;

                }

            }
            
            $item = 'cultivo';

            $item2 = 'campania1';
            
            $item3 = 'campania2';

            $errors = array();
            foreach ($data as $key => $value) {
                        
                $errors[] = ModeloAgro::mdlEditarCosto($tabla,$item,$key,$item2,$_POST['campania1'],$item3,$_POST['campania2'],$value);
            
            }
            
            if(in_array('error',$errors)){

                echo'<script>

                    swal({
                            type: "error",
                            title: "¡No se pudieron modificar los costos!",
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
                        title: "Los costos han sido modificados correctamente",
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

    /*=============================================
	ELIMINAR ARCHIVO
	=============================================*/
    
	static public function ctrEliminarArchivo(){
        
        if(isset($_GET['campo'])){

            $tabla = $_GET['tabla'];
            
            $item = 'campo';
            
            $value = strtoupper($_GET['campo']);
            
            $item2 = 'campania1';
            
            $value2 = $_GET['campania1'];
            
            $item3 = 'campania2';
            
            $value3 = $_GET['campania2'];
            
            $respuesta = ModeloAgro::mdlEliminarArchivo($tabla,$item,$value, $item2, $value2, $item3, $value3);
            // var_dump($respuesta);
            // die();

            if($respuesta == "ok"){

                echo'<script>

                swal({
                        type: "success",
                        title: "El archivo ha sido borrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then(function(result) {
                                if (result.value) {

                                window.location = "index.php?ruta=agro/agro";

                                }
                            })

                </script>';

            }else{

                echo'<script>

                swal({
                        type: "error",
                        title: "El archivo no ha sido borrado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                        }).then(function(result) {
                                if (result.value) {

                                window.location = "index.php?ruta=agro/agro";

                                }
                            })

                </script>';
            
            }	

        }
    }
}

	