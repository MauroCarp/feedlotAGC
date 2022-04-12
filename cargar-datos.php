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

function comprobarVacio($campo,$campoVacio){

    $campoVacio = ($campo == '') ? ($campoVacio + 1) : $campoVacio;

    return $campoVacio;

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

                if($Row[0] == 'Caravana' OR ($Row[0] == 'Hotelero' AND $Row[1] == 'Fecha')){
                    
                    unlink("carga/".$_FILES['nuevosDatos']['name']);

                    echo "<script>
                    window.location.href = 'index.php?ruta=datos&alerta=archivoIncorrecto';
                    </script>"; 

                }

                $campoVacio = 0;


                if($rowValida == TRUE){   

                    $noValido = FALSE;

                    $hotelero 	 		= $Row[0];
                    
                    $campoVacio = comprobarVacio($hotelero,$campoVacio);

                    $caravana 	 		= $Row[1];
                    
                    $campoVacio = comprobarVacio($caravana,$campoVacio);

                    $categoria 	 		= $Row[2];
                    
                    $campoVacio = comprobarVacio($categoria,$campoVacio);

                    $raza 		 		= $Row[3];
                    
                    $campoVacio = comprobarVacio($raza,$campoVacio);

                    $tropa       		= $Row[4];
                    
                    $campoVacio = comprobarVacio($tropa,$campoVacio);

                    $motivo      		= $Row[5];
                    
                    $campoVacio = comprobarVacio($motivo,$campoVacio);

                    $destinoVenta 		= $Row[6];
                    
                    $campoVacio = comprobarVacio($destinoVenta,$campoVacio);

                    $actividad   		= $Row[7];
                    $cab 		 		= $Row[8];
                    $kgIngreso 	 		= $Row[9];
                    $kgSalida 	 		= $Row[10];
                    $kgProd		 		= $Row[11];
                    $dias 		 		= $Row[12];
                    $adpv 		 		= $Row[13];
                    $convMS 	 		= $Row[14];
                    $vecesRP 	 		= ($Row[15] == '') ? 0 : $Row[15];
                    $dias2 		 		= $Row[16];
                    $kgP 		 		= $Row[17];
                    $adpv3 		 		= $Row[18];
                    $CMS 		 		= $Row[19];
                    $vecesRC 	 		= ($Row[20] == '') ? 0 : $Row[20];
                    $dias6 		 		= $Row[21];
                    $kgP7 		 		= $Row[22];
                    $adpv8 		 		= $Row[23];
                    $CMS9 		 		= $Row[24];
                    $vecesT 	 		= ($Row[25] == '') ? 0 : $Row[25];
                    $dias12		 		= $Row[26];
                    $kgP13		 		= $Row[27];
                    $adpv14		 		= $Row[28];
                    $CMS15		 		= $Row[29];
                    $convTC		 		= $Row[30];
                    $totalKgTC	 		= $Row[31];
                    $totalKgMS	 		= $Row[32];
                    $costoKG	 		= $Row[33];
                    $costoCompra 		= $Row[34];
                    $otrosCompra 		= $Row[35];
                    $total		 		= $Row[36];

                    $consignatario 		= $Row[37];
                    
                    comprobarVacio($consignatario,$campoVacio);

                    $proveedor	 		= $Row[38];
                    
                    comprobarVacio($proveedor,$campoVacio);

                    $localidad	 		= $Row[39];
                    
                    comprobarVacio($localidad,$campoVacio);

                    $provincia	 		= $Row[40];
                    
                    comprobarVacio($provincia,$campoVacio);

                    $totalConsumo 		= $Row[41];
                    $totalEstructura 	= $Row[42];
                    $estadoProduccion 	= $Row[43];
                    $anio 	 			= $Row[44];
                    $fechaIngreso 	 	= fechaExcel($Row[45]);
                    $fechaSalida 	 	= fechaExcel($Row[46]);
                    // var_dump($Row[45],$Row[46]);
                    // var_dump($fechaIngreso,$fechaSalida);
                    $noValido = (sizeof(explode('-',$fechaSalida)) == 3) ? FALSE : TRUE; 
                    // var_dump($noValido);
                    // die();
                    $ingresoVenta 	 	= $Row[47];
                    $gastoVenta 	 	= $Row[48];
                    $margen 	 		= $Row[49];
                    $margenKilo 	 	= $Row[50];
                    $transaccion 	 	= $Row[51];
                    $tipoOperacion 	 	= $Row[52];
                    $estadoEgreso 	 	= $Row[53];
                    $estadoIngreso 	 	= $Row[54];
                    $clasificacion 	 	= $Row[55];
                    $sexo 	 			= $Row[56];
                    $fechaRomaneo 	 	= ($Row[57] != "") ? fechaExcel($Row[57]) : '0000-00-00';
                    $kilosCarcasaIngreso = $Row[58];
                    $kilos3raBalanza 	= $Row[59];
                    $kilosCarne4ta 	 	= $Row[60];
                    $dressing 	 		= $Row[61];
                    $ADPC		 	 	= $Row[62]; 
                    $convMSCarcasa 	 	= $Row[63];
                    $establecimiento 	= $Row[64];	
                    $trazadoSino		= $Row[65];	
                    $zona				= $Row[66];	
                    $costoAlimentacion  = $Row[67];
                    $costoSanidad       = $Row[68];
                    $consignatarioVenta = $Row[69];
                    $establecimientoFaena = $Row[70];

                    if($campoVacio > 4){       

                            echo "<script>

                            window.location.href = 'datos';

                            </script>";
                            die();

                    }
                    

                    if ($rowValidaTemp == FALSE) {
                        $fechaSeparada = explode('-',$fechaSalida);
                        $anio = $fechaSeparada[0];
                        $mes = $fechaSeparada[1];
                        
                        if ($mes < 10) {
                            
                            $mes = substr($mes,1);
                        }
                        

                        $sqlValidacion = "SELECT COUNT(*) as valido FROM animales where month(fechaSalida) = $mes AND year(fechaSalida) = $anio";
                        $queryValidacion = mysqli_query($conexion,$sqlValidacion);
                        $resultado = mysqli_fetch_array($queryValidacion);
                        
                        if ($resultado['valido'] != 0) {

                            echo "<script>
                            window.location.href = 'index.php?ruta=datos&alerta=datosRepetidos';
                            </script>";
                            die();

                        }
                    
                    } 

                    $rowValidaTemp = TRUE; 

                    $sql = "INSERT INTO animales(archivo,hotelero,caravana,categoria,raza,tropa,motivo,destinoVenta,actividad,cab,kgIngresoCC,kgSalidaCC,kgProdCC,diasCC,adpvCC,convMSCC,vecesRP,kgProdRP,diasRP,adpvRP,convMSRP,vecesRC,kgProdRC,diasRC,adpvRC,convMSRC,vecesT,kgProdT,diasT,adpvT,convMST,convTC,totalKgTC,totalKgMS,costoKG,costoCompra,otrosCompra,total,consignatario,proveedor,localidad,provincia,totalConsumo,totalEstructura,estadoProduccion,anio,fechaIngreso,fechaSalida,ingresoVenta,gastoVenta,margen,margenKilo,transaccion,tipoOperacion,estadoEgreso,estadoIngreso,clasificacion,sexo,fechaRomaneo,kilosCarcasaIngreso,kilos3raBalanza,kilosCarne4ta,dressing,ADPC,convMSCarcasa,establecimiento,trazadoSino,zona,costoAlimantacion,costoSanidad,consignatarioVenta,estFaena) 
                    VALUES('$nombreArchivo','$hotelero','$caravana','$categoria','$raza','$tropa','$motivo','$destinoVenta','$actividad','$cab','$kgIngreso','$kgSalida','$kgProd','$dias','$adpv','$convMS','$vecesRP','$kgP','$dias2','$adpv3','$CMS','$vecesRC','$kgP7','$dias6','$adpv8','$CMS9','$vecesT','$kgP13','$dias12','$adpv14','$CMS15','$convTC','$totalKgTC','$totalKgMS','$costoKG','$costoCompra','$otrosCompra','$total','$consignatario','$proveedor','$localidad','$provincia','$totalConsumo','$totalEstructura','$estadoProduccion','$anio','$fechaIngreso','$fechaSalida','$ingresoVenta','$gastoVenta','$margen','$margenKilo','$transaccion','$tipoOperacion','$estadoEgreso','$estadoIngreso','$clasificacion','$sexo','$fechaRomaneo','$kilosCarcasaIngreso','$kilos3raBalanza','$kilosCarne4ta','$dressing','$ADPC','$convMSCarcasa','$establecimiento','$trazadoSino','$zona','$costoAlimentacion','$costoSanidad','$consignatarioVenta','$establecimientoFaena')";

                    mysqli_query($conexion,$sql);
                    
                    echo mysqli_error($conexion);

                    $errorMysql = mysqli_error($conexion);

                    if($errorMysql != '' OR $noValido){

                        $sql = "DELETE FROM animales WHERE archivo = '$nombreArchivo'";
                        mysqli_query($conexion,$sql);

                        unlink("carga/".$_FILES['nuevosDatos']['name']);

                        echo "<script>

                        window.location.href = 'index.php?ruta=datos&alerta=error&errorFila=".$rowNumber."';

                        </script>";

                        die();

                    }

                
                }

                if ($Row[0] == 'Hotelero' AND $Row[1] == 'Caravana') {

                        $rowValida = TRUE;

                }

            }		
        }

    }



    echo "<script>

    window.location.href = 'index.php?ruta=datos&alerta=cargadoCorrecto';

    </script>";

    echo "<script>

    window.location.href = 'index.php?ruta=datos&alerta=cargadoCorrecto';

    </script>";

}
?>