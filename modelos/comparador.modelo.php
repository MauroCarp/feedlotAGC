<?php

require_once "conexion.php";

class ModeloDatosComparar{

	/*=============================================
	MOSTRAR Datos
	=============================================*/

	static public function mdlMostrarDatosComparar($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}
	
	
	/*=============================================
	CONTAR DATOS
	=============================================*/


	static public function mdlContarDatosComparar($tabla, $item, $valor,$item2,$valor2,$operador){

		if ($item2 != null) {

			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item AND $item2 = :$item2");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt -> execute();

			//var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{
			
			if($item != null){
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item");
	
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
	
				$stmt -> execute();
				return $stmt -> fetch();
	
			}else{
	
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
	
				$stmt -> execute();
	
				return $stmt -> fetchAll();
	
			}

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR TROPAS
	=============================================*/

	static public function mdlMostrarTropasComparar($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(tropa) FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(tropa) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CONTAR DIAS POR TROPAS
	=============================================*/

	static public function mdlContarDiasTropaComparar($tabla, $item, $valor){

		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM(diasCC) as totalDias, COUNT(tropa) as totalAnimales FROM $tabla WHERE $item = '$valor'");
			
			$stmt -> execute();

			// var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT(tropa) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	CONTAR ANIMALES 
	=============================================*/

	static public function mdlContarAnimalesComparar($tabla,$item,$item2,$item3,$valor,$valor2,$valor3,$campo){
		if($valor != ''){
			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) FROM $tabla WHERE $item = '$valor' AND $campo != ''");

		}
		
		if($valor2 != 'Proveedor'){
				
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) FROM $tabla WHERE $item2 = '$valor2' AND $campo != ''");
		
		}

		if($valor3 != 'Tropa'){
			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) FROM $tabla WHERE $item3 = '$valor3' AND $campo != ''");
				
		}
				
		// var_dump($stmt ->errorInfo());
				
				
		$stmt -> execute();
		
		return $stmt -> fetch();
		
		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	SUMAR CAMPO 
	=============================================*/

	static public function mdlSumarCampoComparar($tabla,$item,$item2,$item3,$valor,$valor2,$valor3,$campo){
		
		if($valor != 'Consignatario'){
			
				$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE $item = '$valor'");

		}
	
		if($valor2 != 'Proveedor'){
				
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE $item2 = '$valor2'");

		}

		if ($valor3 != 'Tropa') {
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE $item3 = '$valor3'");

		}
			// var_dump($stmt);

			
			$stmt -> execute();

			//var_dump($stmt ->errorInfo());

			return $stmt -> fetch();


	



		$stmt -> close();

		$stmt = null;

	}

}