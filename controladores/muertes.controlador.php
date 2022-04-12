<?php
class ControladorDatosMuertes{



	/*=============================================
	MOSTRAR DATOS
	=============================================*/

	static public function ctrMostrarDatos($item, $valor,$orden){

		$tabla = "muertes";

		$respuesta = ModeloDatos::MdlMostrarDatos($tabla, $item, $valor,$orden);

		return $respuesta;
	}

	/*=============================================
	CONTAR DATOS
	=============================================*/

	static public function ctrContarDatos($item, $valor,$item2, $valor2, $operador){

		$tabla = "muertes";

		$respuesta = ModeloDatos::mdlContarDatos($tabla, $item, $valor,$item2, $valor2, $operador);

		return $respuesta;
	
	}

	
	static public function ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2){

		$tabla = "muertes";

		$respuesta = ModeloDatos::mdlContarDatosRango($tabla, $item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR TROPAS
	=============================================*/


	static public function ctrMostrarTropas($variable,$item, $valor){

		$tabla = "muertes";

		$respuesta = ModeloDatos::mdlMostrarTropas($tabla,$variable, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	CONTAR DIAS POR TROPAS
	=============================================*/


	static public function ctrContarDiasTropa($item, $valor){

		$tabla = "muertes";

		$respuesta = ModeloDatos::mdlContarDiasTropa($tabla, $item, $valor);
		return $respuesta;
	
	}

	/*=============================================
	CONTAR ANIMALES
	=============================================*/


	static public function ctrContarAnimales($item, $valor){

		$tabla = "muertes";

		$respuesta = ModeloDatos::mdlContarAnimales($tabla, $item, $valor);
		return $respuesta;
	
	}


	/*=============================================
	SUMAR CAMPO
	=============================================*/

	static public function ctrSumarCampo($item, $valor,$campo){

		$tabla = "muertes";

		$respuesta = ModeloDatos::mdlSumarCampo($tabla, $item, $valor,$campo);
		return $respuesta;
	
	}

	static public function ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "muertes";

		$respuesta = ModeloDatos::mdlSumarCampoRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR DATOS RANGO
	=============================================*/

	static public function ctrMostrarDatosRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "muertes";

		$respuesta = ModeloDatosMuertes::mdlMostrarDatosRango($tabla,$item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

		/*=============================================
	MOSTRAR DATOS DISTINCT RANGO
	=============================================*/

	static public function ctrMostrarDatosDistincRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "muertes";

		$respuesta = ModeloDatosMuertes::mdlMostrarDatosDistincRango($tabla,$item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

	/*=============================================
	MOSTRAR DATOS DISTINCT 
	=============================================*/

	static public function ctrMostrarDatosDistinc($item, $valor,$campo){

		$tabla = "muertes";

		$respuesta = ModeloDatosMuertes::mdlMostrarDatosDistinc($tabla,$item, $valor,$campo);
		return $respuesta;
	
	}

	/*=============================================
	SUMAR DATOS 
	=============================================*/

	static public function ctrSumarDatos($item, $valor,$campo){

		$tabla = "muertes";

		$respuesta = ModeloDatosMuertes::mdlSumarDatos($tabla,$item, $valor,$campo);
		return $respuesta;
	
	}

	/*=============================================
	SUMAR DATOS RANGO
	=============================================*/

	static public function ctrSumarDatosRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "muertes";

		$respuesta = ModeloDatosMuertes::mdlSumarDatosRango($tabla,$item, $valor,$campo,$item2,$fecha1,$fecha2);

		return $respuesta;
	
	}

	/*=============================================
	SUMAR MUERTES CAUSA
	=============================================*/

	static public function ctrSumarMuertesCausaRango($item, $valor,$item2,$valor2,$valor3,$item3,$fecha1,$fecha2){

		$tabla = "muertes";

		$respuesta = ModeloDatosMuertes::mdlSumarMuertesCausaRango($tabla, $item, $valor,$item2,$valor2,$valor3,$item3,$fecha1,$fecha2);

		return $respuesta;
	
	}





}
	


