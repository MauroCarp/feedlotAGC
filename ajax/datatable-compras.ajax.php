<?php

require_once "../controladores/compras.controlador.php";
require_once "../modelos/compras.modelo.php";

require_once "../controladores/datos.controlador.php";
require_once "../modelos/datos.modelo.php";


class TablaCompras{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaCompras(){


		$item = NULL;
		$valor = NULL;
		$orden = 'fecha';
		$compras = ControladorDatosCompras::ctrMostrardatos($item, $valor,$orden);


        if(count($compras) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($compras); $i++){

		//   	/*=============================================
 	 	// 	TRAEMOS LAS ACCIONES
  		// 	=============================================*/ 

			$fechaSQL = $compras[$i]['fecha'];

			$fecha = strtotime($compras[$i]['fecha']);

            $fecha = date('d-m-Y',$fecha);

			$kgIng = number_format($compras[$i]['kgIng'],2,',','.')." Kg.";

			$precioKg = "$ ".number_format($compras[$i]["precioKg"],2,',','.');


		  	$datosJson .='[
			      "<span class=\'hide\'>'.$fechaSQL.'</span> '.$fecha.'",
			      "'.ltrim($compras[$i]["consignatario"]).'",
			      "'.ltrim($compras[$i]["proveedor"]).'",
			      "'.$compras[$i]["tropa"].'",
			      "'.$compras[$i]["cantidad"].'",
			      "'.$kgIng.'",
			      "'.$precioKg.'"
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
$activarCompras = new TablaCompras();
$activarCompras -> mostrarTablaCompras();

