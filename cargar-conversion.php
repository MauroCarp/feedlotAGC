<?php
error_reporting(E_ERROR | E_PARSE);

require_once('extensiones/excel/php-excel-reader/excel_reader2.php');
require_once('extensiones/excel/SpreadsheetReader.php');
require_once('modelos/conexion.php');

$meses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

function fechaExcel($fecha){
	$fechaTemp = explode("-",$fecha);
	$nuevaFecha = $fechaTemp[1]."-".$fechaTemp[0]."-".$fechaTemp[2];
	$standarddate = "20".substr($nuevaFecha,6,2) . "-" . substr($nuevaFecha,3,2) . "-" . substr($nuevaFecha,0,2);
	return $standarddate;
}

function validarRegistro($conexion,$anio,$mes){

    $sql = "SELECT COUNT(*) FROM conversion WHERE YEAR(periodoTime) = '$anio' AND MONTH(periodoTime) = '$mes'";

    $query = mysqli_query($conexion,$sql);

    $result = mysqli_fetch_array($query);
    
    return $result[0];

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
                    
                    if($rowNumber == 3){
                        
                        $anio = $Row[1];
                        
                    }
                    
                    if($rowValida == TRUE){   
                        
                        $mes = $Row[1];
                        
                        if($mes == 'promedio anual'){
                            
                            echo "<script>
                            window.location.href = 'index.php?ruta=inicio';
                            </script>";
                            die();

                        }
                        
                        

                        $mes = str_pad(array_search($mes,$meses) + 1, 2, '0', STR_PAD_LEFT);
        
                        $periodoTime = $anio."-".$mes."-01";
                        
                        $periodo = $anio."-".$mes;
                        // var_dump('AÑO = ' . $anio);
                        // var_dump('MES = ' . $mes);
                        // var_dump('VALIDO = ' . validarRegistro($conexion,$anio,$mes));
                        // var_dump("SQL =  SELECT COUNT(*) FROM conversion WHERE YEAR(periodoTime) = '$anio' AND MONTH(periodoTime) = '$mes'");
                        // var_dump('ROW 2 = ' . $Row[2]);

                        if(validarRegistro($conexion,$anio,$mes) == 0 AND $Row[2] != ''){

                            $kgIngCC = $Row[2];
                            $kgEgrCC = $Row[3];
                            $kgProdCC = $Row[4];
                            $diasCC = $Row[5];
                            $adpvCC = $Row[6];
                            $conversionCC = $Row[7];

                            $kgIngRP = $Row[11];
                            $kgEgrRP = $Row[12];
                            $kgProdRP = $Row[13];
                            $diasRP = $Row[10];
                            $adpvRP = $Row[14];
                            $conversionRP = $Row[15];

                            $kgIngRC = $Row[20];
                            $kgEgrRC = $Row[21];
                            $kgProdRC = $Row[22];
                            $diasRC = $Row[19];
                            $adpvRC = $Row[23];
                            $conversionRC = $Row[24];

                            $kgIngT = $Row[29];
                            $kgEgrT = $Row[30];
                            $kgProdT = $Row[31];
                            $diasT = $Row[28];
                            $adpvT = $Row[32];
                            $conversionT = $Row[33];
                        

                            $sql = "INSERT INTO conversion(archivo,periodo,periodoTime,kgIngCC,kgEgrCC,kgProdCC,diasCC,adpvCC,convMsCC,kgIngRP,kgEgrRP,kgProdRP,diasRP,adpvRP,convMsRP,kgIngRC,kgEgrRC,kgProdRC,diasRC,adpvRC,convMsRC,kgIngT,kgEgrT,kgProdT,diasT,adpvT,convMsT) VALUES('$nombreArchivo','$periodo','$periodoTime','$kgIngCC','$kgEgrCC','$kgProdCC','$diasCC','$adpvCC','$conversionCC','$kgIngRP','$kgEgrRP','$kgProdRP','$diasRP','$adpvRP','$conversionRP','$kgIngRC','$kgEgrRC','$kgProdRC','$diasRC','$adpvRC','$conversionRC','$kgIngT','$kgEgrT','$kgProdT','$diasT','$adpvT','$conversionT')";
                    
                            mysqli_query($conexion,$sql);

                            echo mysqli_error($conexion);

                        }
                            
                    }


					if ($rowNumber == 3) {
 
                        $rowValida = TRUE;

                    }

                    if($rowNumber == 15){
                        
                        $rowValida = FALSE;

                    }


			}
                
        }

    }
    // die();
    echo "<script>
    window.location.href = 'index.php?ruta=inicio';
    </script>";

}
?>