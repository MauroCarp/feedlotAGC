<?php
class ControladorDatos{



	/*=============================================
	MOSTRAR DATOS
	=============================================*/

	static public function ctrMostrarDatos($item, $valor,$orden){

		$tabla = "animales";

		$respuesta = ModeloDatos::MdlMostrarDatos($tabla, $item, $valor,$orden);

		return $respuesta;
	}
	
	/*=============================================
	MOSTRAR DATOS RANGO
	=============================================*/

	static public function ctrMostrarDatosRango($campo, $item, $valor,$item2,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::MdlMostrarDatosRango($tabla, $campo, $item, $valor,$item2,$fecha1,$fecha2);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR DATOS RANGO DOBLEs
	=============================================*/

	static public function ctrMostrarDatosRangoDoble($campo, $item, $valor,$item2,$kg1,$kg2,$item3,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::MdlMostrarDatosRangoDoble($tabla, $campo, $item, $valor,$item2,$kg1,$kg2,$item3,$fecha1,$fecha2);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR DATOS PARA TABLA
	=============================================*/

	static public function ctrMostrarDatosTabla($item, $valor,$orden){

		$tabla = "animales";

		$respuesta = ModeloDatos::MdlMostrarDatosTabla($tabla, $item, $valor,$orden);

		return $respuesta;
	}

	/*=============================================
	CONTAR DATOS
	=============================================*/

	static public function ctrContarDatos($item, $valor,$item2, $valor2, $operador){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarDatos($tabla, $item, $valor,$item2, $valor2, $operador);

		return $respuesta;
	
	}

	
	static public function ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarDatosRango($tabla, $item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR TROPAS
	=============================================*/


	static public function ctrMostrarTropas($variable,$item, $valor){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlMostrarTropas($tabla,$variable, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	CONTAR DIAS POR TROPAS
	=============================================*/


	static public function ctrContarDiasTropa($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarDiasTropa($tabla, $item, $valor);
		return $respuesta;
	
	}

	/*=============================================
	CONTAR ANIMALES
	=============================================*/


	static public function ctrContarAnimales($item, $valor){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarAnimales($tabla, $item, $valor);
		return $respuesta;
	
	}

	/*=============================================
	CONTAR ANIMALES RANGO
	=============================================*/


	static public function ctrContarAnimalesRango($item, $valor,$item2,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarAnimalesRango($tabla, $item, $valor,$item2,$fecha1,$fecha2);
		
		return $respuesta;
	
	}


	/*=============================================
	CONTAR ANIMALES RANGO DOBLE
	=============================================*/


	static public function ctrContarAnimalesRangoDoble($item, $valor,$item2,$kg1,$kg2,$item3,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlContarAnimalesRangoDoble($tabla, $item, $valor,$item2,$kg1,$kg2,$item3,$fecha1,$fecha2);
		
		return $respuesta;
	
	}


	/*=============================================
	SUMAR CAMPO
	=============================================*/

	static public function ctrSumarCampo($item, $valor,$campo){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarCampo($tabla, $item, $valor,$campo);
		return $respuesta;
	
	}

	/*=============================================
	SUMAR CAMPO RANGO
	=============================================*/

	static public function ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarCampoRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}

	
	/*=============================================
	SUMAR CAMPO DOBLE
	=============================================*/

	static public function ctrSumarCampoRangoDoble($item,$valor,$campo,$item2,$kg1,$kg2,$item3,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarCampoRangoDoble($tabla,$item,$valor,$campo,$item2,$kg1,$kg2,$item3,$fecha1,$fecha2);
		return $respuesta;
	
	}


	static public function ctrSumarCampoOperadorRango($item, $valor,$campo,$operador,$item2,$fecha1,$fecha2){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarCampoOperadorRango($tabla, $item, $valor,$campo,$operador,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}


	
	static public function ctrSumarAlimento($item,$valor,$item2,$valor2,$campo,$operador){

		$tabla = "animales";

		$respuesta = ModeloDatos::mdlSumarAlimento($tabla, $item,$valor,$item2,$valor2,$campo,$operador);
		return $respuesta;
	
	}

}