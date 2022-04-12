<?php
function fechaExcel($fecha){
	$fechaTemp = explode("-",$fecha);
	$nuevaFecha = $fechaTemp[1]."-".$fechaTemp[0]."-".$fechaTemp[2];
	$standarddate = "20".substr($nuevaFecha,6,2) . "-" . substr($nuevaFecha,3,2) . "-" . substr($nuevaFecha,0,2);
	return $standarddate;
}

require_once('excel/php-excel-reader/excel_reader2.php');
require_once('excel/SpreadsheetReader.php');


if( isset($_POST["submit"]) ){

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
					if ($contador > 8) {

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
						$fechaRomaneo 	 	= fechaExcel($Row[60]);
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

						$sql = "INSERT INTO animales(
						hotelero,caravana,categoria,raza,tropa,motivo,destinoVenta,actividad,cab,kgIngreso,kgSalida,kgProd,dias,
						adpv,convMS,kgI,kgE,dias2,kgP,adpv3,CMS,kgI4,kgE5,dias6,kgP7,adpv8,CMS9,kgI10,kgE11,dias12,kgP13,adpv14,CMS15,convTC,totalKgTC,totalKgMS,costoKG,costoCompra,otrosCompra,total,consignatario,proveedor,localidad,provincia,totalConsumo,totalEstructura,estadoProduccion,anio,fechaIngreso,fechaSalida,ingresoVenta,gastoVenta,margen,margenKilo,transaccion,tipoOperacion,estadoEgreso,estadoIngreso,clasificacion,sexo,fechaRomaneo,kilosCarcasaIngreso,kilos3raBalanza,kilosCarne4ta,dressing,ADPC,convMSCarcasa,establecimiento,trazadoSino,zona,columna16) VALUES(
						'$hotelero','$caravana','$categoria','$raza','$tropa','$motivo','$destinoVenta','$actividad','$cab','$kgIngreso','$kgSalida','$kgProd','$dias','$adpv','$convMS','$kgI','$kgE','$dias2','$kgP','$adpv3','$CMS','$kgI4','$kgE5','$dias6','$kgP7','$adpv8','$CMS9','$kgI10','$kgE11','$dias12','$kgP13','$adpv14','$CMS15','$convTC','$totalKgTC','$totalKgMS','$costoKG','$costoCompra','$otrosCompra','$total','$consignatario','$proveedor','$localidad','$provincia','$totalConsumo','$totalEstructura','$estadoProduccion','$anio','$fechaIngreso','$fechaSalida','$ingresoVenta','$gastoVenta','$margen','$margenKilo','$transaccion','$tipoOperacion','$estadoEgreso','$estadoIngreso','$clasificacion','$sexo','$fechaRomaneo','$kilosCarcasaIngreso','$kilos3raBalanza','$kilosCarne4ta','$dressing','$ADPC','$convMSCarcasa','$establecimiento','$trazadoSino','$zona','$columna16')";
						mysqli_query($conexion,$sql);
						$error = mysqli_error($conexion);
					}else{
							$contador++;
					}
				}		
        }
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
?>