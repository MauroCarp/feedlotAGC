<?php

class ControladorArchivos{

	/*=============================================
	MOSTRAR ARCHIVOS
	=============================================*/

	static public function ctrMostrarArchivos($item, $valor,$tabla,$distinct){

		$respuesta = ModeloArchivos::mdlMostrarArchivos($tabla, $item, $valor,$distinct);

		return $respuesta;

	}


	/*=============================================
	BORRAR ARCHIVOS
	=============================================*/

	static public function ctrBorrarArchivos(){

		if(isset($_GET["nombreArchivo"])){

			$tabla = $_GET['tabla'];
			$datos = $_GET["nombreArchivo"];

			$respuesta = ModeloArchivos ::mdlBorrarArchivo($tabla, $datos);
			var_dump($respuesta);
			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "Los registros han sido borrados correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "archivosCarga";

								}
							})

				</script>';

			}		

		}

	}

	/*=============================================
	EDITAR ARCHIVO
	=============================================*/

	static public function ctrEditarPlanilla(){
		
		if(isset($_POST["periodo"])){

				$tabla = "controlpanel";

				$datos = array("CSanCabPeriodo" => $_POST['CSanCabPeriodo'],
								"periodo" => $_POST['periodo'],
								"CDiaAlimTCCab" => $_POST['CDiaAlimTCCab'],
								"CKgRacPromTC" => $_POST['CKgRacPromTC'],
								"CKgRacPromMS" => $_POST['CKgRacPromMS'],
								"consumTCPondCab" => $_POST['consumTCPondCab'],
								"consumMSPondCab" => $_POST['consumMSPondCab'],
								"converMSEstADPV" => $_POST['converMSEstADPV'],
								"consumoSoja" => $_POST['soja'],
								"consumoMaiz" => $_POST['maiz'],
								"poblDiaPromPeriodo" => $_POST['poblDiaPromPeriodo'],
								"totalCabSalida" => $_POST['totalCabSalida'],
								"muertosPeriodo" => $_POST['muertosPeriodo'],
								"estadiaProm" => $_POST['estadiaProm'],
								"cabTrazSalidas" => $_POST['cabTrazSalidas'],
								"pesoPromIngSalTraz" => $_POST['pesoPromIngSalTraz'],
								"pesoPromEgrTraz" => $_POST['pesoPromEgrTraz'],
								"kilosGanPeriodoTraz" => $_POST['kilosGanPeriodoTraz'],
								"adpvGanDiaPeriodo" => $_POST['adpvGanDiaPeriodo'],
								"totalCabFaenadas" => $_POST['totalCabFaenadas'],
								"totalKgCarne" => $_POST['totalKgCarne'],
								"totalPesosFaena" => $_POST['totalPesosFaena'],
								"rinde" => $_POST['rinde'],
								"valorKgObtRinde" => $_POST['valorKgObtRinde'],
								"porceDesbaste" => $_POST['porceDesbaste'],
								"CProdKgAlim" => $_POST['CProdKgAlim'],
								"CProdKgAES" => $_POST['CProdKgAES'],
								"margenTecKgProd" => $_POST['margenTecKgProd'],
								"indiceReposicion" => $_POST['indiceReposicion']
							);

				$respuesta = ModeloArchivos::mdlEditarPlanilla($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La planilla ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "index.php?ruta=panelControl&periodos='.$_POST['periodo'].'";

									}
								})

					</script>';

				}else{

							echo'<script>
			
								swal({
									  type: "error",
									  title: "¡No se pudo editar la planilla!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {
			
										window.location = "archivosCarga";
			
										}
									})
			
						  	</script>';
			
				}

		}
		
	}

}
	


