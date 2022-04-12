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

                    if($rowValida == TRUE){   

                        $hotelero 	 		= $Row[0];
                        $caravana 	 		= $Row[1];
                        $categoria 	 		= $Row[2];
                        $raza 		 		= $Row[3];
                        $tropa       		= $Row[4];
                        $motivo      		= $Row[5];
                        $destinoVenta 		= $Row[6];
                        $actividad   		= $Row[7];
                        $cab 		 		= $Row[8];
                        $kgIngreso 	 		= $Row[9];
                        $kgSalida 	 		= $Row[10];
                        $kgProd		 		= $Row[11];
                        $dias 		 		= $Row[12];
                        $adpv 		 		= $Row[13];
                        $convMS 	 		= $Row[14];
                        $kgI 		 		= $Row[15];
                        $kgE 		 		= $Row[16];
                        $dias2 		 		= $Row[17];
                        $kgP 		 		= $Row[18];
                        $adpv3 		 		= $Row[19];
                        $CMS 		 		= $Row[20];
                        $kgI4 		 		= $Row[21];
                        $kgE5 		 		= $Row[22];
                        $dias6 		 		= $Row[23];
                        $kgP7 		 		= $Row[24];
                        $adpv8 		 		= $Row[25];
                        $CMS9 		 		= $Row[26];
                        $kgI10 		 		= $Row[27];
                        $kgE11 		 		= $Row[28];
                        $dias12		 		= $Row[29];
                        $kgP13		 		= $Row[30];
                        $adpv14		 		= $Row[31];
                        $CMS15		 		= $Row[32];
                        $convTC		 		= $Row[33];
                        $totalKgTC	 		= $Row[34];
                        $totalKgMS	 		= $Row[35];
                        $costoKG	 		= $Row[36];
                        $costoCompra 		= $Row[37];
                        $otrosCompra 		= $Row[38];
                        $total		 		= $Row[39];
                        $consignatario 		= $Row[40];
                        $proveedor	 		= $Row[41];
                        $localidad	 		= $Row[42];
                        $provincia	 		= $Row[43];
                        $totalConsumo 		= $Row[44];
                        $totalEstructura 	= $Row[45];
                        $estadoProduccion 	= $Row[46];
                        $anio 	 			= $Row[47];
                        $fechaIngreso 	 	= fechaExcel($Row[48]);
                        $fechaSalida 	 	= fechaExcel($Row[49]);
                        $ingresoVenta 	 	= $Row[50];
                        $gastoVenta 	 	= $Row[51];
                        $margen 	 		= $Row[52];
                        $margenKilo 	 	= $Row[53];
                        $transaccion 	 	= $Row[54];
                        $tipoOperacion 	 	= $Row[55];
                        $estadoEgreso 	 	= $Row[56];
                        $estadoIngreso 	 	= $Row[57];
                        $clasificacion 	 	= $Row[58];
                        $sexo 	 			= $Row[59];
                        $fechaRomaneo 	 	= ($Row[60] != "") ? fechaExcel($Row[60]) : '0000-00-00';
                        $kilosCarcasaIngreso = $Row[61];
                        $kilos3raBalanza 	= $Row[62];
                        $kilosCarne4ta 	 	= $Row[63];
                        $dressing 	 		= $Row[64];
                        $ADPC		 	 	= $Row[65]; 
                        $convMSCarcasa 	 	= $Row[66];
                        $establecimiento 	= $Row[67];	
                        $trazadoSino		= $Row[68];	
                        $zona				= $Row[69];	
                        $columna16			= $Row[70];

                        if ($rowValidaTemp == FALSE) {
                            $fechaSeparada = explode('-',$fecha);
                            $anio = $fechaSeparada[0];
                            $mes = $fechaSeparada[1];
                            
                            if ($mes < 10) {
                                
                                $mes = substr($mes,1);
                            }
                            

                            $sqlValidacion = "SELECT COUNT(*) as valido FROM animales where month(fechaSalida) = $mes AND year(fechaSalida) = $anio";
                            $queryValidacion = mysqli_query($conexion,$sqlValidacion);
                            $resultado = mysqli_fetch_array($queryValidacion);

                            if ($resultado['valido'] != 0) {

                                unlink("carga/".$_FILES['nuevosDatos']['name']);

                                echo "<script>
                                window.location.href = 'index.php?ruta=datos&alerta=datosRepetidos';
                                </script>";
                                die();

                            }
                        
                        } 

                        $rowValidaTemp = TRUE; 

                        $sql = "INSERT INTO animales(archivo,
                        hotelero,caravana,categoria,raza,tropa,motivo,destinoVenta,actividad,cab,
                        kgIngresoCC,kgSalidaCC,kgProdCC,diasCC,adpvCC,convMSCC,kgIngresoRP,kgSalidaRP,kgProdRP,diasRP,adpvRP,convMSRP,kgIngresoRC,kgSalidaRC,kgProdRC,diasRC,adpvRC,convMSRC,kgIngresoT,kgSalidaT,kgProdT,diasT,adpvT,convMST,convTC,totalKgTC,totalKgMS,costoKG,costoCompra,otrosCompra,total,consignatario,proveedor,localidad,provincia,totalConsumo,totalEstructura,estadoProduccion,anio,fechaIngreso,fechaSalida,ingresoVenta,gastoVenta,margen,margenKilo,transaccion,tipoOperacion,estadoEgreso,estadoIngreso,clasificacion,sexo,fechaRomaneo,kilosCarcasaIngreso,kilos3raBalanza,kilosCarne4ta,dressing,ADPC,convMSCarcasa,establecimiento,trazadoSino,zona,columna16) 
                        VALUES('$nombreArchivo','$hotelero','$caravana','$categoria','$raza','$tropa','$motivo','$destinoVenta','$actividad','$cab','$kgIngreso','$kgSalida','$kgProd','$dias','$adpv','$convMS','$kgI','$kgE','$dias2','$kgP','$adpv3','$CMS','$kgI4','$kgE5','$dias6','$kgP7','$adpv8','$CMS9','$kgI10','$kgE11','$dias12','$kgP13','$adpv14','$CMS15','$convTC','$totalKgTC','$totalKgMS','$costoKG','$costoCompra','$otrosCompra','$total','$consignatario','$proveedor','$localidad','$provincia','$totalConsumo','$totalEstructura','$estadoProduccion','$anio','$fechaIngreso','$fechaSalida','$ingresoVenta','$gastoVenta','$margen','$margenKilo','$transaccion','$tipoOperacion','$estadoEgreso','$estadoIngreso','$clasificacion','$sexo','$fechaRomaneo','$kilosCarcasaIngreso','$kilos3raBalanza','$kilosCarne4ta','$dressing','$ADPC','$convMSCarcasa','$establecimiento','$trazadoSino','$zona','$columna16')";
                        mysqli_query($conexion,$sql);

                        $errorMysql = mysqli_error($conexion);
                        
                        if($errorMysql != ''){
                            $sql = "DELETE FROM animales WHERE archivo = '$nombreArchivo'";
                            mysqli_query($conexion,$sql);

                            unlink("carga/".$_FILES['nuevosDatos']['name']);
    
                            echo "<script>
                            window.location.href = 'index.php?ruta=datos&errorFila=".$rowNumber."';
                            </script>";
                            
                        }

                    }

					if ($Row[0] == 'Hotelero') {

                            $rowValida = TRUE;

                    }
				}		
        }

    }
    
    unlink("carga/".$_FILES['nuevosDatos']['name']);

    echo "<script>
    window.location.href = 'datos';
    </script>";
}
?>