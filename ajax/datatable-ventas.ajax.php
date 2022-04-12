<?php
require_once "../controladores/datos.controlador.php";
require_once "../modelos/datos.modelo.php";

function formatearFecha($fecha){
	$fecha = explode('-',$fecha);
	$nuevaFecha = $fecha[2]."-".$fecha[1]."-".$fecha[0];
	return $nuevaFecha;
}

class TablaVentas{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaVentas(){


		$item = NULL;
		
		$valor = NULL;
		
		$orden = 'fechaSalida';
		
		$ventas = ControladorDatos::ctrMostrarDatosTabla($item, $valor,$orden);

        if(count($ventas) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($ventas); $i++){

		//  /*=============================================
 	 	// 	TRAEMOS LAS ACCIONES
  		// 	=============================================*/ 

			$tropa = str_replace("Ã“","Ó",$ventas[$i]["tropa"]);

			$tropa = utf8_decode($tropa);

			$nombreTropa = $ventas[$i]['tropa'];

			$boton = "<button class='btn btn-warning btnVerTropa' tropa='".$tropa."' data-toggle='modal' data-target='#modalVerTropa'><i class='fa fa-eye'></i></button>";

		  	$datosJson .='[
			      "'.ltrim($tropa).'",
				  "'.$boton.'"
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
$activarVentas = new TablaVentas();
$activarVentas -> mostrarTablaVentas();

