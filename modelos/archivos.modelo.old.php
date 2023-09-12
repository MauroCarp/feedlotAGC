<?php

require_once "conexion.php";

class ModeloArchivos{

	/*=============================================
	MOSTRAR ARCHIVOS
	=============================================*/

	static public function mdlMostrarArchivos($tabla, $item, $valor,$distinct){
		
		if($distinct){

			if($item != null){
	
				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(archivo) FROM $tabla WHERE $item = :$item ORDER BY periodoTime DESC");
	
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				
				$stmt -> execute();
				
				return $stmt -> fetch();
				
			}else{
				
				$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(archivo) FROM $tabla ORDER BY periodoTime DESC");
				
				$stmt -> execute();
				
				return $stmt -> fetchAll();
				
			}
			
		}else{
			
			if($item != null){
				
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY periodoTime DESC");
				
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
				
				$stmt -> execute();
				
				return $stmt -> fetch();
				
			}else{
				
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY periodoTime DESC"); 
				
				$stmt -> execute();
	
				return $stmt -> fetchAll();
	
			}
		}
		
		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	BORRAR ARCHIVO
	=============================================*/

	static public function mdlBorrarArchivo($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE archivo = :nombreArchivo");

		$stmt -> bindParam(":nombreArchivo", $datos, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	/*=============================================
	EDITAR PLANILLA
	=============================================*/

	static public function mdlEditarPlanilla($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
		CSanCabPeriodo = :CSanCabPeriodo,
		CDiaAlimTCCab = :CDiaAlimTCCab,
		CKgRacPromTC = :CKgRacPromTC,
		CKgRacPromMS = :CKgRacPromMS,
		consumTCPondCab = :consumTCPondCab,
		consumMSPondCab = :consumMSPondCab,
		converMSEstADPV = :converMSEstADPV,
		consumoSoja = :consumoSoja,
		consumoMaiz = :consumoMaiz,
		poblDiaPromPeriodo = :poblDiaPromPeriodo,
		totalCabSalida = :totalCabSalida,
		muertosPeriodo = :muertosPeriodo,
		estadiaProm = :estadiaProm,
		cabTrazSalidas = :cabTrazSalidas,
		pesoPromIngSalTraz = :pesoPromIngSalTraz,
		pesoPromEgrTraz = :pesoPromEgrTraz,
		kilosGanPeriodoTraz = :kilosGanPeriodoTraz,
		adpvGanDiaPeriodo = :adpvGanDiaPeriodo,
		totalCabFaenadas = :totalCabFaenadas,
		totalKgCarne = :totalKgCarne,
		totalPesosFaena = :totalPesosFaena,
		rinde = :rinde,
		valorKgObtRinde = :valorKgObtRinde,
		porceDesbaste = :porceDesbaste,
		CProdKgAlim = :CProdKgAlim,
		CProdKgAES = :CProdKgAES,
		margenTecKgProd = :margenTecKgProd,
		indiceReposicion = :indiceReposicion
		WHERE periodo = :periodo");

		
		$stmt -> bindParam(":periodo", $datos["periodo"], PDO::PARAM_STR);
		$stmt -> bindParam(":CSanCabPeriodo", $datos['CSanCabPeriodo'], PDO::PARAM_STR);
		$stmt -> bindParam(":CDiaAlimTCCab", $datos['CDiaAlimTCCab'], PDO::PARAM_STR);
		$stmt -> bindParam(":CKgRacPromTC", $datos['CKgRacPromTC'], PDO::PARAM_STR);
		$stmt -> bindParam(":CKgRacPromMS", $datos['CKgRacPromMS'], PDO::PARAM_STR);
		$stmt -> bindParam(":consumTCPondCab", $datos['consumTCPondCab'], PDO::PARAM_STR);
		$stmt -> bindParam(":consumMSPondCab", $datos['consumMSPondCab'], PDO::PARAM_STR);
		$stmt -> bindParam(":converMSEstADPV", $datos['converMSEstADPV'], PDO::PARAM_STR);
		$stmt -> bindParam(":consumoSoja", $datos['consumoSoja'], PDO::PARAM_STR);
		$stmt -> bindParam(":consumoMaiz", $datos['consumoMaiz'], PDO::PARAM_STR);
		$stmt -> bindParam(":poblDiaPromPeriodo", $datos['poblDiaPromPeriodo'], PDO::PARAM_STR);
		$stmt -> bindParam(":totalCabSalida", $datos['totalCabSalida'], PDO::PARAM_STR);
		$stmt -> bindParam(":muertosPeriodo", $datos['muertosPeriodo'], PDO::PARAM_STR);
		$stmt -> bindParam(":estadiaProm", $datos['estadiaProm'], PDO::PARAM_STR);
		$stmt -> bindParam(":cabTrazSalidas", $datos['cabTrazSalidas'], PDO::PARAM_STR);
		$stmt -> bindParam(":pesoPromIngSalTraz", $datos['pesoPromIngSalTraz'], PDO::PARAM_STR);
		$stmt -> bindParam(":pesoPromEgrTraz", $datos['pesoPromEgrTraz'], PDO::PARAM_STR);
		$stmt -> bindParam(":kilosGanPeriodoTraz", $datos['kilosGanPeriodoTraz'], PDO::PARAM_STR);
		$stmt -> bindParam(":adpvGanDiaPeriodo", $datos['adpvGanDiaPeriodo'], PDO::PARAM_STR);
		$stmt -> bindParam(":totalCabFaenadas", $datos['totalCabFaenadas'], PDO::PARAM_STR);
		$stmt -> bindParam(":totalKgCarne", $datos['totalKgCarne'], PDO::PARAM_STR);
		$stmt -> bindParam(":totalPesosFaena", $datos['totalPesosFaena'], PDO::PARAM_STR);
		$stmt -> bindParam(":rinde", $datos['rinde'], PDO::PARAM_STR);
		$stmt -> bindParam(":valorKgObtRinde", $datos['valorKgObtRinde'], PDO::PARAM_STR);
		$stmt -> bindParam(":porceDesbaste", $datos['porceDesbaste'], PDO::PARAM_STR);
		$stmt -> bindParam(":CProdKgAlim", $datos['CProdKgAlim'], PDO::PARAM_STR);
		$stmt -> bindParam(":CProdKgAES", $datos['CProdKgAES'], PDO::PARAM_STR);
		$stmt -> bindParam(":margenTecKgProd", $datos['margenTecKgProd'], PDO::PARAM_STR);
		$stmt -> bindParam(":indiceReposicion", $datos['indiceReposicion'], PDO::PARAM_STR);
		
		if($stmt -> execute()){

			var_dump($stmt ->errorInfo());
			return "ok";
		
		}else{

			var_dump($stmt ->errorInfo());

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


}