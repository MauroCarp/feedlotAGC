<?php

require_once "conexion.php";

class ModeloDatosMuertes{

	static public function mdlMostrarDatosRango($tabla, $item, $valor,$campo,$item2,$fecha1,$fecha2){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item = :$item AND $item2 BETWEEN '$fecha1' AND '$fecha2'");
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			// var_dump($stmt);

			$stmt -> execute();

			
			return $stmt -> fetchAll();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT $campo FROM $tabla WHERE $item2 BETWEEN '$fecha1' AND '$fecha2'");
			
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

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			// var_dump($stmt);

			$stmt -> execute();
			
			return $stmt -> fetchAll();
			
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
    
    
    static public function mdlMostrarDatosDistinc($tabla, $item, $valor,$campo){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($campo) FROM $tabla WHERE $item = :$item");
			
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			// var_dump($stmt);

			$stmt -> execute();
			
			
			// var_dump($stmt ->errorInfo());
			return $stmt -> fetchAll();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT($campo) FROM $tabla");
			
			$stmt -> execute();
			
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlSumarDatosRango($tabla,$item, $valor,$campo,$item2,$fecha1,$fecha2){

		if($item != null){
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla WHERE $item = :$item AND $item2 BETWEEN '$fecha1' AND '$fecha2'");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			// var_dump($stmt);

			$stmt -> execute();
			
			return $stmt -> fetchAll();
			
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
	
	static public function mdlSumarDatos($tabla, $item, $valor,$campo){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo) FROM $tabla");
			
			// var_dump($stmt);
			$stmt -> execute();
			
			// var_dump($stmt ->errorInfo());
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlSumarMuertesCausaRango($tabla, $item, $valor,$item2,$valor2,$valor3,$item3,$fecha1,$fecha2){
		
		if($item != null){

			
			$stmt = Conexion::conectar()->prepare("SELECT SUM(macho + hembra) FROM $tabla WHERE $item = :$item AND $item2 = :$item2 AND MONTH('$valor3') AND $item3 BETWEEN '$fecha1' AND '$fecha2'");


			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
			var_dump($stmt);

			$stmt -> execute();

			
			return $stmt -> fetch();
			
		}else{
			
			$stmt = Conexion::conectar()->prepare("SELECT SUM($campo1 + $campo2) FROM $tabla WHERE $item = :$item ");
			
			// var_dump($stmt);
			$stmt -> execute();
			
			// var_dump($stmt ->errorInfo());
			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}



}		
