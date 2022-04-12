<?php
class ControladorDatosCompras{



	/*=============================================
	MOSTRAR DATOS
	=============================================*/

	static public function ctrMostrarDatos($item, $valor,$orden){

		$tabla = "compras";

		$respuesta = ModeloDatos::MdlMostrarDatos($tabla, $item, $valor,$orden);

		return $respuesta;
	}

	/*=============================================
	CONTAR DATOS
	=============================================*/

	static public function ctrContarDatos($item, $valor,$item2, $valor2, $operador){

		$tabla = "compras";

		$respuesta = ModeloDatos::mdlContarDatos($tabla, $item, $valor,$item2, $valor2, $operador);

		return $respuesta;
	
	}

	
	static public function ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2){

		$tabla = "compras";

		$respuesta = ModeloDatos::mdlContarDatosRango($tabla, $item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR TROPAS
	=============================================*/


	static public function ctrMostrarTropas($variable,$item, $valor){

		$tabla = "compras";

		$respuesta = ModeloDatos::mdlMostrarTropas($tabla,$variable, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	CONTAR DIAS POR TROPAS
	=============================================*/


	static public function ctrContarDiasTropa($item, $valor){

		$tabla = "compras";

		$respuesta = ModeloDatos::mdlContarDiasTropa($tabla, $item, $valor);
		return $respuesta;
	
	}

	/*=============================================
	CONTAR ANIMALES
	=============================================*/


	static public function ctrContarAnimales($item, $valor){

		$tabla = "compras";

		$respuesta = ModeloDatos::mdlContarAnimales($tabla, $item, $valor);
		return $respuesta;
	
	}


	/*=============================================
	SUMAR CAMPO
	=============================================*/

	static public function ctrSumarCampo($item, $valor,$campo){

		$tabla = "compras";

		$respuesta = ModeloDatos::mdlSumarCampo($tabla, $item, $valor,$campo);
		return $respuesta;
	
	}

	static public function ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "compras";

		$respuesta = ModeloDatos::mdlSumarCampoRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR DATOS RANGO
	=============================================*/

	static public function ctrMostrarDatosRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "compras";

		$respuesta = ModeloDatosCompras::mdlMostrarDatosRango($tabla,$item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

		/*=============================================
	MOSTRAR DATOS DISTINCT RANGO
	=============================================*/

	static public function ctrMostrarDatosDistincRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "compras";

		$respuesta = ModeloDatosCompras::mdlMostrarDatosDistincRango($tabla,$item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

	/*=============================================
	BUSCAR PIRI
	=============================================*/

	static public function ctrBuscarPiri($item, $valor,$campo){

		$tabla = "piri";

		$respuesta = ModeloDatosCompras::mdlBuscarPiri($tabla, $item, $valor,$campo);
		return $respuesta;
	
	}

	static public function ctrMostrarPiris($item, $valor,$campo){

		$tabla = "piri";

		$respuesta = ModeloDatosCompras::mdlBuscarPiri($tabla, $item, $valor,$campo);
		return $respuesta;
	
	}



}
	


