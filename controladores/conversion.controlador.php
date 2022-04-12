<?php
class ControladorConversion{

	/*=============================================
	MOSTRAR DATOS
	=============================================*/

	static public function ctrMostrarDatos($item, $periodos){

		$tabla = "conversion";

		$periodos = explode(',',$periodos);

		$periodos = implode("','",$periodos);
		
		$periodos = "'$periodos'";

		$respuesta = ModeloConversion::mdlMostrarDatos($tabla, $item, $periodos);

		return $respuesta;

	}

	/*=============================================
	MOSTRAR DATOS ANUAL
	=============================================*/

	static public function ctrMostrarDatosAnual($item, $anios){

		$tabla = "conversion";

		$respuesta = ModeloConversion::mdlMostrarDatosAnual($tabla, $item, $anios);

		return $respuesta;

	}



}
	


