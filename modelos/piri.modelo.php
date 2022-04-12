<?php

require_once "conexion.php";

class ModeloPiri{

	/*=============================================
	MOSTRAR Datos
	=============================================*/

	static public function mdlMostrarDatos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY fecha DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}
	
	
	/*=============================================
	CONTAR DATOS
	=============================================*/


	static public function mdlContarDatos($tabla, $item, $valor,$item2,$valor2,$operador){

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
	CONTAR DATOS ENTRE FECHAS
	=============================================*/


	static public function mdlContarDatosRango($tabla, $item, $valor,$item2,$valor2,$operador,$item3,$fecha1,$fecha2){

		if ($item2 != null) {

			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item AND $item2 = :$item2 AND $item3 BETWEEN '$fecha1' AND '$fecha2'");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);


			$stmt -> execute();

			//var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{
			
			if($item != null){
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM $tabla WHERE $item $operador :$item AND $item3 BETWEEN '$fecha1' AND '$fecha2'");
	
				$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

				$stmt -> execute();
				return $stmt -> fetch();
	
			}else{
	
				$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla WHERE $item3 BETWEEN '$fecha1' AND '$fecha2'");

				$stmt -> execute();

				return $stmt -> fetchAll();
	
			}

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR TROPAS O CONSIGNATARIO
	=============================================*/

	static public function mdlMostrarTropas($tabla, $variable, $item, $valor){

		if($item != null){
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($variable) FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($variable) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	
	/*=============================================
	CONTAR DIAS POR TROPAS
	=============================================*/

	static public function mdlContarDiasTropa($tabla, $item, $valor){

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


	/*=============================================eee
	CONTAR ANIMALES 
	=============================================*/

	static public function mdlContarAnimales($tabla, $item, $valor){

		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) as totalAnimales FROM $tabla WHERE $item = '$valor'");
			
			$stmt -> execute();

			// var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT COUNT(tropa) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	SUMAR CAMPO 
	=============================================*/

	static public function mdlSumarCampo($tabla, $item, $valor,$campo){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE $item = '$valor'");
			
			$stmt -> execute();

			// var_dump($stmt ->errorInfo());

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	SUMAR CAMPO  RANGO
	=============================================*/

	static public function mdlSumarCampoRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) as totalAnimales FROM $tabla WHERE $item = '$valor' AND $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla WHERE $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
			// var_dump($stmt);
			$stmt -> execute();
			
			// var_dump($stmt ->errorInfo());
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ELIMINAR PIRI
	=============================================*/

	static public function mdlEliminarPiri($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}
