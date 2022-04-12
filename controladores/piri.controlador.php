<?php
class ControladorPiri{



	/*=============================================
	MOSTRAR DATOS
	=============================================*/

	static public function ctrMostrarDatos($item, $valor){

		$tabla = "piri";

		$respuesta = ModeloPiri::MdlMostrarDatos($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	CONTAR DATOS
	=============================================*/

	static public function ctrContarDatos($item, $valor,$item2, $valor2, $operador){

		$tabla = "piri";

		$respuesta = ModeloPiri::mdlContarDatos($tabla, $item, $valor,$item2, $valor2, $operador);

		return $respuesta;
	
	}

	
	static public function ctrContarDatosRango($item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2){

		$tabla = "piri";

		$respuesta = ModeloPiri::mdlContarDatosRango($tabla, $item, $valor,$item2, $valor2, $operador,$item3,$fecha1,$fecha2);

		return $respuesta;
	
	}


	/*=============================================
	MOSTRAR TROPAS
	=============================================*/


	static public function ctrMostrarTropas($variable,$item, $valor){

		$tabla = "piri";

		$respuesta = ModeloPiri::mdlMostrarTropas($tabla,$variable, $item, $valor);

		return $respuesta;
	
	}


	/*=============================================
	CONTAR DIAS POR TROPAS
	=============================================*/


	static public function ctrContarDiasTropa($item, $valor){

		$tabla = "piri";

		$respuesta = ModeloPiri::mdlContarDiasTropa($tabla, $item, $valor);
		return $respuesta;
	
	}

	/*=============================================
	CONTAR piri
	=============================================*/


	static public function ctrContarpiri($item, $valor){

		$tabla = "piri";

		$respuesta = ModeloPiri::mdlContarpiri($tabla, $item, $valor);
		return $respuesta;
	
	}


	/*=============================================
	SUMAR CAMPO
	=============================================*/

	static public function ctrSumarCampo($item, $valor,$campo){

		$tabla = "piri";

		$respuesta = ModeloPiri::mdlSumarCampo($tabla, $item, $valor,$campo);
		return $respuesta;
	
	}

	static public function ctrSumarCampoRango($item, $valor,$campo,$item2,$fecha1,$fecha2){

		$tabla = "piri";

		$respuesta = ModeloPiri::mdlSumarCampoRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2);
		return $respuesta;
	
	}


	/*=============================================
	BORRAR PIRI
	=============================================*/

	static public function ctrEliminarPiri(){

		if(isset($_GET["idPiri"])){

			$tabla ="piri";
			$datos = $_GET["idPiri"];

			$respuesta = ModeloPiri::mdlEliminarPiri($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El registro ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "piri";

								}
							})

				</script>';

			}		

		}

	}


}
	


