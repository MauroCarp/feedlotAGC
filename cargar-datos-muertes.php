<?php
error_reporting(E_ERROR | E_PARSE);

require_once('extensiones/excel/php-excel-reader/excel_reader2.php');
require_once('extensiones/excel/SpreadsheetReader.php');
require_once('modelos/conexion.php');


function fechaExcel($fecha){
	$fechaTemp = explode("-",$fecha);
	$nuevaFecha = $fechaTemp[1]."-".$fechaTemp[0]."-".$fechaTemp[2];
	$standarddate = "20".substr($nuevaFecha,6,2) . "-" . substr($nuevaFecha,3,2) . "-" . substr($nuevaFecha,0,2);
	return $standarddate;
}


if( isset($_FILES["nuevosDatos"]) ){

	$error = false;

	$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

	if(in_array($_FILES["nuevosDatos"]["type"],$allowedFileType)){

		$ruta = "carga/" . $_FILES['nuevosDatos']['name'];

		move_uploaded_file($_FILES['nuevosDatos']['tmp_name'], $ruta);

        $nombreArchivo = str_replace(' ', '',$_FILES['nuevosDatos']['name']);

        $rowNumber = 0;

		$rowValida = FALSE;
        
        $rowValidaTemp = FALSE;


		$Reader = new SpreadsheetReader($ruta);	

		$sheetCount = count($Reader->sheets());

		for($i=0;$i<$sheetCount;$i++){

			$Reader->ChangeSheet($i);

				foreach ($Reader as $Row){
                    
                    $rowNumber++;

                    if(($Row[0] == 'Hotelero' AND $Row[1] == 'Fecha') OR ($Row[0] == 'Hotelero' AND $Row[1] == 'Caravana')){
                      
                        unlink("carga/".$_FILES['nuevosDatos']['name']);
                        
                        echo "<script>
                        
                        window.location.href = 'index.php?ruta=datos-muertes&alerta=archivoIncorrecto';
                        
                        </script>"; 
                        
                        die();
                    
                    }
                    

                    if($rowValida == TRUE){   

                        $caravana    		= $Row[0];
                        $transaccion 		= $Row[1];
                        $hotelero 	 		= $Row[2];
                        $tropa       		= $Row[3];
                        $fecha      	 	= fechaExcel($Row[5]);
                        $dias        		= $Row[6];
                        $corral	 		    = $Row[9];
                        $proveedor	 		= $Row[10];
                        $consignatario 		= $Row[11];
                        $categoria 	 		= $Row[12];
                        $machos 	 		= $Row[14];
                        $hembras            = $Row[15];
                        $kgEgreso 	    	= $Row[17];
                        $diagnostico 		= $Row[25];
                        $motivo         	= $Row[20];
                        $tratado        	= $Row[28];
                        $origen         	= $Row[29];
                        $tipoActividad  	= $Row[30];

                        if ($rowValidaTemp == FALSE) {
                            
                            $fechaSeparada = explode('-',$fecha);
                            $anio = $fechaSeparada[0];
                            $mes = $fechaSeparada[1];

    
                            if ($mes < 10) {
    
                                $mes = substr($mes,1);
                            }

                            $sqlValidacion = "SELECT COUNT(*) as valido FROM muertes where month(fechaMuerte) = $mes AND year(fechaMuerte) = $anio";
                            $queryValidacion = mysqli_query($conexion,$sqlValidacion);
                            $resultado = mysqli_fetch_array($queryValidacion);
                        
                            if ($resultado['valido'] != 0) {
                                
                                unlink("carga/".$_FILES['nuevosDatos']['name']);

                                echo "<script>
                                window.location.href = 'index.php?ruta=datos-muertes&alerta=datosRepetidos';
                                </script>";
                                die();

                            }
                        
                        }  
                        
                        $rowValidaTemp = TRUE;
                        
                        $sql = "INSERT INTO muertes(archivo,caravana,transaccion,hotelero,tropa,fechaMuerte,dias,corral,proveedor,consignatario,categoria,macho,hembra,kilosEgreso,diagnostico,motivo,tratado,origen,tipoActividad) 
                        VALUES('$nombreArchivo','$caravana','$transaccion','$hotelero','$tropa','$fecha','$dias','$corral','$proveedor','$consignatario','$categoria','$machos','$hembras','$kgEgreso','$diagnostico','$motivo','$tratado','$origen','$tipoActividad')";
                        mysqli_query($conexion,$sql);
                   
                        $errorMysql = mysqli_error($conexion);
                        
                        preg_match("/(')[A-z]{2,}(')/",$errorMysql,$coincidencias); 

                        if($errorMysql != ''){

                            $sql = "DELETE FROM muertes WHERE archivo = '$nombreArchivo'";
                           
                            mysqli_query($conexion,$sql);
                            
                            unlink("carga/".$_FILES['nuevosDatos']['name']);

                            $errorColumna = str_replace("'","",$coincidencias[0]);
                            
                            echo "<script>
                            
                                window.location.href = 'index.php?ruta=datos-muertes&alerta=error&errorFila=".$rowNumber."&errorColumna=".$errorColumna."';
                            
                            
                            </script>";
                            
                            die();
                        }

                    }
                    
                    if ($Row[0] == 'Caravana'){
                        
                        $rowValida = TRUE;
                    
                    }

				}		
        }

    }
    
    
    echo "<script>
    window.location.href = 'index.php?ruta=datos-muertes&alerta=cargadoCorrecto';
    </script>";

    echo "<script>
    window.location.href = 'index.php?ruta=datos-muertes&alerta=cargadoCorrecto';
    </script>";

}
?>