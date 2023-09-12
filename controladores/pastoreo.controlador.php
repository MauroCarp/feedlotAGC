<?php
class ControladorPastoreo{

	/*=============================================
	CARGAR PLANILLA 
	=============================================*/

	static public function ctrCargarPlanilla(){
        
        if( isset($_POST["cargarPlantillaPastoreo"]) ){

            require_once('excel/php-excel-reader/excel_reader2.php');
            require_once('excel/SpreadsheetReader.php');

            $error = false;

            $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

            if(in_array($_FILES["file"]["type"],$allowedFileType)){
                $ruta = "carga/" . $_FILES['file']['name'];
                move_uploaded_file($_FILES['file']['tmp_name'], $ruta);

                $Reader = new SpreadsheetReader($ruta);	
                $sheetCount = count($Reader->sheets());

                for($i=0;$i<$sheetCount;$i++){

                    $Reader->ChangeSheet($i);

                        foreach ($Reader as $Row){

                            if($i == 0){
                                var_dump($Row[0]);
                            }


                        }		
                }

                die();

                if($error == ""){
                    echo'<script>

                            swal({
                                type: "success",
                                title: "Los datos han sido cargados correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                                }).then(function(result) {
                                            if (result.value) {

                                            window.location = "datos";

                                            }
                                        })

                            </script>';
                }else{
                    echo'<script>

                            swal({
                                    type: "error",
                                    title: "Hubo un error, los datos no fueron cargados.",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                    }).then(function(result) {
                                    if (result.value) {

                                    window.location = "datos";

                                    }
                                })

                        </script>';
                }

            }
        }

	}

    /*=============================================
	MOSTRAR DATOS 
	=============================================*/

	static public function ctrMostrarRegistros($campo, $item, $valor,$item2 = null,$valor2 = null){

		$tabla = "pastoreo";

		$respuesta = ModeloPastoreo::mdlMostrarRegistros($tabla,$campo, $item, $valor);

        if($item == NULL){

            $data = array();

            foreach ($respuesta as $key => $value) {
                $data[$key]['id'] = $value['id'];
                $data[$key]['tropa'] = $value['tropa'];
                $data[$key]['fechaEntrada'] = $value['fechaEntrada'];
                $data[$key]['fechaSalida'] = $value['fechaSalida'];
    
                if($value['fechaSalida'] != ''){
    
                    $fechaEntrada = new DateTime($value['fechaEntrada']);
                    $fechaSalida = new DateTime($value['fechaSalida']);
    
                    // Obtener la diferencia entre las fechas
                    $intervalo = $fechaEntrada->diff($fechaSalida);
    
                    // Obtener la diferencia en días
                    $diferenciaEnDias = $intervalo->days;
                    $data[$key]['diasDesdeUDP'] = $diferenciaEnDias;
                    $data[$key]['diasProxPastorear'] = $diferenciaEnDias + 1;
                                    
                } else {
    
                    $data[$key]['diasDesdeUDP'] = '-';
    
                    $data[$key]['diasProxPastorear'] = '-';
                    
                }
                
    
            }

            return $data;

        } else {
            return $respuesta;
        }

	}
	

	/*=============================================
	CARGAR REGISTRO 
	=============================================*/

	static public function ctrCargarRegistro(){

		$tabla = "pastoreo";

        if(isset($_POST['cargarPastoreo'])){
            
            $data = array('fechaEntrada'=>$_POST['entradaReal'],'fechaSalida'=>$_POST['salidaReal']);

            $respuesta = ModeloPastoreo::mdlEditarRegistro($tabla,$data,'id',$_POST['idRegistro']);

            if($respuesta == 'ok'){
                
                echo'<script>
                
                swal({
                    type: "success",
                    title: "Registro cargado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result) {
                    if (result.value) {
                        
                        window.location.href = `index.php?ruta=diasPastoreo`;
                    }
                })
                
                </script>';
            }else{
                
                echo'<script>
    
                    swal({
                            type: "error",
                            title: "¡Hubo un error al modificar el registro!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result) {
                            if (result.value) {
                                
                                window.location.href = `index.php?ruta=diasPastoreo`;
                                
    
                            }
                        })
    
                    </script>';
            }

        }

	}
	
	/*=============================================
	CARGAR REGISTRO 
	=============================================*/

	static public function ctrEliminarRegistro(){

		$tabla = "pastoreo";

        if(isset($_GET['accion']) && $_GET['accion'] == 'eliminarRegistro'){
            
            $respuesta = ModeloPastoreo::mdlEliminarRegistro($tabla,'id',$_GET['id']);
            
            if($respuesta == 'ok'){
                
                echo'<script>
                
                swal({
                    type: "success",
                    title: "Registro eliminado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result) {
                    if (result.value) {
                        
                        window.location.href = `index.php?ruta=diasPastoreo`;
                    }
                })
                
                </script>';
            }else{
                
                echo'<script>
    
                    swal({
                            type: "error",
                            title: "¡Hubo un error al eliminar el registro!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                            }).then(function(result) {
                            if (result.value) {
                                
                                window.location.href = `index.php?ruta=diasPastoreo`;
                                
    
                            }
                        })
    
                    </script>';
            }

        }

	}
	
	
}

