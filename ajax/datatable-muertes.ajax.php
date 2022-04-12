<?php

require_once "../controladores/muertes.controlador.php";
require_once "../modelos/muertes.modelo.php";

require_once "../controladores/datos.controlador.php";
require_once "../modelos/datos.modelo.php";


class TablaMuertes{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaMuertes(){


		$item = NULL;
        $valor = NULL;
        $orden = 'fechaMuerte';
        $muertes = ControladorDatosMuertes::ctrMostrardatos($item, $valor,$orden);
        
        if(count($muertes) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($muertes); $i++){

		//   	/*=============================================
 	 	// 	TRAEMOS LAS ACCIONES
  		// 	=============================================*/ 

		  
		  	$fechaSQL = $muertes[$i]['fechaMuerte'];

			$fecha = strtotime($muertes[$i]['fechaMuerte']);

            $fecha = date('d-m-Y',$fecha);

            $tratado = ($muertes[$i]['tratado']) ? "Fue Tratado" : "No fue tratado";

		  	$datosJson .='[
				  "<span class=\'hide\'>'.$fechaSQL.'</span> '.$fecha.'",
				  "'.ltrim($muertes[$i]["consignatario"]).'",
			      "'.ltrim($muertes[$i]["proveedor"]).'",
			      "'.$muertes[$i]["tropa"].'",
			      "'.$muertes[$i]["motivo"].'",
			      "'.$muertes[$i]["diagnostico"].'",
			      "'.$tratado.'"
                ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarMuertes = new TablaMuertes();
$activarMuertes -> mostrarTablaMuertes();

