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

		$rowValida = FALSE;
        
        $rowValidaTemp = FALSE;
        
        $rowNumber = 0;

		$Reader = new SpreadsheetReader($ruta);	

		$sheetCount = count($Reader->sheets());

		for($i=0;$i<$sheetCount;$i++){

			$Reader->ChangeSheet($i);

				foreach ($Reader as $Row){
                    
                    $rowNumber++;

                    if($Row[0] == 'Caravana' OR ($Row[0] == 'Hotelero' AND $Row[1] == 'Caravana')){
                      
                        unlink("carga/".$_FILES['nuevosDatos']['name']);
                        
                        echo "<script>
                        
                        window.location.href = 'index.php?ruta=datos-compras&alerta=archivoIncorrecto';
                        
                        </script>"; 
                        
                        die();
                    
                    }

                    
                    if($rowValida == TRUE){   
                        
                        if($Row[1] == ''){
                            break;
                        }
                        

                        $hotelero 	 		= $Row[0];
                        $fecha      	 	= fechaExcel($Row[1]);

                        $tropa       		= $Row[2];
                        $proveedor	 		= $Row[3];
                        $consignatario 		= $Row[4];
                        $localidad	 		= $Row[6];
                        $cantidad 	 		= $Row[8];
                        $corral	 		    = $Row[7];
                        $categoria 	 		= $Row[9];
                        $machos 	 		= $Row[10];
                        $hembras            = $Row[11];
                        $kgIngreso 	 		= $Row[12];
                        $kgComprado 		= $Row[13];
                        $kgProcedencia 		= $Row[14];
                        $precioTotalKg 		= $Row[17];
                        $precioKg           = $Row[21];
                        $transportista		= $Row[24];
                        $camionero	 		= $Row[25];
                        
                        if ($rowValidaTemp == FALSE) {

                            $fechaSeparada = explode('-',$fecha);

                            $anio = $fechaSeparada[0];

                            $mes = $fechaSeparada[1];
                            
                            if ($mes < 10) {
                                
                                $mes = substr($mes,1);
                            }
                            

                            $sqlValidacion = "SELECT COUNT(*) as valido FROM compras where month(fecha) = $mes AND year(fecha) = $anio";

                            $queryValidacion = mysqli_query($conexion,$sqlValidacion);

                            $resultado = mysqli_fetch_array($queryValidacion);

                            if ($resultado['valido'] != 0) {
                                
                                unlink("carga/".$_FILES['nuevosDatos']['name']);
                                
                                echo "<script>
                                window.location.href = 'index.php?ruta=datos-compras&alerta=datosRepetidos';
                                </script>";
                                
                                die();

                            }
                        
                        } 

                        $rowValidaTemp = TRUE;


                        $sql = "INSERT INTO compras(archivo,fecha,hotelero,consignatario,proveedor,tropa,cantidad,categoria,machos,hembras,kgIng,kgComprado,kgProcedencia,precioTotalKg,precioKg,localidad,corral,transportista,camionero) 
                        VALUES('$nombreArchivo','$fecha','$hotelero','$consignatario','$proveedor','$tropa','$cantidad','$categoria','$machos','$hembras','$kgIngreso','$kgComprado','$kgProcedencia','$precioTotalKg','$precioKg','$localidad','$corral','$transportista','$camionero')";
                        mysqli_query($conexion,$sql);

                        $errorMysql = mysqli_error($conexion);
                        
                        preg_match("/(')[A-z]{2,}(')/",$errorMysql,$coincidencias); 

                        if($errorMysql != ''){
                            
                            $sql = "DELETE FROM compras WHERE archivo = '$nombreArchivo'";
                            
                            mysqli_query($conexion,$sql);
                            
                            unlink("carga/".$_FILES['nuevosDatos']['name']);
                            
                            $errorColumna = str_replace("'","",$coincidencias[0]);

                            echo "<script>

                                window.location.href = 'index.php?ruta=datos-compras&alerta=error&errorFila=".$rowNumber."&errorColumna=".$errorColumna."';

                            </script>";

                            die();
                            
                        }


                    }

                    
                    
                    if ($Row[0] == 'Hotelero' AND $Row[1] == 'Fecha'){
                        
                        $rowValida = TRUE;
                    }

				}		
        }

    }

    echo "<script>
    window.location.href = 'index.php?ruta=datos-compras&alerta=cargadoCorrecto';
    </script>";
    
    echo "<script>
    window.location.href = 'index.php?ruta=datos-compras&alerta=cargadoCorrecto';
    </script>";

}
?>