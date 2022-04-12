<?php

require_once "conexion.php";

class ModeloDatosCompras{

	static public function mdlMostrarDatosRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item = :$item AND $item2 BETWEEN '$fecha1' AND '$fecha2' ORDER BY fecha ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item2 BETWEEN '$fecha1' AND '$fecha2' ORDER BY fecha ASC");
			
			// var_dump($stmt);
			$stmt -> execute();
			
			// var_dump($stmt ->errorInfo());
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}
	
	static public function mdlMostrarDatosDistincRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($campo) FROM $tabla WHERE $item = :$item AND $item2 BETWEEN '$fecha1' AND '$fecha2'");
					
			// var_dump($stmt);

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($campo) FROM $tabla WHERE $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			// var_dump($stmt);
			$stmt -> execute();
			
			// var_dump($stmt ->errorInfo());
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}
	
	static public function mdlBuscarPiri($tabla, $item, $valor,$campo){
		
		$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item < :$item ORDER BY fecha DESC LIMIT 1");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		// var_dump($stmt,$valor);
		
		$stmt -> execute();
		
		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


}